<?php
include_once("views/layouts/header.php");
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Quản lý danh mục</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <a href="?action=createdanhmuc" class="btn btn-primary mb-3"> Thêm danh mục </a>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tên danh mục</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($allDanhMuc) && is_array($allDanhMuc)) { 
                            foreach ($allDanhMuc as $item) { 
                        ?>
                            <tr>
                                <td><?= $item['id_danh_muc'] ?></td>
                                <td><?= $item['name_danh_muc'] ?></td>
                                
                                <td>
                                    <?php if($item['Trangthai'] == 1): ?>
                                        <span class="badge bg-success">Đang hiện</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Đã ẩn (Thùng rác)</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a href="index.php?action=editdanhmuc&id=<?= $item['id_danh_muc'] ?>" class="btn btn-secondary btn-sm">Sửa</a>
                                    
                                    <?php if ($item['Trangthai'] == 1) { ?>
                                        <a href="index.php?action=deletedanhmuc&id=<?= $item['id_danh_muc'] ?>"
                                        onclick="return confirm('Bạn có muốn xóa không?')" 
                                        class="btn btn-danger btn-sm">Xóa</a>
                                    <?php } else { ?>
                                        <a href="index.php?action=restoredanhmuc&id=<?= $item['id_danh_muc'] ?>"
                                        onclick="return confirm('Bạn có muốn khôi phục không?')" 
                                        class="btn btn-warning btn-sm">Khôi phục</a>
                                    <?php } ?>
                                </td>
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
<?php
include_once("views/layouts/footer.php");
?>