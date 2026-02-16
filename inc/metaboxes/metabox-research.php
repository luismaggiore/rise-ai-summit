<?php
/**
 * Research Metabox
 * Custom fields for research publications
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Research metabox
 */
function rise_add_research_metabox() {
    add_meta_box(
        'rise_research_meta',
        __('Research Details', 'rise-ai-summit'),
        'rise_research_metabox_callback',
        'research',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rise_add_research_metabox');

/**
 * Metabox callback
 */
function rise_research_metabox_callback($post) {
    wp_nonce_field('rise_research_meta', 'research_meta_nonce');
    
    // Get saved values
    $authors = get_post_meta($post->ID, 'research_authors', true);
    $institutions = get_post_meta($post->ID, 'research_institutions', true);
    $abstract = get_post_meta($post->ID, 'research_abstract', true);
    $keywords = get_post_meta($post->ID, 'research_keywords', true);
    $pdf_file = get_post_meta($post->ID, 'research_pdf', true);
    $presentation_type = get_post_meta($post->ID, 'research_presentation_type', true);
    $session_date = get_post_meta($post->ID, 'research_session_date', true);
    $session_time = get_post_meta($post->ID, 'research_session_time', true);
    $session_room = get_post_meta($post->ID, 'research_session_room', true);
    $contact_email = get_post_meta($post->ID, 'research_contact_email', true);
    ?>
    
    <style>
        .research-metabox-field {
            margin-bottom: 20px;
        }
        .research-metabox-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #23282d;
        }
        .research-metabox-field input[type="text"],
        .research-metabox-field input[type="email"],
        .research-metabox-field input[type="date"],
        .research-metabox-field input[type="time"],
        .research-metabox-field textarea,
        .research-metabox-field select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .research-metabox-field textarea {
            height: 120px;
        }
        .research-metabox-help {
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin-top: 5px;
        }
        .research-section {
            background: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #0C2340;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .research-section h4 {
            margin: 0 0 15px 0;
            color: #0C2340;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .research-pdf-preview {
            margin-top: 10px;
            padding: 10px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .research-pdf-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .research-pdf-icon {
            font-size: 24px;
            color: #E31837;
        }
    </style>
    
    <!-- Authors Info Section -->
    <div class="research-section">
        <h4><?php _e('Author Information', 'rise-ai-summit'); ?></h4>
        
        <div class="research-metabox-field">
            <label for="research_authors">
                <?php _e('Authors', 'rise-ai-summit'); ?> <span style="color: red;">*</span>
            </label>
            <input type="text" 
                   id="research_authors" 
                   name="research_authors" 
                   value="<?php echo esc_attr($authors); ?>"
                   placeholder="e.g., John Doe, Jane Smith, María González"
                   required>
            <p class="research-metabox-help">
                <?php _e('Comma-separated list of all authors', 'rise-ai-summit'); ?>
            </p>
        </div>
        
        <div class="research-metabox-field">
            <label for="research_institutions">
                <?php _e('Institutions', 'rise-ai-summit'); ?> <span style="color: red;">*</span>
            </label>
            <input type="text" 
                   id="research_institutions" 
                   name="research_institutions" 
                   value="<?php echo esc_attr($institutions); ?>"
                   placeholder="e.g., University of Notre Dame, Universidad de los Andes"
                   required>
            <p class="research-metabox-help">
                <?php _e('Comma-separated list of affiliated institutions', 'rise-ai-summit'); ?>
            </p>
        </div>
        
        <div class="research-metabox-field">
            <label for="research_contact_email">
                <?php _e('Contact Email', 'rise-ai-summit'); ?>
            </label>
            <input type="email" 
                   id="research_contact_email" 
                   name="research_contact_email" 
                   value="<?php echo esc_attr($contact_email); ?>"
                   placeholder="author@example.com">
            <p class="research-metabox-help">
                <?php _e('Public contact email for inquiries about this research', 'rise-ai-summit'); ?>
            </p>
        </div>
    </div>
    
    <!-- Research Content Section -->
    <div class="research-section">
        <h4><?php _e('Research Content', 'rise-ai-summit'); ?></h4>
        
        <div class="research-metabox-field">
            <label for="research_abstract">
                <?php _e('Abstract', 'rise-ai-summit'); ?> <span style="color: red;">*</span>
            </label>
            <textarea id="research_abstract" 
                      name="research_abstract" 
                      required><?php echo esc_textarea($abstract); ?></textarea>
            <p class="research-metabox-help">
                <?php _e('Full abstract text (will be displayed on single page)', 'rise-ai-summit'); ?>
            </p>
        </div>
        
        <div class="research-metabox-field">
            <label for="research_keywords">
                <?php _e('Keywords', 'rise-ai-summit'); ?>
            </label>
            <input type="text" 
                   id="research_keywords" 
                   name="research_keywords" 
                   value="<?php echo esc_attr($keywords); ?>"
                   placeholder="AI ethics, machine learning, bias detection">
            <p class="research-metabox-help">
                <?php _e('Comma-separated keywords (max 5)', 'rise-ai-summit'); ?>
            </p>
        </div>
        
        <div class="research-metabox-field">
            <label for="research_pdf">
                <?php _e('PDF Document', 'rise-ai-summit'); ?>
            </label>
            <div class="research-pdf-container">
                <input type="hidden" id="research_pdf" name="research_pdf" value="<?php echo esc_attr($pdf_file); ?>">
                
                <?php if ($pdf_file): 
                    $pdf_url = wp_get_attachment_url($pdf_file);
                    $pdf_filename = basename(get_attached_file($pdf_file));
                ?>
                    <div class="research-pdf-preview">
                        <div class="research-pdf-info">
                            <i class="fa-solid fa-file-pdf research-pdf-icon"></i>
                            <div>
                                <strong><?php echo esc_html($pdf_filename); ?></strong><br>
                                <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" class="button button-small">
                                    <?php _e('View PDF', 'rise-ai-summit'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <button type="button" class="button research-upload-pdf" id="research_upload_pdf" style="margin-top: 10px;">
                    <?php echo $pdf_file ? __('Change PDF', 'rise-ai-summit') : __('Upload PDF', 'rise-ai-summit'); ?>
                </button>
                
                <?php if ($pdf_file): ?>
                    <button type="button" class="button research-remove-pdf" id="research_remove_pdf">
                        <?php _e('Remove PDF', 'rise-ai-summit'); ?>
                    </button>
                <?php endif; ?>
            </div>
            <p class="research-metabox-help">
                <?php _e('Full paper or extended abstract (PDF format)', 'rise-ai-summit'); ?>
            </p>
        </div>
    </div>
    
    <!-- Session Details Section -->
    <div class="research-section">
        <h4><?php _e('Presentation Details', 'rise-ai-summit'); ?></h4>
        
        <div class="research-metabox-field">
            <label for="research_presentation_type">
                <?php _e('Presentation Type', 'rise-ai-summit'); ?>
            </label>
            <select id="research_presentation_type" name="research_presentation_type">
                <option value=""><?php _e('-- Select --', 'rise-ai-summit'); ?></option>
                <option value="poster" <?php selected($presentation_type, 'poster'); ?>>
                    <?php _e('Poster Presentation', 'rise-ai-summit'); ?>
                </option>
                <option value="oral" <?php selected($presentation_type, 'oral'); ?>>
                    <?php _e('Oral Presentation', 'rise-ai-summit'); ?>
                </option>
                <option value="lightning" <?php selected($presentation_type, 'lightning'); ?>>
                    <?php _e('Lightning Talk', 'rise-ai-summit'); ?>
                </option>
            </select>
        </div>
        
        <div class="research-metabox-field">
            <label for="research_session_date">
                <?php _e('Session Date', 'rise-ai-summit'); ?>
            </label>
            <input type="date" 
                   id="research_session_date" 
                   name="research_session_date" 
                   value="<?php echo esc_attr($session_date); ?>">
        </div>
        
        <div class="research-metabox-field">
            <label for="research_session_time">
                <?php _e('Session Time', 'rise-ai-summit'); ?>
            </label>
            <input type="time" 
                   id="research_session_time" 
                   name="research_session_time" 
                   value="<?php echo esc_attr($session_time); ?>">
        </div>
        
        <div class="research-metabox-field">
            <label for="research_session_room">
                <?php _e('Room/Location', 'rise-ai-summit'); ?>
            </label>
            <input type="text" 
                   id="research_session_room" 
                   name="research_session_room" 
                   value="<?php echo esc_attr($session_room); ?>"
                   placeholder="e.g., Room 101, Poster Hall A">
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        
        // Upload PDF
        $('#research_upload_pdf').on('click', function(e) {
            e.preventDefault();
            
            var mediaUploader = wp.media({
                title: 'Select PDF Document',
                button: {
                    text: 'Use this PDF'
                },
                library: {
                    type: 'application/pdf'
                },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#research_pdf').val(attachment.id);
                
                var preview = '<div class="research-pdf-preview">' +
                    '<div class="research-pdf-info">' +
                    '<i class="fa-solid fa-file-pdf research-pdf-icon"></i>' +
                    '<div><strong>' + attachment.filename + '</strong><br>' +
                    '<a href="' + attachment.url + '" target="_blank" class="button button-small">View PDF</a>' +
                    '</div></div></div>';
                
                $('.research-pdf-preview').remove();
                $('#research_upload_pdf').before(preview);
                $('#research_upload_pdf').text('Change PDF');
                
                if ($('#research_remove_pdf').length === 0) {
                    $('#research_upload_pdf').after('<button type="button" class="button research-remove-pdf" id="research_remove_pdf">Remove PDF</button>');
                }
            });
            
            mediaUploader.open();
        });
        
        // Remove PDF
        $(document).on('click', '#research_remove_pdf', function(e) {
            e.preventDefault();
            $('#research_pdf').val('');
            $('.research-pdf-preview').remove();
            $('#research_upload_pdf').text('Upload PDF');
            $(this).remove();
        });
        
    });
    </script>
    <?php
}

/**
 * Save metabox data
 */
function rise_save_research_meta($post_id) {
    
    // Security checks
    if (!isset($_POST['research_meta_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['research_meta_nonce'], 'rise_research_meta')) {
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
        'research_authors' => 'sanitize_text_field',
        'research_institutions' => 'sanitize_text_field',
        'research_abstract' => 'sanitize_textarea_field',
        'research_keywords' => 'sanitize_text_field',
        'research_pdf' => 'intval',
        'research_presentation_type' => 'sanitize_text_field',
        'research_session_date' => 'sanitize_text_field',
        'research_session_time' => 'sanitize_text_field',
        'research_session_room' => 'sanitize_text_field',
        'research_contact_email' => 'sanitize_email'
    );
    
    foreach ($fields as $field => $sanitize_function) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $sanitize_function($_POST[$field]));
        }
    }
}
add_action('save_post', 'rise_save_research_meta');