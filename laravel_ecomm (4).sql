-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2021 at 01:24 PM
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
(3, '5Xt97KNuuaJLQZIWhsyEIIfyh6Rubc3rBPKqpfti', 1, 3, 'Small', 3, '2021-09-11 04:26:13', '2021-09-11 04:26:13');

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
  `iso` char(2) NOT NULL,
  `id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`iso`, `id`, `country_name`) VALUES
('AF', 1, 'Afghanistan'),
('AL', 2, 'Albania'),
('DZ', 3, 'Algeria'),
('AS', 4, 'American Samoa'),
('AD', 5, 'Andorra'),
('AO', 6, 'Angola'),
('AI', 7, 'Anguilla'),
('AQ', 8, 'Antarctica'),
('AG', 9, 'Antigua and Barbuda'),
('AR', 10, 'Argentina'),
('AM', 11, 'Armenia'),
('AW', 12, 'Aruba'),
('AU', 13, 'Australia'),
('AT', 14, 'Austria'),
('AZ', 15, 'Azerbaijan'),
('BS', 16, 'Bahamas'),
('BH', 17, 'Bahrain'),
('BD', 18, 'Bangladesh'),
('BB', 19, 'Barbados'),
('BY', 20, 'Belarus'),
('BE', 21, 'Belgium'),
('BZ', 22, 'Belize'),
('BJ', 23, 'Benin'),
('BM', 24, 'Bermuda'),
('BT', 25, 'Bhutan'),
('BO', 26, 'Bolivia'),
('BA', 27, 'Bosnia and Herzegovina'),
('BW', 28, 'Botswana'),
('BV', 29, 'Bouvet Island'),
('BR', 30, 'Brazil'),
('IO', 31, 'British Indian Ocean Territory'),
('BN', 32, 'Brunei Darussalam'),
('BG', 33, 'Bulgaria'),
('BF', 34, 'Burkina Faso'),
('BI', 35, 'Burundi'),
('KH', 36, 'Cambodia'),
('CM', 37, 'Cameroon'),
('CA', 38, 'Canada'),
('CV', 39, 'Cape Verde'),
('KY', 40, 'Cayman Islands'),
('CF', 41, 'Central African Republic'),
('TD', 42, 'Chad'),
('CL', 43, 'Chile'),
('CN', 44, 'China'),
('CX', 45, 'Christmas Island'),
('CC', 46, 'Cocos (Keeling) Islands'),
('CO', 47, 'Colombia'),
('KM', 48, 'Comoros'),
('CG', 49, 'Congo'),
('CD', 50, 'Congo, the Democratic Republic of the'),
('CK', 51, 'Cook Islands'),
('CR', 52, 'Costa Rica'),
('CI', 53, 'Cote D\'Ivoire'),
('HR', 54, 'Croatia'),
('CU', 55, 'Cuba'),
('CY', 56, 'Cyprus'),
('CZ', 57, 'Czech Republic'),
('DK', 58, 'Denmark'),
('DJ', 59, 'Djibouti'),
('DM', 60, 'Dominica'),
('DO', 61, 'Dominican Republic'),
('EC', 62, 'Ecuador'),
('EG', 63, 'Egypt'),
('SV', 64, 'El Salvador'),
('GQ', 65, 'Equatorial Guinea'),
('ER', 66, 'Eritrea'),
('EE', 67, 'Estonia'),
('ET', 68, 'Ethiopia'),
('FK', 69, 'Falkland Islands (Malvinas)'),
('FO', 70, 'Faroe Islands'),
('FJ', 71, 'Fiji'),
('FI', 72, 'Finland'),
('FR', 73, 'France'),
('GF', 74, 'French Guiana'),
('PF', 75, 'French Polynesia'),
('TF', 76, 'French Southern Territories'),
('GA', 77, 'Gabon'),
('GM', 78, 'Gambia'),
('GE', 79, 'Georgia'),
('DE', 80, 'Germany'),
('GH', 81, 'Ghana'),
('GI', 82, 'Gibraltar'),
('GR', 83, 'Greece'),
('GL', 84, 'Greenland'),
('GD', 85, 'Grenada'),
('GP', 86, 'Guadeloupe'),
('GU', 87, 'Guam'),
('GT', 88, 'Guatemala'),
('GN', 89, 'Guinea'),
('GW', 90, 'Guinea-Bissau'),
('GY', 91, 'Guyana'),
('HT', 92, 'Haiti'),
('HM', 93, 'Heard Island and Mcdonald Islands'),
('VA', 94, 'Holy See (Vatican City State)'),
('HN', 95, 'Honduras'),
('HK', 96, 'Hong Kong'),
('HU', 97, 'Hungary'),
('IS', 98, 'Iceland'),
('IN', 99, 'India'),
('ID', 100, 'Indonesia'),
('IR', 101, 'Iran, Islamic Republic of'),
('IQ', 102, 'Iraq'),
('IE', 103, 'Ireland'),
('IL', 104, 'Israel'),
('IT', 105, 'Italy'),
('JM', 106, 'Jamaica'),
('JP', 107, 'Japan'),
('JO', 108, 'Jordan'),
('KZ', 109, 'Kazakhstan'),
('KE', 110, 'Kenya'),
('KI', 111, 'Kiribati'),
('KP', 112, 'Korea, Democratic People\'s Republic of'),
('KR', 113, 'Korea, Republic of'),
('KW', 114, 'Kuwait'),
('KG', 115, 'Kyrgyzstan'),
('LA', 116, 'Lao People\'s Democratic Republic'),
('LV', 117, 'Latvia'),
('LB', 118, 'Lebanon'),
('LS', 119, 'Lesotho'),
('LR', 120, 'Liberia'),
('LY', 121, 'Libyan Arab Jamahiriya'),
('LI', 122, 'Liechtenstein'),
('LT', 123, 'Lithuania'),
('LU', 124, 'Luxembourg'),
('MO', 125, 'Macao'),
('MK', 126, 'Macedonia, the Former Yugoslav Republic of'),
('MG', 127, 'Madagascar'),
('MW', 128, 'Malawi'),
('MY', 129, 'Malaysia'),
('MV', 130, 'Maldives'),
('ML', 131, 'Mali'),
('MT', 132, 'Malta'),
('MH', 133, 'Marshall Islands'),
('MQ', 134, 'Martinique'),
('MR', 135, 'Mauritania'),
('MU', 136, 'Mauritius'),
('YT', 137, 'Mayotte'),
('MX', 138, 'Mexico'),
('FM', 139, 'Micronesia, Federated States of'),
('MD', 140, 'Moldova, Republic of'),
('MC', 141, 'Monaco'),
('MN', 142, 'Mongolia'),
('MS', 143, 'Montserrat'),
('MA', 144, 'Morocco'),
('MZ', 145, 'Mozambique'),
('MM', 146, 'Myanmar'),
('NA', 147, 'Namibia'),
('NR', 148, 'Nauru'),
('NP', 149, 'Nepal'),
('NL', 150, 'Netherlands'),
('AN', 151, 'Netherlands Antilles'),
('NC', 152, 'New Caledonia'),
('NZ', 153, 'New Zealand'),
('NI', 154, 'Nicaragua'),
('NE', 155, 'Niger'),
('NG', 156, 'Nigeria'),
('NU', 157, 'Niue'),
('NF', 158, 'Norfolk Island'),
('MP', 159, 'Northern Mariana Islands'),
('NO', 160, 'Norway'),
('OM', 161, 'Oman'),
('PK', 162, 'Pakistan'),
('PW', 163, 'Palau'),
('PS', 164, 'Palestinian Territory, Occupied'),
('PA', 165, 'Panama'),
('PG', 166, 'Papua New Guinea'),
('PY', 167, 'Paraguay'),
('PE', 168, 'Peru'),
('PH', 169, 'Philippines'),
('PN', 170, 'Pitcairn'),
('PL', 171, 'Poland'),
('PT', 172, 'Portugal'),
('PR', 173, 'Puerto Rico'),
('QA', 174, 'Qatar'),
('RE', 175, 'Reunion'),
('RO', 176, 'Romania'),
('RU', 177, 'Russian Federation'),
('RW', 178, 'Rwanda'),
('SH', 179, 'Saint Helena'),
('KN', 180, 'Saint Kitts and Nevis'),
('LC', 181, 'Saint Lucia'),
('PM', 182, 'Saint Pierre and Miquelon'),
('VC', 183, 'Saint Vincent and the Grenadines'),
('WS', 184, 'Samoa'),
('SM', 185, 'San Marino'),
('ST', 186, 'Sao Tome and Principe'),
('SA', 187, 'Saudi Arabia'),
('SN', 188, 'Senegal'),
('CS', 189, 'Serbia and Montenegro'),
('SC', 190, 'Seychelles'),
('SL', 191, 'Sierra Leone'),
('SG', 192, 'Singapore'),
('SK', 193, 'Slovakia'),
('SI', 194, 'Slovenia'),
('SB', 195, 'Solomon Islands'),
('SO', 196, 'Somalia'),
('ZA', 197, 'South Africa'),
('GS', 198, 'South Georgia and the South Sandwich Islands'),
('ES', 199, 'Spain'),
('LK', 200, 'Sri Lanka'),
('SD', 201, 'Sudan'),
('SR', 202, 'Suriname'),
('SJ', 203, 'Svalbard and Jan Mayen'),
('SZ', 204, 'Swaziland'),
('SE', 205, 'Sweden'),
('CH', 206, 'Switzerland'),
('SY', 207, 'Syrian Arab Republic'),
('TW', 208, 'Taiwan, Province of China'),
('TJ', 209, 'Tajikistan'),
('TZ', 210, 'Tanzania, United Republic of'),
('TH', 211, 'Thailand'),
('TL', 212, 'Timor-Leste'),
('TG', 213, 'Togo'),
('TK', 214, 'Tokelau'),
('TO', 215, 'Tonga'),
('TT', 216, 'Trinidad and Tobago'),
('TN', 217, 'Tunisia'),
('TR', 218, 'Turkey'),
('TM', 219, 'Turkmenistan'),
('TC', 220, 'Turks and Caicos Islands'),
('TV', 221, 'Tuvalu'),
('UG', 222, 'Uganda'),
('UA', 223, 'Ukraine'),
('AE', 224, 'United Arab Emirates'),
('GB', 225, 'United Kingdom'),
('US', 226, 'United States'),
('UM', 227, 'United States Minor Outlying Islands'),
('UY', 228, 'Uruguay'),
('UZ', 229, 'Uzbekistan'),
('VU', 230, 'Vanuatu'),
('VE', 231, 'Venezuela'),
('VN', 232, 'Viet Nam'),
('VG', 233, 'Virgin Islands, British'),
('VI', 234, 'Virgin Islands, U.s.'),
('WF', 235, 'Wallis and Futuna'),
('EH', 236, 'Western Sahara'),
('YE', 237, 'Yemen'),
('ZM', 238, 'Zambia'),
('ZW', 239, 'Zimbabwe');

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
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_charges` double(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = active and 0 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country`, `shipping_charges`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh', 100.00, 1, '2021-09-11 11:47:22', '2021-09-11 06:17:32'),
(2, 'India', 1500.00, 1, '2021-09-11 11:47:22', '2021-09-11 06:12:07');

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
(1, 'Muhammad Hannan Ali', NULL, NULL, NULL, NULL, NULL, '01531261214', 1, 'mdhannan.info@gmail.com', NULL, '$2y$10$s9PZ0pnbvfawGFP5gymJ5Oqt6VjjZp8ihvs5CO2pc4QPCJoG8JV4a', NULL, '2021-09-11 04:25:15', '2021-09-11 04:25:55');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_logs`
--
ALTER TABLE `orders_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
