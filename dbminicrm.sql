-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2020 at 09:37 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbminicrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'minimum 100x100',
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `logo`, `website`, `created_at`, `updated_at`) VALUES
(10, 'PT PUPUK SRIWIDJAJA', 'pusri@pusri.co.id', 'ff549270-ec77-11ea-89af-fff866c88a26-1598981071.png', 'pusri.co.id', '2020-09-01 10:24:31', '2020-09-01 10:24:31'),
(29, 'PT PERTAMINA', 'staff@pertamina.co.id', '938e6360-ecd4-11ea-a71a-a1a66f22b791-1599020834.png', 'pertamina.co.id', '2020-09-01 21:27:14', '2020-09-01 21:27:14'),
(30, 'PT TIGA RODA', 'staff@tigaroda.co.id', '20026600-ecd6-11ea-a288-8152e983bf9e-1599021499.jpg', 'tigaroda.co.id', '2020-09-01 21:38:19', '2020-09-01 21:38:19'),
(34, 'PT Holsim', 'staff@holsim.co.id', '823b6310-ece1-11ea-83e1-9b2ee2baf3d5-1599026388.png', 'holsim.co.id', '2020-09-01 22:59:48', '2020-09-01 22:59:48'),
(36, 'PT. Sinar Musi Jaya', 'staff@sinarmusigroup.com', '3e429cb0-ece3-11ea-ba20-79b0a623d763-1599027133.png', 'sinarmusigroup.com', '2020-09-01 23:12:13', '2020-09-01 23:12:13'),
(40, 'PT Perusahaan Listrik Negara', 'staff@pln.co.id', '05f5e870-ece5-11ea-9488-59a265858ad8-1599027897.png', 'pln.co.id', '2020-09-01 23:24:58', '2020-09-01 23:24:58'),
(42, 'PT TELKOM', 'staff@telkom.co.id', '3b5060a0-ece6-11ea-b118-053d9b6d61f0-1599028416.png', 'telkom.co.id', '2020-09-01 23:33:37', '2020-09-01 23:33:37'),
(43, 'PT Gramedia', 'staff@gramedia.co.id', '72600190-ece6-11ea-9269-fbf654eb9689-1599028509.jpg', 'gramedia.com', '2020-09-01 23:35:09', '2020-09-01 23:35:09'),
(51, 'Multi Data Palembang', 'staff@mdp.ac.id', '6e14b830-ece8-11ea-9234-a9c7b4875c51-1599029361.png', 'mdp.ac.id', '2020-09-01 23:49:21', '2020-09-01 23:49:21'),
(52, 'PT Karya Anak Bangsa', 'staff@kab.co.id', '581d9030-ece9-11ea-bdc9-3f64b3290dad-1599029753.png', 'KAB.com', '2020-09-01 23:55:53', '2020-09-01 23:55:53'),
(53, 'Mochammad Trinanda', 'mtr@gmail.com', '08ad3330-ecea-11ea-b6bf-a921c584ad08-1599030050.png', 'bossnanda.com', '2020-09-02 00:00:50', '2020-09-02 00:00:50'),
(54, 'PT Digital Solution', 'staff@digital.co.id', '6a5c0460-ecea-11ea-9c1a-5d8d8bf545f5-1599030213.jpg', 'digitalsolution.co.id', '2020-09-02 00:03:33', '2020-09-02 00:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `company_id`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(3, 'Mochammad Trinanda', 'Noviardy', 10, 'm.trinandanoviardy@gmail.com', '082279655366', '2020-09-01 21:19:41', '2020-09-02 00:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, '2014_10_12_000000_create_users_table', 1),
(14, '2020_09_01_033539_create_companies_table', 1),
(15, '2020_09_01_033746_create_employees_table', 1),
(16, '2020_09_02_052825_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$a5YiPiF0gkqqfPRNIdC4FuhZ5lbyM77PgK7tUXCW0AD8Jw6GPxV72', NULL, '2020-09-01 04:56:05', '2020-09-01 04:56:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_email_unique` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_company_id_foreign` (`company_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
