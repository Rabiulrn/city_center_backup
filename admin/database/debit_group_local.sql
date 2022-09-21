-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 06:13 AM
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
-- Table structure for table `debit_group`
--

CREATE TABLE `debit_group` (
  `id` int(11) NOT NULL,
  `group_name` text NOT NULL,
  `group_description` text NOT NULL,
  `taka` text NOT NULL,
  `pices` text NOT NULL,
  `total_taka` text NOT NULL,
  `total_bill` text NOT NULL,
  `pay` text NOT NULL,
  `due` text NOT NULL,
  `group_date` date NOT NULL,
  `project_name_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `debit_group`
--

INSERT INTO `debit_group` (`id`, `group_name`, `group_description`, `taka`, `pices`, `total_taka`, `total_bill`, `pay`, `due`, `group_date`, `project_name_id`) VALUES
(23, 'à¦¦à¦°à§à¦¶à¦¨à¦¾ à¦–à§à¦šà¦°à¦¾ à¦–à¦°à¦šà¦ƒ1', 'à¦¬à¦¿à¦¬à¦°à¦£à¦ƒ', 'à¦Ÿà¦¾à¦•à¦¾à¦ƒ', 'à¦œà¦¨à¦ƒ', 'à¦®à§‹à¦Ÿ à¦Ÿà¦¾à¦•à¦¾à¦ƒ', 'à¦®à§‹à¦Ÿ à¦¬à¦¿à¦²à¦ƒ', 'à¦œà¦®à¦¾à¦ƒ', 'à¦œà§‡à¦°à¦ƒ', '2019-07-08', 1),
(24, 'à¦¸à¦¾à¦‡à¦Ÿ à¦¬à¦¿à¦•à¦¾à¦¶ à¦šà¦¨à§à¦¦à§à¦° à¦¦à¦²à¦ƒ1', 'à¦¬à¦¿à¦¬à¦°à¦£à¦ƒ', 'à¦Ÿà¦¾à¦•à¦¾à¦ƒ', 'à¦œà¦¨à¦ƒ', 'à¦®à§‹à¦Ÿ à¦Ÿà¦¾à¦•à¦¾à¦ƒ', 'à¦®à§‹à¦Ÿ à¦¬à¦¿à¦²', 'à¦œà¦®à¦¾à¦ƒ', 'à¦œà§‡à¦°à¦ƒ', '2019-07-09', 1),
(26, 'à¦®à¦¾à¦°à¦«à§‹à¦¤ à¦¨à¦¾à¦®', 'à¦¬à¦¿à¦¬à¦°à¦£à¦ƒ', 'à¦¦à¦°à¦ƒ', 'à¦œà¦¨à¦ƒ', 'à¦®à§‹à¦Ÿ à¦Ÿà¦¾à¦•à¦¾à¦ƒ', 'à¦®à§‹à¦Ÿ à¦¬à¦¿à¦²', 'à¦œà¦®à¦¾à¦ƒ', 'à¦œà§‡à¦°à¦ƒ', '2019-07-14', 4),
(27, 'à¦®à¦¾à¦°à¦«à§‹à¦¤ à¦¨à¦¾à¦®', 'à¦¬à¦¿à¦¬à¦°à¦£', 'à¦¦à¦°', 'à¦•à¦¤à¦Ÿà¦¿', 'à¦®à§‹à¦Ÿ à¦Ÿà¦¾à¦•à¦¾', 'à¦¨à¦—à¦¦ à¦ªà¦°à¦¿à¦·à§‹à¦§', 'à¦œà¦®à¦¾', 'à¦œà§‡à¦°', '2019-07-15', 4),
(28, 'à¦¸à¦¾à¦‡à¦Ÿà§‡à¦° à¦…à¦«à¦¿à¦¸ à¦–à¦°à¦šà¦ƒ', 'à¦¬à¦¿à¦¬à¦°à¦£à¦ƒ', 'à¦¦à¦°à¦ƒ', 'à¦œà¦¨à¦ƒ', 'à¦®à§‹à¦Ÿ à¦Ÿà¦¾à¦•à¦¾à¦ƒ', 'à¦®à§‹à¦Ÿ à¦¬à¦¿à¦²à¦ƒ', 'à¦œà¦®à¦¾à¦ƒ', 'à¦œà§‡à¦°à¦ƒ', '2019-07-17', 2),
(29, 'à¦·à§à¦Ÿà¦¾à¦« à¦¦à¦¿à¦¨à§‡à¦° à¦“ à¦®à¦¾à¦¸à¦¿à¦• à¦¬à§‡à¦¤à¦¨ à¦¬à¦¾à¦¬à¦¦', 'à¦¬à¦¿à¦¬à¦°à¦£à¦ƒ', 'à¦Ÿà¦¾à¦•à¦¾à¦ƒ', 'à¦œà¦¨à¦ƒ', 'à¦®à§‹à¦Ÿ à¦Ÿà¦¾à¦•à¦¾à¦ƒ', 'à¦®à§‹à¦Ÿ à¦¬à¦¿à¦²', 'à¦œà¦®à¦¾à¦ƒ', 'à¦œà§‡à¦°à¦ƒ', '2019-07-17', 2),
(33, 'aaaa11', 'aa', 'aa', 'aaa', 'aaa', 'aa', 'aa', 'aa', '2019-09-11', 1),
(34, 'aa', 'aa', 'aa', 'aa', 'aa', '', 'aa', 'aa', '2019-11-11', 1),
(35, 'bb', 'bb', 'bb', 'bb', 'bb', '', 'bb', 'bb', '2019-11-11', 1),
(36, 'cc', 'cc', 'cc', 'cc', 'cc', '', 'cc', 'cc', '2019-11-11', 1),
(37, 'dd', 'dd', 'dd', 'dd', 'dd', '', 'dd', 'dd', '2019-11-11', 1),
(38, 'ee', 'ee', 'ee', 'ee', 'ee', '', 'ee', 'ee', '2019-11-11', 1),
(39, 'ff', 'ff', 'ff', 'ff', 'ff', '', 'ff', 'ff', '2019-11-11', 1),
(40, 'gg', 'gg', 'gg', 'gg', 'gg', '', 'gg', 'gg', '2019-11-11', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `debit_group`
--
ALTER TABLE `debit_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `debit_group`
--
ALTER TABLE `debit_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
