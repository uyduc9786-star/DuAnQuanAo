<?php
require_once "pdo.php"; // Gọi file kết nối DB của bạn

class HoaDon {
    // Lấy tất cả danh sách hóa đơn
    public function getAllOrders() {
        $sql = "SELECT * FROM hoadon ORDER BY id_hoadon DESC";
        return pdo_query($sql);
    }

    // Lấy thông tin 1 hóa đơn theo ID
    public function getOrderById($id) {
        $sql = "SELECT * FROM hoadon WHERE id_hoadon = " . $id;
        return pdo_query_one($sql);
    }

    // Lấy chi tiết sản phẩm trong hóa đơn (Kèm tên SP và Ảnh)
    public function getOrderDetail($id_hoadon) {
        // Join bảng chi tiết với bảng sản phẩm để lấy tên và ảnh
        $sql = "SELECT ct.*, sp.ten_sp, sp.hinh_anh 
                FROM chi_tiet_hoa_don ct 
                JOIN san_pham sp ON ct.id_sanpham = sp.id_sp 
                WHERE ct.id_hoadon = " . $id_hoadon;
        return pdo_query($sql);
    }

    // Cập nhật trạng thái đơn hàng (Ví dụ: Chờ xử lý -> Đang giao)
    public function updateStatus($id, $status) {
        $sql = "UPDATE hoadon SET trang_thai = '$status' WHERE id_hoadon = " . $id;
        pdo_execute($sql);
    }
}
?>