<?php

class CartController {
    public function add() {
        if(isset($_GET['idsp'])) {
            $idSP = $_GET['idsp'];
            if(!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            $tonTaiSP = false;
            foreach($_SESSION['cart'] as $key => $item) {
                if($item['id'] == $idSP) {
                    $_SESSION['cart'][$key]['soLuong']++;
                    $tonTaiSP = true;
                    break;
                }
                if () {

                }
            }
            $_SESSION['cart'] = [
                "id"=> $idSP,
                "soLuong" => 1
            ];
        }
    }
    public function index() {
        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $key => $item) {
                $sanPhamDetall = $this -> cartModel -> getAllProductById($item['id']);
                $_SESSION['cart'][$key]['name'] = $sanPhamDetall['name'];
                $_SESSION['cart'][$key]['price'] = $sanPhamDetall['price'];
                $_SESSION['cart'][$key]['image'] = $sanPhamDetall['image'];

            }
        }
        else {
            $_SESSION['cart'] = [];
        }
    }

}



?>