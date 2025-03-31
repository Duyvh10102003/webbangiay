<?php
require_once 'app/config/database.php';
require_once 'app/models/ManufacturersModel.php';

class ManufacturerApiController
{
    private $manufacturerModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->manufacturerModel = new ManufacturersModel($this->db);
    }

    // Lấy danh sách 
    public function index()
    {
        header('Content-Type: application/json');
        $shoes = $this->manufacturerModel->getManufacturers();

        echo json_encode($shoes);
    }

    // Lấy thông tin theo ID
    public function show($id)
    {
        header('Content-Type: application/json');
        $shoe = $this->manufacturerModel->getManufacturerById($id);

        if ($shoe) {
            echo json_encode($shoe);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Manufacturer not found']);
        }
    }

    // Thêm mới
    public function store()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        
        $name = $data['name'];
        
        $result = $this->manufacturerModel->addManufacturer($name);
        
        if (is_array($result)) {
            http_response_code(400);
            echo json_encode(['errors' => $result]);
        } else {
            http_response_code(201);
            echo json_encode(['message' => 'Manufacturer created successfully']);
        }
    }

    // Cập nhật theo ID
    public function update($id)
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);

        $name = $data['name'];
        

        $result = $this->manufacturerModel->updateManufacturer($id, $name);
        
        if ($result) {
            echo json_encode(['message' => 'Manufacturer updated successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Manufacturer update failed']);
        }
    }

    // Xóa sản phẩm theo ID
    public function destroy($id)
    {
        header('Content-Type: application/json');
        $result = $this->manufacturerModel->deleteManufacturer($id);
        
        if ($result) {
            echo json_encode(['message' => 'Manufacturer deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Manufacturer deletion failed']);
        }
    }
}
?>