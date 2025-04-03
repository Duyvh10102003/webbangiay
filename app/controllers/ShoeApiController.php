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

    // public function show($searchQuery)
    // {
    //     header('Content-Type: application/json');
    //     $shoe = $this->shoeModel->searchShoes($searchQuery);

    //     if ($shoe) {
    //         echo json_encode($shoe);
    //     } else {
    //         http_response_code(404);
    //         echo json_encode(['message' => 'Shoe not found']);
    //     }
    // }
    
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

    // Kiểm tra xem có file ảnh được upload không
    $path_image = '';
    if (!empty($_FILES['path_image']['name'])) {
        $upload_dir = __DIR__ . "/../../public/images/"; // Thư mục lưu ảnh
        $file_name = time() . "_" . basename($_FILES['path_image']['name']); // Đổi tên file để tránh trùng lặp
        $file_path = $upload_dir . $file_name;

        // Kiểm tra và di chuyển file vào thư mục uploads
        if (move_uploaded_file($_FILES['path_image']['tmp_name'], $file_path)) {
            $path_image = "/webbangiay/public/images/" . $file_name; // Lưu đường dẫn ảnh để lưu vào database
        } else {
            http_response_code(400);
            echo json_encode(['errors' => ['path_image' => 'Lỗi khi upload file']]);
            return;
        }
    }

    // Nhận dữ liệu từ `$_POST`
    $id = uniqid(); // Tạo ID ngẫu nhiên
    $title = $_POST['title'] ?? '';
    $price = $_POST['price'] ?? '';
    $type_id = $_POST['type_id'] ?? '';
    $brand_id = $_POST['brand_id'] ?? '';
    $manufacturer_id = $_POST['manufacturer_id'] ?? '';
    $material_id = $_POST['material_id'] ?? '';
    $description = $_POST['description'] ?? '';

    // Gọi phương thức thêm giày vào database
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
public function edit($id)
{
    header('Content-Type: application/json');

    // Lấy dữ liệu sản phẩm hiện tại từ DB
    $currentShoe = $this->shoeModel->getShoeById($id);
    if (!$currentShoe) {
        http_response_code(404);
        echo json_encode(['message' => 'Shoe not found']);
        return;
    }

    // Giữ nguyên ảnh cũ nếu không upload ảnh mới
    $path_image = $currentShoe->path_image; // Truy cập thuộc tính object đúng cách
    if (!empty($_FILES['path_image']['name'])) {
        $upload_dir = __DIR__ . "/../../public/images/"; // Thư mục lưu ảnh
        $file_name = time() . "_" . basename($_FILES['path_image']['name']); // Đổi tên file để tránh trùng lặp
        $file_path = $upload_dir . $file_name;

        // Kiểm tra và di chuyển file vào thư mục uploads
        if (move_uploaded_file($_FILES['path_image']['tmp_name'], $file_path)) {
            $path_image = "/webbangiay/public/images/" . $file_name; // Lưu đường dẫn ảnh để lưu vào database
        } else {
            http_response_code(400);
            echo json_encode(['errors' => ['path_image' => 'Lỗi khi upload file']]);
            return;
        }
    }

    // Nhận dữ liệu từ `$_POST` cho các trường khác (nếu cần)
    $title = $_POST['title'] ?? '';
    $price = $_POST['price'] ?? '';
    $type_id = $_POST['type_id'] ?? '';
    $brand_id = $_POST['brand_id'] ?? '';
    $manufacturer_id = $_POST['manufacturer_id'] ?? '';
    $material_id = $_POST['material_id'] ?? '';
    $description = $_POST['description'] ?? '';

    // Gọi phương thức cập nhật giày vào database
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
    // Tìm kiếm giày theo tên
    public function search($name)
    {
        header('Content-Type: application/json');
    
        // Kiểm tra nếu tên tìm kiếm rỗng
        if (empty($name)) {
            http_response_code(400);
            echo json_encode(['message' => 'Search keyword is required']);
            return;
        }
    
        try {
            $shoes = $this->shoeModel->search($name);
    
                if (!empty($shoes)) {
                echo json_encode($shoes);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'No shoes found']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Internal Server Error', 'error' => $e->getMessage()]);
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
