-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Généré le : mer. 20 déc. 2023 à 12:47
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `header` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `header`, `title`, `author`, `image`, `body`, `date`) VALUES
(1, 'Les nouvelles les plus étranges de la semaine', 'Avec des extraterrestres, des pingouins et des poissons-rouges', 'Professeur Zorglub', 'https://picsum.photos/319/180', 'Des chercheurs découvrent que les chats peuvent communiquer en morse. Une ville construite entièrement en bonbons attire des milliers de visiteurs. Un homme se réveille après 10 ans de coma et découvre que sa femme l\'a quitté pour un extraterrestre. Un poisson-rouge se fait passer pour un requin et terrorise les autres poissons. Un pingouin est arrêté en état d\'ivresse dans un bar de Bretagne.', '2023-10-24'),
(2, 'Les nouvelles du monde, ce qui s\'est passé cette semaine', 'Des marins à la dérive, des pirates et des naufragés', 'Capitaine Haddock', 'https://picsum.photos/318/180', 'Des marins se sont échoués sur une île déserte. Des pirates ont attaqué un navire de croisière. Un naufragé a été retrouvé sur une île déserte.', '2023-12-19');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
