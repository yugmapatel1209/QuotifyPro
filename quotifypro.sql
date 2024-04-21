-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 12:14 PM
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

INSERT INTO `quotations_detail` (`id`, `parent_id`, `quotation_id`, `series`, `material`, `hsn_sac`, `description`, `make`, `quantity`, `unit`, `rate`, `amount`, `gst_percentage`, `gst_amount`, `total_amount`, `extra`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 0, 6, '1', '', '85391000', 'LMP ULTRA VIOLE,PHILIPS,TL20W/0520W2FT', 'PHILIPS', '25', 'EA', '200', '5000', '18%', '900', '5900', NULL, 1, '2020-03-10 17:41:43', '2020-03-10 17:41:43', NULL),
(3, 0, 5, '1', '3209015', '8542', 'YOKOGAWA PID\r\nCONTROLLER,UT35A-000-11-00', 'YOKOGAWA', '2', 'Nos.', '25850', '51700', '18%', '9306', '61006', NULL, 1, '2020-03-10 17:32:22', '2020-03-15 14:01:31', '2020-03-15 14:01:31'),
(4, 0, 5, '2', '3203198', '8542', 'PID CNTR,HONEYWELL,DC-1040-PR-312008-E,', 'HONEYWELL', '2', 'Nos.', '8250', '16500', '18%', '2970', '19470', NULL, 1, '2020-03-10 17:32:22', '2020-03-15 14:01:31', '2020-03-15 14:01:31'),
(5, 0, 6, '1', '3012541', '85391000', 'LMP ULTRA VIOLE,PHILIPS,TL20W/0520W2FT', 'PHILIPS', '25', 'EA', '200', '5000', '18%', '900', '5900', NULL, 1, '2020-03-10 17:41:43', '2020-03-10 17:41:43', NULL),
(8, 0, 9, '1', NULL, '2710', 'oil', NULL, '11', 'liter', '500', '5500', '18%', '990', '6490', NULL, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(9, 0, 9, '2', NULL, '8421', 'oil Filter', NULL, '1', 'Nos.', '500', '500', '18%', '90', '590', NULL, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(10, 0, 9, '3', NULL, '8421', 'Diesel Filter', NULL, '1', 'Nos.', '2000', '2000', '18%', '360', '2360', NULL, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(11, 0, 9, '4', NULL, '8708', 'radiator coolant', NULL, '1', 'Nos.', '600', '600', '18%', '108', '708', NULL, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(12, 0, 9, '5', NULL, '8509', 'service charge', NULL, '1', 'Nos.', '4500', '4500', '18%', '810', '5310', NULL, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(13, 0, 4, '1', '3012541', '8542', 'Test sub', 'PHILIPS', '2', 'Nos.', '8', '16', '18%', '2.88', '18.88', NULL, 1, '2020-03-12 18:39:12', '2020-03-12 18:39:12', '2020-03-08 18:30:00'),
(14, 0, 4, '1', '3012541', '8542', 'Test sub', 'PHILIPS', '2', 'Nos.', '8', '16', '18%', '2.88', '18.88', NULL, 1, '2020-03-12 18:53:54', '2020-03-12 18:53:54', '2020-03-23 18:30:00'),
(15, 0, 4, '1', '3012541', '8542', 'Test sub uupdate', 'PHILIPS', '2', 'Nos.', '8', '16', '18%', '2.88', '18.88', NULL, 1, '2020-03-12 18:58:23', '2020-03-12 19:09:45', '2020-03-12 19:09:45'),
(16, 0, 4, '2', '3012541', '8542', 'Test sub uodae', 'PHILIPS', '2', 'Nos.', '8', '16', '18%', '2.88', '18.88', NULL, 1, '2020-03-12 18:58:23', '2020-03-12 19:09:45', '2020-03-12 19:09:45'),
(17, 0, 4, '1', '3012541', '8542', 'Test sub uupdate no new', 'PHILIPS', '2', 'Nos.', '8', '16', '18%', '2.88', '18.88', NULL, 1, '2020-03-12 19:09:45', '2020-03-12 19:09:45', NULL),
(18, 0, 4, '2', '3012541', '8542', 'Test sub uodae new enttires', 'PHILIPS', '2', 'Nos.', '8', '16', '18%', '2.88', '18.88', NULL, 1, '2020-03-12 19:09:45', '2020-03-12 19:09:45', NULL),
(19, 0, 5, '1', '3209015', '8542', 'YOKOGAWA PID\r\nCONTROLLER,UT35A-000-11-00', 'YOKOGAWA', '2', 'Nos.', '25850', '51700', '18%', '9306', '61006', NULL, 1, '2020-03-15 14:12:37', '2020-03-15 17:35:18', NULL),
(20, 0, 5, '2', '3203198', '8542', 'PID CNTR,HONEYWELL,DC-1040-PR-312008-E,', 'HONEYWELL', '2', 'Nos.', '8250', '16500', '18%', '2970', '19470', NULL, 1, '2020-03-15 14:12:37', '2020-03-15 17:35:18', NULL),
(21, 0, 5, '3', '3203198', '8542', 'test', 'HONEYWELL', '2', 'Nos.', '1000', '2000', '18%', '360', '2360', NULL, 1, '2020-03-15 14:12:37', '2020-03-15 14:54:28', '2020-03-15 14:54:28'),
(24, 0, 5, '3', '3209015', NULL, 'Test 3', 'PHILIPS', '1', 'Nos.', '10', '10', '18%', '1.8', '11.8', NULL, 1, '2020-03-15 15:03:57', '2020-03-15 15:04:50', '2020-03-15 15:04:50'),
(22, 0, 5, '3', '3203198', '8509', 'Add new', 'PHILIPS', '2', 'Nos.', '8250', '16500', '18%', '2970', '19470', NULL, 1, '2020-03-15 14:54:28', '2020-03-15 14:57:49', '2020-03-15 14:57:49'),
(23, 0, 5, '3', '3203198', '8509', 'Add new', 'PHILIPS', '2', 'Nos.', '8250', '16500', '18%', '2970', '19470', NULL, 1, '2020-03-15 14:57:49', '2020-03-15 14:58:26', '2020-03-15 14:58:26'),
(25, 0, 10, '1', NULL, '9954', 'Office server room in DB board \r\n2.5mm single core wire conneting \r\n3 board & server stand battery stand', NULL, '1', 'job', '1500', '1500', '18%', '270', '1770', NULL, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:58', NULL),
(26, 0, 10, '2', NULL, NULL, '18w 8 inch led panel light square cutting size 205mm', 'syska or helonix', '7', 'Nos.', '510', '3570', '18%', '642.6', '4212.6', NULL, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:58', NULL),
(27, 0, 10, '3', NULL, NULL, '15A modular switch', NULL, '1', 'Nos.', '50', '50', '18%', '9', '59', NULL, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:58', NULL),
(28, 0, 10, '4', NULL, NULL, '32A switch  2 modular', NULL, '1', 'Nos.', '135', '135', '18%', '24.3', '159.3', NULL, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:58', NULL),
(29, 0, 10, '5', NULL, NULL, '32A switch 2 modular agents. 32 A Modular MCB', NULL, '1', 'Nos.', '210', '210', '18%', '37.8', '247.8', NULL, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:58', NULL),
(30, 0, 10, '6', NULL, NULL, '15A socket & top', NULL, '5', 'Nos.', '120', '600', '18%', '108', '708', NULL, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:58', NULL),
(31, 0, 10, '7', NULL, '9954', 'Installation work of 15A socket & top', NULL, '1', 'Job', '475', '475', '18%', '85.5', '560.5', NULL, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:58', NULL),
(32, 0, 10, '8', NULL, NULL, '5A Socket & Top', 'HI-FI', '7', 'Nos.', '37', '259', '18%', '46.62', '305.62', NULL, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:58', NULL),
(33, 0, 10, '9', NULL, NULL, '12 Modular board', NULL, '1', 'Nos.', '135', '135', '18%', '24.3', '159.3', NULL, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:58', NULL),
(34, 0, 10, '10', NULL, '9954', '2 MTR cable and 7 mtr flexi. wire & installation\r\nlobuor wor and visiting', NULL, '1', 'Nos.', '650', '650', '18%', '117', '767', NULL, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:58', NULL),
(35, 0, 11, '1', NULL, '9954', 'Office server room in DB board \r\n2.5mm single core wire conneting \r\n3 board & server stand battery stand', NULL, '1', 'job', '1500', '1500', '18%', '270', '1770', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(36, 0, 11, '2', NULL, NULL, '18w 8 inch led panel light square cutting size 205mm', 'syska or helonix', '7', 'Nos.', '510', '3570', '18%', '642.6', '4212.6', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(37, 0, 11, '3', NULL, NULL, '15A modular switch', NULL, '1', 'Nos.', '50', '50', '18%', '9', '59', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(38, 0, 11, '4', NULL, NULL, '32A switch  2 modular', NULL, '1', 'Nos.', '135', '135', '18%', '24.3', '159.3', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(39, 0, 11, '5', NULL, NULL, '32A switch 2 modular agents. 32 A Modular MCB', NULL, '1', 'Nos.', '210', '210', '18%', '37.8', '247.8', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(40, 0, 11, '6', NULL, NULL, '15A socket & top', NULL, '5', 'Nos.', '120', '600', '18%', '108', '708', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(41, 0, 11, '7', NULL, '9954', 'Installation work of 15A socket & top', NULL, '1', 'Job', '475', '475', '18%', '85.5', '560.5', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(42, 0, 11, '8', NULL, NULL, '5A Socket & Top', 'HI-FI', '7', 'Nos.', '37', '259', '18%', '46.62', '305.62', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(43, 0, 11, '9', NULL, NULL, '12 Modular board', NULL, '1', 'Nos.', '135', '135', '18%', '24.3', '159.3', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(44, 0, 11, '10', NULL, '9954', '2 MTR cable and 7 mtr flexi. wire & installation\r\nlobuor wor and visiting', NULL, '1', 'Nos.', '650', '650', '18%', '117', '767', NULL, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(45, 0, 12, '1', '3,172,249.00', NULL, 'ISOLATOR CONTACT SET', NULL, '1', 'EA', '10', '10', '18%', '1.8', '11.8', NULL, 1, '2020-03-15 19:13:55', '2020-03-15 19:13:55', NULL),
(46, 0, 13, '1', '3,172,249.00', NULL, 'ISOLATOR CONTACT SET', NULL, '1', 'EA', '10', '10', '18%', '1.8', '11.8', NULL, 1, '2020-03-15 19:15:06', '2020-03-15 19:28:34', NULL),
(47, 0, 13, '2', NULL, NULL, 'test edit', NULL, '2', 'EA', '20', '40', '18%', '7.2', '47.2', NULL, 1, '2020-03-15 19:21:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `quotations_master`
--

CREATE TABLE `quotations_master` (
  `id` int(10) UNSIGNED NOT NULL,
  `licence` varchar(255) NOT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotations_master`
--

INSERT INTO `quotations_master` (`id`, `licence`, `address`, `client_company`, `client_name`, `client_address`, `rfq_number`, `date`, `quotation_number`, `valid_until`, `detail_amount`, `discount`, `final_amount`, `company_id`, `status`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'Govt. Approved Contractor', 'S/28 Swagat Enclave, Opp. Dediyasan G.I.D.C.,  Modhera Road, Mehsana-384002.', 'IFB Automotive Pvt. Ltd.', 'Yashbir sir', '82.5 Ganretar Service Work', NULL, '2020-02-20', '2019-2020/569', '10 Week', NULL, NULL, NULL, 1, 0, 1, '2020-03-10 17:58:56', '2020-03-10 17:58:56', NULL),
(4, 'Meshana District Co- operative Milk Producer’s Union Ltd, update', 'update Address', 'update Differenz System', 'up RFQ No: M610096904 Date: 12.02.2020', 'up RFQ No: M610096904 Date: 12.02.2020', 'up RFQ No: M610096904 Date: 12.02.2020', '2020-03-12', '2019-2020/4', '16 Month(s)', NULL, NULL, NULL, 1, 0, 1, '2020-03-10 17:31:12', '2020-03-12 19:09:45', NULL),
(5, 'Meshana District Co- operative Milk Producer’s Union Ltd,', 'Address', 'Differenz System', 'RFQ No: M610096904 Date: 12.02.2020', 'RFQ No: M610096904 Date: 12.02.2020', 'RFQ No: M610096904 Date: 12.02.2020', '2020-03-10', '2019-2020/1', '12 Day(s)', '80476', '0', '80476', 1, 0, 1, '2020-03-10 17:32:22', '2020-03-15 17:35:18', NULL),
(6, 'Meshana District Co- operative Milk Producer’s Union Ltd,', 'Address', NULL, NULL, NULL, 'RFQ No: M610096910 Date: 12.02.2020', '2020-03-10', '2019-2020/568', '12 Day(s)', NULL, NULL, NULL, 1, 0, 1, '2020-03-10 17:41:43', '2020-03-10 17:41:43', NULL),
(10, 'Govt. Approved Contractor', 'S/28 Swagat Enclave, Opp. Dediyasan G.I.D.C.,  Modhera Road, Mehsana-384002.', 'Asian Paints ltd, Rajkot', 'Mr. Siddharajsinh', NULL, NULL, '2020-02-12', '2019-2020/560', '1 Month(s)', '8949.12', '0', '8949.12', 1, 0, 1, '2020-03-15 17:50:05', '2020-03-15 17:52:59', NULL),
(11, 'Govt. Approved Contractor', 'S/28 Swagat Enclave, Opp. Dediyasan G.I.D.C.,  Modhera Road, Mehsana-384002.', 'Asian Paints ltd, Rajkot', 'Mr. Siddharajsinh', NULL, NULL, '2020-02-12', '2019-2020/560', '1 Month(s)', '8949.12', '0', '8949.12', 1, 0, 1, '2020-03-15 17:51:51', '2020-03-15 17:51:51', NULL),
(12, 'Govt. Approved Contractor', 'S/28 Swagat Enclave, Opp. Dediyasan G.I.D.C.,  Modhera Road, Mehsana-384002.', 'BANASKANTHA DISTRICT CO-OPERATIVE MILK PRODUCERS\' UNION LIMITED', 'PURCHASE SECTION', NULL, 'RFQ No.B610253145 Date: 18.01.2020', '2020-02-19', '2019-2020/8', '15 Day(s)', '11.8', '0', '11.8', 1, 0, 1, '2020-03-15 19:13:55', '2020-03-15 19:13:55', NULL),
(13, 'Govt. Approved Contractor', 'S/28 Swagat Enclave, Opp. Dediyasan G.I.D.C.,  Modhera Road, Mehsana-384002.', 'BANASKANTHA DISTRICT CO-OPERATIVE MILK PRODUCERS\' UNION LIMITED', 'PURCHASE SECTION', NULL, 'RFQ No.B610253145 Date: 18.01.2020', '2020-02-19', '2019-2020/8', '15 Day(s)', '11.8', '0', '11.8', 1, 0, 1, '2020-03-15 19:15:06', '2020-03-15 19:28:34', NULL);

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
(4, 5, 'Delivery time 3 to 4 Week After O.P.', '', NULL, NULL, NULL),
(5, 0, 'Delivery time 1 to 2 Week After O.P.', '1', '2020-03-15 19:15:06', '2020-03-15 19:15:06', NULL),
(6, 0, 'Test 11', '2', '2020-03-15 19:15:06', '2020-03-15 19:15:06', NULL),
(7, 13, 'Add new', '0', '2020-03-15 19:20:11', '2020-03-15 19:28:34', NULL),
(8, 13, 'Add new', '0', '2020-03-15 19:20:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(9, 13, 'Second new', '2', '2020-03-15 19:20:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(10, 13, 'Add new', '0', '2020-03-15 19:21:39', '2020-03-15 19:24:39', '2020-03-15 19:24:39'),
(11, 13, 'Add new', '1', '2020-03-15 19:21:39', '2020-03-15 19:24:39', '2020-03-15 19:24:39'),
(12, 13, 'Second new', '2', '2020-03-15 19:21:39', '2020-03-15 19:24:39', '2020-03-15 19:24:39'),
(13, 13, 'Add new', '0', '2020-03-15 19:24:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(14, 13, 'Add new', '1', '2020-03-15 19:24:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(15, 13, 'Second new', '2', '2020-03-15 19:24:39', '2020-03-15 19:28:34', '2020-03-15 19:28:34'),
(16, 13, 'add four in edit', '6', '2020-03-15 19:24:39', '2020-03-15 19:28:34', NULL),
(17, 13, 'extra content', '8', '2020-03-15 19:28:34', '2020-03-15 19:28:34', NULL);

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
(1, '', '', '', NULL, NULL, NULL),
(2, 'yugma', 'yugmapatel1209@gmail.com', '$2y$10$zCWG5eETZ4wF7oVdnbhnDu6/l2rYHkGbj4ElVT6EQvYmBsXJ3XIfm', 'bSOkj04eMuf2MEdeT02MCyAeu4Ar6g3tbtGRwFzbpXcAt4cgmmIG9Yp9ybXP', '2020-03-08 11:26:59', '2020-03-08 11:26:59'),
(3, 'Akshay', 'contact@delveandfathom.com', '$2y$10$yVP54z/Q6nt/wGo10uB3kuIwEJTdwplVsR2epegr9ROPz49aRYImK', NULL, '2020-04-02 10:20:56', '2020-04-02 10:20:56');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `quotations_master`
--
ALTER TABLE `quotations_master`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
