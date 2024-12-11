<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Xacthuc extends Model
{
    use HasFactory;

    protected $table = 'xacthuc'; // Tên bảng

    protected $primaryKey = ['MaHoSoND', 'MaQT']; // Cặp khóa chính
    public $incrementing = false; // Vì khóa chính có kiểu varchar, không phải là auto increment

    /**
     * Các trường cần bảo quản
     */
    protected $fillable = [
        'MaHoSoND',
        'MaQT',
        'TrangThaiXacThuc',
        'NgayXacThuc',
    ];

    /**
     * Mối quan hệ với QuanTriVien (thành viên quản trị)
     */
    public function quanTriVien(): BelongsTo
    {
        return $this->belongsTo(QuanTriVien::class, 'MaQT', 'MaQT');
    }

    /**
     * Mối quan hệ với HoSoND (hồ sơ nhận dạng)
     */
    public function hoSoND(): BelongsTo
    {
        return $this->belongsTo(Nguoidung::class, 'MaHoSoND', 'MaHoSoND');
    }
}
