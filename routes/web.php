<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QLTaiKhoan\TKAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiasuController;
  
use Illuminate\Http\Request;
use App\Models\Giasu;
use App\Models\PhuHuynh;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}
//Front (Client)
Route::get('/', function () {
//    return view('auth.login');
    return view('auth.login');

});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
});

// ----------------------------login ------------------------------//
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// -------------------------- main dashboard ----------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->middleware('auth')->name('home');
//    Route::get('user/profile/page', 'userProfile')->middleware('auth')->name('user/profile/page');
//    Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
//    Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');
});

// -------------------------- tài koản ----------------------//
//------- Admin -------//
Route::middleware('auth')->group(function () {
    Route::get('list/admin', [TKAdminController::class, 'index'])->name('list/admin');
});


//------- Gia sư -------//

// Route để hiển thị trang hồ sơ gia sư
Route::get('/hosogiasu', function () {
    return view('giasu.hosogiasu');
});

// Route để lưu thông tin gia sư
Route::post('/save-giasu', function (Request $request) {
    // Xác thực dữ liệu
    $request->validate([
        'HoTen' => 'required|string|max:255',
        'GioiTinh' => 'required|string',
        'SĐT' => 'required|string|max:15',
        'Email' => 'required|email|unique:giasu,Email',
        'DiaChi' => 'required|string|max:255',
        'DiaChiHienTai' => 'required|string|max:255',
        'MoTa' => 'required|string',
        'ThanhTich' => 'required|string',
        'Anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Tạo đối tượng giasu mới
    $giasu = new Giasu();
    $giasu->HoTen = $request->HoTen;
    $giasu->GioiTinh = $request->GioiTinh;
    $giasu->SĐT = $request->SĐT;
    $giasu->Email = $request->Email;
    $giasu->DiaChi = $request->DiaChi;
    $giasu->DiaChiHienTai = $request->DiaChiHienTai;
    $giasu->MoTa = $request->MoTa;
    $giasu->ThanhTich = $request->ThanhTich;

    // Xử lý upload ảnh
    if ($request->hasFile('Anh')) {
        $fileName = time() . '.' . $request->Anh->extension();
        $request->Anh->move(public_path('uploads'), $fileName);
        $giasu->Anh = $fileName;
    }

    $giasu->save();

    return redirect()->back()->with('success', 'Thông tin đã được lưu thành công!');
});

//------- Kết nối cơ sở dữ liệu -------//
use Illuminate\Support\Facades\DB;

Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return "Kết nối cơ sở dữ liệu thành công. Database: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "Không thể kết nối cơ sở dữ liệu: " . $e->getMessage();
    }
});

//------- Phụ huynh -------//
Route::get('/classroom', function () {
    return view('phuhuynh.classroom');
});
Route::get('/phuhuynh/chinhsuathongtin', function () {
    return view('phuhuynh.chinhsuathongtin');
});

//------- Chỉnh sửa thông tin Phụ huynh -------//

Route::post('/save-phuhuynh', function (Request $request) {
    // Xác thực dữ liệu
    $request->validate([
        'HoTen' => 'required|varchar|max:50',
        'SĐT' => 'required|int|max:10',
        'Email' => 'required|varchar|max:50',
        'DiaChi' => 'required|varchar|max:50',
        'Anh' => 'nullable|varchar|max:50',
        'MoTa' => 'nullable|varchar',
    ]);

    $phuhuynh = new PhuHuynh();
    $phuhuynh->HoTen = $request->HoTen;
    $phuhuynh->SĐT = $request->SĐT;
    $phuhuynh->Email = $request->Email;
    $phuhuynh->DiaChi = $request->DiaChi;
    $phuhuynh->MoTa = $request->MoTa;

    // Xử lý upload ảnh
    if ($request->hasFile('Anh')) {
        $fileName = time() . '.' . $request->Anh->extension();
        $request->Anh->move(public_path('uploads'), $fileName);
        $phuhuynh->Anh = $fileName;
    }

    $phuhuynh->save();

    return redirect()->back()->with('success', 'Thông tin đã được lưu thành công!');
});

Route::get('/chinhsuathongtin', function () {
    return view('chinhsuathongtin');
});