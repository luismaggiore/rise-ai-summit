<?php
/**
 * Form Handlers
 * Process front-end contact forms
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * ==============================================
 * 1. ABSTRACT SUBMISSION HANDLER
 * ==============================================
 */
function rise_process_abstract_submission() {
    
    // Only run if form was submitted
    if (!isset($_POST['submit_abstract'])) {
        return;
    }
    
    // Verify nonce
    if (!isset($_POST['abstract_nonce']) || !wp_verify_nonce($_POST['abstract_nonce'], 'submit_abstract')) {
        wp_die(__('Security check failed', 'rise-ai-summit'));
    }
    
    // Sanitize all inputs
    $data = array(
        'first_name' => sanitize_text_field($_POST['author_first_name']),
        'last_name' => sanitize_text_field($_POST['author_last_name']),
        'email' => sanitize_email($_POST['author_email']),
        'institution' => sanitize_text_field($_POST['author_institution']),
        'country' => sanitize_text_field($_POST['author_country']),
        'phone' => sanitize_text_field($_POST['author_phone']),
        'track' => sanitize_text_field($_POST['track']),
        'title' => sanitize_text_field($_POST['abstract_title']),
        'content' => sanitize_textarea_field($_POST['abstract_content']),
        'keywords' => sanitize_text_field($_POST['keywords']),
        'presenter' => sanitize_text_field($_POST['presenter']),
    );
    
    // Validation errors array
    $errors = array();
    
    // Validate required fields
    if (empty($data['first_name'])) {
        $errors[] = __('First name is required', 'rise-ai-summit');
    }
    if (empty($data['last_name'])) {
        $errors[] = __('Last name is required', 'rise-ai-summit');
    }
    if (empty($data['email']) || !is_email($data['email'])) {
        $errors[] = __('Valid email is required', 'rise-ai-summit');
    }
    if (empty($data['institution'])) {
        $errors[] = __('Institution is required', 'rise-ai-summit');
    }
    if (empty($data['track'])) {
        $errors[] = __('Track selection is required', 'rise-ai-summit');
    }
    if (empty($data['title'])) {
        $errors[] = __('Abstract title is required', 'rise-ai-summit');
    }
    if (empty($data['content'])) {
        $errors[] = __('Abstract content is required', 'rise-ai-summit');
    }
    
    // Word count validation (500 words max)
    $word_count = str_word_count($data['content']);
    if ($word_count > 500) {
        $errors[] = sprintf(__('Abstract must be 500 words or less (currently %d words)', 'rise-ai-summit'), $word_count);
    }
    
    // Check consent checkboxes
    if (!isset($_POST['consent'])) {
        $errors[] = __('You must agree to the peer review process', 'rise-ai-summit');
    }
    if (!isset($_POST['code_of_conduct'])) {
        $errors[] = __('You must agree to the Code of Conduct', 'rise-ai-summit');
    }
    
    // If errors, store in session and redirect back
    if (!empty($errors)) {
        set_transient('abstract_errors_' . session_id(), $errors, 300);
        set_transient('abstract_data_' . session_id(), $_POST, 300);
        wp_redirect(add_query_arg('submission', 'error', wp_get_referer()));
        exit;
    }
    
    // Handle file upload (PDF)
    $file_id = 0;
    if (!empty($_FILES['abstract_file']['name'])) {
        $file_id = rise_handle_file_upload($_FILES['abstract_file'], 'abstract');
        if (is_wp_error($file_id)) {
            $errors[] = $file_id->get_error_message();
            set_transient('abstract_errors_' . session_id(), $errors, 300);
            wp_redirect(add_query_arg('submission', 'error', wp_get_referer()));
            exit;
        }
    }
    
    // Co-authors (if provided)
    $coauthors = array();
    if (isset($_POST['coauthor_name']) && is_array($_POST['coauthor_name'])) {
        foreach ($_POST['coauthor_name'] as $index => $name) {
            if (!empty($name)) {
                $coauthors[] = array(
                    'name' => sanitize_text_field($name),
                    'email' => sanitize_email($_POST['coauthor_email'][$index]),
                    'institution' => sanitize_text_field($_POST['coauthor_institution'][$index]),
                );
            }
        }
    }
    
    // Create the post
    $post_id = wp_insert_post(array(
        'post_type' => 'abstract_submission',
        'post_title' => $data['first_name'] . ' ' . $data['last_name'] . ' - ' . $data['title'],
        'post_content' => $data['content'],
        'post_status' => 'publish',
    ));
    
    if (is_wp_error($post_id)) {
        $errors[] = __('Error creating submission. Please try again.', 'rise-ai-summit');
        set_transient('abstract_errors_' . session_id(), $errors, 300);
        wp_redirect(add_query_arg('submission', 'error', wp_get_referer()));
        exit;
    }
    
    // Save all meta fields
    update_post_meta($post_id, 'abstract_author_first_name', $data['first_name']);
    update_post_meta($post_id, 'abstract_author_last_name', $data['last_name']);
    update_post_meta($post_id, 'abstract_author_email', $data['email']);
    update_post_meta($post_id, 'abstract_author_institution', $data['institution']);
    update_post_meta($post_id, 'abstract_author_country', $data['country']);
    update_post_meta($post_id, 'abstract_author_phone', $data['phone']);
    update_post_meta($post_id, 'abstract_track', $data['track']);
    update_post_meta($post_id, 'abstract_title', $data['title']);
    update_post_meta($post_id, 'abstract_keywords', $data['keywords']);
    update_post_meta($post_id, 'abstract_presenter', $data['presenter']);
    update_post_meta($post_id, 'abstract_coauthors', $coauthors);
    update_post_meta($post_id, 'abstract_file', $file_id);
    update_post_meta($post_id, 'abstract_status', 'pending');
    update_post_meta($post_id, 'abstract_submitted_date', current_time('mysql'));
    
    // Send email notifications
    rise_send_abstract_notification($post_id, $data);
    
    // Clear any stored data
    delete_transient('abstract_errors_' . session_id());
    delete_transient('abstract_data_' . session_id());
    
    // Redirect to success page
    wp_redirect(add_query_arg('submission', 'success', wp_get_referer()));
    exit;
}
add_action('template_redirect', 'rise_process_abstract_submission');

/**
 * ==============================================
 * 2. REGISTRATION INTEREST HANDLER
 * ==============================================
 */
function rise_process_registration() {
    
    if (!isset($_POST['submit_registration'])) {
        return;
    }
    
    // Verify nonce
    if (!isset($_POST['registration_nonce']) || !wp_verify_nonce($_POST['registration_nonce'], 'register_interest')) {
        wp_die(__('Security check failed', 'rise-ai-summit'));
    }
    
    // Sanitize inputs
    $data = array(
        'full_name' => sanitize_text_field($_POST['full_name']),
        'email' => sanitize_email($_POST['email']),
        'institution' => sanitize_text_field($_POST['institution']),
        'country' => sanitize_text_field($_POST['country']),
        'phone' => sanitize_text_field($_POST['phone']),
        'attendee_type' => sanitize_text_field($_POST['attendee_type']),
        'how_heard' => sanitize_text_field($_POST['how_heard']),
    );
    
    // Interests (checkboxes)
    $interests = array();
    if (isset($_POST['interests']) && is_array($_POST['interests'])) {
        $interests = array_map('sanitize_text_field', $_POST['interests']);
    }
    
    // Newsletter
    $newsletter = isset($_POST['newsletter']) ? 'yes' : 'no';
    
    // Validation
    $errors = array();
    if (empty($data['full_name'])) {
        $errors[] = __('Full name is required', 'rise-ai-summit');
    }
    if (empty($data['email']) || !is_email($data['email'])) {
        $errors[] = __('Valid email is required', 'rise-ai-summit');
    }
    if (empty($data['country'])) {
        $errors[] = __('Country is required', 'rise-ai-summit');
    }
    if (empty($data['attendee_type'])) {
        $errors[] = __('Attendee type is required', 'rise-ai-summit');
    }
    
    if (!empty($errors)) {
        set_transient('registration_errors_' . session_id(), $errors, 300);
        set_transient('registration_data_' . session_id(), $_POST, 300);
        wp_redirect(add_query_arg('submission', 'error', wp_get_referer()));
        exit;
    }
    
    // Create post
    $post_id = wp_insert_post(array(
        'post_type' => 'preregistration',
        'post_title' => $data['full_name'] . ' - ' . $data['email'],
        'post_status' => 'publish',
    ));
    
    if (is_wp_error($post_id)) {
        $errors[] = __('Error creating registration. Please try again.', 'rise-ai-summit');
        set_transient('registration_errors_' . session_id(), $errors, 300);
        wp_redirect(add_query_arg('submission', 'error', wp_get_referer()));
        exit;
    }
    
    // Save meta
    update_post_meta($post_id, 'registration_full_name', $data['full_name']);
    update_post_meta($post_id, 'registration_email', $data['email']);
    update_post_meta($post_id, 'registration_institution', $data['institution']);
    update_post_meta($post_id, 'registration_country', $data['country']);
    update_post_meta($post_id, 'registration_phone', $data['phone']);
    update_post_meta($post_id, 'registration_attendee_type', $data['attendee_type']);
    update_post_meta($post_id, 'registration_interests', $interests);
    update_post_meta($post_id, 'registration_how_heard', $data['how_heard']);
    update_post_meta($post_id, 'registration_newsletter', $newsletter);
    update_post_meta($post_id, 'registration_submitted_date', current_time('mysql'));
    
    // Send notifications
    rise_send_registration_notification($post_id, $data);
    
    // Clear transients
    delete_transient('registration_errors_' . session_id());
    delete_transient('registration_data_' . session_id());
    
    wp_redirect(add_query_arg('submission', 'success', wp_get_referer()));
    exit;
}
add_action('template_redirect', 'rise_process_registration');

/**
 * ==============================================
 * 3. SPONSOR INQUIRY HANDLER
 * ==============================================
 */
function rise_process_sponsor_inquiry() {
    
    if (!isset($_POST['submit_sponsor_inquiry'])) {
        return;
    }
    
    // Verify nonce
    if (!isset($_POST['sponsor_nonce']) || !wp_verify_nonce($_POST['sponsor_nonce'], 'sponsor_inquiry')) {
        wp_die(__('Security check failed', 'rise-ai-summit'));
    }
    
    // Sanitize
    $data = array(
        'company' => sanitize_text_field($_POST['company_name']),
        'industry' => sanitize_text_field($_POST['industry']),
        'website' => esc_url_raw($_POST['website']),
        'contact_name' => sanitize_text_field($_POST['contact_name']),
        'contact_title' => sanitize_text_field($_POST['contact_title']),
        'contact_email' => sanitize_email($_POST['contact_email']),
        'contact_phone' => sanitize_text_field($_POST['contact_phone']),
        'message' => sanitize_textarea_field($_POST['message']),
        'how_heard' => sanitize_text_field($_POST['how_heard']),
    );
    
    // Validation
    $errors = array();
    if (empty($data['company'])) {
        $errors[] = __('Company name is required', 'rise-ai-summit');
    }
    if (empty($data['contact_name'])) {
        $errors[] = __('Contact name is required', 'rise-ai-summit');
    }
    if (empty($data['contact_email']) || !is_email($data['contact_email'])) {
        $errors[] = __('Valid contact email is required', 'rise-ai-summit');
    }
    if (empty($data['message'])) {
        $errors[] = __('Message is required', 'rise-ai-summit');
    }
    
    if (!empty($errors)) {
        set_transient('sponsor_errors_' . session_id(), $errors, 300);
        set_transient('sponsor_data_' . session_id(), $_POST, 300);
        wp_redirect(add_query_arg('submission', 'error', wp_get_referer()));
        exit;
    }
    
    // Create post
    $post_id = wp_insert_post(array(
        'post_type' => 'sponsor_inquiry',
        'post_title' => $data['company'] . ' - ' . $data['contact_name'],
        'post_content' => $data['message'],
        'post_status' => 'publish',
    ));
    
    if (is_wp_error($post_id)) {
        $errors[] = __('Error creating inquiry. Please try again.', 'rise-ai-summit');
        set_transient('sponsor_errors_' . session_id(), $errors, 300);
        wp_redirect(add_query_arg('submission', 'error', wp_get_referer()));
        exit;
    }
    
    // Save meta
    update_post_meta($post_id, 'sponsor_inquiry_company', $data['company']);
    update_post_meta($post_id, 'sponsor_inquiry_industry', $data['industry']);
    update_post_meta($post_id, 'sponsor_inquiry_website', $data['website']);
    update_post_meta($post_id, 'sponsor_inquiry_contact_name', $data['contact_name']);
    update_post_meta($post_id, 'sponsor_inquiry_contact_title', $data['contact_title']);
    update_post_meta($post_id, 'sponsor_inquiry_contact_email', $data['contact_email']);
    update_post_meta($post_id, 'sponsor_inquiry_contact_phone', $data['contact_phone']);
    update_post_meta($post_id, 'sponsor_inquiry_how_heard', $data['how_heard']);
    update_post_meta($post_id, 'sponsor_inquiry_status', 'new');
    update_post_meta($post_id, 'sponsor_inquiry_submitted_date', current_time('mysql'));
    
    // Send notifications
    rise_send_sponsor_notification($post_id, $data);
    
    // Clear transients
    delete_transient('sponsor_errors_' . session_id());
    delete_transient('sponsor_data_' . session_id());
    
    wp_redirect(add_query_arg('submission', 'success', wp_get_referer()));
    exit;
}
add_action('template_redirect', 'rise_process_sponsor_inquiry');

/**
 * ==============================================
 * FILE UPLOAD HANDLER
 * ==============================================
 */
function rise_handle_file_upload($file, $context = 'general') {
    
    // Check if file was uploaded
    if (empty($file['name'])) {
        return 0;
    }
    
    // Validate file type (PDF only for abstracts)
    $allowed_types = array('application/pdf');
    $file_type = wp_check_filetype($file['name']);
    
    if (!in_array($file['type'], $allowed_types)) {
        return new WP_Error('invalid_file', __('Only PDF files are allowed', 'rise-ai-summit'));
    }
    
    // Check file size (5MB max)
    $max_size = 5 * 1024 * 1024; // 5MB in bytes
    if ($file['size'] > $max_size) {
        return new WP_Error('file_too_large', __('File size must be less than 5MB', 'rise-ai-summit'));
    }
    
    // Use WordPress upload handler
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    
    $upload = wp_handle_upload($file, array('test_form' => false));
    
    if (isset($upload['error'])) {
        return new WP_Error('upload_error', $upload['error']);
    }
    
    // Create attachment
    $attachment = array(
        'post_mime_type' => $upload['type'],
        'post_title' => sanitize_file_name($file['name']),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    
    $attach_id = wp_insert_attachment($attachment, $upload['file']);
    
    if (is_wp_error($attach_id)) {
        return $attach_id;
    }
    
    // Generate metadata
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);
    
    return $attach_id;
}

/**
 * Start session for error handling
 */
function rise_start_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'rise_start_session');