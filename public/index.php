<?php
/**
 * Front Controller Entry Point
 * Makeup.mahadev SaaS Engine
 */

// Load Configuration
require_once dirname(__DIR__) . '/config/config.php';

// Register PSR-4 Custom Autoloader
require_once APP_DIR . '/Core/Autoloader.php';
App\Core\Autoloader::register();

// Start Session Manager & Init Application Core Engine
App\Core\Session::init();
$app = new App\Core\App();
$app->run();
