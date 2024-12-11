<?php

namespace App\Http\Controllers;

use App\Models\Giasu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GiasuController extends Controller
{
    //public function show($MaHoSoGS)
    public function store(Request $request)
    {
        $request->validate([
            'GioiTinh' => 'required',
            'AnhDaiDien' => 'image|mimes:jpg,png,jpeg|max:2048',
            'MaHoSoGS' => 'required',
            'DoiTuong' => 'required',
            'NoiCongTac' => 'required',
            'KinhNghiem' => 'required',
            'BangCap' => 'nullable|string',
            'Email' => 'required|email',
        ]);

        $giasu = new Giasu();
        $giasu->GioiTinh = $request->GioiTinh;
        $giasu->MaHoSoGS = $request->MaHoSoGS;
        $giasu->DoiTuong = $request->DoiTuong;
        $giasu->NoiCongTac = $request->NoiCongTac;
        $giasu->KinhNghiem = $request->KinhNghiem;
        $giasu->BangCap = $request->BangCap;
        $giasu->Email = $request->Email;

        if ($request->hasFile('AnhDaiDien')) {
            $giasu->AnhDaiDien = $request->file('AnhDaiDien')->store('images');
        }

        $giasu->save();

        return redirect()->route('giasu.index')->with('success', 'Hồ sơ gia sư đã được lưu.');
    }
    
    public function showProfile()
        {
            $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
            return view('your_view_name', compact('user')); // Thay your_view_name bằng tên view thực tế
        }
}
