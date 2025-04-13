<?php include __DIR__ . '/../shares/header.php'; ?>

<h2 class="text-center mb-4">Danh sách đơn hàng</h2>

<table id="books" class="table table-striped table-bordered table-hover">
    <thead class="thead-dark text-center">
        <tr>
            <th class="align-top">
                <i class="fa-solid fa-book"></i> Mã Đơn Hàng
            </th>
            <th class="align-top">
                <i class="fa-solid fa-book"></i> Người Đặt Hàng
            </th>
            <th class="align-top">
                <i class="fa-solid fa-book"></i> Số Lượng
            </th>
            <th class="align-top">
                <i class="fa-solid fa-book"></i> Giá
            </th>
            <th class="align-top">
                <i class="fa-solid fa-book"></i> Tổng Tiền
            </th>
            <th class="align-top">
                <i class="fa-solid fa-book"></i> Trạng Thái
            </th>
            <th class="align-top">
                <i class="fa-solid fa-book"></i> Ngày Đặt Hàng
            </th>
            <th class="align-top">
                <i class="fa-solid fa-cogs"></i> Xác Nhận Đơn Hàng
            </th>
        </tr>
    </thead>


    <tbody class="text-center" id="product-list">
        <!-- Dữ liệu sẽ được load vào đây -->
    </tbody>
</table>

<?php include __DIR__ . '/../shares/footer.php'; ?>

               
    <script>
  const API_URL = "http://localhost/webbangiay/api/order/manageOrderAdmin"; // Địa chỉ API để lấy danh sách sản phẩm

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
            <td>${product.product_id}</td>
            <td class="text-left">${product.UserName}</td>
            <td class="text-left">${product.quantity}</td>
            <td class="text-left">${product.price}</td>
            <td class="text-left">${product.total_price}</td>
            <td class="text-left">${product.status}</td>
            <td class="text-left">${product.created_at}</td>
            <td>
              <button class="btn btn-warning btn-sm action-btn verify-btn" data-id="${product.id}"> Xác nhận</button>
              <button class="btn btn-danger btn-sm action-btn dalete-btn" data-id="${product.id}"> Hủy đơn</button>
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


// Xóa sản phẩm
$(document).on("click", ".delete-btn", function() {
    let productId = $(this).data("id");
    if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
        $.ajax({
            url: `${API_URL}/${productId}`, // Gửi yêu cầu DELETE đến API
            method: "DELETE",
            success: function(response) {
                alert("Xóa sản phẩm thành công!");
                loadProducts(); // Tải lại danh sách sản phẩm
            },
            error: function(xhr) {
                console.error("Lỗi khi xóa sản phẩm:", xhr.responseText);
                alert("Có lỗi xảy ra khi xóa sản phẩm!");
            }
        });
    }
});


    </script>

</body>

</html>