<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class CartApiController
{
    // Lấy danh sách sản phẩm trong giỏ hàng (GET /api/cart)
    public function index()
    {
        header("Content-Type: application/json");
        echo json_encode(["status" => "success", "cart" => $_SESSION['cart'] ?? []]);
    }

    // Thêm sản phẩm vào giỏ hàng (POST /api/cart)
function store()
{
    header("Content-Type: application/json");

    // Lấy dữ liệu từ request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Kiểm tra dữ liệu đầu vào hợp lệ
    if (!isset($data['product_id'], $data['quantity'], $data['price'], $data['user_id'])) {
        echo json_encode(["status" => "error", "message" => "Invalid request"]);
        return;
    }

    // Lấy dữ liệu từ request
    $user_id = $data['user_id'];
    $product_id = $data['product_id'];
    $quantity = (int)$data['quantity'];
    $price = (float)$data['price'];

    // Kiểm tra số lượng sản phẩm hợp lệ
    if ($quantity <= 0) {
        echo json_encode(["status" => "error", "message" => "Invalid quantity"]);
        return;
    }

    // Nếu giỏ hàng của user chưa tồn tại, khởi tạo
    if (!isset($_SESSION['cart'][$user_id])) {
        $_SESSION['cart'][$user_id] = [];
    }

    // Nếu sản phẩm đã có trong giỏ hàng của user, cập nhật số lượng
    if (isset($_SESSION['cart'][$user_id][$product_id])) {
        $_SESSION['cart'][$user_id][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$user_id][$product_id] = [
            'quantity' => $quantity,
            'price' => $price
        ];
    }

    // Trả về giỏ hàng đã cập nhật
    echo json_encode(["status" => "success", "cart" => $_SESSION['cart'][$user_id]]);
}


    // Lấy chi tiết sản phẩm trong giỏ hàng (GET /api/cart/{product_id})
    public function show($userid)
{
    header("Content-Type: application/json");

    // Kiểm tra nếu giỏ hàng của người dùng có tồn tại trong session
    if (!isset($_SESSION['cart'][$userid])) {
        echo json_encode(["status" => "error", "message" => "Cart not found for user"]);
        return;
    }

    // Trả về giỏ hàng của người dùng
    $cart = $_SESSION['cart'][$userid];
    echo json_encode(["status" => "success", "cart" => $cart]);
}


    // Xóa sản phẩm khỏi giỏ hàng (DELETE /api/cart/{product_id})
    // public function destroy($product_id)
    // {
    //     header("Content-Type: application/json");

    //     if (!isset($_SESSION['cart'][$product_id])) {
    //         echo json_encode(["status" => "error", "message" => "Product not found in cart"]);
    //         return;
    //     }

    //     unset($_SESSION['cart'][$product_id]);
    //     echo json_encode(["status" => "success", "cart" => $_SESSION['cart']]);
    // }

    // Xóa toàn bộ giỏ hàng (DELETE /api/cart)
    public function clearCart()
    {
        header("Content-Type: application/json");
        $_SESSION['cart'] = [];
        echo json_encode(["status" => "success", "message" => "Cart cleared"]);
    }

    // Tính tổng tiền giỏ hàng (GET /api/cart/total)
    public function getTotal()
    {
        header("Content-Type: application/json");

        $total = 0;
        foreach ($_SESSION['cart'] ?? [] as $product) {
            $total += $product['quantity'] * $product['price'];
        }

        echo json_encode(["status" => "success", "total" => $total]);
    }
}
