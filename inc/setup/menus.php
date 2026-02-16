<?php
/**
 * Register Navigation Menus
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Register navigation menus
 */
function rise_ai_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu (Desktop Navigation)', 'rise-ai-summit'),
        'footer'  => __('Footer Menu', 'rise-ai-summit'),
        'mobile'  => __('Mobile Menu', 'rise-ai-summit'),
    ));
}
add_action('after_setup_theme', 'rise_ai_register_menus');