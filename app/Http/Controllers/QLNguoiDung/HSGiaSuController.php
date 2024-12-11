<?php

namespace App\Http\Controllers\QLNguoiDung;


use App\Http\Controllers\Controller;
use App\Models\Nguoidung;

class HSGiaSuController extends Controller
{
    public function index()
    {
        // Lấy danh sách người dùng có loại người dùng là "Gia sư"
        $dsgiasu = Nguoidung::where('LoaiNguoiDung', 'Gia sư')
            ->with('giaSu') // Lấy cả thông tin liên kết từ bảng GiaSu
            ->paginate(10);

        return view('quanlygiasu.list_dsgiasu', compact('dsgiasu'));
    }


}
