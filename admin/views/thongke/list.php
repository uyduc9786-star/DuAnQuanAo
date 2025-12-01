<?php
include_once("views/layouts/header.php");
?>
<link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
<link rel="stylesheet" href="assets/compiled/css/table-datatable.css">

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Thống kê danh mục sản phẩm</h3>
                <p class="text-subtitle text-muted">Bảng thống kê số lượng và giá sản phẩm theo danh mục.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thống kê</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Dữ liệu chi tiết
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Mã DM</th>
                            <th>Tên Danh Mục</th>
                            <th>Số lượng SP</th>
                            <th>Giá thấp nhất</th>
                            <th>Giá cao nhất</th>
                            <th>Giá trung bình</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Kiểm tra biến $listThongKe từ Controller truyền sang
                        if (isset($listThongKe) && is_array($listThongKe)) {
                            foreach ($listThongKe as $tk) {
                                extract($tk);
                                // $tk sẽ có các key: id, name, countSp, minPrice, maxPrice, avgPrice
                                ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td>
                                        <span class="badge bg-primary"><?php echo $countSp; ?></span>
                                    </td>
                                    <td><?php echo number_format($minPrice, 0, ',', '.'); ?> đ</td>
                                    <td><?php echo number_format($maxPrice, 0, ',', '.'); ?> đ</td>
                                    <td><?php echo number_format($avgPrice, 0, ',', '.'); ?> đ</td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="assets/static/js/pages/simple-datatables.js"></script>
<?php
include_once("views/layouts/footer.php");
?>