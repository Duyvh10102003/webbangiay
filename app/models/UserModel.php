<?php
class UserModel
{
    private $conn;
    private $table_users = "AspNetUsers";
    private $table_roles = "AspNetRoles";
    private $table_user_roles = "AspNetUserRoles";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // 🟢 Đăng ký User + Gán Role
    public function register($username, $email, $password, $role)
    {
        // Kiểm tra dữ liệu đầu vào
        if (empty($username) || empty($email) || empty($password)) {
            return ["error" => "Vui lòng nhập đầy đủ thông tin"];
        }

        // Chuẩn hóa dữ liệu
        $normalizedUsername = strtoupper(trim($username));
        $normalizedEmail = strtoupper(trim($email));

        // Kiểm tra email đã tồn tại chưa
        $query_check = "SELECT Id FROM $this->table_users WHERE NormalizedEmail = :email";
        $stmt_check = $this->conn->prepare($query_check);
        $stmt_check->bindParam(":email", $normalizedEmail);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            return ["error" => "Email đã tồn tại"];
        }

        // Hash mật khẩu
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $userId = bin2hex(random_bytes(18)); // Tạo ID ngẫu nhiên

        // Thêm user vào bảng AspNetUsers
        $query_user = "INSERT INTO $this->table_users 
             (Id, UserName, NormalizedUserName, Email, NormalizedEmail, PasswordHash, EmailConfirmed) 
             VALUES (:id, :username, :normalizedUsername, :email, :normalizedEmail, :password, false)";
        $stmt_user = $this->conn->prepare($query_user);
        $stmt_user->bindParam(":id", $userId);
        $stmt_user->bindParam(":username", $username);
        $stmt_user->bindParam(":normalizedUsername", $normalizedUsername);
        $stmt_user->bindParam(":email", $email);
        $stmt_user->bindParam(":normalizedEmail", $normalizedEmail);
        $stmt_user->bindParam(":password", $passwordHash);

        if ($stmt_user->execute()) {
            // Gán Role cho User (nếu có)
            $query_role = "SELECT Id FROM $this->table_roles WHERE NormalizedName = :role";
            $stmt_role = $this->conn->prepare($query_role);
            $normalizedRole = strtoupper($role);
            $stmt_role->bindParam(":role", $normalizedRole);
            $stmt_role->execute();
            $roleData = $stmt_role->fetch(PDO::FETCH_ASSOC);

            if ($roleData) {
                $roleId = $roleData["Id"];
            } else {
                // Nếu Role chưa tồn tại, thêm mới
                $roleId = bin2hex(random_bytes(18));
                $query_insert_role = "INSERT INTO $this->table_roles (Id, Name, NormalizedName) VALUES (:id, :role, :normalizedRole)";
                $stmt_insert_role = $this->conn->prepare($query_insert_role);
                $stmt_insert_role->bindParam(":id", $roleId);
                $stmt_insert_role->bindParam(":role", $role);
                $stmt_insert_role->bindParam(":normalizedRole", $normalizedRole);
                $stmt_insert_role->execute();
            }

            // Gán user vào bảng AspNetUserRoles
            $query_user_role = "INSERT INTO $this->table_user_roles (UserId, RoleId) VALUES (:userId, :roleId)";
            $stmt_user_role = $this->conn->prepare($query_user_role);
            $stmt_user_role->bindParam(":userId", $userId);
            $stmt_user_role->bindParam(":roleId", $roleId);
            $stmt_user_role->execute();

            return ["message" => "Đăng ký thành công"];
        } else {
            return ["error" => "Đăng ký thất bại"];
        }
    }

    // 🟢 Đăng nhập
    public function login($email, $password)
    {
        $query = "SELECT u.Id, u.UserName, u.Email, u.PasswordHash, r.Name as Role 
                  FROM $this->table_users u
                  LEFT JOIN $this->table_user_roles ur ON u.Id = ur.UserId
                  LEFT JOIN $this->table_roles r ON ur.RoleId = r.Id
                  WHERE u.Email = :email";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["PasswordHash"])) {
            return [
                "id" => $user["Id"],
                "username" => $user["UserName"],
                "email" => $user["Email"],
                "role" => $user["Role"]
            ];
        }
        return false;
    }
}
