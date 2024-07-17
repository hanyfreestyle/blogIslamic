-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 04:09 AM
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
-- Dumping data for table `page_photo_translations`
--

INSERT INTO `page_photo_translations` (`id`, `photo_id`, `locale`, `des`) VALUES
(5, 6, 'ar', '<h2>1. مرحلة البحث</h2>\r\n\r\n<p>في هذه المرحلة يتم تحديد الحاجة الحقيقية للمستخدم من خلال اختيار العنوان المناسب وتحري الأسلوب الأمثل للكتابة الذي يضمن الفهم الأفضل والتدرج في المعلومة والحصول عليها بسهولة.</p>'),
(6, 7, 'ar', '<h2>2. مرحلة الكتابة</h2>\r\n\r\n<p>يقوم الكتاب والخبراء في المجالات المتنوعة بكتابة المقالات، استناداً لسياسات المحتوى في شركة موضوع وبالرجوع لمصادر المعلومات ذات الموثوقية العالية.</p>'),
(7, 8, 'ar', '<h2>3. مرحلة التدقيق</h2>\r\n\r\n<p>تخضع جميع المقالات المكتوبة لعدة مراحل من التدقيق والمراجعة من قبل خبراء للتأكد من دقة المعلومات المكتوبة وشموليتها وفائدتها للمستخدم وأصالتها</p>'),
(8, 9, 'ar', '<h2>4. مرحلة استخدام التكنولوجيا المتقدمة</h2>\r\n\r\n<p>حيث يتم استخدام أدوات الذكاء الاصطناعي المطورة من قبل موضوع لتحرير جميع المقالات وتصحيحها.</p>'),
(9, 10, 'ar', '<h2>5. مرحلة المراجعة</h2>\r\n\r\n<p>يقوم فريقنا بشكل دوري، بمراجعة وإثراء المحتوى للتأكد من حداثته ودقته وتلبيته لاحتياجات القراء</p>');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
