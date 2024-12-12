<?php

use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\QLNguoiDung\HSGiaSuController;
use App\Http\Controllers\QLTaiKhoan\TKAdminController;
use App\Http\Controllers\QLTaiKhoan\VaiTroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiasuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LopHoc\TaolophocController;
use App\Http\Controllers\LopHoc\LophocController;
//use Illuminate\Http\Request;
use App\Models\Giasu;
use App\Models\PhuHuynh;
use App\Http\Controllers\homeController;

use Illuminate\Support\Facades\Request;

function set_active($route) {
    $currentPath = request()->path(); // Lấy đường dẫn hiện tại từ request

    if (is_array($route)) {
        return in_array($currentPath, $route) ? 'active' : '';
    }

    return $currentPath == $route ? 'active' : '';
}


//Đăng nhập trang admin
Route::get('/admin', function () {
//    return view('auth.login');
    return view('auth.login');

});
//Vào màn hình chính trang admin
Route::group(['middleware'=>'auth'],function()
{
    Route::get('/homeadmin',function()
    {
        return view('dashboard.home');
    });
});


// ---------------------------- Xử lý login ------------------------------//

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // đăng nhập tài khoản gia sư
    Route::group(['middleware'=>'auth'],function()
    {
        Route::get('/hosogiasu/{MaHoSoGS}',function()
        {
            return view('giasu.hosogiasu');
        });
    });
    // đăng nhập tài khoản phụ huynh
    Route::group(['middleware'=>'auth'],function()
    {
        Route::get('/classroom/{MaHoSoPH}',function()
        {
            return view('phuhuynh.classroom');
        });
    });
    // Route::get('/classroom', function () {
    //     return view('phuhuynh.classroom');
    // });
    // Route::get('/phuhuynh/chinhsuathongtin', function () {
    //     return view('phuhuynh.chinhsuathongtin');
    // });
    


// ----------------------------Đăng ký tài khoản ------------------------------//
use App\Http\Controllers\Auth\RegisterController;
    // Hiển thị form đăng ký
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // Xử lý đăng ký
Route::post('/register', [RegisterController::class, 'register']);
        
    // đăng ký tài khoản gia sư
    Route::group(['middleware'=>'auth'],function()
    {
        Route::get('/hosogiasu/{MaHoSoGS}',function()
        {
            return view('giasu.hosogiasu');
        });
    });
    // đăng nhập tài khoản phụ huynh
    Route::group(['middleware'=>'auth'],function()
    {
        Route::get('/phuhuynh/{MaHoSoPH}',function()
        {
            return view('phuhuynh.chinhsuathongtin');
        });
    });



// -------------------------- Hiển thị trang chủ Admin ----------------------//
Route::controller(HomeAdminController::class)->group(function () {
    Route::get('/homeadmin', 'index')->middleware('auth')->name('homeadmin');
});

// -------------------------- Quản lý tài koản ----------------------//
//------- Admin -------//
Route::middleware('auth')->group(function () {
    Route::get('list/admin', [TKAdminController::class, 'index'])->name('list/admin');
});
//------- Vai trò -------//
Route::middleware('auth')->group(function () {
    Route::get('list/roles', [VaiTroController::class, 'index'])->name('list.roles'); // Hiển thị danh sách vai trò
    // Xử lý thêm, sửa, xóa vai trò
    Route::post('roles/store', [VaiTroController::class, 'store'])->name('roles.store');//thêm
    Route::post('roles/update/{id}', [VaiTroController::class, 'update'])->name('roles.update');//sửa
    Route::delete('roles/destroy/{id}', [VaiTroController::class, 'destroy'])->name('roles.destroy');//xóa
});
Route::middleware('auth')->group(function () {
    Route::resource('roles', VaiTroController::class);
});
// Route hiển thị form thêm tài khoản của trang admin
Route::get('admin/create', [TKAdminController::class, 'create'])->name('admin.create');
// Route xử lý form thêm tài khoản
Route::post('admin/store', [TKAdminController::class, 'store'])->name('admin.store');
// Route xử lý form xóa tài khoản
Route::delete('admin/delete', [TKAdminController::class, 'delete'])->name('admin.delete');

// -------------------------- Quản lý gia sư ----------------------//
Route::middleware('auth')->group(function () {
    Route::get('list/giasu', [HSGiaSuController::class, 'index'])->name('list.dsgiasu');
});

//----------------------------Tạo và hiển thị danh sách lớp học----------
Route::get('lophoc', [LophocController::class, 'index'])->name('lophoc');
//-------------------Đề nghị dạy----------------------
use App\Http\Controllers\DenghiController;
Route::get('/denghi/create/{MaLop}', [DenghiController::class, 'create'])->name('denghi.create');

//---------------------Tạo lớp học mới--------------------------
// use App\Http\Controllers\LopHoc\TaolophocController;
Route::get('/lophoc/create', [LophocController::class, 'create'])->name('lophoc.create');
Route::post('/lophoc/store', [LophocController::class, 'store'])->name('lophoc.store');
//-----------------------danh sách lớp đã tạo của hồ sơ phụ huynh
Route::get('/phuhuynh/{MaHoSoPH}/lophoc', [LopHocController::class, 'lopdatao'])->name('phuhuynh.lophoc');


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
    $giasu->SDT = $request->SDT;
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
    $phuhuynh->SDT = $request->SDT;
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
// Route hiển thị form thêm tài khoản
Route::get('admin/create', [TKAdminController::class, 'create'])->name('admin.create');

// Route xử lý form thêm tài khoản
Route::post('admin/store', [TKAdminController::class, 'store'])->name('admin.store');

Route::delete('admin/delete', [TKAdminController::class, 'delete'])->name('admin.delete');
//Sửa tài khoản admin
Route::get('admin/edit/{TenDN}', [TKAdminController::class, 'edit'])->name('admin.edit');
Route::post('admin/update/{TenDN}', [TKAdminController::class, 'update'])->name('admin.update');


Route::get('/', [homeController::class,'index'])->name('home');
