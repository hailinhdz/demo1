<?php
session_start();
require_once 'config/database.php';

// Simple Router
$action = $_GET['action'] ?? 'home';

switch($action) {
    case 'home':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
    
    case 'search':
        require_once 'controllers/FlightController.php';
        $controller = new FlightController();
        $controller->search();
        break;
    
    case 'book':
        require_once 'controllers/BookingController.php';
        $controller = new BookingController();
        $controller->book();
        break;
    
    case 'confirm':
        require_once 'controllers/BookingController.php';
        $controller = new BookingController();
        $controller->confirm();
        break;

    case 'add-to-cart':
        require_once 'controllers/CartController.php';
        $controller = new CartController();
        $controller->add();
        break;

    case 'cart':
        require_once 'controllers/CartController.php';
        $controller = new CartController();
        $controller->view();
        break;

    case 'remove-from-cart':
        require_once 'controllers/CartController.php';
        $controller = new CartController();
        $controller->remove();
        break;

    case 'update-cart':
        require_once 'controllers/CartController.php';
        $controller = new CartController();
        $controller->update();
        break;

    case 'checkout':
        require_once 'controllers/CartController.php';
        $controller = new CartController();
        $controller->checkout();
        break;

    case 'process-payment':
        require_once 'controllers/CartController.php';
        $controller = new CartController();
        $controller->processPayment();
        break;
    
    default:
        require_once 'controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
}
?>