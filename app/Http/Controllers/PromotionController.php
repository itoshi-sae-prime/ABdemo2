<?php

namespace App\Http\Controllers;

// use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\LoginController as Check;
use App\Http\Controllers\ApiController as API;

class PromotionController extends Controller
{
    public function promotionForm($barcode, $price)
    {
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
        return view('changesPrice', compact('barcode', 'price'));
    }
    public function sendRequest(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $userId = session('user');
        $infor = DB::table('user_login')->where('id', $userId->id)->first();

        $name = $infor->name;
        $curren_time = now();
        $barcode = $request['barcode'];
        $price = $request['b_value'];
        $discount = $request['value'];
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        $platform = $request['platform'];
        $is_approved = false;

        // Query builder to insert data into the 'approved' table
        DB::table('approved')->insert([
            'name' => $name,
            'current_time' => $curren_time,
            'barcode' => $barcode,
            'price' => $price,
            'discount' => $discount,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'platform' => $platform,
            'is_approved' => $is_approved,
            'created_at' => $curren_time,
            'updated_at' => $curren_time
        ]);

        if ($infor->user_name == 'ABW1570') {
            return redirect()->route('admin.approved.approve');
        } else if ($infor->name == 'Lê Minh Quốc') {
            return redirect()->route('manager.pages.product');
        } else {
            return redirect()->route('user.pages.product');
        }
    }
    public function getApporve(Request $request)
    {
        $approvedRequests = DB::table('approved')->where('is_approved', 0)->get();
        $user = session('user');
        return view('admin.approved.approve', ['approvedRequests' => $approvedRequests]);
        // if ($user->name === 'Nguyễn Thành Danh') {
        //     return view('admin.approved.approve', ['approvedRequests' => $approvedRequests]);
        // } elseif ($user->name === 'Lê Minh Quốc') {
        //     return view('manager.approved.approve', ['approvedRequests' => $approvedRequests]);
        // } else {
        //     // Xử lý trường hợp mặc định nếu cần thiết
        //     return view('login');
        // }
    }
    public function getApporveRefused(Request $request)
    {
        $approvedRequests = DB::table('approved')->where('is_approved', 2)->get();
        return view('admin.approved.refush', ['approvedRequests' => $approvedRequests]);
    }
    public function getApporveAccept(Request $request)
    {
        $approvedRequests = DB::table('approved')->where('is_approved', 1)->get();
        return view('admin.approved.accept', ['approvedRequests' => $approvedRequests]);
    }

    public function refusePromotion(Request $request)
    {
        $userId = session('user');
        $infor = DB::table('user_login')->where('id', $userId->id)->first();
        $approver = $infor->name;
        DB::table('approved')
            ->where('id',  $request->id)
            ->update(['approved_by' => $approver, 'is_approved' => 2]);
        return redirect()->route('pages.approve_refushed');
    }

    public function createPromotion(Request $request)
    {
        $userId = session('user');
        $name = $userId->name;
        $infor = DB::table('user_login')->where('id', $userId->id)->first();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $barcode = $request->barcode;
        $name = $request->name;
        // Lấy thông tin từ session và dữ liệu đã xác thực
        $approver = $infor->name;

        // Cập nhật cơ sở dữ liệu
        DB::table('approved')
            ->where('id', $request->id)
            ->update([
                'approved_by' => $approver,
                'is_approved' => true,
            ]);
        // Chuẩn bị dữ liệu khuyến mãi
        $value = str_replace(".", "", $request->discount);
        $curren_time = now();
        $dataP = new API();
        $id = $dataP->getID($barcode)->id;


        $log = "update_price_barcode:" . $barcode . "_to_" . $value . "_by_:" . $name . "_at_" . $curren_time;
        // Đảm bảo $check được khởi tạo đúng

        // Gửi yêu cầu API
        $url = 'https://apis.haravan.com/com/promotions.json';
        // $bearerToken = env('API_BEARER_TOKEN');
        session(['bearerToken' => '8672E3C68AF157BDE70E4CC6DF58BF09CDED16AFA455BF167E45D15055094122']);
        $bearerToken = session('bearerToken');
        $body = [
            "promotion" => [
                "name" => "CT KM CANH TRANH |" . $barcode . "|" . $value . "| by :" . $name  . "| at :" . $curren_time,
                "ends_at" => $end_date . "T01:00:00Z",
                "starts_at" => $start_date . "T01:00:00Z",
                "value" => $value,
                "discount_type" => "same_price",
                "applies_to_resource" => null,
                "applies_to_quantity" => 0,
                "applies_to_id" => 0,
                "order_over" => null,
                "promotion_apply_type" => 0,
                "created_at" => $curren_time->toDateTimeString(), // Sử dụng ngày giờ động
                "updated_at" => $curren_time->toDateTimeString(), // Sử dụng ngày giờ động
                "first_name" => "tạo từ app",
                "last_name" => "Quốc",
                "create_user" => 200001271639,
                "applies_customer_group_id" => null,
                "status" => "enabled",
                "products_selection" => "product_prerequisite",
                "customers_selection" => "all",
                "provinces_selection" => "all",
                "channels_selection" => "all",
                "locations_selection" => "all",
                "entitled_collection_ids" => [],
                "entitled_product_ids" => [$id],
                "entitled_variant_ids" => [],
                "entitled_customer_ids" => [],
                "entitled_customer_segment_ids" => [],
                "entitled_province_ids" => [],
                "entitled_channels" => [],
                "entitled_location_ids" => [],
                "rule_customs" => [],
                "take_type" => "fixed_amount",
                "usage_limit" => null
            ]
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $bearerToken,
                'Content-Type' => 'application/json'
            ])->post($url, $body);
            if ($response->successful()) {
                $return = $response->json();
                DB::table('promotion_id')->insert([
                    'id_product' => $id,
                    'id_promotion' => $return['promotion']['id'],
                ]);
                return redirect()->route('admin.approved.approve');
            } else {
                return response()->json(['success' => false, 'message' => $response->body()]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
        }
    }
}
