<?php
/**
 * Global Application Configuration
 * Makeup.mahadev SaaS System
 */

// Environment & Debug Settings
define('APP_ENV', 'development'); // development or production
define('APP_DEBUG', true);

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// System Paths
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__DIR__));
define('APP_DIR', ROOT_DIR . DS . 'app');
define('PUBLIC_DIR', ROOT_DIR . DS . 'public');
define('UPLOAD_DIR', PUBLIC_DIR . DS . 'uploads');

// Dynamic Base URL Detection
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$baseUrl = rtrim($protocol . '://' . $host . $scriptName, '/');
// If script name ends with /public, trim it for clean root URLs if rewrite is enabled
if (substr($baseUrl, -7) === '/public') {
    $baseUrl = substr($baseUrl, 0, -7);
}
define('BASE_URL', $baseUrl);

// Database Configuration
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'makeup_mahadev');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Session Configuration
define('SESSION_NAME', 'MAKEUP_MAHADEV_SESS');
define('SESSION_LIFETIME', 86400); // 24 hours

// Upload Settings
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB limit
define('ALLOWED_IMAGE_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']);

// Default Admin Prefix
define('ADMIN_PREFIX', '/admin');
