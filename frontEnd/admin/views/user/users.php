<?php include __DIR__ . '/../shares/header.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-btn {
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            width: 300px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Quản lý người dùng</h1>
    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="userList"></tbody>
    </table>

    <!-- Modal chỉnh sửa -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Chỉnh sửa người dùng</h2>
            <form id="editForm">
                <input type="hidden" id="editUserId">
                <label>Username:</label><br>
                <input type="text" id="editUsername" required><br><br>
                <label>Email:</label><br>
                <input type="email" id="editEmail" required><br><br>
                <label>Role:</label><br>
                <select id="editRole">
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                </select><br><br>
                <button type="submit" class="action-btn edit-btn">Lưu</button>
                <button type="button" class="action-btn" onclick="closeModal()">Hủy</button>
            </form>
        </div>
    </div>
    <?php include __DIR__ . '/../shares/footer.php'; ?>
    <script>
        // Lấy danh sách người dùng khi trang tải
        document.addEventListener('DOMContentLoaded', loadUsers);

        function loadUsers() {
            fetch('http://localhost/webbangiay/api/auth') // Gọi API lấy danh sách user
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    const userList = document.getElementById('userList');
                    userList.innerHTML = '';
                    data.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${user.Id}</td>
                            <td>${user.UserName}</td>
                            <td>${user.Email}</td>
                            <td>${user.Role || 'Chưa có'}</td>
                            <td>
                                <button class="action-btn edit-btn" onclick="openEditModal('${user.Id}', '${user.UserName}', '${user.Email}', '${user.Role}')">Sửa</button>
                                <button class="action-btn delete-btn" onclick="deleteUser('${user.Id}')">Xóa</button>
                            </td>
                        `;
                        userList.appendChild(row);
                    });
                })
                .catch(error => console.error('Lỗi:', error));
        }

        // Mở modal chỉnh sửa
        function openEditModal(id, username, email, role) {
            document.getElementById('editUserId').value = id;
            document.getElementById('editUsername').value = username;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role || 'User';
            document.getElementById('editModal').style.display = 'block';
        }

        // Đóng modal
        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Xử lý form chỉnh sửa
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const userId = document.getElementById('editUserId').value;
            const username = document.getElementById('editUsername').value;
            const email = document.getElementById('editEmail').value;
            const role = document.getElementById('editRole').value;

            fetch(`http://localhost/webbangiay/api/auth/${userId}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    // Cập nhật role riêng (API không hỗ trợ trực tiếp, cần thêm logic server-side)
                    alert(data.message);
                    closeModal();
                    loadUsers(); // Tải lại danh sách
                } else {
                    alert(data.error);
                }
            });
        });

        // Xóa người dùng
        function deleteUser(userId) {
            if (confirm('Bạn có chắc muốn xóa người dùng này?')) {
                fetch(`http://localhost/webbangiay/api/auth/${userId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message || data.error);
                    loadUsers(); // Tải lại danh sách
                });
            }
        }
    </script>
