<?php
require_once('app/config/database.php');
require_once('app/models/EmployeeModel.php');
require_once('app/models/DepartmentModel.php');

class EmployeeController {
    private $employeeModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->employeeModel = new EmployeeModel($this->db);
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;
        $employees = $this->employeeModel->getEmployees($page, $perPage);
        $totalEmployees = $this->employeeModel->getTotalEmployees();
        $totalPages = ceil($totalEmployees / $perPage);
        include 'app/views/employee/list.php';
    }

    public function add() {
        $departments = (new DepartmentModel($this->db))->getDepartments();
        include 'app/views/employee/add.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maNV = $_POST['maNV'] ?? '';
            $tenNV = $_POST['tenNV'] ?? '';
            $phai = $_POST['phai'] ?? '';
            $noiSinh = $_POST['noiSinh'] ?? '';
            $maPhong = $_POST['maPhong'] ?? '';
            $luong = $_POST['luong'] ?? '';

            if ($this->employeeModel->addEmployee($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong)) {
                header('Location: /QL_NhanSu/Employee/list');
            } else {
                echo "Failed to add employee.";
            }
        }
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maNV = $_POST['maNV'];
            $tenNV = $_POST['tenNV'];
            $phai = $_POST['phai'];
            $noiSinh = $_POST['noiSinh'];
            $maPhong = $_POST['maPhong'];
            $luong = $_POST['luong'];

            if ($this->employeeModel->updateEmployee($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong)) {
                header('Location: /QL_NhanSu/Employee/list');
            } else {
                echo "Failed to update employee.";
            }
        }
    }

    public function edit($maNV) {
        $employee = $this->employeeModel->getEmployeeById($maNV);
        $departments = (new DepartmentModel($this->db))->getDepartments();
        include 'app/views/employee/edit.php';
    }

    public function delete($maNV) {
        $employee = $this->employeeModel->getEmployeeById($maNV);
        if ($employee) {
            if ($this->employeeModel->deleteEmployee($maNV)) {
                header('Location: /QL_NhanSu/Employee/list');
            } else {
                echo "Failed to delete employee.";
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "Employee not found";
        }
    }
}