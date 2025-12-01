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
    <link rel="stylesheet" href="./views/assets/css/custom.css?v=1">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><img src="views/assets/images/logo/logo12345.png" alt="Logo" srcset="" style="width: 100%; height: auto; max-width: 200px; max-height: 80px; object-fit: contain;"></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">
                            
                            <span>Menu</span>
                        </li>

                        <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "danhmuc") ? 'active' : '' ?>">
                            <a href="index.php?action=listdanhmuc" class='sidebar-link'>
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>Danh mục</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "sanpham") ? 'active' : '' ?>">
                            <a href="index.php?action=listsanpham" class='sidebar-link'>
                                <i class="bi bi-bag-fill"></i>
                                <span>Sản phẩm</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "hoadon") ? 'active' : '' ?>">
                            <a href="index.php?action=listhoadon" class='sidebar-link'>
                                <i class="bi bi-receipt"></i> <span>Hóa đơn</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "thongke") ? 'active' : '' ?>">
                            <a href="index.php?action=thongke" class='sidebar-link'>
                                <i class="bi bi-bar-chart-fill"></i>
                                <span>Thống kê</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "mausac") ? 'active' : '' ?>">
                            <a href="index.php?action=listmausac" class='sidebar-link'>
                                <i class="bi bi-palette-fill"></i>
                                <span>Màu sắc</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= str_contains($_SERVER['REQUEST_URI'], "kichco") ? 'active' : '' ?>">
                            <a href="index.php?action=listkichco" class='sidebar-link'>
                                <i class="bi bi-aspect-ratio-fill"></i>
                                <span>Kích cỡ</span>
                            </a>
                        </li>

                        <li class="sidebar-item"> 
                            <a href="index.php?action=logout" class='sidebar-link text-danger'>
                                <i class="bi bi-box-arrow-right"></i> <span>Đăng xuất</span>
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