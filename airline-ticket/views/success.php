<?php require_once 'views/layout/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    <i class="fas fa-check-circle text-success display-1 mb-4"></i>
                    <h2 class="mb-4">Đặt Vé Thành Công!</h2>
                    <p class="lead mb-4">Cảm ơn bạn đã đặt vé. Thông tin chi tiết đã được gửi vào email của bạn.</p>
                    <div class="booking-details mt-4 text-start p-4 bg-light rounded">
                        <h4>Thông tin đặt vé:</h4>
                        <p><strong>Mã đặt vé:</strong> <?php echo $booking['booking_code'] ?? ''; ?></p>
                        <p><strong>Chuyến bay:</strong> <?php echo $flight['flight_code'] ?? ''; ?></p>
                        <p><strong>Hành khách:</strong> <?php echo $booking['passenger_name'] ?? ''; ?></p>
                        <p><strong>Số lượng vé:</strong> <?php echo $booking['passengers'] ?? '1'; ?></p>
                        <p><strong>Tổng tiền:</strong> <?php echo isset($booking['total_amount']) ? number_format($booking['total_amount'], 0, ',', '.') . ' VNĐ' : ''; ?></p>
                    </div>
                    <div class="mt-4">
                        <a href="index.php" class="btn btn-primary btn-lg me-2">
                            <i class="fas fa-home"></i> Về Trang Chủ
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-lg" onclick="window.print()">
                            <i class="fas fa-print"></i> In Thông Tin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
