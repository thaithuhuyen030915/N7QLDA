<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giasu extends Model
{
    use HasFactory;
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
}
