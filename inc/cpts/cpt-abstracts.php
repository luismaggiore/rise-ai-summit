<?php
/**
 * Register Abstract Submissions Custom Post Type
 * Admin-only CPT for storing form submissions
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Register Abstract Submissions CPT
 */
function rise_ai_register_abstracts_cpt() {
    
    $labels = array(
        'name'                  => _x('Abstract Submissions', 'Post Type General Name', 'rise-ai-summit'),
        'singular_name'         => _x('Abstract Submission', 'Post Type Singular Name', 'rise-ai-summit'),
        'menu_name'             => __('Abstract Submissions', 'rise-ai-summit'),
        'name_admin_bar'        => __('Abstract', 'rise-ai-summit'),
        'archives'              => __('Abstract Archives', 'rise-ai-summit'),
        'attributes'            => __('Abstract Attributes', 'rise-ai-summit'),
        'parent_item_colon'     => __('Parent Abstract:', 'rise-ai-summit'),
        'all_items'             => __('All Submissions', 'rise-ai-summit'),
        'add_new_item'          => __('Add New Submission', 'rise-ai-summit'),
        'add_new'               => __('Add New', 'rise-ai-summit'),
        'new_item'              => __('New Submission', 'rise-ai-summit'),
        'edit_item'             => __('Edit Submission', 'rise-ai-summit'),
        'update_item'           => __('Update Submission', 'rise-ai-summit'),
        'view_item'             => __('View Submission', 'rise-ai-summit'),
        'view_items'            => __('View Submissions', 'rise-ai-summit'),
        'search_items'          => __('Search Submissions', 'rise-ai-summit'),
        'not_found'             => __('No submissions found', 'rise-ai-summit'),
        'not_found_in_trash'    => __('No submissions found in Trash', 'rise-ai-summit'),
        'items_list'            => __('Submissions list', 'rise-ai-summit'),
        'items_list_navigation' => __('Submissions list navigation', 'rise-ai-summit'),
        'filter_items_list'     => __('Filter submissions list', 'rise-ai-summit'),
    );
    
    $args = array(
        'label'                 => __('Abstract Submission', 'rise-ai-summit'),
        'description'           => __('Abstract submissions from call for papers form', 'rise-ai-summit'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor'),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 25,
        'menu_icon'             => 'dashicons-media-document',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => false,
    );
    
    register_post_type('abstract_submission', $args);
}
add_action('init', 'rise_ai_register_abstracts_cpt', 0);

/**
 * Custom admin columns for Abstract Submissions
 */
function rise_ai_abstracts_admin_columns($columns) {
    $new_columns = array(
        'cb'            => $columns['cb'],
        'title'         => __('Author Name', 'rise-ai-summit'),
        'email'         => __('Email', 'rise-ai-summit'),
        'institution'   => __('Institution', 'rise-ai-summit'),
        'track'         => __('Track', 'rise-ai-summit'),
        'status'        => __('Status', 'rise-ai-summit'),
        'date'          => __('Submitted', 'rise-ai-summit'),
    );
    
    return $new_columns;
}
add_filter('manage_abstract_submission_posts_columns', 'rise_ai_abstracts_admin_columns');

/**
 * Populate custom admin columns
 */
function rise_ai_abstracts_admin_column_content($column, $post_id) {
    switch ($column) {
        case 'email':
            $email = get_post_meta($post_id, 'abstract_author_email', true);
            echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '—';
            break;
            
        case 'institution':
            $institution = get_post_meta($post_id, 'abstract_author_institution', true);
            echo $institution ? esc_html($institution) : '—';
            break;
            
        case 'track':
            $track = get_post_meta($post_id, 'abstract_track', true);
            if ($track) {
                $track_labels = array(
                    'business'  => __('Business', 'rise-ai-summit'),
                    'education' => __('Education', 'rise-ai-summit'),
                    'science'   => __('Science', 'rise-ai-summit'),
                );
                echo isset($track_labels[$track]) ? esc_html($track_labels[$track]) : esc_html($track);
            } else {
                echo '—';
            }
            break;
            
        case 'status':
            $status = get_post_meta($post_id, 'abstract_status', true);
            if ($status) {
                $status_labels = array(
                    'pending'       => __('Pending', 'rise-ai-summit'),
                    'under-review'  => __('Under Review', 'rise-ai-summit'),
                    'accepted'      => __('Accepted', 'rise-ai-summit'),
                    'rejected'      => __('Rejected', 'rise-ai-summit'),
                );
                $label = isset($status_labels[$status]) ? $status_labels[$status] : $status;
                echo '<span class="status-badge ' . esc_attr($status) . '">' . esc_html($label) . '</span>';
            } else {
                echo '<span class="status-badge pending">' . __('Pending', 'rise-ai-summit') . '</span>';
            }
            break;
    }
}
add_action('manage_abstract_submission_posts_custom_column', 'rise_ai_abstracts_admin_column_content', 10, 2);

/**
 * Make columns sortable
 */
function rise_ai_abstracts_sortable_columns($columns) {
    $columns['email'] = 'email';
    $columns['institution'] = 'institution';
    $columns['track'] = 'track';
    $columns['status'] = 'status';
    return $columns;
}
add_filter('manage_edit-abstract_submission_sortable_columns', 'rise_ai_abstracts_sortable_columns');