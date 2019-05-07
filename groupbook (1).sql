-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2019 at 02:43 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `groupbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_com_id` int(11) NOT NULL,
  `post_com_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `comment`, `user_com_id`, `post_com_id`, `created_at`, `updated_at`) VALUES
(1, 'this amazing  ', 1, 3, '2019-04-10 16:26:12', NULL),
(2, 'thanks man ', 2, 3, '2019-04-10 17:25:20', NULL),
(3, 'first comment', 1, 3, '2019-04-12 11:59:36', '2019-04-12 11:59:36'),
(4, 'firsrfsf', 1, 3, '2019-04-12 12:01:20', '2019-04-12 12:01:20'),
(5, 'sdfgsdfsd', 1, 4, '2019-04-12 12:01:34', '2019-04-12 12:01:34'),
(6, 'good man', 1, 3, '2019-04-12 12:03:25', '2019-04-12 12:03:25'),
(7, 'this amazing', 1, 36, '2019-04-13 07:24:35', '2019-04-13 07:24:35'),
(8, 'this test 1', 1, 4, '2019-04-13 07:31:11', '2019-04-13 07:31:11'),
(9, 'etfefwefw', 1, 36, '2019-04-13 07:31:59', '2019-04-13 07:31:59'),
(10, 'sdfsdfsdf', 1, 3, '2019-04-13 07:58:37', '2019-04-13 07:58:37'),
(11, 'zxczxc', 1, 34, '2019-04-13 08:01:11', '2019-04-13 08:01:11'),
(12, 'wewe', 1, 36, '2019-04-13 08:19:17', '2019-04-13 08:19:17'),
(13, 'sdadasdas', 2, 3, '2019-04-13 08:20:27', '2019-04-13 08:20:27'),
(14, 'this test', 2, 3, '2019-04-13 08:28:19', '2019-04-13 08:28:19'),
(15, 'love you thomas', 3, 30, '2019-04-13 08:44:27', '2019-04-13 08:44:27'),
(16, 'love you tooo merna', 1, 30, '2019-04-13 08:45:02', '2019-04-13 08:45:02'),
(17, 'sfsdasdfasfasfasf', 3, 36, '2019-04-13 08:46:29', '2019-04-13 08:46:29'),
(18, 'sdfsdfsdfsd', 1, 3, '2019-04-14 10:59:04', '2019-04-14 10:59:04'),
(19, 'hdfgdfgdf', 1, 4, '2019-04-14 13:19:55', '2019-04-14 13:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `con_id` int(10) UNSIGNED NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `con_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`con_id`, `user_one`, `user_two`, `con_status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, NULL, NULL),
(2, 4, 1, 1, NULL, NULL),
(3, 1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` int(10) UNSIGNED NOT NULL,
  `requester` int(11) NOT NULL,
  `user_requested` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id`, `requester`, `user_requested`, `status`, `created_at`, `updated_at`) VALUES
(8, 2, 4, 1, '2019-03-05 07:17:54', '2019-03-05 07:17:54'),
(9, 2, 1, 1, '2019-03-05 07:17:59', '2019-03-05 07:17:59'),
(10, 2, 3, 1, '2019-03-05 07:18:00', '2019-03-05 07:18:00'),
(11, 3, 1, 1, '2019-03-05 07:19:25', '2019-03-05 07:19:25'),
(12, 4, 3, 1, '2019-03-05 07:19:35', '2019-03-05 07:19:35'),
(13, 4, 1, 1, '2019-03-05 07:19:36', '2019-03-05 07:19:36'),
(14, 4, 2, 1, '2019-03-05 07:19:38', '2019-03-05 07:19:38'),
(15, 5, 1, 1, '2019-04-15 10:55:36', '2019-04-15 10:55:36'),
(16, 5, 2, 0, '2019-04-15 10:55:38', '2019-04-15 10:55:38'),
(17, 5, 3, 1, '2019-04-15 10:55:39', '2019-04-15 10:55:39'),
(18, 5, 4, 0, '2019-04-15 10:55:41', '2019-04-15 10:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `skills`, `requirements`, `contact_email`, `company_img`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'php developer', 'HTML,CSS,PHP', 'sfsdfsd sdfsdfsd sdf sdfsdfsd fs sdfs sdfs', 'programmingknoeloage', 'company_GroupBook-2019-04-03-03-29-21-d254e14859efab62c938ed94db8459abac50faea.jpg', 3, NULL, NULL),
(2, 'php developer', 'CSS,PHP', 'dfgdfgdfgdfgdfgdfg', 'dfgdfgdfgd', 'company_GroupBook-2019-04-03-03-29-21-d254e14859efab62c938ed94db8459abac50faea.jpg', 3, NULL, NULL),
(3, 'laravel developer', 'HTML,CSS,PHP', 'ewfwefwef', 'programmingknoeloage', 'company_GroupBook-2019-04-03-03-29-21-d254e14859efab62c938ed94db8459abac50faea.jpg', 3, NULL, NULL),
(4, 'laravel developer', 'HTML,CSS,PHP', 'fdg dgdf gdf gdfg dfg dfgdfg dfg dfg dfg df', 'programmingknoeloage', 'company_GroupBook-2019-04-03-03-29-21-d254e14859efab62c938ed94db8459abac50faea.jpg', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `userPost_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `post_id`, `userPost_id`, `created_at`, `updated_at`) VALUES
(13, 3, 1, '2019-04-07 14:23:59', '2019-04-07 14:23:59'),
(14, 35, 3, '2019-04-07 14:24:45', '2019-04-07 14:24:45'),
(15, 35, 1, '2019-04-07 14:24:50', '2019-04-07 14:24:50'),
(16, 4, 1, '2019-04-14 13:23:04', '2019-04-14 13:23:04'),
(17, 39, 1, '2019-04-14 13:23:09', '2019-04-14 13:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_from`, `user_to`, `conversation_id`, `msg`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 'hello , merna ', 1, NULL, NULL),
(2, 3, 1, 1, 'hello , thomas ', 1, NULL, NULL),
(3, 1, 3, 1, 'how are you  ? ', 1, NULL, NULL),
(4, 3, 1, 1, 'I fine , thanks ', 1, NULL, NULL),
(5, 4, 1, 2, 'Hello Thomas , can ask your ?', 1, NULL, NULL),
(6, 1, 3, 1, 'Where Are your from ? merna ', 1, NULL, NULL),
(7, 3, 1, 1, 'Egypr ,cairo , and u ', 1, NULL, NULL),
(8, 1, 1, 2, 'hello yassa', 1, NULL, NULL),
(9, 1, 3, 1, 'caito tto', 1, NULL, NULL),
(10, 1, 3, 1, 'dfgdfgdfgdfg', 1, NULL, NULL),
(11, 3, 3, 1, 'dfgdfgdfg', 1, NULL, NULL),
(12, 1, 3, 1, 'sdfgdgdfg', 1, NULL, NULL),
(13, 1, 2, 3, 'sdfsdfsdfsd', 1, NULL, NULL),
(14, 1, 3, 1, 'fpf;', 1, NULL, NULL),
(15, 1, 2, 3, 'dfgdfgdfg', 1, NULL, NULL),
(16, 1, 4, 2, 'hlihkljhli', 1, NULL, NULL),
(17, 1, 2, 3, 'fsdfsdfsdfs', 1, NULL, NULL),
(18, 1, 4, 2, 'sdfsdfsdfsd', 1, NULL, NULL),
(19, 1, 1, 2, 'dssfsdfdfdcsfvsdf', 1, NULL, NULL),
(20, 1, 4, 2, 'cdvsdcscsc', 1, NULL, NULL),
(21, 4, 1, 2, 'dfsddsfsfs', 1, NULL, NULL),
(22, 1, 1, 2, 'sefdfdffsfsf', 1, NULL, NULL),
(23, 1, 3, 1, 'next', 1, NULL, NULL),
(24, 3, 3, 1, 'dfgdfgdfgdfgdf', 1, NULL, NULL);

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
(16, '2014_10_12_000000_create_users_table', 1),
(17, '2014_10_12_100000_create_password_resets_table', 1),
(18, '2019_01_14_135136_create_profile_table', 1),
(19, '2019_02_27_102437_create_friendships_table', 1),
(20, '2019_03_03_202437_create_notifications_table', 1),
(21, '2019_03_07_212846_create_posts_table', 2),
(22, '2019_03_27_151202_create_conversations_table', 3),
(23, '2019_03_27_183430_create_messages_table', 4),
(24, '2019_04_03_135047_create_jobs_table', 5),
(25, '2019_04_05_020120_create_likes_table', 6),
(26, '2019_04_10_160523_create_comments_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_logged` int(11) NOT NULL,
  `user_hero` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_logged`, `user_hero`, `status`, `note`, `created_at`, `updated_at`) VALUES
(7, 2, 1, 0, 'Accepted your friend request', '2019-03-05 07:19:15', '2019-03-05 07:19:15'),
(8, 3, 1, 1, 'Accepted your friend request', '2019-03-05 07:19:44', '2019-03-05 07:19:44'),
(9, 4, 1, 1, 'Accepted your friend request', '2019-03-05 07:19:46', '2019-03-05 07:19:46'),
(10, 4, 2, 0, 'Accepted your friend request', '2019-03-05 07:21:29', '2019-03-05 07:21:29'),
(11, 2, 4, 1, 'Accepted your friend request', '2019-04-05 08:08:57', '2019-04-05 08:08:57'),
(12, 2, 3, 0, 'Accepted your friend request', '2019-04-15 10:56:00', '2019-04-15 10:56:00'),
(13, 4, 3, 0, 'Accepted your friend request', '2019-04-15 10:56:01', '2019-04-15 10:56:01'),
(14, 5, 3, 0, 'Accepted your friend request', '2019-04-15 10:56:02', '2019-04-15 10:56:02'),
(15, 5, 1, 0, 'Accepted your friend request', '2019-04-15 10:56:19', '2019-04-15 10:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('Made_mepro@yahoo.com', '$2y$10$k8ax780SgmbIRmd4qn0q8OFYxgiQuvwlsmwc4etx5dh1xeHQ3RHJe', '2019-04-03 09:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `post_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `content`, `post_image`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 'this post for test ', NULL, 0, '2019-03-06 22:00:00', NULL),
(4, 3, 'W3Schools is optimized for learning, testing, and training. Examples might be simplified to improve reading and basic understanding. Tutorials, references, and examples are constantly reviewed to avoid errors, but we cannot warrant full correctness of all content. While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.\r\n', NULL, 0, '2019-03-06 22:00:00', NULL),
(5, 4, 'W3Schools is optimized for learning, testing, and training. Examples might be simplified to improve reading and basic understanding. Tutorials, references, and examples are constantly reviewed to avoid errors, but we cannot warrant full correctness of all content. While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.\r\n', NULL, 0, '2019-03-06 22:00:00', NULL),
(33, 1, 'W3Schools is optimized for learning, testing, and training. Examples might be simplified to improve reading and basic understanding. Tutorials, references, and examples are constantly reviewed to avoid errors, but we cannot warrant full correctness of all content. While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.', NULL, 1, '2019-03-26 12:24:36', '2019-03-26 12:24:36'),
(34, 1, 'deit post', NULL, 1, '2019-04-05 08:07:17', '2019-04-05 08:07:17'),
(35, 1, 'Edit hello world', NULL, 1, '2019-04-05 08:07:21', '2019-04-05 08:07:21'),
(36, 1, 'this post for testing', NULL, 1, '2019-04-13 07:24:14', '2019-04-13 07:24:14'),
(37, 3, 'i love life', NULL, 1, '2019-04-13 08:46:16', '2019-04-13 08:46:16'),
(38, 1, 'done', 'GroupBook-image-post-2019-04-14-02-54-49-ZmMNFK5MH63ayKCL.png', 1, '2019-04-14 12:54:49', '2019-04-14 12:54:49'),
(40, 1, 'sdfsdfsdfsd', NULL, 1, '2019-04-14 13:05:38', '2019-04-14 13:05:38'),
(41, 1, 'fgdfgdfgdfg', NULL, 1, '2019-04-14 13:08:58', '2019-04-14 13:08:58'),
(47, 1, 'done', 'GroupBook-image-post-2019-04-14-08-52-11-aGsqEVkkFr9zr8ID.png', 1, '2019-04-14 18:52:11', '2019-04-14 18:52:11'),
(48, 1, 'done', 'GroupBook-image-post-2019-04-14-08-52-38-ukDhdREuPJocD5je.png', 1, '2019-04-14 18:52:38', '2019-04-14 18:52:38'),
(49, 1, 'done', 'GroupBook-image-post-2019-04-14-08-52-46-JBBNOrK9IMopDCQz.png', 1, '2019-04-14 18:52:46', '2019-04-14 18:52:46'),
(50, 1, 'done', 'GroupBook-image-post-2019-04-14-08-53-18-1FjNCYH4Bw6glaaj.png', 1, '2019-04-14 18:53:18', '2019-04-14 18:53:18'),
(51, 1, 'done', 'GroupBook-image-post-2019-04-14-08-53-56-m36TTXvmQWSr9e4m.png', 1, '2019-04-14 18:53:56', '2019-04-14 18:53:56'),
(52, 1, 'done', 'GroupBook-image-post-2019-04-14-08-54-43-JWNZZcfR4rGpjh2X.png', 1, '2019-04-14 18:54:43', '2019-04-14 18:54:43'),
(53, 1, 'done', 'GroupBook-image-post-2019-04-14-08-54-43-CpHBru1IMVysRRIr.png', 1, '2019-04-14 18:54:43', '2019-04-14 18:54:43'),
(54, 1, 'done', 'GroupBook-image-post-2019-04-14-08-54-44-XX6RsYgqUKtzSp3b.png', 1, '2019-04-14 18:54:44', '2019-04-14 18:54:44'),
(55, 1, 'done', 'GroupBook-image-post-2019-04-14-08-55-43-spshwZHtF5oTIEjj.png', 1, '2019-04-14 18:55:43', '2019-04-14 18:55:43'),
(56, 1, 'sadsadasdas', 'GroupBook-image-post-2019-04-14-08-55-50-EnoJG0MZ28a9nLkB.png', 1, '2019-04-14 18:55:50', '2019-04-14 18:55:50'),
(57, 1, 'done', 'GroupBook-image-post-2019-04-14-08-56-04-6JfUMbEZrpMmxmxO.png', 1, '2019-04-14 18:56:04', '2019-04-14 18:56:04'),
(58, 1, 'done', 'GroupBook-image-post-2019-04-14-08-56-56-uYGgTfx3aonYdTgz.png', 1, '2019-04-14 18:56:56', '2019-04-14 18:56:56'),
(59, 1, 'done', 'GroupBook-image-post-2019-04-14-08-57-17-OsLRo2XFzoT3q0ml.png', 1, '2019-04-14 18:57:17', '2019-04-14 18:57:17'),
(60, 1, 'done', 'GroupBook-image-post-2019-04-14-08-58-38-aWlER5R6eGYhfT6M.png', 1, '2019-04-14 18:58:38', '2019-04-14 18:58:38'),
(61, 1, 'done', 'GroupBook-image-post-2019-04-14-08-59-14-CMi1rFpeWjV8YBJN.png', 1, '2019-04-14 18:59:14', '2019-04-14 18:59:14'),
(62, 1, 'done', 'GroupBook-image-post-2019-04-14-08-59-41-jRVbID19lh6pZdMF.png', 1, '2019-04-14 18:59:41', '2019-04-14 18:59:41'),
(63, 1, 'done', 'GroupBook-image-post-2019-04-14-09-00-09-09uxLM2O1DXH7Pr6.png', 1, '2019-04-14 19:00:09', '2019-04-14 19:00:09'),
(64, 1, 'done', 'GroupBook-image-post-2019-04-14-09-00-29-akxsk8E8jBCNWh77.png', 1, '2019-04-14 19:00:29', '2019-04-14 19:00:29'),
(65, 1, 'done', 'GroupBook-image-post-2019-04-14-09-01-48-TAWnSuV3c0CTxuSC.png', 1, '2019-04-14 19:01:48', '2019-04-14 19:01:48'),
(66, 1, 'done', 'GroupBook-image-post-2019-04-14-09-03-27-h9yaTxiyjJ9qWoPa.png', 1, '2019-04-14 19:03:27', '2019-04-14 19:03:27'),
(67, 1, 'done', 'GroupBook-image-post-2019-04-14-09-05-01-8fj4cdSSYm1wDoCW.png', 1, '2019-04-14 19:05:01', '2019-04-14 19:05:01'),
(68, 1, 'done', 'GroupBook-image-post-2019-04-14-09-06-06-8hLR3s5zCaZTHoop.png', 1, '2019-04-14 19:06:06', '2019-04-14 19:06:06'),
(69, 1, 'gdfgdfgdfg', 'GroupBook-image-post-2019-04-14-09-10-32-aerheCbqsMyCfyIR.png', 1, '2019-04-14 19:10:32', '2019-04-14 19:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `city`, `country`, `about`, `created_at`, `updated_at`) VALUES
(1, 1, 'sohag', 'egypt', 'I am programmer', '2019-03-04 07:56:57', '2019-03-04 07:56:57'),
(2, 2, NULL, NULL, NULL, '2019-03-04 07:57:58', '2019-03-04 07:57:58'),
(3, 3, NULL, NULL, NULL, '2019-03-04 07:59:30', '2019-03-04 07:59:30'),
(4, 4, NULL, NULL, NULL, '2019-03-04 08:01:38', '2019-03-04 08:01:38'),
(5, 5, NULL, NULL, NULL, '2019-04-15 10:54:02', '2019-04-15 10:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `slug`, `pic`, `role`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'thomas edward', 'male', 'thomas-edward', 'GroubBook-2019-03-26-01-50-43-a8466a9b0a57176780b7e7abcab0362a232d27b6.jpg', 'admin', 'Made_mepro@yahoo.com', '$2y$10$Kn/jZvF.PUS/t9jwR/OsNeh3YY4sOj/80ZPq4xYckmaNk/6YsjCqm', 'aCGIzzcsyZVIJXxFzGgrNKdcRJTTC3fO7i1Jq33UvMCClGxgcZNQbS8MfNs0', '2019-03-04 07:56:57', '2019-04-03 09:49:42'),
(2, 'Morad samer', 'male', 'morad-samer', 'GroubBook-2019-04-13-10-26-30-e1d726fd0cdd1ac432a58a28019daee570335790.jpeg', NULL, 'morad_SAMER@yahoo.com', '$2y$10$CXqEI9sxFklatytTCaEJOO/ug.oRKeAx/OUbMqajyC/9CvS/k1yZm', 'h8yKKDjAqsUZpxw6P0XmTZBivoQmjS6Gdaw6ksO5lP04imdw1OTDjCLTLfqj', '2019-03-04 07:57:58', '2019-03-04 07:57:58'),
(3, 'merna atef', 'female', 'merna-atef', 'girl.jpg', 'company', 'merna@yahoo.com', '$2y$10$K5O4OI9Ezon6Xm.NkSY07em/srTeLtBIFLsL5uk8HCGUfDGwaUaFa', '82PQYNLeDhYWCwuYutGy9LBKXoKZTvcXTMz905drjEVA2nVBbW8fcH5aq7eQ', '2019-03-04 07:59:30', '2019-03-04 07:59:30'),
(4, 'yase edward', 'male', 'yase-edward', 'boy.jpg', NULL, 'yase.edward@yahoo.com', '$2y$10$D8Scn/3Gw4Q/NSSQgiYNCuazq9N/Rq4SPKJUoC5UpF2z8EQDxxqLy', 'EoDhKfkEiZWIbz6SaFwhsIdEhOJa8zTi2tIchauMBCMhIxFBh5yoJhboWZ5G', '2019-03-04 08:01:38', '2019-03-04 08:01:38'),
(5, 'new user', 'male', 'new-user', 'boy.jpg', NULL, 'newuser@yahoo.com', '$2y$10$Btz69r9R2q0kQIi3damaROrLAxgpfHQW2GqIsEVA.rHbOsGx1JOei', 'IiHXWz2yxAJicOvMflJbpmsun4tqOv9R4scRpahE4ccqon7IUd53HBYAoniT', '2019-04-15 10:54:02', '2019-04-15 10:54:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `con_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
