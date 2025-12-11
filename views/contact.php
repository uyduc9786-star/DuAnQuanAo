<?php
include_once "views/layout/header.php";
?>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Liên hệ</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <span>Liên hệ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="map">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3728.3501908295625!2d106.70275521476016!3d20.85292698609503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7a9c2647d347%3A0xc3f14667d4681614!2zVHLGsOG7nW5nIENhbyDEkS4gRlBUIFBvbHl0ZWNobmlj!5e0!3m2!1svi!2s!4v1679021305417!5m2!1svi!2s" 
        height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>

<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Thông tin</span>
                        <h2>Liên hệ với chúng tôi</h2>
                        <p>Cửa hàng thời trang nam uy tín dành cho sinh viên.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>Hải Phòng (Trụ sở chính)</h4>
                            <p>271 Lê Thánh Tông, Máy Chai, Ngô Quyền, Hải Phòng <br />+84 982-314-0958</p>
                        </li>
                        <li>
                            <h4>Email hỗ trợ</h4>
                            <p>davidsever2022@gmail.com</p>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <div style="background: #f3f2ee; padding: 30px; text-align: center;">
                        <h3>Gửi Email Trực Tiếp</h3>
                        <p style="margin-bottom: 20px;">Nhấn nút bên dưới để gửi email trực tiếp cho quản trị viên.</p>
                        
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=davidsever2022@gmail.com&su=Liên hệ từ Web Bán Quần Áo&body=Chào Admin, tôi cần hỗ trợ vấn đề này:" 
                                target="_blank" 
                                class="site-btn" 
                                style="display: inline-block; text-decoration: none; color: white;">
                                    Gửi Email qua Gmail <i class="fa fa-google"></i>
                        </a>
                        
                        <p style="margin-top: 20px; font-size: 14px; color: #888;">
                            (Hệ thống sẽ tự động mở ứng dụng Email trên máy của bạn)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once "views/layout/footer.php";
?>