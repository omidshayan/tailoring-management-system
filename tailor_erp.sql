-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 29, 2026 at 07:30 PM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tailor_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `branch_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone2` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `customer_id`, `branch_name`, `phone`, `phone2`, `code`, `address`, `is_active`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 1, 'شعبه اول', '', NULL, NULL, NULL, 1, 'admin', '2025-08-07 14:20:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `capital`
--

DROP TABLE IF EXISTS `capital`;
CREATE TABLE IF NOT EXISTS `capital` (
  `id` int NOT NULL AUTO_INCREMENT,
  `inventory` bigint NOT NULL,
  `debtors` bigint DEFAULT NULL,
  `creditor` bigint DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `money_balance` decimal(15,2) DEFAULT NULL,
  `money_debtor` decimal(15,2) DEFAULT NULL,
  `money_creditor` decimal(15,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `csrf_token_logs`
--

DROP TABLE IF EXISTS `csrf_token_logs`;
CREATE TABLE IF NOT EXISTS `csrf_token_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `csrf_token_logs`
--

INSERT INTO `csrf_token_logs` (`id`, `message`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'Invalid or missing CSRF token.', '::1', '2025-08-06 23:40:41', NULL),
(2, 'Invalid or missing CSRF token.', '::1', '2025-08-06 23:42:22', NULL),
(3, 'Invalid or missing CSRF token.', '::1', '2025-08-06 23:42:25', NULL),
(4, 'Invalid or missing CSRF token.', '::1', '2025-08-06 23:43:09', NULL),
(5, 'Invalid or missing CSRF token.', '::1', '2025-08-06 23:44:54', NULL),
(6, 'Invalid or missing CSRF token.', '::1', '2025-08-07 00:09:52', NULL),
(7, 'Invalid or missing CSRF token.', '::1', '2025-08-07 00:30:01', NULL),
(8, 'Invalid or missing CSRF token.', '::1', '2025-08-07 18:11:51', NULL),
(9, 'Invalid or missing CSRF token.', '::1', '2025-08-08 23:32:12', NULL),
(10, 'Invalid or missing CSRF token.', '::1', '2025-08-08 23:42:18', NULL),
(11, 'Invalid or missing CSRF token.', '::1', '2025-08-08 23:45:57', NULL),
(12, 'Invalid or missing CSRF token.', '::1', '2025-08-08 23:48:04', NULL),
(13, 'Invalid or missing CSRF token.', '::1', '2025-08-08 23:48:30', NULL),
(14, 'Invalid or missing CSRF token.', '::1', '2025-08-12 21:28:24', NULL),
(15, 'Invalid or missing CSRF token.', '::1', '2025-08-12 21:28:50', NULL),
(16, 'Invalid or missing CSRF token.', '::1', '2025-08-13 17:58:59', NULL),
(17, 'Invalid or missing CSRF token.', '::1', '2025-08-13 18:43:36', NULL),
(18, 'Invalid or missing CSRF token.', '::1', '2025-08-13 18:46:53', NULL),
(19, 'Invalid or missing CSRF token.', '::1', '2026-04-26 20:00:48', NULL),
(20, 'Invalid or missing CSRF token.', '::1', '2026-04-26 23:36:39', NULL),
(21, 'Invalid or missing CSRF token.', '::1', '2026-04-27 02:07:17', NULL),
(22, 'Invalid or missing CSRF token.', '::1', '2026-04-27 02:07:18', NULL),
(23, 'Invalid or missing CSRF token.', '::1', '2026-04-27 02:07:19', NULL),
(24, 'Invalid or missing CSRF token.', '::1', '2026-04-27 23:20:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(50) NOT NULL,
  `father_name` varchar(30) DEFAULT NULL,
  `phone` varchar(14) NOT NULL,
  `password` varchar(124) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `position` varchar(30) NOT NULL,
  `branch_id` int NOT NULL,
  `role` int DEFAULT '1',
  `verify_token` varchar(124) DEFAULT NULL,
  `forgot_token` varchar(256) DEFAULT NULL,
  `forgot_token_expire` datetime DEFAULT NULL,
  `remember_token` varchar(124) DEFAULT NULL,
  `expire_remember_token` varchar(124) DEFAULT NULL,
  `image` varchar(124) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `salary_price` int DEFAULT NULL,
  `who_it` varchar(30) NOT NULL,
  `state` tinyint NOT NULL DEFAULT '1',
  `super_admin` tinyint DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_name` (`employee_name`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `father_name`, `phone`, `password`, `email`, `address`, `position`, `branch_id`, `role`, `verify_token`, `forgot_token`, `forgot_token_expire`, `remember_token`, `expire_remember_token`, `image`, `description`, `salary_price`, `who_it`, `state`, `super_admin`, `created_at`, `updated_at`) VALUES
(48, 'for suport', NULL, '11', '$2y$10$lW.hGj4SfTrsZL.hLRC26.I6oON0TYbMHrAy1xM/jnTebFejeqx5i', 'suport@gmail.com', NULL, '', 0, 3, NULL, '0773271c9258e60f63ae8e753f7f9c17d184d2fb496d594e1279bfd843f09169', '2025-08-11 23:16:53', '8609fdaa31851cd120c9a1b58e6a84d44d5e8657f332c6c997505396f62b6da2', '3', NULL, NULL, 2000, 'ali', 1, 3, '2021-09-01 23:53:55', '2026-04-01 01:04:48'),
(98, 'test', 'f test', '0799888888', '$2y$10$B5XPEAsS4ACkERmo9hoLleIo01FNwaWUTfWWUb/C3HNDOfaNxNnZ6', NULL, NULL, '', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ali', 1, NULL, '2026-03-25 04:15:12', '2026-03-25 05:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_expenses` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `by_whom` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paid` decimal(15,2) DEFAULT NULL,
  `remainder` decimal(15,2) DEFAULT NULL,
  `who_it` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `year` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `state` tinyint DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title_expenses`, `category`, `amount`, `description`, `image`, `by_whom`, `paid`, `remainder`, `who_it`, `year`, `state`, `created_at`, `updated_at`) VALUES
(11, NULL, 'پول برق', 500.00, NULL, NULL, '48', NULL, NULL, 'for suport', NULL, 1, '2026-03-25 05:54:41', '2026-03-25 06:24:21'),
(12, NULL, 'پول برق', 3.00, NULL, NULL, '48', NULL, NULL, 'for suport', NULL, 1, '2026-03-25 05:56:12', '2026-03-25 06:24:15'),
(13, '', 'پول چاشت ', 3.00, '', NULL, NULL, NULL, NULL, 'for suport', NULL, 2, '2026-03-25 05:56:24', '2026-03-25 06:21:43'),
(14, 'dfdsf dsf dsf', 'پول برق', 33.00, 'sdfsadf sadfd', '2026-03-25-05-56-51_69c339dba4166.png', '98', NULL, NULL, 'for suport', NULL, 2, '2026-03-25 05:56:51', '2026-03-25 06:20:59'),
(15, 'for ', 'زکات', 2.00, 'ببیبی ', '2026-03-25-06-07-51_69c33c6fe2af2.jpg', '98', NULL, NULL, 'for suport', NULL, 2, '2026-03-25 06:07:51', '2026-03-25 06:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_categories`
--

DROP TABLE IF EXISTS `expenses_categories`;
CREATE TABLE IF NOT EXISTS `expenses_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `who_it` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses_categories`
--

INSERT INTO `expenses_categories` (`id`, `cat_name`, `description`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(3, 'پول برق', 'این دسته جدید است a', 'ali', 1, '2025-08-13 18:02:12', '2025-08-13 18:42:45'),
(5, 'پول چاشت ', 'چاشت', 'ali', 1, '2025-08-13 18:02:31', '2025-08-13 18:42:04'),
(6, 'زکات', '', 'for suport', 1, '2026-03-25 05:29:46', '2026-03-25 05:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `fabrics`
--

DROP TABLE IF EXISTS `fabrics`;
CREATE TABLE IF NOT EXISTS `fabrics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `buy_price` decimal(15,2) DEFAULT NULL,
  `sell_price` decimal(15,2) DEFAULT NULL,
  `supplier_id` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quality` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fabrics`
--

INSERT INTO `fabrics` (`id`, `name`, `category`, `color`, `unit`, `buy_price`, `sell_price`, `supplier_id`, `status`, `who_it`, `quality`, `description`, `created_at`, `updated_at`) VALUES
(6, 'new fabric', 'چینایی', 'blue', NULL, 30.00, 50.00, 0, 1, 'for suport', NULL, 'desc\r\n', '2026-04-27 00:22:48', NULL),
(7, 'two', 'پاکستانی', '', NULL, 50.00, 60.00, 0, 1, 'for suport', NULL, '', '2026-04-27 00:22:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fabric_stock`
--

DROP TABLE IF EXISTS `fabric_stock`;
CREATE TABLE IF NOT EXISTS `fabric_stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL,
  `fabric_id` int NOT NULL,
  `quantity` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `buy_price` decimal(15,2) DEFAULT NULL,
  `total_price` decimal(15,2) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`,`fabric_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fabric_stock`
--

INSERT INTO `fabric_stock` (`id`, `invoice_id`, `fabric_id`, `quantity`, `buy_price`, `total_price`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(25, 8, 6, '20', 30.00, 600.00, 1, '', '2026-04-27 23:36:13', NULL),
(26, 8, 7, '234', 50.00, 11700.00, 1, '', '2026-04-27 23:39:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT NULL,
  `paid_amount` decimal(15,2) DEFAULT NULL,
  `date` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` tinyint NOT NULL,
  `image` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `total_amount`, `paid_amount`, `date`, `type`, `image`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(8, NULL, 12300.00, NULL, NULL, 2, NULL, 2, NULL, '2026-04-27 23:35:59', '2026-04-27 23:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

DROP TABLE IF EXISTS `measurements`;
CREATE TABLE IF NOT EXISTS `measurements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `af_height` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `af_sholder` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `af_sleeve` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `af_ice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `af_hug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `af_skirt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `af_chatty` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `af_pants` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `af_cloth` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `af_bar_pants` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `va_height` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `va_sholder` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `va_chatty` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `va_desc` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `af_desc` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `user_id`, `af_height`, `af_sholder`, `af_sleeve`, `af_ice`, `af_hug`, `af_skirt`, `af_chatty`, `af_pants`, `af_cloth`, `af_bar_pants`, `va_height`, `va_sholder`, `va_chatty`, `va_desc`, `af_desc`, `status`, `created_at`, `updated_at`) VALUES
(1, 15, '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 1, '2026-04-25 18:08:01', NULL),
(2, 16, '3453', 'dsfd', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 1, '2026-04-25 18:08:10', NULL),
(3, 17, 'dfd', 'sdfd', 'df', 'sdfd', 'sdfsd', 'dfd', 'df', 'sdf', 'sdfsd', 'dfd', 'dsf', 'df', 'df', 'df', NULL, 1, '2026-04-25 18:09:13', NULL),
(4, 18, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2026-04-25 18:12:09', NULL),
(5, 19, '33 shkjd', 'df', '323', '43', '34534', '34534', '345', '453', '345', '453q', '33', '34', '34543', '345sldkfj saj;f  j;kdsjf df dsaf dsf d', '345345kljfgkljfskldjf sdfj sdafds fd ', 1, '2026-04-25 18:12:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
CREATE TABLE IF NOT EXISTS `models` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `fee` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `model_name`, `type`, `fee`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(4, 'خیلی جدید', 'vest', 800, 1, 'for suport', '2026-04-29 23:46:26', '2026-04-29 23:59:37'),
(5, 'جیب دار', 'afghan', 850, 1, 'for suport', '2026-04-29 23:50:27', '2026-04-29 23:57:05'),
(6, 'کت تک', 'suit', 1200, 1, 'for suport', '2026-04-29 23:50:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `ref_id` varchar(32) NOT NULL,
  `notif_type` tinyint NOT NULL DEFAULT '1' COMMENT '1->sale,buy.returns, 1->payment and recipt, 3->salaries',
  `title` varchar(64) NOT NULL,
  `msg` varchar(1024) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `read_at` date DEFAULT NULL,
  `state` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_status_created` (`user_id`,`status`,`created_at`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `not_access_logs`
--

DROP TABLE IF EXISTS `not_access_logs`;
CREATE TABLE IF NOT EXISTS `not_access_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `section_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `page_address` varchar(124) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `not_access_logs`
--

INSERT INTO `not_access_logs` (`id`, `user_id`, `section_name`, `page_address`, `ip_address`, `user_agent`, `status`, `created_at`, `updated_at`) VALUES
(1, 48, 'gen2eral', '/afghan-zar-soft/employees', NULL, NULL, 1, '2025-08-06 23:27:22', NULL),
(2, 48, 'gen2eral', '/afghan-zar-soft/employees', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-06 23:28:43', NULL),
(3, 48, 'gen2eral', '/afghan-zar-soft/employees', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-06 23:30:29', NULL),
(4, 48, 'gen2eral', '/afghan-zar-soft/employees', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-06 23:30:44', NULL),
(5, 48, 'students', '/afghan-zar-soft/positions', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-06 23:31:40', NULL),
(6, 48, 'students', '/afghan-zar-soft/employee-details/93', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-07 00:33:18', NULL),
(7, 48, 'students', '/afghan-zar-soft/edit-employee/93', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-07 00:51:40', NULL),
(8, 48, 'students', '/afghan-zar-soft/edit-employee/93', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-07 18:02:02', NULL),
(9, 48, 'students', '/afghan-zar-soft/add-expense', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-07 23:23:30', NULL),
(10, 48, 'students', '/afghan-zar-soft/profile', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:00:10', NULL),
(11, 48, 'students', '/afghan-zar-soft/forgot-request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:01:49', NULL),
(12, 48, 'students', '/afghan-zar-soft/edit-store-profile/48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:09:36', NULL),
(13, 48, 'students', '/afghan-zar-soft/edit-store-profile/48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:09:50', NULL),
(14, 48, 'students', '/afghan-zar-soft/edit-store-profile/48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:10:03', NULL),
(15, 48, 'students', '/afghan-zar-soft/edit-store-profile/48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:11:07', NULL),
(16, 48, 'students', '/afghan-zar-soft/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 16:17:14', NULL),
(17, 48, 'students', '/afghan-zar-soft/user-details/4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 16:40:27', NULL),
(18, 48, 'students', '/afghan-zar-soft/user-details/4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 16:41:00', NULL),
(19, 48, 'students', '/afghan-zar-soft/user-details/3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 16:52:00', NULL),
(20, 48, 'students', '/afghan-zar-soft/add-expense', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 17:50:04', NULL),
(21, 48, 'students', '/afghan-zar-soft/expenses_categories', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 17:58:18', NULL),
(22, 48, 'students', '/afghan-zar-soft/expense-cat-store', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 17:58:52', NULL),
(23, 48, 'students', '/afghan-zar-soft/expense-cat-store', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 17:59:02', NULL),
(24, 48, 'students', '/afghan-zar-soft/change-status-expense-cat/5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 18:31:37', NULL),
(25, 48, 'genedral', '/transport-sis/change-status-expense/14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 1, '2026-03-25 06:20:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `delivery_date` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `model_id` int NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `employee_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `section_name`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 'general', 48, '2025-08-07 17:49:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `who_it` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(7, 'مدیر مالی', 'ali', 1, '2025-08-07 00:09:19', NULL),
(6, 'حسابدار', 'ali', 1, '2025-08-07 00:09:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `en_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `section_id` int NOT NULL,
  `who_it` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `en_name`, `section_id`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(1, 'عمومی', 'general', 0, 'admin', 1, '2025-08-06 17:30:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int DEFAULT NULL,
  `deduction_form_capital` tinyint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `branch_id`, `deduction_form_capital`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-08-30 17:59:43', '2026-01-22 18:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `ref_id` int DEFAULT NULL,
  `type` tinyint NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `paid_amount` decimal(15,2) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(126) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `state` int NOT NULL DEFAULT '1',
  `who_it` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `address`, `image`, `description`, `state`, `who_it`, `created_at`, `updated_at`) VALUES
(17, 'sdafsdf', '444343', NULL, '$2y$10$y2ZarFa26MbLW3Vl6E8KseJbJmpPIlIe3dXDetTm4kw5YDaD6f1Zu', '', NULL, '', 1, 'for suport', '2026-04-25 18:09:13', NULL),
(16, 'asdfsdf', '456565', NULL, '$2y$10$umF8RBxpfsS0jVEjKUqIYOT7X/Vzp/zOeQJU5twB6OZR13hFqmU.2', '', NULL, '', 1, 'for suport', '2026-04-25 18:08:10', NULL),
(15, 'dsfsdaf', '6565', NULL, '$2y$10$7VANrtNYg/fa6tPsIC83QepJVX767QVtU.em/3b30OylJzd84a1dS', '', NULL, '', 1, 'for suport', '2026-04-25 18:08:01', NULL),
(14, 'dsfsdf', '34343', NULL, '$2y$10$xmD0uPZpZneO/OSheOfQPew/yW0/drpIUsgwfCSX/EJNbgR3hwlO6', '', NULL, '', 1, 'for suport', '2026-04-25 18:06:25', NULL),
(13, 'dsafsdf', '333', NULL, '$2y$10$pLx/k1H96O4GzQfWr0TrhuSFJNQoe9cHT.4xyaIDNxS7HfmOa2e3a', '', NULL, '', 1, 'for suport', '2026-04-25 18:05:30', NULL),
(12, 'sadfdsfdf', '454545', NULL, '$2y$10$VAeiHbMgb6Mxjv/7of.TIu4dJHhxAizpkwsjl3Q0MNR9MMyXyvt6a', '', '2026-04-25-17-47-18_69ecbedecb471.jpg', '', 1, 'for suport', '2026-04-25 17:47:18', NULL),
(11, 'aaaaaa', '3434', NULL, '$2y$10$hBsvg6bhqFyrTexYFh1hce1a3lVriPPto7gd0DAJ3cNQ81BsPuCK.', '', NULL, '', 1, 'for suport', '2026-04-25 17:47:09', NULL),
(18, 'ahmad jan', '334455', NULL, '$2y$10$kL4jDvHhjMIPzSwtI5H6xuCwEFcslETjb1mkOuiH0IKWFRLlyLDf6', '', NULL, '', 1, 'for suport', '2026-04-25 18:12:09', NULL),
(19, 'ali jan', '1111', NULL, '$2y$10$Glvj00HVEbfdvKeWkxIhie6TGRnUhGENpTqC9vwXO5IKCHFhdmCq.', 'address dfsdf sdf', '2026-04-25-18-12-53_69ecc4dd423f2.jpg', 'descr fomr', 1, 'for suport', '2026-04-25 18:12:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_licenses`
--

DROP TABLE IF EXISTS `user_licenses`;
CREATE TABLE IF NOT EXISTS `user_licenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `license_key` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(64) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_licenses`
--

INSERT INTO `user_licenses` (`id`, `user_id`, `branch_id`, `license_key`, `start_date`, `end_date`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 48, 48, 'sadfa3243edfdsfd', '2025-09-04', '2026-09-17', 1, NULL, '2025-09-17 12:37:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vests`
--

DROP TABLE IF EXISTS `vests`;
CREATE TABLE IF NOT EXISTS `vests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vest_model` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `fee` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vests`
--

INSERT INTO `vests` (`id`, `vest_model`, `fee`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'دخص', 400, 2, 'for suport', '2026-04-25 22:49:36', '2026-04-25 22:53:51'),
(2, 'f', 250, 1, 'for suport', '2026-04-25 22:49:38', '2026-04-25 22:54:00'),
(3, 'new', 300, 1, 'for suport', '2026-04-26 17:20:18', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
