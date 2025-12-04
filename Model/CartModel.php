<?php
// Nhúng file kết nối CSDL vào để sử dụng các hàm pdo_execute, pdo_query...
include_once "Model/pdo.php";

class CartModel {

    // ------------------------------------------------------------------
    // 1. HÀM TẠO HÓA ĐƠN MỚI (Lưu thông tin người mua vào bảng hoadon)
    // ------------------------------------------------------------------
    public function createOrder($ho_ten, $sdt, $dia_chi, $tong_tien, $pttt) {
        // Chuẩn bị câu lệnh SQL để thêm mới một dòng vào bảng 'hoadon'
        // Các dấu ? là nơi sẽ điền dữ liệu vào sau này để tránh bị hack SQL Injection
        // NOW() là hàm của SQL lấy thời gian hiện tại
        $sql = "INSERT INTO hoadon (
                    id_khachhang, 
                    ho_ten, 
                    sdt, 
                    dia_chi, 
                    tongtien, 
                    hinh_thuc_thanh_toan, 
                    ngay_dat, 
                    trang_thai
                ) VALUES (
                    0,  -- ID khách hàng = 0 vì đây là khách vãng lai (không đăng nhập)
                    ?,  -- Họ tên người nhận
                    ?,  -- Số điện thoại
                    ?,  -- Địa chỉ giao hàng
                    ?,  -- Tổng tiền đơn hàng
                    ?,  -- Phương thức thanh toán (COD hoặc Chuyển khoản)
                    NOW(), -- Ngày giờ đặt hàng (lấy giờ hiện tại của server)
                    'Mới' -- Trạng thái mặc định của đơn hàng mới
                )";
        
        // Thực thi câu lệnh SQL và lấy về ID của hóa đơn vừa tạo
        // (Ví dụ: Hóa đơn số 105) -> Cần ID này để lưu chi tiết sản phẩm ở bước sau
        return pdo_execute_return_id($sql, $ho_ten, $sdt, $dia_chi, $tong_tien, $pttt);
    }

    // ------------------------------------------------------------------
    // 2. HÀM LƯU CHI TIẾT SẢN PHẨM (Lưu từng món hàng vào bảng chi_tiet_hoa_don)
    // ------------------------------------------------------------------
    public function createOrderDetail($id_hoadon, $id_sanpham, $gia, $so_luong, $mau, $size) {
        // Câu lệnh SQL để thêm sản phẩm vào chi tiết hóa đơn
        $sql = "INSERT INTO chi_tiet_hoa_don (
                    id_hoadon, 
                    id_sanpham, 
                    gia, 
                    so_luong, 
                    mau, 
                    size
                ) VALUES (
                    ?, -- ID hóa đơn vừa tạo ở trên
                    ?, -- ID sản phẩm
                    ?, -- Giá bán tại thời điểm mua
                    ?, -- Số lượng khách mua
                    ?, -- Màu sắc khách chọn
                    ?  -- Size khách chọn
                )";
        
        // Thực thi câu lệnh (Hàm này chỉ thực thi, không cần trả về dữ liệu gì cả)
        pdo_execute($sql, $id_hoadon, $id_sanpham, $gia, $so_luong, $mau, $size);
    }

    // ------------------------------------------------------------------
    // 3. HÀM TRA CỨU ĐƠN HÀNG THEO SỐ ĐIỆN THOẠI
    // ------------------------------------------------------------------
    public function getOrdersByPhone($sdt) {
        // Câu lệnh SQL: Chọn tất cả từ bảng hoadon
        // Điều kiện WHERE: Số điện thoại phải bằng số người dùng nhập
        // ORDER BY id_hoadon DESC: Sắp xếp đơn mới nhất lên đầu
        $sql = "SELECT * FROM hoadon WHERE sdt = ? ORDER BY id_hoadon DESC";
        
        // Thực thi và trả về danh sách các hóa đơn tìm được (dạng mảng)
        return pdo_query($sql, $sdt);
    }

    // ------------------------------------------------------------------
    // 4. HÀM LẤY DANH SÁCH SẢN PHẨM CỦA MỘT ĐƠN HÀNG CỤ THỂ
    // ------------------------------------------------------------------
    public function getBillDetail($id_hoadon) {
        // Câu lệnh này nối 2 bảng lại với nhau:
        // 1. Bảng 'chi_tiet_hoa_don' (ct): Để lấy số lượng, giá, màu, size
        // 2. Bảng 'san_pham' (sp): Để lấy Tên sản phẩm và Ảnh sản phẩm
        $sql = "SELECT 
                    ct.*,        -- Lấy hết thông tin trong bảng chi tiết
                    sp.ten_sp,   -- Lấy thêm tên sản phẩm
                    sp.hinh_anh  -- Lấy thêm ảnh sản phẩm
                FROM chi_tiet_hoa_don ct 
                JOIN san_pham sp ON ct.id_sanpham = sp.id_sp 
                WHERE ct.id_hoadon = ?"; // Điều kiện: Lấy theo ID hóa đơn
        
        // Trả về danh sách các sản phẩm trong đơn hàng đó
        return pdo_query($sql, $id_hoadon);
    }
    
    // ------------------------------------------------------------------
    // 5. HÀM LẤY THÔNG TIN CỦA 1 HÓA ĐƠN (Để xem người nhận, địa chỉ...)
    // ------------------------------------------------------------------
    public function getOneBill($id_hoadon) {
        // Lấy duy nhất 1 dòng từ bảng hóa đơn theo ID
        $sql = "SELECT * FROM hoadon WHERE id_hoadon = ?";
        
        // pdo_query_one: Trả về 1 dòng dữ liệu (không phải mảng danh sách)
        return pdo_query_one($sql, $id_hoadon);
    }
}
?>