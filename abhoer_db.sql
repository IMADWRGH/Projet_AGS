-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2022 at 05:13 AM
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
  `EQUIPEMENT` int(11) NOT NULL
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
  `AUTRE_FICHERS` int(11) NOT NULL
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
  `COMMONTAIRE` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `ID_FILIERE` char(10) NOT NULL,
  `NOM_FILIERE` char(50) NOT NULL,
  `CHEF_FILIERE` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hr_presence`
--

CREATE TABLE `hr_presence` (
  `ID_PRESENCE` char(10) NOT NULL,
  `DATE` date NOT NULL,
  `HR_ENTRE_M` time NOT NULL,
  `HR_SORTIE_M` time NOT NULL,
  `HR_ENTRE_A` time NOT NULL,
  `HR_SORTIE_A` time NOT NULL,
  `OBSERVATION` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hr_presence`
--

INSERT INTO `hr_presence` (`ID_PRESENCE`, `DATE`, `HR_ENTRE_M`, `HR_SORTIE_M`, `HR_ENTRE_A`, `HR_SORTIE_A`, `OBSERVATION`) VALUES
('P1', '2022-08-25', '08:35:15', '12:59:59', '14:00:00', '16:12:01', 'tttt');

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `ID_STAGE` int(10) NOT NULL,
  `DATE_D` date NOT NULL,
  `DATE_F` date NOT NULL,
  `ENCADRENT` char(50) NOT NULL,
  `DEP` char(50) NOT NULL,
  `ID_STAGIAIRE` char(10) NOT NULL,
  `ID_PRESENCE` char(10) NOT NULL,
  `ID_FILIERE` char(10) NOT NULL,
  `ID_EVALUATION` char(10) NOT NULL,
  `ID_DOSSIER` char(10) NOT NULL,
  `ID_CONTINATION` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`ID_STAGE`, `DATE_D`, `DATE_F`, `ENCADRENT`, `DEP`, `ID_STAGIAIRE`, `ID_PRESENCE`, `ID_FILIERE`, `ID_EVALUATION`, `ID_DOSSIER`, `ID_CONTINATION`) VALUES
(1, '2022-08-01', '2022-08-31', 'Khaled', 'IT', 'ST1', 'P1', 'F1', 'E1', 'D1', 'C1');

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
  `NIVEAU` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stagiaire`
--

INSERT INTO `stagiaire` (`ID_STAGIAIRE`, `CIN`, `NOM`, `PRENOM`, `SEXE`, `TEL`, `EMAIL`, `VILLE`, `ADRESSE`, `ETABLISSEMENT`, `NIVEAU`) VALUES
('ST1', 'IA111222', 'MBARKI', 'BIO', 'M', '0611223344', 'test@test.com', 'BENI MELLAL', 'TAGZIRT', 'ECOSIG', 'BAC+2');

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
  ADD PRIMARY KEY (`ID_CONTINATION`);

--
-- Indexes for table `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`ID_DOSSIER`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`ID_EVALUATION`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`ID_FILIERE`);

--
-- Indexes for table `hr_presence`
--
ALTER TABLE `hr_presence`
  ADD PRIMARY KEY (`ID_PRESENCE`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`ID_STAGE`),
  ADD KEY `ID_STAGIAIRE` (`ID_STAGIAIRE`),
  ADD KEY `ID_PRESENSE` (`ID_PRESENCE`),
  ADD KEY `ID_FILIERE` (`ID_FILIERE`),
  ADD KEY `ID_EVALUATION` (`ID_EVALUATION`),
  ADD KEY `ID_DOSSIER` (`ID_DOSSIER`),
  ADD KEY `ID_CONTINATION` (`ID_CONTINATION`);

--
-- Indexes for table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`ID_STAGIAIRE`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `ID_STAGE` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contination`
--
ALTER TABLE `contination`
  ADD CONSTRAINT `contination_ibfk_1` FOREIGN KEY (`ID_CONTINATION`) REFERENCES `stage` (`ID_CONTINATION`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `dossier_ibfk_1` FOREIGN KEY (`ID_DOSSIER`) REFERENCES `stage` (`ID_DOSSIER`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`ID_EVALUATION`) REFERENCES `stage` (`ID_EVALUATION`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`ID_FILIERE`) REFERENCES `stage` (`ID_FILIERE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hr_presence`
--
ALTER TABLE `hr_presence`
  ADD CONSTRAINT `hr_presence_ibfk_1` FOREIGN KEY (`ID_PRESENCE`) REFERENCES `stage` (`ID_PRESENCE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `stagiaire_ibfk_1` FOREIGN KEY (`ID_STAGIAIRE`) REFERENCES `stage` (`ID_STAGIAIRE`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
