-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 04:11 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adp`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `place_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`id`, `place_id`, `latitude`, `longitude`, `user_id`, `name`, `company`, `address`, `address2`, `city`, `state`, `country`, `zipcode`, `phone`, `url`, `email`, `logo`, `created_at`, `updated_at`) VALUES
(13, NULL, NULL, NULL, 9, 'Iliana Reid', NULL, 'Cumque nulla eos ad', 'Adipisicing similiqu', 'Enim occaecat quia v', 'Quia aut earum conse', NULL, '68103', '+1 (107) 926-8755', 'https://www.kefisegypuq.org.uk', 'tuluride@mailinator.com', 'business-13.jpg', '2022-01-03 05:09:46', '2022-01-03 05:11:34'),
(15, NULL, NULL, NULL, 10, 'Cirkle Studio Private Limited', NULL, 'B 506/07, RJD Business Hub', 'Near Naginawadi', 'Surat', 'Gujarat', NULL, '395004', '9016545336', 'https://www.cirklestudio.co', 'info@cirklestudio.com', 'business-15.png', '2022-01-04 22:08:04', '2022-01-05 05:54:03'),
(16, NULL, NULL, NULL, 9, 'App vision', NULL, '3028, Silver Business Point', 'VIP Cirkle Uttran', 'Surat', 'Gujarat', NULL, '395004', '+91 8238772233', 'http://appvisioninfotech.com/', 'appvision333@gmail.com', 'business-16.png', '2022-01-05 22:26:58', '2022-01-05 22:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `business_heading`
--

CREATE TABLE `business_heading` (
  `business_id` bigint(20) UNSIGNED DEFAULT NULL,
  `heading_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offered_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`offered_keywords`)),
  `additional_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional_keywords`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_heading`
--

INSERT INTO `business_heading` (`business_id`, `heading_id`, `image`, `offered_keywords`, `additional_keywords`) VALUES
(13, 30, NULL, '[{\"id\":57,\"super_admin_user_id\":1,\"heading_id\":30,\"name\":\"Domain Name Registration\",\"created_at\":\"2022-01-05T10:16:26.000000Z\",\"updated_at\":\"2022-01-05T10:16:26.000000Z\"},{\"id\":58,\"super_admin_user_id\":1,\"heading_id\":30,\"name\":\"Web Hosting\",\"created_at\":\"2022-01-05T10:16:33.000000Z\",\"updated_at\":\"2022-01-05T10:16:33.000000Z\"},{\"id\":59,\"super_admin_user_id\":1,\"heading_id\":30,\"name\":\"Website Design & Development\",\"created_at\":\"2022-01-05T10:16:40.000000Z\",\"updated_at\":\"2022-01-05T10:16:40.000000Z\"},{\"id\":60,\"super_admin_user_id\":1,\"heading_id\":30,\"name\":\"E-Commerce Site Development\",\"created_at\":\"2022-01-05T10:16:45.000000Z\",\"updated_at\":\"2022-01-05T10:16:45.000000Z\"},{\"id\":61,\"super_admin_user_id\":1,\"heading_id\":30,\"name\":\"SEO Optimization\",\"created_at\":\"2022-01-05T10:16:50.000000Z\",\"updated_at\":\"2022-01-05T10:16:50.000000Z\"},{\"id\":62,\"super_admin_user_id\":1,\"heading_id\":30,\"name\":\"Mobile Responsive\",\"created_at\":\"2022-01-05T10:16:54.000000Z\",\"updated_at\":\"2022-01-05T10:16:54.000000Z\"},{\"id\":63,\"super_admin_user_id\":1,\"heading_id\":30,\"name\":\"Mobile Advertising\",\"created_at\":\"2022-01-05T10:17:01.000000Z\",\"updated_at\":\"2022-01-05T10:17:01.000000Z\"},{\"id\":64,\"super_admin_user_id\":1,\"heading_id\":30,\"name\":\"Copywriting \\u2022 Photography\",\"created_at\":\"2022-01-05T10:17:18.000000Z\",\"updated_at\":\"2022-01-05T10:17:18.000000Z\"},{\"id\":65,\"super_admin_user_id\":1,\"heading_id\":30,\"name\":\"Online Reputation\",\"created_at\":\"2022-01-05T10:17:24.000000Z\",\"updated_at\":\"2022-01-05T10:17:24.000000Z\"},{\"id\":66,\"super_admin_user_id\":1,\"heading_id\":30,\"name\":\"Social Media Management\",\"created_at\":\"2022-01-05T10:17:30.000000Z\",\"updated_at\":\"2022-01-05T10:17:30.000000Z\"}]', '{\"17\":{\"id\":107,\"super_admin_user_id\":9,\"heading_id\":30,\"name\":\"Work Injuries\",\"created_at\":\"2022-01-06T03:40:41.000000Z\",\"updated_at\":\"2022-01-06T03:40:41.000000Z\"},\"18\":{\"id\":108,\"super_admin_user_id\":9,\"heading_id\":30,\"name\":\"Living Trusts\",\"created_at\":\"2022-01-06T03:40:44.000000Z\",\"updated_at\":\"2022-01-06T03:40:44.000000Z\"}}'),
(16, 29, 'heading-image-16-29.png', '[{\"id\":67,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Social Media Management\",\"created_at\":\"2022-01-05T10:17:59.000000Z\",\"updated_at\":\"2022-01-05T10:17:59.000000Z\"},{\"id\":68,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Online Reputation\",\"created_at\":\"2022-01-05T10:18:03.000000Z\",\"updated_at\":\"2022-01-05T10:18:03.000000Z\"},{\"id\":69,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Copywriting \\u2022 Photography\",\"created_at\":\"2022-01-05T10:18:08.000000Z\",\"updated_at\":\"2022-01-05T10:18:08.000000Z\"},{\"id\":70,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Mobile Advertising\",\"created_at\":\"2022-01-05T10:18:12.000000Z\",\"updated_at\":\"2022-01-05T10:18:12.000000Z\"},{\"id\":71,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Mobile Responsive\",\"created_at\":\"2022-01-05T10:18:16.000000Z\",\"updated_at\":\"2022-01-05T10:18:16.000000Z\"},{\"id\":72,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"SEO Optimization\",\"created_at\":\"2022-01-05T10:18:27.000000Z\",\"updated_at\":\"2022-01-05T10:18:27.000000Z\"},{\"id\":73,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"E-Commerce Site Development\",\"created_at\":\"2022-01-05T10:18:33.000000Z\",\"updated_at\":\"2022-01-05T10:18:33.000000Z\"},{\"id\":74,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"E-Commerce Site Development\",\"created_at\":\"2022-01-05T10:18:37.000000Z\",\"updated_at\":\"2022-01-05T10:18:37.000000Z\"},{\"id\":75,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Website Design & Development\",\"created_at\":\"2022-01-05T10:18:41.000000Z\",\"updated_at\":\"2022-01-05T10:18:41.000000Z\"},{\"id\":76,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Web Hosting\",\"created_at\":\"2022-01-05T10:18:47.000000Z\",\"updated_at\":\"2022-01-05T10:18:47.000000Z\"},{\"id\":77,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Web Video\",\"created_at\":\"2022-01-05T10:19:02.000000Z\",\"updated_at\":\"2022-01-05T10:19:02.000000Z\"},{\"id\":78,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Competitor Analysis\",\"created_at\":\"2022-01-05T10:19:07.000000Z\",\"updated_at\":\"2022-01-05T10:19:07.000000Z\"},{\"id\":79,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Market Research\",\"created_at\":\"2022-01-05T10:19:16.000000Z\",\"updated_at\":\"2022-01-05T10:19:16.000000Z\"}]', '{\"18\":{\"id\":111,\"super_admin_user_id\":9,\"heading_id\":29,\"name\":\"CRM Installation\",\"created_at\":\"2022-01-06T04:00:26.000000Z\",\"updated_at\":\"2022-01-06T04:00:26.000000Z\"},\"19\":{\"id\":112,\"super_admin_user_id\":9,\"heading_id\":29,\"name\":\"Online Directory\",\"created_at\":\"2022-01-06T04:01:34.000000Z\",\"updated_at\":\"2022-01-06T04:01:34.000000Z\"},\"20\":{\"id\":113,\"super_admin_user_id\":9,\"heading_id\":29,\"name\":\"Wordpress Website\",\"created_at\":\"2022-01-06T04:01:40.000000Z\",\"updated_at\":\"2022-01-06T04:01:40.000000Z\"},\"21\":{\"id\":114,\"super_admin_user_id\":9,\"heading_id\":29,\"name\":\"Computer Repair\",\"created_at\":\"2022-01-06T04:01:45.000000Z\",\"updated_at\":\"2022-01-06T04:01:45.000000Z\"}}'),
(15, 29, NULL, '[{\"id\":67,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Social Media Management\",\"created_at\":\"2022-01-05T10:17:59.000000Z\",\"updated_at\":\"2022-01-05T10:17:59.000000Z\"},{\"id\":68,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Online Reputation\",\"created_at\":\"2022-01-05T10:18:03.000000Z\",\"updated_at\":\"2022-01-05T10:18:03.000000Z\"},{\"id\":69,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Copywriting \\u2022 Photography\",\"created_at\":\"2022-01-05T10:18:08.000000Z\",\"updated_at\":\"2022-01-05T10:18:08.000000Z\"},{\"id\":70,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Mobile Advertising\",\"created_at\":\"2022-01-05T10:18:12.000000Z\",\"updated_at\":\"2022-01-05T10:18:12.000000Z\"},{\"id\":71,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Mobile Responsive\",\"created_at\":\"2022-01-05T10:18:16.000000Z\",\"updated_at\":\"2022-01-05T10:18:16.000000Z\"},{\"id\":72,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"SEO Optimization\",\"created_at\":\"2022-01-05T10:18:27.000000Z\",\"updated_at\":\"2022-01-05T10:18:27.000000Z\"},{\"id\":73,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"E-Commerce Site Development\",\"created_at\":\"2022-01-05T10:18:33.000000Z\",\"updated_at\":\"2022-01-05T10:18:33.000000Z\"},{\"id\":74,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"E-Commerce Site Development\",\"created_at\":\"2022-01-05T10:18:37.000000Z\",\"updated_at\":\"2022-01-05T10:18:37.000000Z\"},{\"id\":75,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Website Design & Development\",\"created_at\":\"2022-01-05T10:18:41.000000Z\",\"updated_at\":\"2022-01-05T10:18:41.000000Z\"},{\"id\":76,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Web Hosting\",\"created_at\":\"2022-01-05T10:18:47.000000Z\",\"updated_at\":\"2022-01-05T10:18:47.000000Z\"},{\"id\":77,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Web Video\",\"created_at\":\"2022-01-05T10:19:02.000000Z\",\"updated_at\":\"2022-01-05T10:19:02.000000Z\"},{\"id\":78,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Competitor Analysis\",\"created_at\":\"2022-01-05T10:19:07.000000Z\",\"updated_at\":\"2022-01-05T10:19:07.000000Z\"},{\"id\":79,\"super_admin_user_id\":1,\"heading_id\":29,\"name\":\"Market Research\",\"created_at\":\"2022-01-05T10:19:16.000000Z\",\"updated_at\":\"2022-01-05T10:19:16.000000Z\"}]', '{\"13\":{\"id\":80,\"super_admin_user_id\":10,\"heading_id\":29,\"name\":\"CRM Installation\",\"created_at\":\"2022-01-05T10:20:46.000000Z\",\"updated_at\":\"2022-01-05T10:20:46.000000Z\"},\"14\":{\"id\":84,\"super_admin_user_id\":10,\"heading_id\":29,\"name\":\"Landing Page Assignment\",\"created_at\":\"2022-01-05T10:21:12.000000Z\",\"updated_at\":\"2022-01-05T10:21:12.000000Z\"},\"19\":{\"id\":139,\"super_admin_user_id\":10,\"heading_id\":29,\"name\":\"Medical Malpractice\",\"created_at\":\"2022-01-07T03:52:20.000000Z\",\"updated_at\":\"2022-01-07T03:52:20.000000Z\"},\"20\":{\"id\":140,\"super_admin_user_id\":10,\"heading_id\":29,\"name\":\"Work Injuries\",\"created_at\":\"2022-01-07T03:55:11.000000Z\",\"updated_at\":\"2022-01-07T03:55:11.000000Z\"},\"21\":{\"id\":160,\"super_admin_user_id\":10,\"heading_id\":29,\"name\":\"Parasailing Accidents\",\"created_at\":\"2022-01-07T04:55:34.000000Z\",\"updated_at\":\"2022-01-07T04:55:34.000000Z\"},\"22\":{\"id\":161,\"super_admin_user_id\":10,\"heading_id\":29,\"name\":\"Development\",\"created_at\":\"2022-01-07T04:55:37.000000Z\",\"updated_at\":\"2022-01-07T04:55:37.000000Z\"},\"23\":{\"id\":162,\"super_admin_user_id\":10,\"heading_id\":29,\"name\":\"Living Trusts\",\"created_at\":\"2022-01-07T04:55:39.000000Z\",\"updated_at\":\"2022-01-07T04:55:39.000000Z\"}}'),
(15, 27, NULL, '[]', '[{\"id\":99,\"super_admin_user_id\":10,\"heading_id\":27,\"name\":\"Development\",\"created_at\":\"2022-01-05T10:55:47.000000Z\",\"updated_at\":\"2022-01-05T10:55:47.000000Z\"},{\"id\":100,\"super_admin_user_id\":10,\"heading_id\":27,\"name\":\"Market Research\",\"created_at\":\"2022-01-05T10:55:54.000000Z\",\"updated_at\":\"2022-01-05T10:55:54.000000Z\"},{\"id\":101,\"super_admin_user_id\":10,\"heading_id\":27,\"name\":\"Windows Setup\",\"created_at\":\"2022-01-05T10:55:58.000000Z\",\"updated_at\":\"2022-01-05T10:55:58.000000Z\"},{\"id\":102,\"super_admin_user_id\":10,\"heading_id\":27,\"name\":\"Computer Training\",\"created_at\":\"2022-01-05T10:56:04.000000Z\",\"updated_at\":\"2022-01-05T10:56:04.000000Z\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `headings`
--

CREATE TABLE `headings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `headings`
--

INSERT INTO `headings` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(20, 'Addressing Plate Service', 'heading-image-20.jpg', '2022-01-02 23:48:30', '2022-01-02 23:48:30'),
(21, 'Special Postions', 'heading-image-21.jpg', '2022-01-03 01:08:39', '2022-01-03 01:08:39'),
(22, 'Abdominal Supports', 'heading-image-22.jpg', '2022-01-03 01:08:46', '2022-01-03 01:08:46'),
(23, 'Abortion Alternatives', 'heading-image-23.png', '2022-01-03 06:44:27', '2022-01-03 23:30:24'),
(25, 'Ballroom Dancing', 'heading-image-25.png', '2022-01-04 01:13:17', '2022-01-04 01:13:17'),
(26, 'Boat Builders', 'heading-image-26.png', '2022-01-04 01:13:27', '2022-01-04 01:13:27'),
(27, 'Accountants-Certified Public', 'heading-image-27.png', '2022-01-04 01:13:58', '2022-01-04 01:13:58'),
(29, 'Web Developer', 'heading-image-29.png', '2022-01-05 04:44:28', '2022-01-05 04:44:28'),
(30, 'Graphic Design Services', 'heading-image-30.png', '2022-01-05 04:45:15', '2022-01-05 04:45:15'),
(31, 'Bagels', 'heading-image-31.png', '2022-01-06 23:28:28', '2022-01-06 23:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `super_admin_user_id` bigint(20) UNSIGNED NOT NULL,
  `heading_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `super_admin_user_id`, `heading_id`, `name`, `created_at`, `updated_at`) VALUES
(11, 1, 20, 'Bus Accidents', '2022-01-03 00:42:18', '2022-01-03 00:42:18'),
(20, 1, 21, 'Dog Bites', '2022-01-03 01:09:44', '2022-01-03 01:09:44'),
(21, 8, 21, 'Bus Accidents', '2022-01-03 01:09:46', '2022-01-03 01:09:46'),
(22, 7, 21, 'Free Consultation', '2022-01-03 01:09:49', '2022-01-03 01:09:49'),
(29, 1, 21, 'Development', '2022-01-05 00:22:16', '2022-01-05 00:22:16'),
(30, 1, 21, 'Mobile Responsive', '2022-01-05 00:22:23', '2022-01-05 00:22:23'),
(31, 1, 21, 'SEO Optimization', '2022-01-05 00:22:32', '2022-01-05 00:22:32'),
(32, 1, 21, 'Web Video', '2022-01-05 00:22:39', '2022-01-05 00:22:39'),
(33, 10, 21, 'Work Injuries', '2022-01-05 01:05:02', '2022-01-05 01:05:02'),
(34, 10, 21, 'Truck Accidents', '2022-01-05 01:06:14', '2022-01-05 01:06:14'),
(35, 10, 21, 'Slip And Fall', '2022-01-05 01:11:53', '2022-01-05 01:11:53'),
(36, 10, 21, 'Probate', '2022-01-05 01:12:11', '2022-01-05 01:12:11'),
(37, 10, 21, 'Powers of Attorney', '2022-01-05 01:12:24', '2022-01-05 01:12:24'),
(38, 10, 21, 'Pool accidents', '2022-01-05 01:14:36', '2022-01-05 01:14:36'),
(39, 10, 21, 'Pedestrian Accidents', '2022-01-05 01:14:48', '2022-01-05 01:14:48'),
(40, 10, 20, 'Work Injuries', '2022-01-05 01:15:44', '2022-01-05 01:15:44'),
(41, 10, 20, 'Slip And Fall', '2022-01-05 01:15:47', '2022-01-05 01:15:47'),
(42, 10, 20, 'Pool accidents', '2022-01-05 01:15:49', '2022-01-05 01:15:49'),
(43, 10, 20, 'Parasailing Accidents', '2022-01-05 01:38:26', '2022-01-05 01:38:26'),
(44, 10, 21, 'Parasailing Accidents', '2022-01-05 01:38:52', '2022-01-05 01:38:52'),
(45, 10, 25, 'Work Injuries', '2022-01-05 01:39:19', '2022-01-05 01:39:19'),
(46, 10, 25, 'Parasailing Accidents', '2022-01-05 01:39:22', '2022-01-05 01:39:22'),
(47, 10, 25, 'Slip And Fall', '2022-01-05 01:39:24', '2022-01-05 01:39:24'),
(48, 10, 25, 'Pool accidents', '2022-01-05 01:39:27', '2022-01-05 01:39:27'),
(49, 10, 21, 'Living Trusts', '2022-01-05 03:16:07', '2022-01-05 03:16:07'),
(50, 10, 20, 'Living Trusts', '2022-01-05 03:16:15', '2022-01-05 03:16:15'),
(51, 10, 25, 'Living Trusts', '2022-01-05 03:16:23', '2022-01-05 03:16:23'),
(52, 10, 25, 'Medical Malpractice', '2022-01-05 03:17:38', '2022-01-05 03:17:38'),
(53, 10, 20, 'Medical Malpractice', '2022-01-05 03:17:48', '2022-01-05 03:17:48'),
(54, 10, 21, 'Medical Malpractice', '2022-01-05 03:18:01', '2022-01-05 03:18:01'),
(55, 10, 20, 'Living Trusts', '2022-01-05 03:24:46', '2022-01-05 03:24:46'),
(56, 10, 21, 'Living Trusts', '2022-01-05 03:25:12', '2022-01-05 03:25:12'),
(57, 1, 30, 'Domain Name Registration', '2022-01-05 04:46:26', '2022-01-05 04:46:26'),
(58, 1, 30, 'Web Hosting', '2022-01-05 04:46:33', '2022-01-05 04:46:33'),
(59, 1, 30, 'Website Design & Development', '2022-01-05 04:46:40', '2022-01-05 04:46:40'),
(60, 1, 30, 'E-Commerce Site Development', '2022-01-05 04:46:45', '2022-01-05 04:46:45'),
(61, 1, 30, 'SEO Optimization', '2022-01-05 04:46:50', '2022-01-05 04:46:50'),
(62, 1, 30, 'Mobile Responsive', '2022-01-05 04:46:54', '2022-01-05 04:46:54'),
(63, 1, 30, 'Mobile Advertising', '2022-01-05 04:47:01', '2022-01-05 04:47:01'),
(64, 1, 30, 'Copywriting • Photography', '2022-01-05 04:47:18', '2022-01-05 04:47:18'),
(65, 1, 30, 'Online Reputation', '2022-01-05 04:47:24', '2022-01-05 04:47:24'),
(66, 1, 30, 'Social Media Management', '2022-01-05 04:47:30', '2022-01-05 04:47:30'),
(67, 1, 29, 'Social Media Management', '2022-01-05 04:47:59', '2022-01-05 04:47:59'),
(68, 1, 29, 'Online Reputation', '2022-01-05 04:48:03', '2022-01-05 04:48:03'),
(69, 1, 29, 'Copywriting • Photography', '2022-01-05 04:48:08', '2022-01-05 04:48:08'),
(70, 1, 29, 'Mobile Advertising', '2022-01-05 04:48:12', '2022-01-05 04:48:12'),
(71, 1, 29, 'Mobile Responsive', '2022-01-05 04:48:16', '2022-01-05 04:48:16'),
(72, 1, 29, 'SEO Optimization', '2022-01-05 04:48:27', '2022-01-05 04:48:27'),
(73, 1, 29, 'E-Commerce Site Development', '2022-01-05 04:48:33', '2022-01-05 04:48:33'),
(74, 1, 29, 'E-Commerce Site Development', '2022-01-05 04:48:37', '2022-01-05 04:48:37'),
(75, 1, 29, 'Website Design & Development', '2022-01-05 04:48:41', '2022-01-05 04:48:41'),
(76, 1, 29, 'Web Hosting', '2022-01-05 04:48:47', '2022-01-05 04:48:47'),
(77, 1, 29, 'Web Video', '2022-01-05 04:49:02', '2022-01-05 04:49:02'),
(78, 1, 29, 'Competitor Analysis', '2022-01-05 04:49:07', '2022-01-05 04:49:07'),
(79, 1, 29, 'Market Research', '2022-01-05 04:49:16', '2022-01-05 04:49:16'),
(80, 10, 29, 'CRM Installation', '2022-01-05 04:50:46', '2022-01-05 04:50:46'),
(84, 10, 29, 'Landing Page Assignment', '2022-01-05 04:51:12', '2022-01-05 04:51:12'),
(89, 10, 30, 'Windows Setup', '2022-01-05 04:51:57', '2022-01-05 04:51:57'),
(90, 10, 30, 'Linux Web Server', '2022-01-05 04:52:00', '2022-01-05 04:52:00'),
(93, 10, 30, 'Landing Page Assignment', '2022-01-05 04:52:09', '2022-01-05 04:52:09'),
(94, 10, 30, 'Computer Repair', '2022-01-05 04:52:12', '2022-01-05 04:52:12'),
(95, 10, 30, 'Online Directory', '2022-01-05 04:52:16', '2022-01-05 04:52:16'),
(98, 10, 21, 'Development', '2022-01-05 05:09:42', '2022-01-05 05:09:42'),
(107, 9, 30, 'Work Injuries', '2022-01-05 22:10:41', '2022-01-05 22:10:41'),
(111, 9, 29, 'CRM Installation', '2022-01-05 22:30:26', '2022-01-05 22:30:26'),
(112, 9, 29, 'Online Directory', '2022-01-05 22:31:34', '2022-01-05 22:31:34'),
(113, 9, 29, 'Wordpress Website', '2022-01-05 22:31:40', '2022-01-05 22:31:40'),
(114, 9, 29, 'Computer Repair', '2022-01-05 22:31:45', '2022-01-05 22:31:45'),
(139, 10, 29, 'Medical Malpractice', '2022-01-06 22:22:20', '2022-01-06 22:22:20'),
(140, 10, 29, 'Work Injuries', '2022-01-06 22:25:11', '2022-01-06 22:25:11'),
(160, 10, 29, 'Parasailing Accidents', '2022-01-06 23:25:34', '2022-01-06 23:25:34'),
(161, 10, 29, 'Development', '2022-01-06 23:25:37', '2022-01-06 23:25:37'),
(162, 10, 29, 'Living Trusts', '2022-01-06 23:25:39', '2022-01-06 23:25:39'),
(163, 1, 31, 'Airbag Failure', '2022-01-06 23:35:29', '2022-01-06 23:35:29'),
(164, 1, 31, 'Dog Bites', '2022-01-06 23:40:34', '2022-01-06 23:40:34'),
(165, 1, 31, 'Bus Accidents', '2022-01-06 23:40:36', '2022-01-06 23:40:36'),
(166, 1, 31, 'Free Consultation', '2022-01-06 23:40:38', '2022-01-06 23:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_12_17_111745_create_permission_tables', 2),
(6, '2018_08_08_100000_create_telescope_entries_table', 3),
(7, '2021_12_23_055834_create_businesses_table', 4),
(8, '2021_12_24_094401_create_headings_table', 5),
(9, '2021_12_24_094818_create_keywords_table', 5),
(10, '2022_01_04_093100_create_business_heading_table', 6),
(11, '2022_01_04_094506_create_business_heading_table', 7),
(12, '2022_01_10_090058_create_students_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 24),
(2, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 23);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(2, 'role-create', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(3, 'role-edit', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(4, 'role-delete', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(5, 'publisher-list', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(6, 'publisher-create', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(7, 'publisher-edit', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(8, 'publisher-delete', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(9, 'user-list', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(10, 'user-create', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(11, 'user-edit', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(12, 'user-delete', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(13, 'heading-list', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(14, 'heading-create', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(15, 'heading-edit', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(16, 'heading-delete', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(17, 'keyword-list', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(18, 'keyword-create', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(19, 'keyword-edit', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(20, 'keyword-delete', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(21, 'dashboard', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(22, 'business-list', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12'),
(23, 'business-edit', 'web', '2021-12-20 22:00:55', '2021-12-20 22:00:55'),
(28, 'database-backup', 'web', '2021-06-17 10:26:12', '2021-06-19 10:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2021-12-20 22:00:54', '2021-12-20 22:00:54'),
(2, 'publisher-admin', 'web', '2021-12-20 22:00:54', '2021-12-20 22:00:54'),
(3, 'user', 'web', '2021-12-20 22:00:54', '2021-12-20 22:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(21, 2),
(21, 3),
(22, 1),
(23, 1),
(28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publisher_id` bigint(20) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 - Inactive, 1 - Active',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_created_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `publisher_id`, `first_name`, `last_name`, `company`, `email`, `password`, `phone`, `address`, `address2`, `city`, `state`, `zipcode`, `url`, `status`, `logo`, `remember_token`, `token_created_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Parth', 'Togadiya', 'Cirkle Studio Pvt. Ltd.', 'test@gmail.com', '$2y$10$6Aj.WKZ.uM8/B3UncJyPDevueV2Q2vLwY./PB.kI7OaQeS62ZWAOe', '7817895991', 'Nisi et error non qu', 'Mollit elit enim du', 'Surat', 'Gujarat', '395004', 'https://www.gipudy.co.uk', '1', NULL, NULL, NULL, '2021-06-17 10:26:12', '2022-01-03 06:15:03'),
(2, NULL, 'Dora', 'Vinson', 'Weiss Pace Traders', 'cura@mailinator.com', '$2y$10$nh.LzJwX2CYcxED7ZVDCRunUOLK29sTEhL6./A6KvnnTJI9PAo4ca', '+1 (172) 107-5955', 'Maxime nesciunt ad', 'Delectus illo et no', 'Praesentium vitae vo', 'Ut et odio officia m', '79871', 'https://www.gonevyjuxigepo.org.au', '1', 'publisher-2.jpg', NULL, NULL, '2022-01-02 23:34:49', '2022-01-02 23:34:49'),
(3, NULL, 'Martina', 'Allison', 'Bolton Munoz LLC', 'giwupacut@mailinator.com', '$2y$10$kilraDY.hGW.J3qcjdE52OF2D5phvsmgMddXqiqck5TofqgWE/7Me', '+1 (292) 445-1037', 'Et sunt quia pariatu', 'Sit error sunt volu', 'Odit dolore labore l', 'Distinctio In id ve', '33382', 'https://www.vowyxohenyt.biz', '1', 'publisher-3.jpg', NULL, NULL, '2022-01-02 23:35:05', '2022-01-02 23:36:18'),
(4, NULL, 'Murphy', 'Contreras', 'Saunders Banks Inc', 'sulijygopy@mailinator.com', '$2y$10$24Zv0.2wBEJ/GYS./wG88./tlwkDlFeA5wjy2TWq1sc4sFLjKoZ02', '+1 (313) 447-3723', 'Obcaecati nisi ullam', 'Voluptate aliqua Fu', 'Voluptas mollitia ex', 'Perferendis tempor c', '70846', 'https://www.hikesysygil.mobi', '1', 'publisher-4.jpg', NULL, NULL, '2022-01-02 23:35:14', '2022-01-02 23:36:19'),
(5, NULL, 'Briar', 'Cooke', 'Greene Carver Traders', 'dyqywu@mailinator.com', '$2y$10$5GH60Gu7YWOgnrtF/IN4cuEmBUf1xQwnlsfWhvD4L2LMKsDXzJTOS', '+1 (573) 525-5286', 'Libero amet est aut', 'Quia sunt non quia', 'Non assumenda ea non', 'Aperiam et sequi est', '62953', 'https://www.kuluze.ws', '1', 'publisher-5.png', NULL, NULL, '2022-01-02 23:36:07', '2022-01-02 23:36:20'),
(6, 5, 'Guinevere', 'Pickett', NULL, 'xopuxihega@mailinator.com', '$2y$10$dcNN3AigNFaWiLhYUWqm8eCQ7QkLbGqZ0Vi0pEFIIox6HgCr8TX6S', '+1 (693) 396-9517', 'Amet unde praesenti', 'Repudiandae totam au', 'Illum unde expedita', 'Tempore fugiat con', '83893', NULL, '1', NULL, NULL, NULL, '2022-01-02 23:39:30', '2022-01-02 23:39:30'),
(7, 4, 'Kylie', 'Merritt', NULL, 'lukaharir@mailinator.com', '$2y$10$W3sVeCuY5M7G/.bK9hwqteaGb8a6KWIYwGsEzM/rcKVcoFtZTnzMm', '+1 (414) 292-7441', 'Nobis quos eum quisq', 'Autem dolore dolorem', 'A et in deserunt obc', 'Nisi non neque quis', '22309', NULL, '1', NULL, NULL, NULL, '2022-01-02 23:39:50', '2022-01-02 23:39:50'),
(8, 3, 'Madeline', 'Potts', NULL, 'monikitagu@mailinator.com', '$2y$10$HevuQTtLAzRXyZAk0/uRJuzx3UN0DoLozmOENxaS9ZeoHL8FFnRVK', '+1 (308) 456-4235', 'Rerum ea nostrum cum', 'Vel perferendis dolo', 'Dolorem veritatis de', 'Provident obcaecati', '84068', NULL, '1', NULL, NULL, NULL, '2022-01-02 23:40:02', '2022-01-02 23:40:10'),
(9, 2, 'Sean', 'Fowler', NULL, 'vamybopo@mailinator.com', '$2y$10$dHPDv8fwiqK5cK1UoO1vxers7WwYwKr12xmG69zY25HvxB3eQtRyu', '+1 (547) 781-9019', 'Mollitia maxime libe', 'Vel deserunt digniss', 'Consectetur explicab', 'Placeat maiores qui', '47353', NULL, '1', NULL, NULL, NULL, '2022-01-02 23:40:34', '2022-01-02 23:40:34'),
(10, 5, 'Jinal', 'Vora', NULL, 'jinal@gmail.com', '$2y$10$nkpjo6Od8I43BApC.PKcyescFMgALyQ6a0CgLEJjIn0NRI2WaijzG', '8140326585', 'Nisi et error non qu', 'Mollit elit enim du', 'Surat', 'Gujarat', '39500t', NULL, '1', NULL, NULL, NULL, '2022-01-03 01:33:55', '2022-01-03 01:34:23'),
(14, NULL, 'Ronan', 'Clements', 'Carr Odom Co', 'junugobyn@mailinator.com', '$2y$10$nhSen6wrChf3SgZ.1epT6Odo0S9j5mamd/uQRoqpSEUZT.ZnK.bUC', '+1 (612) 815-1168', 'Eveniet aut consequ', 'Id non odio volupta', 'Neque eligendi paria', 'Accusantium omnis ma', '59138', 'https://www.liwiw.me', '1', 'publisher-14.jpg', NULL, NULL, '2022-01-03 21:45:30', '2022-01-03 21:45:30'),
(15, 5, 'Jorden', 'Wilson', NULL, 'nuvot@mailinator.com', '$2y$10$FcrdYqQDYJfqgPY.iCcO4eP62a0xq/5M0fVYgRKv4qY36OQBfuSqy', '+1 (896) 253-3214', 'Minus voluptatem aut', 'Et incididunt nostru', 'Hic sapiente ut elit', 'Sunt pariatur Qui d', '83668', NULL, '1', NULL, NULL, NULL, '2022-01-06 07:27:48', '2022-01-06 07:27:48'),
(16, 5, 'Byron', 'Ward', NULL, 'puky@mailinator.com', '$2y$10$SmvfX1QE1mTX2ZGOaClOS.5CI520YLovEQ.kl42KoqJsz53qQ2Uya', '+1 (384) 481-2196', 'Perferendis fugit v', 'Accusamus mollit in', 'Esse vel quam reicie', 'Amet aliquip exerci', '81649', NULL, '1', NULL, NULL, NULL, '2022-01-06 07:28:01', '2022-01-06 07:28:01'),
(17, 5, 'Lamar', 'Harris', NULL, 'venyjyvu@mailinator.com', '$2y$10$EUR9zYrrTWRO7GaLNkA/j.5zo7HHQ4lqCgtrFcWwzob.iQA9MI9na', '+1 (773) 202-3733', 'Aperiam in id nisi', 'Distinctio Ipsum a', 'Elit voluptas nulla', 'Eos quidem et adipis', '38199', NULL, '1', NULL, NULL, NULL, '2022-01-06 07:28:07', '2022-01-06 07:28:07'),
(20, 14, 'Malcolm', 'Moreno', NULL, 'gonymydyqi@mailinator.com', '$2y$10$n2VexZPmF.yBXP818RE3GeOoR.HWl959ET93UXKRHUDEJ7M1e44SW', '+1 (719) 818-7004', 'Eius in aut sint ve', 'Dicta cupiditate a e', 'Aliquip dolor repreh', 'Illum eos consequat', '26509', NULL, '1', NULL, NULL, NULL, '2022-01-06 23:14:56', '2022-01-06 23:14:56'),
(21, 14, 'Fredericka', 'Logan', NULL, 'tipuzese@mailinator.com', '$2y$10$EdHi5RNJXAz.AKztOQIc1.1jenpW1/9g3bStROZ54v7ksFYyVFRd2', '+1 (166) 747-8216', 'Ex facere error ipsu', 'Magnam reiciendis au', 'Debitis aute consequ', 'Ipsam aliquid eiusmo', '14116', NULL, '1', NULL, NULL, NULL, '2022-01-06 23:15:30', '2022-01-06 23:15:30'),
(22, 14, 'Savannah', 'Preston', NULL, 'higumi@mailinator.com', '$2y$10$FapudiaxsxruL7q2pZ308u70gfSqECSZoxs7CaxpivLLZyVyXm4bC', '+1 (533) 167-6039', 'Quaerat ducimus sed', 'Ut similique dolores', 'Aut accusamus in dol', 'Alias nihil ut itaqu', '62803', NULL, '1', NULL, NULL, NULL, '2022-01-06 23:16:03', '2022-01-06 23:16:03'),
(23, 14, 'Dillon', 'Gaines', NULL, 'qiwuq@mailinator.com', '$2y$10$YbtOWz4QTOyjyCvEm.Zcquv5XxnxCn4OsinDJZnLbRB8mQfmyqlx6', '+1 (673) 756-2739', 'Deserunt qui animi', 'Velit excepturi et d', 'Sit sit ut sint ve', 'Nobis sit anim sed v', '86512', NULL, '1', NULL, NULL, NULL, '2022-01-06 23:16:25', '2022-01-06 23:16:25'),
(24, NULL, 'Jolie', 'Wilkinson', 'Savage Parker LLC', 'peva@mailinator.com', '$2y$10$GapNPeZlAqvWBoW6MqRKoOntXhRi3lztRK3Tdn5injVAFUE1Q/.bu', '+1 (581) 527-8808', 'Ipsum quaerat est qu', 'Vero omnis Nam volup', 'Dolore facere maxime', 'Ex perspiciatis non', '75653', 'https://www.tetahafe.ca', '1', 'publisher-24.jpg', NULL, NULL, '2022-01-07 04:17:07', '2022-01-07 04:17:07'),
(25, NULL, 'Parth', 'Togadiya', 'test', 'parthpatel@gmail.com', '$2y$10$UX0kKqupnNLuS5Dn1GPxoOhh6nlnbXnvyYS7PpqXnlBcxo3Q7eDIS', '+1 (276) 294-2131', 'Nisi et error non qu', 'Est voluptatem nihil', 'Surat,', 'Gujarat', '53773', 'https://getbootstrap.com/', '0', 'publisher-25.jpg', NULL, NULL, '2022-01-07 04:24:08', '2022-01-07 04:24:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `business_heading`
--
ALTER TABLE `business_heading`
  ADD KEY `business_heading_business_id_foreign` (`business_id`),
  ADD KEY `business_heading_heading_id_foreign` (`heading_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `headings`
--
ALTER TABLE `headings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keywords_heading_id_foreign` (`heading_id`),
  ADD KEY `super_admin_user_id` (`super_admin_user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headings`
--
ALTER TABLE `headings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `businesses`
--
ALTER TABLE `businesses`
  ADD CONSTRAINT `businesses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `business_heading`
--
ALTER TABLE `business_heading`
  ADD CONSTRAINT `business_heading_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_heading_heading_id_foreign` FOREIGN KEY (`heading_id`) REFERENCES `headings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `keywords`
--
ALTER TABLE `keywords`
  ADD CONSTRAINT `keywords_heading_id_foreign` FOREIGN KEY (`heading_id`) REFERENCES `headings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keywords_ibfk_1` FOREIGN KEY (`super_admin_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
