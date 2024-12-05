@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tài khoản Gia sư</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Quản lý tài khoản</a></li>
                            <li class="breadcrumb-item active">Tài khoản Gia sư</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Danh sách tài khoản</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('list/admin') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Thêm tài khoản
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                    <tr>
                                        <th>Tên đăng nhập</th>
                                        <th>Mật khẩu</th>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>SĐT</th>
                                        <th>Ngày tạo</th>
                                        <th>Vai trò</th>
                                        <th>Trạng thái</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($adminAccounts as $account)
                                        <tr>
                                            <td>{{ $account->TenDN }}</td>
                                            <td>{{ $account->MatKhau }}</td>
                                            <td>{{ $account->quanTriVien->HoTenQT ?? 'N/A' }}</td>
                                            <td>{{ $account->quanTriVien->Email ?? 'N/A' }}</td>
                                            <td>{{ $account->quanTriVien->SDT ?? 'N/A' }}</td>
                                            <td>{{ $account->NgayTao }}</td>
                                            <td>{{ $account->quanTriVien->vaiTro->TenVaiTro ?? 'N/A' }}</td>
                                            <td>
                                                @if ($account->TrangThaiTK === 'Active')
                                                    <span class="badge bg-success">{{ $account->TrangThaiTK }}</span>
                                                @elseif ($account->TrangThaiTK === 'Inactive')
                                                    <span class="badge bg-warning">{{ $account->TrangThaiTK }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ $account->TrangThaiTK }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ url('view/user/edit/'.$account->TenDN) }}" class="btn btn-sm bg-danger-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    @if (Session::get('role_name') === 'Super Admin')
                                                        <button class="btn btn-sm bg-danger-light user_delete" data-bs-toggle="modal" data-bs-target="#deleteUser">
                                                            <i class="feather-trash-2 me-1"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal xóa tài khoản --}}
    <div class="modal fade contentmodal" id="deleteUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pb-0 border-bottom-0 justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="#
{{--                    {{ route('user/delete') }}--}}
                    " method="POST">
                        @csrf
                        <div class="delete-wrap text-center">
                            <div class="del-icon">
                                <i class="feather-x-circle"></i>
                            </div>
                            <h2>Bạn có chắc chắn muốn xóa tài khoản này?</h2>
                            <input type="hidden" name="TenDN" class="e_user_id" value="">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success me-2">Có</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Không</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            // Xử lý khi nhấn nút xóa
            $(document).on('click', '.user_delete', function() {
                var userId = $(this).closest('tr').find('td:first').text();
                $('.e_user_id').val(userId);
            });
        </script>
    @endsection
@endsection
