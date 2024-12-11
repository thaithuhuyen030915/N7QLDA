<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nguoidung extends Model
{
    use HasFactory;

    protected $table = 'nguoidung'; // Tên bảng trong cơ sở dữ liệu
    public $timestamps = false; // Vô hiệu hóa timestamps
    protected $fillable = [
        'MaHoSoND','HoTen','NgaySinh','GioiTinh','SDT','Email','DiaChi','Anh','NgayTao','LoaiNguoiDung','TenDN',
    ];
    
    // Liên kết với bảng TaiKhoan (FK: TenDN)
    public function taikhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'TenDN', 'TenDN');
    }

    // Mối quan hệ với model GiaSu
    public function giasu()
    {
        return $this->hasOne(Giasu::class, 'MaHoSoGS', 'MaHoSoND');
    }

     // Quan hệ với bảng PhuHuynh
    public function phuhuynh()
    {
        return $this->hasOne(PhuHuynh::class, 'MaHoSoPH', 'MaHoSoND');
    }
}
?>