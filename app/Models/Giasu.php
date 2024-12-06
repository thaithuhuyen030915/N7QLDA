<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giasu extends Model
{
    use HasFactory;
    protected $table = 'giasu';
    protected $fillable = [
        'MaHoSoGS', 'LoaiNguoiDung', 'TrinhDo', 'KinhNghiem', 'BangCap',
    ];
    public function nguoidung()
    {
        return $this->belongsTo(Nguoidung::class, 'MaHoSoGS', 'MaHoSoND');
    }
}
