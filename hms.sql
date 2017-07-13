-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2017 at 03:14 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(3) NOT NULL,
  `patientId` varchar(11) NOT NULL,
  `doctorId` varchar(11) NOT NULL,
  `appointment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(15) NOT NULL DEFAULT 'Unconfirmed',
  `completed_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patientId`, `doctorId`, `appointment_date`, `status`, `completed_date`) VALUES
(3, 'PAT/17-001', 'DOC/17-001', '2017-05-17 19:43:27', 'Confirmed', NULL),
(4, 'PAT/17-001', 'SPE/17-001', '2017-05-17 19:46:06', 'Confirmed', NULL),
(5, 'PAT/17-007', 'DOC/17-002', '2017-07-03 07:45:32', 'Confirmed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `id` int(3) NOT NULL,
  `appointment_id` int(3) NOT NULL,
  `patientId` varchar(10) NOT NULL,
  `doctorId` varchar(10) NOT NULL,
  `ailmentName` varchar(20) DEFAULT NULL,
  `ailmentDesc` text,
  `drugs_administered` text,
  `injections_administered` text,
  `status` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`id`, `appointment_id`, `patientId`, `doctorId`, `ailmentName`, `ailmentDesc`, `drugs_administered`, `injections_administered`, `status`, `created_at`) VALUES
(4, 3, 'PAT/17-001', 'DOC/17-001', NULL, NULL, NULL, NULL, NULL, '2017-05-23 11:50:31'),
(5, 4, 'PAT/17-001', 'SPE/17-001', NULL, NULL, NULL, NULL, NULL, '2017-05-23 11:50:31'),
(6, 5, 'PAT/17-007', 'DOC/17-002', NULL, NULL, NULL, NULL, NULL, '2017-07-03 07:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(3) NOT NULL,
  `doctorId` varchar(15) NOT NULL,
  `surname` varchar(15) NOT NULL,
  `otherNames` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `lastAppointment` timestamp NULL DEFAULT NULL,
  `daysAvailable` json DEFAULT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `doctorId`, `surname`, `otherNames`, `gender`, `address`, `phoneNumber`, `email`, `lastAppointment`, `daysAvailable`, `status`) VALUES
(1, 'DOC/17-001', 'Odey', 'Gold', 'male', 'Golden Zone', '08183659972', 'gold@gmail.com', '2017-05-17 19:40:56', '["Tuesday", "Saturday"]', 'Unavailable'),
(2, 'DOC/17-002', 'Ade', 'Ayo', '', '', '09012937218', 'ayo@gmail.com', '2017-07-03 07:42:08', '["Monday", "Friday"]', 'Available'),
(5, 'DOC/17-003', 'Garba', 'Tolu', '', '', '09012937218', 'tolu@gmail.com', NULL, NULL, 'Unavailable'),
(6, 'DOC/17-006', 'Jb', 'Qui', 'male', 'Sanrab', '08108182081', 'jb@gmail.com', NULL, '["Sunday", "Monday"]', 'Available'),
(7, 'DOC/17-007', 'White', 'Enny', 'male', 'walker zone', '011000098', 'white@enny.com', NULL, NULL, 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(3) NOT NULL,
  `patientId` varchar(10) NOT NULL,
  `surname` varchar(15) NOT NULL,
  `otherNames` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` text NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `appointments` int(3) NOT NULL DEFAULT '2',
  `lastAppointment` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patientId`, `surname`, `otherNames`, `gender`, `date_of_birth`, `address`, `phoneNumber`, `email`, `appointments`, `lastAppointment`) VALUES
(7, 'PAT/17-007', 'Garuba', 'Vic', 'male', '0000-00-00', 'Tanke', '0818365997', 'garubav@gmail.com', 1, '2017-07-03 07:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `pending_registration`
--

CREATE TABLE `pending_registration` (
  `id` int(11) NOT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `otherNames` varchar(30) DEFAULT NULL,
  `specialization` text,
  `gender` varchar(15) DEFAULT NULL,
  `address` text,
  `phoneNumber` varchar(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `daysAvailable` json DEFAULT NULL,
  `maxPatients` int(3) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_registration`
--

INSERT INTO `pending_registration` (`id`, `surname`, `otherNames`, `specialization`, `gender`, `address`, `phoneNumber`, `date_of_birth`, `email`, `daysAvailable`, `maxPatients`, `type`) VALUES
(2, 'Garuba', 'aaaa', NULL, 'Male', 'Tesss', '08183659972', NULL, 'Garuba@gmail.com', NULL, 10, 'specialist'),
(3, 'Test', 'Testing1', NULL, 'Male', 'Tanke', '08183659972', NULL, 'test@gmail.com', '["Sunday"]', NULL, 'doctor'),
(4, 'Vic', 'Oth', NULL, 'Female', 'Sanrab', '08183659972', '1992-02-12', 'gaa@aa.co', NULL, NULL, 'patient'),
(5, 'Grey', 'Drey', NULL, 'Male', 'The grey mansion', '+101010101', NULL, 'greydrey@gmail.com', '["Thursday"]', NULL, 'doctor'),
(6, 'Grey', 'Drey', NULL, 'Male', 'The grey mansion', '+101010101', NULL, 'greydrey@gmail.com', '["Thursday"]', NULL, 'doctor'),
(7, 'Weir', 'Silas', NULL, 'Male', 'Weir Street', '0000111100', '2017-07-03', 'weir@silas.com', NULL, NULL, 'patient'),
(8, 'White', 'Grey', NULL, 'Female', 'White Grey', '07064977388', '1994-02-01', 'lemygold@gmail.com', NULL, NULL, 'patient'),
(11, 'Philemon', 'Rose', 'Surgeon', 'Female', 'rose street', '+1889756', NULL, 'phyrose@gmail.com', NULL, 4, 'specialist');

-- --------------------------------------------------------

--
-- Table structure for table `specialists`
--

CREATE TABLE `specialists` (
  `id` int(11) NOT NULL,
  `specialistId` varchar(10) NOT NULL,
  `specialization` text,
  `surname` varchar(15) NOT NULL,
  `otherNames` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `appointments` int(3) NOT NULL DEFAULT '2',
  `maxPatients` int(3) NOT NULL,
  `currentPatients` int(3) NOT NULL DEFAULT '0',
  `lastAppointment` timestamp NULL DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Unavailable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialists`
--

INSERT INTO `specialists` (`id`, `specialistId`, `specialization`, `surname`, `otherNames`, `gender`, `address`, `phoneNumber`, `email`, `appointments`, `maxPatients`, `currentPatients`, `lastAppointment`, `status`) VALUES
(1, 'SPE/17-001', '', 'Oyeniran', 'Tunji', '', '', '08108182081', 'tunji@gmail.com', 2, 2, 1, '2017-05-17 19:45:16', 'Unavailable'),
(2, 'SPE/17-002', '', 'Garuba', 'Bless', 'female', 'Balogun Village, Tanke Oke-Odo', '09012937218', 'bless@ymail.com', 2, 10, 0, NULL, 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`, `created_at`) VALUES
(1, 'superuser', '$2y$10$d/7/ZrswVAZqPBXIrIZTweeYArwJi9t8q9y3NMsEdNQLDGjTfy7Pi', 'admin', '2017-05-16 20:13:49'),
(2, 'Odey', '$2y$10$3ZdaWX6x3a4pPV9tMRDXc.QgBB0zdMcu3MJRysDx8kgooUOtMmevS', 'doctor', '2017-05-16 20:13:49'),
(3, 'SPE/17-001', '$2y$10$MFT1r/zB1HBem2IHQU/su.j1LWNrifsA.J73Y3WRIkY3h/9l8A5sG', 'specialist', '2017-05-16 20:13:49'),
(5, 'DOC/17-002', '$2y$10$MgkiKQuwhbOBurkR9FEsqOlgOOWiAn0.i.6TEBggY.0dxDgR0c1e.', 'doctor', '2017-05-17 12:14:04'),
(8, 'DOC/17-003', '$2y$10$gN8xqZmdKL3njt9FcKGgzuAIrSaZ4xhzuULyeNDwsCQ9DTEmRK//K', 'doctor', '2017-05-17 12:35:31'),
(9, 'DOC/17-003', '$2y$10$8wWk3nosYodPFd3aAPMhZuRQXTJ.gRPgbFqyNIAD0cYxjL1I22GW2', 'doctor', '2017-05-17 12:37:27'),
(10, 'DOC/17-003', '$2y$10$w3C0.d64Bx0nocj9ZIyPFO9XznkfhurH34Ns5m2FYRtcmTHP2Xy1q', 'doctor', '2017-05-17 12:40:44'),
(11, 'DOC/17-003', '$2y$10$gUk0wNzt6hgVtko2tNRuL.MJmdykxYujvTyzCo99Tucz7DtNURGQu', 'doctor', '2017-05-17 12:44:09'),
(17, 'PAT/17-001', '$2y$10$.YBYO3N8IaJ.D.02sr9.puIKuoyL4vnCGxO5kI.yart99GM1/RJha', 'patient', '2017-05-29 12:38:06'),
(18, 'PAT/17-002', '$2y$10$ZUNY2aH6/99k/OlVZlpodO.OOmNppYQd7DMWvWxhZr408buWN7M7q', 'patient', '2017-05-29 12:41:44'),
(19, 'PAT/17-003', '$2y$10$AGz.rD9q300382HVC9pujuxhql9mtOePE3ogrlpUOOplu7HFT.IEK', 'patient', '2017-05-29 12:57:49'),
(20, 'PAT/17-004', '$2y$10$.TKpyhOOOoBaJJgBFP3UGe4dQH.M2AsnkMyP7qQm1myPvPvEnj7WO', 'patient', '2017-05-29 12:58:50'),
(21, 'PAT/17-005', '$2y$10$jiwW5ksDU8N/icUiJ/KLQOUViEnKVJhBiUNknX2fAaRoQucF3mfpq', 'patient', '2017-05-29 13:00:19'),
(22, 'PAT/17-006', '$2y$10$RMCBw0OK8WUyfvZjbpFqGuS27JodZ0LpSx4liMrNWhi501fDWQVym', 'patient', '2017-05-29 13:04:23'),
(23, 'PAT/17-007', '$2y$10$j2tODF0IpeKZCnWnofVdQ.U641UGX6oeoL03kmGUy6f8.OJoxOxLy', 'patient', '2017-05-29 13:06:27'),
(24, 'DOC/17-006', '$2y$10$eCab8UwAJ2hWGSifco1OdOSkZQOPmYNmPkCVpCf7jBztz12smv1iu', 'doctor', '2017-05-29 13:11:22'),
(25, 'DOC/17-006', '$2y$10$LzfTqfxClWkSLhVPeqnwDu3XZjkeOdtdMHdHmJ./ELm.dcB4.tSLi', 'doctor', '2017-05-29 13:20:08'),
(26, 'DOC/17-006', '$2y$10$84Wca6uBkq6kPe1Za3EMRe6cSYg3HUffZh289F30Wz7S.GMPNCT.q', 'doctor', '2017-05-29 13:21:40'),
(27, 'DOC/17-006', '$2y$10$z3gwxmyDXtAnnEcZaTL8F.8U.pcrmLRHXHTUjyZO5AfZTo7gxazz6', 'doctor', '2017-05-29 13:23:22'),
(28, 'DOC/17-006', '$2y$10$tYXe6W1cMx88IH2X/.0fz.5gCLMLV9xvU84wOVbGQlC2O1LhGIhuS', 'doctor', '2017-05-29 13:24:50'),
(29, 'DOC/17-006', '$2y$10$MI.76E.q3yZeCVKXGX0RH.A.aArkSKVsB8KoQyf1fE4T8zEqZC6h.', 'doctor', '2017-05-29 13:28:30'),
(30, 'DOC/17-006', '$2y$10$AFV//1kNNwu/LllVgJWb/OTxcysi1fSE56EAjvSA2cBgrldwR67y.', 'doctor', '2017-05-29 13:28:39'),
(32, 'root', '$2y$10$TEW7fGTJfRAdZcKmC2xkk.7v22/yzNcJpD.cuYbIjaKBMPx6oJGUS', 'admin', '2017-05-29 13:31:30'),
(33, 'SPE/17-002', '$2y$10$VW5VDHbPqFTUTkjx95LWauz3OxV4NJCqHQe4pK7Oy4VcVjWM70ZrW', 'specialist', '2017-05-29 13:37:56'),
(34, 'DOC/17-007', '$2y$10$hDJ4YBke0xLA1kKvaNQXIeKf6QKzH0FctsGPBbID6Z5VFwYZRnyp6', 'doctor', '2017-07-03 07:08:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `pending_registration`
--
ALTER TABLE `pending_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialists`
--
ALTER TABLE `specialists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialistId` (`specialistId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pending_registration`
--
ALTER TABLE `pending_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `specialists`
--
ALTER TABLE `specialists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
