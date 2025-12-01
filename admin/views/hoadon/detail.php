<?php include_once("views/layouts/header.php"); ?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                <h3>Chi tiết đơn hàng #<?= $order['id_hoadon'] ?></h3>
                <a href="index.php?action=listhoadon" class="btn btn-secondary mb-3">Quay lại</a>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Sản phẩm đã mua</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Phân loại</th>
                                        <th>Giá</th>
                                        <th>SL</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orderDetails as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="image/<?= $item['hinh_anh'] ?>" width="50" style="margin-right: 10px;">
                                                <span><?= $item['ten_sp'] ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            Size: <b><?= $item['size'] ?? 'N/A' ?></b> <br>
                                            Màu: <b><?= $item['mau'] ?? 'N/A' ?></b>
                                        </td>
                                        <td><?= number_format($item['gia']) ?> đ</td>
                                        <td><?= $item['so_luong'] ?></td>
                                        <td><?= number_format($item['gia'] * $item['so_luong']) ?> đ</td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                <div class="card-header">
                    <h4>Thông tin khách hàng</h4>
                </div>
                    <div class="card-body">
                        <p><b>Họ tên:</b> <?= $order['ho_ten'] ?></p>
                        <p><b>SĐT:</b> <?= $order['sdt'] ?></p>
                        <p><b>Địa chỉ:</b> <?= $order['dia_chi'] ?></p>
                        
                        <p>
                            <b>Hình thức thanh toán: </b>
                            <?php 
                                $bg_color = ($order['hinh_thuc_thanh_toan'] == 'Chuyển khoản') ? 'success' : 'primary';
                            ?>
                            <span class="badge bg-<?= $bg_color ?>">
                                <?= $order['hinh_thuc_thanh_toan'] ?>
                            </span>
                        </p>
                        <hr>
                        <h4 class="text-danger">Tổng tiền: <?= number_format($order['tongtien']) ?> đ</h4>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Cập nhật trạng thái</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php?action=update_status" method="POST">
                            <input type="hidden" name="id" value="<?= $order['id_hoadon'] ?>">
                            <div class="form-group">
                                <select name="trang_thai" class="form-select mb-3">
                                    <option value="Chờ xác nhận" <?= $order['trang_thai'] == 'Chờ xác nhận' ? 'selected' : '' ?>>Chờ xác nhận</option>
                                    <option value="Đang giao hàng" <?= $order['trang_thai'] == 'Đang giao hàng' ? 'selected' : '' ?>>Đang giao hàng</option>
                                    <option value="Đã giao" <?= $order['trang_thai'] == 'Đã giao' ? 'selected' : '' ?>>Đã giao (Hoàn tất)</option>
                                    <option value="Đã hủy" <?= $order['trang_thai'] == 'Đã hủy' ? 'selected' : '' ?>>Hủy đơn</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once("views/layouts/footer.php"); ?>