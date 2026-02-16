<?php
/**
 * Committee Member Metabox
 * Custom fields for committee members
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Committee Member metabox
 */
function rise_add_committee_metabox() {
    add_meta_box(
        'rise_committee_meta',
        __('Committee Member Details', 'rise-ai-summit'),
        'rise_committee_metabox_callback',
        'committee_member',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rise_add_committee_metabox');

/**
 * Metabox callback
 */
function rise_committee_metabox_callback($post) {
    wp_nonce_field('rise_committee_meta', 'committee_meta_nonce');
    
    // Get saved values
    $institution = get_post_meta($post->ID, 'committee_institution', true);
    $photo = get_post_meta($post->ID, 'committee_photo', true);
    $bio = get_post_meta($post->ID, 'committee_bio', true);
    $committee_category = get_post_meta($post->ID, 'committee_category', true);
    $display_order = get_post_meta($post->ID, 'committee_display_order', true);
    $email = get_post_meta($post->ID, 'committee_email', true);
    
    ?>
    <style>
        .committee-metabox-field {
            margin-bottom: 20px;
        }
        .committee-metabox-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #23282d;
        }
        .committee-metabox-field input[type="text"],
        .committee-metabox-field input[type="email"],
        .committee-metabox-field input[type="number"],
        .committee-metabox-field textarea,
        .committee-metabox-field select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .committee-metabox-field textarea {
            height: 100px;
        }
        .committee-photo-preview {
            margin-top: 10px;
        }
        .committee-photo-preview img {
            max-width: 150px;
            height: auto;
            border-radius: 8px;
            border: 2px solid #ddd;
        }
        .committee-upload-btn {
            margin-top: 10px;
        }
        .committee-metabox-help {
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin-top: 5px;
        }
        .committee-category-highlight {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
    
    <!-- Category Selection (MOST IMPORTANT) -->
    <div class="committee-category-highlight">
        <div class="committee-metabox-field">
            <label for="committee_category">
                <?php _e('Committee Category', 'rise-ai-summit'); ?> <span style="color: red;">*</span>
            </label>
            <select id="committee_category" name="committee_category" required>
                <option value=""><?php _e('-- Select Category --', 'rise-ai-summit'); ?></option>
                
                <optgroup label="<?php _e('General Chairs', 'rise-ai-summit'); ?>">
                    <option value="general-chair" <?php selected($committee_category, 'general-chair'); ?>>
                        <?php _e('General Chair', 'rise-ai-summit'); ?>
                    </option>
                </optgroup>
                
                <optgroup label="<?php _e('Program Chairs', 'rise-ai-summit'); ?>">
                    <option value="program-chair" <?php selected($committee_category, 'program-chair'); ?>>
                        <?php _e('Program Chair', 'rise-ai-summit'); ?>
                    </option>
                </optgroup>
                
                <optgroup label="<?php _e('Track Co-Chairs: Business', 'rise-ai-summit'); ?>">
                    <option value="track-business-sa" <?php selected($committee_category, 'track-business-sa'); ?>>
                        <?php _e('Business Track Co-Chair (South America)', 'rise-ai-summit'); ?>
                    </option>
                    <option value="track-business-nd" <?php selected($committee_category, 'track-business-nd'); ?>>
                        <?php _e('Business Track Co-Chair (Notre Dame)', 'rise-ai-summit'); ?>
                    </option>
                </optgroup>
                
                <optgroup label="<?php _e('Track Co-Chairs: Education', 'rise-ai-summit'); ?>">
                    <option value="track-education-sa" <?php selected($committee_category, 'track-education-sa'); ?>>
                        <?php _e('Education Track Co-Chair (South America)', 'rise-ai-summit'); ?>
                    </option>
                    <option value="track-education-nd" <?php selected($committee_category, 'track-education-nd'); ?>>
                        <?php _e('Education Track Co-Chair (Notre Dame)', 'rise-ai-summit'); ?>
                    </option>
                </optgroup>
                
                <optgroup label="<?php _e('Track Co-Chairs: Applied Science', 'rise-ai-summit'); ?>">
                    <option value="track-science-sa" <?php selected($committee_category, 'track-science-sa'); ?>>
                        <?php _e('Science Track Co-Chair (South America)', 'rise-ai-summit'); ?>
                    </option>
                    <option value="track-science-nd" <?php selected($committee_category, 'track-science-nd'); ?>>
                        <?php _e('Science Track Co-Chair (Notre Dame)', 'rise-ai-summit'); ?>
                    </option>
                </optgroup>
                
                <optgroup label="<?php _e('Local Team', 'rise-ai-summit'); ?>">
                    <option value="local-logistics" <?php selected($committee_category, 'local-logistics'); ?>>
                        <?php _e('Local Team - Logistics', 'rise-ai-summit'); ?>
                    </option>
                    <option value="local-communications" <?php selected($committee_category, 'local-communications'); ?>>
                        <?php _e('Local Team - Communications', 'rise-ai-summit'); ?>
                    </option>
                    <option value="local-sponsors" <?php selected($committee_category, 'local-sponsors'); ?>>
                        <?php _e('Local Team - Sponsors', 'rise-ai-summit'); ?>
                    </option>
                    <option value="local-web" <?php selected($committee_category, 'local-web'); ?>>
                        <?php _e('Local Team - Web Chair', 'rise-ai-summit'); ?>
                    </option>
                    <option value="local-other" <?php selected($committee_category, 'local-other'); ?>>
                        <?php _e('Local Team - Other', 'rise-ai-summit'); ?>
                    </option>
                </optgroup>
            </select>
            <p class="committee-metabox-help">
                <?php _e('This determines where this person appears on the Committee page.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </div>
    
 
    
    <!-- Institution -->
    <div class="committee-metabox-field">
        <label for="committee_institution">
            <?php _e('Institution/Organization', 'rise-ai-summit'); ?> <span style="color: red;">*</span>
        </label>
        <input type="text" 
               id="committee_institution" 
               name="committee_institution" 
               value="<?php echo esc_attr($institution); ?>"
               placeholder="e.g., Universidad de los Andes, University of Notre Dame"
               required>
    </div>
    
    <!-- Photo Upload -->
    <div class="committee-metabox-field">
        <label for="committee_photo">
            <?php _e('Photo', 'rise-ai-summit'); ?>
        </label>
        <div class="committee-photo-container">
            <input type="hidden" id="committee_photo" name="committee_photo" value="<?php echo esc_attr($photo); ?>">
            <div class="committee-photo-preview">
                <?php if ($photo): ?>
                    <?php echo wp_get_attachment_image($photo, 'thumbnail'); ?>
                <?php endif; ?>
            </div>
            <button type="button" class="button committee-upload-btn" id="committee_upload_photo">
                <?php echo $photo ? __('Change Photo', 'rise-ai-summit') : __('Upload Photo', 'rise-ai-summit'); ?>
            </button>
            <?php if ($photo): ?>
                <button type="button" class="button committee-remove-btn" id="committee_remove_photo">
                    <?php _e('Remove Photo', 'rise-ai-summit'); ?>
                </button>
            <?php endif; ?>
        </div>
        <p class="committee-metabox-help">
            <?php _e('Recommended: Square photo, at least 300x300px', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <!-- Bio -->
    <div class="committee-metabox-field">
        <label for="committee_bio">
            <?php _e('Short Bio', 'rise-ai-summit'); ?>
        </label>
        <textarea id="committee_bio" 
                  name="committee_bio" 
                  maxlength="300"><?php echo esc_textarea($bio); ?></textarea>
        <p class="committee-metabox-help">
            <?php _e('Max 300 characters. Brief description of expertise or role.', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <!-- Display Order -->
    <div class="committee-metabox-field">
        <label for="committee_display_order">
            <?php _e('Display Order', 'rise-ai-summit'); ?>
        </label>
        <input type="number" 
               id="committee_display_order" 
               name="committee_display_order" 
               value="<?php echo esc_attr($display_order ? $display_order : '0'); ?>"
               min="0"
               step="1">
        <p class="committee-metabox-help">
            <?php _e('Lower numbers appear first within each category. Leave 0 for alphabetical.', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <!-- Email (Optional) -->
    <div class="committee-metabox-field">
        <label for="committee_email">
            <?php _e('Email (Optional)', 'rise-ai-summit'); ?>
        </label>
        <input type="email" 
               id="committee_email" 
               name="committee_email" 
               value="<?php echo esc_attr($email); ?>"
               placeholder="contact@example.com">
        <p class="committee-metabox-help">
            <?php _e('Only shown if you want to display contact info publicly.', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        
        // Upload photo
        $('#committee_upload_photo').on('click', function(e) {
            e.preventDefault();
            
            var mediaUploader = wp.media({
                title: '<?php _e('Select Photo', 'rise-ai-summit'); ?>',
                button: {
                    text: '<?php _e('Use this photo', 'rise-ai-summit'); ?>'
                },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#committee_photo').val(attachment.id);
                $('.committee-photo-preview').html('<img src="' + attachment.url + '" style="max-width: 150px; height: auto; border-radius: 8px; border: 2px solid #ddd;">');
                $('#committee_upload_photo').text('<?php _e('Change Photo', 'rise-ai-summit'); ?>');
                if ($('#committee_remove_photo').length === 0) {
                    $('#committee_upload_photo').after('<button type="button" class="button committee-remove-btn" id="committee_remove_photo"><?php _e('Remove Photo', 'rise-ai-summit'); ?></button>');
                }
            });
            
            mediaUploader.open();
        });
        
        // Remove photo
        $(document).on('click', '#committee_remove_photo', function(e) {
            e.preventDefault();
            $('#committee_photo').val('');
            $('.committee-photo-preview').html('');
            $('#committee_upload_photo').text('<?php _e('Upload Photo', 'rise-ai-summit'); ?>');
            $(this).remove();
        });
        
    });
    </script>
    <?php
}

/**
 * Save metabox data
 */
function rise_save_committee_meta($post_id) {
    
    // Security checks
    if (!isset($_POST['committee_meta_nonce']) || !wp_verify_nonce($_POST['committee_meta_nonce'], 'rise_committee_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save fields
    $fields = array(
    
        'committee_institution' => 'sanitize_text_field',
        'committee_photo' => 'intval',
        'committee_bio' => 'sanitize_textarea_field',
        'committee_category' => 'sanitize_text_field',
        'committee_display_order' => 'intval',
        'committee_email' => 'sanitize_email'
    );
    
    foreach ($fields as $field => $sanitize_function) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $sanitize_function($_POST[$field]));
        }
    }
}
add_action('save_post', 'rise_save_committee_meta');