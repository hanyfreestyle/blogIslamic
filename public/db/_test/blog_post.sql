-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 01:27 PM
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
-- Database: `islamic_2`
--

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`id`, `old_id`, `user_id`, `is_active`, `photo`, `photo_thum_1`, `published_at`, `deleted_at`, `created_at`, `updated_at`, `view_count`) VALUES
(1, NULL, 1, 1, NULL, NULL, '2024-07-23', NULL, '2024-07-23 09:10:42', '2024-07-23 09:10:42', NULL),
(2, NULL, 1, 1, NULL, NULL, '2024-07-25', NULL, '2024-07-25 06:47:43', '2024-07-25 06:47:43', NULL),
(3, NULL, 1, 1, NULL, NULL, '2024-07-25', NULL, '2024-07-25 07:50:36', '2024-07-25 07:50:36', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;