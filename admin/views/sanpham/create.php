<?php include_once("views/layouts/header.php"); ?>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Thêm sản phẩm mới</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="index.php?action=storesanpham" enctype="multipart/form-data" method="post">
                    <div class="form-body">
                        <div class="row">
                            
                            <div class="col-12">
                                <fieldset class="form-group">
                                    <label>Danh mục</label>
                                    <select name="danhmuc" class="form-select">
                                        <?php foreach ($allDanhMuc as $item) { ?>
                                            <option value="<?= $item['id_danh_muc'] ?>"><?= $item['name_danh_muc'] ?></option>
                                        <?php } ?>
                                    </select>
                                </fieldset>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input required type="text" class="form-control" name="ten" placeholder="Nhập tên">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Giá sản phẩm</label>
                                    <input required type="number" class="form-control" name="gia" placeholder="Nhập giá">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="number" class="form-control" name="so_luong" value="10">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Loại sản phẩm</label>
                                    <input type="text" class="form-control" name="loai" placeholder="VD: Hot, New...">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>ID Màu Sắc (Nhập số)</label>
                                    <input type="number" class="form-control" name="id_mau_sac" value="1">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>ID Kích Cỡ (Nhập số)</label>
                                    <input type="number" class="form-control" name="id_kich_co" value="1">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Ảnh sản phẩm</label>
                                    <input required type="file" class="form-control" name="anh">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" name="mota" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Thêm</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Làm mới</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once("views/layouts/footer.php"); ?>