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
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
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
                                                   data-desc="{{ $role->MoTa }}">
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
                        <div class="mb-3">
                            <label for="TenVaiTro" class="form-label">Tên Vai trò</label>
                            <input type="text" name="TenVaiTro" id="TenVaiTro" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="MoTa" class="form-label">Mô tả</label>
                            <textarea name="MoTa" id="MoTa" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Sửa Vai trò --}}
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa Vai trò</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST" id="editRoleForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editTenVaiTro" class="form-label">Tên Vai trò</label>
                            <input type="text" name="TenVaiTro" id="editTenVaiTro" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editMoTa" class="form-label">Mô tả</label>
                            <textarea name="MoTa" id="editMoTa" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Cập nhật</button>
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
            // Xử lý mở modal sửa
            $('#editRoleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var desc = button.data('desc');

                $('#editRoleForm').attr('action', '/roles/update/' + id);
                $('#editTenVaiTro').val(name);
                $('#editMoTa').val(desc);
            });

            // Xử lý mở modal xóa
            $('#deleteRoleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Lấy nút kích hoạt modal
                var id = button.data('id'); // Lấy id vai trò cần xóa

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
