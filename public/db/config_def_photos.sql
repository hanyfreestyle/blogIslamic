-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2024 at 09:58 PM
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
-- Database: `blog_article`
--

--
-- Dumping data for table `config_def_photos`
--

INSERT INTO `config_def_photos` (`id`, `cat_id`, `photo`, `photo_thum_1`, `photo_thum_2`, `postion`, `created_at`, `updated_at`) VALUES
(4, 'blog', 'images/def-photo/blog-lltlovlEF3.webp', 'images/def-photo/blog-AfI3kWRbfw.webp', NULL, 4, '2023-08-16 09:18:40', '2024-03-30 18:57:31'),
(12, 'err_404', 'images/def-photo/err-404-GyYn77ncLv.webp', NULL, NULL, 10, '2024-01-25 09:48:47', '2024-01-28 16:32:58'),
(15, 'logo', 'images/def-photo/logo-CdlZqBIJe7.webp', 'images/def-photo/logo-amPNaAteuf.webp', NULL, 0, '2024-02-21 14:53:44', '2024-03-30 18:57:16'),
(16, 'categories', 'images/def-photo/categories-6kv3GqDjVd.webp', 'images/def-photo/categories-KkqVu4CzPY.webp', NULL, 0, '2024-03-30 17:19:40', '2024-03-30 17:47:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
