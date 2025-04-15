<?php
class OrderModel
{
    private $conn; // Biến lưu kết nối CSDL
    private $table_name = "orders";
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

    public function payOrder($orderId)
    {
        $sql = "UPDATE orders SET status = 'completed' WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$orderId]);
    }
    public function manageOrder()
    {
        $query = "SELECT 
        odt.order_id,
        asp.UserName,
        SUM(odt.quantity) AS total_quantity,
        SUM(odt.price * odt.quantity) AS total_item_price,
        MAX(od.total_price) AS total_price, 
        MAX(od.created_at) AS created_at,
        MAX(od.status) AS status
    FROM aspnetusers asp
    JOIN orders od ON asp.Id = od.user_id
    JOIN order_details odt ON od.id = odt.order_id
    JOIN shoes sh ON sh.id = odt.product_id
    GROUP BY odt.order_id, asp.UserName
    ORDER BY odt.order_id DESC";


        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function deleteOrder($order_id)
    {
        // Xóa chi tiết đơn hàng
        $stmt = $this->conn->prepare("DELETE FROM order_details WHERE order_id = ?");
        $stmt->execute([$order_id]);
        $detailsDeleted = $stmt->rowCount();

        // Xóa đơn hàng chính
        $stmt = $this->conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->execute([$order_id]);
        $orderDeleted = $stmt->rowCount();

        return [
            "status" => ($orderDeleted > 0 ? "success" : "error"),
            "message" => $orderDeleted > 0 ? "Đơn hàng đã được xóa" : "Không tìm thấy đơn hàng để xóa",
            "details_deleted" => $detailsDeleted,
            "orders_deleted" => $orderDeleted
        ];
    }
}
