<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'airline-ticket';
    private $username = 'root';
    private $password = '';
    private $pdo;
    
    public function connect() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", 
                               $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch(PDOException $e) {
            die("Lỗi kết nối database: " . $e->getMessage());
        }
    }
}

// Helper function
function formatPrice($price) {
    return number_format($price, 0, ',', '.') . ' VNĐ';
}

function formatDateTime($datetime) {
    return date('d/m/Y H:i', strtotime($datetime));
}
?>