<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaSu extends Model
{
    use HasFactory;

    protected $table = 'giasu'; // Tên bảng
<<<<<<< HEAD
    protected $primaryKey = ['MaHoSoGS', 'LoaiNguoiDung']; // Khóa chính phức hợp
    public $incrementing = false;
    public $timestamps = false;
=======
    protected $primaryKey = 'MaHoSoGS'; // Khóa chính
    public $incrementing = false; // Khóa chính không tự tăng
    public $timestamps = false; // Không sử dụng timestamps
>>>>>>> 68c924fbd2eb5be80683ad5df4869951ff460f15

    protected $fillable = [
        'MaHoSoGS',
        'LoaiNguoiDung',
        'TrinhDo',
        'KinhNghiem',
<<<<<<< HEAD
        'BangCap'
    ];

    // Liên kết với bảng NguoiDung
    public function nguoidung()
=======
        'BangCap',
    ];

    // Quan hệ 1-1 với NguoiDung
    public function Nguoidung(): \Illuminate\Database\Eloquent\Relations\BelongsTo
>>>>>>> 68c924fbd2eb5be80683ad5df4869951ff460f15
    {
        return $this->belongsTo(NguoiDung::class, 'MaHoSoGS', 'MaHoSoND');
    }
}
?>





