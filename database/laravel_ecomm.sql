-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 04, 2021 at 10:36 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `mobile`, `email`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'M Hannan', 'admin', '01744894452', 'admin@admin.com', NULL, '$2y$10$JaGeiO4HmSVuEosPg54mZeFq9l61oZUc15/gbHj3bBRZ/OKXS0We6', '', 1, NULL, NULL, NULL),
(2, 'Aayat', 'admin', '01744894450', 'admin2@admin.com', NULL, '$2y$10$vDzOZqVK2C9u.pQ6670xleiqVNeoKZEUKArVyEM6WSjZoylXJjCG2', '', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `banner_image`, `alt`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Banner One', '1626501500.jpg', 'banner-one', 1, NULL, '2021-07-16 23:58:20'),
(2, 'Banner Two', '1626501512.jpg', 'banner-two', 1, NULL, '2021-07-16 23:58:32'),
(3, 'Banner Three', '1626501524.jpg', 'banner-three', 1, NULL, '2021-07-16 23:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Arrow', 'arrow', 1, NULL, NULL),
(2, 'Gap', 'gap', 1, NULL, NULL),
(3, 'Lee', 'lee', 1, NULL, NULL),
(4, 'Monte', 'monte', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `session_id`, `user_id`, `product_id`, `size`, `quantity`, `created_at`, `updated_at`) VALUES
(1, '7DimDYBaxLXve5z7qjrOdAnH7ggKQcyqjDWqTRCl', 0, 3, 'Small', 1, NULL, NULL),
(2, '7DimDYBaxLXve5z7qjrOdAnH7ggKQcyqjDWqTRCl', 0, 3, 'Medium', 2, NULL, NULL),
(3, '7DimDYBaxLXve5z7qjrOdAnH7ggKQcyqjDWqTRCl', 0, 3, 'Large', 5, NULL, NULL),
(4, 'QeVkURrWqx2yvXeDyrPqBwhnTWQwolud1fOx6ZDO', 0, 1, 'Small', 10, NULL, NULL),
(5, 'e3dm7kW6beIHw33MWtXDhTqIiEPzeCPBDCxi2UAK', 0, 2, 'Large', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amt` decimal(5,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active and 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `title`, `slug`, `image`, `discount_amt`, `description`, `meta_title`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'T Shirt', 't-shirt', '1628073375.jpg', '5.00', 'A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean.', 'T Shirt', 'A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean.', 1, NULL, '2021-08-04 04:36:15'),
(2, 1, 1, 'Casual T Shirt', 'casual-t-shirt', '1626589850.jpg', '0.00', 'Casual T Shirt', 'meta_title', 'Casual T Shirt', 1, NULL, '2021-08-02 02:54:56'),
(3, 1, 1, 'Formal T Shirt', 'formal-t-shirt', '1628070640.jpeg', '5.00', 'Formal T Shirt', 'Formal T Shirt', 'Formal T Shirt', 1, '2021-08-03 04:36:18', '2021-08-04 03:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_admins_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_05_27_054128_create_sections_table', 1),
(6, '2021_05_27_193122_create_categories_table', 1),
(7, '2021_05_30_080237_create_products_table', 1),
(8, '2021_06_10_104620_create_product_attributes_table', 1),
(9, '2021_06_13_190935_create_product_images_table', 1),
(10, '2021_06_14_134344_create_brands_table', 1),
(11, '2021_06_16_055835_create_banners_table', 1),
(12, '2021_07_29_181022_create_carts_table', 2);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'PK on sections table',
  `brand_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'PK on brands table',
  `category_id` int(10) UNSIGNED NOT NULL COMMENT 'PK on categories table',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `weight` double(5,2) NOT NULL,
  `discount_amt` decimal(5,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fabric` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pattern` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sleeve` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occasion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `wash_care` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active and 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `section_id`, `brand_id`, `category_id`, `title`, `slug`, `code`, `color`, `price`, `weight`, `discount_amt`, `image`, `fabric`, `pattern`, `sleeve`, `fit`, `occasion`, `meta_title`, `description`, `wash_care`, `meta_description`, `meta_keyword`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 'Striped Slim Fit Polo T-shirt', 'striped-slim-fit-polo-t-shirt', 'SSFPTS', 'White', '1500.00', 0.00, '5.00', '1628071342.jpg', 'Cotton', 'Plain', 'Half-Sleeve', 'Regular', 'Casual', 'Casual T Shirt', 'Striped Slim Fit Polo T-shirt A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'Factory Wsashed', 'Striped Slim Fit Polo T-shirt A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'T Shirt, Casual T Shirt, Printed T Shirt, Formal T Shirt, Branded T Shirt, Developer T Shirt', 'Yes', 1, NULL, '2021-08-04 04:02:22'),
(2, 1, 2, 2, 'Graphic Print Crew-Neck T-shirt', 'graphic-print-crew-neck-t-shirt', 'GPCNTS', 'Blue', '1500.00', 0.00, '10.00', '1628071282.jpg', 'Cotton', 'Plain', 'Half-Sleeve', 'Regular', 'Casual', 'Casual T Shirt', 'A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'Factory Wsashed', 'Striped Slim Fit Polo T-shirt A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'T Shirt, Casual T Shirt, Printed T Shirt, Formal T Shirt, Branded T Shirt, Developer T Shirt', 'Yes', 1, NULL, '2021-08-04 04:01:22'),
(3, 1, 3, 3, 'Waffle Striped Henley T-shirt', 'waffle-striped-henley-t-shirt', 'WSHTS', 'Blue', '2500.00', 25.00, '50.00', '1627448429.jpg', 'Cotton', 'Plain', 'Half-Sleeve', 'Regular', 'Casual', 'Stylish Casual T Shirt', 'A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'Factory Wsashed', 'Striped Slim Fit Polo T-shirt A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'T Shirt, Casual T Shirt, Printed T Shirt, Formal T Shirt, Branded T Shirt, Developer T Shirt', 'Yes', 1, '2021-07-27 23:00:30', '2021-08-04 03:59:35'),
(4, 1, 3, 2, 'Heathered Polo T-shirt', 'heathered-polo-t-shirt', 'HPTS', 'Polor', '1000.00', 0.00, '5.00', '1627448519.jpg', 'Cotton', 'Check', 'Half-Sleeve', 'Regular', 'Casual', 'Heathered Polo T-shirt', 'A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'Factory Wsashed', 'Striped Slim Fit Polo T-shirt A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'T Shirt, Casual T Shirt, Printed T Shirt, Formal T Shirt, Branded T Shirt, Developer T Shirt', 'Yes', 1, '2021-07-27 23:02:00', '2021-08-04 03:58:45'),
(5, 1, 2, 3, 'Heathered Crew-Neck T-shirt', 'heathered-crew-neck-t-shirt', 'HCNTS', 'Green', '3000.00', 0.00, '10.00', '1628071218.jpg', 'Cotton', 'Plain', 'Half-Sleeve', 'Regular', 'Casual', 'Formal T Shirt One', 'A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'Factory Wsashed', 'Striped Slim Fit Polo T-shirt A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'T Shirt, Casual T Shirt, Printed T Shirt, Formal T Shirt, Branded T Shirt, Developer T Shirt', 'Yes', 1, '2021-08-03 04:37:43', '2021-08-04 04:00:18'),
(6, 1, 3, 3, 'Striped Round-Neck T-shirt', 'striped-round-neck-t-shirt', 'SRNTS', 'Blue', '1200.00', 0.00, '5.00', '1628071940.jpg', 'Pure-Cotton', 'Plain', 'Half-Sleeve', 'Regular', 'Casual', 'Striped Round-Neck T-shirt', 'A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'Factory Wsashed', 'Striped Slim Fit Polo T-shirt A T-shirt, or tee shirt, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of a stretchy, light and inexpensive fabric and are easy to clean. ', 'T Shirt, Casual T Shirt, Printed T Shirt, Formal T Shirt, Branded T Shirt, Developer T Shirt', 'Yes', 1, '2021-08-04 04:12:20', '2021-08-04 04:12:20'),
(7, 1, 4, 3, 'Color Block Crew-Neck', 'color-block-crew-neck', 'CCN', 'Blue', '1500.00', 0.00, '5.00', '1628072715.jpg', 'Polyester', 'Plain', 'Half-Sleeve', 'Regular', 'Casual', 'Color Block Crew-Neck', 'Color Block Crew-Neck', 'Color Block Crew-Neck', 'Color Block Crew-Neck', 'Color Block Crew-Neck', 'Yes', 1, '2021-08-04 04:25:15', '2021-08-04 04:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'Product primary key',
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Different for every product It should meaningful',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `size`, `price`, `stock`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Small', '300.00', 100, 'CTSS', 1, NULL, '2021-08-04 04:21:41'),
(2, 1, 'Medium', '545.00', 35, 'CTSM', 1, NULL, '2021-08-04 04:21:41'),
(3, 1, 'Large', '300.00', 45, 'CTSL', 1, NULL, '2021-08-04 04:21:41'),
(4, 2, 'Small', '300.00', 50, 'BTSM', 1, NULL, NULL),
(5, 2, 'Medium', '350.00', 50, 'BTSMM', 1, NULL, NULL),
(6, 2, 'Large', '400.00', 100, 'BTSML', 1, NULL, NULL),
(7, 4, 'Small', '2000.00', 100, 'TCTS', 1, NULL, NULL),
(8, 4, 'Medium', '2200.00', 150, 'TCTM', 1, NULL, NULL),
(9, 4, 'Large', '2500.00', 200, 'TCTL', 1, NULL, NULL),
(10, 3, 'Small', '2350.00', 20, 'SCTSS', 1, NULL, '2021-08-04 04:20:55'),
(11, 3, 'Medium', '2450.00', 30, 'SCTSM', 1, NULL, '2021-08-04 04:20:55'),
(12, 3, 'Large', '2850.00', 40, 'SCTSL', 1, NULL, '2021-08-04 04:20:55'),
(13, 6, 'Small', '1150.00', 50, 'SRNTS-0S', 1, NULL, NULL),
(14, 6, 'Medium', '1250.00', 50, 'SRNTS-0M', 1, NULL, NULL),
(15, 6, 'Large', '1350.00', 50, 'SRNTS-0L', 1, NULL, NULL),
(16, 5, 'Small', '2950.00', 100, 'HCNTS-0S', 1, NULL, NULL),
(17, 5, 'Medium', '3050.00', 100, 'HCNTS-0M', 1, NULL, NULL),
(18, 5, 'Large', '3150.00', 100, 'HCNTS-0L', 1, NULL, NULL),
(19, 7, 'Small', '1450.00', 20, 'CCN-S', 1, NULL, NULL),
(20, 7, 'Medium', '1500.00', 25, 'CCN-M', 1, NULL, NULL),
(21, 7, 'Large', '1550.00', 35, 'CCN-L', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'Primary key On Products',
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `images`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1626503155.jpg', 1, '2021-07-17 00:25:55', '2021-07-17 00:25:55'),
(2, 1, '1626503155.jpg', 1, '2021-07-17 00:25:55', '2021-07-17 00:25:55'),
(3, 1, '1626503178.jpg', 1, '2021-07-17 00:26:18', '2021-07-17 00:26:18'),
(4, 2, '1626503523.jpg', 1, '2021-07-17 00:32:03', '2021-07-17 00:32:03'),
(5, 2, '1626503523.jpg', 1, '2021-07-17 00:32:03', '2021-07-17 00:32:03'),
(6, 2, '1626503524.jpg', 1, '2021-07-17 00:32:04', '2021-07-17 00:32:04'),
(7, 4, '1627448742.jpg', 1, '2021-07-27 23:05:43', '2021-07-27 23:05:43'),
(8, 4, '1627448743.jpg', 1, '2021-07-27 23:05:43', '2021-07-27 23:05:43'),
(9, 4, '1627448743.jpg', 1, '2021-07-27 23:05:44', '2021-07-27 23:05:44'),
(10, 3, '1627708480.jpg', 1, '2021-07-30 23:14:40', '2021-07-30 23:14:40'),
(11, 3, '1627708480.jpg', 1, '2021-07-30 23:14:41', '2021-07-30 23:14:41'),
(12, 3, '1627708481.jpg', 1, '2021-07-30 23:14:42', '2021-07-30 23:14:42'),
(13, 6, '1628072324.jpg', 1, '2021-08-04 04:18:44', '2021-08-04 04:18:44'),
(14, 6, '1628072324.jpg', 1, '2021-08-04 04:18:44', '2021-08-04 04:18:44'),
(15, 6, '1628072324.jpg', 1, '2021-08-04 04:18:44', '2021-08-04 04:18:44'),
(16, 5, '1628072394.jpg', 1, '2021-08-04 04:19:55', '2021-08-04 04:19:55'),
(17, 5, '1628072395.jpg', 1, '2021-08-04 04:19:55', '2021-08-04 04:19:55'),
(18, 5, '1628072395.jpg', 1, '2021-08-04 04:19:55', '2021-08-04 04:19:55'),
(19, 7, '1628073307.jpg', 1, '2021-08-04 04:35:07', '2021-08-04 04:35:07'),
(20, 7, '1628073307.jpg', 1, '2021-08-04 04:35:07', '2021-08-04 04:35:07'),
(21, 7, '1628073307.jpeg', 1, '2021-08-04 04:35:07', '2021-08-04 04:35:07');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=Active and 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'men', 1, NULL, NULL),
(2, 'Women', 'women', 1, NULL, NULL),
(3, 'Kid', 'kid', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_title_unique` (`title`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_attributes_sku_unique` (`sku`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sections_title_unique` (`title`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
