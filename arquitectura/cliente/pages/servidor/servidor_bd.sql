-- Crear base de datos servidor_db
CREATE DATABASE servidor_db;

-- Crear Tabla Usuarios
USE servidor_db;
CREATE TABLE usuarios(
id int AUTO_INCREMENT,
nombre VARCHAR(300),
usuario VARCHAR(40),
contraseña VARCHAR(40),
PRIMARY KEY(id)
);

--Crear tabla de notas
USE servidor_db;
CREATE TABLE notas(
id int AUTO_INCREMENT,
titulo VARCHAR(300),
descripcion VARCHAR(500),
estado VARCHAR(40),
fecha datetime,
PRIMARY KEY(id)
);