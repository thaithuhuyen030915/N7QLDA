
@extends('layouts.lophoc')

@section('title', 'Lớp Đang Tìm Gia Sư')

@section('content')
<div class="container">
    <!--<h2 class="text-center mb-4">Lớp Đang Tìm Gia Sư</h2>-->
    <h2 class="form-header" style="text-align: center; font-weight: bold; font-size: 30px; color: #007bff;">Lớp Đang Tìm Gia Sư</h2>

    <!-- Danh sách lớp học -->
    <div class="class-list">
        @foreach ($lophocs as $lophoc)
            <div class="class-item">
                <div class="class-img">
                    <img src="{{ asset('images/images.png') }}" alt="Trung tâm gia sư" style="width: 60px; height: 60px; border-radius: 50%; text-align: center;">
                    <h5 style="text-align: center;">Gia sư đăng minh</h5>
                </div>
                <div class="class-info">
                    <h4>{{ $lophoc->MonHoc }} Lớp {{ $lophoc->Lop }} - {{ $lophoc->SoBuoi }} buổi/tuần</h4>
                    <p>- Thời lượng buổi học: {{ $lophoc->ThoiLuongBuoiHoc }}</p>
                    <p>- Hình thức học: {{ $lophoc->HinhThucHoc }}</p>
                    <p>- Yêu cầu: {{ $lophoc->YeuCauGiaSu }}</p>
                    <p>- Sĩ số: {{ $lophoc->TinhTrangLop }}</p>
                </div>
                <div class="class-fee">
                    <p><strong>{{ number_format($lophoc->HocPhi, 0, ',', '.') }} VNĐ</strong></p>
                </div>
                <div class="class-action">
                    <a href="{{ route('denghi.create', ['MaLop' => $lophoc->MaLop]) }}" class="btn">Đề nghị dạy</a>
                </div>
            </div>
        @endforeach
    </div>
       <!-- Phân trang -->
       <div class="pagination">
        {{ $lophocs->links() }}
    </div>
</div>
@endsection
