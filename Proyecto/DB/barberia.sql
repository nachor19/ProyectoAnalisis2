-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2019 at 06:35 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barberia`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TABLACLIENTE` (IN `ID_CLIENTE` INT)  SELECT FECHA, NOMBREB, ID_HORARIO, NOMBRESERVICIO, PRECIO 
FROM BARBERO B, CITA C, servicio s 
WHERE C.ID_BARBERO = B.ID_BARBERO AND C.ID_SERVICIO = S.ID_SERVICIO AND C.CEDULA = ID_CLIENTE$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barbero`
--

CREATE TABLE `barbero` (
  `ID_BARBERO` int(11) NOT NULL,
  `NOMBREB` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barbero`
--

INSERT INTO `barbero` (`ID_BARBERO`, `NOMBREB`) VALUES
(1, 'Cristian'),
(2, 'Martin');

-- --------------------------------------------------------

--
-- Table structure for table `cita`
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
-- Dumping data for table `cita`
--

INSERT INTO `cita` (`ID_CITA`, `ID_BARBERO`, `ID_HORARIO`, `CEDULA`, `FECHA`, `DESCRIPCION`, `ESTADO`, `ID_SERVICIO`, `PRECIO`) VALUES
(35, 2, '11:00:00', 117090968, '2019-03-01', NULL, NULL, 5, '3000'),
(36, 1, '15:00:00', 2147483647, '2019-03-01', NULL, NULL, 5, '3000'),
(46, 1, '09:00:00', 117090968, '2019-03-01', NULL, NULL, 5, '3000'),
(69, 2, '13:00:00', 117090968, '2019-03-08', NULL, NULL, 7, '12000'),
(76, 2, '09:00:00', 117090968, '2019-03-08', NULL, NULL, 5, '3000'),
(77, 1, '09:00:00', 117090968, '2019-03-08', NULL, NULL, 5, '3000'),
(82, 2, '13:00:00', 117090968, '2019-03-09', NULL, NULL, 7, '12000'),
(83, 2, '11:00:00', 117090968, '2019-03-09', NULL, NULL, 7, '12000'),
(84, 2, '16:00:00', 117090968, '2019-03-09', NULL, NULL, 7, '12000'),
(85, 2, '14:00:00', 117090968, '2019-03-09', NULL, NULL, 7, '12000'),
(86, 2, '09:00:00', 117090968, '2019-03-09', NULL, NULL, 5, '3000'),
(87, 1, '09:00:00', 117090968, '2019-03-09', NULL, NULL, 5, '3000'),
(88, 2, '15:00:00', 117090968, '2019-03-09', NULL, NULL, 5, '3000'),
(89, 1, '09:00:00', 117090968, '2019-09-03', NULL, NULL, 5, '3000'),
(90, 1, '09:00:00', 117090968, '2019-03-22', NULL, NULL, 5, '3000'),
(91, 2, '15:00:00', 117090968, '2019-03-24', NULL, NULL, 7, '12000'),
(92, 2, '13:00:00', 117090968, '2019-03-24', NULL, NULL, 5, '3000');

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE `horario` (
  `ID_HORARIO` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horario`
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
-- Table structure for table `orden`
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
-- Table structure for table `orden_producto`
--

CREATE TABLE `orden_producto` (
  `ID` int(11) NOT NULL,
  `ORDEN_ID` int(11) NOT NULL,
  `PRODUCTO_ID` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
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
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`ID_PRODUCTO`, `NOMBRE`, `DESCRIPCION`, `PRECIO`, `COMENTARIO`, `ESTADO`, `CANTIDAD`, `IMAGEN`) VALUES
(1, 'Bálsamo', 'Bálsamo para barba y bigote', '13000.00', '', 'D', 7, '../img/productos/balsamo.png'),
(2, 'Kit Charles', 'Prueba', '15000.00', '', 'D', 10, '../img/productos/kit-charles.png'),
(3, 'Shaving Charles', 'Shaving Charles', '12000.00', '', 'D', 15, '../img/productos/shaving-charles.png'),
(4, 'Shaving Soap', 'Shaving Soap', '9000.00', '', 'D', 9, '../img/productos/shaving-soap.png'),
(5, 'Aceite Bay Rum Beard', 'Grande', '14000.00', '', 'D', 10, '../img/productos/suavecito-bay-rum-beard-oil_large.png');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID_ROL` int(11) NOT NULL,
  `NOMBRE_ROL` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID_ROL`, `NOMBRE_ROL`) VALUES
(1, 'cliente'),
(2, 'administrador'),
(3, 'barbero');

-- --------------------------------------------------------

--
-- Table structure for table `servicio`
--

CREATE TABLE `servicio` (
  `ID_SERVICIO` int(11) NOT NULL,
  `TIEMPO_REQUERIDO` time DEFAULT NULL,
  `NOMBRESERVICIO` varchar(100) DEFAULT NULL,
  `PRECIOSERVICIO` decimal(5,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicio`
--

INSERT INTO `servicio` (`ID_SERVICIO`, `TIEMPO_REQUERIDO`, `NOMBRESERVICIO`, `PRECIOSERVICIO`) VALUES
(5, '01:00:00', 'CORTE CABELLO', '3000'),
(6, '01:00:00', 'CORTE DE CABELLO Y BARBA', '6000'),
(7, '02:00:00', 'ALISSETTE', '12000'),
(8, '01:00:00', 'TEÑIDO DE CABELLO', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
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
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`CEDULA`, `NOMBRE`, `PRIMERAPELLIDO`, `SEGUNDOAPELLIDO`, `EMAILC`, `TELEFONO`, `CONTRASENNA`, `rol`) VALUES
(4362646, 'Prueba3', 'Prueba3', 'Prueba3', 'dklfjl@gmail.com', '98327474', '$2y$10$q2JMnI61C.9rW3j470mpne.UwPkDO9IJUI64.PblluZSkYIbIyWme', 1),
(12341234, 'gabdsda', 'esajdsada', 'dasdasd', 'dsa@correo.com', '12341234', '$2y$10$92W.kr5n4TQTZF.r799fsuZx.HsVGcAUucNTv1X8UXlqypv8uRXUq', 1),
(117090968, 'Ignacio', 'Ramirez', 'Matamoros', 'ignaciorm1319@gmail.com', '87992514', '$2y$10$pQcxESVZuvHKudbUm0iMZuJZLSGVCZ3RPInE3jletI5ziI8u.GS4i', 1),
(117250705, 'Keissy', 'Leitón', 'Hernández', 'keissyleiton08@gmail.com', '60830513', '$2y$10$u2150guKAx0w.0YJrN3vneKTa/McbeOeljT3gw2r/z6.PcDfGH6Ne', 1),
(123412341, 'dsfdsfs', 'fadsfdsf', 'asdfasdf', 'rch@gmail.co', '23432141', '$2y$10$TBRGZN02AMXQhpcZAxzi3.7uObIpDJwZBJRXU5NQRc9VO9t.RIaLK', 1),
(123456789, 'Sofia', 'Matamoros', 'Viquez', 'mvsofia@hotmail.com', '88326518', '$2y$10$Fq2oHVu7UioMvfGUN/I31uRZhsuUuckn6lSrOwTwcmw4M7AgisIs6', 1),
(132456789, 'Minor', 'Solano', 'Nuñez', 'minor@gmail.com', '83457846', '$2y$10$R6FfptqR6h/Qv768irwLbevLTyeoH9bfCXJj4waOAZ8ObWsAsFTCK', 1),
(345236243, 'Alejandro', 'Gonzalez', 'Gonzalez', 'alegonpov@gmail.com', '85408223', '$2y$10$.V917K/ZfMrMbIA862wQM.SsuVR/rsjIK0zs4Cvp3ihBVpdkLkdPO', 2),
(347889342, 'David', 'Jimenez', 'Martinez', 'david@gmail.com', '8739487', '$2y$10$rWfHYkvxxDO99DBndAqC9evuCZKVb35HXO6oLFYsILg1zoe/OKOvi', 1),
(546456546, 'Andres', 'Campos', 'Prado', 'maes@gmail.com', '23423423', '$2y$10$PD3N4gm7XpRWYTsNzmTZZeiNyjPL5FcEbcbxxMPlbRU444McRbwTS', 3),
(999999999, 'Ricardo', 'Madrigal', 'Herrera', 'rch@gmail.com', '12341234', '$2y$10$XOepLspqo.V8GRbd9W6Oou0tN0cvp.za3CGsTL5bZJlD4HwPtj/iq', 1),
(2147483647, 'Manfred', 'Martinez', 'Monge', 'manfred@gmail.com', '82143962', '$2y$10$b/cI/wNOd8CYLMG3UxmXy.NoaB/frsKbhhuXe9SHF..7vYHIc6wS6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barbero`
--
ALTER TABLE `barbero`
  ADD PRIMARY KEY (`ID_BARBERO`);

--
-- Indexes for table `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`ID_CITA`),
  ADD KEY `CEDULA` (`CEDULA`),
  ADD KEY `ID_BARBERO` (`ID_BARBERO`),
  ADD KEY `ID_HORARIO` (`ID_HORARIO`),
  ADD KEY `ID_SERVICIO` (`ID_SERVICIO`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`ID_HORARIO`);

--
-- Indexes for table `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`ORDEN_ID`),
  ADD KEY `cliente_id_fk` (`CLIENTE_ID`);

--
-- Indexes for table `orden_producto`
--
ALTER TABLE `orden_producto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `orden_id_fk` (`ORDEN_ID`),
  ADD KEY `producto_id_fk` (`PRODUCTO_ID`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_PRODUCTO`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID_ROL`);

--
-- Indexes for table `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`ID_SERVICIO`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`CEDULA`),
  ADD UNIQUE KEY `EMAILC` (`EMAILC`),
  ADD UNIQUE KEY `CEDULA` (`CEDULA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barbero`
--
ALTER TABLE `barbero`
  MODIFY `ID_BARBERO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cita`
--
ALTER TABLE `cita`
  MODIFY `ID_CITA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `orden`
--
ALTER TABLE `orden`
  MODIFY `ORDEN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orden_producto`
--
ALTER TABLE `orden_producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID_ROL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `servicio`
--
ALTER TABLE `servicio`
  MODIFY `ID_SERVICIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`CEDULA`) REFERENCES `usuario` (`CEDULA`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`ID_BARBERO`) REFERENCES `barbero` (`ID_BARBERO`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`ID_HORARIO`) REFERENCES `horario` (`ID_HORARIO`),
  ADD CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`ID_SERVICIO`) REFERENCES `servicio` (`ID_SERVICIO`);

--
-- Constraints for table `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `cliente_id_fk` FOREIGN KEY (`CLIENTE_ID`) REFERENCES `usuario` (`CEDULA`);

--
-- Constraints for table `orden_producto`
--
ALTER TABLE `orden_producto`
  ADD CONSTRAINT `orden_id_fk` FOREIGN KEY (`ORDEN_ID`) REFERENCES `orden` (`ORDEN_ID`),
  ADD CONSTRAINT `producto_id_fk` FOREIGN KEY (`PRODUCTO_ID`) REFERENCES `producto` (`ID_PRODUCTO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
