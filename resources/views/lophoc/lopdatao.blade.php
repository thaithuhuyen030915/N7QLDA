
@extends('layout')
@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center">Danh sách lớp học đã tạo của bạn</h2>

    <!-- Hiển thị danh sách lớp học -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead style="background-color: #007bff; color: white;">
                <tr>
                    <th>#</th>
                    <th>Môn học</th>
                    <th>Lớp</th>
                    <th>Số buổi</th>
                    <th>Số lượng học sinh</th>
                    <th>Học phí</th>
                    <th>Thời lượng buổi học</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lophocs as $lophoc) <!-- Duyệt qua danh sách lớp học -->
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lophoc->MonHoc }}</td>
                    <td>{{ $lophoc->Lop }}</td>
                    <td>{{ $lophoc->SoBuoi }}</td>
                    <td>{{ $lophoc->SLHocSinh }}</td>
                    <td>{{ number_format($lophoc->HocPhi, 0, ',', '.') }} VNĐ</td>
                    <td>{{ $lophoc->ThoiLuongBuoiHoc }} Giờ </td>
                    <td>
                        @if($lophoc->TinhTrangLop == 'Chờ duyệt')
                            <span class="badge badge-warning">Chờ duyệt</span>
                        @elseif($lophoc->TinhTrangLop == 'Đã duyệt')
                            <span class="badge badge-success">Đã duyệt</span>
                        @else
                            <span class="badge badge-danger">Đã hủy</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Không có lớp học nào được tìm thấy.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center">
        {{ $lophocs->links() }} <!-- Hiển thị phân trang -->
    </div>
</div>
@endsection