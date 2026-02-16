<?php
/**
 * Home Page Metabox
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Home Page metabox
 */
function rise_ai_add_home_metabox() {
    add_meta_box(
        'home_page_settings',
        __('Homepage Settings', 'rise-ai-summit'),
        'rise_ai_home_page_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rise_ai_add_home_metabox');

/**
 * Home Page Callback
 */
function rise_ai_home_page_callback($post) {
    
    // Only show on front page
    if ($post->ID != get_option('page_on_front')) {
        return;
    }
    
    wp_nonce_field('rise_ai_home_nonce', 'home_nonce');
    
    $hero_image = get_post_meta($post->ID, 'home_hero_image_override', true);
    $featured_speakers = get_post_meta($post->ID, 'home_featured_speakers', true);
    ?>
    
    <div class="rise-metabox-field">
        <label>
            <strong><?php _e('Hero Banner Image Override', 'rise-ai-summit'); ?></strong>
        </label>
        <p class="description">
            <?php _e('Optional: Override the default hero banner image. Leave empty to use default.', 'rise-ai-summit'); ?>
        </p>
        
        <div class="home-hero-image-wrapper" style="margin-top: 10px;">
            <?php if ($hero_image): 
                $image_url = wp_get_attachment_url($hero_image);
            ?>
                <div style="margin-bottom: 10px;">
                    <img src="<?php echo esc_url($image_url); ?>" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            <?php endif; ?>
            
            <input type="hidden" id="home_hero_image_override" name="home_hero_image_override" value="<?php echo esc_attr($hero_image); ?>">
            
            <button type="button" class="button upload-hero-image">
                <?php echo $hero_image ? __('Change Image', 'rise-ai-summit') : __('Upload Image', 'rise-ai-summit'); ?>
            </button>
            
            <?php if ($hero_image): ?>
                <button type="button" class="button remove-hero-image">
                    <?php _e('Remove Image', 'rise-ai-summit'); ?>
                </button>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="rise-metabox-field" style="margin-top: 30px;">
        <label for="home_featured_speakers">
            <strong><?php _e('Featured Speakers (IDs)', 'rise-ai-summit'); ?></strong>
        </label>
        <input type="text" 
               id="home_featured_speakers" 
               name="home_featured_speakers" 
               value="<?php echo esc_attr($featured_speakers); ?>" 
               class="widefat"
               placeholder="12, 45, 67">
        <p class="description">
            <?php _e('Comma-separated speaker post IDs to feature on homepage. Leave empty to auto-select keynotes.', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <?php
}

/**
 * Save Home Page Metabox
 */
function rise_ai_save_home_metabox($post_id) {
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Check if this is front page
    if ($post_id != get_option('page_on_front')) {
        return;
    }
    
    // Check nonce
    if (!isset($_POST['home_nonce']) || !wp_verify_nonce($_POST['home_nonce'], 'rise_ai_home_nonce')) {
        return;
    }
    
    // Save hero image
    if (isset($_POST['home_hero_image_override'])) {
        update_post_meta($post_id, 'home_hero_image_override', absint($_POST['home_hero_image_override']));
    }
    
    // Save featured speakers
    if (isset($_POST['home_featured_speakers'])) {
        update_post_meta($post_id, 'home_featured_speakers', sanitize_text_field($_POST['home_featured_speakers']));
    }
}
add_action('save_post_page', 'rise_ai_save_home_metabox');