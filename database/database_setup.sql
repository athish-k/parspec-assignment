-- Parspec Assignment Database Setup
CREATE DATABASE IF NOT EXISTS single_login_db;
USE single_login_db;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    access_code VARCHAR(100) NOT NULL UNIQUE,
    user_type VARCHAR(50) NOT NULL
);

INSERT INTO users (access_code, user_type) VALUES 
('admin123', 'administrator'),
('user456', 'regular_user'),
('test789', 'tester'),
('parspec2024', 'special_user');

CREATE USER IF NOT EXISTS 'webuser'@'localhost' IDENTIFIED BY 'webpass';
GRANT ALL PRIVILEGES ON single_login_db.* TO 'webuser'@'localhost';
FLUSH PRIVILEGES;
