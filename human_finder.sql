-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 10:08 AM
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
-- Database: `human finder`
--

-- --------------------------------------------------------

--
-- Table structure for table `orphanage`
--

CREATE TABLE `orphanage` (
  `s_no` int(9) NOT NULL,
  `orf_name` varchar(255) NOT NULL,
  `orf_address` varchar(500) NOT NULL,
  `orf_man_name` varchar(255) NOT NULL,
  `orf_phone` varchar(15) NOT NULL,
  `orf_acc_name` varchar(20) NOT NULL,
  `orf_acc_no` bigint(15) NOT NULL,
  `orf_ifsc` varchar(10) NOT NULL,
  `orf_qr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orphanage`
--

INSERT INTO `orphanage` (`s_no`, `orf_name`, `orf_address`, `orf_man_name`, `orf_phone`, `orf_acc_name`, `orf_acc_no`, `orf_ifsc`, `orf_qr`) VALUES
(1, 'dds', 'ff', 'df', 'dff', 'df', 324, 'df', 'images/orphanage qr/'),
(2, 'kjas', 'smdm', 'msdc', 'mmsc', 'mzxdc', 44, 'masc', 'images/orphanage qr/WIN_20240330_11_32_16_Pro.jpg'),
(3, 'sfs', 'sadf', 'sd', 'dfss', 'sdff', 5454, 'sdf', 'images/orphanage qr/IMG_0812.JPG'),
(4, 'asdsdsdf', 'ds', 'sdf', 'sdf', '32', 324, 'df', 'images/orphanage qr/'),
(5, 'asdaasd', 'sad', 'asdf', 'asd', '', 0, '', 'images/orphanage qr/'),
(6, 'asda', 'sad', 'asd', 'asd', 'asd', 342, 'zcx', 'images/orphanage qr/'),
(7, 'vvv', 'dfvf', 'fvcv', 'rteyr', '', 0, '', 'images/orphanage qr/'),
(8, 'gj', 'kmn\r\n', ',m', 'mb', '', 0, '', 'images/orphanage qr/'),
(9, 'gj', 'kmn\r\n', ',m', 'mb', '', 0, '', 'images/orphanage qr/'),
(10, 'gj', 'kmn\r\n', ',m', 'mb', '', 0, '', 'images/orphanage qr/');

-- --------------------------------------------------------

--
-- Table structure for table `outsiders`
--

CREATE TABLE `outsiders` (
  `o_sno` int(255) NOT NULL,
  `oc_image` varchar(255) NOT NULL,
  `oc_name` varchar(255) NOT NULL DEFAULT 'Not Found',
  `oc_age` varchar(255) NOT NULL DEFAULT 'Not Found',
  `found_place` varchar(255) NOT NULL,
  `found_date` date DEFAULT NULL,
  `oc_shirt_color` varchar(255) NOT NULL,
  `oc_pant_color` varchar(255) NOT NULL,
  `oc_gender` char(255) NOT NULL,
  `oc_identifications` varchar(500) NOT NULL,
  `o_name` varchar(255) NOT NULL,
  `o_phone` varchar(15) NOT NULL,
  `o_address` varchar(255) NOT NULL,
  `oc_extra_info` longtext NOT NULL,
  `o_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `p_sno` int(255) NOT NULL,
  `pc_image` varchar(255) NOT NULL,
  `pc_name` varchar(255) NOT NULL,
  `pc_age` int(3) NOT NULL,
  `missing_place` varchar(255) NOT NULL,
  `missing_date` date DEFAULT NULL,
  `pc_shirt_color` varchar(255) NOT NULL,
  `pc_pant_color` varchar(255) NOT NULL,
  `pc_gender` char(255) NOT NULL,
  `pc_identifications` varchar(500) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_phone` varchar(15) NOT NULL,
  `p_address` varchar(255) NOT NULL,
  `pc_extra_info` longtext NOT NULL,
  `p_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`p_sno`, `pc_image`, `pc_name`, `pc_age`, `missing_place`, `missing_date`, `pc_shirt_color`, `pc_pant_color`, `pc_gender`, `pc_identifications`, `p_name`, `p_phone`, `p_address`, `pc_extra_info`, `p_date`) VALUES
(64, 'images/parents/WIN_20240322_11_53_30_Pro.jpg', 'sdf', 23, 'sdf', NULL, 'sdf', 'sdf', 'male', 'sdf', 'sdf', 'sdf', 'f', 'sdfsdf', '2024-04-02 23:06:49'),
(65, 'images/parents/IMG_0746.JPG', 'sfsd', 324, 'sdf', NULL, 'sdf', 'sdf', 'male', 'sdf', 'fdg', 'dfg', 'dfg', 'sdf', '2024-04-02 23:07:40'),
(66, 'images/parents/WIN_20240403_09_45_20_Pro.jpg', 'yugendhar', 20, 'hayatnagar', NULL, 'blue', 'blue', 'other', 'smart', 'ashwanth', '9553381113', 'uppal', 'safe', '2024-04-03 09:47:23'),
(67, 'images/parents/WIN_20240330_11_32_16_Pro.jpg', 'aaaa', 2, 'fds', NULL, 'df', 'df', 'male', 'gfh', 'fghfgfg', 'fgh', 'fgh', 'gh', '2024-04-09 20:39:05'),
(68, 'images/parents/WIN_20240330_11_32_16_Pro.jpg', 'ads', 12, 'sd', '2024-02-02', 'sdf', 'dsf', 'male', 'ds', 'sdf', 'xc', 'df', 'ds', '2024-04-11 01:25:29'),
(70, 'images/parents/IMG-20240423-WA0014.jpg', 'K.Ashwanth Reddy', 8, 'Ghatkesar', '2016-09-23', 'white T-shirt', 'Black', 'male', 'A mole on right hand\r\n', 'K.Abhinay reddy', '9542279982', 'uppal, k.l colony', 'he is safe with me ', '2024-04-23 11:57:06'),
(71, 'images/parents/IMG-20240423-WA0016.jpg', 'M.Rani ', 6, 'L.B Nagar', '2018-08-07', 'Pink', 'Blue', 'female', 'Silky hair\r\nA mole on right hand  ', 'M.Pavan ', '8856765214', 'North lalaguda, Shanthinagar,Secenderabad', 'Contact us if you find her', '2024-04-23 12:05:03'),
(72, 'images/parents/IMG-20240423-WA0018.jpg', 'Rajesh goud', 12, 'Sainikpuri', '2012-07-03', 'red', 'black', 'male', 'Dark spot on left hand\r\nA gap detween two teeth ', 'Sam joel', '7337503400', 'R.K puram,Defence colony H-no:11-220', 'Call me if he find', '2024-04-23 12:12:25'),
(73, 'images/parents/IMG-20240423-WA0017.jpg', 'swathi', 9, 'Kalyanpuri', '2015-09-21', 'Blue', 'black', 'female', 'A mole on right hand & forehead', 'shiva ', '7997781248', 'Ghatkesar,H-no:2-300/3', 'Call me if she find', '2024-04-23 12:17:27'),
(74, 'images/parents/IMG-20240423-WA0019.jpg', 'roja ', 8, 'B.B Nagar', '2016-07-04', 'black', 'black', 'female', 'A mole on left leg\r\n', 'K.Ganesh ', '954887762', 'Amberpet,K.L Colney H-no:15-187/3', 'contact us if she find', '2024-04-23 12:24:40'),
(75, 'images/parents/IMG-20240423-WA0024.jpg', 'M.Vivek kumar', 15, 'Madepalle', '2009-05-12', 'Orange T-Shirt', 'Blue', 'male', 'Curly Hair\r\nA mole on right cheek', 'l.manju', '9654478123', 'Yadagirigutta,H-No:3-450/4', 'Contact me if he find', '2024-04-23 12:31:03'),
(76, 'images/parents/IMG-20240423-WA0023.jpg', 'Aadhya', 18, 'Nalgonda', '2006-08-09', 'black Sari', 'black', 'female', 'A mole on forehead\r\nSilky hair', 'Ashwanth reddy', '8547712254', 'Hayathnagar H-NO:7-788/8', 'Contact me if she is found', '2024-04-23 12:36:15'),
(77, 'images/parents/IMG-20240423-WA0022.jpg', 'I.Venkatesh', 18, 'Uppal', '2006-12-23', 'White ', 'Black', 'male', 'A mole on left cheek & right leg ', 'S.Vamshi Reddy', '8745512236', 'Nacharam,H-NO:34-976/8', 'Contact us if you found', '2024-04-24 09:36:50'),
(78, 'images/parents/IMG-20240423-WA0021.jpg', 'K.Sakshith Reddy', 14, 'Ghatkesar', '2010-04-05', 'Orange t-Shirt', 'Blue', 'male', 'a mole on left leg &  right cheek', 'K.Ganesh Kumar', '9854475521', 'Uppal,J.K Nagar,H-NO:85-584/9', 'Contact us if you found', '2024-04-24 09:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `success_data`
--

CREATE TABLE `success_data` (
  `s_sno` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_age` int(11) DEFAULT NULL,
  `s_shirt_color` varchar(50) DEFAULT NULL,
  `s_pant_color` varchar(50) DEFAULT NULL,
  `s_gender` varchar(10) DEFAULT NULL,
  `s_identifications` text DEFAULT NULL,
  `sop_name` varchar(255) DEFAULT NULL,
  `sop_phone` varchar(20) DEFAULT NULL,
  `sop_address` text DEFAULT NULL,
  `s_extra_info` text DEFAULT NULL,
  `s_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `success_data`
--

INSERT INTO `success_data` (`s_sno`, `s_name`, `s_age`, `s_shirt_color`, `s_pant_color`, `s_gender`, `s_identifications`, `sop_name`, `sop_phone`, `sop_address`, `s_extra_info`, `s_date`) VALUES
(1, 'sdds', 0, 'sdfsdf', 'sdffsd', 'male', 'sdf', 'dfsdf', 'dsfdfs', 'sdfsdf\r\n', 'sdf\r\n\r\nd', '2024-04-10 23:15:34'),
(2, 'raghu', 0, 'adf', 'asd', 'male', 'asd', 'xdc', 'zxdc', 'sdzxc', 'asd', '2024-04-10 23:15:34'),
(3, 'hi', 0, 'zc', 'zsd', 'male', 'sdsdsd', 'zxc', 'zxc', 'xc', 'zxc', '2024-04-10 23:15:34'),
(4, 'hi', 0, 'zc', 'zsd', 'male', 'sdsdsd', 'zxc', 'zxc', 'xc', 'zxc', '2024-04-10 23:15:34'),
(5, 'aa11', 11, 'dsf', 'sdf', 'male', 'sdf\r\ns\r\n\r\n', 'sdf', 'df', 'sfd\r\n', 'dsf', '2024-04-10 23:15:34'),
(6, 'asd', 23, 'a', 'asd', 'male', 'asd', 'asda', 'assddf', 'sdsdccs\r\n\r\n', 'zdx\r\n', '2024-04-10 23:15:34'),
(7, '', 0, 'qq', 'q', 'male', 'qq\r\n', 'waq', 'aq', 'a\r\na\r\na', '2q\r\n', '2024-04-10 23:15:34'),
(8, 'hgh', 54, 'hjg', 'gf', 'male', 'h', 'h', 'hgj', 'hg', 'jgh', '2024-04-10 23:15:34'),
(9, 'ajay', 25, 'grey', 'black', 'male', 'very thin and handsome', 'sanju', '1234567890', 'warangal\r\n', 'he is in pedhapalli ps', '2024-04-10 23:15:34'),
(10, 'sssss', 2, 'ds', 'ds', 'male', 'ds', 'ds', 'dsf', 'ds', 'ds', '2024-04-10 23:15:34'),
(11, 'gv', 54, 'kjh', 'jkk', 'male', 'kghhggkh', 'nnn', 'nn', 'hh', 'kjj', '2024-04-10 23:15:34'),
(12, 'z', 2, 'zv', 'zdc', 'male', 'zdcfs', 'zc', 'zdc', 'zd', 'zczdc', '2024-04-10 23:15:34'),
(13, 'sd', 3, 'wefd', 'asd', 'male', '\r\ndsad\r\ndds\r\n', 'sdc', 'sdc', 'sd\r\n', 'zdfdsf', '2024-04-10 23:26:20'),
(14, 'dxf', 55, 'ghhhhhhh', 'fgh', 'male', 'gh', 'ghgh', 'khg', 'jhg', 'fg', '2024-04-10 23:27:21'),
(15, 'aaaaaa', 21, 'zx', 'as', 'male', 'asd', 'sd', 'asd', 'sd', 'asd', '2024-04-16 23:14:04'),
(16, 'ds', 3, 'gdb', 'gh', 'male', 'gfbg', 'ghf', 'ghfhhgf', 'gfghf', 'fghhf', '2024-04-22 12:01:21'),
(17, 'dhujdfj', 44, 'fkldfs', 'df,lgf', 'male', 'dfoilodgr', 'fclkfck', 'cv,mvb', 'c.,.fb', 'fdkjkj', '2024-04-22 16:21:39'),
(18, 'vishnu', 26, 'green', 'black', 'female', 'adhjads', 'fsdfjhsdj', '556566562', 'dfskjdfs', 'dsfkjdfs', '2024-04-22 16:25:11'),
(19, 'pavani', 20, 'pink saree', 'pink', 'female', 'she has shades', 'venkey', '9392564566', 'uppal', 'safe', '2024-04-22 16:29:13'),
(20, 'pavani', 20, 'pink saree', 'pink', 'female', 'she has shades', 'venkey', '9392564566', 'uppal', 'safe', '2024-04-22 16:31:49'),
(21, 'zxc', 0, 'dfg', 'df', 'male', 'dfg', 'xcv', 'xcv', 'dfdf', 'df', '2024-04-22 16:32:07'),
(22, 'venkatesh', 25, 'black', 'blue jeans', 'male', 'gundu', 'pavan', '6303601332', 'dharmavaram,etcharla', 'safe with me', '2024-04-22 16:40:47'),
(23, 'ajju', 23, 'white', 'blue', 'male', 'thin and handsome', 'bunny', '6546546546', 'nagole', 'safe', '2024-04-22 16:41:43'),
(24, 'ds', 3, 'gdb', 'gh', 'male', 'gfbg', 'ghf', 'ghfhhgf', 'gfghf', 'fghhf', '2024-04-22 16:48:58'),
(25, 'zdf', 3, 'sdf', 'sdfsd', 'male', 'adsf', 'sdff', 'sdfsdf', 'dvxc', 'zxcv', '2024-04-22 16:49:25'),
(26, 'sd', 3, 'sd', 'sdf', 'male', 'sd', 'sdf', 'sd', 'dsf', 'sd', '2024-04-22 18:50:43'),
(27, 'sss', 2, 'dz', 'sdc', 'male', 'sd', 'sdc', 'sd', 'sd', 'sdcsdc', '2024-04-22 18:50:58'),
(28, 'dfas', 3, 'dzfvdf', 'dfv', 'male', 'dfg', 'dfg', 'df', 'sdf', 'dsfg', '2024-04-22 20:12:41'),
(29, 'jh', 65, 'hg', 'jh', 'male', 'jhg', 'hj', 'hjg', 'h', 'hmn', '2024-04-22 20:13:30'),
(30, 'jh', 65, 'hg', 'jh', 'male', 'jhg', 'hj', 'hjg', 'h', 'hmn', '2024-04-22 20:14:20'),
(31, 'revanth', 20, 'red and blue', 'green', 'male', 'looking handsome', 'giri', '8956231477', 'l.b.nagar', 'good', '2024-04-22 20:15:07'),
(32, 'sfs', 32, 'sdf', 'sef', 'male', 'sdf', 'sdf', 'ssfsdfsf', 'sdf', 'sdf', '2024-04-22 20:17:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orphanage`
--
ALTER TABLE `orphanage`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `outsiders`
--
ALTER TABLE `outsiders`
  ADD PRIMARY KEY (`o_sno`),
  ADD UNIQUE KEY `o_sno` (`o_sno`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`p_sno`),
  ADD UNIQUE KEY `p_sno` (`p_sno`);

--
-- Indexes for table `success_data`
--
ALTER TABLE `success_data`
  ADD PRIMARY KEY (`s_sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orphanage`
--
ALTER TABLE `orphanage`
  MODIFY `s_no` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `outsiders`
--
ALTER TABLE `outsiders`
  MODIFY `o_sno` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `p_sno` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `success_data`
--
ALTER TABLE `success_data`
  MODIFY `s_sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
