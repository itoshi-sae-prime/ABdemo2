<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
    public function dbproduct_ab()
    {
        $q = DB::table('product_tables_ab')->select('id', 'barcode', 'product', 'description', 'brand', 'AB', 'Hasaki', 'Guardian', 'Thegioiskinfood', 'Lamthao');
        $arr = $q->get();
        return view('pages.product', compact('arr'));
    }
    public function createpage()
    {
        return view('create');
    }
    public function urlpage()
    {
        $q = DB::table('product_tables_ab')->select('id', 'barcode', 'product', 'description', 'brand', 'AB', 'Hasaki', 'Guardian', 'Thegioiskinfood', 'Lamthao');
        $arr = $q->get();
        return view('pages.urls', compact('arr'));
    }
    public function historypage($id)
    {
        $arr = DB::table('product_tables_ab')->where('id', $id)->first();
        if ($arr) {
            return view('pages.history', compact('arr'));
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }
    public function dashboardpage()
    {
        return view('pages.dashboard');
    }
    public function categoriespage()
    {
        return view('ages.categories');
    }
    public function brandpage()
    {
        return view('pages.brands');
    }
    public function settingpage()
    {
        return view('pages.setting');
    }
}
