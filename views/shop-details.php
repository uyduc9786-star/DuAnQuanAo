<?php 
// ------------------------------------------------------------------
// PHẦN 1: NHÚNG HEADER VÀ CHUẨN BỊ DỮ LIỆU
// ------------------------------------------------------------------

// Nhúng file header (chứa menu, logo, css...) vào trang
include_once "views/layout/header.php"; 

// Chú thích: Biến $sp, $dsSize, $dsMau đã được Controller truyền sang trước khi include file này.
// $sp: Mảng chứa thông tin chi tiết sản phẩm (tên, giá, mô tả...)
// $dsSize: Mảng danh sách các size lấy từ database
// $dsMau: Mảng danh sách các màu lấy từ database
?>

<style>
    /* CSS cho các ô chọn Size và Màu (Dạng nút bấm hình chữ nhật) */
    .product__details__option__size label,
    .product__details__option__color label {
        display: inline-block;      /* Để các ô nằm ngang hàng nhau */
        padding: 10px 20px;         /* Khoảng cách từ chữ ra viền */
        margin-right: 10px;         /* Khoảng cách giữa các ô */
        margin-bottom: 10px;        /* Khoảng cách dòng */
        border: 1px solid #e5e5e5;  /* Viền xám nhạt mặc định */
        color: #111111;             /* Chữ màu đen */
        font-size: 14px;            /* Cỡ chữ */
        font-weight: 700;           /* Chữ đậm */
        text-transform: capitalize; /* Viết hoa chữ cái đầu (vd: đỏ -> Đỏ) */
        cursor: pointer;            /* Con trỏ chuột biến thành bàn tay */
        border-radius: 2px;         /* Bo góc nhẹ */
        min-width: 60px;            /* Chiều rộng tối thiểu */
        text-align: center;         /* Căn giữa chữ */
        background: #fff;           /* Nền trắng */
        
        /* Quan trọng: Để xử lý các lớp đè lên nhau */
        position: relative;         
        z-index: 1;
    }

    /* Hiệu ứng khi ô được chọn (Active) */
    .product__details__option__size label.active,
    .product__details__option__color label.active {
        background: #111111 !important;       /* Đổi nền thành đen */
        color: #ffffff !important;            /* Đổi chữ thành trắng */
        border: 1px solid #111111 !important; /* Đổi viền thành đen */
        
        /* Tắt hết các hiệu ứng bóng mờ lạ (nếu có từ giao diện gốc) */
        box-shadow: none !important;
        outline: none !important;
    }

    /* Ẩn các phần tử giả (::before, ::after) của template gốc để tránh lỗi hiển thị */
    .product__details__option__size label::before,
    .product__details__option__size label::after,
    .product__details__option__color label::before,
    .product__details__option__color label::after {
        display: none !important;
        content: none !important;
        opacity: 0 !important;
        border: none !important;
    }

    /* Ẩn nút tròn (radio input) mặc định của trình duyệt */
    .product__details__option__size input,
    .product__details__option__color input {
        display: none !important; 
    }

    /* CSS cho tiêu đề "Size:", "Màu:" */
    .product__details__option__size span,
    .product__details__option__color span {
        color: #111111;
        font-weight: 700;
        margin-right: 10px;
        display: inline-block;
        min-width: 50px;
    }
    
    /* Khoảng cách giữa phần chọn Màu và phần bên trên */
    .product__details__option__color {
        margin-top: 20px;
        margin-bottom: 25px;
    }
</style>

<section class="shop-details">
    
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                <div class="product__thumb__pic set-bg" data-setbg="admin/image/<?= $sp['hinh_anh'] ?>"></div>
                            </a>
                        </li>
                        </ul>
                </div>
                
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="admin/image/<?= $sp['hinh_anh'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        
                        <h4><?= $sp['ten_sp'] ?></h4>
                        
                        <h3><?= number_format($sp['gia_sp']) ?> đ</h3>
                        
                        <p><?= $sp['Mo_ta'] ?></p>
                        
                        <form action="index.php?act=add_to_cart" method="post">
                            
                            <input type="hidden" name="id_sp" value="<?= $sp['id_sp'] ?>">
                            <input type="hidden" name="ten_sp" value="<?= $sp['ten_sp'] ?>">
                            <input type="hidden" name="gia_sp" value="<?= $sp['gia_sp'] ?>">
                            <input type="hidden" name="hinh_anh" value="<?= $sp['hinh_anh'] ?>">

                            <div class="product__details__option">
                                
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    
                                    <?php 
                                    // Duyệt qua danh sách Size lấy từ Database
                                    // $i là số thứ tự (0, 1, 2...), $size là dữ liệu của từng dòng
                                    foreach($dsSize as $i => $size) {
                                        
                                        // Kiểm tra xem tên cột trong DB là 'ten_kich_co' hay 'loai_kich_co'
                                        // Để tránh lỗi nếu tên cột khác nhau
                                        if(isset($size['ten_kich_co'])) {
                                            $tenSize = $size['ten_kich_co'];
                                        } else {
                                            $tenSize = $size['loai_kich_co'];
                                        }
                                        
                                        // Kiểm tra: Nếu là phần tử đầu tiên ($i == 0) thì thêm class 'active' để chọn sẵn
                                        if ($i == 0) {
                                            $classActive = 'active';
                                            $checked = 'checked';
                                        } else {
                                            $classActive = '';
                                            $checked = '';
                                        }
                                    ?>
                                        <label for="size-<?= $i ?>" class="<?= $classActive ?>">
                                            <?= $tenSize ?>
                                            <input type="radio" id="size-<?= $i ?>" name="size" 
                                                   value="<?= $tenSize ?>" <?= $checked ?>
                                                   onchange="updateActiveState(this)">
                                        </label>
                                    <?php 
                                    } // Kết thúc vòng lặp foreach Size
                                    ?>
                                </div>

                                <div class="product__details__option__color">
                                    <span>Màu:</span>
                                    
                                    <?php 
                                    // Duyệt qua danh sách Màu lấy từ Database
                                    foreach($dsMau as $i => $mau) {
                                        
                                        // Kiểm tra: Nếu là phần tử đầu tiên thì chọn sẵn
                                        if ($i == 0) {
                                            $classActive = 'active';
                                            $checked = 'checked';
                                        } else {
                                            $classActive = '';
                                            $checked = '';
                                        }
                                    ?>
                                        <label for="color-<?= $i ?>" class="<?= $classActive ?>">
                                            <?= $mau['ten_mau'] ?>
                                            <input type="radio" id="color-<?= $i ?>" name="mau" 
                                                   value="<?= $mau['ten_mau'] ?>" <?= $checked ?>
                                                   onchange="updateActiveState(this)">
                                        </label>
                                    <?php 
                                    } // Kết thúc vòng lặp foreach Màu
                                    ?>
                                </div>
                            </div>

                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="quantity" value="1">
                                    </div>
                                </div>
                                <button type="submit" name="add_to_cart" class="primary-btn">Thêm vào giỏ</button>
                            </div>
                        </form>
                        <div class="product__details__last__option">
                            <ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Hàm này sẽ chạy khi người dùng bấm chọn một ô Size hoặc Màu
    function updateActiveState(element) {
        // element: chính là cái nút input radio vừa được bấm
        
        // 1. Tìm thẻ cha bao quanh các lựa chọn (div chứa các label)
        // closest('div') nghĩa là tìm ngược lên trên xem thẻ div nào gần nhất đang chứa nút này
        var parentDiv = element.closest('div');
        
        // 2. Tìm tất cả các thẻ label đang nằm trong thẻ cha đó
        var labels = parentDiv.querySelectorAll('label');
        
        // 3. Chạy vòng lặp qua từng label để XÓA class 'active' (trở về màu trắng)
        labels.forEach(function(l) {
            l.classList.remove('active');
        });
        
        // 4. Thêm class 'active' (màu đen) cho cái label chứa nút vừa bấm
        // parentElement chính là thẻ label bao quanh cái input
        element.parentElement.classList.add('active');
    }
</script>

<?php 
// Nhúng footer vào cuối trang
include_once "views/layout/footer.php"; 
?>