<?php
/**
 * Register Speakers Custom Post Type
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Register Speakers CPT
 */
function rise_ai_register_speakers_cpt() {
    
    $labels = array(
        'name'                  => _x('Speakers', 'Post Type General Name', 'rise-ai-summit'),
        'singular_name'         => _x('Speaker', 'Post Type Singular Name', 'rise-ai-summit'),
        'menu_name'             => __('Speakers', 'rise-ai-summit'),
        'name_admin_bar'        => __('Speaker', 'rise-ai-summit'),
        'archives'              => __('Speaker Archives', 'rise-ai-summit'),
        'attributes'            => __('Speaker Attributes', 'rise-ai-summit'),
        'parent_item_colon'     => __('Parent Speaker:', 'rise-ai-summit'),
        'all_items'             => __('All Speakers', 'rise-ai-summit'),
        'add_new_item'          => __('Add New Speaker', 'rise-ai-summit'),
        'add_new'               => __('Add New', 'rise-ai-summit'),
        'new_item'              => __('New Speaker', 'rise-ai-summit'),
        'edit_item'             => __('Edit Speaker', 'rise-ai-summit'),
        'update_item'           => __('Update Speaker', 'rise-ai-summit'),
        'view_item'             => __('View Speaker', 'rise-ai-summit'),
        'view_items'            => __('View Speakers', 'rise-ai-summit'),
        'search_items'          => __('Search Speaker', 'rise-ai-summit'),
        'not_found'             => __('Not found', 'rise-ai-summit'),
        'not_found_in_trash'    => __('Not found in Trash', 'rise-ai-summit'),
        'featured_image'        => __('Speaker Photo', 'rise-ai-summit'),
        'set_featured_image'    => __('Set speaker photo', 'rise-ai-summit'),
        'remove_featured_image' => __('Remove speaker photo', 'rise-ai-summit'),
        'use_featured_image'    => __('Use as speaker photo', 'rise-ai-summit'),
        'insert_into_item'      => __('Insert into speaker', 'rise-ai-summit'),
        'uploaded_to_this_item' => __('Uploaded to this speaker', 'rise-ai-summit'),
        'items_list'            => __('Speakers list', 'rise-ai-summit'),
        'items_list_navigation' => __('Speakers list navigation', 'rise-ai-summit'),
        'filter_items_list'     => __('Filter speakers list', 'rise-ai-summit'),
    );
    
    $args = array(
        'label'                 => __('Speaker', 'rise-ai-summit'),
        'description'           => __('Conference speakers and presenters', 'rise-ai-summit'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'revisions'),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-microphone',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'speakers',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'speakers'),
    );
    
    register_post_type('speaker', $args);
}
add_action('init', 'rise_ai_register_speakers_cpt', 0);

/**
 * Register Speaker Type Taxonomy
 */
function rise_ai_register_speaker_type_taxonomy() {
    
    $labels = array(
        'name'                       => _x('Speaker Types', 'Taxonomy General Name', 'rise-ai-summit'),
        'singular_name'              => _x('Speaker Type', 'Taxonomy Singular Name', 'rise-ai-summit'),
        'menu_name'                  => __('Speaker Types', 'rise-ai-summit'),
        'all_items'                  => __('All Types', 'rise-ai-summit'),
        'parent_item'                => __('Parent Type', 'rise-ai-summit'),
        'parent_item_colon'          => __('Parent Type:', 'rise-ai-summit'),
        'new_item_name'              => __('New Type Name', 'rise-ai-summit'),
        'add_new_item'               => __('Add New Type', 'rise-ai-summit'),
        'edit_item'                  => __('Edit Type', 'rise-ai-summit'),
        'update_item'                => __('Update Type', 'rise-ai-summit'),
        'view_item'                  => __('View Type', 'rise-ai-summit'),
        'separate_items_with_commas' => __('Separate types with commas', 'rise-ai-summit'),
        'add_or_remove_items'        => __('Add or remove types', 'rise-ai-summit'),
        'choose_from_most_used'      => __('Choose from the most used', 'rise-ai-summit'),
        'popular_items'              => __('Popular Types', 'rise-ai-summit'),
        'search_items'               => __('Search Types', 'rise-ai-summit'),
        'not_found'                  => __('Not Found', 'rise-ai-summit'),
        'no_terms'                   => __('No types', 'rise-ai-summit'),
        'items_list'                 => __('Types list', 'rise-ai-summit'),
        'items_list_navigation'      => __('Types list navigation', 'rise-ai-summit'),
    );
    
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'speaker-type'),
    );
    
    register_taxonomy('speaker_type', array('speaker'), $args);
}
add_action('init', 'rise_ai_register_speaker_type_taxonomy', 0);

/**
 * Register Track Taxonomy (shared with speakers)
 */
function rise_ai_register_track_taxonomy() {
    
    $labels = array(
        'name'                       => _x('Tracks', 'Taxonomy General Name', 'rise-ai-summit'),
        'singular_name'              => _x('Track', 'Taxonomy Singular Name', 'rise-ai-summit'),
        'menu_name'                  => __('Tracks', 'rise-ai-summit'),
        'all_items'                  => __('All Tracks', 'rise-ai-summit'),
        'parent_item'                => __('Parent Track', 'rise-ai-summit'),
        'parent_item_colon'          => __('Parent Track:', 'rise-ai-summit'),
        'new_item_name'              => __('New Track Name', 'rise-ai-summit'),
        'add_new_item'               => __('Add New Track', 'rise-ai-summit'),
        'edit_item'                  => __('Edit Track', 'rise-ai-summit'),
        'update_item'                => __('Update Track', 'rise-ai-summit'),
        'view_item'                  => __('View Track', 'rise-ai-summit'),
        'separate_items_with_commas' => __('Separate tracks with commas', 'rise-ai-summit'),
        'add_or_remove_items'        => __('Add or remove tracks', 'rise-ai-summit'),
        'choose_from_most_used'      => __('Choose from the most used', 'rise-ai-summit'),
        'popular_items'              => __('Popular Tracks', 'rise-ai-summit'),
        'search_items'               => __('Search Tracks', 'rise-ai-summit'),
        'not_found'                  => __('Not Found', 'rise-ai-summit'),
        'no_terms'                   => __('No tracks', 'rise-ai-summit'),
        'items_list'                 => __('Tracks list', 'rise-ai-summit'),
        'items_list_navigation'      => __('Tracks list navigation', 'rise-ai-summit'),
    );
    
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'track'),
    );
    
    register_taxonomy('track', array('speaker'), $args);
}
add_action('init', 'rise_ai_register_track_taxonomy', 0);

/**
 * Add default speaker types on activation
 */
function rise_ai_insert_default_speaker_types() {
    
    // Check if already inserted
    if (get_option('rise_ai_speaker_types_inserted')) {
        return;
    }
    
    $default_types = array(
        'keynote'  => __('Keynote Speaker', 'rise-ai-summit'),
        'panelist' => __('Panelist', 'rise-ai-summit'),
        'invited'  => __('Invited Speaker', 'rise-ai-summit'),
    );
    
    foreach ($default_types as $slug => $name) {
        if (!term_exists($slug, 'speaker_type')) {
            wp_insert_term($name, 'speaker_type', array('slug' => $slug));
        }
    }
    
    update_option('rise_ai_speaker_types_inserted', true);
}
add_action('init', 'rise_ai_insert_default_speaker_types');

/**
 * Add default tracks on activation
 */
function rise_ai_insert_default_tracks() {
    
    // Check if already inserted
    if (get_option('rise_ai_tracks_inserted')) {
        return;
    }
    
    $default_tracks = array(
        'business'  => __('Business: Strategy & Governance', 'rise-ai-summit'),
        'education' => __('Education: Policy & Skills', 'rise-ai-summit'),
        'science'   => __('Applied Science: Health & Engineering', 'rise-ai-summit'),
    );
    
    foreach ($default_tracks as $slug => $name) {
        if (!term_exists($slug, 'track')) {
            wp_insert_term($name, 'track', array('slug' => $slug));
        }
    }
    
    update_option('rise_ai_tracks_inserted', true);
}
add_action('init', 'rise_ai_insert_default_tracks');