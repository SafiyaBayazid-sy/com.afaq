-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2026 at 08:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afaq_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `status` enum('upcoming','completed','cancelled') NOT NULL DEFAULT 'upcoming',
  `notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer_id`, `booking_date`, `booking_time`, `status`, `notes`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-03-10', '10:30:00', 'upcoming', 'أرغب في مناقشة تفاصيل بناء الفيلا', 'تم تأكيد الموعد', '2026-03-05 15:28:48', '2026-03-07 15:28:48'),
(2, 2, '2026-03-12', '16:00:00', 'upcoming', 'الاستفسار عن ترميم الشقة', NULL, '2026-03-06 15:28:48', '2026-03-07 15:28:48'),
(3, 3, '2026-03-05', '13:15:00', 'completed', 'عرض دراسة الجدوى', 'تم الاجتماع وعرض الدراسة', '2026-03-02 15:28:48', '2026-03-07 15:28:48'),
(4, 4, '2026-03-06', '11:45:00', 'cancelled', 'الاستفسار عن البناء على الأرض', 'تم الإلغاء من قبل العميلة', '2026-03-04 15:28:48', '2026-03-07 15:28:48'),
(5, 1, '2026-02-25', '09:00:00', 'completed', 'استشارة أولية', 'تم الاجتماع والتعرف على متطلبات العميل', '2026-02-23 15:28:48', '2026-03-07 15:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `source` enum('facebook','google_ad','snapchat','tiktok','friend','google_search','other') DEFAULT NULL,
  `preferred_property_type` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `budget`, `source`, `preferred_property_type`, `notes`, `created_at`, `updated_at`) VALUES
(1, 3, 1500000.00, 'facebook', 'villa', 'يبحث عن فيلا مستقلة في شمال الرياض', '2026-03-07 15:28:43', '2026-03-07 15:28:43'),
(2, 4, 850000.00, 'google_ad', 'apartment', 'مهتم بشقق فاخرة في جدة', '2026-03-07 15:28:43', '2026-03-07 15:28:43'),
(3, 5, 2000000.00, 'friend', 'building', 'يبحث عن عمارة استثمارية في الدمام', '2026-03-07 15:28:44', '2026-03-07 15:28:44'),
(4, 6, 500000.00, 'snapchat', 'land', 'أرض للاستثمار في ضواحي الرياض', '2026-03-07 15:28:44', '2026-03-07 15:28:44'),
(5, 7, 1200000.00, 'tiktok', 'floor', 'يبحث عن دور كامل في الخبر', '2026-03-07 15:28:44', '2026-03-07 15:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','contacted','completed') NOT NULL DEFAULT 'new',
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `customer_id`, `category_id`, `message`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'أرغب في الاستفسار عن إمكانية بناء فيلا بمساحة 500 متر في شمال الرياض. كم التكلفة التقريبية والمدة الزمنية؟', 'completed', 'تم التواصل مع العميل وإرسال العرض السعري', '2026-03-02 15:28:48', '2026-03-07 15:28:48'),
(2, 1, 3, 'هل يمكنكم توفير استشارة حول أفضل تصميم للفيلا مع مراعاة الخصوصية؟', 'contacted', 'تم تحويل الاستشارة للمهندس المختص', '2026-03-05 15:28:48', '2026-03-07 15:28:48'),
(3, 2, 2, 'لدي شقة قديمة في جدة وأرغب في ترميمها بالكامل. هل لديكم خبرة في هذا المجال؟', 'new', NULL, '2026-03-07 10:28:48', '2026-03-07 15:28:48'),
(4, 4, 1, 'هل يمكنكم بناء فيلا صغيرة على أرض مساحتها 300 متر في ضواحي الرياض؟', 'new', NULL, '2026-03-06 15:28:48', '2026-03-07 15:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_categories`
--

CREATE TABLE `inquiry_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inquiry_categories`
--

INSERT INTO `inquiry_categories` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'بناء جديد', 'استفسارات عن بناء مشاريع جديدة من الألف إلى الياء', 1, '2026-03-07 15:28:45', '2026-03-07 15:28:45'),
(2, 'ترميم وتطوير', 'استفسارات عن ترميم وتجديد العقارات القائمة', 1, '2026-03-07 15:28:45', '2026-03-07 15:28:45'),
(3, 'استشارات هندسية', 'استشارات حول التصميم والهندسة المعمارية', 1, '2026-03-07 15:28:45', '2026-03-07 15:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_campaigns`
--

CREATE TABLE `marketing_campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `utm_source` varchar(255) DEFAULT NULL,
  `utm_medium` varchar(255) DEFAULT NULL,
  `utm_campaign` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marketing_campaigns`
--

INSERT INTO `marketing_campaigns` (`id`, `name`, `platform`, `utm_source`, `utm_medium`, `utm_campaign`, `start_date`, `end_date`, `budget`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'حملة فلل الرياض', 'فيسبوك', 'facebook', 'social', 'riyadh_villas_2026', '2026-02-01', '2026-02-28', 15000.00, 'حملة تستهدف الباحثين عن فلل في الرياض', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(2, 'إعلانات جوجل - ترميم', 'جوجل أدز', 'google_ad', 'cpc', 'renovation_ads_q1', '2026-01-15', '2026-03-15', 25000.00, 'حملة إعلانات بحث تستهدف كلمات مفتاحية للترميم', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(3, 'حملة سناب شات للشباب', 'سناب شات', 'snapchat', 'social', 'youth_snap_2026', '2026-02-15', '2026-03-15', 10000.00, 'حملة تستهدف الفئة العمرية 25-35 سنة', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(4, 'تيك توك عقار', 'تيك توك', 'tiktok', 'social', 'property_tips', '2026-02-20', '2026-03-20', 8000.00, 'محتوى توعوي عن الاستثمار العقاري', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(5, 'حملة جوجل البحثية', 'جوجل أدز', 'google_search', 'cpc', 'construction_search', '2026-01-01', '2026-03-31', 30000.00, 'حملة موسعة للبحث عن كلمات البناء والتشييد', '2026-03-07 15:28:49', '2026-03-07 15:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000003_create_projects_table', 1),
(4, '0001_01_01_000004_create_project_images_table', 1),
(5, '0001_01_01_000005_create_inquiry_categories_table', 1),
(6, '0001_01_01_000006_create_customers_table', 1),
(7, '0001_01_01_000006_create_inquiries_table', 1),
(8, '0001_01_01_000007_create_bookings_table', 1),
(9, '0001_01_01_000008_create_visitor_tracking_table', 1),
(10, '0001_01_01_000009_create_marketing_campaigns_table', 1),
(11, '0001_01_01_000009_create_notifications_table', 1),
(12, '0001_01_01_000010_create_settings_table', 1),
(13, '0001_01_01_000012_create_password_reset_tokens_table', 1),
(14, '0001_01_01_000013_create_sessions_table', 1),
(15, '0001_03_06_103651_create_personal_access_tokens_table', 1),
(16, '0001_08_14_170933_add_two_factor_columns_to_users_table copy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `title`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'new_inquiry', 'استفسار جديد', 'تم استلام استفسار جديد من محمد العلي', 1, '2026-03-02 15:28:50', '2026-03-07 15:28:50'),
(2, 1, 'new_booking', 'حجز موعد جديد', 'تم حجز موعد جديد من فهد الدوسري', 1, '2026-03-04 15:28:50', '2026-03-07 15:28:50'),
(3, 2, 'new_inquiry', 'استفسار جديد', 'تم استلام استفسار جديد من عبدالله الحربي', 0, '2026-03-07 10:28:50', '2026-03-07 15:28:50'),
(4, 1, 'new_customer', 'مستثمر جديد', 'تم تسجيل مستثمر جديد: نورة القحطاني', 0, '2026-03-06 15:28:50', '2026-03-07 15:28:50'),
(5, 3, 'booking_confirmation', 'تأكيد الحجز', 'تم تأكيد حجز موعدك يوم 2026-03-10', 0, '2026-03-05 15:28:50', '2026-03-07 15:28:50'),
(6, 3, 'inquiry_response', 'رد على استفسارك', 'تم الرد على استفسارك بخصوص بناء الفيلا', 1, '2026-03-03 15:28:50', '2026-03-07 15:28:50'),
(7, 4, 'booking_reminder', 'تذكير بالموعد', 'موعدك غداً الساعة 4:00 مساءً', 0, '2026-03-06 15:28:50', '2026-03-07 15:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `project_status` enum('on_hold','in_progress','completed') NOT NULL DEFAULT 'on_hold',
  `project_type` enum('renovation','construction') DEFAULT NULL,
  `property_type` enum('villa','building','floor','apartment','land') DEFAULT NULL,
  `map_location` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `country`, `state`, `city`, `street`, `price`, `project_status`, `project_type`, `property_type`, `map_location`, `video_url`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'فلل النرجس الفاخرة', 'مشروع فلل مستقلة فاخرة في حي النرجس بالرياض، تتميز بتصميم عصري ومساحات واسعة', 'السعودية', 'الرياض', 'الرياض', 'حي النرجس', 2500000.00, 'completed', 'construction', 'villa', 'https://maps.google.com/?q=24.774265,46.738586', 'https://www.youtube.com/watch?v=example1', 1, '2026-03-07 15:28:46', '2026-03-07 15:28:46'),
(2, 'ترميم قصر السلام', 'مشروع ترميم وتطوير قصر تاريخي في جدة مع الحفاظ على الطابع المعماري الأصيل', 'السعودية', 'مكة المكرمة', 'جدة', 'البلد', 1800000.00, 'completed', 'renovation', 'building', 'https://maps.google.com/?q=21.485811,39.192505', 'https://www.youtube.com/watch?v=example2', 1, '2026-03-07 15:28:46', '2026-03-07 15:28:46'),
(3, 'برج الأعمال الشمالي', 'برج إداري تجاري في شمال الرياض مكون من 12 دور', 'السعودية', 'الرياض', 'الرياض', 'طريق الملك فهد', 15000000.00, 'in_progress', 'construction', 'building', 'https://maps.google.com/?q=24.794265,46.628586', 'https://www.youtube.com/watch?v=example3', 1, '2026-03-07 15:28:46', '2026-03-07 15:28:46'),
(4, 'شاطئ الخبر السكني', 'مشروع سكني متكامل على واجهة الخبر البحرية', 'السعودية', 'الشرقية', 'الخبر', 'الكورنيش', 3500000.00, 'on_hold', 'construction', 'apartment', 'https://maps.google.com/?q=26.290427,50.208412', 'https://www.youtube.com/watch?v=example4', 1, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(5, 'تطوير طريق العليا', 'تطوير وترميم واجهة مبنى تجاري في طريق العليا بالرياض', 'السعودية', 'الرياض', 'الرياض', 'طريق العليا', 750000.00, 'completed', 'renovation', 'building', 'https://maps.google.com/?q=24.724265,46.658586', 'https://www.youtube.com/watch?v=example5', 1, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(6, 'مجمع فلل الياسمين', 'مجموعة من الفلل المتلاصقة في حي الياسمين بالرياض', 'السعودية', 'الرياض', 'الرياض', 'حي الياسمين', 4200000.00, 'completed', 'construction', 'villa', 'https://maps.google.com/?q=24.814265,46.668586', 'https://www.youtube.com/watch?v=example6', 0, '2026-03-07 15:28:47', '2026-03-07 15:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `project_images`
--

CREATE TABLE `project_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_images`
--

INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `is_main`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'projects/narjis-villa/main.jpg', 1, 1, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(2, 1, 'projects/narjis-villa/exterior-1.jpg', 0, 2, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(3, 1, 'projects/narjis-villa/interior-1.jpg', 0, 3, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(4, 1, 'projects/narjis-villa/garden.jpg', 0, 4, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(5, 2, 'projects/salam-palace/before-1.jpg', 0, 1, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(6, 2, 'projects/salam-palace/after-1.jpg', 1, 2, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(7, 2, 'projects/salam-palace/details-1.jpg', 0, 3, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(8, 3, 'projects/business-tower/design-1.jpg', 1, 1, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(9, 3, 'projects/business-tower/construction-1.jpg', 0, 2, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(10, 4, 'projects/khobar-beach/view-1.jpg', 1, 1, '2026-03-07 15:28:47', '2026-03-07 15:28:47'),
(11, 4, 'projects/khobar-beach/apartment-1.jpg', 0, 2, '2026-03-07 15:28:47', '2026-03-07 15:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` enum('text','number','boolean','json','image') NOT NULL DEFAULT 'text',
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `label` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES
(1, 'company_name', 'آفاق العمران للتطوير العقاري', 'text', 'company_info', 'اسم الشركة', 'الاسم الرسمي للشركة', 1, '2026-03-07 15:28:50', '2026-03-07 15:28:50'),
(2, 'company_logo', 'settings/logo.png', 'image', 'company_info', 'شعار الشركة', 'شعار الشركة للعرض في الموقع والتطبيق', 1, '2026-03-07 15:28:50', '2026-03-07 15:28:50'),
(3, 'company_email', 'info@afaq-omran.com', 'text', 'company_info', 'البريد الإلكتروني', 'البريد الإلكتروني الرسمي للتواصل', 1, '2026-03-07 15:28:51', '2026-03-07 15:28:51'),
(4, 'company_phone', '966920000000', 'text', 'company_info', 'رقم الهاتف', 'رقم الهاتف الموحد', 1, '2026-03-07 15:28:51', '2026-03-07 15:28:51'),
(5, 'facebook_url', 'https://facebook.com/afaqomran', 'text', 'social_media', 'رابط فيسبوك', 'صفحة الشركة على فيسبوك', 1, '2026-03-07 15:28:51', '2026-03-07 15:28:51'),
(6, 'twitter_url', 'https://twitter.com/afaqomran', 'text', 'social_media', 'رابط تويتر', 'حساب الشركة على تويتر', 1, '2026-03-07 15:28:51', '2026-03-07 15:28:51'),
(7, 'instagram_url', 'https://instagram.com/afaqomran', 'text', 'social_media', 'رابط انستغرام', 'حساب الشركة على انستغرام', 1, '2026-03-07 15:28:51', '2026-03-07 15:28:51'),
(8, 'snapchat_url', 'https://snapchat.com/add/afaqomran', 'text', 'social_media', 'رابط سناب شات', 'حساب الشركة على سناب شات', 1, '2026-03-07 15:28:51', '2026-03-07 15:28:51'),
(9, 'app_store_link', 'https://apps.apple.com/app/afaq-omran', 'text', 'app_links', 'رابط آب ستور', 'رابط التطبيق على آب ستور', 1, '2026-03-07 15:28:51', '2026-03-07 15:28:51'),
(10, 'google_play_link', 'https://play.google.com/store/apps/details?id=com.afaq.omran', 'text', 'app_links', 'رابط جوجل بلاي', 'رابط التطبيق على جوجل بلاي', 1, '2026-03-07 15:28:51', '2026-03-07 15:28:51'),
(11, 'enable_notifications', 'true', 'boolean', 'system', 'تفعيل الإشعارات', 'تشغيل أو إيقاف الإشعارات في النظام', 0, '2026-03-07 15:28:51', '2026-03-07 15:28:51'),
(12, 'default_booking_duration', '60', 'number', 'booking', 'مدة الحجز الافتراضية', 'مدة الموعد بالدقائق', 0, '2026-03-07 15:28:51', '2026-03-07 15:28:51'),
(13, 'about_us', 'شركة آفاق العمران للتطوير العقاري هي شركة رائدة في مجال التطوير العقاري والبناء والترميم، تأسست لتقديم حلول عقارية متكاملة تلبي تطلعات عملائنا.', 'text', 'content', 'من نحن', 'نص صفحة من نحن', 1, '2026-03-07 15:28:51', '2026-03-07 15:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `user_type` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `user_type`, `is_active`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'أحمد المدير', 'admin@afaq.com', '966500000001', '$2y$12$W3zZ6HgGLX7eZlPtdS4KVe79pKujovTrSG//giFv2b.f.3NJj1NOq', NULL, NULL, NULL, 'admin', 1, NULL, NULL, '2026-03-07 15:28:39', '2026-03-07 15:28:39'),
(2, 'سارة المشرفة', 'sarah@afaq.com', '966500000002', '$2y$12$/zRJiove.N7WsxdEJOqBbujdz7gH7aUbROEh9XHfNCGf4LSHl2Seu', NULL, NULL, NULL, 'admin', 1, NULL, NULL, '2026-03-07 15:28:40', '2026-03-07 15:28:40'),
(3, 'محمد العلي', 'mohammed@gmail.com', '966501234567', '$2y$12$b3L0sFe4f40eVq1vbxYnvOY.LX4kj1WE9fjlB79ukUK8jv9sIdfI6', NULL, NULL, NULL, 'customer', 1, NULL, NULL, '2026-03-07 15:28:42', '2026-03-07 15:28:42'),
(4, 'عبدالله الحربي', 'abdullah@hotmail.com', '966502345678', '$2y$12$5/FkQuqG/oc3UtquhnHsW.t4shOGo2GvXudjc9j2EzaoFx4ti1v96', NULL, NULL, NULL, 'customer', 1, NULL, NULL, '2026-03-07 15:28:42', '2026-03-07 15:28:42'),
(5, 'فهد الدوسري', 'fahad@gmail.com', '966503456789', '$2y$12$N6z6HdUNi7tvMDeGElXNqu.r43ub.w/4DouIAGkqKDxan3UMELNF2', NULL, NULL, NULL, 'customer', 1, NULL, NULL, '2026-03-07 15:28:42', '2026-03-07 15:28:42'),
(6, 'نورة القحطاني', 'noura@gmail.com', '966504567890', '$2y$12$dhfH6E6OidU2hhqItJsfKuh/P23wG8DCllSSbSmqZs3N7x4T4nxxy', NULL, NULL, NULL, 'customer', 1, NULL, NULL, '2026-03-07 15:28:43', '2026-03-07 15:28:43'),
(7, 'سعد الشمري', 'saad@yahoo.com', '966505678901', '$2y$12$WiI1z0wxmYvnEm7UzMXQ9OFOOPO6T1UEbRJF1dprrzE4tWhI3nkVO', NULL, NULL, NULL, 'customer', 0, NULL, NULL, '2026-03-07 15:28:43', '2026-03-07 15:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_tracking`
--

CREATE TABLE `visitor_tracking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `utm_source` varchar(255) DEFAULT NULL,
  `utm_medium` varchar(255) DEFAULT NULL,
  `utm_campaign` varchar(255) DEFAULT NULL,
  `visited_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_tracking`
--

INSERT INTO `visitor_tracking` (`id`, `utm_source`, `utm_medium`, `utm_campaign`, `visited_at`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'social', 'riyadh_villas_2026', '2026-02-25 10:30:00', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(2, 'facebook', 'social', 'riyadh_villas_2026', '2026-02-26 06:15:00', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(3, 'google_ad', 'cpc', 'renovation_ads_q1', '2026-02-27 12:45:00', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(4, 'google_ad', 'cpc', 'renovation_ads_q1', '2026-02-28 05:20:00', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(5, 'snapchat', 'social', 'youth_snap_2026', '2026-03-01 16:10:00', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(6, 'tiktok', 'social', 'property_tips', '2026-03-02 15:30:00', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(7, 'google_search', 'organic', NULL, '2026-03-03 07:05:00', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(8, NULL, 'direct', NULL, '2026-03-04 09:40:00', '2026-03-07 15:28:49', '2026-03-07 15:28:49'),
(9, 'friend', 'referral', NULL, '2026-03-05 11:25:00', '2026-03-07 15:28:50', '2026-03-07 15:28:50'),
(10, 'google_ad', 'cpc', 'construction_search', '2026-03-06 13:50:00', '2026-03-07 15:28:50', '2026-03-07 15:28:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inquiries_customer_id_foreign` (`customer_id`),
  ADD KEY `inquiries_category_id_foreign` (`category_id`);

--
-- Indexes for table `inquiry_categories`
--
ALTER TABLE `inquiry_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketing_campaigns`
--
ALTER TABLE `marketing_campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_index` (`user_id`),
  ADD KEY `notifications_is_read_index` (`is_read`),
  ADD KEY `notifications_created_at_index` (`created_at`),
  ADD KEY `notifications_user_id_is_read_index` (`user_id`,`is_read`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_project_status_index` (`project_status`),
  ADD KEY `projects_is_active_index` (`is_active`),
  ADD KEY `projects_name_index` (`name`);

--
-- Indexes for table `project_images`
--
ALTER TABLE `project_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_images_project_id_index` (`project_id`),
  ADD KEY `project_images_is_main_index` (`is_main`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`),
  ADD KEY `settings_group_index` (`group`),
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_user_type_index` (`user_type`),
  ADD KEY `users_is_active_index` (`is_active`);

--
-- Indexes for table `visitor_tracking`
--
ALTER TABLE `visitor_tracking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inquiry_categories`
--
ALTER TABLE `inquiry_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marketing_campaigns`
--
ALTER TABLE `marketing_campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_images`
--
ALTER TABLE `project_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `visitor_tracking`
--
ALTER TABLE `visitor_tracking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD CONSTRAINT `inquiries_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `inquiry_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `inquiries_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_images`
--
ALTER TABLE `project_images`
  ADD CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
