<?php
/**
 * Template Name: Team/Committee Page
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="committee-page">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Leadership', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl text-nd-navy">
                <?php _e('Organizing Committees', 'rise-ai-summit'); ?>
            </h1>
            <p class="mt-4 text-gray-600 font-serif text-lg">
                <?php _e('The team behind RISE AI South America.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>
    
    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        
        <?php
        // Get all committee members
        $all_members = get_posts(array(
            'post_type' => 'committee_member',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'meta_key' => 'committee_display_order',
            'order' => 'ASC'
        ));
        
        // Group members by category
        $grouped = array(
            'general-chair' => array(),
            'program-chair' => array(),
            'track-business-sa' => array(),
            'track-business-nd' => array(),
            'track-education-sa' => array(),
            'track-education-nd' => array(),
            'track-science-sa' => array(),
            'track-science-nd' => array(),
            'local-logistics' => array(),
            'local-communications' => array(),
            'local-sponsors' => array(),
            'local-web' => array(),
            'local-other' => array()
        );
        
        foreach ($all_members as $member) {
            $category = get_post_meta($member->ID, 'committee_category', true);
            if ($category && isset($grouped[$category])) {
                $grouped[$category][] = $member;
            }
        }
        
        // Helper function to display member card
        function display_committee_member($member_id, $size = 'normal') {
            $role = get_post_meta($member_id, 'committee_role', true);
            $institution = get_post_meta($member_id, 'committee_institution', true);
            $photo = get_post_meta($member_id, 'committee_photo', true);
            $bio = get_post_meta($member_id, 'committee_bio', true);
            
            if ($size === 'large') {
                // Large card for General/Program Chairs
                ?>
                <div class="flex items-start gap-4 p-4 rounded-lg bg-white border border-gray-100 shadow-sm">
                    <div class="h-14 w-14 bg-uandes-red text-white flex items-center justify-center font-bold text-lg rounded-full flex-shrink-0">
                        <?php 
                        if ($photo) {
                            echo wp_get_attachment_image($photo, array(56, 56), false, array('class' => 'rounded-full'));
                        } else {
                            // Use initials
                            $title = get_the_title($member_id);
                            $words = explode(' ', $title);
                            $initials = '';
                            if (count($words) >= 2) {
                                $initials = strtoupper(substr($words[0], 0, 1) . substr($words[count($words)-1], 0, 1));
                            } else {
                                $initials = strtoupper(substr($title, 0, 2));
                            }
                            echo $initials;
                        }
                        ?>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg text-nd-navy font-sans"><?php echo esc_html(get_the_title($member_id)); ?></h4>
                        <?php if ($role): ?>
                            <p class="text-xs text-uandes-red font-bold uppercase mt-1"><?php echo esc_html($role); ?></p>
                        <?php endif; ?>
                        <?php if ($institution): ?>
                            <p class="text-xs text-gray-500 font-serif uppercase mt-1"><?php echo esc_html($institution); ?></p>
                        <?php endif; ?>
                        <?php if ($bio): ?>
                            <p class="text-sm text-gray-600 mt-2 font-serif"><?php echo esc_html($bio); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            } else {
                // Small card for track co-chairs
                ?>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-uandes-red/10 text-uandes-red flex items-center justify-center text-xs font-bold flex-shrink-0">
                        <?php 
                        if ($photo) {
                            echo wp_get_attachment_image($photo, array(32, 32), false, array('class' => 'rounded-full'));
                        } else {
                            // Initials
                            $title = get_the_title($member_id);
                            $words = explode(' ', $title);
                            if (count($words) >= 2) {
                                echo strtoupper(substr($words[0], 0, 1) . substr($words[count($words)-1], 0, 1));
                            } else {
                                echo strtoupper(substr($title, 0, 2));
                            }
                        }
                        ?>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800"><?php echo esc_html(get_the_title($member_id)); ?></p>
                        <?php if ($institution): ?>
                            <p class="text-xs text-gray-500"><?php echo esc_html($institution); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        
        <!-- GENERAL CHAIRS -->
        <?php if (!empty($grouped['general-chair'])): ?>
        <div class="mb-16">
            <h3 class="font-sans font-bold text-xl text-uandes-red uppercase tracking-widest border-b border-gray-200 pb-4 mb-8">
                <?php _e('General Chairs', 'rise-ai-summit'); ?>
            </h3>
            <div class="grid md:grid-cols-2 gap-8">
                <?php foreach ($grouped['general-chair'] as $member): ?>
                    <?php display_committee_member($member->ID, 'large'); ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- PROGRAM CHAIRS -->
        <?php if (!empty($grouped['program-chair'])): ?>
        <div class="mb-16">
            <h3 class="font-sans font-bold text-xl text-nd-navy uppercase tracking-widest border-b border-gray-200 pb-4 mb-8">
                <?php _e('Program Chairs', 'rise-ai-summit'); ?>
            </h3>
            <div class="grid md:grid-cols-2 gap-8">
                <?php foreach ($grouped['program-chair'] as $member): ?>
                    <div class="flex items-center gap-4 p-4 rounded border border-dashed border-gray-300">
                        <div class="h-12 w-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 flex-shrink-0">
                            <?php 
                            $photo = get_post_meta($member->ID, 'committee_photo', true);
                            if ($photo) {
                                echo wp_get_attachment_image($photo, array(48, 48), false, array('class' => 'rounded-full'));
                            } else {
                                echo '<i class="fa-solid fa-user"></i>';
                            }
                            ?>
                        </div>
                        <div>
                            <h4 class="font-bold text-nd-navy font-sans"><?php echo esc_html($member->post_title); ?></h4>
                            <p class="text-sm text-gray-600 font-serif"><?php echo esc_html(get_post_meta($member->ID, 'committee_institution', true)); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- TRACK CO-CHAIRS -->
        <div class="mb-16">
            <h3 class="font-sans font-bold text-xl text-nd-navy uppercase tracking-widest border-b border-gray-200 pb-4 mb-8">
                <?php _e('Track Co-Chairs', 'rise-ai-summit'); ?>
            </h3>
            <div class="grid md:grid-cols-3 gap-8">
                
                <!-- Business Track -->
                <div class="bg-white p-6 rounded shadow-sm border border-gray-100 relative overflow-hidden group hover:border-uandes-red/30 transition">
                    <div class="absolute top-0 left-0 w-1 h-full bg-nd-navy"></div>
                    <h4 class="font-bold text-nd-navy font-sans mb-4 text-lg flex items-center gap-2">
                        <i class="fa-solid fa-briefcase text-gray-300"></i> <?php _e('Business', 'rise-ai-summit'); ?>
                    </h4>
                    <div class="space-y-3">
                        <?php if (!empty($grouped['track-business-sa'])): ?>
                            <?php foreach ($grouped['track-business-sa'] as $member): ?>
                                <?php display_committee_member($member->ID, 'small'); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-sm text-gray-400 italic"><?php _e('SA Co-Chair TBA', 'rise-ai-summit'); ?></p>
                        <?php endif; ?>
                        
                        <?php if (!empty($grouped['track-business-nd'])): ?>
                            <?php foreach ($grouped['track-business-nd'] as $member): ?>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-nd-gold/20 text-nd-gold-light flex items-center justify-center text-xs font-bold flex-shrink-0">
                                        <?php 
                                        $photo = get_post_meta($member->ID, 'committee_photo', true);
                                        if ($photo) {
                                            echo wp_get_attachment_image($photo, array(32, 32), false, array('class' => 'rounded-full'));
                                        } else {
                                            $title = $member->post_title;
                                            $words = explode(' ', $title);
                                            if (count($words) >= 2) {
                                                echo strtoupper(substr($words[0], 0, 1) . substr($words[count($words)-1], 0, 1));
                                            } else {
                                                echo 'ND';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800"><?php echo esc_html($member->post_title); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo esc_html(get_post_meta($member->ID, 'committee_institution', true)); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-sm text-gray-400 italic"><?php _e('ND Co-Chair TBA', 'rise-ai-summit'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Education Track -->
                <div class="bg-white p-6 rounded shadow-sm border border-gray-100 relative overflow-hidden group hover:border-nd-gold/50 transition">
                    <div class="absolute top-0 left-0 w-1 h-full bg-nd-gold"></div>
                    <h4 class="font-bold text-nd-navy font-sans mb-4 text-lg flex items-center gap-2">
                        <i class="fa-solid fa-graduation-cap text-gray-300"></i> <?php _e('Education', 'rise-ai-summit'); ?>
                    </h4>
                    <div class="space-y-3">
                        <?php if (!empty($grouped['track-education-sa'])): ?>
                            <?php foreach ($grouped['track-education-sa'] as $member): ?>
                                <?php display_committee_member($member->ID, 'small'); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-sm text-gray-400 italic"><?php _e('SA Co-Chair TBA', 'rise-ai-summit'); ?></p>
                        <?php endif; ?>
                        
                        <?php if (!empty($grouped['track-education-nd'])): ?>
                            <?php foreach ($grouped['track-education-nd'] as $member): ?>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-nd-gold/20 text-nd-gold-light flex items-center justify-center text-xs font-bold flex-shrink-0">
                                        <?php 
                                        $photo = get_post_meta($member->ID, 'committee_photo', true);
                                        if ($photo) {
                                            echo wp_get_attachment_image($photo, array(32, 32), false, array('class' => 'rounded-full'));
                                        } else {
                                            echo 'ND';
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800"><?php echo esc_html($member->post_title); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo esc_html(get_post_meta($member->ID, 'committee_institution', true)); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-sm text-gray-400 italic"><?php _e('ND Co-Chair TBA', 'rise-ai-summit'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Science Track -->
                <div class="bg-white p-6 rounded shadow-sm border border-gray-100 relative overflow-hidden group hover:border-nd-navy/30 transition">
                    <div class="absolute top-0 left-0 w-1 h-full bg-uandes-red"></div>
                    <h4 class="font-bold text-nd-navy font-sans mb-4 text-lg flex items-center gap-2">
                        <i class="fa-solid fa-microscope text-gray-300"></i> <?php _e('Science', 'rise-ai-summit'); ?>
                    </h4>
                    <div class="space-y-3">
                        <?php if (!empty($grouped['track-science-sa'])): ?>
                            <?php foreach ($grouped['track-science-sa'] as $member): ?>
                                <?php display_committee_member($member->ID, 'small'); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-sm text-gray-400 italic"><?php _e('SA Co-Chair TBA', 'rise-ai-summit'); ?></p>
                        <?php endif; ?>
                        
                        <?php if (!empty($grouped['track-science-nd'])): ?>
                            <?php foreach ($grouped['track-science-nd'] as $member): ?>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-nd-gold/20 text-nd-gold-light flex items-center justify-center text-xs font-bold flex-shrink-0">
                                        <?php 
                                        $photo = get_post_meta($member->ID, 'committee_photo', true);
                                        if ($photo) {
                                            echo wp_get_attachment_image($photo, array(32, 32), false, array('class' => 'rounded-full'));
                                        } else {
                                            echo 'ND';
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800"><?php echo esc_html($member->post_title); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo esc_html(get_post_meta($member->ID, 'committee_institution', true)); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-sm text-gray-400 italic"><?php _e('ND Co-Chair TBA', 'rise-ai-summit'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- LOCAL ORGANIZING TEAM -->
        <?php 
        $local_team = array_merge(
            $grouped['local-logistics'],
            $grouped['local-communications'],
            $grouped['local-sponsors'],
            $grouped['local-web'],
            $grouped['local-other']
        );
        ?>
        <?php if (!empty($local_team)): ?>
        <div>
            <h3 class="font-sans font-bold text-xl text-gray-500 uppercase tracking-widest border-b border-gray-200 pb-4 mb-8">
                <?php _e('Local Organizing Team', 'rise-ai-summit'); ?>
            </h3>
            <ul class="grid md:grid-cols-4 gap-4 text-sm font-serif text-gray-600">
                <?php foreach ($local_team as $member): ?>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-uandes-red text-xs"></i> 
                        <span>
                            <?php echo esc_html($member->post_title); ?>
                            <?php 
                            $role = get_post_meta($member->ID, 'committee_role', true);
                            if ($role) {
                                echo ' <span class="text-gray-400">(' . esc_html($role) . ')</span>';
                            }
                            ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

    </div>
    
</div>

<?php
get_footer();