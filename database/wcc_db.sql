-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 28 avr. 2019 à 04:06
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wcc_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `image` varchar(255) NOT NULL,
  `position_latitude` double(10,8) NOT NULL,
  `position_longitude` double(10,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `shop`
--

INSERT INTO `shop` (`id`, `name`, `image`, `position_latitude`, `position_longitude`) VALUES
(1, 'Shop Name 1', '', 33.57180600, -7.62671000),
(2, 'Shop Name 2', '', 33.36905500, -7.72690800),
(3, 'Shop Name 3', '', 33.57029000, -7.54780100),
(4, 'Shop Name 4', '', 33.56738300, -7.54981400),
(5, 'Shop Name 5', '', 33.56398800, -7.59205900),
(6, 'Shop Name 6', '', 33.58131700, -7.56336400),
(7, 'Shop Name 7', '', 28.42550600, -10.76770500),
(8, 'Shop Name 8', '', 33.60611600, -7.53933100),
(9, 'Shop Name 9', '', 33.60611644, -10.76770440),
(10, 'Shop Name 10', '', 33.96641400, -6.86976700),
(11, 'Shop Name 11', '', 33.93525500, -6.80277400),
(12, 'Shop Name 12', '', 34.01808400, -6.85195200);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'mohamedchibani1996@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Structure de la table `users_disliked_shops_2h`
--

CREATE TABLE `users_disliked_shops_2h` (
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `dislike_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users_preferred_shops`
--

CREATE TABLE `users_preferred_shops` (
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `users_disliked_shops_2h`
--
ALTER TABLE `users_disliked_shops_2h`
  ADD PRIMARY KEY (`user_id`,`shop_id`),
  ADD KEY `fk_shop_id_d` (`shop_id`);

--
-- Index pour la table `users_preferred_shops`
--
ALTER TABLE `users_preferred_shops`
  ADD PRIMARY KEY (`user_id`,`shop_id`),
  ADD KEY `fk_shop_id` (`shop_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users_disliked_shops_2h`
--
ALTER TABLE `users_disliked_shops_2h`
  ADD CONSTRAINT `fk_shop_id_d` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_d` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users_preferred_shops`
--
ALTER TABLE `users_preferred_shops`
  ADD CONSTRAINT `fk_shop_id` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
