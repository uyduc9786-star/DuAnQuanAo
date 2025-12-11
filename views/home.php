<?php
// Nhúng header vào trang
include_once "views/layout/header.php";
?>

<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Bộ sưu tập mùa hè</h6>
                            <h2>Bộ sưu tập Thu - Đông 2030</h2>
                            <p>Một nhãn hiệu chuyên sản xuất các mặt hàng xa xỉ thiết yếu. Được chế tác có đạo đức với cam kết không ngừng về chất lượng vượt trội.</p>
                            <a href="index.php?act=shop" class="primary-btn">Mua ngay <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Bộ sưu tập mùa hè</h6>
                            <h2>Bộ sưu tập Thu - Đông 2030</h2>
                            <p>Một nhãn hiệu chuyên sản xuất các mặt hàng xa xỉ thiết yếu. Được chế tác có đạo đức với cam kết không ngừng về chất lượng vượt trội.</p>
                            <a href="index.php?act=shop" class="primary-btn">Mua ngay <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Bộ sưu tập quần áo 2030</h2>
                        <a href="index.php?act=shop">Mua ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Phụ kiện</h2>
                        <a href="index.php?act=shop">Mua ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-3.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Giày mùa xuân 2030</h2>
                        <a href="index.php?act=shop">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Tất cả</li>
                    <li data-filter=".hot-sales">Bán chạy</li>
                    <li data-filter=".new-arrivals">Hàng mới về</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            
            <?php 
            // Kiểm tra biến $bestSellerProducts có tồn tại và có dữ liệu hay không
            if (isset($bestSellerProducts) && is_array($bestSellerProducts) && count($bestSellerProducts) > 0) {
                
                // Bắt đầu vòng lặp foreach thuần để duyệt qua từng sản phẩm
                foreach ($bestSellerProducts as $sp) {
                    
                    // Tách mảng $sp thành các biến riêng lẻ ($id_sp, $ten_sp, $gia_sp...) cho dễ gọi
                    extract($sp);

                    // Xử lý đường dẫn ảnh: Nếu ảnh rỗng thì gán ảnh mặc định
                    if (!empty($hinh_anh)) {
                        $hinhPath = "admin/image/" . $hinh_anh;
                    } else {
                        $hinhPath = "admin/image/default.jpg"; 
                    }

                    // Tạo đường dẫn chi tiết sản phẩm
                    $linkDetail = "index.php?act=detail&id=" . $id_sp;
            ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                        <div class="product__item">
                            
                            <div class="product__item__pic set-bg" data-setbg="<?= $hinhPath ?>" 
                                 onclick="window.location.href='<?= $linkDetail ?>';" 
                                 style="cursor: pointer;">
                                
                                <span class="label">Hot</span> 
                            </div>
                            
                            <div class="product__item__text">
                                <h6><?= $ten_sp ?></h6>
                                
                                <form action="index.php?act=add_to_cart" method="post" style="display: inline;">
                                    <input type="hidden" name="id_sp" value="<?= $id_sp ?>">
                                    <input type="hidden" name="ten_sp" value="<?= $ten_sp ?>">
                                    <input type="hidden" name="gia_sp" value="<?= $gia_sp ?>">
                                    <input type="hidden" name="hinh_anh" value="<?= $hinh_anh ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="mau" value="Mặc định">
                                    <input type="hidden" name="size" value="F">
                                    
                                    <button type="submit" name="add_to_cart" class="add-cart" 
                                            style="border: none; background: none; color: #e53637; font-weight: 700; cursor: pointer; text-transform: uppercase; letter-spacing: 2px;">
                                        + Thêm vào giỏ
                                    </button>
                                </form>
                                <div class="rating">
                                    
                                
                                </div>
                                <h5><?= number_format($gia_sp, 0, ',', '.') ?> đ</h5>
                            </div>
                        </div>
                    </div>
            <?php 
                } // Kết thúc vòng lặp foreach bán chạy
            } // Kết thúc if kiểm tra
            ?>

            <?php 
            // Kiểm tra biến $newProducts có tồn tại và có dữ liệu hay không
            if (isset($newProducts) && is_array($newProducts) && count($newProducts) > 0) {
                
                // Bắt đầu vòng lặp foreach thuần
                foreach ($newProducts as $sp) {
                    
                    extract($sp);
                    
                    // Xử lý đường dẫn ảnh
                    if (!empty($hinh_anh)) {
                        $hinhPath = "admin/image/" . $hinh_anh;
                    } else {
                        $hinhPath = "admin/image/default.jpg";
                    }

                    $linkDetail = "index.php?act=detail&id=" . $id_sp;
            ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                        <div class="product__item">
                            
                            <div class="product__item__pic set-bg" data-setbg="<?= $hinhPath ?>" 
                                 onclick="window.location.href='<?= $linkDetail ?>';" 
                                 style="cursor: pointer;">
                                
                                <span class="label">New</span>
                            </div>
                            
                            <div class="product__item__text">
                                <h6><?= $ten_sp ?></h6>
                                
                                <form action="index.php?act=add_to_cart" method="post" style="display: inline;">
                                    <input type="hidden" name="id_sp" value="<?= $id_sp ?>">
                                    <input type="hidden" name="ten_sp" value="<?= $ten_sp ?>">
                                    <input type="hidden" name="gia_sp" value="<?= $gia_sp ?>">
                                    <input type="hidden" name="hinh_anh" value="<?= $hinh_anh ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="mau" value="Mặc định">
                                    <input type="hidden" name="size" value="F">
                                    
                                    <button type="submit" name="add_to_cart" class="add-cart" 
                                            style="border: none; background: none; color: #e53637; font-weight: 700; cursor: pointer; text-transform: uppercase; letter-spacing: 2px;">
                                        + Thêm vào giỏ
                                    </button>
                                </form>

                                <div class="rating">
                                    

                                </div>
                                <h5><?= number_format($gia_sp, 0, ',', '.') ?> đ</h5>
                            </div>
                        </div>
                    </div>
            <?php 
                } // Kết thúc vòng lặp foreach mới về
            } // Kết thúc if kiểm tra
            ?>

        </div>
    </div>
</section>
<?php
// Nhúng footer vào cuối trang
include_once "views/layout/footer.php";
?>