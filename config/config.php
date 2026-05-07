<?php
/**
 * Main Configuration File
 * Humanitarian Platform 2026
 */

// Application Root
define('APP_ROOT', dirname(__DIR__));
define('APP_URL', 'http://localhost:8000'); // Change in production
define('APP_NAME', 'Humanitarian Foundation 2026');

// Environment
define('ENVIRONMENT', 'development'); // development | production
define('DEBUG_MODE', ENVIRONMENT === 'development');

// Security
define('SECRET_KEY', getenv('SECRET_KEY') ?: bin2hex(random_bytes(32)));
define('SESSION_LIFETIME', 3600); // 1 hour
define('MAX_UPLOAD_SIZE', 50 * 1024 * 1024); // 50MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'webm', 'pdf']);

// Paths
define('UPLOAD_DIR', APP_ROOT . '/assets/uploads/');
define('VIDEO_DIR', APP_ROOT . '/assets/videos/');
define('IMAGE_DIR', APP_ROOT . '/assets/images/');

// Timezone
date_default_timezone_set('UTC');

// Error Reporting
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.gc_maxlifetime', SESSION_LIFETIME);

// Load Database Config
$db_config = require_once __DIR__ . '/database.php';
define('DB_CONFIG', $db_config);

// Autoloader
spl_autoload_register(function ($class) {
    $paths = [
        APP_ROOT . '/includes/',
        APP_ROOT . '/components/',
        APP_ROOT . '/admin/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Helper Functions
require_once __DIR__ . '/helpers.php';
