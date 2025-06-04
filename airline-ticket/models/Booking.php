<?php
class Booking {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
    
    public function createBooking($flightId, $name, $email, $phone, $passengers = 1) {
        try {
            $this->db->beginTransaction();
            
            // Insert booking
            $sql = "INSERT INTO bookings (flight_id, passenger_name, passenger_email, passenger_phone, passenger_count) 
                    VALUES (:flight_id, :name, :email, :phone, :passengers)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':flight_id', $flightId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':passengers', $passengers);
            $stmt->execute();
            
            $bookingId = $this->db->lastInsertId();
            
            // Update available seats
            $this->updateAvailableSeats($flightId, $passengers);
            
            $this->db->commit();
            return $bookingId;
            
        } catch(Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    
    public function updateAvailableSeats($flightId, $passengers = 1) {
        $sql = "UPDATE flights SET available_seats = available_seats - :passengers WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $flightId);
        $stmt->bindParam(':passengers', $passengers);
        
        return $stmt->execute();
    }
    
    public function getBookingById($id) {
        $sql = "SELECT b.*, f.flight_code, f.departure_city, f.arrival_city, 
                       f.departure_time, f.arrival_time, f.price
                FROM bookings b 
                JOIN flights f ON b.flight_id = f.id 
                WHERE b.id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>