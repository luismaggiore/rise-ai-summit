<?php
/**
 * Theme Setup Functions
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function rise_ai_theme_setup() {
    
    /**
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('rise-ai-summit', RISE_AI_DIR . '/languages');
    
    /**
     * Let WordPress manage the document title.
     */
    add_theme_support('title-tag');
    
    /**
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support('post-thumbnails');
    
    /**
     * Set default post thumbnail size
     */
    set_post_thumbnail_size(1200, 630, true);
    
    /**
     * Add custom image sizes for different CPTs
     */
    add_image_size('speaker-photo', 400, 500, true);      // Speaker photos (4:5 ratio)
    add_image_size('sponsor-logo', 300, 150, false);      // Sponsor logos (preserve aspect)
    add_image_size('committee-photo', 200, 200, true);    // Committee photos (square)
    add_image_size('blog-featured', 800, 450, true);      // Blog featured images (16:9)
    add_image_size('hero-banner', 1920, 800, true);       // Hero banners
    
    /**
     * Switch default core markup to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ));
    
    /**
     * Add support for responsive embedded content.
     */
    add_theme_support('responsive-embeds');
    
    /**
     * Add support for editor styles.
     */
    add_theme_support('editor-styles');
    
    /**
     * Add support for wide alignment
     */
    add_theme_support('align-wide');
    
    /**
     * Add support for custom line height
     */
    add_theme_support('custom-line-height');
    
    /**
     * Add support for custom spacing
     */
    add_theme_support('custom-spacing');
}
add_action('after_setup_theme', 'rise_ai_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function rise_ai_content_width() {
    $GLOBALS['content_width'] = apply_filters('rise_ai_content_width', 1200);
}
add_action('after_setup_theme', 'rise_ai_content_width', 0);

/**
 * Add custom image size names for use in media library
 */
function rise_ai_custom_image_sizes($sizes) {
    return array_merge($sizes, array(
        'speaker-photo' => __('Speaker Photo', 'rise-ai-summit'),
        'sponsor-logo' => __('Sponsor Logo', 'rise-ai-summit'),
        'committee-photo' => __('Committee Photo', 'rise-ai-summit'),
        'blog-featured' => __('Blog Featured', 'rise-ai-summit'),
        'hero-banner' => __('Hero Banner', 'rise-ai-summit'),
    ));
}
add_filter('image_size_names_choose', 'rise_ai_custom_image_sizes');