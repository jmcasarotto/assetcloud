/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50631
Source Host           : localhost:3306
Source Database       : jobs24_base

Target Server Type    : MYSQL
Target Server Version : 50631
File Encoding         : 65001

Date: 2017-09-28 16:00:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for confzone
-- ----------------------------
DROP TABLE IF EXISTS `confzone`;
CREATE TABLE `confzone` (
  `zonaId` int(11) NOT NULL AUTO_INCREMENT,
  `zonaName` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`zonaId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of confzone
-- ----------------------------
INSERT INTO `confzone` VALUES ('10', 'Caucete');
INSERT INTO `confzone` VALUES ('11', 'Zonda');
INSERT INTO `confzone` VALUES ('12', 'Rivadavia');
INSERT INTO `confzone` VALUES ('13', 'Sarmiento');
INSERT INTO `confzone` VALUES ('14', 'Los Berros');
INSERT INTO `confzone` VALUES ('15', 'El Encón');

-- ----------------------------
-- Table structure for empresas
-- ----------------------------
DROP TABLE IF EXISTS `empresas`;
CREATE TABLE `empresas` (
  `id_empresa` int(50) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET latin1 NOT NULL,
  `empcuit` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `empdir` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `emptelefono` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `empemail` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cliImagePath` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `localidadid` int(11) DEFAULT NULL,
  `provinciaid` int(11) DEFAULT NULL,
  `paisid` int(11) DEFAULT NULL,
  `gps` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `empcelular` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `zonaId` int(11) DEFAULT NULL,
  `emlogo` blob,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of empresas
-- ----------------------------
INSERT INTO `empresas` VALUES ('1', 'Hospital Dr. Guillermo Rawson', '20111111119', 'Av. Guillermo Rawson 494 sur', '0264 422-4005', 'controloperatihrawson@gmail.com', null, null, null, null, null, '', '12', null);
INSERT INTO `empresas` VALUES ('2', 'Oficinas Ayinco', '30125612569', 'Caseros 619 Sur', '0264 427-4296', '', null, null, null, null, null, '', '12', null);
INSERT INTO `empresas` VALUES ('3', 'Finning', '27111111116', 'Gral. Mariano Acha 1476', '0264 427-2829', null, null, null, null, null, null, null, null, null);
INSERT INTO `empresas` VALUES ('4', 'Clorox S.A.', '20989898985', 'Av. Benavidez 4845 oeste', '0264 423-6464', '', null, null, null, null, null, '', '10', null);
INSERT INTO `empresas` VALUES ('5', 'Hospital Ventura Lloveras', '21221458977', '25 de Mayo 230', '0264 494-1004', null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for sisactions
-- ----------------------------
DROP TABLE IF EXISTS `sisactions`;
CREATE TABLE `sisactions` (
  `actId` int(11) NOT NULL AUTO_INCREMENT,
  `actDescription` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `actDescriptionSpanish` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`actId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sisactions
-- ----------------------------
INSERT INTO `sisactions` VALUES ('1', 'Add', 'Agregar');
INSERT INTO `sisactions` VALUES ('2', 'Edit', 'Editar');
INSERT INTO `sisactions` VALUES ('3', 'Del', 'Eliminar');
INSERT INTO `sisactions` VALUES ('4', 'View', 'Consultar');
INSERT INTO `sisactions` VALUES ('5', 'Imprimir', 'Imprimir');
INSERT INTO `sisactions` VALUES ('6', 'Saldo', 'Consultar Saldo');
INSERT INTO `sisactions` VALUES ('7', 'Asignar', 'Asignar');
INSERT INTO `sisactions` VALUES ('8', 'Finalizar', 'Finalizar');
INSERT INTO `sisactions` VALUES ('9', 'OP', 'OP');
INSERT INTO `sisactions` VALUES ('10', 'Pedidos', 'Pedidos');
INSERT INTO `sisactions` VALUES ('11', 'Supervisor', 'Supervisor');
INSERT INTO `sisactions` VALUES ('12', 'Entregar', 'Entrega de Ordenes');
INSERT INTO `sisactions` VALUES ('13', 'Lectura', 'Lect horas equipos ');

-- ----------------------------
-- Table structure for sisgroups
-- ----------------------------
DROP TABLE IF EXISTS `sisgroups`;
CREATE TABLE `sisgroups` (
  `grpId` int(11) NOT NULL AUTO_INCREMENT,
  `grpName` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grpDash` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`grpId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sisgroups
-- ----------------------------
INSERT INTO `sisgroups` VALUES ('1', 'Administrador', 'Empresa');
INSERT INTO `sisgroups` VALUES ('2', 'Vendedor', 'Sservicio');
INSERT INTO `sisgroups` VALUES ('3', 'Depósito', 'Sservicio');
INSERT INTO `sisgroups` VALUES ('4', 'Operario1', 'Sservicio');
INSERT INTO `sisgroups` VALUES ('5', 'Supervisor de Taller', 'Sservicio');

-- ----------------------------
-- Table structure for sisgroupsactions
-- ----------------------------
DROP TABLE IF EXISTS `sisgroupsactions`;
CREATE TABLE `sisgroupsactions` (
  `grpactId` int(11) NOT NULL AUTO_INCREMENT,
  `grpId` int(11) NOT NULL,
  `menuAccId` int(11) NOT NULL,
  PRIMARY KEY (`grpactId`),
  KEY `grpId` (`grpId`) USING BTREE,
  KEY `menuAccId` (`menuAccId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sisgroupsactions
-- ----------------------------
INSERT INTO `sisgroupsactions` VALUES ('1', '1', '1');
INSERT INTO `sisgroupsactions` VALUES ('2', '1', '2');
INSERT INTO `sisgroupsactions` VALUES ('3', '1', '3');
INSERT INTO `sisgroupsactions` VALUES ('4', '1', '4');
INSERT INTO `sisgroupsactions` VALUES ('5', '1', '5');
INSERT INTO `sisgroupsactions` VALUES ('6', '1', '6');
INSERT INTO `sisgroupsactions` VALUES ('7', '1', '7');
INSERT INTO `sisgroupsactions` VALUES ('8', '1', '8');
INSERT INTO `sisgroupsactions` VALUES ('9', '1', '9');
INSERT INTO `sisgroupsactions` VALUES ('10', '1', '10');
INSERT INTO `sisgroupsactions` VALUES ('11', '1', '11');
INSERT INTO `sisgroupsactions` VALUES ('12', '1', '12');
INSERT INTO `sisgroupsactions` VALUES ('13', '1', '13');
INSERT INTO `sisgroupsactions` VALUES ('14', '1', '14');
INSERT INTO `sisgroupsactions` VALUES ('15', '1', '15');
INSERT INTO `sisgroupsactions` VALUES ('16', '1', '16');
INSERT INTO `sisgroupsactions` VALUES ('17', '1', '17');
INSERT INTO `sisgroupsactions` VALUES ('18', '1', '18');
INSERT INTO `sisgroupsactions` VALUES ('19', '1', '19');
INSERT INTO `sisgroupsactions` VALUES ('20', '1', '20');
INSERT INTO `sisgroupsactions` VALUES ('21', '1', '21');

-- ----------------------------
-- Table structure for sismenu
-- ----------------------------
DROP TABLE IF EXISTS `sismenu`;
CREATE TABLE `sismenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sismenu
-- ----------------------------
INSERT INTO `sismenu` VALUES ('1', null, 'Clientes', 'fa fa-file-picture-o', 'empresa', '1');
INSERT INTO `sismenu` VALUES ('2', null, 'Seguridad', 'fa fa-lock', '', '2');
INSERT INTO `sismenu` VALUES ('3', '2', 'Usuarios', 'fa fa-fw fa-user', 'user', '2');
INSERT INTO `sismenu` VALUES ('4', '2', 'Grupos', 'fa fa-fw fa-users', 'group', '1');
INSERT INTO `sismenu` VALUES ('5', '2', 'Menu', 'fa fa-fw fa-bars', 'menu', '3');
INSERT INTO `sismenu` VALUES ('6', '2', 'Database', 'fa fa-fw fa-database', 'backup', '4');

-- ----------------------------
-- Table structure for sismenuactions
-- ----------------------------
DROP TABLE IF EXISTS `sismenuactions`;
CREATE TABLE `sismenuactions` (
  `menuAccId` int(11) NOT NULL AUTO_INCREMENT,
  `menuId` int(11) NOT NULL,
  `actId` int(11) DEFAULT NULL,
  PRIMARY KEY (`menuAccId`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sismenuactions
-- ----------------------------
INSERT INTO `sismenuactions` VALUES ('1', '1', '1');
INSERT INTO `sismenuactions` VALUES ('2', '1', '2');
INSERT INTO `sismenuactions` VALUES ('3', '1', '3');
INSERT INTO `sismenuactions` VALUES ('4', '1', '4');
INSERT INTO `sismenuactions` VALUES ('5', '2', '1');
INSERT INTO `sismenuactions` VALUES ('6', '3', '1');
INSERT INTO `sismenuactions` VALUES ('7', '3', '2');
INSERT INTO `sismenuactions` VALUES ('8', '3', '3');
INSERT INTO `sismenuactions` VALUES ('9', '3', '4');
INSERT INTO `sismenuactions` VALUES ('10', '4', '1');
INSERT INTO `sismenuactions` VALUES ('11', '4', '2');
INSERT INTO `sismenuactions` VALUES ('12', '4', '3');
INSERT INTO `sismenuactions` VALUES ('13', '4', '4');
INSERT INTO `sismenuactions` VALUES ('14', '5', '1');
INSERT INTO `sismenuactions` VALUES ('15', '5', '2');
INSERT INTO `sismenuactions` VALUES ('16', '5', '3');
INSERT INTO `sismenuactions` VALUES ('17', '5', '4');
INSERT INTO `sismenuactions` VALUES ('18', '6', '1');
INSERT INTO `sismenuactions` VALUES ('19', '6', '2');
INSERT INTO `sismenuactions` VALUES ('20', '6', '3');
INSERT INTO `sismenuactions` VALUES ('21', '6', '4');

-- ----------------------------
-- Table structure for sisusers
-- ----------------------------
DROP TABLE IF EXISTS `sisusers`;
CREATE TABLE `sisusers` (
  `usrId` int(11) NOT NULL AUTO_INCREMENT,
  `usrNick` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usrName` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usrLastName` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usrComision` int(11) NOT NULL,
  `usrPassword` varchar(5000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grpId` int(11) NOT NULL,
  `usrimag` blob NOT NULL,
  PRIMARY KEY (`usrId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sisusers
-- ----------------------------
INSERT INTO `sisusers` VALUES ('0', 'superadmin', 'Super', 'Admin', '0', '21232f297a57a5a743894a0e4a801fc3', '0', '');
INSERT INTO `sisusers` VALUES ('1', 'admin', 'Control', 'Operario', '0', '21232f297a57a5a743894a0e4a801fc3', '1', '');
INSERT INTO `sisusers` VALUES ('2', 'uco', 'Operario', 'Operario', '0', 'ee11cbb19052e40b07aac0ca060c23ee', '4', '');
INSERT INTO `sisusers` VALUES ('3', 'soporte', 'Soporte', 'Trazalog', '0', '855fa866d6d3f72f6a50bc213244e36d', '1', '');
INSERT INTO `sisusers` VALUES ('4', 'insumos', 'Insumos', 'Pañol', '0', '3c6ff27f8f4c3efa42bcee681d78589f', '3', '');
INSERT INTO `sisusers` VALUES ('5', 'supervisor', 'Supervisor', 'Supervisor', '0', '09348c20a019be0318387c08df7a783d', '5', '');
SET FOREIGN_KEY_CHECKS=1;
