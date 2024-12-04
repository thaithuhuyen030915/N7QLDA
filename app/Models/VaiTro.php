<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    use HasFactory;

    protected $table = 'VaiTro';

    protected $fillable = ['MaVT', 'TenVaiTro', 'MoTa', 'Quyen'];
}
