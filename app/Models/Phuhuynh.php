<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuHuynh extends Model
{
    use HasFactory;

    protected $table = 'phuhuynh'; // Tên bảng
    protected $primaryKey = 'MaHoSoPH'; // Đặt khóa chính
    public $timestamps = false; // Nếu bạn ko muốn sử dụng created_at và updated_at

    protected $fillable = [
        'MaHoSoPH',
        'LoaiNguoiDung',
        'CCCD',
        // 'HoTen',
        // 'SDT',
        // 'Email',
        // 'DiaChi',
        // 'Anh',
        // 'Mota',
    ];

    public function Nguoidung(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'MaHoSoPH', 'MaHoSoND');
    }
}
