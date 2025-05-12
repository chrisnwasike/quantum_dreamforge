<?php
// Start session
session_start();

// Load configuration
require_once 'config/constants.php';
require_once 'config/app.php';
require_once 'config/db.php';

// Load essential utilities
require_once 'utils/SecurityUtils.php';
require_once 'utils/LoggerUtils.php';

// Error handling
require_once 'includes/error_handling.php';

// Set up database connection
require_once 'db/Database.php';
$db = new Database();
$conn = $db->getConnection();

// Simple routing system
require_once 'config/routes.php';
$router = new Router();

// Get the requested URL
$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Route the request
$router->route($url);
?>