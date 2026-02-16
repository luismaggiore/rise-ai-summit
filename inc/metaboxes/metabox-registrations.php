<?php
/**
 * Registration Interest Metaboxes
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Registration metaboxes
 */
function rise_ai_add_registration_metaboxes() {
    add_meta_box(
        'registration_details',
        __('Registration Details', 'rise-ai-summit'),
        'rise_ai_registration_details_callback',
        'preregistration',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rise_ai_add_registration_metaboxes');

/**
 * Registration Details Callback
 */
function rise_ai_registration_details_callback($post) {
    wp_nonce_field('rise_ai_registration_nonce', 'registration_nonce');
    
    $full_name = get_post_meta($post->ID, 'registration_full_name', true);
    $email = get_post_meta($post->ID, 'registration_email', true);
    $institution = get_post_meta($post->ID, 'registration_institution', true);
    $country = get_post_meta($post->ID, 'registration_country', true);
    $phone = get_post_meta($post->ID, 'registration_phone', true);
    $attendee_type = get_post_meta($post->ID, 'registration_attendee_type', true);
    $interests = get_post_meta($post->ID, 'registration_interests', true);
    $how_heard = get_post_meta($post->ID, 'registration_how_heard', true);
    $newsletter = get_post_meta($post->ID, 'registration_newsletter', true);
    $submitted_date = get_post_meta($post->ID, 'registration_submitted_date', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th><label for="registration_full_name"><?php _e('Full Name', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="registration_full_name" 
                       name="registration_full_name" 
                       value="<?php echo esc_attr($full_name); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="registration_email"><?php _e('Email', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="email" 
                       id="registration_email" 
                       name="registration_email" 
                       value="<?php echo esc_attr($email); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="registration_institution"><?php _e('Institution', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="registration_institution" 
                       name="registration_institution" 
                       value="<?php echo esc_attr($institution); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="registration_country"><?php _e('Country', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="registration_country" 
                       name="registration_country" 
                       value="<?php echo esc_attr($country); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="registration_phone"><?php _e('Phone', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="registration_phone" 
                       name="registration_phone" 
                       value="<?php echo esc_attr($phone); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="registration_attendee_type"><?php _e('Attendee Type', 'rise-ai-summit'); ?></label></th>
            <td>
                <select id="registration_attendee_type" name="registration_attendee_type">
                    <option value=""><?php _e('Select', 'rise-ai-summit'); ?></option>
                    <option value="academic" <?php selected($attendee_type, 'academic'); ?>>
                        <?php _e('Academic/Researcher', 'rise-ai-summit'); ?>
                    </option>
                    <option value="industry" <?php selected($attendee_type, 'industry'); ?>>
                        <?php _e('Industry Professional', 'rise-ai-summit'); ?>
                    </option>
                    <option value="student" <?php selected($attendee_type, 'student'); ?>>
                        <?php _e('Student', 'rise-ai-summit'); ?>
                    </option>
                    <option value="other" <?php selected($attendee_type, 'other'); ?>>
                        <?php _e('Other', 'rise-ai-summit'); ?>
                    </option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th><label><?php _e('Areas of Interest', 'rise-ai-summit'); ?></label></th>
            <td>
                <?php 
                $interests_array = is_array($interests) ? $interests : array();
                ?>
                <label>
                    <input type="checkbox" name="registration_interests[]" value="business" 
                           <?php checked(in_array('business', $interests_array)); ?>>
                    <?php _e('Business Track', 'rise-ai-summit'); ?>
                </label><br>
                <label>
                    <input type="checkbox" name="registration_interests[]" value="education" 
                           <?php checked(in_array('education', $interests_array)); ?>>
                    <?php _e('Education Track', 'rise-ai-summit'); ?>
                </label><br>
                <label>
                    <input type="checkbox" name="registration_interests[]" value="science" 
                           <?php checked(in_array('science', $interests_array)); ?>>
                    <?php _e('Applied Science Track', 'rise-ai-summit'); ?>
                </label>
            </td>
        </tr>
        
        <tr>
            <th><label for="registration_how_heard"><?php _e('How They Heard', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="registration_how_heard" 
                       name="registration_how_heard" 
                       value="<?php echo esc_attr($how_heard); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label><?php _e('Newsletter Subscription', 'rise-ai-summit'); ?></label></th>
            <td>
                <label>
                    <input type="checkbox" name="registration_newsletter" value="yes" 
                           <?php checked($newsletter, 'yes'); ?>>
                    <?php _e('Subscribed to newsletter', 'rise-ai-summit'); ?>
                </label>
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
 * Save Registration Metabox Data
 */
function rise_ai_save_registration_metaboxes($post_id) {
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Check nonce
    if (!isset($_POST['registration_nonce']) || !wp_verify_nonce($_POST['registration_nonce'], 'rise_ai_registration_nonce')) {
        return;
    }
    
    // Save fields
    $fields = array(
        'registration_full_name' => 'sanitize_text_field',
        'registration_email' => 'sanitize_email',
        'registration_institution' => 'sanitize_text_field',
        'registration_country' => 'sanitize_text_field',
        'registration_phone' => 'sanitize_text_field',
        'registration_attendee_type' => 'sanitize_text_field',
        'registration_how_heard' => 'sanitize_text_field',
    );
    
    foreach ($fields as $field => $sanitize_callback) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $sanitize_callback($_POST[$field]));
        }
    }
    
    // Save interests (array)
    if (isset($_POST['registration_interests'])) {
        $interests = array_map('sanitize_text_field', $_POST['registration_interests']);
        update_post_meta($post_id, 'registration_interests', $interests);
    } else {
        delete_post_meta($post_id, 'registration_interests');
    }
    
    // Save newsletter checkbox
    $newsletter = isset($_POST['registration_newsletter']) ? 'yes' : 'no';
    update_post_meta($post_id, 'registration_newsletter', $newsletter);
}
add_action('save_post_registration_interest', 'rise_ai_save_registration_metaboxes');