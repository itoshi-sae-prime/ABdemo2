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
}
