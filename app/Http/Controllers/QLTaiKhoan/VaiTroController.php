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
        // Tạo một đối tượng VaiTro mới
        $vaiTro = new VaiTro();

        // Tạo mã vai trò mới (nếu chưa có mã vai trò nào)
        $vaiTro->MaVT = $this->generateRoleId(); // Gọi phương thức generateRoleId để tạo MaVT

        // Gán tên và mô tả vai trò
        $vaiTro->TenVaiTro = $request->TenVaiTro;
        $vaiTro->MoTa = $request->MoTa;

        // Lấy quyền từ form và mã hóa thành JSON
        $quyen = $request->input('Quyen');

        // Mã hóa quyền thành JSON và lưu vào trường Quyen
        $vaiTro->Quyen = json_encode($quyen);

        // Lưu vai trò vào CSDL
        $vaiTro->save();

        return redirect()->route('roles.index')->with('success', 'Vai trò đã được tạo thành công!');
    }
    public function update(Request $request, $id)
    {
        // Lấy vai trò cần sửa
        $role = VaiTro::findOrFail($id);

        // Cập nhật thông tin
        $role->TenVaiTro = $request->input('TenVaiTro');
        $role->MoTa = $request->input('MoTa');
        $role->Quyen = json_encode($request->input('Quyen')); // Lưu quyền dạng JSON (nếu cần)

        $role->save();

        return redirect()->route('roles.index')->with('success', 'Cập nhật vai trò thành công!');
    }

    public function destroy($id)
    {
        $role = VaiTro::findOrFail($id);
        $relatedAdmins = $role->QuanTriVien()->count();

        Log::info('Checking if role can be deleted. Related admins: ' . $relatedAdmins);

        if ($relatedAdmins > 0) {
            return redirect()->route('list.roles')->with('error', 'Không thể xóa vai trò này vì nó đang được sử dụng.');
        }

        $role->delete();
        return redirect()->route('list.roles')->with('success', 'Vai trò đã được xóa thành công.');
    }

    // Phương thức tạo ID cho vai trò
    private function generateRoleId()
    {
        $lastRole = VaiTro::orderBy('MaVT', 'desc')->first();
        $newId = 'VT01'; // Mã mặc định nếu chưa có vai trò nào

        if ($lastRole) {
            // Tách số từ mã cuối và tăng giá trị lên
            $number = (int) substr($lastRole->MaVT, 2);
            $newId = 'VT' . str_pad($number + 1, 2, '0', STR_PAD_LEFT);
        }

        return $newId;
    }
}
