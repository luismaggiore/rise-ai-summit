<?php
/**
 * Enqueue Scripts and Styles
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Enqueue frontend scripts and styles
 */
function rise_ai_enqueue_scripts() {
    
    /**
     * Google Fonts: Montserrat + Merriweather
     */
    wp_enqueue_style(
        'rise-ai-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400&display=swap',
        array(),
        null
    );
    
    /**
     * Font Awesome 6.4.0
     */
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
    
    /**
     * Tailwind CSS Script (not stylesheet)
     */
    wp_enqueue_script(
        'tailwind-css',
        'https://cdn.tailwindcss.com',
        array(),
        null,
        false // Load in header
    );
    
    /**
     * Tailwind Configuration (must load AFTER Tailwind)
     */
    $tailwind_config = "
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'uandes-red': '#E31837',
                        'uandes-dark': '#333333',
                        'nd-navy': '#0C2340',
                        'nd-gold': '#AE9142',
                        'nd-gold-light': '#D39F10',
                        'light-gray': '#F8F9FA',
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                        serif: ['Merriweather', 'serif'],
                    },
                    backgroundImage: {
                        'hero-gradient': 'radial-gradient(circle at 70% 50%, #1a3b66 0%, #0C2340 60%)',
                    }
                }
            }
        }
    ";
    wp_add_inline_script('tailwind-css', $tailwind_config);
    
    /**
     * Custom CSS
     */
    wp_enqueue_style(
        'rise-ai-custom',
        get_template_directory_uri() . '/assets/css/custom.css',
        array(),
        '1.0.0'
    );
    
    /**
     * Main JavaScript
     */
    wp_enqueue_script(
        'rise-ai-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'rise_ai_enqueue_scripts');

/**
 * Enqueue admin scripts and styles
 */
function rise_ai_admin_enqueue_scripts($hook) {
    
    // Only load on post edit screens
    if ('post.php' === $hook || 'post-new.php' === $hook) {
        
        wp_enqueue_media();
        
        wp_enqueue_script(
            'rise-ai-admin',
            get_template_directory_uri() . '/assets/js/admin.js',
            array('jquery'),
            '1.0.0',
            true
        );
        
        wp_enqueue_style(
            'rise-ai-admin-css',
            get_template_directory_uri() . '/assets/css/admin.css',
            array(),
            '1.0.0'
        );
    }
}
add_action('admin_enqueue_scripts', 'rise_ai_admin_enqueue_scripts');