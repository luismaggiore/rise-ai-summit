<?php
/**
 * Speaker Metabox
 * Custom fields for speakers
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Speaker metabox
 */
function rise_add_speaker_metabox() {
    add_meta_box(
        'rise_speaker_meta',
        __('Speaker Details', 'rise-ai-summit'),
        'rise_speaker_metabox_callback',
        'speaker',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rise_add_speaker_metabox');

/**
 * Metabox callback
 */
function rise_speaker_metabox_callback($post) {
    wp_nonce_field('rise_speaker_meta', 'speaker_meta_nonce');
    
    // Get saved values
    $position = get_post_meta($post->ID, 'speaker_position', true);
    $institution = get_post_meta($post->ID, 'speaker_institution', true);
    $bio = get_post_meta($post->ID, 'speaker_bio', true);
    $photo = get_post_meta($post->ID, 'speaker_photo', true);
    $talk_title = get_post_meta($post->ID, 'speaker_talk_title', true);
    $talk_description = get_post_meta($post->ID, 'speaker_talk_description', true);
    $track = get_post_meta($post->ID, 'speaker_track', true);
    $speaker_type = get_post_meta($post->ID, 'speaker_type', true);
    $linkedin = get_post_meta($post->ID, 'speaker_linkedin', true);
    $twitter = get_post_meta($post->ID, 'speaker_twitter', true);
    $website = get_post_meta($post->ID, 'speaker_website', true);
    
    ?>
    <style>
        .speaker-metabox-field {
            margin-bottom: 20px;
        }
        .speaker-metabox-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #23282d;
        }
        .speaker-metabox-field input[type="text"],
        .speaker-metabox-field input[type="url"],
        .speaker-metabox-field input[type="email"],
        .speaker-metabox-field textarea,
        .speaker-metabox-field select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .speaker-metabox-field textarea {
            height: 100px;
        }
        .speaker-photo-preview {
            margin-top: 10px;
        }
        .speaker-photo-preview img {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            border: 2px solid #ddd;
        }
        .speaker-type-highlight {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-bottom: 20px;
        }
        .speaker-metabox-help {
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin-top: 5px;
        }
    </style>
    
    <!-- SPEAKER TYPE (MOST IMPORTANT) -->
    <div class="speaker-type-highlight">
        <div class="speaker-metabox-field">
            <label for="speaker_type">
                <?php _e('Speaker Type', 'rise-ai-summit'); ?> <span style="color: red;">*</span>
            </label>
            <select id="speaker_type" name="speaker_type" required>
                <option value=""><?php _e('-- Select Type --', 'rise-ai-summit'); ?></option>
                <option value="keynote" <?php selected($speaker_type, 'keynote'); ?>>
                    <?php _e('⭐ Keynote Speaker', 'rise-ai-summit'); ?>
                </option>
                <option value="panelist" <?php selected($speaker_type, 'panelist'); ?>>
                    <?php _e('👥 Featured Panelist', 'rise-ai-summit'); ?>
                </option>
              
            </select>
            <p class="speaker-metabox-help">
                <strong><?php _e('Keynote:', 'rise-ai-summit'); ?></strong> <?php _e('Large card with photo, bio, talk title (3-column grid)', 'rise-ai-summit'); ?><br>
                <strong><?php _e('Panelist:', 'rise-ai-summit'); ?></strong> <?php _e('Compact circular photo with name (5-column grid)', 'rise-ai-summit'); ?>
            </p>
        </div>
    </div>
    
    <!-- Basic Info -->

    
    <div class="speaker-metabox-field">
        <label for="speaker_position">
            <?php _e('Description', 'rise-ai-summit'); ?> <span style="color: red;">*</span>
        </label>
        <input type="text" 
               id="speaker_position" 
               name="speaker_position" 
               value="<?php echo esc_attr($position); ?>"
               placeholder="e.g., Professor, Director, CEO"
               required>
    </div>
    
    <div class="speaker-metabox-field">
        <label for="speaker_institution">
            <?php _e('Institution/Organization', 'rise-ai-summit'); ?> <span style="color: red;">*</span>
        </label>
        <input type="text" 
               id="speaker_institution" 
               name="speaker_institution" 
               value="<?php echo esc_attr($institution); ?>"
               placeholder="e.g., University of Notre Dame"
               required>
    </div>
    
    <!-- Photo Upload -->
    <div class="speaker-metabox-field">
        <label for="speaker_photo">
            <?php _e('Photo', 'rise-ai-summit'); ?> <span style="color: red;">*</span>
        </label>
        <div class="speaker-photo-container">
            <input type="hidden" id="speaker_photo" name="speaker_photo" value="<?php echo esc_attr($photo); ?>">
            <div class="speaker-photo-preview">
                <?php if ($photo): ?>
                    <?php echo wp_get_attachment_image($photo, 'medium'); ?>
                <?php endif; ?>
            </div>
            <button type="button" class="button speaker-upload-btn" id="speaker_upload_photo">
                <?php echo $photo ? __('Change Photo', 'rise-ai-summit') : __('Upload Photo', 'rise-ai-summit'); ?>
            </button>
            <?php if ($photo): ?>
                <button type="button" class="button speaker-remove-btn" id="speaker_remove_photo">
                    <?php _e('Remove Photo', 'rise-ai-summit'); ?>
                </button>
            <?php endif; ?>
        </div>
        <p class="speaker-metabox-help">
            <?php _e('Recommended: Professional headshot, at least 800x1000px (4:5 ratio)', 'rise-ai-summit'); ?>
        </p>
    </div>
    
  
    
    <!-- Talk Details (mainly for Keynotes) -->
    <div class="speaker-metabox-field">
        <label for="speaker_talk_title">
            <?php _e('Talk Title', 'rise-ai-summit'); ?>
        </label>
        <input type="text" 
               id="speaker_talk_title" 
               name="speaker_talk_title" 
               value="<?php echo esc_attr($talk_title); ?>"
               placeholder="e.g., The Future of Ethical AI">
        <p class="speaker-metabox-help">
            <?php _e('Shown on hover for keynote speakers', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <div class="speaker-metabox-field">
        <label for="speaker_talk_description">
            <?php _e('Talk Description', 'rise-ai-summit'); ?>
        </label>
        <textarea id="speaker_talk_description" 
                  name="speaker_talk_description"><?php echo esc_textarea($talk_description); ?></textarea>
        <p class="speaker-metabox-help">
            <?php _e('Full description of the presentation/talk (optional)', 'rise-ai-summit'); ?>
        </p>
    </div>
    
  <!-- Bio -->
    <div class="speaker-metabox-field">
        <label for="speaker_bio">
            <?php _e('Bio', 'rise-ai-summit'); ?>
        </label>
        <textarea id="speaker_bio" 
                  name="speaker_bio" 
                  maxlength="500"><?php echo esc_textarea($bio); ?></textarea>
        <p class="speaker-metabox-help">
            <?php _e('Max 500 characters. Brief professional biography.', 'rise-ai-summit'); ?>
        </p>
    </div>

    <!-- Track -->
    <div class="speaker-metabox-field">
        <label for="speaker_track">
            <?php _e('Track', 'rise-ai-summit'); ?>
        </label>
        <select id="speaker_track" name="speaker_track">
            <option value=""><?php _e('-- Not Assigned --', 'rise-ai-summit'); ?></option>
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
    </div>
    
    <!-- Social Links -->
    <div class="speaker-metabox-field">
        <label for="speaker_linkedin">
            <?php _e('LinkedIn URL', 'rise-ai-summit'); ?>
        </label>
        <input type="url" 
               id="speaker_linkedin" 
               name="speaker_linkedin" 
               value="<?php echo esc_attr($linkedin); ?>"
               placeholder="https://linkedin.com/in/username">
    </div>
    
    <div class="speaker-metabox-field">
        <label for="speaker_twitter">
            <?php _e('Twitter/X URL', 'rise-ai-summit'); ?>
        </label>
        <input type="url" 
               id="speaker_twitter" 
               name="speaker_twitter" 
               value="<?php echo esc_attr($twitter); ?>"
               placeholder="https://twitter.com/username">
    </div>
    
    <div class="speaker-metabox-field">
        <label for="speaker_website">
            <?php _e('Personal Website', 'rise-ai-summit'); ?>
        </label>
        <input type="url" 
               id="speaker_website" 
               name="speaker_website" 
               value="<?php echo esc_attr($website); ?>"
               placeholder="https://example.com">
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        
        // Upload photo
        $('#speaker_upload_photo').on('click', function(e) {
            e.preventDefault();
            
            var mediaUploader = wp.media({
                title: '<?php _e('Select Speaker Photo', 'rise-ai-summit'); ?>',
                button: {
                    text: '<?php _e('Use this photo', 'rise-ai-summit'); ?>'
                },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#speaker_photo').val(attachment.id);
                $('.speaker-photo-preview').html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto; border-radius: 8px; border: 2px solid #ddd;">');
                $('#speaker_upload_photo').text('<?php _e('Change Photo', 'rise-ai-summit'); ?>');
                if ($('#speaker_remove_photo').length === 0) {
                    $('#speaker_upload_photo').after('<button type="button" class="button speaker-remove-btn" id="speaker_remove_photo"><?php _e('Remove Photo', 'rise-ai-summit'); ?></button>');
                }
            });
            
            mediaUploader.open();
        });
        
        // Remove photo
        $(document).on('click', '#speaker_remove_photo', function(e) {
            e.preventDefault();
            $('#speaker_photo').val('');
            $('.speaker-photo-preview').html('');
            $('#speaker_upload_photo').text('<?php _e('Upload Photo', 'rise-ai-summit'); ?>');
            $(this).remove();
        });
        
    });
    </script>
    <?php
}

/**
 * Save metabox data
 */
function rise_save_speaker_meta($post_id) {
    
    // Security checks
    if (!isset($_POST['speaker_meta_nonce']) || !wp_verify_nonce($_POST['speaker_meta_nonce'], 'rise_speaker_meta')) {
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
        'speaker_position' => 'sanitize_text_field',
        'speaker_institution' => 'sanitize_text_field',
        'speaker_bio' => 'sanitize_textarea_field',
        'speaker_photo' => 'intval',
        'speaker_talk_title' => 'sanitize_text_field',
        'speaker_talk_description' => 'sanitize_textarea_field',
        'speaker_track' => 'sanitize_text_field',
        'speaker_type' => 'sanitize_text_field',
        'speaker_linkedin' => 'esc_url_raw',
        'speaker_twitter' => 'esc_url_raw',
        'speaker_website' => 'esc_url_raw'
    );
    
    foreach ($fields as $field => $sanitize_function) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $sanitize_function($_POST[$field]));
        }
    }
}
add_action('save_post', 'rise_save_speaker_meta');