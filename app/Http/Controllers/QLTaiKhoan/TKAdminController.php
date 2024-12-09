<?php


namespace App\Http\Controllers\QLTaiKhoan;

use App\Http\Controllers\Controller;
use App\Models\QuanTriVien;
use App\Models\TaiKhoan;
use App\Models\VaiTro; // Nếu bạn cần gắn vai trò cho tài khoản
use Illuminate\Http\Request;

class TKAdminController extends Controller
{
    // Hiển thị form tạo tài khoản
    public function create()
    {
        $roles = VaiTro::all(); // Lấy danh sách vai trò nếu có
        return view('quanlytaikhoan.create_admin', compact('roles'));
    }
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $validatedData = $request->validate([
            'TenDN' => 'required|unique:TaiKhoan,TenDN', // Tên đăng nhập phải duy nhất
            'MatKhau' => 'required|min:6', // Mật khẩu phải tối thiểu 6 ký tự
            'HoTen' => 'required|string|max:255', // Họ và tên phải là chuỗi và tối đa 255 ký tự
            'Email' => 'required|email|unique:QuanTriVien,Email', // Email phải duy nhất
            'SDT' => 'required|numeric|unique:QuanTriVien,SDT', // Số điện thoại phải duy nhất
            'VaiTro' => 'required|exists:VaiTro,MaVT', // Vai trò phải tồn tại trong bảng VaiTro
            'TrangThai' => 'required', // Trạng thái tài khoản
        ]);

        // Tạo mã quản trị viên mới theo quy tắc QTXX
        $lastAdmin = QuanTriVien::orderBy('MaQT', 'desc')->first(); // Lấy mã quản trị viên cuối cùng
        $newMaQT = 'QT' . str_pad((intval(substr($lastAdmin->MaQT, 2)) + 1), 2, '0', STR_PAD_LEFT); // Tạo mã mới

        // Tạo tài khoản mới trong bảng TaiKhoan
        $taiKhoan = new TaiKhoan();
        $taiKhoan->TenDN = $validatedData['TenDN'];
        $taiKhoan->MatKhau = $validatedData['MatKhau']; // Mã hóa mật khẩu
        $taiKhoan->LoaiTK = 'QTV'; // Loại tài khoản là quản trị viên (QTV)
        $taiKhoan->TrangThaiTK = $validatedData['TrangThai'];
        $taiKhoan->NgayTao = now(); // Thời điểm tạo tài khoản là thời gian hiện tại
        $taiKhoan->save();

        // Tạo quản trị viên mới trong bảng QuanTriVien
        $quanTriVien = new QuanTriVien();
        $quanTriVien->MaQT = $newMaQT; // Mã quản trị viên tự động tăng
        $quanTriVien->HoTenQT = $validatedData['HoTen'];
        $quanTriVien->Email = $validatedData['Email'];
        $quanTriVien->SDT = $validatedData['SDT'];
        $quanTriVien->TenDN = $taiKhoan->TenDN; // Liên kết tài khoản
        $quanTriVien->MaVT = $validatedData['VaiTro']; // Vai trò của quản trị viên
        $quanTriVien->save();

        // Chuyển hướng về trang danh sách tài khoản với thông báo thành công
        return redirect()->route('list/admin')->with('success', 'Tài khoản quản trị viên đã được tạo thành công!');
    }

    public function delete(Request $request)
    {
        $tenDN = $request->input('TenDN'); // Nhận giá trị TenDN từ input hidden

        // Tìm tài khoản theo tên đăng nhập
        $taiKhoan = TaiKhoan::where('TenDN', $tenDN)->first();

        if ($taiKhoan) {
            $taiKhoan->delete(); // Xóa tài khoản
            return redirect()->route('list.admin')->with('success', 'Tài khoản đã được xóa thành công.');
        }

        return redirect()->route('list.admin')->with('error', 'Tài khoản không tồn tại.');
    }

    // Danh sách tài khoản admin
    public function index()
    {
        $adminAccounts = TaiKhoan::where('LoaiTK', 'QTV')
            ->with(['quanTriVien.vaiTro']) // Load QuanTriVien và VaiTro
            ->get();

        return view('quanlytaikhoan.list_admin', compact('adminAccounts'));
    }
}
