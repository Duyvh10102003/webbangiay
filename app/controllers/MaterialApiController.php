<?php
require_once 'app/config/database.php';
require_once 'app/models/MaterialsModel.php';

class MaterialApiController
{
    private $materialModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->materialModel = new MaterialsModel($this->db);
    }

    // Lấy danh sách 
    public function index()
    {
        header('Content-Type: application/json');
        $shoes = $this->materialModel->getMaterials();

        echo json_encode($shoes);
    }

    // Lấy thông tin theo ID
    public function show($id)
    {
        header('Content-Type: application/json');
        $shoe = $this->materialModel->getMaterialById($id);

        if ($shoe) {
            echo json_encode($shoe);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Material not found']);
        }
    }

    // Thêm mới
    public function store()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        
        $name = $data['name'];
        
        $result = $this->materialModel->addMaterial($name);
        
        if (is_array($result)) {
            http_response_code(400);
            echo json_encode(['errors' => $result]);
        } else {
            http_response_code(201);
            echo json_encode(['message' => 'Material created successfully']);
        }
    }

    // Cập nhật theo ID
    public function update($id)
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);

        $name = $data['name'];
        

        $result = $this->materialModel->updateMaterial($id, $name);
        
        if ($result) {
            echo json_encode(['message' => 'Material updated successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Material update failed']);
        }
    }

    // Xóa sản phẩm theo ID
    public function destroy($id)
    {
        header('Content-Type: application/json');
        $result = $this->materialModel->deleteMaterial($id);
        
        if ($result) {
            echo json_encode(['message' => 'Material deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Material deletion failed']);
        }
    }
}
?>