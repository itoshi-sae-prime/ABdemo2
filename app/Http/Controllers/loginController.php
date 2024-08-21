<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function loginview()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:0',
        ]);
        // Tìm người dùng trong bảng 'user_new' dựa trên email
        $user = DB::table('user_new')->where('email', $request->email)->first();
        // Kiểm tra xem người dùng có tồn tại và mật khẩu có đúng không
        if ($user && $request->password === $user->Password) {
            // Lưu thông tin người dùng vào session
            session(['user' => $user]);
            // Redirect to the intended page
            switch ($user->Role) {
                case 'admin':
                    return redirect()->intended('admin/dashboard');
                case 'manager':
                    return redirect()->intended('manager/dashboard');
                case 'user':
                    return redirect()->intended('user/dashboard');
                default:
                    return redirect()->intended('home'); // hoặc một trang mặc định khác
            }
        } else {
            // Trả về thông báo lỗi nếu không đăng nhập được
            return redirect()->back()->withErrors([
                'error' => 'User with email ' . $request->email . ' does not exist or the password is incorrect. Please try again.',
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginview');
    }
}
