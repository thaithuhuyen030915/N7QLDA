<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;
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
            'TenDN'    => 'required|string', // Tên đăng nhập
            'MatKhau'  => 'required|string', // Mật khẩu
        ]);

        DB::beginTransaction();
        try {
            // Lấy thông tin từ request
            $username = $request->TenDN;
            $password = $request->MatKhau;

            // Kiểm tra người dùng trong cơ sở dữ liệu
            $user = TaiKhoan::where('TenDN', $username)->first();

            if ($user && $user->MatKhau === $password) {
                // Kiểm tra trạng thái tài khoản
                if ($user->TrangThaiTK !== 'Hoạt động') {
                    Toastr::error('Tài khoản của bạn đang ở trạng thái: ' . $user->TrangThaiTK, 'Lỗi');
                    DB::rollBack();
                    return redirect()->back()->withInput();
                }

                // Phân loại tài khoản
                if ($user->LoaiTK === 'QTV') {
                    $this->handleAdminLogin($user);
                    return redirect()->intended('homeadmin');
                } elseif ($user->LoaiTK === 'Phụ huynh') {
                    $maHoSo = $this->handleParentLogin($username, $user);
                    if ($maHoSo) {
                        return redirect('/classroom/' . $maHoSo);
                    }
                } elseif ($user->LoaiTK === 'Gia sư') {
                    $maHoSo = $this->handleTutorLogin($username, $user);
                    if ($maHoSo) {
                        return redirect('/hosogiasu/' . $maHoSo);
                    }
                }
            }
            // Sai tên đăng nhập hoặc mật khẩu
            Toastr::error('Tên đăng nhập hoặc mật khẩu không đúng.', 'Lỗi');
            DB::rollBack();
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Đã xảy ra lỗi trong quá trình đăng nhập.', 'Lỗi');
            return redirect()->back()->withInput();
        }
    }
    

    /**
     * Xử lý đăng xuất.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất user
        $request->session()->flush(); // Xóa toàn bộ session
        Toastr::success('Đăng xuất thành công!', 'Thành công');
        return redirect('login'); // Quay lại trang đăng nhập
    }

    /**
     * Xử lý đăng nhập cho tài khoản quản trị viên.
     */
    private function handleAdminLogin($user)
    {
        Auth::login($user);
        Session::put('TenDN', $user->TenDN);
        Session::put('LoaiTK', $user->LoaiTK);
        Session::put('NgayTao', $user->NgayTao);
        Session::put('TrangThaiTK', $user->TrangThaiTK);
        Toastr::success('Chào mừng Quản trị viên!', 'Thành công');
        DB::commit();
    }

    /**
     * Xử lý đăng nhập cho tài khoản phụ huynh.
     */
    private function handleParentLogin($username, $user)
    {
        $maHoSo = DB::table('phuhuynh')
            ->join('nguoidung', 'phuhuynh.MaHoSoPH', '=', 'nguoidung.MaHoSoND')
            ->where('nguoidung.TenDN', $username)
            ->value('MaHoSoPH');

        if (!$maHoSo) {
            Toastr::error('Không tìm thấy thông tin phụ huynh.', 'Lỗi');
            DB::rollBack();
            return null;
        }

        Auth::login($user);
        Session::put('TenDN', $user->TenDN);
        Session::put('LoaiTK', $user->LoaiTK);
        Session::put('NgayTao', $user->NgayTao);
        Session::put('TrangThaiTK', $user->TrangThaiTK);
        Toastr::success('Chào mừng Phụ huynh!', 'Thành công');
        DB::commit();

        return $maHoSo;
    }

    /**
     * Xử lý đăng nhập cho tài khoản gia sư.
     */
    private function handleTutorLogin($username, $user)
    {
        $maHoSo = DB::table('giasu')
            ->join('nguoidung', 'giasu.MaHoSoGS', '=', 'nguoidung.MaHoSoND')
            ->where('nguoidung.TenDN', $username)
            ->value('MaHoSoGS');

        if (!$maHoSo) {
            Toastr::error('Không tìm thấy thông tin gia sư.', 'Lỗi');
            DB::rollBack();
            return null;
        }

        Auth::login($user);
        Session::put('TenDN', $user->TenDN);
        Session::put('LoaiTK', $user->LoaiTK);
        Session::put('NgayTao', $user->NgayTao);
        Session::put('TrangThaiTK', $user->TrangThaiTK);
        Toastr::success('Chào mừng Gia sư!', 'Thành công');
        DB::commit();

        return $maHoSo;
    }
}
