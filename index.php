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

    if ($url[1] === 'register' || $url[1] === 'login'|| $url[1] === 'logout') {
        $apiController = new AuthApiController();

        if ($url[1] === 'register' && $method === 'POST') {
            $apiController->register();
        }elseif ($url[1] === 'login' && $method === 'POST') {
            $apiController->login();
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
        exit;
    }
    
    // Định tuyến API khác (ShoeApiController, UserApiController,...)
    $apiControllerName = ucfirst($url[1]) . 'ApiController';
    $controllerPath = 'app/controllers/' . $apiControllerName . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        $controller = new $apiControllerName();

        $resource = $url[1]; // e.g., "shoes"
        $actionParam = $url[2] ?? null;

        // Handle search via query param
        if ($method === 'GET' && $actionParam === 'search') {
            $query = $_GET['q'] ?? '';
            $controller->search($query);
            exit;
        }

        switch ($method) {
            case 'GET':
                if (!$actionParam) {
                    $controller->index(); // /api/shoes
                } else {
                    $controller->show($actionParam); // /api/shoes/{id}
                }
                break;

            case 'POST':
                if (!$actionParam) {
                    $controller->store(); // /api/shoes
                } else {
                    $controller->edit($actionParam); // /api/shoes/{id}
                }
                break;

            case 'DELETE':
                if ($actionParam) {
                    $controller->destroy($actionParam); // /api/shoes/{id}
                } else {
                    methodNotAllowed();
                }
                break;

            default:
                methodNotAllowed();
        }
        exit;

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

// Helper for Method Not Allowed
function methodNotAllowed() {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
}