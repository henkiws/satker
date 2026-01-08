<?php

// Handle PHP built-in server
if (php_sapi_name() === 'cli-server') {
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

// Load configuration first
require_once '../config/config.php';
require_once '../config/database.php';

// Load helpers BEFORE controllers (important!)
require_once '../helpers/Auth.php';
require_once '../helpers/Helper.php';

// Load core files
require_once '../core/Database.php';
require_once '../core/Model.php';
require_once '../core/Controller.php';
require_once '../core/App.php';

// Load BaseController
require_once '../app/controllers/BaseController.php';

// Start the application
$app = new App();