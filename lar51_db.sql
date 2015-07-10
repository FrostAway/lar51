-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2015 at 09:58 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lar51_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cat',
  `parent` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `type`, `parent`, `order`, `count`, `created_at`, `updated_at`) VALUES
(2, 'Tin tức', 'Tin-tuc', 'cat', 0, 0, 0, '2015-07-01 00:15:05', '2015-07-01 00:15:05'),
(5, 'Sản phẩm - Dịch vụ', 'san-pham-dich-vu', 'cat', 0, 0, 0, '2015-07-01 00:15:33', '2015-07-07 21:28:40'),
(9, 'Thời sự', 'Thoi-su', 'tag', 0, 0, 0, '2015-07-03 01:40:47', '2015-07-03 01:40:47'),
(10, 'Kinh tế', 'Kinh-te', 'tag', 0, 0, 0, '2015-07-03 01:40:47', '2015-07-03 01:40:47'),
(16, 'Bóng đá', 'Bong-da', 'tag', 0, 0, 0, '2015-07-03 19:09:30', '2015-07-03 19:09:30'),
(20, 'Top Menu', 'Top-Menu', 'menu', 0, 0, 0, '2015-07-03 20:56:35', '2015-07-03 20:59:06'),
(21, 'Footer Menu', 'Footer-Menu', 'menu', 0, 0, 0, '2015-07-03 20:58:55', '2015-07-03 20:59:33'),
(26, 'Tuyển dụng', 'tuyen-dung', 'cat', 0, 0, 0, '2015-07-07 21:32:21', '2015-07-07 21:32:21'),
(27, 'Sự kiện - Cẩm nang du lịch', 'su-kien---cam-nang-du-lich', 'cat', 0, 0, 0, '2015-07-08 03:06:56', '2015-07-08 03:06:56'),
(28, 'du lịch', 'du-lich', 'tag', 0, 0, 0, '2015-07-08 03:08:48', '2015-07-08 03:08:48'),
(29, 'Top Menu', 'top-menu', 'slider', 0, 0, 0, '2015-07-09 20:21:35', '2015-07-09 20:21:35'),
(30, 'Content slider', 'content-slider', 'slider', 0, 0, 0, '2015-07-09 20:21:47', '2015-07-09 20:21:47'),
(31, 'Loại phòng', 'loai-phong', 'cat', 0, 0, 0, '2015-07-09 21:14:21', '2015-07-09 21:14:21'),
(32, 'Đánh giá', 'danh-gia', 'cat', 0, 0, 0, '2015-07-09 21:44:34', '2015-07-09 21:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE IF NOT EXISTS `category_post` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`post_id`, `category_id`, `created_at`, `updated_at`) VALUES
(26, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `mime_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `author_id`, `name`, `title`, `src`, `type`, `mime_type`, `created_at`, `updated_at`) VALUES
(19, 1, 'hinh-anh-1.jpg', 'Hình ảnh 1', '/resources/upload/27_06_2015_1524858_1017341921609330_2536072926638946778_n.jpg', 'image', 'image/jpeg', '2015-06-26 18:55:01', '2015-06-26 20:56:07'),
(21, 1, '10983364_1014501951893327_8824307403865621119_n.jpg', '', 'resources/upload/27_06_2015_10983364_1014501951893327_8824307403865621119_n.jpg', 'image', 'image/jpeg', '2015-06-26 19:47:52', '2015-06-26 19:47:52'),
(28, 1, '11216798_1017341978275991_8695265245657032266_n.jpg', '', '/resources/upload/thumbnail/27_06_2015_11216798_1017341978275991_8695265245657032266_n.jpg', 'image', 'image/jpeg', '2015-06-26 20:12:52', '2015-06-26 20:12:52'),
(29, 1, 'Tiếng Anh ', 'tiếng anh', '<iframe width="560" height="315" src="https://www.youtube.com/embed/voOSePsdiUE" frameborder="0" allowfullscreen></iframe>', 'video', '', '2015-06-27 22:09:21', '2015-06-28 18:29:34'),
(30, 1, 'meville', 'meville', '<iframe width="560" height="315" src="https://www.youtube.com/embed/1ACtCp6jaRE" frameborder="0" allowfullscreen></iframe>', 'video', '', '2015-06-27 22:12:44', '2015-06-28 18:29:11'),
(31, 1, 'QTCS', 'ba toi', '<iframe width="560" height="315" src="https://www.youtube.com/embed/o_FGbmcTNvk" frameborder="0" allowfullscreen></iframe>', 'video', '', '2015-06-28 18:26:34', '2015-06-28 18:26:34'),
(32, 1, 'PageNotFound-Man.jpg', '', '/resources/upload/29_06_2015_PageNotFound-Man.jpg', 'image', 'image/jpeg', '2015-06-28 18:31:04', '2015-06-28 18:31:04'),
(33, 1, '18521_856359974412388_3193020648848491989_n.jpg', '', '/resources/upload/29_06_2015_18521_856359974412388_3193020648848491989_n.jpg', 'image', 'image/jpeg', '2015-06-28 19:01:47', '2015-06-28 19:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `open_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'current',
  `item_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'enable',
  `order` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `group_id`, `parent`, `type`, `open_type`, `item_id`, `link`, `status`, `order`, `icon`, `created_at`, `updated_at`) VALUES
(2, 'Tin tức', 20, 0, 'cat', 'current', 2, '/danh-muc/2/view', 'enable', 4, 'fa-newspaper-o', '2015-07-03 22:22:29', '2015-07-08 02:29:42'),
(6, 'Trang chủ', 20, 0, 'custom', 'current', 0, 'http://localhost/lar51', 'enable', 0, 'fa-home', '2015-07-04 00:10:48', '2015-07-08 01:13:41'),
(17, 'Giới thiệu', 20, 0, 'page', 'current', 21, '/trang/21/view', 'enable', 1, 'fa-user', '2015-07-07 21:36:00', '2015-07-08 02:29:20'),
(18, 'Sản phẩm - Dịch vụ', 20, 0, 'cat', 'current', 2, '/danh-muc/2/view', 'enable', 2, 'fa-shopping-cart', '2015-07-07 21:37:31', '2015-07-08 02:29:29'),
(19, 'Bảng giá', 20, 0, 'page', 'current', 21, '/trang/21/view', 'enable', 3, 'fa-money', '2015-07-07 21:38:05', '2015-07-08 02:29:36'),
(20, 'Thư viện ảnh', 20, 0, 'page', 'current', 23, '/trang/23/view', 'enable', 5, 'fa-image', '2015-07-07 21:39:22', '2015-07-08 02:29:48'),
(21, 'Video', 20, 0, 'page', 'current', 24, '/trang/24/view', 'enable', 6, 'fa-video-camera', '2015-07-07 21:40:09', '2015-07-08 02:29:55'),
(22, 'Tuyển dụng', 20, 0, 'cat', 'current', 26, '/danh-muc/26/view', 'enable', 7, 'fa-users', '2015-07-07 21:40:36', '2015-07-08 02:30:01'),
(23, 'Liên hệ', 20, 0, 'page', 'current', 25, '/trang/25/view', 'enable', 8, 'fa-phone', '2015-07-07 21:41:08', '2015-07-08 02:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_06_12_161949_create_posts_table', 2),
('2015_06_24_032447_create_menus_table', 2),
('2015_06_24_035229_crate_category_table', 2),
('2015_07_01_070801_create_table_category', 3),
('2015_07_03_073558_update_post_table', 4),
('2015_07_04_013831_update_table_category_post', 5),
('2015_07_04_025812_create_table_menus', 6),
('2015_07_06_020201_update_menus_table', 7),
('2015_07_06_023401_update_menus_table', 8),
('2015_07_06_035513_update_menus_table', 9),
('2015_07_07_014335_create_options_table', 10),
('2014_12_31_012339_tbl_temp', 1),
('2014_12_27_010927_create_tbl_users', 2),
('2014_12_29_011935_create_tbl_products', 2),
('2014_12_29_033347_create_attr_group_table', 2),
('2014_12_29_033752_create_attributes_table', 2),
('2014_12_29_034655_create_attr_relationship_table', 2),
('2014_12_30_102609_create_category_table', 2),
('2015_07_08_034643_create_comment_table', 11),
('2015_07_09_010327_crate_slides_table', 11),
('2015_07_10_041205_create_post_meta_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `key`, `title`, `value`, `created_at`, `updated_at`) VALUES
(1, 'st_title', '', 'Laravel', '2015-07-07 18:44:41', '2015-07-09 20:26:51'),
(2, 'st_desc', '', 'Website su dung laravel', '2015-07-07 18:44:41', '2015-07-09 20:26:52'),
(3, 'st_email', '', 'skyfrost.07@gmail.com', '2015-07-07 18:44:41', '2015-07-09 20:26:52'),
(4, 'st_logo', '', 'http://localhost/lar51/public/uploads/logo.png', '2015-07-07 20:44:43', '2015-07-07 20:56:51'),
(5, 'st_yahoo', '', 'vatc.online', '2015-07-09 20:26:52', '2015-07-09 20:26:52'),
(6, 'st_skype', '', 'vatcsleeppod', '2015-07-09 20:26:52', '2015-07-09 20:26:52'),
(7, 'st_phone', '', '(+84) 09874634734', '2015-07-09 20:26:52', '2015-07-09 20:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postmeta`
--

CREATE TABLE IF NOT EXISTS `postmeta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `post_status` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `comment_count` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'post',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `slug`, `image_url`, `post_content`, `post_excerpt`, `author_id`, `post_status`, `comment_status`, `comment_count`, `post_type`, `created_at`, `updated_at`) VALUES
(21, 'Giới thiệu', 'gioi-thieu', '', '<p>giới thiệu website</p>', '', 1, 'publish', 'open', 0, 'page', '2015-07-07 21:25:06', '2015-07-07 21:33:37'),
(22, 'Bảng giá', 'bang-gia', '', '<p>Table bảng gi&aacute;</p>', '', 1, 'publish', 'open', 0, 'page', '2015-07-07 21:30:51', '2015-07-07 21:30:51'),
(23, 'Thư viện Ảnh', 'thu-vien-anh', '', '<p>thư viện ảnh</p>', '', 1, 'publish', 'open', 0, 'page', '2015-07-07 21:31:29', '2015-07-07 21:31:29'),
(24, 'Video', 'video', '', '<p>list video</p>', '', 1, 'publish', 'open', 0, 'page', '2015-07-07 21:31:54', '2015-07-07 21:31:54'),
(25, 'Liên hệ', 'lien-he', '', '<p>trang li&ecirc;n hệ</p>', '', 1, 'publish', 'open', 0, 'page', '2015-07-07 21:32:38', '2015-07-07 21:32:38'),
(26, 'Hội An hành trình tìm về di sản văn hóa truyền thống', 'hoi-an-hanh-trinh-tim-ve-di-san-van-hoa-truyen-thong', '/public/uploads/thumb-2.jpg', '<h4>Hội An h&agrave;nh tr&igrave;nh t&igrave;m về di sản văn h&oacute;a truyền thống</h4>\r\n<p>&nbsp;</p>', '', 1, 'publish', 'open', 0, 'post', '2015-07-08 03:08:48', '2015-07-08 03:08:48'),
(27, 'Gợi ý hành trình tự túc khám phá Singapo 4 ngày', 'goi-y-hanh-trinh-tu-tuc-kham-pha-singapo-4-ngay', '/public/uploads/thumb-3.jpg', '<h4>Gợi &yacute; h&agrave;nh tr&igrave;nh tự t&uacute;c kh&aacute;m ph&aacute; Singapo 4 ng&agrave;y</h4>\r\n<p>&nbsp;</p>', '', 1, 'publish', 'open', 0, 'post', '2015-07-08 03:09:16', '2015-07-08 03:09:49'),
(28, 'Những điểm du lịch phải tới khi đến Đà Nẵng', 'nhung-diem-du-lich-phai-toi-khi-den-da-nang', '/public/uploads/thumb-4.jpg', '<p>Những điểm du lịch phải tới khi đến Đ&agrave; Nẵng</p>', '', 1, 'publish', 'open', 0, 'post', '2015-07-08 03:10:48', '2015-07-08 03:11:11'),
(29, 'Hội An hành trình tìm về di sản văn hóa truyền thống 2', 'hoi-an-hanh-trinh-tim-ve-di-san-van-hoa-truyen-thong-2', '/public/uploads/thumb-5.jpg', '<h4>Hội An h&agrave;nh tr&igrave;nh t&igrave;m về di sản văn h&oacute;a truyền thống</h4>\r\n<p>&nbsp;</p>', '', 1, 'publish', 'open', 0, 'post', '2015-07-08 03:12:05', '2015-07-08 03:12:19'),
(30, 'Phòng đơn', 'phong-don', '', '<p>ATC hoạt động trong lĩnh vực cung cấp dịch vụ du lịch, phục vụ h&agrave;nh kh&aacute;ch đi qua đường h&agrave;ng kh&ocirc;ng v&agrave; đầu tư bất động sản. </p>', '', 1, 'publish', 'open', 0, 'post', '2015-07-09 21:21:34', '2015-07-09 21:31:19'),
(31, 'Phòng đôi', 'phong-doi', '', '<p>ATC hoạt động trong lĩnh vực cung cấp dịch vụ du lịch, phục vụ h&agrave;nh kh&aacute;ch đi qua đường h&agrave;ng kh&ocirc;ng v&agrave; đầu tư bất động sản.</p>', '', 1, 'publish', 'open', 0, 'post', '2015-07-09 21:21:59', '2015-07-09 21:28:48'),
(32, 'Trần Văn B', 'tran-van-b', '/public/uploads/avatar.png', '<p>C&ocirc;ng Ty Cổ Phần Du Lịch H&agrave;ng Kh&ocirc;ng Việt Nam (VATC) l&agrave; một doanh nghiệp mới, được th&agrave;nh lập v&agrave;o đầu th&aacute;ng 11 năm 2013. VATC hoạt động trong lĩnh vực cung cấp dịch vụ du lịch, phục vụ h&agrave;nh kh&aacute;ch đi qua đường h&agrave;ng kh&ocirc;ng v&agrave; đầu tư bất động sản.</p>', 'Nhân viên tài chính', 1, 'publish', 'open', 0, 'post', '2015-07-09 21:55:10', '2015-07-10 00:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slider_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `open_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '9999999',
  `params` text COLLATE utf8_unicode_ci NOT NULL,
  `layers` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `slider_id`, `name`, `desc`, `slug`, `image`, `link`, `open_type`, `order`, `params`, `layers`, `created_at`, `updated_at`) VALUES
(1, 29, 'Khách sạn Mini duy nhất <br /> Tại sân bay Nội Bài', 'Bạn đã sẵn sàng? <strong>Trải nghiệm ngay</strong>', '', '/public/uploads/header-slide1.jpg', 'http://google.com.vn', 'newtab', 1, '', '', '2015-07-09 20:22:56', '2015-07-09 20:22:56'),
(2, 30, 'content slide 1', '', '', '/public/uploads/slide1.jpg', 'https://youtube.com', 'newtab', 1, '', '', '2015-07-09 20:23:52', '2015-07-09 20:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `bird` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `sex` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('administrator','author','subscriber') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'author',
  `activation_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `bird`, `address`, `bio`, `sex`, `role`, `activation_key`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$m.KHfGXBsdyOH3u9tqLSFeqhnG4NgagEUGz4ik9oLbhNZBADAHvfm', '20/3/1993', 'Ha Noi', '', 'male', 'administrator', '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'FrostLife07', 'skyfrost.07@gmail.com', '$2y$10$gkf6wVnzWsWbPN2tR7efrOB9/p5yJcrabrBIHMMid2D6r95O0d3r2', '18/06/2015', 'Nghệ An', '', 'male', 'author', '', NULL, '2015-06-28 19:21:19', '2015-06-28 19:21:38'),
(3, 'meville', 'ex@gmail.com', '$2y$10$Fp529mGYQpUOaLw48gaP5uc3qkaYAKAI9zg5G6l/4NvORrEpp41pG', '', '', '', 'male', 'subscriber', '', NULL, '2015-06-30 02:04:42', '2015-06-30 02:04:42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
