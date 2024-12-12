<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nguoidung extends Model
{
    use HasFactory;

    protected $table = 'nguoidung'; // Tên bảng trong cơ sở dữ liệu
    public $timestamps = false; // Vô hiệu hóa timestamps
    protected $primaryKey = 'MaHoSoND'; // Khóa chính
    public $incrementing = false; // Khóa chính không tự tăng

    protected $fillable = [
        'MaHoSoND',
        'HoTen',
        'NgaySinh',
        'GioiTinh',
        'SDT',
        'Email',
        'DiaChi',
        'Anh',
        'NgayTao',
        'LoaiNguoiDung',
        'TenDN',
    ];

    // Liên kết với bảng TaiKhoan (FK: TenDN)
    public function taikhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'TenDN', 'TenDN');
    }

    // Quan hệ 1-1 với GiaSu
    public function giaSu()
    {
        return $this->hasOne(Giasu::class, 'MaHoSoGS', 'MaHoSoND');
    }

     // Quan hệ với bảng PhuHuynh
    public function phuhuynh()
    {
        return $this->hasOne(PhuHuynh::class, 'MaHoSoPH', 'MaHoSoND');
    }
    // Event observer cho model
    protected static function boot()
    {
        parent::boot();

        // Lắng nghe sự kiện "created"
        static::created(function ($nguoidung) {
            if ($nguoidung->LoaiNguoiDung === 'Gia sư') {
                Giasu::create([
                    'MaHoSoGS' => $nguoidung->MaHoSoND,
                    'LoaiNguoiDung' => $nguoidung->LoaiNguoiDung,
                    'TrinhDo' => null, // hoặc giá trị mặc định
                    'KinhNghiem' => null, // hoặc giá trị mặc định
                    'BangCap' => null, // hoặc giá trị mặc định
                ]);
            }
        });
    }
}
?>