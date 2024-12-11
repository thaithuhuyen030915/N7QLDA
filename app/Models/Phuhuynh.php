<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuHuynh extends Model
{
    use HasFactory;

    protected $table = 'phuhuynh'; // Tên bảng
    protected $primaryKey = ['MaHoSoPH', 'LoaiNguoiDung']; // Khóa chính phức hợp
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['MaHoSoPH', 'LoaiNguoiDung','CCCD'];

    // Mqh với bảng NguoiDung
    public function Nguoidung()
    {
        return $this->belongsTo(Nguoidung::class, 'MaHoSoPH', 'MaHoSoND');
    }
}
?>
