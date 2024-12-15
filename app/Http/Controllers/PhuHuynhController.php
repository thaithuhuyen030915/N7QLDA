<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhuHuynh;
use App\Models\NguoiDung;

class PhuHuynhController extends Controller
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
        'Anh' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        'CCCD' => 'required|file|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Trả về view với thông báo và dữ liệu đã nhập
    return redirect()->back()->with([
        'success' => 'Lưu thành công và chờ xác nhận!',
        'HoTen' => $request->HoTen,
        'NgaySinh' => $request->NgaySinh,
        'GioiTinh' => $request->GioiTinh,
        'SDT' => $request->SDT,
        'Email' => $request->Email,
        'DiaChi' => $request->DiaChi,
    ]);
}
}
