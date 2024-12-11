<?php

namespace App\Http\Controllers\LopHoc;

use App\Http\Controllers\Controller;
use App\Models\LopHoc; // Đảm bảo bạn đã tạo model cho bảng lophoc
use Illuminate\Http\Request;

class LophocController extends Controller
{
    /**
     * Hiển thị danh sách lớp học.
     */
    public function index()
    {
        $lophocs = LopHoc::paginate(5);
        // Trả về view với dữ liệu lớp học
        return view('lophoc.lophoc', compact('lophocs'));
    }
        public function lopdatao($MaHoSoPH)
    {
        // Lấy danh sách lớp học theo mã phụ huynh từ URL
        $lophocs = LopHoc::where('MaHoSoPH', $MaHoSoPH)->paginate(5);

        // Kiểm tra nếu không có lớp học nào thuộc phụ huynh này
        if ($lophocs->isEmpty()) {
            return redirect()->back()->with('warning', 'Không tìm thấy lớp học nào cho phụ huynh này!');
        }

        return view('lophoc.lopdatao', compact('lophocs', 'MaHoSoPH'));
    } 
     // Phương thức hiển thị form tạo lớp học
     public function create()
     {
         return view('lophoc.taolophoc'); // Trả về view form thêm lớp học
     }
     public function store(Request $request)
     {
         $validatedData = $request->validate([
        
             'MonHoc' => 'required|string|max:50',
             'Lop' => 'required|string|max:10',
             'SoBuoi' => 'required|integer',
             'HocPhi' => 'required|string|max:30',
             'ThoiLuongBuoiHoc' => 'required|string|max:11',
             'DoiTuongDay' => 'nullable|string|max:100',
             'HinhThucHoc' => 'required|string|max:50',
             'YeuCauGiaSu' => 'nullable|string|max:200',
             'GioiTinhGiaSu' => 'nullable|string|max:10',
             'DacDiemHocSinh' => 'nullable|string|max:200',
             'ThoiGianDay' => 'nullable|string|max:50',
             'TinhTrangLop' => 'nullable|string|max:50',
             'MaHoSoPH' => 'required|string|max:20',
         ]);
 
      // Tự động sinh Mã Lớp Học
      $lastMaLop = LopHoc::orderBy('MaLop', 'desc')->first();
      if ($lastMaLop) {
          $lastNumber = (int)substr($lastMaLop->MaLop, 2);
          $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
      } else {
          $newNumber = '001';
      }
      $validatedData['MaLop'] = 'LH' . $newNumber;
 
     // Thêm MaLop vào dữ liệu
     //$validatedData['MaLop'] = $newNumber;
 
     // Lưu dữ liệu vào bảng lophoc
     LopHoc::create($validatedData);
 
     // Chuyển hướng về form với thông báo thành công
     return redirect()->route('lophoc')->with('success', 'Thêm lớp học thành công!');
 }
}