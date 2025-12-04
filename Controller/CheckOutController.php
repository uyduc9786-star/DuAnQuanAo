<?php
// Nhúng model sản phẩm vào để lấy thông tin chi tiết sản phẩm khi cần
include_once "Model/UserSanpham.php";

class CheckOutController {
    // Khai báo biến chứa đối tượng model
    private $userSanphamModel;

    // Hàm khởi tạo: Chạy ngay khi tạo mới đối tượng CheckOutController
    public function __construct() {
        // Tạo đối tượng model để dùng các hàm trong đó
        $this->userSanphamModel = new UserSanpham();
    }

    // ------------------------------------------------------------------
    // CHỨC NĂNG: THÊM SẢN PHẨM VÀO GIỎ HÀNG
    // ------------------------------------------------------------------
    public function add() {
        // Bước 1: Kiểm tra xem trên URL có ID sản phẩm không (ví dụ: index.php?act=add_to_cart&idsp=5)
        if (isset($_GET['idsp'])) {
            $idSP = $_GET['idsp']; // Lấy ID sản phẩm về

            // Bước 2: Kiểm tra xem giỏ hàng đã được tạo chưa
            if (!isset($_SESSION['cart'])) {
                // Nếu chưa có thì tạo mới một mảng rỗng
                $_SESSION['cart'] = [];
            }

            // Bước 3: Kiểm tra xem sản phẩm này ĐÃ CÓ trong giỏ hàng chưa
            $daCoTrongGio = false; // Giả sử ban đầu là chưa có

            // Duyệt qua từng món hàng đang có trong giỏ
            foreach ($_SESSION['cart'] as $key => $item) {
                // Nếu tìm thấy ID sản phẩm trong giỏ trùng với ID sản phẩm muốn thêm
                if ($item['id'] == $idSP) {
                    // Tăng số lượng lên 1
                    $_SESSION['cart'][$key]['soLuong']++;
                    $daCoTrongGio = true; // Đánh dấu là đã tìm thấy
                    break; // Thoát khỏi vòng lặp, không cần tìm nữa
                }
            }

            // Bước 4: Nếu sản phẩm CHƯA CÓ trong giỏ (sau khi đã tìm hết vòng lặp)
            if ($daCoTrongGio == false) {
                // Lấy thông tin chi tiết sản phẩm từ Database để lưu vào giỏ (tên, giá, ảnh...)
                // Gọi hàm getProductDetail bên Model
                $spInfo = $this->userSanphamModel->getProductDetail($idSP);

                // Tạo một món hàng mới
                $monHangMoi = [
                    'id' => $idSP,
                    'name' => $spInfo['ten_sp'],
                    'price' => $spInfo['gia_sp'],
                    'image' => $spInfo['hinh_anh'],
                    'soLuong' => 1 // Mặc định mua 1 cái
                ];

                // Thêm món hàng mới vào danh sách giỏ hàng
                array_push($_SESSION['cart'], $monHangMoi);
            }
            
            // Bước 5: Sau khi thêm xong, chuyển hướng người dùng đến trang xem giỏ hàng
            header("Location: index.php?act=cart");
        }
    }

    // ------------------------------------------------------------------
    // CHỨC NĂNG: HIỂN THỊ GIỎ HÀNG (Xem giỏ hàng)
    // ------------------------------------------------------------------
    public function index() {
        // Bước 1: Kiểm tra xem giỏ hàng có tồn tại không
        if (isset($_SESSION['cart'])) {
            // Giỏ hàng đã có dữ liệu trong Session rồi, không cần làm gì thêm
            // View sẽ tự lấy $_SESSION['cart'] để hiển thị
        } else {
            // Nếu chưa có giỏ hàng thì tạo mảng rỗng để View không bị lỗi
            $_SESSION['cart'] = [];
        }

        // Bước 2: Gọi giao diện hiển thị giỏ hàng
        include "views/shopping-cart.php";
    }
}
?>