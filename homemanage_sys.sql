-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 04:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homemanage_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(8,0) DEFAULT 0,
  `product_image` varchar(255) NOT NULL,
  `Detail` text NOT NULL,
  `city` text NOT NULL,
  `status_product` varchar(50) NOT NULL,
  `date_listed` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `bedroom` int(11) NOT NULL,
  `bathroom` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id_product`, `product_name`, `price`, `product_image`, `Detail`, `city`, `status_product`, `date_listed`, `address`, `bedroom`, `bathroom`, `type`) VALUES
(1000, 'บ้านเงิน', 50000, 'homerecom.jpg', 'บ้านใหญ่ใจกลางกรุงเทพ มีห้องนอนและห้องน้ำที่หลากหลาย', 'กรุงเทพ', 'ยังไม่ขาย', '2024-10-07', '40/02344', 5, 2, 'บ้านเดี่ยว'),
(1019, 'บ้านโดมทอง', 14529000, 'S__425148445_0-800x600.jpg', 'บ้านวิวดีมีป่าไม้ ทำให้รู้สึกเป็นหนึ่งเดียวกับธรรมชาติ', 'บึงกาฬ', 'ยังไม่ขาย', '2024-10-08', '40/02344', 1, 1, 'บ้านเดี่ยว'),
(1020, 'บ้านแสน', 1990000, 'home-garden-terrace-head.jpg', 'บ้านนี้อยู่ใกล้มหาวิทยาลัยเทคโนโลยีราชมงคลธัญบุรี', 'ปทุมธานี', 'ยังไม่ขาย', '2024-09-30', '4561/454', 2, 1, 'บ้านเดี่ยว'),
(1021, 'บ้านนาทอง', 1590000, 'f889ca62-306e-43fd-a703-0b9ddb51dca4.jpg', 'บ้านนี้อยู่ใกล้มหาวิทยาลัยเทคโนโลยีราชมงคลธัญบุรี', 'ปทุมธานี', 'ยังไม่ขาย', '2024-10-07', '4561/454', 2, 1, 'บ้านเดี่ยว');

-- --------------------------------------------------------

--
-- Table structure for table `product_list_condo`
--

CREATE TABLE `product_list_condo` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `Detail` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `status_product` varchar(50) DEFAULT NULL,
  `date_listed` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bedroom` int(11) DEFAULT NULL,
  `bathroom` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list_condo`
--

INSERT INTO `product_list_condo` (`id_product`, `product_name`, `price`, `product_image`, `Detail`, `city`, `status_product`, `date_listed`, `address`, `bedroom`, `bathroom`, `type`) VALUES
(100, 'คอนโด', 5555.00, 'R (1).jfif', 'บ้านนี้มีผีเหมือนบ้านแรก', 'phatumthani', 'ยังไม่ขาย', '2024-10-07', '40/02344', 5, 2, 'คอนโด'),
(1021, 'คอนโดแสนใจ', 185411.00, 'R.jfif', 'คอนโดมีส่วนกลางที่ดีมีสระว่ายน้ำพร้อมให้จับจอง', 'ปทุมธานี', 'ยังไม่ขาย', '2024-10-08', 'รังสิต นครนายก 40/5451 ', 1, 1, 'คอนโด'),
(1023, 'Parason', 1200000.00, 'COBE-Ratchada-Rama-9-2.jpg', 'คอนโดเปิดใหม่ใกล้BTS ', 'กรุงเทพ', 'ยังไม่ขาย', '2024-10-06', '24/7', 2, 1, 'คอนโด'),
(1024, 'Origin', 599999.00, 'Origin-Plug-Play-Srinakarin-1.jpg', 'คอนโดวิวดี ในภาคเหนือ ', 'เชียงใหม่', 'ยังไม่ขาย', '2024-10-08', '53/47', 2, 1, 'คอนโด');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `urole`, `time_created`) VALUES
(1, 'คณากร', 'เผยสกุล', 'meoza3x', 'markzanazer4@gmail.com', '$2y$10$8CX2E.YPoj6B/jn9bLcEju0JzfUOZpcHR9aXnohKzfidRyHZMDkNu', 'user', '2024-10-07 14:26:15'),
(2, 'คณากร', 'เผยสกุล', 'meoza5x', 'markzanazer5@gmail.com', '$2y$10$jabXj8lTyUjUYV2w6gGuEu6otiQ0P9BamDdQw9S0VChhoG.tzZSfa', 'admin', '2024-10-08 13:20:04'),
(445, 'Kanakron', 'Phaesakun', 'adminmark', 'kanakronza@gmail.com', '$2y$10$ThzEnLV61rSK3Po/2bidneYywP9eMyJytr7ibMDeWp237u71OwykC', 'user', '2024-10-10 16:25:23'),
(446, 'ทดสอบ', 'ระบบ', 'test_id', 'ddsdsds@aggg.com', '$2y$10$5B6tH2KWFgglEO1/k84Kg.5VvfY/On.XpLSpD.kiUSRZ/gCF5gnkO', 'user', '2024-10-11 09:05:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `product_list_condo`
--
ALTER TABLE `product_list_condo`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1023;

--
-- AUTO_INCREMENT for table `product_list_condo`
--
ALTER TABLE `product_list_condo`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1025;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=448;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
