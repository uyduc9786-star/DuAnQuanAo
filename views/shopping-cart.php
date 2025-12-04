<?php include_once "views/layout/header.php"; ?>

<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $tong_don_hang = 0;
                            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $key => $item) {
                                    $thanh_tien = $item['gia'] * $item['so_luong'];
                                    $tong_don_hang += $thanh_tien;
                                    $hinhAnh = $item['img'] ? "admin/image/".$item['img'] : "admin/image/default.png";
                            ?>
                            <tr>
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="<?= $hinhAnh ?>" width="90" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6><?= $item['ten'] ?></h6>
                                        <h5><?= number_format($item['gia']) ?> đ</h5>
                                        <span>Màu: <?= $item['mau'] ?>, Size: <?= $item['size'] ?></span>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="qty-custom" style="display: flex; align-items: center;">
                                            <a href="index.php?act=update_cart&key=<?= $key ?>&type=decrease" 
                                               style="padding: 0 10px; font-size: 20px; color: black; text-decoration: none;">-</a>
                                            
                                            <input type="text" value="<?= $item['so_luong'] ?>" readonly 
                                                   style="width: 40px; text-align: center; border: none;">
                                            
                                            <a href="index.php?act=update_cart&key=<?= $key ?>&type=increase" 
                                               style="padding: 0 10px; font-size: 20px; color: black; text-decoration: none;">+</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price"><?= number_format($thanh_tien) ?> đ</td>
                                <td class="cart__close">
                                    <a href="index.php?act=delete_cart&key=<?= $key ?>"><i class="fa fa-close"></i></a>
                                </td>
                            </tr>
                            <?php 
                                } 
                            } else {
                                echo '<tr><td colspan="4" class="text-center">Giỏ hàng trống</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="index.php?act=shop">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Tổng giỏ hàng</h6>
                    <ul>
                        <li>Tổng tiền <span><?= number_format($tong_don_hang) ?> đ</span></li>
                    </ul>
                    <?php if ($tong_don_hang > 0): ?>
                        <a href="index.php?act=checkout" class="primary-btn">Tiến hành thanh toán</a>
                    <?php else: ?>
                        <a href="#" class="primary-btn" style="background: gray; cursor: not-allowed;">Giỏ hàng trống</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "views/layout/footer.php"; ?>