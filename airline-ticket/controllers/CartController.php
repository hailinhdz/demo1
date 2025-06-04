<?php
require_once 'models/Cart.php';
require_once 'models/Flight.php';

class CartController {
    private $cart;
    private $flightModel;
    
    public function __construct() {
        $this->cart = new Cart();
        $this->flightModel = new Flight();
    }
    
    public function add() {
        if ($_POST && isset($_POST['flight_id']) && isset($_POST['quantity'])) {
            $flightId = $_POST['flight_id'];
            $quantity = (int)$_POST['quantity'];
            
            $flight = $this->flightModel->getFlightById($flightId);
            if ($flight && $flight['available_seats'] >= $quantity) {
                $this->cart->addItem($flightId, $quantity, $flight);
                $_SESSION['message'] = "Đã thêm vé vào giỏ hàng!";
            } else {
                $_SESSION['error'] = "Không thể thêm vé vào giỏ hàng. Vui lòng kiểm tra lại số lượng!";
            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    
    public function view() {
        $cartItems = $this->cart->getItems();
        $total = $this->cart->getTotal();
        
        $title = "Giỏ Hàng";
        include 'views/layout/header.php';
        include 'views/cart.php';
        include 'views/layout/footer.php';
    }
      public function remove() {
        if (isset($_POST['flight_id'])) {
            $cartItems = $this->cart->getItems();
            $flightId = $_POST['flight_id'];
            
            if (isset($cartItems[$flightId])) {
                $this->cart->removeItem($flightId);
                $_SESSION['message'] = "Đã xóa vé khỏi giỏ hàng!";
            } else {
                $_SESSION['error'] = "Không tìm thấy vé trong giỏ hàng!";
            }
        }
        header('Location: index.php?action=cart');
        exit;
    }
    
    public function update() {
        if ($_POST && isset($_POST['quantities'])) {
            foreach ($_POST['quantities'] as $flightId => $quantity) {
                $flight = $this->flightModel->getFlightById($flightId);
                if ($flight && $flight['available_seats'] >= $quantity) {
                    $this->cart->updateQuantity($flightId, (int)$quantity);
                }
            }
            $_SESSION['message'] = "Đã cập nhật giỏ hàng!";
        }
        header('Location: index.php?action=cart');
        exit;
    }
    
    public function checkout() {
        if ($_POST) {
            // Xử lý thanh toán ở đây
            $cartItems = $this->cart->getItems();
            if (!empty($cartItems)) {
                // Tạo đơn hàng mới
                // Sau khi thanh toán thành công
                $this->cart->clear();
                $_SESSION['message'] = "Đặt vé thành công!";
                header('Location: index.php?action=success');
                exit;
            }
        }
        
        $cartItems = $this->cart->getItems();
        $total = $this->cart->getTotal();
        
        $title = "Thanh Toán";
        include 'views/layout/header.php';
        include 'views/checkout.php';
        include 'views/layout/footer.php';
    }
    
    public function processPayment() {
        if ($_POST) {
            $cartItems = $this->cart->getItems();
            if (!empty($cartItems)) {
                // TODO: Tích hợp cổng thanh toán thực tế ở đây
                
                // Tạm thời coi như thanh toán thành công
                $bookingSuccess = true;
                
                if ($bookingSuccess) {
                    // Cập nhật số ghế còn lại
                    foreach ($cartItems as $flightId => $item) {
                        $flight = $this->flightModel->getFlightById($flightId);
                        $newSeats = $flight['available_seats'] - $item['quantity'];
                        // TODO: Cập nhật số ghế trong database
                    }
                    
                    // Xóa giỏ hàng
                    $this->cart->clear();
                    
                    $_SESSION['message'] = "Thanh toán thành công! Cảm ơn bạn đã đặt vé.";
                    header('Location: index.php?action=success');
                    exit;
                } else {
                    $_SESSION['error'] = "Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại.";
                    header('Location: index.php?action=checkout');
                    exit;
                }
            }
        }
        
        $_SESSION['error'] = "Giỏ hàng trống hoặc dữ liệu không hợp lệ.";
        header('Location: index.php?action=cart');
        exit;
    }
}
