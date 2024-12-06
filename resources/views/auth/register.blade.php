@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Đăng Ký</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="TenDN">Tên Đăng Nhập</label>
                <input type="text" name="TenDN" id="TenDN" class="form-control" required>
                @error('TenDN')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="MatKhau">Mật Khẩu</label>
                <input type="password" name="MatKhau" id="MatKhau" class="form-control" required>
                @error('MatKhau')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="MatKhau_confirmation">Xác Nhận Mật Khẩu</label>
                <input type="password" name="MatKhau_confirmation" id="MatKhau_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Đăng Ký</button>
        </form>
    </div>
@endsection
