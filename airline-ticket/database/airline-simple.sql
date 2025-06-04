-- Bảng flights (chuyến bay)
CREATE TABLE flights (
    id INT PRIMARY KEY AUTO_INCREMENT,
    flight_code VARCHAR(10) NOT NULL,
    departure_airport VARCHAR(50) NOT NULL,
    arrival_airport VARCHAR(50) NOT NULL,
    departure_time DATETIME NOT NULL, 
    arrival_time DATETIME NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    available_seats INT NOT NULL
);

-- Bảng booking (đặt vé)
CREATE TABLE booking (
    id INT PRIMARY KEY AUTO_INCREMENT,
    flight_id INT NOT NULL,
    passenger_name VARCHAR(100) NOT NULL,
    passenger_email VARCHAR(100) NOT NULL, 
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (flight_id) REFERENCES flights(id)
);

-- Dữ liệu mẫu cho bảng flights
INSERT INTO flights (flight_code, departure_airport, arrival_airport, departure_time, arrival_time, price, available_seats) VALUES
('VN123', 'Hanoi', 'Ho Chi Minh City', '2023-10-01 08:00:00', '2023-10-01 10:00:00', 100.00, 50),
('VN456', 'Hanoi', 'Da Nang', '2023-10-01 09:00:00', '2023-10-01 11:00:00', 80.00, 30),
('VN789', 'Ho Chi Minh City', 'Phu Quoc', '2023-10-01 12:00:00', '2023-10-01 14:00:00', 120.00, 20);

-- Dữ liệu mẫu cho bảng booking
INSERT INTO booking (id, flight_id, passenger_name, passenger_email) VALUES 
(1, 'VN123', 'Nguyễn Văn Hoàng', 'vanhoang37vn@gmail.com'),
(2, 'VN456', 'Trần Thị Mai', 'maitran36@outlook.com'),
(3, 'VN789', 'Lê Văn An', 'anlee1998@gmail.com');
