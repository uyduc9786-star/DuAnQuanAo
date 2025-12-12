<?php
class ThongKe {
    
    // 1. Hàm thống kê doanh thu (Chỉ lấy Đã giao)
    public function load_thongke_doanhthu($ngay_bat_dau, $ngay_ket_thuc) {
        $sql = "SELECT 
                    DATE(ngay_dat) as ngay, 
                    COUNT(id_hoadon) as so_luong_don, 
                    SUM(tongtien) as doanh_thu 
                FROM hoadon 
                WHERE trang_thai LIKE '%Đã giao%' 
                AND DATE(ngay_dat) >= '$ngay_bat_dau' 
                AND DATE(ngay_dat) <= '$ngay_ket_thuc' 
                GROUP BY DATE(ngay_dat) 
                ORDER BY DATE(ngay_dat) ASC";
        return pdo_query($sql);
    }

    // 2. Hàm thống kê danh mục (Dùng Subquery để tính tiền CHÍNH XÁC TUYỆT ĐỐI)
    public function load_thongke_sanpham_danhmuc($ngay_bat_dau, $ngay_ket_thuc) {
        $sql = "SELECT 
                    danh_muc.id_danh_muc AS id, 
                    danh_muc.name_danh_muc AS name, 
                    
                    -- Đếm số lượng sản phẩm (Dùng DISTINCT để không đếm trùng)
                    COUNT(DISTINCT san_pham.id_sp) AS countSp, 
                    
                    -- TÍNH TỔNG TIỀN TRỰC TIẾP (Dùng hàm SUM kết hợp điều kiện)
                    -- Logic: Nếu đơn Đã giao và đúng ngày thì cộng tiền, ngược lại thì cộng 0  
                    COALESCE(SUM(
                        CASE 
                            WHEN hoadon.trang_thai LIKE '%Đã giao%' 
                                AND DATE(hoadon.ngay_dat) >= '$ngay_bat_dau' 
                                AND DATE(hoadon.ngay_dat) <= '$ngay_ket_thuc' 
                            THEN chi_tiet_hoa_don.so_luong * chi_tiet_hoa_don.gia 
                            ELSE 0 
                        END
                    ), 0) AS totalRevenue 

                FROM danh_muc 
                
                -- Nối bảng Sản phẩm (Chỉ lấy SP đang hoạt động)
                LEFT JOIN san_pham 
                    ON danh_muc.id_danh_muc = san_pham.id_danh_muc 
                    AND san_pham.trang_thai = 1 
                
                -- Nối bảng Chi tiết hóa đơn
                LEFT JOIN chi_tiet_hoa_don 
                    ON san_pham.id_sp = chi_tiet_hoa_don.id_sanpham 
                
                -- Nối bảng Hóa đơn (Để lấy ngày và trạng thái)
                LEFT JOIN hoadon 
                    ON chi_tiet_hoa_don.id_hoadon = hoadon.id_hoadon

                GROUP BY danh_muc.id_danh_muc, danh_muc.name_danh_muc 
                ORDER BY totalRevenue DESC";
        
        return pdo_query($sql);
    }
    
    // 3. Hàm Doanh thu gần đây (Sidebar)
    public function load_doanhthu_ganday() {
         $sql = "SELECT 
                    DATE(ngay_dat) as ngay, 
                    SUM(tongtien) as doanh_thu 
                 FROM hoadon 
                 WHERE trang_thai LIKE '%Đã giao%' 
                 GROUP BY DATE(ngay_dat) 
                 ORDER BY DATE(ngay_dat) DESC 
                 LIMIT 5";
         return pdo_query($sql);
    }
}
?>