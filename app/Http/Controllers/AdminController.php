<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function dashboardpage_adm()
    {
        return view('admin.pages.dashboard');
    }
    public function userlist()
    {
        $members = DB::table('user_login')->get();

        return view('admin.pages.user', ['members' => $members]);
    }
}
