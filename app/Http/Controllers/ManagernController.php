<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagernController extends Controller
{
    public function dashboardpage_manager()
    {
        return view('manager.pages.dashboard');
    }
}
