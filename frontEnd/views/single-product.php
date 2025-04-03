<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'inc/head.php';
    ?>
    <link rel="stylesheet" href="../css/detail.css" />
</head>

<body>
    <?php
    include 'inc/header.php';
    include 'inc/icon.php';
    ?>

    <div class="container-content-detail">
        <div class="container-sub-2">
            <div class="col-sm-12-detail">
                <div class="content-product-left col-sm-5-detail">
                    <div class="image-single-box">
                        <img id="shoe-image" src="" alt="Ảnh sản phẩm">
                    </div>
                </div>
                <div class="content-product-right col-sm-7-detail">
                    <div class="title-product">
                        <h1 class="title-real" id="shoe-title"></h1>
                        <div class="title-id" id="shoe-id"></div>
                    </div>
                    <div class="desc-product">
                        <div class="col-sm-4-detail">
                            <div class="id-product">
                                <span id="shoe-id-text"></span>
                            </div>
                            <div class="metarial-product">
                                <span id="shoe-material"></span>
                            </div>
                            <div class="brain-product">
                                <span id="shoe-brand"></span>
                            </div>
                            <div class="manufacture-product">
                                <span id="shoe-manufacturer"></span>
                            </div>
                        </div>
                        <div class="col-sm-8-detail">
                            <span class="price">
                                <span class="title-price">Price: </span>
                                <span class="price-real" id="shoe-price"></span>
                            </span>
                            <span class="notify">FREE SHIPPING NATIONWIDE WHEN ORDERING ONLINE</span>

                        </div>
                    </div>
                    <div class="desc-content-product" id="shoe-description"></div>

                    <div class="box-option">
                        <div class="quantity-box">
                            <label for="quantity-product">Quantity</label>
                            <div class="quantity-content">
                                <span class="input-group-addon product_quantity_down"
                                    onclick="up_down_quantity('-')">-</span>
                                <input type="text" id="quantity-product" class="form-control" name="quantity" value="1">
                                <span class="input-group-addon product_quantity_up"
                                    onclick="up_down_quantity('+')">+</span>
                            </div>
                        </div>
                    </div>

                    <div class="box-option">
                        <button class="button-card" id="order-button">BUY</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const shoeId = urlParams.get("id");

            if (shoeId) {
                fetch(`http://localhost/webbangiay/api/shoe/${shoeId}`)
                    .then(response => response.json())
                    .then(shoe => {
                        document.getElementById("shoe-image").src = shoe.path_image;
                        document.getElementById("shoe-title").textContent = shoe.title;
                        document.getElementById("shoe-id").textContent = " - " + shoe.id;
                        document.getElementById("shoe-id-text").textContent = "ID: " + shoe.id;
                        document.getElementById("shoe-material").textContent = "Material: " + shoe.material;
                        document.getElementById("shoe-brand").textContent = "Brand: " + shoe.brand;
                        document.getElementById("shoe-manufacturer").textContent = "Manufacturer: " + shoe.manufacturer;
                        document.getElementById("shoe-price").textContent = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(shoe.price);
                        document.getElementById("shoe-description").textContent = shoe.description;

                        const orderButton = document.getElementById("order-button");
                        const quantityInput = document.getElementById("quantity-product");

                        if (orderButton && quantityInput) {
                            orderButton.onclick = () => {
                                const quantity = parseInt(quantityInput.value, 10) || 0;

                                if (quantity <= 0) {
                                    alert("Vui lòng nhập số lượng hợp lệ.");
                                    return;
                                }

                                add_shop_cart(shoe.id, shoe.price, quantity);
                            };
                        } else {
                            console.error("Lỗi: Không tìm thấy phần tử order-button hoặc quantity-product.");
                        }

                    })
                    .catch(error => console.error("Lỗi khi lấy dữ liệu sản phẩm:", error));
            }
        });

        const up_down_quantity = (operator) => {
            let input_quantity = document.querySelector('#quantity-product');
            let currentValue = parseInt(input_quantity.value) || 1; // Mặc định là 1 nếu giá trị không hợp lệ

            if (operator === '-') {
                currentValue = Math.max(1, currentValue - 1); // Đảm bảo không nhỏ hơn 1
            } else if (operator === '+') {
                currentValue += 1;
            }

            input_quantity.value = currentValue.toString();
            //console.log("up_down_quantity:", currentValue);
        };

        function add_shop_cart(productId, price, quantity) {
            console.log(`Thêm sản phẩm vào giỏ: ID=${productId}, Giá=${price}, Số lượng=${quantity}`);

            // Get user info from local storage
            const userInfoString = localStorage.getItem('userInfo');
            if (!userInfoString) {
                alert("Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.");
                return;
            }

            const userInfo = JSON.parse(userInfoString);
            const userId = userInfo?.id;

            if (!userId) {
                alert("Thông tin người dùng không hợp lệ.");
                return;
            }

            // Ensure quantity is a valid number
            quantity = parseInt(quantity, 10);
            if (isNaN(quantity) || quantity <= 0) {
                alert("Số lượng sản phẩm không hợp lệ.");
                return;
            }

            // Construct the product data object
            const productData = {
                user_id: userId,
                product_id: productId,
                quantity: quantity,
                price: parseFloat(price) // Ensure price is a valid number
            };

            console.log("Gửi dữ liệu sản phẩm:", productData);

            // Send data to API using Fetch API
            fetch('http://localhost/webbangiay/api/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(productData)
            })
                .then(async (response) => {
                    if (!response.ok) {
                        throw new Error(`Lỗi HTTP: ${response.status}`);
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.status === "success") {
                        alert("Sản phẩm đã được thêm vào giỏ hàng!");
                        location.reload(); // Tải lại trang để cập nhật giỏ hàng
                        updateCartUI(data.cart); // Update cart UI
                    } else {
                        alert(`Lỗi khi thêm sản phẩm vào giỏ hàng: ${data.message || "Không xác định"}`);
                    }
                })
                .catch((error) => {
                    console.error("Lỗi khi gửi yêu cầu:", error);
                    alert("Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng. Vui lòng thử lại!");
                });
        }


        // Hàm cập nhật giao diện giỏ hàng
        function updateCartUI(cart) {
            const cartCount = document.querySelector('.badge.bg-primary');
            if (cartCount) {
                cartCount.textContent = Object.keys(cart).length; // Cập nhật số lượng giỏ hàng
            }
        }
    </script>


    <?php
    include 'inc/footer.php';
    ?>

    <script src="../js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/script.js"></script>
</body>