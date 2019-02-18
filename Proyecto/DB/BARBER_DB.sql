-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2019 a las 05:43:03
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `barberia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `CEDULA` int(11) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `PRIMERAPELLIDO` varchar(100) NOT NULL,
  `SEGUNDOAPELLIDO` varchar(100) NOT NULL,
  `EMAILC` varchar(100) NOT NULL,
  `TELEFONO` varchar(8) NOT NULL,
  `CONTRASENNA` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`CEDULA`, `NOMBRE`, `PRIMERAPELLIDO`, `SEGUNDOAPELLIDO`, `EMAILC`, `TELEFONO`, `CONTRASENNA`) VALUES
(12341234, 'gabdsda', 'esajdsada', 'dasdasd', 'dsa@correo.com', '12341234', '$2y$10$92W.kr5n4TQTZF.r799fsuZx.HsVGcAUucNTv1X8UXlqypv8uRXUq'),
(117090968, 'Ignacio', 'Ramirez', 'Matamoros', 'ignaciorm1319@gmail.com', '87992514', '$2y$10$PpvV/SvhN6/a.ilextlPru7/Hq/Qud4OC/9zcnPa7Ut/YC7QsqNgW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CEDULA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
