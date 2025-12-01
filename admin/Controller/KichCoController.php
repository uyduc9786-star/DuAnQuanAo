<?php
include_once("Model/KichCo.php");

class KichCoController {
    private $model;

    public function __construct() {
        $this->model = new KichCo();
    }

    public function index() {
        $listKichCo = $this->model->getAll();
        include "views/kichco/list.php";
    }

    public function create() {
        include "views/kichco/create.php";
    }

    public function store() {
        if (isset($_POST['loai_kich_co'])) {
            $this->model->insert($_POST['loai_kich_co']);
            header("Location: index.php?action=listkichco");
        }
    }

    public function edit() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $kichCo = $this->model->getOne($id);
            include "views/kichco/edit.php";
        }
    }

    public function update() {
        if (isset($_POST['id']) && isset($_POST['loai_kich_co'])) {
            $this->model->update($_POST['id'], $_POST['loai_kich_co']);
            header("Location: index.php?action=listkichco");
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $this->model->delete($_GET['id']);
            header("Location: index.php?action=listkichco");
        }
    }
}
?>