<?php
class OrderModel
{
    private $conn; // Biến lưu kết nối CSDL

    // Hàm khởi tạo, nhận đối tượng kết nối từ Database
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Hàm tạo đơn hàng
    public function createOrder($user_id, $items)
    {
        // Bắt đầu transaction để đảm bảo dữ liệu nhất quán
        $this->conn->beginTransaction();

        try {
            $total_price = 0; // Tổng tiền đơn hàng

            // Tính tổng tiền từ danh sách sản phẩm trong giỏ hàng
            foreach ($items as $item) {
                $total_price += $item['quantity'] * $item['price'];
            }

            // Thêm đơn hàng vào bảng `orders`
            $stmt = $this->conn->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, 'pending')");
            $stmt->execute([$user_id, $total_price]);

            // Lấy ID của đơn hàng vừa tạo
            $order_id = $this->conn->lastInsertId();

            // Thêm từng sản phẩm vào bảng `order_details`
            $stmt = $this->conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

            foreach ($items as $item) {
                $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
            }

            // Xác nhận transaction
            $this->conn->commit();

            // Xóa session giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);

            return ["status" => "success", "message" => "Order created", "order_id" => $order_id];
        } catch (Exception $e) {
            // Nếu có lỗi, rollback để hủy thay đổi
            $this->conn->rollBack();
            return ["status" => "error", "message" => $e->getMessage()];
        }
    }

    // Hàm lấy danh sách đơn hàng của một người dùng
    public function getOrdersByUser($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->execute([$user_id]);

        // Lấy danh sách đơn hàng dưới dạng mảng
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm lấy chi tiết một đơn hàng cụ thể
    public function getOrderDetails($order_id)
    {
        $stmt = $this->conn->prepare("
            SELECT od.*, s.title AS product_name 
            FROM order_details od
            JOIN shoes s ON od.product_id = s.id
            WHERE od.order_id = ?
        ");
        $stmt->execute([$order_id]);

        // Lấy danh sách sản phẩm trong đơn hàng dưới dạng mảng
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
