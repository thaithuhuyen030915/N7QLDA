<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $request->validate([
            'TenDN' => 'required|string|unique:taikhoans,TenDN', // Tên đăng nhập phải duy nhất
            'MatKhau' => 'required|string|min:6|confirmed', // Mật khẩu và xác nhận mật khẩu
            'email' => 'required|string|email|unique:taikhoans,email', // Email phải duy nhất và hợp lệ
        ]);

        DB::beginTransaction();
        try {
            // Lấy thông tin từ request
            $data = $request->only('TenDN', 'MatKhau', 'email');
            $data['MatKhau'] = Hash::make($request->MatKhau); // Mã hóa mật khẩu

            // Tạo tài khoản mới
            $user = TaiKhoan::create($data);

            // Lưu vào session và đăng nhập nếu cần
            session()->put('TenDN', $user->TenDN);
            session()->put('LoaiTK', 'User'); // Bạn có thể thay đổi loại tài khoản ở đây
            Toastr::success('Đăng ký thành công!', 'Thành công');

            DB::commit();
            return redirect()->route('login'); // Điều hướng đến trang đăng nhập sau khi đăng ký thành công
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Đã xảy ra lỗi trong quá trình đăng ký.', 'Lỗi');
            return redirect()->back();
        }
    }
}

?>