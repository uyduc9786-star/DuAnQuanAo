<?php
// Bước 1: Nhúng file Header (chứa menu, logo, css...) vào trang
include_once "views/layout/header.php";
?>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Cửa hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <span>Cửa hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="shop spad">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    
                    <div class="shop__sidebar__search">
                        <form action="index.php" method="GET">
                            <input type="hidden" name="act" value="shop">
                            
                            <input type="text" name="keyword" placeholder="Tìm kiếm...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <li><a href="index.php?act=shop">Tất cả sản phẩm</a></li>
                                                
                                                <?php 
                                                // Kiểm tra xem biến $categories có tồn tại và có dữ liệu không
                                                if (isset($categories) && is_array($categories)) {
                                                    foreach ($categories as $dm) {
                                                        // Tạo đường dẫn lọc theo ID danh mục
                                                        // Ví dụ: index.php?act=shop&iddm=5
                                                        $linkDanhMuc = "index.php?act=shop&iddm=" . $dm['id_danh_muc'];
                                                ?>
                                                        <li>
                                                            <a href="<?= $linkDanhMuc ?>">
                                                                <?= $dm['name_danh_muc'] ?>
                                                            </a>
                                                        </li>
                                                <?php 
                                                    } // Kết thúc vòng lặp danh mục
                                                } 
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Lọc theo giá</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="index.php?act=shop&price=0-100000">Dưới 100.000đ</a></li>
                                                <li><a href="index.php?act=shop&price=100000-300000">100.000đ - 300.000đ</a></li>
                                                <li><a href="index.php?act=shop&price=300000-500000">300.000đ - 500.000đ</a></li>
                                                <li><a href="index.php?act=shop&price=500000-1000000">500.000đ - 1.000.000đ</a></li>
                                                <li><a href="index.php?act=shop&price=1000000-99999999">Trên 1.000.000đ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <?php 
                                    // Đếm số lượng sản phẩm trong mảng $allProducts
                                    $soLuong = 0;
                                    if (isset($allProducts)) {
                                        $soLuong = count($allProducts);
                                    }
                                ?>
                                <p>Hiển thị <?= $soLuong ?> kết quả</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <?php 
                    // Bước 1: Kiểm tra xem có sản phẩm nào không
                    if (isset($allProducts) && count($allProducts) > 0) {
                        
                        // Bước 2: Duyệt qua từng sản phẩm để hiển thị
                        foreach ($allProducts as $sp) {
                            // Tách mảng $sp thành các biến lẻ ($id_sp, $ten_sp, $gia_sp...)
                            extract($sp); 

                            // Xử lý logic hình ảnh: Nếu không có ảnh thì dùng ảnh mặc định
                            if (!empty($hinh_anh)) {
                                $imgName = $hinh_anh;
                            } else {
                                $imgName = 'default.jpg';
                            }
                            $hinhPath = "admin/image/" . $imgName; 

                            // Tạo đường dẫn đến trang chi tiết
                            $linkDetail = "index.php?act=detail&id=" . $id_sp;
                    ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    
                                    <div class="product__item__pic set-bg" data-setbg="<?= $hinhPath ?>" 
                                         onclick="window.location.href='<?= $linkDetail ?>';" 
                                         style="cursor: pointer;">
                                        
                                        <?php if (isset($loai) && $loai != "") { ?>
                                            <span class="label"><?= $loai ?></span>
                                        <?php } ?>

                                        <ul class="product__hover">
                                            <li><a href="#"><img src="views/img/icon/heart.png" alt=""></a></li>
                                            <li><a href="<?= $linkDetail ?>"><img src="views/img/icon/search.png" alt=""></a></li>
                                        </ul>
                                    </div>
                                    
                                    <div class="product__item__text">
                                        <h6><?= $ten_sp ?></h6>
                                        
                                        <form action="index.php?act=add_to_cart" method="post" style="display: inline;">
                                            <input type="hidden" name="id_sp" value="<?= $id_sp ?>">
                                            <input type="hidden" name="ten_sp" value="<?= $ten_sp ?>">
                                            <input type="hidden" name="gia_sp" value="<?= $gia_sp ?>">
                                            <input type="hidden" name="hinh_anh" value="<?= $imgName ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="mau" value="Mặc định">
                                            <input type="hidden" name="size" value="F">
                                            
                                            <button type="submit" name="add_to_cart" class="add-cart" 
                                                    style="border: none; background: none; color: #e53637; font-weight: 700; cursor: pointer; text-transform: uppercase; letter-spacing: 2px;">
                                                + Thêm vào giỏ
                                            </button>
                                        </form>

                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5><?= number_format($gia_sp, 0, ',', '.') ?> đ</h5>
                                    </div>
                                </div>
                            </div>
                            <?php 
                        } // Kết thúc vòng lặp foreach
                    } else { 
                        // Trường hợp không tìm thấy sản phẩm nào (else của if kiểm tra số lượng)
                    ?>
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                Không tìm thấy sản phẩm nào phù hợp với yêu cầu của bạn.
                            </div>
                        </div>
                    <?php 
                    } // Kết thúc if
                    ?>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Nhúng footer vào cuối trang
include_once "views/layout/footer.php";
?>