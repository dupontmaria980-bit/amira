<?php
/**
 * Admin Logout - Humanitarian Platform 2026
 */

session_start();
require_once __DIR__ . '/../config/config.php';

// Log activity
log_activity('admin_logout', ['admin_id' => $_SESSION['admin_id'] ?? null]);

// Destroy session
session_destroy();

// Redirect to login
header('Location: /admin/login.php');
exit;
