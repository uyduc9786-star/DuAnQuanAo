<?php
include_once("views/layouts/header.php");
?>
<div class="page-heading">
    <h3>Quản lý Kích Cỡ (Size)</h3>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-header">
            <a href="index.php?action=createkichco" class="btn btn-primary">Thêm Size mới</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Size</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listKichCo as $kc) { ?>
                        <tr>
                            <td><?php echo $kc['id_kichco']; ?></td>
                            <td>
                                <span class="badge bg-info"><?php echo $kc['loai_kich_co']; ?></span>
                            </td>
                            <td>
                                <a href="index.php?action=editkichco&id=<?php echo $kc['id_kichco']; ?>" class="btn btn-sm btn-primary">Sửa</a>
                                <a href="index.php?action=deletekichco&id=<?php echo $kc['id_kichco']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa size này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once("views/layouts/footer.php");
?>