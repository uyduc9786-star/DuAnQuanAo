<?php include_once("views/layouts/header.php"); ?>
<style>
    /* 1. Đổi màu chữ của các nhãn (Label) sang trắng */
    .form-group label {
        color: #ffffff !important;
        font-weight: 600;
        margin-bottom: 5px;
    }

    /* 2. Đổi màu nền và màu chữ trong ô nhập liệu */
    .form-control, .form-select {
        background-color: #1e1e2d !important; /* Nền tối (khớp với theme) */
        color: #ffffff !important;             /* Chữ màu trắng tinh */
        border: 1px solid #435ebe;             /* Viền màu xanh cho nổi */
    }

    /* 3. Đổi màu chữ gợi ý (Placeholder - VD: Nhập tên...) sang màu xám sáng */
    .form-control::placeholder {
        color: #a6a6a6 !important;
        opacity: 1;
    }

    /* 4. Khi bấm vào ô nhập liệu (Focus) */
    .form-control:focus, .form-select:focus {
        background-color: #1e1e2d !important;
        color: #ffffff !important;
        border-color: #5ddab4; /* Viền sáng lên khi nhập */
        box-shadow: 0 0 5px rgba(93, 218, 180, 0.5);
    }

    /* 5. Fix riêng cho thẻ Select (Danh mục) */
    .form-select option {
        background-color: #1e1e2d;
        color: #fff;
    }
</style>
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