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
        $check = new Check();
        $infor = $check->checkUser()[0];
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
        return redirect()->route('admin.pages.product');
    }
    public function getApporve(Request $request)
    {
        $approvedRequests = DB::table('approved')
            ->where('is_approved', 0)
            ->get();

        return view('appr.approver', ['approvedRequests' => $approvedRequests]);
    }
    public function getApporveRefused(Request $request)
    {
        $approvedRequests = DB::table('approved')
            ->where('is_approved', 2)
            ->get();


        return view('appr.approver', ['approvedRequests' => $approvedRequests, 'page' => 'refuse']);
    }
    public function getApporveAccept(Request $request)
    {
        $approvedRequests = DB::table('approved')
            ->whereIn('is_approved', [1, 2])
            ->get();

        return view('appr.approver', ['approvedRequests' => $approvedRequests, 'page' => 'accept']);
    }

    public function refusePromotion(Request $request)
    {
        $check = new Check();
        $infor = $check->checkUser()[0];
        $approver = $infor->name;
        DB::table('approved')
            ->where('id', $request->ap_id)
            ->update(['approved_by' => $approver, 'is_approved' => 2]);
        return redirect()->route('getApporve');
    }


    public function createPromotion(Request $request)
    {
        $check = new Check();
        $infor = $check->checkUser()[0];


        $start_date = $request->start_date;
        $end_date = $request->end_date;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $barcode = $request->barcode;
        $name = $request->name;
        $approver = $infor->name;
        DB::table('approved')
            ->where('id', $request->ap_id)
            ->update(['approved_by' => $approver, 'is_approved' => true]);


        $value = str_replace(".", "", $request->value);
        $curren_time = now();
        $dataP = new API();
        $id = $dataP->getID($barcode)->id;

        $log = "update_price_barcode:" . $barcode . "_to_" . $value . "_by_:" . (string)$name . "_at_" . $curren_time;
        $check->logAction($log);

        $url = 'https://apis.haravan.com/com/promotions.json';
        $bearerToken = '8672E3C68AF157BDE70E4CC6DF58BF09CDED16AFA455BF167E45D15055094122';

        $body = [
            "promotion" => [
                "name" => "CT KM CANH TRANH |" . $barcode . "|" . $value . "| by :" . $name  . "| at :" . $curren_time . "",
                "ends_at" => $end_date . "T01:00:00Z",
                "starts_at" => $start_date . "T01:00:00Z",
                "value" => $value,
                "discount_type" => "same_price",
                "applies_to_resource" => null,
                "applies_to_quantity" => 0,
                "applies_to_id" => 0,
                "order_over" => null,
                "promotion_apply_type" => 0,
                "created_at" => "2024-01-16T11:57:10.886Z",
                "updated_at" => "2024-01-16T11:57:10.886Z",
                "first_name" => " tạo từ app",
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

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $bearerToken,
            'Content-Type' => 'application/json'
        ])->post($url, $body);

        if ($response->successful()) {
            // Xử lý khi gọi API thành công
            $return = $response->json();
            DB::table('promotion_id')->insert([
                'id_product' => $id,
                'id_promotion' => $return['promotion']['id'],
            ]);
            return redirect()->route('getApporve');
            //  return $return = response()->json(['success' => true, 'data' => $response->json()]);
        } else {
            // Xử lý khi gọi API thất bại
            return response()->json(['success' => false, 'message' => $response->body()]);
        }
    }
}
