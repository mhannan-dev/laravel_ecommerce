-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2021 at 04:27 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

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
(1, 'M Hannan', 'admin', '01744894452', 'admin@admin.com', NULL, '$2y$10$0YgZY0Ze1r.7DoyYHrOZteyy7lcZ126iQeasv1n2juLL4fYZRrK9u', '', 1, NULL, NULL, NULL),
(2, 'Aayat', 'admin', '01744894450', 'admin2@admin.com', NULL, '$2y$10$kCtSSNNSjvX/twcqBbEVSu7oB2ozrTj1zfHKgEUXXq3/ooGx6SrPy', '', 1, NULL, NULL, NULL);

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
(1, 'Banner One', '1631347381.jpg', 'banner-one', 1, NULL, '2021-09-11 02:03:02'),
(2, 'Banner Two', '1631347417.jpg', 'banner-two', 1, NULL, '2021-09-11 02:03:38'),
(3, 'Banner Three', '1631347447.jpg', 'banner-three', 1, NULL, '2021-09-11 02:04:07');

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
(3, '5Xt97KNuuaJLQZIWhsyEIIfyh6Rubc3rBPKqpfti', 1, 3, 'Small', 3, '2021-09-11 04:26:13', '2021-09-11 04:26:13'),
(4, 'IFgVRtsZlGhhSN5h9bvlqTnNZYUE8jBFHeSNV0kp', 1, 4, 'Small', 3, '2021-09-11 09:51:27', '2021-09-11 09:51:27'),
(5, 'IFgVRtsZlGhhSN5h9bvlqTnNZYUE8jBFHeSNV0kp', 1, 3, 'Medium', 3, '2021-09-11 10:20:10', '2021-09-11 10:20:10');

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
(1, 0, 1, 'T-Shirt', 't-shirt', '1631347501.jpg', '0.00', 'T-Shirt', 'meta_title', 'T-Shirt', 1, NULL, '2021-09-11 02:05:01'),
(3, 1, 1, 'Formal T Shirt', 'formal-t-shirt', '1631347609.jpeg', '0.00', 'Formal T Shirt', 'Formal T Shirt', 'Formal T Shirt', 1, '2021-09-11 02:06:49', '2021-09-11 02:06:49'),
(4, 0, 2, 'Shari', 'shari', '1631347732.jpeg', '0.00', 'Shari', 'Shari', 'Shari', 1, '2021-09-11 02:08:52', '2021-09-11 02:08:52'),
(5, 4, 2, 'Suti', 'suti', '1631347769.jpg', '0.00', 'Suti shari', 'Suti shari', 'Suri Shari', 1, '2021-09-11 02:09:29', '2021-09-11 02:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American Samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antarctica'),
(9, 'Antigua and Barbuda'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Aruba'),
(13, 'Australia'),
(14, 'Austria'),
(15, 'Azerbaijan'),
(16, 'Bahamas'),
(17, 'Bahrain'),
(18, 'Bangladesh'),
(19, 'Barbados'),
(20, 'Belarus'),
(21, 'Belgium'),
(22, 'Belize'),
(23, 'Benin'),
(24, 'Bermuda'),
(25, 'Bhutan'),
(26, 'Bolivia'),
(27, 'Bosnia and Herzegovina'),
(28, 'Botswana'),
(29, 'Bouvet Island'),
(30, 'Brazil'),
(31, 'British Indian Ocean Territory'),
(32, 'Brunei Darussalam'),
(33, 'Bulgaria'),
(34, 'Burkina Faso'),
(35, 'Burundi'),
(36, 'Cambodia'),
(37, 'Cameroon'),
(38, 'Canada'),
(39, 'Cape Verde'),
(40, 'Cayman Islands'),
(41, 'Central African Republic'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'Christmas Island'),
(46, 'Cocos (Keeling) Islands'),
(47, 'Colombia'),
(48, 'Comoros'),
(49, 'Congo'),
(50, 'Congo, the Democratic Republic of the'),
(51, 'Cook Islands'),
(52, 'Costa Rica'),
(53, 'Cote D\'Ivoire'),
(54, 'Croatia'),
(55, 'Cuba'),
(56, 'Cyprus'),
(57, 'Czech Republic'),
(58, 'Denmark'),
(59, 'Djibouti'),
(60, 'Dominica'),
(61, 'Dominican Republic'),
(62, 'Ecuador'),
(63, 'Egypt'),
(64, 'El Salvador'),
(65, 'Equatorial Guinea'),
(66, 'Eritrea'),
(67, 'Estonia'),
(68, 'Ethiopia'),
(69, 'Falkland Islands (Malvinas)'),
(70, 'Faroe Islands'),
(71, 'Fiji'),
(72, 'Finland'),
(73, 'France'),
(74, 'French Guiana'),
(75, 'French Polynesia'),
(76, 'French Southern Territories'),
(77, 'Gabon'),
(78, 'Gambia'),
(79, 'Georgia'),
(80, 'Germany'),
(81, 'Ghana'),
(82, 'Gibraltar'),
(83, 'Greece'),
(84, 'Greenland'),
(85, 'Grenada'),
(86, 'Guadeloupe'),
(87, 'Guam'),
(88, 'Guatemala'),
(89, 'Guinea'),
(90, 'Guinea-Bissau'),
(91, 'Guyana'),
(92, 'Haiti'),
(93, 'Heard Island and Mcdonald Islands'),
(94, 'Holy See (Vatican City State)'),
(95, 'Honduras'),
(96, 'Hong Kong'),
(97, 'Hungary'),
(98, 'Iceland'),
(99, 'India'),
(100, 'Indonesia'),
(101, 'Iran, Islamic Republic of'),
(102, 'Iraq'),
(103, 'Ireland'),
(104, 'Israel'),
(105, 'Italy'),
(106, 'Jamaica'),
(107, 'Japan'),
(108, 'Jordan'),
(109, 'Kazakhstan'),
(110, 'Kenya'),
(111, 'Kiribati'),
(112, 'Korea, Democratic People\'s Republic of'),
(113, 'Korea, Republic of'),
(114, 'Kuwait'),
(115, 'Kyrgyzstan'),
(116, 'Lao People\'s Democratic Republic'),
(117, 'Latvia'),
(118, 'Lebanon'),
(119, 'Lesotho'),
(120, 'Liberia'),
(121, 'Libyan Arab Jamahiriya'),
(122, 'Liechtenstein'),
(123, 'Lithuania'),
(124, 'Luxembourg'),
(125, 'Macao'),
(126, 'Macedonia, the Former Yugoslav Republic of'),
(127, 'Madagascar'),
(128, 'Malawi'),
(129, 'Malaysia'),
(130, 'Maldives'),
(131, 'Mali'),
(132, 'Malta'),
(133, 'Marshall Islands'),
(134, 'Martinique'),
(135, 'Mauritania'),
(136, 'Mauritius'),
(137, 'Mayotte'),
(138, 'Mexico'),
(139, 'Micronesia, Federated States of'),
(140, 'Moldova, Republic of'),
(141, 'Monaco'),
(142, 'Mongolia'),
(143, 'Montserrat'),
(144, 'Morocco'),
(145, 'Mozambique'),
(146, 'Myanmar'),
(147, 'Namibia'),
(148, 'Nauru'),
(149, 'Nepal'),
(150, 'Netherlands'),
(151, 'Netherlands Antilles'),
(152, 'New Caledonia'),
(153, 'New Zealand'),
(154, 'Nicaragua'),
(155, 'Niger'),
(156, 'Nigeria'),
(157, 'Niue'),
(158, 'Norfolk Island'),
(159, 'Northern Mariana Islands'),
(160, 'Norway'),
(161, 'Oman'),
(162, 'Pakistan'),
(163, 'Palau'),
(164, 'Palestinian Territory, Occupied'),
(165, 'Panama'),
(166, 'Papua New Guinea'),
(167, 'Paraguay'),
(168, 'Peru'),
(169, 'Philippines'),
(170, 'Pitcairn'),
(171, 'Poland'),
(172, 'Portugal'),
(173, 'Puerto Rico'),
(174, 'Qatar'),
(175, 'Reunion'),
(176, 'Romania'),
(177, 'Russian Federation'),
(178, 'Rwanda'),
(179, 'Saint Helena'),
(180, 'Saint Kitts and Nevis'),
(181, 'Saint Lucia'),
(182, 'Saint Pierre and Miquelon'),
(183, 'Saint Vincent and the Grenadines'),
(184, 'Samoa'),
(185, 'San Marino'),
(186, 'Sao Tome and Principe'),
(187, 'Saudi Arabia'),
(188, 'Senegal'),
(189, 'Serbia and Montenegro'),
(190, 'Seychelles'),
(191, 'Sierra Leone'),
(192, 'Singapore'),
(193, 'Slovakia'),
(194, 'Slovenia'),
(195, 'Solomon Islands'),
(196, 'Somalia'),
(197, 'South Africa'),
(198, 'South Georgia and the South Sandwich Islands'),
(199, 'Spain'),
(200, 'Sri Lanka'),
(201, 'Sudan'),
(202, 'Suriname'),
(203, 'Svalbard and Jan Mayen'),
(204, 'Swaziland'),
(205, 'Sweden'),
(206, 'Switzerland'),
(207, 'Syrian Arab Republic'),
(208, 'Taiwan, Province of China'),
(209, 'Tajikistan'),
(210, 'Tanzania, United Republic of'),
(211, 'Thailand'),
(212, 'Timor-Leste'),
(213, 'Togo'),
(214, 'Tokelau'),
(215, 'Tonga'),
(216, 'Trinidad and Tobago'),
(217, 'Tunisia'),
(218, 'Turkey'),
(219, 'Turkmenistan'),
(220, 'Turks and Caicos Islands'),
(221, 'Tuvalu'),
(222, 'Uganda'),
(223, 'Ukraine'),
(224, 'United Arab Emirates'),
(225, 'United Kingdom'),
(226, 'United States'),
(227, 'United States Minor Outlying Islands'),
(228, 'Uruguay'),
(229, 'Uzbekistan'),
(230, 'Vanuatu'),
(231, 'Venezuela'),
(232, 'Viet Nam'),
(233, 'Virgin Islands, British'),
(234, 'Virgin Islands, U.s.'),
(235, 'Wallis and Futuna'),
(236, 'Western Sahara'),
(237, 'Yemen'),
(238, 'Zambia'),
(239, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_option`, `coupon_code`, `categories`, `users`, `coupon_type`, `amount_type`, `amount`, `expiry_date`, `title`, `alt_text`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mannual', 'CCT1', '1,2', 'mdhannan.info@gmail.com', 'Single', 'Percentage', 10.00, '2021-09-30', 'Coupon one title', 'Coupon one alt text', 1, NULL, NULL),
(2, 'Mannual', 'CCT2', '1,3', 'ahannan.info@gmail.com,mdhannan.info@gmail.com', 'Single', 'Percentage', 20.00, '2021-10-31', 'Coupon two title', 'Coupon two alt text', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_addresses`
--

CREATE TABLE `delivery_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_addresses`
--

INSERT INTO `delivery_addresses` (`id`, `user_id`, `name`, `country`, `state`, `city`, `address`, `mobile`, `zip_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Abdul Hannan', 'Bangladesh', 'Dhaka', 'Dhaka', 'Banani', '01531261214', '1215', '2021-09-11 02:27:29', '2021-09-11 02:27:29'),
(2, 1, 'MA Hannan', 'Pakistan', 'Karachi', 'Karachi', 'XYZ address', '01531261214', '1215', '2021-09-11 04:34:21', '2021-09-11 04:34:21');

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
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_05_27_054128_create_sections_table', 1),
(6, '2021_05_27_193122_create_categories_table', 1),
(7, '2021_05_30_080237_create_products_table', 1),
(8, '2021_06_10_104620_create_product_attributes_table', 1),
(9, '2021_06_13_190935_create_product_images_table', 1),
(10, '2021_06_14_134344_create_brands_table', 1),
(11, '2021_06_16_055835_create_banners_table', 1),
(12, '2021_07_29_181022_create_carts_table', 1),
(14, '2021_08_17_174328_create_countries_table', 1),
(15, '2021_08_19_161651_create_coupons_table', 1),
(16, '2021_08_25_153944_create_delivery_addresses_table', 1),
(17, '2021_09_03_090736_create_orders_table', 1),
(18, '2021_09_03_091458_create_order_products_table', 1),
(19, '2021_09_05_115551_create_order_status_table', 1),
(20, '2021_09_06_120258_create_orders_logs_table', 1),
(21, '2021_09_08_051638_add_column_orders_table', 1),
(25, '2014_10_12_000000_create_users_table', 2),
(26, '2021_08_08_074853_add_new_fields_to_users_table', 3),
(27, '2021_09_10_122452_create_shipping_charges_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` int(11) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charges` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_amount` decimal(10,2) DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_gateway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `courier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `city`, `state`, `country`, `zip_code`, `mobile`, `email`, `shipping_charges`, `coupon_code`, `coupon_amount`, `order_status`, `payment_gateway`, `payment_method`, `grand_total`, `courier_name`, `tracking_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Abdul Hannan', 'Banani', 'Dhaka', 'Dhaka', 'Bangladesh', 1215, 1531261214, 'mdhannan.info@gmail.com', '0', NULL, NULL, 'New', 'COD', 'COD', '14208.00', NULL, NULL, '2021-09-11 10:23:27', '2021-09-11 10:23:27'),
(2, 1, 'Abdul Hannan', 'Banani', 'Dhaka', 'Dhaka', 'Bangladesh', 1215, 1531261214, 'mdhannan.info@gmail.com', '0', NULL, NULL, 'New', 'COD', 'COD', '14208.00', NULL, NULL, '2021-09-11 10:23:59', '2021-09-11 10:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `orders_logs`
--

CREATE TABLE `orders_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL COMMENT 'Order primary key',
  `user_id` int(11) NOT NULL COMMENT 'User primary key',
  `product_id` int(11) NOT NULL COMMENT 'Product primary key',
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `user_id`, `product_id`, `product_name`, `product_color`, `product_size`, `product_code`, `product_price`, `product_qty`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 'Suti Shari One', 'Red', 'Small', 'SSO', '1534.50', '3', '2021-09-11 10:23:27', '2021-09-11 10:23:27'),
(2, 1, 1, 4, 'Suti Shari Two', 'Blue', 'Small', 'SST', '1568.00', '3', '2021-09-11 10:23:27', '2021-09-11 10:23:27'),
(3, 1, 1, 3, 'Suti Shari One', 'Red', 'Medium', 'SSO', '1633.50', '3', '2021-09-11 10:23:27', '2021-09-11 10:23:27'),
(4, 2, 1, 3, 'Suti Shari One', 'Red', 'Small', 'SSO', '1534.50', '3', '2021-09-11 10:24:00', '2021-09-11 10:24:00'),
(5, 2, 1, 4, 'Suti Shari Two', 'Blue', 'Small', 'SST', '1568.00', '3', '2021-09-11 10:24:00', '2021-09-11 10:24:00'),
(6, 2, 1, 3, 'Suti Shari One', 'Red', 'Medium', 'SSO', '1633.50', '3', '2021-09-11 10:24:00', '2021-09-11 10:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New', 1, NULL, NULL),
(2, 'Pending', 1, NULL, NULL),
(3, 'Hold', 1, NULL, NULL),
(4, 'Cancelled', 1, NULL, NULL),
(5, 'In Progress', 1, NULL, NULL),
(6, 'Paid', 1, NULL, NULL),
(7, 'Shipped', 1, NULL, NULL),
(8, 'Delivered', 1, NULL, NULL);

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
(1, 1, 1, 3, 'Formal T Shirt Twp', 'formal-t-shirt-twp', 'FTST', 'red', '100.00', 0.00, '0.00', '1631347681.jpg', 'Wool', 'Self', 'Half-Sleeve', 'Regular', 'Casual', 'Formal T Shirt One meta title', 'Formal T Shirt One description', 'Factory wash', 'Formal T Shirt One meta description', 'Formal T Shirt One meta keyword', 'Yes', 1, NULL, '2021-09-11 02:08:02'),
(2, 1, 2, 3, 'Formal T Shirt One Updated', 'formal-t-shirt-one-updated', 'PRD2', 'red', '200.00', 50.00, '0.00', '1631347642.jpg', 'Cotton', 'Plain', 'Half-Sleeve', 'Regular', 'Casual', 'Formal T Shirt One Updated meta title', 'Formal T Shirt One Updated description', 'Factory wash', 'Formal T Shirt One Updated meta description', 'Formal T Shirt One Updated meta keyword', 'Yes', 1, NULL, '2021-09-11 02:07:22'),
(3, 2, 2, 5, 'Suti Shari One', 'suti-shari-one', 'SSO', 'Red', '1500.00', 450.00, '1.00', '1631347818.jpg', 'Cotton', 'Printed', 'Sleeve-Less', 'Regular', 'Formal', 'Suti Shari One', 'Suti Shari One', 'Suti Shari One', 'Suti Shari One', 'Suti Shari One', 'Yes', 1, '2021-09-11 02:10:18', '2021-09-11 02:10:18'),
(4, 2, 1, 5, 'Suti Shari Two', 'suti-shari-two', 'SST', 'Blue', '1560.00', 450.00, '2.00', '1631347907.jpg', 'Pure-Cotton', 'Solid', 'Half-Sleeve', 'Regular', 'Casual', 'Suti Shari One', 'Suti Shari One', 'Suti Shari One', 'Suti Shari One', 'Suti Shari One', 'Yes', 1, '2021-09-11 02:11:47', '2021-09-11 02:11:47');

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
(1, 4, 'Small', '1600.00', 10, 'SST-S', 1, NULL, NULL),
(2, 4, 'Medium', '1700.00', 50, 'SST-M', 1, NULL, NULL),
(3, 4, 'Large', '1800.00', 50, 'SST-L', 1, NULL, NULL),
(4, 3, 'Small', '1550.00', 50, 'SSOS', 1, NULL, NULL),
(5, 3, 'Medium', '1650.00', 50, 'SSOM', 1, NULL, NULL),
(6, 3, 'Large', '1750.00', 50, 'SSOL', 1, NULL, NULL);

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
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `shipping_charges` float NOT NULL DEFAULT '1000',
  `status` tinyint(3) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country`, `shipping_charges`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 1000, 1, '0000-00-00 00:00:00', '2021-09-11 10:12:59'),
(2, 'Albania', 5000, 1, '0000-00-00 00:00:00', '2021-09-11 10:08:10'),
(3, 'Algeria', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'American Samoa', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Andorra', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Angola', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Anguilla', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Antarctica', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Antigua and Barbuda', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Argentina', 2000, 1, '0000-00-00 00:00:00', '2021-09-11 10:08:00'),
(11, 'Armenia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Aruba', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Australia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Austria', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Azerbaijan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Bahamas', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Bahrain', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Bangladesh', 100, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Barbados', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Belarus', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Belgium', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Belize', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Benin', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Bermuda', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Bhutan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Bolivia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Bosnia and Herzegovina', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Botswana', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Bouvet Island', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Brazil', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'British Indian Ocean Territory', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Brunei Darussalam', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Bulgaria', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Burkina Faso', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Burundi', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Cambodia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Cameroon', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Canada', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Cape Verde', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Cayman Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Central African Republic', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Chad', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Chile', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'China', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Christmas Island', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Cocos (Keeling) Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Colombia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Comoros', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Congo', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Congo, the Democratic Republic of the', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Cook Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Costa Rica', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Cote D\'Ivoire', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Croatia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Cuba', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Cyprus', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Czech Republic', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Denmark', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Djibouti', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Dominica', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Dominican Republic', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Ecuador', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Egypt', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'El Salvador', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Equatorial Guinea', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Eritrea', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Estonia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Ethiopia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Falkland Islands (Malvinas)', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Faroe Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Fiji', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Finland', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'France', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'French Guiana', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'French Polynesia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'French Southern Territories', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'Gabon', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Gambia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Georgia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Germany', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Ghana', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Gibraltar', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Greece', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Greenland', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Grenada', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Guadeloupe', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Guam', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Guatemala', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Guinea', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Guinea-Bissau', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Guyana', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Haiti', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Heard Island and Mcdonald Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Holy See (Vatican City State)', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Honduras', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Hong Kong', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Hungary', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Iceland', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'India', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Indonesia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'Iran, Islamic Republic of', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Iraq', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'Ireland', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Israel', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Italy', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Jamaica', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Japan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Jordan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Kazakhstan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Kenya', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Kiribati', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'Korea, Democratic People\'s Republic of', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Korea, Republic of', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'Kuwait', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'Kyrgyzstan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Lao People\'s Democratic Republic', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Latvia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'Lebanon', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'Lesotho', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'Liberia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Libyan Arab Jamahiriya', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Liechtenstein', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Lithuania', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'Luxembourg', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Macao', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Macedonia, the Former Yugoslav Republic of', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Madagascar', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Malawi', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Malaysia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Maldives', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Mali', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Malta', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'Marshall Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Martinique', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Mauritania', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Mauritius', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Mayotte', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'Mexico', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Micronesia, Federated States of', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Moldova, Republic of', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Monaco', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'Mongolia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'Montserrat', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Morocco', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'Mozambique', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Myanmar', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Namibia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Nauru', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Nepal', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'Netherlands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Netherlands Antilles', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'New Caledonia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'New Zealand', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Nicaragua', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'Niger', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'Nigeria', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'Niue', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'Norfolk Island', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'Northern Mariana Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'Norway', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'Oman', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'Pakistan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'Palau', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'Palestinian Territory, Occupied', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'Panama', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'Papua New Guinea', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'Paraguay', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'Peru', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'Philippines', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Pitcairn', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'Poland', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'Portugal', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'Puerto Rico', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'Qatar', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'Reunion', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Romania', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Russian Federation', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Rwanda', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Saint Helena', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Saint Kitts and Nevis', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Saint Lucia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Saint Pierre and Miquelon', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Saint Vincent and the Grenadines', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Samoa', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'San Marino', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Sao Tome and Principe', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Saudi Arabia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'Senegal', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'Serbia and Montenegro', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'Seychelles', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'Sierra Leone', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'Singapore', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'Slovakia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'Slovenia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'Solomon Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'Somalia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'South Africa', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'South Georgia and the South Sandwich Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'Spain', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'Sri Lanka', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'Sudan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'Suriname', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'Svalbard and Jan Mayen', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'Swaziland', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'Sweden', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'Switzerland', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'Syrian Arab Republic', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'Taiwan, Province of China', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'Tajikistan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'Tanzania, United Republic of', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'Thailand', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'Timor-Leste', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'Togo', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'Tokelau', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'Tonga', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'Trinidad and Tobago', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'Tunisia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'Turkey', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'Turkmenistan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'Turks and Caicos Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'Tuvalu', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'Uganda', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'Ukraine', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'United Arab Emirates', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'United Kingdom', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'United States', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'United States Minor Outlying Islands', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'Uruguay', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'Uzbekistan', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'Vanuatu', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'Venezuela', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'Viet Nam', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'Virgin Islands, British', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'Virgin Islands, U.s.', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'Wallis and Futuna', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'Western Sahara', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'Yemen', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'Zambia', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'Zimbabwe', 1000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0 = Not activated 1 = Activated',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `city`, `state`, `country`, `zip_code`, `mobile`, `status`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Hannan Ali', 'Banani', 'Dhaka', 'Dhaka', 'Bangladesh', '1215', '01531261214', 1, 'mdhannan.info@gmail.com', NULL, '$2y$10$s9PZ0pnbvfawGFP5gymJ5Oqt6VjjZp8ihvs5CO2pc4QPCJoG8JV4a', NULL, '2021-09-11 04:25:15', '2021-09-11 09:50:26');

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
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_logs`
--
ALTER TABLE `orders_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
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
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_logs`
--
ALTER TABLE `orders_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
