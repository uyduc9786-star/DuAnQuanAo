<?php
include_once("Model/ThongKe.php"); // Gọi Model vào

class ThongKeController {
    public function index() {
        // Khởi tạo model
        $thongKeModel = new ThongKe();
        
        // Lấy dữ liệu từ model
        $listThongKe = $thongKeModel->load_thongke_sanpham_danhmuc();
        
        // Gọi view để hiển thị
        include "views/thongke/list.php";
    }
}
?>