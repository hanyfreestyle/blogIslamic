-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 11:16 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `islamic_4`
--

--
-- Dumping data for table `config_meta_tag_translations`
--

INSERT INTO `config_meta_tag_translations` (`id`, `meta_tag_id`, `locale`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', NULL, NULL, 'مقالات', 'موقع مقالات'),
(3, 2, 'ar', NULL, NULL, 'الاقسام', 'الاقسام'),
(5, 3, 'ar', NULL, NULL, 'من نحن', 'من نحن'),
(7, 4, 'ar', NULL, NULL, 'معايير تدقيق المحتوى', 'معايير تدقيق المحتوى'),
(13, 7, 'ar', NULL, NULL, 'عذرًا !! الصفحة التي تبحث عنها غير موجودة.', 'عذرًا !! الصفحة التي تبحث عنها غير موجودة.'),
(14, 8, 'ar', 'سياسية الاستخدام', 'سياسية الاستخدام', 'سياسية الاستخدام', 'سياسية الاستخدام');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
