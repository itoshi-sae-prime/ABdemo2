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
            'account' => 'required|string|min:0',
            'password' => 'required|string|min:0',
        ]);
        session('user');
        // Tìm người dùng trong bảng 'user_new' dựa trên email
        $user = DB::table('user_login')->where('user_name', $request->account)->first();

        // if ($request->account === $user->user_name && $request->password === $user->password)
        //     dd($user->name);
        // else {
        //     dd(false);
        // }
        // Kiểm tra xem người dùng có tồn tại và mật khẩu có đúng không
        if ($user && $request->password === $user->password) {
            // Lưu thông tin người dùng vào session

            session(['user' => $user]);
            $permission = DB::table('permission_user')->where('id_user',  $user->id)->first();
            switch ($permission->id_per) {
                case '1':
                    return redirect()->intended('admin/dashboard');
                case '2':
                    return redirect()->intended('manager/dashboard');
                default:
                    return redirect()->intended('user/dashboard');
            }
            // Redirect to the intended page

        } else {
            // Trả về thông báo lỗi nếu không đăng nhập được
            return redirect()->back()->withErrors([
                'error' => 'User with email ' . $request->account . ' does not exist or the password is incorrect. Please try again.',
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginview');
    }
}
