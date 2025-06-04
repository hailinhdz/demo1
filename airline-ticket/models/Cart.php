<?php
class Cart {
    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }
    
    public function addItem($flightId, $quantity, $flightInfo) {
        if (!isset($_SESSION['cart'][$flightId])) {
            $_SESSION['cart'][$flightId] = [
                'quantity' => $quantity,
                'info' => $flightInfo
            ];
        } else {
            $_SESSION['cart'][$flightId]['quantity'] += $quantity;
        }
    }
    
    public function removeItem($flightId) {
        if (isset($_SESSION['cart'][$flightId])) {
            unset($_SESSION['cart'][$flightId]);
        }
    }
    
    public function updateQuantity($flightId, $quantity) {
        if (isset($_SESSION['cart'][$flightId])) {
            $_SESSION['cart'][$flightId]['quantity'] = $quantity;
        }
    }
    
    public function getItems() {
        return $_SESSION['cart'] ?? [];
    }
    
    public function getTotal() {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['info']['price'] * $item['quantity'];
        }
        return $total;
    }
    
    public function clear() {
        $_SESSION['cart'] = [];
    }
    
    public function getItemCount() {
        $count = 0;
        foreach ($_SESSION['cart'] as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}
?>
