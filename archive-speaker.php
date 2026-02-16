<?php
/**
 * Archive Template: Speakers
 * Displays speakers grouped by type (Keynotes, then Panelists)
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="speakers-archive">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Lineup', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl text-nd-navy">
                <?php _e('Speakers', 'rise-ai-summit'); ?>
            </h1>
            <p class="mt-4 text-gray-600 font-serif text-lg">
                <?php _e('World-class voices in Artificial Intelligence.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>
    
    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        
        <?php
        // Get all speakers grouped by type
        $keynote_speakers = get_posts(array(
            'post_type' => 'speaker',
            'posts_per_page' => -1,
            'meta_key' => 'speaker_type',
            'meta_value' => 'keynote',
            'orderby' => 'menu_order title',
            'order' => 'ASC'
        ));
        
        $panelist_speakers = get_posts(array(
            'post_type' => 'speaker',
            'posts_per_page' => -1,
            'meta_key' => 'speaker_type',
            'meta_value' => 'panelist',
            'orderby' => 'menu_order title',
            'order' => 'ASC'
        ));
        ?>
        
        <!-- KEYNOTE SPEAKERS SECTION -->
        <?php if (!empty($keynote_speakers)): ?>
        <div class="mb-20">
            
            <!-- Section Title -->
            <h2 class="font-sans font-bold text-2xl text-nd-navy mb-10 border-b border-gray-200 pb-4 inline-block">
                <?php _e('Keynote Speakers', 'rise-ai-summit'); ?>
            </h2>
            
            <!-- Speakers Grid (3 columns) -->
            <div class="grid md:grid-cols-3 gap-10">
                <?php foreach ($keynote_speakers as $speaker): ?>
                    <?php
                    $photo = get_post_meta($speaker->ID, 'speaker_photo', true);
                    $credentials = get_post_meta($speaker->ID, 'speaker_title_credentials', true);
                    $position = get_post_meta($speaker->ID, 'speaker_position', true);
                    $institution = get_post_meta($speaker->ID, 'speaker_institution', true);
                    $bio = get_post_meta($speaker->ID, 'speaker_bio', true);
                    $talk_title = get_post_meta($speaker->ID, 'speaker_talk_title', true);
                    $linkedin = get_post_meta($speaker->ID, 'speaker_linkedin', true);
                    $twitter = get_post_meta($speaker->ID, 'speaker_twitter', true);
                    $website = get_post_meta($speaker->ID, 'speaker_website', true);
                    ?>
                    
                    <div class="speaker-card group">
                        <!-- Photo -->
                        <div class="aspect-[4/5] bg-gray-200 rounded-lg overflow-hidden mb-4 relative shadow-md">
                            <?php if ($photo): ?>
                                <?php echo wp_get_attachment_image($photo, 'large', false, array('class' => 'w-full h-full object-cover')); ?>
                            <?php else: ?>
                                <div class="absolute inset-0 flex items-center justify-center text-gray-400 bg-gray-100">
                                    <i class="fa-solid fa-user text-6xl"></i>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Hover Overlay with Talk Title -->
                            <?php if ($talk_title): ?>
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-nd-navy to-transparent p-6 pt-20 translate-y-full group-hover:translate-y-0 transition duration-300">
                                    <p class="text-white text-sm font-serif italic">
                                        "<?php echo esc_html($talk_title); ?>"
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Info -->
                        <h3 class="font-sans font-bold text-xl text-nd-navy">
                            <?php 
                            echo esc_html($speaker->post_title);
                     
                            ?>
                        </h3>
                        
                        <?php if ($institution): ?>
                            <p class="text-uandes-red font-bold text-xs uppercase tracking-wider mb-1 mt-1">
                                <?php echo esc_html($institution); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($position): ?>
                            <p class="text-gray-500 text-sm font-serif mb-3">
                                <?php echo esc_html($position); ?>
                            </p>
                        <?php endif; ?>
                        
                      
                        <!-- Social Links -->
                        <?php if ($linkedin || $twitter || $website): ?>
                            <div class="flex gap-3 mt-4 pt-4 border-t border-gray-100">
                                <?php if ($linkedin): ?>
                                    <a href="<?php echo esc_url($linkedin); ?>" 
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="text-gray-400 hover:text-nd-navy transition">
                                        <i class="fa-brands fa-linkedin text-xl"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($twitter): ?>
                                    <a href="<?php echo esc_url($twitter); ?>" 
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="text-gray-400 hover:text-nd-navy transition">
                                        <i class="fa-brands fa-x-twitter text-xl"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($website): ?>
                                    <a href="<?php echo esc_url($website); ?>" 
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="text-gray-400 hover:text-nd-navy transition">
                                        <i class="fa-solid fa-globe text-xl"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- FEATURED PANELISTS SECTION -->
        <?php if (!empty($panelist_speakers)): ?>
        <div>
            
            <!-- Section Title -->
            <h2 class="font-sans font-bold text-2xl text-nd-navy mb-10 border-b border-gray-200 pb-4 inline-block">
                <?php _e('Featured Panelists', 'rise-ai-summit'); ?>
            </h2>
            
            <!-- Speakers Grid (5 columns, compact) -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                <?php foreach ($panelist_speakers as $speaker): ?>
                    <?php
                    $photo = get_post_meta($speaker->ID, 'speaker_photo', true);
                    $institution = get_post_meta($speaker->ID, 'speaker_institution', true);
                    ?>
                    
                    <div class="speaker-card-compact text-center group">
                        <!-- Photo (circular) -->
                        <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full mb-3 flex items-center justify-center text-gray-300 border border-gray-200 group-hover:border-uandes-red transition overflow-hidden">
                            <?php if ($photo): ?>
                                <?php echo wp_get_attachment_image($photo, 'thumbnail', false, array('class' => 'w-full h-full object-cover')); ?>
                            <?php else: ?>
                                <i class="fa-solid fa-user text-2xl"></i>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Info -->
                        <h4 class="font-bold text-sm text-nd-navy font-sans leading-tight mb-1">
                            <?php echo esc_html($speaker->post_title); ?>
                        </h4>
                        
                        <?php if ($institution): ?>
                            <p class="text-xs text-gray-500 font-serif">
                                <?php echo esc_html($institution); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Empty State -->
        <?php if (empty($keynote_speakers) && empty($panelist_speakers)): ?>
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-users text-4xl text-gray-300"></i>
                </div>
                <h3 class="font-sans font-bold text-2xl text-gray-400 mb-2">
                    <?php _e('Speakers Coming Soon', 'rise-ai-summit'); ?>
                </h3>
                <p class="text-gray-500 font-serif">
                    <?php _e('We\'re finalizing our lineup of world-class speakers. Check back soon!', 'rise-ai-summit'); ?>
                </p>
            </div>
        <?php endif; ?>
        
    </div>
    
</div>

<style>
/* Line clamp for bio text */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Speaker Card Hover Effects */
.speaker-card {
    transition: transform 0.3s ease;
}


.speaker-card-compact {
    transition: transform 0.2s ease;
}

.speaker-card-compact:hover {
    transform: scale(1.05);
}
</style>

<?php
get_footer();