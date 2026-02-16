<?php
/**
 * Abstract Submission Metaboxes
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Abstract metaboxes
 */
function rise_ai_add_abstract_metaboxes() {
    add_meta_box(
        'abstract_author_info',
        __('Author Information', 'rise-ai-summit'),
        'rise_ai_abstract_author_callback',
        'abstract_submission',
        'normal',
        'high'
    );
    
    add_meta_box(
        'abstract_submission_details',
        __('Submission Details', 'rise-ai-summit'),
        'rise_ai_abstract_details_callback',
        'abstract_submission',
        'normal',
        'high'
    );
    
    add_meta_box(
        'abstract_review',
        __('Review & Status', 'rise-ai-summit'),
        'rise_ai_abstract_review_callback',
        'abstract_submission',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'rise_ai_add_abstract_metaboxes');

/**
 * Author Information Callback
 */
function rise_ai_abstract_author_callback($post) {
    wp_nonce_field('rise_ai_abstract_nonce', 'abstract_nonce');
    
    $first_name = get_post_meta($post->ID, 'abstract_author_first_name', true);
    $last_name = get_post_meta($post->ID, 'abstract_author_last_name', true);
    $email = get_post_meta($post->ID, 'abstract_author_email', true);
    $institution = get_post_meta($post->ID, 'abstract_author_institution', true);
    $country = get_post_meta($post->ID, 'abstract_author_country', true);
    $phone = get_post_meta($post->ID, 'abstract_author_phone', true);
    $coauthors = get_post_meta($post->ID, 'abstract_coauthors', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th><label for="abstract_author_first_name"><?php _e('First Name', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="abstract_author_first_name" 
                       name="abstract_author_first_name" 
                       value="<?php echo esc_attr($first_name); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="abstract_author_last_name"><?php _e('Last Name', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="abstract_author_last_name" 
                       name="abstract_author_last_name" 
                       value="<?php echo esc_attr($last_name); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="abstract_author_email"><?php _e('Email', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="email" 
                       id="abstract_author_email" 
                       name="abstract_author_email" 
                       value="<?php echo esc_attr($email); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="abstract_author_institution"><?php _e('Institution', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="abstract_author_institution" 
                       name="abstract_author_institution" 
                       value="<?php echo esc_attr($institution); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="abstract_author_country"><?php _e('Country', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="abstract_author_country" 
                       name="abstract_author_country" 
                       value="<?php echo esc_attr($country); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="abstract_author_phone"><?php _e('Phone', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="abstract_author_phone" 
                       name="abstract_author_phone" 
                       value="<?php echo esc_attr($phone); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="abstract_coauthors"><?php _e('Co-Authors', 'rise-ai-summit'); ?></label></th>
            <td>
                <textarea id="abstract_coauthors" 
                          name="abstract_coauthors" 
                          rows="4" 
                          class="large-text"><?php echo esc_textarea($coauthors); ?></textarea>
                <p class="description">
                    <?php _e('One per line or comma-separated', 'rise-ai-summit'); ?>
                </p>
            </td>
        </tr>
    </table>
    
    <?php
}

/**
 * Submission Details Callback
 */
function rise_ai_abstract_details_callback($post) {
    $track = get_post_meta($post->ID, 'abstract_track', true);
    $title = get_post_meta($post->ID, 'abstract_title', true);
    $keywords = get_post_meta($post->ID, 'abstract_keywords', true);
    $presenter = get_post_meta($post->ID, 'abstract_presenter', true);
    $file_id = get_post_meta($post->ID, 'abstract_file', true);
    $submitted_date = get_post_meta($post->ID, 'abstract_submitted_date', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th><label for="abstract_track"><?php _e('Track', 'rise-ai-summit'); ?></label></th>
            <td>
                <select id="abstract_track" name="abstract_track">
                    <option value=""><?php _e('Select Track', 'rise-ai-summit'); ?></option>
                    <option value="business" <?php selected($track, 'business'); ?>>
                        <?php _e('Business: Strategy & Governance', 'rise-ai-summit'); ?>
                    </option>
                    <option value="education" <?php selected($track, 'education'); ?>>
                        <?php _e('Education: Policy & Skills', 'rise-ai-summit'); ?>
                    </option>
                    <option value="science" <?php selected($track, 'science'); ?>>
                        <?php _e('Applied Science: Health & Engineering', 'rise-ai-summit'); ?>
                    </option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th><label for="abstract_title"><?php _e('Presentation Title', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="abstract_title" 
                       name="abstract_title" 
                       value="<?php echo esc_attr($title); ?>" 
                       class="large-text">
            </td>
        </tr>
        
        <tr>
            <th><label><?php _e('Abstract Content', 'rise-ai-summit'); ?></label></th>
            <td>
                <p class="description">
                    <?php _e('The abstract content is in the main editor above', 'rise-ai-summit'); ?>
                </p>
            </td>
        </tr>
        
        <tr>
            <th><label for="abstract_keywords"><?php _e('Keywords', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="abstract_keywords" 
                       name="abstract_keywords" 
                       value="<?php echo esc_attr($keywords); ?>" 
                       class="large-text">
                <p class="description">
                    <?php _e('Comma-separated keywords', 'rise-ai-summit'); ?>
                </p>
            </td>
        </tr>
        
        <tr>
            <th><label for="abstract_presenter"><?php _e('Presenter', 'rise-ai-summit'); ?></label></th>
            <td>
                <select id="abstract_presenter" name="abstract_presenter">
                    <option value=""><?php _e('Select', 'rise-ai-summit'); ?></option>
                    <option value="primary" <?php selected($presenter, 'primary'); ?>>
                        <?php _e('Primary Author', 'rise-ai-summit'); ?>
                    </option>
                    <option value="coauthor" <?php selected($presenter, 'coauthor'); ?>>
                        <?php _e('Co-Author', 'rise-ai-summit'); ?>
                    </option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th><label><?php _e('Supporting Document', 'rise-ai-summit'); ?></label></th>
            <td>
                <?php 
                if ($file_id) {
                    $file_url = wp_get_attachment_url($file_id);
                    $file_name = basename($file_url);
                    ?>
                    <p>
                        <a href="<?php echo esc_url($file_url); ?>" target="_blank">
                            <i class="fa-solid fa-file-pdf"></i>
                            <?php echo esc_html($file_name); ?>
                        </a>
                    </p>
                    <?php
                } else {
                    ?>
                    <p><?php _e('No file uploaded', 'rise-ai-summit'); ?></p>
                    <?php
                }
                ?>
            </td>
        </tr>
        
        <tr>
            <th><label><?php _e('Submitted Date', 'rise-ai-summit'); ?></label></th>
            <td>
                <strong><?php echo $submitted_date ? esc_html($submitted_date) : '—'; ?></strong>
            </td>
        </tr>
    </table>
    
    <?php
}

/**
 * Review & Status Callback
 */
function rise_ai_abstract_review_callback($post) {
    $status = get_post_meta($post->ID, 'abstract_status', true);
    $reviewed_by = get_post_meta($post->ID, 'abstract_reviewed_by', true);
    ?>
    
    <div class="rise-metabox-field">
        <label for="abstract_status">
            <strong><?php _e('Status', 'rise-ai-summit'); ?></strong>
        </label>
        <select id="abstract_status" name="abstract_status" style="width: 100%;">
            <option value="pending" <?php selected($status, 'pending'); ?>>
                <?php _e('Pending', 'rise-ai-summit'); ?>
            </option>
            <option value="under-review" <?php selected($status, 'under-review'); ?>>
                <?php _e('Under Review', 'rise-ai-summit'); ?>
            </option>
            <option value="accepted" <?php selected($status, 'accepted'); ?>>
                <?php _e('Accepted', 'rise-ai-summit'); ?>
            </option>
            <option value="rejected" <?php selected($status, 'rejected'); ?>>
                <?php _e('Rejected', 'rise-ai-summit'); ?>
            </option>
        </select>
    </div>
    
    <div class="rise-metabox-field" style="margin-top: 15px;">
        <label>
            <strong><?php _e('Reviewed By', 'rise-ai-summit'); ?></strong>
        </label>
        <?php 
        if ($reviewed_by) {
            $reviewer = get_userdata($reviewed_by);
            if ($reviewer) {
                echo '<p>' . esc_html($reviewer->display_name) . '</p>';
            }
        } else {
            ?>
            <p><?php _e('Not yet reviewed', 'rise-ai-summit'); ?></p>
            <?php
        }
        ?>
    </div>
    
    <div class="rise-metabox-field" style="margin-top: 15px;">
        <p class="description">
            <?php _e('Changing status will automatically update the reviewed by field.', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <?php
}

/**
 * Save Abstract Metabox Data
 */
function rise_ai_save_abstract_metaboxes($post_id) {
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Check nonce
    if (!isset($_POST['abstract_nonce']) || !wp_verify_nonce($_POST['abstract_nonce'], 'rise_ai_abstract_nonce')) {
        return;
    }
    
    // Author info
    $fields = array(
        'abstract_author_first_name' => 'sanitize_text_field',
        'abstract_author_last_name' => 'sanitize_text_field',
        'abstract_author_email' => 'sanitize_email',
        'abstract_author_institution' => 'sanitize_text_field',
        'abstract_author_country' => 'sanitize_text_field',
        'abstract_author_phone' => 'sanitize_text_field',
        'abstract_coauthors' => 'sanitize_textarea_field',
    );
    
    foreach ($fields as $field => $sanitize_callback) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $sanitize_callback($_POST[$field]));
        }
    }
    
    // Submission details
    if (isset($_POST['abstract_track'])) {
        update_post_meta($post_id, 'abstract_track', sanitize_text_field($_POST['abstract_track']));
    }
    
    if (isset($_POST['abstract_title'])) {
        update_post_meta($post_id, 'abstract_title', sanitize_text_field($_POST['abstract_title']));
    }
    
    if (isset($_POST['abstract_keywords'])) {
        update_post_meta($post_id, 'abstract_keywords', sanitize_text_field($_POST['abstract_keywords']));
    }
    
    if (isset($_POST['abstract_presenter'])) {
        update_post_meta($post_id, 'abstract_presenter', sanitize_text_field($_POST['abstract_presenter']));
    }
    
    // Status
    if (isset($_POST['abstract_status'])) {
        $old_status = get_post_meta($post_id, 'abstract_status', true);
        $new_status = sanitize_text_field($_POST['abstract_status']);
        
        update_post_meta($post_id, 'abstract_status', $new_status);
        
        // Update reviewer if status changed
        if ($old_status !== $new_status && $new_status !== 'pending') {
            update_post_meta($post_id, 'abstract_reviewed_by', get_current_user_id());
        }
    }
}
add_action('save_post_abstract_submission', 'rise_ai_save_abstract_metaboxes');