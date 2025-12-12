<?php
include_once("Model/TaiKhoan.php");

class TaiKhoanController {
    private $model;

    public function __construct() {
        $this->model = new TaiKhoan();
    }

    // 1. Hiển thị form đăng nhập
    public function login() {
        // Đường dẫn tới file view login mới sửa ở trên
        include "views/auth/login.php";
    }

    // 2. Xử lý khi ấn nút Đăng nhập
    public function checkLogin() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $user = $_POST['username'];
            $pass = $_POST['password'];

            // Gọi model check
            $result = $this->model->check_user($user, $pass);

            if(is_array($result)) {
                // Đăng nhập thành công -> Lưu vào SESSION
                $_SESSION['admin_login'] = $result;
                
                // Chuyển hướng vào trang chính (Dashboard)
                header("Location: index.php");
            } else {
                // Đăng nhập thất bại -> Báo lỗi
                $error_login = "Sai tài khoản hoặc mật khẩu!";
                include "views/auth/login.php";
            }
        }
    }

    // 3. Đăng xuất
    public function logout() {
        // Xóa session
        if(isset($_SESSION['admin_login'])){
            unset($_SESSION['admin_login']);
        }
        // Chuyển về trang login
        header("Location: index.php");
    }
}
?>