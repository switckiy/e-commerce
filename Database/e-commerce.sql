-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 10:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--
CREATE DATABASE IF NOT EXISTS `ecommerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecommerce`;

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `images`, `title`, `deskripsi`) VALUES
(1, '1686685740_c968fe2973c6e97d63a6.png', 'tes1', 'TES1');

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Site Administrator'),
(2, 'user', 'Regular User'),
(4, 'member', 'Membership');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 17:32:03', 1),
(2, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 17:34:01', 1),
(3, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 17:47:44', 1),
(4, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 17:49:30', 1),
(5, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 17:54:50', 1),
(6, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 17:54:59', 1),
(7, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 17:55:23', 1),
(8, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 17:55:50', 1),
(9, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 18:04:32', 1),
(10, '::1', 'Oppths', NULL, '2023-05-27 18:09:43', 0),
(11, '::1', 'tes', NULL, '2023-05-27 18:10:10', 0),
(12, '::1', 'tes', NULL, '2023-05-27 18:10:18', 0),
(13, '::1', 'nagasaya221@gmail.com', 6, '2023-05-27 18:11:15', 1),
(14, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 18:15:05', 1),
(15, '::1', 'nagasaya221@gmail.com', 6, '2023-05-27 18:15:16', 1),
(16, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 18:18:02', 1),
(17, '::1', 'nagasaya221@gmail.com', 6, '2023-05-27 18:18:34', 1),
(18, '::1', 'nagasaya221@gmail.com', 6, '2023-05-27 18:20:38', 1),
(19, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 18:26:01', 1),
(20, '::1', 'nagasaya221@gmail.com', 6, '2023-05-27 18:26:10', 1),
(21, '::1', 'ezarr699@gmail.com', 1, '2023-05-27 18:28:06', 1),
(22, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 13:42:01', 1),
(23, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 14:19:19', 1),
(24, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 14:21:59', 1),
(25, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:00:12', 1),
(26, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:03:25', 1),
(27, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:09:14', 1),
(28, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:13:07', 1),
(29, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:17:33', 1),
(30, '::1', 'admin', NULL, '2023-05-28 15:37:40', 0),
(31, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:37:46', 1),
(32, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:44:53', 1),
(33, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:46:20', 1),
(34, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:47:47', 1),
(35, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:48:09', 1),
(36, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:49:29', 1),
(37, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:49:43', 1),
(38, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:50:40', 1),
(39, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:53:27', 1),
(40, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:58:02', 1),
(41, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 15:58:47', 1),
(42, '::1', 'admin', NULL, '2023-05-28 16:00:04', 0),
(43, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:00:09', 1),
(44, '::1', 'nagasaya221@gmail.com', 6, '2023-05-28 16:04:34', 1),
(45, '::1', 'nagasaya221@gmail.com', 6, '2023-05-28 16:05:08', 1),
(46, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:05:35', 1),
(47, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:05:55', 1),
(48, '::1', 'nagasaya221@gmail.com', 6, '2023-05-28 16:06:05', 1),
(49, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:06:46', 1),
(50, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:06:57', 1),
(51, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:08:16', 1),
(52, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:10:40', 1),
(53, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:12:46', 1),
(54, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:22:45', 1),
(55, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:23:35', 1),
(56, '::1', 'nagasaya221@gmail.com', 6, '2023-05-28 16:24:10', 1),
(57, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:24:52', 1),
(58, '::1', 'ezarr699@gmail.com', 1, '2023-05-28 16:25:25', 1),
(59, '::1', 'admin', NULL, '2023-06-01 15:31:30', 0),
(60, '::1', 'ezarr699@gmail.com', 1, '2023-06-01 15:31:38', 1),
(61, '::1', 'ezarr699@gmail.com', 1, '2023-06-01 15:40:19', 1),
(62, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 13:25:58', 1),
(63, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:12:48', 1),
(64, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:14:24', 1),
(65, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:16:45', 1),
(66, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:18:02', 1),
(67, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:18:44', 1),
(68, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:20:08', 1),
(69, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:20:43', 1),
(70, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:22:02', 1),
(71, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:22:48', 1),
(72, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:28:44', 1),
(73, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:37:13', 1),
(74, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:41:23', 1),
(75, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:46:02', 1),
(76, '::1', 'ezarr699@gmail.com', 1, '2023-06-03 16:46:25', 1),
(77, '::1', 'ezarr699@gmail.com', 1, '2023-06-04 15:59:48', 1),
(78, '::1', 'ezarr699@gmail.com', 1, '2023-06-05 12:20:07', 1),
(79, '::1', 'ezarr699@gmail.com', 1, '2023-06-05 12:21:36', 1),
(80, '::1', 'ezarr699@gmail.com', 1, '2023-06-05 14:57:50', 1),
(81, '::1', 'ezarr699@gmail.com', 1, '2023-06-06 01:51:42', 1),
(82, '::1', 'ezarr699@gmail.com', 1, '2023-06-06 08:48:42', 1),
(83, '::1', 'nagasaya221@gmail.com', 6, '2023-06-07 07:56:44', 1),
(84, '::1', 'nagasaya221@gmail.com', 6, '2023-06-07 11:50:07', 1),
(85, '::1', 'nagasaya221@gmail.com', 6, '2023-06-07 17:13:29', 1),
(86, '::1', 'ezarr699@gmail.com', 1, '2023-06-07 17:21:57', 1),
(87, '::1', 'nagasaya221@gmail.com', 6, '2023-06-07 17:26:24', 1),
(88, '::1', 'nagasaya221@gmail.com', 6, '2023-06-08 13:45:07', 1),
(89, '::1', 'nagasaya221@gmail.com', 6, '2023-06-08 13:54:41', 1),
(90, '::1', 'nagasaya221@gmail.com', 6, '2023-06-09 09:42:18', 1),
(91, '::1', 'ezarr699@gmail.com', 1, '2023-06-09 10:55:29', 1),
(92, '::1', 'nagasaya221@gmail.com', 6, '2023-06-09 11:36:13', 1),
(93, '::1', 'ezarr699@gmail.com', 1, '2023-06-09 12:20:20', 1),
(94, '::1', 'nagasaya221@gmail.com', 6, '2023-06-11 10:20:38', 1),
(95, '::1', 'nagasaya221@gmail.com', 6, '2023-06-11 15:26:42', 1),
(96, '::1', 'ezarr699@gmail.com', 1, '2023-06-12 08:46:36', 1),
(97, '::1', 'ezarr699@gmail.com', 1, '2023-06-12 09:09:01', 1),
(98, '::1', 'nagasaya221@gmail.com', 6, '2023-06-12 09:09:23', 1),
(99, '::1', 'ezarr699@gmail.com', 1, '2023-06-12 09:25:39', 1),
(100, '::1', 'nagasaya221@gmail.com', 6, '2023-06-12 18:12:32', 1),
(101, '::1', 'ezarr699@gmail.com', 1, '2023-06-12 18:39:48', 1),
(102, '::1', 'nagasaya221@gmail.com', 6, '2023-06-12 18:58:51', 1),
(103, '::1', 'ezarr699@gmail.com', 1, '2023-06-12 18:59:06', 1),
(104, '::1', 'ezarr699@gmail.com', 1, '2023-06-13 17:49:47', 1),
(105, '::1', 'nagasaya221@gmail.com', 6, '2023-06-13 18:14:19', 1),
(106, '::1', 'ezarr699@gmail.com', 1, '2023-06-13 18:27:37', 1),
(107, '::1', 'nagasaya221@gmail.com', 6, '2023-06-13 19:56:03', 1),
(108, '::1', 'ezarr699@gmail.com', 1, '2023-06-15 08:40:33', 1),
(109, '::1', 'nagasaya221@gmail.com', 6, '2023-06-15 08:43:15', 1),
(110, '::1', 'ezarr699@gmail.com', 1, '2023-06-15 08:49:37', 1),
(111, '::1', 'nagasaya221@gmail.com', 6, '2023-06-15 08:52:30', 1),
(112, '::1', 'ezarr699@gmail.com', 1, '2023-06-15 09:08:43', 1),
(113, '::1', 'devarahmat57@smk.belajar.id', 7, '2023-06-15 09:10:25', 1),
(114, '::1', 'ezarr699@gmail.com', 1, '2023-06-15 09:17:29', 1),
(115, '::1', 'ezarr699@gmail.com', 1, '2023-06-15 09:22:48', 1),
(116, '::1', 'ezarr699@gmail.com', 1, '2023-06-15 16:11:32', 1),
(117, '::1', 'nagasaya221@gmail.com', 6, '2023-06-16 07:58:59', 1),
(118, '::1', 'nagasaya221@gmail.com', 6, '2023-06-16 08:44:56', 1),
(119, '::1', 'ezarr699@gmail.com', 1, '2023-06-16 09:09:40', 1),
(120, '::1', 'ezarr699@gmail.com', 1, '2023-06-17 15:53:27', 1),
(121, '::1', 'ezarr699@gmail.com', 1, '2023-06-17 17:58:14', 1),
(122, '::1', 'ezarr699@gmail.com', 1, '2023-06-22 15:23:22', 1),
(123, '::1', 'ezarr699@gmail.com', 1, '2023-06-24 02:47:52', 1),
(124, '::1', 'devarahmat57@smk.belajar.id', 7, '2023-06-24 03:45:09', 1),
(125, '::1', 'tes', NULL, '2023-06-24 03:46:25', 0),
(126, '::1', 'tes', NULL, '2023-06-24 03:46:35', 0),
(127, '::1', 'nagasaya221@gmail.com', 6, '2023-06-24 03:46:55', 1),
(128, '::1', 'ezarr699@gmail.com', 1, '2023-06-24 03:56:03', 1),
(129, '::1', 'ezarr699@gmail.com', 1, '2023-06-24 04:07:35', 1),
(130, '::1', 'devarahmat57@smk.belajar.id', 7, '2023-06-24 04:45:42', 1),
(131, '::1', 'ezarr699@gmail.com', 1, '2023-06-24 05:00:24', 1),
(132, '::1', 'devarahmat57@smk.belajar.id', 7, '2023-06-24 07:15:49', 1),
(133, '::1', 'devarahmat57@smk.belajar.id', 7, '2023-06-25 04:59:58', 1),
(134, '::1', 'ezarr699@gmail.com', 1, '2023-06-25 06:22:50', 1),
(135, '::1', 'devarahmat57@smk.belajar.id', 7, '2023-06-25 07:53:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-users', 'Manage All User'),
(2, 'manage-profile', 'Manage user\'s profile'),
(3, 'manage-Menu', 'Managemen-Menu');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chart`
--

CREATE TABLE `chart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `total` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkoout`
--

CREATE TABLE `checkoout` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `negara` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kode_pos` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `order_total` decimal(10,3) NOT NULL,
  `stats` varchar(255) NOT NULL DEFAULT 'Sedang diproses',
  `karyawan` varchar(255) NOT NULL DEFAULT '-',
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `ongkos` decimal(10,3) NOT NULL DEFAULT 1.000,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkoout`
--

INSERT INTO `checkoout` (`id`, `user_id`, `negara`, `alamat`, `kota`, `kode_pos`, `telp`, `catatan`, `order_total`, `stats`, `karyawan`, `tanggal`, `ongkos`, `name`) VALUES
(34, 2, 'jawa barat', 'tes', 'tes', 'tes', 'tes', 'tes', 99.102, 'Sedang Di Antar', 'Services', '2023-06-24 14:32:11', 1.000, 'Deva');

-- --------------------------------------------------------

--
-- Table structure for table `data_chart`
--

CREATE TABLE `data_chart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `total` decimal(10,3) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_chart`
--

INSERT INTO `data_chart` (`id`, `user_id`, `name_product`, `images`, `quantity`, `price`, `total`, `date`) VALUES
(34, 2, 'Nestlé DANCOW 3+ Madu Susu Anak 3-5 Tahun Box 1Kg', '1686017940_09dd961df0c417390188.webp', 1, 99.102, 99.102, '2023-06-24 14:32:11');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `name`) VALUES
(1, 'Services');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1685204815, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `deskripsi` text NOT NULL,
  `diskon` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `name`, `images`, `quantity`, `price`, `deskripsi`, `diskon`) VALUES
(22, 'Nestlé DANCOW 3+ Madu Susu Anak 3-5 Tahun Box 1Kg', '1686017940_09dd961df0c417390188.webp', 169, 101.602, 'DANCOW Parenting Center adalah mitra andalan para orang tua untuk tumbuh kembang si Kecil. Bunda dapat memperoleh berbagai tips dan info seputar parenting. Kini DANCOW Parenting Center mempersembahkan StimuLearn Program edukatif untuk orang tua membantu anak belajar dan bereksplorasi bersama.', 2.500),
(23, 'Nestlé NANKID 3 pHPro Plain Susu Anak 1-3 Tahun Kaleng 800g', '1686018474_858027828468db2055ce.jpg', 184, 334.500, '- Protein whey terhidrolisis parsial / sebagian (50%). Protein merupakan salah satu komponen esensial dalam pertumbuhan dan perkembangan anak, yang bermanfaat membangun dan memperbaiki jaringan tubuh. - 12 vitamin dan 9 mineral - Minyak ikan - Omega 6 / Asam linoleat - Kalsium membantu dalam pembentukan dan mempertahankan kepadatan tulang dan gigi', 2.500),
(24, 'TOLAK ANGIN madu box 12 sachet', '1686019038_15b43a08fcb9f93cebca.webp', 190, 40.500, 'Tolak angin merupakan sediaan herbal untuk mengatasi masuk angin, seperti:pusing, meriang, kembung, sakit perut, tengorokan kering, mual dan muntah, serta meningkatkan daya tahan tubuh. Tolak angin cair juga dapat diminum saat perjalanan jauh, kecapaian dan kurang tidur.', 2.500);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'default.svg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `user_image`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', 'admin', NULL, 'default.svg', '$2y$10$gcO4sibpGwHh/PchUvzVh.xtT83WBF9XnvGuGJ7Kkn13nEi9VENHm', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-27 17:30:23', '2023-05-27 17:30:23', NULL),
(6, 'user@gmail.com', 'user', NULL, 'default.svg', '$2y$10$zEQClE9Mj5yM.FXb4zIave4JseRy5IXO0RCUXBWzqab37tKjmRLzm', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-27 18:10:04', '2023-05-27 18:10:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `chart`
--
ALTER TABLE `chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkoout`
--
ALTER TABLE `checkoout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_chart`
--
ALTER TABLE `data_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chart`
--
ALTER TABLE `chart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `checkoout`
--
ALTER TABLE `checkoout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `data_chart`
--
ALTER TABLE `data_chart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
