CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    part_name VARCHAR(150) NOT NULL,      
    brand ENUM('Apple', 'Samsung', 'Xiaomi', 'Huawei', 'Oppo','Vivo', 'Realme', 'OEM', 'Other') NOT NULL,
    stocks INT NOT NULL,                
    cost DECIMAL(10, 2) NOT NULL, 
    supplier VARCHAR(150) NOT NULL,        
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);