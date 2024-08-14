<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function loginview()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('layouts.dashboard'); // Replace with your intended route
        }

        // Authentication failed
        return redirect()->back()->withErrors([
            'error' => 'Invalid credentials. Please try again.',
        ]);
    }
}
