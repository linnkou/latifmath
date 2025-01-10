CREATE DATABASE math_resources;

USE math_resources;

CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year VARCHAR(50) NOT NULL,
    file_type VARCHAR(50) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_size INT NOT NULL, -- حجم الملف بالبايت
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
