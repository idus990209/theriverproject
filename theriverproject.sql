-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 05:15 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theriverproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `river_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `content`, `river_id`, `user_id`, `date_created`) VALUES
(1, 'Johor River is the largest one!', 1, 1, '2020-06-19'),
(6, 'Buenos!', 1, 2, '2020-06-19'),
(8, 'Heheeeeeee', 1, 1, '2020-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `river`
--

CREATE TABLE `river` (
  `id` int(11) NOT NULL,
  `river_name` varchar(255) NOT NULL,
  `river_location` varchar(255) NOT NULL,
  `map_url` varchar(255) NOT NULL,
  `embed_url` varchar(255) NOT NULL,
  `image_ext` varchar(255) NOT NULL,
  `data_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `river`
--

INSERT INTO `river` (`id`, `river_name`, `river_location`, `map_url`, `embed_url`, `image_ext`, `data_id`) VALUES
(1, 'Johor River', 'Johor', 'https://goo.gl/maps/My9cqEjHhkeYZMjY6', 'pb=!1m18!1m12!1m3!1d1020848.7195067639!2d102.9047605558675!3d1.871402407021366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da687fff22613f%3A0x9796348a21120204!2sJohor%20River!5e0!3m2!1sen!2smy!4v1592295171894!5m2!1sen!2smy', 'jpg', 0),
(2, 'Mersing River', 'Johor', 'https://goo.gl/maps/XLYtMjAuY5nJUgjm7', 'pb=!1m18!1m12!1m3!1d1020848.7195067639!2d102.9047605558675!3d1.871402407021366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31dab364b4cdd191%3A0x9d4a7aa5e83af5f7!2sMersing%20River!5e0!3m2!1sen!2smy!4v1592316738516!5m2!1sen!2smy', 'jpg', 0),
(3, 'Batu Pahat River', 'Johor', 'https://goo.gl/maps/y35DrKRVRVGuyjvp8', 'pb=!1m18!1m12!1m3!1d510400.76516997116!2d103.08802177902525!3d1.9507792329824696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d056a4699eda65%3A0xfb96f1de792bc1f5!2sBatu%20Pahat%20River!5e0!3m2!1sen!2smy!4v1592318318843!5m2!1sen!2smy', 'jpg', 0),
(4, 'Pulai River', 'Johor', 'https://goo.gl/maps/PWjx6ZvXyWv8WKJA6', 'pb=!1m18!1m12!1m3!1d510400.76516997116!2d103.08802177902525!3d1.9507792329824696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d0a757ed18457d%3A0x645c3fcbcebe7e15!2sPulai%20River!5e0!3m2!1sen!2smy!4v1592318402153!5m2!1sen!2smy', 'jpg', 0),
(5, 'Segamat River', 'Johor', 'https://goo.gl/maps/XAz9DNgMQ5UTumR59', 'pb=!1m18!1m12!1m3!1d510400.76516997116!2d103.08802177902525!3d1.9507792329824696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cfd269c749620b%3A0x69cf48677d5cc174!2sSegamat%20River!5e0!3m2!1sen!2smy!4v1592318555227!5m2!1sen!2smy', 'webp', 0),
(6, 'Tebrau River', 'Johor', 'https://goo.gl/maps/3ndfHNyVHcobM34D6', 'pb=!1m18!1m12!1m3!1d63813.72081246373!2d103.7112904860323!3d1.5504764611394424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da6e19801e163f%3A0x822e3c76a4aed7fc!2sSungai%20Tebrau!5e0!3m2!1sen!2smy!4v1592318713961!5m2!1sen!2smy', 'jpeg', 0),
(7, 'Lebam River', 'Johor', 'https://goo.gl/maps/PbibLPbctJkMK6ah6', 'pb=!1m18!1m12!1m3!1d1020730.4055566522!2d102.62954148460263!3d2.064662203824687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da488d69b0f8f3%3A0xa534092d56cfcba8!2sLebam%20River!5e0!3m2!1sen!2smy!4v1592498814951!5m2!1sen!2smy', 'jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `river_data`
--

CREATE TABLE `river_data` (
  `id` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `level` double NOT NULL,
  `ph` double NOT NULL,
  `do` double NOT NULL,
  `temperature` double NOT NULL,
  `ec` double NOT NULL,
  `turbidity` double NOT NULL,
  `river_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `river_data`
--

INSERT INTO `river_data` (`id`, `latitude`, `longitude`, `level`, `ph`, `do`, `temperature`, `ec`, `turbidity`, `river_id`) VALUES
(1, 1.6553, 103.9272, 2.21, 7.1, 6.5, 18.7, 403.7, 3, 1),
(2, 1.6553, 103.9272, 2.21, 7.1, 6.5, 18.7, 403.7, 3, 2),
(3, 1.6553, 103.9272, 2.21, 7.1, 6.5, 18.7, 403.7, 3, 3),
(4, 1.6553, 103.9272, 2.21, 7.1, 6.5, 18.7, 403.7, 3, 4),
(5, 1.6553, 103.9272, 2.21, 7.1, 6.5, 18.7, 403.7, 3, 5),
(6, 1.6553, 103.9272, 2.21, 7.1, 6.5, 18.7, 403.7, 3, 6),
(7, 1.6553, 103.9272, 2.21, 7.1, 6.5, 18.7, 403.7, 3, 7),
(10, 1.6553, 103.9272, 2.21, 7.1, 6.5, 18.7, 403.7, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `userpassword` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `email`, `userpassword`) VALUES
(1, 'admin', 'admin', 'admin@syzygyteam.com', 'admin'),
(2, 'test', 'test', 'test@syzygyteam.com', 'test1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `river`
--
ALTER TABLE `river`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `river_name` (`river_name`);

--
-- Indexes for table `river_data`
--
ALTER TABLE `river_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `river`
--
ALTER TABLE `river`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `river_data`
--
ALTER TABLE `river_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
