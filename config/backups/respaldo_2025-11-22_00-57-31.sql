

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO capacitacion VALUES('16','2027','mayo','julio','junio','6','6','6','6','6','6','6','6','6','6','6','6','6','6','6','6','6','6','6','6','6','6','6','6','48','48','48','144','48','48','48','144','6','6','4.17','4.17','2025-11-18 12:09:17');
INSERT INTO capacitacion VALUES('17','2024','Enero','Febrero','Marzo','5','4','6','3','4','5','2','3','2','4','4','5','6','5','7','30','28','32','12','11','14','3','2','4','0','0','0','0','0','0','0','0','0','0','0','0','2025-11-18 12:18:09');
INSERT INTO capacitacion VALUES('18','2024','Abril','Mayo','Junio','6','5','6','4','4','5','3','2','2','5','5','6','7','6','8','35','33','40','15','13','17','2','3','3','0','0','0','0','0','0','0','0','0','0','0','0','2025-11-18 12:18:09');
INSERT INTO capacitacion VALUES('19','2025','mayo','febrero','julio','1','1','1','23','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','30','8','8','46','30','8','8','46','1','1','2.17','2.17','2025-11-20 21:54:05');


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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO combustibles VALUES('1','2023-12','gas','20','24','23','23','123','2025-11-10 21:35:01');
INSERT INTO combustibles VALUES('2','2024-12','gas lp','32','23','33','33','33','2025-11-10 21:44:36');
INSERT INTO combustibles VALUES('3','2025-06','gas  flamable','8','8','8','8','8','2025-11-10 23:05:37');
INSERT INTO combustibles VALUES('4','2019-01','Gasolina','1200','15000','22000','2.31','2772','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('5','2019-02','Gas LP','800','9600','14500','1.51','1208','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('6','2019-03','Diésel','950','11400','17800','2.68','2546','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('7','2020-01','Gasolina','1300','15500','23000','2.31','3003','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('8','2020-03','Gas LP','820','9800','15000','1.51','1238','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('9','2020-04','Diésel','1000','12000','18500','2.68','2680','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('10','2021-02','Gasolina','1400','16000','25000','2.31','3234','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('11','2021-05','Gas LP','900','10800','16200','1.51','1359','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('12','2021-06','Diésel','1100','12500','20000','2.68','2948','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('13','2022-01','Gasolina','1500','17000','27000','2.31','3465','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('14','2022-02','Gas LP','950','11500','17000','1.51','1434','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('15','2022-03','Diésel','1200','14500','22000','2.68','3216','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('16','2023-02','Gasolina','1600','18000','29000','2.31','3696','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('17','2023-04','Gas LP','980','12000','18000','1.51','1479','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('18','2023-06','Diésel','1300','15800','24000','2.68','3484','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('19','2024-03','Gasolina','1700','19000','31000','2.31','3927','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('20','2024-05','Gas LP','1000','12500','18500','1.51','1510','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('21','2024-06','Diésel','1400','16500','26000','2.68','3752','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('22','2025-01','Gasolina','1800','20000','33000','2.31','4158','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('23','2025-02','Gas LP','1050','13000','19000','1.51','1585','2025-11-18 12:17:14');
INSERT INTO combustibles VALUES('24','2025-03','Diésel','1500','17000','28000','2.68','4020','2025-11-18 12:17:14');


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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO comunidad VALUES('1','2024','mayo','mayo','mayo','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','0','0','0','0','2025-11-07 23:12:30');
INSERT INTO comunidad VALUES('2','2023','mayo','mayo','mayo','2','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','0','0','0','2025-11-07 23:14:55');
INSERT INTO comunidad VALUES('6','2023','mayo','febrero','junio','1','1','12','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','10','10','21','13.6667','2025-11-08 01:49:12');
INSERT INTO comunidad VALUES('7','2020','Enero','Febrero','Marzo','10','12','11','8','9','10','6','7','8','5','5','6','3','3','4','4','4','5','2','2','3','3','3','4','100','110','105','20','22','21','110','116','115','113.66','2025-11-18 12:17:14');
INSERT INTO comunidad VALUES('8','2021','Enero','Febrero','Marzo','12','13','12','9','10','12','7','8','9','6','6','7','4','4','5','5','5','6','3','3','4','3','3','4','120','122','125','25','26','28','130','132','135','132.33','2025-11-18 12:17:14');
INSERT INTO comunidad VALUES('9','2022','Enero','Febrero','Marzo','15','16','15','12','11','14','9','10','11','7','7','8','5','5','6','6','6','7','4','4','5','4','4','5','140','143','145','30','32','33','150','155','160','155','2025-11-18 12:17:14');
INSERT INTO comunidad VALUES('10','2023','Enero','Febrero','Marzo','17','18','17','14','15','16','11','12','13','8','8','9','6','6','7','7','7','8','5','5','6','5','5','6','150','155','158','35','36','38','165','170','175','169.99','2025-11-18 12:17:14');
INSERT INTO comunidad VALUES('11','2024','Enero','Febrero','Marzo','19','20','19','16','17','18','12','13','14','9','9','10','7','7','8','8','8','9','6','6','7','6','6','7','170','175','178','40','41','43','190','200','210','200.33','2025-11-18 12:17:14');
INSERT INTO comunidad VALUES('12','2025','Enero','Febrero','Marzo','21','22','21','18','19','20','14','15','15','10','10','11','8','8','9','9','9','10','7','7','8','6','6','7','185','190','195','45','48','50','210','230','240','226.66','2025-11-18 12:17:14');


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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO consumo_agua VALUES('43','2020-12-12','1','1','0','1','0','0','0','2025-11-10 09:04:07');
INSERT INTO consumo_agua VALUES('48','2021-12-12','2','2','0','1','0','0','0','2025-11-10 09:43:17');
INSERT INTO consumo_agua VALUES('49','2022-12-12','5','5','0','5','2','0','0','2025-11-10 09:43:57');
INSERT INTO consumo_agua VALUES('50','2023-12-12','3','3','11','3','0','0','0','2025-11-10 09:45:22');
INSERT INTO consumo_agua VALUES('51','2024-12-12','0','0','0','0','0','0','0','2025-11-10 10:08:45');
INSERT INTO consumo_agua VALUES('52','2025-12-12','0','0','0','0','0','0','0','2025-11-10 10:09:09');
INSERT INTO consumo_agua VALUES('53','2026-12-12','0','0','0','0','0','0','0','2025-11-10 10:09:23');
INSERT INTO consumo_agua VALUES('54','2027-12-12','0','0','0','0','0','0','0','2025-11-10 10:09:36');
INSERT INTO consumo_agua VALUES('55','2028-12-12','0','0','0','0','0','0','0','2025-11-10 10:09:55');
INSERT INTO consumo_agua VALUES('56','2029-12-12','0','0','0','0','0','0','0','2025-11-10 10:10:37');
INSERT INTO consumo_agua VALUES('58','2030-12-12','0','0','0','0','0','0','0','2025-11-10 10:12:17');
INSERT INTO consumo_agua VALUES('68','2024-01-01','120.5','350.75','480','15.4','60.2','180.7','410.95','2025-11-18 12:18:37');
INSERT INTO consumo_agua VALUES('69','2024-02-01','140.3','390.1','520','17.2','65.1','205.4','455.2','2025-11-18 12:18:37');
INSERT INTO consumo_agua VALUES('70','2024-03-01','135.9','370.8','510','16.8','62.5','198.4','437.6','2025-11-18 12:18:37');
INSERT INTO consumo_agua VALUES('71','2024-04-01','150.2','410.9','560','18.1','70','220.2','480','2025-11-18 12:18:37');


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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO electricidad VALUES('2','2222-12-12','1200.00','23.00','222.00','222.00','222.00','90.00','2025-11-06 05:25:41');
INSERT INTO electricidad VALUES('5','2020-01-01','2500.00','5400.00','5.20','300.00','200.00','150.00','2025-11-18 12:19:45');
INSERT INTO electricidad VALUES('6','2021-01-01','2600.00','5800.00','5.30','310.00','210.00','160.00','2025-11-18 12:19:45');
INSERT INTO electricidad VALUES('7','2022-01-01','2800.00','6200.00','5.40','320.00','220.00','170.00','2025-11-18 12:19:45');
INSERT INTO electricidad VALUES('8','2023-01-01','3000.00','6500.00','5.60','330.00','230.00','180.00','2025-11-18 12:19:45');
INSERT INTO electricidad VALUES('9','2024-01-01','3200.00','7000.00','5.80','340.00','240.00','190.00','2025-11-18 12:19:45');
INSERT INTO electricidad VALUES('10','2025-01-01','3400.00','7400.00','6.00','350.00','250.00','200.00','2025-11-18 12:19:45');


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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO registro_agua VALUES('41','2020-12-12','11','11','200','11','11','11','11','2025-11-10 09:04:07');
INSERT INTO registro_agua VALUES('43','2021-12-12','2','2','2','2','2','2','2','2025-11-10 09:43:17');
INSERT INTO registro_agua VALUES('44','2022-12-12','3','3','3','3','3','3','3','2025-11-10 09:43:57');
INSERT INTO registro_agua VALUES('45','2023-12-12','4','4','4','4','4','4','4','2025-11-10 09:45:22');
INSERT INTO registro_agua VALUES('46','2024-12-12','12','12','12','12','12','12','408.5','2025-11-10 10:08:45');
INSERT INTO registro_agua VALUES('47','2025-12-12','12','12','12','12','12','12','12','2025-11-10 10:09:09');
INSERT INTO registro_agua VALUES('48','2026-12-12','1','1','1','1','1','1','1','2025-11-10 10:09:23');
INSERT INTO registro_agua VALUES('49','2027-12-12','5','5','5','5','5','5','5','2025-11-10 10:09:36');
INSERT INTO registro_agua VALUES('50','2028-12-12','12','12','12','12','12','12','12','2025-11-10 10:09:55');
INSERT INTO registro_agua VALUES('51','2029-12-12','2','2','2','2','2','2','2','2025-11-10 10:10:37');
INSERT INTO registro_agua VALUES('53','2030-12-12','4','4','4','4','4','4','4','2025-11-10 10:12:17');
INSERT INTO registro_agua VALUES('57','2024-01-01','95.4','25.2','18.3','12.5','8.5','396.5','408.5','2025-11-18 12:18:09');
INSERT INTO registro_agua VALUES('58','2024-02-01','100.1','26','19','13','9','396.5','408.5','2025-11-18 12:18:09');
INSERT INTO registro_agua VALUES('59','2024-03-01','98.7','24.8','17.9','12.2','8.7','396.5','408.5','2025-11-18 12:18:09');
INSERT INTO registro_agua VALUES('60','2024-04-01','102.3','27.1','20.5','14','9.3','396.5','408.5','2025-11-18 12:18:09');


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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO rsu VALUES('6','0000-00-00','2','1','1','1','1','1','1','1','1','1','11','0','0','0','2025-11-11 21:20:53');
INSERT INTO rsu VALUES('8','2023-12-12','6','6','6','6','6','6','6','6','6','6','60','0','0','0','2025-11-11 22:10:47');
INSERT INTO rsu VALUES('9','2024-12-12','8','8','8','8','8','8','8','8','8','8','80','0','0','0','2025-11-11 22:12:28');
INSERT INTO rsu VALUES('10','2025-12-12','4','4','4','4','4','4','4','4','4','4','40','0','0','0','2025-11-11 22:19:20');
INSERT INTO rsu VALUES('11','2026-02-12','23','23','23','33','33','33','33','33','3','3','240','40','16','0.04','2025-11-11 22:20:01');
INSERT INTO rsu VALUES('13','2020-01-01','12','6','5','9','7','4','8','3','1','0','55','130','14','0.14','2025-11-18 12:17:14');
INSERT INTO rsu VALUES('14','2021-01-01','14','7','6','11','8','5','9','3','2','1','66','140','15','0.15','2025-11-18 12:17:14');
INSERT INTO rsu VALUES('15','2022-01-01','16','8','6','12','9','6','10','4','2','1','74','150','18','0.18','2025-11-18 12:17:14');
INSERT INTO rsu VALUES('16','2023-01-01','18','9','7','14','10','7','11','4','3','1','84','160','20','0.2','2025-11-18 12:17:14');
INSERT INTO rsu VALUES('17','2024-01-01','20','10','8','15','11','8','12','5','3','1','93','170','22','0.22','2025-11-18 12:17:14');
INSERT INTO rsu VALUES('18','2025-01-01','22','11','9','17','13','9','14','5','4','2','106','180','25','0.25','2025-11-18 12:17:14');
INSERT INTO rsu VALUES('20','2005-02-01','23','12','2','10','2','1','0','1','1','10','62','0','0','0.062','2025-11-18 13:06:53');


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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuario VALUES('1','Joel','Bailòn','Guzman','7774584597','BGJO231014@UPEMOR.EDU.MX','BGJO231014','Administrador','2025-11-11 15:34:29','','Activo','1');
INSERT INTO usuario VALUES('12','smonod','sds','swss','7776005899','juan@upemor.edu.mx','123','','2025-11-20 00:02:53','1','Activo','2');
