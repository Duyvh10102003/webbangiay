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

    // 🟢 Đăng ký User
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

    // 🟢 Đăng nhập
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
}
