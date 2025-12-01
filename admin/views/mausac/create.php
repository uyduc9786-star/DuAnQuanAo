<?php
include_once("views/layouts/header.php");
?>
<div class="page-heading">
    <h3>Thêm Màu Sắc</h3>
</div>
<div class="card">
    <div class="card-body">
        <form action="index.php?action=storemausac" method="POST">
            <div class="form-group mb-3">
                <label for="ten_mau">Tên màu</label>
                <input type="text" class="form-control" name="ten_mau" required placeholder="Ví dụ: Xanh dương">
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="index.php?action=listmausac" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
<?php
include_once("views/layouts/footer.php");
?>