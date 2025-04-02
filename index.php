<?php
session_start();
require_once 'app/models/ShoesModel.php';
require_once 'app/controllers/ShoeApiController.php';
require_once 'app/controllers/AuthApiController.php';
// Start session

$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);
// Kiểm tra phần đầu tiên của URL để xác định controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' :'DefaultController';
// Kiểm tra phần thứ hai của URL để xác định action
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Định tuyến các yêu cầu API
if ($url[0] === 'api') {
    $method = $_SERVER['REQUEST_METHOD'];

    if ($url[1] === 'register' || $url[1] === 'login') {
        $apiController = new AuthApiController();

        if ($url[1] === 'register' && $method === 'POST') {
            $apiController->register();
        } elseif ($url[1] === 'login' && $method === 'POST') {
            $apiController->login();
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
        exit;
    }

    // Định tuyến API khác (ShoeApiController, UserApiController,...)
$apiControllerName = ucfirst($url[1]) . 'ApiController';
if (file_exists('app/controllers/' . $apiControllerName . '.php')) {
    require_once 'app/controllers/' . $apiControllerName . '.php';
    $controller = new $apiControllerName();
    $id = $url[2] ?? null;
    $search = $_GET['search'] ?? null; // Lấy tham số search nếu có

    switch ($method) {
        case 'GET': 
            if ($search) {
                $action = 'search'; // Nếu có tham số search thì gọi action search
            } else {
                $action = $id ? 'show' : 'index';
            }
            break;
        case 'POST': 
            $action = 'store';
            break;
        case 'PUT': 
            $action = $id ? 'update' : null;
            break;
        case 'DELETE': 
            $action = $id ? 'destroy' : null;
            break;
        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
            exit;
    }

    // Gọi phương thức search và truyền tham số search vào
    if ($action && method_exists($controller, $action)) {
        if ($action === 'search') {
            // Truyền tham số search vào phương thức search
            call_user_func_array([$controller, $action], [$search]);
        } else {
            call_user_func_array([$controller, $action], $id ? [$id] : []);
        }
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Action not found']);
    }
    exit;
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Controller not found']);
    exit;
}
}
