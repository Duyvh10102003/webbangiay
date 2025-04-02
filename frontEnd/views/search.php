<?php
include 'inc/head.php';
include 'inc/header.php';
include 'inc/icon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../../frontEnd/js/search.js" defer></script> <!-- Nhúng file JS -->
</head>
<body>
    <div class="container">
        <h2>Kết quả tìm kiếm</h2>
        <form id="search-form">
            <input type="text" id="search-input" placeholder="Nhập tên sản phẩm...">
            <button type="submit">Tìm kiếm</button>
        </form>
        
        <div class="search-results">
            <!-- Kết quả tìm kiếm sẽ được cập nhật ở đây bằng JS -->
        </div>
    </div>

    <?php include 'inc/footer.php'; ?>
</body>
</html>
