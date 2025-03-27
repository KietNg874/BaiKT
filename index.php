<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'app/config/database.php';
require_once 'app/controllers/EmployeeController.php';
require_once 'app/controllers/DepartmentController.php';
require_once 'app/controllers/LoginController.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseDir = '/QL_NhanSu';
$requestUri = str_replace($baseDir, '', $requestUri);

if ($requestUri === '' || $requestUri === '/') {
    header('Location: http://localhost/QL_NhanSu/Login');
    exit;
}

$routes = [
    '/Employee/list' => ['EmployeeController', 'index'],
    '/Employee/add' => ['EmployeeController', 'add'],
    '/Employee/save' => ['EmployeeController', 'save'],
    '/Employee/edit/{maNV}' => ['EmployeeController', 'edit'],
    '/Employee/update' => ['EmployeeController', 'update'],
    '/Employee/delete/{maNV}' => ['EmployeeController', 'delete'],
    '/Department/list' => ['DepartmentController', 'list'],
    '/Login' => ['LoginController', 'index'],
    '/Login/login' => ['LoginController', 'login'],
    '/Login/logout' => ['LoginController', 'logout'],
];

$matched = false;
foreach ($routes as $route => $handler) {
    $pattern = str_replace('{maNV}', '(\w+)', $route);
    $pattern = "@^$pattern$@";
    if (preg_match($pattern, $requestUri, $matches)) {
        $matched = true;
        $controllerName = $handler[0];
        $action = $handler[1];
        $params = array_slice($matches, 1);
        $controller = new $controllerName();
        call_user_func_array([$controller, $action], $params);
        break;
    }
}

if (!$matched) {
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
}