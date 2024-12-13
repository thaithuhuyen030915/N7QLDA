<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 250px;
            background-color: white;
            color: #007bff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            margin-left: 90px;
            margin-top: 50px;
        }

        .sidebar h1 {
            font-size: 22px;
            margin: 0 0 20px 0;
        }

        .sidebar a {
            color: #007bff;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #e0e0e0;
        }

        .content {
            flex: 1;
            padding: 20px;
            margin-right: 90px;
            margin-top: 50px;
        }

        .profile-info {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: grid;
            justify-content: space-between;
            column-gap: 20px;
            border: 1px solid #ddd;
            grid-template-columns: 1fr 1fr; /* Hai cột bằng nhau */
            row-gap: 15px; /* Khoảng cách giữa các hàng */
        }

        .column1, .column2 {
            flex: 1; /* Hai cột có chiều rộng bằng nhau */
            display: flex;
            flex-direction: column;
            gap: 15px; /* Khoảng cách giữa các nhãn và ô nhập liệu */
        }

        .profile-info label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            display: block; /* Đảm bảo label luôn ở trên input */
        }

        .profile-info input,
        .profile-info select,
        .profile-info textarea {
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box; /* Đảm bảo không vượt chiều rộng cột */
            background-color: #fff;
            font-size: 14px;
            box-sizing: border-box;
        }

        .profile-info h2 {
            margin-bottom: 20px;
            font-size: 18px;
            color: #333;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 10px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%; /* Nút Lưu chiếm toàn bộ chiều rộng */
        }

        button:hover {
            background-color: #0056b3;
        }

        .profile-info button {
    grid-column: span 2; /* Nút Lưu thay đổi chiếm toàn bộ chiều rộng */
    padding: 8px 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
    align-self: center; /* Đưa nút ra giữa */
}

.profile-info button:hover {
    background-color: #0056b3;
}

        /* Responsive */
        @media (max-width: 768px) {
            .profile-info {
                flex-direction: column; /* Chuyển về bố cục dọc trên màn hình nhỏ */
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">

        <h1>{{ Auth::user()->TenDN }}</h1>

        <button>Bật thông báo</button>
        <a href="#">Quản lý chung</a>
        <a href="#">Danh sách lớp mới</a>
        <a href="#">Quản lý lớp</a>
        <a href="#">Giới thiệu gia sư</a>
        <a href="#">Cài đặt</a>
        <a href="#">Chat online</a>
        <a href="#">Đăng xuất</a>
    </div>
    <div class="content">
    <form action="{{ route('save-giasu') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h2>Thông tin cá nhân</h2>
                    @if(session('success'))
                        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
                    @endif


            <div class="profile-info">
                <div class="column2">
                    <label for="HoTen">Họ tên đầy đủ:</label>
                    <input type="text" id="HoTen" name="HoTen" value="{{ session('HoTen', '') }}" required/>

                    <label for="NgaySinh">Ngày sinh:</label>
                    <input type="date" id="NgaySinh" name="NgaySinh" value="{{ session('NgaySinh', '') }}" required/>

                    <label for="GioiTinh">Giới tính:</label>
                    <select id="GioiTinh" name="GioiTinh">
                        <option value="Nam" {{ session('GioiTinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ session('GioiTinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    </select>

                    <label for="SDT">Số điện thoại:</label>
                    <input type="text" id="SDT" name="SDT" value="{{ session('SDT', '') }}" required/>

                    <label for="Email">Email:</label>
                    <input type="email" id="Email" name="Email" value="{{ session('Email', '') }}" required/>
                </div>

                <div class="column1">
                    <label for="QueQuan">Quê quán:</label>
                    <input type="text" id="QueQuan" name="QueQuan" value="{{ session('QueQuan', '') }}" required/>

                    <label for="Tinh/Thanh">Tỉnh/thành (Địa điểm dạy):</label>
                    <input type="text" id="Tinh/Thanh" name="Tinh/Thanh" value="{{ session('Tinh/Thanh', '') }}" required/>

                    <label for="Quan/Huyen">Quận/huyện:</label>
                    <input type="text" id="Quan/Huyen" name="Quan/Huyen" value="{{ session('Quan/Huyen', '') }}" required/>

                    <label for="DiaChi">Địa chỉ hiện tại:</label>
                    <input type="text" id="DiaChi" name="DiaChi" value="{{ session('DiaChi', '') }}" required/>
                </div>
            </div>

            <h2>Thông tin gia sư</h2>
            <div class="profile-info">
            <div class="column1">
                    <label for="KinhNghiem">Kinh nghiệm đi gia sư và giảng dạy(chi tiết):</label>
                    <input type="text" id="KinhNghiem" name="KinhNghiem" value="{{ session('KinhNghiem', '') }}" required/>

                    <label for="ThanhTich">Thành tích học tập và dạy học(chi tiết):</label>
                    <input type="text" id="ThanhTich" name="ThanhTich" value="{{ session('ThanhTich', '') }}" required/>
            </div>
            </div>

            <h2>Hồ sơ chuyên môn</h2>
            <div class="profile-info">
            <div class="column2">
                    <label for="ChucVu">Bạn đang là:</label>
                            <select id="ChucVu" name="ChucVu">
                                <option value="Sinh viên" {{ session('ChucVu') == 'Sinh viên' ? 'selected' : '' }}>Sinh viên</option>
                                <option value="Giáo viên" {{ session('ChucVu') == 'Giáo viên' ? 'selected' : '' }}>Giáo viên</option>
                            </select>

                    <label for="NoiHocTap">Nơi học tập/công tác:</label>
                    <input type="text" id="NoiHocTap" name="NoiHocTap" value="{{ session('NoiHocTap', '') }}" required/>

                    <label for="BangCap">Bằng cấp:</label>
                    <input type="text" id="BangCap" name="BangCap" value="{{ session('BangCap', '') }}" required/>

                    <label for="ChuyenNganh">Chuyên ngành:</label>
                    <input type="text" id="ChuyenNganh" name="ChuyenNganh" value="{{ session('ChuyenNganh', '') }}" required/>
                </div>

                <div class="column1">
                    <label for="HinhThucDay">Hình thức dạy:</label>
                    <input type="text" id="HinhThucDay" name="HinhThucDay" value="{{ session('HinhThucDay', '') }}" required/>

                    <label for="MonHoc">Môn học sẽ dạy:</label>
                    <input type="text" id="MonHoc" name="MonHoc" value="{{ session('MonHoc', '') }}" required/>

                    <label for="ThoiGian">Thời gian có thể dạy:</label>
                    <input type="text" id="ThoiGian" name="ThoiGian" value="{{ session('ThoiGian', '') }}" required/>

                    <label for="HocPhi">Học phí vnđ/buổi:</label>
                    <input type="text" id="HocPhi" name="HocPhi" value="{{ session('HocPhi', '') }}" required/>
                </div>
            </div>

            <h2>Ảnh xác nhận thông tin gia sư</h2>
            <div class="profile-info">
            <div class="column1">
                    <label for="Anh">Ảnh đại diện:</label>
                    <input type="file" id="Anh" name="Anh" value="{{ session('Anh', '') }}" required/>

                    <label for="CCCD">Ảnh CMT/CCCD (mặt trước):</label>
                    <input type="file" id="CCCD" name="CCCD" value="{{ session('CCCD', '') }}" required/>

                    <label for="MinhChung">Thẻ sinh viên/bằng cấp:</label>
                    <input type="file" id="MinhChung" name="MinhChung" value="{{ session('MinhChung', '') }}" required/>
            </div>
            </div>


            <button type="submit">Lưu thay đổi và chờ xác nhận</button>
        </form>

    </div>
</body>
</html>
