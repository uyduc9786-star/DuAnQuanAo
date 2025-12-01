<?php
include_once("views/layouts/header.php");
?>
<div class="page-heading">
    <h3>Sửa Màu Sắc</h3>
</div>
<div class="card">
    <div class="card-body">
        <form action="index.php?action=updatemausac" method="POST">
            <input type="hidden" name="id" value="<?php echo $mauSac['id_mausac']; ?>">
            
            <div class="form-group mb-3">
                <label for="ten_mau">Tên màu</label>
                <input type="text" class="form-control" name="ten_mau" value="<?php echo $mauSac['ten_mau']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="index.php?action=listmausac" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
<?php
include_once("views/layouts/footer.php");
?>