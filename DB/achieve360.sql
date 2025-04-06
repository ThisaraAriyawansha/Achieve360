-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 07:01 AM
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
-- Database: `achieve360`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_courses`
--

CREATE TABLE `assigned_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assigned_courses`
--

INSERT INTO `assigned_courses` (`id`, `course_name`, `teacher_name`, `assigned_at`, `created_at`, `updated_at`) VALUES
(14, 'Web Animations', 'Dilini Kumara', '2024-11-10 06:30:39', NULL, NULL),
(15, 'API Development', 'Kasun Perera', '2024-11-10 08:42:56', NULL, NULL),
(20, 'Object-Oriented Programming (OOP)', 'Chamara Fernando', '2024-11-12 23:03:22', NULL, NULL),
(23, 'Java', 'Lahiru Gunawardana', '2024-12-06 22:49:05', NULL, NULL),
(25, 'IOT', 'sachini', '2025-04-04 08:18:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('thisaraariyawansha2001@gmail.com|127.0.0.1', 'i:1;', 1731060779),
('thisaraariyawansha2001@gmail.com|127.0.0.1:timer', 'i:1731060779;', 1731060779);

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
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Object-Oriented Programming (OOP)', 'A programming paradigm based on objects and classes, promoting reusable and maintainable code.', '2024-11-10 06:03:07', '2024-11-10 06:03:07'),
(3, 'API Development', 'Creating interfaces for software components to communicate with each other', '2024-11-10 06:03:36', '2024-11-10 06:03:36'),
(4, 'Cloud Computing', 'Using remote servers and services to store, manage, and process data online, rather than locally.', '2024-11-10 06:03:57', '2024-11-10 06:03:57'),
(5, 'Microservices', 'An architecture where software is divided into small, loosely connected services that can be developed, deployed, and scaled independently.', '2024-11-10 06:04:30', '2024-11-10 06:04:30'),
(6, 'Front-End Development', 'Creating the visual elements of a website using HTML, CSS, and JavaScript.', '2024-11-10 06:08:20', '2024-11-10 06:08:20'),
(7, 'Full-Stack Development', 'Combining front-end and back-end skills to build complete web applications.', '2024-11-10 06:08:35', '2024-11-10 06:08:35'),
(8, 'Back-End Development', 'Handling server-side logic, databases, and APIs.', '2024-11-10 06:09:04', '2024-11-10 06:09:04'),
(9, 'Web Animations', 'Adding movement and interactivity to websites using CSS and JavaScript libraries.', '2024-11-10 06:26:24', '2024-11-10 06:26:24'),
(15, 'IOT', 'This is IOT course', '2024-11-12 23:02:56', '2024-11-12 23:02:56'),
(17, 'Java', 'java course', '2024-12-06 22:48:24', '2024-12-06 22:48:24'),
(18, 'Python', 'aaaaaa', '2025-04-04 08:11:23', '2025-04-04 08:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `marks` int(11) NOT NULL DEFAULT 0,
  `attendance_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_email`, `course_name`, `teacher_name`, `marks`, `attendance_count`, `created_at`, `updated_at`) VALUES
(1, 'nadil@gmail.com', 'API Development', 'Kasun Perera', 40, 5, '2024-11-11 08:46:46', '2024-11-13 10:27:45'),
(2, 'lokith@gmail.com', 'Full-Stack Development', 'Dilini Kumara', 0, 0, '2024-11-11 09:01:19', '2024-11-11 09:01:19'),
(3, 'nadil@gmail.com', 'Web Animations', 'Dilini Kumara', 0, 3, '2024-11-11 09:03:24', '2024-12-06 22:56:34'),
(8, 'malidu@gmail.com', 'Object-Oriented Programming (OOP)', 'Chamara Fernando', 10, 2, '2024-11-13 10:23:24', '2024-12-06 22:59:08'),
(9, 'kamal@gmail.com', 'Object-Oriented Programming (OOP)', 'Chamara Fernando', 0, 0, '2025-03-22 07:07:43', '2025-03-22 07:07:43'),
(10, 'vvv@gmail.com', 'Object-Oriented Programming (OOP)', 'Chamara Fernando', 0, 2, '2025-04-02 06:21:37', '2025-04-04 08:20:54'),
(11, 'namal@gmail.com', 'Java', 'Lahiru Gunawardana', 0, 0, '2025-04-04 08:15:24', '2025-04-04 08:15:24'),
(12, 'namal@gmail.com', 'API Development', 'Kasun Perera', 0, 0, '2025-04-04 08:15:41', '2025-04-04 08:15:41'),
(13, 'namal@gmail.com', 'IOT', 'sachini', 80, 0, '2025-04-04 08:18:29', '2025-04-04 08:19:03');

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
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `marks` decimal(5,2) NOT NULL,
  `exam_type` enum('assignment','quiz','exam') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_08_082017_create_users_table', 1),
(5, '2024_11_08_082648_create_courses_table', 2),
(6, '2024_11_08_082707_create_marks_table', 2),
(7, '2024_11_08_082739_create_attendance_table', 2),
(8, '2024_11_10_090711_create_course_assignments_table', 3),
(9, '2024_11_10_100452_create_assigned_courses_table', 4),
(10, '2024_11_11_133808_create_enrollments_table', 5),
(11, '2024_11_11_141232_create_enrollments_table', 6);

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
('xODQzOS93CKIXr1UVN1uOCusQV66JyAX7h5PQupl', 47, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSlBXbU0yZFo5MTRFWUFjaGxjbFowbnl4Q2UzZUU1NHo2Z3l1RXA5aCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ3O30=', 1743774810);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `full_name`, `status`, `created_at`, `updated_at`) VALUES
(39, 'Thisara', '$2y$12$l.6m0Wf0BPpNHZCIxN/w3eOBOstFePZpvgRUJNHmK6jn9HViZ8X6m', 'admin@gmail.com', 'super_admin', 'Thisara', 'active', '2025-03-22 07:03:24', '2025-03-22 07:03:24'),
(40, 'Kamal', '$2y$12$1Vs6xURNO66IwG0hOtXfc.RNPJikHAohKL4ltQIy5vb68agv0OsRa', 'kamal@gmail.com', 'student', 'Kamal', 'active', '2025-03-22 07:07:20', '2025-04-02 05:51:10'),
(41, 'Thisara ABC', '$2y$12$sFUQ/C2mBBOVO5Id2YKtM.Mve57a03IgE9m5BGrJkpViJ1AHOdTKW', 'thisara@gmail.com', 'student', 'Thisara ABC', 'active', '2025-04-02 05:52:55', '2025-04-02 05:52:55'),
(42, 'admin123', '$2y$12$wimY53b4UPDsysrzdo6J..qrli.iCW0bdy26Iq8XffiNvrgF1dzi2', 'admin123@gmail.com', 'admin', 'admin123', 'Inactive', '2025-04-02 05:54:04', '2025-04-04 08:12:01'),
(43, 'bbb', '$2y$12$iYLokNhmrG.whHnInMCIqu44v006JYgfHrNIpy0TJC9e3tygyWQCy', 'bbbb@gmail.com', 'student', 'bbb', 'active', '2025-04-02 06:16:36', '2025-04-02 06:16:36'),
(44, 'vvv', '$2y$12$ehJEHxTQs7LGRHEhm8c1YeKXDXqVNXJF9TMiV0GGyQ9EkOX1W2a4u', 'vvv@gmail.com', 'student', 'vvv  vvv', 'active', '2025-04-02 06:19:31', '2025-04-02 06:19:31'),
(45, 'namal', '$2y$12$Kv/p7RZDpN7jSFvpDJdPu.rLNMUxNrw7kLQlcDF1ZS7/VOVtg7fAe', 'namal@gmail.com', 'student', 'Namal', 'active', '2025-04-04 08:07:53', '2025-04-04 08:07:53'),
(46, 'sachini', '$2y$12$7iB.mts3TGokZ80FXeED/.6Vn.7Xhhbjjod2ECZXeWP65GrBfb8wu', 'sachini@gmail.com', 'teacher', 'sachini', 'active', '2025-04-04 08:09:49', '2025-04-04 08:09:49'),
(47, 'thilina', '$2y$12$OZ4tnAT1iWhPZn0iPLekIuF3qSLglKx0u9gxu.3DXbnpq7Q0QdTVm', 'thilina@gmail.com', 'admin', 'thilina', 'active', '2025-04-04 08:10:26', '2025-04-04 08:10:26'),
(48, 'sampath', '$2y$12$orMmbUJT2N2vB76bNcvSpufn2tjf6VUbWpdf.NDsulEd8FDt0NvOu', 'sampath@gmail.com', 'manager', 'sampath', 'active', '2025-04-04 08:10:50', '2025-04-04 08:10:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_courses`
--
ALTER TABLE `assigned_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_user_id_foreign` (`user_id`),
  ADD KEY `attendance_course_id_foreign` (`course_id`);

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
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marks_user_id_foreign` (`user_id`),
  ADD KEY `marks_course_id_foreign` (`course_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_courses`
--
ALTER TABLE `assigned_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `attendance_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `marks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
