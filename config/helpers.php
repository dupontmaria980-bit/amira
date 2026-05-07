<?php
/**
 * Helper Functions
 * Humanitarian Platform 2026
 */

/**
 * Sanitize input data
 */
function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Generate CSRF token
 */
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Redirect with message
 */
function redirect($url, $message = null, $type = 'success') {
    if ($message) {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }
    header("Location: " . $url);
    exit;
}

/**
 * Get flash message
 */
function get_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        $type = $_SESSION['flash_type'] ?? 'info';
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
        return ['message' => $message, 'type' => $type];
    }
    return null;
}

/**
 * Format date
 */
function format_date($date, $format = 'd/m/Y H:i') {
    return date($format, strtotime($date));
}

/**
 * Format number with spaces
 */
function format_number($number) {
    return number_format($number, 0, ',', ' ');
}

/**
 * Get file extension
 */
function get_file_extension($filename) {
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

/**
 * Validate file upload
 */
function validate_upload($file) {
    $allowed = ALLOWED_EXTENSIONS;
    $ext = get_file_extension($file['name']);
    
    if (!in_array($ext, $allowed)) {
        return ['valid' => false, 'error' => 'File type not allowed'];
    }
    
    if ($file['size'] > MAX_UPLOAD_SIZE) {
        return ['valid' => false, 'error' => 'File too large'];
    }
    
    return ['valid' => true];
}

/**
 * Secure file upload
 */
function upload_file($file, $directory = UPLOAD_DIR) {
    $validation = validate_upload($file);
    if (!$validation['valid']) {
        return $validation;
    }
    
    $ext = get_file_extension($file['name']);
    $filename = uniqid() . '_' . time() . '.' . $ext;
    $filepath = $directory . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return ['valid' => true, 'path' => $filepath, 'filename' => $filename];
    }
    
    return ['valid' => false, 'error' => 'Upload failed'];
}

/**
 * Get client IP
 */
function get_client_ip() {
    $ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    }
    return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
}

/**
 * Check if request is AJAX
 */
function is_ajax() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

/**
 * JSON response
 */
function json_response($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

/**
 * Rate limiting
 */
function rate_limit($key, $limit = 10, $timeframe = 3600) {
    $session_key = 'rate_limit_' . md5($key);
    $now = time();
    
    if (!isset($_SESSION[$session_key])) {
        $_SESSION[$session_key] = ['count' => 0, 'reset' => $now + $timeframe];
    }
    
    if ($now > $_SESSION[$session_key]['reset']) {
        $_SESSION[$session_key] = ['count' => 0, 'reset' => $now + $timeframe];
    }
    
    $_SESSION[$session_key]['count']++;
    
    return $_SESSION[$session_key]['count'] <= $limit;
}

/**
 * Send notification email (placeholder)
 */
function send_email($to, $subject, $body) {
    // Implement with PHPMailer or similar in production
    return mail($to, $subject, $body);
}

/**
 * Log activity
 */
function log_activity($action, $details = []) {
    $log_file = APP_ROOT . '/logs/activity.log';
    $timestamp = date('Y-m-d H:i:s');
    $ip = get_client_ip();
    $user = $_SESSION['admin_username'] ?? 'guest';
    
    $log_entry = sprintf(
        "[%s] %s - User: %s - IP: %s - Action: %s - Details: %s\n",
        $timestamp,
        ENVIRONMENT,
        $user,
        $ip,
        $action,
        json_encode($details)
    );
    
    file_put_contents($log_file, $log_entry, FILE_APPEND);
}

/**
 * Anti-spam check (simple honeypot)
 */
function check_spam($data) {
    // Check for honeypot field
    if (!empty($data['website']) || !empty($data['honeypot'])) {
        return true;
    }
    
    // Check for suspicious patterns
    $suspicious_patterns = [
        '/viagra|cialis|casino|lottery/i',
        '/http:\/\/|https:\/\//i',
        '/^\w+@\w+\.\w+$/' // Email in name field
    ];
    
    foreach ($suspicious_patterns as $pattern) {
        if (preg_match($pattern, implode(' ', $data))) {
            return true;
        }
    }
    
    return false;
}

/**
 * Get help type label
 */
function get_help_type_label($type) {
    $labels = [
        'financial' => 'Aide Financière',
        'medical' => 'Aide Médicale',
        'food' => 'Aide Alimentaire',
        'social' => 'Soutien Social',
        'other' => 'Autre'
    ];
    return $labels[$type] ?? $type;
}

/**
 * Format currency
 */
function format_currency($amount, $currency = '€') {
    return number_format($amount, 2, ',', ' ') . ' ' . $currency;
}
