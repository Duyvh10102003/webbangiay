<?php
class ShoesModel
{
    private $conn;
    private $table_name = "shoes";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllShoes()
    {
        $query = "SELECT 
                    p.id, 
                    p.path_image, 
                    p.title, 
                    p.price, 
                    t.name AS type, 
                    b.name AS brand, 
                    m.name AS manufacturer, 
                    mat.name AS material, 
                    p.description
                FROM {$this->table_name} p
                LEFT JOIN types t ON p.type_id = t.id
                LEFT JOIN brands b ON p.brand_id = b.id
                LEFT JOIN manufacturers m ON p.manufacturer_id = m.id
                LEFT JOIN materials mat ON p.material_id = mat.id
                ORDER BY id DESC;";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getShoeById($id)
    {
        $query = "SELECT 
                    p.id, 
                    p.path_image, 
                    p.title, 
                    p.price, 
                    t.name AS type, 
                    b.name AS brand, 
                    m.name AS manufacturer, 
                    mat.name AS material, 
                    p.description
                FROM {$this->table_name} p
                LEFT JOIN types t ON p.type_id = t.id
                LEFT JOIN brands b ON p.brand_id = b.id
                LEFT JOIN manufacturers m ON p.manufacturer_id = m.id
                LEFT JOIN materials mat ON p.material_id = mat.id
                WHERE p.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function search($keyword): array
    {
        $query = "SELECT 
                p.id, 
                p.path_image, 
                p.title, 
                p.price, 
                t.name AS type, 
                b.name AS brand, 
                m.name AS manufacturer, 
                mat.name AS material, 
                p.description
              FROM {$this->table_name} p
              LEFT JOIN types t ON p.type_id = t.id
              LEFT JOIN brands b ON p.brand_id = b.id
              LEFT JOIN manufacturers m ON p.manufacturer_id = m.id
              LEFT JOIN materials mat ON p.material_id = mat.id
              WHERE p.title LIKE :keyword 
                 OR p.description LIKE :keyword 
                 OR b.name LIKE :keyword 
                 OR t.name LIKE :keyword 
                 OR m.name LIKE :keyword 
                 OR mat.name LIKE :keyword
                 OR p.id LIKE :keyword";

        $stmt = $this->conn->prepare($query);
        $searchKeyword = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $searchKeyword, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addShoe($id, $path_image, $title, $price, $type_id, $brand_id, $manufacturer_id, $material_id, $description)
    {
        $errors = [];

        // Kiểm tra dữ liệu đầu vào
        if (empty($id)) {
            $errors['id'] = 'ID sản phẩm không được để trống';
        }
        if (empty($path_image)) {
            $errors['path_image'] = 'Ảnh sản phẩm không được để trống';
        }
        if (empty($title)) {
            $errors['title'] = 'Tên sản phẩm không được để trống';
        }
        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }

        if (!empty($errors)) {
            return $errors;
        }

        // Thêm sản phẩm vào bảng `shoes`
        $query = "INSERT INTO {$this->table_name} 
              (id, path_image, title, price, type_id, brand_id, manufacturer_id, material_id, description) 
              VALUES (:id, :path_image, :title, :price, :type_id, :brand_id, :manufacturer_id, :material_id, :description)";

        $stmt = $this->conn->prepare($query);

        // Lọc dữ liệu đầu vào
        $clean_id = htmlspecialchars(strip_tags($id));
        $clean_path_image = htmlspecialchars(strip_tags($path_image));
        $clean_title = htmlspecialchars(strip_tags($title));
        $clean_price = htmlspecialchars(strip_tags($price));
        $clean_description = htmlspecialchars(strip_tags($description));

        $stmt->bindParam(':id', $clean_id);
        $stmt->bindParam(':path_image', $clean_path_image);
        $stmt->bindParam(':title', $clean_title);
        $stmt->bindParam(':price', $clean_price);
        $stmt->bindParam(':type_id', $type_id);
        $stmt->bindParam(':brand_id', $brand_id);
        $stmt->bindParam(':manufacturer_id', $manufacturer_id);
        $stmt->bindParam(':material_id', $material_id);
        $stmt->bindParam(':description', $clean_description);

        return $stmt->execute();
    }

    public function updateShoe($id, $path_image, $title, $price, $type_id, $brand_id, $manufacturer_id, $material_id, $description)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET path_image = :path_image, title = :title, price = :price, type_id = :type_id,  brand_id = :brand_id, manufacturer_id = :manufacturer_id, material_id = :material_id,  description = :description
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sử dụng biến trung gian
        $clean_path_image = htmlspecialchars(strip_tags($path_image));
        $clean_title = htmlspecialchars(strip_tags($title));
        $clean_price = htmlspecialchars(strip_tags($price));
        $clean_description = htmlspecialchars(strip_tags($description));

        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':path_image', $clean_path_image);
        $stmt->bindParam(':title', $clean_title);
        $stmt->bindParam(':price', $clean_price);
        $stmt->bindParam(':type_id', $type_id);
        $stmt->bindParam(':brand_id', $brand_id);
        $stmt->bindParam(':manufacturer_id', $manufacturer_id);
        $stmt->bindParam(':material_id', $material_id);
        $stmt->bindParam(':description', $clean_description);

        return $stmt->execute();
    }

    public function deleteShoe($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
