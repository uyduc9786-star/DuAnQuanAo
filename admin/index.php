<?php
include_once("Controller/DanhMucController.php");
include_once("Controller/SanPhamController.php");

$danhMuc = new DanhMucController();
$sanPham = new SanPhamController();
if(isset($_GET['action']) && $_GET['action'] != "") {
$action = $_GET['action'];
    switch($action) {
        //danhmuc
        case "listdanhmuc":
            $danhMuc->index();
            break;
        case "createdanhmuc":
            $danhMuc->create();
            break;
        case "storedanhmuc":
            $danhMuc->store();
            break;
        case "editdanhmuc":
            $danhMuc->edit();
            break;
        case "updatedanhmuc":
            $danhMuc->update();
            break;
        case "deletedanhmuc":
            $danhMuc->delete();
            break;
        case "restoredanhmuc":
            $danhMuc->restore();
            break;
        case "listsanpham":
            $sanPham->index();
            break;
        case "createsanpham":
            $sanPham->create();
            break;
        case "storesanpham":
            $sanPham->store();
            break;
        case "editsanpham":
            $sanPham->edit();
            break;
        case "updatesanpham":
            $sanPham->update();
            break;
        case "deletesanpham":
            $sanPham->delete();
            break;
        case "restoresanpham":
            $sanPham->restore();
            break;
    }
} else {
    $danhMuc->index();
}

?>