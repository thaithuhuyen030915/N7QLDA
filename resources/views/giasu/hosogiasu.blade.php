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
            background-color: white; /* Thay đổi nền thành màu trắng */
            color: #007bff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            margin-left: 90px; /* Cách lề bên trái 20px */
            margin-top: 50px;
        }

        .sidebar h2 {
            margin: 0;
            font-size: 22px;
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
            margin-right: 90px; /* Cách lề bên phải 20px */
            margin-top: 50px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px; /* Khoảng cách giữa header và bảng thông tin */
        }

        .header h1 {
            margin: 0;
        }

        .profile-info {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-info label {
            font-weight: bold;
        }

        .profile-info input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .profile-info button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .profile-info button:hover {
            background-color: #0056b3;
        }

        .personal-info img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 10px 0;
            display: none; /* Ẩn hình ảnh mặc định */
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 >{{ $giaSu->HoTen }}</h2>
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
    <form action="/save-giasu" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="profile-info">
            <h2>Thông tin cá nhân</h2>

             <!-- Thêm thông báo thành công ở đây -->
             @if(session('success'))
                <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
            @endif
            
            <label for="full-name">Họ và tên:</label>
            <input type="text" name="HoTen" value="{{ old('HoTen', $giaSu->HoTen ?? '') }}" placeholder="Nhập vào họ tên" required/>

            <div class="form-group">
                    <label for="GioiTinh">Giới tính:</label>
                    <select id="GioiTinh" name="GioiTinh" required>
                        <option value="Nữ" {{ $giaSu->GioiTinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Nam" {{ $giaSu->GioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                    </select>
                </div>

                <label for="phone">Số điện thoại:</label>
                <input type="text" id="SĐT" name="SĐT" value="{{ old('SĐT', $giaSu->SDT ?? '') }}" placeholder="0912345678" required/>

                <label for="email">Email:</label>
                <input type="email" id="Email" name="Email" value="{{ old('Email', $giaSu->Email ?? '') }}" placeholder="example@example.com" required/>

                <label for="address">Địa điểm dạy:</label>
                <input type="text" id="DiaChi" name="DiaChi" value="{{ old('DiaChi', $giaSu->DiaChi ?? '') }}" placeholder="Địa điểm dạy" required/>

                <label for="diachi">Địa chỉ hiện tại:</label>
                <input type="text" id="DiaChiHienTai" name="DiaChiHienTai" value="{{ old('DiaChiHienTai', $giaSu->DiaChiHienTai ?? '') }}" placeholder="Địa chỉ của bạn" required/>

                <label for="profile-pic">Ảnh đại diện:</label>
                <input type="file" id="Anh" name="Anh" />

                <label for="mota">Kinh nghiệm giảng dạy:</label>
                <input type="text" id="MoTa" name="MoTa" value="{{ old('MoTa', $giaSu->KinhNghiem ?? '') }}" placeholder="Kinh nghiệm..." required/>

                <label for="thanhtich">Thành tích học tập và dạy học:</label>
                <input type="text" id="ThanhTich" name="ThanhTich" value="{{ old('ThanhTich', $giaSu->BangCap ?? '') }}" placeholder="Thành tích..." required/>            

                <button>Lưu thay đổi</button>
        </div>
    </form>
    </div>
</body>
</html>