-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 14, 2023 at 09:32 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminmns_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `declaration`
--

DROP TABLE IF EXISTS `declaration`;
CREATE TABLE IF NOT EXISTS `declaration` (
  `declarationId` int NOT NULL AUTO_INCREMENT,
  `declarationDate` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `declarationLate` tinyint(1) DEFAULT NULL,
  `evenementDate` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descriptif` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `id` int NOT NULL,
  `userId` int NOT NULL,
  PRIMARY KEY (`declarationId`),
  KEY `id` (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `necessite`
--

DROP TABLE IF EXISTS `necessite`;
CREATE TABLE IF NOT EXISTS `necessite` (
  `typeId` int NOT NULL,
  `formationId` int NOT NULL,
  PRIMARY KEY (`typeId`,`formationId`),
  KEY `formationId` (`formationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

DROP TABLE IF EXISTS `tblclass`;
CREATE TABLE IF NOT EXISTS `tblclass` (
  `classId` int NOT NULL AUTO_INCREMENT,
  `className` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `classDesc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `archived` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`classId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`classId`, `className`, `classDesc`, `archived`) VALUES
(3, 'Dev 2666', 'Dev Web et Web Mobile', 0),
(4, 'Dev 3', 'Dev Web & Web Mobile', 0),
(5, 'Dev 4', 'Dev Web et Web Mobile', 0),
(6, 'Dev 5', 'Dev Web et Web Mobile', 0),
(8, 'Dev 23', 'Dev Web et Web Mobile', 0),
(9, 'test', 'test', 0),
(10, 'test4', 'test4', 0),
(11, 'test 12', '43', 0),
(12, 'dev test', 'testtestetesttesttestetesttesttestetesttesttestete', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbldocument`
--

DROP TABLE IF EXISTS `tbldocument`;
CREATE TABLE IF NOT EXISTS `tbldocument` (
  `documentId` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `documentDate` date DEFAULT NULL,
  `documentName` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `documentBool` tinyint(1) DEFAULT NULL,
  `controlDate` date DEFAULT NULL,
  `motifRefus` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `declarationId` int DEFAULT NULL,
  `typeId` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `userId1` int NOT NULL,
  PRIMARY KEY (`documentId`),
  KEY `declarationId` (`declarationId`),
  KEY `typeId` (`typeId`),
  KEY `userId` (`userId`),
  KEY `userId1` (`userId1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblformation`
--

DROP TABLE IF EXISTS `tblformation`;
CREATE TABLE IF NOT EXISTS `tblformation` (
  `formationId` int NOT NULL AUTO_INCREMENT,
  `formationLabel` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dateStart` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dateEnd` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`formationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblrole`
--

DROP TABLE IF EXISTS `tblrole`;
CREATE TABLE IF NOT EXISTS `tblrole` (
  `userId` int NOT NULL,
  `role_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblrole`
--

INSERT INTO `tblrole` (`userId`, `role_user`, `role`) VALUES
(14, '', ''),
(15, '', 'admin'),
(0, '', 'user'),
(16, '', 'super_admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `userMail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userPwd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userSurname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userAge` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userInscription` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userPhone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userImage` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userCp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userCity` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userStreet` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userNumero` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `classId` int DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`userId`),
  KEY `classId` (`classId`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userId`, `userMail`, `userPwd`, `userSurname`, `userName`, `userAge`, `userInscription`, `userPhone`, `userImage`, `userCp`, `userCity`, `userStreet`, `userNumero`, `classId`, `role`) VALUES
(14, 'superadmin@mail.com', '$2y$10$BV.ITO6oYMy3wq8oUiZxMuedSJ0t0XQVNUB.vF.zFOi', 'Super', 'Admin', '100', NULL, '1111111111', NULL, '57000', 'Super Admin', 'Super Admin', NULL, 3, 'super_admin'),
(17, 'admin@mail.com', '$2y$10$BV.ITO6oYMy3wq8oUiZxMuedSJ0t0XQVNUB.vF.zFOi', 'Simple', 'Admin', '90', NULL, '999999999', NULL, '57000', 'Admin', 'Admin', NULL, 3, 'admin'),
(19, 'user@mail.com', '$2y$10$BV.ITO6oYMy3wq8oUiZxMuedSJ0t0XQVNUB.vF.zFOi', 'New', 'User', '10', NULL, '222222222', NULL, '57000', 'User', 'User', NULL, 4, 'user'),
(31, 'admin2@mail.com', '$2y$10$FB8wMQt6MbcRLn/UIZbzB.kZb4XoPsItgLWSNN/jgG3', 'Simple 2', 'Admin 2', '30', NULL, '33333333333', NULL, '57000', 'Ville', 'Voie', NULL, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `type_piece`
--

DROP TABLE IF EXISTS `type_piece`;
CREATE TABLE IF NOT EXISTS `type_piece` (
  `typeId` int NOT NULL AUTO_INCREMENT,
  `typePieceLabel` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`typeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_retard_absence`
--

DROP TABLE IF EXISTS `type_retard_absence`;
CREATE TABLE IF NOT EXISTS `type_retard_absence` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD CONSTRAINT `fk_classId` FOREIGN KEY (`classId`) REFERENCES `tblclass` (`classId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
