<?php
class EmployeeModel {
    private $conn;
    private $table_name = "NHANVIEN";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getEmployees($page = 1, $perPage = 5) {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT n.MaNV, n.TenNV, n.Phai, n.NoiSinh, n.MaPhong, n.Luong, p.TenPhong 
                  FROM " . $this->table_name . " n
                  LEFT JOIN PHONGBAN p ON n.MaPhong = p.MaPhong
                  LIMIT :perPage OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTotalEmployees() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->total;
    }
    
    public function getEmployeeById($maNV) {
        $query = "SELECT MaNV, TenNV, Phai, NoiSinh, MaPhong, Luong 
                  FROM " . $this->table_name . " 
                  WHERE MaNV = :maNV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':maNV', $maNV);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function addEmployee($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong) {
        $query = "INSERT INTO " . $this->table_name . " (MaNV, TenNV, Phai, NoiSinh, MaPhong, Luong) 
                  VALUES (:maNV, :tenNV, :phai, :noiSinh, :maPhong, :luong)";
        $stmt = $this->conn->prepare($query);

        $maNV = htmlspecialchars(strip_tags($maNV));
        $tenNV = htmlspecialchars(strip_tags($tenNV));
        $phai = htmlspecialchars(strip_tags($phai));
        $noiSinh = htmlspecialchars(strip_tags($noiSinh));
        $maPhong = htmlspecialchars(strip_tags($maPhong));
        $luong = htmlspecialchars(strip_tags($luong));

        $stmt->bindParam(':maNV', $maNV);
        $stmt->bindParam(':tenNV', $tenNV);
        $stmt->bindParam(':phai', $phai);
        $stmt->bindParam(':noiSinh', $noiSinh);
        $stmt->bindParam(':maPhong', $maPhong);
        $stmt->bindParam(':luong', $luong);

        return $stmt->execute();
    }

    public function updateEmployee($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong) {
        $query = "UPDATE " . $this->table_name . " 
                  SET TenNV = :tenNV, Phai = :phai, NoiSinh = :noiSinh, 
                      MaPhong = :maPhong, Luong = :luong 
                  WHERE MaNV = :maNV";
        $stmt = $this->conn->prepare($query);

        $tenNV = htmlspecialchars(strip_tags($tenNV));
        $phai = htmlspecialchars(strip_tags($phai));
        $noiSinh = htmlspecialchars(strip_tags($noiSinh));
        $maPhong = htmlspecialchars(strip_tags($maPhong));
        $luong = htmlspecialchars(strip_tags($luong));

        $stmt->bindParam(':maNV', $maNV);
        $stmt->bindParam(':tenNV', $tenNV);
        $stmt->bindParam(':phai', $phai);
        $stmt->bindParam(':noiSinh', $noiSinh);
        $stmt->bindParam(':maPhong', $maPhong);
        $stmt->bindParam(':luong', $luong);

        return $stmt->execute();
    }

    public function deleteEmployee($maNV) {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaNV = :maNV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':maNV', $maNV);
        return $stmt->execute();
    }
}