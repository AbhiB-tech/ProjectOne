-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 06, 2024 at 06:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtrp`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood`
--

CREATE TABLE `blood` (
  `Blood_Group` varchar(255) NOT NULL,
  `units` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood`
--

INSERT INTO `blood` (`Blood_Group`, `units`) VALUES
('A+', 4468),
('A-', 2545),
('AB+', 2479),
('AB-', 6959),
('ApprovedRequests', 25),
('B+', 6183),
('B-', 9400),
('O+', 3546),
('O-', 6577),
('TotalBlood', 42157),
('TotalDonors', 16),
('TotalRequests', 45);

-- --------------------------------------------------------

--
-- Table structure for table `donationshistory`
--

CREATE TABLE `donationshistory` (
  `id` int(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `diseases` varchar(255) NOT NULL DEFAULT 'Nothing',
  `units` int(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donationshistory`
--

INSERT INTO `donationshistory` (`id`, `blood_group`, `diseases`, `units`, `date`, `status`) VALUES
(10, 'AB+', 'Nothing', 100, '2024-07-01 19:25:59', 'Rejected'),
(10, 'AB-', 'Nothing', 190, '2024-07-01 20:37:28', 'Approved'),
(10, 'AB-', 'Nothing', 23, '2024-07-02 03:16:20', 'Approved'),
(10, 'AB-', 'Nothing', 24, '2024-07-02 03:16:37', 'Approved'),
(21, 'O+', 'Nothing', 90, '2024-07-02 03:31:06', 'Rejected'),
(21, 'O+', 'Nothing', 89, '2024-07-02 03:31:16', 'Approved'),
(23, 'AB+', 'Nothing', 100, '2024-07-04 15:09:25', 'Rejected'),
(23, 'AB+', 'fever', 200, '2024-07-04 15:18:09', 'Approved'),
(21, 'O+', 'Nothing', 897, '2024-07-05 18:17:31', 'Approved'),
(26, 'O-', 'Nothing', 236, '2024-07-06 00:44:44', 'Approved'),
(26, 'O-', 'Nothing', 864, '2024-07-06 00:44:52', 'Approved'),
(26, 'O-', 'Nothing', 561, '2024-07-06 00:44:57', 'Approved'),
(26, 'O-', 'Nothing', 500, '2024-07-06 00:54:47', 'Approved'),
(26, 'O-', 'Nothing', 700, '2024-07-06 00:54:51', 'Pending'),
(26, 'O-', 'Nothing', 1000, '2024-07-06 00:54:56', 'Approved'),
(26, 'O-', 'Nothing', 600, '2024-07-06 00:55:01', 'Pending'),
(29, 'O+', 'Nothing', 1554, '2024-07-06 01:13:10', 'Approved'),
(29, 'O+', 'Nothing', 622, '2024-07-06 01:13:17', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(255) NOT NULL,
  `ApprovedRequests` int(255) DEFAULT 0,
  `PendingRequests` int(255) DEFAULT 0,
  `RequestsMade` int(255) DEFAULT 0,
  `RejectedRequests` int(255) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `ApprovedRequests`, `PendingRequests`, `RequestsMade`, `RejectedRequests`) VALUES
(22, 1, 0, 1, 0),
(10, 3, 0, 4, 1),
(9, 2, 12, 14, 0),
(23, 3, 0, 4, 1),
(24, 0, 0, 0, 0),
(25, 0, 0, 0, 0),
(26, 5, 2, 7, 0),
(27, 0, 0, 0, 0),
(28, 0, 0, 0, 0),
(29, 2, 0, 2, 0),
(15, 0, 0, 0, 0),
(17, 0, 0, 0, 0),
(18, 0, 0, 0, 0),
(20, 0, 0, 0, 0),
(21, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `requestshistory`
--

CREATE TABLE `requestshistory` (
  `id` int(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `diseases` varchar(255) NOT NULL,
  `units` int(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requestshistory`
--

INSERT INTO `requestshistory` (`id`, `blood_group`, `diseases`, `units`, `date`, `status`) VALUES
(9, 'B-', '', 500, '2024-07-01 11:40:45', 'Rejected'),
(10, 'A-', '', 500, '2024-07-01 11:40:45', 'Rejected'),
(9, 'AB-', '', 500, '2024-07-01 12:18:07', 'Approved'),
(9, 'A+', 'Nothing', 1000, '2024-07-01 19:01:33', 'Approved'),
(21, 'O-', 'Nothing', 100, '2024-07-01 23:19:04', 'Approved'),
(21, 'O-', 'Nothing', 500, '2024-07-01 23:23:15', 'Approved'),
(21, 'O-', 'Nothing', 500, '2024-07-01 23:25:46', 'Approved'),
(21, 'O-', 'Nothing', 500, '2024-07-01 23:25:51', 'Approved'),
(22, 'AB+', 'Nothing', 500, '2024-07-01 23:33:24', 'Approved'),
(9, 'B-', 'Nothing', 100, '2024-07-02 03:01:07', 'Approved'),
(9, 'B-', 'Nothing', 200, '2024-07-02 04:01:08', 'Pending'),
(9, 'B-', 'Nothing', 300, '2024-07-02 04:01:15', 'Pending'),
(9, 'B-', 'Nothing', 351, '2024-07-02 04:01:24', 'Pending'),
(9, 'B-', 'Nothing', 123, '2024-07-02 04:01:32', 'Pending'),
(9, 'B-', 'Nothing', 412, '2024-07-02 04:01:40', 'Pending'),
(9, 'B-', 'Nothing', 12, '2024-07-02 04:01:51', 'Pending'),
(9, 'B-', 'Nothing', 133, '2024-07-02 04:02:00', 'Pending'),
(9, 'B-', 'Nothing', 231, '2024-07-02 04:02:07', 'Pending'),
(9, 'B-', 'Nothing', 351, '2024-07-02 04:04:36', 'Pending'),
(9, 'B-', 'fever', 14, '2024-07-02 04:09:47', 'Pending'),
(9, 'B-', 'Nothing', 105, '2024-07-02 04:11:12', 'Pending'),
(9, 'B-', 'Nothing', 45, '2024-07-02 04:11:41', 'Pending'),
(23, 'AB+', 'fever', 200, '2024-07-04 15:20:08', 'Approved'),
(23, 'AB+', 'Nothing', 100, '2024-07-04 15:20:22', 'Approved'),
(9, 'B-', 'fever', 500, '2024-07-04 15:22:51', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `age` int(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL DEFAULT 'Gender',
  `number` int(255) DEFAULT NULL,
  `BloodGroup` varchar(255) NOT NULL DEFAULT 'blood group',
  `diseases` varchar(255) NOT NULL DEFAULT 'Nothing',
  `address` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'Select User Type',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `age`, `pass`, `gender`, `number`, `BloodGroup`, `diseases`, `address`, `user_type`, `date`) VALUES
(1, 'Sai Manas Karupakala ', 'karupakalasai64@gmail.com', 19, '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 1234567890, 'O+', '', 'hyd', 'Admin', '2024-06-24 00:00:30'),
(9, 'patient', 'patient@gmail.com', 25, '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 345789021, 'B-', 'Nothing', 'KMR', 'Patient', '2024-06-30 20:06:17'),
(10, 'Donor', 'donor@gmail.com', 30, '81dc9bdb52d04dc20036dbd8313ed055', 'Female', 2147483647, 'A-', 'Nothing', 'HYD', 'Donor', '2024-06-30 20:07:28'),
(15, 'sanny', 'sanny@gmail.com', 20, '1234', 'Male', 2147483647, 'AB-', 'Nothing', 'TG', 'Donor', '2024-07-01 22:13:25'),
(17, 'sai', 'sai@gmail.com', 20, '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 987654321, 'B-', 'Nothing', 'KMR', 'Donor', '2024-07-01 22:34:29'),
(18, 'Abhinay ', 'abhinay3@gmail.com', 23, '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 2147483647, 'O-', 'Nothing', 'KNR', 'Donor', '2024-07-01 22:46:06'),
(20, 'donor4', 'donor4@gmail.com', 20, '81dc9bdb52d04dc20036dbd8313ed055', 'Female', 2147483647, 'O-', 'Nothing', 'TG', 'Donor', '2024-07-01 22:58:42'),
(21, 'donor', 'donor5@gmail.com', 20, '81dc9bdb52d04dc20036dbd8313ed055', '', 2147483647, 'O+', 'Nothing', 'HYD', 'Donor', '2024-07-01 23:05:47'),
(22, 'female', 'female@gmail.com', 23, '81dc9bdb52d04dc20036dbd8313ed055', 'Female', 987654567, 'B-', 'Nothing', 'TG', 'Donor', '2024-07-01 23:32:19'),
(23, 'sanjay', 'sanjay@gmail.com', 20, '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 2147483647, 'AB+', 'fever', 'kmm', 'Donor', '2024-07-04 15:03:57'),
(24, 'sunny', 'sunny@gmail.com', 23, '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 2147483647, 'B-', 'Nothing', 'Sangareddy District', 'Donor', '2024-07-04 15:33:08'),
(25, 'doner7', 'doner7@gmail.com', 23, '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 2147483647, 'AB-', 'Nothing', 'Sangareddy District, Choutkur, Telangana 502273, India', 'Donor', '2024-07-05 22:39:00'),
(26, 'doner64', 'doner64@gmail.com', 20, '81dc9bdb52d04dc20036dbd8313ed055', 'Female', 2147483647, 'O-', 'Nothing', 'Sangareddy', 'Donor', '2024-07-06 00:44:25'),
(27, 'Manas', 'manas@gmail.com', 23, '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 2147483647, 'A-', 'Nothing', 'Sangareddy District, Choutkur, Telangana 502273, India', 'Donor', '2024-07-06 01:03:37'),
(28, 'sai', 'sai64@gmail.com', 23, '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 2147483647, 'O-', 'Nothing', 'Sangareddy', 'Donor', '2024-07-06 01:06:32'),
(29, 'imtiyaz', 'imtiyaz@gmail.com', 20, '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 2147483647, 'O+', 'Nothing', 'Sangareddy District,', 'Donor', '2024-07-06 01:09:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood`
--
ALTER TABLE `blood`
  ADD PRIMARY KEY (`Blood_Group`);

--
-- Indexes for table `donationshistory`
--
ALTER TABLE `donationshistory`
  ADD KEY `TEST2` (`blood_group`),
  ADD KEY `TEST6` (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD KEY `TEST1` (`id`);

--
-- Indexes for table `requestshistory`
--
ALTER TABLE `requestshistory`
  ADD KEY `TEST4` (`blood_group`),
  ADD KEY `TEST5` (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TEST` (`BloodGroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donationshistory`
--
ALTER TABLE `donationshistory`
  ADD CONSTRAINT `TEST2` FOREIGN KEY (`blood_group`) REFERENCES `blood` (`Blood_Group`),
  ADD CONSTRAINT `TEST6` FOREIGN KEY (`id`) REFERENCES `user_form` (`id`);

--
-- Constraints for table `requestshistory`
--
ALTER TABLE `requestshistory`
  ADD CONSTRAINT `TEST4` FOREIGN KEY (`blood_group`) REFERENCES `blood` (`Blood_Group`),
  ADD CONSTRAINT `TEST5` FOREIGN KEY (`id`) REFERENCES `user_form` (`id`);

--
-- Constraints for table `user_form`
--
ALTER TABLE `user_form`
  ADD CONSTRAINT `TEST` FOREIGN KEY (`BloodGroup`) REFERENCES `blood` (`Blood_Group`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
