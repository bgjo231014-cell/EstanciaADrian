

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo1`,`admvo2`,`admvo3`,`PTC1`,`PTC2`,`PTC3`,`Honorarios1`,`Honorarios2`,`Honorarios3`,`PA1`,`PA2`,`PA3`,`Servicios1`,`Servicios2`,`Servicios3`,`Alumnos1`,`Alumnos2`,`Alumnos3`,`Visitantes1`,`Visitantes2`,`Visitantes3`,`personas_externas_capacitadas1`,`personas_externas_capacitadas2`,`personas_externas_capacitadas3`,`Cantidad_totalCapa1`,`Cantidad_totalCapa2`,`Cantidad_totalCapa3`,`Total_empirico`,`Calculo_total_verdadero1`,`Calculo_total_verdadero2`,`Calculo_total_verdadero3`,`total_verdaderoFinal`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('1','2020','Enero','Febrero','Marzo','7','6','8','5','4','6','3','3','4','5','5','6','7','6','8','25','30','28','10','11','12','2','3','3','50','55','58','163','52','55','58','165','82','81','50','50','2025-11-25 17:47:49');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo1`,`admvo2`,`admvo3`,`PTC1`,`PTC2`,`PTC3`,`Honorarios1`,`Honorarios2`,`Honorarios3`,`PA1`,`PA2`,`PA3`,`Servicios1`,`Servicios2`,`Servicios3`,`Alumnos1`,`Alumnos2`,`Alumnos3`,`Visitantes1`,`Visitantes2`,`Visitantes3`,`personas_externas_capacitadas1`,`personas_externas_capacitadas2`,`personas_externas_capacitadas3`,`Cantidad_totalCapa1`,`Cantidad_totalCapa2`,`Cantidad_totalCapa3`,`Total_empirico`,`Calculo_total_verdadero1`,`Calculo_total_verdadero2`,`Calculo_total_verdadero3`,`total_verdaderoFinal`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('2','2020','Abril','Mayo','Junio','8','7','7','5','6','6','4','4','5','6','5','5','8','8','9','32','29','31','14','12','15','3','2','4','58','55','62','175','60','58','62','180','90','85','51','49','2025-11-25 17:47:49');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo1`,`admvo2`,`admvo3`,`PTC1`,`PTC2`,`PTC3`,`Honorarios1`,`Honorarios2`,`Honorarios3`,`PA1`,`PA2`,`PA3`,`Servicios1`,`Servicios2`,`Servicios3`,`Alumnos1`,`Alumnos2`,`Alumnos3`,`Visitantes1`,`Visitantes2`,`Visitantes3`,`personas_externas_capacitadas1`,`personas_externas_capacitadas2`,`personas_externas_capacitadas3`,`Cantidad_totalCapa1`,`Cantidad_totalCapa2`,`Cantidad_totalCapa3`,`Total_empirico`,`Calculo_total_verdadero1`,`Calculo_total_verdadero2`,`Calculo_total_verdadero3`,`total_verdaderoFinal`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('3','2021','Enero','Febrero','Marzo','9','10','9','7','8','7','4','5','6','6','6','7','10','9','11','35','34','36','16','15','17','4','4','5','64','63','67','194','66','64','67','197','100','95','51','49','2025-11-25 17:47:49');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo1`,`admvo2`,`admvo3`,`PTC1`,`PTC2`,`PTC3`,`Honorarios1`,`Honorarios2`,`Honorarios3`,`PA1`,`PA2`,`PA3`,`Servicios1`,`Servicios2`,`Servicios3`,`Alumnos1`,`Alumnos2`,`Alumnos3`,`Visitantes1`,`Visitantes2`,`Visitantes3`,`personas_externas_capacitadas1`,`personas_externas_capacitadas2`,`personas_externas_capacitadas3`,`Cantidad_totalCapa1`,`Cantidad_totalCapa2`,`Cantidad_totalCapa3`,`Total_empirico`,`Calculo_total_verdadero1`,`Calculo_total_verdadero2`,`Calculo_total_verdadero3`,`total_verdaderoFinal`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('4','2021','Abril','Mayo','Junio','10','9','11','7','7','8','5','6','5','7','8','7','11','10','12','38','40','42','20','18','21','3','4','4','71','74','79','224','72','75','79','226','115','110','51','49','2025-11-25 17:47:49');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo1`,`admvo2`,`admvo3`,`PTC1`,`PTC2`,`PTC3`,`Honorarios1`,`Honorarios2`,`Honorarios3`,`PA1`,`PA2`,`PA3`,`Servicios1`,`Servicios2`,`Servicios3`,`Alumnos1`,`Alumnos2`,`Alumnos3`,`Visitantes1`,`Visitantes2`,`Visitantes3`,`personas_externas_capacitadas1`,`personas_externas_capacitadas2`,`personas_externas_capacitadas3`,`Cantidad_totalCapa1`,`Cantidad_totalCapa2`,`Cantidad_totalCapa3`,`Total_empirico`,`Calculo_total_verdadero1`,`Calculo_total_verdadero2`,`Calculo_total_verdadero3`,`total_verdaderoFinal`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('5','2022','Enero','Febrero','Marzo','12','11','12','9','8','10','6','6','7','8','7','8','13','13','14','45','44','47','22','23','21','4','4','5','78','75','81','234','80','76','82','238','122','116','51','49','2025-11-25 17:47:49');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo1`,`admvo2`,`admvo3`,`PTC1`,`PTC2`,`PTC3`,`Honorarios1`,`Honorarios2`,`Honorarios3`,`PA1`,`PA2`,`PA3`,`Servicios1`,`Servicios2`,`Servicios3`,`Alumnos1`,`Alumnos2`,`Alumnos3`,`Visitantes1`,`Visitantes2`,`Visitantes3`,`personas_externas_capacitadas1`,`personas_externas_capacitadas2`,`personas_externas_capacitadas3`,`Cantidad_totalCapa1`,`Cantidad_totalCapa2`,`Cantidad_totalCapa3`,`Total_empirico`,`Calculo_total_verdadero1`,`Calculo_total_verdadero2`,`Calculo_total_verdadero3`,`total_verdaderoFinal`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('6','2022','Abril','Mayo','Junio','13','12','13','10','11','10','7','7','7','8','9','8','15','14','15','50','48','52','25','26','23','5','5','6','85','82','88','255','87','84','89','260','130','125','51','49','2025-11-25 17:47:49');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo1`,`admvo2`,`admvo3`,`PTC1`,`PTC2`,`PTC3`,`Honorarios1`,`Honorarios2`,`Honorarios3`,`PA1`,`PA2`,`PA3`,`Servicios1`,`Servicios2`,`Servicios3`,`Alumnos1`,`Alumnos2`,`Alumnos3`,`Visitantes1`,`Visitantes2`,`Visitantes3`,`personas_externas_capacitadas1`,`personas_externas_capacitadas2`,`personas_externas_capacitadas3`,`Cantidad_totalCapa1`,`Cantidad_totalCapa2`,`Cantidad_totalCapa3`,`Total_empirico`,`Calculo_total_verdadero1`,`Calculo_total_verdadero2`,`Calculo_total_verdadero3`,`total_verdaderoFinal`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('7','2023','Enero','Febrero','Marzo','14','15','14','11','12','11','8','8','9','9','9','10','16','17','16','55','53','56','28','27','30','6','5','7','93','92','100','285','95','93','102','290','150','143','51','49','2025-11-25 17:47:49');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo1`,`admvo2`,`admvo3`,`PTC1`,`PTC2`,`PTC3`,`Honorarios1`,`Honorarios2`,`Honorarios3`,`PA1`,`PA2`,`PA3`,`Servicios1`,`Servicios2`,`Servicios3`,`Alumnos1`,`Alumnos2`,`Alumnos3`,`Visitantes1`,`Visitantes2`,`Visitantes3`,`personas_externas_capacitadas1`,`personas_externas_capacitadas2`,`personas_externas_capacitadas3`,`Cantidad_totalCapa1`,`Cantidad_totalCapa2`,`Cantidad_totalCapa3`,`Total_empirico`,`Calculo_total_verdadero1`,`Calculo_total_verdadero2`,`Calculo_total_verdadero3`,`total_verdaderoFinal`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('8','2023','Abril','Mayo','Junio','16','15','16','12','13','12','9','9','10','11','10','11','18','17','19','58','57','60','30','32','29','5','6','6','101','100','104','305','102','101','105','308','160','150','52','48','2025-11-25 17:47:49');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo1`,`admvo2`,`admvo3`,`PTC1`,`PTC2`,`PTC3`,`Honorarios1`,`Honorarios2`,`Honorarios3`,`PA1`,`PA2`,`PA3`,`Servicios1`,`Servicios2`,`Servicios3`,`Alumnos1`,`Alumnos2`,`Alumnos3`,`Visitantes1`,`Visitantes2`,`Visitantes3`,`personas_externas_capacitadas1`,`personas_externas_capacitadas2`,`personas_externas_capacitadas3`,`Cantidad_totalCapa1`,`Cantidad_totalCapa2`,`Cantidad_totalCapa3`,`Total_empirico`,`Calculo_total_verdadero1`,`Calculo_total_verdadero2`,`Calculo_total_verdadero3`,`total_verdaderoFinal`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('9','2024','Julio','Agosto','Septiembre','17','16','17','13','12','14','10','9','10','11','12','11','19','20','21','62','61','65','33','35','34','7','8','7','108','112','118','338','110','113','119','342','175','165','51','49','2025-11-25 17:47:49');
INSERT INTO `capacitacion` (`id_capacitacion`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo1`,`admvo2`,`admvo3`,`PTC1`,`PTC2`,`PTC3`,`Honorarios1`,`Honorarios2`,`Honorarios3`,`PA1`,`PA2`,`PA3`,`Servicios1`,`Servicios2`,`Servicios3`,`Alumnos1`,`Alumnos2`,`Alumnos3`,`Visitantes1`,`Visitantes2`,`Visitantes3`,`personas_externas_capacitadas1`,`personas_externas_capacitadas2`,`personas_externas_capacitadas3`,`Cantidad_totalCapa1`,`Cantidad_totalCapa2`,`Cantidad_totalCapa3`,`Total_empirico`,`Calculo_total_verdadero1`,`Calculo_total_verdadero2`,`Calculo_total_verdadero3`,`total_verdaderoFinal`,`cantidad_hombres`,`cantidad_mujeres`,`porcentaje_hombres`,`porcentaje_mujeres`,`fecha_creacion`) VALUES('10','2024','Octubre','Noviembre','Diciembre','18','19','18','14','14','15','11','10','11','13','12','13','22','21','23','70','68','72','36','38','37','8','7','9','126','131','140','397','128','132','141','401','190','185','51','49','2025-11-25 17:47:49');


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

INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo_1`,`admvo_2`,`admvo_3`,`ptc_1`,`ptc_2`,`ptc_3`,`honorarios_1`,`honorarios_2`,`honorarios_3`,`pa_1`,`pa_2`,`pa_3`,`jardin_1`,`jardin_2`,`jardin_3`,`limpieza_1`,`limpieza_2`,`limpieza_3`,`mantto_1`,`mantto_2`,`mantto_3`,`vigilancia_1`,`vigilancia_2`,`vigilancia_3`,`licenciatura_1`,`licenciatura_2`,`licenciatura_3`,`posgrado_1`,`posgrado_2`,`posgrado_3`,`total_personal_1`,`total_personal_2`,`total_personal_3`,`promedio`,`fecha_creacion`) VALUES('1','2020','Enero','Febrero','Marzo','10','12','11','8','9','10','6','7','8','5','5','6','3','3','4','4','4','5','2','2','3','3','3','4','100','110','105','20','22','21','110','116','115','113.66','2025-11-25 17:47:49');
INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo_1`,`admvo_2`,`admvo_3`,`ptc_1`,`ptc_2`,`ptc_3`,`honorarios_1`,`honorarios_2`,`honorarios_3`,`pa_1`,`pa_2`,`pa_3`,`jardin_1`,`jardin_2`,`jardin_3`,`limpieza_1`,`limpieza_2`,`limpieza_3`,`mantto_1`,`mantto_2`,`mantto_3`,`vigilancia_1`,`vigilancia_2`,`vigilancia_3`,`licenciatura_1`,`licenciatura_2`,`licenciatura_3`,`posgrado_1`,`posgrado_2`,`posgrado_3`,`total_personal_1`,`total_personal_2`,`total_personal_3`,`promedio`,`fecha_creacion`) VALUES('2','2021','Enero','Febrero','Marzo','12','13','12','9','10','12','7','8','9','6','6','7','4','4','5','5','5','6','3','3','4','3','3','4','120','122','125','25','26','28','130','132','135','132.33','2025-11-25 17:47:49');
INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo_1`,`admvo_2`,`admvo_3`,`ptc_1`,`ptc_2`,`ptc_3`,`honorarios_1`,`honorarios_2`,`honorarios_3`,`pa_1`,`pa_2`,`pa_3`,`jardin_1`,`jardin_2`,`jardin_3`,`limpieza_1`,`limpieza_2`,`limpieza_3`,`mantto_1`,`mantto_2`,`mantto_3`,`vigilancia_1`,`vigilancia_2`,`vigilancia_3`,`licenciatura_1`,`licenciatura_2`,`licenciatura_3`,`posgrado_1`,`posgrado_2`,`posgrado_3`,`total_personal_1`,`total_personal_2`,`total_personal_3`,`promedio`,`fecha_creacion`) VALUES('3','2022','Enero','Febrero','Marzo','15','16','15','12','11','14','9','10','11','7','7','8','5','5','6','6','6','7','4','4','5','4','4','5','140','143','145','30','32','33','150','155','160','155','2025-11-25 17:47:49');
INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo_1`,`admvo_2`,`admvo_3`,`ptc_1`,`ptc_2`,`ptc_3`,`honorarios_1`,`honorarios_2`,`honorarios_3`,`pa_1`,`pa_2`,`pa_3`,`jardin_1`,`jardin_2`,`jardin_3`,`limpieza_1`,`limpieza_2`,`limpieza_3`,`mantto_1`,`mantto_2`,`mantto_3`,`vigilancia_1`,`vigilancia_2`,`vigilancia_3`,`licenciatura_1`,`licenciatura_2`,`licenciatura_3`,`posgrado_1`,`posgrado_2`,`posgrado_3`,`total_personal_1`,`total_personal_2`,`total_personal_3`,`promedio`,`fecha_creacion`) VALUES('4','2023','Enero','Febrero','Marzo','17','18','17','14','15','16','11','12','13','8','8','9','6','6','7','7','7','8','5','5','6','5','5','6','150','155','158','35','36','38','165','170','175','169.99','2025-11-25 17:47:49');
INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo_1`,`admvo_2`,`admvo_3`,`ptc_1`,`ptc_2`,`ptc_3`,`honorarios_1`,`honorarios_2`,`honorarios_3`,`pa_1`,`pa_2`,`pa_3`,`jardin_1`,`jardin_2`,`jardin_3`,`limpieza_1`,`limpieza_2`,`limpieza_3`,`mantto_1`,`mantto_2`,`mantto_3`,`vigilancia_1`,`vigilancia_2`,`vigilancia_3`,`licenciatura_1`,`licenciatura_2`,`licenciatura_3`,`posgrado_1`,`posgrado_2`,`posgrado_3`,`total_personal_1`,`total_personal_2`,`total_personal_3`,`promedio`,`fecha_creacion`) VALUES('5','2024','Enero','Febrero','Marzo','19','20','19','16','17','18','12','13','14','9','9','10','7','7','8','8','8','9','6','6','7','6','6','7','170','175','178','40','41','43','190','200','210','200.33','2025-11-25 17:47:49');
INSERT INTO `comunidad` (`id_comunidad`,`año`,`mes_1`,`mes_2`,`mes_3`,`admvo_1`,`admvo_2`,`admvo_3`,`ptc_1`,`ptc_2`,`ptc_3`,`honorarios_1`,`honorarios_2`,`honorarios_3`,`pa_1`,`pa_2`,`pa_3`,`jardin_1`,`jardin_2`,`jardin_3`,`limpieza_1`,`limpieza_2`,`limpieza_3`,`mantto_1`,`mantto_2`,`mantto_3`,`vigilancia_1`,`vigilancia_2`,`vigilancia_3`,`licenciatura_1`,`licenciatura_2`,`licenciatura_3`,`posgrado_1`,`posgrado_2`,`posgrado_3`,`total_personal_1`,`total_personal_2`,`total_personal_3`,`promedio`,`fecha_creacion`) VALUES('6','2025','Enero','Febrero','Marzo','21','22','21','18','19','20','14','15','15','10','10','11','8','8','9','9','9','10','7','7','8','6','6','7','185','190','195','45','48','50','210','230','240','226.66','2025-11-25 17:47:49');


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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('1','2020-12-12','120','800','300','1.2','50','170','850','2025-11-25 17:47:49');
INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('2','2021-12-12','130','900','320','1.3','55','185','955','2025-11-25 17:47:49');
INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('3','2022-12-12','140','1000','340','1.35','60','200','1060','2025-11-25 17:47:49');
INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('4','2023-12-12','155','1100','360','1.4','70','225','1170','2025-11-25 17:47:49');
INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('5','2024-12-12','170','1200','380','1.5','80','250','1280','2025-11-25 17:47:49');
INSERT INTO `consumo_agua` (`id`,`mes`,`metros_cubicos`,`costo`,`cuatrimestral`,`percapita`,`consumo_agua_riego`,`total_metros_cubicos`,`total_costo`,`fecha_creacion`) VALUES('6','2025-12-12','185','1300','400','1.55','90','275','1390','2025-11-25 17:47:49');


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


CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rol` (`idRol`,`Nombre`,`Descripcion`) VALUES('1','Administrador','Acceso total al sistema, incluida la gestión de usuarios y reportes.');
INSERT INTO `rol` (`idRol`,`Nombre`,`Descripcion`) VALUES('2','Personal','Acceso a la gestión de registros y generación/descarga de reportes.');
INSERT INTO `rol` (`idRol`,`Nombre`,`Descripcion`) VALUES('3','Invitado','Solo puede visualizar y descargar reportes generados dentro del sitio.');


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rsu` (`id`,`mes`,`papel_kg`,`periodico_kg`,`toalla_manos_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('1','2019-01-01','10','5','4','8','6','3','7','2','1','0','46','120','12','0.12','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`papel_kg`,`periodico_kg`,`toalla_manos_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('2','2020-01-01','12','6','5','9','7','4','8','3','1','0','55','130','14','0.14','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`papel_kg`,`periodico_kg`,`toalla_manos_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('3','2021-01-01','14','7','6','11','8','5','9','3','2','1','66','140','15','0.15','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`papel_kg`,`periodico_kg`,`toalla_manos_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('4','2022-01-01','16','8','6','12','9','6','10','4','2','1','74','150','18','0.18','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`papel_kg`,`periodico_kg`,`toalla_manos_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('5','2023-01-01','18','9','7','14','10','7','11','4','3','1','84','160','20','0.2','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`papel_kg`,`periodico_kg`,`toalla_manos_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('6','2024-01-01','20','10','8','15','11','8','12','5','3','1','93','170','22','0.22','2025-11-25 17:47:49');
INSERT INTO `rsu` (`id`,`mes`,`papel_kg`,`periodico_kg`,`toalla_manos_kg`,`carton_kg`,`pet_kg`,`otros_plasticos_kg`,`vidrio_kg`,`aluminio_kg`,`hojalata_kg`,`fierro_kg`,`total_registro`,`total_cuatrimestre`,`kg_co2_persona_cuatrimestre`,`tn_cuatrimestre`,`fecha_creacion`) VALUES('7','2025-01-01','22','11','9','17','13','9','14','5','4','2','106','180','25','0.25','2025-11-25 17:47:49');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuario` (`idUsuario`,`Nombre`,`ApellidoPaterno`,`ApellidoMaterno`,`Telefono`,`Correo`,`Pass`,`Cargo`,`FechaRegistro`,`CreadoPor`,`Estado`,`idRol`) VALUES('1','Joel','Bailòn','Guzman','7774584597','BGJO231014@UPEMOR.EDU.MX','BGJO231014','Administrador','2025-11-11 15:34:29',NULL,'Activo','1');
