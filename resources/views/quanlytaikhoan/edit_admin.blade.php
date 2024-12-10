@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Chỉnh sửa tài khoản</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('list/admin') }}">Quản lý tài khoản</a></li>
                            <li class="breadcrumb-item active">Chỉnh sửa tài khoản</li>
                        </ul>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.update', $account->TenDN) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên đăng nhập</label>
                            <input type="text" class="form-control" value="{{ $account->TenDN }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input type="text" class="form-control" name="HoTenQT" value="{{ $account->quanTriVien->HoTenQT }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="Email" value="{{ $account->quanTriVien->Email }}" required>
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" name="SDT" value="{{ $account->quanTriVien->SDT }}" required>
                        </div>
                        <div class="form-group">
                            <label>Vai trò</label>
                            <select class="form-control" name="TenVaiTro" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->MaVT }}" {{ $role->MaVT == $account->quanTriVien->MaVT ? 'selected' : '' }}>
                                        {{ $role->TenVaiTro }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control" name="TrangThaiTK" required>
                                <option value="Hoạt động" {{ $account->TrangThaiTK == 'Hoạt động' ? 'selected' : '' }}>Hoạt động</option>
                                <option value="Không hoạt động" {{ $account->TrangThaiTK == 'Không hoạt động' ? 'selected' : '' }}>Không hoạt động</option>
                                <option value="Khóa" {{ $account->TrangThaiTK == 'Khóa' ? 'selected' : '' }}>Khóa</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('list/admin') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
