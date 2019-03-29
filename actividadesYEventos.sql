-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.11 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para actividades
CREATE DATABASE IF NOT EXISTS `actividades` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `actividades`;

-- Volcando estructura para tabla actividades.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.migrations: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_11_27_212508_create_roles_table', 1),
	(4, '2018_11_27_212641_create_role_user_table', 1),
	(5, '2019_03_25_150428_create_table_reportes', 1),
	(6, '2019_03_25_160650_create_table_tareas', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla actividades.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla actividades.reportes
CREATE TABLE IF NOT EXISTS `reportes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci,
  `fecha` date NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reportes_users_id_foreign` (`users_id`),
  CONSTRAINT `reportes_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.reportes: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `reportes` DISABLE KEYS */;
INSERT INTO `reportes` (`id`, `descripcion`, `observacion`, `fecha`, `users_id`, `created_at`, `updated_at`) VALUES
	(27, 'Fin tareas', 'Las tareas estan mal hechas', '2019-03-26', 1, NULL, NULL),
	(28, 'Cumpli la meta', 'Bien hechos', '2019-03-25', 1, '2019-03-27 09:26:00', '2019-03-27 09:26:01'),
	(29, 'Fin del dia', 'Bien hecho todo', '2019-03-24', 1, '2019-03-27 09:26:41', '2019-03-27 09:25:43'),
	(66, 'lkllmk', NULL, '2019-03-27', 1, '2019-03-27 14:58:49', '2019-03-27 14:58:49'),
	(67, 'se elabora reporte del dia 27 de marzo', NULL, '2019-03-27', 1, '2019-03-27 15:39:38', '2019-03-27 15:39:38'),
	(68, 'Reporte', NULL, '2019-03-28', 1, '2019-03-28 14:51:16', '2019-03-28 14:51:16'),
	(69, 'reporte de prueba para el dia veintiocho', NULL, '2019-03-28', 1, '2019-03-28 16:37:24', '2019-03-28 16:37:24');
/*!40000 ALTER TABLE `reportes` ENABLE KEYS */;

-- Volcando estructura para tabla actividades.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.roles: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla actividades.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.role_user: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Volcando estructura para tabla actividades.tareas
CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tituloTarea` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prioridad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tareas_users_id_foreign` (`users_id`),
  CONSTRAINT `tareas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.tareas: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `tareas` DISABLE KEYS */;
INSERT INTO `tareas` (`id`, `tituloTarea`, `prioridad`, `descripcion`, `estado`, `fechaInicio`, `fechaFin`, `users_id`, `created_at`, `updated_at`) VALUES
	(4, 'arriba con la seleccion', 'Alta', 'la selecta cuscatleca', 'Incumplida', '2019-03-25', '2019-03-25', 1, '2019-03-25 16:20:09', '2019-03-27 14:59:49'),
	(5, 'le ganamos a jamaica', 'Media', 'dos a cero', 'Finalizada', '2019-03-25', '2019-03-25', 1, '2019-03-25 16:20:32', '2019-03-27 14:59:49'),
	(6, 'y le vamos a ganar a brasil', 'Baja', 'y hasta francia', 'Incumplida', '2019-03-25', '2019-03-25', 1, '2019-03-25 16:21:01', '2019-03-27 14:59:49'),
	(7, 'NUEVA TAREA 26', 'Alta', 'TAREA DE PREBA PARA ESTE DIA', 'Finalizada', '2019-03-26', '2019-03-26', 1, '2019-03-26 08:33:04', '2019-03-27 14:59:49'),
	(8, 'PENDIENTE DE NUEVO', 'Alta', 'TAREA DE PRUEBA', 'Incumplida', '2019-03-26', '2019-03-26', 1, '2019-03-26 08:34:21', '2019-03-27 14:59:49'),
	(9, '26 DE MARZO PRUEBA', 'Alta', 'PRUEBA UNA VEZ MAS', 'Finalizada', '2019-03-26', '2019-03-26', 1, '2019-03-26 08:35:05', '2019-03-27 14:59:49'),
	(10, 'UNA SEIS MAS', 'Alta', 'MAS TAREAS DE PRUEBA', 'Incumplida', '2019-03-26', '2019-03-26', 1, '2019-03-26 08:36:28', '2019-03-27 14:59:49'),
	(11, 'tarea para mañana', 'Alta', 'tarea para mañana', 'Finalizada', '2019-03-26', '2019-03-27', 1, '2019-03-26 08:55:09', '2019-03-27 15:38:04'),
	(12, 'otra tarea', 'Baja', 'tarea baja', 'Incumplida', '2019-03-26', '2019-03-27', 1, '2019-03-26 08:55:52', '2019-03-27 15:39:38'),
	(13, 'amor eterno', 'Media', 'he inolvidable', 'Incumplida', '2019-03-26', '2019-03-27', 1, '2019-03-26 08:56:34', '2019-03-27 15:39:38'),
	(14, 'ventiocho', 'Alta', 'terea prueba', 'Finalizada', '2019-03-26', '2019-03-28', 1, '2019-03-26 08:57:38', '2019-03-28 14:50:57'),
	(15, 'ventiocho dos', 'Alta', 'tarea de prueba', 'Incumplida', '2019-03-26', '2019-03-28', 1, '2019-03-26 08:58:02', '2019-03-28 14:51:16'),
	(16, 'ventinueve uno', 'Media', 'tarea de prueba de nuevo', 'Finalizada', '2019-03-26', '2019-03-29', 1, '2019-03-26 09:00:37', '2019-03-28 15:06:29'),
	(17, 'ventinueve dos', 'Media', 'otra tareade de prueba', 'Pendiente', '2019-03-26', '2019-03-29', 1, '2019-03-26 09:01:19', '2019-03-26 09:01:20'),
	(18, 'treinta uno', 'Baja', 'treinta de prueba', 'Finalizada', '2019-03-26', '2019-03-30', 1, '2019-03-26 09:01:53', '2019-03-28 10:31:57'),
	(19, 'treinta dos', 'Baja', 'treinta dos de prueba', 'Finalizada', '2019-03-26', '2019-03-30', 1, '2019-03-26 09:02:30', '2019-03-28 10:31:55'),
	(20, 'tarea de nueva prueba', 'Alta', 'prueba de fecha fin', 'Finalizada', '2019-03-26', '2019-03-22', 1, '2019-03-26 10:18:15', '2019-03-28 10:23:11'),
	(21, 'ñalksjdñljfads', 'Alta', 'ñalksjdfñakjdsf', 'Pendiente', '2019-03-25', '2019-03-10', 1, '2019-03-26 10:28:24', '2019-03-27 14:59:50'),
	(22, 'Prueba veintisiete', 'Alta', 'prueba día miercoles', 'Finalizada', '2019-03-27', '2019-03-27', 1, '2019-03-27 10:28:26', '2019-03-28 10:23:24');
/*!40000 ALTER TABLE `tareas` ENABLE KEYS */;

-- Volcando estructura para tabla actividades.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.users: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Don Human', 'donhuma@pepeto.com', '2019-03-25 16:18:41', 'admin', NULL, '2019-03-25 16:18:47', '2019-03-25 16:18:47'),
	(2, 'Chepe Toño', 'chepe@gmail.com', '2019-03-26 11:01:25', 'admin', NULL, '2019-03-26 11:01:28', '2019-03-26 11:01:29'),
	(3, 'Pollo Campero', 'campero@gmail.com', '2019-03-26 11:02:00', 'asda', NULL, '2019-03-26 11:02:02', '2019-03-26 11:02:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
