<?php include_once "views/layout/header.php"; ?>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Thanh toán</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <a href="index.php?act=cart">Giỏ hàng</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="index.php?act=place_order" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Thông tin người nhận</h6>
                        <div class="checkout__input">
                            <p>Họ và tên<span>*</span></p>
                            <input type="text" name="ho_ten" placeholder="Nguyễn Văn A" required>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ nhận hàng<span>*</span></p>
                            <input type="text" name="dia_chi" placeholder="Số nhà, tên đường, phường/xã..." required>
                        </div>
                        <div class="checkout__input">
                            <p>Số điện thoại<span>*</span></p>
                            <input type="text" name="sdt" required>
                        </div>
                        
                        <div id="qr-code-section" style="display: none; margin-top: 20px; text-align: center; border: 1px solid #ddd; padding: 20px;">
                            <h6 style="color: #e53637; font-weight: bold; margin-bottom: 15px;">QUÉT MÃ ĐỂ THANH TOÁN</h6>
                            
                            <?php 
                                // Tính tổng tiền để đưa vào QR
                                $total = 0;
                                if(isset($_SESSION['cart'])) {
                                    foreach($_SESSION['cart'] as $item) $total += $item['gia'] * $item['so_luong'];
                                }
                                // Link tạo QR nhanh (Thay thông tin của bạn vào link dưới)
                                $qr_link = "https://img.vietqr.io/image/MB-0000356490007-compact.jpg?amount=".$total."&addInfo=Thanh toan don hang&accountName=AN DUC UY";
                            ?>
                            <img src="<?= $qr_link ?>" width="300" alt="Mã QR Thanh Toán">
                            
                            <p style="margin-top: 10px; font-size: 14px;">
                                Ngân hàng: <b>MB Bank</b> <br>
                                STK: <b>0000356490007</b> <br>
                                Chủ TK: <b>AN DUC UY</b> <br>
                                Nội dung: <b>Thanh toan don hang</b>
                            </p>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Đơn hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>
                            <ul class="checkout__total__products">
                                <?php 
                                $tong_tien = 0;
                                if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                    $i = 1;
                                    foreach($_SESSION['cart'] as $item) {
                                        $thanh_tien = $item['gia'] * $item['so_luong'];
                                        $tong_tien += $thanh_tien;
                                ?>
                                    <li>
                                        <?= $i ?>. <?= $item['ten'] ?> 
                                        (<?= $item['mau'] ?>, <?= $item['size'] ?>) x <?= $item['so_luong'] ?> 
                                        <span><?= number_format($thanh_tien) ?> đ</span>
                                    </li>
                                <?php 
                                        $i++;
                                    }
                                } 
                                ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Tổng thanh toán <span><?= number_format($tong_tien) ?> đ</span></li>
                            </ul>

                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Thanh toán khi nhận hàng (COD)
                                    <input type="radio" id="payment" name="payment_method" value="Tiền mặt (COD)" checked onchange="toggleQR()">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Chuyển khoản ngân hàng
                                    <input type="radio" id="paypal" name="payment_method" value="Chuyển khoản" onchange="toggleQR()">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            
                            <button type="submit" name="site-btn" class="site-btn">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function toggleQR() {
        var cod = document.getElementById('payment');
        var banking = document.getElementById('paypal');
        var qrSection = document.getElementById('qr-code-section');

        if (banking.checked) {
            qrSection.style.display = 'block'; // Hiện QR
        } else {
            qrSection.style.display = 'none';  // Ẩn QR
        }
    }
</script>

<?php include_once "views/layout/footer.php"; ?>