<?php
/**
 * RISE AI Summit Theme Functions
 * 
 * @package RISE_AI_Summit
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme version
 */
define('RISE_AI_VERSION', '1.0.0');

/**
 * Theme directory path
 */
define('RISE_AI_DIR', get_template_directory());

/**
 * Theme directory URI
 */
define('RISE_AI_URI', get_template_directory_uri());

/**
 * =================================================================
 * 1. SETUP & CONFIGURATION
 * =================================================================
 */
require_once RISE_AI_DIR . '/inc/setup/theme-setup.php';
require_once RISE_AI_DIR . '/inc/setup/enqueue-scripts.php';
require_once RISE_AI_DIR . '/inc/setup/menus.php';

/**
 * =================================================================
 * 2. CUSTOM POST TYPES (Coming in Phase 2)
 * =================================================================
 */
require_once RISE_AI_DIR . '/inc/cpts/cpt-speakers.php';
require_once RISE_AI_DIR . '/inc/cpts/cpt-sponsors.php';
require_once RISE_AI_DIR . '/inc/cpts/cpt-committee.php';
require_once RISE_AI_DIR . '/inc/cpts/cpt-abstracts.php';
require_once RISE_AI_DIR . '/inc/cpts/cpt-registrations.php';
require_once RISE_AI_DIR . '/inc/cpts/cpt-sponsor-inquiries.php';
require_once get_template_directory() . '/inc/cpts/cpt-research.php'; // ← AGREGAR ESTA LÍNEA

/**
 * =================================================================
 * 3. METABOXES (Coming in Phase 3)
 * =================================================================
 */
require_once RISE_AI_DIR . '/inc/metaboxes/metabox-speakers.php';
require_once RISE_AI_DIR . '/inc/metaboxes/metabox-sponsors.php';
require_once RISE_AI_DIR . '/inc/metaboxes/metabox-committee.php';
 require_once RISE_AI_DIR . '/inc/metaboxes/metabox-abstracts.php';
 require_once RISE_AI_DIR . '/inc/metaboxes/metabox-registrations.php';
 require_once RISE_AI_DIR . '/inc/metaboxes/metabox-sponsor-inquiries.php';
require_once RISE_AI_DIR . '/inc/metaboxes/metabox-home.php';
require_once RISE_AI_DIR . '/inc/metaboxes/metabox-tracks.php';
require_once RISE_AI_DIR . '/inc/metaboxes/metabox-agenda.php';
require_once get_template_directory() . '/inc/metaboxes/metabox-research.php'; // ← AGREGAR ESTA LÍNEA


/**
 * =================================================================
 * 4. FORMS & PROCESSING (Coming in Phase 6)
 * =================================================================
 */
require_once RISE_AI_DIR . '/inc/form-handlers.php';
require_once RISE_AI_DIR . '/inc/email-notifications.php';

/**
 * =================================================================
 * 5. ADMIN CUSTOMIZATION (Coming in Phase 7)
 * =================================================================
 */
require_once RISE_AI_DIR . '/inc/admin-columns.php';
require_once RISE_AI_DIR . '/inc/csv-export.php';
require_once RISE_AI_DIR . '/inc/admin-dashboard.php';

/**
 * =================================================================
 * 6. TRANSLATION SUPPORT (Coming in Phase 8)
 * =================================================================
 */
require_once RISE_AI_DIR . '/inc/polylang-strings.php';

/**
 * =================================================================
 * 7. HELPER FUNCTIONS
 * =================================================================
 */
require_once RISE_AI_DIR . '/inc/helpers/template-tags.php';
require_once RISE_AI_DIR . '/inc/helpers/custom-functions.php';

