<?php
include_once("views/layouts/header.php");
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Quản lý sản phẩm</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <a href="?action=createsanpham" class="btn btn-primary"> Thêm </a>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên SP</th>
                            <th>Danh mục</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Màu</th>   <th>Size</th>  <th>Số lượng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allSanPham as $sp): ?>
                            <?php extract($sp); ?>
                            <tr>
                                <td><?= $id_sp ?></td>
                                <td><?= $ten_sp ?></td>
                                
                                <td><?= $name_danh_muc ?></td> 
                                
                                <td>
                                    <img src="image/<?= $hinh_anh ?>" width="50" alt="Ảnh SP">
                                </td>
                                <td><?= number_format($gia_sp) ?> đ</td>
                                
                                <td>
                                    <span class="badge bg-primary"><?= $ten_mau ?? 'Chưa rõ' ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-info"><?= $loai_kich_co ?? 'Chưa rõ' ?></span>
                                </td>

                                <td><?= $so_luong ?></td>
                                <td>
                                    <a href="index.php?action=editsanpham&id=<?= $id_sp ?>" class="btn btn-secondary btn-sm">Sửa</a>
                                    
                                    <?php if ($trang_thai == 1) { ?>
                                        <a href="index.php?action=deletesanpham&id=<?= $id_sp ?>"
                                        onclick="return confirm('Bạn có muốn xóa không?')" 
                                        class="btn btn-danger btn-sm">Xóa</a>
                                    <?php } else { ?>
                                        <a href="index.php?action=restoresanpham&id=<?= $id_sp ?>"
                                        onclick="return confirm('Bạn có muốn khôi phục không?')" 
                                        class="btn btn-warning btn-sm">Khôi phục</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php
include_once("views/layouts/footer.php");
?>