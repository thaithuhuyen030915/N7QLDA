<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lophoc extends Model
{
    use HasFactory;

    // protected $table = 'lophoc';
    // protected $fillable = [
    //     'MaLop', 'MonHoc', 'Lop', 'SoBuoi', 'HocPhi', 'ThoiLuongBuoiHoc', 'DoiTuongDay', 'HinhThucHoc', 'YeuCauGiaSu', 'GioiTinhGiaSu', 'DacDiemHocSinh', 'ThoiGianDay', 'TinhTrangLop', 'MaHoSoPH',
    // ];
    protected $table = 'lophoc'; // Tên bảng trong CSDL
    protected $primaryKey = 'MaLop'; // Khóa chính
    protected $keyType = 'string'; // Định dạng khóa chính là chuỗi
    public $timestamps = false; // Vô hiệu hóa timestamps

    protected $fillable = [
        'MaLop', 'MonHoc', 'Lop', 'SoBuoi', 'HocPhi', 'ThoiLuongBuoiHoc',
        'DoiTuongDay', 'HinhThucHoc', 'YeuCauGiaSu', 'GioiTinhGiaSu',
        'DacDiemHocSinh', 'ThoiGianDay', 'TinhTrangLop', 'MaHoSoPH'
    ];
    public function denghi()
    {
        return $this->hasMany(Denghi::class, 'MaLop', 'MaLop');
    }
    public function phuHuynh()
    {
        return $this->belongsTo(PhuHuynh::class, 'MaHoSoPH', 'MaHoSoPH');
    }
}
