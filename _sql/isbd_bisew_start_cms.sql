-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2019 at 08:36 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isdb_bisew`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `active`, `is_delete`, `name`, `address`, `location`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Amazon.com', 'Amazon.com USA address', 'USA', NULL, 1, '2019-06-23 06:49:28', '2019-06-26 07:38:33'),
(2, 1, 0, 'State Government Georgia', 'Atlanta, USA', 'USA', NULL, 1, '2019-06-26 07:40:52', '2019-06-26 07:40:52'),
(3, 1, 0, 'Medisys', 'KSA, Medisys Company location', 'KSA', NULL, 1, '2019-06-26 07:41:52', '2019-06-26 07:41:52'),
(4, 1, 0, 'Southtech Limited', 'Southtech Limited company dhaka location', 'Dhaka', NULL, 1, '2019-06-26 07:45:19', '2019-06-26 07:45:35'),
(5, 1, 0, 'Govt. of Ras Al Khaima UAE', 'UAE', 'UAE', NULL, 1, '2019-06-26 11:10:27', '2019-06-26 11:10:27'),
(6, 1, 0, 'Spectrum Engineering Ltd', 'Spectrum Engineering Ltd, Dhaka', 'Dhaka', NULL, 1, '2019-06-27 04:42:09', '2019-06-27 04:42:09'),
(7, 1, 0, 'Self Employed', 'Dhaka', 'Dhaka', NULL, 1, '2019-06-27 05:05:37', '2019-06-27 05:05:37'),
(8, 1, 0, 'BelaTech System', 'BelaTech System, Dhaka', 'Dhaka', NULL, 1, '2019-06-27 05:08:26', '2019-06-27 05:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `position_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `active`, `is_delete`, `position_name`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Big Data Consultant', 'Position: Big Data Consultant', 1, '2019-06-23 07:48:11', '2019-06-26 07:30:08'),
(2, 1, 0, 'Senior Database Administrator (DBA)', 'Senior Database Administrator (DBA).', 1, '2019-06-26 07:34:22', '2019-06-26 07:35:32'),
(3, 1, 0, 'IT Head (5 Sea Ports)', 'IT Head (5 Sea Ports)', 1, '2019-06-26 11:11:14', '2019-06-26 11:11:14'),
(4, 1, 0, 'Manager', 'This is the post of Manager', 1, '2019-06-27 04:43:38', '2019-06-27 04:43:38'),
(5, 1, 0, 'Freelancer', 'This is the position of Freelancer.', 1, '2019-06-27 04:48:45', '2019-06-27 04:48:45'),
(6, 1, 0, 'C.E.O', 'chief executive officer', 1, '2019-06-27 05:07:38', '2019-06-27 05:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `rounds`
--

CREATE TABLE `rounds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rounds`
--

INSERT INTO `rounds` (`id`, `active`, `name`, `description`, `start_time`, `end_time`, `is_delete`, `module_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Round-01', 'Round-01', '2019-06-23 08:52:00', '2019-06-23 08:52:00', 0, 1, 1, '2019-06-23 08:52:11', '2019-06-26 07:13:30'),
(2, 1, 'Round-02', 'This is the Round-02', '2019-06-24 06:28:00', '2019-06-25 06:28:00', 0, 1, 1, '2019-06-24 06:29:22', '2019-06-26 07:13:45'),
(3, 1, 'Round-03', 'Round-04', '2019-06-26 07:13:00', '2019-06-26 07:13:00', 0, 1, 1, '2019-06-26 07:14:01', '2019-06-26 07:19:34'),
(4, 1, 'Round-04', 'Round-05', '2019-06-26 07:15:00', '2019-06-26 07:15:00', 0, 1, 1, '2019-06-26 07:15:36', '2019-06-26 07:19:46'),
(5, 1, 'Round-05', 'Round-05', '2019-06-26 07:18:00', '2019-06-26 07:18:00', 0, 1, 1, '2019-06-26 07:18:10', '2019-06-26 07:19:57'),
(6, 1, 'Round-06', 'Round-06', '2019-06-26 07:18:00', '2019-06-26 07:18:00', 0, 1, 1, '2019-06-26 07:18:21', '2019-06-26 07:20:08'),
(7, 1, 'Round-07', 'Round-07', '2019-06-26 07:18:00', '2019-06-26 07:18:00', 0, 1, 1, '2019-06-26 07:18:31', '2019-06-26 07:20:19'),
(8, 1, 'Round-08', 'Round-08', '2019-06-26 07:18:00', '2019-06-26 07:18:00', 0, 1, 1, '2019-06-26 07:18:40', '2019-06-26 07:20:30'),
(9, 1, 'Round-09', 'Round-09', '2019-06-26 07:18:00', '2019-06-26 07:18:00', 0, 1, 1, '2019-06-26 07:18:50', '2019-06-26 07:20:42'),
(10, 1, 'Round-10', 'Round-10', '2019-06-26 07:18:00', '2019-06-26 07:18:00', 0, 1, 1, '2019-06-26 07:19:11', '2019-06-26 07:20:56'),
(11, 1, 'Round-11', 'Round-11', '2019-06-26 07:21:00', '2019-06-26 07:21:00', 0, 1, 1, '2019-06-26 07:21:19', '2019-06-26 07:21:19'),
(12, 1, 'Round-12', 'Round-12', '2019-06-26 07:21:00', '2019-06-26 07:21:00', 0, 1, 1, '2019-06-26 07:21:29', '2019-06-26 07:21:29'),
(13, 1, 'Round-13', 'Round-13', '2019-06-26 07:21:00', '2019-06-26 07:21:00', 0, 1, 1, '2019-06-26 07:21:39', '2019-06-26 07:21:39'),
(14, 1, 'Round-14', 'Round-14', '2019-06-26 07:21:00', '2019-06-26 07:21:00', 0, 1, 1, '2019-06-26 07:21:48', '2019-06-26 07:21:48'),
(15, 1, 'Round-15', 'Round-15', '2019-06-26 07:21:00', '2019-06-26 07:21:00', 0, 1, 1, '2019-06-26 07:21:57', '2019-06-26 07:21:57'),
(16, 1, 'Round-16', 'Round-16', '2019-06-26 07:22:00', '2019-06-26 07:22:00', 0, 1, 1, '2019-06-26 07:22:09', '2019-06-26 07:22:09'),
(17, 1, 'Round-17', 'Round-17', '2019-06-26 07:22:00', '2019-06-26 07:22:00', 0, 1, 1, '2019-06-26 07:22:19', '2019-06-26 07:22:19'),
(18, 1, 'Round-18', 'Round-18', '2019-06-26 07:22:00', '2019-06-26 07:22:00', 0, 1, 1, '2019-06-26 07:22:28', '2019-06-26 07:22:28'),
(19, 1, 'Round-19', 'Round-19', '2019-06-26 07:22:00', '2019-06-26 07:22:00', 0, 1, 1, '2019-06-26 07:22:38', '2019-06-26 07:22:38'),
(20, 1, 'Round-20', 'Round-20', '2019-06-26 07:22:00', '2019-06-26 07:22:00', 0, 1, 1, '2019-06-26 07:22:53', '2019-06-26 07:22:53'),
(21, 1, 'Round-21', 'Round-21', '2019-06-26 07:22:00', '2019-06-26 07:22:00', 0, 1, 1, '2019-06-26 07:23:02', '2019-06-26 07:23:02'),
(22, 1, 'Round-22', 'Round-22', '2019-06-26 07:23:00', '2019-06-26 07:23:00', 0, 1, 1, '2019-06-26 07:23:14', '2019-06-26 07:23:14'),
(23, 1, 'Round-23', 'Round-23', '2019-06-26 07:23:00', '2019-06-26 07:23:00', 0, 1, 1, '2019-06-26 07:23:24', '2019-06-26 07:23:24'),
(24, 1, 'Round-24', 'Round-24', '2019-06-26 07:23:00', '2019-06-26 07:23:00', 0, 1, 1, '2019-06-26 07:23:33', '2019-06-26 07:23:33'),
(25, 1, 'Round-25', 'Round-25', '2019-06-26 07:23:00', '2019-06-26 07:23:00', 0, 1, 1, '2019-06-26 07:23:42', '2019-06-26 07:23:42'),
(26, 1, 'Round-26', 'Round-26', '2019-06-26 07:23:00', '2019-06-26 07:23:00', 0, 1, 1, '2019-06-26 07:23:55', '2019-06-26 07:23:55'),
(27, 1, 'Round-27', 'Round-27', '2019-06-26 07:24:00', '2019-06-26 07:24:00', 0, 1, 1, '2019-06-26 07:24:05', '2019-06-26 07:24:05'),
(28, 1, 'Round-28', 'Round-28', '2019-06-26 07:24:00', '2019-06-26 07:24:00', 0, 1, 1, '2019-06-26 07:24:15', '2019-06-26 07:24:15'),
(29, 1, 'Round-29', 'Round-29', '2019-06-26 07:24:00', '2019-06-26 07:24:00', 0, 1, 1, '2019-06-26 07:24:24', '2019-06-26 07:24:24'),
(30, 1, 'Round-30', 'Round-30', '2019-06-26 07:24:00', '2019-06-26 07:24:00', 0, 1, 1, '2019-06-26 07:24:35', '2019-06-26 07:24:35'),
(31, 1, 'Round-31', 'Round-31', '2019-06-26 07:24:00', '2019-06-26 07:24:00', 0, 1, 1, '2019-06-26 07:24:45', '2019-06-26 07:24:45'),
(32, 1, 'Round-32', 'Round-32', '2019-06-26 07:24:00', '2019-06-26 07:24:00', 0, 1, 1, '2019-06-26 07:24:54', '2019-06-26 07:24:54'),
(33, 1, 'Round-33', 'Round-33', '2019-06-26 07:25:00', '2019-06-26 07:25:00', 0, 1, 1, '2019-06-26 07:25:24', '2019-06-26 07:25:24'),
(34, 1, 'Round-34', 'Round-34', '2019-06-26 07:25:00', '2019-06-26 07:25:00', 0, 1, 1, '2019-06-26 07:25:37', '2019-06-26 07:25:37'),
(35, 1, 'Round-35', 'Round-35', '2019-06-26 07:26:00', '2019-06-26 07:26:00', 0, 1, 1, '2019-06-26 07:26:07', '2019-06-26 07:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` int(11) NOT NULL,
  `round_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `active`, `is_delete`, `name`, `father_name`, `mother_name`, `address`, `email`, `phone`, `module_id`, `round_id`, `subject_id`, `position_id`, `company_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'MD. Shafiqul Islam', 'Father name', 'Mother name', 'This is the student address.', 'shafiq@email.com', '017349054649', 1, 1, 8, 1, 1, 1, '2019-06-24 04:08:28', '2019-06-24 05:25:27'),
(2, 1, 0, 'Md. Mohibur Rahman', 'Father name', 'Mother name', 'this is the address', 'mohib@email.com', '01855874587', 1, 1, 8, 1, 1, 1, '2019-06-24 09:48:02', '2019-06-24 09:48:02'),
(3, 1, 0, 'Shamim Ashrafi', NULL, NULL, NULL, 'shamin@info.com', '01959686532', 1, 1, 3, 1, 1, 1, '2019-06-26 07:46:50', '2019-06-26 07:46:50'),
(4, 1, 0, 'Md. Mahmudur Rahman Khan', NULL, NULL, NULL, 'mahbub@info.com', '015585457458', 1, 1, 3, 3, 5, 1, '2019-06-26 11:11:35', '2019-06-26 11:11:35'),
(5, 1, 0, 'Md. Sharafat Hossain Kamal', NULL, NULL, NULL, 'Sharafat@info.com', '01855323536', 1, 1, 5, 4, 6, 1, '2019-06-27 04:44:49', '2019-06-27 04:44:49'),
(6, 1, 0, 'Enamul Haque Miraz', NULL, NULL, NULL, 'miraz@info.com', '01934858695', 1, 5, 8, 5, 7, 1, '2019-06-27 04:56:28', '2019-06-27 05:05:58'),
(7, 1, 0, 'Mizanur Rahman', NULL, NULL, NULL, 'mizan@info.com', '0189865321', 1, 5, 5, 6, 8, 1, '2019-06-27 05:09:10', '2019-06-27 05:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `subject_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `active`, `is_delete`, `subject_name`, `description`, `module_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Computer Fundamentals', 'Computer Fundamentals', 1, 1, '2019-06-23 08:55:23', '2019-06-23 09:13:40'),
(2, 1, 0, 'Architectural & Civil CAD (ACAD)', 'Architectural & Civil CAD (ACAD)', 1, 1, '2019-06-23 09:17:22', '2019-06-23 09:17:22'),
(3, 1, 0, 'Database Design & Development (DDD)', 'Database Design & Development (DDD)', 1, 1, '2019-06-23 09:17:37', '2019-06-23 09:17:37'),
(4, 1, 0, 'Enterprise System Analysis & Design (C#.Net)', 'Enterprise System Analysis & Design (C#.Net)', 1, 1, '2019-06-23 09:17:51', '2019-06-23 09:17:51'),
(5, 1, 0, 'Enterprise System Analysis & Design (J2EE)', 'Enterprise System Analysis & Design (J2EE)', 1, 1, '2019-06-23 09:18:08', '2019-06-23 09:18:08'),
(6, 1, 0, 'Graphics, Animation & Video Editing (GAVE)', 'Graphics, Animation & Video Editing (GAVE)', 1, 1, '2019-06-23 09:18:20', '2019-06-23 09:18:20'),
(7, 1, 0, 'Networking Technology (NT)', 'Networking Technology (NT)', 1, 1, '2019-06-23 09:18:27', '2019-06-23 09:18:27'),
(8, 1, 0, 'Web-Application Development using PHP & Framework (WDPF)', 'Web-Application Development using PHP & Framework (WDPF)', 1, 1, '2019-06-23 09:18:35', '2019-06-23 09:18:35'),
(9, 1, 0, 'Electrical Works', 'Electrical Works', 2, 1, '2019-07-03 07:29:57', '2019-07-03 07:29:57'),
(10, 1, 0, 'Electronics', 'Electronics', 2, 1, '2019-07-03 07:30:13', '2019-07-03 07:30:13'),
(11, 1, 0, 'Machinist', 'Machinist', 2, 1, '2019-07-03 07:30:23', '2019-07-03 07:30:23'),
(12, 1, 0, 'Refrigeration & Air-Conditioning', 'Refrigeration & Air-Conditioning', 2, 1, '2019-07-03 07:30:34', '2019-07-03 07:30:34'),
(13, 1, 0, 'Welding and Fabrication', 'Welding and Fabrication', 2, 1, '2019-07-03 07:30:45', '2019-07-03 07:30:45'),
(14, 1, 0, 'General Electrical Works', 'General Electrical Works', 3, 1, '2019-07-03 07:33:02', '2019-07-03 07:33:02'),
(15, 1, 0, 'Dress Making & Tailoring', 'Dress Making & Tailoring', 3, 1, '2019-07-03 07:33:13', '2019-07-03 07:33:13'),
(16, 1, 0, 'Welding Works', 'Welding Works', 3, 1, '2019-07-03 07:33:22', '2019-07-03 07:33:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `positions_position_name_unique` (`position_name`);

--
-- Indexes for table `rounds`
--
ALTER TABLE `rounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `students_phone_unique` (`phone`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_subject_name_unique` (`subject_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rounds`
--
ALTER TABLE `rounds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
