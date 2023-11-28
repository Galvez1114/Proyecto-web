-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2023 a las 19:47:45
-- Versión del servidor: 10.4.27-MariaDB-log
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `style_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `responsable` varchar(45) NOT NULL,
  `concepto` varchar(60) NOT NULL,
  `costo` int(11) NOT NULL,
  `cliente` varchar(45) NOT NULL,
  `telefono_cliente` varchar(11) NOT NULL,
  `area` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`fecha`, `hora`, `responsable`, `concepto`, `costo`, `cliente`, `telefono_cliente`, `area`) VALUES
('2023-11-26', '18:53:01', 'Jesus', 'corte de cabello', 120, 'Eduardo', '6875431792', 'Barberia'),
('2022-11-26', '17:00:00', 'Jesus', 'Corte de cabello', 120, 'Paul', '6871418825', 'Barberia'),
('2023-11-28', '09:00:00', 'America', 'Facial', 250, 'Jessy', '6687541442', 'barberia'),
('2023-11-28', '09:00:00', 'Jesus', 'Facial', 250, 'Jessy', '6687541442', 'Barberia'),
('2023-11-28', '08:00:00', 'Jesus', 'corte de cabello', 120, 'Adrian', '6681915800', 'Barberia'),
('2023-11-28', '15:00:00', 'Jesus', 'corte de cabello', 120, 'Adrian', '6681915800', 'Barberia'),
('2023-11-28', '19:00:00', 'Jesus', 'corte de cabello', 120, 'Adrian', '6681915800', 'Barberia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `nivel` int(11) NOT NULL,
  `nombre_cliente` varchar(45) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `num_telefono` varchar(11) NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`nivel`, `nombre_cliente`, `apellido`, `email`, `num_telefono`, `pass`) VALUES
(3, 'Adrian', 'Galvez', 'adrian@micorreo.com', '6681915800', '$2y$10$h5GRC6w7390d8kEwOb/HB.Um5IT7VtRrKvgjf9lFpQzgDjXWQ1k4O'),
(3, 'America', 'Favela', 'america@micorreo.com', '6871988998', '$2y$10$uc7TWrTtYt.6wNedKk8TTO73el2AsaaCXHmTnbKFM4huJa5AgZf2u'),
(3, 'Adrian', 'Galvez', 'galvezadrian2310@gmail.com', '6681915800', '$2y$10$luVCN1PWb6mdwedAw8.truABYB8KQX38Gb2kIGXv69oLHfsCcW66e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsables`
--

CREATE TABLE `responsables` (
  `nivel` int(11) NOT NULL,
  `nombre_resp` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `num_telefono` varchar(11) NOT NULL,
  `area` varchar(30) NOT NULL,
  `turno` varchar(30) NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `responsables`
--

INSERT INTO `responsables` (`nivel`, `nombre_resp`, `apellidos`, `email`, `num_telefono`, `area`, `turno`, `pass`) VALUES
(2, 'Jesus', 'Cuevas', 'jesus@micorreo.com', '6681915800', 'Barberia', 'manana', '$2y$10$VWMsL09RSDYjbt8RMtEZeu5eFLC7d74VkzZUBsicVeGJFeypAPjCC'),
(1, 'Adrian', 'Galvez', 'galvezadrian2310@gmail.com', '', '', 'manana', '$2y$10$/aJwRnwj.gYId5/ym.fDSOXhVWAw6NPXHuZgXJ5wi3uc4Q5vmYWfS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `area` varchar(45) NOT NULL,
  `concepto` varchar(45) NOT NULL,
  `costo` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`area`, `concepto`, `costo`, `descripcion`) VALUES
('barberia', 'corte de cabello', 120, 'Corte de cabello para caballero'),
('barberia', 'Marcado de barba', 150, 'Marcado de barba con navaja'),
('salon', 'Tinte de cabello', 200, 'Tinte de su eleccion');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
