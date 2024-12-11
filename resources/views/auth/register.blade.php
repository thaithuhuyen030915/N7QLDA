@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Đăng Ký</h2>
        <form method="POST" action="{{ route('register') }}" class="mx-auto" style="max-width: 500px;">
            @csrf

            <!-- Chọn loại tài khoản -->
                <style>
                .radio-label {margin-right: 20px;}
                </style>
            <div class="form-group mb-3">
                <label class="form-label">Vui lòng chọn loại tài khoản:</label>
                <div>
                    <input type="radio" name="LoaiTK" id="gia_su" value="Gia sư" class="me-3" {{ old('LoaiTK', 'Gia sư') == 'Gia sư' ? 'checked' : '' }}>
                    <label for="gia_su" class="me-3">Gia sư</label>

                    <input type="radio" name="LoaiTK" id="phu_huynh" value="Học viên" class="me-3" {{ old('LoaiTK') == 'Phụ huynh' ? 'checked' : '' }}>
                    <label for="phu_huynh"> Phụ huynh</label>
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

              <!-- Số ĐT -->
              <div class="form-group mb-3">
                <label for="TenDN">Số điện thoại <span class="text-danger">*</span></label>
                <input type="string" name="SDT" id="TenDN" class="form-control" placeholder="Nhập SĐT" value="{{ old('SDT') }}" required>
                @error('SDT')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <!-- Email -->
            <div class="form-group mb-3">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email của bạn" value="{{ old('email') }}" required>
                @error('email')
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
        </form>
    </div>

    <!-- Script toggle mật khẩu -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(function (icon) {
            icon.addEventListener('click', function () {
                const target = document.getElementById(this.getAttribute('data-target'));
                if (target.type === 'password') {
                    target.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    target.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    </script>
@endsection
