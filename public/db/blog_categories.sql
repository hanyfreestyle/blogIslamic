-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 10:31 AM
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
-- Database: `islamic`
--

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `parent_id`, `old_id`, `old_parent`, `count`, `deep`, `icon`, `photo`, `photo_thum_1`, `is_active`, `postion`, `created_at`, `updated_at`) VALUES
(1, NULL, 29, 0, 4895, 0, NULL, NULL, NULL, 1, 0, '2024-07-17 05:30:04', '2024-07-17 05:30:04'),
(2, NULL, 121, 0, 76, 0, NULL, NULL, NULL, 1, 0, '2024-07-17 05:30:04', '2024-07-17 05:30:04'),
(3, NULL, 122, 0, 14, 0, NULL, NULL, NULL, 1, 0, '2024-07-17 05:30:04', '2024-07-17 05:30:04'),
(4, NULL, 123, 0, 22, 0, NULL, NULL, NULL, 1, 0, '2024-07-17 05:30:04', '2024-07-17 05:30:04'),
(5, NULL, 124, 0, 14, 0, NULL, NULL, NULL, 1, 0, '2024-07-17 05:30:04', '2024-07-17 05:30:04'),
(6, NULL, 15175, 0, 205, 0, NULL, NULL, NULL, 1, 0, '2024-07-17 05:30:04', '2024-07-17 05:30:04'),
(7, NULL, 15176, 0, 6, 0, NULL, NULL, NULL, 1, 0, '2024-07-17 05:30:04', '2024-07-17 05:30:04'),
(8, NULL, 17092, 0, 143, 0, NULL, NULL, NULL, 1, 0, '2024-07-17 05:30:04', '2024-07-17 05:30:04'),
(9, NULL, 40828, 0, 0, 0, NULL, NULL, NULL, 1, 0, '2024-07-17 05:30:04', '2024-07-17 05:30:04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
