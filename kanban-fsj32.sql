-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2026 a las 02:05:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kanban-fsj32`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `jobs`
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
-- Estructura de tabla para la tabla `job_batches`
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
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_07_224525_create_tasks_table', 2),
(5, '2026_04_08_221846_create_personal_access_tokens_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
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
-- Estructura de tabla para la tabla `sessions`
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
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` enum('pendiente','en proceso','completado') NOT NULL,
  `priority` enum('baja','media','alta') NOT NULL,
  `due_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `status`, `priority`, `due_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Testeando', 'Actualiza las pruebas unitarias', 'pendiente', 'baja', '2026-05-01', 5, '2026-04-14 05:01:47', '2026-04-15 04:58:01'),
(2, 'Reporte de ventas', 'Generar un reporte de ventas con todos los productos que se vendieron el 2024', 'en proceso', 'alta', '2026-04-20', 2, '2026-04-15 03:43:04', '2026-04-15 03:43:04'),
(3, 'Dashboard de admisiones', 'Crear un dashboard con el registro de futuros estudiantes', 'en proceso', 'media', '2026-05-10', 10, '2026-04-15 03:44:23', '2026-04-15 03:44:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mrs. Vallie Armstrong PhD', 'frederick84@example.com', '2026-04-08 05:01:22', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', '1eqhUtEuJC', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(2, 'Eudora Auer', 'henri56@example.com', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'x7rUrZbJu7', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(3, 'Lexi Barrows', 'dillon.hessel@example.net', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'j1wEg8rvis', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(4, 'Martina Mohr', 'rogers12@example.com', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', '8zM2yn23dq', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(5, 'Quentin Hickle', 'rosina78@example.org', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'HwLdt4rZPz', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(6, 'Prof. Adriel Kshlerin III', 'florence12@example.com', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'el1YO9NlTh', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(7, 'Dr. Elijah Abernathy MD', 'brennon.greenholt@example.com', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'PcAdmB5Oxx', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(8, 'Vaughn Spinka', 'mthiel@example.org', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'GZMGzz10rx', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(9, 'Rachel Hand DVM', 'kbashirian@example.com', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'Aj1mDYwpCD', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(10, 'Dr. Carleton Nikolaus DDS', 'bradly.dooley@example.net', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'OQ46qnxKSU', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(11, 'Marty Hahn', 'francesca.bartoletti@example.net', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'e9MnmbkajY', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(12, 'Americo Windler', 'giles.will@example.com', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'xNkQUTrE8t', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(13, 'Stephen Bins V', 'lueilwitz.tressie@example.net', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'k1KUtRyE9o', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(14, 'Andre Harvey', 'milo.nader@example.net', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', '2nhpd8PNin', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(15, 'Ms. Carolyn Cormier', 'stephanie43@example.org', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', '4ZvsectqFo', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(16, 'Kelli Adams V', 'aaron.bashirian@example.net', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'Gb83aM3tv8', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(17, 'Dr. Melany Okuneva', 'birdie60@example.net', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'zl42tmtDZb', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(18, 'Mr. Chet Bayer I', 'bill.hackett@example.org', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'Ki7KLnyvL2', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(19, 'Izaiah Marks', 'carley44@example.net', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'Wr6QIsMOCZ', '2026-04-08 05:01:23', '2026-04-08 05:01:23'),
(20, 'Twila Wolf', 'iyost@example.com', '2026-04-08 05:01:23', '$2y$12$o8QuLnu0/EaLVLWdSGAimu9OpNCkhd2kfCSmudyOiC51MWqMaOuo6', 'Ne5TJSgumE', '2026-04-08 05:01:23', '2026-04-08 05:01:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tasks_title_unique` (`title`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
