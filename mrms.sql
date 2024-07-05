-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 08:58 AM
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
-- Database: `mrms`
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
(3, 'B3', '', 'Mendula', '', 'Male', '2024-05-21T14:01', 'B-', '32', '32', '32', '32', 'Normal', 'Alive', '', 2, 9, 'Sibalom, Antique', '', 2, 4, '3', 1);

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
(1, '2024-05-21', '2024-05-22', 1, 4, 'false');

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
(5, 'San Jose Health Center');

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
(3, '2024-05-21', '44', '43', '434', '434', '2024-05-21', '2024-05-21', 3, 10);

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
(2, '', '', '', '', '', '');

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
(1, '2024-05-21', '30kg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-05-22', '', 1, 2, 'false');

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
(1, '2024-05-21', '23', '23', 1, 6);

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
(10, 'Added', '2024-05-21 14:09:26', 9);

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
(3, 'Alive', '', 1, 5, '');

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
(2, 'Joana', '', 'Grace', '1999-12-04', 'San Jose, Antique', 'Housekeeping', 'B-', '09554328798', '', 5, '746108');

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
(2, 'Added', 9, '2024-05-21 13:42:42', 2);

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
(1, '2024-05-21', '2024-05-22', 1, 7, 'false');

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
(1, 9, 1, '2024-05-21 14:07:43', 'false', 6, 'true', 'true', 4);

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
(9, 'staff1', 'cbb9d0bd363a429d6d4bb85cdf509ee9b53e69fd', 'San Jose Staff', '', '09706541243', 'Staff', 'Staff', 5, 'cbb9d0bd363a429d6d4bb85cdf509ee9b53e69fd');

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
  MODIFY `baby_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `baby_imm`
--
ALTER TABLE `baby_imm`
  MODIFY `baby_imm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `center`
--
ALTER TABLE `center`
  MODIFY `center_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `checkup`
--
ALTER TABLE `checkup`
  MODIFY `checkup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `developmental`
--
ALTER TABLE `developmental`
  MODIFY `developmental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `father`
--
ALTER TABLE `father`
  MODIFY `father_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `first_trimester`
--
ALTER TABLE `first_trimester`
  MODIFY `first_trimester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `growth`
--
ALTER TABLE `growth`
  MODIFY `growth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `last_trimester`
--
ALTER TABLE `last_trimester`
  MODIFY `last_trimester_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maternal`
--
ALTER TABLE `maternal`
  MODIFY `maternal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_history`
--
ALTER TABLE `patient_history`
  MODIFY `patient_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_imm`
--
ALTER TABLE `patient_imm`
  MODIFY `patient_imm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `second_trimester`
--
ALTER TABLE `second_trimester`
  MODIFY `second_trimester_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
