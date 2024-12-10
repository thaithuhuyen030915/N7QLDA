<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nguoidung extends Model
{
    use HasFactory;

    protected $table = 'nguoidung'; // Tên bảng
    protected $primaryKey = 'MaHoSoND'; // Khóa chính
    public $incrementing = false; // Khóa chính không tự tăng
    public $timestamps = false; // Không sử dụng timestamps

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

    // Quan hệ 1-1 với GiaSu
    public function giaSu()
    {
        return $this->hasOne(Giasu::class, 'MaHoSoGS', 'MaHoSoND');
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
