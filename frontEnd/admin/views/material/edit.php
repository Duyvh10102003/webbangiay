<?php include __DIR__ . '/../shares/header.php'; ?>

<h1 class="text-center mb-4">Chỉnh Sửa Nguyên Liệu</h1>

<hr />

<div class="row">
    <div class="col-md-6 mx-auto">
        <form id="brand-form">
            <div class="text-danger mb-4" id="validation-summary"></div>

            <div class="form-group mb-3">
                <label for="name" class="control-label">Tên Nguyên Liệu</label>
                <input id="name" name="name" class="form-control" />
            </div>

            <!-- Nút hành động -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Lưu Thay Đổi</button>
                <a href="brands.php" class="btn btn-secondary btn-lg ml-3">Quay về danh sách</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>

<script>
    $(document).ready(function() {
        const brandId = new URLSearchParams(window.location.search).get('id');

        if (!brandId) {
            alert("Không tìm thấy ID Nguyên Liệu!");
            window.location.href = "http://localhost/webbangiay/frontEnd/admin/views/material/materials.php";
            return;
        }

        // Lấy thông tin Nguyên Liệu hiện tại
        $.get(`http://localhost/webbangiay/api/material/${brandId}`, function(data) {
            $("#name").val(data.name);
        });

        // Gửi yêu cầu cập nhật Nguyên Liệu qua AJAX
        $("#brand-form").submit(function(e) {
            e.preventDefault();

            let brandData = {
                name: $("#name").val().trim()
            };

            $.ajax({
                url: `http://localhost/webbangiay/api/material/${brandId}`,
                method: "PUT",
                contentType: "application/json",
                data: JSON.stringify(brandData),
                success: function(response) {
                    alert("Cập nhật Nguyên Liệu thành công!");
                    window.location.href = "http://localhost/webbangiay/frontEnd/admin/views/material/materials.php";  
                },
                error: function(xhr) {
                    console.error("Lỗi khi cập nhật Nguyên Liệu:", xhr.responseText);
                    alert("Có lỗi xảy ra khi cập nhật Nguyên Liệu!");
                }
            });
        });
    });
</script>
