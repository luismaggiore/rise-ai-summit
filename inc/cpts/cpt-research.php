<?php
/**
 * Custom Post Type: Research/Publications
 * For approved and published research submissions
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Register Research CPT
 */
function rise_register_research_cpt() {
    
    $labels = array(
        'name'                  => _x('Research', 'Post type general name', 'rise-ai-summit'),
        'singular_name'         => _x('Research', 'Post type singular name', 'rise-ai-summit'),
        'menu_name'             => _x('Research', 'Admin Menu text', 'rise-ai-summit'),
        'name_admin_bar'        => _x('Research', 'Add New on Toolbar', 'rise-ai-summit'),
        'add_new'               => __('Add New', 'rise-ai-summit'),
        'add_new_item'          => __('Add New Research', 'rise-ai-summit'),
        'new_item'              => __('New Research', 'rise-ai-summit'),
        'edit_item'             => __('Edit Research', 'rise-ai-summit'),
        'view_item'             => __('View Research', 'rise-ai-summit'),
        'all_items'             => __('All Research', 'rise-ai-summit'),
        'search_items'          => __('Search Research', 'rise-ai-summit'),
        'parent_item_colon'     => __('Parent Research:', 'rise-ai-summit'),
        'not_found'             => __('No research found.', 'rise-ai-summit'),
        'not_found_in_trash'    => __('No research found in Trash.', 'rise-ai-summit'),
        'featured_image'        => _x('Research Image', 'Overrides the "Featured Image" phrase', 'rise-ai-summit'),
        'set_featured_image'    => _x('Set research image', 'Overrides the "Set featured image" phrase', 'rise-ai-summit'),
        'remove_featured_image' => _x('Remove research image', 'Overrides the "Remove featured image" phrase', 'rise-ai-summit'),
        'use_featured_image'    => _x('Use as research image', 'Overrides the "Use as featured image" phrase', 'rise-ai-summit'),
        'archives'              => _x('Research archives', 'The post type archive label used in nav menus', 'rise-ai-summit'),
        'insert_into_item'      => _x('Insert into research', 'Overrides the "Insert into post" phrase', 'rise-ai-summit'),
        'uploaded_to_this_item' => _x('Uploaded to this research', 'Overrides the "Uploaded to this post" phrase', 'rise-ai-summit'),
        'filter_items_list'     => _x('Filter research list', 'Screen reader text for the filter links', 'rise-ai-summit'),
        'items_list_navigation' => _x('Research list navigation', 'Screen reader text for the pagination', 'rise-ai-summit'),
        'items_list'            => _x('Research list', 'Screen reader text for the items list', 'rise-ai-summit'),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'research'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-media-document',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );
    
    register_post_type('research', $args);
}
add_action('init', 'rise_register_research_cpt');

/**
 * Register Research Taxonomy (Research Track)
 */
function rise_register_research_taxonomy() {
    
    $labels = array(
        'name'              => _x('Research Tracks', 'taxonomy general name', 'rise-ai-summit'),
        'singular_name'     => _x('Research Track', 'taxonomy singular name', 'rise-ai-summit'),
        'search_items'      => __('Search Tracks', 'rise-ai-summit'),
        'all_items'         => __('All Tracks', 'rise-ai-summit'),
        'parent_item'       => __('Parent Track', 'rise-ai-summit'),
        'parent_item_colon' => __('Parent Track:', 'rise-ai-summit'),
        'edit_item'         => __('Edit Track', 'rise-ai-summit'),
        'update_item'       => __('Update Track', 'rise-ai-summit'),
        'add_new_item'      => __('Add New Track', 'rise-ai-summit'),
        'new_item_name'     => __('New Track Name', 'rise-ai-summit'),
        'menu_name'         => __('Tracks', 'rise-ai-summit'),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'research-track'),
        'show_in_rest'      => true,
    );
    
    register_taxonomy('research_track', array('research'), $args);
}
add_action('init', 'rise_register_research_taxonomy');

/**
 * Add default tracks on theme activation
 */
function rise_add_default_research_tracks() {
    
    // Check if tracks already exist
    $existing = get_terms(array(
        'taxonomy' => 'research_track',
        'hide_empty' => false,
    ));
    
    if (!empty($existing)) {
        return; // Already have tracks
    }
    
    // Create default tracks
    $tracks = array(
        array(
            'name' => 'Business',
            'slug' => 'business',
            'description' => 'Strategy & Governance'
        ),
        array(
            'name' => 'Education',
            'slug' => 'education',
            'description' => 'Policy & Skills'
        ),
        array(
            'name' => 'Applied Science',
            'slug' => 'science',
            'description' => 'Health & Engineering'
        )
    );
    
    foreach ($tracks as $track) {
        if (!term_exists($track['slug'], 'research_track')) {
            wp_insert_term(
                $track['name'],
                'research_track',
                array(
                    'slug' => $track['slug'],
                    'description' => $track['description']
                )
            );
        }
    }
}
add_action('after_switch_theme', 'rise_add_default_research_tracks');

/**
 * Flush rewrite rules on activation
 */
function rise_research_rewrite_flush() {
    rise_register_research_cpt();
    rise_register_research_taxonomy();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'rise_research_rewrite_flush');