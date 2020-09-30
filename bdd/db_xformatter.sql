-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 30 sep. 2020 à 10:14
-- Version du serveur :  8.0.21-0ubuntu0.20.04.4
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_xformatter`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `quantite` int NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `nom`, `description`, `quantite`, `prix`) VALUES
(2, 'UC', 'Pentium IV\r\nCompaq', 2, 180000),
(4, 'Ordinateur de bureau', 'HP proliant\r\nIntel Atom', 25, 450000),
(5, 'UC', 'Ordinateur de bureau N° : 4', 1, 400000),
(6, 'UC', 'Ordinateur de bureau N° : 5', 1, 400000),
(7, 'UC', 'Ordinateur de bureau N° : 6', 1, 400000),
(8, 'UC', 'Ordinateur de bureau N° : 7', 1, 400000),
(9, 'UC', 'Ordinateur de bureau N° : 8', 1, 400000),
(10, 'UC', 'Ordinateur de bureau N° : 9', 1, 400000),
(11, 'UC', 'Ordinateur de bureau N° : 10', 1, 400000),
(12, 'UC', 'Ordinateur de bureau N° : 11', 1, 400000),
(13, 'UC', 'Ordinateur de bureau N° : 12', 1, 400000),
(14, 'UC', 'Ordinateur de bureau N° : 13', 1, 400000),
(15, 'UC', 'Ordinateur de bureau N° : 14', 1, 400000),
(17, 'UC', 'Ordinateur de bureau N° : 16', 1, 400000),
(18, 'UC', 'Ordinateur de bureau N° : 17', 1, 400000),
(19, 'UC', 'Ordinateur de bureau N° : 18', 1, 400000),
(21, 'Laptop', 'Dual core\r\nSous carton\r\nMarque HP', 15, 500000);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `users_id` int NOT NULL,
  `etats_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `users_id`, `etats_id`, `name`, `created_at`) VALUES
(1, 1, 1, 'Sport', '2020-09-23 17:36:42'),
(2, 1, 1, 'Politique', '2020-09-23 17:44:58'),
(4, 1, 1, 'IT', '2020-09-23 23:57:51'),
(5, 1, 1, 'Art', '2020-09-24 00:00:54'),
(6, 1, 1, 'Religion', '2020-09-24 00:03:04'),
(7, 1, 1, 'Education', '2020-09-24 00:03:53'),
(8, 1, 1, 'Divers', '2020-09-24 00:06:03');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `etats_id` int NOT NULL,
  `pages_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

CREATE TABLE `etats` (
  `id` int NOT NULL,
  `lib_etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etats`
--

INSERT INTO `etats` (`id`, `lib_etat`) VALUES
(1, 'Activé'),
(2, 'Desactivé');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` int NOT NULL,
  `users_id` int NOT NULL,
  `etats_id` int NOT NULL,
  `categories_id` int DEFAULT NULL,
  `pages_id` int DEFAULT NULL,
  `menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `metas`
--

CREATE TABLE `metas` (
  `id` int NOT NULL,
  `mots_cles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_type_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `meta_page`
--

CREATE TABLE `meta_page` (
  `id` int NOT NULL,
  `users_id` int NOT NULL,
  `etats_id` int NOT NULL,
  `pages_id` int NOT NULL,
  `metas_id` int NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `meta_type`
--

CREATE TABLE `meta_type` (
  `id` int NOT NULL,
  `lib_type_meta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200908101700', '2020-09-16 20:59:53'),
('20200916204012', '2020-09-16 20:59:55'),
('20200916204231', '2020-09-16 21:05:52'),
('20200916210526', '2020-09-16 21:08:54'),
('20200916211253', '2020-09-16 21:15:14'),
('20200916212017', '2020-09-16 21:25:26'),
('20200916215435', '2020-09-16 22:02:08'),
('20200917133015', '2020-09-17 13:34:40'),
('20200919180143', '2020-09-19 18:03:50');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `users_id` int NOT NULL,
  `etats_id` int NOT NULL,
  `categories_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `titre`, `slug`, `introduction`, `contenu`, `images`, `created_at`, `updated_at`, `users_id`, `etats_id`, `categories_id`) VALUES
(1, 'Ampefiloha : Trano fitehirizana entana may kila forehitra', 'ampefiloha-trano-fitehirizana-entana-may-kila-forehitra', 'An-tapitrisany mahery no tetibidin’ireo entana kila forehitra omaly, nandritra ny firehetan’ny trano nitobian’izany tetsy Ampefiloha.', '<p>Tokony ho tamin&rsquo;ny telo ora sy sasany tany ho any no nanomboka nidonan-tsetroka ny trano lehibe iray tetsy Ampefiloha, tsy lavitra ny tranoben&rsquo;ny Cnaps. Nijolofotra nanaka-danitra avy hatrany ny setroka mainty, narahana lelafo nijoajoala tsy nisy toa izany. Hatairana ny an&rsquo;ireo mponina teo amin&rsquo;ny manodidina, indrindra moa fa ny an&rsquo;ireo mpivarotra teny an-toerana. Nikoropaka sy niolomay samy namonjy ny tenany sy izay entana azo novonjena avokoa ny rehetra. Araka ny fantatra hatrany dia karazan&rsquo;irony trano lehibe fitehirizana entana, na &laquo;entrepot&raquo;, ity nataon&rsquo;ny afo kilalao ity. Minitra vitsy monja taorian&rsquo;ny nampandrenesana azy ireo no tonga ny mpamonjy voina niaraka tamin&rsquo;ireo fiarabe mpamono afo maromaro.</p>\r\n\r\n<p>Tsy lavitra azy ireo ny toerana saingy nisedra olana izy ireo nony teny an-toerana noho ny lalana tery miditra any amin&rsquo;ilay trano nirehitra sy ny hamaroan&rsquo;ny olana, hany ka nanano sarotra ny famonoana sy ny fifehezana ny afo. Karazan&rsquo;entana maromaro mora mirehitra rahateo avokoa ny tao anatiny. Antony nampiredareda sy nampitatra haingana ny afo, hoy ny fanazav&agrave;na azo. Tonga nanampy ireo mpamonjy voina avy etsy Tsaralal&agrave;na tamin&rsquo;ny famonoana ny afo moa ireo miaramilan&rsquo;ny CPC (Corps de protection civile) avy eny Ivato. Naharitra ora vitsivitsy araka izany ny nifehezana ny afo saingy mbola tsy maty tanteraka izany tamin&rsquo;ny fotoana nanoratanay. Hatreto raha ny voalaza hatrany dia mbola tsy fantatra mazava izay tena antony nahatonga izao firehetana izao. Heverina fa ny fanadihadiana ataon&rsquo;ireo tompon&rsquo;andraikitra amin&rsquo;izany no ahafatarana ny marina mahakasika izany. Marihana moa fa na dia teo aza ny hahalehiben&rsquo;ny fahavoazana dia tsy nisy ny namoy ny ainy na ny naratra tao anatin&rsquo;izany loza izany, araka ny nambaran&rsquo;ny tompon&rsquo;andraikitra avy tao amin&rsquo;ny mpamonjy voina.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>&nbsp; m.L</strong></p>', '5f6cdff4e1630131605744.png', '2020-09-24 03:58:24', '2020-09-24 20:05:40', 1, 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `nom_user`, `prenom_user`, `is_verified`) VALUES
(1, 'touky.340@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Xnui8xr+JtolHD7n4FeL/g$WbgAjDCHER7OVawuqB/nFDA6JDhxbvDRMHxbdOciHOQ', 'Touky', 'Herinjaka', 0),
(4, 'devboutiques@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$BUGOOY/c/0oZew1G+NsVPA$U65CAmv5COE3mqpzqQSw8hVGCNIiXixZznwusKwRADw', 'Touky', 'Herinjaka', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3AF3466867B3B43D` (`users_id`),
  ADD KEY `IDX_3AF34668CA7E0C2E` (`etats_id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D9BEC0C4CA7E0C2E` (`etats_id`),
  ADD KEY `IDX_D9BEC0C4401ADD27` (`pages_id`);

--
-- Index pour la table `etats`
--
ALTER TABLE `etats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_727508CF67B3B43D` (`users_id`),
  ADD KEY `IDX_727508CFCA7E0C2E` (`etats_id`),
  ADD KEY `IDX_727508CFA21214B7` (`categories_id`),
  ADD KEY `IDX_727508CF401ADD27` (`pages_id`);

--
-- Index pour la table `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4D6AF93C989D9B62` (`slug`),
  ADD KEY `IDX_4D6AF93C8C379371` (`meta_type_id`);

--
-- Index pour la table `meta_page`
--
ALTER TABLE `meta_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_87ACC56367B3B43D` (`users_id`),
  ADD KEY `IDX_87ACC563CA7E0C2E` (`etats_id`),
  ADD KEY `IDX_87ACC563401ADD27` (`pages_id`),
  ADD KEY `IDX_87ACC56323290B3B` (`metas_id`);

--
-- Index pour la table `meta_type`
--
ALTER TABLE `meta_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2074E575989D9B62` (`slug`),
  ADD KEY `IDX_2074E57567B3B43D` (`users_id`),
  ADD KEY `IDX_2074E575CA7E0C2E` (`etats_id`),
  ADD KEY `IDX_2074E575A21214B7` (`categories_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etats`
--
ALTER TABLE `etats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `metas`
--
ALTER TABLE `metas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `meta_page`
--
ALTER TABLE `meta_page`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `meta_type`
--
ALTER TABLE `meta_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_3AF3466867B3B43D` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_3AF34668CA7E0C2E` FOREIGN KEY (`etats_id`) REFERENCES `etats` (`id`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `FK_D9BEC0C4401ADD27` FOREIGN KEY (`pages_id`) REFERENCES `pages` (`id`),
  ADD CONSTRAINT `FK_D9BEC0C4CA7E0C2E` FOREIGN KEY (`etats_id`) REFERENCES `etats` (`id`);

--
-- Contraintes pour la table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `FK_727508CF401ADD27` FOREIGN KEY (`pages_id`) REFERENCES `pages` (`id`),
  ADD CONSTRAINT `FK_727508CF67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_727508CFA21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_727508CFCA7E0C2E` FOREIGN KEY (`etats_id`) REFERENCES `etats` (`id`);

--
-- Contraintes pour la table `metas`
--
ALTER TABLE `metas`
  ADD CONSTRAINT `FK_4D6AF93C8C379371` FOREIGN KEY (`meta_type_id`) REFERENCES `meta_type` (`id`);

--
-- Contraintes pour la table `meta_page`
--
ALTER TABLE `meta_page`
  ADD CONSTRAINT `FK_87ACC56323290B3B` FOREIGN KEY (`metas_id`) REFERENCES `metas` (`id`),
  ADD CONSTRAINT `FK_87ACC563401ADD27` FOREIGN KEY (`pages_id`) REFERENCES `pages` (`id`),
  ADD CONSTRAINT `FK_87ACC56367B3B43D` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_87ACC563CA7E0C2E` FOREIGN KEY (`etats_id`) REFERENCES `etats` (`id`);

--
-- Contraintes pour la table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `FK_2074E57567B3B43D` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_2074E575A21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_2074E575CA7E0C2E` FOREIGN KEY (`etats_id`) REFERENCES `etats` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
