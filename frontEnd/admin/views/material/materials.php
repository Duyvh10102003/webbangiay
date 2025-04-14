<?php include __DIR__ . '/../shares/header.php'; ?>

<h2 class="text-center mb-4">Danh sách nguyên liệu</h2>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="http://localhost/webbangiay/frontEnd/admin/views/material/create.php" class="btn btn-success btn-lg">Thêm Mới</a>
   
  
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
                <i class="fa-solid fa-book"></i> Tên nguyên liệu
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


<?php include __DIR__ . '/../shares/footer.php'; ?>

               
    <script>
<<<<<<< HEAD
  const API_URL = "http://localhost/webbangiay/api/material"; // Địa chỉ API để lấy danh sách chất liệu

// Load danh sách chất liệu
=======
  const API_URL = "http://localhost/webbangiay/api/material"; 

>>>>>>> master
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


<<<<<<< HEAD

// Load chất liệu khi trang được tải
=======
>>>>>>> master
$(document).ready(function() {
  loadProducts();
});
//
$(document).on("click", ".edit-btn", function() {
    let productId = $(this).data("id");  
    window.location.href = `edit.php?id=${productId}`;  
});

// Xóa chất liệu
$(document).on("click", ".delete-btn", function() {
    let productId = $(this).data("id");
    if (confirm("Bạn có chắc chắn muốn xóa chất liệu?")) {
        $.ajax({
            url: `${API_URL}/${productId}`, 
            method: "DELETE",
            success: function(response) {
<<<<<<< HEAD
                alert("Xóa chất liệu thành công!");
                loadProducts(); // Tải lại danh sách chất liệu
=======
                alert("Xóa thành công!");
                loadProducts(); 
>>>>>>> master
            },
            error: function(xhr) {
                console.error("Lỗi khi :", xhr.responseText);
                alert("Có lỗi xảy ra khi xóa !");
            }
        });
    }
});


    </script>

</body>

</html>