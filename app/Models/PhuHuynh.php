namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuHuynh extends Model
{
    use HasFactory;

    protected $table = 'phuhuynh'; // Tên bảng
    protected $primaryKey = 'MaHoSoPH'; // Đặt khóa chính

    protected $fillable = [
        'HoTen',
        'SĐT',
        'Email',
        'DiaChi',
        'Anh',
        'MoTa',
    ];

    public $timestamps = true; // Nếu bạn muốn sử dụng created_at và updated_at
}