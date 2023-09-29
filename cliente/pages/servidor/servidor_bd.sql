-- Crear base de datos servidor_db
CREATE DATABASE servidor_db;

-- Crear Tabla Usuarios
USE servidor_db;
CREATE TABLE usuarios(
id int AUTO_INCREMENT,
usuario VARCHAR(40),
contraseña VARCHAR(40),
PRIMARY KEY(id)
);