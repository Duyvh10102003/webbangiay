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
    // Gửi form qua AJAX
    $("#product-form").submit(function(e) {
        e.preventDefault();  // Ngăn chặn reload trang

        let title = $("#title").val().trim();
        if (!title) {
            alert('Tên brand không được để trống.');
            return;
        }

        // Dữ liệu gửi đi dưới dạng JSON
        let brandData = {
            title: title
        };

        // Gửi yêu cầu AJAX
        $.ajax({
            url: "http://localhost/webbangiay/api/brand", // Đảm bảo API đúng
            method: "POST",
            contentType: "application/json",  // Xác định kiểu dữ liệu gửi
            data: JSON.stringify(brandData),  // Chuyển object thành JSON
            success: function(response) {
                if (response.error) {
                    alert("Lỗi: " + response.error);
                } else {
                    alert("Thêm Brand thành công!"); 
                    window.location.href = "http://localhost/webbangiay/frontEnd/admin/views/brands/brands.php";  
                }
            },
            error: function(xhr) {
                console.error("Lỗi khi thêm Brand:", xhr.responseText);
                alert("Có lỗi xảy ra khi thêm Brand!");
            }
        });
    });
</script>

