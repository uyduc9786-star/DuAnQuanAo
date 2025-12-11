<?php 
include_once("pdo.php");

class SanPham {

    // 1. Lấy danh sách sản phẩm ĐANG HIỆN (trang_thai = 1)
    // 1. Lấy danh sách sản phẩm ĐANG HIỆN (trang_thai = 1)
    public function getAll() {
        // SỬA LẠI TÊN CỘT Ở ĐÂY:
        // ms.id_mausac (viết liền, không gạch dưới)
        // kc.id_kichco (viết liền, không gạch dưới)
        
        $sql = "SELECT sp.*, 
                       dm.name_danh_muc, 
                       ms.ten_mau, 
                       kc.loai_kich_co
                FROM san_pham sp
                LEFT JOIN danh_muc dm ON sp.id_danh_muc = dm.id_danh_muc
                LEFT JOIN mau_sac ms ON sp.id_mau_sac = ms.id_mausac
                LEFT JOIN kich_co kc ON sp.id_kich_co = kc.id_kichco
                ORDER BY sp.id_sp DESC";
                
        return pdo_query($sql);
    }

    // 2. Lấy 1 sản phẩm chi tiết để sửa
    public function getOne($id) {
        $sql = "SELECT * FROM san_pham WHERE id_sp = ?";
        return pdo_query_one($sql, $id);
    }

    // 3. Thêm mới sản phẩm
    public function insert($ten, $gia, $anh, $moTa, $idDanhMuc, $soLuong, $loai, $idMauSac, $idKichCo) {
        // SỬA: Mặc định thêm vào là trang_thai = 1 (Hiện)
        $sql = "INSERT INTO san_pham (
                    ten_sp, 
                    gia_sp, 
                    hinh_anh, 
                    Mo_ta, 
                    id_danh_muc, 
                    so_luong, 
                    loai, 
                    id_mau_sac, 
                    id_kich_co, 
                    trang_thai,
                    luot_xem
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 0)"; 
        
        pdo_execute($sql, $ten, $gia, $anh, $moTa, $idDanhMuc, $soLuong, $loai, $idMauSac, $idKichCo);
    }

    // 4. Cập nhật sản phẩm
    public function update($id, $ten, $gia, $anh, $moTa, $idDanhMuc, $soLuong, $loai, $idMauSac, $idKichCo) {
        if($anh != "") {
            // Có thay ảnh
            $sql = "UPDATE san_pham SET 
                    ten_sp = ?, 
                    gia_sp = ?, 
                    hinh_anh = ?, 
                    Mo_ta = ?, 
                    id_danh_muc = ?, 
                    so_luong = ?, 
                    loai = ?, 
                    id_mau_sac = ?, 
                    id_kich_co = ? 
                    WHERE id_sp = ?";
            pdo_execute($sql, $ten, $gia, $anh, $moTa, $idDanhMuc, $soLuong, $loai, $idMauSac, $idKichCo, $id);
        } else {
            // Không thay ảnh
            $sql = "UPDATE san_pham SET 
                    ten_sp = ?, 
                    gia_sp = ?, 
                    Mo_ta = ?, 
                    id_danh_muc = ?, 
                    so_luong = ?, 
                    loai = ?, 
                    id_mau_sac = ?, 
                    id_kich_co = ? 
                    WHERE id_sp = ?";
            pdo_execute($sql, $ten, $gia, $moTa, $idDanhMuc, $soLuong, $loai, $idMauSac, $idKichCo, $id);
        }
    }

    // 5. Xóa mềm (SỬA: Set trang_thai = 0 để ẩn đi)
    public function delete($id) {
        $sql = "UPDATE san_pham SET trang_thai = 0 WHERE id_sp = ?";
        pdo_execute($sql, $id);
    }    
    
    // 6. Khôi phục sản phẩm (SỬA: Set trang_thai = 1 để hiện lại)
    public function restore($id) {
        $sql = "UPDATE san_pham SET trang_thai = 1 WHERE id_sp = ?";
        pdo_execute($sql, $id);
    }
}
?>