-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 03:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aeropuerto`
--

-- --------------------------------------------------------

--
-- Table structure for table `aerolineas`
--

CREATE TABLE `aerolineas` (
  `nit` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `sede` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aerolineas`
--

INSERT INTO `aerolineas` (`nit`, `nombre`, `sede`) VALUES
(1234, 'Latam Airlines', 'Chile'),
(2024, 'avianca', 'colombia'),
(2025, 'eco vuelos ', 'colombia'),
(3456, 'Lufthansa', 'Alemania'),
(5678, 'Iberia', 'España'),
(7890, 'Emirates', 'Emiratos Árabes Unidos'),
(9012, 'Air France', 'Francia');

-- --------------------------------------------------------

--
-- Table structure for table `aviones`
--

CREATE TABLE `aviones` (
  `id` int(11) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `aerolinea_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aviones`
--

INSERT INTO `aviones` (`id`, `modelo`, `aerolinea_id`) VALUES
(1, '1215', 2025),
(2, 'Boeing 787 Dreamliner', 1234),
(3, 'Airbus A350', 1234),
(4, 'Airbus A380', 5678),
(5, 'Boeing 777', 5678),
(6, 'Airbus A330', 9012),
(7, 'Boeing 747', 9012),
(8, 'Airbus A320', 3456),
(9, 'Embraer E190', 3456),
(10, 'Boeing 737 MAX', 7890),
(11, 'Airbus A321neo', 7890);

-- --------------------------------------------------------

--
-- Table structure for table `pilotos`
--

CREATE TABLE `pilotos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `informacion_personal` varchar(100) DEFAULT NULL,
  `aerolinea_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pilotos`
--

INSERT INTO `pilotos` (`id`, `nombre`, `informacion_personal`, `aerolinea_id`) VALUES
(2, 'Juan Pérez', 'Licencia: XYZ123', 2024),
(5, '0', '20 años', 2024),
(6, '0', '20', 2025),
(7, 'Array', '16', 2025),
(8, 'gab', '20', 2025),
(9, 'Ana Gómez', 'Licencia: ABC456, Experiencia: 10 años', 1234),
(10, 'Carlos Rodríguez', 'Licencia: DEF789, Experiencia: 8 años', 1234),
(11, 'María López', 'Licencia: GHI012, Experiencia: 12 años', 5678),
(12, 'Luis Martínez', 'Licencia: JKL345, Experiencia: 5 años', 5678),
(13, 'Sofía Hernández', 'Licencia: MNO678, Experiencia: 15 años', 9012),
(14, 'Pedro González', 'Licencia: PQR901, Experiencia: 7 años', 9012),
(15, 'Laura Sánchez', 'Licencia: STU234, Experiencia: 9 años', 3456),
(16, 'Miguel Ramírez', 'Licencia: VWX567, Experiencia: 6 años', 3456),
(17, 'Elena Torres', 'Licencia: YZA890, Experiencia: 11 años', 7890),
(18, 'Javier García', 'Licencia: BCD123, Experiencia: 4 años', 7890);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(1000) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `rol`) VALUES
(1, 'sebas', 'pr@gmail.com', '$2y$10$ogmaUPdN5nWciUI/lAXZEeCYPZqAcwNlu9IJeY32UecwftZ7MxUVG', 'Administrador'),
(2, 'prueba', 'prueba@gamil.com', '$2y$10$DEDocz9cGQCqAO9smY7Bc.oiniiT6fseh9DPhu85IV8Fae09DtVIG', 'Pasajero'),
(3, 'pr2', 'prueba1@gmail.com', '$2y$10$z/N2SMgrzJ9CgThksUUtyOnPt2uJpsHJohBciDERypAmHrpqqOeC.', 'Pasajero');

-- --------------------------------------------------------

--
-- Table structure for table `vuelos`
--

CREATE TABLE `vuelos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `piloto_id` int(11) NOT NULL,
  `avion_id` int(11) NOT NULL,
  `origen` varchar(50) NOT NULL,
  `destino` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vuelos`
--

INSERT INTO `vuelos` (`id`, `fecha`, `hora`, `piloto_id`, `avion_id`, `origen`, `destino`) VALUES
(16, '2024-01-15', '10:30:00', 9, 2, 'Santiago', 'Buenos Aires'),
(17, '2024-02-22', '14:45:00', 10, 3, 'Santiago', 'Lima'),
(18, '2024-03-10', '08:15:00', 11, 4, 'Madrid', 'Londres'),
(19, '2024-04-05', '16:00:00', 12, 5, 'Madrid', 'París'),
(20, '2024-05-20', '12:20:00', 13, 6, 'París', 'Nueva York'),
(21, '2024-06-30', '20:55:00', 14, 7, 'París', 'Tokio'),
(22, '2024-07-12', '09:50:00', 15, 8, 'Frankfurt', 'Roma'),
(23, '2024-08-03', '18:30:00', 16, 9, 'Frankfurt', 'Barcelona'),
(24, '2024-09-18', '11:10:00', 17, 10, 'Dubái', 'Mumbai'),
(25, '2024-05-28', '07:05:00', 6, 1, 'cali', 'bogota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aerolineas`
--
ALTER TABLE `aerolineas`
  ADD PRIMARY KEY (`nit`);

--
-- Indexes for table `aviones`
--
ALTER TABLE `aviones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aerolinea_id` (`aerolinea_id`);

--
-- Indexes for table `pilotos`
--
ALTER TABLE `pilotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`nombre`),
  ADD KEY `aerolinea_id` (`aerolinea_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avion_id` (`avion_id`),
  ADD KEY `piloto_id` (`piloto_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aviones`
--
ALTER TABLE `aviones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pilotos`
--
ALTER TABLE `pilotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vuelos`
--
ALTER TABLE `vuelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aviones`
--
ALTER TABLE `aviones`
  ADD CONSTRAINT `aviones_ibfk_1` FOREIGN KEY (`aerolinea_id`) REFERENCES `aerolineas` (`nit`);

--
-- Constraints for table `pilotos`
--
ALTER TABLE `pilotos`
  ADD CONSTRAINT `pilotos_ibfk_2` FOREIGN KEY (`aerolinea_id`) REFERENCES `aerolineas` (`nit`);

--
-- Constraints for table `vuelos`
--
ALTER TABLE `vuelos`
  ADD CONSTRAINT `vuelos_ibfk_1` FOREIGN KEY (`avion_id`) REFERENCES `aviones` (`id`),
  ADD CONSTRAINT `vuelos_ibfk_2` FOREIGN KEY (`piloto_id`) REFERENCES `pilotos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
