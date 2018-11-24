-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2018 at 03:11 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `work_id` int(9) NOT NULL,
  `work_name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`work_id`, `work_name`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'purus aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a odio in hac', '2018-07-22 13:30:30', '2019-06-06 15:46:32', 2, '2018-11-24 09:10:53', NULL, NULL),
(2, 'donec dapibus duis at velit eu est congue elementum in hac habitasse platea', '2018-11-06 18:30:05', '2019-10-09 17:56:34', 3, '2018-11-24 09:10:53', NULL, NULL),
(3, 'fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis', '2018-08-04 17:02:41', '2019-08-21 04:48:48', 3, '2018-11-24 09:10:53', NULL, NULL),
(4, 'aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque duis bibendum morbi', '2018-06-04 15:13:47', '2019-11-06 06:44:09', 1, '2018-11-24 09:10:53', NULL, NULL),
(5, 'odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas tristique', '2018-07-09 18:08:44', '2019-08-15 06:36:23', 3, '2018-11-24 09:10:53', NULL, NULL),
(6, 'nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci', '2018-10-04 02:08:24', '2019-07-27 22:10:13', 1, '2018-11-24 09:10:53', NULL, NULL),
(7, 'pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque', '2018-06-07 01:42:56', '2019-11-16 16:48:54', 2, '2018-11-24 09:10:53', NULL, NULL),
(8, 'sed ante vivamus tortor duis mattis egestas metus aenean fermentum donec ut mauris eget massa tempor convallis nulla', '2018-08-11 12:07:04', '2019-10-23 11:39:11', 2, '2018-11-24 09:10:53', NULL, NULL),
(9, 'ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo', '2018-08-24 11:37:20', '2019-08-11 20:54:06', 3, '2018-11-24 09:10:53', NULL, NULL),
(10, 'pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat', '2018-09-12 19:32:39', '2019-07-27 09:06:33', 1, '2018-11-24 09:10:53', NULL, NULL),
(11, 'consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae', '2018-09-12 19:32:39', '2019-07-27 09:06:33', 1, '2018-11-24 09:10:53', NULL, NULL),
(12, 'dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis', '2018-06-07 01:42:56', '2019-11-16 16:48:54', 1, '2018-11-24 09:10:53', NULL, NULL),
(13, 'eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor', '2018-08-24 11:37:20', '2019-08-11 20:54:06', 2, '2018-11-24 09:10:53', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
