-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 05:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `reserver_name` text NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `amount` int(100) NOT NULL,
  `number_nights` int(50) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `price` varchar(50) NOT NULL,
  `total` varchar(255) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `children` int(50) NOT NULL,
  `adult` int(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `valid_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `reserver_name`, `room_name`, `amount`, `number_nights`, `check_in`, `check_out`, `price`, `total`, `payment_status`, `payment`, `full_name`, `address`, `email`, `children`, `adult`, `phone`, `valid_id`) VALUES
(182, 'Eric Talamisan', 'Kia Ora A,B or C', 28000, 4, '2022-07-14', '2022-07-18', '7000', '0', '', 'about-img - Copy(1).jpg', 'Eric Talamisan', 'agbuyog street', 'erictalamisan14@gmail.com', 4, 4, '56457457444', 'Screenshot_1.png'),
(185, 'Dorothy Joy Ligan', 'Kia Ora A,B or C', 14000, 2, '2022-08-15', '2022-08-17', '7000', '14000', '', '', '', '', '', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `room_name` varchar(150) NOT NULL,
  `description_1` varchar(255) NOT NULL,
  `description_2` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `booking_status` varchar(50) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `room_name`, `description_1`, `description_2`, `price`, `booking_status`, `check_in`, `check_out`, `image`) VALUES
(9, 'Bungalow Beachfront Villa PHP 7,000/night', '3 Bedroom | Sleeps 9 Adults and 2 Kids 10 years old and below.', 'Masters Bedroom 1 (185/213CM). King sized bed with split type AC. A unique Beachfront Villa with large balcony and living/dining area. Room 2 (140/190CM) A unique room with a Queen Sized Bed and a Single Bed equip with split type AC. Room 3 (90/190CM).', '7000', 'Available', '2022-07-14', '2022-07-18', 'img-1-1.jpg'),
(11, 'Kia Ora A,B or C', '2 Bedroom | Sleeps 6 Adults and 2 children 10 years old and below.', 'Masters Bedroom 1 (185/213CM)King sized bed with split type AC. A unique Beachfront Villa with large balcony and living/dining area. Accommodations can be right beside or in front of the pool. Room 2 (140/190CM) A unique room with two (2) Queen Sized Bed ', '7000', 'Available', '2022-08-15', '2022-08-17', 'img-2-2.jpg'),
(12, 'Garden Bungalow 9A PHP 4,000/night', '2 Bedroom | Sleeps 5 adults and 2 kids 11 years old and below.', 'Masters Bedroom,1 King sized bed, 1 Single bed, Room 2, 1 Queen sized bed. A unique and spacious 2 bedroom apartment with centralized AC. Large and spacious bathroom and shower.', '4000', 'Available', '0000-00-00', '0000-00-00', 'img-3-3.jpg'),
(13, 'Poolside Bungalow Studio Room PHP 4,000/night', 'Living Room: Smart LED TV with cable channels and a Sofa Bed.\r\n\r\n', 'Bathroom: Spacious and modern bathroom with hot and cold water.', '4000', 'Available', '2022-07-29', '2022-07-31', 'img-4.jpg'),
(14, 'Garden Bungalow 8B PHP 3,000/night', 'Sleeps 3 persons.', 'AC Room with Two Queen Bed and en suite bathroom.', '3000', 'Available', '0000-00-00', '0000-00-00', 'garden8b.jpg'),
(15, 'Garden Bungalow 8B PHP 3,000/night', 'Sleeps 3 persons.', 'AC Room with Two Queen Bed and en suite bathroom.', '5000', 'Available', '0000-00-00', '0000-00-00', 'img-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_type`, `name`) VALUES
(3, 'admin', 'admin@admin.com', '$2y$10$DCtztG6JX300RuVNzRAli.D1PIAwUGiAxUmke9dwmWOYWtiVitra6', 'Administrator', 'Administrator'),
(9, 'eric', 'erictalamisan14@gmail.com', '$2y$10$4L60kjTK33lBfFK07wgO6.a1rat7gCkK3szebGRG.aPAJFbz5ZWAy', '', 'Eric Talamisan'),
(10, 'dorothy', 'missdorothyjoy@gmail.com', '$2y$10$i6DfSTlPwUAVMQPivKEGAuggj3VnPsQLLwsWQ792TTTO.vTZuIgge', '', 'Dorothy Joy Ligan'),
(11, 'coco', 'erictalamisan1@gmail.com', '$2y$10$kD6MNQYS7K3f32.jLIAy1.c8fK4L8YJdIhjUBKvN62.qStpcRlRBq', '', 'coco martin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
