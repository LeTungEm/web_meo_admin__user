-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2023 at 07:34 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21091778_webmeo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `pass` text NOT NULL,
  `salt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_name`, `pass`, `salt`) VALUES
(2, 'nangarden', 'MTIzNDU2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `new_price` int(11) NOT NULL DEFAULT 0,
  `gender` varchar(70) DEFAULT NULL,
  `color` varchar(70) DEFAULT NULL,
  `status` varchar(70) DEFAULT NULL,
  `dewormmed` varchar(70) DEFAULT NULL,
  `origin` varchar(70) DEFAULT NULL,
  `father` varchar(70) DEFAULT NULL,
  `mother` varchar(70) DEFAULT NULL,
  `health` varchar(70) DEFAULT NULL,
  `vaccination` varchar(70) DEFAULT NULL,
  `characteristic` varchar(70) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `isShow` tinyint(1) NOT NULL DEFAULT 1,
  `image` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`cat_id`, `name`, `slug`, `age`, `price`, `new_price`, `gender`, `color`, `status`, `dewormmed`, `origin`, `father`, `mother`, `health`, `vaccination`, `characteristic`, `description`, `isShow`, `image`, `video`, `category_id`, `is_delete`) VALUES
(16, 'Mèo anh lông ngắn màu trắng', 'meo-anh-long-ngan-mau-trang', 12, 2000000, 1500000, '0', 'Màu trắng', 'sức khỏe tốt', '2 laan', '', 'kiki', 'kaka', '', '', '', '', 1, '[\"33899901th.jpg\",\"16890748th (1).jpg\"]', '[\"<iframe width=\\\"560\\\" height=\\\"315\\\" src=\\\"https://www.youtube.com/embed/83dT2nEa7h4?si=wZ9eX1LgRJSoLGrw\\\" title=\\\"YouTube video player\\\" frameborder=\\\"0\\\" allow=\\\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\\\" allowfullscreen></iframe>\",\"<iframe width=\\\"560\\\" height=\\\"315\\\" src=\\\"https://www.youtube.com/embed/83dT2nEa7h4?si=wZ9eX1LgRJSoLGrw\\\" title=\\\"YouTube video player\\\" frameborder=\\\"0\\\" allow=\\\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\\\" allowfullscreen></iframe>\"]', 1, 0),
(43, 'Meo emi', 'meo-emi', 12, 3000000, 0, '1', 'white', 'tot', '', '', '', '', '', '1 lan', '', '<p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', 1, '[\"30104581b3907b59-d4db-4cbb-b582-5bc1c23bbcc1.jpg\",\"4985048318d3e8649199e47c708.jpg\"]', '[]', 2, 0),
(44, 'Mèo scottish fold chocolate silver bs12 2 tháng tuổi', 'meo-scottish-fold-chocolate-silver-bs12-2-thang-tuoi', 2, 6500000, 500000, '1', 'Trắng nâu', 'Có sẵn, có thể đón ngay', '1 lần rồi', 'Mẹ golden, bố munchkin chocolate silver', '', '', 'Tốt', 'Đã tiêm 1 mũi vacxin', '', '', 1, '[\"96615252img_20231104_230813-01.jpg\"]', '[]', 4, 0),
(45, 'Mèo scottish fold classic tabby point 2 mắt xanh 4 tháng tuổi', 'meo-scottish-fold-classic-tabby-point-2-mat-xanh-4-thang-tuoi', 4, 3500000, 200000, '0', 'Trắng nâu tabby ', 'Có thể đón ngay', '2', 'Mèo tại NAN Garden', 'Bicolor Classic tabby ', 'Full classic Tabby', 'Tốt ', '2 mũi vacxin rồi', 'Tai nhỏ, cụp sát', '', 1, '[\"76179054img_20231106_205832-01.jpg\"]', '[]', 4, 0),
(46, 'Mèo munchkin chân ngắn black golden ny11 tone red', 'meo-munchkin-chan-ngan-black-golden-ny11-tone-red', 2, 28000000, 1000000, '1', 'Nâu cam', 'Có thể đón ngay', '1 lần', 'NAN Garden', 'Munchkin black Golden ny11 WCF - ba Khè', 'Scottishfold black golden ny11 - mẹ Doris', 'Tốt', '1 mũi vacxin rồi', 'Lùn tịt, lanh lợi', '', 1, '[\"76560574img_20231117_115821.jpg\",\"28857901img_20231103_124521.jpg\",\"22130321img_20231103_122023.jpg\",\"9883825img_20231103_115057-01.jpg\"]', '[\"https://vt.tiktok.com/ZSN9kuFMR/\"]', 3, 0),
(47, 'meo moi mau vang', 'meo-moi-mau-vang', 0, 2000000, 1900000, '0', 'trang', '', '', '', 'kiki', '', '', '', '', '<p><br></p><p><img src=\"https://taphoahotgirl.000webhostapp.com/back_end/api/Controllers/GetFileController.php?imgURL=word/2388845image_news.jpg&width=500\" style=\"width: 300px;\" class=\"fr-fic fr-dib\"></p><p><br></p><p>hinh meo hai</p><p><br></p><p><img src=\"https://taphoahotgirl.000webhostapp.com/back_end/api/Controllers/GetFileController.php?imgURL=word/29374890image_news.jpg&width=500\" style=\"width: 300px;\" class=\"fr-fic fr-dib\"></p><p><br></p><p><br></p><p>hinh anh meo nha!</p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', 1, '[\"689640242aafd3d4534b8415dd5a.jpg\"]', '[]', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `slug`, `description`) VALUES
(1, 'Mèo anh lông ngắn', 'meo-anh-long-ngan', 'Mèo anh lông ngắn'),
(2, 'Mèo anh lông dài', 'meo-anh-long-dai', 'Mèo anh lông dài'),
(3, 'Mèo Munchkin', 'meo-munchkin', 'Mèo Munchkin'),
(4, 'Mèo Scottish Fold', 'meo-scottish-fold', 'Mèo Scottish Fold'),
(5, 'Mèo Mỹ Tai Xoắn', 'meo-my-tai-xoan', 'Mèo Mỹ Tai Xoắn');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_name` varchar(70) NOT NULL,
  `user_phone` varchar(12) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `create_date` timestamp(1) NOT NULL DEFAULT current_timestamp(1),
  `isView` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_name`, `user_phone`, `address`, `total`, `create_date`, `isView`) VALUES
(23, 'Tung', '0859002124', 'Cao Lo', 120000000, '2023-10-29 12:30:26.7', 0),
(24, 'Tung Tung', '0859002124', 'Cao Lo', 120000000, '2023-10-29 12:49:44.2', 0),
(25, 'Tung Tung', '0859002124', 'Cao Lo', 240000000, '2023-11-04 09:42:15.5', 0),
(26, 'Tung Tung', '0859002124', 'Cao Lo', 360000000, '2023-11-04 09:44:36.9', 0),
(27, 'Tung Tung', '0859002124', 'Cao Lo', 240000000, '2023-11-04 09:45:38.9', 0),
(28, 'Tung Tung', '0859002124', 'Cao Lo', 120000000, '2023-11-04 09:46:31.7', 0),
(29, 'Tung Tung', '0859002124', 'Cao Lo', 120000000, '2023-11-04 09:58:24.6', 0),
(30, 'Tung Tung', '0859002124', 'Cao Lo', 120000000, '2023-11-04 10:02:50.8', 0),
(31, 'Tung Tung', '0859002124', 'Cao Lo', 241500000, '2023-11-04 10:12:17.1', 0),
(32, 'Tung Tung', '0859002124', 'Cao Lo', 120000000, '2023-11-04 10:21:34.7', 0),
(33, 'Tung Tung', '0859002124', 'Cao Lo', 123000000, '2023-11-04 10:24:50.2', 0),
(34, 'Tung Le', '0859002124', 'undefined', 121500000, '2023-11-05 08:17:45.4', 0),
(35, 'Tung Le', '0859002124', 'undefined', 121500000, '2023-11-05 08:19:16.1', 0),
(36, 'Tung Le', '0859002124', 'undefined', 241500000, '2023-11-05 08:21:44.1', 0),
(37, 'Tung Le', '0859002124', 'undefined', 241500000, '2023-11-05 08:24:11.8', 0),
(38, 'Tung Le', '0859002124', 'undefined', 241500000, '2023-11-05 08:26:25.8', 0),
(39, 'Tung Le', '0859002124', 'undefined', 241500000, '2023-11-05 08:26:37.9', 0),
(40, 'Tung Le', '0859002124', 'undefined', 241500000, '2023-11-05 08:30:23.3', 0),
(41, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 08:33:00.7', 0),
(42, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 08:43:25.5', 0),
(43, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 08:44:14.1', 0),
(44, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 08:44:15.0', 0),
(45, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 08:44:15.8', 0),
(46, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 08:55:37.2', 0),
(47, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 08:56:47.3', 0),
(48, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 08:57:02.6', 0),
(49, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 09:03:29.0', 0),
(50, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 09:04:14.2', 0),
(51, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 09:13:38.6', 0),
(52, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 09:13:42.7', 0),
(53, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 09:14:34.7', 0),
(54, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 09:15:01.2', 0),
(55, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 09:15:16.0', 0),
(56, 'Tung Le', '0859002124', 'undefined', 121500000, '2023-11-05 09:23:42.4', 0),
(57, 'Tung Le', '0859002124', 'undefined', 1500000, '2023-11-05 09:28:12.6', 0),
(58, 'Tung Le', '0859002124', 'undefined', 1500000, '2023-11-05 09:29:33.8', 0),
(59, 'Tung Le', '0859002124', 'undefined', 121500000, '2023-11-05 09:32:02.2', 0),
(60, 'Tung Le', '0859002124', 'undefined', 120000000, '2023-11-05 09:34:33.6', 0),
(61, 'Tung Le', '0859002124', 'undefined', 240000000, '2023-11-05 09:42:07.3', 1),
(62, 'Tung Le', '0859002124', 'undefined', 240000000, '2023-11-05 09:43:19.1', 1),
(63, 'Tung Le', '0859002124', 'undefined', 241500000, '2023-11-05 09:47:36.4', 1),
(64, 'Tung Le', '0859002124', 'undefined', 1500000, '2023-11-07 03:28:24.7', 1),
(65, 'Tung Le', '0859002124', 'undefined', 3000000, '2023-11-07 03:29:26.1', 1),
(66, 'Tung Le', '0859002124', 'undefined', 3000000, '2023-11-07 03:31:27.3', 1),
(67, 'Tung Le', '0859002124', 'undefined', 3000000, '2023-11-07 05:34:43.3', 1),
(68, 'Tung Le', '0859002124', 'undefined', 4900000, '2023-11-07 05:58:01.9', 1),
(69, 'Tung Le', '0859002124', 'undefined', 3000000, '2023-11-07 06:08:54.3', 1),
(70, 'Tung Lê', '0859002124', 'Mail test từ Tùng', 4500000, '2023-11-08 07:17:51.3', 1),
(71, 'Tung', '0859002124', 'test tuwf Tung', 3000000, '2023-11-08 07:18:23.8', 1),
(72, 'Tung Lê', '0859002124', 'Mail test từ Tùng', 4500000, '2023-11-08 07:19:36.2', 1),
(73, 'Nhan', '0934193740', 'undefined', 500000, '2023-11-28 09:48:49.8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `quantity`, `price`, `cat_id`) VALUES
(31, 1, 1500000, 16),
(33, 2, 1500000, 16),
(40, 1, 1500000, 16),
(56, 1, 1500000, 16),
(57, 1, 1500000, 16),
(58, 1, 1500000, 16),
(59, 1, 1500000, 16),
(63, 1, 1500000, 16),
(64, 1, 1500000, 16),
(65, 2, 1500000, 16),
(66, 2, 1500000, 16),
(67, 2, 1500000, 16),
(68, 2, 1500000, 16),
(69, 2, 1500000, 16),
(72, 1, 3000000, 43),
(72, 1, 1500000, 16),
(73, 1, 500000, 44);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `user_name` varchar(70) DEFAULT NULL,
  `user_phone` varchar(12) DEFAULT NULL,
  `star_number` tinyint(1) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `create_date` timestamp(1) NOT NULL DEFAULT current_timestamp(1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate_id`, `comment`, `user_name`, `user_phone`, `star_number`, `cat_id`, `create_date`) VALUES
(1, 'Meo on nha', 'Thien An', '0859002124', 5, 16, '2023-11-05 07:06:39.2'),
(2, 'meo ok ne', 'tung', '0859002124', 4, 16, '2023-11-05 07:46:02.9'),
(3, 'Meo nay rat ok', 'Tung', '0851910282', 4, 16, '2023-11-05 07:52:59.6'),
(11, 'Meo cute quas', 'Tung', '0859002124', 4, 43, '2023-11-08 07:02:45.9'),
(12, 'Cute', 'Nhan', '0934193740', 5, 46, '2023-11-08 07:42:55.7');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `banner` text DEFAULT NULL,
  `client_respons` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `service` text DEFAULT NULL,
  `policy` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `mating` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`banner`, `client_respons`, `about`, `service`, `policy`, `experience`, `mating`) VALUES
('', '[\"client_responses/30146617IMG_20231002_230813-01.jpg\",\"client_responses/12438219a3fe2d715dee8ab0d3ff.jpg\",\"client_responses/72867515img_20231102_125122-01.jpg\",\"client_responses/51524445img_20231101_124135-01.jpg\",\"client_responses/15863491img_20231105_171859.jpg\",\"client_responses/31128975img_20231015_183606-01.jpg\",\"client_responses/70678461img_20230918_204831-01.jpg\",\"client_responses/962331281691418049673.jpg\",\"client_responses/64214499318d3e8649199e47c708.jpg\"]', '<p><br><img src=\"https://taphoahotgirl.000webhostapp.com/back_end/api/Controllers/GetFileController.php?imgURL=word/16357654image_news.jpg&width=1200\" style=\"width: 100%;\" class=\"fr-fic fr-dib\"></p><p><br></p><p>H&Igrave;NH SỐ 2</p><p><br></p><p><br></p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', '<p>dichj&nbsp;</p><p><br><img src=\"https://taphoahotgirl.000webhostapp.com/back_end/api/Controllers/GetFileController.php?imgURL=word/92401077image_news.jpg&width=1200\" style=\"width: 100%;\" class=\"fr-fic fr-dib\"></p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', '<p>tra gop 0%</p><p><br><img src=\"https://taphoahotgirl.000webhostapp.com/back_end/api/Controllers/GetFileController.php?imgURL=word/30168084image_news.jpg&width=1200\" style=\"width: 300px;\" class=\"fr-fic fr-dib\"></p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', '<p><img src=\"https://taphoahotgirl.000webhostapp.com/back_end/api/Controllers/GetFileController.php?imgURL=word/28690177image_news.jpg&width=500\" style=\"width: 100%;\" class=\"fr-fic fr-dib\"></p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', '<p>phoi meo gom cacs yeu cau</p><p><br></p><p><img src=\"https://taphoahotgirl.000webhostapp.com/back_end/api/Controllers/GetFileController.php?imgURL=word/87722286image_news.jpg&width=1200\" style=\"width: 300px;\" class=\"fr-fic fr-dib\"></p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cat`
--
ALTER TABLE `cat`
  ADD CONSTRAINT `cat_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`cat_id`);

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
