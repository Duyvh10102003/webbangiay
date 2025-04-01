
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
            <span id="shoe-manufacture"></span>
        </div>
    </div>
    <div class="col-sm-8-detail">
        <span class="price">
            <span class="title-price">Giá: </span>
            <span class="price-real" id="shoe-price"></span>
        </span>
        <span class="notify">MIỄN PHÍ VẬN CHUYỂN TOÀN QUỐC KHI ĐẶT HÀNG ONLINE</span>
    </div>
</div>
                <div class="desc-content-product" id="shoe-description"></div>
                <div class="box-option">
                    <div class="quantity-box">
                        <label for="quantity-product">Số lượng</label>
                        <div class="quantity-content">
                            <span class="input-group-addon product_quantity_down" onclick="up_down_quantity('-')">-</span>
                            <input type="text" id="quantity-product" class="form-control" name="quantity" value="1" oninput="change_input_quantity(event)" onblur="blur_input(event)">
                            <span class="input-group-addon product_quantity_up" onclick="up_down_quantity('+')">+</span>
                        </div>
                    </div>
                </div>
                <div class="box-option">
                    <button class="button-card" id="order-button">ĐẶT HÀNG</button>
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
                // Cập nhật các trường dữ liệu
                document.getElementById("shoe-image").src = shoe.path_image;  // Hình ảnh
                document.getElementById("shoe-title").textContent = shoe.title;  // Tên sản phẩm
                document.getElementById("shoe-id").textContent = " - " + shoe.id;  // ID sản phẩm
                document.getElementById("shoe-id-text").textContent = "ID: " + shoe.id;  // ID sản phẩm
                document.getElementById("shoe-material").textContent = "Chất liệu: " + shoe.material_id;  // Chất liệu
                document.getElementById("shoe-brand").textContent = "Thương hiệu: " + shoe.brand_id;  // Thương hiệu
                document.getElementById("shoe-manufacture").textContent = "Sản xuất: " + shoe.manufacturer_id;  // Sản xuất
                document.getElementById("shoe-price").textContent = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(shoe.price);  // Giá
                document.getElementById("shoe-description").textContent = shoe.description;  // Mô tả
                
                // Cập nhật sự kiện cho nút Đặt Hàng
                document.getElementById("order-button").setAttribute("onclick", `add_shop_card(true, '${shoe.id}')`);
            })
            .catch(error => console.error("Lỗi khi lấy dữ liệu sản phẩm:", error));
    }
});
const change_input_quantity = (event) => {
        if (event.data < '0' || event.data > '9') {
            event.target.value = event.target.value.replace(/\D/, '')
        }
    }

    const blur_input = (event) => {
        if (event.target.value === '') {
            // event.target.value = '1'
        } else {
            event.target.value = parseInt(event.target.value).toString()
        }
    }

    const up_down_quantity = (operator) => {
        input_quantity = document.querySelector('#quantity-product')
        if (operator === '-') {
            input_quantity.value = (input_quantity.value <= 0 ? input_quantity.value : parseInt(input_quantity.value) - 1).toString()
        } else if (operator === '+') {
            ++input_quantity.value
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

