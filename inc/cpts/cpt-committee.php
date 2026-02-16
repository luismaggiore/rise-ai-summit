<?php
/**
 * Register Committee Members Custom Post Type
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Register Committee Members CPT
 */
function rise_ai_register_committee_cpt() {
    
    $labels = array(
        'name'                  => _x('Committee Members', 'Post Type General Name', 'rise-ai-summit'),
        'singular_name'         => _x('Committee Member', 'Post Type Singular Name', 'rise-ai-summit'),
        'menu_name'             => __('Committee', 'rise-ai-summit'),
        'name_admin_bar'        => __('Committee Member', 'rise-ai-summit'),
        'archives'              => __('Committee Archives', 'rise-ai-summit'),
        'attributes'            => __('Member Attributes', 'rise-ai-summit'),
        'parent_item_colon'     => __('Parent Member:', 'rise-ai-summit'),
        'all_items'             => __('All Members', 'rise-ai-summit'),
        'add_new_item'          => __('Add New Member', 'rise-ai-summit'),
        'add_new'               => __('Add New', 'rise-ai-summit'),
        'new_item'              => __('New Member', 'rise-ai-summit'),
        'edit_item'             => __('Edit Member', 'rise-ai-summit'),
        'update_item'           => __('Update Member', 'rise-ai-summit'),
        'view_item'             => __('View Member', 'rise-ai-summit'),
        'view_items'            => __('View Members', 'rise-ai-summit'),
        'search_items'          => __('Search Member', 'rise-ai-summit'),
        'not_found'             => __('Not found', 'rise-ai-summit'),
        'not_found_in_trash'    => __('Not found in Trash', 'rise-ai-summit'),
        'featured_image'        => __('Member Photo', 'rise-ai-summit'),
        'set_featured_image'    => __('Set member photo', 'rise-ai-summit'),
        'remove_featured_image' => __('Remove member photo', 'rise-ai-summit'),
        'use_featured_image'    => __('Use as member photo', 'rise-ai-summit'),
        'insert_into_item'      => __('Insert into member', 'rise-ai-summit'),
        'uploaded_to_this_item' => __('Uploaded to this member', 'rise-ai-summit'),
        'items_list'            => __('Members list', 'rise-ai-summit'),
        'items_list_navigation' => __('Members list navigation', 'rise-ai-summit'),
        'filter_items_list'     => __('Filter members list', 'rise-ai-summit'),
    );
    
    $args = array(
        'label'                 => __('Committee Member', 'rise-ai-summit'),
        'description'           => __('Conference organizing committee members', 'rise-ai-summit'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 22,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'team',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'team'),
    );
    
    register_post_type('committee_member', $args);
}
add_action('init', 'rise_ai_register_committee_cpt', 0);

/**
 * Register Committee Type Taxonomy
 */
function rise_ai_register_committee_type_taxonomy() {
    
    $labels = array(
        'name'                       => _x('Committee Types', 'Taxonomy General Name', 'rise-ai-summit'),
        'singular_name'              => _x('Committee Type', 'Taxonomy Singular Name', 'rise-ai-summit'),
        'menu_name'                  => __('Committee Types', 'rise-ai-summit'),
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
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'committee-type'),
    );
    
    register_taxonomy('committee_type', array('committee_member'), $args);
}
add_action('init', 'rise_ai_register_committee_type_taxonomy', 0);

/**
 * Add default committee types on activation
 */
function rise_ai_insert_default_committee_types() {
    
    // Check if already inserted
    if (get_option('rise_ai_committee_types_inserted')) {
        return;
    }
    
    $default_types = array(
        'general-chairs'  => __('General Chairs', 'rise-ai-summit'),
        'program-chairs'  => __('Program Chairs', 'rise-ai-summit'),
        'track-chairs'    => __('Track Co-Chairs', 'rise-ai-summit'),
        'local-team'      => __('Local Organizing Team', 'rise-ai-summit'),
    );
    
    foreach ($default_types as $slug => $name) {
        if (!term_exists($slug, 'committee_type')) {
            wp_insert_term($name, 'committee_type', array('slug' => $slug));
        }
    }
    
    update_option('rise_ai_committee_types_inserted', true);
}
add_action('init', 'rise_ai_insert_default_committee_types');