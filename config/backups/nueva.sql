SET FOREIGN_KEY_CHECKS=0;


SET FOREIGN_KEY_CHECKS=1;


DROP TABLE IF EXISTS `capacitacion`;
CREATE TABLE `capacitacion` (
  `id_capacitacion` int(11) NOT NULL AUTO_INCREMENT,
  `año` int(11) NOT NULL,
  `mes` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `admvos` int(11) DEFAULT 0,
  `ptcs` int(11) DEFAULT 0,
  `honorarios` int(11) DEFAULT 0,
  `pa` int(11) DEFAULT 0,
  `docentes` int(11) DEFAULT 0,
  `jardineros` int(11) DEFAULT 0,
  `servicio_limpieza` int(11) DEFAULT 0,
  `seguridad` int(11) DEFAULT 0,
  `visitantes` int(11) DEFAULT 0,
  `personas_externas_capacitadas` int(11) DEFAULT 0,
  `cantidad_total_capa` float DEFAULT 0,
  `total_empirico` float DEFAULT 0,
  `calculo_total_verdadero` float DEFAULT 0,
  `total_verdadero_final` float DEFAULT 0,
  `cantidad_hombres` int(11) DEFAULT 0,
  `cantidad_mujeres` int(11) DEFAULT 0,
  `porcentaje_hombres` float DEFAULT 0,
  `porcentaje_mujeres` float DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_capacitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`docentes`,`jardineros`,`servicio_limpieza`,`seguridad`,`visitantes`,`personas_externas_capacitadas`,`cantidad_total_capa`,`total_empirico`,`calculo_total_verdadero`,`total_verdadero_final`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('11','2025','Enero','Capacitación ambiental mensual','10','8','5','4','20','3','6','5','12','15','88','88','88','88','40','48','45.45','54.55','2026-05-17 13:34:11');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`docentes`,`jardineros`,`servicio_limpieza`,`seguridad`,`visitantes`,`personas_externas_capacitadas`,`cantidad_total_capa`,`total_empirico`,`calculo_total_verdadero`,`total_verdadero_final`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('12','2025','Febrero','Capacitación ambiental mensual','12','9','6','5','22','4','7','6','14','18','103','103','103','103','48','55','46.6','53.4','2026-05-17 13:34:11');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`docentes`,`jardineros`,`servicio_limpieza`,`seguridad`,`visitantes`,`personas_externas_capacitadas`,`cantidad_total_capa`,`total_empirico`,`calculo_total_verdadero`,`total_verdadero_final`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('13','2025','Marzo','Capacitación ambiental mensual','11','10','7','4','24','4','8','6','16','20','110','110','110','110','52','58','47.27','52.73','2026-05-17 13:34:11');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`docentes`,`jardineros`,`servicio_limpieza`,`seguridad`,`visitantes`,`personas_externas_capacitadas`,`cantidad_total_capa`,`total_empirico`,`calculo_total_verdadero`,`total_verdadero_final`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('14','2025','Abril','Capacitación ambiental mensual','13','2','8','6','26','5','9','7','18','22','116','116','116','116','60','65','48','52','2026-05-17 13:34:11');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`docentes`,`jardineros`,`servicio_limpieza`,`seguridad`,`visitantes`,`personas_externas_capacitadas`,`cantidad_total_capa`,`total_empirico`,`calculo_total_verdadero`,`total_verdadero_final`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('15','2025','Mayo','Capacitación ambiental mensual','14','12','9','6','28','5','10','7','20','24','135','135','135','135','65','70','48.15','51.85','2026-05-17 14:03:31');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`docentes`,`jardineros`,`servicio_limpieza`,`seguridad`,`visitantes`,`personas_externas_capacitadas`,`cantidad_total_capa`,`total_empirico`,`calculo_total_verdadero`,`total_verdadero_final`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('16','2025','Junio','Capacitación ambiental mensual','15','12','10','7','30','6','10','8','22','25','145','145','145','145','70','75','48.28','51.72','2026-05-17 14:03:31');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`docentes`,`jardineros`,`servicio_limpieza`,`seguridad`,`visitantes`,`personas_externas_capacitadas`,`cantidad_total_capa`,`total_empirico`,`calculo_total_verdadero`,`total_verdadero_final`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('17','2025','Julio','Capacitación ambiental mensual','16','13','10','7','32','6','11','8','24','27','154','154','154','154','74','80','48.05','51.95','2026-05-17 14:03:31');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`docentes`,`jardineros`,`servicio_limpieza`,`seguridad`,`visitantes`,`personas_externas_capacitadas`,`cantidad_total_capa`,`total_empirico`,`calculo_total_verdadero`,`total_verdadero_final`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('18','2025','Agosto','Capacitacióhtrsrs','17','14','3','8','34','7','12','9','26','30','160','160','160','160','80','88','47.619','52.381','2026-05-17 14:03:31');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`docentes`,`jardineros`,`servicio_limpieza`,`seguridad`,`visitantes`,`personas_externas_capacitadas`,`cantidad_total_capa`,`total_empirico`,`calculo_total_verdadero`,`total_verdadero_final`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('19','2025','septiembre','wwwwwwwwww','1','1','1','1','1','1','1','1','1','1','10','10','10','10','9','1','90','10','2026-05-17 14:27:43');


DROP TABLE IF EXISTS `combustibles`;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('1','2019-01','Gasolina','1200','15000','22000','2.31','2772','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('2','2019-02','Gas LP','800','9600','14500','1.51','1208','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('3','2019-03','Diésel','950','11400','17800','2.68','2546','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('4','2020-01','Gasolina','1300','15500','23000','2.31','3003','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('5','2020-03','Gas LP','820','9800','15000','1.51','1238','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('6','2020-04','Diésel','1000','12000','18500','2.68','2680','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('7','2021-02','Gasolina','1400','16000','25000','2.31','3234','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('8','2021-05','Gas LP','900','10800','16200','1.51','1359','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('9','2021-06','Diésel','1100','12500','20000','2.68','2948','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('10','2022-01','Gasolina','1500','17000','27000','2.31','3465','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('11','2022-02','Gas LP','950','11500','17000','1.51','1434','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('12','2022-03','Diésel','1200','14500','22000','2.68','3216','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('13','2023-02','Gasolina','1600','18000','29000','2.31','3696','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('14','2023-04','Gas LP','980','12000','18000','1.51','1479','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('15','2023-06','Diésel','1300','15800','24000','2.68','3484','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('16','2024-03','Gasolina','1700','19000','31000','2.31','3927','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('17','2024-05','Gas LP','1000','12500','18500','1.51','1510','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('18','2024-06','Diésel','1400','16500','26000','2.68','3752','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('19','2025-01','Gasolina','1800','20000','33000','2.31','4158','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('20','2025-02','Gas LP','1050','13000','19000','1.51','1585','2025-11-25 17:47:49');
INSERT INTO `combustibles` (`id`,`mes`,`tipo_combustible`,`litros_combustible_mes`,`litros_combustible_anio`,`costos`,`factores_emision`,`co2_generado`,`fecha_registro`) VALUES('21','2025-03','Diésel','1500','17000','28000','2.68','4020','2025-11-25 17:47:49');


DROP TABLE IF EXISTS `comunidad`;
CREATE TABLE `comunidad` (
  `id_comunidad` int(11) NOT NULL AUTO_INCREMENT,
  `año` int(11) NOT NULL,
  `mes` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `admvos` float DEFAULT 0,
  `ptcs` float DEFAULT 0,
  `honorarios` float DEFAULT 0,
  `pa` float DEFAULT 0,
  `jardineros` float DEFAULT 0,
  `limpieza` float DEFAULT 0,
  `maestros` float DEFAULT 0,
  `vigilancias` float DEFAULT 0,
  `licenciaturas` float DEFAULT 0,
  `posgrados` float DEFAULT 0,
  `total_personal` float DEFAULT 0,
  `promedio` float DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_comunidad`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`jardineros`,`limpieza`,`maestros`,`vigilancias`,`licenciaturas`,`posgrados`,`total_personal`,`promedio`,`fecha_creacion`) VALUES('7','2025','Enero','Registro mensual de comunidad universitaria','21','18','14','10','5','6','4','7','120','15','220','22','2026-05-17 12:43:27');
INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`jardineros`,`limpieza`,`maestros`,`vigilancias`,`licenciaturas`,`posgrados`,`total_personal`,`promedio`,`fecha_creacion`) VALUES('8','2025','Febrero','Registro mensual de comunidad universitaria','22','19','15','10','5','6','4','7','125','16','229','22.9','2026-05-17 12:43:27');
INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`jardineros`,`limpieza`,`maestros`,`vigilancias`,`licenciaturas`,`posgrados`,`total_personal`,`promedio`,`fecha_creacion`) VALUES('9','2025','Marzo','Registro mensual de comunidad universitaria','21','20','15','11','5','6','4','7','130','17','236','23.6','2026-05-17 12:43:27');
INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`jardineros`,`limpieza`,`maestros`,`vigilancias`,`licenciaturas`,`posgrados`,`total_personal`,`promedio`,`fecha_creacion`) VALUES('10','2025','abril','adminstracion','12','12','12','12','12','12','12','12','12','12','120','12','2026-05-17 13:15:48');
INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes`,`descripcion`,`admvos`,`ptcs`,`honorarios`,`pa`,`jardineros`,`limpieza`,`maestros`,`vigilancias`,`licenciaturas`,`posgrados`,`total_personal`,`promedio`,`fecha_creacion`) VALUES('11','2025','julio','adminstrativo','12','12','12','12','12','12','12','12','12','12','120','12','2026-05-17 13:16:49');


DROP TABLE IF EXISTS `consumo_agua`;
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
  KEY `fk_consumo_registro` (`mes`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('1','2020-12-12','120','800','300','1.2','50','170','850','2025-11-25 17:47:49');
INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('2','2021-12-12','130','900','320','1.3','55','185','955','2025-11-25 17:47:49');
INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('3','2022-12-12','140','1000','340','1.35','60','200','1060','2025-11-25 17:47:49');
INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('4','2023-12-12','155','1100','360','1.4','70','225','1170','2025-11-25 17:47:49');
INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('5','2024-12-12','170','1200','380','1.5','80','250','1280','2025-11-25 17:47:49');
INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('6','2025-12-12','185','1300','400','1.55','90','275','1390','2025-11-25 17:47:49');


DROP TABLE IF EXISTS `electricidad`;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `electricidad` (`id_elec`,`mes_elec`,`cons_kw_mes_elec`,`costo_elec`,`cons_percap_elec`,`ener_sud1_elec`,`ener_sl172_elec`,`ener_scid_elec`,`created_elec`) VALUES('1','2020-01-01','2500.00','5400.00','5.20','300.00','200.00','150.00','2025-11-25 17:47:49');
INSERT INTO `electricidad` (`id_elec`,`mes_elec`,`cons_kw_mes_elec`,`costo_elec`,`cons_percap_elec`,`ener_sud1_elec`,`ener_sl172_elec`,`ener_scid_elec`,`created_elec`) VALUES('2','2021-01-01','2600.00','5800.00','5.30','310.00','210.00','160.00','2025-11-25 17:47:49');
INSERT INTO `electricidad` (`id_elec`,`mes_elec`,`cons_kw_mes_elec`,`costo_elec`,`cons_percap_elec`,`ener_sud1_elec`,`ener_sl172_elec`,`ener_scid_elec`,`created_elec`) VALUES('3','2022-01-01','2800.00','6200.00','5.40','320.00','220.00','170.00','2025-11-25 17:47:49');
INSERT INTO `electricidad` (`id_elec`,`mes_elec`,`cons_kw_mes_elec`,`costo_elec`,`cons_percap_elec`,`ener_sud1_elec`,`ener_sl172_elec`,`ener_scid_elec`,`created_elec`) VALUES('4','2023-01-01','3000.00','6500.00','5.60','330.00','230.00','180.00','2025-11-25 17:47:49');
INSERT INTO `electricidad` (`id_elec`,`mes_elec`,`cons_kw_mes_elec`,`costo_elec`,`cons_percap_elec`,`ener_sud1_elec`,`ener_sl172_elec`,`ener_scid_elec`,`created_elec`) VALUES('5','2024-01-01','3200.00','7000.00','5.80','340.00','240.00','190.00','2025-11-25 17:47:49');
INSERT INTO `electricidad` (`id_elec`,`mes_elec`,`cons_kw_mes_elec`,`costo_elec`,`cons_percap_elec`,`ener_sud1_elec`,`ener_sl172_elec`,`ener_scid_elec`,`created_elec`) VALUES('6','2025-01-01','3400.00','7400.00','6.00','350.00','250.00','200.00','2025-11-25 17:47:49');


DROP TABLE IF EXISTS `registro_agua`;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('1','2020-12-12','11','11','200','11','11',NULL,NULL,'2025-11-25 17:47:49');
INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('2','2021-12-12','2','2','2','2','2',NULL,NULL,'2025-11-25 17:47:49');
INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('3','2022-12-12','3','3','3','3','3','20',NULL,'2025-11-25 17:47:49');
INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('4','2023-12-12','4','4','4','4','4','20',NULL,'2025-11-25 17:47:49');
INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('5','2024-12-12','12','12','12','12','12',NULL,NULL,'2025-11-25 17:47:49');
INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('6','2025-12-12','12','12','12','12','12',NULL,NULL,'2025-11-25 17:47:49');
INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('7','2026-12-12','1','1','1','1','1','29',NULL,'2025-11-25 17:47:49');
INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('8','2027-12-12','5','5','5','5','5','30',NULL,'2025-11-25 17:47:49');
INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('9','2028-12-12','12','12','12','12','12',NULL,NULL,'2025-11-25 17:47:49');
INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('10','2029-12-12','2','2','2','2','2',NULL,NULL,'2025-11-25 17:47:49');
INSERT INTO `registro_agua` (`id`,`periodo_mensual`,`metros_cubicos_descargados`,`dbo_mg_l`,`sst_mg_l`,`nt_mg_l`,`percapita`,`total_cuatri`,`total_metros_cubicos_descargados`,`fecha_creacion`) VALUES('11','2030-12-12','4','4','4','4','4',NULL,NULL,'2025-11-25 17:47:49');


DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rol` (`idRol`,`Nombre`,`Descripcion`) VALUES('1','Administrador','Acceso total al sistema, incluida la gestión de usuarios y reportes.');
INSERT INTO `rol` (`idRol`,`Nombre`,`Descripcion`) VALUES('2','Personal','Acceso a la gestión de registros y generación/descarga de reportes.');
INSERT INTO `rol` (`idRol`,`Nombre`,`Descripcion`) VALUES('3','Invitado','Solo puede visualizar y descargar reportes generados dentro del sitio.');


DROP TABLE IF EXISTS `rsu`;
CREATE TABLE `rsu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` date NOT NULL,
  `basura_kg` float DEFAULT 0,
  `basura_organica_kg` float DEFAULT 0,
  `papel_kg` float DEFAULT 0,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rsu` (`id`,`mes`,`basura_kg`,`basura_organica_kg`,`papel_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('1','2019-01-01','5','4','10','8','6','3','7','2','1','0','46','120','12','0.12','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`basura_kg`,`basura_organica_kg`,`papel_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('2','2020-01-01','6','5','12','9','7','4','8','3','1','0','55','130','14','0.14','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`basura_kg`,`basura_organica_kg`,`papel_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('3','2021-01-01','7','6','14','11','8','5','9','3','2','1','66','140','15','0.15','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`basura_kg`,`basura_organica_kg`,`papel_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('4','2022-01-01','8','6','16','12','9','6','10','4','2','1','74','150','18','0.18','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`basura_kg`,`basura_organica_kg`,`papel_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('5','2023-01-01','9','7','18','14','10','7','11','4','3','1','84','160','20','0.2','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`basura_kg`,`basura_organica_kg`,`papel_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('6','2024-01-01','10','8','20','15','11','8','12','5','3','1','93','170','22','0.22','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`basura_kg`,`basura_organica_kg`,`papel_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('7','2025-01-01','11','9','22','17','13','9','14','5','4','2','106','180','25','0.25','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`basura_kg`,`basura_organica_kg`,`papel_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('8','2026-05-17','12','12','12','12','12','12','12','0','0','0','84','0','0','0.084','2026-05-17 12:25:31');


DROP TABLE IF EXISTS `usuario`;
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
  KEY `fk_usuario_CreadoPor` (`CreadoPor`) NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuario` (`idUsuario`,`Nombre`,`ApellidoPaterno`,`ApellidoMaterno`,`Telefono`,`Correo`,`Pass`,`Cargo`,`FechaRegistro`,`CreadoPor`,`Estado`,`idRol`) VALUES('1','Joel','Bailòn','Guzman','7774584597','BGJO231014@UPEMOR.EDU.MX','BGJO231014','Administrador','2025-11-11 15:34:29',NULL,'Activo','1');
INSERT INTO `usuario` (`idUsuario`,`Nombre`,`ApellidoPaterno`,`ApellidoMaterno`,`Telefono`,`Correo`,`Pass`,`Cargo`,`FechaRegistro`,`CreadoPor`,`Estado`,`idRol`) VALUES('2','Adrina','vazquez','sanchez','7776005899','svao230653@upemor.edu.mx','adrian777','CECAM','2026-05-13 21:42:42','1','Activo','2');
