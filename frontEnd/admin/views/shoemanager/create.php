<?php include __DIR__ . '/../shares/header.php'; ?>

<h1 class="text-center mb-4">Thêm Giày Mới</h1>

<hr />

<div class="row">
    <div class="col-md-10 mx-auto">
        <form id="product-form" method="post" enctype="multipart/form-data">
            <div class="text-danger mb-4" id="validation-summary"></div>

            <div class="row">
                <!-- Cột trái -->
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="title" class="control-label">Tên giày</label>
                        <input id="title" name="title" class="form-control" />
                        <span id="title-validation" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="type_id" class="control-label">Thể loại</label>
                        <select id="type_id" name="type_id" class="form-control">
                            <!-- Options sẽ được thêm thông qua API -->
                        </select>
                        <span id="type-validation" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="control-label">Miêu tả</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                        <span id="description-validation" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price" class="control-label">Giá</label>
                        <input id="price" name="price" type="number" class="form-control" />
                        <span id="price-validation" class="text-danger"></span>
                    </div>
                </div>

                <!-- Cột phải -->
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="brand_id" class="control-label">Thương hiệu</label>
                        <select id="brand_id" name="brand_id" class="form-control">
                            <!-- Options sẽ được thêm thông qua API -->
                        </select>
                        <span id="brand-validation" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="material_id" class="control-label">Chất liệu</label>
                        <select id="material_id" name="material_id" class="form-control">
                            <!-- Options sẽ được thêm thông qua API -->
                        </select>
                        <span id="material-validation" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="manufacturer_id" class="control-label">Nhà sản xuất</label>
                        <select id="manufacturer_id" name="manufacturer_id" class="form-control">
                            <!-- Options sẽ được thêm thông qua API -->
                        </select>
                        <span id="manufacturer-validation" class="text-danger"></span>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="path_image" class="control-label">Hình ảnh giày</label>
                        <input type="file" id="path_image" name="path_image" class="form-control" />
                        <span id="image-validation" class="text-danger"></span>
                    </div>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="text-center mt-4">
                <input type="submit" value="Thêm" class="btn btn-success btn-lg" />
                <a href="index.php" class="btn btn-secondary btn-lg ml-3">Quay về danh sách</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>

<script>
    $(document).ready(function() {
        // Lấy dữ liệu thể loại từ API
        $.get('http://localhost/webbangiay/api/type', function(data) {
            data.forEach(type => {
                $('#type_id').append(`<option value="${type.id}">${type.name}</option>`);
            });
        });

        // Lấy dữ liệu thương hiệu từ API
        $.get('http://localhost/webbangiay/api/brand', function(data) {
            data.forEach(brand => {
                $('#brand_id').append(`<option value="${brand.id}">${brand.name}</option>`);
            });
        });

        // Lấy dữ liệu chất liệu từ API
        $.get('http://localhost/webbangiay/api/material', function(data) {
            data.forEach(material => {
                $('#material_id').append(`<option value="${material.id}">${material.name}</option>`);
            });
        });
        $.get('http://localhost/webbangiay/api/manufacturer', function(data) {
            data.forEach(manufacturer => {
                $('#manufacturer_id').append(`<option value="${manufacturer.id}">${manufacturer.name}</option>`);
            });
        });
    });

    // Gửi form qua AJAX
    $("#product-form").submit(function(e) {
        e.preventDefault();  // Ngừng hành động mặc định của form

        // Kiểm tra trường dữ liệu bắt buộc
        if (!$("#title").val() || !$("#description").val() || !$("#price").val()) {
            alert('Tên giày, mô tả và giá không được để trống.');
            return;
        }

        // Tạo đối tượng FormData để gửi dữ liệu của form, bao gồm cả file ảnh
        let formData = new FormData(this);

        // Gửi yêu cầu AJAX
        $.ajax({
            url: "http://localhost/webbangiay/api/shoe", // Đảm bảo URL này là chính xác
            method: "POST",
            data: formData,
            processData: false,  // Không xử lý dữ liệu tự động
            contentType: false,  // Không tự động đặt content-type
            success: function(response) {
                alert("Thêm giày thành công!");
                window.location.href = "index.php";  // Quay về trang danh sách
            },
            error: function(xhr) {
                console.error("Lỗi khi thêm giày:", xhr.responseText);
                alert("Có lỗi xảy ra khi thêm giày!");
            }
        });
    });
</script>