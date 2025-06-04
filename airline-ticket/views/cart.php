<div class="container my-4">
    <h2 class="mb-4"><i class="fas fa-shopping-cart"></i> Giỏ Hàng</h2>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php 
            echo $_SESSION['error']; 
            unset($_SESSION['error']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info">
            <p class="mb-0">Giỏ hàng của bạn đang trống.</p>
            <a href="index.php" class="btn btn-primary mt-3">Tiếp Tục Tìm Chuyến Bay</a>
        </div>
    <?php else: ?>
        <form action="index.php?action=update-cart" method="POST">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Chuyến Bay</th>
                            <th>Ngày Bay</th>
                            <th>Giá Vé</th>
                            <th>Số Lượng</th>
                            <th>Tổng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>                        <?php foreach ($cartItems as $flightId => $item): ?>
                            <tr class="cart-item" id="cart-item-<?php echo $flightId; ?>">
                                <td>
                                    <strong><?php echo $item['info']['flight_code']; ?></strong><br>
                                    <?php echo $item['info']['departure_airport']; ?> → <?php echo $item['info']['arrival_airport']; ?>
                                </td>
                                <td><?php echo date('d/m/Y H:i', strtotime($item['info']['departure_time'])); ?></td>
                                <td><?php echo number_format($item['info']['price'], 0, ',', '.'); ?> USD</td>
                                <td>
                                    <input type="number" name="quantities[<?php echo $flightId; ?>]" 
                                           value="<?php echo $item['quantity']; ?>" 
                                           min="1" max="<?php echo $item['info']['available_seats']; ?>" 
                                           class="form-control" style="width: 80px">
                                </td>
                                <td><?php echo number_format($item['info']['price'] * $item['quantity'], 0, ',', '.'); ?> VNĐ</td>
                                <td>                    <form action="index.php?action=remove-from-cart" method="POST" class="d-inline">
                                        <input type="hidden" name="flight_id" value="<?php echo $flightId; ?>">
                                        <button type="button" class="btn btn-danger btn-sm delete-cart-item" 
                                                data-flight-id="<?php echo $flightId; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Tổng Cộng:</strong></td>
                            <td colspan="2"><strong><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Tiếp Tục Tìm Chuyến Bay
                </a>
                <div>
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-sync"></i> Cập Nhật Giỏ Hàng
                    </button>
                    <a href="index.php?action=checkout" class="btn btn-success">
                        <i class="fas fa-check"></i> Tiến Hành Thanh Toán
                    </a>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>
