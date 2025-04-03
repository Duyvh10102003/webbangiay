<?php include __DIR__ . '/../shares/header.php'; ?>

<h2 class="text-center mb-4">Danh sách thương hiệu</h2>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="http://localhost/webbangiay/frontEnd/admin/views/brands/create.php" class="btn btn-success btn-lg">Thêm Mới</a>
   
  
</div>

<table id="books" class="table table-striped table-bordered table-hover">
    <thead class="thead-dark text-center">
        <tr>
            <th class="align-top">
                <a href="">
                    <i class="fa-solid fa-book"></i> ID
                </a>
            </th>
            <th class="align-top">
                <i class="fa-solid fa-book"></i> Tên thương hiệu
            </th>
            <th class="align-top">
                <i class="fa-solid fa-cogs"></i> Hành Động
            </th>
        </tr>
    </thead>


    <tbody class="text-center" id="product-list">
        <!-- Dữ liệu sẽ được load vào đây -->
    </tbody>
</table>

<!-- PHÂN TRANG -->
<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
           
        </ul>
    </nav>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm số lượng sách</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addForm" method="post" asp-action="AddQuantity" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="BookId" id="addBookId" />
                    <div class="form-group">
                        <label for="addBookQuantity">Số lượng thêm</label>
                        <input type="number" class="form-control" id="addBookQuantity" name="AddQuantity" min="1" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include __DIR__ . '/../shares/footer.php'; ?>

               
    <script>
  const API_URL = "http://localhost/webbangiay/api/brand"; // Địa chỉ API để lấy danh sách thương hiệu

// Load danh sách thương hiệu
function loadProducts() {
  $.ajax({
    url: API_URL,
    method: "GET",
    dataType: "json",
    success: function(response) {
      let html = "";
      $.each(response, function(index, product) {
        html += `
          <tr>
            <td>${product.id}</td>
            <td class="text-left">${product.name}</td>
            <td>
              <button class="btn btn-warning btn-sm action-btn edit-btn" data-id="${product.id}">Chỉnh Sửa</button>
              <button class="btn btn-danger btn-sm action-btn delete-btn" data-id="${product.id}">Xóa</button>
            </td>
          </tr>
        `;
      });
      $("#product-list").html(html);
    },
    error: function(xhr, status, error) {
      console.error("Lỗi khi gọi API:", error);
      console.log("Phản hồi từ server:", xhr.responseText);
    }
  });
}



// Load thương hiệu khi trang được tải
$(document).ready(function() {
  loadProducts();
});
//
$(document).on("click", ".edit-btn", function() {
    let productId = $(this).data("id");  // Lấy ID giày cần chỉnh sửa
    window.location.href = `edit.php?id=${productId}`;  // Chuyển hướng đến trang edit.php
});

// Xóa thương hiệu
$(document).on("click", ".delete-btn", function() {
    let productId = $(this).data("id");
    if (confirm("Bạn có chắc chắn muốn xóa thương hiệu này?")) {
        $.ajax({
            url: `${API_URL}/${productId}`, // Gửi yêu cầu DELETE đến API
            method: "DELETE",
            success: function(response) {
                alert("Xóa thương hiệu thành công!");
                loadProducts(); // Tải lại danh sách thương hiệu
            },
            error: function(xhr) {
                console.error("Lỗi khi xóa thương hiệu:", xhr.responseText);
                alert("Có lỗi xảy ra khi xóa thương hiệu!");
            }
        });
    }
});


    </script>

</body>

</html>