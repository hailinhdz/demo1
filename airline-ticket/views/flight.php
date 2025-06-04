<div class="container">
    <div class="row">
        <div class="col-12">
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
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($message)): ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> <?php echo $message; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($searchData)): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Kết quả tìm kiếm:</h5>
                        <p class="mb-0">
                            <strong><?php echo htmlspecialchars($searchData['departure']); ?></strong> 
                            <i class="fas fa-arrow-right mx-2"></i>
                            <strong><?php echo htmlspecialchars($searchData['arrival']); ?></strong>
                            - <?php echo date('d/m/Y', strtotime($searchData['date'])); ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($flights)): ?>
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-plane"></i> Danh Sách Chuyến Bay</h4>
                    </div>
                    <div class="card-body p-0">
                        <?php foreach($flights as $flight): ?>
                            <div class="flight-item border-bottom p-3">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <div class="text-center">
                                            <h5 class="mb-0 text-primary"><?php echo $flight['flight_code']; ?></h5>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <h6 class="mb-0"><?php echo $flight['departure_airport']; ?></h6>
                                            <small class="text-muted"><?php echo date('H:i', strtotime($flight['departure_time'])); ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <i class="fas fa-arrow-right text-primary"></i>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <h6 class="mb-0"><?php echo $flight['arrival_airport']; ?></h6>
                                            <small class="text-muted"><?php echo date('H:i', strtotime($flight['arrival_time'])); ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text-center">
                                            <div class="price text-danger h5 mb-2">
                                                <?php echo formatPrice($flight['price']); ?>
                                            </div>
                                            <div class="available-seats text-muted small mb-2">
                                                Còn <?php echo $flight['available_seats']; ?> ghế
                                            </div>                                            <form action="index.php?action=add-to-cart" method="POST" class="mb-2">
                                                <input type="hidden" name="flight_id" value="<?php echo $flight['id']; ?>">
                                                <div class="input-group input-group-sm mb-2">
                                                    <input type="number" name="quantity" value="1" min="1" 
                                                           max="<?php echo $flight['available_seats']; ?>" 
                                                           class="form-control" style="width: 60px">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                                                    </button>
                                                </div>
                                            </form>
                                            <a href="index.php?action=book&flight_id=<?php echo $flight['id']; ?>" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fas fa-ticket-alt"></i> Đặt Vé Ngay
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Tìm Kiếm Lại
                </a>
            </div>
        </div>
    </div>
</div>