<?php
/**
 * Tracks Page Metabox
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Tracks Page metabox
 */
function rise_ai_add_tracks_metabox() {
    
    // Get tracks page
    $tracks_page = get_page_by_path('tracks');
    
    if (!$tracks_page) return;
    
    add_meta_box(
        'tracks_content',
        __('Tracks Content', 'rise-ai-summit'),
        'rise_ai_tracks_content_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rise_ai_add_tracks_metabox');

/**
 * Tracks Content Callback
 */
function rise_ai_tracks_content_callback($post) {
    
    // Only show on tracks page
    $tracks_page = get_page_by_path('tracks');
    if (!$tracks_page || $post->ID != $tracks_page->ID) {
        return;
    }
    
    wp_nonce_field('rise_ai_tracks_nonce', 'tracks_nonce');
    
    // Track 1: Business
    $business_topics = get_post_meta($post->ID, 'track_business_topics', true);
    
    // Track 2: Education
    $education_topics = get_post_meta($post->ID, 'track_education_topics', true);
    
    // Track 3: Science
    $science_topics = get_post_meta($post->ID, 'track_science_topics', true);
    
    ?>
    
    <p class="description" style="margin-bottom: 20px;">
        <?php _e('The track titles and descriptions are managed through the Track taxonomy. Here you can customize the key topics for each track.', 'rise-ai-summit'); ?>
    </p>
    
    <div style="border: 1px solid #ddd; padding: 20px; margin-bottom: 20px; background: #f9f9f9; border-radius: 4px;">
        <h3 style="margin-top: 0; color: #0C2340; border-bottom: 2px solid #0C2340; padding-bottom: 10px;">
            <i class="fa-solid fa-briefcase"></i>
            <?php _e('Track 1: Business (Strategy & Governance)', 'rise-ai-summit'); ?>
        </h3>
        
        <label for="track_business_topics">
            <strong><?php _e('Key Topics', 'rise-ai-summit'); ?></strong>
        </label>
        <textarea id="track_business_topics" 
                  name="track_business_topics" 
                  rows="6" 
                  class="widefat"
                  placeholder="<?php esc_attr_e('One topic per line, e.g.:\nResponsible AI in organizations\nProductivity and transformation', 'rise-ai-summit'); ?>"><?php echo esc_textarea($business_topics); ?></textarea>
        <p class="description">
            <?php _e('One topic per line. These will appear as checkmarks in the track card.', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <div style="border: 1px solid #ddd; padding: 20px; margin-bottom: 20px; background: #fffbf0; border-radius: 4px;">
        <h3 style="margin-top: 0; color: #AE9142; border-bottom: 2px solid #AE9142; padding-bottom: 10px;">
            <i class="fa-solid fa-graduation-cap"></i>
            <?php _e('Track 2: Education (Policy & Skills)', 'rise-ai-summit'); ?>
        </h3>
        
        <label for="track_education_topics">
            <strong><?php _e('Key Topics', 'rise-ai-summit'); ?></strong>
        </label>
        <textarea id="track_education_topics" 
                  name="track_education_topics" 
                  rows="6" 
                  class="widefat"
                  placeholder="<?php esc_attr_e('One topic per line, e.g.:\nAI literacy and workforce skills\nTeaching and learning augmentation', 'rise-ai-summit'); ?>"><?php echo esc_textarea($education_topics); ?></textarea>
        <p class="description">
            <?php _e('One topic per line. These will appear as checkmarks in the track card.', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <div style="border: 1px solid #ddd; padding: 20px; background: #fff5f5; border-radius: 4px;">
        <h3 style="margin-top: 0; color: #E31837; border-bottom: 2px solid #E31837; padding-bottom: 10px;">
            <i class="fa-solid fa-microscope"></i>
            <?php _e('Track 3: Applied Science (Health & Engineering)', 'rise-ai-summit'); ?>
        </h3>
        
        <label for="track_science_topics">
            <strong><?php _e('Key Topics', 'rise-ai-summit'); ?></strong>
        </label>
        <textarea id="track_science_topics" 
                  name="track_science_topics" 
                  rows="6" 
                  class="widefat"
                  placeholder="<?php esc_attr_e('One topic per line, e.g.:\nAI for science and engineering innovation\nApplied research translation', 'rise-ai-summit'); ?>"><?php echo esc_textarea($science_topics); ?></textarea>
        <p class="description">
            <?php _e('One topic per line. These will appear as checkmarks in the track card.', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <?php
}

/**
 * Save Tracks Metabox
 */
function rise_ai_save_tracks_metabox($post_id) {
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Check if this is tracks page
    $tracks_page = get_page_by_path('tracks');
    if (!$tracks_page || $post_id != $tracks_page->ID) {
        return;
    }
    
    // Check nonce
    if (!isset($_POST['tracks_nonce']) || !wp_verify_nonce($_POST['tracks_nonce'], 'rise_ai_tracks_nonce')) {
        return;
    }
    
    // Save topics
    if (isset($_POST['track_business_topics'])) {
        update_post_meta($post_id, 'track_business_topics', sanitize_textarea_field($_POST['track_business_topics']));
    }
    
    if (isset($_POST['track_education_topics'])) {
        update_post_meta($post_id, 'track_education_topics', sanitize_textarea_field($_POST['track_education_topics']));
    }
    
    if (isset($_POST['track_science_topics'])) {
        update_post_meta($post_id, 'track_science_topics', sanitize_textarea_field($_POST['track_science_topics']));
    }
}
add_action('save_post_page', 'rise_ai_save_tracks_metabox');