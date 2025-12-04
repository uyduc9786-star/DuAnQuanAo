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
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863981044336!2d105.74459841476343!3d21.038127792835514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2zVHLGsOG7nW5nIENhbyDEk-G6sW5nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1647683936634!5m2!1svi!2s" 
    height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Thông tin</span>
                        <h2>Liên hệ với chúng tôi</h2>
                        <p>Như bạn có thể mong đợi về một cửa hàng thời trang nam cao cấp, chúng tôi luôn chú trọng đến từng chi tiết.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>Hà Nội</h4>
                            <p>Tòa nhà FPT Polytechnic, Phố Trịnh Văn Bô, Nam Từ Liêm <br />+84 982-314-0958</p>
                        </li>
                        <li>
                            <h4>Hồ Chí Minh</h4>
                            <p>109 Đường Nguyễn Huệ, Quận 1 <br />+84 345-423-9893</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Họ và tên">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Email">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Nội dung tin nhắn"></textarea>
                                <button type="submit" class="site-btn">Gửi tin nhắn</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once "views/layout/footer.php";
?>