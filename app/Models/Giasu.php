<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaSu extends Model
{
    use HasFactory;

    protected $table = 'giasu'; // Tên bảng
    protected $primaryKey = ['MaHoSoGS', 'LoaiNguoiDung']; // Khóa chính phức hợp
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MaHoSoGS',
        'LoaiNguoiDung',
        'TrinhDo',
        'KinhNghiem',
        'BangCap'
    ];

    // Liên kết với bảng NguoiDung
    public function nguoidung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaHoSoGS', 'MaHoSoND');
    }
}
?>





