<?php 
include_once("pdo.php");

class SanPham {

    // 1. Lấy danh sách sản phẩm đang hiển thị (trang_thai = 0)
    // Lưu ý: Sắp xếp theo id_sp giảm dần để cái mới lên đầu
    public function getAll() {
        // Kết nối 4 bảng: SanPham, DanhMuc, MauSac, KichCo
        $sql = "SELECT sp.*, 
                       dm.name_danh_muc, 
                       ms.ten_mau, 
                       kc.loai_kich_co
                FROM san_pham sp
                LEFT JOIN danh_muc dm ON sp.id_danh_muc = dm.id_danh_muc
                LEFT JOIN mau_sac ms ON sp.id_mau_sac = ms.id_mausac
                LEFT JOIN kich_co kc ON sp.id_kich_co = kc.id_kichco
                WHERE sp.trang_thai = 0
                ORDER BY sp.id_sp DESC";
                
        return pdo_query($sql);
    }

    // 2. Lấy 1 sản phẩm chi tiết để sửa
    public function getOne($id) {
        $sql = "SELECT * FROM san_pham WHERE id_sp = ?";
        return pdo_query_one($sql, $id);
    }

    // 3. Thêm mới sản phẩm (Cập nhật đủ các cột: Màu, Size, Số lượng, Loại...)
    public function insert($ten, $gia, $anh, $moTa, $idDanhMuc, $soLuong, $loai, $idMauSac, $idKichCo) {
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
                    trang_thai
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0)"; 
        // Mặc định trang_thai = 0 (Hiện)
        
        pdo_execute($sql, $ten, $gia, $anh, $moTa, $idDanhMuc, $soLuong, $loai, $idMauSac, $idKichCo);
    }

    // 4. Cập nhật sản phẩm
    public function update($id, $ten, $gia, $anh, $moTa, $idDanhMuc, $soLuong, $loai, $idMauSac, $idKichCo) {
        if($anh != "") {
            // Trường hợp 1: Có chọn ảnh mới -> Update cả ảnh
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
            // Trường hợp 2: Không chọn ảnh mới -> Giữ nguyên ảnh cũ
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

    // 5. Xóa mềm (Ẩn sản phẩm đi, set trang_thai = 1)
    public function delete($id) {
        $sql = "UPDATE san_pham SET trang_thai = 1 WHERE id_sp = ?";
        pdo_execute($sql, $id);
    }    
    
    // 6. Khôi phục sản phẩm
    public function restore($id) {
        $sql = "UPDATE san_pham SET trang_thai = 0 WHERE id_sp = ?";
        pdo_execute($sql, $id);
    }
}
?>