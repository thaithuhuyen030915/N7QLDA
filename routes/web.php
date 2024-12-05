<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QLTaiKhoan\TKAdminController;
use App\Http\Controllers\QLTaiKhoan\VaiTroController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [homeController::class,'index'])->name('home');