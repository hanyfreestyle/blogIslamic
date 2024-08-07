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
-- Dumping data for table `config_meta_tags`
--

INSERT INTO `config_meta_tags` (`id`, `cat_id`, `photo`, `photo_thum_1`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'home', NULL, NULL, '2023-08-16 09:18:40', '2023-08-16 09:18:40', NULL),
(2, 'categories', NULL, NULL, '2023-08-16 11:16:16', '2024-03-28 21:54:22', NULL),
(3, 'AboutUs', NULL, NULL, '2023-08-16 11:30:42', '2024-03-28 22:41:19', NULL),
(4, 'Review', NULL, NULL, '2023-08-16 11:32:36', '2024-03-28 22:41:45', NULL),
(7, 'err_404', NULL, NULL, '2024-01-25 13:35:18', '2024-01-25 13:35:18', NULL),
(8, 'trems', NULL, NULL, '2024-08-07 06:05:55', '2024-08-07 06:05:55', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
