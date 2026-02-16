<?php
/**
 * Polylang String Registration
 * Register dynamic strings for translation
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Register strings with Polylang
 * These strings can then be translated in Settings > Languages > String translations
 */
function rise_register_polylang_strings() {
    
    if (!function_exists('pll_register_string')) {
        return;
    }
    
    // ===== NAVIGATION =====
    pll_register_string('nav_about', 'About', 'rise-ai-summit');
    pll_register_string('nav_tracks', 'Tracks', 'rise-ai-summit');
    pll_register_string('nav_agenda', 'Agenda', 'rise-ai-summit');
    pll_register_string('nav_speakers', 'Speakers', 'rise-ai-summit');
    pll_register_string('nav_research', 'Research', 'rise-ai-summit');
    pll_register_string('nav_logistics', 'Logistics', 'rise-ai-summit');
    pll_register_string('nav_people', 'People', 'rise-ai-summit');
    pll_register_string('nav_sponsor', 'Sponsor', 'rise-ai-summit');
    
    // ===== CTAs =====
    pll_register_string('cta_submit_abstract', 'Submit Abstract', 'rise-ai-summit');
    pll_register_string('cta_register', 'Register', 'rise-ai-summit');
    pll_register_string('cta_sponsor', 'Become a Sponsor', 'rise-ai-summit');
    pll_register_string('cta_explore_tracks', 'Explore Tracks', 'rise-ai-summit');
    pll_register_string('cta_call_for_abstracts', 'Call for Abstracts', 'rise-ai-summit');
    pll_register_string('cta_read_more', 'Read More', 'rise-ai-summit');
    pll_register_string('cta_view_all', 'View All', 'rise-ai-summit');
    pll_register_string('cta_download', 'Download', 'rise-ai-summit');
    
    // ===== TRACK NAMES =====
    pll_register_string('track_business', 'Business', 'rise-ai-summit');
    pll_register_string('track_education', 'Education', 'rise-ai-summit');
    pll_register_string('track_science', 'Applied Science', 'rise-ai-summit');
    
    // ===== FORM LABELS =====
    pll_register_string('form_first_name', 'First Name', 'rise-ai-summit');
    pll_register_string('form_last_name', 'Last Name', 'rise-ai-summit');
    pll_register_string('form_email', 'Email', 'rise-ai-summit');
    pll_register_string('form_phone', 'Phone', 'rise-ai-summit');
    pll_register_string('form_institution', 'Institution', 'rise-ai-summit');
    pll_register_string('form_country', 'Country', 'rise-ai-summit');
    pll_register_string('form_message', 'Message', 'rise-ai-summit');
    pll_register_string('form_submit', 'Submit', 'rise-ai-summit');
    pll_register_string('form_required', 'Required', 'rise-ai-summit');
    
    // ===== COMMON PHRASES =====
    pll_register_string('common_loading', 'Loading...', 'rise-ai-summit');
    pll_register_string('common_success', 'Success!', 'rise-ai-summit');
    pll_register_string('common_error', 'Error', 'rise-ai-summit');
    pll_register_string('common_learn_more', 'Learn More', 'rise-ai-summit');
    pll_register_string('common_contact_us', 'Contact Us', 'rise-ai-summit');
    
    // ===== DATES =====
    pll_register_string('date_october_2026', 'October 2026', 'rise-ai-summit');
    pll_register_string('date_santiago_chile', 'Santiago, Chile', 'rise-ai-summit');
    
    // ===== FOOTER =====
    pll_register_string('footer_copyright', '2026 RISE AI South America Summit. All rights reserved.', 'rise-ai-summit');
    pll_register_string('footer_global_series', 'Part of the RISE AI Global Series', 'rise-ai-summit');
}
add_action('init', 'rise_register_polylang_strings');

/**
 * Helper function to output Polylang string
 * Usage: rise_pll_e('nav_about');
 */
function rise_pll_e($string_name) {
    if (function_exists('pll_e')) {
        pll_e($string_name);
    } else {
        // Fallback if Polylang not active
        _e($string_name, 'rise-ai-summit');
    }
}

/**
 * Helper function to get Polylang string
 * Usage: $text = rise_pll__('nav_about');
 */
function rise_pll__($string_name) {
    if (function_exists('pll__')) {
        return pll__($string_name);
    } else {
        // Fallback if Polylang not active
        return __($string_name, 'rise-ai-summit');
    }
}