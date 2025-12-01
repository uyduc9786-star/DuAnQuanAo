<?php
class ThongKe {
    public function load_thongke_sanpham_danhmuc() {
        // SQL chuẩn dựa trên ảnh bảng san_pham và danh_muc bạn gửi
        $sql = "SELECT dm.id_danh_muc AS id, 
                       dm.name_danh_muc AS name, 
                       COUNT(sp.id_sp) as countSp, 
                       MIN(sp.gia_sp) as minPrice, 
                       MAX(sp.gia_sp) as maxPrice, 
                       AVG(sp.gia_sp) as avgPrice";
        
        // Nối bảng danh_muc với san_pham qua id_danh_muc
        $sql .= " FROM danh_muc dm LEFT JOIN san_pham sp ON dm.id_danh_muc = sp.id_danh_muc";
        
        // Nhóm lại theo danh mục
        $sql .= " GROUP BY dm.id_danh_muc, dm.name_danh_muc";
        
        // Sắp xếp danh mục mới nhất lên đầu
        $sql .= " ORDER BY dm.id_danh_muc DESC";
        
        return pdo_query($sql);
    }
}
?>