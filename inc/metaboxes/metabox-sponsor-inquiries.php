<?php
/**
 * Sponsor Inquiry Metaboxes
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Sponsor Inquiry metaboxes
 */
function rise_ai_add_sponsor_inquiry_metaboxes() {
    add_meta_box(
        'sponsor_inquiry_details',
        __('Inquiry Details', 'rise-ai-summit'),
        'rise_ai_sponsor_inquiry_details_callback',
        'sponsor_inquiry',
        'normal',
        'high'
    );
    
    add_meta_box(
        'sponsor_inquiry_status',
        __('Inquiry Status', 'rise-ai-summit'),
        'rise_ai_sponsor_inquiry_status_callback',
        'sponsor_inquiry',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'rise_ai_add_sponsor_inquiry_metaboxes');

/**
 * Inquiry Details Callback
 */
function rise_ai_sponsor_inquiry_details_callback($post) {
    wp_nonce_field('rise_ai_sponsor_inquiry_nonce', 'sponsor_inquiry_nonce');
    
    $company = get_post_meta($post->ID, 'sponsor_inquiry_company', true);
    $industry = get_post_meta($post->ID, 'sponsor_inquiry_industry', true);
    $website = get_post_meta($post->ID, 'sponsor_inquiry_website', true);
    $contact_name = get_post_meta($post->ID, 'sponsor_inquiry_contact_name', true);
    $contact_title = get_post_meta($post->ID, 'sponsor_inquiry_contact_title', true);
    $contact_email = get_post_meta($post->ID, 'sponsor_inquiry_contact_email', true);
    $contact_phone = get_post_meta($post->ID, 'sponsor_inquiry_contact_phone', true);
    $how_heard = get_post_meta($post->ID, 'sponsor_inquiry_how_heard', true);
    $submitted_date = get_post_meta($post->ID, 'sponsor_inquiry_submitted_date', true);
    ?>
    
    <h3><?php _e('Company Information', 'rise-ai-summit'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="sponsor_inquiry_company"><?php _e('Company Name', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="sponsor_inquiry_company" 
                       name="sponsor_inquiry_company" 
                       value="<?php echo esc_attr($company); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="sponsor_inquiry_industry"><?php _e('Industry/Sector', 'rise-ai-summit'); ?></label></th>
            <td>
                <select id="sponsor_inquiry_industry" name="sponsor_inquiry_industry">
                    <option value=""><?php _e('Select', 'rise-ai-summit'); ?></option>
                    <option value="tech" <?php selected($industry, 'tech'); ?>>
                        <?php _e('Technology', 'rise-ai-summit'); ?>
                    </option>
                    <option value="finance" <?php selected($industry, 'finance'); ?>>
                        <?php _e('Finance', 'rise-ai-summit'); ?>
                    </option>
                    <option value="healthcare" <?php selected($industry, 'healthcare'); ?>>
                        <?php _e('Healthcare', 'rise-ai-summit'); ?>
                    </option>
                    <option value="education" <?php selected($industry, 'education'); ?>>
                        <?php _e('Education', 'rise-ai-summit'); ?>
                    </option>
                    <option value="other" <?php selected($industry, 'other'); ?>>
                        <?php _e('Other', 'rise-ai-summit'); ?>
                    </option>
                </select>
            </td>
        </tr>
        
        <tr>
            <th><label for="sponsor_inquiry_website"><?php _e('Website', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="url" 
                       id="sponsor_inquiry_website" 
                       name="sponsor_inquiry_website" 
                       value="<?php echo esc_url($website); ?>" 
                       class="regular-text">
                <?php if ($website): ?>
                    <a href="<?php echo esc_url($website); ?>" target="_blank" class="button button-small">
                        <?php _e('Visit', 'rise-ai-summit'); ?>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    
    <h3><?php _e('Contact Person', 'rise-ai-summit'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="sponsor_inquiry_contact_name"><?php _e('Full Name', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="sponsor_inquiry_contact_name" 
                       name="sponsor_inquiry_contact_name" 
                       value="<?php echo esc_attr($contact_name); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="sponsor_inquiry_contact_title"><?php _e('Title/Position', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="sponsor_inquiry_contact_title" 
                       name="sponsor_inquiry_contact_title" 
                       value="<?php echo esc_attr($contact_title); ?>" 
                       class="regular-text">
            </td>
        </tr>
        
        <tr>
            <th><label for="sponsor_inquiry_contact_email"><?php _e('Email', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="email" 
                       id="sponsor_inquiry_contact_email" 
                       name="sponsor_inquiry_contact_email" 
                       value="<?php echo esc_attr($contact_email); ?>" 
                       class="regular-text">
                <?php if ($contact_email): ?>
                    <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="button button-small">
                        <i class="fa-solid fa-envelope"></i>
                        <?php _e('Email', 'rise-ai-summit'); ?>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        
        <tr>
            <th><label for="sponsor_inquiry_contact_phone"><?php _e('Phone', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="tel" 
                       id="sponsor_inquiry_contact_phone" 
                       name="sponsor_inquiry_contact_phone" 
                       value="<?php echo esc_attr($contact_phone); ?>" 
                       class="regular-text">
            </td>
        </tr>
    </table>
    
    <h3><?php _e('Additional Information', 'rise-ai-summit'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label><?php _e('Message', 'rise-ai-summit'); ?></label></th>
            <td>
                <p class="description">
                    <?php _e('The inquiry message is in the main editor above', 'rise-ai-summit'); ?>
                </p>
            </td>
        </tr>
        
        <tr>
            <th><label for="sponsor_inquiry_how_heard"><?php _e('How They Heard', 'rise-ai-summit'); ?></label></th>
            <td>
                <input type="text" 
                       id="sponsor_inquiry_how_heard" 
                       name="sponsor_inquiry_how_heard" 
                       value="<?php echo esc_attr($how_heard); ?>" 
                       class="regular-text">
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
 * Inquiry Status Callback
 */
function rise_ai_sponsor_inquiry_status_callback($post) {
    $status = get_post_meta($post->ID, 'sponsor_inquiry_status', true);
    if (!$status) {
        $status = 'new';
    }
    ?>
    
    <div class="rise-metabox-field">
        <label for="sponsor_inquiry_status">
            <strong><?php _e('Status', 'rise-ai-summit'); ?></strong>
        </label>
        <select id="sponsor_inquiry_status" name="sponsor_inquiry_status" style="width: 100%;">
            <option value="new" <?php selected($status, 'new'); ?>>
                <?php _e('New', 'rise-ai-summit'); ?>
            </option>
            <option value="contacted" <?php selected($status, 'contacted'); ?>>
                <?php _e('Contacted', 'rise-ai-summit'); ?>
            </option>
            <option value="in-progress" <?php selected($status, 'in-progress'); ?>>
                <?php _e('In Progress', 'rise-ai-summit'); ?>
            </option>
            <option value="closed" <?php selected($status, 'closed'); ?>>
                <?php _e('Closed', 'rise-ai-summit'); ?>
            </option>
        </select>
    </div>
    
    <div class="rise-metabox-field" style="margin-top: 20px;">
        <?php
        $status_descriptions = array(
            'new' => __('Fresh inquiry, needs review', 'rise-ai-summit'),
            'contacted' => __('Initial contact made', 'rise-ai-summit'),
            'in-progress' => __('Negotiating sponsorship', 'rise-ai-summit'),
            'closed' => __('Completed or declined', 'rise-ai-summit'),
        );
        
        if (isset($status_descriptions[$status])) {
            echo '<p class="description">' . esc_html($status_descriptions[$status]) . '</p>';
        }
        ?>
    </div>
    
    <div class="rise-metabox-field" style="margin-top: 20px;">
        <p><strong><?php _e('Quick Actions', 'rise-ai-summit'); ?></strong></p>
        <?php if ($contact_email = get_post_meta($post->ID, 'sponsor_inquiry_contact_email', true)): ?>
            <p>
                <a href="mailto:<?php echo esc_attr($contact_email); ?>?subject=RISE%20AI%20Summit%20Sponsorship" 
                   class="button button-secondary button-large" 
                   style="width: 100%; text-align: center;">
                    <i class="fa-solid fa-envelope"></i>
                    <?php _e('Send Email', 'rise-ai-summit'); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
    
    <?php
}

/**
 * Save Sponsor Inquiry Metabox Data
 */
function rise_ai_save_sponsor_inquiry_metaboxes($post_id) {
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Check nonce
    if (!isset($_POST['sponsor_inquiry_nonce']) || !wp_verify_nonce($_POST['sponsor_inquiry_nonce'], 'rise_ai_sponsor_inquiry_nonce')) {
        return;
    }
    
    // Save fields
    $fields = array(
        'sponsor_inquiry_company' => 'sanitize_text_field',
        'sponsor_inquiry_industry' => 'sanitize_text_field',
        'sponsor_inquiry_website' => 'esc_url_raw',
        'sponsor_inquiry_contact_name' => 'sanitize_text_field',
        'sponsor_inquiry_contact_title' => 'sanitize_text_field',
        'sponsor_inquiry_contact_email' => 'sanitize_email',
        'sponsor_inquiry_contact_phone' => 'sanitize_text_field',
        'sponsor_inquiry_how_heard' => 'sanitize_text_field',
        'sponsor_inquiry_status' => 'sanitize_text_field',
    );
    
    foreach ($fields as $field => $sanitize_callback) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $sanitize_callback($_POST[$field]));
        }
    }
}
add_action('save_post_sponsor_inquiry', 'rise_ai_save_sponsor_inquiry_metaboxes');