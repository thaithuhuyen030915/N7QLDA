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
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="#" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Thêm gia sư
                                        </a>
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
                                        <th>Ảnh</th>
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
                                            <td>
                                                @if($giasu->Anh)
                                                    <img src="{{ asset('storage/' . $giasu->Anh) }}" alt="Ảnh gia sư" width="50">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $giasu->giaSu->TrinhDo ?? 'N/A' }}</td>
                                            <td>{{ $giasu->giaSu->KinhNghiem ?? 'N/A' }}</td>
                                            <td>{{ $giasu->giaSu->BangCap ?? 'N/A' }}</td>
                                            <td class="text-end">
{{--                                                <a href="{{ route('edit.giasu', $giasu->MaHoSoND) }}" class="btn btn-warning btn-sm">--}}
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <form action="
{{--                                                {{ route('delete.giasu', $giasu->MaHoSoND) }}" method="POST" style="display: inline-block;--}}
                                                ">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa gia sư này?')">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </button>
                                                </form>
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
