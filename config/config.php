<?php

// Detect if running on built-in server
if (php_sapi_name() === 'cli-server') {
    define('BASE_URL', 'http://localhost:8001');
} else {
    define('BASE_URL', 'http://localhost/satker-ppbj/public');
}

define('APP_NAME', 'SATKER-PPBJ Management System');

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS

session_start();