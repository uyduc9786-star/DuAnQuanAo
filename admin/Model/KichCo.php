<?php
class KichCo {
    public function getAll() {
        $sql = "SELECT * FROM kich_co ORDER BY id_kichco DESC";
        return pdo_query($sql);
    }

    public function getOne($id) {
        $sql = "SELECT * FROM kich_co WHERE id_kichco = ?";
        return pdo_query_one($sql, $id);
    }

    public function insert($tenKichCo) {
        $sql = "INSERT INTO kich_co(loai_kich_co) VALUES(?)";
        pdo_execute($sql, $tenKichCo);
    }

    public function update($id, $tenKichCo) {
        $sql = "UPDATE kich_co SET loai_kich_co = ? WHERE id_kichco = ?";
        pdo_execute($sql, $tenKichCo, $id);
    }

    public function delete($id) {
        $sql = "DELETE FROM kich_co WHERE id_kichco = ?";
        pdo_execute($sql, $id);
    }
}
?>