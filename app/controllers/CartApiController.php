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
    public function store()
    {
        header("Content-Type: application/json");
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['product_id']) || !isset($data['quantity']) || !isset($data['price'])) {
            echo json_encode(["status" => "error", "message" => "Invalid request"]);
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $product_id = $data['product_id'];
        $quantity = $data['quantity'];
        $price = $data['price'];

        // Nếu sản phẩm đã có trong giỏ, cập nhật số lượng và tổng giá
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = [
                'quantity' => $quantity,
                'price' => $price
            ];
        }

        echo json_encode(["status" => "success", "cart" => $_SESSION['cart']]);
    }

    // Lấy chi tiết sản phẩm trong giỏ hàng (GET /api/cart/{product_id})
    public function show($product_id)
    {
        header("Content-Type: application/json");

        if (!isset($_SESSION['cart'][$product_id])) {
            echo json_encode(["status" => "error", "message" => "Product not found in cart"]);
            return;
        }

        echo json_encode(["status" => "success", "product" => $_SESSION['cart'][$product_id]]);
    }

    // Xóa sản phẩm khỏi giỏ hàng (DELETE /api/cart/{product_id})
    public function destroy($product_id)
    {
        header("Content-Type: application/json");

        if (!isset($_SESSION['cart'][$product_id])) {
            echo json_encode(["status" => "error", "message" => "Product not found in cart"]);
            return;
        }

        unset($_SESSION['cart'][$product_id]);
        echo json_encode(["status" => "success", "cart" => $_SESSION['cart']]);
    }

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
