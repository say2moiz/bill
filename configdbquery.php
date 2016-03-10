<?php
$configdb = "-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2016 at 04:24 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `billing`
--
CREATE DATABASE IF NOT EXISTS `billing` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `billing`;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE IF NOT EXISTS `bill` (
  `idBill` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(45) NOT NULL,
  `caddress` varchar(45) NOT NULL,
  `meternum` int(11) NOT NULL,
  `readtime` datetime NOT NULL,
  `reading` varchar(45) NOT NULL,
  `unit` varchar(45) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idBillGenerationHistory` int(11) NOT NULL,
  `companyPhone` varchar(45) NOT NULL,
  `billType` varchar(45) NOT NULL,
  `companyAddress` varchar(200) NOT NULL,
  `companyName` varchar(45) NOT NULL,
  `idCompany` int(11) NOT NULL,
  `idBillTitle` int(11) NOT NULL,
  PRIMARY KEY (`idBill`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `billgenerationhistory`
--

CREATE TABLE IF NOT EXISTS `billgenerationhistory` (
  `idBillGenerationHistory` int(11) NOT NULL AUTO_INCREMENT,
  `unitPrice` int(11) NOT NULL,
  `fileName` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCompany` int(11) NOT NULL,
  `idBillTitle` int(11) NOT NULL,
  PRIMARY KEY (`idBillGenerationHistory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `billtitle`
--

CREATE TABLE IF NOT EXISTS `billtitle` (
  `idBillTitle` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `timeStamp` datetime DEFAULT NULL,
  PRIMARY KEY (`idBillTitle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `billtitle`
--

INSERT INTO `billtitle` (`idBillTitle`, `title`, `idUser`, `timeStamp`) VALUES
(1, 'Cooling energy Bill', 1, '2015-07-02 16:12:04'),
(2, 'Heat Energy Bill', 1, '2015-07-02 16:12:04'),
(3, 'Water Bill', 1, '2015-07-02 16:12:04'),
(4, 'Electricity Bill', 1, '2015-07-02 16:12:04'),
(5, 'Cooling energy Invoice', 1, '2015-07-02 16:12:04'),
(6, 'Heat energy Invoice', 1, '2015-07-02 16:12:04'),
(7, 'Water invoice', 1, '2015-07-02 16:12:04'),
(8, 'Electricity Invoice', 1, '2015-07-02 16:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `idCompany` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(45) NOT NULL,
  `companyAddress` varchar(100) NOT NULL,
  `companyPhone` varchar(45) NOT NULL,
  `timeStamp` datetime NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idCompany`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`idCompany`, `companyName`, `companyAddress`, `companyPhone`, `timeStamp`, `idUser`) VALUES
(1, 'My Company', '100 main street', '98765432', '2016-02-15 01:39:03', 1),
(2, 'Admin', '101 main street', '98765432', '2016-01-25 04:22:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `idCurrency` int(11) NOT NULL AUTO_INCREMENT,
  `currencyName` varchar(45) DEFAULT NULL,
  `currencyShortName` varchar(45) NOT NULL,
  `symbol` varchar(45) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `timeStamp` datetime NOT NULL,
  PRIMARY KEY (`idCurrency`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`idCurrency`, `currencyName`, `currencyShortName`, `symbol`, `idUser`, `timeStamp`) VALUES
(1, '', 'AED', '', 1, '2015-07-02 17:21:18'),
(2, '', 'ARS', '', 1, '2015-07-02 17:21:18'),
(3, '', 'AUD', '', 1, '2015-07-02 17:21:18'),
(4, '', 'BRL', '', 1, '2015-07-02 17:21:18'),
(5, '', 'CAD', '', 1, '2015-07-02 17:21:18'),
(6, '', 'CHF', '', 1, '2015-07-02 17:21:18'),
(7, '', 'CNY', '', 1, '2015-07-02 17:21:18'),
(8, '', 'CZK', '', 1, '2015-07-02 17:21:18'),
(9, '', 'DKK', '', 1, '2015-07-02 17:21:18'),
(10, '', 'EUR', '', 1, '2015-07-02 17:21:18'),
(11, '', 'GBP', '', 1, '2015-07-02 17:21:18'),
(12, '', 'HKD', '', 1, '2015-07-02 17:21:18'),
(13, '', 'HUF', '', 1, '2015-07-02 17:21:18'),
(14, '', 'ILS', '', 1, '2015-07-02 17:21:18'),
(15, '', 'INR', '', 1, '2015-07-02 17:21:18'),
(16, '', 'PKR', '', 1, '2015-07-02 17:21:18'),
(17, '', 'JPY', '', 1, '2015-07-02 17:21:18'),
(18, '', 'KRW', '', 1, '2015-07-02 17:21:18'),
(19, '', 'MAD', '', 1, '2015-07-02 17:21:18'),
(20, '', 'MXN', '', 1, '2015-07-02 17:21:18'),
(21, '', 'NOK', '', 1, '2015-07-02 17:21:18'),
(22, '', 'NZD', '', 1, '2015-07-02 17:21:18'),
(23, '', 'PHP', '', 1, '2015-07-02 17:21:18'),
(24, '', 'PLN', '', 1, '2015-07-02 17:21:18'),
(25, '', 'SEK', '', 1, '2015-07-02 17:21:18'),
(26, '', 'SGD', '', 1, '2015-07-02 17:21:18'),
(27, '', 'THB', '', 1, '2015-07-02 17:21:18'),
(28, '', 'TRY', '', 1, '2015-07-02 17:21:18'),
(29, '', 'USD', '', 1, '2015-07-02 17:21:18'),
(30, '', 'ZAR', '', 1, '2015-07-02 17:21:18'),
(31, '', 'RUB', '', 1, '2015-07-02 17:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `licensekeys`
--

CREATE TABLE IF NOT EXISTS `licensekeys` (
  `idLicenseKeys` int(11) NOT NULL AUTO_INCREMENT,
  `licenseKey` varchar(200) NOT NULL,
  `expired` int(11) NOT NULL DEFAULT '0',
  `idUser` int(11) NOT NULL,
  `daysValidFor` int(11) DEFAULT '0',
  `usedBy` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idLicenseKeys`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=186 ;

--
-- Dumping data for table `licensekeys`
--

INSERT INTO `licensekeys` (`idLicenseKeys`, `licenseKey`, `expired`, `idUser`, `daysValidFor`, `usedBy`) VALUES
(1, 'LU858-1ZS1V-QR3MD-2ZY75', 0, 1, 30, 0),
(2, 'U53Y8-UD09C-W8IA0-42YKM', 0, 1, 30, 0),
(3, 'J1V70-SSV3U-O2VID-QXG7E', 0, 1, 30, 0),
(4, 'DX0ZS-M6YAS-IBF3D-JBTLJ', 0, 1, 30, 0),
(5, 'KMIU9-R0E0Y-ENVEI-LGUPO', 0, 1, 30, 0),
(6, 'VGUXO-09Q0P-R3F9Q-I1W1W', 0, 1, 30, 0),
(7, 'GBYSQ-QD3IW-MAT1J-DBTIS', 0, 1, 30, 0),
(8, '2HBJN-SC17V-FBAJW-SZYLG', 0, 1, 30, 0),
(9, 'XVWR6-GMPBH-4QI58-U96BG', 0, 1, 30, 0),
(10, 'QR6KH-N7OL1-8OPOK-4VR3X', 0, 1, 30, 0),
(11, 'P14KB-OJ08F-NQMIC-Q1MWF', 0, 1, 30, 0),
(12, 'L07TV-ELCZY-X0HGI-9H372', 0, 1, 30, 0),
(13, 'LKDWW-4URZH-Y2ZVK-SFY0G', 0, 1, 30, 0),
(14, 'F04YM-R9T1D-9ZBLH-YKMQN', 0, 1, 30, 0),
(15, 'B8EKP-LBOCF-SF9YP-S4XE9', 0, 1, 30, 0),
(16, 'ZIOSF-HYVL0-0F0U8-YU6FE', 0, 1, 30, 0),
(17, 'MQY9H-RNI0Y-WLAJH-HW8SN', 0, 1, 30, 0),
(18, 'Z9N23-BE7BN-W0AYH-Z2GZ3', 0, 1, 30, 0),
(19, '9VRSY-GO1RV-0BRDO-LJOZC', 0, 1, 30, 0),
(20, '7ZRIC-1EL10-PKWO1-U187G', 0, 1, 30, 0),
(21, 'ZEMUW-D2ZDW-XCG70-VRZO2', 0, 1, 30, 0),
(22, 'DGSWX-CNSGW-5RLSL-9F9U9', 0, 1, 30, 0),
(23, 'K0882-AM4JT-CF3R8-3AWNM', 0, 1, 30, 0),
(24, '9FFYL-1XJC0-ZE40X-Z29L8', 0, 1, 30, 0),
(25, 'PIDN6-Y262B-1BGT4-0X6NP', 0, 1, 30, 0),
(26, 'MMIF3-UZMF3-Y893S-RN095', 0, 1, 30, 0),
(27, '7MSV0-36XO7-RR94E-BELF4', 0, 1, 30, 0),
(28, '6TP36-JKQHY-UZPSX-BX9LQ', 0, 1, 30, 0),
(29, 'R38OA-IN337-8IAFT-UGVQK', 0, 1, 30, 0),
(30, 'PRTOL-UFN8A-EE9U2-GPQBQ', 0, 1, 30, 0),
(31, '6OFRS-VBG42-9AAG5-9URAU', 0, 1, 30, 0),
(32, 'X7KY3-HA4HV-B9M10-WN86Y', 0, 1, 30, 0),
(33, '656W9-0UQHJ-JWZZ4-EC0WN', 0, 1, 30, 0),
(34, 'MVPOG-AXWWG-EBL3G-DLGX2', 0, 1, 30, 0),
(35, 'I86UF-M1PXE-V25QH-XND9S', 0, 1, 30, 0),
(36, 'JJ0JD-X4QAR-DAWR6-O85CV', 0, 1, 30, 0),
(37, 'XO7C1-HM38D-YJII0-OJM5Y', 0, 1, 30, 0),
(38, 'EY7DN-6KDEK-0X9TX-IB454', 0, 1, 30, 0),
(39, '6806W-CDN37-K2U0F-BSHBX', 0, 1, 30, 0),
(40, 'YU2U0-T1KZM-10HYG-ON23I', 0, 1, 30, 0),
(41, '0NC1P-Y05AN-FDW0H-N3PIH', 0, 1, 30, 0),
(42, '0ZBS6-K92RN-79AZI-VWRYV', 0, 1, 30, 0),
(43, '6PXP7-1ACLH-C9E8Y-F91GB', 0, 1, 30, 0),
(44, '94PVY-61LHG-AGFMT-WWXGW', 0, 1, 30, 0),
(45, 'F4KX6-DZYPE-0G4GK-D09Y7', 0, 1, 30, 0),
(46, 'G0ZW2-F2YYP-0BOM5-GCDDC', 0, 1, 30, 0),
(47, 'JNYGD-OTQF7-8OSF2-933PW', 0, 1, 30, 0),
(48, 'DDXM9-04VV8-4MQRA-CZSFZ', 0, 1, 30, 0),
(49, '71V1I-RJGHM-PQ6W8-T9AH5', 0, 1, 30, 0),
(50, 'RZARB-QZ3ZQ-E3DQX-9LXDJ', 0, 1, 30, 0),
(51, '823FD-BWULF-7B1MS-S9L1Q', 0, 1, 30, 0),
(52, 'CLR3X-BBD20-KIDCU-ZXLYS', 0, 1, 30, 0),
(53, 'CFADO-4OOKB-H83BI-YUR4C', 0, 1, 30, 0),
(54, 'WX5CV-IYFVQ-ELFBR-APHYG', 0, 1, 30, 0),
(55, 'AXAM7-WMP43-964R3-1RKGR', 0, 1, 30, 0),
(56, '6R69X-3M24Q-L3CFH-VPD3B', 0, 1, 30, 0),
(57, 'SATWP-FFM1H-CYUOD-TSQUQ', 0, 1, 30, 0),
(58, 'WUMMS-S10LP-YSUDP-IOZ53', 0, 1, 30, 0),
(59, 'NAL0W-GW908-F91U0-1M0Z0', 0, 1, 30, 0),
(60, 'TX769-B0Z0F-8FOY8-YC4UK', 0, 1, 30, 0),
(61, 'MMEOK-QSAT4-BWG0T-E15NC', 0, 1, 30, 0),
(62, 'QQON2-I8S5N-4QLWR-YHHXG', 0, 1, 30, 0),
(63, 'E3ZNG-ZSJ7V-PKTXI-QTXLH', 0, 1, 30, 0),
(64, 'C1TSY-1H4R3-GGCY2-9TU5I', 0, 1, 30, 0),
(65, 'RF3NA-ZPOY7-C1WCV-PO2K6', 0, 1, 30, 0),
(66, 'ELCDN-PISKJ-WDOWW-N4XAI', 0, 1, 30, 0),
(67, 'GEHHT-HAISY-12FZL-5DAB5', 0, 1, 30, 0),
(68, 'O504Z-71HBQ-98CFZ-T4I37', 0, 1, 30, 0),
(69, '9PWVT-89SFS-IF6MI-QNFK7', 0, 1, 30, 0),
(70, 'XFLTM-CV0TF-9R4C4-JLC9B', 0, 1, 30, 0),
(71, 'V52J1-YD8OH-HTVZA-99542', 0, 1, 30, 0),
(72, 'V7T6C-VP2RC-NPPD0-KA6LL', 0, 1, 30, 0),
(73, '3GRA8-FDL9T-Q0AUQ-HY9OH', 0, 1, 30, 0),
(74, 'A8FZW-HBFW9-7UW9F-NXQTT', 0, 1, 30, 0),
(75, 'NDRU4-E1NXI-1R6ZK-4HG07', 0, 1, 30, 0),
(76, 'W87Y2-ZGV0X-NWES4-JASPP', 0, 1, 30, 0),
(77, 'ANRXG-L35FB-3T92K-YLKVY', 0, 1, 30, 0),
(78, 'HZVVJ-3V3U2-RN0OU-Z43Z1', 0, 1, 30, 0),
(79, 'R2IC0-SATI0-NYBXG-P190J', 0, 1, 30, 0),
(80, 'S86G4-KBV5G-9TGOC-P5DEK', 0, 1, 30, 0),
(81, 'TCTSJ-QEEXA-IV39Z-4LB6O', 0, 1, 30, 0),
(82, 'JPWGI-5JZMU-W6HJC-I4FQZ', 0, 1, 30, 0),
(83, '78E2R-65OGY-ECBUX-ZZI33', 0, 1, 30, 0),
(84, 'I7RNI-M943Z-GGU0N-4UYP4', 0, 1, 30, 0),
(85, 'OHZVG-UBDSQ-14RE0-1XKJL', 0, 1, 30, 0),
(86, 'FFISU-O929L-MFAVY-AZP2N', 0, 1, 30, 0),
(87, 'ZUCZD-IM9QE-7Y5QZ-Z889W', 0, 1, 30, 0),
(88, '24XL9-4AKWG-8TKU1-RDHLD', 0, 1, 30, 0),
(89, 'W3868-XT3ZN-NL9JL-NM90Q', 0, 1, 30, 0),
(90, '63QTI-P3DQB-YDFON-9PZ01', 0, 1, 30, 0),
(91, '4YE5T-TNKCA-4STLM-QUFJW', 0, 1, 30, 0),
(92, 'H1P8C-4F9JW-LVN4J-LQZ3D', 0, 1, 30, 0),
(93, 'G6LOU-YWIJ1-D9LMT-ZNGL3', 0, 1, 30, 0),
(94, 'RQKLI-61X10-V2XXF-H97J5', 0, 1, 30, 0),
(95, 'LIJJ3-3ALBN-4TCEV-6S3W4', 0, 1, 30, 0),
(96, 'QW2MS-LN51C-KO2V4-NYF53', 0, 1, 30, 0),
(97, 'CQ1FB-ZLMFV-66SOL-1039O', 0, 1, 30, 0),
(98, '6CY2V-42O7N-EGROB-WNEOY', 0, 1, 30, 0),
(99, 'FKS48-CJCMH-83P7Q-C28DJ', 0, 1, 30, 0),
(100, 'UR0PK-IZ9CQ-46T3S-Y1VUI', 0, 1, 30, 0),
(101, 'LRKDL-YVHN7-2BTPZ-TQ70H', 0, 1, 365, 0),
(102, 'GWY9K-I6N7A-IKYWA-JVKEI', 0, 1, 365, 0),
(103, 'L24X7-KDT9S-FKWY6-8PTX7', 0, 1, 365, 0),
(104, 'RKKIO-WELJ2-AEXSK-GXA3O', 0, 1, 365, 0),
(105, '687KR-WQ28Z-2NPPZ-BSSVH', 0, 1, 365, 0),
(106, 'KGJ6M-EDT2V-7EHKD-EYPPR', 0, 1, 365, 0),
(107, '41KZ0-QSZ9K-PAYP7-TPWK3', 0, 1, 365, 0),
(108, 'KCP15-RW4JE-1CDYF-6PNYJ', 0, 1, 365, 0),
(109, '47XYQ-T7C58-57FOK-I6UTQ', 0, 1, 365, 0),
(110, 'IYQT0-RO8RF-IZCPJ-HWTLQ', 0, 1, 365, 0),
(111, 'YH38O-WSWLS-37UET-50FB6', 0, 1, 365, 0),
(112, '63F9Y-3IWFP-D05LE-3AZE4', 0, 1, 365, 0),
(113, 'EMRKK-PACEY-B0ZMQ-GXDU6', 0, 1, 365, 0),
(114, 'BGI6Q-K3VAY-E8KBS-SNW3F', 0, 1, 365, 0),
(115, '5EPP6-0EIAI-KCL21-6OF5H', 0, 1, 365, 0),
(116, 'NSR83-W7V4Y-BEAOG-9QAGF', 0, 1, 365, 0),
(117, '0IOD8-KX305-L0EIH-30CZU', 0, 1, 365, 0),
(118, 'YWW8T-UKPOG-V84E5-A9Y7U', 0, 1, 365, 0),
(119, 'PREDI-4LUBO-5P6PU-YPW31', 0, 1, 365, 0),
(120, 'ZHOXL-6Z3O7-UIS9L-N0K3G', 0, 1, 365, 0),
(121, 'ZWOFR-E6JYT-Y8NEU-HGT7R', 0, 1, 365, 0),
(122, 'GBV18-M6RWX-YY0YL-1QYWZ', 0, 1, 365, 0),
(123, 'LM7AP-6EWOB-TALB9-F1U3S', 0, 1, 365, 0),
(124, '457BF-XVI2E-YBLAU-85TB7', 0, 1, 365, 0),
(125, 'AQRP4-60P9Y-FNR8T-K8QJV', 0, 1, 365, 0),
(126, 'SPFJZ-UU2YC-MD9Z4-Z1X6U', 0, 1, 365, 0),
(127, 'TX4FR-7SOEG-K3VW9-MR98R', 0, 1, 365, 0),
(128, '5RBFM-4U5BK-OVRS6-1415O', 0, 1, 365, 0),
(129, 'X0Z6C-YGLVK-ZBP1C-DC5X6', 0, 1, 365, 0),
(130, 'Y2KR3-JMKVR-WJUHR-56W1F', 0, 1, 365, 0),
(131, 'EQ3RM-7S6G1-E3ZFU-JS5FX', 0, 1, 365, 0),
(132, 'ZC095-SW0DP-04ARL-3X8KU', 0, 1, 365, 0),
(133, 'XS9WD-OH6VM-M7HTH-WT0GQ', 0, 1, 365, 0),
(134, 'ZEBPJ-OHAM4-RESFH-K5TIP', 0, 1, 365, 0),
(135, 'BZ6BC-5CDV3-CCXY1-66HQC', 0, 1, 365, 0),
(136, 'OWAT0-Y23BT-W3574-CLDLQ', 0, 1, 365, 0),
(137, 'A1NTA-D4I65-DA3K8-4MC1I', 0, 1, 365, 0),
(138, 'UOODC-BG77H-7Z2VA-6ZPKP', 0, 1, 365, 0),
(139, 'KPD4X-3JBLL-ESQFT-IWB4Z', 0, 1, 365, 0),
(140, '7G738-KCE2V-ESC4Q-S3I7D', 0, 1, 365, 0),
(141, 'YQ4Y0-2CJU5-7LKAK-3S5QH', 0, 1, 365, 0),
(142, 'JYMRH-FIDNS-9AOR7-ZOK8G', 0, 1, 365, 0),
(143, '6WN4B-0AYPL-JGDV6-LZLMT', 0, 1, 365, 0),
(144, 'LXO3S-NOWPX-H7VIG-HGLEP', 0, 1, 365, 0),
(145, 'ZXOBL-P5BVN-44WZH-S9EJP', 0, 1, 365, 0),
(146, '365VY-ZNRX2-WBN48-16DHW', 0, 1, 365, 0),
(147, '4K0BK-VNB41-RDVA5-EEC7V', 0, 1, 365, 0),
(148, 'TERTP-74N5X-6CRC9-EMN7R', 0, 1, 365, 0),
(149, 'CKCW0-AJS8K-5W2MZ-645F4', 0, 1, 365, 0),
(150, 'HD9OR-0WC2B-42YYB-BJ6B2', 0, 1, 365, 0),
(151, 'FOGRO-PLFWZ-2H7OQ-W5KW5', 0, 1, 1825, 0),
(152, 'VUF8X-7OLGX-G7ZO5-JOOLJ', 0, 1, 1825, 0),
(153, '2O3PA-VJZXZ-9U283-AADER', 0, 1, 1825, 0),
(154, 'QJZ8Y-J851J-YIM9I-SRXRX', 0, 1, 1825, 0),
(155, '2A0FM-J580D-HSD1V-499NO', 0, 1, 1825, 0),
(156, 'S8OEJ-PARLV-CSKG5-VJOK1', 0, 1, 1825, 0),
(157, '49YPE-F5WYV-H1WUS-4T1GM', 0, 1, 1825, 0),
(158, 'TOAHG-IN6UP-DPM1T-ITOSJ', 0, 1, 1825, 0),
(159, '1COBE-BARH8-ZCEDM-2PFJD', 0, 1, 1825, 0),
(160, 'JMJ9G-O15KS-T2HP8-F9N58', 0, 1, 1825, 0),
(161, 'JBWYD-XCJC8-SGLE3-OP6MP', 0, 1, 1825, 0),
(162, 'QS7GB-Y6GIV-ELY96-FPDEV', 0, 1, 1825, 0),
(163, 'DWEE1-20ZAK-L49OZ-QI2HB', 0, 1, 1825, 0),
(164, '4Y0UQ-3UREO-V2QFE-7ULB6', 0, 1, 1825, 0),
(165, 'AUYE5-F4V21-634XZ-YWSV0', 0, 1, 1825, 0),
(166, 'IVP5I-VSW0Z-08MZN-KF1MW', 0, 1, 1825, 0),
(167, '1W8PI-RCYGD-A3YXW-4N5JH', 0, 1, 1825, 0),
(168, 'K915D-ZRL3J-JTCMO-78H3T', 0, 1, 1825, 0),
(169, 'DT22T-VHY5B-OXIFH-YGV8I', 0, 1, 1825, 0),
(170, '4WSK1-8ILD2-7KN58-X0OGO', 0, 1, 1825, 0),
(171, '1D68T-G9MYN-2BI5F-84QPU', 0, 1, 1825, 0),
(172, 'VJO6B-CRNLD-R9AA2-FIDG6', 0, 1, 1825, 0),
(173, 'SAAYA-AGQK3-9ZQWJ-ODFO9', 0, 1, 1825, 0),
(174, 'KXHPX-3BIK5-ZM1SW-IGAU5', 0, 1, 1825, 0),
(175, 'EB7ZZ-3S1SD-YQWDK-1YRXG', 0, 1, 1825, 0),
(176, 'ZSXXM-6VXY5-MFLFI-VL7EA', 0, 1, 3650, 0),
(177, 'K7M2M-O09CB-X9SB8-3MG77', 0, 1, 3650, 0),
(178, 'VWRK6-E7ML6-EEQWN-BPVUC', 0, 1, 3650, 0),
(179, '3QBYZ-QW5YL-XD5JA-L4999', 0, 1, 3650, 0),
(180, 'Y0RDA-H2E6X-2A802-JJ0Y3', 0, 1, 3650, 0),
(181, 'PL1ES-16HF0-PRPQH-97YUD', 0, 1, 3650, 0),
(182, '0UM4Q-77ZH6-DWSHI-BTEG9', 0, 1, 3650, 0),
(183, '4LJ5T-BLZH9-088OL-UM8PA', 0, 1, 3650, 0),
(184, 'S76KA-9C48N-3W73P-EBS3L', 0, 1, 3650, 0),
(185, '5HJYT-CXFV5-KHG3C-44WKR', 0, 1, 3650, 0);

-- --------------------------------------------------------

--
-- Table structure for table `oldbills`
--

CREATE TABLE IF NOT EXISTS `oldbills` (
  `idOldBills` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(45) NOT NULL,
  `caddress` varchar(45) NOT NULL,
  `companyName` varchar(45) NOT NULL,
  `companyAddress` varchar(45) NOT NULL,
  `companyPhone` varchar(45) NOT NULL,
  `billType` varchar(45) NOT NULL,
  `meterNumber` int(11) NOT NULL,
  `previousReading` varchar(45) NOT NULL,
  `oldReadTime` datetime NOT NULL,
  `currentReading` varchar(45) NOT NULL,
  `newReadTime` datetime NOT NULL,
  `energyUsed` varchar(45) NOT NULL,
  `unitPrice` varchar(45) NOT NULL,
  `charges` varchar(45) NOT NULL,
  `idBillingHistory1` int(11) NOT NULL,
  `idBillingHistory2` int(11) NOT NULL,
  `pair` varchar(45) NOT NULL,
  `idBill1` int(11) NOT NULL,
  `idBill2` int(11) NOT NULL,
  `timeStamp` datetime NOT NULL,
  `idUser` varchar(45) NOT NULL,
  `billingHistoryDate1` datetime NOT NULL,
  `billingHistoryDate2` datetime NOT NULL,
  `deletedFromPrimaryTables` int(11) NOT NULL DEFAULT '0',
  `dateDeletedFromPrimaryTables` datetime NOT NULL,
  `fileName` varchar(45) NOT NULL,
  `idCompany` int(11) NOT NULL,
  `idBillTitle` int(11) NOT NULL,
  PRIMARY KEY (`idOldBills`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `truncatehistory`
--

CREATE TABLE IF NOT EXISTS `truncatehistory` (
  `idTruncateHistory` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `table` varchar(45) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `truncate` int(11) NOT NULL,
  `undo` int(11) NOT NULL DEFAULT '0',
  `idBillGenerationHistory` varchar(2000) NOT NULL,
  PRIMARY KEY (`idTruncateHistory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contactNumber` varchar(45) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `lastLogin` datetime DEFAULT NULL,
  `licenseExpiryDate` varchar(200) NOT NULL DEFAULT '2015-07-04 00:00:00',
  `accessLevel` int(11) NOT NULL DEFAULT '10',
  `idCompany` int(11) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `userName`, `email`, `contactNumber`, `password`, `isActive`, `lastLogin`, `licenseExpiryDate`, `accessLevel`, `idCompany`) VALUES
(1, 'admin', 'say2moiz@gmail.com', '+923333858767', '9694f4d62f6841ac7ad1fac67416350b', 1, '2015-07-11 01:01:56', '2015-07-04 00:00:00', 1000, 2),
(2, 'mumshaad', 'jaw_maxy@hotmail.com', '+971 50 417 5961', '3476a31daaea93798d47d73d9e1bb4b3', 1, '2015-07-10 12:33:34', '2015-07-04 00:00:00', 1000, 2),
(3, 'user', 'test@test.com', '+92123456789', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2015-07-11 02:27:05', '2015-07-04 00:00:00', 10, 1),
(4, 'superuser', 'test@superuser.com', '+92123456778', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2015-07-11 02:29:36', '2016-03-05 08:00:17', 100, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
";
?>