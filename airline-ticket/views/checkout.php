<div class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-credit-card"></i> Thông Tin Thanh Toán</h4>
                </div>
                <div class="card-body">
                    <form action="index.php?action=process-payment" method="POST" id="payment-form">
                        <!-- Thông tin người đặt -->
                        <h5 class="mb-3">Thông tin người đặt</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="customer_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="customer_email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" name="customer_phone" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" name="customer_address" class="form-control">
                            </div>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <h5 class="mb-3">Phương thức thanh toán</h5>
                        <div class="mb-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" checked>
                                <label class="form-check-label" for="bank_transfer">
                                    Chuyển khoản ngân hàng
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="momo" value="momo">
                                <label class="form-check-label" for="momo">
                                    Ví MoMo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="vnpay" value="vnpay">
                                <label class="form-check-label" for="vnpay">
                                    VNPay
                                </label>
                            </div>
                        </div>

                        <!-- Nút thanh toán -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-lock"></i> Thanh Toán An Toàn
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tổng quan đơn hàng -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Tổng Quan Đơn Hàng</h5>
                </div>
                <div class="card-body">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <strong><?php echo $item['info']['flight_code']; ?></strong><br>
                                <small><?php echo $item['info']['departure_airport']; ?> → <?php echo $item['info']['arrival_airport']; ?></small><br>
                                <small><?php echo date('d/m/Y H:i', strtotime($item['info']['departure_time'])); ?></small>
                            </div>
                            <div class="text-end">
                                <span><?php echo number_format($item['info']['price'] * $item['quantity'], 0, ',', '.'); ?> VNĐ</span><br>
                                <small class="text-muted"><?php echo $item['quantity']; ?> vé</small>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tổng tiền vé:</span>
                        <strong><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí dịch vụ:</span>
                        <strong>0 VNĐ</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-0">
                        <h5>Tổng cộng:</h5>
                        <h5 class="text-success"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
