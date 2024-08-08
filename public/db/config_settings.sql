-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 08:46 AM
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
-- Dumping data for table `config_settings`
--

INSERT INTO `config_settings` (`id`, `web_url`, `web_status`, `switch_lang`, `phone_num`, `whatsapp_num`, `phone_call`, `whatsapp_send`, `email`, `def_url`, `facebook`, `youtube`, `twitter`, `instagram`, `linkedin`, `google_api`, `schema_type`, `schema_lat`, `schema_long`, `schema_postal_code`, `schema_country`) VALUES
(1, '#', 1, 0, '0100-00-00002', '0100-00-00002', '01000000002', '201000000002', 'info@islamic-dreams-interpretation.com', 'https://islamic-dreams-interpretation.com', 'https://www.facebook.com/', 'https://www.youtube.com', 'https://www.twitter.com/', 'https://www.Instagram.com/', 'https://www.linkedin.com/', NULL, 'Type', NULL, NULL, '21111', 'EG');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
