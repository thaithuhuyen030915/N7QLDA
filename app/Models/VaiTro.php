<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    use HasFactory;

    protected $table = 'VaiTro';
    protected $primaryKey = 'MaVT';
    public $incrementing = false; // Vì `MaVT` không tự tăng
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['MaVT', 'TenVaiTro', 'MoTa', 'Quyen'];

    public function QuanTriVien(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuanTriVien::class, 'MaVT', 'MaVT');
    }
    protected $casts = [
        'Quyen' => 'array',
    ];
}
