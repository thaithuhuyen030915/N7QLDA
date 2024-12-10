<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giasu extends Model
{
    use HasFactory;

    protected $table = 'giasu'; // Tên bảng
    protected $primaryKey = 'MaHoSoGS'; // Khóa chính
    public $incrementing = false; // Khóa chính không tự tăng
    public $timestamps = false; // Không sử dụng timestamps

    protected $fillable = [
        'MaHoSoGS',
        'LoaiNguoiDung',
        'TrinhDo',
        'KinhNghiem',
        'BangCap',
    ];

    // Quan hệ 1-1 với NguoiDung
    public function Nguoidung(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Nguoidung::class, 'MaHoSoGS', 'MaHoSoND');
    }
}
