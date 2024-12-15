<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhuHuynh;
use App\Models\NguoiDung;

class PhuHuynhController extends Controller
{
    public function update(Request $request)
    {
    // Xác thực dữ liệu
    $request->validate([
        'HoTen' => 'required|string|max:50',
        'NgaySinh' => 'required|date',
        'GioiTinh' => 'required|string|max:10',
        'SDT' => 'required|string|max:15',
        'Email' => 'required|email|max:50',
        'DiaChi' => 'required|string|max:50',
        'Anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'CCCD' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'MaHoSoND' => 'nullable|string|max:50', // Không bắt buộc
        'NgayTao' => 'nullable|date', // Không bắt buộc
        'TenDN' => 'nullable|string|max:50', // Không bắt buộc
    ]);

    // Lưu thông tin người dùng
    $nguoiDung = new NguoiDung();
    $nguoiDung->HoTen = $request->HoTen;
    $nguoiDung->NgaySinh = $request->NgaySinh;
    $nguoiDung->GioiTinh = $request->GioiTinh;
    $nguoiDung->SDT = $request->SDT;
    $nguoiDung->Email = $request->Email;
    $nguoiDung->DiaChi = $request->DiaChi;

    if ($request->hasFile('Anh')) {
        $imageName = time() . '.' . $request->Anh->extension();
        $request->Anh->move(public_path('assets/img'), $imageName); // Sửa đường dẫn ở đây
        $nguoiDung->Anh = $imageName;
    }

    // if ($request->hasFile('CCCD')) {
    //     $imageName = time() . '.' . $request->CCCD->extension();
    //     $request->Anh->move(public_path('assets/img'), $imageName); // Sửa đường dẫn ở đây
    //     $nguoiDung->Anh = $imageName;
    // }

    // Gán giá trị cho MaHoSoND, nhưng không bắt buộc
    $nguoiDung->MaHoSoND = $request->MaHoSoND; // Có thể là null
    $nguoiDung->NgayTao = $request->NgayTao;
    $nguoiDung->TenDN = $request->TenDN;
    $nguoiDung->save();

    // Lưu thông tin phụ huynh
    $maHoSoPH = auth()->user()->MaHoSoPH; // Điều chỉnh theo logic của bạn
    $phuHuynh = PhuHuynh::where('MaHoSoPH', $maHoSoPH)->first() ?? new PhuHuynh();
    $phuHuynh->MaHoSoPH = $maHoSoPH;
    $phuHuynh->CCCD = $request->hasFile('CCCD') ? $request->CCCD->store('cccd') : $phuHuynh->CCCD;
    $phuHuynh->LoaiNguoiDung = 'PhuHuynh'; // Hoặc logic tùy chỉnh của bạn
    $phuHuynh->save();

    return redirect()->back()->with('success', 'Thông tin đã được lưu!');
    }
}
