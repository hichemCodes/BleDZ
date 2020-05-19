-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 19, 2020 at 04:49 AM
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
(20, 'laouar', 'hichem', '123456', '5eb051a9708b25.49337896.jpg', 40),
(24, 'user', 'user', '786932', NULL, 45),
(25, 'usernew', 'usernew', '569823', NULL, 46),
(26, 'user', 'user', '145236', NULL, 48),
(28, 'agrone', 'agrone', '153624', NULL, 50),
(29, 'laouar', 'laouar', '856923', NULL, 51),
(30, 'zerman', 'hamza', '455556', NULL, 54),
(31, 'moha', 'moha', '452362', NULL, 55),
(32, 'user', 'usernew', '123523', NULL, 56),
(33, 'newuser', 'user', '745896', NULL, 57),
(34, 'maha', 'amin', '145298', NULL, 58);

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
(38, '2020-04-28 21:28:46', 12600.00, 'a:1:{i:0;s:2:\"82\";}', 11, 20),
(39, '2020-05-09 19:25:29', 43320.00, 'a:1:{i:0;s:2:\"84\";}', 11, 20),
(40, '2020-05-16 00:25:34', 38000.00, 'a:2:{i:0;s:2:\"85\";i:1;s:2:\"86\";}', 11, 20);

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
(12, 'laouarmedhichem23@gmail.com'),
(14, 'mohahich23@gmail.com');

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
(11, 'elhajar', NULL, 38, 1),
(12, 'alger', NULL, 39, 1),
(13, 'elbouni', NULL, 41, 1),
(14, 'barahal', NULL, 52, 0),
(15, 'lllll', NULL, 53, 1);

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
('p2', 'carote', 12000.00, 21000.00, 10000.00, '2020-05-15 17:21:33');

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
(181, '2020-04-12 14:00:00', 0, 12, NULL),
(221, '2020-05-15 22:00:00', 1, 11, 20);

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
(82, 20, 'p1', 11, 1.50, 0.90, 0.60, 'B', 12600.00, '2020-04-28 21:26:21'),
(83, 24, 'p1', 13, 1.40, 1.20, 0.20, 'B', 4200.00, '2020-04-30 18:44:48'),
(84, 20, 'p1', 11, 2.50, 0.60, 1.90, 'A', 43320.00, '2020-05-07 21:59:10'),
(85, 20, 'p1', 11, 2.20, 1.40, 0.80, 'C', 15200.00, '2020-05-13 21:19:30'),
(86, 20, 'p1', 11, 1.50, 0.30, 1.20, 'C', 22800.00, '2020-05-15 19:15:23');

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
(38, 'elhajar99@gmail.com', '$2y$10$JCInITxEpYAbfuWk9X9TF.hXeD4uLgaMRnaqU7T1eJjn61fTMOrfK', '$2y$10$t6699smqnP1fUCRcAlxjOuh0aHnUuRfGv4G72jVEnB4AvGIUYtJCC', 1, '2020-04-11 16:58:27', 23, 1),
(39, 'alger@gmail.com', '$2y$10$IbhC4ivgZFPzqHqSEE1zp.2GwHBtQr0Z2uYhsSo9j18XutNYv6YRC', '$2y$10$6wT7oXHIJg5ysL1lIjwIne89.lKNkFPrYK7I7/ASawoN21NaNhWzO', 1, '2020-04-11 16:59:16', 16, 1),
(40, 'laouarmedhichem23@gmail.com', '$2y$10$4mUy6EpzN25R7q2GHHCaJuhJ0v7DOhhCuprK5oyE96fIglKGCtM.C', '$2y$10$DmenxjiqTZhhIebTYsiboObUN4riQhja4NhUtl5Bqgt58yQZWeSSO', 1, '2020-04-11 17:31:22', 23, 2),
(41, 'elbouni@gmail.com', '$2y$10$5eN66VUlQXl7O4Y8DZD7Guyx0CtJcujAqfBe4ODZEyNB2BEuRFs/e', '$2y$10$cE2DrmqcYn6Pc/LG2IHED.Jm4c/En8LRK45tVO81x0BZ1g.ko6zZ6', 1, '2020-04-11 17:34:09', 23, 1),
(45, 'user16@gmail.com', '$2y$10$vTtpy7AP6wd2svl/1o5ASu8k/BVcha5qpV8yhy2d041fvGnpSrgIC', '$2y$10$jvNOf51PSHWq1DgK5Ozm2OL86pMjoxsP9UHd2TVLLZl5CAj5eXb.u', 1, '2020-04-12 14:23:50', 16, 2),
(46, 'usernew2399o@gmail.com', '$2y$10$wkp/vZfPbmfAGew1lgaeTOpgAy4l9YZBqGex5cMzYJrxSrtTEeDzy', '$2y$10$B08GxuTw0QRXaHJTp.2x6O.b2G8OQHajZ0TRqJQiEPskRhteCXYeC', 1, '2020-04-12 14:24:48', 16, 2),
(48, 'mohahich23@gmail.com', '$2y$10$J9D3FDObhiyo/6Y7ozO6e.s3ppBfLGUpw8RKoVVaDp2Rf9mizcV72', '$2y$10$F9at0djR9Xvj.1mU1vuDkuAvwmupfEmY8263SppNNXTgo9HF2YuNK', 1, '2020-05-04 15:49:48', 23, 2),
(50, 'agrone@gmail.com', '$2y$10$biqnEFDKZM3m.UJ11BcyJ.6szFn.1Ll4JNH6vxlGEUVVpxqYGLPki', '$2y$10$hOQtvWJTUgbFFuCzLjhwuudu4a5asjw.cWVt0D.tzZWvL57UTfn22', 0, '2020-05-05 15:58:02', 12, 2),
(51, 'hichem@gmail.com', '$2y$10$7ZYwCtPsyOuyxidYsADZsestmy29Ij757f1LeLxgeJiC/AxKc23Oa', '$2y$10$va/TcCBS7EkGxFERMmR9KOARSQTGfBh7Jqjgl5H7MtvnjrLUcHN7m', 0, '2020-05-06 00:04:36', 18, 2),
(52, 'barahel@annaba.com', '$2y$10$QvQrnWn0tDka35MRw5tDauFv46F8Xf1luFUGOLKEwpKZgELufL1Sq', '$2y$10$A1DaPA7RiqkkhyvoRM4sT.GuakLVXHdbPEzON.3fcF/pM.KWtX5La', 1, '2020-05-06 01:02:55', 16, 1),
(53, 'mmmm@annaba.com', '$2y$10$2NPnKpIPgwm9h4/W4sJ2dugfKYebGSYFDJ2dF0u48v4G7YW7Q9BHO', '$2y$10$JzOm.3trZH25dzjjN10iAeTGKF2HWFJqJK285RI7wB6Srys1h2Q9G', 1, '2020-05-07 14:25:38', 24, 1),
(54, 'zerman@gmail.com', '$2y$10$8JCtyRbDKhJm62IRmQ32V.I8jRSWzSUkCADj0L34cNj2lkKxA.MYC', '$2y$10$Dj72t1.xJ8i5U0tQdc0UNeBcSEcLiqyzQ9T4/t0RlQrW6m225M6Bm', 1, '2020-05-14 20:42:12', 16, 2),
(55, 'moha@gmail.com', '$2y$10$MZFP0Oiz0L678RiwHIq2nOXC/RWXat/TzUnR4jyWQtwYh4Nrr4mrm', '$2y$10$J/1jU3Gw/.cP/.uRA8tl5OZ4Zvor2sQzSZVdxNPM5hzVTnq6yWuoa', 1, '2020-05-14 20:51:50', 16, 2),
(56, 'klkll@hllm.fr', '$2y$10$6I/KckMOSmNxmN.I1xXzM.nQ4VvN3ikaLHJpAZ0Z7coRNKgsyrcXS', '$2y$10$ppONugucwNPeBa/kNAEXTersNbKqeIjt6vj22267Lli18RJyo96pi', 1, '2020-05-14 20:52:49', 16, 2),
(57, 'new@gmail.com', '$2y$10$TrOwUyJjta0Vqlyzy948nehDkhXz7yissVaV3eBcwiIT2aK5fpyX2', '$2y$10$OTctOzrJToEnzIoKb9m6f.3b7knJM8UFsKGtCjB4T4EmsbdxUIba2', 1, '2020-05-14 20:54:31', 16, 2),
(58, 'mohaa@gmail.com', '$2y$10$P3FsGz2au747bqtjRoxheOx2IGVXoMCkm89eqUB.Qhkw/4JM84Wx6', '$2y$10$RvZQbhEGAb23APF8k43VG.EofqunnNVdGv4ItVXOS2o1vRpTqScgO', 1, '2020-05-14 21:08:00', 16, 2);

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
(2311416072, 'toyota', 'moha amine', 236574, 82),
(2311416072, 'toyota', 'moha amine', 236574, 83),
(2311416072, 'toyota', 'moha amine', 152362, 84),
(2311416072, 'toyota', 'moha amine', 236574, 85),
(2311416072, 'klkbgglf', 'moha amine', 145236, 86);

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
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `newslatter`
--
ALTER TABLE `newslatter`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `récoltes`
--
ALTER TABLE `récoltes`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
