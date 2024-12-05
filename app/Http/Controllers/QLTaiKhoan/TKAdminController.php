<?php

namespace App\Http\Controllers\QLTaiKhoan;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;

class TKAdminController extends Controller
{
    public function index()
    {
        $adminAccounts = TaiKhoan::where('LoaiTK', 'QTV')
            ->with(['quanTriVien.vaiTro']) // Load QuanTriVien và VaiTro
            ->get();

        return view('quanlytaikhoan.list_admin', compact('adminAccounts'));
    }
}
