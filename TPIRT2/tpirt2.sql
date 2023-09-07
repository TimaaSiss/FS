-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 30 mai 2023 à 11:45
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tpirt2`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(64) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(90) NOT NULL,
  `dateinscription` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `dateinscription`) VALUES
(6, 'Assi', 'aissata@yahoo.com', '1b53e7cd31284d0069a8d916bb3d46fbd06debd2', '0000-00-00'),
(7, 'Tenin', 'tenimba@gmail.com', '1c3103f2662f20d3d33fddd7366713506685ecb1', '0000-00-00'),
(8, 'Djetou', 'djetou@yahoo.com', '883bc09af13869e72dedc1f9a60858255a1575be', '0000-00-00'),
(9, 'Fatoumata', 'fatoumata@yahoo.com', '9bd1eb5c09c227c1fad5828c93148e83ce0ced47', '0000-00-00'),
(10, 'Fanta', 'fanta@yahoo.com', '7932c08c39d1f4ad3fd0914f8a1824a306e97caa', '2023-05-26'),
(11, 'Binta', 'binta@yahoo.com', 'a0e6e56d6509e90ab85c9e4b931b07eb78f474e0', '2023-05-27'),
(12, 'Anna', 'anna@yahoo.com', '2bc1ecb410e142bce83bce6f212b41e1781536dc', '2023-05-27'),
(13, 'Ada', 'adambarry@yahoo.com', 'e4ea294c062c525643df036a35ca579b905fa400', '2023-05-28'),
(14, 'Mama', 'mama@gmail.com', '99df988b77e60a1718e9e6fecdaf22552047be28', '2023-05-29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
