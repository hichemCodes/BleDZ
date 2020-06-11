-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2020 at 08:15 AM
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
(1, 'laouar', 'hichem', '123456', '5ed6c8d23d34a4.00611336.jpg', 2),
(2, 'laouar', 'mohamed', '475621', NULL, 4),
(3, 'zermi', 'kheireddine', '745856', NULL, 5),
(4, 'algeruser', 'user', '856236', NULL, 6),
(5, 'sasane', 'skander', '452362', NULL, 7),
(6, 'laouarr', 'hichem', '478569', NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `droit_d_accès`
--

CREATE TABLE `droit_d_accès` (
  `profil_id` int(15) NOT NULL,
  `code_option` varchar(255) NOT NULL,
  `accès` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `droit_d_accès`
--

INSERT INTO `droit_d_accès` (`profil_id`, `code_option`, `accès`) VALUES
(1, 'OP1', 'créer/modifier/valider'),
(2, 'OP1', 'créer/modifier'),
(1, 'OP2', 'ajouter/consulter/supprimer/annuler'),
(2, 'OP2', 'consulter/prendre/annuler'),
(1, 'OP3', 'ajouter/consulter'),
(2, 'OP3', 'consulter'),
(1, 'OP4', 'ajouter/consulter'),
(1, 'OP5', 'envoyer'),
(2, 'OP5', 'abonner/désabonner'),
(1, 'OP6', 'ajouter/modifier/consulter');

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

--
-- Dumping data for table `factures`
--

INSERT INTO `factures` (`id`, `date`, `montant`, `recoltes_id`, `office_id`, `agriculteur_id`) VALUES
(1, '2020-05-26 19:00:03', 27360.00, 'a:1:{i:0;s:1:\"1\";}', 1, 1),
(2, '2020-05-30 19:49:43', 13900.00, 'a:2:{i:0;s:1:\"2\";i:1;s:1:\"3\";}', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newslatter`
--

CREATE TABLE `newslatter` (
  `id` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newslatter`
--

INSERT INTO `newslatter` (`id`, `email`, `subscribed_at`) VALUES
(26, 'laouarmedhichem23@gmail.com', '2020-06-10 18:09:20'),
(27, 'skander@gmail.com', '2020-06-11 06:20:03');

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
(1, 'elhadjar', '0654153065', 1, 1),
(2, 'elbouni', NULL, 3, 1),
(3, 'berrahal', NULL, 9, 0),
(4, 'BabElOued', NULL, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Option`
--

CREATE TABLE `Option` (
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Option`
--

INSERT INTO `Option` (`code`, `description`) VALUES
('OP1', 'les comptes'),
('OP2', 'les rendez-vous'),
('OP3', 'les récoltes'),
('OP4', 'les factures'),
('OP5', 'les newslatter'),
('OP6', 'les produits');

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
(1, 'laouarmedhichem23@gmail.com', '11ce3b8d', '2020-06-03 02:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix_unitaire_A` float(10,2) NOT NULL,
  `prix_unitaire_B` float(10,2) DEFAULT NULL,
  `prix_unitaire_C` float(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`code`, `description`, `prix_unitaire_A`, `prix_unitaire_B`, `prix_unitaire_C`, `created_at`) VALUES
('p1', 'blé', 22800.00, 21000.00, 19000.00, '2020-04-28 20:56:42'),
('p2', 'pomme de terre', 35000.00, 32000.00, 30000.00, '2020-05-15 17:21:33');

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

--
-- Dumping data for table `récoltes`
--

INSERT INTO `récoltes` (`id`, `agriculteur_id`, `produit_code`, `office_id`, `poids_entré`, `poids_sortie`, `Quantité`, `Qualité`, `montant`, `date`) VALUES
(1, 1, 'p1', 1, 1.50, 0.30, 1.20, 'A', 27360.00, '2020-05-28 18:51:18'),
(2, 1, 'p1', 1, 1.20, 0.80, 0.40, 'C', 7600.00, '2020-04-18 18:54:14'),
(3, 3, 'p1', 1, 1.60, 1.30, 0.30, 'B', 6300.00, '2020-05-26 18:56:17'),
(4, 2, 'p1', 1, 1.20, 0.60, 0.60, 'C', 11400.00, '2020-05-30 00:53:03'),
(5, 3, 'p1', 2, 1.30, 0.20, 1.10, 'B', 23100.00, '2020-04-14 14:11:44'),
(6, 1, 'p1', 2, 0.60, 0.10, 0.50, 'B', 10500.00, '2020-06-07 08:41:18'),
(7, 3, 'p1', 1, 1.20, 0.40, 0.80, 'B', 16800.00, '2020-06-10 14:09:31'),
(8, 2, 'p1', 2, 1.00, 0.50, 0.50, 'A', 13680.00, '2020-06-10 14:15:42'),
(9, 2, 'p1', 2, 1.30, 0.20, 1.10, 'B', 23100.00, '2020-04-23 14:20:04'),
(10, 3, 'p1', 2, 1.20, 0.70, 0.50, 'A', 11400.00, '2020-03-20 15:23:31'),
(11, 1, 'p1', 3, 1.30, 0.35, 0.95, 'B', 19950.00, '2020-03-10 17:01:12'),
(12, 5, 'p1', 4, 1.20, 0.30, 0.90, 'A', 20520.00, '2020-06-11 06:37:33');

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
(1, 'elhadjar.office@gmail.com', '$2y$10$/sdJ5y2wHv970/T.Hk6e1uWYOD7MmbKvjARVUcu5Qa6SWOsDbk11K', '$2y$10$DmjLqeVrevXCZy2GpxNQJ.lD832hBtCX8yFEqLIzKtSugzVuHv/P.', 1, '2020-05-26 16:51:11', 23, 1),
(2, 'laouarmedhichem23@gmail.com', '$2y$10$7x2PITlc4kvpI19hR62ja.3ekW75i06P8WPGUplMz.SAqY/PFlHgq', '$2y$10$TobwAyFJAp0m0fPgiOY00OwX9PyPQJQ/mkaysicwts59xhP/bqoIG', 1, '2020-05-26 16:57:15', 23, 2),
(3, 'elbouni.office@gmail.com', '$2y$10$al4RCgbtSWMmB8XztPEBreM5xl4G/lpBoaMwfdyHGBq/.y0WTA5M2', '$2y$10$TA58Xa6WzcphuQXzmEeDDOpxqFdWFBs1amI2aN/vv3wsfL8FOQLgO', 1, '2020-05-26 17:58:50', 23, 1),
(4, 'mohamed@gmail.com', '$2y$10$qZWtJwE1oOLeIGCjuI3d4eLlxmctxXk8gi4V.n3385aMPFMXfRSdy', '$2y$10$QCQPzmS4FE3VbbB5lkpBWOfQ9L1eJmXihQTND15sbHBHNiUIo/Zwu', 1, '2020-05-29 23:57:06', 23, 2),
(5, 'zermi@gmail.com', '$2y$10$f3S38YlKJ1oy.NRWKXseu.vEQMquaa4dcqMZhY1Acu5yjbD529XL.', '$2y$10$cyhBhQjosrgm7icYzjz8jOPwsgbwEVLqt/iqtq8aa8S3FWRZ9UUau', 1, '2020-05-30 03:50:11', 23, 2),
(6, 'alger_user@gmail.com', '$2y$10$WOiOolLv0NTDuZoAZ3.FMuJYpNZxD9ifYrIOeyelWmjdjNNfnqjge', '$2y$10$RVwxCLihFK5rfFhcVWx./ePS9OMiBM3reIVwb25r.RW0L4HGSPmmC', 0, '2020-06-02 21:45:00', 17, 2),
(7, 'skander@gmail.com', '$2y$10$o1cmFuXMxMbUPLiN5YVBzOo/Alvb0LqWQF7mW0eybj8PmhG7pAkmC', '$2y$10$x8.6yBm5eUUM3Y6VDuHuaeZPCMyU4mDnwE0Sg4vr8JH5Z9JrSDlwe', 1, '2020-06-03 01:40:41', 16, 2),
(8, 'laouarmedhichem23@gmai.com', '$2y$10$EIXjzn1E2rihQZdSCas2TeM..3ojd1XJ2luRPt6KWmTYmCus7qwue', '$2y$10$LuqQlr2kG/L8uNKCnn6kNuqumOZyCqEK7Oe1cSw3uueBxajzIzCRW', 1, '2020-06-03 03:05:12', 23, 2),
(9, 'berrahal.office@gmail.com', '$2y$10$l33sSN2Ku.iuI7Td0zbFP.9mebUjdxYLLGEj13oo.KVVFYkJctd2y', '$2y$10$DZuMWdHd5cPWcLa.u0TW9.63KQ3B9ADynxsuUUOkOlNsx.HkE.5FW', 1, '2020-06-10 14:34:04', 23, 1),
(11, 'BabElOued.office@gmail.com', '$2y$10$1.CFiAomS.FwwITOQ6i6AubURirMD5ov3FefrXgB9tsKPC4PxcOFW', '$2y$10$oza18IaScDbsWPp8BKKbf.SLo.e94Cu9WY6zIUpfXm8VpJwtAfTM.', 1, '2020-06-11 05:33:21', 16, 1);

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

--
-- Dumping data for table `véhicule`
--

INSERT INTO `véhicule` (`matricule`, `marque`, `nom_de_chauffeur`, `num_de_permis`, `récolte_id`) VALUES
(2311652368, 'toyota', 'chauffeur', 145236, 1),
(2311652368, 'toyota', 'chauffeur', 454586, 2),
(2311652368, 'toyota', 'chauffeur', 153625, 3),
(2311416072, 'toyota', 'lmml', 785632, 4),
(2311615322, 'toyota', 'chauffeur', 452362, 5),
(2311596528, 'toyota', 'chauffeur', 859236, 6),
(2311416072, 'toyota', 'chauffeur', 856321, 7),
(2311416072, 'toyota', 'chauffeur', 453203, 8),
(2311416072, 'toyota', 'chauffeur', 236574, 9),
(2311416072, 'toyota', 'chauffeur', 236574, 10),
(2311416072, 'toyota', 'chauffeur', 120352, 11),
(2311416072, 'toyota', 'chauffeur', 853207, 12);

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
-- Indexes for table `droit_d_accès`
--
ALTER TABLE `droit_d_accès`
  ADD KEY `fk_profil` (`profil_id`),
  ADD KEY `FK_option` (`code_option`);

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
-- Indexes for table `Option`
--
ALTER TABLE `Option`
  ADD PRIMARY KEY (`code`);

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
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newslatter`
--
ALTER TABLE `newslatter`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `récoltes`
--
ALTER TABLE `récoltes`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wilayas`
--
ALTER TABLE `wilayas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agriculteurs`
--
ALTER TABLE `agriculteurs`
  ADD CONSTRAINT `fk_agriculteurs` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `droit_d_accès`
--
ALTER TABLE `droit_d_accès`
  ADD CONSTRAINT `FK_option` FOREIGN KEY (`code_option`) REFERENCES `Option` (`code`),
  ADD CONSTRAINT `fk_profil` FOREIGN KEY (`profil_id`) REFERENCES `profile` (`id`);

--
-- Constraints for table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `fk_facture_agriculteur` FOREIGN KEY (`agriculteur_id`) REFERENCES `agriculteurs` (`id`),
  ADD CONSTRAINT `fk_facture_office` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`);

--
-- Constraints for table `offices`
--
ALTER TABLE `offices`
  ADD CONSTRAINT `fk_offices` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `fk_rendezVous` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`),
  ADD CONSTRAINT `fk_rendez_vous_2` FOREIGN KEY (`agriculteur_id`) REFERENCES `agriculteurs` (`id`);

--
-- Constraints for table `récoltes`
--
ALTER TABLE `récoltes`
  ADD CONSTRAINT `fk_one` FOREIGN KEY (`agriculteur_id`) REFERENCES `agriculteurs` (`id`),
  ADD CONSTRAINT `fk_three` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`),
  ADD CONSTRAINT `fk_two` FOREIGN KEY (`produit_code`) REFERENCES `produit` (`code`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_profile` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`wilaya_id`) REFERENCES `wilayas` (`id`);

--
-- Constraints for table `véhicule`
--
ALTER TABLE `véhicule`
  ADD CONSTRAINT `fk_key` FOREIGN KEY (`récolte_id`) REFERENCES `récoltes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
