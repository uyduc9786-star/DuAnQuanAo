<?php
include_once("views/layouts/header.php");

// --- PHẦN 1: TÍNH TOÁN SỐ LIỆU TRONG PHP (CHO CODE HTML SẠCH) ---

$tong_doanh_thu = 0;
$tong_don_hang = 0;
$tong_san_pham_all = 0; // Biến này để tính tổng sản phẩm
$trung_binh_doanh_thu = 0;

$mang_ngay = [];
$mang_tien = [];

// 1. Xử lý dữ liệu Doanh thu (Để vẽ biểu đồ + Tính tổng tiền)
if (isset($listDoanhThu) && is_array($listDoanhThu)) {
    foreach ($listDoanhThu as $dt) {
        $tong_doanh_thu += $dt['doanh_thu'];
        $tong_don_hang += $dt['so_luong_don'];
        
        // Đẩy dữ liệu vào mảng vẽ biểu đồ
        $mang_ngay[] = date("d/m", strtotime($dt['ngay']));
        $mang_tien[] = $dt['doanh_thu'];
    }
    // Tính trung bình
    if(count($listDoanhThu) > 0) {
        $trung_binh_doanh_thu = $tong_doanh_thu / count($listDoanhThu);
    }
}

// 2. Xử lý dữ liệu Danh mục (Để tính tổng số lượng sản phẩm)
if (isset($listDanhMuc) && is_array($listDanhMuc)) {
    foreach ($listDanhMuc as $dm) {
        $tong_san_pham_all += $dm['countSp'];
    }
}
?>

<link rel="stylesheet" href="assets/vendors/iconly/bold.css">

<style>
    /* CSS màu mè cho chữ nổi */
    .font-extrabold { color: #fff !important; font-weight: 800; }
    .text-muted { color: #ddd !important; }
    .card-header h4 { color: #fff !important; }
    /* CSS cho bảng danh mục */
    .table-hover tbody tr:hover { background-color: rgba(255,255,255,0.1); }
    .table td, .table th { color: #fff !important; vertical-align: middle; }
</style>

<div class="page-heading">
    <div class="row align-items-center">
        <div class="col-md-6"><h3>Thống Kê Kinh Doanh</h3></div>
        <div class="col-md-6">
            <form action="index.php" method="GET" class="d-flex justify-content-end gap-2">
                <input type="hidden" name="action" value="thongke"> 
                <input type="date" name="date_from" class="form-control" style="width: 150px;" value="<?= $dateFrom ?>">
                <span class="text-white align-self-center">-</span>
                <input type="date" name="date_to" class="form-control" style="width: 150px;" value="<?= $dateTo ?>">
                <button type="submit" class="btn btn-primary">Lọc</button>
            </form>
        </div>
    </div>
</div>

<div class="page-content">
    
    <div class="row">
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body px-3 py-4">
                    <div class="row">
                        <div class="col-md-4"><div class="stats-icon purple"><i class="iconly-boldShow"></i></div></div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Doanh Thu</h6>
                            <h6 class="font-extrabold mb-0"><?= number_format($tong_doanh_thu/1000000, 1, ',', '.') ?> M</h6>
                            <small style="color: #5ddab4"><?= number_format($tong_doanh_thu, 0, ',', '.') ?> đ</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body px-3 py-4">
                    <div class="row">
                        <div class="col-md-4"><div class="stats-icon blue"><i class="iconly-boldBuy"></i></div></div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Tổng Đơn</h6>
                            <h6 class="font-extrabold mb-0"><?= $tong_don_hang ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body px-3 py-4">
                    <div class="row">
                        <div class="col-md-4"><div class="stats-icon green"><i class="iconly-boldBag"></i></div></div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Sản Phẩm</h6>
                            <h6 class="font-extrabold mb-0"><?= $tong_san_pham_all ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body px-3 py-4">
                    <div class="row">
                        <div class="col-md-4"><div class="stats-icon red"><i class="iconly-boldChart"></i></div></div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">TB/Ngày</h6>
                            <h6 class="font-extrabold mb-0"><?= number_format($trung_binh_doanh_thu, 0, ',', '.') ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header"><h4>Biểu đồ Doanh thu</h4></div>
                <div class="card-body">
                    <div id="chart-doanh-thu"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header"><h4>Mới bán gần đây</h4></div>
                <div class="card-content pb-4">
                    <?php if(isset($listGanDay) && is_array($listGanDay)): ?>
                        <?php foreach($listGanDay as $ganday): ?>
                        <div class="recent-message d-flex px-4 py-3 align-items-center">
                            <div class="avatar avatar-lg bg-primary">
                                <i class="bi bi-cash-stack" style="font-size: 20px; color: white; padding: 10px;"></i>
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1 text-white"><?= date("d/m/Y", strtotime($ganday['ngay'])) ?></h5>
                                <h6 class="text-muted mb-0" style="color: #5ddab4 !important;">
                                    + <?= number_format($ganday['doanh_thu'], 0, ',', '.') ?> đ
                                </h6>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Chi tiết theo Danh mục</h4></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>Tên Danh Mục</th>
                                    <th>Số lượng SP</th>
                                    <th>Giá TB</th>
                                    <th>Doanh thu ước tính</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($listDanhMuc) && is_array($listDanhMuc)): ?>
                                    <?php foreach ($listDanhMuc as $dm): ?>
                                    <tr>
                                        <td>
                                            <p class="font-bold mb-0"><?= $dm['name'] ?></p>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary"><?= $dm['countSp'] ?></span>
                                        </td>
                                        <td>
                                            <?= number_format($dm['avgPrice'], 0, ',', '.') ?> đ
                                        </td>
                                        <td>
                                            <?php $dt_danhmuc = $dm['totalRevenue'] ? $dm['totalRevenue'] : 0; ?>
                                            <strong style="color: #5ddab4;">
                                                <?= number_format($dt_danhmuc, 0, ',', '.') ?> đ
                                            </strong>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        series: [{
            name: 'Doanh thu',
            data: <?php echo json_encode($mang_tien); ?>
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: false }
        },
        colors: ['#435ebe'],
        xaxis: {
            categories: <?php echo json_encode($mang_ngay); ?>
        },
        tooltip: {
            theme: 'dark',
            y: {
                formatter: function (val) {
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(val);
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-doanh-thu"), options);
    chart.render();
</script>

<?php include_once("views/layouts/footer.php"); ?>