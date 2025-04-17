<?php
require_once 'app/config/database.php';
require_once 'app/models/TypesModel.php';

class TypeApiController
{
    private $typeModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->typeModel = new TypesModel($this->db);
    }

    // Lấy danh sách 
    public function index()
    {
        header('Content-Type: application/json');
        $shoes = $this->typeModel->getTypes();

        echo json_encode($shoes);
    }

    // Lấy thông tin theo ID
    public function show($id)
    {
        header('Content-Type: application/json');
        $shoe = $this->typeModel->getTypeById($id);

        if ($shoe) {
            echo json_encode($shoe);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Type not found']);
        }
    }

    // Thêm mới
    public function store()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);

        $name = $data['name'];

        $result = $this->typeModel->addType($name);

        if (is_array($result)) {
            http_response_code(400);
            echo json_encode(['errors' => $result]);
        } else {
            http_response_code(201);
            echo json_encode(['message' => 'Type created successfully']);
        }
    }

    // Cập nhật theo ID
    public function update($id)
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);

        $name = $data['name'];

        $result = $this->typeModel->updateType($id, $name);

        if ($result) {
            echo json_encode(['message' => 'Type updated successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Type update failed']);
        }
    }

    // Xóa sản phẩm theo ID
    public function destroy($id)
    {
        header('Content-Type: application/json');
        $result = $this->typeModel->deleteType($id);

        if ($result) {
            echo json_encode(['message' => 'Type deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Type deletion failed']);
        }
    }
}
