<?php
require_once 'models/Flight.php';
require_once 'models/Booking.php';

class BookingController {
    public function book() {
        $flightModel = new Flight();
        $flightId = $_GET['flight_id'] ?? 0;
        $flight = null;
        
        if ($flightId) {
            $flight = $flightModel->getFlightById($flightId);
            if (!$flight || $flight['available_seats'] <= 0) {
                header('Location: index.php?action=home');
                exit;
            }
        } else {
            header('Location: index.php?action=home');
            exit;
        }
        
        $title = "Đặt Vé Máy Bay";
        include 'views/layout/header.php';
        include 'views/booking.php';
        include 'views/layout/footer.php';
    }
    
    public function confirm() {
        $success = false;
        $bookingId = null;
        $booking = null;
        
        if ($_POST) {
            $flightId = $_POST['flight_id'] ?? 0;
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $passengers = intval($_POST['passengers'] ?? 1);
            
            // Validation
            $errors = [];
            if (empty($name)) $errors[] = "Họ tên không được để trống";
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email không hợp lệ";
            if (empty($phone)) $errors[] = "Số điện thoại không được để trống";
            if ($passengers < 1 || $passengers > 9) $errors[] = "Số hành khách phải từ 1-9";
            
            if (empty($errors)) {
                try {
                    $bookingModel = new Booking();
                    $bookingId = $bookingModel->createBooking($flightId, $name, $email, $phone, $passengers);
                    
                    if ($bookingId) {
                        $success = true;
                        $booking = $bookingModel->getBookingById($bookingId);
                    }
                } catch(Exception $e) {
                    $errors[] = "Có lỗi xảy ra khi đặt vé: " . $e->getMessage();
                }
            }
        } else {
            header('Location: index.php?action=home');
            exit;
        }
        
        $title = $success ? "Đặt Vé Thành Công" : "Lỗi Đặt Vé";
        include 'views/layout/header.php';
        include 'views/success.php';
        include 'views/layout/footer.php';
    }
}
?>