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
            <input type="hidden" name="user_Id" id="user_Id" value="">
            <button type="submit" class="btn btn-success w-100">Confirm Order</button>
        </form>
    </div>
    <!-- Modal Lựa chọn phương thức thanh toán -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel">Chọn phương thức thanh toán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body text-center">
                    
                    <!-- Lựa chọn phương thức -->
                    <div class="mb-3">
                        <button class="btn btn-outline-primary me-2" id="btn-bank">Ngân hàng</button>
                        <button class="btn btn-outline-warning" id="btn-momo">Momo</button>
                    </div>

                    <!-- QR Code sẽ thay đổi -->
                    <div id="qr-image-container" class="mb-3 d-none">
                        <img id="qr-image" src="" alt="QR Code Thanh toán" class="img-fluid" style="max-height: 300px;">
                    </div>
                    <h3 class="text-danger fs-5 mb-3">
                        Vui lòng nhập đầy đủ họ tên và số điện thoại vào phần nội dung chuyển khoản để chúng tôi liên hệ giao hàng.
                    </h3>
                    <!-- Nút xác nhận thanh toán -->
                    <button type="button" class="btn btn-success w-100 d-none" id="btn-confirm-after-payment">Tôi đã thanh toán</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Lấy user_id từ localStorage
            const userInfo = JSON.parse(localStorage.getItem("userInfo"));
            const user_id = userInfo.id;
            document.getElementById("user_Id").value = user_id;
            console.log("User ID từ localStorage:", localStorage.getItem("userInfo"));

            // Lấy giỏ hàng từ localStorage
            const cartObject = JSON.parse(localStorage.getItem("cart")) || {};
            const orderDetails = document.getElementById("order-details");
            const totalPriceElement = document.getElementById("total-price");
            let total = 0;

            // Chuyển đổi object -> array và lọc theo user_id
            const cartArray = Object.keys(cartObject)
                .filter(cartUserId => cartUserId === user_id) // Lọc theo user_id
                .map(cartUserId => {
                    return Object.keys(cartObject[cartUserId]).map(product_id => ({
                        user_id: cartUserId,
                        product_id: product_id,
                        quantity: parseInt(cartObject[cartUserId][product_id].quantity, 10),
                        price: parseInt(cartObject[cartUserId][product_id].price, 10)
                    }));
                }).flat();

            console.log("Giỏ hàng sau khi chuyển đổi:", cartArray);

            // Hiển thị giỏ hàng trong bảng HTML
            cartArray.forEach(product => {
                const row = document.createElement("tr");
                row.innerHTML = `
        <td>${product.product_id}</td>
        <td>${product.quantity}</td>
        <td>${product.price.toLocaleString('vi-VN')} VND</td>
        <td>${(product.quantity * product.price).toLocaleString('vi-VN')} VND</td>
    `;
                orderDetails.appendChild(row);
                total += product.quantity * product.price;
            });

            // Hiển thị tổng giá trong phần tử tổng giá
            totalPriceElement.textContent = total.toLocaleString('vi-VN');


            // Xử lý khi nhấn nút "Confirm Order"
            document.getElementById("order-form").addEventListener("submit", function(event) {
    event.preventDefault();
    
    // Hiển thị modal chọn phương thức thanh toán
    const qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
    qrModal.show();

    const qrImage = document.getElementById("qr-image");
    const qrContainer = document.getElementById("qr-image-container");
    const confirmBtn = document.getElementById("btn-confirm-after-payment");

    // Xử lý khi người dùng chọn ngân hàng
    document.getElementById("btn-bank").onclick = () => {
        qrImage.src = "../images/bank.jpg"; // đường dẫn ảnh QR ngân hàng
        qrContainer.classList.remove("d-none");
        confirmBtn.classList.remove("d-none");
    };

    // Xử lý khi người dùng chọn momo
    document.getElementById("btn-momo").onclick = () => {
        qrImage.src = "../images/momo.jpg"; // đường dẫn ảnh QR Momo
        qrContainer.classList.remove("d-none");
        confirmBtn.classList.remove("d-none");
    };

    // Sau khi người dùng đã thanh toán
    confirmBtn.onclick = function () {
        const orderData = {
            user_id: user_id,
            cart: cartArray
        };

        fetch("http://localhost/webbangiay/api/order", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.text())
        .then(data => {
            try {
                const jsonData = JSON.parse(data);
                if (jsonData.status === "success") {
                    alert("Đặt hàng thành công!");
                    localStorage.removeItem("cart");
                    window.location.href = "index.php";
                } else {
                    alert("Có lỗi xảy ra khi đặt hàng: " + jsonData.message);
                }
            } catch (error) {
                console.error("Lỗi phân tích JSON:", error);
            }
        })
        .catch(error => console.error("Lỗi gửi đơn hàng:", error));
    };
});

        });
    </script>
    <?php
    include 'inc/footer.php';

    ?>
</body>

</html>