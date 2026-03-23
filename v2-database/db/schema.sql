CREATE DATABASE IF NOT EXISTS user_management_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE user_management_db;

DROP TABLE IF EXISTS activity_logs;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'Regular User') NOT NULL DEFAULT 'Regular User',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    message VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_activity_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

INSERT INTO users (name, email, password_hash, role)
VALUES (
    'Alice Admin',
    'admin@example.com',
    '$2y$12$cqsaMb6p9zaiYainQMpD8Od/sLHCiOLorQs4AI2xju3f3oTgxBUpS',
    'Admin'
);
