-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 01:27 PM
-- Server version: 5.7.33
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oc5`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `json` mediumtext COLLATE utf8mb4_unicode_ci,
  `up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`id`, `category`, `up`) VALUES
(1, 'public', '2023-08-18 10:40:03'),
(2, 'trucs', '2023-08-18 10:40:03'),
(3, 'works', '2023-08-24 13:42:06'),
(4, 'prog', '2023-08-24 20:00:13'),
(5, 'lessons', '2023-08-25 13:40:22'),
(6, 'philo', '2023-08-26 12:45:42'),
(7, 'fun', '2023-08-26 12:46:28'),
(8, 'home', '2023-12-26 13:40:13'),
(10, 'erzer', '2023-12-27 14:47:57'),
(11, 'jhgjhg', '2023-12-27 14:51:23'),
(12, 'nouvelle', '2023-12-29 12:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `msg` mediumtext COLLATE utf8mb4_unicode_ci,
  `pub` int(1) NOT NULL,
  `up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `uid`, `name`, `mail`, `msg`, `pub`, `up`) VALUES
(1, 21, 'kjk', 'kljkl', 'Quod deserunt quibusdam harum debitis. Amet omnis vel est similique fuga culpa eos. Ut alias voluptate ratione sed ut.', 0, '2023-12-27 12:30:03'),
(2, 21, 'jkn', 'n,b,k', 'Ratione id sed dolorem. Qui voluptatem doloribus praesentium est cum nihil ut. Animi suscipit quia eaque aliquam atque qui occaecati. Vel nostrum incidunt voluptatum inventore earum consectetur aperiam molestiae. Fugiat facilis velit velit doloremque ullam. Nesciunt neque delectus hic laudantium quaerat voluptatibus officiis ut.', 0, '2023-12-27 12:30:14'),
(3, 21, 'jkn', 'j.k@k.h', 'Error eum at consectetur eos illum illum vitae necessitatibus. Possimus omnis exercitationem et qui. Impedit explicabo laborum laboriosam sunt exercitationem repudiandae.', 0, '2023-12-27 12:30:24'),
(4, 1, 'fd', 'fd@fd.gdf', 'Debitis sit qui est exercitationem. Est enim qui blanditiis laborum et labore. Fuga est voluptas in odio.', 1, '2023-12-27 12:30:32'),
(5, 1, 'fgh', 'fgh@fgh.fgh', 'Optio corrupti possimus totam. Eum nisi aut voluptas occaecati asperiores. Voluptas non enim labore placeat inventore non. Dolor quos expedita nesciunt error ipsum. Ullam quis qui animi ullam.', 1, '2023-12-27 12:30:36'),
(6, 1, 'fgh', 'fgh@fgh.fgh', 'Quod deserunt quibusdam harum debitis. Amet omnis vel est similique fuga culpa eos. Ut alias voluptate ratione sed ut.', 1, '2023-12-27 12:30:45'),
(7, 0, 'jean', 'jean@valjeans.com', 'Ratione id sed dolorem. Qui voluptatem doloribus praesentium est cum nihil ut. Animi suscipit quia eaque aliquam atque qui occaecati. Vel nostrum incidunt voluptatum inventore earum consectetur aperiam molestiae. Fugiat facilis velit velit doloremque ullam. Nesciunt neque delectus hic laudantium quaerat voluptatibus officiis ut.', 1, '2023-12-27 12:30:52'),
(8, 1, 'ert', 'ret@ert.ert', 'Error eum at consectetur eos illum illum vitae necessitatibus. Possimus omnis exercitationem et qui. Impedit explicabo laborum laboriosam sunt exercitationem repudiandae.', 1, '2023-12-27 12:30:58'),
(9, 1, 'sfd', 'sd@dfg.fg', 'Optio corrupti possimus totam. Eum nisi aut voluptas occaecati asperiores. Voluptas non enim labore placeat inventore non. Dolor quos expedita nesciunt error ipsum. Ullam quis qui animi ullam.', 1, '2023-12-27 12:32:40'),
(10, 1, 'fddf', 'dffd@dffd.dffd', 'dffd', 1, '2023-12-27 15:09:17'),
(11, 0, 'ssf', 'dsf@sfd.sf', 'sdf', 1, '2023-12-29 12:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `excerpt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` mediumtext COLLATE utf8mb4_unicode_ci,
  `pub` int(11) DEFAULT NULL,
  `lastup` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `catid`, `title`, `excerpt`, `content`, `pub`, `lastup`, `up`) VALUES
(1, 1, 4, 'Welcome', 'Page d’accueil', 'Si jamais vous tombez sur cette page, je vous dis bonjour.<br>', 1, '2023-08-17 21:09:57', '2023-08-17 19:09:57'),
(2, 1, 5, 'Gâteau', 'Faire que ce soit bon', '<div>Un logiciel est comme un gâteau.</div><div>Il fonctionne par couches.</div><div>La pâte est l\'infrastructure sur laquelle tout repose.</div><div>Le lit est la couche fonctionnelle qui sert à simplifier le reste, pour pas qu\'il colle à la pâte.</div><div>La consistance est le métier, qui est ce à quoi le logiciel est dédié. Il peut être aux pommes ou même aux frites.</div><div>Le glaçage est ce qui donne son apparence au gâteau, il peut être vernis ou chantilly.</div><div>Et la cerise sur le gâteau c\'est quand ce qu\'on cherche tombe naturellement sous la main.<br></div>', 1, '2023-08-16 21:14:58', '2023-08-17 19:17:59'),
(3, 1, 7, 'Châpiteau', 'Le bureau de voyage', '<div>De la même manière que les cirques vont de villes en villes,</div><div>un logiciel doit pouvoir être porté de concepts en concepts.</div><div>Bien que ce soit séduisant d\'avoir un objet qu\'on peut facilement brancher et débrancher à d\'autres machines, porter un logiciel nécessite quand même tout un déballage d\'artillerie d\'ustensiles pour pouvoir être monté et démonté.</div>', 1, '2023-08-19 18:59:48', '2023-08-19 16:59:48'),
(4, 1, 6, 'Jeu', 'La théorie du jeu', '<div><img src=\"/img/15765888.png\"></div><div><br></div><div>Ce qui est important est de jouer et de s\'amuser.</div><div>Car l\'apprentissage se fait mieux lorsqu\'on ressent du plaisir à ce qu\'on fait.</div><div>Cela se ressent pour l\'utilisateur, qui voit tout de suite quand un travail forcené donne des boutons.<br></div>Ce qui est fait avec le cœur, même si c\'est mal fait, a plus de valeur qu\'un produit industriel où les employés sont malheureux, même si c\'est bien fait.<br>', 1, '2023-08-22 20:55:00', '2023-08-22 18:55:00'),
(18, 1, 3, 'Coffre-fort', 'L\'endroit où on met ce qui est précieux', '<div>Ce qui est précieux dans la prog est l\'envie d\'explorer les potentiels.</div><div>Il ne faut pas placer cette envie entre toutes les mains.</div><div>Les gens aiment bien embaucher des passionnés pour pouvoir profiter quelques mois de leur engouement naturel, qui va ensuite décliner, parce qu\'il n\'est pas généré mais seulement consommé.</div><div>Dans ce cas il vaut mieux scinder clairement ce qui fait notre joie de ce qui est tristement demandé.</div><div>La prog a des vertus thérapeutiques si elle est faite dans la joie. Mais cela, il faut le mettre dans un coffre-fort.<br></div>', 1, '2023-08-24 22:15:21', '2023-08-24 20:15:21'),
(20, 1, 2, 'Yellow submarine', 'C\'est une chanson d\'un groupe du siècle dernier', '<div>La chanson Yellow Submarine parle d\'un mec qui parle tout le temps et qui se balade dans le monde entier dans son sous-marin jaune.</div><div>Il a plein de choses à raconter et il sait tout sur tout. Il est toujours content et plein d\'entrain.</div><div>Mais sa joie de vivre n\'est pas très communicante ce qui fait qu\'il est toujours seul.</div><div>C\'est à cause d\'elle qu\'il ne trouve pas de boulot mais il est content quand même parce que comme ça il peut passer sa vie entière dans son Yellow Submarine.<br></div>', 1, '2023-11-06 16:25:36', '2023-11-06 15:25:36'),
(23, 1, 1, 'Home', 'Logiciel maison 2', '<div>La premier truc est de faire des <b>logiciels-maison</b>. 2<br></div><div>Cela permet de bien intégrer les potentialités de la prog.</div><div>Peu importent les erreurs, ce qui compte c\'est d\'avoir une compréhension de la mécanique.</div>', 1, '2023-12-23 14:46:44', '2023-11-06 15:32:33'),
(24, 1, 8, 'Présentation', 'Dav Dev', '<h3>Trouver le problème</h3>\n<div class=\"excerpt\">C\'est trouver la solution</div>\n<p>Je n\'aime pas parler de moi parce que c\'est aborder un sujet trop complexe pour moi. Mais bon en gros ce qui m\'énerve ce sont les trucs qui ne marchent pas.</p>', 0, '2023-12-26 14:41:15', '2023-11-09 13:10:39'),
(25, 1, 1, 'Travaux en ligne', 'Fractal', '<p><img src=\"/img/15765888.png\"></p>\r\n<p>Framework PHP pour créer des micro-applications facilement. Architecture microservices. Partage de données dans un modèle de travail contributif de type Twitter-Like (réseau semi-ouvert).</p>\r\n<p>Visitez <a href=\"http://logic.ovh\">logic.ovh</a></p>', 0, '2023-12-27 13:46:55', '2023-11-09 13:37:32'),
(26, 13, 1, 'test3', 'tt3', 'test', 0, '2023-12-27 13:27:23', '2023-11-12 14:29:03'),
(27, 1, 1, 'ffh', 'tfty', 'ftyty', 0, '2023-12-29 13:11:41', '2023-12-27 14:23:26'),
(31, 1, 12, 'dfszerz', 'zerze', 'rzer', 0, '2023-12-29 13:11:42', '2023-12-27 14:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `uid`, `surname`, `slogan`, `banner`, `logo`, `up`) VALUES
(1, 1, 'dav', 'il est où le problème', '24601_4_1.jpg', '15765888.png', '2023-10-16 12:56:47'),
(2, 2, 'user2', 'user2 is there', '', '', '2023-10-22 13:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `uid`, `url`, `up`) VALUES
(1, 1, 'http://a.com', '2023-10-16 12:29:31'),
(2, 1, 'http://b.com', '2023-10-16 12:29:31'),
(3, 1, 'http://x.com', '2023-10-16 12:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txt` mediumtext COLLATE utf8mb4_unicode_ci,
  `pub` int(11) DEFAULT NULL,
  `up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `uid`, `bid`, `name`, `mail`, `txt`, `pub`, `up`) VALUES
(1, 1, 1, 'sophie', '', 'Bonjour, bravo pour l\'initiative.', 1, '2023-10-22 12:59:23'),
(2, 2, 1, 'julio', '', 'hello aussi', 0, '2023-10-22 12:59:23'),
(3, 21, 23, 'géraldine', '', 'Bravo pour l\'initiative !', 1, '2023-11-06 16:26:35'),
(4, 21, 2, 'roberta', '', 'Voilà une belle initiative !', 1, '2023-11-06 20:31:41'),
(5, 21, 2, 'd', '', 'jhgj', 0, '2023-11-07 10:08:24'),
(6, 21, 2, 'd', '', 'jkhk', 0, '2023-11-07 10:18:09'),
(7, 21, 2, 'd', '', 'jkhk', 0, '2023-11-07 10:18:30'),
(8, 21, 2, 'd', '', 'iuyi', 0, '2023-11-07 10:22:33'),
(9, 21, 2, 'd', '', 'lkjl', 0, '2023-11-07 10:34:08'),
(10, 21, 2, 'albert', '', 'lkjl', 0, '2023-11-07 10:34:13'),
(11, 21, 2, 'roger', '', 'Personne ne fait de faute sur ce site ?', 1, '2023-11-07 10:34:30'),
(12, 21, 2, 'ernst', '', 'Je suis tout-à-fait d\'accord.', 1, '2023-11-08 19:08:31'),
(13, 21, 23, 'micheline', '', 'Très bon site', 0, '2023-11-09 11:35:23'),
(14, 21, 23, 'roger', '', 'Je n\'aurais pas dit mieux.\n\nkjhkjhkh', 0, '2023-11-09 11:54:57'),
(15, 21, 4, 'pierre', '', 'Excellent', 1, '2023-11-09 13:09:36'),
(16, 21, 25, 'pablo', '', 'Hola pablar espagnol, donde esta la callé ?', 1, '2023-11-09 13:43:52'),
(17, 21, 25, 'favela', '', 'Il fallait y penser quand même.', 1, '2023-11-09 13:45:49'),
(18, 26, 23, 'pokemon', '', 'Je crois que j\'arrive à saisir l\'analogie.', 1, '2023-11-09 14:28:10'),
(19, 21, 1, 'bidule', '', 'Je vois tout-à-fait.', 1, '2023-11-13 11:55:44'),
(20, 21, 25, 'paul', '', 'hello', 0, '2023-11-14 10:16:27'),
(21, 21, 25, 'john', 'd@d.d', ',khg', 0, '2023-11-14 14:02:40'),
(30, 21, 1, 'd', 'd@d.d', 'jhgj', 0, '2023-11-14 15:30:22'),
(31, 21, 1, 'd', 'd@d.d', 'jhgjhj', 0, '2023-11-14 15:30:35'),
(32, 1, 26, 'boris', 'd@d.d', 'Très bien.', 1, '2023-12-04 12:16:35'),
(33, 1, 1, 'françois', 'd@d.d', 'Une phrase avec un point.', 1, '2023-12-07 15:20:25'),
(34, 13, 1, 'drodinette', 'd@d.d', 'Très bonne analyse.', 1, '2023-12-12 14:52:28'),
(35, 1, 23, 'julie', 'd@d.d', 'Bonjour, vous avez raison.', 1, '2023-12-18 14:32:07'),
(36, 1, 23, 'dav', 'd@d.d', 'khgkjh', 0, '2023-12-18 14:41:56'),
(37, 1, 23, 'dav', 'd@d.d', 'kjhgjh', 0, '2023-12-18 14:42:14'),
(38, 1, 23, 'dav', 'd@d.d', 'jhg', 0, '2023-12-18 14:44:14'),
(39, 1, 23, 'dav', 'd@d.d', 'hj', 0, '2023-12-18 14:45:16'),
(40, 1, 23, 'dav', 'd@d.d', 'kjhkj', 0, '2023-12-18 14:45:35'),
(41, 27, 1, 'julia', 'd2@d.d', 'Ah oui ça y est je comprends.', 1, '2023-12-19 10:47:06'),
(42, 1, 26, 'julien', 'd@d.d', 'En effet c\'est intéressant.', 1, '2023-12-19 11:11:51'),
(43, 0, 3, 'jules', 'j@k.k', 'Bien vu', 1, '2023-12-22 12:52:25'),
(44, 0, 3, 'dsf', 'fds@d.f', 'Bravo', 0, '2023-12-22 13:33:03'),
(45, 0, 3, 'dfg', 'dfgdf@dfg.dfg', 'Voilà une bonne idée.', 0, '2023-12-22 13:34:14'),
(46, 0, 3, 'gdfg', 'dfg@dfg.dfg', 'On se demande à quoi ça sert', 0, '2023-12-22 13:34:45'),
(47, 0, 23, 'ds', 'zer@zer.zer', 'tsdt', 0, '2023-12-26 14:48:20'),
(48, 0, 1, 'dfgdf', 'dfgdf@dfg.dfg', 'ggfdg', 0, '2023-12-29 12:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `auth` int(11) DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pswd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `auth`, `mail`, `pswd`, `up`) VALUES
(1, 'dav', 6, 'd@d.d', '$2y$10$P129uyqS/Hd4rF5J0kDcuuCvuoLOyQhurMHi1FvXGm/C2HeUAWnNC', '2023-09-03 14:45:53'),
(2, 'user2', 1, 'user1@oc5.com', '$2y$10$P129uyqS/Hd4rF5J0kDcuuCvuoLOyQhurMHi1FvXGm/C2HeUAWnNC', '2023-10-22 13:00:06'),
(13, 'd', 1, 'd@d.d', '$2y$10$P129uyqS/Hd4rF5J0kDcuuCvuoLOyQhurMHi1FvXGm/C2HeUAWnNC', '2023-10-30 18:36:40'),
(21, 'd1', 1, 'd@d.d', '$2y$10$pIVas6nU90mKzhl1LvBYs.muyyhO6G4emMZEY8nahyRAqXbdl95p2', '2023-10-30 20:07:15'),
(22, 'd2', 1, 'd@d.d', '$2y$10$DYa5PwgVQo58snXSktA63OFsfiVo5M1h4J9x80p97opeMsK52pXGm', '2023-10-31 10:08:22'),
(25, 'g', 1, 'g', '$2y$10$.kH.WolFqPK/eLOR6WFUceEi6NVlIwz5z4kCT7/aE9Ktj2INnCgnC', '2023-11-02 15:17:21'),
(26, 'jhgj', 1, 'j@j.j', '$2y$10$778ZW2gKz2Lv01nvixezBOEspJUGUwGl.O78L919qQe133JiawFpO', '2023-11-09 14:27:00'),
(27, 'd2', 1, 'd2@d.d', '$2y$10$rCAKJI3g2juKaxxYOB53ieJMWCKiq9GFwBalYpkpIPGBu5haxBiKC', '2023-12-19 10:45:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
