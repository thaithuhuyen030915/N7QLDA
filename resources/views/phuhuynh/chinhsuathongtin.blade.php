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
            margin-right: 90px;
            margin-top: 50px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
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
            width: 100%; /* Nút Lưu chiếm toàn bộ chiều rộng */
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
    </style>
</head>
<body>
    <div class="sidebar">
        @if(Auth::check())
            <h1>{{ Auth::user()->TenDN }}</h1> <!-- Hiển thị tên người dùng -->
        @else
            <h1>Vui lòng đăng nhập</h1> <!-- Hiển thị nếu người dùng chưa đăng nhập -->
        @endif
        
        <button>Bật thông báo</button>
        <a href="#">Quản lý chung</a>
        <a href="#">Danh sách gia sư</a>
        <a href="#">Quản lý lớp</a>
        <a href="#">Đăng yêu cầu tìm gia sư</a>
        <a href="#">Cài đặt</a>
        <a href="#">Chat online</a>
        <a href="#">Đăng xuất</a>
    </div>
    <div class="content">
    <form action="{{ route('phuhuynh.update') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Thêm token CSRF -->
            <div class="profile-info">
                <h2>Thông tin cá nhân</h2>

                <!-- Thêm thông báo thành công -->
                @if(session('success'))
                    <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
                @endif
                
                <label for="full-name">Họ và tên:</label>
                <input type="text" id="HoTen" name="HoTen" placeholder="" 
                       value="{{ session('HoTen', '') }}" required/>

                <label for="ngay-sinh">Ngày sinh:</label>
                <input type="date" id="NgaySinh" name="NgaySinh" placeholder="" 
                       value="{{ session('NgaySinh', '') }}" required/>

                <label for="gioi-tinh">Giới Tính:</label>
                <input type="text" id="GioiTinh" name="GioiTinh" placeholder="" 
                       value="{{ session('GioiTinh', '') }}" required/>

                <label for="phone">Số điện thoại:</label>
                <input type="text" id="SDT" name="SDT" placeholder="" 
                       value="{{ session('SDT', '') }}" required/>

                <label for="email">Email:</label>
                <input type="email" id="Email" name="Email" placeholder="" 
                       value="{{ session('Email', '') }}" required/>

                <label for="address">Địa chỉ:</label>
                <input type="text" id="DiaChi" name="DiaChi" placeholder="" 
                       value="{{ session('DiaChi', '') }}" required/>

                <label for="profile-pic">Ảnh đại diện:</label>
                <input type="file" id="Anh" name="Anh" />

                <label for="CCCD">Ảnh CCCD:</label>
                <input type="file" id="CCCD" name="CCCD" />

                <button type="submit">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</body>
</html>
