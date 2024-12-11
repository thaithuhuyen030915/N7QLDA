<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\QuanTriVien;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
//    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;


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
                // Kiểm tra loại tài khoản phải là QTV
                if ($user->LoaiTK === 'QTV') {
                    // Lưu thông tin đăng nhập vào session
                    Auth::login($user);
                    Session::put('TenDN', $user->TenDN);
                    Session::put('LoaiTK', $user->LoaiTK);
                    Session::put('NgayTao', $user->NgayTao);
                    Session::put('TrangThaiTK', $user->TrangThaiTK);

                    // Lấy thông tin quản trị viên và vai trò của họ
                    $admin = QuanTriVien::where('TenDN', $username)->first();
                    if ($admin) {
                        $role = $admin->vaiTro ? $admin->vaiTro->TenVaiTro : 'Chưa xác định';
                        Session::put('TenVaiTro', $role); // Lưu tên vai trò vào session
                    }

                    Toastr::success('Đăng nhập thành công!', 'Thành công');
                    DB::commit();
                    return redirect()->intended('homeadmin'); // Chuyển đến trang home
                } elseif ($user->LoaiTK === 'Phụ huynh') {
                    // Xử lý đăng nhập phụ huynh
                    $maHoSo = DB::table('phuhuynh')
                    ->join('nguoidung', 'phuhuynh.MaHoSoPH', '=', 'nguoidung.MaHoSoND')
                    ->where('nguoidung.TenDN', $username)
                    ->value('MaHoSoPH');
                    if (!$maHoSo) {
                        // Nếu không tìm thấy mã hồ sơ, xử lý lỗi
                        Toastr::error('Không tìm thấy thông tin phụ huynh.', 'Lỗi');
                        return redirect()->back();
                    }
                    // Lưu thông tin đăng nhập vào session
                    Auth::login($user);
                    Session::put('TenDN', $user->TenDN);
                    Session::put('LoaiTK', $user->LoaiTK);
                    Session::put('NgayTao', $user->NgayTao);
                    Session::put('TrangThaiTK', $user->TrangThaiTK);

                    Toastr::success('Chào mừng phụ huynh!', 'Thành công');
                    DB::commit();
                    return redirect('/classroom/' . $maHoSo);
                } elseif ($user->LoaiTK === 'Gia sư'){
                    // Xử lý đăng nhập gia sư
                    // Tìm mã hồ sơ của gia sư dựa trên tên đăng nhập
                    $maHoSo = DB::table('giasu')
                    ->join('nguoidung', 'giasu.MaHoSoGS', '=', 'nguoidung.MaHoSoND')
                    ->where('nguoidung.TenDN', $username)
                    ->value('MaHoSoGS');
                    if (!$maHoSo) {
                        // Nếu không tìm thấy mã hồ sơ, xử lý lỗi
                        Toastr::error('Không tìm thấy thông tin gia sư.', 'Lỗi');
                        return redirect()->back();
                    }
                    // Lưu thông tin đăng nhập vào session
                    Auth::login($user);
                    Session::put('TenDN', $user->TenDN);
                    Session::put('LoaiTK', $user->LoaiTK);
                    Session::put('NgayTao', $user->NgayTao);
                    Session::put('TrangThaiTK', $user->TrangThaiTK);
                    Toastr::success('Chào mừng gia sư!', 'Thành công');
                    DB::commit();
                    return redirect('/hosogiasu/' . $maHoSo);
                } else {
                    //Sai thông tin đăng nhập
                    Toastr::error('Tên đăng nhập hoặc mật khẩu không đúng.', 'Lỗi');
                    DB::rollBack();
                    return redirect()->back();
                }
            }
        }catch (\Illuminate\Validation\ValidationException $e) {
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
