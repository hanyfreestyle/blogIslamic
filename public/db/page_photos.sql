-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 04:08 AM
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
-- Dumping data for table `page_photos`
--

INSERT INTO `page_photos` (`id`, `page_id`, `photo`, `photo_thum_1`, `photo_thum_2`, `position`, `print_photo`, `is_default`) VALUES
(6, 2, 'images/pages/2/معايير-تدقيق-المحتوى-في-موضوع-A053kRxpil.webp', 'images/pages/2/معايير-تدقيق-المحتوى-في-موضوع-DZVIq4QY2m.webp', NULL, 0, 2, 0),
(7, 2, 'images/pages/2/معايير-تدقيق-المحتوى-في-موضوع-QIqbccAcV5.webp', 'images/pages/2/معايير-تدقيق-المحتوى-في-موضوع-YBV4d6fJhk.webp', NULL, 0, 2, 0),
(8, 2, 'images/pages/2/معايير-تدقيق-المحتوى-في-موضوع-uDDOkDpjtS.webp', 'images/pages/2/معايير-تدقيق-المحتوى-في-موضوع-VKz530wRZa.webp', NULL, 0, 2, 0),
(9, 2, 'images/pages/2/معايير-تدقيق-المحتوى-في-موضوع-MSQD2o9lzL.webp', 'images/pages/2/معايير-تدقيق-المحتوى-في-موضوع-fGtOdJbUSf.webp', NULL, 0, 2, 0),
(10, 2, 'images/pages/2/معايير-تدقيق-المحتوى-في-موضوع-jozkzxA9E6.webp', 'images/pages/2/معايير-تدقيق-المحتوى-في-موضوع-dnEs9FZqd6.webp', NULL, 0, 2, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
