

<?php
require_once "app/models/UserModel.php";
require_once "app/config/database.php";

class AuthApiController
{
    private $userModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    // Đăng ký User
    public function register()
    {
        header("Content-Type: application/json");
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['username']) || !isset($data['email']) || !isset($data['password'])) {
            echo json_encode(["error" => "Vui lòng nhập đầy đủ thông tin"]);
            return;
        }

        $role = $data['role'] ?? 'User'; // Mặc định là User nếu không truyền role
        $result = $this->userModel->register($data['username'], $data['email'], $data['password'], $role);

        echo json_encode($result);
    }

    // Đăng nhập
    public function login()
    {
        header("Content-Type: application/json");
        $data = json_decode(file_get_contents("php://input"));

        if (!isset($data->email) || !isset($data->password)) {
            echo json_encode(["error" => "Vui lòng nhập đầy đủ thông tin"]);
            return;
        }

        $user = $this->userModel->login($data->email, $data->password);

        if ($user) {
    
            echo json_encode([
                "message" => "Đăng nhập thành công",
                "user" => [
                    "id" => $user["id"],
                    "username" => $user["username"],
                    "email" => $user["email"],
                    "role" => $user["role"]
                ],
              
                "token" => bin2hex(random_bytes(32)) // Token giả lập
            ]);
        } else {
            echo json_encode(["error" => "Sai email hoặc mật khẩu"]);
        }
        
    }

    // Lấy thông tin người dùng theo ID
    public function show($userId)
    {
        
        $user = $this->userModel->getUserById($userId);

        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(["error" => "Người dùng không tồn tại"]);
        }
    }

// Trong class AuthApiController
public function update($userId)
{
    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"), true);


    if (empty($userId) || empty($data)) {
        echo json_encode(["error" => "Dữ liệu không hợp lệ"]);
        return;
    }


    $result = $this->userModel->updateuser(
        $userId,
        $data['username'] ?? null,
        $data['email'] ?? null,
        $data['role'] ?? null
    );

    echo json_encode($result);
}
    // Xóa người dùng

    public function destroy($userId)
    {
        header("Content-Type: application/json");
        $result = $this->userModel->deleteuser($userId);

        echo json_encode($result);
    }
    // Lấy danh sách người dùng
    public function index()
    {
        header("Content-Type: application/json");
        $users = $this->userModel->getAllUsers();

        if ($users) {
            echo json_encode($users);
        } else {
            echo json_encode(["error" => "Không có người dùng nào"]);
        }
    }
}

