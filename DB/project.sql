-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2021 at 04:00 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Food'),
(2, 'Animal'),
(8, 'Shose');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Afghanistan'),
(2, 'Åland Islands'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua and Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bermuda'),
(26, 'Bhutan'),
(27, 'Bolivia (Plurinational State of)'),
(28, 'Bonaire, Sint Eustatius and Saba'),
(29, 'Bosnia and Herzegovina'),
(30, 'Botswana'),
(31, 'Bouvet Island'),
(32, 'Brazil'),
(33, 'British Indian Ocean Territory'),
(34, 'United States Minor Outlying Islands'),
(35, 'Virgin Islands (British)'),
(36, 'Virgin Islands (U.S.)'),
(37, 'Brunei Darussalam'),
(38, 'Bulgaria'),
(39, 'Burkina Faso'),
(40, 'Burundi'),
(41, 'Cambodia'),
(42, 'Cameroon'),
(43, 'Canada'),
(44, 'Cabo Verde'),
(45, 'Cayman Islands'),
(46, 'Central African Republic'),
(47, 'Chad'),
(48, 'Chile'),
(49, 'China'),
(50, 'Christmas Island'),
(51, 'Cocos (Keeling) Islands'),
(52, 'Colombia'),
(53, 'Comoros'),
(54, 'Congo'),
(55, 'Congo (Democratic Republic of the)'),
(56, 'Cook Islands'),
(57, 'Costa Rica'),
(58, 'Croatia'),
(59, 'Cuba'),
(60, 'Curaçao'),
(61, 'Cyprus'),
(62, 'Czech Republic'),
(63, 'Denmark'),
(64, 'Djibouti'),
(65, 'Dominica'),
(66, 'Dominican Republic'),
(67, 'Ecuador'),
(68, 'Egypt'),
(69, 'El Salvador'),
(70, 'Equatorial Guinea'),
(71, 'Eritrea'),
(72, 'Estonia'),
(73, 'Ethiopia'),
(74, 'Falkland Islands (Malvinas)'),
(75, 'Faroe Islands'),
(76, 'Fiji'),
(77, 'Finland'),
(78, 'France'),
(79, 'French Guiana'),
(80, 'French Polynesia'),
(81, 'French Southern Territories'),
(82, 'Gabon'),
(83, 'Gambia'),
(84, 'Georgia'),
(85, 'Germany'),
(86, 'Ghana'),
(87, 'Gibraltar'),
(88, 'Greece'),
(89, 'Greenland'),
(90, 'Grenada'),
(91, 'Guadeloupe'),
(92, 'Guam'),
(93, 'Guatemala'),
(94, 'Guernsey'),
(95, 'Guinea'),
(96, 'Guinea-Bissau'),
(97, 'Guyana'),
(98, 'Haiti'),
(99, 'Heard Island and McDonald Islands'),
(100, 'Holy See'),
(101, 'Honduras'),
(102, 'Hong Kong'),
(103, 'Hungary'),
(104, 'Iceland'),
(105, 'India'),
(106, 'Indonesia'),
(107, 'Côte d\'Ivoire'),
(108, 'Iran (Islamic Republic of)'),
(109, 'Iraq'),
(110, 'Ireland'),
(111, 'Isle of Man'),
(112, 'Israel'),
(113, 'Italy'),
(114, 'Jamaica'),
(115, 'Japan'),
(116, 'Jersey'),
(117, 'Jordan'),
(118, 'Kazakhstan'),
(119, 'Kenya'),
(120, 'Kiribati'),
(121, 'Kuwait'),
(122, 'Kyrgyzstan'),
(123, 'Lao People\'s Democratic Republic'),
(124, 'Latvia'),
(125, 'Lebanon'),
(126, 'Lesotho'),
(127, 'Liberia'),
(128, 'Libya'),
(129, 'Liechtenstein'),
(130, 'Lithuania'),
(131, 'Luxembourg'),
(132, 'Macao'),
(133, 'Macedonia (the former Yugoslav Republic of)'),
(134, 'Madagascar'),
(135, 'Malawi'),
(136, 'Malaysia'),
(137, 'Maldives'),
(138, 'Mali'),
(139, 'Malta'),
(140, 'Marshall Islands'),
(141, 'Martinique'),
(142, 'Mauritania'),
(143, 'Mauritius'),
(144, 'Mayotte'),
(145, 'Mexico'),
(146, 'Micronesia (Federated States of)'),
(147, 'Moldova (Republic of)'),
(148, 'Monaco'),
(149, 'Mongolia'),
(150, 'Montenegro'),
(151, 'Montserrat'),
(152, 'Morocco'),
(153, 'Mozambique'),
(154, 'Myanmar'),
(155, 'Namibia'),
(156, 'Nauru'),
(157, 'Nepal'),
(158, 'Netherlands'),
(159, 'New Caledonia'),
(160, 'New Zealand'),
(161, 'Nicaragua'),
(162, 'Niger'),
(163, 'Nigeria'),
(164, 'Niue'),
(165, 'Norfolk Island'),
(166, 'Korea (Democratic People\'s Republic of)'),
(167, 'Northern Mariana Islands'),
(168, 'Norway'),
(169, 'Oman'),
(170, 'Pakistan'),
(171, 'Palau'),
(172, 'Palestine, State of'),
(173, 'Panama'),
(174, 'Papua New Guinea'),
(175, 'Paraguay'),
(176, 'Peru'),
(177, 'Philippines'),
(178, 'Pitcairn'),
(179, 'Poland'),
(180, 'Portugal'),
(181, 'Puerto Rico'),
(182, 'Qatar'),
(183, 'Republic of Kosovo'),
(184, 'Réunion'),
(185, 'Romania'),
(186, 'Russian Federation'),
(187, 'Rwanda'),
(188, 'Saint Barthélemy'),
(189, 'Saint Helena, Ascension and Tristan da Cunha'),
(190, 'Saint Kitts and Nevis'),
(191, 'Saint Lucia'),
(192, 'Saint Martin (French part)'),
(193, 'Saint Pierre and Miquelon'),
(194, 'Saint Vincent and the Grenadines'),
(195, 'Samoa'),
(196, 'San Marino'),
(197, 'Sao Tome and Principe'),
(198, 'Saudi Arabia'),
(199, 'Senegal'),
(200, 'Serbia'),
(201, 'Seychelles'),
(202, 'Sierra Leone'),
(203, 'Singapore'),
(204, 'Sint Maarten (Dutch part)'),
(205, 'Slovakia'),
(206, 'Slovenia'),
(207, 'Solomon Islands'),
(208, 'Somalia'),
(209, 'South Africa'),
(210, 'South Georgia and the South Sandwich Islands'),
(211, 'Korea (Republic of)'),
(212, 'South Sudan'),
(213, 'Spain'),
(214, 'Sri Lanka'),
(215, 'Sudan'),
(216, 'Suriname'),
(217, 'Svalbard and Jan Mayen'),
(218, 'Swaziland'),
(219, 'Sweden'),
(220, 'Switzerland'),
(221, 'Syrian Arab Republic'),
(222, 'Taiwan'),
(223, 'Tajikistan'),
(224, 'Tanzania, United Republic of'),
(225, 'Thailand'),
(226, 'Timor-Leste'),
(227, 'Togo'),
(228, 'Tokelau'),
(229, 'Tonga'),
(230, 'Trinidad and Tobago'),
(231, 'Tunisia'),
(232, 'Turkey'),
(233, 'Turkmenistan'),
(234, 'Turks and Caicos Islands'),
(235, 'Tuvalu'),
(236, 'Uganda'),
(237, 'Ukraine'),
(238, 'United Arab Emirates'),
(239, 'United Kingdom of Great Britain and Northern Ireland'),
(240, 'United States of America'),
(241, 'Uruguay'),
(242, 'Uzbekistan'),
(243, 'Vanuatu'),
(244, 'Venezuela (Bolivarian Republic of)'),
(245, 'Viet Nam'),
(246, 'Wallis and Futuna'),
(247, 'Western Sahara'),
(248, 'Yemen'),
(249, 'Zambia'),
(250, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `countryId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `productId`, `amount`, `countryId`, `userId`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, '2021-04-29 12:08:20', '2021-04-29 12:08:20'),
(34, 11, 5, 34, 2, '2021-04-29 21:19:53', '2021-04-29 21:22:00'),
(35, 3, 1, 2, 2, '2021-04-29 21:30:53', '2021-04-29 21:30:53'),
(36, 1, 100, 60, 2, '2021-04-30 09:34:50', '2021-04-30 09:34:50'),
(37, 13, 15, 7, 2, '2021-04-30 12:25:12', '2021-04-30 12:25:12'),
(38, 13, 112, 93, 2, '2021-04-30 12:32:54', '2021-04-30 12:33:17');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_04_28_151352_create_products_table', 1),
(4, '2021_04_28_215354_categories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `amountInStock` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `categoryId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `amountInStock`, `created_at`, `updated_at`, `categoryId`) VALUES
(1, 'Bread', 300, '2021-04-29 03:35:09', '2021-04-30 03:35:18', 1),
(2, 'Kola', 200, '2021-04-21 03:35:25', '2021-04-22 03:35:30', 1),
(13, 'Nick', 1000, '2021-04-30 12:24:29', '2021-04-30 12:24:29', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 't', 't@gmail.com', '$2y$10$VJszgg2/O2HHEwP2/E7Psu8ozcG2suT0DbVjG.sG2E0/zr26ez5Li', 'YQlNCi6ozz4Vvodtq4yIbfnduJgMh54wJP7fXPbhqmeUz5Qhes6n2RJufZLV', '2021-04-28 20:27:23', '2021-04-28 20:27:23'),
(2, 't1', 't1@gmail.com', '$2y$10$YMK9iS5u/yU2RsJBMD8o.OZLOdtP8a9fWEvRuwndjdKa2LPwJ9eXu', 'BZvwQUGzgY0jRLGqoiN4x0BBOCPdV7V0h7AleL1g1Umi7FjwV7YigPBffSYc', '2021-04-29 09:07:33', '2021-04-29 09:07:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `countryId` (`countryId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`countryId`) REFERENCES `countries` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
