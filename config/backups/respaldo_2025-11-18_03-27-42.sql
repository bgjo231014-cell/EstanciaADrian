

CREATE TABLE `capacitacion` (
  `id_capacitacion` int(11) NOT NULL AUTO_INCREMENT,
  `año` int(11) NOT NULL,
  `mes_1` varchar(50) DEFAULT NULL,
  `mes_2` varchar(50) DEFAULT NULL,
  `mes_3` varchar(50) DEFAULT NULL,
  `admvo1` int(11) DEFAULT 0,
  `admvo2` int(11) DEFAULT 0,
  `admvo3` int(11) DEFAULT 0,
  `PTC1` int(11) DEFAULT 0,
  `PTC2` int(11) DEFAULT 0,
  `PTC3` int(11) DEFAULT 0,
  `Honorarios1` int(11) DEFAULT 0,
  `Honorarios2` int(11) DEFAULT 0,
  `Honorarios3` int(11) DEFAULT 0,
  `PA1` int(11) DEFAULT 0,
  `PA2` int(11) DEFAULT 0,
  `PA3` int(11) DEFAULT 0,
  `Servicios1` int(11) DEFAULT 0,
  `Servicios2` int(11) DEFAULT 0,
  `Servicios3` int(11) DEFAULT 0,
  `Alumnos1` int(11) DEFAULT 0,
  `Alumnos2` int(11) DEFAULT 0,
  `Alumnos3` int(11) DEFAULT 0,
  `Visitantes1` int(11) DEFAULT 0,
  `Visitantes2` int(11) DEFAULT 0,
  `Visitantes3` int(11) DEFAULT 0,
  `personas_externas_capacitadas1` int(11) DEFAULT 0,
  `personas_externas_capacitadas2` int(11) DEFAULT 0,
  `personas_externas_capacitadas3` int(11) DEFAULT 0,
  `Cantidad_totalCapa1` float DEFAULT 0,
  `Cantidad_totalCapa2` float DEFAULT 0,
  `Cantidad_totalCapa3` float DEFAULT 0,
  `Total_empirico` float DEFAULT 0,
  `Calculo_total_verdadero1` float DEFAULT 0,
  `Calculo_total_verdadero2` float DEFAULT 0,
  `Calculo_total_verdadero3` float DEFAULT 0,
  `total_verdaderoFinal` float DEFAULT 0,
  `cantidad_hombres` int(11) DEFAULT 0,
  `cantidad_mujeres` int(11) DEFAULT 0,
  `porcentaje_hombres` float DEFAULT 0,
  `porcentaje_mujeres` float DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_capacitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `combustibles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` varchar(20) NOT NULL,
  `tipo_combustible` varchar(50) NOT NULL,
  `litros_combustible_mes` float NOT NULL,
  `litros_combustible_anio` float NOT NULL,
  `costos` float NOT NULL,
  `factores_emision` float NOT NULL,
  `co2_generado` float NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO combustibles VALUES('1','2023-12','gas','20','24','23','23','123','2025-11-10 21:35:01');
INSERT INTO combustibles VALUES('2','2024-12','gas lp','32','23','33','33','33','2025-11-10 21:44:36');
INSERT INTO combustibles VALUES('3','2025-06','8','8','8','8','8','8','2025-11-10 23:05:37');


CREATE TABLE `comunidad` (
  `id_comunidad` int(11) NOT NULL AUTO_INCREMENT,
  `año` int(11) NOT NULL,
  `mes_1` varchar(100) DEFAULT NULL,
  `mes_2` varchar(100) DEFAULT NULL,
  `mes_3` varchar(100) DEFAULT NULL,
  `admvo_1` float DEFAULT NULL,
  `admvo_2` float DEFAULT NULL,
  `admvo_3` float DEFAULT NULL,
  `ptc_1` float DEFAULT NULL,
  `ptc_2` float DEFAULT NULL,
  `ptc_3` float DEFAULT NULL,
  `honorarios_1` float DEFAULT NULL,
  `honorarios_2` float DEFAULT NULL,
  `honorarios_3` float DEFAULT NULL,
  `pa_1` float DEFAULT NULL,
  `pa_2` float DEFAULT NULL,
  `pa_3` float DEFAULT NULL,
  `jardin_1` float DEFAULT NULL,
  `jardin_2` float DEFAULT NULL,
  `jardin_3` float DEFAULT NULL,
  `limpieza_1` float DEFAULT NULL,
  `limpieza_2` float DEFAULT NULL,
  `limpieza_3` float DEFAULT NULL,
  `mantto_1` float DEFAULT NULL,
  `mantto_2` float DEFAULT NULL,
  `mantto_3` float DEFAULT NULL,
  `vigilancia_1` float DEFAULT NULL,
  `vigilancia_2` float DEFAULT NULL,
  `vigilancia_3` float DEFAULT NULL,
  `licenciatura_1` float DEFAULT NULL,
  `licenciatura_2` float DEFAULT NULL,
  `licenciatura_3` float DEFAULT NULL,
  `posgrado_1` float DEFAULT NULL,
  `posgrado_2` float DEFAULT NULL,
  `posgrado_3` float DEFAULT NULL,
  `total_personal_1` float DEFAULT NULL,
  `total_personal_2` float DEFAULT NULL,
  `total_personal_3` float DEFAULT NULL,
  `promedio` float DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_comunidad`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO comunidad VALUES('1','2024','mayo','mayo','mayo','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','0','0','','','2025-11-07 23:12:30');
INSERT INTO comunidad VALUES('2','2023','mayo','mayo','mayo','2','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','','','','','2025-11-07 23:14:55');
INSERT INTO comunidad VALUES('6','2023','mayo','febrero','junio','1','1','12','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','10','10','21','13.6667','2025-11-08 01:49:12');


CREATE TABLE `consumo_agua` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` date NOT NULL,
  `metros_cubicos` float DEFAULT NULL,
  `costo` float DEFAULT NULL,
  `cuatrimestral` float DEFAULT NULL,
  `percapita` float DEFAULT NULL,
  `consumo_agua_riego` float DEFAULT NULL,
  `total_metros_cubicos` float DEFAULT NULL,
  `total_costo` float DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_consumo_registro` (`mes`),
  CONSTRAINT `fk_consumo_registro` FOREIGN KEY (`mes`) REFERENCES `registro_agua` (`periodo_mensual`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO consumo_agua VALUES('43','2020-12-12','1','1','','1','0','','','2025-11-10 09:04:07');
INSERT INTO consumo_agua VALUES('48','2021-12-12','2','2','','1','0','','','2025-11-10 09:43:17');
INSERT INTO consumo_agua VALUES('49','2022-12-12','5','5','','5','2','','','2025-11-10 09:43:57');
INSERT INTO consumo_agua VALUES('50','2023-12-12','3','3','11','3','0','','','2025-11-10 09:45:22');
INSERT INTO consumo_agua VALUES('51','2024-12-12','0','0','','0','0','','','2025-11-10 10:08:45');
INSERT INTO consumo_agua VALUES('52','2025-12-12','0','0','','0','0','','','2025-11-10 10:09:09');
INSERT INTO consumo_agua VALUES('53','2026-12-12','0','0','','0','0','','','2025-11-10 10:09:23');
INSERT INTO consumo_agua VALUES('54','2027-12-12','0','0','0','0','0','','','2025-11-10 10:09:36');
INSERT INTO consumo_agua VALUES('55','2028-12-12','0','0','','0','0','','','2025-11-10 10:09:55');
INSERT INTO consumo_agua VALUES('56','2029-12-12','0','0','','0','0','','','2025-11-10 10:10:37');
INSERT INTO consumo_agua VALUES('58','2030-12-12','0','0','','0','0','','','2025-11-10 10:12:17');


CREATE TABLE `electricidad` (
  `id_elec` int(11) NOT NULL AUTO_INCREMENT,
  `mes_elec` date DEFAULT NULL,
  `cons_kw_mes_elec` decimal(10,2) DEFAULT NULL,
  `costo_elec` decimal(10,2) DEFAULT NULL,
  `cons_percap_elec` decimal(10,2) DEFAULT NULL,
  `ener_sud1_elec` decimal(10,2) DEFAULT NULL,
  `ener_sl172_elec` decimal(10,2) DEFAULT NULL,
  `ener_scid_elec` decimal(10,2) DEFAULT NULL,
  `created_elec` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_elec`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO electricidad VALUES('2','2222-12-12','1200.00','23.00','222.00','222.00','222.00','90.00','2025-11-06 05:25:41');


CREATE TABLE `programacioncapacitacion` (
  `id_programacion` int(11) NOT NULL AUTO_INCREMENT,
  `año` int(11) NOT NULL,
  `fecha_capacitacion` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `tema` varchar(500) NOT NULL,
  `estado` enum('programada','realizada','cancelada') DEFAULT 'programada',
  `observaciones` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_programacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `registro_agua` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_mensual` date NOT NULL,
  `metros_cubicos_descargados` float DEFAULT NULL,
  `dbo_mg_l` float DEFAULT NULL,
  `sst_mg_l` float DEFAULT NULL,
  `nt_mg_l` float DEFAULT NULL,
  `percapita` float DEFAULT NULL,
  `total_cuatri` float DEFAULT NULL,
  `total_metros_cubicos_descargados` float DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `periodo_mensual` (`periodo_mensual`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO registro_agua VALUES('41','2020-12-12','11','11','200','11','11','','','2025-11-10 09:04:07');
INSERT INTO registro_agua VALUES('43','2021-12-12','2','2','2','2','2','','','2025-11-10 09:43:17');
INSERT INTO registro_agua VALUES('44','2022-12-12','3','3','3','3','3','20','','2025-11-10 09:43:57');
INSERT INTO registro_agua VALUES('45','2023-12-12','4','4','4','4','4','20','','2025-11-10 09:45:22');
INSERT INTO registro_agua VALUES('46','2024-12-12','12','12','12','12','12','','','2025-11-10 10:08:45');
INSERT INTO registro_agua VALUES('47','2025-12-12','12','12','12','12','12','','','2025-11-10 10:09:09');
INSERT INTO registro_agua VALUES('48','2026-12-12','1','1','1','1','1','29','','2025-11-10 10:09:23');
INSERT INTO registro_agua VALUES('49','2027-12-12','5','5','5','5','5','30','','2025-11-10 10:09:36');
INSERT INTO registro_agua VALUES('50','2028-12-12','12','12','12','12','12','','','2025-11-10 10:09:55');
INSERT INTO registro_agua VALUES('51','2029-12-12','2','2','2','2','2','','','2025-11-10 10:10:37');
INSERT INTO registro_agua VALUES('53','2030-12-12','4','4','4','4','4','','','2025-11-10 10:12:17');


CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO rol VALUES('1','Administrador','Acceso total al sistema, incluida la gestión de usuarios y reportes.');
INSERT INTO rol VALUES('2','Personal','Acceso a la gestión de registros y generación/descarga de reportes.');
INSERT INTO rol VALUES('3','Invitado','Solo puede visualizar y descargar reportes generados dentro del sitio.');


CREATE TABLE `rsu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` date NOT NULL,
  `papel_kg` float DEFAULT 0,
  `periodico_kg` float DEFAULT 0,
  `toalla_manos_kg` float DEFAULT 0,
  `carton_kg` float DEFAULT 0,
  `pet_kg` float DEFAULT 0,
  `otros_plasticos_kg` float DEFAULT 0,
  `vidrio_kg` float DEFAULT 0,
  `aluminio_kg` float DEFAULT 0,
  `hojalata_kg` float DEFAULT 0,
  `fierro_kg` float DEFAULT 0,
  `total_registro` float DEFAULT 0,
  `total_cuatrimestre` float DEFAULT 0,
  `kg_co2_persona_cuatrimestre` float DEFAULT 0,
  `tn_cuatrimestre` float DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO rsu VALUES('6','0000-00-00','2','1','1','1','1','1','1','1','1','1','11','0','0','0','2025-11-11 21:20:53');
INSERT INTO rsu VALUES('8','2023-12-12','6','6','6','6','6','6','6','6','6','6','60','0','0','0','2025-11-11 22:10:47');
INSERT INTO rsu VALUES('9','2024-12-12','8','8','8','8','8','8','8','8','8','8','80','0','0','0','2025-11-11 22:12:28');
INSERT INTO rsu VALUES('10','2025-12-12','4','4','4','4','4','4','4','4','4','4','40','0','0','0','2025-11-11 22:19:20');
INSERT INTO rsu VALUES('11','2026-02-12','23','23','23','33','33','33','33','33','3','3','240','40','16','0.04','2025-11-11 22:20:01');


CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `ApellidoPaterno` varchar(50) NOT NULL,
  `ApellidoMaterno` varchar(50) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Correo` varchar(100) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `Cargo` varchar(100) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `CreadoPor` int(11) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `idRol` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `Correo` (`Correo`),
  KEY `idRol` (`idRol`),
  KEY `fk_usuario_CreadoPor` (`CreadoPor`),
  CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`),
  CONSTRAINT `fk_usuario_CreadoPor` FOREIGN KEY (`CreadoPor`) REFERENCES `usuario` (`idUsuario`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuario VALUES('1','Joel','Bailòn','Guzman','7774584597','BGJO231014@UPEMOR.EDU.MX','BGJO231014','Administrador','2025-11-11 15:34:29','','Activo','1');
INSERT INTO usuario VALUES('4','adrian','sanchez','vazquez','77760058','svao230653@upemor.edu.mx','1234','','2025-11-17 13:41:54','1','Activo','2');
