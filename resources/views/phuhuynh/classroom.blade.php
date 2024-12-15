<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lớp Học Của Bạn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
        }

        .user-info {
            font-size: 16px;
            position: relative;
        }

        .dropdown-button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 2px 5px;
            font-size: 10px; 
            line-height: 1;
        }

        .dropdown {
            position: absolute;
            right: 0;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1;
            display: none;
        }

        .dropdown.visible {
            display: block;
        }

        .dropdown-item {
            padding: 10px 15px;
            cursor: pointer;
            color: #333;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .container {
            padding: 20px;
        }

        .classroom-info {
            background-color: white;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 0 150px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .filter-section {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter-select, .search-input, .search-button, .add-button {
            margin-right: 10px;
        }

        .filter-select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-input {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            flex: 1;
        }

        .search-button, .add-button {
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            color: white;
            cursor: pointer;
        }

        .search-button {
            background-color: #28a745;
        }

        .add-button {
            background-color: #007bff;
        }

        .no-data-message {
            color: #666;
            font-style: italic;
        }
    </style>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('visible');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-button')) {
                const dropdowns = document.getElementsByClassName("dropdown");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('visible')) {
                        openDropdown.classList.remove('visible');
                    }
                }
            }
        }
    </script>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="title">Gia Sư Đăng Minh</div>
            <div class="user-info">
                {{ Auth::user()->TenDN }} <!-- Hiển thị tên người dùng -->
                <button class="filter-select dropdown-button" onclick="toggleDropdown()">▼</button>
                <div class="dropdown" id="userDropdown">
                    <div class="dropdown-item"><a href="#">Quản lý lớp</a></div>
                    <div class="dropdown-item"><a href="#">Danh sách gia sư</a></div>
                    <div class="dropdown-item"><a href="#">Đăng yêu cầu tìm gia sư</a></div>
                    <div class="dropdown-item"><a href="{{ route('phuhuynh.chinhsuathongtin') }}">Chỉnh sửa thông tin</a></div>
                    <div class="dropdown-item"><a href="#">Đổi mật khẩu</a></div>
                    <div class="dropdown-item"><a href="#">Đăng xuất</a></div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="classroom-info">
                <h1>LỚP HỌC CỦA BẠN</h1>
                <div class="filter-section">
                    <select class="filter-select">
                        <option value="">Lọc trạng thái</option>
                        <option value="1">Đang tìm gia sư</option>
                        <option value="2">Lớp đã kết nối</option>
                        <option value="3">Lớp chưa kết nối</option>
                    </select>
                    <input type="text" placeholder="Số điện thoại, gia sư hoặc lớp học" class="search-input">
                    <button class="search-button">Tìm Kiếm</button>
                    <button class="add-button">Thêm lớp học</button>
                </div>
                <div class="no-data-message">Không có lớp học nào!</div>
            </div>
        </div>
    </main>
</body>
</html>