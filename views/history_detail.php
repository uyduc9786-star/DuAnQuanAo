<?php include_once "views/layout/header.php"; ?>

<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h4>Chi tiết đơn hàng #<?= $bill['id_hoadon'] ?></h4>
                </div>
                
                <div style="background: #f3f2ee; padding: 20px; margin-bottom: 30px; border-radius: 5px;">
                    <p><strong>Người nhận:</strong> <?= $bill['ho_ten'] ?></p>
                    <p><strong>Số điện thoại:</strong> <?= $bill['sdt'] ?></p>
                    <p><strong>Địa chỉ:</strong> <?= $bill['dia_chi'] ?></p>
                    <p><strong>Ngày đặt:</strong> <?= date("d/m/Y H:i", strtotime($bill['ngay_dat'])) ?></p>
                    <p><strong>Trạng thái:</strong> <span style="color: red; font-weight: bold;"><?= $bill['trang_thai'] ?></span></p>
                </div>

                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($billDetail as $item): ?>
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="admin/image/<?= $item['hinh_anh'] ?>" width="80" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6><?= $item['ten_sp'] ?></h6>
                                            <h5>Màu: <?= $item['mau'] ?> | Size: <?= $item['size'] ?></h5>
                                        </div>
                                    </td>
                                    <td class="cart__price"><?= number_format($item['gia']) ?> đ</td>
                                    <td class="cart__quantity" style="font-weight: bold; text-align: center;"><?= $item['so_luong'] ?></td>
                                    <td class="cart__price" style="color: #e53637;"><?= number_format($item['gia'] * $item['so_luong']) ?> đ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="index.php?act=check_order">Quay lại tra cứu</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="cart__total">
                            <h6>Tổng thanh toán</h6>
                            <ul>
                                <li>Tổng tiền <span><?= number_format($bill['tongtien']) ?> đ</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "views/layout/footer.php"; ?>