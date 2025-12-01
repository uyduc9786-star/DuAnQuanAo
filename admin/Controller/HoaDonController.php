<?php
include_once "Model/HoaDon.php";

class HoaDonController {
    private $hoaDonModel;

    public function __construct() {
        $this->hoaDonModel = new HoaDon();
    }

    // Hiển thị danh sách đơn hàng
    public function index() {
        $listHoaDon = $this->hoaDonModel->getAllOrders();
        include "views/hoadon/list.php";
    }

    // Xem chi tiết đơn hàng
    public function detail() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // 1. Lấy thông tin người mua
            $order = $this->hoaDonModel->getOrderById($id);
            // 2. Lấy danh sách sản phẩm họ mua
            $orderDetails = $this->hoaDonModel->getOrderDetail($id);
            
            include "views/hoadon/detail.php";
        }
    }

    // Cập nhật trạng thái
    public function update_status() {
        if (isset($_POST['id']) && isset($_POST['trang_thai'])) {
            $id = $_POST['id'];
            $status = $_POST['trang_thai'];
            $this->hoaDonModel->updateStatus($id, $status);
            
            // Quay lại trang chi tiết
            header("Location: index.php?action=listhoadon");
        }
    }
}
?>