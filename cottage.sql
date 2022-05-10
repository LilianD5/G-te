-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 07 avr. 2022 à 11:22
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cottage`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `login_admin` varchar(50) NOT NULL,
  `pass_admin` varchar(10) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `login_admin`, `pass_admin`) VALUES
(1, 'Admin', 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id_reserv` int(11) NOT NULL AUTO_INCREMENT,
  `id_gite` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date_reserv` date NOT NULL,
  `end_date_reserv` date NOT NULL,
  `nbr_nuit` tinyint(1) NOT NULL,
  `nbr_people` int(11) NOT NULL,
  `price_reserv` int(11) NOT NULL,
  PRIMARY KEY (`id_reserv`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bookings`
--

INSERT INTO `bookings` (`id_reserv`, `id_gite`, `id_client`, `date_reserv`, `end_date_reserv`, `nbr_nuit`, `nbr_people`, `price_reserv`) VALUES
(1, 64, 1, '2022-04-10', '2022-04-13', 2, 2, 150),
(2, 65, 2, '2022-04-25', '2022-04-30', 5, 3, 500),
(11, 75, 19, '2022-04-01', '2022-04-06', 4, 7, 1552),
(13, 92, 21, '2022-04-07', '2022-04-21', 13, 2, 3640),
(9, 75, 17, '2022-04-01', '2022-04-28', 26, 3, 10088),
(8, 75, 16, '2022-04-01', '2022-04-13', 11, 7, 4268),
(14, 92, 22, '2022-04-07', '2022-04-19', 11, 2, 3080);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_categ` int(11) NOT NULL AUTO_INCREMENT,
  `image_categ` varchar(255) NOT NULL,
  `name_categ` varchar(250) NOT NULL,
  PRIMARY KEY (`id_categ`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_categ`, `image_categ`, `name_categ`) VALUES
(1, 'Image-catégorie-chambre', 'Chambre'),
(2, 'Image-catégorie-appartement', 'Appartement'),
(3, 'Image-catégorie-Maison', 'Maison'),
(4, 'Image-catégorie-Villa', 'Villa');

-- --------------------------------------------------------

--
-- Structure de la table `cottages`
--

DROP TABLE IF EXISTS `cottages`;
CREATE TABLE IF NOT EXISTS `cottages` (
  `id_gite` int(11) NOT NULL AUTO_INCREMENT,
  `id_categ` int(11) NOT NULL,
  `name_gite` varchar(255) NOT NULL,
  `name_simple_gite` varchar(255) NOT NULL,
  `location_gite` varchar(255) NOT NULL,
  `profil_gite` varchar(255) NOT NULL,
  `desc_gite` text NOT NULL,
  `nbr_sleeping` int(11) NOT NULL,
  `nbr_bathroom` int(11) NOT NULL,
  `price_night` int(11) NOT NULL,
  PRIMARY KEY (`id_gite`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cottages`
--

INSERT INTO `cottages` (`id_gite`, `id_categ`, `name_gite`, `name_simple_gite`, `location_gite`, `profil_gite`, `desc_gite`, `nbr_sleeping`, `nbr_bathroom`, `price_night`) VALUES
(64, 3, 'La Petite Maison dans la Prairie', 'lapetitemaisondanslaprairie', 'La prairie', 'lapetitemaisondanslaprairie_070422072547_pdp.jpg', 'Revivez la touchante saison des années 80 au sein de cette petite maison dans la prairie.', 8, 2, 170),
(65, 2, 'Chez Martine', 'chezmartine', 'En ville', 'chezmartine_070422071802_pdp.jpg', 'Petit appartement de ville, avec petit jardin d\'intérieur, parking en bas de l\'immeuble disponibles pour les habitants, les animaux de compagnies sont les bienvenus.', 2, 1, 80),
(83, 4, 'In the sun ', 'inthesun', 'Marseille', 'inthesun_060422093656_pdp.jpg', 'Maison sur Marseille, façade en pierre, et intérieur cosy, décorer style façon méditerranéenne. ', 6, 1, 230),
(78, 3, 'Antibes sous les tropiques', 'antibessouslestropiques', 'Antibes', 'antibessouslestropiques_060422093140_pdp.jpg', 'Maison sur Antibes à 10 min de la mer. L\'appartement comprend 4 couchages et 2 salles de bains. Les animaux de compagnies sont les bienvenus.', 4, 2, 180),
(79, 2, 'City of Light', 'cityoflight', 'Annecy', 'cityoflight_060422093243_pdp.jpg', 'Appartement au centre ville d\'Annecy, rue piétonne avec toutes les commodités à proximité. ', 2, 1, 210),
(80, 2, 'Cosy flat au Centre Ville', 'cosyflataucentreville', 'Metz', 'cosyflataucentreville_060422093342_pdp.jpg', 'Appartement au centre ville de Metz, proche de toutes commodités. Prix par nuit : 90€. Appartement dans immeuble et quartier calme. ', 2, 1, 90),
(81, 4, 'La Dolce Vita au bord de Mer', 'ladolcevitaauborddemer', 'Metz', 'ladolcevitaauborddemer_060422093443_pdp.jpg', 'Villa bord de mer, sur falaise. Disposant de 8 couchages et de 3 salle de bains. Vue magnifique.', 8, 3, 230),
(75, 4, 'La villa des coeurs brises', 'lavilladescoeursbrises', 'Sur une île', 'lavilladescoeursbrises_070422065322_pdp.jpg', 'Une villa pour star de télé réalité botoxé et au français douteux. Profiter de sa piscine à 5m de la mer et de sa salle de sport que personne utilisera. Pouvant accueillir jusqu\'à 12 personnes et possédant pas moins de 4  salle de bains, c\'est l\'endroit idéal pour tout vos clashs saisonniers !', 12, 4, 388),
(82, 3, 'Goodvibes ', 'goodvibes', 'Biarritz', 'goodvibes_060422093602_pdp.jpg', 'Maison sur Biarritz décorer chaudement. Intérieur très spacieux et fonctionnel. Disposant de 4 couchages et d\'une salle de bain. ', 4, 1, 180),
(84, 3, 'In the wild ', 'inthewild', 'Aix les Bains', 'inthewild_060422093748_pdp.jpg', 'Petite maison au allure de chalet au cœur de la forêt. Tout proche de Aix les bains, accès en voiture principalement. Village à 30 min à pieds.', 1, 1, 200),
(85, 4, 'The mediterranean', 'themediterranean', 'Montpellier', 'themediterranean_060422093929_pdp.jpg', 'Grande villa avec piscine au sein d\'une grande et vaste propriété. Intérieur moderne, avec de grand espaces. Nombres de couchages  : 8.', 8, 1, 280),
(86, 2, 'The charming', 'thecharming', 'Lyon', 'thecharming_060422094039_pdp.jpg', 'Appartement au centre de ville du vieux Lyon. A 5 min de la gare en métro. Appartement cosy, pour un couple ou personne seule.', 2, 1, 130),
(87, 1, 'La Parisienne', 'laparisienne', 'Paris', 'laparisienne_060422094124_pdp.jpg', 'Chambre au sein d\'un immeuble donnant vue direct sur la Tour Eiffel. \r\nQuartier calme, et proches de toutes commodités.', 1, 1, 190),
(88, 3, 'Pure mountain air ', 'puremountainair', 'Annecy', 'puremountainair_060422094351_pdp.jpg', 'Petite maison au bord du lac d\'Annecy, avec un vaste jardin un accès au lac directement par ponton, vue magnifique.', 5, 1, 135),
(89, 4, 'The luxurious', 'theluxurious', 'Saint-Tropez', 'theluxurious_060422094500_pdp.jpg', 'Magnifique villa au alentours de Saint-Tropez avec cheminée, jardin, barbecue, plusieurs espaces de couchages possibilités d\'accueillir 12 personnes.', 12, 4, 265),
(90, 3, 'The gentle ', 'thegentle', 'Aix les Bains', 'thegentle_060422094548_pdp.jpg', 'Maison avec façade en pierre et intérieur en bois. Cette maison familial au caractère chaleureux vous offrira de magnifiques souvenirs.', 3, 1, 150),
(91, 4, 'Strong in character', 'strongincharacter', 'Biarritz', 'strongincharacter_060422094644_pdp.jpg', 'Villa dans la ville de Biarritz, en haut d\'une falaise avec vue sur la mer. \r\nLaissez vous transportez.', 5, 3, 260),
(92, 3, 'Simply quiet', 'simplyquiet', 'Marseille', 'simplyquiet_060422094742_pdp.jpg', 'Maison tout en couleur au sein de la belle ville de Marseille, dans un quartier très calme, et tout en couleurs. ', 7, 3, 280),
(93, 4, 'Relaxation Place', 'relaxationplace', 'Nice', 'relaxationplace_060422094830_pdp.jpg', 'Magnifique villa avec façade tout en pierre, bordée d\'une immense piscine à 10 min de la mer à pieds.', 6, 3, 500),
(94, 4, 'La Maison de reve', 'lamaisondereve', 'Nimes', 'lamaisondereve_060422095004_pdp.jpg', 'Venez en famille ou entres amis vous détendre et profiter de cette magnifique villa sur les hauteurs de Nîmes', 10, 1, 850);

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `firstname_client` varchar(15) NOT NULL,
  `lastname_client` varchar(15) NOT NULL,
  `phone_client` int(11) NOT NULL,
  `mail_client` varchar(50) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id_client`, `firstname_client`, `lastname_client`, `phone_client`, `mail_client`) VALUES
(1, 'Lilian', 'Diaz', 606060606, 'lilian@mail.com'),
(2, 'Tiffany', 'Flore', 606060606, 'tiff@mail.com'),
(3, 'Xhesika', 'Milaqui', 606060606, 'jess@mail.com'),
(4, 'Andre', 'Long', 606060606, 'andre@mail.com'),
(5, 'Justin', 'Loyer', 606060606, 'justin@mail.com'),
(6, 'Andy', 'Loisel', 606060606, 'andy@mail.com'),
(7, 'Cedric', 'Belanger', 606060606, 'cedric@mail.com'),
(11, 'Johnny', 'Halliday', 606060606, 'jojo@mail.com'),
(16, 'George', 'Washington', 606060606, 'George@mail.com'),
(17, 'Tom', 'Sawyer', 606060606, 'Tommy@mail.com'),
(18, 'Kad', 'Merad', 606060606, 'kad@mail.com'),
(19, 'Kad', 'Merad', 606060606, 'kad@mail.com'),
(20, 'Tom', 'Jedusor', 606060606, 'tom@mail.com'),
(21, 'lolo', 'Lilian', 612551415, 'blbla@gmail.com'),
(22, 'lolo', 'Lilian', 612551415, 'blbla@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `detail_booking`
--

DROP TABLE IF EXISTS `detail_booking`;
CREATE TABLE IF NOT EXISTS `detail_booking` (
  `id_detail_booking` int(11) NOT NULL AUTO_INCREMENT,
  `id_gite` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_reserv` int(11) NOT NULL,
  `day_booked` date NOT NULL,
  PRIMARY KEY (`id_detail_booking`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `detail_booking`
--

INSERT INTO `detail_booking` (`id_detail_booking`, `id_gite`, `id_client`, `id_reserv`, `day_booked`) VALUES
(67, 72, 20, 12, '2022-04-05'),
(66, 75, 19, 11, '2022-04-06'),
(65, 75, 19, 11, '2022-04-05'),
(64, 75, 19, 11, '2022-04-04'),
(63, 75, 19, 11, '2022-04-03'),
(62, 75, 19, 11, '2022-04-02'),
(61, 75, 19, 11, '2022-04-01'),
(60, 75, 18, 10, '2022-04-06'),
(59, 75, 18, 10, '2022-04-05'),
(58, 75, 18, 10, '2022-04-04'),
(57, 75, 18, 10, '2022-04-03'),
(56, 75, 18, 10, '2022-04-02'),
(55, 75, 18, 10, '2022-04-01'),
(27, 75, 17, 9, '2022-04-01'),
(28, 75, 17, 9, '2022-04-02'),
(29, 75, 17, 9, '2022-04-03'),
(30, 75, 17, 9, '2022-04-04'),
(31, 75, 17, 9, '2022-04-05'),
(32, 75, 17, 9, '2022-04-06'),
(33, 75, 17, 9, '2022-04-07'),
(34, 75, 17, 9, '2022-04-08'),
(35, 75, 17, 9, '2022-04-09'),
(36, 75, 17, 9, '2022-04-10'),
(37, 75, 17, 9, '2022-04-11'),
(38, 75, 17, 9, '2022-04-12'),
(39, 75, 17, 9, '2022-04-13'),
(40, 75, 17, 9, '2022-04-14'),
(41, 75, 17, 9, '2022-04-15'),
(42, 75, 17, 9, '2022-04-16'),
(43, 75, 17, 9, '2022-04-17'),
(44, 75, 17, 9, '2022-04-18'),
(45, 75, 17, 9, '2022-04-19'),
(46, 75, 17, 9, '2022-04-20'),
(47, 75, 17, 9, '2022-04-21'),
(48, 75, 17, 9, '2022-04-22'),
(49, 75, 17, 9, '2022-04-23'),
(50, 75, 17, 9, '2022-04-24'),
(51, 75, 17, 9, '2022-04-25'),
(52, 75, 17, 9, '2022-04-26'),
(53, 75, 17, 9, '2022-04-27'),
(54, 75, 17, 9, '2022-04-28'),
(68, 72, 20, 12, '2022-04-06'),
(69, 72, 20, 12, '2022-04-07'),
(70, 72, 20, 12, '2022-04-08'),
(71, 72, 20, 12, '2022-04-09'),
(72, 72, 20, 12, '2022-04-10'),
(73, 72, 20, 12, '2022-04-11'),
(74, 72, 20, 12, '2022-04-12'),
(75, 72, 20, 12, '2022-04-13'),
(76, 72, 20, 12, '2022-04-14'),
(77, 72, 20, 12, '2022-04-15'),
(78, 72, 20, 12, '2022-04-16'),
(79, 72, 20, 12, '2022-04-17'),
(80, 72, 20, 12, '2022-04-18'),
(81, 72, 20, 12, '2022-04-19'),
(82, 72, 20, 12, '2022-04-20'),
(83, 72, 20, 12, '2022-04-21'),
(84, 92, 21, 13, '2022-04-07'),
(85, 92, 21, 13, '2022-04-08'),
(86, 92, 21, 13, '2022-04-09'),
(87, 92, 21, 13, '2022-04-10'),
(88, 92, 21, 13, '2022-04-11'),
(89, 92, 21, 13, '2022-04-12'),
(90, 92, 21, 13, '2022-04-13'),
(91, 92, 21, 13, '2022-04-14'),
(92, 92, 21, 13, '2022-04-15'),
(93, 92, 21, 13, '2022-04-16'),
(94, 92, 21, 13, '2022-04-17'),
(95, 92, 21, 13, '2022-04-18'),
(96, 92, 21, 13, '2022-04-19'),
(97, 92, 21, 13, '2022-04-20'),
(98, 92, 21, 13, '2022-04-21'),
(99, 92, 22, 14, '2022-04-07'),
(100, 92, 22, 14, '2022-04-08'),
(101, 92, 22, 14, '2022-04-09'),
(102, 92, 22, 14, '2022-04-10'),
(103, 92, 22, 14, '2022-04-11'),
(104, 92, 22, 14, '2022-04-12'),
(105, 92, 22, 14, '2022-04-13'),
(106, 92, 22, 14, '2022-04-14'),
(107, 92, 22, 14, '2022-04-15'),
(108, 92, 22, 14, '2022-04-16'),
(109, 92, 22, 14, '2022-04-17'),
(110, 92, 22, 14, '2022-04-18'),
(111, 92, 22, 14, '2022-04-19');

-- --------------------------------------------------------

--
-- Structure de la table `gite_option`
--

DROP TABLE IF EXISTS `gite_option`;
CREATE TABLE IF NOT EXISTS `gite_option` (
  `id_gite_suppl` int(11) NOT NULL AUTO_INCREMENT,
  `id_gite` int(11) NOT NULL,
  `id_suppl` int(11) NOT NULL,
  PRIMARY KEY (`id_gite_suppl`)
) ENGINE=MyISAM AUTO_INCREMENT=338 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `gite_option`
--

INSERT INTO `gite_option` (`id_gite_suppl`, `id_gite`, `id_suppl`) VALUES
(337, 64, 4),
(336, 64, 2),
(329, 65, 4),
(328, 65, 3),
(327, 65, 2),
(260, 83, 4),
(259, 83, 3),
(258, 83, 2),
(257, 83, 1),
(263, 82, 4),
(262, 82, 3),
(261, 82, 2),
(267, 81, 4),
(266, 81, 3),
(269, 80, 4),
(270, 79, 3),
(272, 78, 4),
(271, 78, 2),
(265, 81, 2),
(264, 81, 1),
(304, 75, 4),
(303, 75, 3),
(302, 75, 2),
(301, 75, 1),
(268, 80, 3),
(256, 84, 4),
(255, 84, 2),
(254, 85, 3),
(253, 85, 2),
(252, 85, 1),
(251, 86, 3),
(250, 87, 3),
(249, 88, 4),
(248, 88, 3),
(247, 88, 2),
(246, 88, 1),
(245, 89, 3),
(244, 89, 2),
(243, 89, 1),
(242, 90, 4),
(241, 90, 3),
(240, 90, 2),
(239, 90, 1),
(238, 91, 4),
(237, 91, 3),
(236, 91, 2),
(235, 91, 1),
(234, 92, 4),
(233, 92, 3),
(232, 92, 2),
(231, 92, 1),
(226, 93, 3),
(225, 93, 2),
(224, 93, 1),
(223, 94, 3),
(222, 94, 2),
(221, 94, 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `id_gite` int(11) NOT NULL,
  `name_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id_image`, `id_gite`, `name_image`) VALUES
(43, 82, 'goodvibes_060422093602_0.jpg'),
(42, 81, 'ladolcevitaauborddemer_060422093443_1.jpg'),
(41, 81, 'ladolcevitaauborddemer_060422093443_0.jpg'),
(40, 80, 'cosyflataucentreville_060422093342_1.jpg'),
(38, 79, 'cityoflight_060422093243_1.jpg'),
(39, 80, 'cosyflataucentreville_060422093342_0.jpg'),
(44, 82, 'goodvibes_060422093602_1.jpg'),
(76, 64, 'lapetitemaisondanslaprairie_070422072909_0.jpg'),
(77, 64, 'lapetitemaisondanslaprairie_070422072909_1.jpg'),
(45, 83, 'inthesun_060422093656_0.jpg'),
(37, 79, 'cityoflight_060422093243_0.jpg'),
(36, 78, 'antibessouslestropiques_060422093140_1.jpg'),
(35, 78, 'antibessouslestropiques_060422093140_0.jpg'),
(46, 83, 'inthesun_060422093656_1.jpg'),
(47, 84, 'inthewild_060422093748_0.jpg'),
(48, 84, 'inthewild_060422093748_1.jpg'),
(49, 85, 'themediterranean_060422093929_0.jpg'),
(50, 85, 'themediterranean_060422093929_1.jpg'),
(51, 86, 'thecharming_060422094039_0.jpg'),
(52, 86, 'thecharming_060422094039_1.jpg'),
(53, 87, 'laparisienne_060422094124_0.jpg'),
(54, 87, 'laparisienne_060422094124_1.jpg'),
(55, 88, 'puremountainair_060422094351_0.jpg'),
(56, 88, 'puremountainair_060422094351_1.jpg'),
(57, 89, 'theluxurious_060422094500_0.jpg'),
(58, 89, 'theluxurious_060422094500_1.jpg'),
(59, 90, 'thegentle_060422094548_0.jpg'),
(60, 90, 'thegentle_060422094548_1.jpg'),
(61, 91, 'strongincharacter_060422094644_0.jpg'),
(62, 91, 'strongincharacter_060422094644_1.jpg'),
(63, 92, 'simplyquiet_060422094742_0.jpg'),
(64, 92, 'simplyquiet_060422094742_1.jpg'),
(65, 93, 'relaxationplace_060422094830_0.jpg'),
(66, 93, 'relaxationplace_060422094830_1.jpg'),
(67, 94, 'lamaisondereve_060422095004_0.jpg'),
(68, 75, 'lavilladescoeursbrises_070422065610_0.jpg'),
(69, 75, 'lavilladescoeursbrises_070422065610_1.jpg'),
(74, 65, 'chezmartine_070422072036_0.jpg'),
(75, 65, 'chezmartine_070422072036_1.jpg'),
(78, 64, 'lapetitemaisondanslaprairie_070422072909_2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id_suppl` int(11) NOT NULL AUTO_INCREMENT,
  `name_suppl` varchar(25) NOT NULL,
  PRIMARY KEY (`id_suppl`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id_suppl`, `name_suppl`) VALUES
(1, 'Piscine'),
(2, 'Jardin'),
(3, 'Parking'),
(4, 'Animaux acceptés');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
