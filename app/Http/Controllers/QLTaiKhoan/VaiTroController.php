<?php

namespace App\Http\Controllers\QLTaiKhoan;

use App\Http\Controllers\Controller;
use App\Models\VaiTro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class VaiTroController extends Controller
{
    public function index()
    {
        $roles = VaiTro::all();
        return view('quanlytaikhoan.list_roles', compact('roles')); // Truyền dữ liệu sang view
    }

    public function store(Request $request)
    {
        // Lấy mã vai trò cuối cùng
        $lastRole = VaiTro::orderBy('MaVT', 'desc')->first();
        $newId = 'VT01'; // Mã mặc định nếu chưa có vai trò nào

        if ($lastRole) {
            // Tách số từ mã cuối và tăng giá trị lên
            $number = (int) substr($lastRole->MaVT, 2);
            $newId = 'VT' . str_pad($number + 1, 2, '0', STR_PAD_LEFT);
        }

        // Tạo vai trò mới
        VaiTro::create([
            'MaVT' => $newId,
            'TenVaiTro' => $request->TenVaiTro,
            'MoTa' => $request->MoTa,
        ]);

        return redirect()->route('list.roles')->with('success', 'Vai trò đã được thêm thành công!');
    }


    public function update(Request $request, $id)
    {
        $role = VaiTro::findOrFail($id);
        $role->update([
            'TenVaiTro' => $request->TenVaiTro,
            'MoTa' => $request->MoTa,
        ]);

        return redirect()->route('list.roles')->with('success', 'Vai trò đã được cập nhật!');
    }

//    public function destroy($id)
//    {
//        // Tìm vai trò theo ID
//        $role = VaiTro::find($id);
//
//        if (!$role) {
//            return redirect()->back()->with('error', 'Vai trò không tồn tại.');
//        }
//
//        // Kiểm tra xem vai trò có liên kết với quản trị viên nào không
//        if ($role->quanTriVien()->exists()) {
//            return redirect()->back()->with('error', 'Không thể xóa vai trò vì đang được sử dụng.');
//        }
//
//        // Xóa vai trò
//        $role->delete();
//        return redirect()->back()->with('success', 'Xóa vai trò thành công.');
//    }
//    public function destroy($id)
//    {
//        $role = VaiTro::findOrFail($id);
//
//        // Kiểm tra nếu vai trò có liên kết với bảng khác, ví dụ như bảng 'QuanTriVien'
//        if ($role->QuanTriVien()->count() > 0) {
//            // Nếu vai trò này đang được sử dụng, không thể xóa, bạn có thể xử lý tùy theo yêu cầu.
//            return redirect()->route('list.roles')->with('error', 'Không thể xóa vai trò vì nó đang được sử dụng.');
//        }
//
//        // Xóa vai trò
//        $role->delete();
//
//        // Quay lại danh sách vai trò và hiển thị thông báo thành công
//        return redirect()->route('list.roles')->with('success', 'Vai trò đã được xóa thành công.');
//    }
//    public function destroy($id)
//    {
//        try {
//            $role = VaiTro::findOrFail($id);
//
//            // Kiểm tra quan hệ QuanTriVien
//            Log::info('QuanTriVien count: ' . $role->QuanTriVien()->count());
//
//            if ($role->QuanTriVien()->count() > 0) {
//                return redirect()->route('list.roles')->with('error', 'Không thể xóa vai trò vì nó đang được sử dụng.');
//            }
//
//            $role->delete();
//
//            return redirect()->route('list.roles')->with('success', 'Vai trò đã được xóa thành công.');
//        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
//            return redirect()->route('list.roles')->with('error', 'Vai trò không tồn tại.');
//        }
//    }
    public function destroy($id)
    {
            // Tìm vai trò theo ID
            $role = VaiTro::findOrFail($id);

            // Kiểm tra nếu vai trò có liên kết với bảng 'QuanTriVien'
            $relatedAdmins = $role->QuanTriVien()->count();

            // Ghi log để kiểm tra số lượng quản trị viên liên kết
            Log::info('Checking if role can be deleted. Related admins: ' . $relatedAdmins);

            if ($relatedAdmins > 0) {
                // Nếu có quản trị viên sử dụng vai trò này, không thể xóa
                return redirect()->route('list.roles')->with('error', 'Không thể xóa vai trò này vì nó đang được sử dụng.');
            }
            // Nếu không có quản trị viên, tiến hành xóa vai trò
            $role->delete();

            // Quay lại danh sách và hiển thị thông báo thành công
            return redirect()->route('list.roles')->with('success', 'Vai trò đã được xóa thành công.');
    }

}

