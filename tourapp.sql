-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2024 at 04:57 AM
-- Server version: 5.7.44-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tjthouhi_tourapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `amount` varchar(100) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `detail`, `amount`, `tour_id`, `added`) VALUES
(1, 'Hotel advance', '5100', 1, '2020-08-29 05:12:36'),
(2, 'Okten raihan', '2000', 1, '2020-08-29 11:40:57'),
(3, 'Raaz car okten', '555', 1, '2020-08-29 11:50:07'),
(4, 'Food on road', '640', 1, '2020-08-29 01:11:56'),
(5, 'Choklet', '70', 1, '2020-08-29 01:12:33'),
(6, 'Lunch', '4200', 1, '2020-08-29 03:05:40'),
(7, 'Lunch bill by tj and parag', '3150', 1, '2020-08-30 03:09:57'),
(8, 'Okten dj', '1000', 1, '2020-08-30 07:01:26'),
(9, 'Shorif food', '400', 1, '2020-08-30 07:01:52'),
(10, 'Tj extra ', '400', 1, '2020-08-30 07:02:27'),
(11, 'Room rent', '24200', 1, '2020-08-31 11:45:10'),
(12, 'Raaz', '975', 1, '2020-08-31 10:50:26'),
(13, 'Rayhan car', '400', 1, '2020-08-31 10:51:27'),
(14, 'Biriyani ', '1300', 2, '2021-01-28 11:01:14'),
(15, 'car', '15', 3, '2022-10-20 11:42:24'),
(16, 'hotel', '120', 3, '2022-10-20 11:42:33'),
(17, 'Bus vara', '100', 4, '2024-03-10 04:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `tourDetail`
--

CREATE TABLE `tourDetail` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tourDetail`
--

INSERT INTO `tourDetail` (`id`, `title`, `detail`) VALUES
(1, 'Sreemangal Tour', '2night tour'),
(2, 'Coxbazar Tour', ''),
(3, 'UK tour', 'Me and maju'),
(4, 'Germany', 'TOnmoyer goro gurat');

-- --------------------------------------------------------

--
-- Table structure for table `tour_user`
--

CREATE TABLE `tour_user` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tour_user`
--

INSERT INTO `tour_user` (`id`, `tour_id`, `user_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 5),
(5, 1, 6),
(6, 1, 7),
(7, 1, 8),
(8, 1, 9),
(9, 1, 10),
(10, 1, 11),
(11, 1, 12),
(12, 2, 1),
(13, 2, 12),
(14, 2, 6),
(15, 2, 7),
(16, 2, 14),
(17, 2, 15),
(18, 2, 17),
(19, 2, 18),
(20, 2, 19),
(21, 2, 20),
(22, 2, 21),
(23, 3, 1),
(24, 3, 22),
(25, 4, 23);

-- --------------------------------------------------------

--
-- Table structure for table `tour_user_pay`
--

CREATE TABLE `tour_user_pay` (
  `id` int(11) NOT NULL,
  `tu_id` int(11) NOT NULL,
  `payed` varchar(100) NOT NULL,
  `added` datetime NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tour_user_pay`
--

INSERT INTO `tour_user_pay` (`id`, `tu_id`, `payed`, `added`, `notes`) VALUES
(1, 1, '5100', '2020-08-29 05:15:13', 'hotel booking with bkash fee'),
(2, 10, '2000', '2020-08-29 11:41:16', 'Okten'),
(3, 11, '555', '2020-08-29 11:49:45', 'Okten'),
(4, 1, '640', '2020-08-29 01:13:00', 'Food on road'),
(5, 1, '70', '2020-08-29 01:13:16', 'On road choklete'),
(6, 3, '2200', '2020-08-29 03:05:59', 'Lunch'),
(7, 10, '2000', '2020-08-29 03:06:17', 'Lunch'),
(8, 2, '2000', '2020-08-30 02:57:00', 'Cash tj'),
(9, 1, '1150', '2020-08-30 03:10:31', 'Lunch bill'),
(10, 2, '1000', '2020-08-30 07:01:03', 'Dj okten'),
(11, 7, '400', '2020-08-30 07:02:08', 'Food'),
(12, 1, '400', '2020-08-30 07:02:45', 'Extra'),
(13, 8, '6000', '2020-08-31 11:44:05', 'Room rent'),
(14, 7, '7000', '2020-08-31 11:44:26', 'Room rent'),
(15, 1, '11200', '2020-08-31 11:44:54', 'Room rent'),
(16, 8, '1600', '2020-08-31 04:18:11', 'In cash'),
(17, 3, '975', '2020-08-31 10:50:46', 'Car'),
(18, 10, '400', '2020-08-31 10:52:13', 'Total'),
(19, 23, '10', '2022-10-20 11:42:58', 'car'),
(20, 23, '80', '2022-10-20 11:43:09', 'hotel'),
(21, 24, '40', '2022-10-20 11:43:17', 'hotel'),
(22, 25, '50', '2024-03-10 04:56:53', 'eewr');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_pass`) VALUES
(1, 'tonmoy', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`) VALUES
(1, 'Tj Thouhid', '01737616304'),
(2, 'Dj', '01717129912'),
(3, 'Raaz', '01774148909'),
(5, 'Aka', '00000000'),
(6, 'Naima', '000000000'),
(7, 'Asma', '000000'),
(8, 'Shorif', '000000000'),
(9, 'Mr Rifat', '0000000000'),
(10, 'Mrs Refat', '000000'),
(11, 'Al Raihan', '0000'),
(12, 'Ali Syed', '00000000'),
(14, 'Ruxi', ''),
(15, 'Mumu', ''),
(17, 'Topu', ''),
(18, 'Shima', ''),
(19, 'Marjana', ''),
(20, 'Meheraj', ''),
(21, 'Sami', ''),
(22, 'Maju', '087444'),
(23, 'Rokib', '011415');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `property` varchar(255) NOT NULL,
  `type` enum('text','email','option','image') NOT NULL DEFAULT 'text'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `title`, `value`, `property`, `type`) VALUES
(1, 'Website Title', 'Tour App', 'title', 'text'),
(2, 'Logo', '2020/05/06/musc-logo.png', 'logo', 'image'),
(3, 'Admin Email', 'admin@f.com', 'admin_email', 'email'),
(4, 'Favicon', '2020/05/06/musc-logo-0.png', 'favicon', 'image'),
(5, 'Admin Url', 'https://tourapp.tjthouhid.com/', 'admin_url', 'text'),
(6, 'Site Url', 'https://tourapp.tjthouhid.com', 'site_url', 'text');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourDetail`
--
ALTER TABLE `tourDetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_user`
--
ALTER TABLE `tour_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_user_pay`
--
ALTER TABLE `tour_user_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tourDetail`
--
ALTER TABLE `tourDetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tour_user`
--
ALTER TABLE `tour_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tour_user_pay`
--
ALTER TABLE `tour_user_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
