

<?php include __DIR__ . '/../shares/header.php'; ?>

<h2 class="text-center mb-4">Danh sách giày</h2>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="create.php" class="btn btn-success btn-lg">Thêm Mới</a>
   
  
</div>

<table id="books" class="table table-striped table-bordered table-hover">
    <thead class="thead-dark text-center">
        <tr>
            <th class="align-top">
                <i class="fa-solid fa-image"></i>
                Hình ảnh
            </th>
            <th class="align-top">
                <a href="">
                    <i class="fa-solid fa-book"></i> ID
                   
                </a>
            </th>
            <th class="align-top">
                <a href="">
                    <i class="fa-solid fa-book"></i> Tên Giày
                   
                </a>
            </th>
            
            <th class="align-top">
                <a href="">
                    <i class="fa-solid fa-dollar-sign"></i> Giá
                <a>
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
            <form id="addForm" method="post" asp-action="AddQuantity">
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
  const API_URL = "http://localhost/saleshoe/api/product";

// Load danh sách sản phẩm
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
            <td><img src="${product.path_image}" alt="Product Image" width="100"></td>
            <td>${product.id}</td>
            <td class="text-left">${product.title}</td>
            <td>${parseFloat(product.price).toLocaleString()} VND</td>
            <td>
              <button class="btn btn-warning btn-sm action-btn edit-btn" data-id="${product.id}" data-title="${product.title}" data-description="${product.description}" data-price="${product.price}" data-type="${product.type}" data-brain="${product.brain}" data-manufacture="${product.manufacture}" data-material="${product.material}" data-path_image="${product.path_image}">Chỉnh Sửa</button>
              <button class="btn btn-info btn-sm action-btn details-btn" data-id="${product.id}">Chi Tiết</button>
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



// Load sản phẩm khi trang được tải
$(document).ready(function() {
  loadProducts();
});

    </script>

</body>

</html>