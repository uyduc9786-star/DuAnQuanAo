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
                        <?php
                            // 1. Khai báo các biến trạng thái select (Mặc định là rỗng)
                            $selected_cho_xac_nhan = "";
                            $selected_dang_giao    = "";
                            $selected_da_giao      = "";
                            $selected_da_huy       = "";
                            
                            // 2. Khai báo biến để khóa form (Mặc định là rỗng - tức là không khóa)
                            $khoa_form = ""; 
                            $loi_nhan  = ""; // Biến để hiện thông báo nếu cần

                            // 3. Dùng IF - ELSEIF để kiểm tra logic
                            if ($order['trang_thai'] == 'Chờ xác nhận') {
                                $selected_cho_xac_nhan = "selected";
                            } 
                            elseif ($order['trang_thai'] == 'Đang giao hàng') {
                                $selected_dang_giao = "selected";
                            } 
                            elseif ($order['trang_thai'] == 'Đã giao') {
                                $selected_da_giao = "selected";
                            } 
                            elseif ($order['trang_thai'] == 'Đã hủy') {
                                $selected_da_huy = "selected";
                                
                                // LOGIC QUAN TRỌNG: Nếu đã hủy thì gán chữ "disabled" vào biến khóa
                                $khoa_form = "disabled"; 
                                $loi_nhan  = "Đơn hàng này đã bị hủy. Bạn không thể cập nhật trạng thái nữa.";
                            }
                        ?>

                        <form action="index.php?action=update_status" method="POST">
                            
                            <input type="hidden" name="id" value="<?= $order['id_hoadon'] ?>">
                            
                            <div class="form-group">
                                <label class="form-label">Chọn trạng thái:</label>
                                
                                <select name="trang_thai" class="form-select mb-3" <?= $khoa_form ?>>
                                    
                                    <option value="Chờ xác nhận" <?= $selected_cho_xac_nhan ?>>
                                        Chờ xác nhận
                                    </option>
                                    
                                    <option value="Đang giao hàng" <?= $selected_dang_giao ?>>
                                        Đang giao hàng
                                    </option>
                                    
                                    <option value="Đã giao" <?= $selected_da_giao ?>>
                                        Đã giao (Hoàn tất)
                                    </option>
                                    
                                    <option value="Đã hủy" <?= $selected_da_huy ?>>
                                        Hủy đơn
                                    </option>
                                    
                                </select>
                                
                                <?php if ($loi_nhan != ""): ?>
                                    <div class="alert alert-danger p-2" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill"></i> <?= $loi_nhan ?>
                                    </div>
                                <?php endif; ?>
                                
                            </div>

                            <button type="submit" class="btn btn-primary w-100" <?= $khoa_form ?>>
                                Cập nhật
                            </button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once("views/layouts/footer.php"); ?>