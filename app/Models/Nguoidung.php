<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nguoidung extends Model
{
    use HasFactory;

    protected $table = 'nguoidung'; // Tên bảng trong cơ sở dữ liệu
//    protected $primaryKey = 'MaHoSoND'; //khiến trang chủ không chạy đuợc

    protected $fillable = [
        'MaHoSoND','HoTen','NgaySinh','GioiTinh','SDT','Email','DiaChi','Anh','NgayTao','LoaiNguoiDung','TenDN',
    ];

    // Mối quan hệ với model GiaSu
    public function giasu()
    {
        return $this->hasOne(Giasu::class, 'MaHoSoGS', 'MaHoSoND');
    }
}
