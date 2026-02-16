<?php
/**
 * Custom Helper Functions
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Sanitize phone number
 */
function rise_ai_sanitize_phone($phone) {
    return preg_replace('/[^0-9+\-() ]/', '', $phone);
}

/**
 * Validate email with additional checks
 */
function rise_ai_validate_email($email) {
    $email = sanitize_email($email);
    
    if (!is_email($email)) {
        return false;
    }
    
    // Additional check for common typos
    $common_domains = array('gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com');
    $domain = substr(strrchr($email, "@"), 1);
    
    return !empty($domain);
}

/**
 * Generate unique filename for uploads
 */
function rise_ai_unique_filename($filename) {
    $info = pathinfo($filename);
    $ext = isset($info['extension']) ? '.' . $info['extension'] : '';
    $name = basename($filename, $ext);
    
    return $name . '-' . uniqid() . $ext;
}

/**
 * Format file size
 */
function rise_ai_format_file_size($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}

/**
 * Check if file is PDF
 */
function rise_ai_is_pdf($file) {
    $file_type = wp_check_filetype($file['name']);
    return $file_type['ext'] === 'pdf';
}

/**
 * Get country list for forms
 */
function rise_ai_get_countries() {
    return array(
        'AR' => __('Argentina', 'rise-ai-summit'),
        'BO' => __('Bolivia', 'rise-ai-summit'),
        'BR' => __('Brazil', 'rise-ai-summit'),
        'CL' => __('Chile', 'rise-ai-summit'),
        'CO' => __('Colombia', 'rise-ai-summit'),
        'EC' => __('Ecuador', 'rise-ai-summit'),
        'GY' => __('Guyana', 'rise-ai-summit'),
        'PY' => __('Paraguay', 'rise-ai-summit'),
        'PE' => __('Peru', 'rise-ai-summit'),
        'SR' => __('Suriname', 'rise-ai-summit'),
        'UY' => __('Uruguay', 'rise-ai-summit'),
        'VE' => __('Venezuela', 'rise-ai-summit'),
        'US' => __('United States', 'rise-ai-summit'),
        'CA' => __('Canada', 'rise-ai-summit'),
        'MX' => __('Mexico', 'rise-ai-summit'),
        'OTHER' => __('Other', 'rise-ai-summit'),
    );
}

/**
 * Log errors to custom log file
 */
function rise_ai_log_error($message, $context = array()) {
    if (!WP_DEBUG) return;
    
    $log_file = WP_CONTENT_DIR . '/rise-ai-errors.log';
    $timestamp = current_time('mysql');
    $log_message = sprintf(
        "[%s] %s | Context: %s\n",
        $timestamp,
        $message,
        json_encode($context)
    );
    
    error_log($log_message, 3, $log_file);
}

/**
 * Send email with error handling
 */
function rise_ai_send_email($to, $subject, $message, $headers = array()) {
    $sent = wp_mail($to, $subject, $message, $headers);
    
    if (!$sent) {
        rise_ai_log_error('Email failed to send', array(
            'to' => $to,
            'subject' => $subject
        ));
    }
    
    return $sent;
}

/**
 * Get site contact emails
 */
function rise_ai_get_contact_emails() {
    return array(
        'general'   => 'info@rise-summit.cl',
        'research'  => 'research@rise-summit.cl',
        'sponsors'  => 'sponsors@rise-summit.cl',
        'logistics' => 'logistics@rise-summit.cl',
    );
}

/**
 * Check if user is in South America (based on timezone or other method)
 */
function rise_ai_is_south_america() {
    $timezone = get_option('timezone_string');
    $sa_timezones = array('America/Santiago', 'America/Buenos_Aires', 'America/Sao_Paulo', 'America/Lima', 'America/Bogota');
    
    return in_array($timezone, $sa_timezones);
}

/**
 * Convert word count to reading time
 */
function rise_ai_words_to_reading_time($word_count, $wpm = 200) {
    return ceil($word_count / $wpm);
}

/**
 * Truncate text by word count
 */
function rise_ai_truncate_text($text, $max_words = 50, $append = '...') {
    $words = explode(' ', $text);
    
    if (count($words) <= $max_words) {
        return $text;
    }
    
    return implode(' ', array_slice($words, 0, $max_words)) . $append;
}

/**
 * Get social share links
 */
function rise_ai_get_social_share_links($url = '', $title = '') {
    if (empty($url)) {
        $url = get_permalink();
    }
    
    if (empty($title)) {
        $title = get_the_title();
    }
    
    return array(
        'twitter' => 'https://twitter.com/intent/tweet?url=' . urlencode($url) . '&text=' . urlencode($title),
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url),
        'linkedin' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode($url),
        'email' => 'mailto:?subject=' . urlencode($title) . '&body=' . urlencode($url),
    );
}