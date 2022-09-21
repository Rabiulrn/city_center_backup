-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 06:14 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xl_software2`
--

-- --------------------------------------------------------

--
-- Table structure for table `debit_group_data`
--

CREATE TABLE `debit_group_data` (
  `id` int(11) NOT NULL,
  `entry_date` date NOT NULL,
  `group_name` text NOT NULL,
  `group_description` text NOT NULL,
  `group_taka` text NOT NULL,
  `group_pices` text NOT NULL,
  `group_total_taka` text NOT NULL,
  `group_total_bill` text NOT NULL,
  `group_pay` text NOT NULL,
  `group_due` text NOT NULL,
  `group_id` int(11) NOT NULL,
  `dg_date` date NOT NULL,
  `project_name_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `debit_group_data`
--

INSERT INTO `debit_group_data` (`id`, `entry_date`, `group_name`, `group_description`, `group_taka`, `group_pices`, `group_total_taka`, `group_total_bill`, `group_pay`, `group_due`, `group_id`, `dg_date`, `project_name_id`) VALUES
(120, '2019-09-25', 'dddddddd', 'dddddddddd', '500', '1', '500', '500', '500', '0', 24, '2019-07-09', 1),
(123, '2019-09-25', 'asdf', 'asdf', '', '', '0', '', '', '', 33, '2019-09-11', 1),
(200, '2019-10-12', 'vvv', 'vv', '500', '1', '500', '550', '150', '400', 0, '1970-01-01', 1),
(203, '2019-10-12', 'mm', 'mm', '100', '100', '10000', '100', '100', '100', 0, '1970-01-01', 1),
(204, '2019-10-12', 'gg', 'gg', '100', '100', '10000', '100', '100', '100', 0, '1970-01-01', 1),
(232, '2019-10-14', 'aa', 'aa', '500', '2', '1000', '', '1000', '0', 24, '2019-07-09', 1),
(233, '2019-10-14', 'bb', 'bb', '1000', '2', '2000', '', '2000', '0', 24, '2019-07-09', 1),
(234, '2019-10-14', 'ee', 'ee', '1000', '1', '1000', '', '1000', '0', 24, '2019-07-09', 1),
(235, '2019-10-14', 'ff', 'ff', '1500', '1', '1500', '', '1500', '0', 24, '2019-07-09', 1),
(236, '2019-09-25', '', '', '', '', '0', '', '', '', 24, '2019-07-09', 1),
(237, '2019-10-14', 'xx', 'xx', '500', '2', '1000', '', '800', '200', 23, '2019-07-08', 1),
(238, '2019-10-14', 'yy', 'yy', '500', '2', '1000', '', '600', '400', 23, '2019-07-08', 1),
(246, '2019-11-06', 'aaa', 'aaa', '', '', '0', '', '', '', 0, '1970-01-01', 1),
(276, '2019-11-04', '', '', '', '', '0', '', '', '', 33, '2019-09-11', 1),
(277, '2019-11-05', 'x', 'x', '50', '2', '100', '', '0', '100', 33, '2019-09-11', 1),
(278, '2019-11-05', '', '', '', '', '0', '', '', '', 33, '2019-09-11', 1),
(280, '2019-11-05', '', '', '', '', '0', '', '', '', 33, '2019-09-11', 1),
(282, '2019-11-05', '', '', '', '', '0', '', '', '', 24, '2019-07-09', 1),
(285, '2019-10-14', 'a', 'a', '20', '2', '40', '', '0', '40', 24, '2019-07-09', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `debit_group_data`
--
ALTER TABLE `debit_group_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `debit_group_data`
--
ALTER TABLE `debit_group_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
