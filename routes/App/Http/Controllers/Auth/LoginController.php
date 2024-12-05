<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan; // Model bảng TaiKhoan
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     */
    public function login()
    {
        return view('auth.login'); // Trả về view đăng nhập
    }

    /**
     * Xử lý logic đăng nhập.
     */
    public function authenticate(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'TenDN'    => 'required|string|max:20', // Tên đăng nhập
            'MatKhau'  => 'required|string|max:20', // Mật khẩu
        ]);

        DB::beginTransaction();
        try {
            // Lấy thông tin từ request
            $username = $request->TenDN;
            $password = $request->MatKhau;

            // Kiểm tra người dùng trong cơ sở dữ liệu
            $user = TaiKhoan::where('TenDN', $username)->first();

            if ($user && Hash::check($password, $user->MatKhau)) {
                // Lưu thông tin đăng nhập vào session
                Auth::login($user);
                Session::put('TenDN', $user->TenDN);
                Session::put('LoaiTK', $user->LoaiTK);
                Session::put('NgayTao', $user->NgayTao);
                Session::put('TrangThaiTK', $user->TrangThaiTK);

                Toastr::success('Đăng nhập thành công!', 'Thành công');
                DB::commit();
                return redirect()->intended('dashboard'); // Chuyển đến trang dashboard
            } else {
                // Sai thông tin đăng nhập
                Toastr::error('Tên đăng nhập hoặc mật khẩu không đúng.', 'Lỗi');
                DB::rollBack();
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Đã xảy ra lỗi trong quá trình đăng nhập.', 'Lỗi');
            return redirect()->back();
        }
    }

    /**
     * Xử lý logic đăng xuất.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất user
        $request->session()->flush(); // Xóa toàn bộ session
        Toastr::success('Đăng xuất thành công!', 'Thành công');
        return redirect('login'); // Quay lại trang đăng nhập
    }
}
