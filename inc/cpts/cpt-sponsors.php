<?php
/**
 * Register Sponsors Custom Post Type
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Register Sponsors CPT
 */
function rise_ai_register_sponsors_cpt() {
    
    $labels = array(
        'name'                  => _x('Sponsors', 'Post Type General Name', 'rise-ai-summit'),
        'singular_name'         => _x('Sponsor', 'Post Type Singular Name', 'rise-ai-summit'),
        'menu_name'             => __('Sponsors', 'rise-ai-summit'),
        'name_admin_bar'        => __('Sponsor', 'rise-ai-summit'),
        'archives'              => __('Sponsor Archives', 'rise-ai-summit'),
        'attributes'            => __('Sponsor Attributes', 'rise-ai-summit'),
        'parent_item_colon'     => __('Parent Sponsor:', 'rise-ai-summit'),
        'all_items'             => __('All Sponsors', 'rise-ai-summit'),
        'add_new_item'          => __('Add New Sponsor', 'rise-ai-summit'),
        'add_new'               => __('Add New', 'rise-ai-summit'),
        'new_item'              => __('New Sponsor', 'rise-ai-summit'),
        'edit_item'             => __('Edit Sponsor', 'rise-ai-summit'),
        'update_item'           => __('Update Sponsor', 'rise-ai-summit'),
        'view_item'             => __('View Sponsor', 'rise-ai-summit'),
        'view_items'            => __('View Sponsors', 'rise-ai-summit'),
        'search_items'          => __('Search Sponsor', 'rise-ai-summit'),
        'not_found'             => __('Not found', 'rise-ai-summit'),
        'not_found_in_trash'    => __('Not found in Trash', 'rise-ai-summit'),
        'featured_image'        => __('Sponsor Logo', 'rise-ai-summit'),
        'set_featured_image'    => __('Set sponsor logo', 'rise-ai-summit'),
        'remove_featured_image' => __('Remove sponsor logo', 'rise-ai-summit'),
        'use_featured_image'    => __('Use as sponsor logo', 'rise-ai-summit'),
        'insert_into_item'      => __('Insert into sponsor', 'rise-ai-summit'),
        'uploaded_to_this_item' => __('Uploaded to this sponsor', 'rise-ai-summit'),
        'items_list'            => __('Sponsors list', 'rise-ai-summit'),
        'items_list_navigation' => __('Sponsors list navigation', 'rise-ai-summit'),
        'filter_items_list'     => __('Filter sponsors list', 'rise-ai-summit'),
    );
    
    $args = array(
        'label'                 => __('Sponsor', 'rise-ai-summit'),
        'description'           => __('Event sponsors and partners', 'rise-ai-summit'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 21,
        'menu_icon'             => 'dashicons-awards',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => 'sponsors',
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'sponsors'),
    );
    
    register_post_type('sponsor', $args);
}
add_action('init', 'rise_ai_register_sponsors_cpt', 0);

/**
 * Register Sponsor Level Taxonomy
 */
function rise_ai_register_sponsor_level_taxonomy() {
    
    $labels = array(
        'name'                       => _x('Sponsor Levels', 'Taxonomy General Name', 'rise-ai-summit'),
        'singular_name'              => _x('Sponsor Level', 'Taxonomy Singular Name', 'rise-ai-summit'),
        'menu_name'                  => __('Sponsor Levels', 'rise-ai-summit'),
        'all_items'                  => __('All Levels', 'rise-ai-summit'),
        'parent_item'                => __('Parent Level', 'rise-ai-summit'),
        'parent_item_colon'          => __('Parent Level:', 'rise-ai-summit'),
        'new_item_name'              => __('New Level Name', 'rise-ai-summit'),
        'add_new_item'               => __('Add New Level', 'rise-ai-summit'),
        'edit_item'                  => __('Edit Level', 'rise-ai-summit'),
        'update_item'                => __('Update Level', 'rise-ai-summit'),
        'view_item'                  => __('View Level', 'rise-ai-summit'),
        'separate_items_with_commas' => __('Separate levels with commas', 'rise-ai-summit'),
        'add_or_remove_items'        => __('Add or remove levels', 'rise-ai-summit'),
        'choose_from_most_used'      => __('Choose from the most used', 'rise-ai-summit'),
        'popular_items'              => __('Popular Levels', 'rise-ai-summit'),
        'search_items'               => __('Search Levels', 'rise-ai-summit'),
        'not_found'                  => __('Not Found', 'rise-ai-summit'),
        'no_terms'                   => __('No levels', 'rise-ai-summit'),
        'items_list'                 => __('Levels list', 'rise-ai-summit'),
        'items_list_navigation'      => __('Levels list navigation', 'rise-ai-summit'),
    );
    
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'sponsor-level'),
    );
    
    register_taxonomy('sponsor_level', array('sponsor'), $args);
}
add_action('init', 'rise_ai_register_sponsor_level_taxonomy', 0);

/**
 * Add default sponsor levels on activation
 */
function rise_ai_insert_default_sponsor_levels() {
    
    // Check if already inserted
    if (get_option('rise_ai_sponsor_levels_inserted')) {
        return;
    }
    
    $default_levels = array(
        'platinum' => __('Platinum', 'rise-ai-summit'),
        'gold'     => __('Gold', 'rise-ai-summit'),
        'silver'   => __('Silver', 'rise-ai-summit'),
        'bronze'   => __('Bronze', 'rise-ai-summit'),
        'in-kind'  => __('In-Kind', 'rise-ai-summit'),
    );
    
    foreach ($default_levels as $slug => $name) {
        if (!term_exists($slug, 'sponsor_level')) {
            wp_insert_term($name, 'sponsor_level', array('slug' => $slug));
        }
    }
    
    update_option('rise_ai_sponsor_levels_inserted', true);
}
add_action('init', 'rise_ai_insert_default_sponsor_levels');