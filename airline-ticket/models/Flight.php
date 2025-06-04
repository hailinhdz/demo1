<?php
class Flight {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
      public function searchFlights($departure, $arrival, $date) {
        $sql = "SELECT * FROM flights 
                WHERE departure_airport = :departure 
                AND arrival_airport = :arrival 
                AND DATE(departure_time) = :date 
                AND available_seats > 0
                ORDER BY departure_time ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':departure', $departure);
        $stmt->bindParam(':arrival', $arrival);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFlightById($id) {
        $sql = "SELECT * FROM flights WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
      public function getAllCities() {
        $sql = "SELECT DISTINCT departure_airport as city FROM flights 
                UNION 
                SELECT DISTINCT arrival_airport as city FROM flights 
                ORDER BY city";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        public function searchAlternativeFlights($departure, $arrival) {
        $sql = "SELECT * FROM flights 
                WHERE departure_airport = :departure 
                AND arrival_airport = :arrival 
                AND departure_time >= NOW()
                AND available_seats > 0
                ORDER BY departure_time ASC
                LIMIT 5";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':departure', $departure);
        $stmt->bindParam(':arrival', $arrival);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>