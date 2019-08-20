-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2019 a las 23:43:13
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZARADMIN` (IN `cedulaVal` INT, IN `nombreVal` VARCHAR(100), IN `apellido1` VARCHAR(100), IN `apellido2` VARCHAR(100), IN `telefonoVal` VARCHAR(100), IN `rolVal` INT)  NO SQL
UPDATE USUARIO U SET U.NOMBRE = nombreVal, U.PRIMERAPELLIDO = apellido1, U.SEGUNDOAPELLIDO = apellido2, U.TELEFONO = telefonoVal, u.rol =rolVal WHERE u.CEDULA = cedulaVal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZARCITA` (IN `id_citaVal` INT, IN `id_barberoVal` INT, IN `id_horarioVal` INT, IN `id_servicioVal` INT, IN `horaVal` DATE)  NO SQL
UPDATE CITA 
SET ID_BARBERO = id_barberoVal, ID_HORARIO = id_horarioVal, ID_SERVICIO = id_servicioVal, FECHA = horaVal 
WHERE ID_CITA = id_citaVal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZARCLIENTE` (IN `cedulaVal` INT, IN `nombre` VARCHAR(100), IN `primerApellido` VARCHAR(100), IN `segundoApellido` VARCHAR(100), IN `email` VARCHAR(100), IN `telefono` VARCHAR(100), IN `rolVal` INT)  NO SQL
    DETERMINISTIC
UPDATE USUARIO SET NOMBRE = nombre,
 PRIMERAPELLIDO = primerApellido,
 SEGUNDOAPELLIDO = segundoApellido,
 TELEFONO = telefono,
 EMAILC = email,
 rol = rolVal 
WHERE CEDULA = cedulaVal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZARPROD` (IN `id_prod` INT, IN `nombreVal` VARCHAR(100), IN `descr` VARCHAR(100), IN `precio` DECIMAL(13,2), IN `cant` INT, IN `img` TEXT)  NO SQL
UPDATE PRODUCTO P SET P.NOMBRE = nombreVal, p.DESCRIPCION = descr, p.CANTIDAD = cant, p.IMAGEN = img WHERE P.ID_PRODUCTO = id_prod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADMINISTRADORES` ()  NO SQL
SELECT CEDULA, NOMBRE, concat_ws(' ', PRIMERAPELLIDO, SEGUNDOAPELLIDO) AS APELLIDOS, EMAILC, TELEFONO FROM USUARIO WHERE ROL = 2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BARBEROS` ()  NO SQL
SELECT CEDULA, NOMBRE, concat_ws(' ', PRIMERAPELLIDO, SEGUNDOAPELLIDO) AS APELLIDOS, EMAILC, TELEFONO FROM USUARIO WHERE ROL = 3$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BARBEROSB` (IN `id_barbero` INT)  NO SQL
SELECT CEDULA, NOMBRE, concat_ws(' ', PRIMERAPELLIDO, SEGUNDOAPELLIDO) AS APELLIDOS, EMAILC, TELEFONO FROM USUARIO WHERE ROL = 3 AND CEDULA = id_barbero$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CITAS` ()  NO SQL
SELECT ID_CITA, B.NOMBRE, H.ID_HORARIO, U.CEDULA, concat_ws(' ', U.NOMBRE, U.PRIMERAPELLIDO) AS USUARIO, C.FECHA, DESCRIPCION, ESTADO, S.NOMBRESERVICIO, S.PRECIOSERVICIO 
FROM cita C, usuario B, horario H, usuario U, servicio S
WHERE C.ID_BARBERO = B.CEDULA AND C.ID_HORARIO = H.ID_HORARIO AND C.ID_SERVICIO = S.ID_SERVICIO AND C.CEDULA = U.CEDULA$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSACTUALIZAR` (IN `ID_CLIENTE` INT)  NO SQL
SELECT NOMBRE, PRIMERAPELLIDO, SEGUNDOAPELLIDO, EMAILC, TELEFONO, NOMBRE_ROL, CEDULA FROM USUARIO U, ROLES R WHERE U.rol = R.ID_ROL AND CEDULA = ID_CLIENTE$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSACTUALIZARADMIN` (IN `cedulaVal` INT)  NO SQL
SELECT U.CEDULA, U.NOMBRE, U.PRIMERAPELLIDO, U.SEGUNDOAPELLIDO, U.TELEFONO, R.NOMBRE_ROL
FROM USUARIO U, ROLES R
WHERE U.rol = R.ID_ROL AND U.CEDULA = cedulaVal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSACTUALIZARCITA` (IN `id_citaVal` INT)  NO SQL
SELECT C.ID_CITA, B.NOMBRE, ID_HORARIO, S.NOMBRESERVICIO, C.FECHA, C.ESTADO
FROM SERVICIO S, CITA C, USUARIO B
WHERE C.ID_SERVICIO = S.ID_SERVICIO AND C.ID_BARBERO = B.CEDULA AND S.ID_SERVICIO = C.ID_SERVICIO AND C.ID_CITA = id_citaVal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSACTUALIZARPROD` (IN `id_productoVal` INT)  NO SQL
SELECT p.ID_PRODUCTO, p.NOMBRE, p.DESCRIPCION, p.PRECIO, p.CANTIDAD, p.IMAGEN FROM producto P WHERE P.ID_PRODUCTO = id_productoVal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GETCITA` (IN `id_citaVal` INT)  NO SQL
SELECT C.ID_CITA, B.NOMBRE, ID_HORARIO, S.NOMBRESERVICIO, C.FECHA
FROM SERVICIO S, CITA C, USUARIO B
WHERE C.ID_SERVICIO = S.ID_SERVICIO AND C.ID_BARBERO = B.CEDULA AND S.ID_SERVICIO = C.ID_SERVICIO AND C.ID_CITA = id_citaVal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PRODUCTOS` ()  NO SQL
SELECT ID_PRODUCTO, NOMBRE, DESCRIPCION, PRECIO, CANTIDAD FROM producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TABLACLIENTE` (IN `ID_CLIENTE` INT)  SELECT c.ID_CITA, FECHA, b.NOMBRE, ID_HORARIO, NOMBRESERVICIO, PRECIO 
FROM usuario B, CITA C, servicio s 
WHERE C.ID_BARBERO = B.CEDULA AND C.ID_SERVICIO = S.ID_SERVICIO AND C.CEDULA = ID_CLIENTE$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TABLACLIENTES` ()  NO SQL
SELECT CEDULA, NOMBRE, concat_ws(' ', PRIMERAPELLIDO, SEGUNDOAPELLIDO) AS APELLIDOS, EMAILC, TELEFONO FROM USUARIO WHERE ROL = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPDATEDATA` (IN `id_citaVal` INT)  NO SQL
UPDATE CITA SET ESTADO = "REALIZADA" WHERE ID_CITA = id_citaVal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPDATEDATA2` (IN `id_citaVal` INT)  NO SQL
UPDATE CITA SET ESTADO = "PENDIENTE" WHERE ID_CITA = id_citaVal$$

DELIMITER ;

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
  `ESTADO` varchar(100) DEFAULT NULL,
  `ID_SERVICIO` int(11) DEFAULT NULL,
  `PRECIO` decimal(5,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`ID_CITA`, `ID_BARBERO`, `ID_HORARIO`, `CEDULA`, `FECHA`, `DESCRIPCION`, `ESTADO`, `ID_SERVICIO`, `PRECIO`) VALUES
(107, 117250705, '14:00:00', 110780256, '2019-08-08', NULL, 'REALIZADA', 6, '12000'),
(108, 117250705, '10:00:00', 132456789, '2019-08-28', NULL, 'PENDIENTE', 6, '6000'),
(111, 117250705, '14:00:00', 203670467, '2019-08-28', 'hola', 'PENDIENTE', 6, '6000'),
(112, 109234729, '14:00:00', 198032403, '2019-08-24', NULL, 'PENDIENTE', 6, '6000'),
(114, 678462467, '10:00:00', 110780256, '2019-08-23', 'Sin comentarios', 'PENDIENTE', 7, '12000'),
(117, 109234729, '11:00:00', 17282007, '0000-00-00', NULL, 'PENDIENTE', 6, '6000'),
(119, 117250705, '16:00:00', 17282007, '2019-08-30', NULL, 'PENDIENTE', 6, '6000'),
(120, 678462467, '16:00:00', 17282007, '2019-08-30', NULL, 'PENDIENTE', 6, '6000'),
(122, 109234729, '11:00:00', 17282007, '2019-08-29', NULL, 'PENDIENTE', 6, '6000'),
(123, 109234729, '09:00:00', 17282007, '2019-08-28', NULL, 'PENDIENTE', 5, '3000'),
(124, 109234729, '09:00:00', 17282007, '2019-08-31', NULL, 'PENDIENTE', 5, '3000'),
(126, 117250705, '09:00:00', 17282007, '0000-00-00', NULL, 'PENDIENTE', 5, '3000');

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
-- Estructura de tabla para la tabla `orden`
--

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
(2, 'Kit Charles', 'Kit Charles', '15000.00', '', 'D', 6, '../img/productos/kit-charles.png'),
(3, 'Shaving Charles', 'Shaving Charles', '12000.00', '', 'D', 15, '../img/productos/shaving-charles.png'),
(4, 'Shaving Soap', 'Shaving Soap', '9000.00', '', 'D', 9, '../img/productos/shaving-soap.png'),
(5, 'Aceite Bay Rum Beard', 'Grande', '14000.00', '', 'D', 10, '../img/productos/suavecito-bay-rum-beard-oil_large.png'),
(6, 'Prueba', 'Prueba2', '5000.00', '', 'D', 2, '../img/productos/balsamo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID_ROL` int(11) NOT NULL,
  `NOMBRE_ROL` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID_ROL`, `NOMBRE_ROL`) VALUES
(1, 'CLIENTE'),
(2, 'ADMINISTRADOR'),
(3, 'BARBERO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

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
(17282007, 'Emma', 'Rose', 'Li', 'emma@gmail.com', '70826871', '$2y$10$OYGFkaWK1.I.r/r6xHZeGO84hbnKMemkp0wyEGIwCvdK1mZqr7vOS', 1),
(109234729, 'Minor', 'Davis', 'Segura', 'minor@gmail.com', '98217309', '$2y$10$Szo787hvaXUAkiWQuqcT4O6T2Tx0GvQduEsGM3T3/ZOHGRrjlMoIy', 3),
(110780256, 'David', 'Viquez', 'Marin', 'david@gmail.com', '60367856', '$2y$10$xdXdSro.UDpxDB/2hScIBO0GCY6WaNoyEbNKsXJFXeJ8di0Tx.qma', 1),
(117090968, 'Ignacio', 'Ramirez', 'Matamoros', 'ignaciorm1319@gmail.com', '86045616', '$2y$10$pQcxESVZuvHKudbUm0iMZuJZLSGVCZ3RPInE3jletI5ziI8u.GS4i', 2),
(117250705, 'Keissy', 'Leiton', 'Hernandez', 'keissy@gmail.com', '60830513', '$2y$10$u2150guKAx0w.0YJrN3vneKTa/McbeOeljT3gw2r/z6.PcDfGH6Ne', 3),
(123456789, 'Mario', 'Marin', 'Castro', 'benito@gmail.com', '87992514', '$2y$10$Fq2oHVu7UioMvfGUN/I31uRZhsuUuckn6lSrOwTwcmw4M7AgisIs6', 2),
(132456789, 'Mario', 'Marin', 'Castro', 'mario@gmail.com', '87992514', '$2y$10$R6FfptqR6h/Qv768irwLbevLTyeoH9bfCXJj4waOAZ8ObWsAsFTCK', 1),
(198032403, 'Jose', 'Varela', 'Monge', 'jose@gmail.com', '83920189', '$2y$10$TjYp6q3TUzE2NSK88BJwgOpCPw6HNT4X0vJdBSoMAdwkYNK8XI3o6', 1),
(203670467, 'Mario', 'Marin', 'Castro', 'mario@gmail.com', '87992514', '$2y$10$VIyGCZvijGqkKd2crda0I.8VgpgFDXUDgzM4xolNLqVND/87nmeJy', 1),
(345236243, 'Mario', 'Marin', 'Castro', 'mario@gmail.com', '87992514', '$2y$10$.V917K/ZfMrMbIA862wQM.SsuVR/rsjIK0zs4Cvp3ihBVpdkLkdPO', 1),
(436475757, 'Mario', 'Marin', 'Castro', 'mario@gmail.com', '87992514', '$2y$10$pWHAN8RS7MCDab4NM0J6OOQLsNcwoRdJkelz/VDS0MrR70KbVWl/K', 1),
(546345634, 'Carlos', 'Sanchez', 'Guevara', 'carlos@gmail.com', '68729010', '$2y$10$i2svnAEeSEQeiCzcLGfkReiAnbFtmJpmPuuLeJne8ddeTe1w8kzw6', 2),
(546456546, 'Mario', 'Marin', 'Castro', 'mario@gmail.com', '87992514', '$2y$10$PD3N4gm7XpRWYTsNzmTZZeiNyjPL5FcEbcbxxMPlbRU444McRbwTS', 1),
(678462467, 'Jerry', 'Salas', 'Mora', 'jerry@gmail.com', '60567945', '$2y$10$5r9NeuTPdITe10A3DSYaB.e7Vf27lRCfJN/uexkc6y7GXTx2Ma29G', 3),
(702567025, 'Daniela', 'Monge', 'Cartin', 'daniela@gmail.com', '60260356', '$2y$10$SCb6IYsP.bJm9gisF/v0auzvXlPouRukfWtAlKhKiUCoarGX92PZa', 1),
(826713892, 'Mario', 'Marin', 'Castro', 'mario@gmail.com', '87992514', '$2y$10$cOOwgu9PpPg6vdh0bMrCf.Ekll4EXLwX.GUt0ikVeLmHB1VuTbejy', 1),
(832749238, 'Mario', 'Marin', 'Castro', 'mario@gmail.com', '87992514', '$2y$10$oCsdX.TUYTVRwyprfWJVW.Y30Q9lY8j5vmYMRgJqQx/vXxtgTeNnC', 1),
(876983274, 'Mario', 'Marin', 'Castro', 'mario@gmail.com', '87992514', '$2y$10$QWX0xs2F6a1jw2TYZtMJ.O1SOIiJJzyLPYdoiLZmRHMaDA0xkHcxW', 1),
(888888888, 'Mario', 'Marin', 'Castro', 'mario@gmail.com', '87992514', '$2y$10$XNqPa3hnynZaEA0ChWCEWeNE.WaeNJoNOInxVGdYFdnaXQVKiV3bi', 1),
(2147483647, 'Mario', 'Marin', 'Castro', 'mario@gmail.com', '87992514', '$2y$10$b/cI/wNOd8CYLMG3UxmXy.NoaB/frsKbhhuXe9SHF..7vYHIc6wS6', 1);

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
  ADD UNIQUE KEY `CEDULA` (`CEDULA`),
  ADD KEY `EMAILC` (`EMAILC`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `ID_CITA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

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
  MODIFY `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
