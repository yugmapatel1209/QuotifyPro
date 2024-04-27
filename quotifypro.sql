-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 12:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quotifypro`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_03_08_162203_create_quotation_master_table', 1),
(2, '2020_03_08_163416_create_quotation_detail_table', 1),
(3, '2020_03_08_164622_create_terms_conditions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotations_detail`
--

CREATE TABLE `quotations_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `quotation_id` int(11) NOT NULL DEFAULT 0,
  `series` varchar(255) NOT NULL,
  `material` varchar(255) DEFAULT NULL,
  `hsn_sac` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `including_gst` varchar(100) DEFAULT NULL,
  `excluding_gst` varchar(255) DEFAULT NULL,
  `discount_percentage` varchar(50) DEFAULT NULL,
  `final_amount` varchar(255) DEFAULT NULL,
  `profit_percentage` varchar(255) DEFAULT NULL,
  `original_rate` varchar(255) DEFAULT NULL,
  `purchase_amount` varchar(255) DEFAULT NULL,
  `sales_amount` varchar(255) DEFAULT NULL,
  `transportation_charges` varchar(255) DEFAULT NULL,
  `gst_percentage` varchar(255) DEFAULT NULL,
  `gst_amount` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `extra` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotations_detail`
--

INSERT INTO `quotations_detail` (`id`, `parent_id`, `quotation_id`, `series`, `material`, `hsn_sac`, `description`, `make`, `quantity`, `unit`, `rate`, `amount`, `including_gst`, `excluding_gst`, `discount_percentage`, `final_amount`, `profit_percentage`, `original_rate`, `purchase_amount`, `sales_amount`, `transportation_charges`, `gst_percentage`, `gst_amount`, `total_amount`, `extra`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 0, 6, '1', '', '85391000', 'LMP ULTRA VIOLE,PHILIPS,TL20W/0520W2FT', 'PHILIPS', '25', 'EA', '200', '5000', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '900', '5900', NULL, 1, '2020-03-10 17:41:43', '2020-03-10 17:41:43', NULL),
(3, 0, 5, '1', '3209015', '8542', 'YOKOGAWA PID\r\nCONTROLLER,UT35A-000-11-00', 'YOKOGAWA', '2', 'Nos.', '25850', '51700', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '9306', '61006', NULL, 1, '2020-03-10 17:32:22', '2020-03-15 14:01:31', '2020-03-15 14:01:31'),
(4, 0, 5, '2', '3203198', '8542', 'PID CNTR,HONEYWELL,DC-1040-PR-312008-E,', 'HONEYWELL', '2', 'Nos.', '8250', '16500', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '2970', '19470', NULL, 1, '2020-03-10 17:32:22', '2020-03-15 14:01:31', '2020-03-15 14:01:31'),
(5, 0, 6, '1', '3012541', '85391000', 'LMP ULTRA VIOLE,PHILIPS,TL20W/0520W2FT', 'PHILIPS', '25', 'EA', '200', '5000', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '900', '5900', NULL, 1, '2020-03-10 17:41:43', '2020-03-10 17:41:43', NULL),
(8, 0, 9, '1', NULL, '2710', 'oil', NULL, '11', 'liter', '500', '5500', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '990', '6490', NULL, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(9, 0, 9, '2', NULL, '8421', 'oil Filter', NULL, '1', 'Nos.', '500', '500', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '90', '590', NULL, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(10, 0, 9, '3', NULL, '8421', 'Diesel Filter', NULL, '1', 'Nos.', '2000', '2000', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '360', '2360', NULL, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(11, 0, 9, '4', NULL, '8708', 'radiator coolant', NULL, '1', 'Nos.', '600', '600', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '108', '708', NULL, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(12, 0, 9, '5', NULL, '8509', 'service charge', NULL, '1', 'Nos.', '4500', '4500', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '810', '5310', NULL, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(13, 0, 4, '1', '3012541', '8542', 'Test sub', 'PHILIPS', '2', 'Nos.', '8', '16', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '2.88', '18.88', NULL, 1, '2020-03-12 18:39:12', '2020-03-12 18:39:12', '2020-03-08 18:30:00'),
(14, 0, 4, '1', '3012541', '8542', 'Test sub', 'PHILIPS', '2', 'Nos.', '8', '16', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '2.88', '18.88', NULL, 1, '2020-03-12 18:53:54', '2020-03-12 18:53:54', '2020-03-23 18:30:00'),
(15, 0, 4, '1', '3012541', '8542', 'Test sub uupdate', 'PHILIPS', '2', 'Nos.', '8', '16', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '2.88', '18.88', NULL, 1, '2020-03-12 18:58:23', '2020-03-12 19:09:45', '2020-03-12 19:09:45'),
(16, 0, 4, '2', '3012541', '8542', 'Test sub uodae', 'PHILIPS', '2', 'Nos.', '8', '16', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '2.88', '18.88', NULL, 1, '2020-03-12 18:58:23', '2020-03-12 19:09:45', '2020-03-12 19:09:45'),
(17, 0, 4, '1', '3012541', '8542', 'Test sub uupdate no new', 'PHILIPS', '2', 'Nos.', '8', '16', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '2.88', '18.88', NULL, 1, '2020-03-12 19:09:45', '2024-02-24 20:35:03', NULL),
(18, 0, 4, '2', '3012541', '8542', 'Test sub uodae new enttires', 'PHILIPS', '2', 'Nos.', '8', '16', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '2.88', '18.88', NULL, 1, '2020-03-12 19:09:45', '2024-02-24 20:35:03', NULL),
(19, 0, 5, '1', '3209015', '8542', 'YOKOGAWA PID\r\nCONTROLLER,UT35A-000-11-00', 'YOKOGAWA', '2', 'Nos.', '25850', '51700', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '9306', '61006', NULL, 1, '2020-03-15 14:12:37', '2024-02-24 08:18:42', NULL),
(20, 0, 5, '2', '3203198', '8542', 'PID CNTR,HONEYWELL,DC-1040-PR-312008-E,', 'HONEYWELL', '2', 'Nos.', '8250', '16500', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '2970', '19470', NULL, 1, '2020-03-15 14:12:37', '2024-02-24 08:18:42', NULL),
(21, 0, 5, '3', '3203198', '8542', 'test', 'HONEYWELL', '2', 'Nos.', '1000', '2000', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '360', '2360', NULL, 1, '2020-03-15 14:12:37', '2020-03-15 14:54:28', '2020-03-15 14:54:28'),
(24, 0, 5, '3', '3209015', NULL, 'Test 3', 'PHILIPS', '1', 'Nos.', '10', '10', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '1.8', '11.8', NULL, 1, '2020-03-15 15:03:57', '2020-03-15 15:04:50', '2020-03-15 15:04:50'),
(22, 0, 5, '3', '3203198', '8509', 'Add new', 'PHILIPS', '2', 'Nos.', '8250', '16500', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '2970', '19470', NULL, 1, '2020-03-15 14:54:28', '2020-03-15 14:57:49', '2020-03-15 14:57:49'),
(23, 0, 5, '3', '3203198', '8509', 'Add new', 'PHILIPS', '2', 'Nos.', '8250', '16500', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '2970', '19470', NULL, 1, '2020-03-15 14:57:49', '2020-03-15 14:58:26', '2020-03-15 14:58:26'),
(25, 0, 10, '1', NULL, '9954', 'Office server room in DB board \r\n2.5mm single core wire conneting \r\n3 board & server stand battery stand', NULL, '1', 'job', '1500', '1500', '8963', '10000', '10', '1200', '20', '1500', '2000', '5600', '45', '18%', '300', '1800', NULL, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(26, 0, 10, '2', NULL, NULL, '18w 8 inch led panel light square cutting size 205mm', 'syska or helonix', '7', 'Nos.', '510', '3570', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18%', '0', '3570', NULL, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(27, 0, 10, '3', NULL, NULL, '15A modular switch', NULL, '1', 'Nos.', '50', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18%', '0', '50', NULL, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(28, 0, 10, '4', NULL, NULL, '32A switch  2 modular', NULL, '1', 'Nos.', '135', '135', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18%', '0', '135', NULL, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(29, 0, 10, '5', NULL, NULL, '32A switch 2 modular agents. 32 A Modular MCB', NULL, '1', 'Nos.', '210', '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18%', '0', '210', NULL, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(30, 0, 10, '6', NULL, NULL, '15A socket & top', NULL, '5', 'Nos.', '120', '600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18%', '0', '600', NULL, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(31, 0, 10, '7', NULL, '9954', 'Installation work of 15A socket & top', NULL, '1', 'Job', '475', '475', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18%', '0', '475', NULL, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(32, 0, 10, '8', NULL, NULL, '5A Socket & Top', 'HI-FI', '7', 'Nos.', '37', '259', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18%', '0', '259', NULL, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(33, 0, 10, '9', NULL, NULL, '12 Modular board', NULL, '1', 'Nos.', '135', '135', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18%', '0', '135', NULL, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(34, 0, 10, '10', NULL, '9954', '2 MTR cable and 7 mtr flexi. wire & installation\r\nlobuor wor and visiting', NULL, '1', 'Nos.', '650', '650', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18%', '0', '650', NULL, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(35, 0, 11, '1', NULL, '9954', 'Office server room in DB board \r\n2.5mm single core wire conneting \r\n3 board & server stand battery stand', NULL, '1', 'job', '1500', '1500', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '270', '1770', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(36, 0, 11, '2', NULL, NULL, '18w 8 inch led panel light square cutting size 205mm', 'syska or helonix', '7', 'Nos.', '510', '3570', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '642.6', '4212.6', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(37, 0, 11, '3', NULL, NULL, '15A modular switch', NULL, '1', 'Nos.', '50', '50', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '9', '59', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(38, 0, 11, '4', NULL, NULL, '32A switch  2 modular', NULL, '1', 'Nos.', '135', '135', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '24.3', '159.3', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(39, 0, 11, '5', NULL, NULL, '32A switch 2 modular agents. 32 A Modular MCB', NULL, '1', 'Nos.', '210', '210', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '37.8', '247.8', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(40, 0, 11, '6', NULL, NULL, '15A socket & top', NULL, '5', 'Nos.', '120', '600', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '108', '708', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(41, 0, 11, '7', NULL, '9954', 'Installation work of 15A socket & top', NULL, '1', 'Job', '475', '475', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '85.5', '560.5', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(42, 0, 11, '8', NULL, NULL, '5A Socket & Top', 'HI-FI', '7', 'Nos.', '37', '259', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '46.62', '305.62', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(43, 0, 11, '9', NULL, NULL, '12 Modular board', NULL, '1', 'Nos.', '135', '135', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '24.3', '159.3', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(44, 0, 11, '10', NULL, '9954', '2 MTR cable and 7 mtr flexi. wire & installation\r\nlobuor wor and visiting', NULL, '1', 'Nos.', '650', '650', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '117', '767', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(45, 0, 12, '1', '3,172,249.00', NULL, 'ISOLATOR CONTACT SET', NULL, '1', 'EA', '10', '10', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '1.8', '11.8', NULL, 1, '2020-03-15 19:13:55', '2024-02-24 20:45:49', NULL),
(46, 0, 13, '1', '3,172,249.00', NULL, 'ISOLATOR CONTACT SET', NULL, '1', 'EA', '10', '10', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '1.8', '11.8', NULL, 1, '2020-03-15 19:15:06', '2024-02-24 22:57:11', NULL),
(47, 0, 13, '2', NULL, NULL, 'test edit', NULL, '2', 'EA', '20', '40', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '18%', '7.2', '47.2', NULL, 1, '2020-03-15 19:21:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(48, 0, 14, '1', NULL, NULL, NULL, NULL, '10', 'Nos.', '12', '120', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '5%', '6', '126', NULL, 1, '2024-02-24 08:04:59', '2024-02-24 08:04:59', NULL),
(49, 0, 15, '1', 'ddd', 'ddd', 'sss', NULL, '10', 'Nos.', '20', '200', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '5%', '10', '210', NULL, 1, '2024-02-24 10:59:54', '2024-02-24 20:44:50', NULL),
(50, 0, 16, '1', NULL, NULL, NULL, NULL, '12', '10', '1000', '12000', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '5%', '600', '12600', NULL, 1, '2024-02-24 11:37:23', '2024-02-24 11:37:23', NULL),
(51, 0, 17, '1', NULL, NULL, NULL, NULL, '10', 'Nos.', '120', '1200', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '5%', '60', '1260', NULL, 1, '2024-02-24 11:40:28', '2024-02-24 11:40:28', NULL),
(52, 0, 20, '1', NULL, NULL, NULL, NULL, '10', 'EA', '10', '100', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '5%', '5', '105', NULL, 1, '2024-02-24 12:00:06', '2024-02-24 12:00:06', NULL),
(53, 0, 21, '1', NULL, NULL, NULL, NULL, '456', 'Nos.', '10', '4560', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '5%', '228', '4788', NULL, 1, '2024-02-24 12:04:07', '2024-02-24 12:04:07', NULL),
(54, 0, 22, '1', NULL, NULL, NULL, NULL, '15', '89', '100', '1500', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '5%', '75', '1575', NULL, 1, '2024-02-24 12:09:23', '2024-02-24 12:09:23', NULL),
(55, 0, 23, '1', NULL, NULL, NULL, NULL, '35', 'Nos.', '45', '1575', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '5%', '78.75', '1653.75', NULL, 1, '2024-02-24 12:10:59', '2024-02-24 12:25:18', NULL),
(56, 0, 30, '1', NULL, NULL, NULL, NULL, '10', '10', '600', '6000', NULL, NULL, NULL, NULL, '10', NULL, NULL, NULL, NULL, '5%', '600', '6600', NULL, 1, '2024-02-24 23:08:19', '2024-02-24 23:18:40', NULL),
(57, 0, 30, '2', NULL, NULL, NULL, NULL, '10', 'Nos.', '10', '100', NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, NULL, '5%', '30', '130', NULL, 1, '2024-02-24 23:17:03', '2024-02-24 23:18:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotations_master`
--

CREATE TABLE `quotations_master` (
  `id` int(10) UNSIGNED NOT NULL,
  `licence` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `client_company` varchar(255) DEFAULT NULL,
  `client_name` text DEFAULT NULL,
  `client_address` text DEFAULT NULL,
  `rfq_number` text DEFAULT NULL,
  `date` date NOT NULL,
  `quotation_number` varchar(255) NOT NULL,
  `valid_until` varchar(255) NOT NULL,
  `detail_amount` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `final_amount` varchar(255) DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `status` int(11) DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_laterpad_image` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotations_master`
--

INSERT INTO `quotations_master` (`id`, `licence`, `address`, `client_company`, `client_name`, `client_address`, `rfq_number`, `date`, `quotation_number`, `valid_until`, `detail_amount`, `discount`, `final_amount`, `company_id`, `status`, `is_active`, `is_laterpad_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'Govt. Approved Contractor', 'S/28 Swagat Enclave, Opp. Dediyasan G.I.D.C.,  Modhera Road, Mehsana-384002.', 'IFB Automotive Pvt. Ltd.', 'Yashbir sir', '82.5 Ganretar Service Work', NULL, '2020-02-20', '2019-2020/569', '10 Week', NULL, NULL, NULL, 1, 0, 1, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(4, NULL, NULL, 'update Differenz System', 'up RFQ No: M610096904 Date: 12.02.2020', 'up RFQ No: M610096904 Date: 12.02.2020', 'up RFQ No: M610096904 Date: 12.02.2020', '2020-03-12', '2023-2024/4', '16 Month(s)', '37.76', '0', '37.76', 1, 0, 1, 0, '2020-03-10 17:31:12', '2024-02-24 20:35:03', NULL),
(26, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-29', '2023-2024/123', '10 Day(s)', NULL, NULL, NULL, 1, 0, 1, 1, '2024-02-24 23:02:34', '2024-02-24 23:02:34', NULL),
(5, NULL, NULL, 'Differenz System', 'RFQ No: M610096904 Date: 12.02.2020', 'RFQ No: M610096904 Date: 12.02.2020', 'RFQ No: M610096904 Date: 12.02.2020', '2020-03-10', '2023-2024/123', '12 Day(s)', '80476', '0', '80476', 1, 0, 1, 1, '2020-03-10 17:32:22', '2024-02-24 08:18:42', NULL),
(15, NULL, NULL, 'IFB Automotive Pvt. Ltd.', 'Yashbir sir', NULL, 'asd', '2024-02-29', '2023-2024/123456', '10 Day(s)', '210', '0', '210', 2, 0, 1, 0, '2024-02-24 10:59:54', '2024-02-24 20:44:50', NULL),
(6, 'Meshana District Co- operative Milk Producer’s Union Ltd,', 'Address', NULL, NULL, NULL, 'RFQ No: M610096910 Date: 12.02.2020', '2020-03-10', '2019-2020/568', '12 Day(s)', NULL, NULL, NULL, 1, 0, 1, 1, '2020-03-10 17:41:43', '2020-03-10 17:41:43', NULL),
(10, NULL, NULL, 'Asian Paints ltd, Rajkot', 'Mr. Siddharajsinh', NULL, NULL, '2020-02-12', '2023-2024/560', '1 Month(s)', '7884', '0', '7884', 1, 0, 1, 1, '2020-03-15 17:50:05', '2024-03-09 08:30:07', NULL),
(11, 'Govt. Approved Contractor', 'S/28 Swagat Enclave, Opp. Dediyasan G.I.D.C.,  Modhera Road, Mehsana-384002.', 'Asian Paints ltd, Rajkot', 'Mr. Siddharajsinh', NULL, NULL, '2020-02-12', '2019-2020/560', '1 Month(s)', '8949.12', '0', '8949.12', 1, 0, 1, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(12, NULL, NULL, 'BANASKANTHA DISTRICT CO-OPERATIVE MILK PRODUCERS\' UNION LIMITED', 'PURCHASE SECTION', NULL, 'RFQ No.B610253145 Date: 18.01.2020', '2020-02-19', '2023-2024/8', '15 Day(s)', '11.8', '0', '11.8', 1, 0, 0, 1, '2020-03-15 19:13:55', '2024-02-24 20:45:49', NULL),
(25, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-29', '2023-2024/123', '10 Day(s)', NULL, NULL, NULL, 1, 0, 1, 1, '2024-02-24 23:00:59', '2024-02-24 23:00:59', NULL),
(13, NULL, NULL, 'BANASKANTHA DISTRICT CO-OPERATIVE MILK PRODUCERS\' UNION LIMITED', 'PURCHASE SECTION', NULL, 'RFQ No.B610253145 Date: 18.01.2020', '2020-02-19', '2023-2024/8', '15 Day(s)', '11.8', '0', '11.8', 1, 0, 1, 1, '2020-03-15 19:15:06', '2024-02-24 22:57:11', NULL),
(24, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-29', '2023-2024/123', '10 Day(s)', NULL, NULL, NULL, 1, 0, 1, 1, '2024-02-24 22:58:20', '2024-02-24 22:58:20', NULL),
(14, 'Govt. Approved Contractor', 'surat', 'IFB Automotive Pvt. Ltd.', 'Mr. Siddharajsinh', 'adajan', 'aaa', '2024-02-29', '2023-2024/asdfg', '10 Day(s)', '126', '0', '126', 1, 1, 1, 1, '2024-02-24 08:04:59', '2024-02-24 08:04:59', NULL),
(16, NULL, NULL, 'xsd', 'PURCHASE SECTION', NULL, '222', '2024-02-29', '2023-2024/123', '10 Day(s)', '12600', '0', '12600', 1, 0, 1, 1, '2024-02-24 11:37:23', '2024-02-24 11:37:23', NULL),
(17, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-29', '2023-2024/123', '10 Day(s)', '1260', '0', '1260', 1, 0, 1, 1, '2024-02-24 11:40:28', '2024-02-24 11:40:28', NULL),
(18, NULL, NULL, 'dddd', 'Mr. Siddharajsinh', NULL, '123', '2024-03-01', '2023-2024/123', '10 Day(s)', NULL, NULL, NULL, 1, 0, 1, 1, '2024-02-24 11:58:18', '2024-02-24 11:58:18', NULL),
(19, NULL, NULL, 'dddd', 'Mr. Siddharajsinh', NULL, '123', '2024-03-01', '2023-2024/123', '10 Day(s)', NULL, NULL, NULL, 1, 0, 1, 1, '2024-02-24 11:59:55', '2024-02-24 11:59:55', NULL),
(20, NULL, NULL, 'dddd', 'Mr. Siddharajsinh', NULL, '123', '2024-03-01', '2023-2024/123', '10 Day(s)', '105', '0', '105', 1, 0, 1, 1, '2024-02-24 12:00:06', '2024-02-24 12:00:06', NULL),
(21, NULL, NULL, 'BANASKANTHA DISTRICT CO-OPERATIVE MILK PRODUCERS\ UNION LIMITED', 'up RFQ No: M610096904 Date: 12.02.2020', NULL, '123', '2024-02-29', '2023-2024/123', '15 Day(s)', '4788', '0', '4788', 1, 0, 1, 1, '2024-02-24 12:04:07', '2024-02-24 12:04:07', NULL),
(22, NULL, NULL, 'Differenz System', 'Mr. Siddharajsinh', NULL, 'ff', '2024-02-29', '2023-2024/123', '17 Day(s)', '1575', '0', '1575', 1, 0, 1, 0, '2024-02-24 12:09:23', '2024-02-24 12:09:23', NULL),
(23, NULL, NULL, 'abc', 'abc', NULL, '4789', '2024-02-29', '2023-2024/asdfg', '10 Day(s)', '1653.75', '0', '1653.75', 1, 0, 1, 0, '2024-02-24 12:10:59', '2024-02-24 12:25:18', NULL),
(27, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-29', '2023-2024/123', '10 Day(s)', NULL, NULL, NULL, 1, 0, 1, 1, '2024-02-24 23:03:02', '2024-02-24 23:03:02', NULL),
(28, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-29', '2023-2024/123', '10 Day(s)', NULL, NULL, NULL, 1, 0, 1, 1, '2024-02-24 23:04:04', '2024-02-24 23:04:04', NULL),
(29, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-29', '2023-2024/123', '10 Day(s)', NULL, NULL, NULL, 1, 0, 1, 1, '2024-02-24 23:05:19', '2024-02-24 23:05:19', NULL),
(30, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-29', '2023-2024/xcc', '10 Day(s)', '6730', '0', '6730', 1, 0, 1, 1, '2024-02-24 23:08:19', '2024-02-24 23:18:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terms_conditions`
--

CREATE TABLE `terms_conditions` (
  `id` int(10) UNSIGNED NOT NULL,
  `quotation_id` int(11) NOT NULL DEFAULT 0,
  `description` varchar(255) NOT NULL,
  `extra` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_conditions`
--

INSERT INTO `terms_conditions` (`id`, `quotation_id`, `description`, `extra`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Qty after po', 'aa', NULL, NULL, NULL),
(2, 1, 'teettsts', 'aa', NULL, NULL, NULL),
(3, 1, 'Delivery time 3 to 4 Week After O.P.', '', NULL, NULL, NULL),
(4, 5, 'Delivery time 3 to 4 Week After O.P.', '0', NULL, '2024-02-24 08:18:42', NULL),
(5, 0, 'Delivery time 1 to 2 Week After O.P.', '1', '2020-03-15 19:15:06', '2020-03-15 19:15:06', NULL),
(6, 0, 'Test 11', '2', '2020-03-15 19:15:06', '2020-03-15 19:15:06', NULL),
(7, 13, 'Add new', '0', '2020-03-15 19:20:11', '2024-02-24 22:57:11', NULL),
(8, 13, 'Add new', '0', '2020-03-15 19:20:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(9, 13, 'Second new', '2', '2020-03-15 19:20:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(10, 13, 'Add new', '0', '2020-03-15 19:21:39', '2020-03-15 19:24:39', '2020-03-15 19:24:39'),
(11, 13, 'Add new', '1', '2020-03-15 19:21:39', '2020-03-15 19:24:39', '2020-03-15 19:24:39'),
(12, 13, 'Second new', '2', '2020-03-15 19:21:39', '2020-03-15 19:24:39', '2020-03-15 19:24:39'),
(13, 13, 'Add new', '0', '2020-03-15 19:24:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(14, 13, 'Add new', '1', '2020-03-15 19:24:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(15, 13, 'Second new', '2', '2020-03-15 19:24:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(16, 13, 'add four in edit', '1', '2020-03-15 19:24:39', '2024-02-24 22:57:11', NULL),
(17, 13, 'extra content', '2', '2020-03-15 19:28:34', '2024-02-24 22:57:11', NULL),
(18, 14, 'xd', '1', '2024-02-24 08:04:59', '2024-02-24 08:04:59', NULL),
(19, 15, 'sss', '0', '2024-02-24 10:59:54', '2024-02-24 20:44:50', NULL),
(20, 16, 'asd', '1', '2024-02-24 11:37:23', '2024-02-24 11:37:23', NULL),
(21, 17, 'add', '1', '2024-02-24 11:40:28', '2024-02-24 11:40:28', NULL),
(22, 20, 'dddd', '1', '2024-02-24 12:00:06', '2024-02-24 12:00:06', NULL),
(23, 21, 'dddd', '1', '2024-02-24 12:04:07', '2024-02-24 12:04:07', NULL),
(24, 22, 'ddddd', '1', '2024-02-24 12:09:23', '2024-02-24 12:09:23', NULL),
(25, 23, 'abc', '0', '2024-02-24 12:10:59', '2024-02-24 12:25:18', NULL),
(26, 30, 'xc', '0', '2024-02-24 23:08:19', '2024-02-24 23:18:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Yugma Patel', 'yugma@yopmail.com', '$2y$12$Red2rc/1hAjZvszqf4a0I.OeUKG4o8xX2.IZPgixs21R3TuEDrlmq', 'PEJXCYuv0ujajcTm8QrtZZrKQrdtJcwWBfLr47Lmjs2QZcZkzGROcvX9sLQf', NULL, NULL),
(2, 'Hardik Patel', 'hdpatel1991@gmail.com', '$2y$10$uXQ3hCczq6tJ6Y4nvTBqJOm7.iDcOcZDKw3HgkW3mpvA6qwJe/62S', 'bSOkj04eMuf2MEdeT02MCyAeu4Ar6g3tbtGRwFzbpXcAt4cgmmIG9Yp9ybXP', '2020-03-08 11:26:59', '2020-03-08 11:26:59'),
(3, 'Akshay', 'contact@delveandfathom.com', '$2y$10$yVP54z/Q6nt/wGo10uB3kuIwEJTdwplVsR2epegr9ROPz49aRYImK', NULL, '2020-04-02 10:20:56', '2020-04-02 10:20:56'),
(4, 'Hardik Patel', 'hdpatel1990@gmail.com', '$2y$12$Red2rc/1hAjZvszqf4a0I.OeUKG4o8xX2.IZPgixs21R3TuEDrlmq', NULL, '2024-02-24 08:01:32', '2024-02-24 08:01:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations_detail`
--
ALTER TABLE `quotations_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations_master`
--
ALTER TABLE `quotations_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quotations_detail`
--
ALTER TABLE `quotations_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `quotations_master`
--
ALTER TABLE `quotations_master`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
