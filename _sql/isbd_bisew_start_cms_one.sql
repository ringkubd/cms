-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2019 at 06:01 PM
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
-- Database: `isbd_bisew_2.00`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_uri` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `active`, `name`, `icon`, `route_uri`, `method`, `parent_id`, `order`, `visibility`, `description`, `is_delete`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Access Control', 'fa-lock', '#', 'GET', 0, 1, 1, 'Access Control Main Menu.', 0, 1, '2019-08-29 05:05:58', '2019-09-02 08:49:03'),
(2, 1, 'Admin Menu', 'fa-list', '#', 'GET', 1, 0, 1, 'Parent Menu! ', 0, 1, '2019-08-29 05:07:10', '2019-08-29 05:17:29'),
(3, 1, 'All admin-menu', 'fa-list', 'admin-menu', 'GET', 2, 0, 1, 'Data Tables! ', 0, 1, '2019-08-29 05:07:11', '2019-08-29 05:17:29'),
(4, 1, 'Save admin-menu', '', 'admin-menu', 'POST', 2, NULL, 0, 'Store! ', 0, 1, '2019-08-29 05:07:11', '2019-08-29 05:07:11'),
(5, 1, 'Add admin-menu', 'fa-pencil-square-o', 'admin-menu/create', 'GET', 2, 1, 1, 'Create! ', 0, 1, '2019-08-29 05:07:11', '2019-08-29 05:17:29'),
(6, 1, 'Update admin-menu', '', 'admin-menu/{admin_menu}', 'PUT', 2, NULL, 0, 'Update! ', 0, 1, '2019-08-29 05:07:11', '2019-08-29 05:07:11'),
(7, 1, 'Show admin-menu', '', 'admin-menu/{admin_menu}', 'GET', 2, NULL, 0, 'Show! ', 0, 1, '2019-08-29 05:07:11', '2019-08-29 05:07:11'),
(8, 1, 'Destroy admin-menu', '', 'admin-menu/{admin_menu}', 'DELETE', 2, NULL, 0, 'Destroy! ', 0, 1, '2019-08-29 05:07:11', '2019-08-29 05:07:11'),
(9, 1, 'Edit admin-menu', '', 'admin-menu/{admin_menu}/edit', 'GET', 2, NULL, 0, 'Edit! ', 0, 1, '2019-08-29 05:07:11', '2019-08-29 05:07:11'),
(10, 1, 'Save Resource Menu', '', 'save-resource-menu', 'POST', 2, NULL, 0, 'Save Resource Menu', 0, 1, '2019-08-29 05:07:59', '2019-08-29 05:08:11'),
(11, 1, 'Clone Admin Menu', '', 'admin-menu/{admin_menu}/clone', 'GET', 2, NULL, 0, 'Clone Admin Menu', 0, 1, '2019-08-29 05:08:58', '2019-08-29 05:08:58'),
(12, 1, 'Users', 'fa-users', '#', 'GET', 1, 2, 1, 'Parent Menu! ', 0, 1, '2019-08-29 05:10:47', '2019-08-29 05:17:29'),
(13, 1, 'All user', 'fa-list', 'user', 'GET', 12, 0, 1, 'Data Tables! ', 0, 1, '2019-08-29 05:10:48', '2019-08-29 05:17:42'),
(14, 1, 'Save user', '', 'user', 'POST', 12, NULL, 0, 'Store! ', 0, 1, '2019-08-29 05:10:48', '2019-08-29 05:10:48'),
(15, 1, 'Add user', 'fa-pencil-square-o', 'user/create', 'GET', 12, 1, 1, 'Create! ', 0, 1, '2019-08-29 05:10:48', '2019-08-29 05:17:42'),
(16, 1, 'Update user', '', 'user/{user}', 'PUT', 12, NULL, 0, 'Update! ', 0, 1, '2019-08-29 05:10:48', '2019-08-29 05:10:48'),
(17, 1, 'Show user', '', 'user/{user}', 'GET', 12, NULL, 0, 'Show! ', 0, 1, '2019-08-29 05:10:48', '2019-08-29 05:10:48'),
(18, 1, 'Destroy user', '', 'user/{user}', 'DELETE', 12, NULL, 0, 'Destroy! ', 0, 1, '2019-08-29 05:10:48', '2019-08-29 05:10:48'),
(19, 1, 'Edit user', '', 'user/{user}/edit', 'GET', 12, NULL, 0, 'Edit! ', 0, 1, '2019-08-29 05:10:48', '2019-08-29 05:10:48'),
(20, 1, 'Role', 'fa-user', '#', 'GET', 1, 1, 1, 'Parent Menu! ', 0, 1, '2019-08-29 05:11:38', '2019-08-29 05:17:29'),
(21, 1, 'All role', 'fa-list', 'role', 'GET', 20, 0, 1, 'Data Tables! ', 0, 1, '2019-08-29 05:11:38', '2019-08-29 05:17:37'),
(22, 1, 'Save role', '', 'role', 'POST', 20, NULL, 0, 'Store! ', 0, 1, '2019-08-29 05:11:38', '2019-08-29 05:11:38'),
(23, 1, 'Add role', 'fa-pencil-square-o', 'role/create', 'GET', 20, 1, 1, 'Create! ', 0, 1, '2019-08-29 05:11:38', '2019-08-29 05:17:37'),
(24, 1, 'Update role', '', 'role/{role}', 'PUT', 20, NULL, 0, 'Update! ', 0, 1, '2019-08-29 05:11:38', '2019-08-29 05:11:38'),
(25, 1, 'Show role', '', 'role/{role}', 'GET', 20, NULL, 0, 'Show! ', 0, 1, '2019-08-29 05:11:38', '2019-08-29 05:11:38'),
(26, 1, 'Destroy role', '', 'role/{role}', 'DELETE', 20, NULL, 0, 'Destroy! ', 0, 1, '2019-08-29 05:11:38', '2019-08-29 05:11:38'),
(27, 1, 'Edit role', '', 'role/{role}/edit', 'GET', 20, NULL, 0, 'Edit! ', 0, 1, '2019-08-29 05:11:38', '2019-08-29 05:11:38'),
(28, 1, 'Setup Access', 'fa-check-square-o', '#', 'GET', 1, 3, 1, 'Parent Menu!', 0, 1, '2019-08-29 05:12:14', '2019-08-29 05:17:29'),
(29, 1, 'Alignment', 'fa-list', 'setup-access', 'GET', 28, 0, 1, 'Data Tables!', 0, 1, '2019-08-29 05:12:14', '2019-08-29 05:17:47'),
(30, 1, 'Save setup-access', '', 'setup-access', 'POST', 28, NULL, 0, 'Store! ', 0, 1, '2019-08-29 05:12:14', '2019-08-29 05:12:14'),
(31, 1, 'Permission', 'fa-pencil-square-o', 'setup-access/create', 'GET', 28, 1, 1, 'Create!', 0, 1, '2019-08-29 05:12:14', '2019-08-29 05:17:47'),
(32, 1, 'Update setup-access', '', 'setup-access/{setup_access}', 'PUT', 28, NULL, 0, 'Update! ', 0, 1, '2019-08-29 05:12:14', '2019-08-29 05:12:14'),
(33, 1, 'Show setup-access', '', 'setup-access/{setup_access}', 'GET', 28, NULL, 0, 'Show! ', 0, 1, '2019-08-29 05:12:14', '2019-08-29 05:12:14'),
(34, 1, 'Destroy setup-access', '', 'setup-access/{setup_access}', 'DELETE', 28, NULL, 0, 'Destroy! ', 0, 1, '2019-08-29 05:12:14', '2019-08-29 05:12:14'),
(35, 1, 'Edit setup-access', '', 'setup-access/{setup_access}/edit', 'GET', 28, NULL, 0, 'Edit! ', 0, 1, '2019-08-29 05:12:14', '2019-08-29 05:12:14'),
(36, 1, 'Find Admin Menu', '', 'find-admin-menu', 'POST', 28, NULL, 0, 'Find Admin Menu BY AJAX Request', 0, 1, '2019-08-29 05:13:30', '2019-08-29 05:13:30'),
(37, 1, 'Find Alignment Menu', '', 'find-alignment-menu', 'POST', 28, NULL, 0, 'Find Alignment Menu by AJAX request.', 0, 1, '2019-08-29 05:14:16', '2019-08-29 05:14:16'),
(38, 1, 'Save Alignment', '', 'save-alignment', 'POST', 28, NULL, 0, 'Save Menu Alignment.', 0, 1, '2019-08-29 05:15:00', '2019-08-29 05:15:00'),
(39, 1, 'Artisan', 'fa-terminal', 'artisan', 'GET', 1, 4, 1, 'This menu control the artisan command.', 0, 1, '2019-09-01 04:07:37', '2019-09-01 06:06:17'),
(40, 1, 'Artisan Caching', '', 'artisan/cache/{key}', 'GET', 39, NULL, 0, 'This menu for Artisan Caching command.', 0, 1, '2019-09-01 04:51:28', '2019-09-01 05:36:22'),
(41, 1, 'Artisan Clear Caching', '', 'artisan/clear-cache/{key}', 'GET', 39, NULL, 0, 'This menu for Artisan Clear Cache command.', 0, 1, '2019-09-01 05:16:47', '2019-09-01 05:36:12'),
(42, 1, 'Artisan migration with seed.', '', 'artisan/migrate-seed/{app_key}', 'GET', 39, NULL, 0, 'This menu for Artisan migration with seed command.', 0, 1, '2019-09-01 05:47:51', '2019-09-01 05:47:51'),
(43, 1, 'Artisan Database seed', '', 'artisan/db-seed/{app_key}', 'GET', 39, NULL, 0, 'This menu for Artisan Database seed command.', 0, 1, '2019-09-01 06:10:00', '2019-09-01 06:10:00'),
(44, 1, 'Artisan Command Down', '', 'artisan/down/{app_key}', 'GET', 39, NULL, 0, 'This menu for Artisan Command Down command.', 0, 1, '2019-09-01 06:13:49', '2019-09-01 06:13:49'),
(45, 1, 'Artisan Command Up', '', 'artisan/up/{app_key}', 'GET', 39, NULL, 0, 'This menu for Artisan Command Up command.', 0, 1, '2019-09-01 06:14:06', '2019-09-01 06:14:06'),
(46, 1, 'Accessibility', 'fa-check-square', '#', 'GET', 0, 0, 1, 'This is the parent menu of all Accessibility menus.', 0, 1, '2019-09-01 06:44:39', '2019-09-02 08:49:03'),
(47, 1, 'Module', 'fa-list', '#', 'GET', 46, 4, 1, 'Parent Menu! ', 0, 1, '2019-09-01 06:47:07', '2019-09-02 11:28:00'),
(48, 1, 'All module', 'fa-list', 'module', 'GET', 47, NULL, 1, 'Data Tables! ', 0, 1, '2019-09-01 06:47:07', '2019-09-01 06:47:07'),
(49, 1, 'Save module', '', 'module', 'POST', 47, NULL, 0, 'Store! ', 0, 1, '2019-09-01 06:47:07', '2019-09-01 06:47:07'),
(50, 1, 'Add module', 'fa-pencil-square-o', 'module/create', 'GET', 47, NULL, 1, 'Create! ', 0, 1, '2019-09-01 06:47:07', '2019-09-01 06:47:07'),
(51, 1, 'Update module', '', 'module/{module}', 'PUT', 47, NULL, 0, 'Update! ', 0, 1, '2019-09-01 06:47:07', '2019-09-01 06:47:07'),
(52, 1, 'Show module', '', 'module/{module}', 'GET', 47, NULL, 0, 'Show! ', 0, 1, '2019-09-01 06:47:07', '2019-09-01 06:47:07'),
(53, 1, 'Destroy module', '', 'module/{module}', 'DELETE', 47, NULL, 0, 'Destroy! ', 0, 1, '2019-09-01 06:47:07', '2019-09-01 06:47:07'),
(54, 1, 'Edit module', '', 'module/{module}/edit', 'GET', 47, NULL, 0, 'Edit! ', 0, 1, '2019-09-01 06:47:08', '2019-09-01 06:47:08'),
(55, 1, 'Settings', 'fa-wrench', '#', 'GET', 46, 5, 1, 'This is the parent menu settings.', 0, 1, '2019-09-02 06:01:36', '2019-09-02 11:28:01'),
(56, 1, 'General settings', 'fa-flag', 'settings/general-settings', 'GET', 55, 0, 1, 'This is the General settings menu.', 0, 1, '2019-09-02 06:02:20', '2019-09-02 08:49:04'),
(57, 1, 'Save general settings', '', 'settings/general-settings-save', 'POST', 55, NULL, 0, 'Save general settings', 0, 1, '2019-09-02 06:03:15', '2019-09-02 06:03:15'),
(58, 1, 'Themes', 'fa-puzzle-piece', 'settings/theme', 'GET', 55, 1, 1, 'This menu for theme settings.', 0, 1, '2019-09-02 06:31:42', '2019-09-02 08:49:04'),
(59, 1, 'Save Themes', '', 'settings/theme-settings-save', 'POST', 55, NULL, 0, 'This is the settings request for save the themes.', 0, 1, '2019-09-02 06:33:33', '2019-09-02 06:33:33'),
(60, 1, 'Manage Term', 'fa-flag', '#', 'GET', 46, 3, 1, 'Parent Menu! ', 0, 1, '2019-09-02 10:48:14', '2019-09-02 11:28:00'),
(61, 1, 'All term', 'fa-list', 'term', 'GET', 60, 0, 1, 'Data Tables! ', 0, 1, '2019-09-02 10:48:15', '2019-09-02 10:49:15'),
(62, 1, 'Save term', '', 'term', 'POST', 60, NULL, 0, 'Store! ', 0, 1, '2019-09-02 10:48:15', '2019-09-02 10:48:15'),
(63, 1, 'Add term', 'fa-pencil-square-o', 'term/create', 'GET', 60, 1, 1, 'Create! ', 0, 1, '2019-09-02 10:48:15', '2019-09-02 10:49:15'),
(64, 1, 'Update term', '', 'term/{term}', 'PUT', 60, NULL, 0, 'Update! ', 0, 1, '2019-09-02 10:48:15', '2019-09-02 10:48:15'),
(65, 1, 'Show term', '', 'term/{term}', 'GET', 60, NULL, 0, 'Show! ', 0, 1, '2019-09-02 10:48:15', '2019-09-02 10:48:15'),
(66, 1, 'Destroy term', '', 'term/{term}', 'DELETE', 60, NULL, 0, 'Destroy! ', 0, 1, '2019-09-02 10:48:15', '2019-09-02 10:48:15'),
(67, 1, 'Edit term', '', 'term/{term}/edit', 'GET', 60, NULL, 0, 'Edit! ', 0, 1, '2019-09-02 10:48:15', '2019-09-02 10:48:15'),
(68, 1, 'Menu', 'fa-exclamation', '#', 'GET', 46, 0, 1, 'Parent Menu! ', 0, 1, '2019-09-02 11:19:26', '2019-09-02 11:28:00'),
(69, 1, 'All menu', 'fa-list', 'menu', 'GET', 68, 0, 1, 'Data Tables! ', 0, 1, '2019-09-02 11:19:26', '2019-09-02 11:28:01'),
(70, 1, 'Save menu', '', 'menu', 'POST', 68, NULL, 0, 'Store! ', 0, 1, '2019-09-02 11:19:26', '2019-09-02 11:19:26'),
(71, 1, 'Add menu', 'fa-pencil-square-o', 'menu/create', 'GET', 68, 1, 1, 'Create! ', 0, 1, '2019-09-02 11:19:26', '2019-09-02 11:28:01'),
(72, 1, 'Update menu', '', 'menu/{menu}', 'PUT', 68, NULL, 0, 'Update! ', 0, 1, '2019-09-02 11:19:26', '2019-09-02 11:19:26'),
(73, 1, 'Show menu', '', 'menu/{menu}', 'GET', 68, NULL, 0, 'Show! ', 0, 1, '2019-09-02 11:19:26', '2019-09-02 11:19:26'),
(74, 1, 'Destroy menu', '', 'menu/{menu}', 'DELETE', 68, NULL, 0, 'Destroy! ', 0, 1, '2019-09-02 11:19:26', '2019-09-02 11:19:26'),
(75, 1, 'Edit menu', '', 'menu/{menu}/edit', 'GET', 68, NULL, 0, 'Edit! ', 0, 1, '2019-09-02 11:19:26', '2019-09-02 11:19:26'),
(76, 1, 'Clone Menu', '', 'menu/{menu}/clone', 'GET', 68, NULL, 0, 'This is the menu cloning request.', 0, 1, '2019-09-02 11:23:37', '2019-09-02 11:23:37'),
(77, 1, 'Menu Group', 'fa-cubes', '#', 'GET', 46, 2, 1, 'Parent Menu! ', 0, 1, '2019-09-02 11:24:56', '2019-09-02 11:28:00'),
(78, 1, 'All group-menu', 'fa-list', 'group-menu', 'GET', 77, NULL, 1, 'Data Tables! ', 0, 1, '2019-09-02 11:24:56', '2019-09-02 11:24:56'),
(79, 1, 'Save group-menu', '', 'group-menu', 'POST', 77, NULL, 0, 'Store! ', 0, 1, '2019-09-02 11:24:56', '2019-09-02 11:24:56'),
(80, 1, 'Add group-menu', 'fa-pencil-square-o', 'group-menu/create', 'GET', 77, NULL, 1, 'Create! ', 0, 1, '2019-09-02 11:24:56', '2019-09-02 11:24:56'),
(81, 1, 'Update group-menu', '', 'group-menu/{group_menu}', 'PUT', 77, NULL, 0, 'Update! ', 0, 1, '2019-09-02 11:24:56', '2019-09-02 11:24:56'),
(82, 1, 'Show group-menu', '', 'group-menu/{group_menu}', 'GET', 77, NULL, 0, 'Show! ', 0, 1, '2019-09-02 11:24:56', '2019-09-02 11:24:56'),
(83, 1, 'Destroy group-menu', '', 'group-menu/{group_menu}', 'DELETE', 77, NULL, 0, 'Destroy! ', 0, 1, '2019-09-02 11:24:56', '2019-09-02 11:24:56'),
(84, 1, 'Edit group-menu', '', 'group-menu/{group_menu}/edit', 'GET', 77, NULL, 0, 'Edit! ', 0, 1, '2019-09-02 11:24:56', '2019-09-02 11:24:56'),
(85, 1, 'Add to Group', 'fa-university', '#', 'GET', 46, 1, 1, 'Parent Menu! ', 0, 1, '2019-09-02 11:27:17', '2019-09-02 11:28:00'),
(86, 1, 'All menu-grouping', 'fa-list', 'menu-grouping', 'GET', 85, NULL, 1, 'Data Tables! ', 0, 1, '2019-09-02 11:27:17', '2019-09-02 11:27:17'),
(87, 1, 'Save menu-grouping', '', 'menu-grouping', 'POST', 85, NULL, 0, 'Store! ', 0, 1, '2019-09-02 11:27:17', '2019-09-02 11:27:17'),
(88, 1, 'Add menu-grouping', 'fa-pencil-square-o', 'menu-grouping/create', 'GET', 85, NULL, 1, 'Create! ', 0, 1, '2019-09-02 11:27:17', '2019-09-02 11:27:17'),
(89, 1, 'Update menu-grouping', '', 'menu-grouping/{menu_grouping}', 'PUT', 85, NULL, 0, 'Update! ', 0, 1, '2019-09-02 11:27:17', '2019-09-02 11:27:17'),
(90, 1, 'Show menu-grouping', '', 'menu-grouping/{menu_grouping}', 'GET', 85, NULL, 0, 'Show! ', 0, 1, '2019-09-02 11:27:17', '2019-09-02 11:27:17'),
(91, 1, 'Destroy menu-grouping', '', 'menu-grouping/{menu_grouping}', 'DELETE', 85, NULL, 0, 'Destroy! ', 0, 1, '2019-09-02 11:27:18', '2019-09-02 11:27:18'),
(92, 1, 'Edit menu-grouping', '', 'menu-grouping/{menu_grouping}/edit', 'GET', 85, NULL, 0, 'Edit! ', 0, 1, '2019-09-02 11:27:18', '2019-09-02 11:27:18'),
(93, 1, 'Menu Alignment Save', '', 'save-front-menu-alignment', 'POST', 0, NULL, 0, 'Menu Alignment Save', 0, 1, '2019-09-02 11:30:53', '2019-09-02 11:30:53'),
(94, 1, 'Media Control', 'fa-picture-o', '#', 'GET', 0, NULL, 1, 'This is the Media Control main menu.', 0, 1, '2019-09-02 11:37:18', '2019-09-02 11:44:19'),
(95, 1, 'Manage Image', 'fa-file-image-o', 'manage-image', 'GET', 94, NULL, 1, 'Manage Image menu.', 0, 1, '2019-09-02 11:43:59', '2019-09-02 11:43:59'),
(96, 1, 'Manage file', 'fa-file-o', 'manage-file', 'GET', 94, NULL, 1, 'Manage file menu.', 0, 1, '2019-09-02 11:45:27', '2019-09-02 11:45:27');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_type` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_page` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_time` timestamp NULL DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_relations`
--

CREATE TABLE `advertisement_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `module_id` int(11) NOT NULL,
  `advertise_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `attachment_type` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_path_type` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_study_relations`
--

CREATE TABLE `case_study_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `post_id` int(11) NOT NULL,
  `round_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `front_menus`
--

CREATE TABLE `front_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actionType` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuClass` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menuOrder` int(11) DEFAULT NULL,
  `menuStyle` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `front_menu_groupings`
--

CREATE TABLE `front_menu_groupings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `menuOrder` int(11) NOT NULL,
  `is_permission` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filePath` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_status` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categories` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_relation`
--

CREATE TABLE `gallery_relation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `category_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_groups`
--

CREATE TABLE `menu_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `style` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(214, '2014_10_12_000000_create_users_table', 1),
(215, '2014_10_12_100000_create_password_resets_table', 1),
(216, '2019_04_29_085332_create_roles_table', 1),
(217, '2019_04_29_142653_create_admin_menus_table', 1),
(218, '2019_04_30_141623_create_user_permissions_table', 1),
(219, '2019_05_05_050246_create_front_menus_table', 1),
(220, '2019_05_07_064427_create_menu_groups_table', 1),
(221, '2019_05_08_073715_create_front_menu_groupings_table', 1),
(222, '2019_05_11_073836_create_term_taxonomies_table', 1),
(223, '2019_05_12_033227_create_taxonomies_table', 1),
(224, '2019_05_16_080335_create_modules_table', 1),
(225, '2019_05_24_060022_create_posts_table', 1),
(226, '2019_05_25_112652_create_attachments_table', 1),
(227, '2019_05_25_114845_create_comments_table', 1),
(228, '2019_05_25_120714_create_term_relations_table', 1),
(229, '2019_06_20_122528_create_rounds_table', 1),
(230, '2019_06_20_172126_create_companies_table', 1),
(231, '2019_06_23_132423_create_positions_table', 1),
(232, '2019_06_23_142545_create_subjects_table', 1),
(233, '2019_06_23_153710_create_students_table', 1),
(234, '2019_06_24_161427_create_case_study_relations_table', 1),
(235, '2019_07_08_094112_create_settings_table', 1),
(236, '2019_07_21_101745_create_advertisements_table', 1),
(237, '2019_07_21_162956_advertise_relations', 1),
(238, '2019_07_30_133535_create_galleries_table', 1),
(239, '2019_08_25_160258_create_gallery_relation_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menugroup` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discription` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_content_bn` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_excerpt_bn` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_time` timestamp NULL DEFAULT NULL,
  `post_type` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_format` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `upload_type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_thumb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb_status` tinyint(1) NOT NULL DEFAULT 1,
  `comments_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `active`, `name`, `description`, `user_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super-admin', 'This is the Master Role.', 1, 0, '2019-08-29 04:59:49', '2019-08-29 04:59:49'),
(2, 1, 'Administrator', 'Administrator user role.', 1, 0, '2019-08-29 05:18:50', '2019-08-29 05:18:50'),
(3, 1, 'Editor', 'This is Editor user role.', 1, 0, '2019-08-29 05:19:17', '2019-08-29 05:19:17'),
(4, 1, 'Contributor', 'This is Contributor user role.', 1, 0, '2019-08-29 05:20:01', '2019-08-29 05:20:01'),
(5, 1, 'Subscriber', 'This is Subscriber user role.', 1, 0, '2019-08-29 05:20:32', '2019-08-29 05:20:32');

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

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `active`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'site_name', 'IsDB-BISEW new', 1, NULL, '2019-09-02 06:27:33'),
(2, 1, 'site_url', 'http://www.idb-bisew.org/abcd', 1, NULL, '2019-09-02 06:27:33'),
(3, 1, 'date_format', 'd-m-Y', 1, NULL, '2019-09-02 06:27:33'),
(4, 1, 'time_format', 'g:i a', 1, NULL, '2019-09-02 06:27:33'),
(5, 1, 'meta_title', 'Islamic Development Bank-Bangladesh Islamic Solidarity Educational Wakf (IsDB-BISEW)', 1, NULL, '2019-09-02 06:27:33'),
(6, 1, 'meta_key', 'IsDB-BISEW, idb, idb-bisew', 1, NULL, '2019-09-02 06:27:33'),
(7, 1, 'meta_desc', 'Islamic Development Bank-Bangladesh Islamic Solidarity Educational Wakf  was established following an agreement between the Islamic Development Bank, Jeddah, Saudi Arabia, and the Government of Bangladesh.', 1, NULL, '2019-09-02 06:27:34'),
(8, 1, 'meta_picture', NULL, 1, NULL, NULL),
(9, 1, 'default_theme', 'default', 1, NULL, '2019-09-02 08:48:38'),
(10, 1, 'facebook_url', 'https://www.facebook.com/', 1, NULL, '2019-09-02 06:27:34'),
(11, 1, 'linkedin_url', 'https://www.linkedin.com/', 1, NULL, '2019-09-02 06:27:34'),
(12, 1, 'youtube_url', 'https://www.youtube.com/channel/UCpkDA8qqR7tfvvTeXna5mkw', 1, NULL, '2019-09-02 06:27:34');

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

-- --------------------------------------------------------

--
-- Table structure for table `taxonomies`
--

CREATE TABLE `taxonomies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `term` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `term_relations`
--

CREATE TABLE `term_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `taxonomy_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `term_taxonomies`
--

CREATE TABLE `term_taxonomies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(455) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `menugroup` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `active`, `firstName`, `LastName`, `gender`, `role_id`, `is_delete`, `picture`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super-Admin', NULL, 'male', 1, 0, 'Uploads/Avatar/2019-09/1567319260-head-659652_960_720.png', 'superadmin@email.com', '2019-08-29 05:03:02', '$2y$10$3W/P5xsaKoaoYYP2uzceBO1CPOjDpi/SBUTQOI8NKB66Nd982as/u', NULL, '2019-08-29 05:01:17', '2019-08-29 05:03:02'),
(2, 1, 'Administrator', NULL, 'male', 2, 0, 'Uploads/Avatar/2019-09/1567319260-head-659652_960_720.png', 'administrator@email.com', NULL, '$2y$10$TWuH1/gOOz7ZpZYtsbQf6OKVLvQYSkfSNx42T.PrwhG0PX0bpDDWq', NULL, '2019-08-29 05:27:53', '2019-09-01 06:27:40'),
(3, 1, 'Editor', NULL, 'male', 3, 0, 'Uploads/Avatar/2019-09/1567319279-dummy-profile-pic-1.jpg', 'editor@email.com', NULL, '$2y$10$GjBnfevpGSBjkofuCVt1Eebs3QjoHvss/QcosSYeurrKD4WAw5TrS', NULL, '2019-08-29 05:28:19', '2019-09-01 06:27:59'),
(4, 1, 'Contributor', NULL, 'male', 4, 0, 'Uploads/Avatar/2019-09/1567319297-user-307993__340.png', 'contributor@email.com', NULL, '$2y$10$VI7H.V.MAzyuburyYvcQZu99UPVIsrkT9aIUv00Nq1UDCABZHj1ge', NULL, '2019-08-29 05:28:45', '2019-09-01 06:28:18'),
(5, 1, 'Subscriber', NULL, 'male', 5, 0, 'Uploads/Avatar/2019-09/1567319311-images.png', 'Subscriber@email.com', NULL, '$2y$10$ZqfN/Afb4cYa7xLCwHPehu2Lyex10HzvI0vYNSSZ1EE0FapPXesH6', NULL, '2019-08-29 05:29:08', '2019-09-01 06:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_permission` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `menu_id`, `role_id`, `is_permission`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, NULL),
(2, 2, 1, 1, 1, NULL, NULL),
(3, 3, 1, 1, 1, NULL, NULL),
(4, 4, 1, 1, 1, NULL, NULL),
(5, 5, 1, 1, 1, NULL, NULL),
(6, 6, 1, 1, 1, NULL, NULL),
(7, 7, 1, 1, 1, NULL, NULL),
(8, 8, 1, 1, 1, NULL, NULL),
(9, 9, 1, 1, 1, NULL, NULL),
(10, 10, 1, 1, 1, NULL, NULL),
(11, 11, 1, 1, 1, NULL, NULL),
(12, 12, 1, 1, 1, NULL, NULL),
(13, 13, 1, 1, 1, NULL, NULL),
(14, 14, 1, 1, 1, NULL, NULL),
(15, 15, 1, 1, 1, NULL, NULL),
(16, 16, 1, 1, 1, NULL, NULL),
(17, 17, 1, 1, 1, NULL, NULL),
(18, 18, 1, 1, 1, NULL, NULL),
(19, 19, 1, 1, 1, NULL, NULL),
(20, 20, 1, 1, 1, NULL, NULL),
(21, 21, 1, 1, 1, NULL, NULL),
(22, 22, 1, 1, 1, NULL, NULL),
(23, 23, 1, 1, 1, NULL, NULL),
(24, 24, 1, 1, 1, NULL, NULL),
(25, 25, 1, 1, 1, NULL, NULL),
(26, 26, 1, 1, 1, NULL, NULL),
(27, 27, 1, 1, 1, NULL, NULL),
(28, 28, 1, 1, 1, NULL, NULL),
(29, 29, 1, 1, 1, NULL, NULL),
(30, 30, 1, 1, 1, NULL, NULL),
(31, 31, 1, 1, 1, NULL, NULL),
(32, 32, 1, 1, 1, NULL, NULL),
(33, 33, 1, 1, 1, NULL, NULL),
(34, 34, 1, 1, 1, NULL, NULL),
(35, 35, 1, 1, 1, NULL, NULL),
(36, 36, 1, 1, 1, NULL, NULL),
(37, 37, 1, 1, 1, NULL, NULL),
(38, 38, 1, 1, 1, NULL, NULL),
(39, 1, 2, 1, 1, '2019-08-29 05:29:56', '2019-08-29 05:29:56'),
(40, 20, 2, 1, 1, '2019-08-29 05:29:56', '2019-08-29 05:29:56'),
(41, 22, 2, 1, 1, '2019-08-29 05:29:56', '2019-08-29 05:29:56'),
(42, 24, 2, 1, 1, '2019-08-29 05:29:57', '2019-08-29 05:29:57'),
(43, 25, 2, 1, 1, '2019-08-29 05:29:57', '2019-08-29 05:29:57'),
(44, 26, 2, 1, 1, '2019-08-29 05:29:57', '2019-08-29 05:29:57'),
(45, 27, 2, 1, 1, '2019-08-29 05:29:57', '2019-08-29 05:29:57'),
(46, 21, 2, 1, 1, '2019-08-29 05:29:57', '2019-08-29 05:29:57'),
(47, 23, 2, 1, 1, '2019-08-29 05:29:57', '2019-08-29 05:29:57'),
(48, 12, 2, 1, 1, '2019-08-29 05:30:19', '2019-08-29 05:30:19'),
(49, 14, 2, 1, 1, '2019-08-29 05:30:19', '2019-08-29 05:30:19'),
(50, 16, 2, 1, 1, '2019-08-29 05:30:19', '2019-08-29 05:30:19'),
(51, 17, 2, 1, 1, '2019-08-29 05:30:19', '2019-08-29 05:30:19'),
(52, 18, 2, 1, 1, '2019-08-29 05:30:19', '2019-08-29 05:30:19'),
(53, 19, 2, 1, 1, '2019-08-29 05:30:19', '2019-08-29 05:30:19'),
(54, 13, 2, 1, 1, '2019-08-29 05:30:19', '2019-08-29 05:30:19'),
(55, 15, 2, 1, 1, '2019-08-29 05:30:19', '2019-08-29 05:30:19'),
(56, 39, 1, 1, 1, NULL, NULL),
(57, 40, 1, 1, 1, NULL, NULL),
(58, 41, 1, 1, 1, NULL, NULL),
(59, 42, 1, 1, 1, NULL, NULL),
(60, 43, 1, 1, 1, NULL, NULL),
(61, 44, 1, 1, 1, NULL, NULL),
(62, 45, 1, 1, 1, NULL, NULL),
(63, 46, 1, 1, 1, NULL, NULL),
(64, 47, 1, 1, 1, NULL, NULL),
(65, 48, 1, 1, 1, NULL, NULL),
(66, 49, 1, 1, 1, NULL, NULL),
(67, 50, 1, 1, 1, NULL, NULL),
(68, 51, 1, 1, 1, NULL, NULL),
(69, 52, 1, 1, 1, NULL, NULL),
(70, 53, 1, 1, 1, NULL, NULL),
(71, 54, 1, 1, 1, NULL, NULL),
(72, 55, 1, 1, 1, NULL, NULL),
(73, 56, 1, 1, 1, NULL, NULL),
(74, 57, 1, 1, 1, NULL, NULL),
(75, 58, 1, 1, 1, NULL, NULL),
(76, 59, 1, 1, 1, NULL, NULL),
(77, 60, 1, 1, 1, NULL, NULL),
(78, 61, 1, 1, 1, NULL, NULL),
(79, 62, 1, 1, 1, NULL, NULL),
(80, 63, 1, 1, 1, NULL, NULL),
(81, 64, 1, 1, 1, NULL, NULL),
(82, 65, 1, 1, 1, NULL, NULL),
(83, 66, 1, 1, 1, NULL, NULL),
(84, 67, 1, 1, 1, NULL, NULL),
(85, 68, 1, 1, 1, NULL, NULL),
(86, 69, 1, 1, 1, NULL, NULL),
(87, 70, 1, 1, 1, NULL, NULL),
(88, 71, 1, 1, 1, NULL, NULL),
(89, 72, 1, 1, 1, NULL, NULL),
(90, 73, 1, 1, 1, NULL, NULL),
(91, 74, 1, 1, 1, NULL, NULL),
(92, 75, 1, 1, 1, NULL, NULL),
(93, 76, 1, 1, 1, NULL, NULL),
(94, 77, 1, 1, 1, NULL, NULL),
(95, 78, 1, 1, 1, NULL, NULL),
(96, 79, 1, 1, 1, NULL, NULL),
(97, 80, 1, 1, 1, NULL, NULL),
(98, 81, 1, 1, 1, NULL, NULL),
(99, 82, 1, 1, 1, NULL, NULL),
(100, 83, 1, 1, 1, NULL, NULL),
(101, 84, 1, 1, 1, NULL, NULL),
(102, 85, 1, 1, 1, NULL, NULL),
(103, 86, 1, 1, 1, NULL, NULL),
(104, 87, 1, 1, 1, NULL, NULL),
(105, 88, 1, 1, 1, NULL, NULL),
(106, 89, 1, 1, 1, NULL, NULL),
(107, 90, 1, 1, 1, NULL, NULL),
(108, 91, 1, 1, 1, NULL, NULL),
(109, 92, 1, 1, 1, NULL, NULL),
(110, 93, 1, 1, 1, NULL, NULL),
(111, 94, 1, 1, 1, NULL, NULL),
(112, 95, 1, 1, 1, NULL, NULL),
(113, 96, 1, 1, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_menus_name_index` (`name`),
  ADD KEY `admin_menus_route_uri_index` (`route_uri`),
  ADD KEY `admin_menus_method_index` (`method`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisement_relations`
--
ALTER TABLE `advertisement_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_attachment_type_index` (`attachment_type`);

--
-- Indexes for table `case_study_relations`
--
ALTER TABLE `case_study_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_study_relations_post_id_index` (`post_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_index` (`post_id`),
  ADD KEY `comments_user_id_index` (`user_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_menus`
--
ALTER TABLE `front_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `front_menus_actiontype_index` (`actionType`),
  ADD KEY `front_menus_action_index` (`action`);

--
-- Indexes for table `front_menu_groupings`
--
ALTER TABLE `front_menu_groupings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `front_menu_groupings_menu_id_index` (`menu_id`),
  ADD KEY `front_menu_groupings_group_id_index` (`group_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_relation`
--
ALTER TABLE `gallery_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_groups`
--
ALTER TABLE `menu_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_groups_slug_name_index` (`slug_name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_slug_index` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `positions_position_name_unique` (`position_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_post_slug_unique` (`post_slug`),
  ADD KEY `posts_post_status_post_type_index` (`post_status`,`post_type`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_user_id_index` (`user_id`);

--
-- Indexes for table `rounds`
--
ALTER TABLE `rounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

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
-- Indexes for table `taxonomies`
--
ALTER TABLE `taxonomies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxonomies_slug_index` (`slug`),
  ADD KEY `taxonomies_term_index` (`term`);

--
-- Indexes for table `term_relations`
--
ALTER TABLE `term_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `term_relations_taxonomy_id_index` (`taxonomy_id`),
  ADD KEY `term_relations_post_id_index` (`post_id`);

--
-- Indexes for table `term_taxonomies`
--
ALTER TABLE `term_taxonomies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `term_taxonomies_slug_index` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_permissions_menu_id_index` (`menu_id`),
  ADD KEY `user_permissions_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertisement_relations`
--
ALTER TABLE `advertisement_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_study_relations`
--
ALTER TABLE `case_study_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_menus`
--
ALTER TABLE `front_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_menu_groupings`
--
ALTER TABLE `front_menu_groupings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_relation`
--
ALTER TABLE `gallery_relation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_groups`
--
ALTER TABLE `menu_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rounds`
--
ALTER TABLE `rounds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxonomies`
--
ALTER TABLE `taxonomies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `term_relations`
--
ALTER TABLE `term_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `term_taxonomies`
--
ALTER TABLE `term_taxonomies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
