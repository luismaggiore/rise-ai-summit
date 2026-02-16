<?php
/**
 * Admin Dashboard Widgets
 * Display statistics and quick actions
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * Add Dashboard Widget
 */
function rise_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'rise_summit_stats',
        __('RISE AI Summit - Statistics', 'rise-ai-summit'),
        'rise_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'rise_add_dashboard_widgets');

/**
 * Dashboard Widget Content
 */
function rise_dashboard_widget_content() {
    
    // Get counts with fallback
    $abstracts = wp_count_posts('abstract_submission');
    $abstracts_count = isset($abstracts->publish) ? $abstracts->publish : 0;
    
    $registrations = wp_count_posts('preregistration');
    $registrations_count = isset($registrations->publish) ? $registrations->publish : 0;
    
    $sponsors = wp_count_posts('sponsor_inquiry');
    $sponsors_count = isset($sponsors->publish) ? $sponsors->publish : 0;
    
    // Get pending/new counts
    $abstracts_pending = get_posts(array(
        'post_type' => 'abstract_submission',
        'meta_key' => 'abstract_status',
        'meta_value' => 'pending',
        'posts_per_page' => -1,
        'fields' => 'ids'
    ));
    
    $sponsors_new = get_posts(array(
        'post_type' => 'sponsor_inquiry',
        'meta_key' => 'sponsor_inquiry_status',
        'meta_value' => 'new',
        'posts_per_page' => -1,
        'fields' => 'ids'
    ));
    
    // Get recent submissions (last 7 days)
    $recent_abstracts = get_posts(array(
        'post_type' => 'abstract_submission',
        'date_query' => array(
            'after' => '7 days ago'
        ),
        'posts_per_page' => -1,
        'fields' => 'ids'
    ));
    
    $recent_registrations = get_posts(array(
        'post_type' => 'preregistration',
        'date_query' => array(
            'after' => '7 days ago'
        ),
        'posts_per_page' => -1,
        'fields' => 'ids'
    ));
    
    ?>
    <style>
        .rise-stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        .rise-stat-box {
            text-align: center;
            padding: 20px;
            background: #f0f0f1;
            border-radius: 4px;
            border-left: 4px solid #0C2340;
        }
        .rise-stat-box.pending {
            border-left-color: #E31837;
            background: #fff5f5;
        }
        .rise-stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #0C2340;
            line-height: 1;
        }
        .rise-stat-label {
            color: #666;
            font-size: 13px;
            margin-top: 5px;
        }
        .rise-stat-sublabel {
            color: #999;
            font-size: 11px;
            margin-top: 3px;
        }
        .rise-quick-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .rise-quick-action {
            flex: 1;
            min-width: 150px;
        }
        .rise-recent-activity {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        .rise-activity-item {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .rise-activity-item:last-child {
            border-bottom: none;
        }
    </style>
    
    <div class="rise-dashboard-widget">
        
        <!-- Statistics Grid -->
        <div class="rise-stats-grid">
            <div class="rise-stat-box">
                <div class="rise-stat-number"><?php echo $abstracts_count; ?></div>
                <div class="rise-stat-label"><?php _e('Total Abstracts', 'rise-ai-summit'); ?></div>
                <?php if (count($abstracts_pending) > 0): ?>
                    <div class="rise-stat-sublabel">
                        <?php printf(__('%d pending review', 'rise-ai-summit'), count($abstracts_pending)); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="rise-stat-box">
                <div class="rise-stat-number"><?php echo $registrations_count; ?></div>
                <div class="rise-stat-label"><?php _e('Registrations', 'rise-ai-summit'); ?></div>
                <?php if (count($recent_registrations) > 0): ?>
                    <div class="rise-stat-sublabel">
                        <?php printf(__('%d in last 7 days', 'rise-ai-summit'), count($recent_registrations)); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="rise-stat-box">
                <div class="rise-stat-number"><?php echo $sponsors_count; ?></div>
                <div class="rise-stat-label"><?php _e('Sponsor Inquiries', 'rise-ai-summit'); ?></div>
                <?php if (count($sponsors_new) > 0): ?>
                    <div class="rise-stat-sublabel">
                        <?php printf(__('%d new/uncontacted', 'rise-ai-summit'), count($sponsors_new)); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Alerts for Pending Items -->
        <?php if (count($abstracts_pending) > 0 || count($sponsors_new) > 0): ?>
            <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                <strong><?php _e('Action Required:', 'rise-ai-summit'); ?></strong>
                <ul style="margin: 10px 0 0 20px;">
                    <?php if (count($abstracts_pending) > 0): ?>
                        <li>
                            <a href="<?php echo admin_url('edit.php?post_type=abstract_submission&abstract_status=pending'); ?>">
                                <?php printf(__('%d abstract(s) awaiting review', 'rise-ai-summit'), count($abstracts_pending)); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (count($sponsors_new) > 0): ?>
                        <li>
                            <a href="<?php echo admin_url('edit.php?post_type=sponsor_inquiry'); ?>">
                                <?php printf(__('%d new sponsor inquir(y/ies) to respond to', 'rise-ai-summit'), count($sponsors_new)); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <!-- Quick Actions -->
        <div class="rise-quick-actions">
            <a href="<?php echo admin_url('edit.php?post_type=abstract_submission'); ?>" class="button rise-quick-action">
                <span class="dashicons dashicons-media-document"></span>
                <?php _e('View Abstracts', 'rise-ai-summit'); ?>
            </a>
            <a href="<?php echo admin_url('edit.php?post_type=registration_interest'); ?>" class="button rise-quick-action">
                <span class="dashicons dashicons-tickets-alt"></span>
                <?php _e('View Registrations', 'rise-ai-summit'); ?>
            </a>
            <a href="<?php echo admin_url('edit.php?post_type=sponsor_inquiry'); ?>" class="button rise-quick-action">
                <span class="dashicons dashicons-businessman"></span>
                <?php _e('View Sponsors', 'rise-ai-summit'); ?>
            </a>
            <a href="<?php echo admin_url('admin.php?page=rise-export-contacts'); ?>" class="button button-primary rise-quick-action">
                <span class="dashicons dashicons-download"></span>
                <?php _e('Export Data', 'rise-ai-summit'); ?>
            </a>
        </div>
        
        <!-- Recent Activity -->
        <div class="rise-recent-activity">
            <h4 style="margin: 0 0 10px 0;"><?php _e('Recent Activity (Last 7 Days)', 'rise-ai-summit'); ?></h4>
            
            <?php if (count($recent_abstracts) > 0 || count($recent_registrations) > 0): ?>
                <div>
                    <?php if (count($recent_abstracts) > 0): ?>
                        <div class="rise-activity-item">
                            <span>
                                <span class="dashicons dashicons-media-document" style="color: #0C2340;"></span>
                                <?php printf(__('%d new abstract(s)', 'rise-ai-summit'), count($recent_abstracts)); ?>
                            </span>
                            <a href="<?php echo admin_url('edit.php?post_type=abstract_submission'); ?>" class="button button-small">
                                <?php _e('Review', 'rise-ai-summit'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (count($recent_registrations) > 0): ?>
                        <div class="rise-activity-item">
                            <span>
                                <span class="dashicons dashicons-tickets-alt" style="color: #0C2340;"></span>
                                <?php printf(__('%d new registration(s)', 'rise-ai-summit'), count($recent_registrations)); ?>
                            </span>
                            <a href="<?php echo admin_url('edit.php?post_type=registration_interest'); ?>" class="button button-small">
                                <?php _e('View', 'rise-ai-summit'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p style="color: #999; font-style: italic; margin: 0;">
                    <?php _e('No recent activity in the last 7 days', 'rise-ai-summit'); ?>
                </p>
            <?php endif; ?>
        </div>
        
        <!-- Summit Info -->
        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; background: #f9f9f9; padding: 15px; border-radius: 4px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong style="color: #0C2340;"><?php _e('RISE AI Summit 2026', 'rise-ai-summit'); ?></strong>
                    <div style="color: #666; font-size: 12px; margin-top: 3px;">
                        <?php _e('October 15-16, 2026 • Santiago, Chile', 'rise-ai-summit'); ?>
                    </div>
                </div>
                <a href="<?php echo home_url(); ?>" target="_blank" class="button">
                    <?php _e('View Site', 'rise-ai-summit'); ?>
                </a>
            </div>
        </div>
        
    </div>
    <?php
}