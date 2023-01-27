-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2021 at 12:33 PM
-- Server version: 10.3.31-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lawwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us_page`
--

CREATE TABLE `about_us_page` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_1_heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_1_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_1_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_2_heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_2_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_2_image_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_2_image_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_2_image_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_2_image_4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_3_heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_3_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_3_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_4_heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_4_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_4_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_5_heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_5_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_5_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `academy`
--

CREATE TABLE `academy` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_1_heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_1_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_2_heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_2_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_3_heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_3_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_4_heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_4_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_1_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `academy_courses`
--

CREATE TABLE `academy_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details_page_heading` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(20,2) NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `academy_facilities`
--

CREATE TABLE `academy_facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `academy_faculties`
--

CREATE TABLE `academy_faculties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 Default 0 Not Default ',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 inative',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` bigint(20) NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` bigint(20) DEFAULT NULL,
  `town_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `banner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beautician_docs`
--

CREATE TABLE `beautician_docs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beautician_gallery`
--

CREATE TABLE `beautician_gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beautician_services`
--

CREATE TABLE `beautician_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beautician_working_times`
--

CREATE TABLE `beautician_working_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `day` enum('MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `date` date NOT NULL,
  `type` enum('group','individual') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'individual',
  `current_status` enum('Pending','PaymentFailed','Booked','Assigned','Accepted','OnTheWay','Postponed','Cancel','Reached','Start','Completed','Refunded','Temperature uploaded','Scanned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `amount` double(20,2) NOT NULL,
  `note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_at` enum('home','salon') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'home',
  `txn_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_assigns`
--

CREATE TABLE `booking_assigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `temperature` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Temperature_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission` double(20,2) NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `assign_user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Assigned','OnTheWay','Postponed','Cancel','Start','Completed','Refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Assigned',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_cancel_reasons`
--

CREATE TABLE `booking_cancel_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_services`
--

CREATE TABLE `booking_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Free','Buy') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Buy',
  `booking_id` int(10) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_statuses`
--

CREATE TABLE `booking_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `status` enum('Pending','PaymentFailed','Booked','Assigned','Accepted','OnTheWay','Postponed','Cancel','Reached','Start','Completed','Refunded','Temperature uploaded','Scanned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_users`
--

CREATE TABLE `booking_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `temperature` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Temperature_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_times`
--

CREATE TABLE `business_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day` enum('MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorey_type` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=>Service-Categorey,1=>Product-Categorey',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=>active,0=>deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(20,2) NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_features`
--

CREATE TABLE `certificate_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_users`
--

CREATE TABLE `certificate_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `txn_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('PENDING','PAYMENTFAILED','SUCCESS') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `status` enum('PENDING','UPLOADED','FAILED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `certificate_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_numbers`
--

CREATE TABLE `contact_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 inactive 1 Active',
  `default_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 Default 0 Not Default ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_features`
--

CREATE TABLE `course_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_users`
--

CREATE TABLE `course_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `txn_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('PENDING','PAYMENTFAILED','SUCCESS') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_id` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 inactive 1 Active',
  `default_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 Default 0 Not Default ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_questions`
--

CREATE TABLE `faq_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachfile` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_news`
--

CREATE TABLE `gallery_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `heading` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_photos`
--

CREATE TABLE `gallery_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_videos`
--

CREATE TABLE `gallery_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_conditions`
--

CREATE TABLE `health_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `H_p_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Dob` date NOT NULL,
  `Marital_status` enum('Married','Single','Others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Occupation` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Emergency_number` bigint(20) NOT NULL,
  `Plastic_Surgery_Face` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Plastic_Surgery_Date_Face` date DEFAULT NULL,
  `Plastic_Surgery_Type_Face` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Plastic_Surgery_Body` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Plastic_Surgery_Date_Body` date DEFAULT NULL,
  `Plastic_Surgery_Type_Body` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Pregnant` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `Pregnancy_Month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Medications` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Medications_Specify` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Skin_Allergy` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Skin_Allergy_Specify` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Skin_Type_Specify` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Service_Focus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Service_Focus_Remark` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Last_Facial_Treatment` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Last_Facial_Treatment_date` date DEFAULT NULL,
  `Last_Facial_Treatment_Type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Last_Facial_Treatment_How_Often` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Skincare_Routine_At_Home` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Skincare_Routine_At_Specify` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Product_Brand_Use` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Last_Body_Treatment` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Last_Body_Treatment_Date` date DEFAULT NULL,
  `Last_Body_Treatment_Type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Last_Body_Treatment_How_Often` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Body_Allergy_Sensitive` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Body_Allergy_Sensitive_Specify` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Joint_Condition` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Joint_Condition_Specify` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Bone_Condition` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Bone_Condition_Specify` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Circulatory_Condition` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Circulatory_Condition_Specify` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Diabetes` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Diabetes_Specify` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Customer_Sign` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_page_contents`
--

CREATE TABLE `home_page_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_us_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `membership_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_us_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_us_image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_us_video` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 inactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `html_template` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_template` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `for` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_for` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `default_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 Default 0 Not Default ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (`id`, `title`, `subject`, `html_template`, `text_template`, `for`, `template_for`, `status`, `default_status`, `created_at`, `updated_at`) VALUES
(1, 'PAYMENTFAILED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Order', 'PAYMENTFAILED', '1', '0', '2021-11-15 06:47:25', '2021-11-15 06:47:25'),
(2, 'ORDERED', 'Your order is confirmed', '<p>We know you can&#39;t wait to get your hands on it. Our team is working hard while ensuring highest safety standards in these tough times. Deliveries may take longer than usual, we are trying our best to deliver it soon.</p>', NULL, 'Order Success', 'ORDERED', '1', '0', '2021-11-15 06:47:25', '2021-11-15 06:47:25'),
(3, 'DISPATCH', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Order On The Way', 'DISPATCH', '1', '0', '2021-11-15 06:47:25', '2021-11-15 06:47:25'),
(4, 'ONTHEWAY', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Order Payment Failed', 'ONTHEWAY', '1', '0', '2021-11-15 06:47:25', '2021-11-15 06:47:25'),
(5, 'DELIVERED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Order Cancel', 'DELIVERED', '1', '0', '2021-11-15 06:47:25', '2021-11-15 06:47:25'),
(6, 'CANCEL', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'CANCEL', 'CANCEL', '1', '0', '2021-11-15 06:47:25', '2021-11-15 06:47:25'),
(7, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Order Refund', 'REFUNDED', '1', '0', '2021-11-15 06:47:25', '2021-11-15 06:47:25'),
(8, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Booking Payment Failed', 'PaymentFailed', '1', '0', '2021-11-15 06:47:25', '2021-11-15 06:47:25'),
(9, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Booking Success', 'Booked', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(10, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Booking Assigned to PBTLA', 'Assigned', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(11, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Booking Accepted by PBTLA', 'Accepted', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(12, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'PBTLA On The Way', 'OnTheWay', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(13, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Booking Postponed', 'Postponed', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(14, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Booking Cancel', 'Cancel', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(15, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'PBTLA Reached On Destination', 'Reached', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(16, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Service started by PBTLA', 'Start', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(17, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Booking Cancel', 'Completed', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(18, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Booking Refund', 'Refunded', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(19, 'REFUNDED', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Membership Purchase', 'Membership', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26'),
(20, 'Booking Assign mail to PBTA', 'your order has been PAYMENT FAILED', 'your order has been PAYMENT FAILED', NULL, 'Booking Assign mail to PBTA', 'Bookingassigntopbt', '1', '0', '2021-11-15 06:47:26', '2021-11-15 06:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `membership_features`
--

CREATE TABLE `membership_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_features`
--

INSERT INTO `membership_features` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Lawwa.Asia Welcome Kit', NULL, NULL),
(2, 'Free 1 Main Service (Classic Massage)', NULL, NULL),
(3, 'Enjoy our special promotion exclusive', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `membership_has_features`
--

CREATE TABLE `membership_has_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `membership_feature_id` bigint(20) UNSIGNED NOT NULL,
  `membership_plan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans`
--

CREATE TABLE `membership_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 inactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membership_users`
--

CREATE TABLE `membership_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `txn_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membership_plan_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('PENDING','PAYMENTFAILED','SUCCESS') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `membership_plan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_ship_services`
--

CREATE TABLE `member_ship_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `membership_plan_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_10_053606_create_brands_table', 1),
(5, '2020_09_11_095805_create_products_table', 1),
(6, '2020_09_14_131833_create_pages_table', 1),
(7, '2020_09_14_131833_create_privacy_policy_table', 1),
(8, '2020_09_14_131833_create_social_link_table', 1),
(9, '2020_09_15_105842_create_banners_table', 1),
(10, '2020_09_17_094326_create_categories_table', 1),
(11, '2020_09_31_194119_create_services_table', 1),
(12, '2020_10_14_064647_create_product_categories_table', 1),
(13, '2020_10_14_064647_create_service_categories_table', 1),
(14, '2020_10_21_061339_create_product_images_table', 1),
(15, '2020_10_22_115708_create_product_cart_table', 1),
(16, '2020_10_22_115708_create_service_cart_table', 1),
(17, '2020_11_06_070127_create_product_brands_table', 1),
(18, '2020_11_09_074150_create_notifications_table', 1),
(19, '2020_11_09_133134_create_faq_questions_table', 1),
(20, '2020_11_17_055846_create_academy_courses_table', 1),
(21, '2020_11_17_055846_create_gallery_news_table', 1),
(22, '2020_11_17_055846_create_gallery_photos_table', 1),
(23, '2020_11_17_055846_create_gallery_videos_table', 1),
(24, '2020_11_17_111643_create_product_videos_table', 1),
(25, '2020_11_29_065748_create_profile_informations_table', 1),
(26, '2020_11_29_065748_create_user_address_table', 1),
(27, '2020_12_29_075312_create_permission_tables', 1),
(28, '2021_01_04_124428_create_beautician_docs_table', 1),
(29, '2021_01_04_124428_create_beautician_gallery_table', 1),
(30, '2021_01_05_052930_add_parent_id_to_categories_table', 1),
(31, '2021_01_05_103301_create_beautician_services_table', 1),
(32, '2021_01_21_075555_create_mail_templates_table', 1),
(33, '2021_02_25_075847_create_addresses_table', 1),
(34, '2021_02_25_075914_create_emails_table', 1),
(35, '2021_02_25_080017_create_contact_numbers_table', 1),
(36, '2021_03_01_094316_create_home_page_contents_table', 1),
(37, '2021_03_05_043216_create_business_times_table', 1),
(38, '2021_03_09_124125_create_country_state_city_tables', 1),
(39, '2021_03_22_052933_create_beautician_working_times_table', 1),
(40, '2021_03_23_081613_create_bookings_table', 1),
(41, '2021_03_24_105835_create_booking_services_table', 1),
(42, '2021_03_24_105835_create_booking_users_table', 1),
(43, '2021_03_25_045745_create_video_recodings_table', 1),
(44, '2021_04_01_094316_create_about_us_page_table', 1),
(45, '2021_04_01_094316_create_academy_table', 1),
(46, '2021_04_03_035317_create_academy_facilities_table', 1),
(47, '2021_04_03_035317_create_academy_faculty_table', 1),
(48, '2021_04_05_061339_create_my_favourites_table', 1),
(49, '2021_04_05_114720_create_working_times_table', 1),
(50, '2021_04_06_121050_create_booking_statuses_table', 1),
(51, '2021_04_12_170248_create_bank_details_table', 1),
(52, '2021_04_13_204505_create_orders_table', 1),
(53, '2021_04_14_105835_create_order_products_table', 1),
(54, '2021_04_14_121147_create_order_statuses_table', 1),
(55, '2021_04_23_163641_create_wallets_table', 1),
(56, '2021_04_23_163826_create_work_histories_table', 1),
(57, '2021_04_27_142445_create_membership_plans_table', 1),
(58, '2021_04_28_111406_create_membership_users_table', 1),
(59, '2021_04_28_124909_create_order_cancel_reasons_table', 1),
(60, '2021_04_29_091542_create_tickets_table', 1),
(61, '2021_04_29_102115_create_ticket_categories_table', 1),
(62, '2021_04_29_160300_create_ticket_comments_table', 1),
(63, '2021_04_30_051517_create_query_management_table', 1),
(64, '2021_05_01_054527_create_membership_features_table', 1),
(65, '2021_05_01_055240_create_membership_has_features_table', 1),
(66, '2021_05_04_124909_create_booking_cancel_reasons_table', 1),
(67, '2021_05_04_161008_create_feedback_table', 1),
(68, '2021_05_05_070930_create_user_ratings_table', 1),
(69, '2021_05_06_051721_create_product_review_ratings_table', 1),
(70, '2021_05_11_161938_create_member_ship_services_table', 1),
(71, '2021_05_11_180454_create_user_free_services_table', 1),
(72, '2021_05_12_064227_add_user_member_ship_plan_to_users_table', 1),
(73, '2021_05_17_130921_create_term_conditions_table', 1),
(74, '2021_05_20_055846_create_settings_table', 1),
(75, '2021_05_24_045737_create_payment history_table', 1),
(76, '2021_05_25_111301_create_course_features_table', 1),
(77, '2021_05_25_150033_create_course_users_table', 1),
(78, '2021_05_25_164107_create_certificates_table', 1),
(79, '2021_05_25_170521_create_certificate_features_table', 1),
(80, '2021_05_25_181103_create_certificate_users_table', 1),
(81, '2021_05_28_110149_create_notification_attachments_table', 1),
(82, '2021_05_31_121133_create_booking_assigns_table', 1),
(83, '2021_06_15_171802_create_banks_table', 1),
(84, '2021_06_18_084809_create_recruitments_table', 1),
(85, '2021_06_18_101740_create_recruitment_features_table', 1),
(86, '2021_06_21_110137_add_soft_delete_to_users', 1),
(87, '2021_06_22_144836_create_health_conditions_table', 1),
(88, '2021_06_23_170124_create_recruitment_applies_table', 1),
(89, '2021_06_30_175514_create_product_colors_table', 1),
(90, '2021_06_30_175717_create_product_sizes_table', 1),
(91, '2021_07_13_124927_add_address_type_to_orders_table', 1),
(92, '2021_08_16_111254_add_tracking_id_to_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `my_favourites`
--

CREATE TABLE `my_favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `for` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_attachments`
--

CREATE TABLE `notification_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `total_quantity` tinyint(4) NOT NULL,
  `txn_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_option` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ShippingCharges` decimal(10,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_status` enum('PENDING','PAYMENTFAILED','ORDERED','DISPATCH','ONTHEWAY','DELIVERED','CANCEL','REFUNDED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_cancel_reasons`
--

CREATE TABLE `order_cancel_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` decimal(20,2) NOT NULL,
  `product_quantity` tinyint(4) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `status` enum('PENDING','PAYMENTFAILED','ORDERED','DISPATCH','ONTHEWAY','DELIVERED','CANCEL','REFUNDED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `ShippingCharges` decimal(10,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `txn_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Order','Booking','Membership','Certification','Course') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Failed','Successed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_for` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `permission_for`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'bookings-list', 'Bookings', 'web', '2021-11-15 06:47:13', '2021-11-15 06:47:13'),
(2, 'bookings-show', 'Bookings', 'web', '2021-11-15 06:47:13', '2021-11-15 06:47:13'),
(3, 'bookings-assign', 'Bookings', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(4, 'orders-list', 'Orders', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(5, 'orders-show', 'Orders', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(6, 'orders-status-change', 'Orders', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(7, 'Mail-Templates-list', 'Mail-Templates', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(8, 'Mail-Templates-show', 'Mail-Templates', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(9, 'Mail-Templates-edit', 'Mail-Templates', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(10, 'queries-list', 'Queries', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(11, 'queries-show', 'Queries', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(12, 'queries-status-change', 'Queries', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(13, 'Feedbacks-list', 'Feedbacks', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(14, 'Feedbacks-show', 'Feedbacks', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(15, 'Pages-list', 'Pages', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(16, 'Pages-show', 'Pages', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(17, 'Pages-edit', 'Pages', 'web', '2021-11-15 06:47:14', '2021-11-15 06:47:14'),
(18, 'Tickets-close', 'Tickets', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(19, 'Tickets-show', 'Tickets', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(20, 'Tickets-comments', 'Tickets', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(21, 'Tickets-list', 'Tickets', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(22, 'Notifications-show', 'Notifications', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(23, 'Notifications-edit', 'Notifications', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(24, 'Notifications-create', 'Notifications', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(25, 'Notifications-list', 'Settings', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(26, 'Notifications-delete', 'Settings', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(27, 'Courses-list', 'Courses', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(28, 'Payments-list', 'Payments', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(29, 'Certificates-list', 'Certificates', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(30, 'Certificates-update-change', 'Certificates', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(31, 'recruitmentapplies-list', 'Recruitment Applies', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(32, 'recruitmentapplies-show', 'Recruitment Applies', 'web', '2021-11-15 06:47:15', '2021-11-15 06:47:15'),
(33, 'role-list', 'Roles', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(34, 'role-create', 'Roles', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(35, 'role-edit', 'Roles', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(36, 'role-delete', 'Roles', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(37, 'role-show', 'Roles', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(38, 'banners-list', 'Banners', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(39, 'banners-create', 'Banners', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(40, 'banners-edit', 'Banners', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(41, 'banners-delete', 'Banners', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(42, 'banners-show', 'Banners', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(43, 'user-list', 'Users', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(44, 'user-create', 'Users', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(45, 'user-edit', 'Users', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(46, 'user-delete', 'Users', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(47, 'user-show', 'Users', 'web', '2021-11-15 06:47:16', '2021-11-15 06:47:16'),
(48, 'product-list', 'Products', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(49, 'product-create', 'Products', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(50, 'product-edit', 'Products', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(51, 'product-delete', 'Products', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(52, 'product-show', 'Products', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(53, 'membershipplan-list', 'Membership-plan', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(54, 'membershipplan-create', 'Membership-plan', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(55, 'membershipplan-edit', 'Membership-plan', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(56, 'membershipplan-delete', 'Membership-plan', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(57, 'membershipplan-show', 'Membership-plan', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(58, 'categories-list', 'Category', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(59, 'categories-create', 'Category', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(60, 'categories-edit', 'Category', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(61, 'categories-delete', 'Category', 'web', '2021-11-15 06:47:17', '2021-11-15 06:47:17'),
(62, 'categories-show', 'Category', 'web', '2021-11-15 06:47:18', '2021-11-15 06:47:18'),
(63, 'service-list', 'Services', 'web', '2021-11-15 06:47:18', '2021-11-15 06:47:18'),
(64, 'service-create', 'Services', 'web', '2021-11-15 06:47:18', '2021-11-15 06:47:18'),
(65, 'service-edit', 'Services', 'web', '2021-11-15 06:47:18', '2021-11-15 06:47:18'),
(66, 'service-delete', 'Services', 'web', '2021-11-15 06:47:18', '2021-11-15 06:47:18'),
(67, 'service-show', 'Services', 'web', '2021-11-15 06:47:18', '2021-11-15 06:47:18'),
(68, 'sociallinks-list', 'Social-Links', 'web', '2021-11-15 06:47:18', '2021-11-15 06:47:18'),
(69, 'sociallinks-create', 'Social-Links', 'web', '2021-11-15 06:47:18', '2021-11-15 06:47:18'),
(70, 'sociallinks-edit', 'Social-Links', 'web', '2021-11-15 06:47:18', '2021-11-15 06:47:18'),
(71, 'sociallinks-delete', 'Social-Links', 'web', '2021-11-15 06:47:18', '2021-11-15 06:47:18'),
(72, 'sociallinks-show', 'Social-Links', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(73, 'Beauticians', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(74, 'Customers', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(75, 'Membership Customers', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(76, 'Total Orders', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(77, 'Total Products', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(78, 'Total Bookings', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(79, 'Booking Revenue', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(80, 'Order Revenue', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(81, 'Certification', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(82, 'Course Revenue', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19'),
(83, 'Membership Revenue', 'Dashboard', 'web', '2021-11-15 06:47:19', '2021-11-15 06:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_thumbnail` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) DEFAULT NULL,
  `unit_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(20,2) NOT NULL,
  `sale_price` decimal(20,2) NOT NULL,
  `member_price` decimal(20,2) NOT NULL,
  `stock` smallint(6) NOT NULL DEFAULT 0,
  `product_type` enum('Simple','Variable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Simple',
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_cart`
--

CREATE TABLE `product_cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` tinyint(4) NOT NULL DEFAULT 0,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_review_ratings`
--

CREATE TABLE `product_review_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_videos`
--

CREATE TABLE `product_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `video_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_informations`
--

CREATE TABLE `profile_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Dob` date NOT NULL,
  `Gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `About_us` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Id_Proof` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nric` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Emergency_Number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `User_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `query_management`
--

CREATE TABLE `query_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachfile` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruitments`
--

CREATE TABLE `recruitments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `heading` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_applies`
--

CREATE TABLE `recruitment_applies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachfile` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_features`
--

CREATE TABLE `recruitment_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recruitment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Beautician', 'web', '2021-11-15 06:47:20', '2021-11-15 06:47:20'),
(2, 'Customer', 'web', '2021-11-15 06:47:20', '2021-11-15 06:47:20'),
(3, 'Admin', 'web', '2021-11-15 06:47:20', '2021-11-15 06:47:20');

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
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3),
(64, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(69, 3),
(70, 3),
(71, 3),
(72, 3),
(73, 3),
(74, 3),
(75, 3),
(76, 3),
(77, 3),
(78, 3),
(79, 3),
(80, 3),
(81, 3),
(82, 3),
(83, 3);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `employee_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `amount` decimal(20,2) NOT NULL,
  `brief_detail` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `houre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minute` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UserId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_cart`
--

CREATE TABLE `service_cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Free','Buy') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Buy',
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `BeauticianCommission` int(11) NOT NULL DEFAULT 0,
  `ShippingCharges` int(11) NOT NULL DEFAULT 0,
  `ChargeCondition` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `BeauticianCommission`, `ShippingCharges`, `ChargeCondition`) VALUES
(1, '2021-11-15 06:47:25', '2021-11-15 06:47:25', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `term_conditions`
--

CREATE TABLE `term_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `term` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_categories`
--

INSERT INTO `ticket_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Order Related', NULL, NULL),
(2, 'Technical Support', NULL, NULL),
(3, 'Booking Related', NULL, NULL),
(4, 'Dispute & Complaint', NULL, NULL),
(5, 'Other', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address_Location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 deactive 1 Active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `membership_plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `profile_pic`, `Address_Location`, `phone_no`, `status`, `email_verified_at`, `password`, `avatar`, `provider`, `provider_id`, `access_token`, `remember_token`, `created_at`, `updated_at`, `membership_plan_id`, `deleted_at`) VALUES
(1, 'kayyum khan', 'admin@lawwa.com', NULL, NULL, '8888888888', '1', NULL, '$2y$10$qrh0dHBe4nWDAH3MJzwLoujkViRTF.LslCu8skfiOh/o9405hb4j2', NULL, NULL, NULL, NULL, NULL, '2021-11-15 06:47:20', '2021-11-15 06:47:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MobileNumber` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `State_Province_Region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Town_City` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Zip_Postcode` bigint(20) DEFAULT NULL,
  `Type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address_line1` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address_line2` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Latitude` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_free_services`
--

CREATE TABLE `user_free_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

CREATE TABLE `user_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_recodings`
--

CREATE TABLE `video_recodings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `narration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `working_times`
--

CREATE TABLE `working_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_histories`
--

CREATE TABLE `work_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `services_amount` decimal(10,2) NOT NULL,
  `booking_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `customer_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `commission` decimal(10,2) NOT NULL DEFAULT 0.00,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Pending','Accepted','Cancel','Completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us_page`
--
ALTER TABLE `about_us_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academy`
--
ALTER TABLE `academy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academy_courses`
--
ALTER TABLE `academy_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academy_facilities`
--
ALTER TABLE `academy_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academy_faculties`
--
ALTER TABLE `academy_faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_details_user_id_index` (`user_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beautician_docs`
--
ALTER TABLE `beautician_docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beautician_docs_user_id_index` (`user_id`);

--
-- Indexes for table `beautician_gallery`
--
ALTER TABLE `beautician_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beautician_gallery_user_id_index` (`user_id`);

--
-- Indexes for table `beautician_services`
--
ALTER TABLE `beautician_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beautician_services_service_id_index` (`service_id`),
  ADD KEY `beautician_services_user_id_index` (`user_id`);

--
-- Indexes for table `beautician_working_times`
--
ALTER TABLE `beautician_working_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beautician_working_times_user_id_index` (`user_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_assigns`
--
ALTER TABLE `booking_assigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_assigns_booking_id_index` (`booking_id`),
  ADD KEY `booking_assigns_assign_user_id_index` (`assign_user_id`);

--
-- Indexes for table `booking_cancel_reasons`
--
ALTER TABLE `booking_cancel_reasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_cancel_reasons_booking_id_index` (`booking_id`);

--
-- Indexes for table `booking_services`
--
ALTER TABLE `booking_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_services_booking_id_index` (`booking_id`),
  ADD KEY `booking_services_service_id_index` (`service_id`);

--
-- Indexes for table `booking_statuses`
--
ALTER TABLE `booking_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_statuses_booking_id_index` (`booking_id`);

--
-- Indexes for table `booking_users`
--
ALTER TABLE `booking_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_users_user_id_foreign` (`user_id`),
  ADD KEY `booking_users_booking_id_index` (`booking_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_times`
--
ALTER TABLE `business_times`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `business_times_day_unique` (`day`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD KEY `categories_parent_id_index` (`parent_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_features`
--
ALTER TABLE `certificate_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificate_features_certificate_id_index` (`certificate_id`);

--
-- Indexes for table `certificate_users`
--
ALTER TABLE `certificate_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificate_users_user_id_index` (`user_id`),
  ADD KEY `certificate_users_certificate_id_index` (`certificate_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_numbers`
--
ALTER TABLE `contact_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_features`
--
ALTER TABLE `course_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_features_course_id_index` (`course_id`);

--
-- Indexes for table `course_users`
--
ALTER TABLE `course_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_users_user_id_index` (`user_id`),
  ADD KEY `course_users_course_id_index` (`course_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faq_questions`
--
ALTER TABLE `faq_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_news`
--
ALTER TABLE `gallery_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_photos`
--
ALTER TABLE `gallery_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_videos`
--
ALTER TABLE `gallery_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_conditions`
--
ALTER TABLE `health_conditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `health_conditions_user_id_index` (`user_id`);

--
-- Indexes for table `home_page_contents`
--
ALTER TABLE `home_page_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_features`
--
ALTER TABLE `membership_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_has_features`
--
ALTER TABLE `membership_has_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_has_features_membership_feature_id_index` (`membership_feature_id`),
  ADD KEY `membership_has_features_membership_plan_id_index` (`membership_plan_id`);

--
-- Indexes for table `membership_plans`
--
ALTER TABLE `membership_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_users`
--
ALTER TABLE `membership_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_users_user_id_index` (`user_id`),
  ADD KEY `membership_users_membership_plan_id_index` (`membership_plan_id`);

--
-- Indexes for table `member_ship_services`
--
ALTER TABLE `member_ship_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_ship_services_membership_plan_id_index` (`membership_plan_id`),
  ADD KEY `member_ship_services_service_id_index` (`service_id`);

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
-- Indexes for table `my_favourites`
--
ALTER TABLE `my_favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `my_favourites_product_id_foreign` (`product_id`),
  ADD KEY `my_favourites_user_id_foreign` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_sender_id_index` (`sender_id`),
  ADD KEY `notifications_receiver_id_index` (`receiver_id`);

--
-- Indexes for table `notification_attachments`
--
ALTER TABLE `notification_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_attachments_notification_id_index` (`notification_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_index` (`user_id`);

--
-- Indexes for table `order_cancel_reasons`
--
ALTER TABLE `order_cancel_reasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_cancel_reasons_order_id_index` (`order_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_index` (`order_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_statuses_order_id_index` (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_name_unique` (`name`),
  ADD UNIQUE KEY `pages_url_unique` (`url`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_history_user_id_index` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_brands_product_id_foreign` (`product_id`),
  ADD KEY `product_brands_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_cart_product_id_index` (`product_id`),
  ADD KEY `product_cart_user_id_index` (`user_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_product_id_foreign` (`product_id`),
  ADD KEY `product_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_colors_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_review_ratings`
--
ALTER TABLE `product_review_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_review_ratings_order_id_index` (`order_id`),
  ADD KEY `product_review_ratings_user_id_index` (`user_id`),
  ADD KEY `product_review_ratings_product_id_index` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_videos`
--
ALTER TABLE `product_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_videos_product_id_foreign` (`product_id`);

--
-- Indexes for table `profile_informations`
--
ALTER TABLE `profile_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_informations_user_id_index` (`User_id`);

--
-- Indexes for table `query_management`
--
ALTER TABLE `query_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitments`
--
ALTER TABLE `recruitments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitment_applies`
--
ALTER TABLE `recruitment_applies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitment_features`
--
ALTER TABLE `recruitment_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recruitment_features_recruitment_id_index` (`recruitment_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_userid_index` (`UserId`);

--
-- Indexes for table `service_cart`
--
ALTER TABLE `service_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_cart_service_id_index` (`service_id`),
  ADD KEY `service_cart_user_id_index` (`user_id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_categories_service_id_index` (`service_id`),
  ADD KEY `service_categories_category_id_index` (`category_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `social_links_name_unique` (`name`),
  ADD UNIQUE KEY `social_links_icon_unique` (`icon`),
  ADD UNIQUE KEY `social_links_url_unique` (`url`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term_conditions`
--
ALTER TABLE `term_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_ticket_id_unique` (`ticket_id`);

--
-- Indexes for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_membership_plan_id_foreign` (`membership_plan_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_address_user_id_index` (`user_id`);

--
-- Indexes for table `user_free_services`
--
ALTER TABLE `user_free_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_free_services_user_id_index` (`user_id`),
  ADD KEY `user_free_services_service_id_index` (`service_id`);

--
-- Indexes for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_ratings_sender_id_index` (`sender_id`),
  ADD KEY `user_ratings_receiver_id_index` (`receiver_id`),
  ADD KEY `user_ratings_booking_id_index` (`booking_id`);

--
-- Indexes for table `video_recodings`
--
ALTER TABLE `video_recodings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_recodings_booking_id_index` (`booking_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_index` (`user_id`);

--
-- Indexes for table `working_times`
--
ALTER TABLE `working_times`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `working_times_employee_id_date_unique` (`employee_id`,`date`);

--
-- Indexes for table `work_histories`
--
ALTER TABLE `work_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_histories_booking_id_index` (`booking_id`),
  ADD KEY `work_histories_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us_page`
--
ALTER TABLE `about_us_page`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `academy`
--
ALTER TABLE `academy`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `academy_courses`
--
ALTER TABLE `academy_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `academy_facilities`
--
ALTER TABLE `academy_facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `academy_faculties`
--
ALTER TABLE `academy_faculties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beautician_docs`
--
ALTER TABLE `beautician_docs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beautician_gallery`
--
ALTER TABLE `beautician_gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beautician_services`
--
ALTER TABLE `beautician_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beautician_working_times`
--
ALTER TABLE `beautician_working_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_assigns`
--
ALTER TABLE `booking_assigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_cancel_reasons`
--
ALTER TABLE `booking_cancel_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_services`
--
ALTER TABLE `booking_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_statuses`
--
ALTER TABLE `booking_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_users`
--
ALTER TABLE `booking_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_times`
--
ALTER TABLE `business_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate_features`
--
ALTER TABLE `certificate_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate_users`
--
ALTER TABLE `certificate_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_numbers`
--
ALTER TABLE `contact_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_features`
--
ALTER TABLE `course_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_users`
--
ALTER TABLE `course_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_questions`
--
ALTER TABLE `faq_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_news`
--
ALTER TABLE `gallery_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_photos`
--
ALTER TABLE `gallery_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_videos`
--
ALTER TABLE `gallery_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_conditions`
--
ALTER TABLE `health_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_page_contents`
--
ALTER TABLE `home_page_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `membership_features`
--
ALTER TABLE `membership_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `membership_has_features`
--
ALTER TABLE `membership_has_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `membership_plans`
--
ALTER TABLE `membership_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `membership_users`
--
ALTER TABLE `membership_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_ship_services`
--
ALTER TABLE `member_ship_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `my_favourites`
--
ALTER TABLE `my_favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_attachments`
--
ALTER TABLE `notification_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_cancel_reasons`
--
ALTER TABLE `order_cancel_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_cart`
--
ALTER TABLE `product_cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_review_ratings`
--
ALTER TABLE `product_review_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_videos`
--
ALTER TABLE `product_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_informations`
--
ALTER TABLE `profile_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `query_management`
--
ALTER TABLE `query_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recruitments`
--
ALTER TABLE `recruitments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recruitment_applies`
--
ALTER TABLE `recruitment_applies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recruitment_features`
--
ALTER TABLE `recruitment_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_cart`
--
ALTER TABLE `service_cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `term_conditions`
--
ALTER TABLE `term_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_free_services`
--
ALTER TABLE `user_free_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_ratings`
--
ALTER TABLE `user_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_recodings`
--
ALTER TABLE `video_recodings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `working_times`
--
ALTER TABLE `working_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_histories`
--
ALTER TABLE `work_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD CONSTRAINT `bank_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beautician_docs`
--
ALTER TABLE `beautician_docs`
  ADD CONSTRAINT `beautician_docs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beautician_gallery`
--
ALTER TABLE `beautician_gallery`
  ADD CONSTRAINT `beautician_gallery_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beautician_services`
--
ALTER TABLE `beautician_services`
  ADD CONSTRAINT `beautician_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `beautician_services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beautician_working_times`
--
ALTER TABLE `beautician_working_times`
  ADD CONSTRAINT `beautician_working_times_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_assigns`
--
ALTER TABLE `booking_assigns`
  ADD CONSTRAINT `booking_assigns_assign_user_id_foreign` FOREIGN KEY (`assign_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_assigns_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_cancel_reasons`
--
ALTER TABLE `booking_cancel_reasons`
  ADD CONSTRAINT `booking_cancel_reasons_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_services`
--
ALTER TABLE `booking_services`
  ADD CONSTRAINT `booking_services_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_statuses`
--
ALTER TABLE `booking_statuses`
  ADD CONSTRAINT `booking_statuses_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_users`
--
ALTER TABLE `booking_users`
  ADD CONSTRAINT `booking_users_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `certificate_features`
--
ALTER TABLE `certificate_features`
  ADD CONSTRAINT `certificate_features_certificate_id_foreign` FOREIGN KEY (`certificate_id`) REFERENCES `certificates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `certificate_users`
--
ALTER TABLE `certificate_users`
  ADD CONSTRAINT `certificate_users_certificate_id_foreign` FOREIGN KEY (`certificate_id`) REFERENCES `certificates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `certificate_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_features`
--
ALTER TABLE `course_features`
  ADD CONSTRAINT `course_features_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `academy_courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_users`
--
ALTER TABLE `course_users`
  ADD CONSTRAINT `course_users_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `academy_courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `health_conditions`
--
ALTER TABLE `health_conditions`
  ADD CONSTRAINT `health_conditions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `membership_has_features`
--
ALTER TABLE `membership_has_features`
  ADD CONSTRAINT `membership_has_features_membership_feature_id_foreign` FOREIGN KEY (`membership_feature_id`) REFERENCES `membership_features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `membership_has_features_membership_plan_id_foreign` FOREIGN KEY (`membership_plan_id`) REFERENCES `membership_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `membership_users`
--
ALTER TABLE `membership_users`
  ADD CONSTRAINT `membership_users_membership_plan_id_foreign` FOREIGN KEY (`membership_plan_id`) REFERENCES `membership_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `membership_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_ship_services`
--
ALTER TABLE `member_ship_services`
  ADD CONSTRAINT `member_ship_services_membership_plan_id_foreign` FOREIGN KEY (`membership_plan_id`) REFERENCES `membership_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `member_ship_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `my_favourites`
--
ALTER TABLE `my_favourites`
  ADD CONSTRAINT `my_favourites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `my_favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_attachments`
--
ALTER TABLE `notification_attachments`
  ADD CONSTRAINT `notification_attachments_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_cancel_reasons`
--
ALTER TABLE `order_cancel_reasons`
  ADD CONSTRAINT `order_cancel_reasons_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD CONSTRAINT `order_statuses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD CONSTRAINT `product_brands_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_brands_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD CONSTRAINT `product_cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_review_ratings`
--
ALTER TABLE `product_review_ratings`
  ADD CONSTRAINT `product_review_ratings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_review_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_review_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_videos`
--
ALTER TABLE `product_videos`
  ADD CONSTRAINT `product_videos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile_informations`
--
ALTER TABLE `profile_informations`
  ADD CONSTRAINT `profile_informations_user_id_foreign` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recruitment_features`
--
ALTER TABLE `recruitment_features`
  ADD CONSTRAINT `recruitment_features_recruitment_id_foreign` FOREIGN KEY (`recruitment_id`) REFERENCES `recruitments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_userid_foreign` FOREIGN KEY (`UserId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_cart`
--
ALTER TABLE `service_cart`
  ADD CONSTRAINT `service_cart_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD CONSTRAINT `service_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_categories_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_membership_plan_id_foreign` FOREIGN KEY (`membership_plan_id`) REFERENCES `membership_plans` (`id`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_free_services`
--
ALTER TABLE `user_free_services`
  ADD CONSTRAINT `user_free_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_free_services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD CONSTRAINT `user_ratings_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_ratings_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_ratings_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_recodings`
--
ALTER TABLE `video_recodings`
  ADD CONSTRAINT `video_recodings_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `work_histories`
--
ALTER TABLE `work_histories`
  ADD CONSTRAINT `work_histories_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `work_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
