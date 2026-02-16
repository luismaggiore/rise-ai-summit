<?php
/**
 * Agenda Page Metabox
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Agenda Page metabox
 */
function rise_ai_add_agenda_metabox() {
    
    // Get agenda page
    $agenda_page = get_page_by_path('agenda');
    
    if (!$agenda_page) return;
    
    add_meta_box(
        'agenda_note',
        __('Agenda Management', 'rise-ai-summit'),
        'rise_ai_agenda_note_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rise_ai_add_agenda_metabox');

/**
 * Agenda Note Callback
 */
function rise_ai_agenda_note_callback($post) {
    
    // Only show on agenda page
    $agenda_page = get_page_by_path('agenda');
    if (!$agenda_page || $post->ID != $agenda_page->ID) {
        return;
    }
    ?>
    
    <div style="padding: 20px; background: #e7f3ff; border-left: 4px solid #0C2340; border-radius: 4px;">
        <h3 style="margin-top: 0; color: #0C2340;">
            <i class="fa-solid fa-info-circle"></i>
            <?php _e('Agenda Content Management', 'rise-ai-summit'); ?>
        </h3>
        
        <p style="margin: 0;">
            <?php _e('The agenda schedule is currently hardcoded in the page template. For this phase, you can edit the agenda content directly in:', 'rise-ai-summit'); ?>
        </p>
        
        <code style="display: block; margin: 15px 0; padding: 10px; background: white; border-radius: 4px;">
            /page-templates/page-agenda.php
        </code>
        
        <p style="margin: 15px 0 0 0; font-size: 13px; color: #555;">
            <strong><?php _e('Future Enhancement:', 'rise-ai-summit'); ?></strong>
            <?php _e('A visual agenda builder will be added in Phase 7 to manage sessions through the admin interface.', 'rise-ai-summit'); ?>
        </p>
    </div>
    
    <?php
}