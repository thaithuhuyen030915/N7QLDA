<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DenghiController extends Controller
{
    public function create($MaLop)
    {
        // Logic xử lý tạo đề nghị dạy cho lớp học với MaLop
        // Ví dụ: Trả về view với MaLop
        return view('denghi.create', compact('MaLop'));
    }
}