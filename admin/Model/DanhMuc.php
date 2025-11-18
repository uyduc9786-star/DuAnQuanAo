<?php 
include_once("pdo.php");

class DanhMuc {
    public function getAll() {
        $sql = "select * from danh_muc";
        return pdo_query($sql);
    }

    public function insert($ten) {
        $sql = "insert into danh_muc (name_danh_muc) values (?)";
        pdo_execute($sql, $ten);
    }

    public function getOne($id) {
        $sql = "select * from danh_muc where id_danh_muc = ?";
        return pdo_query_one($sql, $id);
    }

    public function update($id, $ten) {
        $sql = "update danh_muc set `name_danh_muc` = ? where id_danh_muc = ?";
        pdo_execute($sql, $ten, $id);
    }

    
    public function delete($id) {
        $sql = "update danh_muc set Trangthai = 1 where id_danh_muc = ?";
        pdo_execute($sql, $id);
    }    
    public function restore($id) {
        $sql = "update danh_muc set Trangthai = 0 where id_danh_muc = ?";
        pdo_execute($sql, $id);
    }
}

?>