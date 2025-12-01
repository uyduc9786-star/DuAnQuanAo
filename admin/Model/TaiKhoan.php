<?php
class TaiKhoan {
    // Hàm kiểm tra đăng nhập dành riêng cho bảng Admin
    public function check_user($user, $pass) {
        // Sửa lại câu SQL: Chọn từ bảng 'admin'
        // Cột username và password phải khớp với SQL vừa tạo ở trên
        $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
        
        // Thực thi hàm lấy 1 dòng dữ liệu
        return pdo_query_one($sql, $user, $pass);
    }
}
?>