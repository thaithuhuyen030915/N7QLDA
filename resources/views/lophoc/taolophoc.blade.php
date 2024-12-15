<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Lớp Học Mới</title>
    <!-- Link đến CSS riêng -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/taolophoc.css') }}">
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-container">
        <h4 class="form-header" style="text-align: center; font-weight: bold; font-size: 24px; color: #007bff;">Tạo Lớp Học Mới</h4>
        <form action="{{ route('lophoc.store') }}" method="POST">
            @csrf
            <!-- Tóm tắt yêu cầu -->
            <div class="form-group mb-3">
                <label for="summary" class="form-section-title">Tóm tắt yêu cầu</label>
                <input type="text" id="summary" name="summary" class="form-control" placeholder="VD: Tìm gia sư Toán lớp 8 tại Hà Nội" required>
            </div>
            <!-- Môn học -->
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="MonHoc" class="form-section-title">Môn học</label>
                    <input type="text" id="MonHoc" name="MonHoc" class="form-control" placeholder="VD: Toán" required>
                </div>
                <div class="col-md-6">
                    <label for="Lop" class="form-section-title">Lớp</label>
                    <input type="text" id="Lop" name="Lop" class="form-control" placeholder="VD: Lớp 8" required>
                </div>
            </div>
            <!-- Số buổi học và phí -->
            <div class="row g-3 mt-3">
                <div class="col-md-6">
                <label for="SoBuoi" class="form-section-title">Số buổi</label>
                    <select id="SoBuoi" name="SoBuoi" class="form-select" required>
                        <option value="">-- Lựa chọn số buổi học --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="HocPhi" class="form-section-title">Học phí (VNĐ/buổi)</label>
                    <input type="text" id="HocPhi" name="HocPhi" class="form-control" placeholder="VD: 150000 - 300000" required>
                </div>
            </div>
            <!-- THỜI LƯỢNG BUỔI HỌC -->
            <div class="form-group mt-3">
                <label for="ThoiLuongBuoiHoc" class="form-section-title">Thời Lượng Buổi Học</label>
                <select id="ThoiLuongBuoiHoc" name="ThoiLuongBuoiHoc" class="form-select"required>
                        <option value="">-- Thời lượng buổi học --</option>
                        <option value="1h">1</option>
                        <option value="1.5h">1.5</option>
                        <option value="2h">2</option>
                        <option value="2.5h">2.5</option>
                    </select>
        </div>
            <!-- Hình thức học -->
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="DoiTuongDay" class="form-section-title">Đối tượng dạy</label>
                    <input type="text" id="DoiTuongDay" name="DoiTuongDay" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="HinhThucHoc" class="form-section-title">Hình thức học</label>
                    <select id="HinhThucHoc" name="HinhThucHoc" class="form-select" required>
                        <option value="">-- Lựa chọn hình thức học --</option>
                        <option value="online">Online</option>
                        <option value="offline">Offline</option>
                    </select>
            </div>
            <!--//-->
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="DacDiemHocSinh" class="form-section-title">Đặc điểm học sinh</label>
                    <input type="text" id="DacDiemHocSinh" name="DacDiemHocSinh" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="GioiTinhGiaSu" class="form-section-title">Giới tính gia sư</label>
                    <select id="GioiTinhGiaSu" name="GioiTinhGiaSu" class="form-select">
                        <!--<option value="khong_yeu_cau">Không yêu cầu</option>-->
                        <option value="nu">Nữ</option>
                        <option value="nam">Nam</option>
                    </select>
            </div>
            <div class="form-group mb-3">
                <label for="YeuCauGiaSu" class="form-section-title">Yêu cầu gia sư</label>
                <input type="text" id="YeuCauGiaSu" name="YeuCauGiaSu" class="form-control"  required>
            </div>

            <!-- Thời gian học -->
             <div class="form-section-title">Thời gian có thể học</div>
            <div class="table-responsive">
                <table class="table table-bordered time-table">
                    <thead>
                        <tr>
                            <th>Thứ 2</th>
                            <th>Thứ 3</th>
                            <th>Thứ 4</th>
                            <th>Thứ 5</th>
                            <th>Thứ 6</th>
                            <th>Thứ 7</th>
                            <th>Chủ nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" name="ThoiGianDay" id="ThoiGianDay" placeholder="--Giờ--"></td>
                            <td><input type="text" class="form-control" name="ThoiGianDay" id="ThoiGianDay" placeholder="--Giờ--"></td>
                            <td><input type="text" class="form-control" name="ThoiGianDay" id="ThoiGianDay" placeholder="--Giờ--"></td>
                            <td><input type="text" class="form-control" name="ThoiGianDay" id="ThoiGianDay" placeholder="--Giờ--"></td>
                            <td><input type="text" class="form-control" name="ThoiGianDay" id="ThoiGianDay" placeholder="--Giờ--"></td>
                            <td><input type="text" class="form-control" name="ThoiGianDay" id="ThoiGianDay" placeholder="--Giờ--"></td>
                            <td><input type="text" class="form-control" name="ThoiGianDay" id="ThoiGianDay" placeholder="--Giờ--"></td>
                        </tr>
                       
                    </tbody>
                </table>
            </div> 

            <div class="form-group mb-3">
                <label for="TinhTrangLop" class="form-section-title">Tình trạng lớp</label>
                <input type="text" id="TinhTrangLop" name="TinhTrangLop" class="form-control" >
            </div>
            <div class="form-group mb-3">
                <label for="MaHoSoPH" class="form-section-title">Mã hồ sơ Phụ Huynh</label>
                <input type="text" id="MaHoSoPH" name="MaHoSoPH" class="form-control" required>
            </div>
            <!-- Cam kết -->
            <div class="form-check mt-3">
                <input type="checkbox" id="agreement" name="agreement" class="form-check-input" required>
                <label for="agreement" class="form-check-label">Tôi cam kết thông tin trên là chính xác</label>
            </div>


            <!-- Nút gửi -->
            <button type="submit" class="btn btn-primary w-100 mt-4" style="font-weight: bold;">TẠO LỚP HỌC</button>
        </form>
    </div>
    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<!--Hiển thị thông báo thành công-->
<!-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif -->
</html>
