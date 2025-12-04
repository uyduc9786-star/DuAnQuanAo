<?php
// Nhúng file kết nối CSDL
include_once "pdo.php"; 

class UserSanpham {
    
    // ------------------------------------------------------------------
    // 1. HÀM LẤY SẢN PHẨM MỚI NHẤT (Để hiện ở trang chủ)
    // ------------------------------------------------------------------
    public function getNewArrivals() {
        // Logic: Sản phẩm mới là sản phẩm có ID lớn nhất (mới thêm vào sau cùng)
        // trang_thai = 1: Chỉ lấy sản phẩm đang được bán (không bị ẩn)
        // LIMIT 8: Chỉ lấy 8 cái để hiển thị cho đẹp
        $sql = "SELECT * FROM san_pham WHERE trang_thai = 1 ORDER BY id_sp DESC LIMIT 8";
        
        // Trả về danh sách 8 sản phẩm mới nhất
        return pdo_query($sql);
    }

    // ------------------------------------------------------------------
    // 2. HÀM LẤY SẢN PHẨM BÁN CHẠY NHẤT (Để hiện ở trang chủ)
    // ------------------------------------------------------------------
    public function getBestSellers() {
        // Logic: Phải tính tổng số lượng đã bán trong bảng 'chi_tiet_hoa_don'
        // Sau đó sắp xếp giảm dần (DESC) theo tổng số lượng đó
        $sql = "SELECT 
                    sp.*,                  -- Lấy thông tin sản phẩm
                    SUM(ct.so_luong) as tong_ban -- Tính tổng số lượng đã bán
                FROM san_pham sp 
                JOIN chi_tiet_hoa_don ct ON sp.id_sp = ct.id_sanpham 
                WHERE sp.trang_thai = 1    -- Chỉ lấy sp đang hoạt động
                GROUP BY sp.id_sp          -- Gom nhóm theo từng sản phẩm
                ORDER BY tong_ban DESC     -- Sắp xếp cái nào bán nhiều nhất lên đầu
                LIMIT 8";                  
        
        return pdo_query($sql);
    }

    // ------------------------------------------------------------------
    // 3. HÀM LẤY TẤT CẢ SẢN PHẨM CHO TRANG CỬA HÀNG (CÓ CHỨC NĂNG LỌC)
    // ------------------------------------------------------------------
    public function getAllShop($categoryId = 0, $minPrice = 0, $maxPrice = 0, $keyword = "") {
        // Khởi tạo câu lệnh SQL cơ bản: Lấy tất cả sản phẩm đang hoạt động
        $sql = "SELECT * FROM san_pham WHERE trang_thai = 1";
        
        // -- BẮT ĐẦU GHÉP CÁC ĐIỀU KIỆN LỌC --

        // 1. Nếu người dùng chọn lọc theo Danh mục (categoryId > 0)
        if ($categoryId > 0) {
            $sql = $sql . " AND id_danh_muc = " . $categoryId;
        }

        // 2. Nếu người dùng chọn lọc theo Giá (maxPrice > 0)
        if ($maxPrice > 0) {
            // BETWEEN: Lấy giá nằm trong khoảng từ min đến max
            $sql = $sql . " AND gia_sp BETWEEN " . $minPrice . " AND " . $maxPrice;
        }

        // 3. Nếu người dùng nhập Từ khóa tìm kiếm
        if ($keyword != "") {
            // LIKE: Tìm sản phẩm có tên CHỨA từ khóa đó
            $sql = $sql . " AND ten_sp LIKE '%" . $keyword . "%'";
        }

        // -- KẾT THÚC LỌC --

        // Cuối cùng: Sắp xếp sản phẩm mới nhất lên đầu
        $sql = $sql . " ORDER BY id_sp DESC";
        
        // Thực thi câu lệnh SQL hoàn chỉnh và trả về kết quả
        return pdo_query($sql);
    }

    // ------------------------------------------------------------------
    // 4. HÀM LẤY DANH SÁCH DANH MỤC (Để hiển thị bên cột trái trang Shop)
    // ------------------------------------------------------------------
    public function getAllCategories() {
        // Lấy tất cả danh mục đang hoạt động (Trangthai = 1)
        $sql = "SELECT * FROM danh_muc WHERE Trangthai = 1 ORDER BY id_danh_muc DESC";
        return pdo_query($sql);
    }
    
    // ------------------------------------------------------------------
    // 5. HÀM LẤY CHI TIẾT 1 SẢN PHẨM (Để hiện ở trang Chi tiết sản phẩm)
    // ------------------------------------------------------------------
    public function getProductDetail($id) {
        // Lấy thông tin của sản phẩm có ID trùng với ID truyền vào
        $sql = "SELECT * FROM san_pham WHERE id_sp = ?";
        return pdo_query_one($sql, $id);
    }
    
    // ------------------------------------------------------------------
    // 6. CÁC HÀM PHỤ TRỢ: LẤY DANH SÁCH MÀU VÀ SIZE
    // ------------------------------------------------------------------
    
    // Lấy toàn bộ bảng màu sắc
    public function getAllMau() { 
        return pdo_query("SELECT * FROM mau_sac"); 
    }

    // Lấy toàn bộ bảng kích cỡ
    public function getAllSize() { 
        return pdo_query("SELECT * FROM kich_co"); 
    }
}
?>