# PIaeropuerto
-- Creación de la base de datos
CREATE DATABASE Aeropuerto;

-- Selección de la base de datos
USE Aeropuerto;

-- Creación de la tabla de Usuarios
CREATE TABLE Usuarios (
    id INT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    correo VARCHAR(50) NOT NULL,
    contrasena VARCHAR(50) NOT NULL,
    rol VARCHAR(20) NOT NULL
);

-- Creación de la tabla de Vuelos
CREATE TABLE Vuelos (
    id INT PRIMARY KEY,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    piloto_id INT NOT NULL,
    avion_id INT NOT NULL,
    origen VARCHAR(50) NOT NULL,
    destino VARCHAR(50) NOT NULL
);

-- Creación de la tabla de Aviones
CREATE TABLE Aviones (
    id INT PRIMARY KEY,
    fabricante VARCHAR(50) NOT NULL
);

-- Creación de la tabla de Pasajeros
CREATE TABLE Pasajeros (
    id INT PRIMARY KEY,
    usuario_id INT NOT NULL,
    informacion_personal VARCHAR(100)
);

-- Relación entre Usuarios y Pasajeros
ALTER TABLE Pasajeros
ADD FOREIGN KEY (usuario_id) REFERENCES Usuarios(id);

-- Relación entre Vuelos y Aviones
ALTER TABLE Vuelos
ADD FOREIGN KEY (avion_id) REFERENCES Aviones(id);

-- Relación entre Vuelos y Pilotos
ALTER TABLE Vuelos
ADD FOREIGN KEY (piloto_id) REFERENCES Usuarios(id);

-- Insertar datos de prueba
INSERT INTO Usuarios (id, nombre, correo, contrasena, rol)
VALUES
    (1, 'Administrador', 'admin@admin.com', 'password', 'Administrador'),
    (2, 'Pasajero1', 'pasajero1@pasajero.com', 'password', 'Pasajero'),
    (3, 'Pasajero2', 'pasajero2@pasajero.com', 'password', 'Pasajero');

INSERT INTO Aviones (id, fabricante)
VALUES
    (1, 'Boeing'),
    (2, 'Airbus'),
    (3, 'Boeing');

INSERT INTO Vuelos (id, fecha, hora, piloto_id, avion_id, origen, destino)
VALUES
    (1, '2024-05-15', '08:00:00', 1, 1, 'Madrid', 'Barcelona'),
    (2, '2024-05-16', '10:00:00', 2, 2, 'Barcelona', 'Madrid'),
    (3, '2024-05-17', '12:00:00', 1, 1, 'Madrid', 'Barcelona');

INSERT INTO Pasajeros (id, usuario_id, informacion_personal)
VALUES
    (1, 2, 'Información personal del pasajero 1'),
    (2, 3, 'Información personal del pasajero 2');
