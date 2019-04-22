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
DROP DATABASE IF EXISTS `actividades`;
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.reportes: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `reportes` DISABLE KEYS */;
INSERT INTO `reportes` (`id`, `descripcion`, `observacion`, `fecha`, `users_id`, `created_at`, `updated_at`) VALUES
	(22, 'Reporte  Nuevo', ' ', '2019-04-10', 1, '2019-04-10 11:02:15', '2019-04-10 11:02:15'),
	(25, 'Reporte Prueba', ' ', '2019-04-10', 1, '2019-04-10 11:13:49', '2019-04-10 11:13:49'),
	(26, 'Reporte Prueba 3', ' ', '2019-04-10', 1, '2019-04-10 11:17:07', '2019-04-10 11:17:07'),
	(28, 'Reporte de prueba final', ' ', '2019-04-10', 1, '2019-04-10 14:41:34', '2019-04-10 14:41:34'),
	(29, 'Reporte de prueba', 'Observación de prueba', '2019-04-10', 1, '2019-04-10 14:54:27', '2019-04-10 14:57:49'),
	(31, 'Reporte de Prueba Final', 'likhlk', '2019-04-11', 1, '2019-04-11 15:56:18', '2019-04-11 16:41:11'),
	(32, 'Final Prueba Reportes', ' ', '2019-04-11', 1, '2019-04-11 15:58:43', '2019-04-11 15:58:43'),
	(33, 'El Alumno reporta que si realizó todas las tareas', ' ', '2019-04-11', 1, '2019-04-11 16:01:52', '2019-04-11 16:01:52'),
	(34, 'Reporto que si realicé todos las tareas', ' ', '2019-04-11', 1, '2019-04-11 17:38:26', '2019-04-11 17:38:26'),
	(35, 'Reporto que solo logré hacer una tarea', ' ', '2019-04-11', 1, '2019-04-11 17:39:10', '2019-04-11 17:39:10'),
	(36, 'Reporto que solo pude efectuar la primera actividad', ' ', '2019-04-22', 1, '2019-04-22 11:55:24', '2019-04-22 11:55:24');
/*!40000 ALTER TABLE `reportes` ENABLE KEYS */;

-- Volcando estructura para tabla actividades.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.roles: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Admnistrador', '2019-04-13 09:35:09', '2019-04-13 09:35:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.role_user: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2019-04-13 09:35:30', '2019-04-13 09:35:30');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Volcando estructura para tabla actividades.tareas
CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tituloTarea` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prioridad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tareas_users_id_foreign` (`users_id`),
  CONSTRAINT `tareas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla actividades.tareas: ~42 rows (aproximadamente)
/*!40000 ALTER TABLE `tareas` DISABLE KEYS */;
INSERT INTO `tareas` (`id`, `tituloTarea`, `prioridad`, `descripcion`, `estado`, `fecha`, `users_id`, `created_at`, `updated_at`) VALUES
	(2, 'Tarea Anterior', 'Media', 'Prueba dia anterior', 'Incumplida', '2019-04-03', 1, '2019-04-04 09:13:28', '2019-04-04 09:56:51'),
	(3, 'Segunda Tarea', 'Baja', 'Segunda', 'Incumplida', '2019-04-04', 1, '2019-04-04 09:27:10', '2019-04-05 16:10:51'),
	(4, 'Tercera Tarea', 'Alta', 'Tercera', 'Incumplida', '2019-04-04', 1, '2019-04-04 09:27:33', '2019-04-05 16:10:51'),
	(5, 'Cuarta Tarea ', 'Alta', 'Prueba ', 'Incumplida', '2019-04-03', 1, '2019-04-04 10:40:58', '2019-04-04 11:15:02'),
	(6, 'Nuva Tarea', 'Alta', 'tarea descripcion', 'Pendiente', '2019-04-26', 1, '2019-04-04 14:23:40', '2019-04-04 14:23:40'),
	(7, 'Tarea User2', 'Alta', 'tarea para usuario 2 ', 'Incumplida', '2019-04-04', 2, '2019-04-04 15:11:59', '2019-04-22 12:25:18'),
	(8, 'Concierto', 'Media', 'Concierto de Amaretto en Ahuachapan', 'Incumplida', '2019-04-04', 3, '2019-04-04 15:13:47', '2019-04-22 12:26:22'),
	(9, 'Prueba', 'Alta', 'Usuario 1', 'Incumplida', '2019-04-04', 1, '2019-04-04 16:41:15', '2019-04-05 16:10:51'),
	(10, 'Prueba 2', 'Alta', 'usuario 1', 'Incumplida', '2019-04-04', 1, '2019-04-04 16:41:43', '2019-04-05 16:10:51'),
	(11, 'Prueba 3', 'Alta', 'Usuario 2', 'Incumplida', '2019-04-04', 2, '2019-04-04 16:44:09', '2019-04-22 12:25:18'),
	(12, 'Prueba', 'Alta', 'usuario 2', 'Incumplida', '2019-04-04', 2, '2019-04-04 16:47:58', '2019-04-22 12:25:18'),
	(13, 'Prueba 4', 'Alta', 'Usuario 3', 'Incumplida', '2019-04-04', 3, '2019-04-04 16:49:12', '2019-04-22 12:26:23'),
	(16, 'prueba final', 'Alta', 'para validaciones', 'Incumplida', '2019-04-05', 1, '2019-04-05 10:34:21', '2019-04-08 09:57:42'),
	(17, 'PRUEBAS FINALES', 'Alta', 'otra prueba final', 'Incumplida', '2019-04-05', 1, '2019-04-05 11:20:43', '2019-04-05 11:20:43'),
	(18, 'PRUEBAS FINALES', 'Alta', 'otra prueba final', 'Incumplida', '2019-04-06', 1, '2019-04-05 16:46:16', '2019-04-08 09:57:42'),
	(19, 'Tarea', 'Alta', 'Prueba', 'Finalizada', '2019-04-08', 1, '2019-04-08 08:51:23', '2019-04-08 12:12:10'),
	(20, 'Tarea lunes', 'Media', 'para el dia lunes', 'Incumplida', '2019-04-08', 2, '2019-04-08 08:51:56', '2019-04-22 12:25:18'),
	(21, 'Tarea S 11', 'Baja', 'Semana doce', 'Incumplida', '2019-04-08', 3, '2019-04-08 08:52:32', '2019-04-22 12:26:23'),
	(22, 'Tarea Anterior', 'Media', 'Prueba dia anterior', 'Finalizada', '2019-04-08', 1, '2019-04-08 09:55:05', '2019-04-08 12:12:18'),
	(23, 'Cuarta Tarea', 'Alta', 'Prueba', 'Finalizada', '2019-04-08', 1, '2019-04-08 09:56:43', '2019-04-08 12:18:36'),
	(24, 'Tarea prueba', 'Alta', 'Prueba', 'Incumplida', '2019-04-08', 1, '2019-04-08 10:26:34', '2019-04-10 11:21:41'),
	(25, 'Prueba', 'Alta', 'Prueba textArea', 'Incumplida', '2019-04-08', 1, '2019-04-08 10:33:12', '2019-04-10 11:21:41'),
	(26, 'Segunda Tarea', 'Baja', 'Segunda', 'Incumplida', '2019-04-08', 1, '2019-04-08 11:19:51', '2019-04-10 11:21:41'),
	(27, 'PRUEBAS FINALES (Tarea Reasignada)', 'Alta', 'otra prueba final', 'Incumplida', '2019-04-08', 1, '2019-04-08 11:22:48', '2019-04-10 11:21:41'),
	(30, '10-4', 'Alta', 'Tarea Tarea', 'Incumplida', '2019-04-10', 1, '2019-04-10 09:57:45', '2019-04-11 16:00:41'),
	(35, 'Tarea de prueba', 'Alta', 'tarea de prueba para los sweet alert', 'Incumplida', '2019-04-11', 2, '2019-04-10 10:01:36', '2019-04-22 12:25:18'),
	(36, 'Tarea', 'Alta', 'Descripcion', 'Incumplida', '2019-04-10', 1, '2019-04-10 10:02:05', '2019-04-11 16:00:41'),
	(37, 'Tarea de Prueba para el alumno', 'Alta', 'Se genera una tarea de prueba para el alumno!', 'Incumplida', '2019-04-10', 3, '2019-04-10 12:19:19', '2019-04-22 12:26:23'),
	(39, 'Otra tarea de prueba', 'Alta', 'nueva tarea de prueba', 'Incumplida', '2019-04-10', 3, '2019-04-10 12:26:19', '2019-04-22 12:26:23'),
	(40, 'otra tarea de prueba', 'Alta', 'Tarea en pruebas finales', 'Incumplida', '2019-04-10', 3, '2019-04-10 12:29:57', '2019-04-22 12:26:23'),
	(43, 'Tarea de prueba', 'Alta', 'descripción de prueba', 'Incumplida', '2019-04-10', 1, '2019-04-10 12:33:25', '2019-04-11 17:39:49'),
	(44, 'Otra tarea de prueba final', 'Alta', 'finales', 'Incumplida', '2019-04-10', 1, '2019-04-10 12:34:19', '2019-04-11 17:39:49'),
	(45, 'una nueva tarea de prueba', 'Alta', 'Descripcion de la tarea nueva', 'Incumplida', '2019-04-10', 1, '2019-04-10 12:45:59', '2019-04-11 17:39:49'),
	(46, '10-4 (Tarea Reasignada)', 'Alta', 'Tarea Tarea', 'Incumplida', '2019-04-10', 1, '2019-04-10 12:50:24', '2019-04-11 17:39:49'),
	(47, 'Tarea (Tarea Reasignada)', 'Alta', 'Descripcion', 'Incumplida', '2019-04-10', 1, '2019-04-10 12:50:33', '2019-04-11 17:39:49'),
	(48, 'Tarea de prueba (Tarea Reasignada)', 'Alta', 'descripción de prueba', 'Incumplida', '2019-04-10', 1, '2019-04-10 12:50:38', '2019-04-11 17:39:49'),
	(49, 'Otra tarea de prueba final (Tarea Reasignada)', 'Alta', 'finales', 'Incumplida', '2019-04-11', 1, '2019-04-10 12:50:44', '2019-04-12 11:30:25'),
	(50, 'una nueva tarea de prueba (Tarea Reasignada)', 'Alta', 'Descripcion de la tarea nueva', 'Incumplida', '2019-04-12', 1, '2019-04-10 12:50:51', '2019-04-13 15:11:45'),
	(52, 'Tarea (Tarea Reasignada)', 'Alta', 'Descripcion', 'Incumplida', '2019-04-11', 1, '2019-04-10 14:57:07', '2019-04-12 11:30:25'),
	(56, 'Prueba', 'Alta', 'Prueba', 'Finalizada', '2019-04-22', 1, '2019-04-22 09:47:55', '2019-04-22 11:54:53'),
	(57, 'Entrega preliminar Proyecto', 'Alta', 'Entrega preliminar del proyecto final', 'Incumplida', '2019-04-22', 1, '2019-04-22 11:54:17', '2019-04-22 11:55:25'),
	(58, 'Vista Preliminar de Exposición', 'Alta', 'Exposición preliminar de exposición final de proyecto', 'Pendiente', '2019-04-22', 1, '2019-04-22 11:56:19', '2019-04-22 11:56:19'),
	(59, 'Prueba alumno 2', 'Alta', 'Tarea 1', 'Pendiente', '2019-04-22', 2, '2019-04-22 12:25:49', '2019-04-22 12:25:49'),
	(60, 'Prueba Alumno 3', 'Alta', 'Tarea 2', 'Pendiente', '2019-04-22', 2, '2019-04-22 12:26:13', '2019-04-22 12:26:13');
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

-- Volcando datos para la tabla actividades.users: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Roberto Carlos', 'roberto.carlos@gmail.com', '2019-04-03 14:18:35', 'secret', NULL, '2019-04-03 14:18:40', '2019-04-03 14:18:40'),
	(2, 'Juan José', 'juan.josé@hotmail.com', '2019-04-03 14:19:02', 'secret', NULL, '2019-04-03 14:19:05', '2019-04-03 14:19:05'),
	(3, 'Julio Yudice', 'julio.yudice@myspace.com', '2019-04-03 14:19:54', 'secret', NULL, '2019-04-03 14:19:57', '2019-04-03 14:19:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
