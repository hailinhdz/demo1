<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h3><i class="fas fa-search"></i> Tìm Kiếm Chuyến Bay</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="index.php?action=search" id="searchForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Điểm đi <span class="text-danger">*</span></label>
                                <select name="departure" class="form-select" required>
                                    <option value="">-- Chọn điểm đi --</option>
                                    <?php if (isset($cities)): ?>
                                        <?php foreach($cities as $city): ?>
                                            <option value="<?php echo htmlspecialchars($city['city']); ?>">
                                                <?php echo htmlspecialchars($city['city']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="Hà Nội">Hà Nội</option>
                                        <option value="TP.HCM">TP.HCM</option>
                                        <option value="Đà Nẵng">Đà Nẵng</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Điểm đến <span class="text-danger">*</span></label>
                                <select name="arrival" class="form-select" required>
                                    <option value="">-- Chọn điểm đến --</option>
                                    <?php if (isset($cities)): ?>
                                        <?php foreach($cities as $city): ?>
                                            <option value="<?php echo htmlspecialchars($city['city']); ?>">
                                                <?php echo htmlspecialchars($city['city']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="Hà Nội">Hà Nội</option>
                                        <option value="TP.HCM">TP.HCM</option>
                                        <option value="Đà Nẵng">Đà Nẵng</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày bay <span class="text-danger">*</span></label>
                                <input type="date" name="date" class="form-control" required 
                                       min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số hành khách</label>
                                <select name="passengers" class="form-select">
                                    <?php for($i = 1; $i <= 9; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> người</option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-search"></i> Tìm Kiếm Chuyến Bay
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>