@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Danh sách Gia sư</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('homeadmin') }}">Quản lý gia sư</a></li>
                            <li class="breadcrumb-item active">Danh sách gia sư</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Hiển thị thông báo --}}
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Danh sách gia sư</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                    <tr>
                                        <th>Mã gia sư</th>
                                        <th>Họ tên</th>
                                        <th>Ngày sinh</th>
                                        <th>Giới tính</th>
                                        <th>Email</th>
                                        <th>SĐT</th>
                                        <th>Địa chỉ</th>
                                        <th>Trình độ</th>
                                        <th>Kinh nghiệm</th>
                                        <th>Bằng cấp</th>
                                        <th class="text-end">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($dsgiasu as $giasu)
                                        <tr>
                                            <td>{{ $giasu->MaHoSoND }}</td>
                                            <td>{{ $giasu->HoTen }}</td>
                                            <td>{{ $giasu->NgaySinh ? date('d-m-Y', strtotime($giasu->NgaySinh)) : 'N/A' }}</td>
                                            <td>{{ $giasu->GioiTinh }}</td>
                                            <td>{{ $giasu->Email }}</td>
                                            <td>{{ $giasu->SDT }}</td>
                                            <td>{{ $giasu->DiaChi }}</td>
                                            <td>{{ $giasu->giaSu->TrinhDo ?? 'N/A' }}</td>
                                            <td>{{ $giasu->giaSu->KinhNghiem ?? 'N/A' }}</td>
                                            <td>{{ $giasu->giaSu->BangCap ?? 'N/A' }}</td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    @if (Session::get('TenVaiTro') === 'Super Admin')
                                                        <a
                                                           class="btn btn-sm bg-warning-light
                                                        ">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm bg-danger-light user_delete" data-id="" data-bs-toggle="modal" data-bs-target="#deleteUser">
                                                            <i class="feather-trash-2 me-1"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center">Không có gia sư nào.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Phân trang --}}
                            <div class="mt-4">
                                {{ $dsgiasu->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
