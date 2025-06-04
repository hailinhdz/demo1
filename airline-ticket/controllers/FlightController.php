<?php
require_once 'models/Flight.php';

class FlightController {
    public function search() {
        $flightModel = new Flight();
        $flights = [];
        $searchData = [];
        
        if ($_POST) {
            $departure = $_POST['departure'] ?? '';
            $arrival = $_POST['arrival'] ?? '';
            $date = $_POST['date'] ?? '';
            
            $searchData = [
                'departure' => $departure,
                'arrival' => $arrival,
                'date' => $date
            ];
            
            if ($departure && $arrival && $date) {
                if ($departure === $arrival) {
                    $error = "Điểm đi và điểm đến không được giống nhau!";
                } else {                    $flights = $flightModel->searchFlights($departure, $arrival, $date);
                    if (empty($flights)) {
                        // Tìm các chuyến bay thay thế
                        $alternativeFlights = $flightModel->searchAlternativeFlights($departure, $arrival);
                        if (!empty($alternativeFlights)) {
                            $message = "Không tìm thấy chuyến bay cho ngày bạn chọn. Dưới đây là một số chuyến bay thay thế:";
                            $flights = $alternativeFlights;
                        } else {
                            $message = "Không tìm thấy chuyến bay phù hợp!";
                        }
                    }
                }
            } else {
                $error = "Vui lòng điền đầy đủ thông tin tìm kiếm!";
            }
        }
          $title = "Kết Quả Tìm Kiếm";
        include 'views/layout/header.php';
        include 'views/flight.php';
        include 'views/layout/footer.php';
    }
}
?>