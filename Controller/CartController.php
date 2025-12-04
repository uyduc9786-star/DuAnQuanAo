<?php
// Nhúng các file Model cần thiết để xử lý dữ liệu
include_once "Model/UserSanpham.php"; // Model lấy thông tin sản phẩm
include_once "Model/CartModel.php";   // Model xử lý đơn hàng (lưu hóa đơn)

class CartController {
    // Khai báo 2 thuộc tính để chứa đối tượng Model
    private $userSanpham;
    private $cartModel;

    // Hàm khởi tạo (Chạy ngay khi Controller được gọi)
    public function __construct() {
        $this->userSanpham = new UserSanpham();
        $this->cartModel = new CartModel();
        
        // Kiểm tra xem giỏ hàng đã tồn tại chưa
        // Nếu chưa có thì tạo mới một mảng rỗng để chứa sản phẩm
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // ----------------------------------------------------------------
    // 1. CHỨC NĂNG: XEM CHI TIẾT SẢN PHẨM
    // ----------------------------------------------------------------
    public function detail() {
        // Bước 1: Kiểm tra xem trên URL có ID sản phẩm không (ví dụ: &id=10)
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id']; // Lấy ID từ URL về
            
            // Bước 2: Gọi Model để lấy thông tin chi tiết của sản phẩm đó
            $sp = $this->userSanpham->getProductDetail($id);
            
            // Bước 3: Lấy danh sách Màu và Size từ Database để hiện ra Form cho khách chọn
            $dsMau = $this->userSanpham->getAllMau();
            $dsSize = $this->userSanpham->getAllSize();
            
            // Bước 4: Gửi các dữ liệu này sang giao diện (View) để hiển thị
            include "views/shop-details.php";
        } else {
            // Nếu không có ID thì đuổi về trang chủ
            header("Location: index.php");
        }
    }

    // ----------------------------------------------------------------
    // 2. CHỨC NĂNG: THÊM VÀO GIỎ HÀNG
    // ----------------------------------------------------------------
    public function addToCart() {
        // Kiểm tra xem người dùng có bấm nút "Thêm vào giỏ" không
        if (isset($_POST['add_to_cart'])) {
            
            // Bước 1: Lấy dữ liệu từ Form gửi lên
            $id = $_POST['id_sp'];
            $ten = $_POST['ten_sp'];
            $gia = $_POST['gia_sp'];
            $img = $_POST['hinh_anh'];
            
            // Kiểm tra số lượng, nếu không nhập thì mặc định là 1
            if (isset($_POST['quantity'])) {
                $soluong = (int)$_POST['quantity'];
            } else {
                $soluong = 1;
            }

            // Kiểm tra màu sắc và kích cỡ
            if (isset($_POST['mau'])) {
                $mau = $_POST['mau'];
            } else {
                $mau = 'Mặc định';
            }

            if (isset($_POST['size'])) {
                $size = $_POST['size'];
            } else {
                $size = 'F'; // Free size
            }

            // Bước 2: Tạo một cái Mã (Key) duy nhất cho sản phẩm trong giỏ
            // Ví dụ: sanpham_10_Do_XL (ID 10, Màu Đỏ, Size XL)
            // Để phân biệt: Áo đỏ khác với Áo xanh
            $key = $id . '_' . $mau . '_' . $size;

            // Bước 3: Kiểm tra xem sản phẩm này đã có trong giỏ hàng chưa
            if (isset($_SESSION['cart'][$key])) {
                // Nếu có rồi -> Chỉ cần tăng số lượng lên
                $_SESSION['cart'][$key]['so_luong'] += $soluong;
            } else {
                // Nếu chưa có -> Thêm mới vào mảng giỏ hàng
                $_SESSION['cart'][$key] = [
                    'id' => $id,
                    'ten' => $ten,
                    'gia' => $gia,
                    'img' => $img,
                    'so_luong' => $soluong,
                    'mau' => $mau,
                    'size' => $size
                ];
            }
            
            // Bước 4: Chuyển hướng người dùng sang trang xem giỏ hàng
            header("Location: index.php?act=cart"); 
        }
    }

    // ----------------------------------------------------------------
    // 3. CHỨC NĂNG: XEM GIỎ HÀNG
    // ----------------------------------------------------------------
    public function viewCart() {
        // Chỉ đơn giản là gọi giao diện giỏ hàng ra
        // Dữ liệu giỏ hàng nằm trong $_SESSION['cart'] rồi nên View tự lấy được
        include "views/shopping-cart.php";
    }

    // ----------------------------------------------------------------
    // 4. CHỨC NĂNG: XÓA SẢN PHẨM KHỎI GIỎ
    // ----------------------------------------------------------------
    public function deleteItem() {
        // Kiểm tra xem trên URL có key sản phẩm cần xóa không
        if (isset($_GET['key'])) {
            $key = $_GET['key'];
            
            // Dùng hàm unset để xóa phần tử đó khỏi session
            unset($_SESSION['cart'][$key]);
        }
        // Xóa xong thì quay lại trang giỏ hàng
        header("Location: index.php?act=cart");
    }

    // ----------------------------------------------------------------
    // 5. CHỨC NĂNG: TRANG THANH TOÁN (CHECKOUT)
    // ----------------------------------------------------------------
    public function checkout() {
        // Gọi giao diện nhập thông tin thanh toán
        include "views/checkout.php";
    }

    // ----------------------------------------------------------------
    // 6. CHỨC NĂNG: XỬ LÝ ĐẶT HÀNG (LƯU VÀO DB)
    // ----------------------------------------------------------------
    public function placeOrder() {
        // Kiểm tra người dùng có bấm nút ĐẶT HÀNG không
        // Và giỏ hàng phải có sản phẩm thì mới cho đặt
        if (isset($_POST['site-btn']) && !empty($_SESSION['cart'])) {
            
            // Bước 1: Lấy thông tin người nhận từ Form
            $ho_ten = $_POST['ho_ten'];
            $dia_chi = $_POST['dia_chi'];
            $sdt = $_POST['sdt'];
            
            // Kiểm tra phương thức thanh toán
            if (isset($_POST['payment_method'])) {
                $pttt = $_POST['payment_method'];
            } else {
                $pttt = 'COD'; // Mặc định là Tiền mặt
            }
            
            // Bước 2: Tính tổng tiền đơn hàng
            $tong_tien = 0;
            foreach ($_SESSION['cart'] as $item) {
                // Thành tiền = Giá x Số lượng
                $thanhTien = $item['gia'] * $item['so_luong'];
                $tong_tien += $thanhTien;
            }

            // Bước 3: Lưu thông tin chung vào bảng 'hoadon'
            // Hàm này sẽ trả về ID của hóa đơn vừa tạo (ví dụ: Đơn hàng số 15)
            $id_hoadon = $this->cartModel->createOrder($ho_ten, $sdt, $dia_chi, $tong_tien, $pttt);

            // Bước 4: Lưu chi tiết từng món hàng vào bảng 'chi_tiet_hoa_don'
            foreach ($_SESSION['cart'] as $item) {
                $this->cartModel->createOrderDetail(
                    $id_hoadon,       // ID hóa đơn vừa tạo ở trên
                    $item['id'],      // ID sản phẩm
                    $item['gia'],     // Giá lúc mua
                    $item['so_luong'],// Số lượng mua
                    $item['mau'],     // Màu sắc
                    $item['size']     // Kích cỡ
                );
            }

            // Bước 5: Xóa sạch giỏ hàng sau khi đặt thành công
            unset($_SESSION['cart']);

            // Bước 6: Thông báo cho khách và quay về trang chủ
            echo "<script>
                alert('Đặt hàng thành công! Mã đơn hàng của bạn là: #$id_hoadon');
                window.location.href='index.php';
            </script>";

        } else {
            // Nếu giỏ hàng trống mà cố tình vào đặt hàng
            echo "<script>alert('Giỏ hàng trống!'); window.location.href='index.php?act=shop';</script>";
        }
    }

    // ----------------------------------------------------------------
    // 7. CHỨC NĂNG: TRA CỨU ĐƠN HÀNG (KHÁCH VÃNG LAI)
    // ----------------------------------------------------------------
    public function checkOrder() {
        $orders = [];  // Biến chứa danh sách đơn hàng tìm được
        $message = ""; // Biến chứa thông báo lỗi (nếu có)
        
        // Kiểm tra xem người dùng có bấm nút "Tra cứu" không
        if (isset($_POST['btn_check'])) {
            $sdt = $_POST['sdt']; // Lấy số điện thoại người dùng nhập
            
            // Nếu số điện thoại không được để trống
            if (!empty($sdt)) {
                // Gọi Model để tìm các đơn hàng có SĐT này
                $orders = $this->cartModel->getOrdersByPhone($sdt);
                
                // Nếu tìm xong mà danh sách vẫn rỗng -> Không có đơn nào
                if (empty($orders)) {
                    $message = "Không tìm thấy đơn hàng nào với số điện thoại này.";
                }
            } else {
                $message = "Vui lòng nhập số điện thoại.";
            }
        }
        // Hiện giao diện tra cứu kèm kết quả
        include "views/check_order.php";
    }

    // ----------------------------------------------------------------
    // 8. CHỨC NĂNG: XEM CHI TIẾT LỊCH SỬ ĐƠN HÀNG
    // ----------------------------------------------------------------
    public function historyDetail() {
        // Kiểm tra xem trên URL có ID hóa đơn không
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id_hoadon = $_GET['id'];
            
            // Lấy thông tin chung của hóa đơn (Tên người nhận, địa chỉ...)
            $bill = $this->cartModel->getOneBill($id_hoadon);
            
            // Lấy danh sách sản phẩm trong hóa đơn đó
            $billDetail = $this->cartModel->getBillDetail($id_hoadon);
            
            // Hiện giao diện chi tiết
            include "views/history_detail.php";
        } else {
            // Nếu không có ID thì quay lại trang tra cứu
            header("Location: index.php?act=check_order");
        }
    }
    public function updateCart() {
        if (isset($_GET['key']) && isset($_GET['type'])) {
            $key = $_GET['key'];
            $type = $_GET['type'];

            if (isset($_SESSION['cart'][$key])) {
                if ($type == 'increase') {
                    // Nếu là tăng -> cộng thêm 1
                    $_SESSION['cart'][$key]['so_luong']++;
                } else if ($type == 'decrease') {
                    // Nếu là giảm
                    if ($_SESSION['cart'][$key]['so_luong'] > 1) {
                        // Nếu số lượng > 1 thì trừ đi 1
                        $_SESSION['cart'][$key]['so_luong']--;
                    } else {
                        // Nếu số lượng đang là 1 mà bấm giảm -> Xóa luôn sản phẩm
                        unset($_SESSION['cart'][$key]);
                    }
                }
            }
        }
        // Quay lại trang giỏ hàng
        header("Location: index.php?act=cart");
    }
}
?>