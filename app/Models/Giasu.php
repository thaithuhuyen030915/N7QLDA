<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giasu extends Model
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
        'BangCap',
        'QueQuan',
        'Tinh_Thanh',
        'Quan_Huyen',
        'ThanhTich',
        'ChucVu',
        'NoiHocTap',
        'HinhThucDay',
        'MonHoc',
        'ThoiGian',
        'HocPhi',
        'CCCD',
        'MinhChung',
        'ChuyenNganh',
    ];

    // Liên kết với bảng NguoiDung
//    public function nguoidung()
//        'BangCap',
//    ];

    // Quan hệ 1-1 với NguoiDung
    public function Nguoidung(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'MaHoSoGS', 'MaHoSoND');
    }
}
?>





