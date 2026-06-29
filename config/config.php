<?php
/**
 * Global Application Configuration
 * Makeup.mahadev SaaS System
 */

// System Paths
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__DIR__));
define('APP_DIR', ROOT_DIR . DS . 'app');
define('PUBLIC_DIR', ROOT_DIR . DS . 'public');
define('UPLOAD_DIR', PUBLIC_DIR . DS . 'uploads');

// Load .env file if it exists
$envFile = ROOT_DIR . DS . '.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $name = trim($parts[0]);
            $value = trim($parts[1]);
            // Strip quotes if present
            if (preg_match('/^"([^"]*)"$/', $value, $matches) || preg_match("/^'([^']*)'$/", $value, $matches)) {
                $value = $matches[1];
            }
            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}

// Env helper function
if (!function_exists('env')) {
    function env($key, $default = null) {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        if ($value === 'true') return true;
        if ($value === 'false') return false;
        if ($value === 'null') return null;
        return $value;
    }
}

// Environment & Debug Settings
define('APP_ENV', env('APP_ENV', 'development'));
define('APP_DEBUG', env('APP_DEBUG', true));

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

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
define('DB_HOST', env('DB_HOST', '127.0.0.1'));
define('DB_PORT', env('DB_PORT', '3306'));
define('DB_NAME', env('DB_NAME', 'makeup_mahadev'));
define('DB_USER', env('DB_USER', 'root'));
define('DB_PASS', env('DB_PASS', ''));
define('DB_CHARSET', env('DB_CHARSET', 'utf8mb4'));

// Session Configuration
define('SESSION_NAME', env('SESSION_NAME', 'MAKEUP_MAHADEV_SESS'));
define('SESSION_LIFETIME', env('SESSION_LIFETIME', 86400)); // 24 hours

// Upload Settings
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB limit
define('ALLOWED_IMAGE_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']);

// Default Admin Prefix
define('ADMIN_PREFIX', '/admin');
