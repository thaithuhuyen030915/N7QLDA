<?php

use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\QLTaiKhoan\TKAdminController;
use App\Http\Controllers\QLTaiKhoan\VaiTroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;

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



// Route hiển thị form thêm tài khoản
Route::get('admin/create', [TKAdminController::class, 'create'])->name('admin.create');

// Route xử lý form thêm tài khoản
Route::post('admin/store', [TKAdminController::class, 'store'])->name('admin.store');

Route::delete('admin/delete', [TKAdminController::class, 'delete'])->name('admin.delete');


Route::get('/', [homeController::class,'index'])->name('home');
