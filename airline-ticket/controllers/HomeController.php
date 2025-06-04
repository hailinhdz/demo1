<?php
require_once 'models/Flight.php';

class HomeController {
    public function index() {
        $flightModel = new Flight();
        $cities = $flightModel->getAllCities();
        
        $title = "Đặt Vé Máy Bay Online";
        include 'views/layout/header.php';
        include 'views/home.php';
        include 'views/layout/footer.php';
    }
}
?>