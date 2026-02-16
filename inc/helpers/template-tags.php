<?php
/**
 * Template Tags & Helper Functions
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Default primary menu (fallback)
 */
function rise_ai_default_primary_menu() {
    $menu_items = array(
        'about'      => __('About', 'rise-ai-summit'),
        'tracks'     => __('Tracks', 'rise-ai-summit'),
        'agenda'     => __('Agenda', 'rise-ai-summit'),
        'speakers'   => __('Speakers', 'rise-ai-summit'),
        'research'   => __('Research', 'rise-ai-summit'),
        'logistics'  => __('Logistics', 'rise-ai-summit'),
        'team'       => __('People', 'rise-ai-summit'),
    );
    
    echo '<ul class="flex space-x-2 lg:space-x-6 items-center">';
    foreach ($menu_items as $slug => $label) {
        $url = home_url('/' . $slug . '/');
        printf(
            '<li><a href="%s" class="hover:text-uandes-red transition px-2 py-1">%s</a></li>',
            esc_url($url),
            esc_html($label)
        );
    }
    echo '</ul>';
}

/**
 * Default mobile menu (fallback)
 */
function rise_ai_default_mobile_menu() {
    $menu_items = array(
        'about'      => __('About', 'rise-ai-summit'),
        'tracks'     => __('Tracks', 'rise-ai-summit'),
        'agenda'     => __('Agenda', 'rise-ai-summit'),
        'speakers'   => __('Speakers', 'rise-ai-summit'),
        'research'   => __('Research', 'rise-ai-summit'),
        'logistics'  => __('Logistics', 'rise-ai-summit'),
        'team'       => __('People', 'rise-ai-summit'),
    );
    
    foreach ($menu_items as $slug => $label) {
        $url = home_url('/' . $slug . '/');
        printf(
            '<a href="%s" onclick="toggleMobileMenu()" class="block w-full text-left py-2 border-b border-gray-100 text-nd-navy font-bold hover:text-uandes-red">%s</a>',
            esc_url($url),
            esc_html($label)
        );
    }
}

/**
 * ==============================================
 * URL HELPERS (Polylang compatible)
 * ==============================================
 */

/**
 * Get page URL by slug (Polylang compatible)
 * Returns the URL of a page in the current language
 * 
 * @param string $slug Page slug
 * @return string Page URL
 */
function rise_ai_get_page_url_by_slug($slug) {
    
    // Try to get page by slug in current language
    if (function_exists('pll_current_language')) {
        $lang = pll_current_language();
        
        // Get page by slug
        $page = get_page_by_path($slug);
        
        if ($page) {
            // Get translated version if exists
            if (function_exists('pll_get_post')) {
                $translated_id = pll_get_post($page->ID, $lang);
                if ($translated_id) {
                    return get_permalink($translated_id);
                }
            }
            return get_permalink($page->ID);
        }
    } else {
        // Polylang not active, use standard method
        $page = get_page_by_path($slug);
        if ($page) {
            return get_permalink($page->ID);
        }
    }
    
    // Fallback to home URL
    return home_url('/');
}

/**
 * Get page URL by ID (Polylang compatible)
 * 
 * @param int $page_id Page ID
 * @return string Page URL
 */
function rise_ai_get_page_url($page_id) {
    
    if (function_exists('pll_get_post')) {
        $lang = pll_current_language();
        $translated_id = pll_get_post($page_id, $lang);
        
        if ($translated_id) {
            return get_permalink($translated_id);
        }
    }
    
    return get_permalink($page_id);
}

/**
 * Get CPT archive URL (Polylang compatible)
 * 
 * @param string $post_type CPT slug
 * @return string Archive URL
 */
function rise_ai_get_cpt_url($post_type) {
    
    $url = get_post_type_archive_link($post_type);
    
    // Polylang adds language to archive URLs automatically
    return $url ? $url : home_url('/');
}

/**
 * Output translated page link
 * Usage: rise_ai_page_link('about', 'Learn More');
 * 
 * @param string $slug Page slug
 * @param string $text Link text
 * @param array $classes CSS classes
 */
function rise_ai_page_link($slug, $text, $classes = array()) {
    $url = rise_ai_get_page_url_by_slug($slug);
    $class_string = !empty($classes) ? ' class="' . esc_attr(implode(' ', $classes)) . '"' : '';
    
    echo '<a href="' . esc_url($url) . '"' . $class_string . '>' . esc_html($text) . '</a>';
}