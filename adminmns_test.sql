-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2023 at 09:12 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`classId`, `className`, `classDesc`, `archived`) VALUES
(3, 'Dev 2', 'Dev Web et Web Mobile', 0),
(4, 'Dev 3', 'Dev Web & Web Mobile', 0),
(5, 'Dev 4', 'Dev Web et Web Mobile', 0),
(6, 'Dev 5', 'Dev Web et Web Mobile', 0),
(8, 'Dev 23', 'Dev Web et Web Mobile', 0),
(9, 'test', 'test', 0),
(10, 'test4', 'test4', 0),
(11, 'test 5', '43', 0);

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
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblrole`
--

INSERT INTO `tblrole` (`userId`, `role_user`, `role`) VALUES
(14, '', 'super_admin'),
(15, '', 'administration');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userId`, `userMail`, `userPwd`, `userSurname`, `userName`, `userAge`, `userInscription`, `userPhone`, `userImage`, `userCp`, `userCity`, `userStreet`, `userNumero`, `classId`, `role`) VALUES
(14, 'superadmin@admin.fr', NULL, 'Suuper', 'Admin', '100', NULL, '0000000000', NULL, '57000', 'admin city', 'admin street', NULL, 4, 'super_admin'),
(17, 'agnes.yoann@gmail.com', '$2y$10$2LXItZ8/vEEMrsGIW6cEtuf3H6shU4s/RbvIh/IyqER', 'Agnes', 'Yoann', '22', NULL, '0781547774', NULL, '57300', 'Hagondange', '15 Rue Hemingway', NULL, 3, ''),
(19, 'test@mail.fr', '$2y$10$yRTfroN2i5se00k9rcBGJerxEHsSJSheAhPL63Ffl7a', 'Noob', 'User', '32', NULL, '3232', NULL, '3232', 'testtest@mail.fr', 'testtest@mail.fr', NULL, 4, ''),
(22, 'Noob2@n.fr', '$2y$10$dmJyLfJugk3mMmpzleggn.gUYjRBIrm9hPeoZ9GvY73', 'Noon2', 'User2', '22', NULL, '2222222222222222', NULL, '22222', 'noob vil', 'noob voi', NULL, 3, ''),
(23, 'testcacacacatest@testcacacacatest.fr', '$2y$10$qGKd55FBx7JYRVWGf1glKe6lOTSGnDnx4U3I.fGVdPi', 'ewqewq', 'eqweqw', '23', NULL, '3232323232', NULL, 'eqwewq', 'ewqeqw', 'ewqewq', NULL, 3, ''),
(24, 'testENCOREtest@mail.fr', '$2y$10$XgGpbSACSj.DfNBhrdtiEu9usiDa2F.ALAvy.cJLDdT', 'testEnc', 'EncoreTest', '23', NULL, '2232323', NULL, '312321', 'ewreqw', 'eqw', NULL, 3, ''),
(25, 'finaltest@t.fr', '$2y$10$ZsUFjxriKtJ40YkaGs4I1O8Ocw9wJctBVWCJSasHxDv', 'final', 'test', '33', NULL, '3333', NULL, '32133', 'ewqe', 'ewqef', NULL, 10, ''),
(26, 'testcacacacatest@testcacacacatest.fr', '$2y$10$zqLxMsXVjn8QJIeWM1eAV.mXOqaUOeygb5H19xmF05o', 'testcacacacatest', 'testcacacacatest', '123', NULL, '213', NULL, '321', 'dsa', 'dsa', NULL, 3, '');

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
