-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 01:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion`
--

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_prof` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `statut` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id_prof`, `password`, `username`, `statut`) VALUES
(1, 'test201', 'Moyou', '0');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `matricule` varchar(7) NOT NULL,
  `noms` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`matricule`, `noms`) VALUES
('21Q2523', 'Alban Happi'),
('21Q2531', 'Jean Therese');

-- --------------------------------------------------------

--
-- Table structure for table `ue`
--

CREATE TABLE `ue` (
  `id_ue` varchar(20) NOT NULL,
  `niveau` varchar(20) NOT NULL,
  `statut` enum('0','1') NOT NULL,
  `id_prof` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ue`
--

INSERT INTO `ue` (`id_ue`, `niveau`, `statut`, `id_prof`) VALUES
('ICT201', '2', '1', 1),
('ICT313', '3', '1', 1),
('INF248', '1', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `uejoinetudiant`
--

CREATE TABLE `uejoinetudiant` (
  `id_ue` varchar(20) NOT NULL,
  `matricule` varchar(7) NOT NULL,
  `cc` int(2) NOT NULL,
  `tp` int(2) NOT NULL,
  `ee` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uejoinetudiant`
--

INSERT INTO `uejoinetudiant` (`id_ue`, `matricule`, `cc`, `tp`, `ee`) VALUES
('ICT201', '21Q2523', 20, 20, 20),
('ICT201', '21Q2531', 20, 20, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_prof`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`matricule`);

--
-- Indexes for table `ue`
--
ALTER TABLE `ue`
  ADD PRIMARY KEY (`id_ue`),
  ADD KEY `id_prof` (`id_prof`);

--
-- Indexes for table `uejoinetudiant`
--
ALTER TABLE `uejoinetudiant`
  ADD KEY `id_ue` (`id_ue`),
  ADD KEY `matricule` (`matricule`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_prof` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ue`
--
ALTER TABLE `ue`
  ADD CONSTRAINT `ue_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `enseignant` (`id_prof`);

--
-- Constraints for table `uejoinetudiant`
--
ALTER TABLE `uejoinetudiant`
  ADD CONSTRAINT `uejoinetudiant_ibfk_1` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`),
  ADD CONSTRAINT `uejoinetudiant_ibfk_2` FOREIGN KEY (`matricule`) REFERENCES `etudiant` (`matricule`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
