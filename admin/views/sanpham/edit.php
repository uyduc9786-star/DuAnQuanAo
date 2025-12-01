<?php include_once("views/layouts/header.php"); ?>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sửa sản phẩm: <?= $sanPham['ten_sp'] ?></h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="index.php?action=updatesanpham" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?= $sanPham['id_sp'] ?>">
                    
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <fieldset class="form-group">
                                    <label>Danh mục</label>
                                    <select name="danhmuc" class="form-select">
                                        <?php foreach ($allDanhMuc as $item) { ?>
                                            <option 
                                                <?= ($sanPham['id_danh_muc'] == $item['id_danh_muc']) ? "selected" : "" ?> 
                                                value="<?= $item['id_danh_muc'] ?>">
                                                <?= $item['name_danh_muc'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </fieldset>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input required type="text" class="form-control" name="ten" value="<?= $sanPham['ten_sp'] ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Giá sản phẩm</label>
                                    <input required type="number" class="form-control" name="gia" value="<?= $sanPham['gia_sp'] ?>">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="number" class="form-control" name="so_luong" value="<?= $sanPham['so_luong'] ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Loại</label>
                                    <input type="text" class="form-control" name="loai" value="<?= $sanPham['loai'] ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>ID Màu</label>
                                    <input type="number" class="form-control" name="id_mau_sac" value="<?= $sanPham['id_mau_sac'] ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>ID Size</label>
                                    <input type="number" class="form-control" name="id_kich_co" value="<?= $sanPham['id_kich_co'] ?>">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Ảnh sản phẩm (Chỉ chọn nếu muốn thay ảnh mới)</label>
                                    <input type="file" class="form-control" name="anh">
                                    <div class="mt-2">
                                        <img src="image/<?= $sanPham['hinh_anh'] ?>" width="100px" alt="Ảnh hiện tại">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" name="mota" rows="3"><?= $sanPham['Mo_ta'] ?></textarea>
                                </div>
                            </div>
                            
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Cập nhật</button>
                                <a href="index.php?action=listsanpham" class="btn btn-light-secondary me-1 mb-1">Hủy</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once("views/layouts/footer.php"); ?>