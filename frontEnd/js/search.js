document.addEventListener("DOMContentLoaded", function() {
    const searchForm = document.getElementById("search-form");
    const searchInput = document.getElementById("search-input");

    // Ngăn chặn reload khi nhấn Enter
    searchInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Ngăn form submit mặc định
            searchProduct();
        }
    });

    // Ngăn chặn submit form về trang chủ
    searchForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Ngăn form reload
        searchProduct();
    });

    function searchProduct() {
        const searchQuery = searchInput.value.trim();
        if (!searchQuery) {
            alert("Vui lòng nhập từ khóa tìm kiếm!");
            return;
        }

        fetch(`http://localhost/webbangiay/api/shoe?search=${encodeURIComponent(searchQuery)}`)
            .then(response => response.json())
            .then(data => displayResults(data))
            .catch(error => console.error("Lỗi khi tìm kiếm:", error));
    }

    function displayResults(products) {
        const resultsContainer = document.querySelector(".search-results");
        resultsContainer.innerHTML = ""; // Xóa kết quả cũ

        if (!products || products.length === 0) {
            resultsContainer.innerHTML = "<p>Không tìm thấy sản phẩm nào.</p>";
            return;
        }

        products.forEach(product => {
            const productItem = `
              <div class='product-item'>
                  <img src='${product.path_image}' alt='Sản phẩm'>
                  <h3><a href='single-product.php?id=${product.id}'>${product.title}</a></h3>
                  <p>Giá: ${new Intl.NumberFormat("vi-VN").format(product.price)} VND</p>
              </div>
          `;
            resultsContainer.innerHTML += productItem;
        });
    }
});