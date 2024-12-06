<?php

use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\QLTaiKhoan\TKAdminController;
use App\Http\Controllers\QLTaiKhoan\VaiTroController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\GiasuController;
  
use Illuminate\Http\Request;
use App\Models\Giasu;
use App\Models\PhuHuynh;
=======
use App\Http\Controllers\homeController;
>>>>>>> fedee5e49427ce6d90ad8ffc0990e3cf26cd4a30

function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}
//Front (Client)
Route::get('/admin', function () {
//    return view('auth.login');
    return view('auth.login');

});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('/homeadmin',function()
    {
        return view('dashboard.home');
    });
});

// ----------------------------Đăng nhập ------------------------------//
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ----------------------------Đăng ký ------------------------------//
use App\Http\Controllers\Auth\RegisterController;
    // Hiển thị form đăng ký
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // Xử lý đăng ký
Route::post('register', [RegisterController::class, 'register']);


// -------------------------- main dashboard ----------------------//
Route::controller(HomeAdminController::class)->group(function () {
    Route::get('/homeadmin', 'index')->middleware('auth')->name('homeadmin');
//    Route::get('user/profile/page', 'userProfile')->middleware('auth')->name('user/profile/page');
//    Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
//    Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');
});

// -------------------------- tài koản ----------------------//
//------- Admin -------//
Route::middleware('auth')->group(function () {
    Route::get('list/admin', [TKAdminController::class, 'index'])->name('list/admin');
});
Route::middleware('auth')->group(function () {
    // Hiển thị danh sách vai trò
    Route::get('list/roles', [VaiTroController::class, 'index'])->name('list.roles');

    // Xử lý thêm mới và cập nhật vai trò
    Route::post('roles/store', [VaiTroController::class, 'store'])->name('roles.store');
    Route::post('roles/update/{id}', [VaiTroController::class, 'update'])->name('roles.update');
    Route::delete('roles/destroy/{id}', [VaiTroController::class, 'destroy'])->name('roles.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('roles', VaiTroController::class);
});


//------- Gia sư -------//

<<<<<<< HEAD
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
=======
// Route hiển thị form thêm tài khoản
Route::get('admin/create', [TKAdminController::class, 'create'])->name('admin.create');

// Route xử lý form thêm tài khoản
Route::post('admin/store', [TKAdminController::class, 'store'])->name('admin.store');

Route::delete('admin/delete', [TKAdminController::class, 'delete'])->name('admin.delete');


Route::get('/', [homeController::class,'index'])->name('home');
>>>>>>> fedee5e49427ce6d90ad8ffc0990e3cf26cd4a30
