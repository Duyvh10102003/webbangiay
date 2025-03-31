<?php
require_once 'app/config/database.php';
require_once 'app/models/ShoesModel.php';
require_once 'app/models/BrandsModel.php';
require_once 'app/models/ManufacturersModel.php';
require_once 'app/models/MaterialsModel.php';
require_once 'app/models/TypesModel.php';

class ShoeApiController
{
    private $shoeModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->shoeModel = new ShoesModel($this->db);
    }

    // Lấy danh sách sản phẩm
    public function index()
    {
        header('Content-Type: application/json');
        $shoes = $this->shoeModel->getAllShoes();
        // foreach ($shoes as &$shoe) {
        //     // Format giá thành tiền Việt Nam Đồng (VND)
        //     $shoe['price'] = number_format($shoe['price'], 0, ',', '.') . ' ₫';

        // }
        echo json_encode($shoes);
    }

    // Lấy thông tin sản phẩm theo ID
    public function show($id)
    {
        header('Content-Type: application/json');
        $shoe = $this->shoeModel->getShoeById($id);

        if ($shoe) {
            echo json_encode($shoe);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Shoe not found']);
        }
    }

    // Thêm sản phẩm mới
    public function store()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        
        $id = $data['id'];
        $path_image = $data['path_image'] ?? '';
        $title = $data['title'] ?? '';
        $price = $data['price'] ?? '';
        $type_id = $data['type_id'] ?? '';
        $brand_id = $data['brand_id'] ?? '';
        $manufacturer_id = $data['manufacturer_id'] ?? '';
        $material_id = $data['material_id'] ?? '';
        $description = $data['description'] ?? '';
        
        $result = $this->shoeModel->addShoe($id, $path_image, $title, $price, $type_id, $brand_id, $manufacturer_id, $material_id, $description);
        
        if (is_array($result)) {
            http_response_code(400);
            echo json_encode(['errors' => $result]);
        } else {
            http_response_code(201);
            echo json_encode(['message' => 'Shoe created successfully']);
        }
    }

    // Cập nhật sản phẩm theo ID
    public function update($id)
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        
        $path_image = $data['path_image'] ?? '';
        $title = $data['title'] ?? '';
        $price = $data['price'] ?? '';
        $type_id = $data['type_id'] ?? '';
        $brand_id = $data['brand_id'] ?? '';
        $manufacturer_id = $data['manufacturer_id'] ?? '';
        $material_id = $data['material_id'] ?? '';
        $description = $data['description'] ?? '';
        
        $result = $this->shoeModel->updateShoe($id, $path_image, $title, $price, $type_id, $brand_id, $manufacturer_id, $material_id, $description);
        
        if ($result) {
            echo json_encode(['message' => 'Shoe updated successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Shoe update failed']);
        }
    }

    // Xóa sản phẩm theo ID
    public function destroy($id)
    {
        header('Content-Type: application/json');
        $result = $this->shoeModel->deleteShoe($id);
        
        if ($result) {
            echo json_encode(['message' => 'Shoe deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Shoe deletion failed']);
        }
    }

    //upload ảnh 
    // private function uploadImage($file)
    // {
    //     if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
    //         return ["error" => "Không có file nào được tải lên hoặc file bị lỗi."];
    //     }

    //     $target_dir = "public/images/";

    //     if (!file_exists($target_dir)) {
    //         mkdir($target_dir, 0777, true);
    //     }

    //     $file_name = time() . "_" . basename($file["name"]);
    //     $target_file = $target_dir . $file_name;
    //     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    //     $allowed_types = ["jpg", "jpeg", "png", "gif"];

    //     if (!in_array($imageFileType, $allowed_types)) {
    //         return ["error" => "Chỉ chấp nhận file ảnh JPG, JPEG, PNG, GIF."];
    //     }

    //     if (move_uploaded_file($file["tmp_name"], $target_file)) {
    //         // Trả về đường dẫn có thêm "/shopshoe/"
    //         return ["path" => "/shopshoe/" . $target_file];
    //     } else {
    //         return ["error" => "Không thể tải lên ảnh."];
    //     }
    // }
}
?>
