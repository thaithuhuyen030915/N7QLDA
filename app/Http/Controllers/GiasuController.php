<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiaSu;
use App\Models\NguoiDung;

class GiaSuController extends Controller
{
    public function save(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'HoTen' => 'required|string|max:255',
            'NgaySinh' => 'required|date',
            'GioiTinh' => 'required|string|max:10',
            'SDT' => 'required|string|max:15',
            'Email' => 'required|email|max:255',
            'DiaChi' => 'required|string|max:255',
            'Anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'KinhNghiem' => 'required|string',
            'ThanhTich' => 'required|string',
            'ChucVu' => 'required|string',
            'NoiHocTap' => 'required|string',
            'BangCap' => 'required|string',
            'ChuyenNganh' => 'required|string',
            'HinhThucDay' => 'required|string',
            'MonHoc' => 'required|string',
            'ThoiGian' => 'required|string',
            'HocPhi' => 'required|numeric',
            'CCCD' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'MinhChung' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Lưu hình ảnh nếu có
        $imageName = null;
        if ($request->hasFile('Anh')) {
            $imageName = time() . '.' . $request->Anh->extension();
            $request->Anh->move(public_path('assets/img'), $imageName);
        }

        // Lưu thông tin người dùng
        $nguoiDung = new NguoiDung();
        $nguoiDung->HoTen = $request->HoTen;
        $nguoiDung->NgaySinh = $request->NgaySinh;
        $nguoiDung->GioiTinh = $request->GioiTinh;
        $nguoiDung->SDT = $request->SDT;
        $nguoiDung->Email = $request->Email;
        $nguoiDung->DiaChi = $request->DiaChi;
        $nguoiDung->Anh = $imageName;
        $nguoiDung->save();

        // Lưu thông tin gia sư
        $giaSu = new GiaSu();
        $giaSu->MaHoSoGS = $nguoiDung->id; // Giả sử MaHoSoGS là khóa ngoại từ NguoiDung
        $giaSu->LoaiNguoiDung = 'Gia Sư'; // Hoặc lấy từ input nếu cần
        $giaSu->KinhNghiem = $request->KinhNghiem;
        $giaSu->BangCap = $request->BangCap;
        $giaSu->QueQuan = $request->QueQuan;
        $giaSu->Tinh_Thanh = $request->input('Tinh/Thanh');
        $giaSu->Quan_Huyen = $request->input('Quan/Huyen');
        $giaSu->ThanhTich = $request->ThanhTich;
        $giaSu->ChucVu = $request->ChucVu;
        $giaSu->NoiHocTap = $request->NoiHocTap;
        $giaSu->HinhThucDay = $request->HinhThucDay;
        $giaSu->MonHoc = $request->MonHoc;
        $giaSu->ThoiGian = $request->ThoiGian;
        $giaSu->HocPhi = $request->HocPhi;

        // Lưu file CCCD và Minh Chứng
        if ($request->hasFile('CCCD')) {
            $cccdName = time() . '_cccd.' . $request->CCCD->extension();
            $request->CCCD->move(public_path('assets/img'), $cccdName);
            $giaSu->CCCD = $cccdName;
        }

        if ($request->hasFile('MinhChung')) {
            $minhChungName = time() . '_minhchung.' . $request->MinhChung->extension();
            $request->MinhChung->move(public_path('assets/img'), $minhChungName);
            $giaSu->MinhChung = $minhChungName;
        }

        $giaSu->ChuyenNganh = $request->ChuyenNganh;
        $giaSu->save();

        return redirect()->back()->with('success', 'Thông tin đã được lưu thành công!');
    }
}
?>
