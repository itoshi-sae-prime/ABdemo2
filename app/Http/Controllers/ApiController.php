<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getID($barcode)
    {
        $pro = DB::table('product_id')->where('barcode', $barcode)->first();
        return $pro;
    }
}
