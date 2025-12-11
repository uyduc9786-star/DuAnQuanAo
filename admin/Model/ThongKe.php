<?php
class ThongKe {
    
    // 1. Hàm doanh thu (Giữ nguyên)
    public function load_thongke_doanhthu($ngay_bat_dau, $ngay_ket_thuc) {
        $sql = "SELECT DATE(ngay_dat) as ngay, ";
        $sql .= "COUNT(id_hoadon) as so_luong_don, ";
        $sql .= "SUM(tongtien) as doanh_thu ";
        $sql .= "FROM hoadon ";
        $sql .= "WHERE trang_thai != 'Đã hủy' ";
        $sql .= "AND DATE(ngay_dat) >= '$ngay_bat_dau' ";
        $sql .= "AND DATE(ngay_dat) <= '$ngay_ket_thuc' ";
        $sql .= "GROUP BY DATE(ngay_dat) ";
        $sql .= "ORDER BY DATE(ngay_dat) ASC";
        return pdo_query($sql);
    }

    // 2. Hàm danh mục (SỬA LỖI ĐẾM SẢN PHẨM ĐÃ XÓA TẠI ĐÂY)
    public function load_thongke_sanpham_danhmuc() {
        $sql = "SELECT dm.id_danh_muc AS id, ";
        $sql .= "dm.name_danh_muc AS name, ";
        
        // Vẫn giữ DISTINCT để không bị đếm trùng khi join bảng hóa đơn
        $sql .= "COUNT(DISTINCT sp.id_sp) as countSp, "; 
        
        $sql .= "MIN(sp.gia_sp) as minPrice, ";
        $sql .= "MAX(sp.gia_sp) as maxPrice, ";
        $sql .= "AVG(sp.gia_sp) as avgPrice, ";
        
        $sql .= "SUM(ct.so_luong * sp.gia_sp) as totalRevenue "; 

        $sql .= "FROM danh_muc dm ";
        
        // --- QUAN TRỌNG: THÊM ĐIỀU KIỆN 'trang_thai = 1' VÀO ĐÂY ---
        // Nghĩa là: Chỉ lấy những sản phẩm đang hiện (trang_thai = 1)
        // Những cái đã xóa (trang_thai = 0) sẽ bị loại ra khỏi phép đếm
        $sql .= "LEFT JOIN san_pham sp ON dm.id_danh_muc = sp.id_danh_muc AND sp.trang_thai = 1 ";
        
        $sql .= "LEFT JOIN chi_tiet_hoa_don ct ON sp.id_sp = ct.id_sanpham ";

        $sql .= "GROUP BY dm.id_danh_muc, dm.name_danh_muc ";
        $sql .= "ORDER BY countSp DESC"; 
        
        return pdo_query($sql);
    }
    
    // 3. Hàm doanh thu gần đây (Giữ nguyên)
    public function load_doanhthu_ganday() {
         $sql = "SELECT DATE(ngay_dat) as ngay, SUM(tongtien) as doanh_thu ";
         $sql .= "FROM hoadon WHERE trang_thai != 'Đã hủy' ";
         $sql .= "GROUP BY DATE(ngay_dat) ";
         $sql .= "ORDER BY DATE(ngay_dat) DESC "; 
         $sql .= "LIMIT 5"; 
         return pdo_query($sql);
    }
}
?>