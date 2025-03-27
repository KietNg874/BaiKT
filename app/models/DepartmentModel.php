<?php
class DepartmentModel {
    private $conn;
    private $table_name = "PHONGBAN";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getDepartments() {
        $query = "SELECT MaPhong, TenPhong FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}