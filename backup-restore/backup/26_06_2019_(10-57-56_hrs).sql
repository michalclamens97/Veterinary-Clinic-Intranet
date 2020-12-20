SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS pasantia;

USE pasantia;

DROP TABLE IF EXISTS cliente;

CREATE TABLE `cliente` (
  `NOMBRE` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDO` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CEDULA` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TELEFONO` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DIRECCION` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO cliente VALUES("Michael","Clamens","V-24765424","(0412) 196-2891","Maneiro");



DROP TABLE IF EXISTS consulta;

CREATE TABLE `consulta` (
  `CEDULA_CLIENTE` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ID_MASCOTA` int(11) NOT NULL,
  `NOMBRE_MASCOTA` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `MOTIVO` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PROCEDIMIENTOS` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `MEDICAMENTOS` varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `OBSERVACIONES` varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_CITA` date NOT NULL,
  `PROXIMA_CITA` date NOT NULL,
  `PRECIO` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TRATAMIENTO` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO consulta VALUES("V-24765424","58","Mandy","Miasis","Venopunción,Ex heces","Doxipet susp,Floxacol","Sin Observaciones","2019-06-26","2019-06-26","Bs.50.000","Doxipet susp: 2 ml c 5 hrs.\nFloxacol: 5 ml c 10 hrs.");



DROP TABLE IF EXISTS desparasitacion;

CREATE TABLE `desparasitacion` (
  `CEDULA` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ID_MASCOTA` int(11) NOT NULL,
  `MASCOTA` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `RAZA` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ESPECIE` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PRODUCTOS` varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_CONSTANCIA` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS especies;

CREATE TABLE `especies` (
  `ESPECIE` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO especies VALUES("canina");
INSERT INTO especies VALUES("felina");



DROP TABLE IF EXISTS especies_raza;

CREATE TABLE `especies_raza` (
  `TIPO` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `RAZA` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO especies_raza VALUES("canina","Poodle");
INSERT INTO especies_raza VALUES("canina","Schnauzer");
INSERT INTO especies_raza VALUES("canina","Cocker Spaniel");
INSERT INTO especies_raza VALUES("canina","Pastor Aleman");
INSERT INTO especies_raza VALUES("canina","Pug");
INSERT INTO especies_raza VALUES("canina","Labrador Retriever");
INSERT INTO especies_raza VALUES("canina","Golden Retriver");
INSERT INTO especies_raza VALUES("canina","Boxer");
INSERT INTO especies_raza VALUES("canina","Dalmata");
INSERT INTO especies_raza VALUES("canina","Doberman Pinscher");
INSERT INTO especies_raza VALUES("canina","Rottweiler");
INSERT INTO especies_raza VALUES("canina","Salchicha");
INSERT INTO especies_raza VALUES("canina","Bulldog Ingles");
INSERT INTO especies_raza VALUES("canina","Bulldog Frances");
INSERT INTO especies_raza VALUES("canina","Bull Terrier");
INSERT INTO especies_raza VALUES("canina","Pitbull Terrier");
INSERT INTO especies_raza VALUES("canina","Mestizo");
INSERT INTO especies_raza VALUES("felina","Angora");
INSERT INTO especies_raza VALUES("felina","Persa");
INSERT INTO especies_raza VALUES("felina","Mix");
INSERT INTO especies_raza VALUES("felina","Siamez");



DROP TABLE IF EXISTS informe_medico;

CREATE TABLE `informe_medico` (
  `CEDULA_CLIENTE` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ID_MASCOTA` int(11) NOT NULL,
  `NOMBRE_MASCOTA` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `MOTIVO` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PROCEDIMIENTOS` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `OBSERVACIONES` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_CITA` date NOT NULL,
  `PROXIMA_CITA` date NOT NULL,
  `PRECIO` float NOT NULL,
  `INFORME` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `MEDICAMENTOS` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO informe_medico VALUES("V-24765424","58","Mandy","Miasis","Venopunción,Ex heces","Sin Observaciones","2019-06-26","2019-06-26","0","El motivo de la consulta fue una miasis. Se llevo a cabo una venopunción y un ex de heces.","Doxipet susp,Floxacol");



DROP TABLE IF EXISTS login;

CREATE TABLE `login` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PASS` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PREGUNTA` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `RESPUESTA` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO login VALUES("1","admin","mandy","bebida favorita?","cafe");
INSERT INTO login VALUES("2","user","1234","color favorito?","azul");
INSERT INTO login VALUES("4","mike","1234","bebida favorita?","cerveza");



DROP TABLE IF EXISTS mascota;

CREATE TABLE `mascota` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ESPECIE` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `RAZA` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `EDAD` date NOT NULL,
  `SEXO` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PESO` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ESTERILIZADO` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CEDULA_CLIENTE` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

INSERT INTO mascota VALUES("58","Mandy","canina","Schnauzer","2017-04-04","hembra","Kg 0.9","Si","V-24765424");
INSERT INTO mascota VALUES("59","Rocko","canina","Rottweiler","2016-08-18","macho","Kg 7","Si","V-24765424");



DROP TABLE IF EXISTS medicamentos;

CREATE TABLE `medicamentos` (
  `NOMBRE` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PRECIO` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO medicamentos VALUES("Doxipet susp","Bs.5.000");
INSERT INTO medicamentos VALUES("Doxicilina tos 100 mg","Bs.8.000");
INSERT INTO medicamentos VALUES("Floxacol","Bs.2.000");
INSERT INTO medicamentos VALUES("Cefalexina Susp 250mg","Bs.7.000");



DROP TABLE IF EXISTS motivo_consulta;

CREATE TABLE `motivo_consulta` (
  `MOTIVO` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO motivo_consulta VALUES("Medicina interna");
INSERT INTO motivo_consulta VALUES("Laboratorio");
INSERT INTO motivo_consulta VALUES("Cardiología");
INSERT INTO motivo_consulta VALUES("Gastrología");
INSERT INTO motivo_consulta VALUES("Oftalmología");
INSERT INTO motivo_consulta VALUES("Dermatología");
INSERT INTO motivo_consulta VALUES("Miasis");



DROP TABLE IF EXISTS procedimientos_consulta;

CREATE TABLE `procedimientos_consulta` (
  `PROCEDIMIENTO` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PRECIO` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO procedimientos_consulta VALUES("Anestesia","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Analgesia","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Venopunción","Bs.7.000");
INSERT INTO procedimientos_consulta VALUES("Química Sanguinea","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Ex orina","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Ex heces","Bs.5.000");
INSERT INTO procedimientos_consulta VALUES("Fluidoterapia","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Tratamiento","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Citología","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Limpieza dental","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Raspado de piel","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Sedación","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Eco","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Rx","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Cirugía","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Sextuple","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Hospitalización","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Sextuple rabia","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Pensión","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Peluquería","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Lavado","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Biopsia","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Toma de muestras","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Drenaje","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Vendaje","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Rabia","Bs.0");
INSERT INTO procedimientos_consulta VALUES("Hematología Completa","Bs.0");



DROP TABLE IF EXISTS productos;

CREATE TABLE `productos` (
  `PRODUCTO` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `LOTE` int(11) NOT NULL,
  `ELABORACION` date NOT NULL,
  `VENCIMIENTO` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO productos VALUES("Dog tab plus","13","2017-05-12","2019-05-12");
INSERT INTO productos VALUES("Fiprolav","15","2019-04-16","2021-06-17");



DROP TABLE IF EXISTS vacunacion;

CREATE TABLE `vacunacion` (
  `CEDULA_CLIENTE` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ID_MASCOTA` int(11) NOT NULL,
  `NOMBRE_MASCOTA` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FECHA_APLICACION` date NOT NULL,
  `FECHA_PROXIMA` date NOT NULL,
  `ITEM` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CANTIDAD` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




SET FOREIGN_KEY_CHECKS=1;