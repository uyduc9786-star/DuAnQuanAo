<?php
class MauSac {
    // Lấy tất cả màu
    public function getAll() {
        $sql = "SELECT * FROM mau_sac ORDER BY id_mausac DESC";
        return pdo_query($sql);
    }

    // Lấy 1 màu theo ID (để sửa)
    public function getOne($id) {
        $sql = "SELECT * FROM mau_sac WHERE id_mausac = ?";
        return pdo_query_one($sql, $id);
    }

    // Thêm mới
    public function insert($tenMau) {
        $sql = "INSERT INTO mau_sac(ten_mau) VALUES(?)";
        pdo_execute($sql, $tenMau);
    }

    // Cập nhật
    public function update($id, $tenMau) {
        $sql = "UPDATE mau_sac SET ten_mau = ? WHERE id_mausac = ?";
        pdo_execute($sql, $tenMau, $id);
    }

    // Xóa (Lưu ý: Nếu xóa màu đang dùng cho SP thì có thể lỗi khóa ngoại, 
    // nhưng ở mức cơ bản ta cứ làm xóa thường)
    public function delete($id) {
        $sql = "DELETE FROM mau_sac WHERE id_mausac = ?";
        pdo_execute($sql, $id);
    }
}
?>