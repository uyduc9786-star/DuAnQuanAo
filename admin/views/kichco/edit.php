<?php
include_once("views/layouts/header.php");
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Cập Nhật Kích Cỡ</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.php?action=listkichco">Danh sách kích cỡ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cập nhật</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sửa thông tin</h4>
            </div>
            <div class="card-body">
                <form action="index.php?action=updatekichco" method="POST">
                    
                    <input type="hidden" name="id" value="<?php echo $kichCo['id_kichco']; ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Tên Kích Cỡ (Size)</label>
                                <input type="text" class="form-control" id="basicInput" name="loai_kich_co" 
                                       value="<?php echo $kichCo['loai_kich_co']; ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Lưu thay đổi</button>
                        <a href="index.php?action=listkichco" class="btn btn-secondary me-1 mb-1">Hủy bỏ</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php
include_once("views/layouts/footer.php");
?>