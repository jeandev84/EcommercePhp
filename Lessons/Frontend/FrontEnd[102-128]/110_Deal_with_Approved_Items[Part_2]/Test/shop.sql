-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  sam. 31 mars 2018 à 09:10
-- Version du serveur :  10.2.3-MariaDB-log
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Ordering`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(7, 'Hand Made', 'Hand Made items', 1, 0, 0, 0),
(8, 'Computers', 'Computers item', 2, 0, 0, 0),
(9, 'Cell Phones', 'Cell Phones', 3, 0, 0, 0),
(10, 'Clothing', 'Clothing And Fashion', 4, 0, 0, 0),
(11, 'Tools', 'Home Tools', 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(1, 'Very Nice', 1, '2018-03-30', 2, 19),
(2, 'Nice Item, Thanks so much', 0, '2018-03-31', 5, 19),
(3, 'This is a Very Good Phone', 0, '2018-03-31', 2, 19),
(4, 'This is a Very Good Phone', 0, '2018-03-31', 2, 19),
(5, 'This is a Very Good Phone', 0, '2018-03-31', 2, 19),
(6, 'Very Nice This is The second comment ', 1, '2018-03-31', 2, 19),
(7, 'Very Good Product thanks!', 1, '2018-03-31', 6, 20),
(8, 'Very Good Product thanks!', 1, '2018-03-31', 6, 20),
(9, 'Very Good Product thanks!', 1, '2018-03-31', 6, 20),
(10, 'This is Me Khalid', 1, '2018-03-31', 2, 19);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Status` varchar(255) NOT NULL,
  `Rating` smallint(6) DEFAULT NULL,
  `Approve` tinyint(4) DEFAULT 0,
  `Cat_ID` int(11) DEFAULT NULL,
  `Member_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`Item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Status`, `Rating`, `Approve`, `Cat_ID`, `Member_ID`) VALUES
(1, 'Speaker', 'Very Good Speaker', '10', '2018-03-30', 'China', NULL, '1', NULL, 1, 8, 16),
(2, 'Yeti Blue Mic', 'Very Good Microphone', '108', '2018-03-30', 'USA', NULL, '1', NULL, 1, 8, 19),
(3, 'iPhone 6s', 'Apple iPhone 6s', '300', '2018-03-30', 'USA', NULL, '2', NULL, 1, 9, 16),
(4, 'Magic Mouse', 'Apple Magic Mouse', '150', '2018-03-30', 'USA', NULL, '1', NULL, 1, 8, 1),
(5, 'Network Cable', 'Cat 9 Network Cable', '100', '2018-03-30', 'USA', NULL, '1', NULL, 1, 8, 19),
(6, 'Game', 'Test Game For Item', '120', '2018-03-31', 'USA', NULL, '2', NULL, 1, 8, 20),
(7, 'Test Item', 'This is a best item in our planete', '20', '2018-03-31', 'USA', NULL, '1', NULL, 1, 10, 19),
(8, 'Test  Item New ', 'The Best game in the world , please pay it', '45', '2018-03-31', 'UK', NULL, '1', NULL, 0, 8, 19),
(9, 'Test  Item New ', 'The Best game in the world , please pay it', '45', '2018-03-31', 'UK', NULL, '1', NULL, 0, 8, 19);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'To identify User',
  `Username` varchar(255) NOT NULL COMMENT 'Username To Login',
  `Password` varchar(255) NOT NULL COMMENT 'Password To Login',
  `Email` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0 COMMENT 'Identify User Group',
  `TrustStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'Seller Rank',
  `RegStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'User Approval',
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`) VALUES
(1, 'Brown', '601f1889667efaebb33b8c12572835da3f027f78', 'jeanyao@ymail.com', 'Kouassi', 1, 0, 1, '2018-03-28'),
(16, 'Michelle', '601f1889667efaebb33b8c12572835da3f027f78', 'michou@yahoo.fr', 'Yao ', 0, 0, 1, '2018-03-30'),
(17, 'Hussen', '601f1889667efaebb33b8c12572835da3f027f78', 'hussein@test.me', 'Alan LeGrand', 0, 0, 1, '2018-03-30'),
(18, 'Application', '601f1889667efaebb33b8c12572835da3f027f78', 'app@app.com', 'Application API', 0, 0, 0, '2018-03-30'),
(19, 'Khalid', '601f1889667efaebb33b8c12572835da3f027f78', 'kalid@site.com', 'Khalid Ahmad', 0, 0, 1, '2018-03-06'),
(20, 'londonien', '601f1889667efaebb33b8c12572835da3f027f78', 'londonien@site.uk', NULL, 0, 0, 0, '2018-03-31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `comment_user` (`user_id`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `member_1` (`Member_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To identify User', AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
