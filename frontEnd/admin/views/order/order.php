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
            <td class="order-toggle" data-id="${product.order_id}" style="cursor: pointer; color: blue;">
  ${product.order_id}
</td>
            <td class="text-left">${product.UserName}</td>
            <td class="text-left">${product.total_quantity}</td>
            <td class="text-left">${parseFloat(product.total_price).toLocaleString()} VND</td>
            
            <td class="text-left">${product.status}</td>
            <td class="text-left">${product.created_at}</td>
            <td>
              <button class="btn btn-warning btn-sm action-btn verify-btn" data-id="${product.order_id}"> Xác nhận</button>
              <button class="btn btn-danger btn-sm action-btn delete-btn" data-id="${product.order_id}">Hủy đơn</button>
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



    // Khi trang tải
    $(document).ready(function() {
        loadProducts();
    });

    // Xác nhận đơn hàng
    $(document).on("click", ".verify-btn", function() {
        let orderId = $(this).data("id");

        if (confirm("Bạn có chắc chắn muốn xác nhận đơn hàng này không?")) {
            $.ajax({
                url: "http://localhost/webbangiay/api/order/payOrder",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    order_id: orderId
                }),
                success: function(response) {
                    if (response.success) {
                        alert("Đơn hàng đã được xác nhận thành công!");
                        loadProducts();
                    } else {
                        alert("Xác nhận thất bại: " + response.message);
                    }
                },
                error: function(xhr) {
                    console.error("Lỗi xác nhận đơn hàng:", xhr.responseText);
                    alert("Có lỗi xảy ra khi xác nhận đơn hàng!");
                }
            });
        }
    });

    // Xoá đơn hàng
    $(document).on("click", ".delete-btn", function () {
  let orderId = $(this).data("id");
  if (confirm("Bạn có chắc chắn muốn xóa đơn hàng " + orderId)) {
    $.ajax({
      url: `http://localhost/webbangiay/api/order/${orderId}`,
      method: "DELETE",
      success: function (response) {
        if (response.status === "success") {
          alert(response.message);
          $(this).closest("tr").remove(); // Xóa dòng đơn hàng trong bảng
        } else {
          alert("Không thể xóa đơn hàng: " + response.message);
        }
      },
      error: function (xhr) {
        console.error("Lỗi khi xóa đơn hàng:", xhr.responseText);
        alert("Có lỗi xảy ra khi xóa đơn hàng!");
      }
    });
  }
});

    $(document).on("click", ".order-toggle", function() {
        const orderId = $(this).data("id");
        const currentRow = $(this).closest("tr");

        // Nếu đã mở rồi thì ẩn lại
        if (currentRow.next().hasClass("order-details-row")) {
            currentRow.next().remove();
            return;
        }

        // Xoá dòng chi tiết cũ nếu có
        $(".order-details-row").remove();

        $.ajax({
            url: `http://localhost/webbangiay/api/order/${orderId}`,
            method: "GET",
            success: function(response) {
                if (response.length > 0) {
                    let html = `
          <tr class="order-details-row">
            <td colspan="8">
              <table class="table table-bordered mb-0">
                <thead>
                  <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                    <th>Thành Tiền</th>
                  </tr>
                </thead>
                <tbody>`;

                    response.forEach(item => {
                        html += `
            <tr>
              <td>${item.product_id}</td>
              <td>${item.quantity}</td>
              <td>${parseFloat(item.price).toLocaleString()} VND</td>
              <td>${parseFloat(item.quantity * item.price).toLocaleString()} VND</td>
              
            </tr>`;
                    });

                    html += `
                </tbody>
              </table>
            </td>
          </tr>`;

                    currentRow.after(html);
                } else {
                    alert("Không có sản phẩm trong đơn hàng này!");
                }
            },
            error: function() {
                alert("Lỗi khi lấy chi tiết đơn hàng!");
            }
        });
    });
</script>

</body>

</html>