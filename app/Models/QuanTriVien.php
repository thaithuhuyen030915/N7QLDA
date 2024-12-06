<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuanTriVien extends Model
{
    use HasFactory;

    protected $table = 'QuanTriVien';
    public $timestamps = false; // Nếu không sử dụng các cột timestamps (created_at, updated_at)

    protected $fillable = [
        'MaQT', 'HoTenQT', 'Email', 'SDT', 'TenDN', 'MaVT'
    ];

    public function taiKhoan(): BelongsTo
    {
        return $this->belongsTo(TaiKhoan::class, 'TenDN', 'TenDN');  // Liên kết với bảng TaiKhoan qua TenDN
    }

    public function VaiTro(): BelongsTo
    {
        return $this->belongsTo(VaiTro::class, 'MaVT', 'MaVT');
    }
}
