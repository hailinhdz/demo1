<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Website Bán Vé Máy Bay'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-plane"></i> Lingkvivu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Trang Chủ</a>
                    </li>
                </ul>
                <!-- Thêm icon giỏ hàng -->
                <div class="ms-auto">
                    <a href="index.php?action=cart" class="btn btn-outline-light position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                            <?php 
                            $cartCount = 0;
                            foreach ($_SESSION['cart'] as $item) {
                                $cartCount += $item['quantity'];
                            }
                            ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $cartCount; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <main class="py-4">

<!-- // ===== FILE: views/layout/footer.php =====
    </main>
    
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p>&copy; 2025 AirlineBooking. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html> -->