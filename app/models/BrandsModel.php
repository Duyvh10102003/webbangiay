<?php
class BrandsModel
{
    private $conn;
    private $table_name = "brands";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getBrands()
    {
        $query = "SELECT * FROM " . $this->table_name. " ORDER BY id DESC"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getBrandById($id)
    {
        $query = "SELECT p.*
                FROM brands p 
                WHERE p.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function addBrand($name)
    {
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'Tên thương hiệu sản phẩm không được để trống';
        }

        $query = "INSERT INTO " . $this->table_name . " (name) 
                  VALUES (:name)";
        $stmt = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($name));

        $stmt->bindParam(':name', $name);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateBrand($id, $name)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET name=:name
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($name));

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function deleteBrand($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>