-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2022 at 07:43 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abhoer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contination`
--

CREATE TABLE `contination` (
  `ID_CONTINATION` char(10) NOT NULL,
  `TACHES` varchar(100) NOT NULL,
  `ABSENCES` smallint(6) DEFAULT NULL,
  `TEMPS_DEPLOYE` smallint(6) DEFAULT NULL,
  `EQUIPEMENT` int(11) NOT NULL,
  `ID_STAGE` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `ID_DEPARTEMENT` char(10) NOT NULL,
  `NOM` varchar(30) NOT NULL,
  `CHEF` varchar(30) NOT NULL,
  `ETAT` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`ID_DEPARTEMENT`, `NOM`, `CHEF`, `ETAT`) VALUES
('DP1', 'IT', 'KHALED', 1),
('DP2', 'DPH', 'KAMAL', 1),
('DP3', 'RH', 'ASMA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dossier`
--

CREATE TABLE `dossier` (
  `ID_DOSSIER` char(10) NOT NULL,
  `CV` char(20) DEFAULT NULL,
  `PHOTO` char(20) DEFAULT NULL,
  `DEMANDE` char(20) DEFAULT NULL,
  `ASSURANCE` char(20) DEFAULT NULL,
  `COPY_CIN` char(20) DEFAULT NULL,
  `DATE_DEPOSE` datetime NOT NULL,
  `STATUT` char(15) NOT NULL,
  `AUTRE_FICHERS` char(20) DEFAULT NULL,
  `ID_STAGE` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dossier`
--

INSERT INTO `dossier` (`ID_DOSSIER`, `CV`, `PHOTO`, `DEMANDE`, `ASSURANCE`, `COPY_CIN`, `DATE_DEPOSE`, `STATUT`, `AUTRE_FICHERS`, `ID_STAGE`) VALUES
('D1', NULL, NULL, NULL, NULL, NULL, '2022-09-01 07:00:26', 'accepté', NULL, 'T1'),
('D2', NULL, NULL, NULL, NULL, NULL, '2022-09-01 07:02:27', 'non traité', NULL, 'T2'),
('D3', 'CV_T3.svg', NULL, 'Demande_T3.svg', 'Assurance_T3.png', NULL, '2022-09-01 05:20:08', 'en attendant', NULL, 'T3');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `ID_EVALUATION` char(10) NOT NULL,
  `E1` char(10) NOT NULL,
  `E2` char(10) NOT NULL,
  `E3` char(10) NOT NULL,
  `E4` char(10) NOT NULL,
  `E5` char(10) NOT NULL,
  `E6` char(10) NOT NULL,
  `E7` char(10) NOT NULL,
  `E8` char(10) NOT NULL,
  `E9` char(10) NOT NULL,
  `E10` char(10) NOT NULL,
  `E11` char(10) NOT NULL,
  `E12` char(10) NOT NULL,
  `E13` char(10) NOT NULL,
  `COMMONTAIRE` char(255) NOT NULL,
  `ID_STAGE` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `ID_FILIERE` char(10) NOT NULL,
  `NOM_FILIERE` char(50) NOT NULL,
  `CHEF_FILIERE` char(50) NOT NULL,
  `ID_STAGE` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE `presence` (
  `ID_PRESENCE` char(10) NOT NULL,
  `DATE` date NOT NULL,
  `HR_ENTRE_M` time DEFAULT NULL,
  `HR_SORTIE_M` time DEFAULT NULL,
  `HR_ENTRE_A` time DEFAULT NULL,
  `HR_SORTIE_A` time DEFAULT NULL,
  `OBSERVATION` char(255) NOT NULL,
  `ID_STAGE` char(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`ID_PRESENCE`, `DATE`, `HR_ENTRE_M`, `HR_SORTIE_M`, `HR_ENTRE_A`, `HR_SORTIE_A`, `OBSERVATION`, `ID_STAGE`, `created_at`, `updated_at`) VALUES
('P1', '2022-08-29', '08:00:00', '12:00:00', '13:00:00', '17:17:00', '', 'T1', '2022-08-30 13:38:52', '2022-08-30 22:49:06'),
('P2', '2022-08-30', '16:44:00', '16:45:00', '16:48:00', '18:48:00', '', 'T2', '2022-08-30 13:44:37', '2022-08-30 17:10:58'),
('P3', '2022-08-30', '22:46:00', '22:47:00', '14:45:00', '22:47:00', '', 'T1', '2022-08-30 21:46:27', '2022-08-30 22:47:29'),
('P4', '2022-09-01', '06:35:00', '06:36:00', '06:42:00', NULL, '', 'T1', '2022-09-01 05:35:34', '2022-09-01 06:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `ID_STAGE` char(10) NOT NULL,
  `DATE_D` date NOT NULL,
  `DATE_F` date NOT NULL,
  `TYPE` char(30) DEFAULT NULL,
  `ENCADRENT` char(50) DEFAULT NULL,
  `ID_DEPARTEMENT` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`ID_STAGE`, `DATE_D`, `DATE_F`, `TYPE`, `ENCADRENT`, `ID_DEPARTEMENT`) VALUES
('T1', '2022-08-01', '2022-08-31', 'init', 'Khaled', 'DP1'),
('T2', '2022-08-01', '2022-09-30', 'app', 'achraf', 'DP2'),
('T3', '2022-09-01', '2022-09-30', 'pfe', NULL, 'DP3');

-- --------------------------------------------------------

--
-- Table structure for table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `ID_STAGIAIRE` char(10) NOT NULL,
  `CIN` char(10) NOT NULL,
  `NOM` varchar(30) NOT NULL,
  `PRENOM` varchar(30) NOT NULL,
  `SEXE` char(1) NOT NULL,
  `TEL` char(20) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `VILLE` varchar(30) NOT NULL,
  `ADRESSE` varchar(100) NOT NULL,
  `ETABLISSEMENT` char(100) NOT NULL,
  `NIVEAU` char(50) NOT NULL,
  `ID_STAGE` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stagiaire`
--

INSERT INTO `stagiaire` (`ID_STAGIAIRE`, `CIN`, `NOM`, `PRENOM`, `SEXE`, `TEL`, `EMAIL`, `VILLE`, `ADRESSE`, `ETABLISSEMENT`, `NIVEAU`, `ID_STAGE`) VALUES
('S1', 'IA111222', 'MBARKI', 'BIO', 'M', '0611223344', 'test@test.com', 'BENI MELLAL', 'TAGZIRT', 'ECOSIG', 'BAC+2', 'T1'),
('S2', 'I333222', 'TIFU', 'OMAR', 'F', '0622334455', 'imar@omar.com', 'AGADIR', 'AOURIR', 'ISTA', 'BAC+2', 'T2'),
('S3', 'IA1122', 'KHADIJA', 'HILALI', 'F', '0611223344', 'a@b.com', 'casa', 'CT02', 'FP', 'Bac+3', 'T3');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `USER_ID` char(10) NOT NULL,
  `USERNAME` char(20) NOT NULL,
  `PWD` varchar(20) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `ROLE` char(20) NOT NULL,
  `ETAT` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`USER_ID`, `USERNAME`, `PWD`, `EMAIL`, `ROLE`, `ETAT`) VALUES
('U1', 'Mustapha', '123', 'admin@admin.com', 'admin', 1),
('U2', 'Ali', '123', 'presense@presense.com', 'presense', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contination`
--
ALTER TABLE `contination`
  ADD PRIMARY KEY (`ID_CONTINATION`),
  ADD KEY `ID_STAGE` (`ID_STAGE`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`ID_DEPARTEMENT`);

--
-- Indexes for table `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`ID_DOSSIER`),
  ADD KEY `ID_STAGE` (`ID_STAGE`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`ID_EVALUATION`),
  ADD KEY `ID_STAGE` (`ID_STAGE`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`ID_FILIERE`),
  ADD KEY `ID_STAGE` (`ID_STAGE`);

--
-- Indexes for table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`ID_PRESENCE`),
  ADD KEY `ID_STAGE` (`ID_STAGE`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`ID_STAGE`),
  ADD KEY `ID_DEPARTEMENT` (`ID_DEPARTEMENT`);

--
-- Indexes for table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`ID_STAGIAIRE`),
  ADD KEY `ID_STAGE` (`ID_STAGE`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contination`
--
ALTER TABLE `contination`
  ADD CONSTRAINT `contination_ibfk_1` FOREIGN KEY (`ID_STAGE`) REFERENCES `stage` (`ID_STAGE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `dossier_ibfk_1` FOREIGN KEY (`ID_STAGE`) REFERENCES `stage` (`ID_STAGE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`ID_STAGE`) REFERENCES `stage` (`ID_STAGE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`ID_STAGE`) REFERENCES `stage` (`ID_STAGE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `presence_ibfk_1` FOREIGN KEY (`ID_STAGE`) REFERENCES `stage` (`ID_STAGE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `stagiaire_ibfk_1` FOREIGN KEY (`ID_STAGE`) REFERENCES `stage` (`ID_STAGE`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
