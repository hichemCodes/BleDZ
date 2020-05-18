-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2020 at 01:09 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_licence`
--

-- --------------------------------------------------------

--
-- Table structure for table `agriculteurs`
--

CREATE TABLE `agriculteurs` (
  `id` int(15) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `num_de_carte` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agriculteurs`
--

INSERT INTO `agriculteurs` (`id`, `nom`, `prenom`, `num_de_carte`, `avatar`, `user_id`) VALUES
(26, 'laouar', 'hichem', '123456', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `factures`
--

CREATE TABLE `factures` (
  `id` int(15) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `montant` float(10,2) NOT NULL,
  `recoltes_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `office_id` int(15) NOT NULL,
  `agriculteur_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `newslatter`
--

CREATE TABLE `newslatter` (
  `id` int(15) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newslatter`
--

INSERT INTO `newslatter` (`id`, `email`) VALUES
(12, 'laouarmedhichem23@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(15) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `num_telephone` varchar(255) DEFAULT NULL,
  `user_id` int(15) NOT NULL,
  `full_acces` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `nom`, `num_telephone`, `user_id`, `full_acces`) VALUES
(14, 'elhajar', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Option`
--

CREATE TABLE `Option` (
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(15) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `user_email`, `code`, `created_at`) VALUES
(1, 'laouarmedhichem23@gmail.com', 'ba065e13', '2020-04-15 17:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `prix_unitaire_A` float(10,2) NOT NULL,
  `prix_unitaire_B` float(10,2) DEFAULT NULL,
  `prix_unitaire_C` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`code`, `description`, `type`, `prix_unitaire_A`, `prix_unitaire_B`, `prix_unitaire_C`) VALUES
('p1', 'blé', 'terre', 22800.00, 21000.00, 19000.00);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(15) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `type`) VALUES
(1, 'office'),
(2, 'agriculteur');

-- --------------------------------------------------------

--
-- Table structure for table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `is_taken` tinyint(1) NOT NULL DEFAULT 0,
  `office_id` int(15) NOT NULL,
  `agriculteur_id` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id`, `date`, `is_taken`, `office_id`, `agriculteur_id`) VALUES
(1, '2020-04-28 14:00:00', 1, 14, 26);

-- --------------------------------------------------------

--
-- Table structure for table `récoltes`
--

CREATE TABLE `récoltes` (
  `id` int(15) NOT NULL,
  `agriculteur_id` int(15) NOT NULL,
  `produit_code` varchar(255) NOT NULL,
  `office_id` int(15) NOT NULL,
  `poids_entré` float(5,2) NOT NULL,
  `poids_sortie` float(5,2) NOT NULL,
  `Quantité` float(5,2) NOT NULL,
  `Qualité` varchar(255) NOT NULL,
  `montant` float(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `mot_de_passe_confirmation` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `wilaya_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `mot_de_passe`, `mot_de_passe_confirmation`, `is_verified`, `created_at`, `wilaya_id`, `profile_id`) VALUES
(1, 'elhajar@gmail.com', '$2y$10$dVDRNzqV1rBvWjyDt9jLUOVh5gyyMcbEJSF6epPY90IkBq3QpxpZO', '$2y$10$W1SmMAli2XrXrC9A24Q7wODdhYyJRsFKEmiKdipRdOxOJiP6SoGZ2', 1, '2020-04-26 22:56:21', 23, 1),
(2, 'laouarmedhichem23@gmail.com', '$2y$10$vHDDJvJurDXN05zDEJTSjucltyMTa4bS9WXNm0lE3O7qMR.hWkO3a', '$2y$10$kOFlUBo8jzhDkfdaCTAA.OZGyG04d7PVnO1i6SUkG8qxaqOe9ora6', 1, '2020-04-26 22:59:30', 23, 2);

-- --------------------------------------------------------

--
-- Table structure for table `véhicule`
--

CREATE TABLE `véhicule` (
  `matricule` bigint(15) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `nom_de_chauffeur` varchar(255) NOT NULL,
  `num_de_permis` bigint(15) NOT NULL,
  `récolte_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wilayas`
--

CREATE TABLE `wilayas` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wilayas`
--

INSERT INTO `wilayas` (`id`, `code`, `nom`) VALUES
(1, 1, 'Adrar'),
(2, 2, 'Chlef'),
(3, 3, 'Laghouat'),
(4, 4, 'Oum El Bouaghi'),
(5, 5, 'Batna'),
(6, 6, 'Béjaïa'),
(7, 7, 'Biskra'),
(8, 8, 'Béchar'),
(9, 9, 'Blida'),
(10, 10, 'Bouira'),
(11, 11, 'Tamanrasset'),
(12, 12, 'Tébessa'),
(13, 13, 'Tlemcen'),
(14, 14, 'Tiaret'),
(15, 15, 'Tizi Ouzou'),
(16, 16, 'Alger'),
(17, 17, 'Djelfa'),
(18, 18, 'Jijel'),
(19, 19, 'Sétif'),
(20, 20, 'Saïda'),
(21, 21, 'Skikda'),
(22, 22, 'Sidi Bel Abbès'),
(23, 23, 'Annaba'),
(24, 24, 'Guelma'),
(25, 25, 'Constantine'),
(26, 26, 'Médéa'),
(27, 27, 'Mostaganem'),
(28, 28, 'M\'Sila'),
(29, 29, 'Mascara'),
(30, 30, 'Ouargla'),
(31, 31, 'Oran'),
(32, 32, 'El Bayadh'),
(33, 33, 'Illizi'),
(34, 34, 'Bordj Bou Arreridj'),
(35, 35, 'Boumerdès'),
(36, 36, 'El Tarf'),
(37, 37, 'Tindouf'),
(38, 38, 'Tissemsilt'),
(39, 39, 'El Oued'),
(40, 40, 'Khenchela'),
(41, 41, 'Souk Ahras'),
(42, 42, 'Tipaza'),
(43, 43, 'Mila'),
(44, 44, 'Aïn Defla'),
(45, 45, 'Naâma'),
(46, 46, 'Aïn Témouchent'),
(47, 47, 'Ghardaïa'),
(48, 48, 'Relizane');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agriculteurs`
--
ALTER TABLE `agriculteurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_agriculteurs` (`user_id`);

--
-- Indexes for table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facture_office` (`office_id`),
  ADD KEY `fk_facture_agriculteur` (`agriculteur_id`);

--
-- Indexes for table `newslatter`
--
ALTER TABLE `newslatter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_offices` (`user_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rendezVous` (`office_id`),
  ADD KEY `fk_rendez_vous_2` (`agriculteur_id`);

--
-- Indexes for table `récoltes`
--
ALTER TABLE `récoltes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_one` (`agriculteur_id`),
  ADD KEY `fk_two` (`produit_code`),
  ADD KEY `fk_three` (`office_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users` (`wilaya_id`),
  ADD KEY `fk_profile` (`profile_id`);

--
-- Indexes for table `véhicule`
--
ALTER TABLE `véhicule`
  ADD KEY `fk_key` (`récolte_id`);

--
-- Indexes for table `wilayas`
--
ALTER TABLE `wilayas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agriculteurs`
--
ALTER TABLE `agriculteurs`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `newslatter`
--
ALTER TABLE `newslatter`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
