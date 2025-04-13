<?php
require_once "app/models/OrderModel.php";
require_once 'app/config/database.php';
class OrderApiController
{
    private $orderModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->orderModel = new OrderModel($this->db);
    }

    public function manageOrderAdmin()
    {
        header('Content-Type: application/json');
        $order = $this->orderModel->manageOrder();

        if ($order) {
            echo json_encode($order);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Order not found']);
        }
    }
    // Lấy danh sách đơn hàng của một user
    public function index()
    {
        header("Content-Type: application/json");
        $user_id = $_GET['user_id'] ?? null;
        if (!$user_id) {
            echo json_encode(["status" => "error", "message" => "Missing user_id"]);
            return;
        }
        $orders = $this->orderModel->getOrdersByUser($user_id);
        echo json_encode($orders);
    }

    // Lấy chi tiết đơn hàng
    public function show($order_id)
    {
        header("Content-Type: application/json");
        $order = $this->orderModel->getOrderDetails($order_id);
        echo json_encode($order);
    }
    public function store()
    {
        header("Content-Type: application/json");
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Lấy dữ liệu từ JSON request
        $data = json_decode(file_get_contents("php://input"), true);

        $user_id = $data['user_id'] ?? null;
        $items = $data['cart'] ?? [];

        if (!$user_id || empty($items)) {
            echo json_encode(["status" => "error", "message" => "Thiếu thông tin đơn hàng"]);
            return;
        }

        // Gọi model để tạo đơn hàng
        $result = $this->orderModel->createOrder($user_id, $items);

        if ($result["status"] === "success") {
            $_SESSION['cart'] = []; // Xóa giỏ hàng sau khi đặt hàng thành công
        }

        echo json_encode($result);
    }

    // POST: /order/pay
    public function payOrder() {
        // Lấy JSON từ request body
        $data = json_decode(file_get_contents("php://input"), true);
        $orderId = $data['order_id'] ?? null;

        if (!$orderId) {
            echo json_encode(['success' => false, 'message' => 'Order ID is required']);
            return;
        }

        $success = $this->orderModel->payOrder($orderId);
        echo json_encode(['success' => $success]);
    }
    public function destroy($order_id)
{
    header('Content-Type: application/json');

    $result = $this->orderModel->deleteOrder($order_id);

    echo json_encode($result);
}
}
