-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 05:31 AM
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
-- Database: `laravel11-spare-item`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `donator` text DEFAULT NULL,
  `donatee` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `description`, `image`, `donator`, `donatee`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '<p><strong>Lorem Ipsum is simply dummy text</strong> of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', '174012439967b830ef26371.jpg', '<ol><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li></ol>', '<ol><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li></ol>', '2025-02-21 07:53:19', '2025-02-21 07:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` enum('admin','client','customer') DEFAULT NULL,
  `activity_type` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `related_table` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `role`, `activity_type`, `status`, `message`, `related_table`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'Registration', 'Success', 'New admin registered successfully.', 'users', '127.0.0.1', '2025-02-21 06:15:46', '2025-02-21 06:15:46'),
(2, 1, 'admin', 'Login', 'Success', 'Admin login successful.', 'users', '127.0.0.1', '2025-02-21 06:16:23', '2025-02-21 06:16:23'),
(3, 2, 'client', 'Registration', 'Success', 'New client registered successfully.', 'users', '127.0.0.1', '2025-02-21 06:17:32', '2025-02-21 06:17:32'),
(4, 2, 'client', 'Registration', 'Failed', 'Validation failed: {\"email\":[\"The email has already been taken.\"]}', 'users', '127.0.0.1', '2025-02-21 06:17:39', '2025-02-21 06:17:39'),
(5, 2, 'client', 'Login', 'Failed', 'Account not activated. Client needs to verify email.', 'users', '127.0.0.1', '2025-02-21 06:21:19', '2025-02-21 06:21:19'),
(6, 2, 'client', 'Email verified', 'Success', 'Email verification successful.', 'users', '127.0.0.1', '2025-02-21 06:21:27', '2025-02-21 06:21:27'),
(7, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-21 06:21:44', '2025-02-21 06:21:44'),
(8, 1, 'admin', 'Login', 'Success', 'Admin login successful.', 'users', '127.0.0.1', '2025-02-21 06:22:13', '2025-02-21 06:22:13'),
(9, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-21 07:59:14', '2025-02-21 07:59:14'),
(10, 2, 'client', 'Profile access', 'Success', 'Profile accessed successfully for email: client1@gmail.com', 'users', '127.0.0.1', '2025-02-21 08:04:46', '2025-02-21 08:04:46'),
(11, 2, 'client', 'Profile access', 'Success', 'Profile accessed successfully for email: client1@gmail.com', 'users', '127.0.0.1', '2025-02-21 08:11:30', '2025-02-21 08:11:30'),
(12, 2, 'client', 'Document upload', 'Success', 'Customer documents uploaded successfully', 'users', '127.0.0.1', '2025-02-21 08:12:45', '2025-02-21 08:12:45'),
(13, 1, 'admin', 'Login', 'Failed', 'Invalid email or password.', 'users', '127.0.0.1', '2025-02-21 08:13:34', '2025-02-21 08:13:34'),
(14, 1, 'admin', 'Login', 'Success', 'Admin login successful.', 'users', '127.0.0.1', '2025-02-21 08:13:41', '2025-02-21 08:13:41'),
(15, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-21 12:52:40', '2025-02-21 12:52:40'),
(16, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-21 14:22:43', '2025-02-21 14:22:43'),
(17, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-21 14:31:02', '2025-02-21 14:31:02'),
(18, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-21 14:31:36', '2025-02-21 14:31:36'),
(19, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-22 04:42:00', '2025-02-22 04:42:00'),
(20, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-22 04:42:16', '2025-02-22 04:42:16'),
(21, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-22 04:42:45', '2025-02-22 04:42:45'),
(22, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-22 12:42:02', '2025-02-22 12:42:02'),
(23, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-22 12:42:12', '2025-02-22 12:42:12'),
(24, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-22 12:51:17', '2025-02-22 12:51:17'),
(25, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-23 04:03:43', '2025-02-23 04:03:43'),
(26, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-23 04:03:57', '2025-02-23 04:03:57'),
(35, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-24 03:56:51', '2025-02-24 03:56:51'),
(36, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-24 03:57:17', '2025-02-24 03:57:17'),
(37, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-24 04:15:52', '2025-02-24 04:15:52'),
(47, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-24 14:40:58', '2025-02-24 14:40:58'),
(48, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-02-24 14:40:59', '2025-02-24 14:40:59'),
(49, 2, 'client', 'Item creation', 'Failed', 'Product creation failed due to an error. Error: Undefined variable $food', 'products', '127.0.0.1', '2025-02-24 14:40:59', '2025-02-24 14:40:59'),
(54, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-24 14:57:38', '2025-02-24 14:57:38'),
(55, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-02-24 14:57:38', '2025-02-24 14:57:38'),
(56, 2, 'client', 'Item creation', 'Failed', 'Product creation failed due to an error. Error: Undefined variable $food (View: C:\\xampp\\htdocs\\PROJECT\\RAJ\\Spare-Food-Website\\Localhost_Complete_Project\\LARAVEL_11_SPARE_ITEMS\\spare-item\\resources\\views\\email\\notification\\product-upload.blade.php)', 'products', '127.0.0.1', '2025-02-24 14:57:44', '2025-02-24 14:57:44'),
(57, 2, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"end_collection_time\":[\"The end collection time field must be a date after start collection time.\"]}', 'products', '127.0.0.1', '2025-02-24 15:48:08', '2025-02-24 15:48:08'),
(58, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-24 15:49:02', '2025-02-24 15:49:02'),
(59, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-02-24 15:49:07', '2025-02-24 15:49:07'),
(60, 2, 'client', 'Item creation', 'Failed', 'Product creation failed due to an error. Error: Undefined variable $food (View: C:\\xampp\\htdocs\\PROJECT\\RAJ\\Spare-Food-Website\\Localhost_Complete_Project\\LARAVEL_11_SPARE_ITEMS\\spare-item\\resources\\views\\email\\notification\\product-upload.blade.php)', 'products', '127.0.0.1', '2025-02-24 15:49:13', '2025-02-24 15:49:13'),
(61, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-24 15:59:49', '2025-02-24 15:59:49'),
(62, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-02-24 15:59:49', '2025-02-24 15:59:49'),
(63, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-24 16:00:03', '2025-02-24 16:00:03'),
(64, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-24 16:10:05', '2025-02-24 16:10:05'),
(65, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-24 16:17:41', '2025-02-24 16:17:41'),
(66, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-25 04:38:26', '2025-02-25 04:38:26'),
(67, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-25 04:38:33', '2025-02-25 04:38:33'),
(68, 2, 'client', 'Retrieve item list', 'Failed', 'Error occurred while retrieving product details: Call to undefined relationship [category] on model [App\\Models\\Product].', 'products', '127.0.0.1', '2025-02-25 04:41:49', '2025-02-25 04:41:49'),
(69, 2, 'client', 'Retrieve item list', 'Failed', 'Error occurred while retrieving product details: Call to undefined relationship [category] on model [App\\Models\\Product].', 'products', '127.0.0.1', '2025-02-25 04:49:54', '2025-02-25 04:49:54'),
(70, 2, 'client', 'Retrieve item list', 'Failed', 'Error occurred while retrieving product details: Call to undefined relationship [category] on model [App\\Models\\Product].', 'products', '127.0.0.1', '2025-02-25 04:51:41', '2025-02-25 04:51:41'),
(71, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-25 04:52:03', '2025-02-25 04:52:03'),
(72, 2, 'client', 'Retrieve item list', 'Failed', 'Error occurred while retrieving product details: Call to undefined relationship [category] on model [App\\Models\\Product].', 'products', '127.0.0.1', '2025-02-25 04:52:39', '2025-02-25 04:52:39'),
(73, 2, 'client', 'Retrieve item list', 'Failed', 'Error occurred while retrieving product details: Call to undefined relationship [country] on model [App\\Models\\Product].', 'products', '127.0.0.1', '2025-02-25 04:54:28', '2025-02-25 04:54:28'),
(74, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 04:55:05', '2025-02-25 04:55:05'),
(75, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 04:58:16', '2025-02-25 04:58:16'),
(76, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 04:59:13', '2025-02-25 04:59:13'),
(77, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 06:21:05', '2025-02-25 06:21:05'),
(78, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 06:22:02', '2025-02-25 06:22:02'),
(79, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 06:22:22', '2025-02-25 06:22:22'),
(80, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 06:26:53', '2025-02-25 06:26:53'),
(81, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 06:38:56', '2025-02-25 06:38:56'),
(82, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 07:05:39', '2025-02-25 07:05:39'),
(83, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 07:09:52', '2025-02-25 07:09:52'),
(84, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 07:13:24', '2025-02-25 07:13:24'),
(85, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 07:14:08', '2025-02-25 07:14:08'),
(86, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 07:18:28', '2025-02-25 07:18:28'),
(87, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 07:45:01', '2025-02-25 07:45:01'),
(88, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 07:45:29', '2025-02-25 07:45:29'),
(89, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 08:27:32', '2025-02-25 08:27:32'),
(90, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 08:28:05', '2025-02-25 08:28:05'),
(91, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 08:33:16', '2025-02-25 08:33:16'),
(92, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 09:09:48', '2025-02-25 09:09:48'),
(93, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 09:11:35', '2025-02-25 09:11:35'),
(94, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-25 12:30:59', '2025-02-25 12:30:59'),
(95, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-25 12:31:02', '2025-02-25 12:31:02'),
(96, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-25 12:31:56', '2025-02-25 12:31:56'),
(97, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-25 12:34:37', '2025-02-25 12:34:37'),
(98, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 12:34:52', '2025-02-25 12:34:52'),
(99, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 13:10:04', '2025-02-25 13:10:04'),
(100, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 13:12:19', '2025-02-25 13:12:19'),
(101, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-25 13:12:44', '2025-02-25 13:12:44'),
(102, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-25 15:01:26', '2025-02-25 15:01:26'),
(103, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:01:31', '2025-02-25 15:01:31'),
(104, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:02:16', '2025-02-25 15:02:16'),
(105, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:02:39', '2025-02-25 15:02:39'),
(106, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-25 15:02:42', '2025-02-25 15:02:42'),
(107, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:05:00', '2025-02-25 15:05:00'),
(108, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:09:49', '2025-02-25 15:09:49'),
(109, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:09:55', '2025-02-25 15:09:55'),
(110, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:12:19', '2025-02-25 15:12:19'),
(111, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:14:16', '2025-02-25 15:14:16'),
(112, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-25 15:15:08', '2025-02-25 15:15:08'),
(113, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:15:11', '2025-02-25 15:15:11'),
(114, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:17:25', '2025-02-25 15:17:25'),
(115, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:20:52', '2025-02-25 15:20:52'),
(116, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:21:45', '2025-02-25 15:21:45'),
(117, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 15:26:13', '2025-02-25 15:26:13'),
(118, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:10:15', '2025-02-25 16:10:15'),
(119, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:10:40', '2025-02-25 16:10:40'),
(120, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:35:01', '2025-02-25 16:35:01'),
(121, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:36:00', '2025-02-25 16:36:00'),
(122, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:36:50', '2025-02-25 16:36:50'),
(123, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:37:16', '2025-02-25 16:37:16'),
(124, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:38:51', '2025-02-25 16:38:51'),
(125, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:44:32', '2025-02-25 16:44:32'),
(126, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:46:25', '2025-02-25 16:46:25'),
(127, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:47:45', '2025-02-25 16:47:45'),
(128, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:49:18', '2025-02-25 16:49:18'),
(129, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:49:33', '2025-02-25 16:49:33'),
(130, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:52:07', '2025-02-25 16:52:07'),
(131, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 16:53:12', '2025-02-25 16:53:12'),
(132, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 17:03:52', '2025-02-25 17:03:52'),
(133, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 17:06:20', '2025-02-25 17:06:20'),
(134, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 18:09:39', '2025-02-25 18:09:39'),
(135, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-25 18:10:13', '2025-02-25 18:10:13'),
(136, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-26 03:42:13', '2025-02-26 03:42:13'),
(137, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-26 03:43:13', '2025-02-26 03:43:13'),
(138, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-26 03:43:42', '2025-02-26 03:43:42'),
(139, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 03:43:47', '2025-02-26 03:43:47'),
(140, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 03:45:55', '2025-02-26 03:45:55'),
(141, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 03:49:49', '2025-02-26 03:49:49'),
(142, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 03:50:31', '2025-02-26 03:50:31'),
(143, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 04:19:25', '2025-02-26 04:19:25'),
(144, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 04:19:57', '2025-02-26 04:19:57'),
(145, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 04:29:20', '2025-02-26 04:29:20'),
(146, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 04:44:09', '2025-02-26 04:44:09'),
(147, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 04:45:16', '2025-02-26 04:45:16'),
(148, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 04:50:21', '2025-02-26 04:50:21'),
(149, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 05:29:13', '2025-02-26 05:29:13'),
(150, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 05:30:11', '2025-02-26 05:30:11'),
(151, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 05:40:38', '2025-02-26 05:40:38'),
(152, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 05:40:54', '2025-02-26 05:40:54'),
(153, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 05:42:23', '2025-02-26 05:42:23'),
(154, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 05:43:56', '2025-02-26 05:43:56'),
(155, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 05:45:51', '2025-02-26 05:45:51'),
(156, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 05:46:05', '2025-02-26 05:46:05'),
(157, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 05:57:08', '2025-02-26 05:57:08'),
(158, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-26 06:09:50', '2025-02-26 06:09:50'),
(159, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-26 06:20:55', '2025-02-26 06:20:55'),
(160, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 06:21:07', '2025-02-26 06:21:07'),
(161, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 06:21:41', '2025-02-26 06:21:41'),
(162, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 06:22:10', '2025-02-26 06:22:10'),
(163, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 06:23:35', '2025-02-26 06:23:35'),
(164, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-26 06:45:04', '2025-02-26 06:45:04'),
(165, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-27 03:55:25', '2025-02-27 03:55:25'),
(166, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-27 03:55:34', '2025-02-27 03:55:34'),
(167, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 03:55:39', '2025-02-27 03:55:39'),
(168, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 04:05:17', '2025-02-27 04:05:17'),
(169, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 04:06:04', '2025-02-27 04:06:04'),
(170, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 04:17:33', '2025-02-27 04:17:33'),
(171, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 04:17:48', '2025-02-27 04:17:48'),
(172, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 04:23:39', '2025-02-27 04:23:39'),
(173, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 04:23:56', '2025-02-27 04:23:56'),
(174, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 04:24:23', '2025-02-27 04:24:23'),
(175, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 04:24:33', '2025-02-27 04:24:33'),
(176, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 04:25:09', '2025-02-27 04:25:09'),
(177, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-27 04:34:16', '2025-02-27 04:34:16'),
(178, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-27 04:48:20', '2025-02-27 04:48:20'),
(179, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-02-27 04:48:23', '2025-02-27 04:48:23'),
(180, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-27 04:48:35', '2025-02-27 04:48:35'),
(181, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 04:48:57', '2025-02-27 04:48:57'),
(182, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 09:04:40', '2025-02-27 09:04:40'),
(183, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-27 09:05:40', '2025-02-27 09:05:40'),
(184, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-27 09:05:40', '2025-02-27 09:05:40'),
(185, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-27 09:05:44', '2025-02-27 09:05:44'),
(186, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 09:06:17', '2025-02-27 09:06:17'),
(187, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"end_collection_time\":[\"The end collection time field must match the format H:i:s.\"]}', 'products', '127.0.0.1', '2025-02-27 09:06:43', '2025-02-27 09:06:43'),
(188, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 09:07:47', '2025-02-27 09:07:47'),
(189, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-27 09:08:06', '2025-02-27 09:08:06'),
(190, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-27 09:08:06', '2025-02-27 09:08:06'),
(191, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-27 09:08:10', '2025-02-27 09:08:10'),
(192, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 09:09:03', '2025-02-27 09:09:03'),
(193, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"end_collection_time\":[\"The end collection time field must be a date after start collection time.\"]}', 'products', '127.0.0.1', '2025-02-27 09:11:15', '2025-02-27 09:11:15'),
(194, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-27 09:12:04', '2025-02-27 09:12:04'),
(195, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-27 09:12:04', '2025-02-27 09:12:04'),
(196, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-27 09:12:07', '2025-02-27 09:12:07'),
(197, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 09:12:35', '2025-02-27 09:12:35'),
(198, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 09:13:32', '2025-02-27 09:13:32'),
(199, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 09:14:54', '2025-02-27 09:14:54'),
(200, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 09:15:10', '2025-02-27 09:15:10'),
(201, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-27 09:16:12', '2025-02-27 09:16:12'),
(202, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-27 09:16:12', '2025-02-27 09:16:12'),
(203, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-27 09:16:16', '2025-02-27 09:16:16'),
(204, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 09:16:27', '2025-02-27 09:16:27'),
(205, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-27 15:33:48', '2025-02-27 15:33:48'),
(206, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-27 17:30:05', '2025-02-27 17:30:05'),
(207, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 17:30:10', '2025-02-27 17:30:10'),
(208, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 17:30:47', '2025-02-27 17:30:47'),
(209, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 17:32:03', '2025-02-27 17:32:03'),
(210, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 17:32:17', '2025-02-27 17:32:17'),
(211, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 17:35:35', '2025-02-27 17:35:35'),
(212, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"A variant with the same color and size already exists.\"]}', 'products', '127.0.0.1', '2025-02-27 17:36:04', '2025-02-27 17:36:04'),
(213, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"A variant with the same color and size already exists.\"]}', 'products', '127.0.0.1', '2025-02-27 17:36:48', '2025-02-27 17:36:48'),
(214, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"A variant with the same color and size already exists.\"]}', 'products', '127.0.0.1', '2025-02-27 17:38:15', '2025-02-27 17:38:15'),
(215, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-27 17:38:55', '2025-02-27 17:38:55'),
(216, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"A variant with the same color and size already exists.\"]}', 'products', '127.0.0.1', '2025-02-27 17:39:21', '2025-02-27 17:39:21'),
(217, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-28 03:34:42', '2025-02-28 03:34:42'),
(218, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 03:34:58', '2025-02-28 03:34:58'),
(219, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 03:35:04', '2025-02-28 03:35:04'),
(220, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"A variant with the same color and size already exists.\"]}', 'products', '127.0.0.1', '2025-02-28 03:36:55', '2025-02-28 03:36:55'),
(221, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 03:37:53', '2025-02-28 03:37:53'),
(222, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 03:38:18', '2025-02-28 03:38:18'),
(223, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 03:38:18', '2025-02-28 03:38:18'),
(224, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 03:38:25', '2025-02-28 03:38:25'),
(225, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 03:38:42', '2025-02-28 03:38:42'),
(226, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 03:39:27', '2025-02-28 03:39:27'),
(227, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 03:39:27', '2025-02-28 03:39:27'),
(228, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 03:39:32', '2025-02-28 03:39:32'),
(229, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 03:43:42', '2025-02-28 03:43:42'),
(230, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 03:44:17', '2025-02-28 03:44:17'),
(231, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 03:44:17', '2025-02-28 03:44:17'),
(232, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 03:44:23', '2025-02-28 03:44:23'),
(233, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 03:47:21', '2025-02-28 03:47:21'),
(234, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 03:48:22', '2025-02-28 03:48:22'),
(235, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 03:48:22', '2025-02-28 03:48:22'),
(236, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 03:48:27', '2025-02-28 03:48:27'),
(237, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 04:13:26', '2025-02-28 04:13:26'),
(238, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 04:13:43', '2025-02-28 04:13:43'),
(239, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 04:13:43', '2025-02-28 04:13:43'),
(240, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 04:13:48', '2025-02-28 04:13:48'),
(241, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 04:14:09', '2025-02-28 04:14:09'),
(242, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 04:14:28', '2025-02-28 04:14:28'),
(243, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 04:14:28', '2025-02-28 04:14:28'),
(244, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 04:14:33', '2025-02-28 04:14:33'),
(245, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 04:15:28', '2025-02-28 04:15:28'),
(246, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 04:15:41', '2025-02-28 04:15:41'),
(247, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 04:15:41', '2025-02-28 04:15:41'),
(248, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 04:15:46', '2025-02-28 04:15:46'),
(249, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 04:15:53', '2025-02-28 04:15:53'),
(250, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 04:17:57', '2025-02-28 04:17:57'),
(251, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-02-28 04:18:47', '2025-02-28 04:18:47'),
(252, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 04:36:20', '2025-02-28 04:36:20'),
(253, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-02-28 04:36:48', '2025-02-28 04:36:48'),
(254, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 05:29:31', '2025-02-28 05:29:31'),
(255, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants.2.color\":[\"Duplicate color and size combination.\"],\"variants.2.size\":[\"Duplicate color and size combination.\"]}', 'products', '127.0.0.1', '2025-02-28 05:29:59', '2025-02-28 05:29:59'),
(256, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 05:37:55', '2025-02-28 05:37:55'),
(257, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants.2.color\":[\"Duplicate color and size combination.\"],\"variants.2.size\":[\"Duplicate color and size combination.\"]}', 'products', '127.0.0.1', '2025-02-28 05:38:29', '2025-02-28 05:38:29'),
(258, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants.2.color\":[\"Duplicate color and size combination.\"],\"variants.2.size\":[\"Duplicate color and size combination.\"]}', 'products', '127.0.0.1', '2025-02-28 05:38:38', '2025-02-28 05:38:38'),
(259, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants.2.color\":[\"Duplicate color and size combination.\"],\"variants.2.size\":[\"Duplicate color and size combination.\"]}', 'products', '127.0.0.1', '2025-02-28 05:38:50', '2025-02-28 05:38:50'),
(260, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:00:07', '2025-02-28 06:00:07'),
(261, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:00:26', '2025-02-28 06:00:26'),
(262, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:01:02', '2025-02-28 06:01:02'),
(263, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants.2.color\":[\"Duplicate color and size combination.\"],\"variants.2.size\":[\"Duplicate color and size combination.\"]}', 'products', '127.0.0.1', '2025-02-28 06:01:18', '2025-02-28 06:01:18'),
(264, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:04:25', '2025-02-28 06:04:25'),
(265, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-02-28 06:04:42', '2025-02-28 06:04:42'),
(266, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:05:21', '2025-02-28 06:05:21'),
(267, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-02-28 06:05:39', '2025-02-28 06:05:39'),
(268, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-02-28 06:07:37', '2025-02-28 06:07:37'),
(269, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:07:50', '2025-02-28 06:07:50'),
(270, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:08:24', '2025-02-28 06:08:24'),
(271, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 06:10:31', '2025-02-28 06:10:31'),
(272, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 06:10:31', '2025-02-28 06:10:31'),
(273, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 06:10:37', '2025-02-28 06:10:37'),
(274, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:10:49', '2025-02-28 06:10:49'),
(275, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 06:11:24', '2025-02-28 06:11:24'),
(276, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 06:11:24', '2025-02-28 06:11:24'),
(277, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 06:11:31', '2025-02-28 06:11:31'),
(278, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:11:45', '2025-02-28 06:11:45'),
(279, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-02-28 06:31:57', '2025-02-28 06:31:57'),
(280, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:33:23', '2025-02-28 06:33:23'),
(281, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-02-28 06:35:00', '2025-02-28 06:35:00'),
(282, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:35:16', '2025-02-28 06:35:16'),
(283, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 06:36:13', '2025-02-28 06:36:13'),
(284, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:36:19', '2025-02-28 06:36:19'),
(285, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 06:37:15', '2025-02-28 06:37:15'),
(286, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 06:37:15', '2025-02-28 06:37:15'),
(287, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 06:37:18', '2025-02-28 06:37:18'),
(288, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:37:22', '2025-02-28 06:37:22'),
(289, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:37:49', '2025-02-28 06:37:49'),
(290, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 06:37:58', '2025-02-28 06:37:58'),
(291, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 06:38:18', '2025-02-28 06:38:18'),
(292, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 06:38:18', '2025-02-28 06:38:18'),
(293, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 06:38:20', '2025-02-28 06:38:20'),
(294, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 06:50:55', '2025-02-28 06:50:55'),
(295, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 06:51:23', '2025-02-28 06:51:23'),
(296, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 06:54:47', '2025-02-28 06:54:47'),
(297, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 06:55:03', '2025-02-28 06:55:03'),
(298, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 06:57:27', '2025-02-28 06:57:27'),
(299, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:05:05', '2025-02-28 07:05:05'),
(300, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:05:14', '2025-02-28 07:05:14'),
(301, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 07:05:29', '2025-02-28 07:05:29'),
(302, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 07:05:29', '2025-02-28 07:05:29'),
(303, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 07:05:32', '2025-02-28 07:05:32'),
(304, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:05:45', '2025-02-28 07:05:45'),
(305, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-02-28 07:06:24', '2025-02-28 07:06:24'),
(306, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:06:55', '2025-02-28 07:06:55'),
(307, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 07:07:21', '2025-02-28 07:07:21'),
(308, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 07:07:21', '2025-02-28 07:07:21'),
(309, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 07:07:24', '2025-02-28 07:07:24'),
(310, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:07:28', '2025-02-28 07:07:28'),
(311, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:07:36', '2025-02-28 07:07:36'),
(312, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 07:08:01', '2025-02-28 07:08:01'),
(313, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 07:08:01', '2025-02-28 07:08:01'),
(314, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 07:08:03', '2025-02-28 07:08:03'),
(315, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:08:08', '2025-02-28 07:08:08'),
(316, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:08:19', '2025-02-28 07:08:19'),
(317, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 07:08:51', '2025-02-28 07:08:51'),
(318, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 07:08:51', '2025-02-28 07:08:51'),
(319, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 07:08:56', '2025-02-28 07:08:56'),
(320, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:09:29', '2025-02-28 07:09:29'),
(321, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:09:55', '2025-02-28 07:09:55'),
(322, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 07:25:52', '2025-02-28 07:25:52'),
(323, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 07:25:52', '2025-02-28 07:25:52'),
(324, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 07:25:58', '2025-02-28 07:25:58'),
(325, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:27:05', '2025-02-28 07:27:05'),
(326, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 07:27:21', '2025-02-28 07:27:21'),
(327, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 07:27:21', '2025-02-28 07:27:21');
INSERT INTO `activity_logs` (`id`, `user_id`, `role`, `activity_type`, `status`, `message`, `related_table`, `ip_address`, `created_at`, `updated_at`) VALUES
(328, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 07:27:27', '2025-02-28 07:27:27'),
(329, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:27:39', '2025-02-28 07:27:39'),
(330, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:28:07', '2025-02-28 07:28:07'),
(331, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:28:26', '2025-02-28 07:28:26'),
(332, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 07:29:52', '2025-02-28 07:29:52'),
(333, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 07:29:52', '2025-02-28 07:29:52'),
(334, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 07:29:58', '2025-02-28 07:29:58'),
(335, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:30:12', '2025-02-28 07:30:12'),
(336, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:30:33', '2025-02-28 07:30:33'),
(337, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:43:55', '2025-02-28 07:43:55'),
(338, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:44:18', '2025-02-28 07:44:18'),
(339, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 07:45:11', '2025-02-28 07:45:11'),
(340, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 07:45:11', '2025-02-28 07:45:11'),
(341, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 07:45:13', '2025-02-28 07:45:13'),
(342, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:45:24', '2025-02-28 07:45:24'),
(343, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:53:10', '2025-02-28 07:53:10'),
(344, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 07:53:27', '2025-02-28 07:53:27'),
(345, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 07:53:27', '2025-02-28 07:53:27'),
(346, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 07:53:30', '2025-02-28 07:53:30'),
(347, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:53:36', '2025-02-28 07:53:36'),
(348, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 07:53:45', '2025-02-28 07:53:45'),
(349, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-02-28 13:05:17', '2025-02-28 13:05:17'),
(350, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 13:06:07', '2025-02-28 13:06:07'),
(351, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 13:06:10', '2025-02-28 13:06:10'),
(352, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 13:18:54', '2025-02-28 13:18:54'),
(353, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 13:19:28', '2025-02-28 13:19:28'),
(354, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 13:21:33', '2025-02-28 13:21:33'),
(355, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 13:22:02', '2025-02-28 13:22:02'),
(356, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 13:25:00', '2025-02-28 13:25:00'),
(357, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 14:57:55', '2025-02-28 14:57:55'),
(358, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 14:59:06', '2025-02-28 14:59:06'),
(359, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 14:59:15', '2025-02-28 14:59:15'),
(360, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:00:46', '2025-02-28 15:00:46'),
(361, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:06:06', '2025-02-28 15:06:06'),
(362, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:10:39', '2025-02-28 15:10:39'),
(363, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:11:10', '2025-02-28 15:11:10'),
(364, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:11:23', '2025-02-28 15:11:23'),
(365, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-02-28 15:12:39', '2025-02-28 15:12:39'),
(366, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-02-28 15:12:39', '2025-02-28 15:12:39'),
(367, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 15:12:41', '2025-02-28 15:12:41'),
(368, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:12:48', '2025-02-28 15:12:48'),
(369, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:13:03', '2025-02-28 15:13:03'),
(370, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:14:29', '2025-02-28 15:14:29'),
(371, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:15:15', '2025-02-28 15:15:15'),
(372, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:21:15', '2025-02-28 15:21:15'),
(373, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:21:28', '2025-02-28 15:21:28'),
(374, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:23:06', '2025-02-28 15:23:06'),
(375, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-02-28 15:23:20', '2025-02-28 15:23:20'),
(376, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-02-28 15:44:28', '2025-02-28 15:44:28'),
(377, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-01 04:34:48', '2025-03-01 04:34:48'),
(378, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-01 04:37:59', '2025-03-01 04:37:59'),
(379, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 04:38:05', '2025-03-01 04:38:05'),
(380, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 04:38:18', '2025-03-01 04:38:18'),
(381, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 06:03:39', '2025-03-01 06:03:39'),
(382, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 06:04:40', '2025-03-01 06:04:40'),
(383, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 06:05:26', '2025-03-01 06:05:26'),
(384, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 06:07:50', '2025-03-01 06:07:50'),
(385, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-01 06:08:14', '2025-03-01 06:08:14'),
(386, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 06:08:59', '2025-03-01 06:08:59'),
(387, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-01 06:09:58', '2025-03-01 06:09:58'),
(388, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-01 06:09:58', '2025-03-01 06:09:58'),
(389, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-01 06:10:01', '2025-03-01 06:10:01'),
(390, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 06:10:15', '2025-03-01 06:10:15'),
(391, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 06:10:37', '2025-03-01 06:10:37'),
(392, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 06:11:52', '2025-03-01 06:11:52'),
(393, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 09:10:36', '2025-03-01 09:10:36'),
(394, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 09:18:39', '2025-03-01 09:18:39'),
(395, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 09:21:16', '2025-03-01 09:21:16'),
(396, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-01 09:21:40', '2025-03-01 09:21:40'),
(397, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-01 09:21:40', '2025-03-01 09:21:40'),
(398, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-01 09:21:42', '2025-03-01 09:21:42'),
(399, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-01 09:22:38', '2025-03-01 09:22:38'),
(400, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-03 04:02:51', '2025-03-03 04:02:51'),
(401, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-03 04:03:01', '2025-03-03 04:03:01'),
(402, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 04:03:08', '2025-03-03 04:03:08'),
(403, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 04:07:17', '2025-03-03 04:07:17'),
(404, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 04:14:24', '2025-03-03 04:14:24'),
(405, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 04:21:06', '2025-03-03 04:21:06'),
(406, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 04:21:15', '2025-03-03 04:21:15'),
(407, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 04:21:30', '2025-03-03 04:21:30'),
(408, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 04:58:48', '2025-03-03 04:58:48'),
(409, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 04:59:04', '2025-03-03 04:59:04'),
(410, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 05:36:41', '2025-03-03 05:36:41'),
(411, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 05:37:56', '2025-03-03 05:37:56'),
(412, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 05:49:54', '2025-03-03 05:49:54'),
(413, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 05:51:50', '2025-03-03 05:51:50'),
(414, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-03 12:01:11', '2025-03-03 12:01:11'),
(415, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-03 12:02:23', '2025-03-03 12:02:23'),
(416, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 12:02:31', '2025-03-03 12:02:31'),
(417, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 12:22:08', '2025-03-03 12:22:08'),
(418, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-03 12:23:20', '2025-03-03 12:23:20'),
(419, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-03 12:23:20', '2025-03-03 12:23:20'),
(420, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-03 12:23:22', '2025-03-03 12:23:22'),
(421, 2, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"qty\":[\"The qty field must be an integer.\"]}', 'products', '127.0.0.1', '2025-03-03 13:33:47', '2025-03-03 13:33:47'),
(422, 2, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"qty\":[\"The qty field must be an integer.\"]}', 'products', '127.0.0.1', '2025-03-03 13:44:48', '2025-03-03 13:44:48'),
(423, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-03 14:03:41', '2025-03-03 14:03:41'),
(424, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-03 14:03:44', '2025-03-03 14:03:44'),
(425, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-03 14:03:59', '2025-03-03 14:03:59'),
(426, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 14:18:07', '2025-03-03 14:18:07'),
(427, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 14:18:15', '2025-03-03 14:18:15'),
(428, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 14:41:42', '2025-03-03 14:41:42'),
(429, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 14:41:58', '2025-03-03 14:41:58'),
(430, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 14:48:05', '2025-03-03 14:48:05'),
(431, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 14:53:05', '2025-03-03 14:53:05'),
(432, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 14:54:37', '2025-03-03 14:54:37'),
(433, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 14:55:38', '2025-03-03 14:55:38'),
(434, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 14:56:05', '2025-03-03 14:56:05'),
(435, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 15:01:22', '2025-03-03 15:01:22'),
(436, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 15:03:55', '2025-03-03 15:03:55'),
(437, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-03 15:04:29', '2025-03-03 15:04:29'),
(438, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-03 15:04:29', '2025-03-03 15:04:29'),
(439, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-03 15:04:30', '2025-03-03 15:04:30'),
(440, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 15:05:02', '2025-03-03 15:05:02'),
(441, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-03 15:05:10', '2025-03-03 15:05:10'),
(442, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-03 15:05:10', '2025-03-03 15:05:10'),
(443, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-03 15:05:12', '2025-03-03 15:05:12'),
(444, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 15:07:27', '2025-03-03 15:07:27'),
(445, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-03 15:07:37', '2025-03-03 15:07:37'),
(446, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-03 15:07:37', '2025-03-03 15:07:37'),
(447, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-03 15:07:39', '2025-03-03 15:07:39'),
(448, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-03 15:24:22', '2025-03-03 15:24:22'),
(449, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-03 15:24:26', '2025-03-03 15:24:26'),
(450, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-03 15:24:47', '2025-03-03 15:24:47'),
(451, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-03 15:24:47', '2025-03-03 15:24:47'),
(452, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-03 15:24:49', '2025-03-03 15:24:49'),
(453, 3, 'client', 'Registration', 'Success', 'New client registered successfully.', 'users', '127.0.0.1', '2025-03-04 05:28:14', '2025-03-04 05:28:14'),
(454, 4, 'customer', 'Registration', 'Success', 'New customer registered successfully.', 'users', '127.0.0.1', '2025-03-04 05:33:30', '2025-03-04 05:33:30'),
(455, 4, 'customer', 'Login', 'Failed', 'Login failed. Customer not found.', 'users', '127.0.0.1', '2025-03-04 05:34:19', '2025-03-04 05:34:19'),
(456, 4, 'customer', 'Login', 'Failed', 'Customer login failed due to a system error: Undefined variable $user', 'users', '127.0.0.1', '2025-03-04 05:37:03', '2025-03-04 05:37:03'),
(457, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-04 05:39:42', '2025-03-04 05:39:42'),
(458, 4, 'customer', 'Follow/Unfollow', 'Success', 'Following started successfully.', 'followers', '127.0.0.1', '2025-03-04 05:39:50', '2025-03-04 05:39:50'),
(459, 4, 'customer', 'Follow/Unfollow', 'Success', 'Follow/Unfollow updated successfully. Status: Unfollowed', 'followers', '127.0.0.1', '2025-03-04 05:40:03', '2025-03-04 05:40:03'),
(460, 4, 'customer', 'Document upload', 'Success', 'Customer documents uploaded successfully', 'users', '127.0.0.1', '2025-03-04 05:57:06', '2025-03-04 05:57:06'),
(461, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-08 05:31:48', '2025-03-08 05:31:48'),
(462, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 05:31:58', '2025-03-08 05:31:58'),
(463, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-08 05:32:04', '2025-03-08 05:32:04'),
(464, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-08 05:32:08', '2025-03-08 05:32:08'),
(465, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 05:33:42', '2025-03-08 05:33:42'),
(466, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-08 05:33:45', '2025-03-08 05:33:45'),
(467, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-08 05:34:37', '2025-03-08 05:34:37'),
(468, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-08 05:44:07', '2025-03-08 05:44:07'),
(469, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-08 05:44:09', '2025-03-08 05:44:09'),
(470, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 05:44:19', '2025-03-08 05:44:19'),
(471, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 05:44:48', '2025-03-08 05:44:48'),
(472, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-08 05:44:53', '2025-03-08 05:44:53'),
(473, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-08 05:47:18', '2025-03-08 05:47:18'),
(474, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 05:47:24', '2025-03-08 05:47:24'),
(475, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-08 05:47:27', '2025-03-08 05:47:27'),
(476, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-08 05:47:51', '2025-03-08 05:47:51'),
(477, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-08 05:47:51', '2025-03-08 05:47:51'),
(478, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 05:47:53', '2025-03-08 05:47:53'),
(479, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-08 16:10:13', '2025-03-08 16:10:13'),
(480, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 16:10:19', '2025-03-08 16:10:19'),
(482, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-08 16:15:38', '2025-03-08 16:15:38'),
(483, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-08 16:15:38', '2025-03-08 16:15:38'),
(484, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 16:15:48', '2025-03-08 16:15:48'),
(485, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-08 16:20:31', '2025-03-08 16:20:31'),
(486, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-08 16:20:32', '2025-03-08 16:20:32'),
(487, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 16:20:47', '2025-03-08 16:20:47'),
(488, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 16:28:19', '2025-03-08 16:28:19'),
(489, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-08 16:29:45', '2025-03-08 16:29:45'),
(490, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-08 16:29:46', '2025-03-08 16:29:46'),
(491, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-08 16:29:53', '2025-03-08 16:29:53'),
(492, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-08 17:00:14', '2025-03-08 17:00:14'),
(493, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-08 17:01:57', '2025-03-08 17:01:57'),
(494, 2, 'client', 'Login', 'Failed', 'Login failed. Customer not found.', 'users', '127.0.0.1', '2025-03-09 04:34:12', '2025-03-09 04:34:12'),
(495, 2, 'client', 'Login', 'Failed', 'Login failed. Customer not found.', 'users', '127.0.0.1', '2025-03-09 04:34:17', '2025-03-09 04:34:17'),
(496, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-09 04:34:27', '2025-03-09 04:34:27'),
(497, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-09 04:34:38', '2025-03-09 04:34:38'),
(498, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-09 04:37:40', '2025-03-09 04:37:40'),
(499, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-09 04:37:44', '2025-03-09 04:37:44'),
(500, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-09 04:37:57', '2025-03-09 04:37:57'),
(501, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-09 04:38:43', '2025-03-09 04:38:43'),
(502, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-09 04:38:58', '2025-03-09 04:38:58'),
(503, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-09 04:47:11', '2025-03-09 04:47:11'),
(504, 2, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-03-09 04:49:33', '2025-03-09 04:49:33'),
(505, 2, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-03-09 04:52:15', '2025-03-09 04:52:15'),
(506, 2, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"variants\":[\"Duplicate variant: A variant with the same color and size already exists in the request.\"]}', 'products', '127.0.0.1', '2025-03-09 04:54:59', '2025-03-09 04:54:59'),
(507, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-09 04:55:48', '2025-03-09 04:55:48'),
(508, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-09 04:55:49', '2025-03-09 04:55:49'),
(509, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-09 04:56:02', '2025-03-09 04:56:02'),
(510, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-09 05:02:44', '2025-03-09 05:02:44'),
(511, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-10 04:06:23', '2025-03-10 04:06:23'),
(512, 2, 'client', 'Retrieve order list', 'Failed', 'System error: Call to undefined method App\\Models\\Order::food()', 'orders', '127.0.0.1', '2025-03-10 04:06:39', '2025-03-10 04:06:39'),
(513, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 04:06:45', '2025-03-10 04:06:45'),
(514, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 04:06:54', '2025-03-10 04:06:54'),
(515, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-10 04:07:17', '2025-03-10 04:07:17'),
(516, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-10 04:07:17', '2025-03-10 04:07:17'),
(517, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 04:07:19', '2025-03-10 04:07:19'),
(518, 2, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"qty\":[\"The qty field is required.\"]}', 'products', '127.0.0.1', '2025-03-10 04:12:02', '2025-03-10 04:12:02'),
(519, 2, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"qty\":[\"The qty field is required.\"]}', 'products', '127.0.0.1', '2025-03-10 04:46:20', '2025-03-10 04:46:20'),
(521, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-10 15:42:38', '2025-03-10 15:42:38'),
(522, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 15:43:47', '2025-03-10 15:43:47'),
(523, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 15:43:52', '2025-03-10 15:43:52'),
(524, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 15:44:37', '2025-03-10 15:44:37'),
(525, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 15:44:40', '2025-03-10 15:44:40'),
(528, 2, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"name\":[\"The name has already been taken.\"]}', 'products', '127.0.0.1', '2025-03-10 16:13:16', '2025-03-10 16:13:16'),
(530, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-10 16:15:46', '2025-03-10 16:15:46'),
(531, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-10 16:15:47', '2025-03-10 16:15:47'),
(532, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 16:16:02', '2025-03-10 16:16:02'),
(533, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 16:19:23', '2025-03-10 16:19:23'),
(534, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 16:23:43', '2025-03-10 16:23:43'),
(535, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"current_stock\":[\"The current stock field is required.\"]}', 'products', '127.0.0.1', '2025-03-10 16:24:22', '2025-03-10 16:24:22'),
(536, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"current_stock\":[\"The current stock field is required.\"]}', 'products', '127.0.0.1', '2025-03-10 16:24:41', '2025-03-10 16:24:41'),
(537, 2, 'client', 'Item update', 'Failed', 'Validation failed: {\"current_stock\":[\"The current stock field is required.\"]}', 'products', '127.0.0.1', '2025-03-10 16:25:48', '2025-03-10 16:25:48'),
(538, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 16:27:16', '2025-03-10 16:27:16'),
(539, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-10 16:27:29', '2025-03-10 16:27:29'),
(540, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-10 16:27:29', '2025-03-10 16:27:29'),
(541, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 16:27:34', '2025-03-10 16:27:34'),
(542, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 16:59:36', '2025-03-10 16:59:36'),
(543, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-10 16:59:59', '2025-03-10 16:59:59'),
(544, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-10 16:59:59', '2025-03-10 16:59:59'),
(545, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 17:00:04', '2025-03-10 17:00:04'),
(546, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 17:01:10', '2025-03-10 17:01:10'),
(547, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-10 17:02:02', '2025-03-10 17:02:02'),
(548, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-10 17:02:02', '2025-03-10 17:02:02'),
(549, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 17:02:04', '2025-03-10 17:02:04'),
(550, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 17:02:30', '2025-03-10 17:02:30'),
(551, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-10 17:09:45', '2025-03-10 17:09:45'),
(552, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-10 17:09:45', '2025-03-10 17:09:45'),
(553, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 17:09:47', '2025-03-10 17:09:47'),
(554, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 17:10:16', '2025-03-10 17:10:16'),
(555, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-10 17:10:27', '2025-03-10 17:10:27'),
(556, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-10 17:10:27', '2025-03-10 17:10:27'),
(557, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 17:10:28', '2025-03-10 17:10:28'),
(558, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-10 17:12:17', '2025-03-10 17:12:17'),
(559, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-10 17:12:54', '2025-03-10 17:12:54'),
(560, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-10 17:12:54', '2025-03-10 17:12:54'),
(561, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-10 17:12:56', '2025-03-10 17:12:56'),
(562, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-11 04:17:32', '2025-03-11 04:17:32'),
(563, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-11 04:17:34', '2025-03-11 04:17:34'),
(564, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-11 04:17:35', '2025-03-11 04:17:35'),
(565, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-11 04:17:44', '2025-03-11 04:17:44'),
(566, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-11 04:18:00', '2025-03-11 04:18:00'),
(567, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-11 04:20:08', '2025-03-11 04:20:08'),
(568, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-11 04:20:12', '2025-03-11 04:20:12'),
(569, 2, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"name\":[\"The name has already been taken.\"]}', 'products', '127.0.0.1', '2025-03-11 04:20:23', '2025-03-11 04:20:23'),
(570, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-11 04:20:26', '2025-03-11 04:20:26'),
(571, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-11 04:22:42', '2025-03-11 04:22:42'),
(572, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-11 04:23:21', '2025-03-11 04:23:21'),
(573, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-11 04:23:21', '2025-03-11 04:23:21'),
(574, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-11 04:23:24', '2025-03-11 04:23:24'),
(575, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-11 04:28:09', '2025-03-11 04:28:09'),
(576, 2, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-11 04:28:09', '2025-03-11 04:28:09'),
(577, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-11 04:28:17', '2025-03-11 04:28:17'),
(578, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-11 04:30:28', '2025-03-11 04:30:28'),
(579, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-11 07:23:43', '2025-03-11 07:23:43'),
(580, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-11 08:56:43', '2025-03-11 08:56:43'),
(581, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-11 08:56:49', '2025-03-11 08:56:49'),
(582, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-11 08:58:27', '2025-03-11 08:58:27'),
(583, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-11 09:01:29', '2025-03-11 09:01:29'),
(584, 2, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-11 09:01:47', '2025-03-11 09:01:47'),
(585, 2, 'client', 'Item update', 'Success', 'Item updated successfully.', 'products', '127.0.0.1', '2025-03-11 09:01:47', '2025-03-11 09:01:47'),
(586, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-11 09:01:50', '2025-03-11 09:01:50'),
(587, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-11 14:38:01', '2025-03-11 14:38:01'),
(588, 4, 'customer', 'Retrieve wishlist', 'Success', 'Wishlist items retrieved successfully.', 'wishlists', '127.0.0.1', '2025-03-11 14:40:32', '2025-03-11 14:40:32'),
(589, 4, 'customer', 'Retrieve wishlist', 'Success', 'Wishlist items retrieved successfully.', 'wishlists', '127.0.0.1', '2025-03-11 14:52:31', '2025-03-11 14:52:31'),
(590, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-12 13:09:28', '2025-03-12 13:09:28'),
(591, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-12 13:09:31', '2025-03-12 13:09:31'),
(592, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-12 13:44:11', '2025-03-12 13:44:11'),
(593, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-12 13:44:57', '2025-03-12 13:44:57'),
(594, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-12 13:44:58', '2025-03-12 13:44:58'),
(595, 4, 'customer', 'Retrieve wishlist', 'Success', 'Wishlist items retrieved successfully.', 'wishlists', '127.0.0.1', '2025-03-12 13:46:54', '2025-03-12 13:46:54'),
(596, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-12 14:55:11', '2025-03-12 14:55:11'),
(597, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-12 14:56:17', '2025-03-12 14:56:17'),
(598, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-12 16:13:42', '2025-03-12 16:13:42'),
(599, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-12 17:11:29', '2025-03-12 17:11:29'),
(600, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-12 17:12:39', '2025-03-12 17:12:39'),
(601, 3, 'client', 'Login', 'Failed', 'Account not activated. Client needs to verify email.', 'users', '127.0.0.1', '2025-03-13 03:48:59', '2025-03-13 03:48:59'),
(602, 3, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-13 03:49:24', '2025-03-13 03:49:24'),
(603, 3, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-13 03:49:39', '2025-03-13 03:49:39'),
(604, 3, 'client', 'Profile access', 'Success', 'Profile accessed successfully for email: client2@gmail.com', 'users', '127.0.0.1', '2025-03-13 03:49:53', '2025-03-13 03:49:53'),
(605, 3, 'client', 'Document upload', 'Success', 'Customer documents uploaded successfully', 'users', '127.0.0.1', '2025-03-13 03:50:55', '2025-03-13 03:50:55'),
(606, 3, 'client', 'Document upload', 'Success', 'Customer documents uploaded successfully', 'users', '127.0.0.1', '2025-03-13 03:51:04', '2025-03-13 03:51:04'),
(607, 3, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-13 03:51:07', '2025-03-13 03:51:07'),
(608, 1, 'admin', 'Login', 'Success', 'Admin login successful.', 'users', '127.0.0.1', '2025-03-13 03:52:38', '2025-03-13 03:52:38'),
(609, 1, 'admin', 'Login', 'Success', 'Admin login successful.', 'users', '127.0.0.1', '2025-03-13 04:07:35', '2025-03-13 04:07:35'),
(610, 1, 'admin', 'Retrieve item list', 'Success', 'Successfully retrieved products.', 'products', '127.0.0.1', '2025-03-13 04:16:43', '2025-03-13 04:16:43'),
(611, 1, 'admin', 'Retrieve item list', 'Success', 'Successfully retrieved products.', 'products', '127.0.0.1', '2025-03-13 04:18:15', '2025-03-13 04:18:15'),
(612, 1, 'admin', 'Retrieve item list', 'Success', 'Successfully retrieved products.', 'products', '127.0.0.1', '2025-03-13 04:23:32', '2025-03-13 04:23:32'),
(613, 1, 'admin', 'Retrieve item list', 'Success', 'Product info found successfully.', 'products', '127.0.0.1', '2025-03-13 04:24:10', '2025-03-13 04:24:10'),
(614, 1, 'admin', 'Retrieve item list', 'Success', 'Product info found successfully.', 'products', '127.0.0.1', '2025-03-13 04:51:36', '2025-03-13 04:51:36'),
(615, 1, 'admin', 'Retrieve order list', 'Success', 'Orders retrieved successfully.', 'orders', '127.0.0.1', '2025-03-13 04:52:35', '2025-03-13 04:52:35'),
(616, 1, 'admin', 'Retrieve item list', 'Success', 'Successfully retrieved products.', 'products', '127.0.0.1', '2025-03-13 04:52:44', '2025-03-13 04:52:44'),
(617, 1, 'admin', 'Retrieve item list', 'Success', 'Product info found successfully.', 'products', '127.0.0.1', '2025-03-13 04:52:51', '2025-03-13 04:52:51'),
(618, 3, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-13 05:21:16', '2025-03-13 05:21:16'),
(619, 3, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-13 05:21:20', '2025-03-13 05:21:20'),
(620, 3, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-13 05:21:33', '2025-03-13 05:21:33'),
(621, 3, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-13 05:24:13', '2025-03-13 05:24:13'),
(622, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-13 05:24:26', '2025-03-13 05:24:26'),
(623, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-13 05:24:34', '2025-03-13 05:24:34'),
(624, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-13 08:28:03', '2025-03-13 08:28:03'),
(625, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-13 14:14:47', '2025-03-13 14:14:47'),
(626, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-13 15:36:56', '2025-03-13 15:36:56'),
(627, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-13 15:36:57', '2025-03-13 15:36:57'),
(628, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-13 16:27:55', '2025-03-13 16:27:55'),
(629, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-14 04:46:02', '2025-03-14 04:46:02'),
(630, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-14 06:55:53', '2025-03-14 06:55:53'),
(631, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-14 09:30:43', '2025-03-14 09:30:43'),
(632, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-14 14:11:55', '2025-03-14 14:11:55'),
(633, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-14 15:16:54', '2025-03-14 15:16:54'),
(634, 4, 'customer', 'Retrieve wishlist', 'Success', 'Wishlist items retrieved successfully.', 'wishlists', '127.0.0.1', '2025-03-14 15:17:07', '2025-03-14 15:17:07'),
(635, 4, 'customer', 'Retrieve wishlist', 'Success', 'Wishlist items retrieved successfully.', 'wishlists', '127.0.0.1', '2025-03-14 15:17:13', '2025-03-14 15:17:13'),
(636, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-14 16:37:43', '2025-03-14 16:37:43'),
(637, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-15 03:37:36', '2025-03-15 03:37:36'),
(638, 4, 'customer', 'Wishlist creation', 'Success', 'Item added to wishlist successfully.', 'wishlists', '127.0.0.1', '2025-03-15 03:37:53', '2025-03-15 03:37:53'),
(639, 4, 'customer', 'Wishlist creation', 'Success', 'Item added to wishlist successfully.', 'wishlists', '127.0.0.1', '2025-03-15 04:16:56', '2025-03-15 04:16:56'),
(640, 4, 'customer', 'Wishlist creation', 'Failed', 'This item is already in your wishlist.', 'wishlists', '127.0.0.1', '2025-03-15 04:17:29', '2025-03-15 04:17:29'),
(641, 4, 'customer', 'Wishlist creation', 'Success', 'Item added to wishlist successfully.', 'wishlists', '127.0.0.1', '2025-03-15 04:19:49', '2025-03-15 04:19:49'),
(642, 4, 'customer', 'Retrieve wishlist', 'Success', 'Wishlist items retrieved successfully.', 'wishlists', '127.0.0.1', '2025-03-15 04:19:58', '2025-03-15 04:19:58'),
(643, 4, 'customer', 'Wishlist creation', 'Failed', 'This item is already in your wishlist.', 'wishlists', '127.0.0.1', '2025-03-15 04:28:20', '2025-03-15 04:28:20'),
(644, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-15 05:22:14', '2025-03-15 05:22:14'),
(645, 4, 'customer', 'Wishlist creation', 'Failed', 'This item is already in your wishlist.', 'wishlists', '127.0.0.1', '2025-03-15 05:22:31', '2025-03-15 05:22:31'),
(646, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-15 06:46:12', '2025-03-15 06:46:12'),
(647, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-15 06:46:28', '2025-03-15 06:46:28'),
(648, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-15 06:47:00', '2025-03-15 06:47:00'),
(649, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-15 08:14:56', '2025-03-15 08:14:56'),
(650, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-15 08:15:49', '2025-03-15 08:15:49'),
(651, 2, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-15 14:00:59', '2025-03-15 14:00:59'),
(652, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-15 16:08:06', '2025-03-15 16:08:06');
INSERT INTO `activity_logs` (`id`, `user_id`, `role`, `activity_type`, `status`, `message`, `related_table`, `ip_address`, `created_at`, `updated_at`) VALUES
(653, 2, 'client', 'Retrieve item list', 'Success', 'Item info found successfully.', 'products', '127.0.0.1', '2025-03-15 16:08:29', '2025-03-15 16:08:29'),
(654, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-15 16:08:37', '2025-03-15 16:08:37'),
(655, 2, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-15 17:06:35', '2025-03-15 17:06:35'),
(656, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-15 17:06:58', '2025-03-15 17:06:58'),
(657, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-16 04:31:36', '2025-03-16 04:31:36'),
(658, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-16 05:44:38', '2025-03-16 05:44:38'),
(659, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-16 08:25:58', '2025-03-16 08:25:58'),
(660, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-16 13:31:15', '2025-03-16 13:31:15'),
(661, 4, 'customer', 'Wishlist creation', 'Success', 'Item added to wishlist successfully.', 'wishlists', '127.0.0.1', '2025-03-16 13:33:44', '2025-03-16 13:33:44'),
(662, 4, 'customer', 'Wishlist creation', 'Failed', 'This item is already in your wishlist.', 'wishlists', '127.0.0.1', '2025-03-16 13:47:38', '2025-03-16 13:47:38'),
(663, 3, 'client', 'Login', 'Success', 'Client logged in successfully.', 'users', '127.0.0.1', '2025-03-16 14:35:18', '2025-03-16 14:35:18'),
(664, 3, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-16 14:35:32', '2025-03-16 14:35:32'),
(665, 3, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-16 14:52:41', '2025-03-16 14:52:41'),
(666, 3, 'client', 'Retrieve item list', 'Success', 'Coordinates fetched successfully.', 'products', '127.0.0.1', '2025-03-16 14:55:39', '2025-03-16 14:55:39'),
(667, 3, 'client', 'Item creation', 'Success', 'Product created successfully.', 'products', '127.0.0.1', '2025-03-16 14:55:44', '2025-03-16 14:55:44'),
(668, 3, 'client', 'Item creation', 'Failed', 'Validation failed during product creation. Errors: {\"name\":[\"The name has already been taken.\"]}', 'products', '127.0.0.1', '2025-03-16 14:56:15', '2025-03-16 14:56:15'),
(669, 3, 'client', 'Retrieve item list', 'Success', 'Successfully retrieved items.', 'products', '127.0.0.1', '2025-03-16 14:56:21', '2025-03-16 14:56:21'),
(670, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-16 15:03:31', '2025-03-16 15:03:31'),
(671, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-16 16:06:40', '2025-03-16 16:06:40'),
(672, 4, 'customer', 'Login', 'Success', 'Customer login successful.', 'users', '127.0.0.1', '2025-03-16 17:07:10', '2025-03-16 17:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `banned_customers`
--

CREATE TABLE `banned_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Arong', '174037053967bbf26ba953d.png', 1, '2025-02-24 04:15:43', '2025-02-24 04:15:43');

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `product_id`, `product_variant_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 1, 500.00, '2025-03-16 13:46:32', '2025-03-16 17:24:24'),
(2, 4, 4, 5, 2, 7000.00, '2025-03-16 15:04:14', '2025-03-16 17:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `max_request_by_customer` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `max_request_by_customer`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Food', 3, '174012365767b82e09abd4e.jpg', '2025-02-21 07:40:59', '2025-02-21 07:40:59'),
(2, 'Clothing', 3, '174012368267b82e220c4cd.jpg', '2025-02-21 07:41:22', '2025-02-21 07:41:22'),
(3, 'Electronics', 3, '174012370267b82e36bac4b.jpg', '2025-02-21 07:41:42', '2025-02-21 07:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `county_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `county_id`, `created_at`, `updated_at`) VALUES
(1, 'Bedford', 1, '2024-11-05 15:18:37', '2024-11-05 15:18:37'),
(2, 'Luton', 1, '2024-11-05 15:18:37', '2024-11-05 15:18:37'),
(3, 'Dunstable', 1, '2024-11-05 15:18:37', '2024-11-05 15:18:37'),
(4, 'Leighton Buzzard', 1, '2024-11-05 15:18:37', '2024-11-05 15:18:37'),
(5, 'Flitwick', 1, '2024-11-05 15:18:37', '2024-11-05 15:18:37'),
(6, 'Ampthill', 1, '2024-11-05 15:18:37', '2024-11-05 15:18:37'),
(7, 'Biggleswade', 1, '2024-11-05 15:18:37', '2024-11-05 15:18:37'),
(8, 'Houghton Regis', 1, '2024-11-05 15:18:37', '2024-11-05 15:18:37'),
(9, 'Kempston', 1, '2024-11-05 15:18:37', '2024-11-05 15:18:37'),
(10, 'Harlington', 1, '2024-11-05 15:18:37', '2024-11-05 15:18:37'),
(11, 'Reading', 2, '2024-11-05 15:19:24', '2024-11-05 15:19:24'),
(12, 'Bracknell', 2, '2024-11-05 15:19:24', '2024-11-05 15:19:24'),
(13, 'Slough', 2, '2024-11-05 15:19:24', '2024-11-05 15:19:24'),
(14, 'Wokingham', 2, '2024-11-05 15:19:24', '2024-11-05 15:19:24'),
(15, 'Newbury', 2, '2024-11-05 15:19:24', '2024-11-05 15:19:24'),
(16, 'Thatcham', 2, '2024-11-05 15:19:24', '2024-11-05 15:19:24'),
(17, 'Basingstoke', 2, '2024-11-05 15:19:24', '2024-11-05 15:19:24'),
(18, 'Maidenhead', 2, '2024-11-05 15:19:24', '2024-11-05 15:19:24'),
(19, 'Woodley', 2, '2024-11-05 15:19:24', '2024-11-05 15:19:24'),
(20, 'Crowthorne', 2, '2024-11-05 15:19:24', '2024-11-05 15:19:24'),
(21, 'Bristol', 3, '2024-11-05 15:20:08', '2024-11-05 15:20:08'),
(22, 'Bath', 3, '2024-11-05 15:20:08', '2024-11-05 15:20:08'),
(23, 'Keynsham', 3, '2024-11-05 15:20:08', '2024-11-05 15:20:08'),
(24, 'Weston-super-Mare', 3, '2024-11-05 15:20:08', '2024-11-05 15:20:08'),
(25, 'Yate', 3, '2024-11-05 15:20:08', '2024-11-05 15:20:08'),
(26, 'Filton', 3, '2024-11-05 15:20:08', '2024-11-05 15:20:08'),
(27, 'Patchway', 3, '2024-11-05 15:20:08', '2024-11-05 15:20:08'),
(28, 'Brislington', 3, '2024-11-05 15:20:08', '2024-11-05 15:20:08'),
(29, 'Kingswood', 3, '2024-11-05 15:20:08', '2024-11-05 15:20:08'),
(30, 'Portishead', 3, '2024-11-05 15:20:08', '2024-11-05 15:20:08'),
(31, 'Aylesbury', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(32, 'Milton Keynes', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(33, 'High Wycombe', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(34, 'Amersham', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(35, 'Beaconsfield', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(36, 'Buckingham', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(37, 'Chesham', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(38, 'Gerrards Cross', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(39, 'Winslow', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(40, 'Bletchley', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(41, 'Woburn Sands', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(42, 'Stony Stratford', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(43, 'Newport Pagnell', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(44, 'Fenny Stratford', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(45, 'Olney', 4, '2024-11-05 15:20:50', '2024-11-05 15:20:50'),
(46, 'Cambridge', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(47, 'Peterborough', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(48, 'Ely', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(49, 'Huntingdon', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(50, 'St Neots', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(51, 'Wisbech', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(52, 'March', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(53, 'Ramsey', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(54, 'Whittlesey', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(55, 'Chatteris', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(56, 'Sawtry', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(57, 'Yaxley', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(58, 'Cambourne', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(59, 'Godmanchester', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(60, 'Fletton', 5, '2024-11-05 15:22:26', '2024-11-05 15:22:26'),
(61, 'Barking and Dagenham', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(62, 'Barnet', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(63, 'Bexley', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(64, 'Brent', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(65, 'Bromley', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(66, 'Camden', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(67, 'Croydon', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(68, 'Ealing', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(69, 'Enfield', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(70, 'Greenwich', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(71, 'Hackney', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(72, 'Hammersmith and Fulham', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(73, 'Haringey', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(74, 'Harrow', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(75, 'Havering', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(76, 'Hillingdon', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(77, 'Hounslow', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(78, 'Islington', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(79, 'Kensington and Chelsea', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(80, 'Kingston upon Thames', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(81, 'Lambeth', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(82, 'Lewisham', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(83, 'Merton', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(84, 'Newham', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(85, 'Redbridge', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(86, 'Richmond upon Thames', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(87, 'Southwark', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(88, 'Sutton', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(89, 'Tower Hamlets', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(90, 'Waltham Forest', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(91, 'Wandsworth', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39'),
(92, 'Westminster', 17, '2024-11-05 15:40:39', '2024-11-05 15:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','under-review','solved','further-investigation') NOT NULL DEFAULT 'pending',
  `cmp_date` date DEFAULT NULL,
  `cmp_time` time DEFAULT NULL,
  `clnt_cmp_date` date DEFAULT NULL,
  `clnt_cmp_time` time DEFAULT NULL,
  `clnt_cmp_feedback_date` date DEFAULT NULL,
  `clnt_cmp_feedback_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complain_conversations`
--

CREATE TABLE `complain_conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `complain_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `reply_message` text NOT NULL,
  `sender_role` enum('customer','client','admin') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counties`
--

CREATE TABLE `counties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counties`
--

INSERT INTO `counties` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Bedfordshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(2, 'Berkshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(3, 'Bristol', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(4, 'Buckinghamshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(5, 'Cambridgeshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(6, 'Cheshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(7, 'Cornwall', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(8, 'Cumbria', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(9, 'Derbyshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(10, 'Devon', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(11, 'Dorset', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(12, 'Durham', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(13, 'East Riding of Yorkshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(14, 'East Sussex', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(15, 'Essex', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(16, 'Gloucestershire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(17, 'Greater London', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(18, 'Greater Manchester', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(19, 'Hampshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(20, 'Herefordshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(21, 'Hertfordshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(22, 'Isle of Wight', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(23, 'Kent', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(24, 'Lancashire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(25, 'Leicestershire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(26, 'Lincolnshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(27, 'Merseyside', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(28, 'Norfolk', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(29, 'North Yorkshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(30, 'Northamptonshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(31, 'Northumberland', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(32, 'Nottinghamshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(33, 'Oxfordshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(34, 'Rutland', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(35, 'Shropshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(36, 'Somerset', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(37, 'South Yorkshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(38, 'Staffordshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(39, 'Suffolk', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(40, 'Surrey', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(41, 'Tyne and Wear', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(42, 'Warwickshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(43, 'West Midlands', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(44, 'West Sussex', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(45, 'West Yorkshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(46, 'Wiltshire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(47, 'Worcestershire', 1, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(48, 'Aberdeenshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(49, 'Angus', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(50, 'Argyll and Bute', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(51, 'City of Aberdeen', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(52, 'City of Dundee', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(53, 'City of Edinburgh', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(54, 'City of Glasgow', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(55, 'Clackmannanshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(56, 'Dumfries and Galloway', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(57, 'East Ayrshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(58, 'East Dunbartonshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(59, 'East Lothian', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(60, 'East Renfrewshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(61, 'Falkirk', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(62, 'Fife', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(63, 'Highland', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(64, 'Inverclyde', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(65, 'Midlothian', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(66, 'Moray', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(67, 'Na h-Eileanan Siar', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(68, 'North Ayrshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(69, 'North Lanarkshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(70, 'Orkney Islands', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(71, 'Perth and Kinross', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(72, 'Renfrewshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(73, 'Scottish Borders', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(74, 'Shetland Islands', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(75, 'South Ayrshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(76, 'South Lanarkshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(77, 'Stirling', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(78, 'West Dunbartonshire', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(79, 'West Lothian', 2, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(80, 'Blaenau Gwent', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(81, 'Bridgend', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(82, 'Caerphilly', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(83, 'Cardiff', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(84, 'Carmarthenshire', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(85, 'Ceredigion', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(86, 'Conwy', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(87, 'Denbighshire', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(88, 'Flintshire', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(89, 'Gwynedd', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(90, 'Isle of Anglesey', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(91, 'Merthyr Tydfil', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(92, 'Monmouthshire', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(93, 'Neath Port Talbot', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(94, 'Newport', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(95, 'Pembrokeshire', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(96, 'Powys', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(97, 'Rhondda Cynon Taf', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(98, 'Swansea', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(99, 'Torfaen', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(100, 'Vale of Glamorgan', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(101, 'Wrexham', 3, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(102, 'Antrim', 4, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(103, 'Armagh', 4, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(104, 'Down', 4, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(105, 'Fermanagh', 4, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(106, 'Londonderry', 4, '2024-11-05 08:57:16', '2024-11-05 08:57:16'),
(107, 'Tyrone', 4, '2024-11-05 08:57:16', '2024-11-05 08:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'England', '2024-11-05 08:52:03', '2024-11-05 08:52:03'),
(2, 'Scotland', '2024-11-05 08:52:03', '2024-11-05 08:52:03'),
(3, 'Wales', '2024-11-05 08:52:03', '2024-11-05 08:52:03'),
(4, 'Northern Ireland', '2024-11-05 08:52:03', '2024-11-05 08:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_name` varchar(50) NOT NULL,
  `coupon_discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `expire_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `client_id`, `coupon_name`, `coupon_discount`, `expire_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 'march-2025', 10.00, '2025-03-31', 1, '2025-03-15 15:34:54', '2025-03-15 16:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `customer_complains`
--

CREATE TABLE `customer_complains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `sender_role` enum('customer','client','admin') NOT NULL,
  `status` enum('pending','under-review','solved','further-investigation') NOT NULL DEFAULT 'pending',
  `message` text NOT NULL,
  `cmp_date` date DEFAULT NULL,
  `cmp_time` time DEFAULT NULL,
  `customer_cmp_date` date DEFAULT NULL,
  `customer_cmp_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_complain_conversions`
--

CREATE TABLE `customer_complain_conversions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_complain_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `reply_message` text NOT NULL,
  `sender_role` enum('customer','client','admin') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_users`
--

CREATE TABLE `facebook_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `provider_id` varchar(100) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `client_id`, `customer_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 0, '2025-03-04 05:39:50', '2025-03-04 05:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `google_users`
--

CREATE TABLE `google_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `provider_id` varchar(100) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `heroes`
--

CREATE TABLE `heroes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `heroes`
--

INSERT INTO `heroes` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '174012394867b82f2c12a4c.webp', '2025-02-21 07:45:48', '2025-02-21 07:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `instagram_users`
--

CREATE TABLE `instagram_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `provider_id` varchar(100) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_02_17_194200_create_countries_table', 1),
(4, '2025_02_17_194211_create_counties_table', 1),
(5, '2025_02_17_194222_create_cities_table', 1),
(6, '2025_02_17_194233_create_users_table', 1),
(7, '2025_02_17_194240_create_facebook_users_table', 1),
(8, '2025_02_17_194242_create_google_users_table', 1),
(9, '2025_02_17_194244_create_twitter_users_table', 1),
(10, '2025_02_17_194246_create_instagram_users_table', 1),
(11, '2025_02_17_194251_create_site_settings_table', 1),
(12, '2025_02_17_194304_create_abouts_table', 1),
(13, '2025_02_17_194316_create_contacts_table', 1),
(14, '2025_02_17_194327_create_term_conditions_table', 1),
(15, '2025_02_17_194342_create_categories_table', 1),
(16, '2025_02_17_194350_create_brands_table', 1),
(17, '2025_02_17_194355_create_heroes_table', 1),
(18, '2025_02_17_194415_create_products_table', 1),
(19, '2025_02_17_194433_create_product_images_table', 1),
(20, '2025_02_17_194440_create_product_variants_table', 1),
(21, '2025_02_17_194446_create_orders_table', 1),
(22, '2025_02_17_194455_create_order_items_table', 1),
(23, '2025_02_17_194515_create_shipping_addresses_table', 1),
(24, '2025_02_17_194541_create_wishlists_table', 1),
(25, '2025_02_17_194550_create_followers_table', 1),
(26, '2025_02_17_194615_create_customer_complains_table', 1),
(27, '2025_02_17_194622_create_customer_complain_conversions_table', 1),
(28, '2025_02_17_194630_create_complains_table', 1),
(29, '2025_02_17_194640_create_complain_conversations_table', 1),
(30, '2025_02_17_194651_create_banned_customers_table', 1),
(31, '2025_02_17_194701_create_newsletter_subscribers_table', 1),
(32, '2025_02_17_194713_create_activity_logs_table', 1),
(33, '2025_02_17_194723_create_product_shares_table', 1),
(34, '2025_02_21_112416_create_notifications_table', 1),
(35, '2025_03_08_204924_create_stock_movements_table', 2),
(36, '2025_03_11_223033_create_carts_table', 3),
(38, '2025_03_15_113805_create_coupons_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('039fbf82-50ad-4ce3-875a-6056ec6b1aa8', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":2}', NULL, '2025-03-11 04:28:14', '2025-03-11 04:28:14'),
('0c72c80f-4891-4423-983d-0fb29ec03f7a', 'App\\Notifications\\CustomerDocumentNotification', 'App\\Models\\User', 1, '{\"data\":\"Customer document\",\"doc_customer_id\":4}', NULL, '2025-03-04 05:57:06', '2025-03-04 05:57:06'),
('0e8ee587-98bc-4f1e-9fe6-cb6b927c00c0', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":1}', NULL, '2025-03-08 16:20:44', '2025-03-08 16:20:44'),
('1154f38f-fcfd-4fb0-8a13-85f3f2329779', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":2}', NULL, '2025-03-03 14:03:54', '2025-03-03 14:03:54'),
('1245ca06-c08f-4e7c-a998-b316badb071d', 'App\\Notifications\\ClientDocumentNotification', 'App\\Models\\User', 1, '{\"data\":\"Client document\",\"doc_client_id\":2}', NULL, '2025-02-21 08:12:45', '2025-02-21 08:12:45'),
('23ec77ea-5331-4f37-bb7a-7936e693cb65', 'App\\Notifications\\NewClientRegistrationNotification', 'App\\Models\\User', 1, '{\"data\":\"New Client Registration\",\"client_id\":3}', NULL, '2025-03-04 05:28:24', '2025-03-04 05:28:24'),
('2ad8d37d-533a-4273-9b2d-288c9020b1b3', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":1}', NULL, '2025-03-09 04:55:54', '2025-03-09 04:55:54'),
('31832cf6-23a2-469a-83b7-4aae803dd59e', 'App\\Notifications\\ClientDocumentNotification', 'App\\Models\\User', 1, '{\"data\":\"Client document\",\"doc_client_id\":3}', NULL, '2025-03-13 03:51:04', '2025-03-13 03:51:04'),
('3349ae75-786a-4ffc-be3e-effa2b9ebfb0', 'App\\Notifications\\ClientDocumentNotification', 'App\\Models\\User', 1, '{\"data\":\"Client document\",\"doc_client_id\":3}', NULL, '2025-03-13 03:50:55', '2025-03-13 03:50:55'),
('37ccc4a7-0f5b-4e0a-b11b-1162556f6416', 'App\\Notifications\\NewCustomerRegistrationNotification', 'App\\Models\\User', 1, '{\"data\":\"New Customer Registration\",\"customer_id\":4}', NULL, '2025-03-04 05:33:35', '2025-03-04 05:33:35'),
('38cdee25-3e5d-4232-b4d4-b78cfddc6c3b', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":3}', NULL, '2025-03-08 05:44:17', '2025-03-08 05:44:17'),
('40ac503b-dc0a-4190-a3bb-b44135ee9e55', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":1}', NULL, '2025-03-09 04:37:54', '2025-03-09 04:37:54'),
('48ccc775-6a2e-4af7-8677-cbcb46d218f9', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":1}', NULL, '2025-02-27 04:48:32', '2025-02-27 04:48:32'),
('53954a63-7ef6-4142-b43b-903cb42a2ae1', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":1}', NULL, '2025-02-24 15:59:56', '2025-02-24 15:59:56'),
('5fa8631d-9de2-48eb-9a8d-0b5083af7474', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":5}', NULL, '2025-03-10 16:15:56', '2025-03-10 16:15:56'),
('656887b6-9b73-4cc6-8bd7-fcb723b91f9b', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":1}', NULL, '2025-03-08 16:29:51', '2025-03-08 16:29:51'),
('91c2ce71-bb07-4e88-a8b1-73623f84623b', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":3}', NULL, '2025-03-13 05:21:30', '2025-03-13 05:21:30'),
('9ab128a8-f6f6-410b-adad-4203586b5ec7', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":4}', NULL, '2025-03-16 14:56:14', '2025-03-16 14:56:14'),
('d65fc52b-7b00-4e5e-a5ad-ce39d5563f13', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":1}', NULL, '2025-03-11 04:20:22', '2025-03-11 04:20:22'),
('dfa93959-0aff-4fa0-9dc1-fc38c580d975', 'App\\Notifications\\NewClientRegistrationNotification', 'App\\Models\\User', 1, '{\"data\":\"New Client Registration\",\"client_id\":2}', NULL, '2025-02-21 06:17:37', '2025-02-21 06:17:37'),
('f22bc491-c9c3-4b81-a5a5-3d2d724405bd', 'App\\Notifications\\NewProductNotification', 'App\\Models\\User', 1, '{\"data\":\"New Product Upload\",\"product_id\":2}', NULL, '2025-03-08 16:15:43', '2025-03-08 16:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved order','completed','cancel') NOT NULL DEFAULT 'pending',
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `accept_order_request_tnc` tinyint(1) NOT NULL DEFAULT 0,
  `approve_date` date DEFAULT NULL,
  `approve_time` time DEFAULT NULL,
  `accept_product_delivery_tnc` tinyint(1) NOT NULL DEFAULT 0,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `cancel_date` date DEFAULT NULL,
  `cancel_time` time DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `paid_amount` decimal(10,2) DEFAULT 0.00,
  `payment_type` varchar(50) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `order_number` varchar(50) DEFAULT NULL,
  `invoice_no` varchar(50) DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `selling_qty` int(11) NOT NULL DEFAULT 0,
  `color` varchar(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `current_stock` tinyint(1) NOT NULL DEFAULT 0,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `county_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `zip_code` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `expire_date` date DEFAULT NULL,
  `collection_date` date DEFAULT NULL,
  `start_collection_time` time DEFAULT NULL,
  `end_collection_time` time DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `accept_tnc` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('pending','published','processing','completed') NOT NULL DEFAULT 'pending',
  `has_variants` tinyint(1) NOT NULL DEFAULT 0,
  `has_brand` tinyint(1) NOT NULL DEFAULT 0,
  `has_discount_price` tinyint(1) NOT NULL DEFAULT 0,
  `is_free` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `client_id`, `category_id`, `brand_id`, `image`, `name`, `price`, `discount_price`, `current_stock`, `address1`, `address2`, `country_id`, `county_id`, `city_id`, `zip_code`, `description`, `expire_date`, `collection_date`, `start_collection_time`, `end_collection_time`, `latitude`, `longitude`, `accept_tnc`, `status`, `has_variants`, `has_brand`, `has_discount_price`, `is_free`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, '174166680967cfb9f92881d.jpeg', 'T-Shirt One', 600.00, 500.00, 9, '12 High Street', NULL, 1, 17, 62, 'EN5 5XQ', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.&nbsp;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&nbsp;</p>', '2025-03-31', '2025-03-30', '09:00:00', '18:00:00', 51.65577600, -0.20363380, 1, 'published', 1, 0, 1, 0, '2025-03-11 04:20:11', '2025-03-11 04:23:21'),
(2, 2, 2, 1, '174166728967cfbbd938b31.webp', 'Punjabi One', 5000.00, 0.00, 10, '12 High Street', NULL, 1, 17, 62, 'EN5 5XQ', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.&nbsp;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&nbsp;</p>', '2025-03-31', '2025-03-30', '09:00:00', '18:00:00', 51.65577600, -0.20363380, 1, 'published', 0, 1, 0, 0, '2025-03-11 04:28:09', '2025-03-11 09:01:47'),
(3, 3, 1, NULL, '174184327767d26b4d1a90d.jpg', 'Butter Chicken', 0.00, 0.00, 5, '12 High Street', NULL, 1, 17, 62, 'EN5 5XQ', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.&nbsp;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&nbsp;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&nbsp;<span class=\"ql-cursor\">﻿</span></p>', '2025-03-31', '2025-03-30', '09:00:00', '18:00:00', 51.65577600, -0.20363380, 1, 'published', 0, 0, 0, 1, '2025-03-13 05:21:20', '2025-03-13 05:21:20'),
(4, 3, 2, 1, '174213694067d6e66c1fa22.jpg', 'Sharee One', 7000.00, 0.00, 6, '45 Station Road', '12 High Street', 1, 17, 62, 'EN5 1PJ', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.&nbsp;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&nbsp;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&nbsp;<span class=\"ql-cursor\">﻿</span></p>', '2025-03-31', '2025-03-30', '09:00:00', '18:00:00', 51.64865600, -0.17885260, 1, 'published', 1, 1, 0, 0, '2025-03-16 14:55:43', '2025-03-16 14:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, '174166681167cfb9fbde8eb.jpeg', '2025-03-11 04:20:12', '2025-03-11 04:20:12'),
(2, 1, '174166681167cfb9fbef7f5.jpeg', '2025-03-11 04:20:12', '2025-03-11 04:20:12'),
(3, 2, '174166728967cfbbd983770.webp', '2025-03-11 04:28:09', '2025-03-11 04:28:09'),
(4, 2, '174166728967cfbbd98829b.webp', '2025-03-11 04:28:09', '2025-03-11 04:28:09'),
(5, 3, '174184328067d26b50822de.jpg', '2025-03-13 05:21:20', '2025-03-13 05:21:20'),
(6, 3, '174184328067d26b50a3eee.jpg', '2025-03-13 05:21:20', '2025-03-13 05:21:20'),
(7, 4, '174213694367d6e66fc0ebe.jpeg', '2025-03-16 14:55:44', '2025-03-16 14:55:44'),
(8, 4, '174213694367d6e66ff084b.jpeg', '2025-03-16 14:55:44', '2025-03-16 14:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_shares`
--

CREATE TABLE `product_shares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `recipient_email` varchar(255) DEFAULT NULL,
  `shared_via` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `current_stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `color`, `size`, `current_stock`, `created_at`, `updated_at`) VALUES
(1, 1, 'red', 'small', 3, '2025-03-11 04:20:11', '2025-03-11 04:23:21'),
(2, 1, 'red', 'medium', 2, '2025-03-11 04:20:11', '2025-03-11 04:20:11'),
(3, 1, 'black', 'small', 2, '2025-03-11 04:20:11', '2025-03-11 04:20:11'),
(4, 1, 'black', 'medium', 2, '2025-03-11 04:23:21', '2025-03-11 04:23:21'),
(5, 4, 'red', 'medium', 3, '2025-03-16 14:55:43', '2025-03-16 14:55:43'),
(6, 4, 'black', 'medium', 3, '2025-03-16 14:55:43', '2025-03-16 14:55:43');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pQ6pBlPcUxwc7NKgbUThrVqkuH4UnLt5apdQ5604', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTlVwWE05ZGJqWnhnSkFlSEtxSVJPcDlqYkEzTEZXYnZEbkRjM2xZSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jbGllbnQvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1742148784),
('yBXbDv4B5qz5bTgfYYRH7dovZmjgFJAdyQQoMWhQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUDdxemlhcE05dkZsbjZuZUU5M0VsOWtiMzlGQ29weU1hNXdQR0ltRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZXR0aW5nLWxpc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9sb2dvdXQiO319', 1742148801);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `zip_code` varchar(50) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `county_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone1` varchar(20) NOT NULL,
  `phone2` varchar(20) DEFAULT NULL,
  `logo` varchar(255) NOT NULL,
  `website_name` varchar(50) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `refund` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `privacy` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `name`, `email`, `phone1`, `phone2`, `logo`, `website_name`, `slogan`, `address`, `city`, `country`, `zip_code`, `facebook`, `linkedin`, `youtube`, `description`, `refund`, `terms`, `privacy`, `created_at`, `updated_at`) VALUES
(1, 'Graphics Cloud Ltd', 'info@spareitems.org', '07931245768', '07931245768', '174012131367b824e13f46b.png', 'SpareX', 'SpareX connects donors and recipients seamlessly !', '622 New North Road', 'London', 'United Kingdom', 'IG3 8SA', 'https://www.facebook.com/', 'https://www.linkedin.com', 'https://www.youtube.com', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><p><br></p>', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><p><br></p>', '<p><strong>Lorem Ipsum is simply dummy </strong>text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><ol><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li></ol>', '<p><strong>Lorem Ipsum is simply </strong>dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><ol><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li></ol>', '2025-02-21 07:01:53', '2025-02-21 07:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL COMMENT 'Positive for additions, negative for deductions',
  `movement_type` enum('upload','sale','adjustment','return','expired','damaged') NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `product_id`, `variant_id`, `client_id`, `order_id`, `quantity`, `movement_type`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, NULL, 2, 'upload', 'New variant stock upload', '2025-03-11 04:20:11', '2025-03-11 04:20:11'),
(2, 1, 2, 2, NULL, 2, 'upload', 'New variant stock upload', '2025-03-11 04:20:11', '2025-03-11 04:20:11'),
(3, 1, 3, 2, NULL, 2, 'upload', 'New variant stock upload', '2025-03-11 04:20:11', '2025-03-11 04:20:11'),
(4, 1, 1, 2, NULL, 1, 'adjustment', 'Stock adjustment during update', '2025-03-11 04:23:21', '2025-03-11 04:23:21'),
(5, 1, 4, 2, NULL, 2, 'upload', 'New variant stock upload', '2025-03-11 04:23:21', '2025-03-11 04:23:21'),
(6, 2, NULL, 2, NULL, 5, 'upload', 'Initial product stock upload', '2025-03-11 04:28:09', '2025-03-11 04:28:09'),
(7, 2, NULL, 2, NULL, 5, 'adjustment', 'Stock adjustment during update', '2025-03-11 09:01:47', '2025-03-11 09:01:47'),
(8, 3, NULL, 3, NULL, 5, 'upload', 'Initial product stock upload', '2025-03-13 05:21:20', '2025-03-13 05:21:20'),
(9, 4, 5, 3, NULL, 3, 'upload', 'New variant stock upload', '2025-03-16 14:55:43', '2025-03-16 14:55:43'),
(10, 4, 6, 3, NULL, 3, 'upload', 'New variant stock upload', '2025-03-16 14:55:43', '2025-03-16 14:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `term_conditions`
--

CREATE TABLE `term_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_conditions`
--

INSERT INTO `term_conditions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Product Upload', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', '2025-02-21 07:57:20', '2025-02-21 07:57:20'),
(2, 'Request Approve', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', '2025-02-21 07:57:36', '2025-02-21 07:57:36'),
(3, 'Product Deliver', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', '2025-02-21 07:57:47', '2025-02-21 07:57:47'),
(4, 'Customer Registration', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', '2025-02-21 07:58:01', '2025-02-21 07:58:01'),
(5, 'Client Registration', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', '2025-02-21 07:58:13', '2025-02-21 07:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `twitter_users`
--

CREATE TABLE `twitter_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `provider_id` varchar(100) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('admin','client','customer') NOT NULL DEFAULT 'customer',
  `password` varchar(255) NOT NULL,
  `accept_registration_tnc` tinyint(1) NOT NULL DEFAULT 0,
  `otp` varchar(6) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `zip_code` varchar(50) DEFAULT NULL,
  `doc_image1` varchar(255) DEFAULT NULL,
  `doc_image2` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `county_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `mobile`, `image`, `role`, `password`, `accept_registration_tnc`, `otp`, `status`, `is_email_verified`, `address1`, `address2`, `zip_code`, `doc_image1`, `doc_image2`, `latitude`, `longitude`, `country_id`, `county_id`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 'admin@gmail.com', NULL, NULL, 'admin', '$2y$12$9cdE10naIl1JNwNGGCZD2eYkhOVYr4dVCcqjNj6ALkGMPLnpCRuO6', 0, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-21 06:15:46', '2025-02-21 06:15:46'),
(2, 'Client', 'One', 'client1@gmail.com', '01771556644', NULL, 'client', '$2y$12$v9EeHo/cXqeN5AmVCwhBxOs37ArrIqNMTk.eA.cY1OnRKulPID.EO', 1, '0', 1, 1, '12 High Street', NULL, 'EN5 5XQ', '1740125555_doc1.jpeg', '1740125556_doc2.png', 51.65577600, -0.20363380, 1, 17, 62, '2025-02-21 06:17:32', '2025-02-21 08:12:37'),
(3, 'Client', 'Two', 'client2@gmail.com', '01771222222', NULL, 'client', '$2y$12$77fDGxnnR6YPJcZWcVjg5uh1RfvrwWP7p0p2Mey2v2ctu05hYQhi2', 1, '0', 1, 1, '12 High Street', NULL, 'EN5 5XQ', '1741837856_doc1.jpeg', '1741837857_doc2.png', 51.65577600, -0.20363380, 1, 17, 62, '2025-03-04 05:28:14', '2025-03-13 03:50:59'),
(4, 'Subrata', 'Dey', 'anupbca1@gmail.com', '01771556644', NULL, 'customer', '$2y$12$K10Xtd5Ou8ZGruT.8iy.QeJJ6TkEhufOBincPro4Du1U3I0EEsRz2', 1, '0', 1, 1, '12 High Street', NULL, 'EN5 5XQ', '1741067816_doc1.jpeg', '1741067820_doc2.png', 51.65577600, -0.20363380, 1, 17, 62, '2025-03-04 05:33:30', '2025-03-04 05:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `customer_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2025-03-16 13:33:44', '2025-03-16 13:33:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `banned_customers`
--
ALTER TABLE `banned_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banned_customers_client_id_foreign` (`client_id`),
  ADD KEY `banned_customers_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_customer_id_product_id_product_variant_id_unique` (`customer_id`,`product_id`,`product_variant_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_county_id_foreign` (`county_id`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complains_order_id_foreign` (`order_id`),
  ADD KEY `complains_product_id_foreign` (`product_id`),
  ADD KEY `complains_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `complain_conversations`
--
ALTER TABLE `complain_conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complain_conversations_complain_id_foreign` (`complain_id`),
  ADD KEY `complain_conversations_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counties`
--
ALTER TABLE `counties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `counties_country_id_foreign` (`country_id`);

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
  ADD UNIQUE KEY `coupons_coupon_name_unique` (`coupon_name`),
  ADD KEY `coupons_client_id_foreign` (`client_id`);

--
-- Indexes for table `customer_complains`
--
ALTER TABLE `customer_complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_complains_client_id_foreign` (`client_id`),
  ADD KEY `customer_complains_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `customer_complain_conversions`
--
ALTER TABLE `customer_complain_conversions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_complain_conversions_customer_complain_id_foreign` (`customer_complain_id`),
  ADD KEY `customer_complain_conversions_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `facebook_users`
--
ALTER TABLE `facebook_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facebook_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followers_client_id_foreign` (`client_id`),
  ADD KEY `followers_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `google_users`
--
ALTER TABLE `google_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `google_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instagram_users`
--
ALTER TABLE `instagram_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instagram_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletter_subscribers_email_unique` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD UNIQUE KEY `orders_invoice_no_unique` (`invoice_no`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_client_id_foreign` (`client_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD KEY `products_client_id_foreign` (`client_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_country_id_foreign` (`country_id`),
  ADD KEY `products_county_id_foreign` (`county_id`),
  ADD KEY `products_city_id_foreign` (`city_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_shares`
--
ALTER TABLE `product_shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_shares_customer_id_foreign` (`customer_id`),
  ADD KEY `product_shares_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_foreign` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipping_addresses_email_unique` (`email`),
  ADD KEY `shipping_addresses_order_id_foreign` (`order_id`),
  ADD KEY `shipping_addresses_country_id_foreign` (`country_id`),
  ADD KEY `shipping_addresses_county_id_foreign` (`county_id`),
  ADD KEY `shipping_addresses_city_id_foreign` (`city_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_settings_email_unique` (`email`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_variant_id_foreign` (`variant_id`),
  ADD KEY `stock_movements_order_id_foreign` (`order_id`),
  ADD KEY `stock_movements_product_id_variant_id_index` (`product_id`,`variant_id`),
  ADD KEY `stock_movements_client_id_movement_type_index` (`client_id`,`movement_type`);

--
-- Indexes for table `term_conditions`
--
ALTER TABLE `term_conditions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `term_conditions_name_unique` (`name`);

--
-- Indexes for table `twitter_users`
--
ALTER TABLE `twitter_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `twitter_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_county_id_foreign` (`county_id`),
  ADD KEY `users_city_id_foreign` (`city_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_customer_id_foreign` (`customer_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=673;

--
-- AUTO_INCREMENT for table `banned_customers`
--
ALTER TABLE `banned_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complain_conversations`
--
ALTER TABLE `complain_conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counties`
--
ALTER TABLE `counties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_complains`
--
ALTER TABLE `customer_complains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_complain_conversions`
--
ALTER TABLE `customer_complain_conversions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facebook_users`
--
ALTER TABLE `facebook_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_users`
--
ALTER TABLE `google_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `instagram_users`
--
ALTER TABLE `instagram_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_shares`
--
ALTER TABLE `product_shares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `term_conditions`
--
ALTER TABLE `term_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `twitter_users`
--
ALTER TABLE `twitter_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `banned_customers`
--
ALTER TABLE `banned_customers`
  ADD CONSTRAINT `banned_customers_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `banned_customers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_county_id_foreign` FOREIGN KEY (`county_id`) REFERENCES `counties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `complains`
--
ALTER TABLE `complains`
  ADD CONSTRAINT `complains_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `complains_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `complains_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `complain_conversations`
--
ALTER TABLE `complain_conversations`
  ADD CONSTRAINT `complain_conversations_complain_id_foreign` FOREIGN KEY (`complain_id`) REFERENCES `complains` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complain_conversations_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `counties`
--
ALTER TABLE `counties`
  ADD CONSTRAINT `counties_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_complains`
--
ALTER TABLE `customer_complains`
  ADD CONSTRAINT `customer_complains_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_complains_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `customer_complain_conversions`
--
ALTER TABLE `customer_complain_conversions`
  ADD CONSTRAINT `customer_complain_conversions_customer_complain_id_foreign` FOREIGN KEY (`customer_complain_id`) REFERENCES `customer_complains` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_complain_conversions_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facebook_users`
--
ALTER TABLE `facebook_users`
  ADD CONSTRAINT `facebook_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `followers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `google_users`
--
ALTER TABLE `google_users`
  ADD CONSTRAINT `google_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `instagram_users`
--
ALTER TABLE `instagram_users`
  ADD CONSTRAINT `instagram_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_county_id_foreign` FOREIGN KEY (`county_id`) REFERENCES `counties` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_shares`
--
ALTER TABLE `product_shares`
  ADD CONSTRAINT `product_shares_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_shares_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD CONSTRAINT `shipping_addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_addresses_county_id_foreign` FOREIGN KEY (`county_id`) REFERENCES `counties` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_movements_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_movements_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `twitter_users`
--
ALTER TABLE `twitter_users`
  ADD CONSTRAINT `twitter_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_county_id_foreign` FOREIGN KEY (`county_id`) REFERENCES `counties` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
