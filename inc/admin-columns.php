<?php
/**
 * Admin Columns Customization
 * Custom columns for CPT admin lists
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * ==============================================
 * SPEAKERS COLUMNS
 * ==============================================
 */

/**
 * Add custom columns to Speakers list
 */
function rise_speakers_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['speaker_photo'] = __('Photo', 'rise-ai-summit');
    $new_columns['speaker_institution'] = __('Institution', 'rise-ai-summit');
    $new_columns['speaker_type'] = __('Type', 'rise-ai-summit');
    $new_columns['speaker_track'] = __('Track', 'rise-ai-summit');
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_speaker_posts_columns', 'rise_speakers_columns');

/**
 * Populate custom columns for Speakers
 */
function rise_speakers_custom_column($column, $post_id) {
    switch ($column) {
        case 'speaker_photo':
            $photo_id = get_post_meta($post_id, 'speaker_photo', true);
            if ($photo_id) {
                echo wp_get_attachment_image($photo_id, array(50, 50), false, array('style' => 'border-radius: 50%;'));
            } else {
                echo '<span class="dashicons dashicons-admin-users" style="font-size: 50px; color: #ccc;"></span>';
            }
            break;
            
        case 'speaker_institution':
            $institution = get_post_meta($post_id, 'speaker_institution', true);
            echo $institution ? esc_html($institution) : '—';
            break;
            
        case 'speaker_type':
            $type = get_post_meta($post_id, 'speaker_type', true);
            if ($type) {
                $type_labels = array(
                    'keynote' => __('Keynote', 'rise-ai-summit'),
                    'panelist' => __('Panelist', 'rise-ai-summit'),
                    'invited' => __('Invited Speaker', 'rise-ai-summit')
                );
                $label = isset($type_labels[$type]) ? $type_labels[$type] : $type;
                echo '<span style="background: #0C2340; color: white; padding: 3px 8px; border-radius: 3px; font-size: 11px;">' . esc_html($label) . '</span>';
            } else {
                echo '—';
            }
            break;
            
        case 'speaker_track':
            $track = get_post_meta($post_id, 'speaker_track', true);
            if ($track) {
                $track_colors = array(
                    'business' => '#0C2340',
                    'education' => '#AE9142',
                    'science' => '#E31837'
                );
                $track_labels = array(
                    'business' => __('Business', 'rise-ai-summit'),
                    'education' => __('Education', 'rise-ai-summit'),
                    'science' => __('Science', 'rise-ai-summit')
                );
                $color = isset($track_colors[$track]) ? $track_colors[$track] : '#666';
                $label = isset($track_labels[$track]) ? $track_labels[$track] : $track;
                echo '<span style="background: ' . $color . '; color: white; padding: 3px 8px; border-radius: 3px; font-size: 11px;">' . esc_html($label) . '</span>';
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_speaker_posts_custom_column', 'rise_speakers_custom_column', 10, 2);

/**
 * ==============================================
 * SPONSORS COLUMNS
 * ==============================================
 */

/**
 * Add custom columns to Sponsors list
 */
function rise_sponsors_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['sponsor_logo'] = __('Logo', 'rise-ai-summit');
    $new_columns['sponsor_level'] = __('Level', 'rise-ai-summit');
    $new_columns['sponsor_website'] = __('Website', 'rise-ai-summit');
    $new_columns['sponsor_order'] = __('Display Order', 'rise-ai-summit');
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_sponsor_posts_columns', 'rise_sponsors_columns');

/**
 * Populate custom columns for Sponsors
 */
function rise_sponsors_custom_column($column, $post_id) {
    switch ($column) {
        case 'sponsor_logo':
            $logo_id = get_post_meta($post_id, 'sponsor_logo', true);
            if ($logo_id) {
                echo wp_get_attachment_image($logo_id, array(100, 50));
            } else {
                echo '—';
            }
            break;
            
        case 'sponsor_level':
            $level = get_post_meta($post_id, 'sponsor_level', true);
            if ($level) {
                $level_colors = array(
                    'platinum' => '#E5E4E2',
                    'gold' => '#FFD700',
                    'silver' => '#C0C0C0',
                    'bronze' => '#CD7F32'
                );
                $color = isset($level_colors[$level]) ? $level_colors[$level] : '#666';
                echo '<span style="background: ' . $color . '; color: #333; padding: 3px 10px; border-radius: 3px; font-size: 11px; font-weight: bold; text-transform: uppercase;">' . esc_html($level) . '</span>';
            } else {
                echo '—';
            }
            break;
            
        case 'sponsor_website':
            $website = get_post_meta($post_id, 'sponsor_website', true);
            if ($website) {
                echo '<a href="' . esc_url($website) . '" target="_blank">' . esc_html(parse_url($website, PHP_URL_HOST)) . '</a>';
            } else {
                echo '—';
            }
            break;
            
        case 'sponsor_order':
            $order = get_post_meta($post_id, 'sponsor_display_order', true);
            echo $order ? esc_html($order) : '—';
            break;
    }
}
add_action('manage_sponsor_posts_custom_column', 'rise_sponsors_custom_column', 10, 2);

/**
 * Make sponsor order column sortable
 */
function rise_sponsors_sortable_columns($columns) {
    $columns['sponsor_order'] = 'sponsor_order';
    return $columns;
}
add_filter('manage_edit-sponsor_sortable_columns', 'rise_sponsors_sortable_columns');

/**
 * ==============================================
 * COMMITTEE MEMBERS COLUMNS
 * ==============================================
 */

/**
 * Add custom columns to Committee list
 */
function rise_committee_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['committee_photo'] = __('Photo', 'rise-ai-summit');
    $new_columns['committee_role'] = __('Role', 'rise-ai-summit');
    $new_columns['committee_institution'] = __('Institution', 'rise-ai-summit');
    $new_columns['committee_type'] = __('Type', 'rise-ai-summit');
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_committee_member_posts_columns', 'rise_committee_columns');

/**
 * Populate custom columns for Committee
 */
function rise_committee_custom_column($column, $post_id) {
    switch ($column) {
        case 'committee_photo':
            $photo_id = get_post_meta($post_id, 'committee_photo', true);
            if ($photo_id) {
                echo wp_get_attachment_image($photo_id, array(50, 50), false, array('style' => 'border-radius: 50%;'));
            } else {
                echo '<span class="dashicons dashicons-admin-users" style="font-size: 50px; color: #ccc;"></span>';
            }
            break;
            
        case 'committee_role':
            $role = get_post_meta($post_id, 'committee_role', true);
            echo $role ? esc_html($role) : '—';
            break;
            
        case 'committee_institution':
            $institution = get_post_meta($post_id, 'committee_institution', true);
            echo $institution ? esc_html($institution) : '—';
            break;
            
        case 'committee_type':
            $type = get_post_meta($post_id, 'committee_type', true);
            if ($type) {
                $type_labels = array(
                    'general-chairs' => __('General Chair', 'rise-ai-summit'),
                    'program-chairs' => __('Program Chair', 'rise-ai-summit'),
                    'track-chairs' => __('Track Chair', 'rise-ai-summit'),
                    'local-team' => __('Local Team', 'rise-ai-summit')
                );
                $label = isset($type_labels[$type]) ? $type_labels[$type] : $type;
                echo '<span style="background: #0C2340; color: white; padding: 3px 8px; border-radius: 3px; font-size: 11px;">' . esc_html($label) . '</span>';
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_committee_member_posts_custom_column', 'rise_committee_custom_column', 10, 2);

/**
 * ==============================================
 * ABSTRACT SUBMISSIONS COLUMNS
 * ==============================================
 */

/**
 * Add custom columns to Abstract Submissions list
 */
function rise_abstracts_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['author'] = __('Author', 'rise-ai-summit');
    $new_columns['email'] = __('Email', 'rise-ai-summit');
    $new_columns['institution'] = __('Institution', 'rise-ai-summit');
    $new_columns['track'] = __('Track', 'rise-ai-summit');
    $new_columns['status'] = __('Status', 'rise-ai-summit');
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_abstract_submission_posts_columns', 'rise_abstracts_columns');

/**
 * Populate custom columns for Abstracts
 */
function rise_abstracts_custom_column($column, $post_id) {
    switch ($column) {
        case 'author':
            $first = get_post_meta($post_id, 'abstract_author_first_name', true);
            $last = get_post_meta($post_id, 'abstract_author_last_name', true);
            echo esc_html($first . ' ' . $last);
            break;
            
        case 'email':
            $email = get_post_meta($post_id, 'abstract_author_email', true);
            if ($email) {
                echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';
            } else {
                echo '—';
            }
            break;
            
        case 'institution':
            $institution = get_post_meta($post_id, 'abstract_author_institution', true);
            echo $institution ? esc_html($institution) : '—';
            break;
            
        case 'track':
            $track = get_post_meta($post_id, 'abstract_track', true);
            if ($track) {
                $track_colors = array(
                    'business' => '#0C2340',
                    'education' => '#AE9142',
                    'science' => '#E31837'
                );
                $track_labels = array(
                    'business' => __('Business', 'rise-ai-summit'),
                    'education' => __('Education', 'rise-ai-summit'),
                    'science' => __('Science', 'rise-ai-summit')
                );
                $color = isset($track_colors[$track]) ? $track_colors[$track] : '#666';
                $label = isset($track_labels[$track]) ? $track_labels[$track] : $track;
                echo '<span style="background: ' . $color . '; color: white; padding: 3px 8px; border-radius: 3px; font-size: 11px;">' . esc_html($label) . '</span>';
            } else {
                echo '—';
            }
            break;
            
        case 'status':
            $status = get_post_meta($post_id, 'abstract_status', true);
            if ($status) {
                $status_colors = array(
                    'pending' => '#FFA500',
                    'under-review' => '#0073aa',
                    'accepted' => '#46b450',
                    'rejected' => '#dc3232'
                );
                $status_labels = array(
                    'pending' => __('Pending', 'rise-ai-summit'),
                    'under-review' => __('Under Review', 'rise-ai-summit'),
                    'accepted' => __('Accepted', 'rise-ai-summit'),
                    'rejected' => __('Rejected', 'rise-ai-summit')
                );
                $color = isset($status_colors[$status]) ? $status_colors[$status] : '#666';
                $label = isset($status_labels[$status]) ? $status_labels[$status] : $status;
                echo '<span style="background: ' . $color . '; color: white; padding: 3px 8px; border-radius: 3px; font-size: 11px; font-weight: bold;">' . esc_html($label) . '</span>';
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_abstract_submission_posts_custom_column', 'rise_abstracts_custom_column', 10, 2);

/**
 * ==============================================
 * REGISTRATION INTERESTS COLUMNS
 * ==============================================
 */

/**
 * Add custom columns to Registrations list
 */
function rise_registrations_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['email'] = __('Email', 'rise-ai-summit');
    $new_columns['country'] = __('Country', 'rise-ai-summit');
    $new_columns['attendee_type'] = __('Type', 'rise-ai-summit');
    $new_columns['interests'] = __('Interests', 'rise-ai-summit');
    $new_columns['newsletter'] = __('Newsletter', 'rise-ai-summit');
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_registration_interest_posts_columns', 'rise_registrations_columns');

/**
 * Populate custom columns for Registrations
 */
function rise_registrations_custom_column($column, $post_id) {
    switch ($column) {
        case 'email':
            $email = get_post_meta($post_id, 'registration_email', true);
            if ($email) {
                echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';
            } else {
                echo '—';
            }
            break;
            
        case 'country':
            $country = get_post_meta($post_id, 'registration_country', true);
            echo $country ? esc_html($country) : '—';
            break;
            
        case 'attendee_type':
            $type = get_post_meta($post_id, 'registration_attendee_type', true);
            if ($type) {
                echo '<span style="background: #0C2340; color: white; padding: 3px 8px; border-radius: 3px; font-size: 11px;">' . esc_html(ucfirst($type)) . '</span>';
            } else {
                echo '—';
            }
            break;
            
        case 'interests':
            $interests = get_post_meta($post_id, 'registration_interests', true);
            if (is_array($interests) && count($interests) > 0) {
                echo esc_html(implode(', ', $interests));
            } else {
                echo '—';
            }
            break;
            
        case 'newsletter':
            $newsletter = get_post_meta($post_id, 'registration_newsletter', true);
            if ($newsletter === 'yes') {
                echo '<span class="dashicons dashicons-yes-alt" style="color: #46b450;"></span>';
            } else {
                echo '<span class="dashicons dashicons-dismiss" style="color: #ccc;"></span>';
            }
            break;
    }
}
add_action('manage_registration_interest_posts_custom_column', 'rise_registrations_custom_column', 10, 2);

/**
 * ==============================================
 * SPONSOR INQUIRIES COLUMNS
 * ==============================================
 */

/**
 * Add custom columns to Sponsor Inquiries list
 */
function rise_sponsor_inquiries_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['contact'] = __('Contact', 'rise-ai-summit');
    $new_columns['email'] = __('Email', 'rise-ai-summit');
    $new_columns['phone'] = __('Phone', 'rise-ai-summit');
    $new_columns['industry'] = __('Industry', 'rise-ai-summit');
    $new_columns['status'] = __('Status', 'rise-ai-summit');
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_sponsor_inquiry_posts_columns', 'rise_sponsor_inquiries_columns');

/**
 * Populate custom columns for Sponsor Inquiries
 */
function rise_sponsor_inquiries_custom_column($column, $post_id) {
    switch ($column) {
        case 'contact':
            $name = get_post_meta($post_id, 'sponsor_inquiry_contact_name', true);
            $title = get_post_meta($post_id, 'sponsor_inquiry_contact_title', true);
            if ($name) {
                echo '<strong>' . esc_html($name) . '</strong>';
                if ($title) {
                    echo '<br><small>' . esc_html($title) . '</small>';
                }
            } else {
                echo '—';
            }
            break;
            
        case 'email':
            $email = get_post_meta($post_id, 'sponsor_inquiry_contact_email', true);
            if ($email) {
                echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';
            } else {
                echo '—';
            }
            break;
            
        case 'phone':
            $phone = get_post_meta($post_id, 'sponsor_inquiry_contact_phone', true);
            echo $phone ? esc_html($phone) : '—';
            break;
            
        case 'industry':
            $industry = get_post_meta($post_id, 'sponsor_inquiry_industry', true);
            echo $industry ? esc_html(ucfirst($industry)) : '—';
            break;
            
        case 'status':
            $status = get_post_meta($post_id, 'sponsor_inquiry_status', true);
            if ($status) {
                $status_colors = array(
                    'new' => '#FFA500',
                    'contacted' => '#0073aa',
                    'in-progress' => '#46b450',
                    'closed' => '#666'
                );
                $status_labels = array(
                    'new' => __('New', 'rise-ai-summit'),
                    'contacted' => __('Contacted', 'rise-ai-summit'),
                    'in-progress' => __('In Progress', 'rise-ai-summit'),
                    'closed' => __('Closed', 'rise-ai-summit')
                );
                $color = isset($status_colors[$status]) ? $status_colors[$status] : '#666';
                $label = isset($status_labels[$status]) ? $status_labels[$status] : $status;
                echo '<span style="background: ' . $color . '; color: white; padding: 3px 8px; border-radius: 3px; font-size: 11px; font-weight: bold;">' . esc_html($label) . '</span>';
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_sponsor_inquiry_posts_custom_column', 'rise_sponsor_inquiries_custom_column', 10, 2);

/**
 * ==============================================
 * ADMIN FILTERS
 * ==============================================
 */

/**
 * Add filters to Abstract Submissions list
 */
function rise_abstract_admin_filters() {
    global $typenow;
    
    if ($typenow !== 'abstract_submission') {
        return;
    }
    
    // Status filter
    $current_status = isset($_GET['abstract_status']) ? $_GET['abstract_status'] : '';
    ?>
    <select name="abstract_status">
        <option value=""><?php _e('All Statuses', 'rise-ai-summit'); ?></option>
        <option value="pending" <?php selected($current_status, 'pending'); ?>><?php _e('Pending', 'rise-ai-summit'); ?></option>
        <option value="under-review" <?php selected($current_status, 'under-review'); ?>><?php _e('Under Review', 'rise-ai-summit'); ?></option>
        <option value="accepted" <?php selected($current_status, 'accepted'); ?>><?php _e('Accepted', 'rise-ai-summit'); ?></option>
        <option value="rejected" <?php selected($current_status, 'rejected'); ?>><?php _e('Rejected', 'rise-ai-summit'); ?></option>
    </select>
    
    <?php
    // Track filter
    $current_track = isset($_GET['abstract_track']) ? $_GET['abstract_track'] : '';
    ?>
    <select name="abstract_track">
        <option value=""><?php _e('All Tracks', 'rise-ai-summit'); ?></option>
        <option value="business" <?php selected($current_track, 'business'); ?>><?php _e('Business', 'rise-ai-summit'); ?></option>
        <option value="education" <?php selected($current_track, 'education'); ?>><?php _e('Education', 'rise-ai-summit'); ?></option>
        <option value="science" <?php selected($current_track, 'science'); ?>><?php _e('Applied Science', 'rise-ai-summit'); ?></option>
    </select>
    <?php
}
add_action('restrict_manage_posts', 'rise_abstract_admin_filters');

/**
 * Filter Abstract Submissions by meta
 */
function rise_abstract_filter_query($query) {
    global $pagenow, $typenow;
    
    if ($pagenow === 'edit.php' && $typenow === 'abstract_submission' && $query->is_main_query()) {
        
        $meta_query = array();
        
        // Status filter
        if (isset($_GET['abstract_status']) && $_GET['abstract_status'] !== '') {
            $meta_query[] = array(
                'key' => 'abstract_status',
                'value' => sanitize_text_field($_GET['abstract_status']),
                'compare' => '='
            );
        }
        
        // Track filter
        if (isset($_GET['abstract_track']) && $_GET['abstract_track'] !== '') {
            $meta_query[] = array(
                'key' => 'abstract_track',
                'value' => sanitize_text_field($_GET['abstract_track']),
                'compare' => '='
            );
        }
        
        if (count($meta_query) > 0) {
            $query->set('meta_query', $meta_query);
        }
    }
}
add_action('pre_get_posts', 'rise_abstract_filter_query');

/**
 * Add filters to Sponsor Inquiries list
 */
function rise_sponsor_admin_filters() {
    global $typenow;
    
    if ($typenow !== 'sponsor_inquiry') {
        return;
    }
    
    // Status filter
    $current_status = isset($_GET['sponsor_status']) ? $_GET['sponsor_status'] : '';
    ?>
    <select name="sponsor_status">
        <option value=""><?php _e('All Statuses', 'rise-ai-summit'); ?></option>
        <option value="new" <?php selected($current_status, 'new'); ?>><?php _e('New', 'rise-ai-summit'); ?></option>
        <option value="contacted" <?php selected($current_status, 'contacted'); ?>><?php _e('Contacted', 'rise-ai-summit'); ?></option>
        <option value="in-progress" <?php selected($current_status, 'in-progress'); ?>><?php _e('In Progress', 'rise-ai-summit'); ?></option>
        <option value="closed" <?php selected($current_status, 'closed'); ?>><?php _e('Closed', 'rise-ai-summit'); ?></option>
    </select>
    <?php
}
add_action('restrict_manage_posts', 'rise_sponsor_admin_filters');

/**
 * Filter Sponsor Inquiries by status
 */
function rise_sponsor_filter_query($query) {
    global $pagenow, $typenow;
    
    if ($pagenow === 'edit.php' && $typenow === 'sponsor_inquiry' && $query->is_main_query()) {
        
        if (isset($_GET['sponsor_status']) && $_GET['sponsor_status'] !== '') {
            $query->set('meta_query', array(
                array(
                    'key' => 'sponsor_inquiry_status',
                    'value' => sanitize_text_field($_GET['sponsor_status']),
                    'compare' => '='
                )
            ));
        }
    }
}
add_action('pre_get_posts', 'rise_sponsor_filter_query');

/**
 * Add filters to Registration Interests list
 */
function rise_registration_admin_filters() {
    global $typenow;
    
    if ($typenow !== 'registration') {
        return;
    }
    
    // Attendee type filter
    $current_type = isset($_GET['attendee_type']) ? $_GET['attendee_type'] : '';
    ?>
    <select name="attendee_type">
        <option value=""><?php _e('All Types', 'rise-ai-summit'); ?></option>
        <option value="academic" <?php selected($current_type, 'academic'); ?>><?php _e('Academic', 'rise-ai-summit'); ?></option>
        <option value="industry" <?php selected($current_type, 'industry'); ?>><?php _e('Industry', 'rise-ai-summit'); ?></option>
        <option value="student" <?php selected($current_type, 'student'); ?>><?php _e('Student', 'rise-ai-summit'); ?></option>
        <option value="government" <?php selected($current_type, 'government'); ?>><?php _e('Government', 'rise-ai-summit'); ?></option>
        <option value="other" <?php selected($current_type, 'other'); ?>><?php _e('Other', 'rise-ai-summit'); ?></option>
    </select>
    <?php
}
add_action('restrict_manage_posts', 'rise_registration_admin_filters');

/**
 * Filter Registrations by attendee type
 */
function rise_registration_filter_query($query) {
    global $pagenow, $typenow;
    
    if ($pagenow === 'edit.php' && $typenow === 'registration' && $query->is_main_query()) {
        
        if (isset($_GET['attendee_type']) && $_GET['attendee_type'] !== '') {
            $query->set('meta_query', array(
                array(
                    'key' => 'registration_attendee_type',
                    'value' => sanitize_text_field($_GET['attendee_type']),
                    'compare' => '='
                )
            ));
        }
    }
}
add_action('pre_get_posts', 'rise_registration_filter_query');