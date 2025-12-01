<?php
include_once("Model/SanPham.php");
include_once("Model/DanhMuc.php"); // Nhớ include cả Model DanhMuc

class SanPhamController
{
    private $sanPham;
    private $danhMuc;

    public function __construct()
    {
        $this->sanPham = new SanPham();
        $this->danhMuc = new DanhMuc();
    }

    // --- HIỂN THỊ DANH SÁCH ---
    public function index()
    {
        // Gọi hàm getAll mới đã có đủ thông tin
        $allSanPham = $this->sanPham->getAll();
        
        include_once("./views/sanpham/list.php");
    }

    public function create()
    {
        $allDanhMuc = $this->danhMuc->getAll();
        // Cần load thêm màu sắc, kích cỡ để hiển thị option chọn (nếu có bảng màu/size riêng)
        include_once("./views/sanpham/create.php");
    }

    // --- THÊM MỚI (STORE) ---
    public function store() {
        if(isset($_POST['ten'])) {
            $ten = $_POST['ten'];
            $gia = $_POST['gia'];
            $moTa = $_POST['mota'];
            $idDanhMuc = $_POST['danhmuc'];
            
            $soLuong = $_POST['so_luong'] ?? 0;
            $loai = $_POST['loai'] ?? 'Thường'; 
            $idMauSac = $_POST['id_mau_sac'] ?? 0;
            $idKichCo = $_POST['id_kich_co'] ?? 0;

            // --- ĐOẠN SỬA LẠI ---
            $imageName = ""; 
            if(isset($_FILES['anh']) && $_FILES['anh']['size'] > 0) {
                // 1. Tạo tên file riêng (không kèm 'image/')
                $filename = uniqid() . "_" . $_FILES['anh']['name'];
                
                // 2. Định nghĩa nơi upload file đến (Thư mục vật lý)
                // Lưu ý: Code đang chạy tại index.php nên đường dẫn là image/
                $target_dir = "image/";
                $target_file = $target_dir . $filename;
                
                // 3. Di chuyển file
                if (move_uploaded_file($_FILES['anh']['tmp_name'], $target_file)){
                    // 4. CHỈ LƯU TÊN FILE VÀO DATABASE (Quan trọng)
                    $imageName = $filename; 
                }
            }
            // --------------------

            $this->sanPham->insert($ten, $gia, $imageName, $moTa, $idDanhMuc, $soLuong, $loai, $idMauSac, $idKichCo);
            
            header("Location:index.php?action=listsanpham"); 
        }
    }

    public function edit() {
        if(isset($_GET['id'])) {
            $allDanhMuc = $this->danhMuc->getAll();
            $id = $_GET['id'];
            $sanPham = $this->sanPham->getOne($id);
            include_once("./views/sanpham/edit.php");
        }
    }

    // --- CẬP NHẬT (UPDATE) ---
    public function update() {
        if(isset($_POST['id'])) { 
            $id = $_POST['id'];
            $ten = $_POST['ten'];
            $gia = $_POST['gia'];
            $moTa = $_POST['mota'];
            $idDanhMuc = $_POST['danhmuc'];
            
            $soLuong = $_POST['so_luong'] ?? 0;
            $loai = $_POST['loai'] ?? 'Thường';
            $idMauSac = $_POST['id_mau_sac'] ?? 0;
            $idKichCo = $_POST['id_kich_co'] ?? 0;

            // --- ĐOẠN SỬA LẠI ---
            $imageName = ""; 
            // Lấy lại ảnh cũ trước (để nếu không up ảnh mới thì giữ nguyên)
            $spCu = $this->sanPham->getOne($id);
            $imageName = $spCu['hinh_anh']; 

            if(isset($_FILES['anh']) && $_FILES['anh']['name'] != '') {
                // 1. Tạo tên file mới
                $filename = uniqid() . "_" . $_FILES['anh']['name'];
                $target_dir = "image/";
                $target_file = $target_dir . $filename;

                if(move_uploaded_file($_FILES['anh']['tmp_name'], $target_file)){
                     // 2. Cập nhật tên ảnh mới để lưu vào DB
                    $imageName = $filename;

                    // 3. Xóa ảnh cũ (Cần thêm đường dẫn image/ vào để unlink tìm thấy file)
                    $old_file_path = "image/" . $spCu['hinh_anh'];
                    if($spCu['hinh_anh'] && file_exists($old_file_path)) {
                        unlink($old_file_path);
                    }
                }
            }
            // --------------------

            $this->sanPham->update($id, $ten, $gia, $imageName, $moTa, $idDanhMuc, $soLuong, $loai, $idMauSac, $idKichCo);
            
            header("Location:index.php?action=listsanpham");
        }
    }

    public function delete() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->sanPham->delete($id);
            header("Location:index.php?action=listsanpham");
        }
    }

    public function restore() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->sanPham->restore($id); // Đã có hàm restore bên Model
            header("Location:index.php?action=listsanpham");
        }
    }
}
?>