<?php
/**
 * Sponsor Metaboxes
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Sponsor metaboxes
 */
function rise_ai_add_sponsor_metaboxes() {
    add_meta_box(
        'sponsor_details',
        __('Sponsor Details', 'rise-ai-summit'),
        'rise_ai_sponsor_details_callback',
        'sponsor',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rise_ai_add_sponsor_metaboxes');

/**
 * Sponsor Details Metabox Callback
 */
function rise_ai_sponsor_details_callback($post) {
    wp_nonce_field('rise_ai_sponsor_details_nonce', 'sponsor_details_nonce');
    
    $website = get_post_meta($post->ID, 'sponsor_website', true);
    $display_order = get_post_meta($post->ID, 'sponsor_display_order', true);
    ?>
    
    <div class="rise-metabox-field">
        <label for="sponsor_website">
            <?php _e('Website URL', 'rise-ai-summit'); ?>
        </label>
        <input type="url" 
               id="sponsor_website" 
               name="sponsor_website" 
               value="<?php echo esc_url($website); ?>" 
               class="widefat"
               placeholder="https://example.com">
        <p class="description">
            <?php _e('Sponsor company website', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <div class="rise-metabox-field">
        <label for="sponsor_display_order">
            <?php _e('Display Order', 'rise-ai-summit'); ?>
        </label>
        <input type="number" 
               id="sponsor_display_order" 
               name="sponsor_display_order" 
               value="<?php echo esc_attr($display_order ? $display_order : 0); ?>" 
               min="0"
               step="1">
        <p class="description">
            <?php _e('Lower numbers appear first (0 = automatic)', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <div class="rise-metabox-field">
        <p><strong><?php _e('Featured Image', 'rise-ai-summit'); ?></strong></p>
        <p class="description">
            <?php _e('Set the sponsor logo as the Featured Image (recommended: SVG or PNG with transparent background)', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <?php
}

/**
 * Save Sponsor Metabox Data
 */
function rise_ai_save_sponsor_metaboxes($post_id) {
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Check nonce
    if (!isset($_POST['sponsor_details_nonce']) || !wp_verify_nonce($_POST['sponsor_details_nonce'], 'rise_ai_sponsor_details_nonce')) {
        return;
    }
    
    // Save website
    if (isset($_POST['sponsor_website'])) {
        update_post_meta($post_id, 'sponsor_website', esc_url_raw($_POST['sponsor_website']));
    }
    
    // Save display order
    if (isset($_POST['sponsor_display_order'])) {
        update_post_meta($post_id, 'sponsor_display_order', absint($_POST['sponsor_display_order']));
    }
}
add_action('save_post_sponsor', 'rise_ai_save_sponsor_metaboxes');