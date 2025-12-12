<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="views/assets/css/bootstrap.css">

    <link rel="stylesheet" href="views/assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="views/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="views/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="views/assets/css/app.css">
    <link rel="shortcut icon" href="views/assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./views/assets/css/custom.css?v=1">
    <style>
                /* --- CSS CHO SIDEBAR (MENU TRÁI) --- */

        /* 1. Tổng thể Sidebar */
        #sidebar {
            background-color: #ffffff;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.03); /* Bóng đổ nhẹ sang phải */
            border-right: 1px solid #f2f7ff;
            z-index: 100;
        }

        .sidebar-wrapper {
            padding: 25px; /* Tăng khoảng cách lề cho thoáng */
            height: 100vh;
            overflow-y: auto;
        }

        /* 2. Phần Logo/Brand (Chữ Riew) */
        .sidebar-header {
            margin-bottom: 30px;
            text-align: center; /* Căn giữa logo cho cân đối */
            position: relative;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center; /* Hoặc flex-start nếu muốn căn trái */
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo i {
            font-size: 28px;
            color: #435ebe; /* Màu xanh chủ đạo */
        }

        .brand-logo span {
            font-size: 24px;
            font-weight: 800; /* Chữ đậm */
            color: #25396f;
            letter-spacing: -0.5px;
            font-family: 'Nunito', sans-serif;
        }

        /* 3. Tiêu đề nhóm (Menu) */
        .sidebar-title {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
            color: #a6b0cf; /* Màu xám nhạt sang trọng */
            margin-bottom: 15px;
            margin-top: 10px;
            letter-spacing: 1px;
            padding-left: 15px;
        }

        /* 4. Các Item trong Menu */
        .sidebar-item {
            margin-bottom: 8px; /* Khoảng cách giữa các dòng */
            list-style: none;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            border-radius: 12px; /* Bo tròn mềm mại */
            color: #555;
            text-decoration: none;
            transition: all 0.3s ease; /* Hiệu ứng mượt mà */
            font-weight: 600;
            font-size: 15px;
        }

        .sidebar-link i {
            font-size: 18px;
            margin-right: 15px;
            color: #888;
            transition: all 0.3s;
            width: 20px; /* Cố định chiều rộng icon để chữ luôn thẳng hàng */
            text-align: center;
        }

        /* 5. Hiệu ứng Hover (Di chuột vào) */
        .sidebar-link:hover {
            background-color: #f0f4f8; /* Nền xám xanh nhẹ */
            color: #435ebe;
            transform: translateX(5px); /* Đẩy nhẹ sang phải tạo cảm giác động */
        }

        .sidebar-link:hover i {
            color: #435ebe;
        }

        /* 6. Trạng thái Active (Đang chọn) */
        .sidebar-item.active .sidebar-link {
            background-color: #435ebe; /* Nền xanh */
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(67, 94, 190, 0.4); /* Đổ bóng màu xanh */
        }

        .sidebar-item.active .sidebar-link i {
            color: #ffffff;
        }

        /* 7. Nút Đăng xuất (Đặc biệt) */
        .logout-item {
            margin-top: 40px; /* Cách xa các menu trên */
            border-top: 1px solid #f0f0f0;
            padding-top: 20px;
        }

        .logout-link {
            color: #ff5b5c !important; /* Màu đỏ */
        }

        .logout-link:hover {
            background-color: #fff0f0 !important; /* Nền đỏ nhạt khi hover */
            color: #d63031 !important;
        }
        /* --- MẪU 1: GRADIENT TÍM XANH THỜI THƯỢNG --- */
/* Tạo khối nền màu cho Logo */
.sidebar-header {
    /* Sử dụng gradient màu xanh điện và tím sáng hơn để tạo độ tương phản cao */
    background: linear-gradient(135deg, #4361ee 0%, #7209b7 100%);
    /* Điều chỉnh margin để khối logo không bị quá sát cạnh */
    margin: 25px 15px 35px 15px;
    padding: 25px 20px;
    border-radius: 20px; /* Bo góc tròn trịa mềm mại hơn */
    /* QUAN TRỌNG: Hiệu ứng đổ bóng sáng (Glow) màu xanh tím để làm nổi khối khỏi nền tối */
    box-shadow: 0 8px 32px 0 rgba(67, 97, 238, 0.5);
    text-align: center;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.1); /* Thêm viền sáng nhẹ */
}

/* Thêm một lớp phủ ánh sáng tinh tế để tạo cảm giác bóng bẩy (Glassmorphism nhẹ) */
.sidebar-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at center, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 60%);
    pointer-events: none;
}

/* Chỉnh sửa phần chứa logo để căn giữa tốt hơn */
.sidebar-header .logo {
    display: flex;
    justify-content: center;
}

/* --- Tùy chỉnh Icon --- */
.brand-logo i {
    color: #ffffff !important;
    font-size: 34px; /* Tăng kích thước icon lớn hơn (cũ là 28px) */
    /* Tạo bóng đổ sâu cho icon để nó tách khỏi nền gradient */
    filter: drop-shadow(0 4px 4px rgba(0,0,0,0.4));
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Hiệu ứng chuyển động nảy */
}

/* --- Tùy chỉnh Chữ RIEW --- */
.brand-logo span {
    color: #ffffff !important;
    font-size: 28px; /* Tăng kích thước chữ lớn hơn (cũ là 24px) */
    font-weight: 900; /* Dùng font chữ đậm nhất */
    letter-spacing: 1.5px; /* Giãn cách chữ rộng hơn cho sang trọng */
    text-transform: uppercase; /* Chuyển thành chữ in hoa cho mạnh mẽ */
    /* Tạo bóng đổ cho chữ */
    text-shadow: 0 4px 4px rgba(0,0,0,0.4);
    margin-left: 10px;
}

/* --- Hiệu ứng khi di chuột vào khu vực logo --- */
.sidebar-header:hover .brand-logo i {
    transform: scale(1.15) rotate(-10deg); /* Phóng to và xoay nhẹ icon khi hover */
}

.sidebar-header:hover {
    /* Tăng độ sáng của box-shadow khi hover */
     box-shadow: 0 12px 40px 0 rgba(67, 97, 238, 0.7);
     transition: all 0.3s ease;
}

/* Chỉnh lại màu nút tắt menu trên mobile cho đồng bộ */
.sidebar-hide i {
    color: rgba(255, 255, 255, 0.7);
    transition: 0.3s;
}
.sidebar-hide:hover i {
    color: #ffffff;
}

/* Nút tắt menu trên mobile cũng phải chuyển màu */
.sidebar-hide i {
    color: #fff;
}
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex align-items-center">
                <div class="logo w-100">
                    <a href="index.php" class="brand-logo">
                        <i class="bi bi-person-circle"></i> <span>Riew</span>
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu ps-0"> <li class="sidebar-title">Bảng điều khiển</li>

                <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "danhmuc") ? 'active' : '' ?>">
                    <a href="index.php?action=listdanhmuc" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i> <span>Danh mục</span>
                    </a>
                </li>

                <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "sanpham") ? 'active' : '' ?>">
                    <a href="index.php?action=listsanpham" class='sidebar-link'>
                        <i class="bi bi-bag-check-fill"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>

                <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "hoadon") ? 'active' : '' ?>">
                    <a href="index.php?action=listhoadon" class='sidebar-link'>
                        <i class="bi bi-receipt-cutoff"></i> 
                        <span>Hóa đơn</span>
                    </a>
                </li>

                <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "thongke") ? 'active' : '' ?>">
                    <a href="index.php?action=thongke" class='sidebar-link'>
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Thống kê</span>
                    </a>
                </li>

                <li class="sidebar-title">Cấu hình</li>

                <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "mausac") ? 'active' : '' ?>">
                    <a href="index.php?action=listmausac" class='sidebar-link'>
                        <i class="bi bi-palette-fill"></i>
                        <span>Màu sắc</span>
                    </a>
                </li>

                <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "kichco") ? 'active' : '' ?>">
                    <a href="index.php?action=listkichco" class='sidebar-link'>
                        <i class="bi bi-arrows-angle-expand"></i>
                        <span>Kích cỡ</span>
                    </a>
                </li>

                <li class="sidebar-item logout-item"> 
                    <a href="index.php?action=logout" class='sidebar-link logout-link'>
                        <i class="bi bi-box-arrow-right"></i> 
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>