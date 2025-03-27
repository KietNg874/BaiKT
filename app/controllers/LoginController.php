<?php
require_once 'app/config/database.php';
require_once 'app/models/UserModel.php';

class LoginController {
    private $userModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    public function index() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /QL_NhanSu/Employee/list');
            exit;
        }
        include 'app/views/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->getUserByUsername($username);
            if ($user && $user->password === $password) {
                $_SESSION['user_id'] = $user->Id;
                $_SESSION['username'] = $user->username;
                $_SESSION['role'] = $user->role;
                header('Location: /QL_NhanSu/Employee/list');
                exit;
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
                include 'app/views/login.php';
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /QL_NhanSu/Login');
        exit;
    }
}