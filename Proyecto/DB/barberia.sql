-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-02-2019 a las 00:09:54
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
-- Estructura de tabla para la tabla `barbero`
--

CREATE TABLE `barbero` (
  `ID_BARBERO` int(11) NOT NULL,
  `NOMBREB` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `barbero`
--

INSERT INTO `barbero` (`ID_BARBERO`, `NOMBREB`) VALUES
(1, 'Cristian'),
(2, 'Martin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaservicio`
--

CREATE TABLE `categoriaservicio` (
  `ID_CATEGORIASERVICIO` int(11) NOT NULL,
  `NOMBRECAT` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `ID_CITA` int(11) NOT NULL,
  `ID_BARBERO` int(11) DEFAULT NULL,
  `ID_HORARIO` time NOT NULL,
  `CEDULA` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `DESCRIPCION` varchar(100) DEFAULT NULL,
  `ESTADO` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(117090968, 'Ignacio', 'Ramirez', 'Matamoros', 'nachorabbit19@gmail.com', '87992514', '$2y$10$3Q37mu.NTEjMdlwnP46.X.WbwsSS2/p7rgffdW8qgpIeEkUOTu0Mq'),
(117250705, 'Keissy', 'Leitón', 'Hernández', 'keissyleiton08@gmail.com', '60830513', '$2y$10$u2150guKAx0w.0YJrN3vneKTa/McbeOeljT3gw2r/z6.PcDfGH6Ne'),
(123456789, 'Sofia', 'Matamoros', 'Viquez', 'mvsofia@hotmail.com', '88326518', '$2y$10$Fq2oHVu7UioMvfGUN/I31uRZhsuUuckn6lSrOwTwcmw4M7AgisIs6'),
(132456789, 'Minor', 'Solano', 'Nuñez', 'minor@gmail.com', '83457846', '$2y$10$R6FfptqR6h/Qv768irwLbevLTyeoH9bfCXJj4waOAZ8ObWsAsFTCK'),
(347889342, 'David', 'Jimenez', 'Martinez', 'david@gmail.com', '8739487', '$2y$10$rWfHYkvxxDO99DBndAqC9evuCZKVb35HXO6oLFYsILg1zoe/OKOvi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `ID_HORARIO` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`ID_HORARIO`) VALUES
('09:00:00'),
('10:00:00'),
('11:00:00'),
('13:00:00'),
('14:00:00'),
('15:00:00'),
('16:00:00'),
('17:00:00'),
('18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `ID_SERVICIO` int(11) NOT NULL,
  `PRECIOSERVICIO` decimal(5,2) DEFAULT NULL,
  `DESCRIPCIONS` varchar(100) DEFAULT NULL,
  `ID_CATEGORIASERVICIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barbero`
--
ALTER TABLE `barbero`
  ADD PRIMARY KEY (`ID_BARBERO`);

--
-- Indices de la tabla `categoriaservicio`
--
ALTER TABLE `categoriaservicio`
  ADD PRIMARY KEY (`ID_CATEGORIASERVICIO`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`ID_CITA`),
  ADD KEY `CEDULA` (`CEDULA`),
  ADD KEY `ID_BARBERO` (`ID_BARBERO`),
  ADD KEY `ID_HORARIO` (`ID_HORARIO`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CEDULA`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`ID_HORARIO`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`ID_SERVICIO`),
  ADD KEY `ID_CATEGORIASERVICIO` (`ID_CATEGORIASERVICIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barbero`
--
ALTER TABLE `barbero`
  MODIFY `ID_BARBERO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoriaservicio`
--
ALTER TABLE `categoriaservicio`
  MODIFY `ID_CATEGORIASERVICIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `ID_CITA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `ID_SERVICIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`CEDULA`) REFERENCES `cliente` (`CEDULA`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`ID_BARBERO`) REFERENCES `barbero` (`ID_BARBERO`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`ID_HORARIO`) REFERENCES `horario` (`ID_HORARIO`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`ID_CATEGORIASERVICIO`) REFERENCES `categoriaservicio` (`ID_CATEGORIASERVICIO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
