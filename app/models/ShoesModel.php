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
        $query = "SELECT p.id, p.path_image, p.title, p.price, p.type, p.brain, p.manufacture, p.material, p.description
                  FROM {$this->table_name} p ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getShoeById($id)
    {
        $query = "SELECT * FROM {$this->table_name} WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addShoe($id, $path_image, $title, $price, $type, $brain, $manufacture, $material, $description)
    {
        $errors = [];
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

        if (empty($type)) {
            $errors['type'] = 'Loại sản phẩm không được để trống';
        }
        if (empty($brain)) {
            $errors['brain'] = 'Thương hiệu sản phẩm không được để trống';
        }
        if (empty($manufacture)) {
            $errors['manufacture'] = 'Nước sản xuất sản phẩm không được để trống';
        }
        if (empty($material)) {
            $errors['material'] = 'Nguyên vật liệu sản phẩm không được để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        
        if (!empty($errors)) {
            return $errors;
        }

        $query = "INSERT INTO {$this->table_name} (id, path_image, title, price, type, brain, manufacture, material, description) 
                  VALUES (:id, :path_image, :title, :price, :type, :brain, :manufacture, :material, :description)";
        
        $stmt = $this->conn->prepare($query);

        // Sử dụng biến trung gian để tránh lỗi "Only variables should be passed by reference"
        $clean_id = htmlspecialchars(strip_tags($id));
        $clean_path_image = htmlspecialchars(strip_tags($path_image));
        $clean_title = htmlspecialchars(strip_tags($title));
        $clean_price = htmlspecialchars(strip_tags($price));
        $clean_type = htmlspecialchars(strip_tags($type));
        $clean_brain = htmlspecialchars(strip_tags($brain));
        $clean_manufacture = htmlspecialchars(strip_tags($manufacture));
        $clean_material = htmlspecialchars(strip_tags($material));
        $clean_description = htmlspecialchars(strip_tags($description));

        $stmt->bindParam(':id', $clean_id);
        $stmt->bindParam(':path_image', $clean_path_image);
        $stmt->bindParam(':title', $clean_title);
        $stmt->bindParam(':price', $clean_price);
        $stmt->bindParam(':type', $clean_type);
        $stmt->bindParam(':brain', $clean_brain);
        $stmt->bindParam(':manufacture', $clean_manufacture);
        $stmt->bindParam(':material', $clean_material);
        $stmt->bindParam(':description', $clean_description);

        return $stmt->execute();
    }

    public function updateShoe($id, $path_image, $title, $price, $type, $brain, $manufacture, $material, $description)
    {
        $query = "UPDATE {$this->table_name} 
                  SET path_image = :path_image, title = :title, price = :price, type = :type,  brain = :brain, manufacture = :manufacture, material = :material,  description = :description
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        // Sử dụng biến trung gian
        $clean_path_image = htmlspecialchars(strip_tags($path_image));
        $clean_title = htmlspecialchars(strip_tags($title));
        $clean_price = htmlspecialchars(strip_tags($price));
        $clean_type = htmlspecialchars(strip_tags($type));
        $clean_brain = htmlspecialchars(strip_tags($brain));
        $clean_manufacture = htmlspecialchars(strip_tags($manufacture));
        $clean_material = htmlspecialchars(strip_tags($material));
        $clean_description = htmlspecialchars(strip_tags($description));

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':path_image', $clean_path_image);
        $stmt->bindParam(':title', $clean_title);
        $stmt->bindParam(':price', $clean_price);
        $stmt->bindParam(':type', $clean_type);
        $stmt->bindParam(':brain', $clean_brain);
        $stmt->bindParam(':manufacture', $clean_manufacture);
        $stmt->bindParam(':material', $clean_material);
        $stmt->bindParam(':description', $clean_description);

        return $stmt->execute();
    }

    public function deleteShoe($id)
    {
        $query = "DELETE FROM {$this->table_name} WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}
?>
