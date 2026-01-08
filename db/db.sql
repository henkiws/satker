-- Create Database
CREATE DATABASE IF NOT EXISTS kemenkum_satker;
USE kemenkum_satker;

-- Table: users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    role ENUM('admin', 'satker', 'ppbj') DEFAULT 'satker',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: satker
CREATE TABLE satker (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kode VARCHAR(50) UNIQUE NOT NULL,
    nama VARCHAR(200) NOT NULL,
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: ppbj
CREATE TABLE ppbj (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    nip VARCHAR(50) UNIQUE NOT NULL,
    jabatan VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default admin user
-- Username: admin
-- Password: admin123
INSERT INTO users (username, password, nama, email, role, is_active) 
VALUES ('admin', '$2y$12$qdBX4.gHT2LbqzPJIUQ6IOCj/7Au0MtUjx56dRgY0dyHx.J6Z6/z.', 'Administrator', 'admin@mail.com', 'admin', 1);

-- Sample data for satker (optional)
INSERT INTO satker (kode, nama, alamat) VALUES
('STK001', 'Satker Keuangan Daerah', 'Jl. Sudirman No. 123, Yogyakarta'),
('STK002', 'Satker Pembangunan', 'Jl. Malioboro No. 45, Yogyakarta'),
('STK003', 'Satker Kesehatan', 'Jl. Solo No. 78, Yogyakarta');

-- Sample data for ppbj (optional)
INSERT INTO ppbj (nama, nip, jabatan) VALUES
('Budi Santoso', '198501012010011001', 'Kepala Seksi Pengadaan'),
('Siti Nurhaliza', '198702152011012002', 'Staf Pengadaan Senior'),
('Ahmad Fauzi', '199003202015011003', 'Staf Pengadaan');