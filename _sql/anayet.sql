-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2024 at 11:48 AM
-- Server version: 8.0.39-0ubuntu0.24.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anayet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_uri` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int DEFAULT NULL,
  `order` int DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `active`, `name`, `icon`, `route_uri`, `method`, `parent_id`, `order`, `visibility`, `description`, `is_delete`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Access Control', 'fa-lock', '#', 'GET', 0, 12, 1, 'Access Control Main Menu.', 0, 1, '2019-08-28 17:05:58', '2024-08-08 10:47:50'),
(2, 1, 'Admin Menu', 'fa-list', '#', 'GET', 1, 0, 1, 'Parent Menu! ', 0, 1, '2019-08-28 17:07:10', '2019-08-28 17:17:29'),
(3, 1, 'All admin-menu', 'fa-list', 'admin/admin-menu', 'GET', 2, 0, 1, 'Data Tables! ', 0, 1, '2019-08-28 17:07:11', '2019-08-28 17:17:29'),
(4, 1, 'Save admin-menu', '', 'admin/admin-menu', 'POST', 2, NULL, 0, 'Store! ', 0, 1, '2019-08-28 17:07:11', '2019-08-28 17:07:11'),
(5, 1, 'Add admin-menu', 'fa-pencil-square-o', 'admin/admin-menu/create', 'GET', 2, 1, 1, 'Create! ', 0, 1, '2019-08-28 17:07:11', '2019-08-28 17:17:29'),
(6, 1, 'Update admin-menu', '', 'admin/admin-menu/{admin_menu}', 'PUT', 2, NULL, 0, 'Update! ', 0, 1, '2019-08-28 17:07:11', '2019-08-28 17:07:11'),
(7, 1, 'Show admin-menu', '', 'admin/admin-menu/{admin_menu}', 'GET', 2, NULL, 0, 'Show! ', 0, 1, '2019-08-28 17:07:11', '2019-08-28 17:07:11'),
(8, 1, 'Destroy admin-menu', '', 'admin/admin-menu/{admin_menu}', 'DELETE', 2, NULL, 0, 'Destroy! ', 0, 1, '2019-08-28 17:07:11', '2019-08-28 17:07:11'),
(9, 1, 'Edit admin-menu', '', 'admin/admin-menu/{admin_menu}/edit', 'GET', 2, NULL, 0, 'Edit! ', 0, 1, '2019-08-28 17:07:11', '2019-08-28 17:07:11'),
(10, 1, 'Save Resource Menu', '', 'admin/save-resource-menu', 'POST', 2, NULL, 0, 'Save Resource Menu', 0, 1, '2019-08-28 17:07:59', '2019-08-28 17:08:11'),
(11, 1, 'Clone Admin Menu', '', 'admin/admin-menu/{admin_menu}/clone', 'GET', 2, NULL, 0, 'Clone Admin Menu', 0, 1, '2019-08-28 17:08:58', '2019-08-28 17:08:58'),
(12, 1, 'Users', 'fa-users', '#', 'GET', 1, 2, 1, 'Parent Menu! ', 0, 1, '2019-08-28 17:10:47', '2019-08-28 17:17:29'),
(13, 1, 'All user', 'fa-list', 'admin/user', 'GET', 12, 0, 1, 'Data Tables! ', 0, 1, '2019-08-28 17:10:48', '2019-08-28 17:17:42'),
(14, 1, 'Save user', '', 'admin/user', 'POST', 12, NULL, 0, 'Store! ', 0, 1, '2019-08-28 17:10:48', '2019-08-28 17:10:48'),
(15, 1, 'Add user', 'fa-pencil-square-o', 'admin/user/create', 'GET', 12, 1, 1, 'Create! ', 0, 1, '2019-08-28 17:10:48', '2019-08-28 17:17:42'),
(16, 1, 'Update user', '', 'admin/user/{user}', 'PUT', 12, NULL, 0, 'Update! ', 0, 1, '2019-08-28 17:10:48', '2019-08-28 17:10:48'),
(17, 1, 'Show user', '', 'admin/user/{user}', 'GET', 12, NULL, 0, 'Show! ', 0, 1, '2019-08-28 17:10:48', '2019-08-28 17:10:48'),
(18, 1, 'Destroy user', '', 'admin/user/{user}', 'DELETE', 12, NULL, 0, 'Destroy! ', 0, 1, '2019-08-28 17:10:48', '2019-08-28 17:10:48'),
(19, 1, 'Edit user', '', 'admin/user/{user}/edit', 'GET', 12, NULL, 0, 'Edit! ', 0, 1, '2019-08-28 17:10:48', '2019-08-28 17:10:48'),
(20, 1, 'Role', 'fa-user', '#', 'GET', 1, 1, 1, 'Parent Menu! ', 0, 1, '2019-08-28 17:11:38', '2019-08-28 17:17:29'),
(21, 1, 'All role', 'fa-list', 'admin/role', 'GET', 20, 0, 1, 'Data Tables! ', 0, 1, '2019-08-28 17:11:38', '2019-08-28 17:17:37'),
(22, 1, 'Save role', '', 'admin/role', 'POST', 20, NULL, 0, 'Store! ', 0, 1, '2019-08-28 17:11:38', '2019-08-28 17:11:38'),
(23, 1, 'Add role', 'fa-pencil-square-o', 'admin/role/create', 'GET', 20, 1, 1, 'Create! ', 0, 1, '2019-08-28 17:11:38', '2019-08-28 17:17:37'),
(24, 1, 'Update role', '', 'admin/role/{role}', 'PUT', 20, NULL, 0, 'Update! ', 0, 1, '2019-08-28 17:11:38', '2019-08-28 17:11:38'),
(25, 1, 'Show role', '', 'admin/role/{role}', 'GET', 20, NULL, 0, 'Show! ', 0, 1, '2019-08-28 17:11:38', '2019-08-28 17:11:38'),
(26, 1, 'Destroy role', '', 'admin/role/{role}', 'DELETE', 20, NULL, 0, 'Destroy! ', 0, 1, '2019-08-28 17:11:38', '2019-08-28 17:11:38'),
(27, 1, 'Edit role', '', 'admin/role/{role}/edit', 'GET', 20, NULL, 0, 'Edit! ', 0, 1, '2019-08-28 17:11:38', '2019-08-28 17:11:38'),
(28, 1, 'Setup Access', 'fa-check-square-o', '#', 'GET', 1, 3, 1, 'Parent Menu!', 0, 1, '2019-08-28 17:12:14', '2019-08-28 17:17:29'),
(29, 1, 'Alignment', 'fa-list', 'admin/setup-access', 'GET', 28, 0, 1, 'Data Tables!', 0, 1, '2019-08-28 17:12:14', '2019-08-28 17:17:47'),
(30, 1, 'Save setup-access', '', 'admin/setup-access', 'POST', 28, NULL, 0, 'Store! ', 0, 1, '2019-08-28 17:12:14', '2019-08-28 17:12:14'),
(31, 1, 'Permission', 'fa-pencil-square-o', 'admin/setup-access/create', 'GET', 28, 1, 1, 'Create!', 0, 1, '2019-08-28 17:12:14', '2019-08-28 17:17:47'),
(32, 1, 'Update setup-access', '', 'admin/setup-access/{setup_access}', 'PUT', 28, NULL, 0, 'Update! ', 0, 1, '2019-08-28 17:12:14', '2019-08-28 17:12:14'),
(33, 1, 'Show setup-access', '', 'admin/setup-access/{setup_access}', 'GET', 28, NULL, 0, 'Show! ', 0, 1, '2019-08-28 17:12:14', '2019-08-28 17:12:14'),
(34, 1, 'Destroy setup-access', '', 'admin/setup-access/{setup_access}', 'DELETE', 28, NULL, 0, 'Destroy! ', 0, 1, '2019-08-28 17:12:14', '2019-08-28 17:12:14'),
(35, 1, 'Edit setup-access', '', 'admin/setup-access/{setup_access}/edit', 'GET', 28, NULL, 0, 'Edit! ', 0, 1, '2019-08-28 17:12:14', '2019-08-28 17:12:14'),
(36, 1, 'Find Admin Menu', '', 'admin/find-admin-menu', 'POST', 28, NULL, 0, 'Find Admin Menu BY AJAX Request', 0, 1, '2019-08-28 17:13:30', '2019-08-28 17:13:30'),
(37, 1, 'Find Alignment Menu', '', 'admin/find-alignment-menu', 'POST', 28, NULL, 0, 'Find Alignment Menu by AJAX request.', 0, 1, '2019-08-28 17:14:16', '2019-08-28 17:14:16'),
(38, 1, 'Save Alignment', '', 'admin/save-alignment', 'POST', 28, NULL, 0, 'Save Menu Alignment.', 0, 1, '2019-08-28 17:15:00', '2019-08-28 17:15:00'),
(39, 1, 'Artisan', 'fa-terminal', 'admin/artisan', 'GET', 1, 4, 1, 'This menu control the artisan command.', 0, 1, '2019-08-31 16:07:37', '2019-08-31 18:06:17'),
(40, 1, 'Artisan Caching', '', 'admin/artisan/cache/{key}', 'GET', 39, NULL, 0, 'This menu for Artisan Caching command.', 0, 1, '2019-08-31 16:51:28', '2019-08-31 17:36:22'),
(41, 1, 'Artisan Clear Caching', '', 'admin/artisan/clear-cache/{key}', 'GET', 39, NULL, 0, 'This menu for Artisan Clear Cache command.', 0, 1, '2019-08-31 17:16:47', '2019-08-31 17:36:12'),
(42, 1, 'Artisan migration with seed.', '', 'admin/artisan/migrate-seed/{app_key}', 'GET', 39, NULL, 0, 'This menu for Artisan migration with seed command.', 0, 1, '2019-08-31 17:47:51', '2019-08-31 17:47:51'),
(43, 1, 'Artisan Database seed', '', 'admin/artisan/db-seed/{app_key}', 'GET', 39, NULL, 0, 'This menu for Artisan Database seed command.', 0, 1, '2019-08-31 18:10:00', '2019-08-31 18:10:00'),
(44, 1, 'Artisan Command Down', '', 'admin/artisan/down/{app_key}', 'GET', 39, NULL, 0, 'This menu for Artisan Command Down command.', 0, 1, '2019-08-31 18:13:49', '2019-08-31 18:13:49'),
(45, 1, 'Artisan Command Up', '', 'admin/artisan/up/{app_key}', 'GET', 39, NULL, 0, 'This menu for Artisan Command Up command.', 0, 1, '2019-08-31 18:14:06', '2019-08-31 18:14:06'),
(46, 1, 'Accessibility', 'fa-check-square', '#', 'GET', 0, 11, 1, 'This is the parent menu of all Accessibility menus.', 0, 1, '2019-08-31 18:44:39', '2024-08-08 10:47:50'),
(47, 1, 'Module', 'fa-list', '#', 'GET', 46, 4, 1, 'Parent Menu! ', 0, 1, '2019-08-31 18:47:07', '2019-09-01 23:28:00'),
(48, 1, 'All module', 'fa-list', 'admin/module', 'GET', 47, NULL, 1, 'Data Tables! ', 0, 1, '2019-08-31 18:47:07', '2019-08-31 18:47:07'),
(49, 1, 'Save module', '', 'admin/module', 'POST', 47, NULL, 0, 'Store! ', 0, 1, '2019-08-31 18:47:07', '2019-08-31 18:47:07'),
(50, 1, 'Add module', 'fa-pencil-square-o', 'admin/module/create', 'GET', 47, NULL, 1, 'Create! ', 0, 1, '2019-08-31 18:47:07', '2019-08-31 18:47:07'),
(51, 1, 'Update module', '', 'admin/module/{module}', 'PUT', 47, NULL, 0, 'Update! ', 0, 1, '2019-08-31 18:47:07', '2019-08-31 18:47:07'),
(52, 1, 'Show module', '', 'admin/module/{module}', 'GET', 47, NULL, 0, 'Show! ', 0, 1, '2019-08-31 18:47:07', '2019-08-31 18:47:07'),
(53, 1, 'Destroy module', '', 'admin/module/{module}', 'DELETE', 47, NULL, 0, 'Destroy! ', 0, 1, '2019-08-31 18:47:07', '2019-08-31 18:47:07'),
(54, 1, 'Edit module', '', 'admin/module/{module}/edit', 'GET', 47, NULL, 0, 'Edit! ', 0, 1, '2019-08-31 18:47:08', '2019-08-31 18:47:08'),
(55, 1, 'Settings', 'fa-wrench', '#', 'GET', 46, 5, 1, 'This is the parent menu settings.', 0, 1, '2019-09-01 18:01:36', '2019-09-01 23:28:01'),
(56, 1, 'General settings', 'fa-flag', 'admin/settings/general-settings', 'GET', 55, 0, 1, 'This is the General settings menu.', 0, 1, '2019-09-01 18:02:20', '2019-09-01 20:49:04'),
(57, 1, 'Save general settings', '', 'admin/settings/general-settings-save', 'POST', 55, NULL, 0, 'Save general settings', 0, 1, '2019-09-01 18:03:15', '2019-09-01 18:03:15'),
(58, 1, 'Themes', 'fa-puzzle-piece', 'admin/settings/theme', 'GET', 55, 1, 1, 'This menu for theme settings.', 0, 1, '2019-09-01 18:31:42', '2019-09-01 20:49:04'),
(59, 1, 'Save Themes', '', 'admin/settings/theme-settings-save', 'POST', 55, NULL, 0, 'This is the settings request for save the themes.', 0, 1, '2019-09-01 18:33:33', '2019-09-01 18:33:33'),
(60, 1, 'Manage Term', 'fa-flag', '#', 'GET', 46, 3, 1, 'Parent Menu! ', 0, 1, '2019-09-01 22:48:14', '2019-09-01 23:28:00'),
(61, 1, 'All term', 'fa-list', 'admin/term', 'GET', 60, 0, 1, 'Data Tables! ', 0, 1, '2019-09-01 22:48:15', '2019-09-01 22:49:15'),
(62, 1, 'Save term', '', 'admin/term', 'POST', 60, NULL, 0, 'Store! ', 0, 1, '2019-09-01 22:48:15', '2019-09-01 22:48:15'),
(63, 1, 'Add term', 'fa-pencil-square-o', 'admin/term/create', 'GET', 60, 1, 1, 'Create! ', 0, 1, '2019-09-01 22:48:15', '2019-09-01 22:49:15'),
(64, 1, 'Update term', '', 'admin/term/{term}', 'PUT', 60, NULL, 0, 'Update! ', 0, 1, '2019-09-01 22:48:15', '2019-09-01 22:48:15'),
(65, 1, 'Show term', '', 'admin/term/{term}', 'GET', 60, NULL, 0, 'Show! ', 0, 1, '2019-09-01 22:48:15', '2019-09-01 22:48:15'),
(66, 1, 'Destroy term', '', 'admin/term/{term}', 'DELETE', 60, NULL, 0, 'Destroy! ', 0, 1, '2019-09-01 22:48:15', '2019-09-01 22:48:15'),
(67, 1, 'Edit term', '', 'admin/term/{term}/edit', 'GET', 60, NULL, 0, 'Edit! ', 0, 1, '2019-09-01 22:48:15', '2019-09-01 22:48:15'),
(68, 1, 'Menu', 'fa-exclamation', 'admin/menu', 'GET', 46, 0, 1, 'Parent Menu!', 0, 1, '2019-09-01 23:19:26', '2019-09-15 07:04:32'),
(69, 1, 'All menu', 'fa-list', 'admin/menu', 'GET', 68, 0, 0, 'Data Tables!', 0, 1, '2019-09-01 23:19:26', '2019-09-15 07:05:30'),
(70, 1, 'Save menu', '', 'admin/menu', 'POST', 68, NULL, 0, 'Store! ', 0, 1, '2019-09-01 23:19:26', '2019-09-01 23:19:26'),
(71, 1, 'Add menu', 'fa-pencil-square-o', 'admin/menu/create', 'GET', 68, 1, 0, 'Create!', 0, 1, '2019-09-01 23:19:26', '2019-09-15 07:05:15'),
(72, 1, 'Update menu', '', 'admin/menu/{menu}', 'PUT', 68, NULL, 0, 'Update! ', 0, 1, '2019-09-01 23:19:26', '2019-09-01 23:19:26'),
(73, 1, 'Show menu', '', 'admin/menu/{menu}', 'GET', 68, NULL, 0, 'Show! ', 0, 1, '2019-09-01 23:19:26', '2019-09-01 23:19:26'),
(74, 1, 'Destroy menu', '', 'admin/menu/{menu}', 'DELETE', 68, NULL, 0, 'Destroy! ', 0, 1, '2019-09-01 23:19:26', '2019-09-01 23:19:26'),
(75, 1, 'Edit menu', '', 'admin/menu/{menu}/edit', 'GET', 68, NULL, 0, 'Edit! ', 0, 1, '2019-09-01 23:19:26', '2019-09-01 23:19:26'),
(76, 1, 'Clone Menu', '', 'admin/menu/{menu}/clone', 'GET', 68, NULL, 0, 'This is the menu cloning request.', 0, 1, '2019-09-01 23:23:37', '2019-09-01 23:23:37'),
(77, 1, 'Menu Group', 'fa-cubes', '#', 'GET', 46, 2, 1, 'Parent Menu! ', 0, 1, '2019-09-01 23:24:56', '2019-09-01 23:28:00'),
(78, 1, 'All group-menu', 'fa-list', 'admin/group-menu', 'GET', 77, NULL, 1, 'Data Tables! ', 0, 1, '2019-09-01 23:24:56', '2019-09-01 23:24:56'),
(79, 1, 'Save group-menu', '', 'admin/group-menu', 'POST', 77, NULL, 0, 'Store! ', 0, 1, '2019-09-01 23:24:56', '2019-09-01 23:24:56'),
(80, 1, 'Add group-menu', 'fa-pencil-square-o', 'admin/group-menu/create', 'GET', 77, NULL, 1, 'Create! ', 0, 1, '2019-09-01 23:24:56', '2019-09-01 23:24:56'),
(81, 1, 'Update group-menu', '', 'admin/group-menu/{group_menu}', 'PUT', 77, NULL, 0, 'Update! ', 0, 1, '2019-09-01 23:24:56', '2019-09-01 23:24:56'),
(82, 1, 'Show group-menu', '', 'admin/group-menu/{group_menu}', 'GET', 77, NULL, 0, 'Show! ', 0, 1, '2019-09-01 23:24:56', '2019-09-01 23:24:56'),
(83, 1, 'Destroy group-menu', '', 'admin/group-menu/{group_menu}', 'DELETE', 77, NULL, 0, 'Destroy! ', 0, 1, '2019-09-01 23:24:56', '2019-09-01 23:24:56'),
(84, 1, 'Edit group-menu', '', 'admin/group-menu/{group_menu}/edit', 'GET', 77, NULL, 0, 'Edit! ', 0, 1, '2019-09-01 23:24:56', '2019-09-01 23:24:56'),
(94, 1, 'Media Control', 'fa-picture-o', '#', 'GET', 0, 10, 1, 'This is the Media Control main menu.', 0, 1, '2019-09-01 23:37:18', '2024-08-08 10:47:50'),
(95, 1, 'Manage Image', 'fa-file-image-o', 'admin/manage-image', 'GET', 94, NULL, 1, 'Manage Image menu.', 0, 1, '2019-09-01 23:43:59', '2019-09-01 23:43:59'),
(96, 1, 'Manage file', 'fa-file-o', 'admin/manage-file', 'GET', 94, NULL, 1, 'Manage file menu.', 0, 1, '2019-09-01 23:45:27', '2019-09-01 23:45:27'),
(97, 1, 'Pages', 'fa-columns', '#', 'GET', 0, 6, 1, 'Parent Menu! ', 0, 1, '2019-09-03 18:12:35', '2024-08-08 10:47:50'),
(98, 1, 'All page', 'fa-list', 'admin/page', 'GET', 97, NULL, 1, 'Data Tables! ', 0, 1, '2019-09-03 18:12:35', '2019-09-03 18:12:35'),
(99, 1, 'Save page', '', 'admin/page', 'POST', 97, NULL, 0, 'Store! ', 0, 1, '2019-09-03 18:12:35', '2019-09-03 18:12:35'),
(100, 1, 'Add page', 'fa-pencil-square-o', 'admin/page/create', 'GET', 97, NULL, 1, 'Create! ', 0, 1, '2019-09-03 18:12:35', '2019-09-03 18:12:35'),
(101, 1, 'Update page', '', 'admin/page/{page}', 'PUT', 97, NULL, 0, 'Update! ', 0, 1, '2019-09-03 18:12:35', '2019-09-03 18:12:35'),
(102, 1, 'Show page', '', 'admin/page/{page}', 'GET', 97, NULL, 0, 'Show! ', 0, 1, '2019-09-03 18:12:35', '2019-09-03 18:12:35'),
(103, 1, 'Destroy page', '', 'admin/page/{page}', 'DELETE', 97, NULL, 0, 'Destroy! ', 0, 1, '2019-09-03 18:12:36', '2019-09-03 18:12:36'),
(104, 1, 'Edit page', '', 'admin/page/{page}/edit', 'GET', 97, NULL, 0, 'Edit! ', 0, 1, '2019-09-03 18:12:36', '2019-09-03 18:12:36'),
(105, 1, 'Manage taxonomy', '', '#', 'GET', 60, NULL, 0, 'Parent Menu!', 0, 1, '2019-09-04 03:54:53', '2019-09-04 04:06:09'),
(106, 1, 'All admin/term/taxonomy', 'fa-list', 'admin/term/taxonomy', 'GET', 105, NULL, 0, 'Data Tables!', 0, 1, '2019-09-04 03:54:53', '2019-09-04 04:02:23'),
(107, 1, 'Save admin/term/taxonomy', '', 'admin/term/taxonomy', 'POST', 105, NULL, 0, 'Store!', 0, 1, '2019-09-04 03:54:53', '2019-09-04 04:01:54'),
(108, 1, 'Add admin/term/taxonomy', 'fa-pencil-square-o', 'admin/term/taxonomy/create', 'GET', 105, NULL, 0, 'Create!', 0, 1, '2019-09-04 03:54:53', '2019-09-04 03:58:13'),
(109, 1, 'Update admin/term/taxonomy', '', 'admin/term/taxonomy/{taxonomy}', 'PUT', 105, NULL, 0, 'Update!', 0, 1, '2019-09-04 03:54:53', '2019-09-04 03:57:57'),
(110, 1, 'Show admin/term/taxonomy', '', 'admin/term/taxonomy/{taxonomy}', 'GET', 105, NULL, 0, 'Show!', 0, 1, '2019-09-04 03:54:53', '2019-09-04 03:57:37'),
(111, 1, 'Destroy admin/term/taxonomy', '', 'admin/term/taxonomy/{taxonomy}', 'DELETE', 105, NULL, 0, 'Destroy!', 0, 1, '2019-09-04 03:54:53', '2019-09-04 03:56:10'),
(112, 1, 'Edit admin/term/taxonomy', '', 'admin/term/taxonomy/{taxonomy}/edit', 'GET', 105, NULL, 0, 'Edit!', 0, 1, '2019-09-04 03:54:54', '2019-09-04 03:55:35'),
(177, 1, 'File store', '', 'admin/image/upload/store', 'POST', 169, NULL, 0, 'File store request', 0, 1, '2019-09-05 05:07:01', '2019-09-05 05:07:01'),
(178, 1, 'Image Delete', '', 'admin/image/delete', 'POST', 169, NULL, 0, 'Image Delete', 0, 1, '2019-09-05 05:13:42', '2019-09-05 05:13:42'),
(179, 1, 'Image Save', '', 'admin/image-save', 'POST', 169, NULL, 0, 'Image Save', 0, 1, '2019-09-05 05:14:17', '2019-09-05 05:14:17'),
(180, 1, 'Image Delete by ID', '', 'admin/image-delete/{id}', 'DELETE', 169, NULL, 0, 'Image Delete by ID', 0, 1, '2019-09-05 05:15:09', '2019-09-05 05:15:09'),
(181, 1, 'Image Update', '', 'admin/image-update/{id}', 'PUT', 169, NULL, 0, 'Image Update', 0, 1, '2019-09-05 05:15:45', '2019-09-05 05:15:45'),
(182, 1, 'Category', 'fa-list-alt', 'admin/term/category/create', 'GET', 0, 4, 1, 'Create!category', 0, 1, '2019-09-05 05:34:23', '2024-08-08 10:47:50'),
(183, 1, 'Edit category', '', 'admin/term/category/{category}/edit', 'GET', 0, NULL, 0, 'Edit ! taxonomy category', 0, 1, '2019-09-05 05:34:23', '2019-09-05 05:34:23'),
(184, 1, 'Tags', 'fa-list-alt', 'admin/term/tags/create', 'GET', 0, 5, 1, 'Create!tags', 0, 1, '2019-09-05 05:34:39', '2024-08-08 10:47:50'),
(185, 1, 'Edit tags', '', 'admin/term/tags/{tags}/edit', 'GET', 0, NULL, 0, 'Edit ! taxonomy tags', 0, 1, '2019-09-05 05:34:39', '2019-09-05 05:34:39'),
(186, 1, 'photo-category', 'fa-list-alt', 'admin/term/photo-gallery/photo-category/create', 'GET', 169, NULL, 1, 'Create!photo-category', 0, 1, '2019-09-05 05:34:59', '2019-09-05 05:34:59'),
(187, 1, 'Edit photo-category', '', 'admin/term/photo-gallery/photo-category/{photo_category}/edit', 'GET', 169, NULL, 0, 'Edit ! taxonomy photo-category', 0, 1, '2019-09-05 05:34:59', '2019-09-05 05:34:59'),
(188, 1, 'Advertisement', 'fa-list', '#', 'GET', 0, 7, 1, 'Parent Menu! ', 0, 1, '2019-09-05 05:42:29', '2024-08-08 10:47:50'),
(189, 1, 'All advertisement', 'fa-list', 'admin/advertisement', 'GET', 188, NULL, 1, 'Data Tables! ', 0, 1, '2019-09-05 05:42:29', '2019-09-05 05:42:29'),
(190, 1, 'Save advertisement', '', 'admin/advertisement', 'POST', 188, NULL, 0, 'Store! ', 0, 1, '2019-09-05 05:42:29', '2019-09-05 05:42:29'),
(191, 1, 'Add advertisement', 'fa-pencil-square-o', 'admin/advertisement/create', 'GET', 188, NULL, 1, 'Create! ', 0, 1, '2019-09-05 05:42:29', '2019-09-05 05:42:29'),
(192, 1, 'Update advertisement', '', 'admin/advertisement/{advertisement}', 'PUT', 188, NULL, 0, 'Update! ', 0, 1, '2019-09-05 05:42:29', '2019-09-05 05:42:29'),
(193, 1, 'Show advertisement', '', 'admin/advertisement/{advertisement}', 'GET', 188, NULL, 0, 'Show! ', 0, 1, '2019-09-05 05:42:30', '2019-09-05 05:42:30'),
(194, 1, 'Destroy advertisement', '', 'admin/advertisement/{advertisement}', 'DELETE', 188, NULL, 0, 'Destroy! ', 0, 1, '2019-09-05 05:42:30', '2019-09-05 05:42:30'),
(195, 1, 'Edit advertisement', '', 'admin/advertisement/{advertisement}/edit', 'GET', 188, NULL, 0, 'Edit! ', 0, 1, '2019-09-05 05:42:30', '2019-09-05 05:42:30'),
(196, 1, 'Filter Post Data', '', 'admin/filter-post-data', 'GET', 188, NULL, 0, 'Filter Post Data', 0, 1, '2019-09-05 05:45:03', '2019-09-05 05:45:03'),
(197, 1, 'Filter Advertisement', '', 'admin/filter-advertisement', 'GET', 188, NULL, 0, 'Filter Advertisement', 0, 1, '2019-09-05 05:45:45', '2019-09-05 05:45:45'),
(198, 1, 'Student Info', 'fa-info', '#', 'GET', 0, 8, 1, 'Student Information Parent menu.', 0, 1, '2019-09-05 06:02:39', '2024-08-08 10:47:50'),
(199, 1, 'Round', 'fa-flag', '#', 'GET', 198, 3, 1, 'Parent Menu! ', 0, 1, '2019-09-05 06:05:07', '2019-09-05 06:49:26'),
(200, 1, 'All round', 'fa-list', 'admin/round', 'GET', 199, NULL, 1, 'Data Tables! ', 0, 1, '2019-09-05 06:05:07', '2019-09-05 06:05:07'),
(201, 1, 'Save round', '', 'admin/round', 'POST', 199, NULL, 0, 'Store! ', 0, 1, '2019-09-05 06:05:07', '2019-09-05 06:05:07'),
(202, 1, 'Add round', 'fa-pencil-square-o', 'admin/round/create', 'GET', 199, NULL, 1, 'Create! ', 0, 1, '2019-09-05 06:05:07', '2019-09-05 06:05:07'),
(203, 1, 'Update round', '', 'admin/round/{round}', 'PUT', 199, NULL, 0, 'Update! ', 0, 1, '2019-09-05 06:05:07', '2019-09-05 06:05:07'),
(204, 1, 'Show round', '', 'admin/round/{round}', 'GET', 199, NULL, 0, 'Show! ', 0, 1, '2019-09-05 06:05:07', '2019-09-05 06:05:07'),
(205, 1, 'Destroy round', '', 'admin/round/{round}', 'DELETE', 199, NULL, 0, 'Destroy! ', 0, 1, '2019-09-05 06:05:07', '2019-09-05 06:05:07'),
(206, 1, 'Edit round', '', 'admin/round/{round}/edit', 'GET', 199, NULL, 0, 'Edit! ', 0, 1, '2019-09-05 06:05:07', '2019-09-05 06:05:07'),
(207, 1, 'Company', 'fa-flag', '#', 'GET', 198, 2, 1, 'Parent Menu! ', 0, 1, '2019-09-05 06:15:57', '2019-09-05 06:49:26'),
(208, 1, 'All company', 'fa-list', 'admin/company', 'GET', 207, NULL, 1, 'Data Tables! ', 0, 1, '2019-09-05 06:15:57', '2019-09-05 06:15:57'),
(209, 1, 'Save company', '', 'admin/company', 'POST', 207, NULL, 0, 'Store! ', 0, 1, '2019-09-05 06:15:57', '2019-09-05 06:15:57'),
(210, 1, 'Add company', 'fa-pencil-square-o', 'admin/company/create', 'GET', 207, NULL, 1, 'Create! ', 0, 1, '2019-09-05 06:15:57', '2019-09-05 06:15:57'),
(211, 1, 'Update company', '', 'admin/company/{company}', 'PUT', 207, NULL, 0, 'Update! ', 0, 1, '2019-09-05 06:15:57', '2019-09-05 06:15:57'),
(212, 1, 'Show company', '', 'admin/company/{company}', 'GET', 207, NULL, 0, 'Show! ', 0, 1, '2019-09-05 06:15:57', '2019-09-05 06:15:57'),
(213, 1, 'Destroy company', '', 'admin/company/{company}', 'DELETE', 207, NULL, 0, 'Destroy! ', 0, 1, '2019-09-05 06:15:57', '2019-09-05 06:15:57'),
(214, 1, 'Edit company', '', 'admin/company/{company}/edit', 'GET', 207, NULL, 0, 'Edit! ', 0, 1, '2019-09-05 06:15:57', '2019-09-05 06:15:57'),
(215, 1, 'Position', 'fa-flag', '#', 'GET', 198, 1, 1, 'Parent Menu! ', 0, 1, '2019-09-05 06:16:49', '2019-09-05 06:49:26'),
(216, 1, 'All position', 'fa-list', 'admin/position', 'GET', 215, NULL, 1, 'Data Tables! ', 0, 1, '2019-09-05 06:16:49', '2019-09-05 06:16:49'),
(217, 1, 'Save position', '', 'admin/position', 'POST', 215, NULL, 0, 'Store! ', 0, 1, '2019-09-05 06:16:49', '2019-09-05 06:16:49'),
(218, 1, 'Add position', 'fa-pencil-square-o', 'admin/position/create', 'GET', 215, NULL, 1, 'Create! ', 0, 1, '2019-09-05 06:16:49', '2019-09-05 06:16:49'),
(219, 1, 'Update position', '', 'admin/position/{position}', 'PUT', 215, NULL, 0, 'Update! ', 0, 1, '2019-09-05 06:16:49', '2019-09-05 06:16:49'),
(220, 1, 'Show position', '', 'admin/position/{position}', 'GET', 215, NULL, 0, 'Show! ', 0, 1, '2019-09-05 06:16:49', '2019-09-05 06:16:49'),
(221, 1, 'Destroy position', '', 'admin/position/{position}', 'DELETE', 215, NULL, 0, 'Destroy! ', 0, 1, '2019-09-05 06:16:49', '2019-09-05 06:16:49'),
(222, 1, 'Edit position', '', 'admin/position/{position}/edit', 'GET', 215, NULL, 0, 'Edit! ', 0, 1, '2019-09-05 06:16:49', '2019-09-05 06:16:49'),
(223, 1, 'Course', 'fa-flag', '#', 'GET', 198, 4, 1, 'Parent Menu! ', 0, 1, '2019-09-05 06:17:16', '2019-09-05 06:49:26'),
(224, 1, 'All course', 'fa-list', 'admin/course', 'GET', 223, 0, 1, 'Data Tables! ', 0, 1, '2019-09-05 06:17:16', '2019-09-05 06:49:26'),
(225, 1, 'Save course', '', 'admin/course', 'POST', 223, NULL, 0, 'Store! ', 0, 1, '2019-09-05 06:17:17', '2019-09-05 06:17:17'),
(226, 1, 'Add course', 'fa-pencil-square-o', 'admin/course/create', 'GET', 223, 1, 1, 'Create! ', 0, 1, '2019-09-05 06:17:17', '2019-09-05 06:49:27'),
(227, 1, 'Update course', '', 'admin/course/{course}', 'PUT', 223, NULL, 0, 'Update! ', 0, 1, '2019-09-05 06:17:17', '2019-09-05 06:17:17'),
(228, 1, 'Show course', '', 'admin/course/{course}', 'GET', 223, NULL, 0, 'Show! ', 0, 1, '2019-09-05 06:17:17', '2019-09-05 06:17:17'),
(229, 1, 'Destroy course', '', 'admin/course/{course}', 'DELETE', 223, NULL, 0, 'Destroy! ', 0, 1, '2019-09-05 06:17:17', '2019-09-05 06:17:17'),
(230, 1, 'Edit course', '', 'admin/course/{course}/edit', 'GET', 223, NULL, 0, 'Edit! ', 0, 1, '2019-09-05 06:17:17', '2019-09-05 06:17:17'),
(231, 1, 'Student', 'fa-flag', '#', 'GET', 198, 0, 1, 'Parent Menu! ', 0, 1, '2019-09-05 06:17:49', '2019-09-05 06:49:26'),
(232, 1, 'All student', 'fa-list', 'admin/student', 'GET', 231, NULL, 1, 'Data Tables! ', 0, 1, '2019-09-05 06:17:49', '2019-09-05 06:17:49'),
(233, 1, 'Save student', '', 'admin/student', 'POST', 231, NULL, 0, 'Store! ', 0, 1, '2019-09-05 06:17:49', '2019-09-05 06:17:49'),
(234, 1, 'Add student', 'fa-pencil-square-o', 'admin/student/create', 'GET', 231, NULL, 1, 'Create! ', 0, 1, '2019-09-05 06:17:49', '2019-09-05 06:17:49'),
(235, 1, 'Update student', '', 'admin/student/{student}', 'PUT', 231, NULL, 0, 'Update! ', 0, 1, '2019-09-05 06:17:49', '2019-09-05 06:17:49'),
(236, 1, 'Show student', '', 'admin/student/{student}', 'GET', 231, NULL, 0, 'Show! ', 0, 1, '2019-09-05 06:17:49', '2019-09-05 06:17:49'),
(237, 1, 'Destroy student', '', 'admin/student/{student}', 'DELETE', 231, NULL, 0, 'Destroy! ', 0, 1, '2019-09-05 06:17:49', '2019-09-05 06:17:49'),
(238, 1, 'Edit student', '', 'admin/student/{student}/edit', 'GET', 231, NULL, 0, 'Edit! ', 0, 1, '2019-09-05 06:17:49', '2019-09-05 06:17:49'),
(239, 1, 'Dashboard', 'fa-tachometer', 'dashboard', 'GET', 0, 0, 1, NULL, 0, 1, '2019-11-27 03:30:35', '2021-07-06 10:56:16'),
(240, 1, 'Api Token', 'fa-link', 'admin/api-token', 'GET', 55, NULL, 1, 'Api Token Register', 0, 1, '2020-01-15 07:53:28', '2020-01-15 07:53:28'),
(241, 1, 'Api Token', 'fa-link', 'admin/api-token', 'POST', 55, NULL, 0, 'Api Token Register', 0, 1, '2020-01-15 07:53:53', '2020-01-15 07:53:53'),
(242, 0, 'Query', 'fa-envelope-o', '#', 'GET', 0, 8, 0, 'Parent Menu!', 0, 1, '2020-01-15 07:54:54', '2020-01-16 06:01:41'),
(243, 1, 'Query Message', 'fa-list', 'admin/contact', 'GET', 0, 2, 1, 'Data Tables!', 0, 1, '2020-01-15 07:54:54', '2024-08-08 10:47:50'),
(244, 1, 'Save contact', '', 'admin/contact', 'POST', 242, NULL, 0, 'Store! ', 0, 1, '2020-01-15 07:54:54', '2020-01-15 07:54:54'),
(245, 1, 'Add contact', 'fa-pencil-square-o', 'admin/contact/create', 'GET', 242, NULL, 0, 'Create!', 0, 1, '2020-01-15 07:54:54', '2020-01-15 07:56:01'),
(246, 1, 'Update contact', '', 'admin/contact/{contact}', 'PUT', 242, NULL, 0, 'Update! ', 0, 1, '2020-01-15 07:54:54', '2020-01-15 07:54:54'),
(247, 1, 'Show contact', '', 'admin/contact/{contact}', 'GET', 242, NULL, 0, 'Show! ', 0, 1, '2020-01-15 07:54:54', '2020-01-15 07:54:54'),
(248, 1, 'Destroy contact', '', 'admin/contact/{contact}', 'DELETE', 242, NULL, 0, 'Destroy! ', 0, 1, '2020-01-15 07:54:54', '2020-01-15 07:54:54'),
(249, 1, 'Edit contact', '', 'admin/contact/{contact}/edit', 'GET', 242, NULL, 0, 'Edit! ', 0, 1, '2020-01-15 07:54:54', '2020-01-15 07:54:54'),
(250, 1, 'Notes', 'fa-pencil-square-o', '#', 'GET', 0, 1, 1, 'Parent Menu! ', 0, 1, '2020-02-09 11:07:53', '2024-08-08 10:47:50'),
(251, 1, 'All note', 'fa-list', 'admin/note', 'GET', 250, NULL, 1, 'Data Tables! ', 0, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(252, 1, 'Save note', '', 'admin/note', 'POST', 250, NULL, 0, 'Store! ', 0, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(253, 1, 'Add note', 'fa-pencil-square-o', 'admin/note/create', 'GET', 250, NULL, 1, 'Create! ', 0, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(254, 1, 'Update note', '', 'admin/note/{note}', 'PUT', 250, NULL, 0, 'Update! ', 0, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(255, 1, 'Show note', '', 'admin/note/{note}', 'GET', 250, NULL, 0, 'Show! ', 0, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(256, 1, 'Destroy note', '', 'admin/note/{note}', 'DELETE', 250, NULL, 0, 'Destroy! ', 0, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(257, 1, 'Edit note', '', 'admin/note/{note}/edit', 'GET', 250, NULL, 0, 'Edit! ', 0, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(258, 1, 'Quick Note Edit', '', 'admin/note/{note}/quick-edit', 'PUT', 250, NULL, 0, 'Quick Note Edit Menu', 0, 1, '2020-02-10 11:15:20', '2020-02-10 11:15:20'),
(259, 1, 'Certificate Award', 'fa-trophy', '#', 'GET', 0, 3, 1, 'Parent Menu! ', 0, 1, '2020-02-20 10:31:31', '2024-08-08 10:47:50'),
(260, 1, 'All certificate-award', 'fa-list', 'admin/certificate-award', 'GET', 259, NULL, 1, 'Data Tables! ', 0, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(261, 1, 'Save certificate-award', '', 'admin/certificate-award', 'POST', 259, NULL, 0, 'Store! ', 0, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(262, 0, 'Add certificate-award', 'fa-pencil-square-o', 'admin/certificate-award/create', 'GET', 259, NULL, 0, 'Create!', 0, 1, '2020-02-20 10:31:31', '2020-02-20 10:32:34'),
(263, 1, 'Update certificate-award', '', 'admin/certificate-award/{certificate_award}', 'PUT', 259, NULL, 0, 'Update! ', 0, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(264, 1, 'Show certificate-award', '', 'admin/certificate-award/{certificate_award}', 'GET', 259, NULL, 0, 'Show! ', 0, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(265, 1, 'Destroy certificate-award', '', 'admin/certificate-award/{certificate_award}', 'DELETE', 259, NULL, 0, 'Destroy! ', 0, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(266, 1, 'Edit certificate-award', '', 'admin/certificate-award/{certificate_award}/edit', 'GET', 259, NULL, 0, 'Edit! ', 0, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(267, 1, 'VTP Auto Notice', 'fa-magic', '#', 'GET', 121, 2, 1, 'VTP Auto Notice Menu', 0, 1, '2020-03-15 10:29:18', '2020-03-15 11:09:27'),
(268, 1, 'Save vtp-auto-notice', '', 'admin/vtp-auto-notice', 'POST', 267, NULL, 0, 'Save vtp-auto-notice', 0, 1, '2020-03-15 10:31:21', '2020-03-15 10:31:21'),
(269, 1, 'Update vtp-auto-notice', '', 'admin/vtp-auto-notice/{vtp_auto_notice}', 'PUT', 267, NULL, 0, 'Update vtp-auto-notice', 0, 1, '2020-03-15 10:32:00', '2020-03-15 10:32:00'),
(270, 1, 'Show vtp-auto-notice', 'fa-list', 'admin/vtp-auto-notice/{vtp_auto_notice}', 'GET', 267, NULL, 0, 'Show vtp-auto-notice', 0, 1, '2020-03-15 10:32:42', '2020-03-15 10:35:23'),
(271, 1, 'Destroy vtp-auto-notice', '', 'admin/vtp-auto-notice/{vtp_auto_notice}', 'DELETE', 267, NULL, 0, 'Destroy vtp-auto-notice', 0, 1, '2020-03-15 10:34:48', '2020-03-15 10:34:48'),
(272, 1, 'Edit vtp-auto-notice', '', 'admin/vtp-auto-notice/{vtp_auto_notice}/edit', 'GET', 267, NULL, 0, 'Edit vtp-auto-notice', 0, 1, '2020-03-15 10:35:15', '2020-03-15 10:35:15'),
(273, 1, 'VTP Notice Format', 'fa-pencil-square-o', 'admin/vtp-auto-notice/create', 'GET', 267, 1, 1, 'VTP Notice Format', 0, 1, '2020-03-15 10:37:15', '2020-03-15 11:10:02'),
(274, 1, 'Save vtp-auto-notice', 'fa-pencil-square-o', 'admin/vtp-auto-notice', 'POST', 267, NULL, 0, 'Save vtp-auto-notice', 0, 1, '2020-03-15 10:37:54', '2020-03-15 10:37:54'),
(275, 1, 'VTP Notice History', 'fa-list', 'admin/vtp-auto-notice', 'GET', 267, 0, 1, 'VTP Notice History', 0, 1, '2020-03-15 10:38:38', '2020-03-15 11:10:02'),
(276, 1, 'VTP Notice Refresh', 'fa-list', 'admin/vtp-auto-notice-refresh', 'GET', 267, NULL, 0, 'VTP Notice Refresh', 0, 1, '2020-03-15 11:01:13', '2020-03-15 11:01:13'),
(308, 1, 'Edit abc', '', 'admin/type/abc/{abc}/edit', 'GET', 301, NULL, 0, 'Edit! abc', 0, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(307, 1, 'Destroy abc', '', 'admin/type/abc/{abc}', 'DELETE', 301, NULL, 0, 'Destroy! abc', 0, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(306, 1, 'Show abc', '', 'admin/type/abc/{abc}', 'GET', 301, NULL, 0, 'Show! abc', 0, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(305, 1, 'Update abc', '', 'admin/type/abc/{abc}', 'PUT', 301, NULL, 0, 'Update! abc', 0, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(304, 1, 'Add abc', 'fa-pencil-square-o', 'admin/type/abc/create', 'GET', 301, NULL, 1, 'Create! abc', 0, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(303, 1, 'Save abc', '', 'admin/type/abc', 'POST', 301, NULL, 0, 'Store! abc', 0, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(302, 1, 'All abc', 'fa-list', 'admin/type/abc', 'GET', 301, NULL, 1, 'Data Tables! abc', 0, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(301, 1, 'ABC', 'fa-pencil-square-o', '#', 'GET', 0, 9, 1, 'This is the parent menu of ', 0, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `upload_type` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_page` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_time` timestamp NULL DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_relations`
--

CREATE TABLE `advertisement_relations` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `module_id` int NOT NULL,
  `advertise_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `attachment_type` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_path_type` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_study_relations`
--

CREATE TABLE `case_study_relations` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `post_id` int NOT NULL,
  `round_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `student_id` int NOT NULL,
  `module_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `location` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `reply_id` int DEFAULT NULL COMMENT 'reply comment_id',
  `viewed_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `front_menus`
--

CREATE TABLE `front_menus` (
  `id` bigint UNSIGNED NOT NULL,
  `active` int NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order` int DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `group_id` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_type` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `front_menus`
--

INSERT INTO `front_menus` (`id`, `active`, `name`, `url`, `options`, `order`, `parent_id`, `group_id`, `menu_type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'About IsDB-BISEW', 'about', '{\"menu_class\":\"test\",\"menu_title\":\"About IsDB-BISEW\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 0, 0, '1', 'internal', 3, '2019-08-28 17:29:56', '2021-05-24 09:20:46'),
(2, 1, 'What We Do', '/isdb-bisew-programme', '{\"menu_class\":\"mega-menu\",\"menu_title\":\"What We Do\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 1, 0, '1', 'external', 3, '2019-08-28 17:29:56', '2021-05-24 09:20:46'),
(3, 1, 'IDB Bhaban', '/idb-bhaban', '{\"menu_class\":\"\",\"menu_title\":\"IsDB Bhaban\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 2, 0, '1', 'external', 3, '2019-08-28 17:29:56', '2021-05-24 09:20:46'),
(4, 1, 'Notice', '/notice', '{\"menu_class\":\"\",\"menu_title\":\"Notice\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 3, 0, '1', 'external', 3, '2019-08-28 17:29:56', '2021-05-24 09:20:46'),
(5, 1, 'Photo Gallery', '/photo-gallery', '{\"menu_class\":\"\",\"menu_title\":\"Photo Gallery\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 4, 0, '1', 'external', 3, '2019-08-28 17:29:56', '2021-05-24 09:20:46'),
(6, 0, 'Single test post', 'it-scholarship/7/single-test-post', '{\"menu_class\":\"\",\"menu_title\":\"Single test post\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 3, 0, '1', 'internal', 1, '2019-08-28 17:29:56', '2021-05-24 09:20:46'),
(7, 1, 'IT Scholarship Programme', 'it-scholarship-programme', '{\"menu_class\":\"\",\"menu_title\":\"IT Scholarship Programme\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 0, 2, '1', 'internal', 1, '2019-08-28 17:29:56', '2019-11-03 07:46:47'),
(8, 1, 'Vocational Training Programme', 'vocational-training-programme', '{\"menu_class\":\"\",\"menu_title\":\"Vocational Training Programme\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 1, 2, '1', 'internal', 1, '2019-08-28 17:29:56', '2019-11-03 07:46:47'),
(9, 1, 'Madrasah Education Programme', 'madrasah-education-programme', '{\"menu_class\":\"\",\"menu_title\":\"Madrasah Education Programme\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 2, 2, '1', 'internal', 1, '2019-08-28 17:29:56', '2019-11-03 07:46:47'),
(10, 1, '4-Year Diploma Scholarship Programme', 'four-year-diploma-scholarship', '{\"menu_class\":\"\",\"menu_title\":\"4-Year Diploma Scholarship Programme\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 3, 2, '1', 'internal', 1, '2019-08-28 17:29:56', '2019-11-03 07:46:47'),
(11, 1, 'IT Scholarship Overview', 'it-scholarship-programme/it-scholarship-programme-overview', '{\"menu_class\":\"\",\"menu_title\":\"IT Scholarship Overview\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 2, 7, '1', 'internal', 1, '2019-08-28 17:29:56', '2019-11-17 10:40:49'),
(12, 1, 'IT Scholarship Objective', 'it-scholarship-programme/it-scholarship-programme-objective', '{\"menu_class\":\"\",\"menu_title\":\"IT Scholarship Project Objective\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 0, 7, '1', 'internal', 1, '2019-08-28 17:29:56', '2019-11-17 10:40:49'),
(13, 1, 'IT Scholarship Outcome', 'it-scholarship-programme/it-scholarship-programme-outcome', '{\"menu_class\":\"\",\"menu_title\":\"IT Scholarship Outcome\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 1, 7, '1', 'internal', 1, '2019-08-28 17:29:56', '2019-11-17 10:40:49'),
(14, 1, 'Training and Assessment', 'it-scholarship-programme/training-and-assessment', '{\"menu_class\":\"\",\"menu_title\":\"Training and Assessment\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 3, 7, '1', 'internal', 1, '2019-08-28 17:29:56', '2019-11-17 10:40:49'),
(15, 1, 'IT Scholarship Unique Features', 'it-scholarship-programme/it-scholarship-unique-features', '{\"menu_class\":\"\",\"menu_title\":\"IT Scholarship Unique Features\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 4, 7, '1', 'internal', 1, '2019-08-28 17:29:56', '2019-11-17 10:40:49'),
(16, 1, 'Rental terms & condition', 'idb-bhaban/rental-terms-condition', '{\"menu_class\":\"\",\"menu_title\":\"Rental terms & condition\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 0, 3, '1', 'internal', 1, '2019-09-23 10:36:21', '2019-11-26 09:17:56'),
(17, 1, 'Fire Fighting Capabilities', 'idb-bhaban/fire-fighting-capabilities-of-idb-bhaban', '{\"menu_class\":\"\",\"menu_title\":\"Fire Fighting Capabilities of IDB Bhaban\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 1, 3, '1', 'internal', 1, '2019-09-23 11:05:03', '2019-11-26 09:17:56'),
(18, 1, 'Business Center Facilities', 'idb-bhaban/business-center-facilities', '{\"menu_class\":\"\",\"menu_title\":\"Business Center Facilities\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 2, 3, '1', 'internal', 1, '2019-09-23 11:23:11', '2019-11-26 09:17:56'),
(19, 1, 'IDB Bhaban Tenant List', 'idb-bhaban/idb-bhaban-tenant-list', '{\"menu_class\":\"\",\"menu_title\":\"IDB Bhaban Tenant List\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 3, 3, '1', 'internal', 1, '2019-09-23 11:29:00', '2019-11-26 09:17:56'),
(20, 1, 'Contact Us', 'idb-bhaban/contact-us', '{\"menu_class\":\"\",\"menu_title\":\"Contact Us\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 4, 3, '1', 'internal', 1, '2019-09-23 11:38:59', '2019-11-26 09:17:56'),
(21, 0, 'Training and Assessment', 'it-scholarship/training-and-assessment', '{\"menu_class\":\"\",\"menu_title\":\"Training and Assessment\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 5, 7, '1', 'internal', 1, '2019-10-06 09:45:15', '2019-11-17 10:40:49'),
(22, 1, 'Objectives of Vocational training', 'vocational-training-programme/objectives-of-vocational-training', '{\"menu_class\":\"\",\"menu_title\":\"Objectives of Vocational training\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 0, 8, '1', 'internal', 1, '2019-10-06 09:46:43', '2019-11-03 08:50:14'),
(23, 1, 'Project Overview', 'vocational-training-programme/project-overview', '{\"menu_class\":\"\",\"menu_title\":\"Project Overview\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 1, 8, '1', 'internal', 1, '2019-10-06 09:46:43', '2019-11-03 08:50:14'),
(24, 0, 'Vocational Training Syllabus & Course Contents', 'vocational-training/vocational-training-syllabus-course-contents', '{\"menu_class\":\"\",\"menu_title\":\"Vocational Training Syllabus & Course Contents\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 2, 8, '1', 'internal', 1, '2019-10-06 09:46:43', '2019-11-03 08:50:14'),
(25, 1, 'Unique Features of Vocational Training', 'vocational-training-programme/unique-features-of-vocational-training', '{\"menu_class\":\"\",\"menu_title\":\"Unique Features of Vocational Training\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 2, 8, '1', 'internal', 1, '2019-10-06 09:46:43', '2019-11-03 08:50:14'),
(26, 1, 'Case Study', 'vocational-training-programme/vocational-case-study', '{\"menu_class\":\"\",\"menu_title\":\"Case Study\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 3, 8, '1', 'internal', 1, '2019-10-06 09:46:43', '2019-11-03 08:50:14'),
(27, 1, 'Placement Status', 'vocational-training-programme/placement-status', '{\"menu_class\":\"\",\"menu_title\":\"Placement Status\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 4, 8, '1', 'internal', 1, '2019-10-06 09:46:44', '2019-11-03 08:50:14'),
(28, 1, 'FAQ Vocational', 'vocational-training-programme/faq-vocational', '{\"menu_class\":\"\",\"menu_title\":\"FAQ Vocational\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 5, 8, '1', 'internal', 1, '2019-10-06 09:55:29', '2019-11-03 08:50:14'),
(29, 1, 'IsDB-BISEW Madrasah Project', 'madrasah-education-programme/isdb-bisew-madrasah-project', '{\"menu_class\":\"\",\"menu_title\":\"IDB-BISEW Madrasah Project\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 0, 9, '1', 'internal', 1, '2019-10-06 10:16:41', '2019-11-26 09:16:07'),
(30, 1, 'Scope of the Madrasah Project', 'madrasah-education-programme/scope-of-the-madrasah-project', '{\"menu_class\":\"\",\"menu_title\":\"Scope of the Madrasah Project\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 1, 9, '1', 'internal', 1, '2019-10-06 10:20:38', '2019-11-26 09:16:07'),
(31, 1, 'Selected Madrasahs', 'madrasah-education-programme/selected-madrasahs', '{\"menu_class\":\"\",\"menu_title\":\"Selected Madrasahs\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 2, 9, '1', 'internal', 1, '2019-10-06 10:26:44', '2019-11-26 09:16:07'),
(32, 1, 'Madrasah Programme Data Sheet', 'madrasah-education-programme/madrasah-education-programme-data-sheet', '{\"menu_class\":\"\",\"menu_title\":\"Madrasah Programme Data Sheet\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 3, 9, '1', 'internal', 1, '2019-10-06 10:27:00', '2019-11-26 09:16:07'),
(33, 1, 'Madrasah Programme Achievements', 'madrasah-education-programme/madrasah-education-programme-achievements', '{\"menu_class\":\"\",\"menu_title\":\"Madrasah Programme Achievements\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 4, 9, '1', 'internal', 1, '2019-10-06 10:30:11', '2019-11-26 09:16:08'),
(34, 1, 'Diploma Scholarship Project objective', 'four-year-diploma-scholarship/four-year-diploma-scholarship-project', '{\"menu_class\":\"\",\"menu_title\":\"Four Year Diploma Scholarship Project objective\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 0, 10, '1', 'internal', 1, '2019-10-21 09:38:39', '2019-11-05 05:36:01'),
(35, 1, 'Diploma Scholarship Project Datasheet', 'four-year-diploma-scholarship/diploma-project-datasheet', '{\"menu_class\":\"\",\"menu_title\":\"Four Year Diploma Scholarship Project Datasheet\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 1, 10, '1', 'internal', 1, '2019-10-21 09:38:39', '2019-11-05 05:36:01'),
(36, 1, 'Diploma  Project Selected Area', 'four-year-diploma-scholarship/diploma-project-selected-area', '{\"menu_class\":\"\",\"menu_title\":\"Diploma  Project Selected Area\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 2, 10, '1', 'internal', 1, '2019-10-21 09:38:39', '2019-11-05 05:36:01'),
(37, 1, 'Financial Assistance', 'four-year-diploma-scholarship/diploma-project-financial-assistance', '{\"menu_class\":\"\",\"menu_title\":\"Diploma  Project Financial Assistance\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 3, 10, '1', 'internal', 1, '2019-10-21 09:38:39', '2019-11-05 05:36:01'),
(38, 1, 'Job Placement Assistance', 'four-year-diploma-scholarship/diploma-project-job-placement-assistance', '{\"menu_class\":\"\",\"menu_title\":\"Diploma  Project Job Placement Assistance\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 4, 10, '1', 'internal', 1, '2019-10-21 09:38:39', '2019-11-05 05:36:01'),
(39, 1, 'Orphanage Programme', 'orphanage-programme', '{\"menu_class\":\"\",\"menu_title\":\"Orphanage Programme\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 4, 2, '1', 'external', 1, '2019-10-29 04:53:04', '2019-11-03 07:46:47'),
(40, 1, 'Placement Cell', 'it-scholarship-programme/placement-cell-of-the-it-scholarship-project', '{\"menu_class\":\"\",\"menu_title\":\"Placement Cell\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 5, 7, '1', 'external', 1, '2019-11-02 07:47:10', '2019-11-17 10:40:49'),
(41, 1, 'FAQ IT Scholarship', 'it-scholarship-programme/frequently-asked-questions', '{\"menu_class\":\"\",\"menu_title\":\"FAQ\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 6, 7, '1', 'external', 1, '2019-11-04 03:55:51', '2019-11-17 10:40:50'),
(42, 1, 'CareerHub', 'careerhub', '{\"menu_class\":\"\",\"menu_title\":\"CareerHub\",\"menu_window\":\"on\",\"menu_icon\":\"\"}', 5, 0, '1', 'internal', 3, '2021-05-24 09:20:46', '2021-05-24 09:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `filePath` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_status` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_time` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_relation`
--

CREATE TABLE `gallery_relation` (
  `id` bigint UNSIGNED NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `category_id` int NOT NULL,
  `picture_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `key`, `value`) VALUES
(1, 'project_complete', '38.18');

-- --------------------------------------------------------

--
-- Table structure for table `menu_groups`
--

CREATE TABLE `menu_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `style` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_groups`
--

INSERT INTO `menu_groups` (`id`, `name`, `slug_name`, `description`, `style`, `user_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Header menu', 'header-menu', 'This Footer menu is control footer menu.', 'mega', 1, 0, '2019-09-02 15:52:27', '2019-09-03 18:31:37'),
(2, 'Sidebar menu', 'sidebar-menu', 'This Footer menu is control footer menu.', 'horizontal', 1, 0, '2019-09-03 18:29:42', '2019-09-03 18:31:09'),
(3, 'Footer menu', 'footer-menu', 'This Footer menu is control footer menu.', 'horizontal', 1, 0, '2019-09-03 18:32:10', '2019-09-03 18:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(239, '2019_08_25_160258_create_gallery_relation_table', 1),
(318, '2014_10_12_000000_create_users_table', 1),
(319, '2014_10_12_100000_create_password_resets_table', 1),
(320, '2019_04_29_085332_create_roles_table', 1),
(321, '2019_04_29_142653_create_admin_menus_table', 1),
(322, '2019_04_30_141623_create_user_permissions_table', 1),
(323, '2019_05_05_050246_create_front_menus_table', 1),
(324, '2019_05_07_064427_create_menu_groups_table', 1),
(325, '2019_05_08_073715_create_front_menu_groupings_table', 1),
(326, '2019_05_11_073836_create_term_taxonomies_table', 1),
(327, '2019_05_12_033227_create_taxonomies_table', 1),
(328, '2019_05_16_080335_create_modules_table', 1),
(329, '2019_05_24_060022_create_posts_table', 1),
(330, '2019_05_25_112652_create_attachments_table', 1),
(331, '2019_05_25_114845_create_comments_table', 1),
(332, '2019_05_25_120714_create_term_relations_table', 1),
(333, '2019_06_20_122528_create_rounds_table', 1),
(334, '2019_06_20_172126_create_companies_table', 1),
(335, '2019_06_23_132423_create_positions_table', 1),
(336, '2019_06_23_142545_create_subjects_table', 1),
(337, '2019_06_23_153710_create_students_table', 1),
(338, '2019_06_24_161427_create_case_study_relations_table', 1),
(339, '2019_07_08_094112_create_settings_table', 1),
(340, '2019_07_21_101745_create_advertisements_table', 1),
(341, '2019_07_21_162956_advertise_relations', 1),
(342, '2019_07_30_133535_create_galleries_table', 1),
(343, '2019_08_25_160258_create_gallery_relation_table', 1),
(396, '2014_10_12_000000_create_users_table', 1),
(397, '2014_10_12_100000_create_password_resets_table', 1),
(398, '2019_04_29_085332_create_roles_table', 1),
(399, '2019_04_29_142653_create_admin_menus_table', 1),
(400, '2019_04_30_141623_create_user_permissions_table', 1),
(401, '2019_05_05_050246_create_front_menus_table', 1),
(402, '2019_05_07_064427_create_menu_groups_table', 1),
(403, '2019_05_08_073715_create_front_menu_groupings_table', 1),
(404, '2019_05_11_073836_create_term_taxonomies_table', 1),
(405, '2019_05_12_033227_create_taxonomies_table', 1),
(406, '2019_05_16_080335_create_modules_table', 1),
(407, '2019_05_24_060022_create_posts_table', 1),
(408, '2019_05_25_112652_create_attachments_table', 1),
(409, '2019_05_25_114845_create_comments_table', 1),
(410, '2019_05_25_120714_create_term_relations_table', 1),
(411, '2019_06_20_122528_create_rounds_table', 1),
(412, '2019_06_20_172126_create_companies_table', 1),
(413, '2019_06_23_132423_create_positions_table', 1),
(414, '2019_06_23_142545_create_subjects_table', 1),
(415, '2019_06_23_153710_create_students_table', 1),
(416, '2019_06_24_161427_create_case_study_relations_table', 1),
(417, '2019_07_08_094112_create_settings_table', 1),
(418, '2019_07_21_101745_create_advertisements_table', 1),
(419, '2019_07_21_162956_advertise_relations', 1),
(420, '2019_07_30_133535_create_galleries_table', 1),
(421, '2019_08_25_160258_create_gallery_relation_table', 1),
(426, '2019_10_15_154110_create_contacts_table', 2),
(427, '2019_12_22_114222_create_widget_groups_table', 3),
(428, '2019_12_22_133358_create_widgets_table', 3),
(429, '2020_01_12_122124_adds_api_token_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuGroup` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_form` date DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `active`, `name`, `slug`, `menuGroup`, `picture`, `start_form`, `description`, `user_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(12, 1, 'ABC', 'abc', '301,302,303,304,305,306,307,308', NULL, '2024-08-08', '<p><span style=\"box-sizing: border-box; font-weight: bold; color: #333333; font-family: \'Source Sans Pro\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;\">Module name</span></p>\r\n<p class=\"text-muted\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #777777; font-family: \'Source Sans Pro\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;\">Fill the module name for managing content by module.</p>', 2, 0, '2024-08-08 10:47:05', '2024-08-08 10:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint UNSIGNED NOT NULL,
  `note_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note_status` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_time` timestamp NULL DEFAULT NULL,
  `upload_type` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_thumb` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb_status` tinyint(1) NOT NULL DEFAULT '1',
  `attachment_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sumon4skf@gmail.com', '$2y$10$O8sV.XOirH/k0QAd8jN60.7f7NXnK8dDolRXptOqB3cIfIpl9PjLC', '2019-12-17 14:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `position_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `active`, `is_delete`, `position_name`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Big Data Consultant', 'Position: Big Data Consultant', 1, '2019-06-23 07:48:11', '2019-06-26 07:30:08'),
(2, 1, 0, 'Senior Database Administrator (DBA)', 'Senior Database Administrator (DBA).', 1, '2019-06-26 07:34:22', '2019-06-26 07:35:32'),
(3, 1, 0, 'IT Head (5 Sea Ports)', 'IT Head (5 Sea Ports)', 1, '2019-06-26 11:11:14', '2019-06-26 11:11:14'),
(4, 1, 0, 'Manager', 'This is the post of Manager', 1, '2019-06-27 04:43:38', '2019-06-27 04:43:38'),
(5, 1, 0, 'Freelancer', 'This is the position of Freelancer.', 1, '2019-06-27 04:48:45', '2019-06-27 04:48:45'),
(6, 1, 0, 'C.E.O', 'chief executive officer', 1, '2019-06-27 05:07:38', '2019-06-27 05:07:52'),
(7, 1, 0, 'Welder', 'This is the post of vocation training Graduates.', 1, '2019-10-22 06:19:11', '2019-10-22 06:19:11'),
(8, 1, 0, 'Jr. Engineer', 'Junior Engineer', 1, '2019-11-24 05:31:19', '2019-11-24 05:31:19'),
(9, 1, 0, 'Jr. Programmer', 'Junior Programmer', 1, '2019-11-24 05:32:50', '2019-11-24 05:32:50'),
(10, 1, 0, 'Software Developer', 'Software Developer', 1, '2019-11-24 05:33:15', '2019-11-24 05:33:15'),
(11, 1, 0, 'Jr. Web Developer', 'Junior Web Developer', 1, '2019-11-24 05:33:36', '2019-11-24 05:33:36'),
(12, 1, 0, 'Assistant Programmer', 'Assistant Programmer', 1, '2019-12-29 11:02:15', '2019-12-29 11:02:15'),
(13, 1, 0, 'Graphic Designer & Content Developer', 'Graphic Designer & Content Developer', 1, '2019-12-29 11:02:34', '2019-12-29 11:02:34'),
(14, 1, 0, 'Support Engineer', 'Support Engineer', 1, '2019-12-29 11:02:46', '2019-12-29 11:02:46'),
(15, 1, 0, 'Draftman', NULL, 1, '2020-02-10 04:19:25', '2020-02-10 04:19:25'),
(16, 1, 0, 'Jr. Software Engineer', NULL, 1, '2020-02-10 04:19:45', '2020-02-10 04:19:45'),
(17, 1, 0, 'IT Executive', NULL, 1, '2020-02-10 04:20:03', '2020-02-10 04:20:03'),
(18, 1, 0, 'Content Developer', NULL, 1, '2020-02-10 04:20:44', '2020-02-10 04:20:44'),
(19, 1, 0, 'Motion Graphic Editor', NULL, 1, '2020-02-10 04:21:00', '2020-02-10 04:21:00'),
(20, 1, 0, 'Asst. Programmer', NULL, 1, '2020-02-10 04:21:12', '2020-02-10 04:21:12'),
(21, 1, 0, 'Site Engineer', NULL, 3, '2020-11-02 10:51:39', '2020-11-02 10:51:39'),
(22, 1, 0, 'Trainer Graphics Designer', NULL, 3, '2021-07-07 11:05:31', '2021-07-07 11:05:31'),
(23, 1, 0, 'Executive, Creative and Design', NULL, 3, '2021-07-07 11:05:46', '2021-07-07 11:05:46'),
(24, 1, 0, 'Jr. Software Developer', NULL, 3, '2021-07-07 11:06:05', '2021-07-07 11:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `post_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `post_slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `post_content_bn` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `post_excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `post_excerpt_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `post_status` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_time` timestamp NULL DEFAULT NULL,
  `post_type` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_format` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `upload_type` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_thumb` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb_status` tinyint(1) NOT NULL DEFAULT '1',
  `comments_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `active`, `name`, `description`, `user_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super-admin', 'This is the Master Role.', 1, 0, '2019-08-28 16:59:49', '2019-08-28 16:59:49'),
(2, 1, 'Administrator', 'Administrator user role.', 1, 0, '2019-08-28 17:18:50', '2019-08-28 17:18:50'),
(3, 1, 'Editor', 'This is Editor user role.', 1, 0, '2019-08-28 17:19:17', '2019-08-28 17:19:17'),
(4, 1, 'Contributor', 'This is Contributor user role.', 1, 0, '2019-08-28 17:20:01', '2019-08-28 17:20:01'),
(5, 1, 'Subscriber', 'This is Subscriber user role.', 1, 0, '2019-08-28 17:20:32', '2019-08-28 17:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `rounds`
--

CREATE TABLE `rounds` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `module_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `active`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'site_title', 'IsDB-BISEW', 2, NULL, '2019-11-27 03:28:49'),
(2, 1, 'tagline', 'Islamic Development Bank-Bangladesh Islamic Solidarity Educational Wakf', 2, NULL, '2019-11-27 03:28:49'),
(3, 1, 'logo_preview', 'title', 2, NULL, '2019-11-27 03:28:49'),
(4, 1, 'logo_picture', 'photos/shares/Logos/2019-10/1569908409-isdb-bisew.png', 1, NULL, '2019-10-01 05:40:10'),
(5, 1, 'home_url', 'https://www.isdb-bisew.org/', 2, NULL, '2019-11-27 03:28:49'),
(6, 1, 'meta_title', 'IsDB-BISEW - Islamic Development Bank-Bangladesh Islamic Solidarity Educational Wakf', 2, NULL, '2019-11-27 03:28:49'),
(7, 1, 'meta_desc', 'IsDB-BISEW was established following an agreement between the Islamic Development Bank, Jeddah, Saudi Arabia, and the Government of Bangladesh.', 2, NULL, '2019-11-27 03:28:49'),
(8, 1, 'meta_picture', 'photos/shares/Meta-Picture/isdb-bisew-11-2019.jpg', 1, NULL, '2019-11-26 11:18:18'),
(9, 1, 'date_format', 'M d, Y', 2, NULL, '2019-11-27 03:28:49'),
(10, 1, 'time_format', 'g:i a', 2, NULL, '2019-11-27 03:28:49'),
(11, 1, 'default_theme', 'default', 1, NULL, '2019-09-08 03:58:06'),
(12, 1, 'facebook_url', 'https://www.facebook.com/IDBBISEWSCHOLARSHIP', 2, NULL, '2019-11-27 03:28:49'),
(13, 1, 'linkedin_url', '#', 2, NULL, '2019-11-27 03:28:49'),
(14, 1, 'youtube_url', '#', 2, NULL, '2019-11-27 03:28:49'),
(15, 1, 'meta_key', NULL, 2, NULL, '2019-11-27 03:28:49'),
(16, 1, 'linkedid_url', '#', 2, NULL, NULL),
(17, 1, 'vt_api_base_url', 'http://pis.isdb-bisew.org/', 2, NULL, NULL),
(18, 1, 'vt_api_token', 'kPXTWxneR6PSioi2c8zla0XCeqB2oriPU7GxrsVEsqHwyGCqH6HQjs1BIL9S', 2, NULL, NULL),
(19, 1, 'tranding_now', '/,it-scholarship-programme,vocational-training-programme,madrasah-education-programme,four-year-diploma-scholarship,orphanage-programme', 2, NULL, NULL),
(20, 1, 'twitter_url', NULL, 2, NULL, NULL),
(21, 1, 'project_complete', '38.9', 2, NULL, NULL),
(22, 1, 'total_beneficiaries', '42574', 2, NULL, NULL),
(23, 1, 'job_placement_voc', '92', 2, NULL, NULL),
(24, 1, 'job_placement_it', '89', 2, NULL, NULL),
(25, 1, 'madrasah_passing_rate', '95', 2, NULL, NULL),
(26, 1, 'beneficiaries_voc', '1925', 2, NULL, NULL),
(27, 1, 'beneficiaries_it', '16105', 2, NULL, NULL),
(28, 1, 'beneficiaries_madrasah', '28012', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_link` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expertise` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_type` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_success_stories` tinyint(1) DEFAULT '0',
  `profile_image` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_id` int NOT NULL,
  `round_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `position_id` int NOT NULL,
  `company_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `subject_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `module_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxonomies`
--

CREATE TABLE `taxonomies` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `term` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxonomies`
--

INSERT INTO `taxonomies` (`id`, `active`, `name`, `slug`, `description`, `parent_id`, `picture`, `term`, `module`, `user_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Notice', 'notice', 'Notice', NULL, NULL, 'category', '0', 3, 0, '2019-09-05 07:54:06', '2020-01-02 16:12:33'),
(2, 1, 'Trending Now', 'trending-now', 'This category manage all Trending now post.', NULL, NULL, 'category', '0', 3, 0, '2019-09-05 07:54:19', '2020-01-02 16:12:28'),
(3, 1, 'Main-Slider', 'main-slider', 'Main-Slider', NULL, NULL, 'category', '0', 3, 0, '2019-09-05 07:54:39', '2020-01-02 16:12:23'),
(4, 1, 'Success Stories', 'success-stories', 'Success Stories', NULL, NULL, 'category', '0', 3, 0, '2019-09-05 07:55:05', '2020-01-02 16:12:16'),
(5, 1, 'Top Placement', 'top-placement', 'Top Placement', NULL, NULL, 'category', '0', 3, 0, '2019-09-05 07:59:41', '2020-01-02 16:12:09'),
(6, 1, 'Latest Update', 'latest-update', 'This is the category for latest news manage.', NULL, NULL, 'category', '0', 3, 0, '2019-09-05 08:00:04', '2020-01-02 16:12:03'),
(7, 1, 'IT Scholarship', 'it-scholarship', 'IT Scholarship', 0, NULL, 'photo-category', 'photo-gallery', 1, 0, '2019-09-05 08:05:27', '2019-09-05 08:05:27'),
(8, 1, 'Vocational training', 'vocational-training', 'Vocational training', 0, NULL, 'photo-category', 'photo-gallery', 1, 0, '2019-09-05 08:05:37', '2019-09-05 08:05:37'),
(9, 1, 'Madrasah Project', 'madrasah-project', 'Madrasah Project', 0, NULL, 'photo-category', 'photo-gallery', 1, 0, '2019-09-05 08:05:45', '2019-09-05 08:05:45'),
(10, 1, 'Four Year Diploma', 'four-year-diploma', 'Four Year Diploma', 0, NULL, 'photo-category', 'photo-gallery', 1, 0, '2019-09-05 08:05:52', '2019-09-05 08:05:52'),
(11, 1, 'Business Center', 'business-center', 'Business Center', 0, NULL, 'photo-category', 'photo-gallery', 1, 0, '2019-09-05 08:05:57', '2019-09-05 08:05:57'),
(12, 1, 'Other Photos', 'other-photos', 'Other Photos', 0, NULL, 'photo-category', 'photo-gallery', 1, 0, '2019-09-05 08:06:04', '2019-09-05 08:06:04'),
(13, 1, 'IsDB-BISEW', 'isdb-bisew', 'Islamic Development Bank-Bangladesh Islamic Solidarity Educational Wakf', 0, NULL, 'tags', '0', 3, 0, '2019-09-21 05:49:46', '2020-01-02 16:12:56'),
(14, 1, 'IT Scholarship', 'it-scholarship', 'IT Scholarship', 0, NULL, 'tags', '0', 3, 0, '2019-09-21 05:51:32', '2020-01-02 16:12:51'),
(15, 1, 'Events', 'events', 'Control All Events posts.', NULL, NULL, 'category', '0', 3, 0, '2019-10-01 05:36:20', '2020-01-02 16:11:54'),
(16, 1, 'IDB Bhaban', 'idb-bhaban', NULL, NULL, NULL, 'photo-category', 'photo-gallery', 3, 0, '2020-01-02 14:19:25', '2020-01-02 14:19:25'),
(17, 1, 'Top Freelancer', 'top-freelancer', NULL, NULL, NULL, 'category', NULL, 2, 1, '2021-07-06 10:57:31', '2021-07-06 10:57:42'),
(18, 1, 'Top Freelancer', 'top-freelancer', 'Top freelancer', NULL, NULL, 'category', NULL, 2, 0, '2021-07-06 10:58:05', '2021-07-06 10:58:05'),
(19, 1, 'Tender', 'tender', 'Tender Notice', NULL, NULL, 'category', '0', 2, 0, '2021-07-25 05:05:56', '2021-07-25 05:06:50'),
(20, 1, 'Project', 'project', NULL, NULL, NULL, 'category', NULL, 2, 1, '2023-04-04 04:16:32', '2023-04-04 04:21:56'),
(21, 1, 'Class Project', 'class-project', 'Class Project', NULL, NULL, 'category', '0', 2, 0, '2023-04-04 04:22:12', '2023-04-04 04:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `tender_notice_points`
--

CREATE TABLE `tender_notice_points` (
  `id` int NOT NULL,
  `number` int DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `value` text,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tender_notice_points`
--

INSERT INTO `tender_notice_points` (`id`, `number`, `title`, `value`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '2021-08-10 08:58:49', '2021-08-10 11:58:49'),
(2, 1, 'What is Lorem Ipsum2?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '2021-08-10 08:58:49', '2021-08-11 11:58:49');

-- --------------------------------------------------------

--
-- Table structure for table `term_relations`
--

CREATE TABLE `term_relations` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `taxonomy_id` int NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_relations`
--

INSERT INTO `term_relations` (`id`, `is_active`, `taxonomy_id`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 7, 1, '2019-09-15 11:31:49', '2019-10-24 09:49:29'),
(2, 0, 2, 7, 1, '2019-09-15 11:31:50', '2019-10-24 09:49:29'),
(3, 1, 1, 8, 1, '2019-09-15 11:39:19', '2020-01-01 21:35:39'),
(4, 0, 2, 8, 1, '2019-09-15 11:39:19', '2020-01-01 21:35:39'),
(5, 1, 6, 8, 1, '2019-09-15 11:40:36', '2020-01-01 21:35:40'),
(6, 0, 3, 9, 1, '2019-09-16 08:00:21', '2019-09-19 06:06:44'),
(7, 1, 3, 10, 1, '2019-09-16 08:33:35', '2019-10-06 11:08:06'),
(8, 1, 3, 11, 1, '2019-09-16 09:53:42', '2019-10-06 16:58:06'),
(9, 1, 6, 15, 1, '2019-09-16 11:34:07', '2019-10-06 12:28:55'),
(10, 1, 6, 16, 1, '2019-09-17 04:08:53', '2019-09-17 04:09:18'),
(11, 1, 6, 17, 1, '2019-09-17 04:30:52', '2019-09-17 04:30:52'),
(12, 1, 6, 18, 1, '2019-09-17 04:31:54', '2019-10-07 04:41:48'),
(13, 0, 5, 18, 1, '2019-09-17 04:35:10', '2019-10-07 04:41:48'),
(14, 0, 6, 19, 1, '2019-09-17 04:46:34', '2020-01-01 21:31:04'),
(15, 1, 6, 20, 1, '2019-09-17 08:41:51', '2019-10-07 04:30:12'),
(16, 1, 3, 21, 1, '2019-09-19 06:12:25', '2019-11-03 10:33:15'),
(17, 1, 6, 21, 1, '2019-09-19 06:12:25', '2019-11-03 10:33:15'),
(18, 0, 14, 22, 1, '2019-09-22 09:42:14', '2022-07-04 09:45:24'),
(19, 1, 4, 22, 1, '2019-09-22 09:42:14', '2022-07-04 09:45:24'),
(20, 1, 4, 23, 1, '2019-09-22 09:44:37', '2019-09-22 09:44:37'),
(21, 1, 4, 24, 1, '2019-09-22 09:44:37', '2019-09-22 09:44:37'),
(22, 1, 4, 25, 1, '2019-09-22 09:45:57', '2019-09-22 09:45:57'),
(23, 1, 4, 26, 1, '2019-09-22 10:04:40', '2019-09-22 10:04:40'),
(24, 0, 3, 20, 1, '2019-10-05 09:02:07', '2019-10-07 04:30:12'),
(25, 0, 3, 19, 1, '2019-10-05 09:02:50', '2020-01-01 21:31:04'),
(26, 0, 3, 51, 1, '2019-10-05 09:07:24', '2020-11-02 14:58:56'),
(27, 1, 3, 57, 1, '2019-10-06 11:17:11', '2019-10-06 12:18:15'),
(28, 0, 6, 51, 1, '2019-10-06 12:18:50', '2020-11-02 14:58:56'),
(29, 1, 3, 58, 1, '2019-10-06 12:20:43', '2019-10-17 06:47:56'),
(30, 0, 3, 59, 1, '2019-10-06 12:27:46', '2019-11-04 04:07:43'),
(31, 1, 3, 15, 1, '2019-10-06 12:28:55', '2019-10-06 12:28:55'),
(32, 1, 6, 59, 1, '2019-10-06 12:35:51', '2019-11-04 04:07:43'),
(33, 1, 1, 60, 1, '2019-10-06 18:16:50', '2019-10-15 09:02:17'),
(34, 1, 1, 61, 1, '2019-10-06 18:17:44', '2020-01-01 21:32:52'),
(35, 0, 1, 62, 1, '2019-10-06 18:20:17', '2019-11-25 04:16:02'),
(36, 1, 1, 63, 1, '2019-10-06 18:22:54', '2019-10-06 18:23:05'),
(37, 0, 2, 62, 1, '2019-10-06 18:23:53', '2019-11-25 04:16:02'),
(38, 0, 6, 61, 1, '2019-10-06 18:24:11', '2020-01-01 21:32:52'),
(39, 0, 2, 61, 1, '2019-10-07 03:07:11', '2020-01-01 21:32:52'),
(40, 1, 4, 71, 1, '2019-10-22 09:17:05', '2019-10-22 09:17:05'),
(41, 1, 4, 72, 1, '2019-10-22 09:18:33', '2019-10-28 04:14:33'),
(42, 0, 1, 72, 1, '2019-10-24 05:30:00', '2019-10-28 04:14:33'),
(43, 0, 2, 72, 1, '2019-10-24 05:30:00', '2019-10-28 04:14:33'),
(44, 1, 6, 73, 1, '2019-10-24 07:13:03', '2019-10-24 07:13:03'),
(45, 0, 2, 74, 1, '2019-10-24 09:49:14', '2019-11-03 09:48:29'),
(46, 0, 3, 74, 1, '2019-10-24 09:49:14', '2019-11-03 09:48:29'),
(47, 0, 4, 74, 1, '2019-10-24 09:49:14', '2019-11-03 09:48:29'),
(48, 0, 5, 72, 1, '2019-10-28 04:06:38', '2019-10-28 04:14:33'),
(49, 0, 13, 77, 1, '2019-11-03 07:30:55', '2019-11-23 04:03:30'),
(50, 0, 1, 77, 1, '2019-11-03 07:30:55', '2019-11-23 04:03:30'),
(51, 0, 2, 77, 1, '2019-11-03 07:30:55', '2019-11-23 04:03:30'),
(52, 0, 2, 78, 1, '2019-11-03 10:13:00', '2020-01-01 21:34:46'),
(53, 1, 3, 78, 1, '2019-11-03 10:13:00', '2020-01-01 21:34:46'),
(54, 0, 2, 79, 1, '2019-11-03 10:30:57', '2020-01-01 21:30:43'),
(55, 1, 6, 79, 1, '2019-11-03 10:30:57', '2020-01-01 21:30:43'),
(56, 0, 2, 80, 1, '2019-11-03 10:37:30', '2019-11-26 10:58:09'),
(57, 1, 6, 80, 1, '2019-11-03 10:37:30', '2019-11-26 10:58:09'),
(58, 1, 6, 81, 1, '2019-11-04 04:11:58', '2019-11-04 04:11:58'),
(59, 1, 1, 19, 1, '2019-11-21 04:12:50', '2020-01-01 21:31:04'),
(60, 0, 2, 19, 1, '2019-11-21 04:18:25', '2020-01-01 21:31:04'),
(61, 1, 1, 84, 1, '2019-11-23 04:27:29', '2020-08-04 05:27:15'),
(62, 0, 2, 84, 1, '2019-11-23 04:27:29', '2020-08-04 05:27:15'),
(63, 1, 1, 85, 1, '2019-11-23 04:46:54', '2020-01-01 21:34:26'),
(64, 0, 2, 85, 1, '2019-11-23 04:46:54', '2020-01-01 21:34:26'),
(65, 0, 4, 86, 1, '2019-11-24 06:30:25', '2019-12-29 11:24:15'),
(66, 1, 5, 86, 1, '2019-11-24 06:31:11', '2019-12-29 11:24:15'),
(67, 0, 4, 87, 1, '2019-11-24 06:31:59', '2019-12-29 11:24:07'),
(68, 1, 5, 87, 1, '2019-11-24 06:31:59', '2019-12-29 11:24:07'),
(69, 0, 4, 88, 1, '2019-11-24 06:33:14', '2019-12-29 11:24:00'),
(70, 1, 5, 88, 1, '2019-11-24 06:33:14', '2019-12-29 11:24:00'),
(71, 0, 4, 89, 1, '2019-11-24 06:34:30', '2019-12-29 11:23:52'),
(72, 1, 5, 89, 1, '2019-11-24 06:34:30', '2019-12-29 11:23:52'),
(73, 0, 4, 90, 1, '2019-11-24 06:35:27', '2019-12-29 11:23:27'),
(74, 1, 5, 90, 1, '2019-11-24 06:35:27', '2019-12-29 11:23:27'),
(75, 1, 6, 91, 1, '2019-11-25 04:22:47', '2020-02-06 06:37:38'),
(76, 1, 6, 93, 1, '2019-12-29 10:37:16', '2020-01-02 08:43:38'),
(77, 1, 5, 94, 1, '2019-12-29 11:19:11', '2019-12-29 11:36:58'),
(78, 0, 4, 95, 1, '2019-12-29 11:21:02', '2019-12-29 11:36:42'),
(79, 1, 5, 95, 1, '2019-12-29 11:21:42', '2019-12-29 11:36:42'),
(80, 1, 5, 96, 1, '2019-12-29 11:22:35', '2019-12-29 11:36:25'),
(81, 1, 1, 97, 3, '2020-01-01 19:21:57', '2020-01-13 11:41:53'),
(82, 0, 3, 97, 3, '2020-01-01 19:21:57', '2020-01-13 11:41:53'),
(83, 0, 2, 97, 3, '2020-01-01 21:30:06', '2020-01-13 11:41:53'),
(84, 1, 1, 98, 3, '2020-01-06 10:53:36', '2020-08-04 05:26:55'),
(85, 0, 2, 98, 3, '2020-01-06 10:53:36', '2020-08-04 05:26:55'),
(86, 1, 6, 99, 3, '2020-01-08 07:15:36', '2020-01-08 08:08:18'),
(87, 1, 1, 100, 3, '2020-01-14 03:31:57', '2020-01-26 16:11:26'),
(88, 0, 2, 100, 3, '2020-01-14 03:31:57', '2020-01-26 16:11:26'),
(89, 1, 1, 103, 3, '2020-01-26 16:02:17', '2020-02-08 04:17:47'),
(90, 0, 2, 103, 3, '2020-01-26 16:02:17', '2020-02-08 04:17:47'),
(91, 0, 1, 104, 1, '2020-02-02 10:56:50', '2020-02-02 10:57:16'),
(92, 0, 2, 104, 1, '2020-02-02 10:56:50', '2020-02-02 10:57:16'),
(93, 1, 1, 105, 3, '2020-02-03 03:26:51', '2020-04-07 11:22:16'),
(94, 0, 2, 105, 3, '2020-02-03 03:26:51', '2020-04-07 11:22:16'),
(95, 1, 5, 106, 1, '2020-02-10 04:49:19', '2020-02-10 04:49:19'),
(96, 1, 5, 107, 1, '2020-02-10 04:50:44', '2020-02-10 04:50:44'),
(97, 1, 5, 108, 1, '2020-02-10 04:52:11', '2020-02-10 04:52:11'),
(98, 1, 5, 109, 1, '2020-02-10 04:53:13', '2020-02-10 04:53:21'),
(99, 1, 5, 110, 1, '2020-02-10 04:54:33', '2020-02-10 04:54:33'),
(100, 1, 5, 111, 1, '2020-02-10 04:55:36', '2020-11-02 11:13:46'),
(101, 0, 2, 112, 3, '2020-02-26 08:47:01', '2021-06-23 18:57:10'),
(102, 1, 6, 112, 3, '2020-02-26 08:47:01', '2021-06-23 18:57:10'),
(103, 1, 15, 112, 3, '2020-02-26 08:47:01', '2021-06-23 18:57:10'),
(104, 1, 6, 113, 1, '2020-03-01 11:02:57', '2020-03-10 05:41:43'),
(105, 1, 1, 115, 3, '2020-03-10 07:19:50', '2020-08-31 10:57:59'),
(106, 0, 2, 115, 3, '2020-03-10 07:19:50', '2020-08-31 10:57:58'),
(108, 1, 1, 117, 1, '2020-03-15 18:00:03', '2020-08-10 04:59:34'),
(109, 1, 1, 119, 3, '2020-03-19 06:44:25', '2020-08-04 05:25:46'),
(110, 0, 2, 119, 3, '2020-03-19 06:44:25', '2020-08-04 05:25:46'),
(111, 1, 1, 120, 3, '2020-04-01 09:56:00', '2020-04-06 15:54:15'),
(112, 0, 2, 120, 3, '2020-04-01 09:56:00', '2020-04-06 15:54:15'),
(113, 1, 1, 121, 3, '2020-04-07 11:21:00', '2020-08-04 05:26:00'),
(114, 0, 2, 121, 3, '2020-04-07 11:21:00', '2020-08-04 05:26:00'),
(115, 1, 1, 122, 3, '2020-08-04 05:25:20', '2020-08-31 10:49:31'),
(116, 0, 2, 122, 3, '2020-08-04 05:25:20', '2020-08-31 10:49:31'),
(117, 1, 1, 123, 3, '2020-08-04 05:36:40', '2020-11-02 13:52:50'),
(118, 0, 2, 123, 3, '2020-08-04 05:36:40', '2020-11-02 13:52:50'),
(119, 1, 1, 124, 3, '2020-08-10 04:43:05', '2020-08-26 08:40:18'),
(120, 0, 2, 124, 3, '2020-08-10 04:43:05', '2020-08-26 08:40:18'),
(121, 1, 1, 125, 3, '2020-08-26 08:56:10', '2020-09-03 11:19:55'),
(122, 0, 2, 125, 3, '2020-08-26 08:56:10', '2020-09-03 11:19:55'),
(123, 1, 1, 126, 3, '2020-09-01 11:05:31', '2020-09-09 11:21:47'),
(124, 0, 2, 126, 3, '2020-09-01 11:05:31', '2020-09-09 11:21:47'),
(125, 1, 1, 127, 3, '2020-09-03 11:40:57', '2020-11-02 15:08:37'),
(126, 0, 2, 127, 3, '2020-09-03 11:40:57', '2020-11-02 15:08:37'),
(127, 1, 1, 128, 3, '2020-09-09 11:16:36', '2020-09-23 12:24:31'),
(128, 0, 2, 128, 3, '2020-09-09 11:16:36', '2020-09-23 12:24:31'),
(129, 1, 1, 129, 3, '2020-09-27 11:04:26', '2020-10-18 09:45:17'),
(130, 0, 2, 129, 3, '2020-09-27 11:04:26', '2020-10-18 09:45:17'),
(131, 1, 1, 130, 3, '2020-10-12 13:07:18', '2020-10-18 09:44:54'),
(132, 0, 2, 130, 3, '2020-10-12 13:07:18', '2020-10-18 09:44:54'),
(133, 1, 1, 131, 3, '2020-10-13 10:06:40', '2020-10-18 09:44:34'),
(134, 0, 2, 131, 3, '2020-10-13 11:13:36', '2020-10-18 09:44:34'),
(135, 1, 1, 132, 3, '2020-10-18 09:42:09', '2020-11-02 14:00:06'),
(136, 0, 2, 132, 3, '2020-10-18 09:42:09', '2020-11-02 14:00:06'),
(137, 1, 5, 133, 3, '2020-11-02 11:28:54', '2020-11-02 11:28:54'),
(138, 1, 5, 134, 3, '2020-11-02 11:29:49', '2020-11-02 11:29:49'),
(139, 1, 5, 135, 3, '2020-11-02 11:30:39', '2020-11-02 11:30:39'),
(140, 1, 1, 136, 3, '2020-11-02 13:59:24', '2021-02-01 11:53:49'),
(141, 0, 2, 136, 3, '2020-11-02 13:59:24', '2021-02-01 11:53:49'),
(142, 0, 6, 127, 3, '2020-11-02 15:08:12', '2020-11-02 15:08:37'),
(143, 1, 1, 137, 3, '2020-11-05 09:12:46', '2020-12-10 10:38:50'),
(144, 0, 2, 137, 3, '2020-11-05 09:12:46', '2020-12-10 10:38:50'),
(145, 1, 1, 138, 3, '2020-11-15 11:43:53', '2020-12-10 10:38:03'),
(146, 0, 2, 138, 3, '2020-11-15 11:43:53', '2020-12-10 10:38:03'),
(147, 0, 1, 139, 1, '2020-11-30 08:40:00', '2020-11-30 08:41:09'),
(148, 1, 1, 140, 3, '2020-11-30 10:59:59', '2020-12-10 10:37:28'),
(149, 0, 2, 140, 3, '2020-11-30 10:59:59', '2020-12-10 10:37:28'),
(150, 1, 1, 141, 3, '2020-12-01 11:52:42', '2020-12-10 11:02:07'),
(151, 0, 2, 141, 3, '2020-12-01 11:52:42', '2020-12-10 11:02:07'),
(152, 1, 6, 142, 3, '2020-12-04 16:33:51', '2020-12-20 04:21:59'),
(153, 1, 1, 143, 3, '2020-12-10 10:37:12', '2020-12-30 09:07:00'),
(154, 0, 2, 143, 3, '2020-12-10 10:37:12', '2020-12-30 09:07:00'),
(155, 1, 1, 144, 3, '2020-12-17 10:38:36', '2020-12-30 09:06:47'),
(156, 0, 2, 144, 3, '2020-12-17 10:38:36', '2020-12-30 09:06:47'),
(157, 1, 1, 145, 3, '2020-12-21 08:53:52', '2020-12-30 09:04:15'),
(158, 0, 2, 145, 3, '2020-12-21 08:53:52', '2020-12-30 09:04:15'),
(159, 1, 1, 146, 3, '2020-12-24 04:45:14', '2020-12-28 10:02:20'),
(160, 1, 2, 146, 3, '2020-12-24 04:45:14', '2020-12-28 10:02:20'),
(161, 1, 1, 147, 3, '2020-12-28 10:03:14', '2021-01-06 05:07:41'),
(162, 0, 2, 147, 3, '2020-12-28 10:03:14', '2021-01-06 05:07:41'),
(163, 0, 1, 148, 3, '2020-12-30 09:00:26', '2020-12-30 09:06:17'),
(164, 0, 2, 148, 3, '2020-12-30 09:00:26', '2020-12-30 09:06:17'),
(165, 1, 1, 149, 3, '2020-12-30 09:06:08', '2021-01-06 05:08:00'),
(166, 0, 2, 149, 3, '2020-12-30 09:06:08', '2021-01-06 05:08:00'),
(167, 0, 6, 136, 3, '2020-12-30 09:19:27', '2021-02-01 11:53:49'),
(168, 1, 1, 150, 3, '2021-01-06 05:07:20', '2021-01-19 11:04:38'),
(169, 0, 2, 150, 3, '2021-01-06 05:07:20', '2021-01-19 11:04:38'),
(170, 1, 1, 151, 3, '2021-02-01 11:54:56', '2021-06-01 04:57:33'),
(171, 0, 2, 151, 3, '2021-02-01 11:54:56', '2021-06-01 04:57:33'),
(172, 1, 1, 152, 3, '2021-02-03 06:14:20', '2021-02-24 09:45:03'),
(173, 0, 2, 152, 3, '2021-02-03 06:14:20', '2021-02-24 09:45:03'),
(174, 1, 1, 153, 3, '2021-02-14 10:40:45', '2021-02-17 10:10:22'),
(175, 0, 2, 153, 3, '2021-02-14 10:40:45', '2021-02-17 10:10:22'),
(176, 1, 1, 154, 3, '2021-02-17 10:10:02', '2021-02-24 09:46:05'),
(177, 0, 2, 154, 3, '2021-02-17 10:10:02', '2021-02-24 09:46:05'),
(178, 1, 1, 155, 3, '2021-02-24 09:44:26', '2021-03-08 10:41:04'),
(179, 0, 2, 155, 3, '2021-02-24 09:44:26', '2021-03-08 10:41:04'),
(180, 1, 6, 156, 3, '2021-02-28 06:56:22', '2023-04-04 04:47:52'),
(181, 1, 6, 157, 3, '2021-03-08 04:53:34', '2021-03-08 04:55:04'),
(182, 1, 1, 158, 3, '2021-03-08 10:25:27', '2021-03-16 09:21:40'),
(183, 0, 2, 158, 3, '2021-03-08 10:25:27', '2021-03-16 09:21:40'),
(184, 1, 1, 159, 3, '2021-03-08 10:40:49', '2021-03-16 09:21:26'),
(185, 0, 2, 159, 3, '2021-03-08 10:40:49', '2021-03-16 09:21:26'),
(186, 1, 1, 160, 3, '2021-03-08 10:42:36', '2021-03-09 09:54:32'),
(187, 1, 1, 161, 3, '2021-03-11 04:42:54', '2021-03-11 04:43:12'),
(188, 0, 2, 162, 3, '2021-03-16 05:28:14', '2021-06-23 08:11:22'),
(189, 1, 6, 162, 3, '2021-03-16 05:28:14', '2021-06-23 08:11:22'),
(190, 1, 1, 163, 3, '2021-03-21 05:31:27', '2021-06-01 04:58:04'),
(191, 0, 2, 163, 3, '2021-03-21 05:31:27', '2021-06-01 04:58:04'),
(192, 1, 1, 164, 3, '2021-04-02 04:58:10', '2021-05-01 04:50:10'),
(193, 0, 2, 164, 3, '2021-04-02 04:58:10', '2021-05-01 04:50:10'),
(194, 1, 1, 165, 3, '2021-04-04 06:31:22', '2021-06-01 04:57:47'),
(195, 0, 2, 165, 3, '2021-04-04 06:31:22', '2021-06-01 04:57:47'),
(196, 1, 1, 167, 3, '2021-06-01 10:21:41', '2021-09-12 07:26:06'),
(197, 1, 2, 167, 3, '2021-06-01 10:21:41', '2021-09-12 07:26:06'),
(198, 1, 1, 168, 3, '2021-06-02 06:34:41', '2021-06-23 08:11:01'),
(199, 0, 2, 168, 3, '2021-06-02 06:34:41', '2021-06-23 08:11:01'),
(200, 1, 1, 169, 3, '2021-06-06 07:14:09', '2021-06-23 08:10:18'),
(201, 0, 2, 169, 3, '2021-06-06 07:14:09', '2021-06-23 08:10:18'),
(202, 1, 1, 170, 3, '2021-06-09 08:56:36', '2021-06-23 08:09:58'),
(203, 0, 2, 170, 3, '2021-06-09 08:56:36', '2021-06-23 08:09:58'),
(204, 0, 1, 171, 3, '2021-06-23 08:07:05', '2021-06-23 15:47:48'),
(205, 0, 2, 171, 3, '2021-06-23 08:07:05', '2021-06-23 15:47:48'),
(206, 1, 1, 172, 3, '2021-06-23 13:04:34', '2021-06-26 05:40:15'),
(207, 0, 1, 174, 3, '2021-06-23 15:41:03', '2021-08-11 05:57:21'),
(208, 1, 3, 174, 3, '2021-06-23 15:42:35', '2021-08-11 05:57:21'),
(209, 1, 1, 175, 3, '2021-06-23 15:54:44', '2021-09-15 09:22:17'),
(210, 0, 2, 175, 3, '2021-06-23 15:54:44', '2021-09-15 09:22:17'),
(211, 1, 1, 112, 3, '2021-06-23 18:57:10', '2021-06-23 18:57:10'),
(212, 0, 2, 172, 3, '2021-06-23 18:58:48', '2021-06-26 05:40:15'),
(213, 1, 1, 177, 3, '2021-06-26 05:03:13', '2021-07-03 09:29:45'),
(214, 0, 2, 177, 3, '2021-06-26 05:03:13', '2021-07-03 09:29:45'),
(215, 1, 1, 178, 3, '2021-06-28 10:09:23', '2021-07-03 09:28:51'),
(216, 0, 2, 178, 3, '2021-06-28 10:09:23', '2021-07-03 09:28:51'),
(217, 1, 1, 179, 3, '2021-07-03 09:28:34', '2021-08-11 05:36:44'),
(218, 0, 2, 179, 3, '2021-07-03 09:28:34', '2021-08-11 05:36:44'),
(219, 1, 1, 180, 3, '2021-07-13 07:25:23', '2021-08-11 05:36:32'),
(220, 0, 2, 180, 3, '2021-07-13 07:25:23', '2021-08-11 05:36:32'),
(221, 1, 1, 181, 3, '2021-07-18 13:43:28', '2021-08-11 05:36:19'),
(222, 0, 2, 181, 3, '2021-07-18 13:43:28', '2021-08-11 05:36:19'),
(223, 0, 19, 175, 2, '2021-07-25 05:18:21', '2021-09-15 09:22:17'),
(224, 0, 19, 174, 2, '2021-07-25 05:37:22', '2021-08-11 05:57:21'),
(225, 0, 1, 183, 2, '2021-08-03 08:28:38', '2021-08-03 09:43:07'),
(226, 1, 1, 184, 2, '2021-08-03 09:25:46', '2021-08-19 04:19:44'),
(227, 1, 2, 184, 2, '2021-08-03 09:25:46', '2021-08-19 04:19:44'),
(228, 0, 19, 185, 2, '2021-08-11 06:01:47', '2021-08-11 13:28:16'),
(229, 1, 1, 185, 3, '2021-08-11 13:28:16', '2021-08-11 13:28:16'),
(230, 1, 2, 186, 3, '2021-08-18 06:53:26', '2021-08-18 07:50:27'),
(231, 0, 1, 186, 3, '2021-08-18 07:43:25', '2021-08-18 07:50:27'),
(232, 1, 6, 186, 3, '2021-08-18 07:47:18', '2021-08-18 07:50:27'),
(233, 1, 1, 187, 3, '2021-08-19 04:24:12', '2021-09-12 07:25:00'),
(234, 0, 2, 187, 3, '2021-08-19 04:24:12', '2021-09-12 07:25:00'),
(235, 1, 1, 188, 3, '2021-08-24 14:20:14', '2021-09-12 07:25:36'),
(236, 0, 2, 188, 3, '2021-08-24 14:20:14', '2021-09-12 07:25:36'),
(237, 0, 1, 189, 3, '2021-09-15 08:10:02', '2021-09-15 08:22:00'),
(238, 0, 2, 189, 3, '2021-09-15 08:10:02', '2021-09-15 08:22:00'),
(239, 1, 1, 190, 3, '2021-09-15 08:21:57', '2021-09-15 08:21:57'),
(240, 1, 2, 190, 3, '2021-09-15 08:21:57', '2021-09-15 08:21:57'),
(241, 0, 6, 191, 3, '2021-09-20 04:28:18', '2023-04-04 04:58:31'),
(242, 1, 19, 192, 3, '2021-09-22 05:13:38', '2021-09-22 10:12:32'),
(243, 1, 1, 192, 3, '2021-09-22 05:42:11', '2021-09-22 10:12:32'),
(244, 1, 2, 192, 3, '2021-09-22 05:42:11', '2021-09-22 10:12:32'),
(245, 1, 4, 193, 2, '2022-07-04 09:29:29', '2023-06-21 09:46:19'),
(246, 1, 21, 191, 2, '2023-04-04 04:46:40', '2023-04-04 04:58:31'),
(247, 1, 21, 156, 2, '2023-04-04 04:47:52', '2023-04-04 04:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `term_taxonomies`
--

CREATE TABLE `term_taxonomies` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(455) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `module_id` int DEFAULT NULL,
  `menugroup` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_taxonomies`
--

INSERT INTO `term_taxonomies` (`id`, `active`, `name`, `slug`, `description`, `user_id`, `module_id`, `menugroup`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Category', 'category', 'This is the Category Term.', 1, 0, '182,183', 0, '2019-09-05 05:34:23', '2019-09-05 05:34:23'),
(2, 1, 'Tags', 'tags', 'This is the Tags Term', 1, 0, '184,185', 0, '2019-09-05 05:34:39', '2019-09-05 05:34:39'),
(3, 1, 'Photo Category', 'photo-category', 'This is the Term for managing  photo gallery.', 1, 8, '186,187', 0, '2019-09-05 05:34:58', '2019-09-05 05:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `firstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `active`, `firstName`, `LastName`, `gender`, `role_id`, `is_delete`, `picture`, `email`, `email_verified_at`, `password`, `remember_token`, `app_token`, `app_reference`, `created_at`, `updated_at`, `api_token`) VALUES
(1, 1, 'Manik', 'Khanik', 'female', 2, 0, '', 'manik@isdb-bisew.org', '2019-08-28 17:03:02', '$2y$12$YWmSQRxQy2NmJfyEIPIQpO5vG9kWPX1dYXCHxoiSwX3Z3ghKqiDGG', '7RcENS9WSKxFQjFvYkGENbf3asfhFpbfSVXb7RvlNjRUPk9aK5LCBlOc6x3I', NULL, NULL, '2019-11-21 04:00:20', '2021-07-08 10:16:11', NULL),
(2, 1, 'Anwar Jahid', NULL, 'male', 1, 0, '', 'ajr.jahid@gmail.com', '2019-11-21 17:03:02', '$2y$10$9MGwf/DOsfmI7NvylsftHeQe1FdLDHq9Ij6/k22eZyLCrrZBP.HBK', 'AcGIj1uVHyFElupAQrHJ9pzv4SYHpYouYwp2OD7F3seJGT6uCah1s3Ibh3W7', 'Fl2o5lPq3moG5DwWXe3TGHgYDxvIJvJsci5iygWv8iv0KEq1j54VBi34OFW2', 'http://192.168.20.231:8002/auto-login/generate_token', '2019-11-21 06:29:48', '2024-03-05 04:23:29', NULL),
(3, 1, 'Md. Anaytur', 'Rahaman', 'male', 1, 0, 'photos/shares/avatar/md-anaytur-01-2020.png', 'anayt@isdb-bisew.org', '2019-11-21 17:03:02', '$2y$10$Vd3xQOwNCgo6Y7gPE8FPv.LM3un22g7AkwKWBvPr4zI/ENXdn/f7C', 'IimXSwD0RHJACB7G46pl1CGJzQVqlUOSVYjKmJr2x5rDZjtTTJdBKPy3v0uB', NULL, NULL, '2019-11-24 04:06:22', '2020-01-02 13:19:33', NULL),
(4, 1, 'Md. Helalur', 'Rahman', 'male', 4, 0, '', 'helal@isdb-bisew.org', '2020-02-16 03:18:12', '$2y$10$utDfcRIPVQ20T3XxR.heCOb2K2KxdBqqfDs4fB7tbuytOtHOViSxK', NULL, NULL, NULL, '2020-02-16 03:17:32', '2020-08-25 09:32:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_id` int NOT NULL,
  `role_id` int NOT NULL,
  `is_permission` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(39, 1, 2, 1, 1, '2019-08-28 17:29:56', '2019-08-28 17:29:56'),
(40, 20, 2, 1, 1, '2019-08-28 17:29:56', '2019-08-28 17:29:56'),
(41, 22, 2, 1, 1, '2019-08-28 17:29:56', '2019-08-28 17:29:56'),
(42, 24, 2, 1, 1, '2019-08-28 17:29:57', '2019-08-28 17:29:57'),
(43, 25, 2, 1, 1, '2019-08-28 17:29:57', '2019-08-28 17:29:57'),
(44, 26, 2, 1, 1, '2019-08-28 17:29:57', '2019-08-28 17:29:57'),
(45, 27, 2, 1, 1, '2019-08-28 17:29:57', '2019-08-28 17:29:57'),
(46, 21, 2, 1, 1, '2019-08-28 17:29:57', '2019-08-28 17:29:57'),
(47, 23, 2, 1, 1, '2019-08-28 17:29:57', '2019-08-28 17:29:57'),
(48, 12, 2, 1, 1, '2019-08-28 17:30:19', '2019-08-28 17:30:19'),
(49, 14, 2, 1, 1, '2019-08-28 17:30:19', '2019-08-28 17:30:19'),
(50, 16, 2, 1, 1, '2019-08-28 17:30:19', '2019-08-28 17:30:19'),
(51, 17, 2, 1, 1, '2019-08-28 17:30:19', '2019-08-28 17:30:19'),
(52, 18, 2, 1, 1, '2019-08-28 17:30:19', '2019-08-28 17:30:19'),
(53, 19, 2, 1, 1, '2019-08-28 17:30:19', '2019-08-28 17:30:19'),
(54, 13, 2, 1, 1, '2019-08-28 17:30:19', '2019-08-28 17:30:19'),
(55, 15, 2, 1, 1, '2019-08-28 17:30:19', '2019-08-28 17:30:19'),
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
(113, 96, 1, 1, 1, NULL, NULL),
(114, 97, 1, 1, 1, NULL, NULL),
(115, 98, 1, 1, 1, NULL, NULL),
(116, 99, 1, 1, 1, NULL, NULL),
(117, 100, 1, 1, 1, NULL, NULL),
(118, 101, 1, 1, 1, NULL, NULL),
(119, 102, 1, 1, 1, NULL, NULL),
(120, 103, 1, 1, 1, NULL, NULL),
(121, 104, 1, 1, 1, NULL, NULL),
(122, 105, 1, 1, 1, NULL, NULL),
(123, 106, 1, 1, 1, NULL, NULL),
(124, 107, 1, 1, 1, NULL, NULL),
(125, 108, 1, 1, 1, NULL, NULL),
(126, 109, 1, 1, 1, NULL, NULL),
(127, 110, 1, 1, 1, NULL, NULL),
(128, 111, 1, 1, 1, NULL, NULL),
(129, 112, 1, 1, 1, NULL, NULL),
(194, 177, 1, 1, 1, NULL, NULL),
(195, 178, 1, 1, 1, NULL, NULL),
(196, 179, 1, 1, 1, NULL, NULL),
(197, 180, 1, 1, 1, NULL, NULL),
(198, 181, 1, 1, 1, NULL, NULL),
(199, 182, 1, 1, 1, NULL, NULL),
(200, 183, 1, 1, 1, NULL, NULL),
(201, 184, 1, 1, 1, NULL, NULL),
(202, 185, 1, 1, 1, NULL, NULL),
(203, 186, 1, 1, 1, NULL, NULL),
(204, 187, 1, 1, 1, NULL, NULL),
(205, 188, 1, 1, 1, NULL, NULL),
(206, 189, 1, 1, 1, NULL, NULL),
(207, 190, 1, 1, 1, NULL, NULL),
(208, 191, 1, 1, 1, NULL, NULL),
(209, 192, 1, 1, 1, NULL, NULL),
(210, 193, 1, 1, 1, NULL, NULL),
(211, 194, 1, 1, 1, NULL, NULL),
(212, 195, 1, 1, 1, NULL, NULL),
(213, 196, 1, 1, 1, NULL, NULL),
(214, 197, 1, 1, 1, NULL, NULL),
(215, 198, 1, 1, 1, NULL, NULL),
(216, 199, 1, 1, 1, NULL, NULL),
(217, 200, 1, 1, 1, NULL, NULL),
(218, 201, 1, 1, 1, NULL, NULL),
(219, 202, 1, 1, 1, NULL, NULL),
(220, 203, 1, 1, 1, NULL, NULL),
(221, 204, 1, 1, 1, NULL, NULL),
(222, 205, 1, 1, 1, NULL, NULL),
(223, 206, 1, 1, 1, NULL, NULL),
(224, 207, 1, 1, 1, NULL, NULL),
(225, 208, 1, 1, 1, NULL, NULL),
(226, 209, 1, 1, 1, NULL, NULL),
(227, 210, 1, 1, 1, NULL, NULL),
(228, 211, 1, 1, 1, NULL, NULL),
(229, 212, 1, 1, 1, NULL, NULL),
(230, 213, 1, 1, 1, NULL, NULL),
(231, 214, 1, 1, 1, NULL, NULL),
(232, 215, 1, 1, 1, NULL, NULL),
(233, 216, 1, 1, 1, NULL, NULL),
(234, 217, 1, 1, 1, NULL, NULL),
(235, 218, 1, 1, 1, NULL, NULL),
(236, 219, 1, 1, 1, NULL, NULL),
(237, 220, 1, 1, 1, NULL, NULL),
(238, 221, 1, 1, 1, NULL, NULL),
(239, 222, 1, 1, 1, NULL, NULL),
(240, 223, 1, 1, 1, NULL, NULL),
(241, 224, 1, 1, 1, NULL, NULL),
(242, 225, 1, 1, 1, NULL, NULL),
(243, 226, 1, 1, 1, NULL, NULL),
(244, 227, 1, 1, 1, NULL, NULL),
(245, 228, 1, 1, 1, NULL, NULL),
(246, 229, 1, 1, 1, NULL, NULL),
(247, 230, 1, 1, 1, NULL, NULL),
(248, 231, 1, 1, 1, NULL, NULL),
(249, 232, 1, 1, 1, NULL, NULL),
(250, 233, 1, 1, 1, NULL, NULL),
(251, 234, 1, 1, 1, NULL, NULL),
(252, 235, 1, 1, 1, NULL, NULL),
(253, 236, 1, 1, 1, NULL, NULL),
(254, 237, 1, 1, 1, NULL, NULL),
(255, 238, 1, 1, 1, NULL, NULL),
(260, 183, 2, 1, 1, '2019-10-30 07:07:33', '2019-10-30 07:07:33'),
(261, 185, 2, 1, 1, '2019-10-30 07:07:33', '2019-10-30 07:07:33'),
(269, 182, 2, 1, 1, '2019-10-30 07:07:34', '2019-10-30 07:07:34'),
(270, 184, 2, 1, 1, '2019-10-30 07:07:34', '2019-10-30 07:07:34'),
(272, 97, 2, 1, 1, '2019-10-30 07:07:34', '2019-10-30 07:07:34'),
(273, 188, 2, 1, 1, '2019-10-30 07:07:34', '2019-10-30 07:07:34'),
(274, 198, 2, 1, 1, '2019-10-30 07:07:34', '2019-10-30 07:07:34'),
(275, 94, 2, 1, 1, '2019-10-30 07:07:34', '2019-10-30 07:07:34'),
(276, 46, 2, 1, 1, '2019-10-30 07:07:34', '2019-10-30 07:07:34'),
(333, 177, 2, 1, 1, '2019-10-30 07:11:49', '2019-10-30 07:11:49'),
(334, 178, 2, 1, 1, '2019-10-30 07:11:49', '2019-10-30 07:11:49'),
(335, 179, 2, 1, 1, '2019-10-30 07:11:49', '2019-10-30 07:11:49'),
(336, 180, 2, 1, 1, '2019-10-30 07:11:49', '2019-10-30 07:11:49'),
(337, 181, 2, 1, 1, '2019-10-30 07:11:49', '2019-10-30 07:11:49'),
(338, 186, 2, 1, 1, '2019-10-30 07:11:49', '2019-10-30 07:11:49'),
(339, 187, 2, 1, 1, '2019-10-30 07:11:49', '2019-10-30 07:11:49'),
(340, 98, 2, 1, 1, '2019-10-30 07:12:02', '2019-10-30 07:12:02'),
(341, 99, 2, 1, 1, '2019-10-30 07:12:02', '2019-10-30 07:12:02'),
(342, 100, 2, 1, 1, '2019-10-30 07:12:02', '2019-10-30 07:12:02'),
(343, 101, 2, 1, 1, '2019-10-30 07:12:02', '2019-10-30 07:12:02'),
(344, 102, 2, 1, 1, '2019-10-30 07:12:02', '2019-10-30 07:12:02'),
(345, 103, 2, 1, 1, '2019-10-30 07:12:02', '2019-10-30 07:12:02'),
(346, 104, 2, 1, 1, '2019-10-30 07:12:02', '2019-10-30 07:12:02'),
(347, 189, 2, 1, 1, '2019-10-30 07:12:28', '2019-10-30 07:12:28'),
(348, 190, 2, 1, 1, '2019-10-30 07:12:28', '2019-10-30 07:12:28'),
(349, 191, 2, 1, 1, '2019-10-30 07:12:28', '2019-10-30 07:12:28'),
(350, 192, 2, 1, 1, '2019-10-30 07:12:28', '2019-10-30 07:12:28'),
(351, 193, 2, 1, 1, '2019-10-30 07:12:28', '2019-10-30 07:12:28'),
(352, 194, 2, 1, 1, '2019-10-30 07:12:28', '2019-10-30 07:12:28'),
(353, 195, 2, 1, 1, '2019-10-30 07:12:28', '2019-10-30 07:12:28'),
(354, 196, 2, 1, 1, '2019-10-30 07:12:28', '2019-10-30 07:12:28'),
(355, 197, 2, 1, 1, '2019-10-30 07:12:28', '2019-10-30 07:12:28'),
(356, 231, 2, 1, 1, '2019-10-30 07:12:54', '2019-10-30 07:12:54'),
(357, 215, 2, 1, 1, '2019-10-30 07:12:54', '2019-10-30 07:12:54'),
(358, 207, 2, 1, 1, '2019-10-30 07:12:54', '2019-10-30 07:12:54'),
(359, 199, 2, 1, 1, '2019-10-30 07:12:54', '2019-10-30 07:12:54'),
(360, 223, 2, 1, 1, '2019-10-30 07:12:54', '2019-10-30 07:12:54'),
(361, 232, 2, 1, 1, '2019-10-30 07:13:15', '2019-10-30 07:13:15'),
(362, 233, 2, 1, 1, '2019-10-30 07:13:15', '2019-10-30 07:13:15'),
(363, 234, 2, 1, 1, '2019-10-30 07:13:15', '2019-10-30 07:13:15'),
(364, 235, 2, 1, 1, '2019-10-30 07:13:15', '2019-10-30 07:13:15'),
(365, 236, 2, 1, 1, '2019-10-30 07:13:15', '2019-10-30 07:13:15'),
(366, 237, 2, 1, 1, '2019-10-30 07:13:15', '2019-10-30 07:13:15'),
(367, 238, 2, 1, 1, '2019-10-30 07:13:15', '2019-10-30 07:13:15'),
(368, 216, 2, 1, 1, '2019-10-30 07:13:28', '2019-10-30 07:13:28'),
(369, 217, 2, 1, 1, '2019-10-30 07:13:28', '2019-10-30 07:13:28'),
(370, 218, 2, 1, 1, '2019-10-30 07:13:28', '2019-10-30 07:13:28'),
(371, 219, 2, 1, 1, '2019-10-30 07:13:28', '2019-10-30 07:13:28'),
(372, 220, 2, 1, 1, '2019-10-30 07:13:28', '2019-10-30 07:13:28'),
(373, 221, 2, 1, 1, '2019-10-30 07:13:29', '2019-10-30 07:13:29'),
(374, 222, 2, 1, 1, '2019-10-30 07:13:29', '2019-10-30 07:13:29'),
(375, 208, 2, 1, 1, '2019-10-30 07:13:46', '2019-10-30 07:13:46'),
(376, 209, 2, 1, 1, '2019-10-30 07:13:46', '2019-10-30 07:13:46'),
(377, 210, 2, 1, 1, '2019-10-30 07:13:46', '2019-10-30 07:13:46'),
(378, 211, 2, 1, 1, '2019-10-30 07:13:46', '2019-10-30 07:13:46'),
(379, 212, 2, 1, 1, '2019-10-30 07:13:46', '2019-10-30 07:13:46'),
(380, 213, 2, 1, 1, '2019-10-30 07:13:46', '2019-10-30 07:13:46'),
(381, 214, 2, 1, 1, '2019-10-30 07:13:46', '2019-10-30 07:13:46'),
(382, 200, 2, 1, 1, '2019-10-30 07:35:58', '2019-10-30 07:35:58'),
(383, 201, 2, 1, 1, '2019-10-30 07:35:58', '2019-10-30 07:35:58'),
(384, 202, 2, 1, 1, '2019-10-30 07:35:58', '2019-10-30 07:35:58'),
(385, 203, 2, 1, 1, '2019-10-30 07:35:58', '2019-10-30 07:35:58'),
(386, 204, 2, 1, 1, '2019-10-30 07:35:58', '2019-10-30 07:35:58'),
(387, 205, 2, 1, 1, '2019-10-30 07:35:58', '2019-10-30 07:35:58'),
(388, 206, 2, 1, 1, '2019-10-30 07:35:58', '2019-10-30 07:35:58'),
(389, 225, 2, 1, 1, '2019-10-30 07:36:13', '2019-10-30 07:36:13'),
(390, 227, 2, 1, 1, '2019-10-30 07:36:13', '2019-10-30 07:36:13'),
(391, 228, 2, 1, 1, '2019-10-30 07:36:13', '2019-10-30 07:36:13'),
(392, 229, 2, 1, 1, '2019-10-30 07:36:13', '2019-10-30 07:36:13'),
(393, 230, 2, 1, 1, '2019-10-30 07:36:14', '2019-10-30 07:36:14'),
(394, 224, 2, 1, 1, '2019-10-30 07:36:14', '2019-10-30 07:36:14'),
(395, 226, 2, 1, 1, '2019-10-30 07:36:14', '2019-10-30 07:36:14'),
(396, 95, 2, 1, 1, '2019-10-30 07:36:44', '2019-10-30 07:36:44'),
(397, 96, 2, 1, 1, '2019-10-30 07:36:44', '2019-10-30 07:36:44'),
(398, 68, 2, 1, 1, '2019-10-30 07:37:12', '2019-10-30 07:37:12'),
(399, 77, 2, 1, 1, '2019-10-30 07:37:12', '2019-10-30 07:37:12'),
(400, 60, 2, 0, 1, '2019-10-30 07:37:12', '2019-10-30 07:37:12'),
(401, 47, 2, 0, 1, '2019-10-30 07:37:12', '2019-10-30 07:37:12'),
(402, 55, 2, 1, 1, '2019-10-30 07:37:12', '2019-10-30 07:37:12'),
(403, 70, 2, 1, 1, '2019-10-30 07:37:12', '2019-10-30 07:37:12'),
(404, 72, 2, 1, 1, '2019-10-30 07:37:12', '2019-10-30 07:37:12'),
(405, 73, 2, 1, 1, '2019-10-30 07:37:13', '2019-10-30 07:37:13'),
(406, 74, 2, 1, 1, '2019-10-30 07:37:13', '2019-10-30 07:37:13'),
(407, 75, 2, 1, 1, '2019-10-30 07:37:13', '2019-10-30 07:37:13'),
(408, 76, 2, 1, 1, '2019-10-30 07:37:13', '2019-10-30 07:37:13'),
(409, 69, 2, 1, 1, '2019-10-30 07:37:13', '2019-10-30 07:37:13'),
(410, 71, 2, 1, 1, '2019-10-30 07:37:13', '2019-10-30 07:37:13'),
(411, 78, 2, 1, 1, '2019-10-30 07:37:31', '2019-10-30 07:37:31'),
(412, 79, 2, 1, 1, '2019-10-30 07:37:31', '2019-10-30 07:37:31'),
(413, 80, 2, 1, 1, '2019-10-30 07:37:31', '2019-10-30 07:37:31'),
(414, 81, 2, 1, 1, '2019-10-30 07:37:31', '2019-10-30 07:37:31'),
(415, 82, 2, 1, 1, '2019-10-30 07:37:31', '2019-10-30 07:37:31'),
(416, 83, 2, 1, 1, '2019-10-30 07:37:31', '2019-10-30 07:37:31'),
(417, 84, 2, 1, 1, '2019-10-30 07:37:31', '2019-10-30 07:37:31'),
(418, 62, 2, 0, 1, '2019-10-30 07:37:53', '2019-10-30 07:37:53'),
(419, 64, 2, 0, 1, '2019-10-30 07:37:53', '2019-10-30 07:37:53'),
(420, 65, 2, 0, 1, '2019-10-30 07:37:53', '2019-10-30 07:37:53'),
(421, 66, 2, 0, 1, '2019-10-30 07:37:53', '2019-10-30 07:37:53'),
(422, 67, 2, 0, 1, '2019-10-30 07:37:53', '2019-10-30 07:37:53'),
(423, 105, 2, 0, 1, '2019-10-30 07:37:53', '2019-10-30 07:37:53'),
(424, 61, 2, 0, 1, '2019-10-30 07:37:53', '2019-10-30 07:37:53'),
(425, 63, 2, 0, 1, '2019-10-30 07:37:53', '2019-10-30 07:37:53'),
(426, 57, 2, 1, 1, '2019-10-30 07:38:44', '2019-10-30 07:38:44'),
(427, 59, 2, 1, 1, '2019-10-30 07:38:45', '2019-10-30 07:38:45'),
(428, 56, 2, 1, 1, '2019-10-30 07:38:45', '2019-10-30 07:38:45'),
(429, 58, 2, 1, 1, '2019-10-30 07:38:45', '2019-10-30 07:38:45'),
(430, 28, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(431, 30, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(432, 32, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(433, 33, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(434, 34, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(435, 35, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(436, 36, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(437, 37, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(438, 38, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(439, 29, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(440, 31, 2, 1, 1, '2019-10-30 07:39:12', '2019-10-30 07:39:12'),
(441, 239, 1, 1, 1, NULL, NULL),
(442, 239, 2, 1, 1, '2020-01-02 09:04:51', '2020-01-02 09:04:51'),
(443, 240, 1, 1, 1, NULL, NULL),
(444, 241, 1, 1, 1, NULL, NULL),
(445, 242, 1, 1, 1, NULL, NULL),
(446, 243, 1, 1, 1, NULL, NULL),
(447, 244, 1, 1, 1, NULL, NULL),
(448, 245, 1, 1, 1, NULL, NULL),
(449, 246, 1, 1, 1, NULL, NULL),
(450, 247, 1, 1, 1, NULL, NULL),
(451, 248, 1, 1, 1, NULL, NULL),
(452, 249, 1, 1, 1, NULL, NULL),
(453, 250, 1, 1, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(454, 251, 1, 1, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(455, 252, 1, 1, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(456, 253, 1, 1, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(457, 254, 1, 1, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(458, 255, 1, 1, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(459, 256, 1, 1, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(460, 257, 1, 1, 1, '2020-02-09 11:07:53', '2020-02-09 11:07:53'),
(461, 250, 3, 1, 1, '2020-02-09 11:10:54', '2020-02-09 11:10:54'),
(462, 257, 3, 1, 1, '2020-02-09 11:10:54', '2020-02-09 11:10:54'),
(463, 251, 3, 1, 1, '2020-02-09 11:10:54', '2020-02-09 11:10:54'),
(464, 252, 3, 1, 1, '2020-02-09 11:10:54', '2020-02-09 11:10:54'),
(465, 253, 3, 1, 1, '2020-02-09 11:10:54', '2020-02-09 11:10:54'),
(466, 254, 3, 1, 1, '2020-02-09 11:10:54', '2020-02-09 11:10:54'),
(467, 255, 3, 1, 1, '2020-02-09 11:10:54', '2020-02-09 11:10:54'),
(468, 258, 1, 1, 1, '2020-02-10 11:15:20', '2020-02-10 11:15:20'),
(469, 250, 5, 1, 1, '2020-02-11 09:57:07', '2020-02-11 09:57:07'),
(470, 251, 5, 1, 1, '2020-02-11 09:57:09', '2020-02-11 09:57:09'),
(471, 252, 5, 1, 1, '2020-02-11 09:57:11', '2020-02-11 09:57:11'),
(472, 253, 5, 1, 1, '2020-02-11 09:57:11', '2020-02-11 09:57:11'),
(473, 255, 5, 1, 1, '2020-02-11 09:57:13', '2020-02-11 09:57:13'),
(474, 257, 5, 1, 1, '2020-02-11 09:57:17', '2020-02-11 09:57:17'),
(475, 258, 5, 1, 1, '2020-02-11 09:57:22', '2020-02-11 09:57:22'),
(476, 254, 5, 1, 1, '2020-02-11 09:57:26', '2020-02-11 09:57:26'),
(477, 259, 1, 1, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(478, 260, 1, 1, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(479, 261, 1, 1, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(480, 262, 1, 1, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(481, 263, 1, 1, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(482, 264, 1, 1, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(483, 265, 1, 1, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(484, 266, 1, 1, 1, '2020-02-20 10:31:31', '2020-02-20 10:31:31'),
(485, 267, 1, 1, 1, '2020-03-15 10:29:18', '2020-03-15 10:29:18'),
(486, 268, 1, 1, 1, '2020-03-15 10:31:21', '2020-03-15 10:31:21'),
(487, 269, 1, 1, 1, '2020-03-15 10:32:00', '2020-03-15 10:32:00'),
(488, 270, 1, 1, 1, '2020-03-15 10:32:42', '2020-03-15 10:32:42'),
(489, 271, 1, 1, 1, '2020-03-15 10:34:48', '2020-03-15 10:34:48'),
(490, 272, 1, 1, 1, '2020-03-15 10:35:15', '2020-03-15 10:35:15'),
(491, 273, 1, 1, 1, '2020-03-15 10:37:15', '2020-03-15 10:37:15'),
(492, 274, 1, 1, 1, '2020-03-15 10:37:54', '2020-03-15 10:37:54'),
(493, 275, 1, 1, 1, '2020-03-15 10:38:38', '2020-03-15 10:38:38'),
(494, 276, 1, 1, 1, '2020-03-15 11:01:13', '2020-03-15 11:01:13'),
(495, 267, 2, 1, 1, '2020-03-15 11:08:51', '2020-03-15 11:08:51'),
(496, 268, 2, 1, 1, '2020-03-15 11:08:54', '2020-03-15 11:08:54'),
(497, 269, 2, 1, 1, '2020-03-15 11:08:55', '2020-03-15 11:08:55'),
(498, 270, 2, 1, 1, '2020-03-15 11:08:56', '2020-03-15 11:08:56'),
(499, 271, 2, 1, 1, '2020-03-15 11:08:57', '2020-03-15 11:08:57'),
(500, 272, 2, 1, 1, '2020-03-15 11:08:58', '2020-03-15 11:08:58'),
(501, 273, 2, 1, 1, '2020-03-15 11:08:59', '2020-03-15 11:08:59'),
(502, 274, 2, 1, 1, '2020-03-15 11:09:00', '2020-03-15 11:09:00'),
(503, 275, 2, 1, 1, '2020-03-15 11:09:00', '2020-03-15 11:09:00'),
(504, 276, 2, 1, 1, '2020-03-15 11:09:01', '2020-03-15 11:09:01'),
(506, 260, 4, 1, 1, '2020-08-25 09:35:48', '2020-08-25 09:35:48'),
(507, 264, 4, 1, 1, '2020-08-25 09:35:50', '2020-08-25 09:35:50'),
(508, 259, 4, 1, 1, '2020-08-25 09:37:24', '2020-08-25 09:37:24'),
(511, 250, 4, 1, 1, '2020-08-25 09:41:52', '2020-08-25 09:41:52'),
(512, 251, 4, 1, 1, '2020-08-25 09:42:01', '2020-08-25 09:42:01'),
(513, 253, 4, 1, 1, '2020-08-25 09:42:03', '2020-08-25 09:42:03'),
(514, 261, 4, 0, 1, '2020-08-25 09:43:19', '2020-08-25 09:45:15'),
(515, 263, 4, 0, 1, '2020-08-25 09:43:21', '2020-08-25 09:45:16'),
(516, 265, 4, 0, 1, '2020-08-25 09:43:22', '2020-08-25 09:45:17'),
(517, 266, 4, 0, 1, '2020-08-25 09:43:23', '2020-08-25 09:45:19'),
(549, 308, 1, 1, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(548, 307, 1, 1, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(547, 306, 1, 1, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(546, 305, 1, 1, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(545, 304, 1, 1, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(544, 303, 1, 1, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(543, 302, 1, 1, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05'),
(542, 301, 1, 1, 2, '2024-08-08 10:47:05', '2024-08-08 10:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `vtp_auto_notices`
--

CREATE TABLE `vtp_auto_notices` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `notice_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notice_slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notice_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notice_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vtp_auto_notices`
--

INSERT INTO `vtp_auto_notices` (`id`, `active`, `notice_title`, `notice_slug`, `notice_details`, `notice_type`, `user_id`, `updated_by`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Intake Notice: IsDB-BISEW Vocational Training Programme, Round-[round]', 'intake-notice-isdb-bisew-vocational-training-programme-round-round', '<p>আবেদনের শেষ তারিখ: [lastdate]</p>\r\n<p><a class=\"btn btn-block btn-main\" title=\"Apply now\" href=\"../../../apply\" target=\"_blank\" rel=\"noopener\">Apply now</a></p>', 'circular', 1, 1, 0, '2020-01-26 06:57:19', '2020-01-27 05:33:38'),
(2, 1, 'নির্বাচিত প্রার্থী তালিকা ও সূচী (রাউন্ড  - [round])', 'round', '<p style=\"text-align: center;\">মৌখিক পরীক্ষা শুরুর কমপক্ষে ৩০ মিনিট পূর্বে পরীক্ষার্থীকে উপস্থিত হতে হবে।</p>\r\n<p style=\"text-align: center;\">এস এস সি পাস প্রার্থীদের অবশ্যই পরীক্ষার মূল সনদপত্র সাথে আনতে হবে।</p>\r\n<p style=\"text-align: center;\">অষ্টম শ্রেণী পাস পরীক্ষার্থীদের অবশ্যই কর্তূপক্ষ প্রদত্ত সনদপত্র ও পরীক্ষার নম্বরপত্র সাথে আনতে হবে।</p>\r\n<p style=\"text-align: center;\"><strong>মৌখিক পরীক্ষার স্থানঃ</strong></p>\r\n<p style=\"text-align: center;\">আই ডি বি ভবন(৪র্থ তলা), ই/৮-এ রোকেয়া সরণী, শেরেবাংলা নগর, ঢাকা।</p>\r\n<p style=\"text-align: center;\">[exam_date]</p>\r\n<p>[result]</p>', 'primary-result', 1, 1, 0, '2020-01-26 07:39:16', '2020-03-15 10:20:52'),
(3, 1, 'Finally Selected Candidate list of Vocational Training Programme, Round-[round]', 'finally-selected-candidate-list-of-vocational-training-programme-round-round', '<p><span style=\"color: #333333; font-family: Source Sans Pro, Helvetica Neue, Helvetica, Arial, sans-serif;\">Finally </span><span style=\"color: #333333; font-family: \'Source Sans Pro\', \'Helvetica Neue\', Helvetica, Arial, sans-serif; background-color: #f9f9f9;\">Selected Candidate list of Vocational Training Programme, Round-[round]</span></p>', 'final-result', 1, 1, 0, '2020-01-26 07:39:40', '2020-01-27 06:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `vtp_notice_tracker`
--

CREATE TABLE `vtp_notice_tracker` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `post_id` int NOT NULL,
  `vtp_round` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notice_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vtp_notice_tracker`
--

INSERT INTO `vtp_notice_tracker` (`id`, `active`, `post_id`, `vtp_round`, `notice_type`, `created_at`, `updated_at`) VALUES
(2, 1, 117, '24', 'primary-result', '2020-03-15 18:00:03', '2020-03-15 18:00:03'),
(3, 1, 139, '25', 'primary-result', '2020-11-30 08:40:00', '2020-11-30 08:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `widget_groups`
--

CREATE TABLE `widget_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_menus`
--
ALTER TABLE `front_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `front_menus_action_index` (`url`(191));

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
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
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
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_post_slug_unique` (`note_slug`),
  ADD KEY `posts_post_status_post_type_index` (`note_status`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tender_notice_points`
--
ALTER TABLE `tender_notice_points`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_permissions_menu_id_index` (`menu_id`),
  ADD KEY `user_permissions_role_id_index` (`role_id`);

--
-- Indexes for table `vtp_auto_notices`
--
ALTER TABLE `vtp_auto_notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vtp_notice_tracker`
--
ALTER TABLE `vtp_notice_tracker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `widgets_slug_unique` (`slug`);

--
-- Indexes for table `widget_groups`
--
ALTER TABLE `widget_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `widget_groups_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertisement_relations`
--
ALTER TABLE `advertisement_relations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_study_relations`
--
ALTER TABLE `case_study_relations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_menus`
--
ALTER TABLE `front_menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_relation`
--
ALTER TABLE `gallery_relation`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_groups`
--
ALTER TABLE `menu_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=430;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rounds`
--
ALTER TABLE `rounds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxonomies`
--
ALTER TABLE `taxonomies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tender_notice_points`
--
ALTER TABLE `tender_notice_points`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `term_relations`
--
ALTER TABLE `term_relations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `term_taxonomies`
--
ALTER TABLE `term_taxonomies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=550;

--
-- AUTO_INCREMENT for table `vtp_auto_notices`
--
ALTER TABLE `vtp_auto_notices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vtp_notice_tracker`
--
ALTER TABLE `vtp_notice_tracker`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `widget_groups`
--
ALTER TABLE `widget_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
