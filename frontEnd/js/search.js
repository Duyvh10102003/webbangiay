document.addEventListener("DOMContentLoaded", function() {
    // Xử lý search trong header
    const headerSearchForm = document.getElementById("header-search-form");
    const headerSearchInput = document.getElementById("header-search-input");
    const headerSearchButton = document.getElementById("header-search-button");

    // Xử lý search trong trang search.php
    const mainSearchForm = document.getElementById("main-search-form");
    const mainSearchInput = document.getElementById("main-search-input");
    const mainSearchButton = document.getElementById("main-search-button");
    const resultsContainer = document.getElementById("search-results");

    // Xử lý sự kiện cho header search
    if (headerSearchForm) {
        headerSearchButton.addEventListener("click", () => handleSearch(headerSearchInput.value, false));
        headerSearchInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                handleSearch(headerSearchInput.value, false);
            }
        });
    }

    // Xử lý sự kiện cho main search
    if (mainSearchForm) {
        mainSearchButton.addEventListener("click", () => handleSearch(mainSearchInput.value, true));
        mainSearchInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                handleSearch(mainSearchInput.value, true);
            }
        });
    }

    function handleSearch(query, isMainSearch) {
        const searchQuery = query.trim();

        if (!searchQuery) {
            alert("Vui lòng nhập từ khóa tìm kiếm!");
            return;
        }

        if (isMainSearch) {
            // Hiển thị loading
            if (resultsContainer) resultsContainer.innerHTML = "<div class='loading'>Đang tìm kiếm...</div>";

            // Gọi API
            fetch(`/webbangiay/api/shoe?search=${encodeURIComponent(searchQuery)}`)
                .then(response => {
                    if (!response.ok) throw new Error("Lỗi kết nối");
                    return response.json();
                })
                .then(data => {
                    if (resultsContainer) {
                        if (data.message && !Array.isArray(data)) {
                            resultsContainer.innerHTML = `<p class="error">${data.message}</p>`;
                        } else {
                            displayResults(data);
                        }
                    }
                    // Cập nhật URL
                    window.location.href = `/webbangiay/frontEnd/views/search.php?search=${encodeURIComponent(searchQuery)}`;
                })
                .catch(error => {
                    console.error("Lỗi:", error);
                    if (resultsContainer) resultsContainer.innerHTML = `<p class="error">Có lỗi xảy ra</p>`;
                });
        } else {
            // Chuyển hướng đến trang search với từ khóa
            window.location.href = `/webbangiay/frontEnd/views/search.php?search=${encodeURIComponent(searchQuery)}`;
        }
    }

    function displayResults(products) {
        if (!resultsContainer) return;

        if (!products || products.length === 0) {
            resultsContainer.innerHTML = "<p class='no-results'>Không tìm thấy sản phẩm nào.</p>";
            return;
        }

        let html = "";
        products.forEach(product => {
            html += `
                <div class="product-item">
                    <img src="${product.path_image}" alt="${product.title}">
                    <h3><a href="single-product.php?id=${product.id}">${product.title}</a></h3>
                    <p>Giá: ${formatPrice(product.price)} VND</p>
                </div>
            `;
        });

        resultsContainer.innerHTML = html;
    }

    function formatPrice(price) {
        return new Intl.NumberFormat("vi-VN").format(price || 0);
    }
});