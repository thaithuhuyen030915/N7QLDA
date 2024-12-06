@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: #007bff;">CÁC LỚP HỌC ĐANG TÌM KIẾM GIA SƯ</h2>
    <div class="row">
        @foreach($dsLophoc as $lopHoc)
            <div class="col-md-4 mb-4">
                <div class="card" style="border: 1px solid #007bff; border-radius: 10px; transition: transform 0.2s;">
                    <div class="card-body" style="background-color: #f8f9fa;">
                        <h5 class="card-title" style="color: #007bff;">{{ $lopHoc->MonHoc }}</h5>
                        <p class="card-text">Lớp: {{ $lopHoc->Lop }}</p>
                        <p class="card-text">Số buổi/tuần: {{ $lopHoc->SoBuoi }}</p>
                        <p class="card-text">Học phí (VND/buổi): {{ $lopHoc->HocPhi }}</p>
                        <p class="card-text">Thời lượng (giờ): {{ $lopHoc->ThoiLuongBuoiHoc }}</p>
                        <p class="card-text">Hình thức: {{ $lopHoc->HinhThucHoc }}</p>
                    </div>
                    <div class="card-footer border-0 text-center">
                        <button type="button" class="btn btn-primary">Đề nghị dạy</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="text-center mb-4 mt-5" style="color: #007bff;">GIA SƯ NỔI BẬT</h2>
    <div class="row">
        @foreach($giasus as $giasu)
            <div class="col-md-4 mb-4">
                <div class="card" style="border: 1px solid #007bff; border-radius: 10px; transition: transform 0.2s;">
                    <img src="{{ !empty($giasu->nguoidung->Anh) ? asset($giasu->nguoidung->Anh) : asset('frontend/images/nguoidung.jpg') }}" class="card-img-top" alt="Gia sư" style="width: 80%; height: auto; margin: auto;">
                    <div class="card-body" style="background-color: #f8f9fa;">
                        <h5 class="card-title" style="color: #007bff;">{{ $giasu->nguoidung->HoTen }}</h5>
                        <p class="card-text">Trình độ: {{ $giasu->TrinhDo }}</p>
                        <p class="card-text">Kinh nghiệm: {{ $giasu->KinhNghiem }}</p>
                    </div>
                    <div class="card-footer border-0 text-center">
                        <button type="button" class="btn btn-primary">Mời dạy</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection