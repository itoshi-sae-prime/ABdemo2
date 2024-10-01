<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function dashboardpage_mng()
    {
        return view('manager.pages.dashboard');
    }
}
