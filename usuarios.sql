-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS usuarios
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

-- Seleccionar la base de datos
USE usuarios;

-- Crear la tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
