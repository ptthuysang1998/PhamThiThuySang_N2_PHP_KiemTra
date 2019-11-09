-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 09, 2019 lúc 11:48 AM
-- Phiên bản máy phục vụ: 5.7.26
-- Phiên bản PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `danhba`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhba`
--

DROP TABLE IF EXISTS `danhba`;
CREATE TABLE IF NOT EXISTS `danhba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `phonenumber` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ac` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhba`
--

INSERT INTO `danhba` (`id`, `name`, `phonenumber`, `email`, `username`) VALUES
(22, 'Sang', '2414125125', 'sang@gmail.com', 'sang'),
(23, 'Papa', '0393597578', '1@gmail.com', 'sang'),
(24, 'Mama', '03515120', 'ma@gmail.com', 'sang'),
(25, 'Hoàng', '03515120', 'hoang@gmail.com', 'sang'),
(26, 'Khánh', '3124464656', 'khanh@gmail.com', 'sang');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `label`
--

DROP TABLE IF EXISTS `label`;
CREATE TABLE IF NOT EXISTS `label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `labelname` text COLLATE utf8_unicode_ci,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `label`
--

INSERT INTO `label` (`id`, `labelname`, `username`) VALUES
(17, 'Sang', 'sang'),
(18, 'Khác biệt', 'sang'),
(19, 'Bạn thân', 'sang'),
(20, 'Thầy giáo', 'sang'),
(21, 'Danh sách đen', 'sang'),
(22, 'Gia đình', 'sang');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `label_danhba`
--

DROP TABLE IF EXISTS `label_danhba`;
CREATE TABLE IF NOT EXISTS `label_danhba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `danhba_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `label_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `labledanhba_danhba` (`danhba_id`),
  KEY `labledanhba_lable` (`label_id`),
  KEY `ca` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `label_danhba`
--

INSERT INTO `label_danhba` (`id`, `danhba_id`, `username`, `label_id`) VALUES
(24, 22, 'sang', 17),
(25, 23, 'sang', 22),
(26, 24, 'sang', 22),
(27, 25, 'sang', 19),
(28, 26, 'sang', 19),
(29, 22, 'sang', 18),
(30, 23, 'sang', 18),
(31, 24, 'sang', 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('sang', '123');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `danhba`
--
ALTER TABLE `danhba`
  ADD CONSTRAINT `ac` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `label`
--
ALTER TABLE `label`
  ADD CONSTRAINT `label_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `label_danhba`
--
ALTER TABLE `label_danhba`
  ADD CONSTRAINT `ca` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `labledanhba_danhba` FOREIGN KEY (`danhba_id`) REFERENCES `danhba` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `labledanhba_lable` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
