<?php
include_once("Model/MauSac.php");

class MauSacController {
    private $model;

    public function __construct() {
        $this->model = new MauSac();
    }

    public function index() {
        $listMauSac = $this->model->getAll();
        include "views/mausac/list.php";
    }

    // Hiển thị form thêm mới
    public function create() {
        include "views/mausac/create.php";
    }

    // Lưu dữ liệu thêm mới
    public function store() {
        if (isset($_POST['ten_mau'])) {
            $tenMau = $_POST['ten_mau'];
            $this->model->insert($tenMau);
            header("Location: index.php?action=listmausac");
        }
    }

    // Hiển thị form sửa
    public function edit() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $mauSac = $this->model->getOne($id);
            include "views/mausac/edit.php";
        }
    }

    // Lưu dữ liệu cập nhật
    public function update() {
        if (isset($_POST['id']) && isset($_POST['ten_mau'])) {
            $id = $_POST['id'];
            $tenMau = $_POST['ten_mau'];
            $this->model->update($id, $tenMau);
            header("Location: index.php?action=listmausac");
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->delete($id);
            header("Location: index.php?action=listmausac");
        }
    }
    public function restore() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->restore($id);
            // Khôi phục xong quay lại trang list
            header("Location:index.php?action=listmausac");
        }
    }
}
?>