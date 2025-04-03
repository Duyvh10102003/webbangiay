<?php include __DIR__ . '/../shares/header.php'; ?>

<h2 class="text-center mb-4">Danh sách tài khoản</h2>

<table id="users" class="table table-striped table-bordered table-hover">
    <thead class="thead-dark text-center">
        <tr>
            <th class="align-top"><a href="#"><i class="fa-solid fa-book"></i> ID</a></th>
            <th class="align-top"><a href="#"><i class="fa-solid fa-book"></i> Username</a></th>
            <th class="align-top"><a href="#"><i class="fa-solid fa-dollar-sign"></i> Email</a></th>
            <th class="align-top"><a href="#"><i class="fa-solid fa-dollar-sign"></i> Role</a></th>
            <th class="align-top"><i class="fa-solid fa-cogs"></i> Hành Động</th>
        </tr>
    </thead>
    <tbody class="text-center" id="user-list">
        <!-- Dữ liệu sẽ được load vào đây -->
    </tbody>
</table>

<!-- PHÂN TRANG -->
<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Phân trang sẽ được thêm sau -->
        </ul>
    </nav>
</div>

<!-- Modal chỉnh sửa -->
<div id="editModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
    <div class="modal-content" style="background-color: white; margin: 15% auto; padding: 20px; width: 300px; border-radius: 5px;">
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
            <button type="submit" class="btn btn-success">Lưu</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Hủy</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>

<script>
// Lấy danh sách người dùng khi trang tải
document.addEventListener('DOMContentLoaded', loadUsers);

function loadUsers() {
    fetch('http://localhost/webbangiay/api/auth')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            const userList = document.getElementById('user-list');
            userList.innerHTML = '';
            data.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.Id}</td>
                    <td>${user.UserName}</td>
                    <td>${user.Email}</td>
                    <td>${user.Role || 'Chưa có'}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="openEditModal('${user.Id}', '${user.UserName}', '${user.Email}', '${user.Role}')">Sửa</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteUser('${user.Id}')">Xóa</button>
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
        body: JSON.stringify({ username, email, role })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            closeModal();
            loadUsers(); // Tải lại danh sách
        } else {
            alert(data.error);
        }
    })
    .catch(error => console.error('Lỗi:', error));
});

// Xóa người dùng
function deleteUser(userId) {
    if (confirm('Bạn có chắc muốn xóa người dùng này?')) {
        fetch(`http://localhost/webbangiay/api/auth/${userId}`, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message || data.error);
            loadUsers(); // Tải lại danh sách
        })
        .catch(error => console.error('Lỗi:', error));
    }
}
</script>

</body>
</html>