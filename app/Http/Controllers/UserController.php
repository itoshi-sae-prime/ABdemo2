<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboardpage_user()
    {
        return view('user.pages.dashboard');
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
}
