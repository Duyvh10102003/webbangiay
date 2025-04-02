<?php
include 'inc/head.php';
include 'inc/header.php';
include 'inc/icon.php';

// Xử lý tìm kiếm bằng PHP trước
$searchResults = [];
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    // Gọi model để lấy kết quả
    require_once '../app/models/ShoesModel.php';
    $shoeModel = new ShoesModel(); // Đã sửa ở đây
    $searchResults = $shoeModel->search($searchQuery); // Thêm dòng này để thực hiện tìm kiếm
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Kết quả tìm kiếm</h2>
        <form id="main-search-form" action="search.php" method="get">
            <input type="text" name="search" id="main-search-input" 
                   value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                   placeholder="Nhập tên sản phẩm...">
            <button type="submit">Tìm kiếm</button>
        </form>
        
        <div class="search-results">
            <?php if (isset($_GET['search'])): ?>
                <?php if (empty($searchResults)): ?>
                    <p>Không tìm thấy sản phẩm nào.</p>
                <?php else: ?>
                    <?php foreach ($searchResults as $product): ?>
                        <div class="product-item">
                            <img src="<?= $product['path_image'] ?>" alt="<?= $product['title'] ?>">
                            <h3><a href="single-product.php?id=<?= $product['id'] ?>"><?= $product['title'] ?></a></h3>
                            <p>Giá: <?= number_format($product['price'], 0, ',', '.') ?> VND</p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'inc/footer.php'; ?>
</body>
</html>