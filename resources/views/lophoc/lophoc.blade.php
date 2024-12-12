
@extends('layouts.lophoc')


@section('content')
<div class="container">
    <!--<h2 class="text-center mb-4">Lớp Đang Tìm Gia Sư</h2>-->
    <h2 class="form-header" style="text-align: center; font-weight: bold; font-size: 50px; color: #007bff; font-family: 'Times New Roman', serif; letter-spacing: 1px;">Lớp Đang Tìm Gia Sư</h2>

    <!-- Danh sách lớp học -->
    <div class="class-list">
        @foreach ($lophocs as $lophoc)
            <div class="class-item">
                <div class="class-img">
                    <img src="{{ asset('frontend/images/logo.png') }}" alt="Trung tâm gia sư" style="width: 60px; height: 60px; border-radius: 50%; text-align: center;">
                    <p style="text-align: center;font-weight: bold;">Gia sư đăng minh</p>
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
</div>
<!-- Phân trang -->


