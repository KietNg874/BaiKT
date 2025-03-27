<?php
require_once 'app/config/database.php';
require_once 'app/models/DepartmentModel.php';

class DepartmentController {
    private $departmentModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->departmentModel = new DepartmentModel($this->db);
    }
}