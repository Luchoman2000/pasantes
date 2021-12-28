-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para db_asistencias
CREATE DATABASE IF NOT EXISTS `db_asistencias` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_asistencias`;

-- Volcando estructura para tabla db_asistencias.asistencia
CREATE TABLE IF NOT EXISTS `asistencia` (
  `asi_id` int(11) NOT NULL AUTO_INCREMENT,
  `asi_dia` date NOT NULL,
  `asi_hora_ingreso` time NOT NULL DEFAULT '00:00:00',
  `asi_hora_salida_a` time NOT NULL DEFAULT '00:00:00',
  `asi_hora_regreso_a` time NOT NULL DEFAULT '00:00:00',
  `asi_hora_salida` time NOT NULL DEFAULT '00:00:00',
  `per_id` int(11) NOT NULL,
  PRIMARY KEY (`asi_id`),
  KEY `fk_ASISTENCIA_PERSONAL1_idx` (`per_id`),
  CONSTRAINT `fk_ASISTENCIA_PERSONAL1` FOREIGN KEY (`per_id`) REFERENCES `personal` (`per_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla db_asistencias.asistencia: ~62 rows (aproximadamente)
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` (`asi_id`, `asi_dia`, `asi_hora_ingreso`, `asi_hora_salida_a`, `asi_hora_regreso_a`, `asi_hora_salida`, `per_id`) VALUES
	(6, '2021-08-25', '08:37:13', '12:01:00', '12:30:00', '15:02:20', 1),
	(41, '2021-10-28', '20:43:51', '21:02:06', '21:02:15', '21:02:19', 1),
	(42, '2021-10-29', '20:33:46', '20:34:24', '20:34:40', '20:34:43', 1),
	(45, '2021-10-30', '10:58:32', '11:10:37', '11:10:49', '00:00:00', 1),
	(59, '2021-11-02', '23:43:30', '00:00:00', '00:00:00', '23:58:00', 1),
	(62, '2021-11-03', '00:42:57', '00:00:00', '00:00:00', '21:16:32', 1),
	(63, '2021-11-03', '21:30:56', '21:33:08', '21:33:10', '21:32:22', 2),
	(64, '2021-11-04', '20:37:29', '00:00:00', '00:00:00', '00:00:00', 1),
	(66, '2021-11-05', '20:53:51', '00:00:00', '00:00:00', '20:54:00', 1),
	(69, '2021-11-06', '15:48:20', '00:00:00', '00:00:00', '17:24:00', 1),
	(73, '2021-11-07', '19:53:19', '00:00:00', '00:00:00', '19:54:19', 1),
	(74, '2021-11-08', '19:59:39', '00:00:00', '00:00:00', '22:32:52', 1),
	(75, '2021-11-08', '20:00:21', '20:05:30', '20:05:57', '20:06:04', 2),
	(76, '2021-11-09', '20:39:04', '00:00:00', '00:00:00', '00:00:00', 1),
	(77, '2021-11-13', '22:47:21', '00:00:00', '00:00:00', '00:00:00', 1),
	(88, '2021-11-14', '17:48:05', '18:01:36', '00:00:00', '00:00:00', 1),
	(89, '2021-11-15', '18:27:04', '00:00:01', '18:24:02', '18:24:59', 1),
	(91, '2021-11-17', '20:06:22', '00:00:00', '00:00:00', '21:04:00', 1),
	(92, '2021-11-18', '08:41:31', '00:00:00', '00:00:00', '14:50:08', 1),
	(103, '2021-11-19', '11:13:55', '00:00:00', '00:00:00', '17:00:00', 2),
	(104, '2021-11-19', '14:24:45', '00:00:00', '00:00:00', '00:00:00', 4),
	(105, '2021-11-20', '09:21:01', '00:00:00', '00:00:00', '00:00:00', 4),
	(106, '2021-11-20', '20:57:38', '00:00:00', '00:00:00', '00:00:00', 2),
	(108, '2021-11-24', '10:27:52', '00:00:00', '00:00:00', '00:00:00', 2),
	(109, '2021-11-25', '17:36:33', '00:00:00', '00:00:00', '00:00:00', 1),
	(111, '2021-11-27', '09:22:04', '00:00:00', '00:00:00', '00:00:00', 1),
	(112, '2021-11-28', '12:11:08', '21:35:24', '21:35:26', '21:35:28', 1),
	(113, '2021-11-28', '20:11:54', '00:00:00', '00:00:00', '23:00:00', 2),
	(114, '2021-11-30', '19:40:06', '00:00:00', '00:00:00', '21:23:32', 1),
	(115, '2021-12-01', '20:53:03', '00:00:00', '00:00:00', '00:00:00', 4),
	(116, '2021-12-03', '21:01:06', '00:00:00', '00:00:00', '00:00:00', 1),
	(117, '2021-12-04', '08:28:09', '17:10:19', '17:10:24', '17:10:29', 1),
	(118, '2021-12-04', '14:38:52', '00:00:00', '00:00:00', '14:39:10', 4),
	(119, '2021-12-04', '15:28:30', '15:29:00', '00:00:00', '00:00:00', 2),
	(120, '2021-12-04', '01:00:00', '01:30:00', '02:00:00', '03:00:00', 5),
	(122, '2021-12-05', '09:31:25', '00:00:00', '00:00:00', '00:00:00', 1),
	(123, '2021-12-05', '22:03:33', '00:00:00', '00:00:00', '00:00:00', 4),
	(124, '2021-12-06', '13:32:03', '00:00:00', '00:00:00', '19:00:00', 5),
	(125, '2021-12-06', '13:35:43', '13:36:00', '13:36:08', '13:36:17', 1),
	(126, '2021-12-07', '10:17:16', '00:00:00', '00:00:00', '10:47:51', 1),
	(127, '2021-12-07', '10:27:52', '20:57:03', '20:57:08', '20:57:15', 4),
	(129, '2021-12-08', '09:39:14', '09:39:14', '09:39:15', '00:00:00', 5),
	(130, '2021-12-10', '08:15:52', '00:00:00', '00:00:00', '00:00:00', 5),
	(132, '2021-12-11', '08:53:50', '00:00:00', '00:00:00', '00:00:00', 5),
	(135, '2021-12-12', '20:23:01', '00:00:00', '00:00:00', '21:02:00', 4),
	(136, '2021-12-12', '22:05:01', '22:09:27', '22:09:38', '22:11:56', 1),
	(139, '2021-12-13', '09:50:28', '09:50:33', '00:00:00', '00:00:00', 4),
	(140, '2021-12-13', '10:31:43', '10:33:54', '10:53:33', '13:18:44', 1),
	(143, '2021-12-15', '05:00:00', '00:00:00', '00:00:00', '00:00:00', 4),
	(144, '2021-12-13', '15:00:17', '15:00:41', '15:00:51', '15:01:08', 12),
	(145, '2021-12-13', '15:13:44', '00:00:00', '00:00:00', '00:00:00', 6),
	(148, '2021-12-16', '20:45:13', '00:00:00', '00:00:00', '00:00:00', 12),
	(150, '2021-12-16', '21:02:01', '00:00:00', '00:00:00', '00:00:00', 6),
	(154, '2021-12-17', '18:44:21', '00:00:00', '00:00:00', '19:18:11', 1),
	(165, '2021-12-18', '13:23:07', '13:23:39', '15:21:42', '15:21:46', 1),
	(168, '2021-12-19', '00:05:01', '00:00:00', '00:00:00', '00:00:00', 6),
	(169, '2021-12-19', '00:09:31', '00:00:00', '00:00:00', '00:00:00', 1),
	(171, '2021-12-19', '00:46:59', '00:00:00', '00:00:00', '00:00:00', 12),
	(172, '2021-12-02', '08:00:00', '12:03:00', '13:22:00', '15:00:00', 1),
	(173, '2021-12-20', '08:00:00', '09:11:44', '09:11:50', '00:00:00', 1),
	(174, '2021-12-19', '16:26:33', '00:00:00', '00:00:00', '00:00:00', 5),
	(175, '2021-12-19', '16:35:33', '00:00:00', '00:00:00', '00:00:00', 7),
	(179, '2021-12-20', '09:17:54', '09:18:05', '09:18:07', '00:00:00', 17);
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;

-- Volcando estructura para tabla db_asistencias.auditoria
CREATE TABLE IF NOT EXISTS `auditoria` (
  `aud_id` int(11) NOT NULL AUTO_INCREMENT,
  `aud_responsable` varchar(100) NOT NULL,
  `aud_accion` varchar(50) NOT NULL,
  `aud_descripcion` varchar(255) NOT NULL,
  `aud_valor_antes` varchar(50) DEFAULT NULL,
  `aud_valor_ahora` varchar(50) DEFAULT NULL,
  `aud_fecha_hora` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`aud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla db_asistencias.auditoria: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `auditoria` DISABLE KEYS */;
INSERT INTO `auditoria` (`aud_id`, `aud_responsable`, `aud_accion`, `aud_descripcion`, `aud_valor_antes`, `aud_valor_ahora`, `aud_fecha_hora`) VALUES
	(1, 'jsjjs sjej', 'Eliminar', 'Eliminó un personal', '15', NULL, '2021-12-19 22:20:54'),
	(2, 'jsjjs sjej', 'Eliminar', 'Eliminó un personal', '16', NULL, '2021-12-19 22:22:50'),
	(3, 'jsjjs sjej', 'Editar', 'Editó un personal', 'N/A', 'N/A', '2021-12-19 22:27:21');
/*!40000 ALTER TABLE `auditoria` ENABLE KEYS */;

-- Volcando estructura para tabla db_asistencias.horario
CREATE TABLE IF NOT EXISTS `horario` (
  `hor_id` int(11) NOT NULL AUTO_INCREMENT,
  `hor_entrada` time NOT NULL DEFAULT '00:00:00',
  `hor_salida_a` time DEFAULT '00:00:00',
  `hor_regreso_a` time DEFAULT '00:00:00',
  `hor_salida` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`hor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla db_asistencias.horario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` (`hor_id`, `hor_entrada`, `hor_salida_a`, `hor_regreso_a`, `hor_salida`) VALUES
	(1, '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
	(4, '04:03:00', '12:03:00', '12:03:00', '23:01:00'),
	(7, '04:56:00', '23:04:00', '23:04:00', '03:45:00'),
	(8, '08:00:00', '12:03:00', '13:22:00', '15:00:00');
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;

-- Volcando estructura para tabla db_asistencias.personal
CREATE TABLE IF NOT EXISTS `personal` (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `per_pri_nombre` varchar(100) NOT NULL,
  `per_seg_nombre` varchar(100) DEFAULT '""',
  `per_pri_apellido` varchar(100) NOT NULL,
  `per_seg_apellido` varchar(100) DEFAULT '""',
  `per_dni` varchar(20) NOT NULL,
  `per_telefono` varchar(20) DEFAULT '"N/A"',
  `per_correo` varchar(150) DEFAULT '"N/A"',
  `per_direccion` varchar(150) DEFAULT NULL,
  `per_fecha_nacimiento` date DEFAULT '1000-01-01',
  `per_estado` varchar(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla db_asistencias.personal: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
INSERT INTO `personal` (`per_id`, `per_pri_nombre`, `per_seg_nombre`, `per_pri_apellido`, `per_seg_apellido`, `per_dni`, `per_telefono`, `per_correo`, `per_direccion`, `per_fecha_nacimiento`, `per_estado`) VALUES
	(1, 'LUIS', '', 'ESTACIO', 'SABANDO', '1314147552', '123123123', 'LUIS@GMAIL.COM22', '123123', '2000-09-13', '1'),
	(2, 'TEST', 'TEST', 'TEST', 'TEST', '1234567896', '23224534564', 'QWE@ASD.QWE', NULL, '1000-01-01', '1'),
	(3, 'FULANO', 'DE', 'TAL', 'XD', '1234567896', '2346544678', 'qwe@123.com', NULL, '1000-01-01', '1'),
	(4, 'EREN', '', 'JEAGER', '', '1314147552j', '12352453254', 'eren@gmail.com', NULL, '1000-01-01', '1'),
	(5, 'Yalek', 'Benito', 'Zapata', 'Yepeto', '171465413', '0999999999', 'asdasd@nosequehacer.gob', NULL, '1000-01-01', '1'),
	(6, 'ANGEL', 'LUIS', 'ESTACIO', '', 'asd', '+593979279968', 'luisangellibra2000@gmail.com', NULL, '2222-03-12', '1'),
	(7, 'TTRR', '', 'TRRTRT', '', 'erte', '', '', NULL, '0000-00-00', '0'),
	(9, 'jsjjs', 'j123', 'sjej', 'jwje', '', '879', 'asd@asd.asd', 'qw', '2021-11-09', '1'),
	(11, 'QWE', '', 'QWE', '', 'qweqwe', '', '', NULL, '0000-00-00', '1'),
	(12, 'JOSEPH', '', 'OBANDO', '', '1750166637', '0999999999', 'Hola_K_Ase@outlook.com', 'Mi casa', '2023-06-07', '1'),
	(13, 'yo', '', 'tu', '', '1718197161', '', '', NULL, '0000-00-00', '1'),
	(17, 'kevin', 'danilo', 'castro', '', '127383836', '0987266622', 'cjmayk@hotmail.com', NULL, '2021-12-20', '1');
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;

-- Volcando estructura para tabla db_asistencias.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(45) NOT NULL DEFAULT 'PASANTE',
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla db_asistencias.rol: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
	(1, 'ADMINISTRADOR'),
	(3, 'PASANTE');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando estructura para tabla db_asistencias.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_usuario` varchar(45) NOT NULL,
  `usu_clave` varchar(100) NOT NULL,
  `usu_estado` varchar(2) NOT NULL DEFAULT '1',
  `per_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `hor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usu_id`),
  KEY `fk_USUARIO_PERSONAL_idx` (`per_id`),
  KEY `fk_USUARIO_ROL1_idx` (`rol_id`),
  KEY `hor_id` (`hor_id`) USING BTREE,
  CONSTRAINT `fk_USUARIO_HORARIO` FOREIGN KEY (`hor_id`) REFERENCES `horario` (`hor_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_USUARIO_PERSONAL` FOREIGN KEY (`per_id`) REFERENCES `personal` (`per_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_USUARIO_ROL1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla db_asistencias.usuario: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usu_id`, `usu_usuario`, `usu_clave`, `usu_estado`, `per_id`, `rol_id`, `hor_id`) VALUES
	(1, 'lman', '$2y$10$zDqnJM92el5aCFk7tuTI1.KT5qvswQj67G3B6RAX60f18JmDXSvqu', '1', 1, 3, 8),
	(13, 'administrador', '$2y$10$ckR/yJYoHu/AsIHBRPNba.VBIV2M7beOuQ/c0uNRSO7PhQ07HBoam', '1', 9, 1, 1),
	(18, '1123', '$2y$10$pqA.t9DehMQK8IzHtY/.wuQeuz5PRBmln9B6HRTOOZBlcvgLYicJa', '1', 3, 1, 4),
	(61, 'qwe', '$2y$10$bZyovR.Fd5Nm/5fhSoa/vudrrVBRdQa542zcUxiOw9o6h1zyFW85O', '1', 7, 3, NULL),
	(62, 'ewq', '$2y$10$yg5awL2t4xrF5QtWYk3qGuaoMTQexX99UdYMOo0hA/gnB/LFG9VOa', '1', 11, 3, 4),
	(64, 'joba', '$2y$10$0pr/4ANvfzizvu9LejgrI.jpAvEU0ISL6CljwM7y7Rw/3m/DFuHdK', '0', 12, 3, 8),
	(65, '123123', '$2y$10$NsV87J3.4u/v3lia79S2su93M/AWhtKe1pDrecIKfiuVLjhkBoiqm', '1', 6, 3, 1),
	(66, 'YOTU', '$2y$10$yScggbqrV3TWrWVKF2NEDusI.9iG4jwuNZn.GOsh7bi5ivW.yOEg6', '1', 13, 3, 8),
	(67, 'test', '$2y$10$/8la0ra5JLVcie3j/74Jp.v6qGpfCSIu6Pzis6jnrEB9KvhYr1ukC', '1', 5, 3, 8),
	(69, 'kvn420', '$2y$10$4BI5bB78pRfJj3TarOSjJuBE2h9uEUFBqQenRTLFkRMfL3XSzxSta', '1', 17, 3, 8);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
