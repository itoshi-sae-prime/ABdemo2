<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sanpham;
use Exception;
use Goutte\Client;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function createpage()
    {
        return view('create');
    }
    public function createUserpage()
    {
        return view('createUser');
    }
    public function showUpdateForm($id)
    {
        $products = DB::table('products')->where('id', $id)->first();
        return view('pages.updateLink', ['products' => $products]);
    }
    public function changesLink(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ab_beautyworld' => 'nullable|string|max:255',
            'hasaki' => 'nullable|string|max:255',
            'guardian' => 'nullable|string|max:255',
            'thegioiskinfood' => 'nullable|string|max:255',
            'lamthao' => 'nullable|string|max:255',
            'watsons' => 'nullable|string|max:255',
            'sociolla' => 'nullable|string|max:255',
        ]);

        // Find the product by ID
        $product = Sanpham::findOrFail($id);

        // Update the product details with the new data from the form
        $product->ab_beautyworld = $validatedData['ab_beautyworld'] ?: '';
        $product->hasaki = $validatedData['hasaki'] ?: '';
        $product->guardian = $validatedData['guardian'] ?: '';
        $product->thegioiskinfood = $validatedData['thegioiskinfood'] ?: '';
        $product->lamthao = $validatedData['lamthao'] ?: '';
        $product->watsons = $validatedData['watsons'] ?: '';
        $product->sociolla = $validatedData['sociolla'] ?: '';
        // Save the updated product information
        $product->save();
        // Redirect back with a success message
        return redirect()->route('history', $id)->with('success', 'Product details updated successfully.');
    }

    public function urlpage()
    {
        $products = DB::table('products')
            ->leftJoin('now_prices', function ($join) {
                $join->on('products.id', '=', 'now_prices.p_id')
                    ->whereRaw('now_prices.created_at = (SELECT MAX(np2.created_at) FROM now_prices np2 WHERE np2.p_id = products.id)');
            })
            ->select('products.id', 'products.product_barcode', 'products.brand', 'products.product_name', 'products.ab_beautyworld', 'now_prices.p_ab')
            ->get();
        $user = session('user');
        $permission = DB::table('permission_user')->where('id_user',  $user->id)->first();
        if ($user && isset($user->name)) {
            switch ($permission->id_per) {
                case '1':
                    $view = 'admin.pages.urls';
                    break;
                case '2':
                    $view = 'manager.pages.urls';
                    break;
                default:
                    $view = 'user.pages.urls';
                    break;
            }
            return view($view, [
                'products' => $products,
            ]);
        } else {
            return redirect()->route('login');
        }
    }
    public function historypage($id)
    {
        $product = Sanpham::findOrFail($id);
        $detail =   DB::table('now_prices')->where('p_id', $id)->orderBy('created_at', 'desc')->take(5)->get();
        // $details = $detail->first();
        $detail = $detail->isEmpty() ? 0 : $detail;
        $latestPrices = DB::select("
        SELECT * 
        FROM (
            SELECT 
                @rn := IF(@prev = p_id, @rn + 1, 1) AS rn,
                @prev := p_id, 
                t.*
            FROM now_prices t, (SELECT @prev := null, @rn := 0) as vars
            ORDER BY p_id, created_at DESC
        ) AS subquery
        WHERE subquery.rn = 1;
    ");
        return view('history', [
            'product' => $product,
            'detail' => $detail,
            'new_p' => $latestPrices,
        ]);
    }
    public function updateLink(Request $request)
    {
        // Lấy danh sách ID và link mới từ request
        $ids = $request->input('ids');
        $newLink = $request->input('new_link');

        // Cập nhật link cho các sản phẩm được chọn
        Sanpham::whereIn('id', $ids)->update(['ab_beautyworld' => $newLink]);

        // Chuyển hướng hoặc trả về kết quả
        return redirect()->route('admin.pages.urls')->with('success', 'Link đã được cập nhật thành công.');
    }
    public function categoriespage()
    {
        $q = DB::table('categories')->select('id', 'name', 'thumbnail', 'description', 'url', 'stock');
        $arr = $q->get();
        return view('pages.categories', compact('arr'));
    }
    // public function brandpage()
    // {
    //     $q = DB::table('brands')->select('id', 'name', 'thumbnail', 'description', 'url', 'stock');
    //     $arr = $q->get();
    //     return view('pages.brand', compact('arr'));
    // }
    public function settingpage()
    {
        return view('pages.setting');
    }
    function  configCompare($products, $var)
    {
        $array = [];
        $i = 0;
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            $rows = DB::select("
                                    SELECT *
                                    FROM (
                                        SELECT *
                                        FROM now_prices
                                        WHERE p_id = ?
                                        ORDER BY created_at DESC
                                        LIMIT 2
                                    ) subquery
                                    ORDER BY created_at ASC
                                ", [$product->id]);
            // var_dump($product->id);
            // die();
            if (count($rows) > 1) {
                $array[] = $this->compare($rows[1]->$var, $rows[0]->$var);
            } else {
                $array[] = '';
            }
            $i++;
        }
        return $array;
    }
    public  function averageWithoutZero($values)
    {
        $total = 0;
        $count = 0;
        foreach ($values as $value) {
            if ($value != 0) {
                $total += $value;
                $count++;
            }
        }
        if ($count == 0) {
            return 0; // Tránh chia cho 0 nếu không có giá trị nào khác 0
        }
        return $total / $count;
    }
    public function productsRoot(Request $request)
    {
        $perPage = $request->input('perPage', 200); // Default to 200 if not specified

        // Initial query
        $query = DB::table('products');

        // Apply search filter if provided
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('product_barcode', 'like', '%' . $search . '%');
            });
        }

        // Paginate results
        $products = $query->paginate($perPage);

        // Get the filtered product IDs
        $productIds = $query->pluck('id');

        // Fetch latest prices based on filtered product IDs
        $latestPrices = DB::select("
        SELECT * 
        FROM (
            SELECT 
                @rn := IF(@prev = p_id, @rn + 1, 1) AS rn,
                @prev := p_id, 
                t.*
            FROM now_prices t, (SELECT @prev := null, @rn := 0) as vars
            WHERE t.p_id IN (" . implode(',', $productIds->toArray()) . ")
            ORDER BY p_id, created_at DESC
        ) AS subquery
        WHERE subquery.rn = 1;
        ");

        // Calculate average values for each product
        $averageValues = [];
        foreach ($latestPrices as $price) {
            $values = [
                $price->p_ab,
                $price->p_hsk,
                $price->p_gu,
                $price->p_tgs,
                $price->p_lt,
                $price->p_ws,
                $price->p_sc,
            ];
            $averageValues[$price->p_id] = $this->averageWithoutZero($values);
        }

        $userId = session('user');
        if ($userId) {
            // Fetch the user's role from the database using the user ID
            $user = DB::table('user_login')->where('id', $userId->id)->first();

            $role = $user ? $user->name : null;

            if ($user && isset($role)) {
                switch ($role) {
                    case 'Nguyễn Thành Danh':
                        $view = 'admin.pages.product';
                        break;
                    case 'Lê Minh Quốc':
                        $view = 'manager.pages.product';
                        break;
                    default:
                        $view = 'user.pages.product';
                        break;
                }
                return view($view, [
                    'detail' => DB::table('now_prices')->get(),
                    'arr' => $products,
                    'new_p' => $latestPrices,
                    'average_values' => $averageValues,
                    'c_ab' => $this->configCompare($products, 'p_ab'),
                    'c_hsk' => $this->configCompare($products, 'p_hsk'),
                    'c_gu' => $this->configCompare($products, 'p_gu'),
                    'c_tgk' => $this->configCompare($products, 'p_tgs'),
                    'c_tl' => $this->configCompare($products, 'p_lt'),
                    'c_ws' => $this->configCompare($products, 'p_ws'),
                    'c_sc' => $this->configCompare($products, 'p_sc'),
                    'perPage' => $perPage,
                ]);
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        }
    }

    private function compare($new, $old)
    {
        if ($new > $old) {
            return "fa fa-chevron-up";
        } elseif ($new < $old) {
            return "fa fa-chevron-down";
        } else {
            return "";
        }
    }
    private function checkPrice($products)
    {
        foreach ($products as $product) {
            $product->ab_beautyworld = $this->abScanner($product->ab_beautyworld);
            $product->hasaki = $this->hasakiScanner($product->hasaki);
            $product->guardian = $this->guScanner($product->guardian);
            $product->thegioiskinfood = $this->tgScanner($product->thegioiskinfood);
            $product->lamthao = $this->ltScanner($product->lamthao);
            $product->watsons = $this->wsScanner($product->watsons);
            $product->sociolla = $this->scScanner($product->socialla);
        }
        return $products;
    }
    private function abScanner($link)
    {
        return $this->selectScanner($link, 'GET', 'span.pro-price', null, 1000);
    }
    private function hasakiScanner($value)
    {
        return $this->selectScanner($value, 'GET', '#product_final_price', 'value');
    }
    private function guScanner($value)
    {
        return $this->selectScanner($value, 'GET', "//span[@class='price']", null, 1000);
    }
    private function tgScanner($value)
    {
        return $this->selectScanner($value, 'GET', "//div[@class='page-product-info-newprice']", null, 1000);
    }
    private function ltScanner($value)
    {
        return $this->selectScanner($value, 'GET', "//span[@class='current-price ProductPrice']", null, 1000);
    }
    private function wsScanner($value)
    {
        return $this->selectScanner($value, 'GET', 'span.price', null, 1000);
    }
    private function scScanner($value)
    {
        return $this->selectScanner($value, 'GET', 'span.after-no-save', null, 1000);
    }
    public function reset()
    {
        $this->addProductToPNow();
        return redirect()->route('admin.pages.products');
    }
    private function addProductToPNow()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $products = $this->checkPrice(Sanpham::all());
        foreach ($products as $product) {
            DB::table('now_prices')->insert([
                'p_id' => $product->id,
                'p_ab' => $product->ab_beautyworld,
                'p_hsk' => $product->hasaki,
                'p_gu' => $product->guardian,
                'p_tgs' => $product->thegioiskinfood,
                'p_lt' => $product->lamthao,
                'p_ws' => $product->watsons,
                'p_sc' => $product->socialla,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function selectScanner($value, $method, $selector, $attribute = null, $multiplier = 1)
    {
        $crawler = new CrawlerController();
        $gtagVa =  $crawler->getPrice($value);
        if ($gtagVa) {
            return $gtagVa;
        } else {
            $var_client = $this->generalScanner($value, $method, $selector, $attribute, $multiplier);
            if ($var_client) {
                return $var_client;
            } else {
                return $this->domScanner($value, $method, $selector, $attribute, $multiplier);
            }
        }
    }
    private function generalScanner($value, $method, $selector, $attribute = null, $multiplier = 1)
    {
        $client = new Client();
        $httpOptions = [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; gmt)'
            ]
        ];
        try {
            $crawler = $client->request('GET', $value, $httpOptions);
            $elements = $crawler->filter($selector);
            if ($elements->count() > 0) {
                $elementValue = ($attribute !== null) ? $elements->attr($attribute) : $elements->text();
                return $this->cTN($elementValue) * $multiplier;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }
    private function domScanner($value, $method, $selector, $attribute = null, $multiplier = 1)
    {

        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        try {
            $dom->loadHTML(file_get_contents($value));
        } catch (Exception $e) {
            return false;
        }
        libxml_clear_errors();
        $xpath = new DOMXPath($dom);
        $prices = $xpath->query($selector);
        try {
            if ($prices->length > 0) {
                $price = $prices->item(0)->nodeValue;
                return $this->cTN($price);
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    private function cTN($input)
    {
        $number = preg_replace('/[^\d]/', '', $input);
        $number = (float) $number;
        if (strlen((string)$number) >= 9) {

            return $number / 1000;
        }
        return $number;
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_barcode' => 'required|max:255',
            'brand' => 'required|max:255',
            'product_name' => 'required|max:255',
            'ab_beautyworld' => 'required|max:255',
            'hasaki' => 'required|max:255',
            'guardian' => 'required|max:255',
            'thegioiskinfood' => 'required|max:255',
            'lamthao' => 'required|max:255',
            'watsons' => 'required|max:255',
            'socialla' => 'required|max:255'
        ]);
        $product = Sanpham::create($validatedData);
        return redirect()->route('admin.pages.product')->with('success', 'Product created successfully.');
    }

    public function updateUserlist(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'user_name' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        $user = DB::table('user_login')->insert($validatedData);
        return redirect()->route('pages.user_list')->with('success', 'Product created successfully.');
    }
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids', []);
        if (count($ids) > 0) {
            Sanpham::whereIn('id', $ids)->delete();
            DB::table('now_prices')->where('p_id', $ids)->delete();
            return redirect()->route('admin.pages.product')->with('success', 'Các mục đã được xóa thành công.');
        }
        return redirect()->route('admin.pages.product')->with('error', 'Không có mục nào được chọn để xóa.');
    }
}
