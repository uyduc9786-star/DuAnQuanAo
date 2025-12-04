<?php 
// Bước 1: Nhúng file Header vào đầu trang để có menu, logo, css...
include_once "views/layout/header.php"; 
?>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Tra cứu đơn hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <span>Lịch sử mua hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="shop spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="cart__discount" style="margin-bottom: 50px; text-align: center;">
                    <h6 style="margin-bottom: 20px;">Nhập số điện thoại để kiểm tra đơn hàng của bạn</h6>
                    
                    <form action="index.php?act=check_order" method="post" style="position: relative; max-width: 500px; margin: 0 auto;">
                        
                        <input type="text" name="sdt" placeholder="Số điện thoại..." style="width: 100%; padding-right: 100px;">
                        
                        <button type="submit" name="btn_check" style="position: absolute; right: 0; top: 0;">Tra cứu</button>
                    </form>

                    <?php 
                    // Kiểm tra xem biến $message có tồn tại và có nội dung không
                    // Biến này được tạo ra bên Controller khi không tìm thấy đơn hàng
                    if(isset($message) && $message != "") { 
                    ?>
                        <p style="color: red; margin-top: 10px; font-weight: bold;">
                            <?= $message ?>
                        </p>
                    <?php 
                    } 
                    ?>
                </div>
                <?php 
                // Kiểm tra: Nếu biến $orders tồn tại và có dữ liệu (tìm thấy đơn hàng)
                if (isset($orders) && count($orders) > 0) { 
                ?>
                    <h4 class="mb-4" style="border-bottom: 2px solid #000; padding-bottom: 10px;">Danh sách đơn hàng</h4>
                    
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th> </tr>
                            </thead>
                            
                            <tbody>
                                <?php 
                                // Duyệt qua từng đơn hàng trong danh sách $orders
                                foreach ($orders as $bill) { 
                                ?>
                                    <tr>
                                        <td style="font-weight: bold;">#<?= $bill['id_hoadon'] ?></td>
                                        
                                        <td><?= date("d/m/Y H:i", strtotime($bill['ngay_dat'])) ?></td>
                                        
                                        <td style="color: #e53637; font-weight: 700;">
                                            <?= number_format($bill['tongtien']) ?> đ
                                        </td>
                                        
                                        <td>
                                            <?php 
                                                // Lấy trạng thái từ CSDL
                                                $tt = $bill['trang_thai'];
                                                
                                                // Mặc định màu đen
                                                $color = 'black';
                                                
                                                // Kiểm tra trạng thái để gán màu tương ứng
                                                if ($tt == 'Mới') {
                                                    $color = 'blue';    // Màu xanh dương
                                                } else if ($tt == 'Đang giao hàng') {
                                                    $color = 'orange';  // Màu cam
                                                } else if ($tt == 'Hoàn tất') {
                                                    $color = 'green';   // Màu xanh lá
                                                } else if ($tt == 'Đã hủy') {
                                                    $color = 'red';     // Màu đỏ
                                                }
                                            ?>
                                            <span style="color: <?= $color ?>; font-weight: 600;">
                                                <?= $tt ?>
                                            </span>
                                        </td>
                                        
                                        <td>
                                            <a href="index.php?act=history_detail&id=<?= $bill['id_hoadon'] ?>" 
                                               class="btn btn-dark btn-sm" 
                                               style="background: #111; color: #fff; padding: 5px 15px;">
                                                Xem chi tiết
                                            </a>
                                        </td>
                                    </tr>
                                <?php 
                                } // Kết thúc vòng lặp foreach
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php 
                } // Kết thúc lệnh if kiểm tra đơn hàng
                ?>
                </div>
        </div>
    </div>
</section>

<?php 
// Bước cuối: Nhúng file Footer vào cuối trang
include_once "views/layout/footer.php"; 
?>