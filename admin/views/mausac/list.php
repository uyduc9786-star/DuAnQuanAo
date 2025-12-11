<?php
include_once("views/layouts/header.php");
?>
<div class="page-heading">
    <h3>Quản lý Màu sắc</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            <a href="index.php?action=createmausac" class="btn btn-primary">Thêm màu mới</a>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Màu</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Vòng lặp foreach kiểu cũ cho dễ hiểu
                    foreach($listMauSac as $mau) { 
                    ?>
                        <tr>
                            <td><?php echo $mau['id_mausac']; ?></td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    <?php echo $mau['ten_mau']; ?>
                                </span>
                            </td>
                            <td>
                                <a href="index.php?action=editmausac&id=<?php echo $mau['id_mausac']; ?>" class="btn btn-sm btn-primary">Sửa</a>
                                <?php if ($mau['Trangthai'] == 1) { ?>
                                        <a href="index.php?action=deletemausac&id=<?= $mau['id_mausac'] ?>"
                                        onclick="return confirm('Bạn có muốn xóa không?')" 
                                        class="btn btn-danger btn-sm">Xóa</a>
                                    <?php } else { ?>
                                        <a href="index.php?action=restoremausac&id=<?= $mau['id_mausac'] ?>"
                                        onclick="return confirm('Bạn có muốn khôi phục không?')" 
                                        class="btn btn-warning btn-sm">Khôi phục</a>
                                    <?php } ?>
                            </td>
                        </tr>
                    <?php 
                    } // Kết thúc vòng lặp
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once("views/layouts/footer.php");
?>