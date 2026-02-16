<?php
/**
 * CSV Export Functionality
 * Export form submissions to CSV files
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Export menu page
 */
function rise_add_export_menu() {
    add_menu_page(
        __('Export Contacts', 'rise-ai-summit'),
        __('Export Data', 'rise-ai-summit'),
        'manage_options',
        'rise-export-contacts',
        'rise_export_page',
        'dashicons-download',
        80
    );
}
add_action('admin_menu', 'rise_add_export_menu');

/**
 * Export page HTML
 */
function rise_export_page() {
    
    // Get counts
    $abstracts_count = wp_count_posts('abstract_submission')->publish;
    $registrations_count = wp_count_posts('preregistration')->publish;
    $sponsors_count = wp_count_posts('sponsor_inquiry')->publish;
    
    ?>
    <div class="wrap">
        <h1><?php _e('Export Data to CSV', 'rise-ai-summit'); ?></h1>
        
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2><?php _e('Select Data to Export', 'rise-ai-summit'); ?></h2>
            
            <form method="post" action="">
                <?php wp_nonce_field('rise_export_csv', 'export_nonce'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row"><?php _e('Data Types', 'rise-ai-summit'); ?></th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="checkbox" name="export_abstracts" value="1" checked>
                                    <strong><?php _e('Abstract Submissions', 'rise-ai-summit'); ?></strong>
                                    <span class="description">(<?php echo $abstracts_count; ?> <?php _e('entries', 'rise-ai-summit'); ?>)</span>
                                </label><br><br>
                                
                                <label>
                                    <input type="checkbox" name="export_registrations" value="1" checked>
                                    <strong><?php _e('Registration Interests', 'rise-ai-summit'); ?></strong>
                                    <span class="description">(<?php echo $registrations_count; ?> <?php _e('entries', 'rise-ai-summit'); ?>)</span>
                                </label><br><br>
                                
                                <label>
                                    <input type="checkbox" name="export_sponsors" value="1" checked>
                                    <strong><?php _e('Sponsor Inquiries', 'rise-ai-summit'); ?></strong>
                                    <span class="description">(<?php echo $sponsors_count; ?> <?php _e('entries', 'rise-ai-summit'); ?>)</span>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><?php _e('Date Range', 'rise-ai-summit'); ?></th>
                        <td>
                            <label>
                                <?php _e('From:', 'rise-ai-summit'); ?>
                                <input type="date" name="date_from" style="width: 200px;">
                            </label>
                            <br><br>
                            <label>
                                <?php _e('To:', 'rise-ai-summit'); ?>
                                <input type="date" name="date_to" style="width: 200px;">
                            </label>
                            <p class="description"><?php _e('Leave empty to export all dates', 'rise-ai-summit'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><?php _e('Export Format', 'rise-ai-summit'); ?></th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="radio" name="export_format" value="combined" checked>
                                    <?php _e('Single file (all data types in one CSV with separators)', 'rise-ai-summit'); ?>
                                </label><br><br>
                                <label>
                                    <input type="radio" name="export_format" value="separate">
                                    <?php _e('Separate files (ZIP archive with individual CSVs)', 'rise-ai-summit'); ?>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                </table>
                
                <p class="submit">
                    <button type="submit" name="do_export" class="button button-primary button-large">
                        <span class="dashicons dashicons-download" style="margin-top: 3px;"></span>
                        <?php _e('Download CSV', 'rise-ai-summit'); ?>
                    </button>
                </p>
            </form>
        </div>
        
        <!-- Quick Stats -->
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2><?php _e('Quick Statistics', 'rise-ai-summit'); ?></h2>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <div style="text-align: center; padding: 20px; background: #f0f0f1; border-radius: 4px;">
                    <div style="font-size: 36px; font-weight: bold; color: #0C2340;"><?php echo $abstracts_count; ?></div>
                    <div style="color: #666; margin-top: 5px;"><?php _e('Abstracts', 'rise-ai-summit'); ?></div>
                </div>
                <div style="text-align: center; padding: 20px; background: #f0f0f1; border-radius: 4px;">
                    <div style="font-size: 36px; font-weight: bold; color: #0C2340;"><?php echo $registrations_count; ?></div>
                    <div style="color: #666; margin-top: 5px;"><?php _e('Registrations', 'rise-ai-summit'); ?></div>
                </div>
                <div style="text-align: center; padding: 20px; background: #f0f0f1; border-radius: 4px;">
                    <div style="font-size: 36px; font-weight: bold; color: #0C2340;"><?php echo $sponsors_count; ?></div>
                    <div style="color: #666; margin-top: 5px;"><?php _e('Sponsor Inquiries', 'rise-ai-summit'); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    
    // Process export if form submitted
    if (isset($_POST['do_export'])) {
        rise_process_csv_export();
    }
}

/**
 * Process CSV Export
 */
function rise_process_csv_export() {
    
    // Security check
    if (!isset($_POST['export_nonce']) || !wp_verify_nonce($_POST['export_nonce'], 'rise_export_csv')) {
        wp_die(__('Security check failed', 'rise-ai-summit'));
    }
    
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have permission to export data', 'rise-ai-summit'));
    }
    
    // Get date range
    $date_from = !empty($_POST['date_from']) ? sanitize_text_field($_POST['date_from']) : '';
    $date_to = !empty($_POST['date_to']) ? sanitize_text_field($_POST['date_to']) : '';
    
    // Export format
    $format = isset($_POST['export_format']) ? $_POST['export_format'] : 'combined';
    
    if ($format === 'separate') {
        rise_export_separate_files($date_from, $date_to);
    } else {
        rise_export_combined_file($date_from, $date_to);
    }
}

/**
 * Export combined file
 */
function rise_export_combined_file($date_from = '', $date_to = '') {
    
    $filename = 'rise-ai-contacts-' . date('Y-m-d-His') . '.csv';
    
    // Set headers
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    $output = fopen('php://output', 'w');
    
    // UTF-8 BOM for Excel compatibility
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // ===== ABSTRACT SUBMISSIONS =====
    if (isset($_POST['export_abstracts'])) {
        
        fputcsv($output, array('===== ABSTRACT SUBMISSIONS ====='));
        fputcsv($output, array('First Name', 'Last Name', 'Email', 'Institution', 'Country', 'Phone', 'Track', 'Title', 'Status', 'Submitted Date'));
        
        $args = array(
            'post_type' => 'abstract_submission',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );
        
        // Add date filter
        if (!empty($date_from) || !empty($date_to)) {
            $args['date_query'] = array();
            if (!empty($date_from)) {
                $args['date_query']['after'] = $date_from;
            }
            if (!empty($date_to)) {
                $args['date_query']['before'] = $date_to;
            }
        }
        
        $abstracts = get_posts($args);
        
        foreach ($abstracts as $abstract) {
            $row = array(
                get_post_meta($abstract->ID, 'abstract_author_first_name', true),
                get_post_meta($abstract->ID, 'abstract_author_last_name', true),
                get_post_meta($abstract->ID, 'abstract_author_email', true),
                get_post_meta($abstract->ID, 'abstract_author_institution', true),
                get_post_meta($abstract->ID, 'abstract_author_country', true),
                get_post_meta($abstract->ID, 'abstract_author_phone', true),
                get_post_meta($abstract->ID, 'abstract_track', true),
                get_post_meta($abstract->ID, 'abstract_title', true),
                get_post_meta($abstract->ID, 'abstract_status', true),
                get_post_meta($abstract->ID, 'abstract_submitted_date', true)
            );
            fputcsv($output, $row);
        }
        
        fputcsv($output, array('')); // Blank line
        fputcsv($output, array('')); // Blank line
    }
    
    // ===== REGISTRATION INTERESTS =====
    if (isset($_POST['export_registrations'])) {
        
        fputcsv($output, array('===== REGISTRATION INTERESTS ====='));
        fputcsv($output, array('Full Name', 'Email', 'Institution', 'Country', 'Phone', 'Attendee Type', 'Interests', 'Newsletter', 'Submitted Date'));
        
        $args = array(
            'post_type' => 'preregistration',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );
        
        // Add date filter
        if (!empty($date_from) || !empty($date_to)) {
            $args['date_query'] = array();
            if (!empty($date_from)) {
                $args['date_query']['after'] = $date_from;
            }
            if (!empty($date_to)) {
                $args['date_query']['before'] = $date_to;
            }
        }
        
        $registrations = get_posts($args);
        
        foreach ($registrations as $registration) {
            $interests = get_post_meta($registration->ID, 'registration_interests', true);
            $interests_str = is_array($interests) ? implode(', ', $interests) : '';
            
            $row = array(
                get_post_meta($registration->ID, 'registration_full_name', true),
                get_post_meta($registration->ID, 'registration_email', true),
                get_post_meta($registration->ID, 'registration_institution', true),
                get_post_meta($registration->ID, 'registration_country', true),
                get_post_meta($registration->ID, 'registration_phone', true),
                get_post_meta($registration->ID, 'registration_attendee_type', true),
                $interests_str,
                get_post_meta($registration->ID, 'registration_newsletter', true),
                get_post_meta($registration->ID, 'registration_submitted_date', true)
            );
            fputcsv($output, $row);
        }
        
        fputcsv($output, array('')); // Blank line
        fputcsv($output, array('')); // Blank line
    }
    
    // ===== SPONSOR INQUIRIES =====
    if (isset($_POST['export_sponsors'])) {
        
        fputcsv($output, array('===== SPONSOR INQUIRIES ====='));
        fputcsv($output, array('Company', 'Industry', 'Website', 'Contact Name', 'Contact Title', 'Email', 'Phone', 'Status', 'Submitted Date'));
        
        $args = array(
            'post_type' => 'sponsor_inquiry',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );
        
        // Add date filter
        if (!empty($date_from) || !empty($date_to)) {
            $args['date_query'] = array();
            if (!empty($date_from)) {
                $args['date_query']['after'] = $date_from;
            }
            if (!empty($date_to)) {
                $args['date_query']['before'] = $date_to;
            }
        }
        
        $sponsors = get_posts($args);
        
        foreach ($sponsors as $sponsor) {
            $row = array(
                get_post_meta($sponsor->ID, 'sponsor_inquiry_company', true),
                get_post_meta($sponsor->ID, 'sponsor_inquiry_industry', true),
                get_post_meta($sponsor->ID, 'sponsor_inquiry_website', true),
                get_post_meta($sponsor->ID, 'sponsor_inquiry_contact_name', true),
                get_post_meta($sponsor->ID, 'sponsor_inquiry_contact_title', true),
                get_post_meta($sponsor->ID, 'sponsor_inquiry_contact_email', true),
                get_post_meta($sponsor->ID, 'sponsor_inquiry_contact_phone', true),
                get_post_meta($sponsor->ID, 'sponsor_inquiry_status', true),
                get_post_meta($sponsor->ID, 'sponsor_inquiry_submitted_date', true)
            );
            fputcsv($output, $row);
        }
    }
    
    fclose($output);
    exit;
}

/**
 * Export separate files (ZIP)
 */
function rise_export_separate_files($date_from = '', $date_to = '') {
    
    // Create temp directory
    $upload_dir = wp_upload_dir();
    $temp_dir = $upload_dir['basedir'] . '/rise-export-' . time();
    wp_mkdir_p($temp_dir);
    
    $files = array();
    
    // Export each type to separate file
    if (isset($_POST['export_abstracts'])) {
        $file = rise_export_abstracts_csv($temp_dir, $date_from, $date_to);
        if ($file) $files[] = $file;
    }
    
    if (isset($_POST['export_registrations'])) {
        $file = rise_export_registrations_csv($temp_dir, $date_from, $date_to);
        if ($file) $files[] = $file;
    }
    
    if (isset($_POST['export_sponsors'])) {
        $file = rise_export_sponsors_csv($temp_dir, $date_from, $date_to);
        if ($file) $files[] = $file;
    }
    
    // Create ZIP
    $zip_file = $temp_dir . '/rise-ai-export-' . date('Y-m-d-His') . '.zip';
    $zip = new ZipArchive();
    
    if ($zip->open($zip_file, ZipArchive::CREATE) === TRUE) {
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }
        $zip->close();
        
        // Download ZIP
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . basename($zip_file) . '"');
        header('Content-Length: ' . filesize($zip_file));
        readfile($zip_file);
        
        // Clean up
        foreach ($files as $file) {
            unlink($file);
        }
        unlink($zip_file);
        rmdir($temp_dir);
        
        exit;
    }
}

/**
 * Export abstracts to CSV file
 */
function rise_export_abstracts_csv($dir, $date_from, $date_to) {
    $filename = $dir . '/abstracts-' . date('Y-m-d') . '.csv';
    $output = fopen($filename, 'w');
    
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
    
    fputcsv($output, array('First Name', 'Last Name', 'Email', 'Institution', 'Country', 'Phone', 'Track', 'Title', 'Status', 'Submitted Date'));
    
    $args = array(
        'post_type' => 'abstract_submission',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );
    
    if (!empty($date_from) || !empty($date_to)) {
        $args['date_query'] = array();
        if (!empty($date_from)) $args['date_query']['after'] = $date_from;
        if (!empty($date_to)) $args['date_query']['before'] = $date_to;
    }
    
    $posts = get_posts($args);
    
    foreach ($posts as $post) {
        fputcsv($output, array(
            get_post_meta($post->ID, 'abstract_author_first_name', true),
            get_post_meta($post->ID, 'abstract_author_last_name', true),
            get_post_meta($post->ID, 'abstract_author_email', true),
            get_post_meta($post->ID, 'abstract_author_institution', true),
            get_post_meta($post->ID, 'abstract_author_country', true),
            get_post_meta($post->ID, 'abstract_author_phone', true),
            get_post_meta($post->ID, 'abstract_track', true),
            get_post_meta($post->ID, 'abstract_title', true),
            get_post_meta($post->ID, 'abstract_status', true),
            get_post_meta($post->ID, 'abstract_submitted_date', true)
        ));
    }
    
    fclose($output);
    return $filename;
}

/**
 * Export registrations to CSV file
 */
function rise_export_registrations_csv($dir, $date_from, $date_to) {
    $filename = $dir . '/registrations-' . date('Y-m-d') . '.csv';
    $output = fopen($filename, 'w');
    
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    fputcsv($output, array('Full Name', 'Email', 'Institution', 'Country', 'Phone', 'Attendee Type', 'Interests', 'Newsletter', 'Submitted Date'));
    
    $args = array(
        'post_type' => 'preregistration',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );
    
    if (!empty($date_from) || !empty($date_to)) {
        $args['date_query'] = array();
        if (!empty($date_from)) $args['date_query']['after'] = $date_from;
        if (!empty($date_to)) $args['date_query']['before'] = $date_to;
    }
    
    $posts = get_posts($args);
    
    foreach ($posts as $post) {
        $interests = get_post_meta($post->ID, 'registration_interests', true);
        $interests_str = is_array($interests) ? implode(', ', $interests) : '';
        
        fputcsv($output, array(
            get_post_meta($post->ID, 'registration_full_name', true),
            get_post_meta($post->ID, 'registration_email', true),
            get_post_meta($post->ID, 'registration_institution', true),
            get_post_meta($post->ID, 'registration_country', true),
            get_post_meta($post->ID, 'registration_phone', true),
            get_post_meta($post->ID, 'registration_attendee_type', true),
            $interests_str,
            get_post_meta($post->ID, 'registration_newsletter', true),
            get_post_meta($post->ID, 'registration_submitted_date', true)
        ));
    }
    
    fclose($output);
    return $filename;
}

/**
 * Export sponsors to CSV file
 */
function rise_export_sponsors_csv($dir, $date_from, $date_to) {
    $filename = $dir . '/sponsor-inquiries-' . date('Y-m-d') . '.csv';
    $output = fopen($filename, 'w');
    
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    fputcsv($output, array('Company', 'Industry', 'Website', 'Contact Name', 'Contact Title', 'Email', 'Phone', 'Status', 'Submitted Date'));
    
    $args = array(
        'post_type' => 'sponsor_inquiry',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );
    
    if (!empty($date_from) || !empty($date_to)) {
        $args['date_query'] = array();
        if (!empty($date_from)) $args['date_query']['after'] = $date_from;
        if (!empty($date_to)) $args['date_query']['before'] = $date_to;
    }
    
    $posts = get_posts($args);
    
    foreach ($posts as $post) {
        fputcsv($output, array(
            get_post_meta($post->ID, 'sponsor_inquiry_company', true),
            get_post_meta($post->ID, 'sponsor_inquiry_industry', true),
            get_post_meta($post->ID, 'sponsor_inquiry_website', true),
            get_post_meta($post->ID, 'sponsor_inquiry_contact_name', true),
            get_post_meta($post->ID, 'sponsor_inquiry_contact_title', true),
            get_post_meta($post->ID, 'sponsor_inquiry_contact_email', true),
            get_post_meta($post->ID, 'sponsor_inquiry_contact_phone', true),
            get_post_meta($post->ID, 'sponsor_inquiry_status', true),
            get_post_meta($post->ID, 'sponsor_inquiry_submitted_date', true)
        ));
    }
    
    fclose($output);
    return $filename;
}