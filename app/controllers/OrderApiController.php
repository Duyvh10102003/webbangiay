<?php
require_once "app/models/OrderModel.php";

class OrderApiController
{
    private $orderModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->orderModel = new OrderModel($this->db);
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
    // header("Content-Type: application/json");
    // session_start();

    // if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    //     echo json_encode(["status" => "error", "message" => "Cart is empty"]);
    //     return;
    // }

    // $user_id = $_POST['user_id'] ?? null;
    // if (!$user_id) {
    //     echo json_encode(["status" => "error", "message" => "Missing user_id"]);
    //     return;
    // }

    // // Lấy sản phẩm từ giỏ hàng
    // $items = $_SESSION['cart'];

    // // Lưu đơn hàng vào database
    // $result = $this->orderModel->createOrder($user_id, $items);

    // if ($result["status"] === "success") {
    //     $_SESSION['cart'] = []; // Xóa giỏ hàng sau khi đặt hàng thành công
    // }

    // echo json_encode($result);

    header("Content-Type: application/json");
    session_start();

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

}
