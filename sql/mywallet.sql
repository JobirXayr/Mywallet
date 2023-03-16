-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2023 at 08:57 AM
-- Server version: 5.6.47
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mywallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashflows`
--

CREATE TABLE `cashflows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `type` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cashflows`
--

INSERT INTO `cashflows` (`id`, `user_id`, `category_id`, `amount`, `note`, `type`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 60000000, 'Cheers !', 1, 1, '2023-03-13 04:42:18', '2023-03-13 04:42:18'),
(6, 1, 10, 6000000, 'Have a nice trip !', -1, 1, '2023-03-13 04:50:00', '2023-03-13 04:50:00'),
(7, 1, 1, 15000000, 'Some note', 1, 1, '2023-01-13 04:51:35', '2023-01-13 04:51:35'),
(8, 1, 5, 7000000, 'Hard working result!', 1, 1, '2023-02-13 04:52:18', '2023-02-13 04:52:18'),
(9, 1, 8, 1500000, NULL, -1, 1, '2023-02-13 04:53:21', '2023-02-13 04:53:21'),
(10, 1, 16, 500000, NULL, -1, 1, '2023-01-13 04:53:39', '2023-01-13 04:53:39'),
(11, 1, 6, 6500000, NULL, 1, 1, '2023-03-13 05:20:06', '2023-03-13 05:20:06'),
(12, 1, 18, 500000, NULL, -1, 1, '2023-03-13 10:59:46', '2023-03-13 10:59:46'),
(13, 1, 5, 8000000, 'some note here', 1, 1, '2023-03-13 22:09:12', '2023-03-13 22:09:12'),
(14, 1, 19, 4000000, 'some note here', -1, 1, '2023-03-13 22:09:41', '2023-03-13 22:09:41'),
(15, 1, 20, 950000, 'some notes', -1, 1, '2023-03-16 00:39:46', '2023-03-16 00:39:46'),
(16, 1, 3, 4500000, 'some notes here', 1, 1, '2023-03-16 00:40:12', '2023-03-16 00:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `path`, `type`, `created_at`, `updated_at`) VALUES
(1, 0, 'Business', NULL, 1, '2023-03-11 22:40:32', '2023-03-11 22:40:32'),
(2, 0, 'Extra Income', NULL, 1, '2023-03-11 22:41:05', '2023-03-11 22:41:05'),
(3, 0, 'Gifts', NULL, 1, '2023-03-11 22:41:25', '2023-03-11 22:41:25'),
(4, 0, 'Loan', NULL, 1, '2023-03-11 22:41:58', '2023-03-11 22:41:58'),
(5, 0, 'Salary', NULL, 1, '2023-03-11 22:42:26', '2023-03-11 22:42:26'),
(6, 0, 'Other', NULL, 1, '2023-03-11 22:42:50', '2023-03-11 22:42:50'),
(7, 0, 'Gifts', NULL, -1, '2023-03-12 07:30:14', '2023-03-12 07:30:14'),
(8, 0, 'Food & Drink', NULL, -1, '2023-03-12 08:18:34', '2023-03-12 08:18:34'),
(9, 0, 'Shopping', NULL, -1, '2023-03-12 08:35:05', '2023-03-12 08:35:05'),
(10, 0, 'Travel', '1678661912_my_office.jpg', -1, '2023-03-12 08:37:18', '2023-03-12 17:58:32'),
(11, 0, 'Home', '1678628814_certificate.jpg', -1, '2023-03-12 08:46:54', '2023-03-12 08:46:54'),
(12, 0, 'Transport', '1678662032_audi.jpg', -1, '2023-03-12 18:00:32', '2023-03-12 18:00:32'),
(14, 0, 'Work', NULL, -1, '2023-03-13 02:46:39', '2023-03-13 02:46:39'),
(15, 0, 'Family & Personal', NULL, -1, '2023-03-13 02:46:39', '2023-03-13 02:46:39'),
(16, 0, 'Education', NULL, -1, '2023-03-13 02:46:39', '2023-03-13 02:46:39'),
(17, 0, 'Car', NULL, -1, '2023-03-13 02:46:39', '2023-03-13 02:46:39'),
(18, 0, 'Entertainment', NULL, -1, '2023-03-13 02:46:39', '2023-03-13 02:46:39'),
(19, 0, 'Healthcare', NULL, -1, '2023-03-13 02:46:39', '2023-03-13 02:46:39'),
(20, 0, 'Bills & Fees', NULL, -1, '2023-03-13 02:46:39', '2023-03-13 02:46:39'),
(21, 0, 'Other', NULL, -1, '2023-03-13 02:46:39', '2023-03-13 02:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Сум', '2023-03-11 22:03:02', '2023-03-11 22:03:02'),
(2, 'Доллар США', '2023-03-11 22:03:41', '2023-03-11 22:03:41'),
(3, 'Рубль', '2023-03-11 22:03:50', '2023-03-11 22:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2023_03_11_135739_create_currencies_table', 1),
(9, '2023_03_11_135942_create_users_table', 1),
(10, '2023_03_11_223432_create_categories_table', 2),
(13, '2023_03_12_231801_create_cashflows_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `path`, `password`, `remember_token`, `currency_id`, `created_at`, `updated_at`) VALUES
(1, 'Jobir', 'jobir@mail.ru', NULL, '$2y$10$/cEkZFah0yaxojEWCc62gesRwWzRgULBMU4ie27TC3TJ2wKnz1F3G', 'Klfem1LrnxGgClORdQX04f0800cAvWW1QL6YhleklLYSIs5q7kPixLdJ95Dh', 1, '2023-03-11 17:05:23', '2023-03-11 17:05:23'),
(2, 'Hoshimjon', 'hoshimjon@mail.ru', NULL, '$2y$10$poLrLqtawbUTJH7zEjZfz.YOmETDyI9nvAvzZ5ZuBjQLOGoMwmck6', NULL, 1, '2023-03-16 00:50:13', '2023-03-16 00:50:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashflows`
--
ALTER TABLE `cashflows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cashflows_user_id_foreign` (`user_id`),
  ADD KEY `cashflows_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_currency_id_foreign` (`currency_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashflows`
--
ALTER TABLE `cashflows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cashflows`
--
ALTER TABLE `cashflows`
  ADD CONSTRAINT `cashflows_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cashflows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
