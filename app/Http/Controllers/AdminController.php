<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function user_deleteSelected(Request $request)
    {
        // Lấy mảng ID từ yêu cầu
        $ids = $request->input('items');

        if (!is_array($ids) || count($ids) === 0) {
            return redirect()->back()->with('error', 'Không có người dùng nào được chọn để xóa.');
        }

        // Xóa người dùng với các ID được chọn
        User::destroy($ids);

        // Chuyển hướng về trang trước đó với thông báo thành công
        return redirect()->back()->with('success', 'Người dùng đã được xóa thành công.');
    }
}
