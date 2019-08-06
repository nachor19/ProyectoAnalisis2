-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-08-2019 a las 21:27:09
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

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
CREATE DATABASE IF NOT EXISTS `barberia` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `barberia`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `SP_BARBEROS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BARBEROS` ()  NO SQL
SELECT CEDULA, NOMBRE, concat_ws(' ', PRIMERAPELLIDO, SEGUNDOAPELLIDO) AS APELLIDOS, EMAILC, TELEFONO FROM USUARIO WHERE ROL = 3$$

DROP PROCEDURE IF EXISTS `SP_CITAS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CITAS` ()  NO SQL
SELECT ID_CITA, B.NOMBRE, H.ID_HORARIO, U.CEDULA, concat_ws(' ', U.NOMBRE, U.PRIMERAPELLIDO) AS USUARIO, C.FECHA, DESCRIPCION, ESTADO, S.NOMBRESERVICIO, S.PRECIOSERVICIO 
FROM cita C, usuario B, horario H, usuario U, servicio S
WHERE C.ID_BARBERO = B.CEDULA AND C.ID_HORARIO = H.ID_HORARIO AND C.ID_SERVICIO = S.ID_SERVICIO AND C.CEDULA = U.CEDULA$$

DROP PROCEDURE IF EXISTS `SP_PRODUCTOS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PRODUCTOS` ()  NO SQL
SELECT ID_PRODUCTO, NOMBRE, DESCRIPCION, PRECIO, CANTIDAD FROM producto$$

DROP PROCEDURE IF EXISTS `SP_TABLACLIENTE`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TABLACLIENTE` (IN `ID_CLIENTE` INT)  SELECT FECHA, b.NOMBRE, ID_HORARIO, NOMBRESERVICIO, PRECIO 
FROM usuario B, CITA C, servicio s 
WHERE C.ID_BARBERO = B.CEDULA AND C.ID_SERVICIO = S.ID_SERVICIO AND C.CEDULA = ID_CLIENTE$$

DROP PROCEDURE IF EXISTS `SP_TABLACLIENTES`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TABLACLIENTES` ()  NO SQL
SELECT CEDULA, NOMBRE, concat_ws(' ', PRIMERAPELLIDO, SEGUNDOAPELLIDO) AS APELLIDOS, EMAILC, TELEFONO FROM USUARIO WHERE ROL = 1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

DROP TABLE IF EXISTS `cita`;
CREATE TABLE `cita` (
  `ID_CITA` int(11) NOT NULL,
  `ID_BARBERO` int(11) DEFAULT NULL,
  `ID_HORARIO` time NOT NULL,
  `CEDULA` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `DESCRIPCION` varchar(100) DEFAULT NULL,
  `ESTADO` varchar(100) DEFAULT NULL,
  `ID_SERVICIO` int(11) DEFAULT NULL,
  `PRECIO` decimal(5,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`ID_CITA`, `ID_BARBERO`, `ID_HORARIO`, `CEDULA`, `FECHA`, `DESCRIPCION`, `ESTADO`, `ID_SERVICIO`, `PRECIO`) VALUES
(94, 110780256, '11:00:00', 132456789, '2019-08-16', NULL, NULL, 7, '12000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

DROP TABLE IF EXISTS `horario`;
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
-- Estructura de tabla para la tabla `orden`
--

DROP TABLE IF EXISTS `orden`;
CREATE TABLE `orden` (
  `ORDEN_ID` int(11) NOT NULL,
  `CLIENTE_ID` int(11) NOT NULL,
  `PRECIO_TOTAL` decimal(13,2) NOT NULL,
  `CREADO` datetime NOT NULL,
  `MODIFICADO` datetime NOT NULL,
  `ESTADO` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_producto`
--

DROP TABLE IF EXISTS `orden_producto`;
CREATE TABLE `orden_producto` (
  `ID` int(11) NOT NULL,
  `ORDEN_ID` int(11) NOT NULL,
  `PRODUCTO_ID` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `ID_PRODUCTO` int(11) NOT NULL,
  `NOMBRE` varchar(40) NOT NULL,
  `DESCRIPCION` varchar(140) NOT NULL,
  `PRECIO` decimal(13,2) NOT NULL,
  `COMENTARIO` varchar(255) NOT NULL,
  `ESTADO` enum('D','A') NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `IMAGEN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_PRODUCTO`, `NOMBRE`, `DESCRIPCION`, `PRECIO`, `COMENTARIO`, `ESTADO`, `CANTIDAD`, `IMAGEN`) VALUES
(1, 'Bálsamo', 'Bálsamo para barba y bigote', '13000.00', '', 'D', 7, '../img/productos/balsamo.png'),
(2, 'Kit Charles', 'Prueba', '15000.00', '', 'D', 10, '../img/productos/kit-charles.png'),
(3, 'Shaving Charles', 'Shaving Charles', '12000.00', '', 'D', 15, '../img/productos/shaving-charles.png'),
(4, 'Shaving Soap', 'Shaving Soap', '9000.00', '', 'D', 9, '../img/productos/shaving-soap.png'),
(5, 'Aceite Bay Rum Beard', 'Grande', '14000.00', '', 'D', 10, '../img/productos/suavecito-bay-rum-beard-oil_large.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `ID_ROL` int(11) NOT NULL,
  `NOMBRE_ROL` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID_ROL`, `NOMBRE_ROL`) VALUES
(1, 'cliente'),
(2, 'administrador'),
(3, 'barbero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE `servicio` (
  `ID_SERVICIO` int(11) NOT NULL,
  `TIEMPO_REQUERIDO` time DEFAULT NULL,
  `NOMBRESERVICIO` varchar(100) DEFAULT NULL,
  `PRECIOSERVICIO` decimal(5,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`ID_SERVICIO`, `TIEMPO_REQUERIDO`, `NOMBRESERVICIO`, `PRECIOSERVICIO`) VALUES
(5, '01:00:00', 'CORTE CABELLO', '3000'),
(6, '01:00:00', 'CORTE DE CABELLO Y BARBA', '6000'),
(7, '02:00:00', 'ALISSETTE', '12000'),
(8, '01:00:00', 'TEÑIDO DE CABELLO', '10000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `CEDULA` int(11) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `PRIMERAPELLIDO` varchar(100) NOT NULL,
  `SEGUNDOAPELLIDO` varchar(100) NOT NULL,
  `EMAILC` varchar(100) NOT NULL,
  `TELEFONO` varchar(8) NOT NULL,
  `CONTRASENNA` varchar(100) NOT NULL,
  `rol` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`CEDULA`, `NOMBRE`, `PRIMERAPELLIDO`, `SEGUNDOAPELLIDO`, `EMAILC`, `TELEFONO`, `CONTRASENNA`, `rol`) VALUES
(4362646, 'Prueba3', 'Prueba3', 'Prueba3', 'dklfjl@gmail.com', '98327474', '$2y$10$q2JMnI61C.9rW3j470mpne.UwPkDO9IJUI64.PblluZSkYIbIyWme', 1),
(12341234, 'gabdsda', 'esajdsada', 'dasdasd', 'dsa@correo.com', '12341234', '$2y$10$92W.kr5n4TQTZF.r799fsuZx.HsVGcAUucNTv1X8UXlqypv8uRXUq', 1),
(110780256, 'Dyver', 'Brenes', 'Mora', 'dyver@gmail.com', '86567825', '$2y$10$xdXdSro.UDpxDB/2hScIBO0GCY6WaNoyEbNKsXJFXeJ8di0Tx.qma', 3),
(117090968, 'Ignacio', 'Ramirez', 'Matamoros', 'ignaciorm1319@gmail.com', '87992514', '$2y$10$pQcxESVZuvHKudbUm0iMZuJZLSGVCZ3RPInE3jletI5ziI8u.GS4i', 1),
(117250705, 'Keissy', 'Leitón', 'Hernández', 'keissyleiton08@gmail.com', '60830513', '$2y$10$u2150guKAx0w.0YJrN3vneKTa/McbeOeljT3gw2r/z6.PcDfGH6Ne', 1),
(123412341, 'dsfdsfs', 'fadsfdsf', 'asdfasdf', 'rch@gmail.co', '23432141', '$2y$10$TBRGZN02AMXQhpcZAxzi3.7uObIpDJwZBJRXU5NQRc9VO9t.RIaLK', 1),
(123456789, 'Sofia', 'Matamoros', 'Viquez', 'mvsofia@hotmail.com', '88326518', '$2y$10$Fq2oHVu7UioMvfGUN/I31uRZhsuUuckn6lSrOwTwcmw4M7AgisIs6', 1),
(132456789, 'Minor', 'Solano', 'Nuñez', 'minor@gmail.com', '83457846', '$2y$10$R6FfptqR6h/Qv768irwLbevLTyeoH9bfCXJj4waOAZ8ObWsAsFTCK', 1),
(345236243, 'Alejandro', 'Gonzalez', 'Gonzalez', 'alegonpov@gmail.com', '85408223', '$2y$10$.V917K/ZfMrMbIA862wQM.SsuVR/rsjIK0zs4Cvp3ihBVpdkLkdPO', 2),
(347889342, 'David', 'Jimenez', 'Martinez', 'david@gmail.com', '8739487', '$2y$10$rWfHYkvxxDO99DBndAqC9evuCZKVb35HXO6oLFYsILg1zoe/OKOvi', 1),
(546456546, 'Andres', 'Campos', 'Prado', 'maes@gmail.com', '23423423', '$2y$10$PD3N4gm7XpRWYTsNzmTZZeiNyjPL5FcEbcbxxMPlbRU444McRbwTS', 3),
(777777777, 'Maria', 'Mora', 'Li', 'maria@gmail.com', '89667456', '$2y$10$mra.wpnKamyjANEUG8ItkeaWtvqGR./z3CgNqFqC44nrYS.bNbVwy', 1),
(888888888, 'Benito', 'Camelas', 'Mora', 'benito@gmail.com', '88888888', '$2y$10$XNqPa3hnynZaEA0ChWCEWeNE.WaeNJoNOInxVGdYFdnaXQVKiV3bi', 2),
(999999999, 'Ricardo', 'Madrigal', 'Herrera', 'rch@gmail.com', '12341234', '$2y$10$XOepLspqo.V8GRbd9W6Oou0tN0cvp.za3CGsTL5bZJlD4HwPtj/iq', 1),
(2147483647, 'Manfred', 'Martinez', 'Monge', 'manfred@gmail.com', '82143962', '$2y$10$b/cI/wNOd8CYLMG3UxmXy.NoaB/frsKbhhuXe9SHF..7vYHIc6wS6', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`ID_CITA`),
  ADD KEY `CEDULA` (`CEDULA`),
  ADD KEY `ID_BARBERO` (`ID_BARBERO`),
  ADD KEY `ID_HORARIO` (`ID_HORARIO`),
  ADD KEY `ID_SERVICIO` (`ID_SERVICIO`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`ID_HORARIO`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`ORDEN_ID`),
  ADD KEY `cliente_id_fk` (`CLIENTE_ID`);

--
-- Indices de la tabla `orden_producto`
--
ALTER TABLE `orden_producto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `orden_id_fk` (`ORDEN_ID`),
  ADD KEY `producto_id_fk` (`PRODUCTO_ID`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_PRODUCTO`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID_ROL`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`ID_SERVICIO`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`CEDULA`),
  ADD UNIQUE KEY `EMAILC` (`EMAILC`),
  ADD UNIQUE KEY `CEDULA` (`CEDULA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `ID_CITA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `ORDEN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_producto`
--
ALTER TABLE `orden_producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID_ROL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `ID_SERVICIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`CEDULA`) REFERENCES `usuario` (`CEDULA`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`ID_HORARIO`) REFERENCES `horario` (`ID_HORARIO`),
  ADD CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`ID_SERVICIO`) REFERENCES `servicio` (`ID_SERVICIO`),
  ADD CONSTRAINT `cita_ibfk_5` FOREIGN KEY (`ID_BARBERO`) REFERENCES `usuario` (`CEDULA`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `cliente_id_fk` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `usuario` (`CEDULA`);

--
-- Filtros para la tabla `orden_producto`
--
ALTER TABLE `orden_producto`
  ADD CONSTRAINT `orden_id_fk` FOREIGN KEY (`ORDEN_ID`) REFERENCES `orden` (`ORDEN_ID`),
  ADD CONSTRAINT `producto_id_fk` FOREIGN KEY (`PRODUCTO_ID`) REFERENCES `producto` (`ID_PRODUCTO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
