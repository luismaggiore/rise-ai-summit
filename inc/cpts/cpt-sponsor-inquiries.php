<?php
/**
 * Register Sponsor Inquiries Custom Post Type
 * Admin-only CPT for storing sponsor contact form submissions
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Register Sponsor Inquiries CPT
 */
function rise_ai_register_sponsor_inquiries_cpt() {
    
    $labels = array(
        'name'                  => _x('Sponsor Inquiries', 'Post Type General Name', 'rise-ai-summit'),
        'singular_name'         => _x('Sponsor Inquiry', 'Post Type Singular Name', 'rise-ai-summit'),
        'menu_name'             => __('Sponsor Inquiries', 'rise-ai-summit'),
        'name_admin_bar'        => __('Inquiry', 'rise-ai-summit'),
        'archives'              => __('Inquiry Archives', 'rise-ai-summit'),
        'attributes'            => __('Inquiry Attributes', 'rise-ai-summit'),
        'parent_item_colon'     => __('Parent Inquiry:', 'rise-ai-summit'),
        'all_items'             => __('All Inquiries', 'rise-ai-summit'),
        'add_new_item'          => __('Add New Inquiry', 'rise-ai-summit'),
        'add_new'               => __('Add New', 'rise-ai-summit'),
        'new_item'              => __('New Inquiry', 'rise-ai-summit'),
        'edit_item'             => __('Edit Inquiry', 'rise-ai-summit'),
        'update_item'           => __('Update Inquiry', 'rise-ai-summit'),
        'view_item'             => __('View Inquiry', 'rise-ai-summit'),
        'view_items'            => __('View Inquiries', 'rise-ai-summit'),
        'search_items'          => __('Search Inquiries', 'rise-ai-summit'),
        'not_found'             => __('No inquiries found', 'rise-ai-summit'),
        'not_found_in_trash'    => __('No inquiries found in Trash', 'rise-ai-summit'),
        'items_list'            => __('Inquiries list', 'rise-ai-summit'),
        'items_list_navigation' => __('Inquiries list navigation', 'rise-ai-summit'),
        'filter_items_list'     => __('Filter inquiries list', 'rise-ai-summit'),
    );
    
    $args = array(
        'label'                 => __('Sponsor Inquiry', 'rise-ai-summit'),
        'description'           => __('Sponsor inquiry submissions from sponsorship form', 'rise-ai-summit'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor'),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 27,
        'menu_icon'             => 'dashicons-businessman',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => false,
    );
    
    register_post_type('sponsor_inquiry', $args);
}
add_action('init', 'rise_ai_register_sponsor_inquiries_cpt', 0);

/**
 * Custom admin columns for Sponsor Inquiries
 */
function rise_ai_sponsor_inquiries_admin_columns($columns) {
    $new_columns = array(
        'cb'              => $columns['cb'],
        'title'           => __('Company Name', 'rise-ai-summit'),
        'contact'         => __('Contact Person', 'rise-ai-summit'),
        'email'           => __('Email', 'rise-ai-summit'),
        'phone'           => __('Phone', 'rise-ai-summit'),
        'status'          => __('Status', 'rise-ai-summit'),
        'date'            => __('Submitted', 'rise-ai-summit'),
    );
    
    return $new_columns;
}
add_filter('manage_sponsor_inquiry_posts_columns', 'rise_ai_sponsor_inquiries_admin_columns');

/**
 * Populate custom admin columns
 */
function rise_ai_sponsor_inquiries_admin_column_content($column, $post_id) {
    switch ($column) {
        case 'contact':
            $contact = get_post_meta($post_id, 'sponsor_inquiry_contact_name', true);
            echo $contact ? esc_html($contact) : '—';
            break;
            
        case 'email':
            $email = get_post_meta($post_id, 'sponsor_inquiry_contact_email', true);
            echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '—';
            break;
            
        case 'phone':
            $phone = get_post_meta($post_id, 'sponsor_inquiry_contact_phone', true);
            echo $phone ? esc_html($phone) : '—';
            break;
            
        case 'status':
            $status = get_post_meta($post_id, 'sponsor_inquiry_status', true);
            if ($status) {
                $status_labels = array(
                    'new'         => __('New', 'rise-ai-summit'),
                    'contacted'   => __('Contacted', 'rise-ai-summit'),
                    'in-progress' => __('In Progress', 'rise-ai-summit'),
                    'closed'      => __('Closed', 'rise-ai-summit'),
                );
                $label = isset($status_labels[$status]) ? $status_labels[$status] : $status;
                echo '<span class="status-badge ' . esc_attr($status) . '">' . esc_html($label) . '</span>';
            } else {
                echo '<span class="status-badge new">' . __('New', 'rise-ai-summit') . '</span>';
            }
            break;
    }
}
add_action('manage_sponsor_inquiry_posts_custom_column', 'rise_ai_sponsor_inquiries_admin_column_content', 10, 2);

/**
 * Make columns sortable
 */
function rise_ai_sponsor_inquiries_sortable_columns($columns) {
    $columns['contact'] = 'contact';
    $columns['email'] = 'email';
    $columns['status'] = 'status';
    return $columns;
}
add_filter('manage_edit-sponsor_inquiry_sortable_columns', 'rise_ai_sponsor_inquiries_sortable_columns');