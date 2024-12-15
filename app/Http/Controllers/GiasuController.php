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
            'TrinhDo' => 'required|string',
            'ChuyenNganh' => 'required|string',
            'HinhThucDay' => 'required|string',
            'MonHoc' => 'required|string',
            'CCCD' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'MinhChung' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

       
         // Đưa thông tin vào session để hiển thị lại trên giao diện
        return redirect()->back()->with([
        'success' => 'Lưu thành công và chờ xác nhận!',
        'HoTen' => $request->HoTen,
        'NgaySinh' => $request->NgaySinh,
        'GioiTinh' => $request->GioiTinh,
        'SDT' => $request->SDT,
        'Email' => $request->Email,
        'DiaChi' => $request->DiaChi,
        'QueQuan' => $request->QueQuan,
        'Tinh/Thanh' => $request->input('Tinh/Thanh'),
        'Quan/Huyen' => $request->input('Quan/Huyen'),
        'KinhNghiem' => $request->KinhNghiem,
        'ThanhTich' => $request->ThanhTich,
        'ChucVu' => $request->ChucVu,
        'NoiHocTap' => $request->NoiHocTap,
        'TrinhDo' => $request->TrinhDo,
        'ChuyenNganh' => $request->ChuyenNganh,
        'HinhThucDay' => $request->HinhThucDay,
        'MonHoc' => $request->MonHoc,
    ]);

        //return redirect()->back()->with('success', 'Thông tin đã được lưu thành công!');
    }
}
?>
