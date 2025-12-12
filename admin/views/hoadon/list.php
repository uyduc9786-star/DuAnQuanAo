<?php include_once("views/layouts/header.php"); ?>

<div class="page-heading">
    <h3>Quản lý đơn hàng</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listHoaDon as $order): ?>
                        <tr>
                            <td>#<?= $order['id_hoadon'] ?></td>
                            <td>
                                <?= $order['ho_ten'] ?><br>
                                <small><?= $order['sdt'] ?></small>
                            </td>
                            <td><?= date('d/m/Y', strtotime($order['ngay_dat'] ?? 'now')) ?></td>
                            <td><?= number_format($order['tongtien']) ?> đ</td>
                            <td>
                                    <?php
                                        $class_mau = '';
            
                                        switch ($order['trang_thai']) {
                                            case 'Mới':
                                                $class_mau = 'info';
                                                break;
                                            
                                            case 'Đã giao':
                                                $class_mau = 'success';
                                                break;

                                            case 'Đã hủy':
                                                $class_mau = 'danger'; // Màu đỏ
                                                break;

                                            default:
                                                $class_mau = 'warning'; // Các trường hợp còn lại
                                                break;
                                        }
                                    ?>
                                    <span class="badge bg-<?= $class_mau ?>">
                                        <?= $order['trang_thai'] ?>
                                    </span>
                            </td>
                            <td>
                                <a href="index.php?action=hoadon_detail&id=<?= $order['id_hoadon'] ?>" class="btn btn-sm btn-primary">Chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once("views/layouts/footer.php"); ?>