-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 09:41 PM
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
-- Dumping data for table `config_site_robots`
--

INSERT INTO `config_site_robots` (`id`, `cat_id`, `tag_manager_code`, `analytics_code`, `web_master_meta`, `web_master_html`, `google_api`, `robots`, `created_at`, `updated_at`) VALUES
(1, NULL, 'GTM-N787VV2B', 'G-HJ18793RZT', '2f5yRtAUIxahiTjP5ObVZcgnXOgDn0OF48cWtrGx4co', 'google2046fca3bd763c13', NULL, 'Disallow: /vendors/\r\nDisallow: /test/', NULL, '2024-08-08 16:40:21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
