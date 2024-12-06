<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giasu extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = [
        'AnhDaiDien',
        'GioiTinh',
        'MaHoSoGS',
        'DoiTuong',
        'NoiCongTac',
        'KinhNghiem',
        'BangCap',
        'Email',
    ];
=======
    protected $table = 'giasu';
    protected $fillable = [
        'MaHoSoGS', 'LoaiNguoiDung', 'TrinhDo', 'KinhNghiem', 'BangCap',
    ];
    public function nguoidung()
    {
        return $this->belongsTo(Nguoidung::class, 'MaHoSoGS', 'MaHoSoND');
    }
>>>>>>> fedee5e49427ce6d90ad8ffc0990e3cf26cd4a30
}
