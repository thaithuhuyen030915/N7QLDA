<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use App\Models\NguoiDung;
use App\Models\PhuHuynh;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Brian2694\Toastr\Facades\Toastr;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Thay bằng đường dẫn view của bạn
    }

    public function register(Request $request)
    {
        \Log::info('Register method called.');
        try {
            DB::beginTransaction(); // Bắt đầu transaction

            // Validate form inputs
            $validatedData = $request->validate([
                'TenDN' => 'required|string|unique:taikhoan,TenDN|max:255',
                'MatKhau' => 'required|string|min:6|regex:#^(?=.*[a-zA-Z])(?=.*\\d)[a-zA-Z\\d]+$#|confirmed',
                'LoaiTK' => 'required|string|in:Gia sư,Phụ huynh',
            ], [
                'MatKhau.regex' => 'Mật khẩu phải bao gồm cả chữ cái và số.',
                'MatKhau.confirmed' => 'Xác nhận mật khẩu không đúng.',
            ]);

            // Tạo tài khoản mới
            $taiKhoan = TaiKhoan::create([
                'TenDN' => $request->TenDN,
                'MatKhau' => $request->MatKhau,
                'LoaiTK' => $request->LoaiTK,
                'NgayTao' => now(),
                'TrangThaiTK' => 'Hoạt động',
            ]);

            // Sinh mã hồ sơ tự động
            $lastProfile = NguoiDung::orderBy('MaHoSoND', 'desc')->first();
            $maHoSo = $lastProfile ? 'HS' . str_pad(((int)substr($lastProfile->MaHoSoND, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'HS009';

            while (NguoiDung::where('MaHoSoND', $maHoSo)->exists()) {
                $maHoSo = 'HS' . str_pad(((int)substr($maHoSo, 2)) + 1, 3, '0', STR_PAD_LEFT);
            }

            // Tạo người dùng mới
            NguoiDung::create([
                'MaHoSoND' => $maHoSo,
                'NgayTao' => now(),
                'LoaiNguoiDung' => $request->LoaiTK,
                'TenDN' => $taiKhoan->TenDN,
            ]);

            // Nếu loại tài khoản là Phụ huynh, thêm thông tin vào bảng PhuHuynh
            if ($request->LoaiTK === 'Phụ huynh') {
                PhuHuynh::create([
                    'MaHoSoPH' => $maHoSo,
                    'LoaiNguoiDung' => $request->LoaiTK,
                    'CCCD' => $request->input('CCCD', null),
                    'HoTen' => $request->input('HoTen', null),
                    'SĐT' => $request->input('SĐT', null),
                    'Email' => $request->input('Email', null),
                    'DiaChi' => $request->input('DiaChi', null),
                    'Anh' => $request->input('Anh', null),
                    'MoTa' => $request->input('MoTa', null),
                ]);
            }

            DB::commit(); // Lưu thay đổi vào database
            Toastr::success('Đăng ký thành công! Hãy đăng nhập để tiếp tục.');// Chuyển hướng về trang đăng nhập với thông báo thành công
            return redirect()->route('login');

        } catch (Exception $e) {
            DB::rollBack(); // Hoàn tác nếu có lỗi
            return back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
}
?>
