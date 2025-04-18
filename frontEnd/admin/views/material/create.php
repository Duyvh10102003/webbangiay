<?php include __DIR__ . '/../shares/header.php'; ?>

<h1 class="text-center mb-4">Thêm Nguyên Liệu Mới</h1>

<hr />

<div class="row">
    <div class="col-md-10 mx-auto">
        <form id="brand-form">
            <div class="text-danger mb-4" id="validation-summary"></div>

            <div class="row">
                <!-- Cột trái -->
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name" class="control-label">Tên Nguyên Liệu</label>
                        <input id="name" name="name" class="form-control" />
                        <span id="name-validation" class="text-danger"></span>
                    </div>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg">Thêm</button>
                <a href="materials.php" class="btn btn-secondary btn-lg ml-3">Quay về danh sách</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>

<script> 
    $(document).ready(function() {
        $("#brand-form").submit(function(e) {
            e.preventDefault();  // Ngăn chặn reload trang

            let brandName = $("#name").val().trim();
            if (!brandName) {
                alert("Tên nguyên liệu không được để trống.");
                return;
            }

            let requestData = { name: brandName };

            $.ajax({
                url: "http://localhost/webbangiay/api/material", 
                method: "POST",
                contentType: "application/json", // Định dạng JSON
                data: JSON.stringify(requestData), // Chuyển dữ liệu thành JSON
                success: function(response) {
                    alert("Thêm nguyên liệu thành công!");
                    window.location.href = "http://localhost/webbangiay/frontEnd/admin/views/material/materials.php";  
                },
                error: function(xhr) {
                    console.error("Lỗi khi thêm nguyê liệu:", xhr.responseText);
                    alert("Có lỗi xảy ra khi thêm nguyên liệu!");
                }
            });
        });
    });
</script>
