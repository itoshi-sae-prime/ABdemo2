<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sanpham;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    // public function home()
    // {
    //     return view('pages.home');
    // }
    public function createpage()
    {
        return view('create');
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

        return view('admin.pages.urls', [
            'products' => $products,
        ]);
    }
    public function historypage($id)
    {
        $product = Sanpham::findOrFail($id);
        $detail =   DB::table('now_prices')->where('p_id', $id)->orderBy('created_at', 'desc')->take(5)->get();
        // $details = $detail->first();
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
    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query == '') {
            $q = DB::table('products')->select('id', 'product_barcode', 'brand', 'product_name', 'brand', 'ab_beautyworld', 'hasaki', 'guardian', 'thegioiskinfood', 'lamthao');
            $arr = $q->get();
            return view('pages.product', compact('arr'));
        } elseif ($query != '') {
            $arr = DB::table('products')->where('product_barcode', 'LIKE', "%$query%")->orWhere('product_name', 'LIKE', "%$query%")->get();
            return view('pages.product', compact('arr'));
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }
    public function searchurl(Request $request)
    {
        $query = $request->input('query');

        if ($query == '') {
            $q = DB::table('products')->select('id', 'product_barcode', 'brand', 'product_name', 'brand', 'ab_beautyworld', 'hasaki', 'guardian', 'thegioiskinfood', 'lamthao');
            $arr = $q->get();
            return view('pages.urls', compact('arr'));
        } elseif ($query != '') {
            $arr = DB::table('urls')->where('product_barcode', 'LIKE', "%$query%")->orWhere('product_name', 'LIKE', "%$query%")->get();
            return view('pages.urls', compact('arr'));
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }
    public function dashboardpage()
    {
        return view('pages.dashboard');
        // $user = Auth::user();

        // $userRole = DB::table('user_new')->where('role', $user->Role)->value('Role');
        // dd($user->Role);
        // die();
        // if ($user->role === 'admin') {
        //     echo '1';
        //     return view('admin.pages.dashboard');
        // } else if ($user->role  ===  'manager') {
        //     echo '2';
        //     return view('manager.pages.dashboard');
        // } else {
        //     echo '3';
        //     return view('user.pages.dashboard');
        // }
    }
    public function categoriespage()
    {
        $q = DB::table('categories')->select('id', 'name', 'thumbnail', 'description', 'url', 'stock');
        $arr = $q->get();
        return view('pages.categories', compact('arr'));
    }
    public function brandpage()
    {
        $q = DB::table('brands')->select('id', 'name', 'thumbnail', 'description', 'url', 'stock');
        $arr = $q->get();
        return view('pages.brand', compact('arr'));
    }
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
        $perPage = $request->input('perPage', 200); // Default to 50 if not specified

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

        // Fetch latest prices
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

        // Calculate average values for each product
        $averageValues = [];
        foreach ($latestPrices as $price) {
            $values = [
                $price->p_ab,
                $price->p_hsk,
                $price->p_gu,
                $price->p_tgs,
                $price->p_lt
            ];
            $averageValues[$price->p_id] = $this->averageWithoutZero($values);
        }
        $userId = session('user');
        if ($userId) {
            // Fetch the user's role from the database using the user ID
            $user = DB::table('user_new')->where('id', $userId->Id)->first();

            $role = $user ? $user->Role : null;

            if ($user && isset($role)) {
                switch ($role) {
                    case 'admin':
                        $view = 'admin.pages.product';
                        break;
                    case 'manager':
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
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    public function reset()
    {
        $this->addProductToPNow();
        return redirect()->route('pages.products');
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
        ]);
        // var_dump($validatedData);
        // die();
        // Create the product and log the result
        $product = Sanpham::create($validatedData);
        return redirect()->route('pages.product')->with('success', 'Product created successfully.');
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
