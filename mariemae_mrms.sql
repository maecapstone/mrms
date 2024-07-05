-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 04, 2024 at 03:57 PM
-- Server version: 10.6.18-MariaDB
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mariemae_mrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `baby`
--

CREATE TABLE `baby` (
  `baby_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension_name` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `datetime_delivery` varchar(100) NOT NULL,
  `blood_type` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `length` varchar(100) NOT NULL,
  `circular_head` varchar(100) NOT NULL,
  `circular_chest` varchar(100) NOT NULL,
  `type_delivery` varchar(100) NOT NULL,
  `baby_status` varchar(100) NOT NULL,
  `datetime_died` varchar(100) NOT NULL,
  `maternal_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `place_birth` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `father_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `child_no` varchar(100) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baby`
--

INSERT INTO `baby` (`baby_id`, `first_name`, `middle_name`, `last_name`, `extension_name`, `sex`, `datetime_delivery`, `blood_type`, `weight`, `length`, `circular_head`, `circular_chest`, `type_delivery`, `baby_status`, `datetime_died`, `maternal_id`, `history_id`, `place_birth`, `remarks`, `father_id`, `center_id`, `child_no`, `patient_id`) VALUES
(1, 'B1', '', 'Mendula', '', 'Male', '2024-05-21T13:52', 'A+', '30kg', '12in', '32', '323', 'Normal', 'Alive', '', 1, 3, 'Sibalom, Antique', '', 1, 4, '1', 1),
(2, 'B2', '', 'Mendula', '', 'Male', '2024-05-21T13:53', 'B-', '12', '121', '22', '22', 'Normal', 'Alive', '', 1, 3, 'Sibalom, Antique', '', 1, 4, '2', 1),
(3, 'B3', '', 'Mendula', '', 'Male', '2024-05-21T14:01', 'B-', '32', '32', '32', '32', 'Normal', 'Alive', '', 2, 9, 'Sibalom, Antique', '', 2, 4, '3', 1),
(4, 'fd', 'fd', 'fd', '', 'Male', '2024-06-20T14:14', 'A+', 'fdfdf', 're', 're', 're', 'Normal', 'Alive', '', 3, 11, 'fdf', '', 3, 4, '4', 1),
(5, 'karl', '', 'dwwef', '', 'Male', '2024-07-01T11:26', 'A+', '12', '34', '2434', '234', 'Normal', 'Alive', '', 9, 23, 'sibalom', '', 4, 4, '1', 11),
(6, 'carlo', 'ada', 'dfsdf', '', 'Male', '2024-07-03T11:33', 'B-', '2343', '235', '35', '345', 'Normal', 'Alive', '2024-07-31T11:34', 10, 25, 'sibalom', '', 5, 4, '2', 11),
(7, 'lans', '', 'guhi', '', 'Male', '2024-07-02T11:48', 'A+', '45', '678', 'kjhi', '789', 'Normal', 'Alive', '', 4, 39, 'jhgjhk', '', 6, 4, '1', 5),
(8, 'Karol', '', 'Dfftt', '', 'Male', '2024-07-02T15:14', 'A+', '12', '12', '12', '123', 'Normal', 'Alive', '', 7, 43, 'Jajsisb', '', 7, 4, '1', 9),
(9, 'Karlo', 'Jsiwn', 'Sbisb', '', 'Male', '2024-07-02T15:57', 'AB+', '12', '12', '24', '12', 'Normal', 'Alive', '', 16, 45, 'Hrjen', '', 8, 4, '1', 14),
(10, 'Melissa', '', 'Bdjb', '', 'Male', '2024-07-02T16:04', 'A-', '13', '13', '12', '12', 'Normal', 'Died', '', 18, 48, 'Sibalom', '', 9, 4, '2', 14),
(11, 'Josh', '', 'Nsisb', '', 'Male', '2024-07-02T16:15', 'A+', '12', '12', '12', '12', 'Normal', 'Alive', '', 19, 52, 'Sibalom', '', 10, 4, '3', 14),
(12, 'Udud', '', 'Hsush', '', 'Male', '2024-07-02T16:19', 'A-', '7373', '8373', 'Jdjdjd', '6373', 'Normal', 'Alive', '', 17, 53, 'Jejdh', '', 11, 4, '4', 14),
(13, 'Mike', '', 'Jeisbs', '', 'Male', '2024-07-02T16:46', 'A-', '16', '13', '12', '123', 'Normal', 'Alive', '', 20, 60, '12', '', 12, 4, '5', 14),
(14, 'juan', '', 'dela cruz', '', 'Male', '2024-07-04T13:01', 'A+', '2', '2', '5', '5', 'Normal', 'Alive', '', 13, 74, 'sibalom', '', 13, 4, '1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `baby_imm`
--

CREATE TABLE `baby_imm` (
  `baby_imm_id` int(11) NOT NULL,
  `vaccine_date` varchar(100) NOT NULL,
  `when_return` varchar(100) NOT NULL,
  `baby_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `sms_sent` enum('false','true') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baby_imm`
--

INSERT INTO `baby_imm` (`baby_imm_id`, `vaccine_date`, `when_return`, `baby_id`, `history_id`, `sms_sent`) VALUES
(1, '2024-05-21', '2024-05-22', 1, 4, 'false'),
(2, '2024-06-30', '2024-07-01', 5, 32, 'false'),
(3, '2024-06-30', '2024-07-01', 5, 33, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `center`
--

CREATE TABLE `center` (
  `center_id` int(11) NOT NULL,
  `center_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `center`
--

INSERT INTO `center` (`center_id`, `center_name`) VALUES
(1, ''),
(4, 'Sibalom Health Center'),
(5, 'San Jose Health Center'),
(6, 'San Remegio Health Center'),
(7, 'belison health center'),
(8, 'Angel Salazar Memorial Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `checkup`
--

CREATE TABLE `checkup` (
  `checkup_id` int(11) NOT NULL,
  `checkup_date` date NOT NULL,
  `age` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `bmi` varchar(100) NOT NULL,
  `last_menstrual` varchar(100) NOT NULL,
  `expected_delivery` varchar(100) NOT NULL,
  `maternal_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkup`
--

INSERT INTO `checkup` (`checkup_id`, `checkup_date`, `age`, `weight`, `height`, `bmi`, `last_menstrual`, `expected_delivery`, `maternal_id`, `history_id`) VALUES
(1, '2024-05-21', '44', '30kg', '153cm', '32', '2024-05-21', '2024-05-21', 1, 1),
(2, '2024-05-21', '44', '32', '23', '23', '2024-05-21', '2024-05-21', 2, 8),
(3, '2024-05-21', '44', '43', '434', '434', '2024-05-21', '2024-05-21', 3, 10),
(4, '2024-06-24', '0', 'fd', 'fd', 'fdf', '2024-06-24', '2024-06-24', 4, 14),
(5, '2024-06-24', '5', '12', '12', '12', '2024-06-24', '2024-06-24', 5, 16),
(6, '2024-06-25', '0', '123', '123', '12', '2024-06-25', '2024-06-25', 6, 17),
(7, '2024-06-26', '0', '1322', '23', '213', '2024-06-26', '2024-06-26', 7, 19),
(8, '2024-06-26', '0', '54', '145', 'none', '2024-05-26', '2024-06-26', 8, 20),
(9, '2024-07-01', '0', '22', '32', '23', '2024-07-01', '2024-07-01', 9, 22),
(10, '2024-07-01', '0', '123', '12', '67', '2024-06-30', '2024-08-09', 10, 24),
(11, '2024-07-01', '0', '23', '234', '34', '2024-03-05', '2025-06-19', 11, 26),
(12, '2024-07-02', '0', '53', '1.60', '20.70', '2024-06-30', '2024-07-02', 12, 37),
(13, '2024-07-02', '0', '34', '45', '0.02', '2024-06-30', '2024-07-02', 13, 38),
(14, '2024-07-02', '0', '45', '2', '11.25', '2024-07-02', '2024-07-02', 14, 41),
(15, '2024-07-02', '0', '345', '67', '0.08', '2024-06-30', '2024-07-02', 15, 42),
(16, '2024-07-02', '0', '60', '25', '0.10', '2024-07-01', '2024-07-31', 16, 44),
(17, '2024-07-02', '0', '6464', '51', '2.49', '2024-07-17', '2024-07-19', 17, 46),
(18, '2024-07-02', '0', '12', '45', '0.01', '2024-07-02', '2024-07-02', 18, 47),
(19, '2024-07-02', '0', '12', '15', '0.05', '2024-07-14', '2024-07-02', 19, 49),
(20, '2024-07-02', '0', '12', '15', '0.05', '2024-07-02', '2024-07-02', 20, 59),
(21, '2024-07-02', '0', '12', '15', '0.05', '2024-07-02', '2024-07-02', 21, 61),
(22, '2024-07-02', '0', '53', '11', '0.44', '2024-07-26', '2024-07-24', 22, 62),
(23, '2024-07-02', '0', '124', '34', '0.11', '2024-01-26', '2024-07-02', 23, 63),
(24, '2024-07-02', '0', '2345', '32', '2.29', '2024-03-05', '2024-07-19', 24, 65),
(25, '2024-07-02', '0', '25253', '24', '43.84', '2024-07-01', '2024-07-03', 25, 67),
(26, '2024-07-03', '0', '75', '22', '0.15', '2024-07-10', '2024-07-01', 26, 69),
(27, '2024-07-04', '0', '50', '2', '12.50', '2024-06-01', '2025-03-01', 27, 73),
(28, '2024-07-04', '0', '50', '2', '12.50', '2024-06-25', '2025-03-04', 28, 75);

-- --------------------------------------------------------

--
-- Table structure for table `developmental`
--

CREATE TABLE `developmental` (
  `developmental_id` int(11) NOT NULL,
  `date_achievement` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `baby_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `developmental`
--

INSERT INTO `developmental` (`developmental_id`, `date_achievement`, `description`, `baby_id`, `history_id`) VALUES
(1, '2024-05-21', 'walking', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `father`
--

CREATE TABLE `father` (
  `father_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension_name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `father`
--

INSERT INTO `father` (`father_id`, `first_name`, `middle_name`, `last_name`, `extension_name`, `contact`, `address`) VALUES
(1, 'Rico', '', 'Mendula', 'Jr.', '', ''),
(2, '', '', '', '', '', ''),
(3, 'fdf', 'df', 'fd', '', '', ''),
(4, 'carlo', 'josh', 'dsgdrg', '', '57645345345', 'sibalom'),
(5, 'kil', 'vd', 'sdgfd', '', '34535232', 'sibalom'),
(6, '', '', '', '', '', ''),
(7, '', '', '', '', '', ''),
(8, '', '', '', '', '', ''),
(9, '', '', '', '', '0000000000', 'Sibalom'),
(10, '', '', '', '', '', ''),
(11, '', '', '', '', '', ''),
(12, '', '', '', '', '', ''),
(13, '', '', '', '', '09123456789', 'sibalom');

-- --------------------------------------------------------

--
-- Table structure for table `first_trimester`
--

CREATE TABLE `first_trimester` (
  `first_trimester_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `weight` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `age_gestation` varchar(100) NOT NULL,
  `blood_pressure` varchar(100) NOT NULL,
  `nutritional` varchar(100) NOT NULL,
  `pagbuo` varchar(100) NOT NULL,
  `pagsusuri` varchar(100) NOT NULL,
  `laboratory` varchar(500) NOT NULL,
  `hemoglobin` varchar(100) NOT NULL,
  `urinalysis` varchar(100) NOT NULL,
  `cbc` varchar(100) NOT NULL,
  `sti` varchar(100) NOT NULL,
  `stool` varchar(100) NOT NULL,
  `acetic` varchar(100) NOT NULL,
  `tetanus` varchar(100) NOT NULL,
  `treatments` varchar(500) NOT NULL,
  `pinag_usapan` varchar(500) NOT NULL,
  `date_return` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `maternal_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `sms_sent` enum('false','true') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_trimester`
--

INSERT INTO `first_trimester` (`first_trimester_id`, `date`, `weight`, `height`, `age_gestation`, `blood_pressure`, `nutritional`, `pagbuo`, `pagsusuri`, `laboratory`, `hemoglobin`, `urinalysis`, `cbc`, `sti`, `stool`, `acetic`, `tetanus`, `treatments`, `pinag_usapan`, `date_return`, `remarks`, `maternal_id`, `history_id`, `sms_sent`) VALUES
(1, '2024-05-21', '30kg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-05-22', '', 1, 2, 'false'),
(2, '2024-06-20', '12', '1el1', '12', '100', 'Normal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 12, 'false'),
(3, '2024-06-24', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 15, 'false'),
(4, '2024-06-25', '12', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 6, 18, 'false'),
(5, '2024-06-26', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Bacteriuria', '', '', '', 7, 21, 'false'),
(6, '2024-07-01', '34', '23', '1', '34', 'Normal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 11, 27, 'false'),
(7, '2024-07-01', '3456', '123', '24', '345', 'Normal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 11, 28, 'false'),
(8, '2024-07-02', '434', '4343', '43434', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 13, 40, 'true'),
(9, '2024-07-02', '12', '23', '', '124', 'Normal', '', '', '', '', '', '', 'Syphilis', '', '', '', '', '', '', 'Died', 19, 50, 'true'),
(10, '2024-07-02', '', '', 'NaN weeks and NaN days', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Killed', 17, 54, 'true'),
(11, '2024-07-02', '32', '32', '22 weeks and 6 days', '23', 'Normal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 23, 64, 'true'),
(12, '2024-07-02', '25', '52', '0 weeks and 2 days', '32', 'Normal', 'djsjejs', 'shash', 'esghs', 'sdhs', 'seg', 'dfhszh', 'Syphilis', 'dj', 'xfnz', 'rsdznd', 'Syphilis', 'dxd', '2024-07-31', 'skgkggi', 25, 68, 'true'),
(13, '2024-07-03', '', '', '1 weeks and 0 days', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'accident', 26, 70, 'true'),
(14, '2024-07-04', '50', '5\'5', '1 weeks and 4 days', '120/90', 'Normal', '', '', '', '', '', '', '', '', '', '', '', '', '2024-07-11', '', 28, 76, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `growth`
--

CREATE TABLE `growth` (
  `growth_id` int(11) NOT NULL,
  `date_measurement` date NOT NULL,
  `weight` varchar(100) NOT NULL,
  `length` varchar(100) NOT NULL,
  `baby_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `growth`
--

INSERT INTO `growth` (`growth_id`, `date_measurement`, `weight`, `length`, `baby_id`, `history_id`) VALUES
(1, '2024-05-21', '23', '23', 1, 6),
(2, '2024-07-03', '45', '34', 12, 71),
(3, '2024-07-03', '34', '56', 12, 72);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `description`, `datetime`, `user_id`) VALUES
(1, 'Added', '2024-05-21 13:47:43', 8),
(2, 'Added', '2024-05-21 13:49:34', 8),
(3, 'Added', '2024-05-21 13:54:40', 8),
(4, 'Added', '2024-05-21 13:56:30', 8),
(5, 'Added', '2024-05-21 13:57:01', 8),
(6, 'Added', '2024-05-21 13:57:44', 8),
(7, 'Added', '2024-05-21 13:58:41', 8),
(8, 'Added', '2024-05-21 13:59:56', 8),
(9, 'Added', '2024-05-21 14:01:16', 8),
(10, 'Added', '2024-05-21 14:09:26', 9),
(11, 'Added', '2024-06-20 14:14:19', 8),
(12, 'Added', '2024-06-20 20:34:04', 8),
(13, 'Added', '2024-06-20 20:34:11', 8),
(14, 'Added', '2024-06-24 15:23:23', 8),
(15, 'Added', '2024-06-24 15:27:19', 8),
(16, 'Added', '2024-06-24 20:08:26', 8),
(17, 'Added', '2024-06-25 12:46:24', 8),
(18, 'Added', '2024-06-25 12:50:11', 8),
(19, 'Added', '2024-06-26 15:05:05', 8),
(20, 'Added', '2024-06-26 15:10:33', 8),
(21, 'Added', '2024-06-26 15:21:09', 8),
(22, 'Added', '2024-07-01 11:12:42', 8),
(23, 'Added', '2024-07-01 11:27:44', 8),
(24, 'Added', '2024-07-01 11:30:02', 8),
(25, 'Added', '2024-07-01 11:35:00', 8),
(26, 'Added', '2024-07-01 11:39:57', 8),
(27, 'Added', '2024-07-01 11:53:27', 8),
(28, 'Added', '2024-07-01 11:54:20', 8),
(29, 'Added', '2024-07-01 12:10:04', 8),
(30, 'Added', '2024-07-01 12:10:04', 8),
(31, 'Added', '2024-07-01 12:13:33', 8),
(32, 'Added', '2024-07-01 12:14:52', 8),
(33, 'Added', '2024-07-01 12:14:52', 8),
(34, 'Added', '2024-07-01 12:17:07', 8),
(35, 'Added', '2024-07-01 12:18:14', 8),
(36, 'Added', '2024-07-01 13:33:53', 8),
(37, 'Added', '2024-07-02 11:32:21', 8),
(38, 'Added', '2024-07-02 11:36:29', 8),
(39, 'Added', '2024-07-02 11:49:12', 8),
(40, 'Added', '2024-07-02 12:37:06', 8),
(41, 'Added', '2024-07-02 13:06:54', 8),
(42, 'Added', '2024-07-02 13:07:27', 8),
(43, 'Added', '2024-07-02 15:16:49', 8),
(44, 'Added', '2024-07-02 15:55:29', 8),
(45, 'Added', '2024-07-02 15:57:17', 8),
(46, 'Added', '2024-07-02 15:58:34', 8),
(47, 'Added', '2024-07-02 16:03:33', 8),
(48, 'Added', '2024-07-02 16:06:11', 8),
(49, 'Added', '2024-07-02 16:09:00', 8),
(50, 'Added', '2024-07-02 16:09:56', 8),
(51, 'Added', '2024-07-02 16:10:56', 8),
(52, 'Added', '2024-07-02 16:16:12', 8),
(53, 'Added', '2024-07-02 16:19:55', 8),
(54, 'Added', '2024-07-02 16:23:15', 8),
(55, 'Added', '2024-07-02 16:24:56', 8),
(56, 'Added', '2024-07-02 16:25:13', 8),
(57, 'Added', '2024-07-02 16:25:20', 8),
(58, 'Added', '2024-07-02 16:25:44', 8),
(59, 'Added', '2024-07-02 16:45:15', 8),
(60, 'Added', '2024-07-02 16:46:32', 8),
(61, 'Added', '2024-07-02 16:49:00', 8),
(62, 'Added', '2024-07-02 16:52:03', 8),
(63, 'Added', '2024-07-02 16:56:06', 8),
(64, 'Added', '2024-07-02 16:58:17', 8),
(65, 'Added', '2024-07-02 17:08:33', 8),
(66, 'Added', '2024-07-02 17:09:35', 8),
(67, 'Added', '2024-07-02 19:16:46', 6),
(68, 'Added', '2024-07-02 19:18:19', 6),
(69, 'Added', '2024-07-03 11:21:01', 8),
(70, 'Added', '2024-07-03 11:25:26', 8),
(71, 'Added', '2024-07-03 12:04:58', 8),
(72, 'Added', '2024-07-03 12:06:28', 8),
(73, 'Added', '2024-07-04 11:09:56', 8),
(74, 'Added', '2024-07-04 13:03:49', 8),
(75, 'Added', '2024-07-04 13:32:28', 13),
(76, 'Added', '2024-07-04 13:58:50', 13);

-- --------------------------------------------------------

--
-- Table structure for table `last_trimester`
--

CREATE TABLE `last_trimester` (
  `last_trimester_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `weight` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `age` int(100) NOT NULL,
  `blood_pressure` varchar(100) NOT NULL,
  `nutritional` varchar(100) NOT NULL,
  `buntis` varchar(100) NOT NULL,
  `payong` varchar(100) NOT NULL,
  `birthplan` varchar(100) NOT NULL,
  `ngipin` varchar(100) NOT NULL,
  `laboratory` varchar(500) NOT NULL,
  `urinalysis` varchar(100) NOT NULL,
  `cbc` varchar(100) NOT NULL,
  `bacteriuria` varchar(100) NOT NULL,
  `blood_rh` varchar(100) NOT NULL,
  `treatments` varchar(100) NOT NULL,
  `pinag_usapan` varchar(100) NOT NULL,
  `date_return` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `maternal_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `sms_sent` enum('false','true') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `last_trimester`
--

INSERT INTO `last_trimester` (`last_trimester_id`, `date`, `weight`, `height`, `age`, `blood_pressure`, `nutritional`, `buntis`, `payong`, `birthplan`, `ngipin`, `laboratory`, `urinalysis`, `cbc`, `bacteriuria`, `blood_rh`, `treatments`, `pinag_usapan`, `date_return`, `remarks`, `maternal_id`, `history_id`, `sms_sent`) VALUES
(1, '2024-07-01', '587', '889', 67, '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-07-01', '', 10, 35, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `maternal`
--

CREATE TABLE `maternal` (
  `maternal_id` int(11) NOT NULL,
  `patient_status` varchar(100) NOT NULL,
  `datetime_died` varchar(100) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maternal`
--

INSERT INTO `maternal` (`maternal_id`, `patient_status`, `datetime_died`, `patient_id`, `center_id`, `remarks`) VALUES
(1, 'Died', '2024-05-21T13:54', 1, 4, 'complications'),
(2, 'Died', '2024-05-21T14:00', 1, 4, 'none'),
(3, 'Alive', '', 1, 5, ''),
(4, 'Died', '2024-07-02T11:47', 5, 4, 'hfjhgmngkj'),
(5, 'Alive', '', 3, 4, ''),
(6, 'Alive', '', 7, 4, ''),
(7, 'Died', '', 9, 4, ''),
(8, 'Alive', '', 10, 4, ''),
(9, 'Alive', '', 11, 4, ''),
(10, 'Alive', '', 11, 4, ''),
(11, 'Alive', '', 11, 4, ''),
(12, 'Alive', '', 12, 4, ''),
(13, 'Alive', '', 8, 4, ''),
(14, 'Alive', '', 13, 4, ''),
(15, 'Alive', '', 13, 4, ''),
(16, 'Died', '', 14, 4, 'VJwbsb'),
(17, 'Alive', '', 14, 4, ''),
(18, 'Alive', '', 14, 4, ''),
(19, 'Died', '2024-07-02T16:14', 14, 4, 'Conflict illness'),
(20, 'Alive', '', 14, 4, ''),
(21, 'Alive', '', 15, 4, ''),
(22, 'Alive', '', 16, 4, ''),
(23, 'Alive', '', 16, 4, ''),
(24, 'Alive', '', 13, 4, ''),
(25, 'Alive', '', 14, 4, ''),
(26, 'Alive', '', 17, 4, ''),
(27, 'Alive', '', 8, 4, ''),
(28, 'Alive', '', 18, 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birth_date` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `blood_type` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `center_id` int(11) NOT NULL,
  `patient_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `first_name`, `middle_name`, `last_name`, `birth_date`, `address`, `occupation`, `blood_type`, `contact`, `email`, `center_id`, `patient_code`) VALUES
(1, 'Rica', '', 'Mendula', '1980-03-10', 'Sibalom, Antique', 'Housekeeping', 'O+', '09506758943', '', 4, '654960'),
(2, 'Joana', '', 'Grace', '1999-12-04', 'San Jose, Antique', 'Housekeeping', 'B-', '09554328798', '', 5, '746108'),
(3, 'Jocelyn', '', 'Hilado', '2019-03-04', 'District 1, sibalom', 'None', 'A+', '09771598041', '', 4, '118877'),
(4, 'marie', '', 'supat', '2024-05-08', 'bambang', 'housewife', 'AB+', '09926053523', '', 4, '948738'),
(5, 'Jane', '', 'Doe', '2024-06-24', 'Sibalom', 'N/A', 'B+', '09674438790', '', 4, '779137'),
(6, 'marie', '', 'aurelio', '2024-05-08', 'taguig', 'students', 'AB+', '0926484474', '', 4, '590450'),
(7, 'linda', '', 'linda', '2024-06-25', 'sibalom', 'none', '0-', '00000000000', '', 4, '765311'),
(8, '@$5gfdg', '', 'rwwe4', '2024-06-25', 'sibalom', 'none', 'A+', '00000000000', '', 4, '587062'),
(9, 'jucy', '', 'sedfe', '2024-06-26', 'sibalom', 'rfthr', 'A-', '00000000', '', 4, '243104'),
(10, 'mae', '', 'supat', '2024-06-26', 'carawisan 1', 'none', 'A+', '09926053523', '', 4, '778367'),
(11, 'joana', '', 'marie', '2024-07-01', 'sibalom', 'none', 'B-', '00000', '', 4, '440245'),
(12, 'jfaj', '', 'jun', '2024-07-02', 'sibalom', 'segsah', 'A+', '36436365', '', 4, '702123'),
(13, 'dgga', '', 'jojo', '2024-07-02', 'san jose', 's,hkvke', 'O+', '435636463', '', 4, '222835'),
(14, 'Jocel', '', 'La', '2024-07-02', 'Sibalom', 'None', 'B-', '00000000000', '', 4, '445371'),
(15, 'New', '', 'New', '2024-07-02', 'Sibalom', 'None', 'AB-', '00000000000', '', 4, '226456'),
(16, 'wew', '', 'wew', '2024-07-01', 'akugau', 'awgfkawugfi', 'AB-', '289562765', '', 4, '359572'),
(17, 'rose', '', 'marie', '2024-07-10', 'sibalom', 'none', 'A-', '00000000000', '', 4, '898372'),
(18, 'Jane', '', 'Smith', '2024-07-04', 'Sibalom', 'Tambay', 'A+', '09123456789', '', 8, '304114');

-- --------------------------------------------------------

--
-- Table structure for table `patient_history`
--

CREATE TABLE `patient_history` (
  `patient_history_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_history`
--

INSERT INTO `patient_history` (`patient_history_id`, `description`, `user_id`, `datetime`, `patient_id`) VALUES
(1, 'Added', 8, '2024-05-21 13:41:47', 1),
(2, 'Added', 9, '2024-05-21 13:42:42', 2),
(3, 'Added', 8, '2024-06-20 05:30:13', 3),
(4, 'Added', 8, '2024-06-20 20:22:32', 4),
(5, 'Added', 8, '2024-06-24 14:34:40', 5),
(6, 'Updated', 8, '2024-06-24 15:27:00', 5),
(7, 'Added', 8, '2024-06-24 15:47:17', 6),
(8, 'Added', 8, '2024-06-25 12:45:44', 7),
(9, 'Added', 8, '2024-06-25 13:12:37', 8),
(10, 'Added', 8, '2024-06-26 15:03:47', 9),
(11, 'Added', 8, '2024-06-26 15:06:38', 10),
(12, 'Updated', 8, '2024-06-26 15:30:38', 10),
(13, 'Added', 8, '2024-07-01 11:11:21', 11),
(14, 'Updated', 8, '2024-07-01 12:32:51', 11),
(15, 'Added', 8, '2024-07-02 10:49:12', 12),
(16, 'Added', 8, '2024-07-02 13:01:50', 13),
(17, 'Added', 8, '2024-07-02 15:54:31', 14),
(18, 'Added', 8, '2024-07-02 16:48:26', 15),
(19, 'Added', 8, '2024-07-02 16:50:32', 16),
(20, 'Added', 8, '2024-07-03 11:16:41', 17),
(21, 'Updated', 8, '2024-07-03 11:17:44', 17),
(22, 'Added', 13, '2024-07-04 13:28:35', 18);

-- --------------------------------------------------------

--
-- Table structure for table `patient_imm`
--

CREATE TABLE `patient_imm` (
  `patient_imm_id` int(11) NOT NULL,
  `date_given` varchar(100) NOT NULL,
  `when_return` varchar(100) NOT NULL,
  `maternal_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `sms_sent` enum('false','true') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_imm`
--

INSERT INTO `patient_imm` (`patient_imm_id`, `date_given`, `when_return`, `maternal_id`, `history_id`, `sms_sent`) VALUES
(1, '2024-05-21', '2024-05-22', 1, 7, 'false'),
(2, '2024-06-30', '2024-07-01', 11, 29, 'false'),
(3, '2024-07-08', '2024-07-09', 11, 30, 'false'),
(4, '2024-06-30', '2024-07-01', 10, 34, 'false'),
(5, '2024-06-30', '2024-07-02', 4, 36, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `allowed` enum('false','true') NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `see_sender` enum('false','true') NOT NULL,
  `see_receiver` enum('false','true') NOT NULL,
  `center_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `sender_id`, `patient_id`, `datetime`, `allowed`, `receiver_id`, `see_sender`, `see_receiver`, `center_id`) VALUES
(1, 9, 1, '2024-05-21 14:07:43', 'false', 6, 'true', 'true', 4),
(2, 8, 18, '2024-07-04 14:41:56', 'true', 12, 'false', 'true', 8);

-- --------------------------------------------------------

--
-- Table structure for table `second_trimester`
--

CREATE TABLE `second_trimester` (
  `second_trimester_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `blood_pressure` varchar(100) NOT NULL,
  `nutritional` varchar(100) NOT NULL,
  `buntis` varchar(100) NOT NULL,
  `payong` varchar(500) NOT NULL,
  `birthplan` varchar(500) NOT NULL,
  `ngipin` varchar(100) NOT NULL,
  `laboratory` varchar(500) NOT NULL,
  `urinalysis` varchar(100) NOT NULL,
  `cbc` varchar(100) NOT NULL,
  `etiologic` varchar(100) NOT NULL,
  `smear` varchar(100) NOT NULL,
  `diabetes` varchar(100) NOT NULL,
  `bacteriuria` varchar(100) NOT NULL,
  `treatments` varchar(100) NOT NULL,
  `pinag_usapan` varchar(100) NOT NULL,
  `date_return` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `maternal_id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `sms_sent` enum('false','true') NOT NULL,
  `weight` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `second_trimester`
--

INSERT INTO `second_trimester` (`second_trimester_id`, `date`, `blood_pressure`, `nutritional`, `buntis`, `payong`, `birthplan`, `ngipin`, `laboratory`, `urinalysis`, `cbc`, `etiologic`, `smear`, `diabetes`, `bacteriuria`, `treatments`, `pinag_usapan`, `date_return`, `remarks`, `maternal_id`, `history_id`, `sms_sent`, `weight`, `age`, `height`) VALUES
(1, '2024-07-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-07-01', '', 6, 31, 'false', '57', '4', '8'),
(2, '2024-07-02', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Died ', 19, 51, 'true', '', '', ''),
(3, '2024-07-02', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 24, 66, 'true', '34', '17 weeks and 2 days', '453');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `role` enum('Super','Admin','Staff') NOT NULL,
  `role_desc` varchar(100) NOT NULL,
  `center_id` int(11) NOT NULL,
  `user_token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `fullname`, `email`, `contact`, `role`, `role_desc`, `center_id`, `user_token`) VALUES
(1, 'super', '8451ba8a14d79753d34cb33b51ba46b4b025eb81', 'Super Administrator', '', '', 'Super', 'Super Administrator', 1, '8451ba8a14d79753d34cb33b51ba46b4b025eb81'),
(6, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Sibalom Administrator', '', '09706542123', 'Admin', 'Administrator', 4, 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(7, 'admin1', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 'San Jose Administrator', '', '09795643212', 'Admin', 'Administrator', 5, '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a'),
(8, 'staff', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', 'Sibalom Staff', '', '09875645342', 'Staff', 'Staff', 4, '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611'),
(9, 'staff1', 'cbb9d0bd363a429d6d4bb85cdf509ee9b53e69fd', 'San Jose Staff', '', '09706541243', 'Staff', 'Staff', 5, 'cbb9d0bd363a429d6d4bb85cdf509ee9b53e69fd'),
(10, 'm', '6b0d31c0d563223024da45691584643ac78c96e8', 'm', '', '0975357322', 'Admin', 'staff2', 6, '6b0d31c0d563223024da45691584643ac78c96e8'),
(11, 'admin3', '33aab3c7f01620cade108f488cfd285c0e62c1ec', 'admin3', '', '000000000', 'Admin', 'admin', 7, '33aab3c7f01620cade108f488cfd285c0e62c1ec'),
(12, 'user1', 'b3daa77b4c04a9551b8781d03191fe098f325e67', 'user user', 'user@gmail.com', '09123456789', 'Admin', 'Head Nurse', 8, 'b3daa77b4c04a9551b8781d03191fe098f325e67'),
(13, 'user2', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4', 'user 2', 'user2@gmail.com', '09123456789', 'Staff', 'Midwife', 8, 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baby`
--
ALTER TABLE `baby`
  ADD PRIMARY KEY (`baby_id`),
  ADD KEY `maternal_id` (`maternal_id`),
  ADD KEY `history_id` (`history_id`),
  ADD KEY `father_id` (`father_id`),
  ADD KEY `center_id` (`center_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `baby_imm`
--
ALTER TABLE `baby_imm`
  ADD PRIMARY KEY (`baby_imm_id`),
  ADD KEY `history_id` (`history_id`),
  ADD KEY `baby_id` (`baby_id`);

--
-- Indexes for table `center`
--
ALTER TABLE `center`
  ADD PRIMARY KEY (`center_id`);

--
-- Indexes for table `checkup`
--
ALTER TABLE `checkup`
  ADD PRIMARY KEY (`checkup_id`),
  ADD KEY `maternal_id` (`maternal_id`),
  ADD KEY `history_id` (`history_id`);

--
-- Indexes for table `developmental`
--
ALTER TABLE `developmental`
  ADD PRIMARY KEY (`developmental_id`),
  ADD KEY `history_id` (`history_id`),
  ADD KEY `baby_id` (`baby_id`);

--
-- Indexes for table `father`
--
ALTER TABLE `father`
  ADD PRIMARY KEY (`father_id`);

--
-- Indexes for table `first_trimester`
--
ALTER TABLE `first_trimester`
  ADD PRIMARY KEY (`first_trimester_id`),
  ADD KEY `maternal_id` (`maternal_id`),
  ADD KEY `history_id` (`history_id`);

--
-- Indexes for table `growth`
--
ALTER TABLE `growth`
  ADD PRIMARY KEY (`growth_id`),
  ADD KEY `history_id` (`history_id`),
  ADD KEY `baby_id` (`baby_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `last_trimester`
--
ALTER TABLE `last_trimester`
  ADD PRIMARY KEY (`last_trimester_id`),
  ADD KEY `maternal_id` (`maternal_id`),
  ADD KEY `history_id` (`history_id`);

--
-- Indexes for table `maternal`
--
ALTER TABLE `maternal`
  ADD PRIMARY KEY (`maternal_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `patient_history`
--
ALTER TABLE `patient_history`
  ADD PRIMARY KEY (`patient_history_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `patient_imm`
--
ALTER TABLE `patient_imm`
  ADD PRIMARY KEY (`patient_imm_id`),
  ADD KEY `maternal_id` (`maternal_id`),
  ADD KEY `history_id` (`history_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `reciever_id` (`receiver_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `second_trimester`
--
ALTER TABLE `second_trimester`
  ADD PRIMARY KEY (`second_trimester_id`),
  ADD KEY `maternal_id` (`maternal_id`),
  ADD KEY `history_id` (`history_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `center_id` (`center_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baby`
--
ALTER TABLE `baby`
  MODIFY `baby_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `baby_imm`
--
ALTER TABLE `baby_imm`
  MODIFY `baby_imm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `center`
--
ALTER TABLE `center`
  MODIFY `center_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `checkup`
--
ALTER TABLE `checkup`
  MODIFY `checkup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `developmental`
--
ALTER TABLE `developmental`
  MODIFY `developmental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `father`
--
ALTER TABLE `father`
  MODIFY `father_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `first_trimester`
--
ALTER TABLE `first_trimester`
  MODIFY `first_trimester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `growth`
--
ALTER TABLE `growth`
  MODIFY `growth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `last_trimester`
--
ALTER TABLE `last_trimester`
  MODIFY `last_trimester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maternal`
--
ALTER TABLE `maternal`
  MODIFY `maternal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `patient_history`
--
ALTER TABLE `patient_history`
  MODIFY `patient_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patient_imm`
--
ALTER TABLE `patient_imm`
  MODIFY `patient_imm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `second_trimester`
--
ALTER TABLE `second_trimester`
  MODIFY `second_trimester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baby`
--
ALTER TABLE `baby`
  ADD CONSTRAINT `baby_ibfk_1` FOREIGN KEY (`maternal_id`) REFERENCES `maternal` (`maternal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `baby_ibfk_2` FOREIGN KEY (`history_id`) REFERENCES `history` (`history_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `baby_ibfk_3` FOREIGN KEY (`father_id`) REFERENCES `father` (`father_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `baby_ibfk_4` FOREIGN KEY (`center_id`) REFERENCES `center` (`center_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `baby_ibfk_5` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `baby_imm`
--
ALTER TABLE `baby_imm`
  ADD CONSTRAINT `baby_imm_ibfk_1` FOREIGN KEY (`history_id`) REFERENCES `history` (`history_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `baby_imm_ibfk_2` FOREIGN KEY (`baby_id`) REFERENCES `baby` (`baby_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `checkup`
--
ALTER TABLE `checkup`
  ADD CONSTRAINT `checkup_ibfk_1` FOREIGN KEY (`maternal_id`) REFERENCES `maternal` (`maternal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkup_ibfk_2` FOREIGN KEY (`history_id`) REFERENCES `history` (`history_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `developmental`
--
ALTER TABLE `developmental`
  ADD CONSTRAINT `developmental_ibfk_1` FOREIGN KEY (`history_id`) REFERENCES `history` (`history_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `developmental_ibfk_2` FOREIGN KEY (`baby_id`) REFERENCES `baby` (`baby_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `first_trimester`
--
ALTER TABLE `first_trimester`
  ADD CONSTRAINT `first_trimester_ibfk_1` FOREIGN KEY (`maternal_id`) REFERENCES `maternal` (`maternal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `first_trimester_ibfk_2` FOREIGN KEY (`history_id`) REFERENCES `history` (`history_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `growth`
--
ALTER TABLE `growth`
  ADD CONSTRAINT `growth_ibfk_1` FOREIGN KEY (`history_id`) REFERENCES `history` (`history_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `growth_ibfk_2` FOREIGN KEY (`baby_id`) REFERENCES `baby` (`baby_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `last_trimester`
--
ALTER TABLE `last_trimester`
  ADD CONSTRAINT `last_trimester_ibfk_1` FOREIGN KEY (`maternal_id`) REFERENCES `maternal` (`maternal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `last_trimester_ibfk_2` FOREIGN KEY (`history_id`) REFERENCES `history` (`history_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maternal`
--
ALTER TABLE `maternal`
  ADD CONSTRAINT `maternal_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maternal_ibfk_2` FOREIGN KEY (`center_id`) REFERENCES `center` (`center_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `center` (`center_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_history`
--
ALTER TABLE `patient_history`
  ADD CONSTRAINT `patient_history_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_imm`
--
ALTER TABLE `patient_imm`
  ADD CONSTRAINT `patient_imm_ibfk_1` FOREIGN KEY (`maternal_id`) REFERENCES `maternal` (`maternal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_imm_ibfk_2` FOREIGN KEY (`history_id`) REFERENCES `history` (`history_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_4` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_5` FOREIGN KEY (`center_id`) REFERENCES `center` (`center_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `second_trimester`
--
ALTER TABLE `second_trimester`
  ADD CONSTRAINT `second_trimester_ibfk_1` FOREIGN KEY (`maternal_id`) REFERENCES `maternal` (`maternal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `second_trimester_ibfk_2` FOREIGN KEY (`history_id`) REFERENCES `history` (`history_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `center` (`center_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
