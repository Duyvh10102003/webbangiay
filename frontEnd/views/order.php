<?php

session_start();

// Lấy dữ liệu giỏ hàng từ localStorage (frontend đã lưu)
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

?>

<!DOCTYPE html>
<html lang="vi">
<head>

<title>Spark - Shoes Store Website </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/vendor.css">
  <!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<?php
  include 'inc/header.php';
  include 'inc/icon.php';
  ?>
<div class="container">
    <h2 class="text-center mb-4">Order Summary</h2>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="order-details">
            <!-- Dữ liệu sẽ được thêm bằng JavaScript -->
        </tbody>
    </table>

    <p class="fw-bold fs-5 text-end">Total Price: <span id="total-price"></span> VND</p>

    <form id="order-form" class="text-center">
        <input type="hidden" name="user_id" id="user_id" value="">
        <button type="submit" class="btn btn-success w-100">Confirm Order</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Lấy user_id từ localStorage
        const user_id = localStorage.getItem("user_id") || 0;
        document.getElementById("user_id").value = user_id;

        // Lấy giỏ hàng từ localStorage
        const cart = JSON.parse(localStorage.getItem("cart")) || {};
        const orderDetails = document.getElementById("order-details");
        const totalPriceElement = document.getElementById("total-price");
        let total = 0;

        Object.keys(cart).forEach(product_id => {
            const product = cart[product_id];
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${product_id}</td>
                <td>${product.quantity}</td>
                <td>${product.price.toLocaleString('vi-VN')} VND</td>
                <td>${(product.quantity * product.price).toLocaleString('vi-VN')} VND</td>
            `;

            orderDetails.appendChild(row);
            total += product.quantity * product.price;
        });

        totalPriceElement.textContent = total.toLocaleString('vi-VN');

        // Xử lý khi nhấn nút "Confirm Order"
        document.getElementById("order-form").addEventListener("submit", function (event) {
            event.preventDefault();

            fetch("http://localhost/webbangiay/api/order", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    user_id: user_id,
                    cart: cart
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert("Đặt hàng thành công!");
                    localStorage.removeItem("cart");
                    window.location.href = "index.php";
                } else {
                    alert("Có lỗi xảy ra khi đặt hàng!");
                }
            })
            .catch(error => console.error("Lỗi gửi đơn hàng:", error));
        });
    });
</script>
<?php
  include 'inc/footer.php';

  ?>
</body>
</html>
