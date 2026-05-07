-- ========================================
-- DATABASE SCHEMA - HUMANITARIAN PLATFORM 2026
-- ========================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `humanitarian_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `humanitarian_db`;

-- ========================================
-- TABLE: users
-- ========================================
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'moderator', 'user') DEFAULT 'user',
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`),
  INDEX `idx_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- TABLE: admins
-- ========================================
CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(255) NOT NULL,
  `avatar` VARCHAR(255) DEFAULT NULL,
  `permissions` JSON DEFAULT NULL,
  `last_login` TIMESTAMP NULL DEFAULT NULL,
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_admin_email` (`email`),
  UNIQUE KEY `unique_admin_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- TABLE: donation_requests
-- ========================================
CREATE TABLE IF NOT EXISTS `donation_requests` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `whatsapp` VARCHAR(50) DEFAULT NULL,
  `country` VARCHAR(100) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `situation` TEXT NOT NULL,
  `help_type` ENUM('financial', 'medical', 'food', 'social', 'other') NOT NULL,
  `amount_requested` DECIMAL(10,2) DEFAULT NULL,
  `description` TEXT NOT NULL,
  `status` ENUM('pending', 'approved', 'rejected', 'completed') DEFAULT 'pending',
  `admin_notes` TEXT DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `is_spam` TINYINT(1) DEFAULT 0,
  `gdpr_consent` TINYINT(1) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_status` (`status`),
  INDEX `idx_help_type` (`help_type`),
  INDEX `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- TABLE: testimonials
-- ========================================
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(100) NOT NULL,
  `country` VARCHAR(100) NOT NULL,
  `help_type` ENUM('financial', 'medical', 'food', 'social', 'other') NOT NULL,
  `description` TEXT NOT NULL,
  `video_path` VARCHAR(255) NOT NULL,
  `thumbnail_path` VARCHAR(255) DEFAULT NULL,
  `duration` INT DEFAULT NULL,
  `likes_count` INT UNSIGNED DEFAULT 0,
  `views_count` INT UNSIGNED DEFAULT 0,
  `comments_count` INT UNSIGNED DEFAULT 0,
  `is_featured` TINYINT(1) DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_help_type` (`help_type`),
  INDEX `idx_is_featured` (`is_featured`),
  INDEX `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- TABLE: media_uploads
-- ========================================
CREATE TABLE IF NOT EXISTS `media_uploads` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `file_name` VARCHAR(255) NOT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `file_type` VARCHAR(50) NOT NULL,
  `file_size` BIGINT UNSIGNED NOT NULL,
  `mime_type` VARCHAR(100) NOT NULL,
  `uploaded_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_user_id` (`user_id`),
  INDEX `idx_file_type` (`file_type`),
  CONSTRAINT `fk_media_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- TABLE: notifications
-- ========================================
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `admin_id` INT UNSIGNED DEFAULT NULL,
  `title` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `type` ENUM('info', 'success', 'warning', 'error') DEFAULT 'info',
  `is_read` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_user_id` (`user_id`),
  INDEX `idx_admin_id` (`admin_id`),
  INDEX `idx_is_read` (`is_read`),
  CONSTRAINT `fk_notification_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_notification_admin` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- TABLE: comments (for testimonials)
-- ========================================
CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `testimonial_id` INT UNSIGNED NOT NULL,
  `user_name` VARCHAR(100) DEFAULT 'Anonymous',
  `comment_text` TEXT NOT NULL,
  `is_approved` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_testimonial_id` (`testimonial_id`),
  INDEX `idx_is_approved` (`is_approved`),
  CONSTRAINT `fk_comment_testimonial` FOREIGN KEY (`testimonial_id`) REFERENCES `testimonials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- TABLE: analytics
-- ========================================
CREATE TABLE IF NOT EXISTS `analytics` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_url` VARCHAR(255) NOT NULL,
  `visitor_ip` VARCHAR(45) DEFAULT NULL,
  `user_agent` TEXT DEFAULT NULL,
  `referrer` VARCHAR(255) DEFAULT NULL,
  `session_id` VARCHAR(100) DEFAULT NULL,
  `visited_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_page_url` (`page_url`),
  INDEX `idx_visited_at` (`visited_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- INSERT DEFAULT ADMIN USER
-- ========================================
-- Password: admin123 (hashed with password_hash in PHP)
INSERT INTO `admins` (`username`, `email`, `password_hash`, `full_name`, `permissions`) VALUES
('admin', 'admin@humanitarian.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', '{"manage_users": true, "manage_donations": true, "manage_testimonials": true, "view_analytics": true}');

-- ========================================
-- INSERT SAMPLE TESTIMONIALS
-- ========================================
INSERT INTO `testimonials` (`first_name`, `country`, `help_type`, `description`, `video_path`, `thumbnail_path`, `duration`, `is_featured`, `is_active`) VALUES
('Marie', 'France', 'medical', 'Grâce à cette fondation, j''ai pu recevoir les soins médicaux dont j''avais désespérément besoin.', 'assets/videos/testimonial1.mp4', 'assets/images/thumb1.jpg', 45, 1, 1),
('Ahmed', 'Morocco', 'food', 'Ma famille et moi avons reçu une aide alimentaire qui nous a sauvés pendant les moments difficiles.', 'assets/videos/testimonial2.mp4', 'assets/images/thumb2.jpg', 38, 1, 1),
('Sophie', 'Belgium', 'financial', 'L''aide financière m''a permis de recommencer ma vie et de trouver un logement stable.', 'assets/videos/testimonial3.mp4', 'assets/images/thumb3.jpg', 52, 0, 1),
('Jean', 'Canada', 'social', 'Le soutien social m''a aidé à retrouver confiance en moi et à reconstruire ma vie.', 'assets/videos/testimonial4.mp4', 'assets/images/thumb4.jpg', 41, 1, 1);

COMMIT;
