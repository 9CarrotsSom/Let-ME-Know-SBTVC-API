-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Feb 16, 2023 at 09:11 AM
-- Server version: 8.0.29
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `usernames` varchar(50) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL,
  `roles` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `usernames`, `passwd`, `roles`) VALUES
(1, 'admin', '123456', 'superadmin'),
(2, 'admin2', '111111', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `marker_image` longtext NOT NULL,
  `url` longtext NOT NULL,
  `address` varchar(100) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `detail` longtext NOT NULL,
  `market_type` varchar(50) NOT NULL DEFAULT '',
  `ribbon` varchar(100) NOT NULL DEFAULT '<i class=''fa fa-thumbs-up''></i>',
  `timez` varchar(50) NOT NULL DEFAULT '',
  `total` varchar(50) NOT NULL DEFAULT '',
  `types` varchar(50) NOT NULL DEFAULT '',
  `tambon` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `title`, `marker_image`, `url`, `address`, `latitude`, `longitude`, `detail`, `market_type`, `ribbon`, `timez`, `total`, `types`, `tambon`, `province`) VALUES
(1, 'วัดลาดปลาเค้า', 'assets/img/20293349_a7gLTIWqcRj4nYIYN7fX8KkMhOilEpRpVEAIrDBnO5Q.jpg', 'https://goo.gl/maps/CG2F5eTFFPpLpKhX7', '100.604481', '19.687185', '99.725895', '', '', '<i class=\'fa fa-thumbs-up\'></i>', '', '', '', 'จอมกาย', 'กทม'),
(2, 'หมู่บ้านอารียา', 'assets/img/20293349_a7gLTIWqcRj4nYIYN7fX8KkMhOilEpRpVEAIrDBnO5Q.jpg', 'https://goo.gl/maps/CG2F5eTFFPpLpKhX7', '100.605768', '19.675453', '99.730431', 'รายละเอียด ปปปปปปป', 'clear', '<i class=\'fa fa-thumbs-up\'></i>', '16.00-19.00', '20 ร้าน', 'ตลาดสด', 'กายจอม', 'ลำปาง'),
(4, 'วัดลาดปลาเค้า', 'assets/img/20293349_a7gLTIWqcRj4nYIYN7fX8KkMhOilEpRpVEAIrDBnO5Q.jpg', 'https://goo.gl/maps/CG2F5eTFFPpLpKhX7', '100.604481', '19.687185', '99.725895', 'รายละเอียด 2', 'clear', '<i class=\'fa fa-thumbs-up\'></i>', '16.00-19.00', '20 ร้าน', 'ตลาดสด', 'เอกมัย', 'ลำพูน'),
(31, 'ตลาดหกแยกอำเภอพาน', '', 'https://maps.google.com?q=GPRV W33 ตลาดหกแยกอำเภอพาน ตำบล เมืองพาน อำเภอ พาน เชียงราย 57120', 'ทดสอบ', '19.542203', '99.742790', 'GPRV W33 ตำบล เมืองพาน อำเภอ พาน เชียงราย 57120', 'clear', '<i class=\'fa fa-thumbs-up\'></i>', '16.00-19.00', '20', 'ตลาดสด', 'ทะเล', 'พะเยา'),
(32, 'ฟาร์มโชคดี', '', 'https://goo.gl/maps/CG2F5eTFFPpLpKhX7', '201 ', '19.675453', '99.730431', 'สวัสดี', 'clear', '<i class=\'fa fa-thumbs-up\'></i>', '16:00 - 16:30', '300', 'ตลาดสดหนองตองเชียงใหม่', 'จอมทอม', 'เชียงราย'),
(33, 'ฟาร์มเอกชัย', '', 'https://goo.gl/maps/CG2F5eTFFPpLpKhX7', '203', '19.675453', '99.730431', '23', 'clear', '<i class=\'fa fa-thumbs-up\'></i>', '16:00 - 19:00', '300', 'สด', 'หนองตอง', 'เชียงคาน');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
  `id` int NOT NULL,
  `id_location` int NOT NULL,
  `path_image` varchar(255) NOT NULL DEFAULT '0',
  `created_at` datetime(3) NOT NULL,
  `updated_at` datetime(3) NOT NULL,
  `user_created` varchar(255) NOT NULL,
  `user_updated` varchar(255) NOT NULL,
  `status_item` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`id`, `id_location`, `path_image`, `created_at`, `updated_at`, `user_created`, `user_updated`, `status_item`) VALUES
(1, 2, '/api-market/image_item/1676522489743.jpg', '2023-02-16 11:41:29.000', '2023-02-16 12:18:32.000', 'Admin', 'Admin', 9),
(2, 2, '/api-market/image_item/1676522489748.jpg', '2023-02-16 11:41:29.000', '2023-02-16 12:24:05.000', 'Admin', 'Admin', 9),
(3, 2, '/api-market/image_item/1676522606224.jpg', '2023-02-16 11:43:26.000', '2023-02-16 12:19:58.000', 'Admin', 'Admin', 9),
(4, 2, '/api-market/image_item/1676522606229.jpg', '2023-02-16 11:43:26.000', '2023-02-16 12:24:02.000', 'Admin', 'Admin', 9),
(5, 2, '/api-market/image_item/1676522606235.jpg', '2023-02-16 11:43:26.000', '2023-02-16 12:16:56.000', 'Admin', 'Admin', 9),
(6, 2, '/api-market/image_item/1676522606246.jpg', '2023-02-16 11:43:26.000', '2023-02-16 12:18:13.000', 'Admin', 'Admin', 9),
(7, 2, '/api-market/image_item/1676522606257.jpg', '2023-02-16 11:43:26.000', '2023-02-16 12:17:10.000', 'Admin', 'Admin', 9),
(8, 2, '/api-market/image_item/1676525065743.jpg', '2023-02-16 12:24:25.000', '2023-02-16 12:24:25.000', 'Admin', 'Admin', 1),
(9, 2, '/api-market/image_item/1676525105635.jpg', '2023-02-16 12:25:05.000', '2023-02-16 12:26:33.000', 'Admin', 'Admin', 9),
(10, 2, '/api-market/image_item/1676525161233.jpg', '2023-02-16 12:26:01.000', '2023-02-16 12:26:01.000', 'Admin', 'Admin', 1),
(11, 2, '/api-market/image_item/1676525187804.jpg', '2023-02-16 12:26:27.000', '2023-02-16 12:26:36.000', 'Admin', 'Admin', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
