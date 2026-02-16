<?php
/**
 * Custom Post Type: Registrations
 * Stores registration form submissions
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Register Registration CPT
 */
function rise_register_registration_cpt() {
    
    $labels = array(
        'name'                  => _x('Registrations', 'Post type general name', 'rise-ai-summit'),
        'singular_name'         => _x('preregistration', 'Post type singular name', 'rise-ai-summit'),
        'menu_name'             => _x('Registrations', 'Admin Menu text', 'rise-ai-summit'),
        'name_admin_bar'        => _x('preregistration', 'Add New on Toolbar', 'rise-ai-summit'),
        'add_new'               => __('Add New', 'rise-ai-summit'),
        'add_new_item'          => __('Add New Registration', 'rise-ai-summit'),
        'new_item'              => __('New Registration', 'rise-ai-summit'),
        'edit_item'             => __('View Registration', 'rise-ai-summit'),
        'view_item'             => __('View Registration', 'rise-ai-summit'),
        'all_items'             => __('All Registrations', 'rise-ai-summit'),
        'search_items'          => __('Search Registrations', 'rise-ai-summit'),
        'not_found'             => __('No registrations found.', 'rise-ai-summit'),
        'not_found_in_trash'    => __('No registrations found in Trash.', 'rise-ai-summit'),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 26,
        'menu_icon'          => 'dashicons-tickets-alt',
        'supports'           => array('title'),
        'show_in_rest'       => false,
        'capabilities' => array(
            'create_posts' => 'do_not_allow',
        ),
        'map_meta_cap' => true,
    );
    
    register_post_type('preregistration', $args);
}
add_action('init', 'rise_register_registration_cpt');

/**
 * Customize columns in admin list
 */
function rise_registration_columns($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => __('Name', 'rise-ai-summit'),
        'email' => __('Email', 'rise-ai-summit'),
        'institution' => __('Institution', 'rise-ai-summit'),
        'country' => __('Country', 'rise-ai-summit'),
        'attendee_type' => __('Type', 'rise-ai-summit'),
        'date' => __('Submitted', 'rise-ai-summit'),
    );
    return $new_columns;
}
add_filter('manage_registration_posts_columns', 'rise_registration_columns');

/**
 * Populate custom columns
 */
function rise_registration_column_content($column, $post_id) {
    switch ($column) {
        case 'email':
            echo esc_html(get_post_meta($post_id, 'registration_email', true));
            break;
        case 'institution':
            echo esc_html(get_post_meta($post_id, 'registration_institution', true));
            break;
        case 'country':
            echo esc_html(get_post_meta($post_id, 'registration_country', true));
            break;
        case 'attendee_type':
            $type = get_post_meta($post_id, 'registration_attendee_type', true);
            $types = array(
                'academic' => __('Academic', 'rise-ai-summit'),
                'industry' => __('Industry', 'rise-ai-summit'),
                'student' => __('Student', 'rise-ai-summit'),
                'government' => __('Government', 'rise-ai-summit'),
                'other' => __('Other', 'rise-ai-summit')
            );
            if (isset($types[$type])) {
                echo '<span class="registration-type registration-type-' . esc_attr($type) . '">' . esc_html($types[$type]) . '</span>';
            }
            break;
    }
}
add_action('manage_registration_posts_custom_column', 'rise_registration_column_content', 10, 2);

/**
 * Make columns sortable
 */
function rise_registration_sortable_columns($columns) {
    $columns['email'] = 'email';
    $columns['country'] = 'country';
    $columns['attendee_type'] = 'attendee_type';
    return $columns;
}
add_filter('manage_edit-registration_sortable_columns', 'rise_registration_sortable_columns');

/**
 * Add custom styles for admin list
 */
function rise_registration_admin_styles() {
    global $post_type;
    if ('preregistration' === $post_type) {
        ?>
        <style>
            .registration-type {
                display: inline-block;
                padding: 3px 8px;
                border-radius: 3px;
                font-size: 11px;
                font-weight: bold;
                text-transform: uppercase;
            }
            .registration-type-academic { background: #0C2340; color: white; }
            .registration-type-industry { background: #E31837; color: white; }
            .registration-type-student { background: #AE9142; color: white; }
            .registration-type-government { background: #666; color: white; }
            .registration-type-other { background: #ddd; color: #333; }
            
            .column-email { width: 20%; }
            .column-institution { width: 20%; }
            .column-country { width: 12%; }
            .column-attendee_type { width: 10%; }
        </style>
        <?php
    }
}
add_action('admin_head', 'rise_registration_admin_styles');

/**
 * Remove quick edit
 */
function rise_registration_remove_quick_edit($actions, $post) {
    if ($post->post_type === 'preregistration') {
        unset($actions['inline hide-if-no-js']);
    }
    return $actions;
}
add_filter('post_row_actions', 'rise_registration_remove_quick_edit', 10, 2);

/**
 * Change "Add New" button text
 */
function rise_registration_change_add_new() {
    global $submenu;
    if (isset($submenu['edit.php?post_type=registration'])) {
        $submenu['edit.php?post_type=registration'][10][0] = __('Add Manual Entry', 'rise-ai-summit');
    }
}
add_action('admin_menu', 'rise_registration_change_add_new');

/**
 * Add notice at top of edit screen
 */
function rise_registration_edit_notice() {
    global $post_type;
    if ('preregistration' === $post_type) {
        ?>
        <div class="notice notice-info">
            <p>
                <strong><?php _e('Note:', 'rise-ai-summit'); ?></strong> 
                <?php _e('Registrations are automatically created when users submit the registration form. You can view and manage them here.', 'rise-ai-summit'); ?>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'rise_registration_edit_notice');