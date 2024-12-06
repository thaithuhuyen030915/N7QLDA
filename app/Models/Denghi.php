<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denghi extends Model
{
    use HasFactory;
    protected $table = 'denghi';
    protected $fillable = [
        'MaDeNghi', 'TrangThaiDeNghi', 'NgayGui', 'MaHoSoPH', 'MaHoSoGS', 'MaLop',
    ];
}
