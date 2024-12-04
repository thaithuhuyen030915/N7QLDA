
@extends('layouts.app')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="login-right">
        <div class="login-right-wrap">
            <h1>Chào mừng!</h1>
            <h2>Đăng nhập vào hệ thống</h2>
            <form
                action="{{ route('login') }}"
                method="POST">
                @csrf
                <div class="form-group">
                    <label>Tên đăng nhập <span class="login-danger">*</span></label>
                    <input type="text" name="TenDN" class="form-control @error('TenDN') is-invalid @enderror" required>
                    @error('TenDN')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Mật khẩu <span class="login-danger">*</span></label>
                    <input type="password" name="MatKhau" class="form-control pass-input @error('MatKhau') is-invalid @enderror" required>
                    <span class="profile-views feather-eye toggle-password"></span>
                    @error('MatKhau')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Đăng nhập</button>
                </div>
            </form>
        </div>
    </div>

@endsection
