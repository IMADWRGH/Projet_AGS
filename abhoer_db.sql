-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2022 at 12:31 AM
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
-- Table structure for table `dossier`
--

CREATE TABLE `dossier` (
  `ID_DOSSIER` char(10) NOT NULL,
  `CV` int(11) NOT NULL,
  `PHOTO` int(11) NOT NULL,
  `DEMANDE` int(11) NOT NULL,
  `ASSURANCE` int(11) NOT NULL,
  `COPY_CIN` int(11) NOT NULL,
  `DATE_DEPOSE` date NOT NULL,
  `STATUT` char(15) NOT NULL,
  `AUTRE_FICHERS` int(11) NOT NULL,
  `ID_STAGE` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('P10', '2022-08-28', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '', 'T1', '2022-08-29 02:47:18', '2022-08-29 20:31:22'),
('P11', '2022-08-29', '17:01:00', '00:00:00', '00:00:00', '00:00:00', '', 'T1', '2022-08-29 16:02:00', '2022-08-29 17:02:00'),
('P12', '2022-08-29', '17:03:00', '00:00:00', '00:00:00', '00:00:00', '', 'T1', '2022-08-29 16:03:42', '2022-08-29 17:03:42'),
('P13', '2022-08-29', '19:41:00', '00:00:00', '00:00:00', '00:00:00', '', 'T1', '2022-08-29 18:41:49', '2022-08-29 19:41:49'),
('P14', '2022-08-29', '19:44:00', '00:00:00', '00:00:00', '00:00:00', '', 'T1', '2022-08-29 18:44:16', '2022-08-29 19:44:16'),
('P15', '2022-08-29', '19:50:00', '00:00:00', '00:00:00', '00:00:00', '', 'T2', '2022-08-29 18:47:14', '2022-08-29 19:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `ID_STAGE` char(10) NOT NULL,
  `DATE_D` date NOT NULL,
  `DATE_F` date NOT NULL,
  `ENCADRENT` char(50) NOT NULL,
  `DEP` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`ID_STAGE`, `DATE_D`, `DATE_F`, `ENCADRENT`, `DEP`) VALUES
('T1', '2022-08-01', '2022-08-31', 'Khaled', 'IT'),
('T2', '2022-08-01', '2022-09-30', 'achraf', 'DPH');

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
('S2', 'I333222', 'TAFU', 'OMAR', 'F', '0622334455', 'imar@omar.com', 'AGADIR', 'AOURIR', 'ISTA', 'BAC+2', 'T2');

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
  ADD PRIMARY KEY (`ID_STAGE`);

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
