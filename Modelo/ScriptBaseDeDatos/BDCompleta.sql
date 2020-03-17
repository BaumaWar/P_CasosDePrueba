DROP DATABASE IF EXISTS `proyecto_casosprueba`;
CREATE DATABASE IF NOT EXISTS `proyecto_casosprueba` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proyecto_casosprueba`;

CREATE TABLE IF NOT EXISTS `modulo` (
  `id_modulo` int(20) NOT NULL AUTO_INCREMENT,
  `mod_descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id_tip_doc` tinyint(2) NOT NULL AUTO_INCREMENT,
  `tip_doc_descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tip_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tipo_prueba` (
  `id_tip_pru` bigint(50) NOT NULL AUTO_INCREMENT,
  `tip_pru_descripcion` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id_tip_pru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usu` bigint(50) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `num_documento` varchar(50) DEFAULT NULL,
  `fk_tip_doc` tinyint(2) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_usu`),
  KEY `fk_tip_doc` (`fk_tip_doc`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`fk_tip_doc`) REFERENCES `tipo_documento` (`id_tip_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `calificacion` (
  `id_cal` tinyint(2) NOT NULL AUTO_INCREMENT,
  `cal_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `caso_prueba` (
  `id_cas_pru` bigint(50) NOT NULL AUTO_INCREMENT,
  `fk_tip_pru` bigint(50) DEFAULT NULL,
  `fk_usu` bigint(50) DEFAULT NULL,
  `nombre_caso` varchar(800) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_creacion` varchar(21) DEFAULT NULL,
  `fecha_modificacion` varchar(21) DEFAULT NULL,
  `estado` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id_cas_pru`),
  KEY `fk_tip_pru` (`fk_tip_pru`),
  KEY `fk_usu` (`fk_usu`),
  CONSTRAINT `caso_prueba_ibfk_1` FOREIGN KEY (`fk_tip_pru`) REFERENCES `tipo_prueba` (`id_tip_pru`),
  CONSTRAINT `caso_prueba_ibfk_2` FOREIGN KEY (`fk_usu`) REFERENCES `usuario` (`id_usu`),
  CONSTRAINT `caso_prueba_ibfk_3` FOREIGN KEY (`fk_usu`) REFERENCES `usuario` (`id_usu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `prueba_proceso` (
  `id_pru_pro` bigint(50) NOT NULL AUTO_INCREMENT,
  `fk_usu` bigint(50) DEFAULT NULL,
  `fk_mod` int(20) DEFAULT NULL,
  `descripcion_pru_pro` varchar(200) DEFAULT NULL,
  `fecha_creacion` varchar(21) DEFAULT NULL,
  `fecha_modificacion` varchar(21) DEFAULT NULL,
  PRIMARY KEY (`id_pru_pro`),
  KEY `fk_usu` (`fk_usu`),
  KEY `fk_mod` (`fk_mod`),
  CONSTRAINT `prueba_proceso_ibfk_1` FOREIGN KEY (`fk_usu`) REFERENCES `usuario` (`id_usu`),
  CONSTRAINT `prueba_proceso_ibfk_2` FOREIGN KEY (`fk_mod`) REFERENCES `modulo` (`id_modulo`),
  CONSTRAINT `prueba_proceso_ibfk_3` FOREIGN KEY (`fk_usu`) REFERENCES `usuario` (`id_usu`),
  CONSTRAINT `prueba_proceso_ibfk_4` FOREIGN KEY (`fk_mod`) REFERENCES `modulo` (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `detalle_caso_prueba` (
  `id_det_cas_pru` bigint(50) NOT NULL AUTO_INCREMENT,
  `fk_cas_pru` bigint(50) DEFAULT NULL,
  `det_descripcion` varchar(10000) CHARACTER SET utf8 DEFAULT NULL,
  `valores_entrada` varchar(3000) DEFAULT NULL,
  `precondiciones_ejecucion` varchar(3000) DEFAULT NULL,
  `resultados_esperados` varchar(3000) DEFAULT NULL,
  `post_condiciones` varchar(3000) DEFAULT NULL,
  `estado` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id_det_cas_pru`),
  KEY `fk_cas_pru` (`fk_cas_pru`),
  CONSTRAINT `detalle_caso_prueba_ibfk_1` FOREIGN KEY (`fk_cas_pru`) REFERENCES `caso_prueba` (`id_cas_pru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `detalle_prueba_proceso` (
  `id_det_pru_pro` bigint(50) NOT NULL AUTO_INCREMENT,
  `fk_pru_pro` bigint(50) DEFAULT NULL,
  `fk_cas_pru` bigint(50) DEFAULT NULL,
  `fk_calificacion` tinyint(2) DEFAULT NULL,
  `argumento` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`id_det_pru_pro`),
  KEY `fk_pru_pro` (`fk_pru_pro`),
  KEY `fk_cas_pru` (`fk_cas_pru`),
  KEY `fk_calificacion` (`fk_calificacion`),
  CONSTRAINT `detalle_prueba_proceso_ibfk_1` FOREIGN KEY (`fk_pru_pro`) REFERENCES `prueba_proceso` (`id_pru_pro`),
  CONSTRAINT `detalle_prueba_proceso_ibfk_2` FOREIGN KEY (`fk_cas_pru`) REFERENCES `caso_prueba` (`id_cas_pru`),
  CONSTRAINT `detalle_prueba_proceso_ibfk_3` FOREIGN KEY (`fk_calificacion`) REFERENCES `calificacion` (`id_cal`),
  CONSTRAINT `detalle_prueba_proceso_ibfk_4` FOREIGN KEY (`fk_pru_pro`) REFERENCES `prueba_proceso` (`id_pru_pro`),
  CONSTRAINT `detalle_prueba_proceso_ibfk_5` FOREIGN KEY (`fk_cas_pru`) REFERENCES `caso_prueba` (`id_cas_pru`),
  CONSTRAINT `detalle_prueba_proceso_ibfk_6` FOREIGN KEY (`fk_calificacion`) REFERENCES `calificacion` (`id_cal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `notificacion` (
  `id_notificacion` bigint(50) NOT NULL AUTO_INCREMENT,
  `fk_usu_receptor` bigint(50) DEFAULT NULL,
  `fk_pru_pro` bigint(50) DEFAULT NULL,
  `fk_usu_emisor` bigint(50) DEFAULT NULL,
  `fecha_creacion` varchar(21) DEFAULT NULL,
  `estado` tinyint(2) DEFAULT NULL,
  `fecha_visto` varchar(21) DEFAULT NULL,
  `fecha_leido` varchar(21) DEFAULT NULL,
  PRIMARY KEY (`id_notificacion`),
  KEY `fk_usu_receptor` (`fk_usu_receptor`),
  KEY `fk_usu_emisor` (`fk_usu_emisor`),
  KEY `fk_pru_pro` (`fk_pru_pro`),
  CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`fk_usu_receptor`) REFERENCES `usuario` (`id_usu`),
  CONSTRAINT `notificacion_ibfk_2` FOREIGN KEY (`fk_usu_emisor`) REFERENCES `usuario` (`id_usu`),
  CONSTRAINT `notificacion_ibfk_3` FOREIGN KEY (`fk_pru_pro`) REFERENCES `prueba_proceso` (`id_pru_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `modulo` (`id_modulo`, `mod_descripcion`) VALUES
	(1, 'Liquidacion'),
	(2, 'Rastreo'),
	(3, 'Despacho'),
	(4, 'Resportes'),
	(5, 'Usuario'),
	(6, 'Auditoria'),
	(7, 'Registradora'),
	(8, 'Indicadores'),
	(9, 'Vehiculo'),
	(10, 'Coductor'),
	(11, 'Alarmas'),
	(12, 'Puntos de control'),
	(13, 'Rutas'),
	(14, 'Empresa'),
	(15, 'Matenimiento'),
	(16, 'Liciencia de conducion'),
	(17, 'Polizas'),
	(18, 'Entorno'),
	(19, 'Configuracion de servidor wifi'),
	(20, 'Categorias de descuento'),
	(21, 'Perfiles'),
	(22, 'Asociacion empresa-vehiculo'),
	(23, 'Propietarios'),
	(24, 'Grupo de vehiculos'),
	(25, 'GPS'),
	(26, 'Documentos-tarjeta operacion'),
	(27, 'Inventario'),
	(28, 'Parametros de confioguracion'),
	(29, 'Geozona'),
	(30, 'GPS modelo'),
	(31, 'Hardware'),
	(32, 'GPS tarjeta sim-operador'),
	(33, 'GPS-tarjeta sim'),
	(34, 'Documentos-tarjeta operacion-vehiculo'),
	(35, 'Documentos-revision tecnico mecanica'),
	(36, 'Documentos-revision tecnico mecanica-vehiculo'),
	(37, 'Documentos-centro de diagnostico'),
	(38, 'Documentos-centor de expedicion'),
	(39, 'Asociacion conductor-vehiculo'),
	(40, 'Acerca de'),
	(41, 'Inicio'),
	(42, 'Sin modulo.');

INSERT INTO `tipo_documento` (`id_tip_doc`, `tip_doc_descripcion`) VALUES
	(1, 'Cedula de ciudadania'),
	(2, 'Tarjeta de identidad');
	
INSERT INTO `tipo_prueba` (`id_tip_pru`, `tip_pru_descripcion`) VALUES
	(1, 'Caja blanca'),
	(2, 'Caja negra');
	
INSERT INTO `calificacion` (`id_cal`, `cal_descripcion`) VALUES
	(1, 'Si'),
	(2, 'No');

ALTER TABLE caso_prueba ADD(fk_modulo INT(20));
ALTER TABLE caso_prueba add FOREIGN KEY(fk_modulo) REFERENCES modulo(id_modulo);









