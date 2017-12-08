-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 04, 2016 at 06:41 pm
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_materiel`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id_a` int(11) NOT NULL,
  `matricule` varchar(8) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `service` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`id_a`, `matricule`, `nom`, `prenom`, `service`, `email`, `motdepasse`, `admin`) VALUES
(10, 'cD147', 'Someone', 'Salma', 'Gestion des flux et planification', 'salma.s@hotmail.fr', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0),
(12, 'HD1478', 'Taik', 'Afaf', 'Informatique', 'afaf@gmail.com', '47712274726432508e4279ac1c22695327722ccb', 1);

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

CREATE TABLE `demande` (
  `id_d` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `materiel` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `pending` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demande`
--

INSERT INTO `demande` (`id_d`, `service`, `materiel`, `description`, `pending`) VALUES
(2, 'Informatique', 'Serveur', 'Linux ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id_f` int(11) NOT NULL,
  `nom_f` varchar(255) NOT NULL,
  `ville_f` varchar(255) NOT NULL,
  `tel_f` varchar(25) NOT NULL,
  `email_f` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`id_f`, `nom_f`, `ville_f`, `tel_f`, `email_f`) VALUES
(1, 'HP', 'Rabat', '0523854714', 'hp.support@gmail.com'),
(2, 'Cimat', 'HadSwalem', '0534419864', 'cimat-maroc@gmail.com'),
(3, 'Cisco', 'Casablance', '0528241417', 'cisco.net@hotmail.com'),
(4, 'Linux', 'Casablanca', '0521417478', 'linux-servers@homail.fr');

-- --------------------------------------------------------

--
-- Table structure for table `historique_agent`
--

CREATE TABLE `historique_agent` (
  `id_ha` int(11) NOT NULL,
  `matricule` varchar(8) NOT NULL,
  `service` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_depart` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `historique_materiel`
--

CREATE TABLE `historique_materiel` (
  `id_h` int(11) NOT NULL,
  `numserie` int(11) NOT NULL,
  `eqp` int(11) NOT NULL,
  `prix_achat` float NOT NULL,
  `facon_h` int(11) DEFAULT NULL,
  `prix_vente` float DEFAULT NULL,
  `date_h` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `materiel`
--

CREATE TABLE `materiel` (
  `id_m` int(11) NOT NULL,
  `numserie` varchar(75) NOT NULL,
  `eqp` varchar(75) NOT NULL,
  `prix` float NOT NULL,
  `date_achat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duree_garantie` int(7) NOT NULL,
  `service` varchar(75) NOT NULL,
  `fournisseur` varchar(75) NOT NULL,
  `id_demande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materiel`
--

INSERT INTO `materiel` (`id_m`, `numserie`, `eqp`, `prix`, `date_achat`, `duree_garantie`, `service`, `fournisseur`, `id_demande`) VALUES
(1, 'XcF123K', 'Imprimante', 2000, '2016-08-26 12:08:27', 15, 'RH', 'HP', 0),
(3, 'tDfgH125', 'Serveur', 120000, '2016-09-03 13:06:40', 15, 'Informatique', 'Linux', 2),
(4, '123456', 'camion', 60000, '2016-09-04 12:30:03', 24, 'Ateliers centraux/Garage', 'afaf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reclamation`
--

CREATE TABLE `reclamation` (
  `id_r` int(13) NOT NULL,
  `numserie` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Service`
--

CREATE TABLE `Service` (
  `Nom_service` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Service`
--

INSERT INTO `Service` (`Nom_service`, `id`) VALUES
('Ateliers centraux/Garage', 1),
('Comptabilité', 2),
('Controle materiel', 3),
('Developpement durable', 4),
('Eau et STEP', 5),
('Extraction', 6),
('GC et preservation du patrimoine', 7),
('Gestion', 8),
('Gestion des flux et planification', 9),
('Informatique', 10),
('Laboratoire', 11),
('Pipeline et logistique', 12),
('Qualite et securite', 13),
('Reseau electrique', 14),
('Ressources humaines', 15),
('SOTREG', 16),
('Support', 17),
('Telecom', 18),
('Traitement', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id_a`);

--
-- Indexes for table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id_d`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id_f`);

--
-- Indexes for table `historique_agent`
--
ALTER TABLE `historique_agent`
  ADD PRIMARY KEY (`id_ha`);

--
-- Indexes for table `historique_materiel`
--
ALTER TABLE `historique_materiel`
  ADD PRIMARY KEY (`id_h`);

--
-- Indexes for table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id_m`);

--
-- Indexes for table `Service`
--
ALTER TABLE `Service`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `historique_agent`
--
ALTER TABLE `historique_agent`
  MODIFY `id_ha` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `historique_materiel`
--
ALTER TABLE `historique_materiel`
  MODIFY `id_h` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Service`
--
ALTER TABLE `Service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
