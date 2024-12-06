@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Danh sách Vai trò</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('list/admin') }}">Danh sách tài khoản</a></li>
                            <li class="breadcrumb-item active">Vai trò</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <!-- Nút thêm mới vai trò -->
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                            <i class="fas fa-plus"></i> Thêm Vai trò
                        </a>
                    </div>
                </div>
            </div>

            {{-- Thông báo --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Danh sách vai trò --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Vai trò</th>
                                        <th>Mô tả</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->MaVT }}</td>
                                            <td>{{ $role->TenVaiTro }}</td>
                                            <td>{{ $role->MoTa }}</td>
                                            <td>
                                                <!-- Nút sửa -->
                                                <a href="#" class="btn btn-sm btn-warning"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#editRoleModal"
                                                   data-id="{{ $role->MaVT }}"
                                                   data-name="{{ $role->TenVaiTro }}"
                                                   data-desc="{{ $role->MoTa }}"
                                                   data-permissions='@json($role->Quyen)'>
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>


                                                <!-- Nút xóa -->
                                                <button class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteRoleModal"
                                                        data-id="{{ $role->MaVT }}">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
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

    {{-- Modal Thêm Vai trò --}}
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Vai trò</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Tên vai trò -->
                        <div class="mb-3">
                            <label for="TenVaiTro" class="form-label">Tên Vai trò</label>
                            <input type="text" name="TenVaiTro" id="TenVaiTro" class="form-control" required>
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="MoTa" class="form-label">Mô tả</label>
                            <textarea name="MoTa" id="MoTa" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Quản lý quyền -->
                        <h3>Quản lý quyền:</h3>
                        <div>
                            <h4>Quản lý Gia Sư:</h4>
                            <label><input type="checkbox" name="Quyen[quan_ly_gia_su][xem]"> Xem</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_gia_su][them]"> Thêm</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_gia_su][sua]"> Sửa</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_gia_su][xoa]"> Xóa</label>
                        </div>

                        <div>
                            <h4>Quản lý Phụ Huynh:</h4>
                            <label><input type="checkbox" name="Quyen[quan_ly_phu_huynh][xem]"> Xem</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_phu_huynh][them]"> Thêm</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_phu_huynh][sua]"> Sửa</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_phu_huynh][xoa]"> Xóa</label>
                        </div>

                        <div>
                            <h4>Quản lý Lớp Học:</h4>
                            <label><input type="checkbox" name="Quyen[quan_ly_lop_hoc][xem]"> Xem</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_lop_hoc][them]"> Thêm</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_lop_hoc][sua]"> Sửa</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_lop_hoc][xoa]"> Xóa</label>
                        </div>

                        <div>
                            <h4>Quản lý Tài Khoản:</h4>
                            <label><input type="checkbox" name="Quyen[quan_ly_tai_khoan][xem]"> Xem</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_tai_khoan][them]"> Thêm</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_tai_khoan][sua]"> Sửa</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_tai_khoan][xoa]"> Xóa</label>
                        </div>

                        <div>
                            <h4>Quản lý Thanh Toán:</h4>
                            <label><input type="checkbox" name="Quyen[quan_ly_thanh_toan][xem]"> Xem</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_thanh_toan][sua]"> Sửa</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_thanh_toan][xoa]"> Xóa</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu Vai Trò</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal sửa vai trò -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa Vai trò</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editRoleForm" action="" method="POST">
                    @csrf
                    @method('PUT') <!-- Đảm bảo sử dụng PUT -->
                    <div class="modal-body">
                        <!-- Tên vai trò -->
                        <div class="mb-3">
                            <label for="editTenVaiTro" class="form-label">Tên Vai trò</label>
                            <input type="text" name="TenVaiTro" id="editTenVaiTro" class="form-control" required>
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label for="editMoTa" class="form-label">Mô tả</label>
                            <textarea name="MoTa" id="editMoTa" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Quản lý quyền -->
                        <div>
                            <h4>Quản lý Gia Sư:</h4>
                            <label><input type="checkbox" name="Quyen[quan_ly_gia_su][xem]" id="editQuyenXemGiaSu"> Xem</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_gia_su][them]" id="editQuyenThemGiaSu"> Thêm</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_gia_su][sua]" id="editQuyenSuaGiaSu"> Sửa</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_gia_su][xoa]" id="editQuyenXoaGiaSu"> Xóa</label>
                        </div>

                        <div>
                            <h4>Quản lý Phụ Huynh:</h4>
                            <label><input type="checkbox" name="Quyen[quan_ly_phu_huynh][xem]" id="editQuyenXemPhuHuynh"> Xem</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_phu_huynh][them]" id="editQuyenThemPhuHuynh"> Thêm</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_phu_huynh][sua]" id="editQuyenSuaPhuHuynh"> Sửa</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_phu_huynh][xoa]" id="editQuyenXoaPhuHuynh"> Xóa</label>
                        </div>

                        <div>
                            <h4>Quản lý Lớp Học:</h4>
                            <label><input type="checkbox" name="Quyen[quan_ly_lop_hoc][xem]" id="editQuyenXemLopHoc"> Xem</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_lop_hoc][them]" id="editQuyenThemLopHoc"> Thêm</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_lop_hoc][sua]" id="editQuyenSuaLopHoc"> Sửa</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_lop_hoc][xoa]" id="editQuyenXoaLopHoc"> Xóa</label>
                        </div>

                        <div>
                            <h4>Quản lý Tài Khoản:</h4>
                            <label><input type="checkbox" name="Quyen[quan_ly_tai_khoan][xem]" id="editQuyenXemTaiKhoan"> Xem</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_tai_khoan][them]" id="editQuyenThemTaiKhoan"> Thêm</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_tai_khoan][sua]" id="editQuyenSuaTaiKhoan"> Sửa</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_tai_khoan][xoa]" id="editQuyenXoaTaiKhoan"> Xóa</label>
                        </div>

                        <div>
                            <h4>Quản lý Thanh Toán:</h4>
                            <label><input type="checkbox" name="Quyen[quan_ly_thanh_toan][xem]" id="editQuyenXemThanhToan"> Xem</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_thanh_toan][sua]" id="editQuyenSuaThanhToan"> Sửa</label>
                            <label><input type="checkbox" name="Quyen[quan_ly_thanh_toan][xoa]" id="editQuyenXoaThanhToan"> Xóa</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Modal Xóa Vai trò --}}
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa Vai trò</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST" id="deleteRoleForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="deleteRoleId">
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa vai trò này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            $('#editRoleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Lấy nút kích hoạt modal
                var id = button.data('id'); // Lấy ID vai trò
                var name = button.data('name'); // Lấy tên vai trò
                var desc = button.data('desc'); // Lấy mô tả vai trò
                // var permissions = button.data('permissions'); // Lấy quyền vai trò
                var permissions = JSON.parse(button.data('permissions')); // Parse JSON nếu cần
                console.log(permissions); // Kiểm tra giá trị trong console để xem nó có đúng không

                if (id === 'VT01') {
                    $('#editRoleModal .btn-primary').prop('disabled', true); // Vô hiệu hóa nút sửa
                } else {
                    $('#editRoleModal .btn-primary').prop('disabled', false); // Bật lại nút sửa
                }

                // Điền thông tin vào các trường của form
                $('#editTenVaiTro').val(name);
                $('#editMoTa').val(desc);

                // Cập nhật action URL của form
                var actionUrl = '{{ route("roles.update", ":id") }}';
                actionUrl = actionUrl.replace(':id', id);
                $('#editRoleForm').attr('action', actionUrl);
            });



            // Xử lý mở modal xóa
            $('#deleteRoleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Lấy nút kích hoạt modal
                var id = button.data('id'); // Lấy id vai trò cần xóa

                if (id === 'VT01') {
                    $('#deleteRoleModal .btn-danger').prop('disabled', true); // Vô hiệu hóa nút xóa
                } else {
                    $('#deleteRoleModal .btn-danger').prop('disabled', false); // Bật lại nút xóa
                }

                // Cập nhật action URL của form
                var actionUrl = '{{ route("roles.destroy", ":id") }}';
                actionUrl = actionUrl.replace(':id', id);
                $('#deleteRoleForm').attr('action', actionUrl);

                // Gán id vào hidden input
                $('#deleteRoleId').val(id);
            });
        </script>
    @endsection
@endsection
