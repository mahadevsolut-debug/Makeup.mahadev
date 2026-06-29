-- Makeup.mahadev SaaS Database Schema
-- Compatible with MySQL 5.7+ and MySQL 8.0+

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `booking_addons`;
DROP TABLE IF EXISTS `bookings`;
DROP TABLE IF EXISTS `service_addons`;
DROP TABLE IF EXISTS `service_packages`;
DROP TABLE IF EXISTS `services`;
DROP TABLE IF EXISTS `service_categories`;
DROP TABLE IF EXISTS `portfolio_images`;
DROP TABLE IF EXISTS `portfolio`;
DROP TABLE IF EXISTS `blogs`;
DROP TABLE IF EXISTS `blog_categories`;
DROP TABLE IF EXISTS `reviews`;
DROP TABLE IF EXISTS `gallery`;
DROP TABLE IF EXISTS `team`;
DROP TABLE IF EXISTS `faq`;
DROP TABLE IF EXISTS `settings`;
DROP TABLE IF EXISTS `users`;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. Users / Admin Authentication
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'staff') DEFAULT 'admin',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Service Categories
CREATE TABLE `service_categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(120) NOT NULL UNIQUE,
  `description` TEXT NULL,
  `sort_order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Services Core Table
CREATE TABLE `services` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NULL,
  `title` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(180) NOT NULL UNIQUE,
  `description` TEXT NOT NULL,
  `cover_image` VARCHAR(255) NULL,
  `duration` VARCHAR(50) DEFAULT '2 Hours',
  `pricing_type` ENUM('simple', 'package') DEFAULT 'package',
  `simple_price` DECIMAL(10, 2) DEFAULT 0.00,
  `status` ENUM('active', 'hidden') DEFAULT 'active',
  `is_featured` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `service_categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Service Packages (Dynamic Tiered Pricing)
CREATE TABLE `service_packages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `service_id` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL, -- e.g., Basic, Silver, Gold, Premium
  `price` DECIMAL(10, 2) NOT NULL,
  `description` TEXT NULL,
  `is_popular` TINYINT(1) DEFAULT 0,
  `sort_order` INT DEFAULT 0,
  FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Service Add-ons
CREATE TABLE `service_addons` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `service_id` INT NULL, -- NULL means global addon applicable to all services
  `name` VARCHAR(120) NOT NULL, -- e.g., Hair Styling, Saree Draping, Travel Fee
  `price` DECIMAL(10, 2) NOT NULL,
  `description` TEXT NULL,
  `status` ENUM('active', 'hidden') DEFAULT 'active',
  FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Booking / Service Requests
CREATE TABLE `bookings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `booking_code` VARCHAR(20) NOT NULL UNIQUE,
  `customer_name` VARCHAR(100) NOT NULL,
  `customer_email` VARCHAR(150) NOT NULL,
  `customer_phone` VARCHAR(30) NOT NULL,
  `event_date` DATE NOT NULL,
  `event_time` TIME NOT NULL,
  `location` TEXT NOT NULL,
  `service_id` INT NOT NULL,
  `package_id` INT NULL,
  `base_price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  `addons_total` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  `total_price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  `notes` TEXT NULL,
  `status` ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`package_id`) REFERENCES `service_packages`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Booking Add-ons Pivot Table
CREATE TABLE `booking_addons` (
  `booking_id` INT NOT NULL,
  `addon_id` INT NOT NULL,
  `price_at_booking` DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (`booking_id`, `addon_id`),
  FOREIGN KEY (`booking_id`) REFERENCES `bookings`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`addon_id`) REFERENCES `service_addons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Portfolio Items
CREATE TABLE `portfolio` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,
  `category` VARCHAR(50) NOT NULL DEFAULT 'Bridal', -- Bridal, Party, Fashion, Celebrity
  `client_name` VARCHAR(100) NULL,
  `event_date` DATE NULL,
  `cover_image` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `sort_order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 9. Portfolio Extra Media Gallery
CREATE TABLE `portfolio_images` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `portfolio_id` INT NOT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `media_type` ENUM('image', 'video') DEFAULT 'image',
  `sort_order` INT DEFAULT 0,
  FOREIGN KEY (`portfolio_id`) REFERENCES `portfolio`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 10. Blog Categories
CREATE TABLE `blog_categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(120) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 11. Blog Posts CMS
CREATE TABLE `blogs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NULL,
  `title` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(220) NOT NULL UNIQUE,
  `content` LONGTEXT NOT NULL,
  `featured_image` VARCHAR(255) NULL,
  `meta_title` VARCHAR(200) NULL,
  `meta_description` TEXT NULL,
  `status` ENUM('draft', 'published') DEFAULT 'published',
  `views_count` INT DEFAULT 0,
  `published_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `blog_categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 12. Reviews & Testimonials
CREATE TABLE `reviews` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `client_name` VARCHAR(100) NOT NULL,
  `client_role` VARCHAR(100) DEFAULT 'Happy Bride',
  `client_avatar` VARCHAR(255) NULL,
  `rating` TINYINT(1) DEFAULT 5,
  `review_text` TEXT NOT NULL,
  `is_featured` TINYINT(1) DEFAULT 0,
  `status` ENUM('pending', 'approved') DEFAULT 'approved',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 13. Before/After & Standalone Gallery
CREATE TABLE `gallery` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,
  `before_image` VARCHAR(255) NULL,
  `after_image` VARCHAR(255) NOT NULL,
  `category` VARCHAR(50) DEFAULT 'Transformation',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 14. Team Members / Artists
CREATE TABLE `team` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `designation` VARCHAR(100) NOT NULL DEFAULT 'Senior Makeup Artist',
  `photo` VARCHAR(255) NULL,
  `bio` TEXT NULL,
  `instagram_url` VARCHAR(255) NULL,
  `sort_order` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 15. FAQ Manager
CREATE TABLE `faq` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `question` VARCHAR(255) NOT NULL,
  `answer` TEXT NOT NULL,
  `category` VARCHAR(50) DEFAULT 'General',
  `sort_order` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 16. Website Dynamic Settings (Key-Value Store)
CREATE TABLE `settings` (
  `setting_key` VARCHAR(100) PRIMARY KEY,
  `setting_value` LONGTEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
