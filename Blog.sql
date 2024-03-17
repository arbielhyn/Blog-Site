-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2024 at 09:21 PM
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
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `Blog`
--

CREATE TABLE `Blog` (
  `id` int(50) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Content` varchar(500) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Blog`
--

INSERT INTO `Blog` (`id`, `Title`, `Content`, `Date`) VALUES
(3, 'TBH', 'I think you&#039;re cool!', '2024-01-22 18:53:25'),
(4, '@_ellalacanlale', 'add me on ig', '2024-01-22 22:58:37'),
(5, 'First Post', 'Hi :)', '2024-01-23 02:14:04'),
(6, 'Testing', '1 2 3 Check', '2024-01-23 02:14:49'),
(8, 'Coffee', 'I wish there was a closer coffee shop near me, so that I wouldn&#039;t need to be drinking this trash coffee from Tim Hortons, like it makes my tummy hurts. Im just here rambling cut I need to meet the 200 word count. I could&#039;ve gotten an lorem Epsom but you know I got time to kill so it is what it is. I don&#039;t know if this is 200 word yet like damn', '2024-01-23 17:29:34'),
(10, 'GRRRR.BRRRRR...RAHHRAHHRAHH', 'PHEW PHEW', '2024-01-24 02:55:42'),
(11, 'senioritis ', 'today, im feeling just a lil stressed that exams are coming up, but low-key im also gaslighting myself into thinking that ik everything even though I haven&#039;t looked over shit. its also the fact that im now a senior and I don&#039;t give af about any of my school work, like im literally clocked out mentally and it&#039;s only January. 6 more months to go! you got that shit.', '2024-01-24 03:09:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Blog`
--
ALTER TABLE `Blog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Blog`
--
ALTER TABLE `Blog`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
