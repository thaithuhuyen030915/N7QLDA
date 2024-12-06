@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <h3 class="page-title">Thêm Tài Khoản Admin</h3>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.store') }}" method="POST" class="form-horizontal">
                @csrf

                <div class="form-group row">
                    <label for="TenDN" class="col-md-3 col-form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="text" name="TenDN" id="TenDN" class="form-control @error('TenDN') is-invalid @enderror" required>
                        @error('TenDN')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row position-relative">
                    <label for="MatKhau" class="col-md-3 col-form-label">Mật khẩu <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="password" name="MatKhau" id="MatKhau" class="form-control @error('MatKhau') is-invalid @enderror" required>
                        <span class="profile-views feather-eye toggle-password position-absolute" onclick="togglePasswordVisibility()" style="right: 30px; top: 50%; transform: translateY(-50%); cursor: pointer;"></span>
                        @error('MatKhau')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="HoTen" class="col-md-3 col-form-label">Họ và tên <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="text" id="HoTen" name="HoTen" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Email" class="col-md-3 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="email" id="Email" name="Email" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="SDT" class="col-md-3 col-form-label">Số điện thoại <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="text" id="SDT" name="SDT" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="VaiTro" class="col-md-3 col-form-label">Vai trò <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select id="VaiTro" name="VaiTro" class="form-control" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->MaVT }}">{{ $role->TenVaiTro }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="TrangThai" class="col-md-3 col-form-label">Trạng thái <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select id="TrangThai" name="TrangThai" class="form-control" required>
                            <option value="Hoạt động">Hoạt động</option>
                            <option value="Không hoạt động">Không hoạt động</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('MatKhau');
            const toggleButton = document.querySelector('.toggle-password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.replace('feather-eye', 'feather-eye-off');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.replace('feather-eye-off', 'feather-eye');
            }
        }
    </script>
@endsection
