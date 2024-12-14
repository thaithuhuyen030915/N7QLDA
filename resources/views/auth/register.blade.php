@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Đăng Ký</h2>
        <form method="POST" action="{{ route('register') }}" class="mx-auto" style="max-width: 500px;">
            @csrf

            <!-- Chọn loại tài khoản -->
            <style>
                .radio-label { margin-right: 20px; }
            </style>
            <div class="form-group mb-3">
                <label class="form-label">Vui lòng chọn loại tài khoản:</label>
                <div>
                    <input type="radio" name="LoaiTK" id="gia_su" value="Gia sư" class="me-3" {{ old('LoaiTK', 'Gia sư') == 'Gia sư' ? 'checked' : '' }}>
                    <label for="gia_su" class="me-3">Gia sư</label>

                    <input type="radio" name="LoaiTK" id="phu_huynh" value="Phụ huynh" class="me-3" {{ old('LoaiTK') == 'Phụ huynh' ? 'checked' : '' }}>
                    <label for="phu_huynh">Phụ huynh</label>
                </div>
            </div>

            <!-- Tên đăng nhập -->
            <div class="form-group mb-3">
                <label for="TenDN">Tên Đăng Nhập <span class="text-danger">*</span></label>
                <input type="text" name="TenDN" id="TenDN" class="form-control" placeholder="Nhập tên đăng nhập" value="{{ old('TenDN') }}" required>
                @error('TenDN')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Mật khẩu -->
            <div class="form-group mb-3">
                <label for="MatKhau">Mật Khẩu <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" name="MatKhau" id="MatKhau" class="form-control" placeholder="Nhập mật khẩu" required>
                    <span class="input-group-text">
                        <i class="fas fa-eye toggle-password" style="cursor: pointer;" data-target="MatKhau"></i>
                    </span>
                </div>
                @error('MatKhau')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Xác nhận mật khẩu -->
            <div class="form-group mb-3">
                <label for="MatKhau_confirmation">Xác Nhận Mật Khẩu <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" name="MatKhau_confirmation" id="MatKhau_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
                    <span class="input-group-text">
                        <i class="fas fa-eye toggle-password" style="cursor: pointer;" data-target="MatKhau_confirmation"></i>
                    </span>
                </div>
            </div>

            <!-- Button Đăng Ký -->
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary w-50">Đăng Ký</button>
            </div>

            <!-- Nút điều hướng đến trang đăng nhập -->
            <div class="form-group text-center mt-3">
                <p>Bạn đã có tài khoản?
                    <a href="{{ route('login') }}" class="text-primary">Đăng nhập</a>
                </p>
            </div>

        </form>
    </div>

    <!-- Script toggle mật khẩu -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(function (icon) {
            icon.addEventListener('click', function () {
                const target = document.getElementById(this.getAttribute('data-target'));
                if (target.type === 'password') {
                    target.type = 'text';
                    this.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Thêm gạch chéo vào icon
                } else {
                    target.type = 'password';
                    this.innerHTML = '<i class="fas fa-eye"></i>'; // Quay lại icon mắt thường
                }
            });
        });
    </script>

@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
