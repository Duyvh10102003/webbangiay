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

    // Đăng ký User + Gán Role
    public function register($username, $email, $password, $role = "User")
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

    // Đăng nhập
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

        $user = $stmt->fetch();

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

    // Trong class UserModel
public function updateuser($userid, $username, $email, $role = null)
{
    if (empty($userid)) {
        return ["error" => "ID người dùng không hợp lệ"];
    }

    // Chuẩn hóa dữ liệu
    $normalizedUsername = strtoupper(trim($username));
    $normalizedEmail = strtoupper(trim($email));

    // Kiểm tra user có tồn tại không
    $query_check = "SELECT Id FROM $this->table_users WHERE Id = :id";
    $stmt_check = $this->conn->prepare($query_check);
    $stmt_check->bindParam(":id", $userid);
    $stmt_check->execute();

    if ($stmt_check->rowCount() == 0) {
        return ["error" => "Người dùng không tồn tại"];
    }

    // Cập nhật thông tin user
    $query = "UPDATE $this->table_users 
              SET UserName = :username, NormalizedUserName = :normalizedUsername, 
                  Email = :email, NormalizedEmail = :normalizedEmail 
              WHERE Id = :id";

    try {
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $userid);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":normalizedUsername", $normalizedUsername);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":normalizedEmail", $normalizedEmail);

        if ($stmt->execute()) {
            // Cập nhật role nếu có
            if ($role) {
                $normalizedRole = strtoupper($role);
                // Kiểm tra role đã tồn tại chưa
                $query_role = "SELECT Id FROM $this->table_roles WHERE NormalizedName = :role";
                $stmt_role = $this->conn->prepare($query_role);
                $stmt_role->bindParam(":role", $normalizedRole);
                $stmt_role->execute();
                $roleData = $stmt_role->fetch(PDO::FETCH_ASSOC);

                if ($roleData) {
                    $roleId = $roleData['Id'];
                } else {
                    // Nếu role chưa tồn tại, tạo mới
                    $roleId = bin2hex(random_bytes(18));
                    $query_insert_role = "INSERT INTO $this->table_roles (Id, Name, NormalizedName) VALUES (:id, :role, :normalizedRole)";
                    $stmt_insert_role = $this->conn->prepare($query_insert_role);
                    $stmt_insert_role->bindParam(":id", $roleId);
                    $stmt_insert_role->bindParam(":role", $role);
                    $stmt_insert_role->bindParam(":normalizedRole", $normalizedRole);
                    $stmt_insert_role->execute();
                }

                // Xóa role cũ và thêm role mới (đảm bảo chỉ có 1 role/user)
                $query_delete_role = "DELETE FROM $this->table_user_roles WHERE UserId = :userId";
                $stmt_delete_role = $this->conn->prepare($query_delete_role);
                $stmt_delete_role->bindParam(":userId", $userid);
                $stmt_delete_role->execute();

                $query_update_role = "INSERT INTO $this->table_user_roles (UserId, RoleId) VALUES (:userId, :roleId)";
                $stmt_update_role = $this->conn->prepare($query_update_role);
                $stmt_update_role->bindParam(":userId", $userid);
                $stmt_update_role->bindParam(":roleId", $roleId);
                $stmt_update_role->execute();
            }
            return ["message" => "Cập nhật thành công"];
        } else {
            return ["error" => "Cập nhật thất bại"];
        }
    } catch (PDOException $e) {
        return ["error" => "Lỗi SQL: " . $e->getMessage()];
    }
}

    // Xóa user
    public function deleteuser ($userid)
    {
        // Kiểm tra dữ liệu đầu vào
        if (empty($userid)) {
            return ["error" => "Vui lòng nhập đầy đủ thông tin"];
        }

        // Xóa user
        $query = "DELETE FROM $this->table_users WHERE Id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $userid);

        if ($stmt->execute()) {
            return ["message" => "Xóa thành công"];
        } else {
            return ["error" => "Xóa thất bại"];
        }
    }
    // Lấy danh sách user
    public function getAllUsers()
    {
        $query = "SELECT u.Id, u.UserName, u.Email, r.Name as Role 
                  FROM $this->table_users u
                  LEFT JOIN $this->table_user_roles ur ON u.Id = ur.UserId
                  LEFT JOIN $this->table_roles r ON ur.RoleId = r.Id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy thông tin user theo ID
    public function getUserById($userid)
    {
        $query = "SELECT u.Id, u.UserName, u.Email, r.Name as Role 
                  FROM $this->table_users u
                  LEFT JOIN $this->table_user_roles ur ON u.Id = ur.UserId
                  LEFT JOIN $this->table_roles r ON ur.RoleId = r.Id
                  WHERE u.Id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $userid);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
