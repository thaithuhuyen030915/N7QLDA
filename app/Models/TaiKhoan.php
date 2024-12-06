<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class TaiKhoan extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'TaiKhoan'; // Tên bảng
    protected $primaryKey = 'TenDN'; // Khóa chính
    public $incrementing = false; // Nếu khóa chính không phải auto-increment
    public $timestamps = false; // Nếu không sử dụng các cột timestamps (created_at, updated_at)

    protected $fillable = [
        'TenDN',
        'MatKhau',
        'LoaiTK',
        'NgayTao',
        'TrangThaiTK',
    ];

    protected $hidden = [
        'MatKhau', // Ẩn mật khẩu trong JSON output
    ];

    // Tên cột mật khẩu để Laravel sử dụng khi xác thực
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }
    public function quanTriVien()
    {
        return $this->hasOne(QuanTriVien::class, 'TenDN', 'TenDN');
    }
}
