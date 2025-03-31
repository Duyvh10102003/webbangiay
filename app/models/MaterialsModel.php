<?php
class MaterialsModel
{
    private $conn;
    private $table_name = "materials";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getMaterials()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getMaterialById($id)
    {
        $query = "SELECT p.*
                FROM materials p 
                WHERE p.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function addMaterial($name)
    {
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'Tên chất liệu sản phẩm không được để trống';
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

    public function updateMaterial($id, $name)
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

    public function deleteMaterial($id)
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