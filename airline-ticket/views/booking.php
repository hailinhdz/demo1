<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if ($flight): ?>
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4><i class="fas fa-ticket-alt"></i> Đặt Vé Máy Bay</h4>
                    </div>
                    <div class="card-body">
                        <!-- Flight Info -->
                        <div class="flight-info mb-4 p-3 bg-light rounded">
                            <h5>Thông tin chuyến bay</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Mã chuyến bay:</strong> <?php echo $flight['flight_code']; ?></p>
                                    <p><strong>Tuyến bay:</strong> <?php echo $flight['departure_city']; ?> → <?php echo $flight['arrival_city']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Khởi hành:</strong> <?php echo formatDateTime($flight['departure_time']); ?></p>
                                    <p><strong>Giá vé:</strong> <span class="text-danger"><?php echo formatPrice($flight['price']); ?></span></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Booking Form -->
                        <form method="POST" action="index.php?action=confirm" id="bookingForm">
                            <input type="hidden" name="flight_id" value="<?php echo $flight['id']; ?>">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" required 
                                           placeholder="Nhập họ và tên">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" required 
                                           placeholder="Nhập email">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" class="form-control" required 
                                           placeholder="Nhập số điện thoại">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Số hành khách</label>
                                    <select name="passengers" class="form-select" id="passengers">
                                        <?php for($i = 1; $i <= min(9, $flight['available_seats']); $i++): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?> người</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Total Price -->
                            <div class="total-section p-3 bg-primary text-white rounded mb-3">
                                <div class="row">
                                    <div class="col">
                                        <h5>Tổng tiền: <span id="totalPrice"><?php echo formatPrice($flight['price']); ?></span></h5>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg me-2">
                                    <i class="fas fa-check"></i> Xác Nhận Đặt Vé
                                </button>
                                <a href="javascript:history.back()" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left"></i> Quay Lại
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">
                    <h4>Lỗi!</h4>
                    <p>Không tìm thấy thông tin chuyến bay hoặc chuyến bay đã hết vé.</p>
                    <a href="index.php" class="btn btn-primary">Về Trang Chủ</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passengersSelect = document.getElementById('passengers');
    const totalPriceSpan = document.getElementById('totalPrice');
    const basePrice = <?php echo $flight['price'] ?? 0; ?>;
    
    passengersSelect.addEventListener('change', function() {
        const passengers = parseInt(this.value);
        const totalPrice = basePrice * passengers;
        totalPriceSpan.textContent = new Intl.NumberFormat('vi-VN').format(totalPrice) + ' VNĐ';
    });
});
</script>
