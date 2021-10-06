-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 06 oct. 2021 à 16:41
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wf3_php_intermediaire_justine`
--
CREATE DATABASE IF NOT EXISTS `wf3_php_intermediaire_justine` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wf3_php_intermediaire_justine`;

-- --------------------------------------------------------

--
-- Structure de la table `advert`
--

CREATE TABLE `advert` (
  `id` int(3) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `postal_code` varchar(5) NOT NULL,
  `city` varchar(20) NOT NULL,
  `type` enum('location','vente') NOT NULL,
  `price` int(11) NOT NULL,
  `reservation_message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `advert`
--

INSERT INTO `advert` (`id`, `title`, `description`, `postal_code`, `city`, `type`, `price`, `reservation_message`) VALUES
(1, 'Marseille appart T2', 'Beau t2 dans le centre de Marseille. Cuisine fournie', '13000', 'Marseille', 'location', 1300, '0'),
(2, 'Suresnes maison t5', 'Belle maison lumineuse dans le centre de Suresnes. Parfait pour les grandes familles, écoles à proximité.', '92150', 'Suresnes', 'vente', 350000, ''),
(3, 'Courbevoie appartement T4', 'Aliquam vulputate tempus vestibulum. Aliquam faucibus augue et semper sagittis. Aenean hendrerit rhoncus erat. Phasellus sit amet magna metus. Praesent vitae felis laoreet, luctus ligula vitae, placerat tortor.', '92400', 'Courbevoie', 'vente', 400000, ''),
(4, 'Puteaux appartement T4', 'unc tempus iaculis magna eu tristique. Aliquam a luctus tortor, nec rhoncus turpis. Suspendisse bibendum mollis orci vitae pulvinar. Quisque ut erat tellus. Aliquam lacinia, ante ut laoreet sollicitudin.', '92500', 'Puteaux', 'location', 2500, ''),
(5, 'Seine Saint Denis maison t2', 'ellentesque aliquam felis id mauris congue ullamcorper. Curabitur blandit ligula ac felis auctor placerat. Sed scelerisque leo eget mauris gravida, id imperdiet magna aliquam.', '93000', 'Seine Saint Denis', 'location', 900, 'J\'aimerai ce bien car il semble très beau !'),
(6, 'Clichy appartement studio', 'Pellentesque aliquam felis id mauris congue ullamcorper. Curabitur blandit ligula ac felis auctor placerat. Sed scelerisque leo eget mauris gravida, id imperdiet magna aliquam.', '92024', 'Clichy', 'vente', 150000, ''),
(7, 'Nanterre appartement t3', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '92150', 'Nanterre', 'location', 2500, ''),
(8, 'Colombes maison t4', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '92025', 'Colombes', 'location', 3200, 'c\'est beau'),
(9, 'Strasbourg maison t6', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '67000', 'Strasbourg', 'location', 3000, ''),
(10, 'Dingsheim appartement t4', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '67097', 'Dingsheim', 'vente', 150000, 'JE LE VEUX !'),
(11, 'Paris appartement studio', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '75016', 'Paris', 'vente', 500000, ''),
(12, 'Paris maison t5', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '75015', 'Paris', 'location', 6500, ''),
(13, 'Lille appartement t2', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '59000', 'Lille', 'vente', 250000, ''),
(14, 'Lyon maison t3', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '69000', 'Lyon', 'location', 1750, 'c\'est beau'),
(15, 'Charenton appartement studio', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '54532', 'Charenton', 'location', 500, 'coucou\r\n'),
(16, 'Moise maison t2', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '65459', 'Moise', 'vente', 150000, 'ok'),
(17, 'Toulouse maison t4', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '14000', 'Toulouse', 'vente', 250000, 'COucou\r\n'),
(18, 'Toulon appartement t5', 'Sed vitae fringilla eros. Curabitur imperdiet hendrerit nulla, non varius orci maximus quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam a elit faucibus, sagittis risus non, semper massa.', '15000', 'Toulon', 'location', 3000, 'azerty'),
(19, 'Montpellier maison T3', 'Bel appart la famille, check ça !', '12568', 'Montpellier', 'vente', 600000, 'c\'est beau'),
(20, 'essai-1', 'Villa sur mer', '66220', 'Collioure', 'location', 3000, ''),
(21, 'Essai 2 - Maison d\'été', 'Vue sur montagne', '64123', 'Pont à Mousson', 'location', 2500, ''),
(22, 'essai-2', 'bellle maison', '91000', 'evry', 'vente', 350000, ''),
(23, 'essai-3', 'bellle maison en bord de mer', '06412', 'Toulon', 'vente', 450000, ''),
(24, 'essai-4', 'Villa au bord du lac d\'Annecy', '74100', 'Annecy', 'location', 2500, ''),
(25, 'essai-5', 'Chalet de montagne', '73245', 'Courchevel', 'location', 950, ''),
(26, 'essai-6', 'Appartement en cœur de station', '74500', 'Courchevel', 'location', 550, ''),
(27, 'essai-7', 'hangar à bateau', '83340', 'Toulon', 'vente', 200000, ''),
(28, 'essai-8', 'bien immobilier', '91000', 'evry', 'vente', 230000, ''),
(29, 'essai-9', 'Maison près du port', '66200', 'Collioure', 'location', 760, ''),
(30, 'essai-9', 'Maison près du port', '66200', 'Collioure', 'location', 760, ''),
(31, 'essai-9', 'Maison près du port', '66200', 'Collioure', 'location', 760, ''),
(32, 'essai-9', 'Maison près du port', '66200', 'Collioure', 'location', 760, ''),
(33, 'essai-9', 'Maison près du port', '66200', 'Collioure', 'location', 760, ''),
(34, 'essai-9', 'Maison près du port', '66200', 'Collioure', 'location', 760, ''),
(35, 'essai-9', 'Maison près du port', '66200', 'Collioure', 'location', 760, ''),
(36, 'essai-9', 'Maison près du port', '66200', 'Collioure', 'location', 760, ''),
(37, 'essai-9', 'Maison près du port', '66200', 'Collioure', 'location', 760, ''),
(38, 'essai-2', 'maison toute simple', '91000', 'evry', 'vente', 300000, ''),
(39, 'essai-8', 'maison paris', '75000', 'PARIS', 'location', 3000, ''),
(40, 'essai-1', 'Appartement vue sur parc', '91000', 'evry', 'vente', 230000, ''),
(41, 'essai-1', 'chalet en bord de piste', '73560', 'Val d\'Isère', 'location', 2500, ''),
(42, 'essai-1', 'chalet en bord de piste', '73560', 'Val d\'Isère', 'location', 2500, ''),
(43, 'essai-1', 'chalet en bord de piste', '73560', 'Val d\'Isère', 'location', 2500, ''),
(44, 'essai-1', 'qqqqqqqqqqqqqqqqq', '91000', 'evry', 'vente', 300000, ''),
(45, 'Test envoi', 'sssssssssssssssss', '91000', 'Evry', 'location', 5600, ''),
(46, 'Test envoi', 'sssssssssssssssss', '91000', 'Evry', 'location', 5600, ''),
(47, 'Test envoi - 45', 'Maison de luxe', '83220', 'Saint Tropez', 'vente', 1450000, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `advert`
--
ALTER TABLE `advert`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
