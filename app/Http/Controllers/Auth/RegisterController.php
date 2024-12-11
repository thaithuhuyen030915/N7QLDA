<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use App\Models\NguoiDung;
use App\Models\PhuHuynh;
use App\Models\GiaSu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;



class RegisterController extends Controller
{
    /**
     * Hiển thị form đăng ký.
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Trả về view đăng ký
    }

    /**
     * Xử lý logic đăng ký.
     */
    public function register(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'TenDN' => 'required|string|unique:taikhoan,TenDN', // Tên đăng nhập phải duy nhất
            'email' => 'required|string|email|unique:taikhoan,email', // Email phải duy nhất và hợp lệ
            'MatKhau' => 'required|string|min:6|regex:#^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]+$#|confirmed', // Mật khẩu 6 ký tự, gồm chữ và số
            'LoaiTK' => 'required|string|in:Gia sư,Phụ huynh', // Loại tài khoản
            'SDT' => 'required|string|regex:/^0[35789][0-9]{8}$/|unique:nguoidung,SDT', // Số điện thoại phải hợp lệ
        ], [
            'MatKhau.confirmed' => 'Xác nhận mật khẩu không đúng.', // Thông báo nếu mật khẩu không khớp
            'MatKhau.regex' => 'Mật khẩu phải bao gồm cả chữ cái và số.',
            'SDT.required' => 'Số điện thoại là bắt buộc.',
            'SDT.regex' => 'Số điện thoại không hợp lệ. Phải bắt đầu bằng 03, 05, 07, 08, hoặc 09 và có 10-11 chữ số.',
            'SDT.min' => 'Số điện thoại phải có ít nhất 10 chữ số.',
            'SDT.max' => 'Số điện thoại không được quá 11 chữ số.',
            'SDT.unique' => 'Số điện thoại đã được sử dụng.', // Thông báo lỗi nếu số điện thoại không duy nhất
        ]);

        DB::beginTransaction(); // Bắt đầu transaction

        try {
            // Lấy thông tin từ request
            $data = [
                'TenDN' => $request->TenDN,
                'MatKhau' => Hash::make($request->MatKhau), // Mã hóa mật khẩu
                'LoaiTK' => $request->LoaiTK, // Loại tài khoản
                'NgayTao' => now(), // Gán thời gian hiện tại cho NgayTao
                'TrangThaiTK' => 'Hoạt động', // Mặc định trạng thái tài khoản là "Hoạt động"
                'email' => $request->email,
                'SDT' => $request->SDT,
            ];

            // Tạo tài khoản mới trong bảng TaiKhoan
            $taiKhoan = TaiKhoan::create($data);

            // Sinh mã hồ sơ tự động
            $maHoSo = 'HS' . time(); // VD: HS1678891234
            $nguoiDungData = [
                'MaHoSoND' => $maHoSo,
                'HoTen' => $request->TenDN, // Sử dụng TenDN làm HoTen
                'NgaySinh' => $request->NgaySinh ?: null, // Nếu không có giá trị, có thể để null
                'GioiTinh' => $request->GioiTinh ?: null, // Nếu không có giá trị, có thể để null
                'SDT' => $request->SDT,
                'Email' => $request->email,
                'DiaChi' => $request->DiaChi ?: null, // Nếu không có địa chỉ, có thể để null
                'Anh' => null, // Nếu không có ảnh, có thể để null
                'NgayTao' => now(),
                'LoaiNguoiDung' => $request->LoaiTK,
                'TenDN' => $request->TenDN,
            ];

            // Lưu vào bảng NguoiDung
            NguoiDung::create($nguoiDungData);

            // Kiểm tra loại tài khoản và điều hướng tương ứng
            if ($request->LoaiTK === 'Gia sư') {
                GiaSu::create([
                    'MaHoSoGS' => $maHoSo,
                    'LoaiNguoiDung' => 'Gia sư',
                ]);
                return redirect('/hosogiasu')->with('success', 'Đăng ký thành công! Hãy hoàn thiện hồ sơ gia sư.');
            } elseif ($request->LoaiTK === 'Phụ huynh') {
                PhuHuynh::create([
                    'MaHoSoPH' => $maHoSo,
                    'LoaiNguoiDung' => 'Phụ huynh',
                ]);
                return redirect('/classroom')->with('success', 'Đăng ký thành công! Hãy hoàn thiện thông tin phụ huynh.');
            }
            DB::commit(); // Xác nhận transaction

            // Chuyển hướng về trang đăng nhập
            //return redirect()->route('login');
    } catch (\Illuminate\Validation\ValidationException $e) 
        {
            DB::rollBack(); // Hoàn tác nếu có lỗi
            Toastr::error('Đã xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại!', 'Lỗi');
            return redirect()->back()->withInput();
        }
    }
}