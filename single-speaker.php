<?php
/**
 * Single Speaker Template
 * 
 * @package RISE_AI_Summit
 */

get_header();

while (have_posts()): the_post();

$credentials = get_post_meta(get_the_ID(), 'speaker_title_credentials', true);
$position = get_post_meta(get_the_ID(), 'speaker_position', true);
$institution = get_post_meta(get_the_ID(), 'speaker_institution', true);
$talk_title = get_post_meta(get_the_ID(), 'speaker_talk_title', true);
$talk_description = get_post_meta(get_the_ID(), 'speaker_talk_description', true);
$linkedin = get_post_meta(get_the_ID(), 'speaker_linkedin', true);
$twitter = get_post_meta(get_the_ID(), 'speaker_twitter', true);
$website = get_post_meta(get_the_ID(), 'speaker_website', true);

// Get taxonomies
$speaker_types = get_the_terms(get_the_ID(), 'speaker_type');
$tracks = get_the_terms(get_the_ID(), 'track');
?>

<article class="single-speaker">
    
    <!-- Hero Section -->
    <div class="bg-nd-navy text-white py-20">
        <div class="max-w-5xl mx-auto px-4">
            <a href="<?php echo get_post_type_archive_link('speaker'); ?>" 
               class="inline-flex items-center gap-2 text-nd-gold hover:text-white mb-6 transition text-sm font-bold">
                <i class="fa-solid fa-arrow-left"></i>
                <?php _e('Back to Speakers', 'rise-ai-summit'); ?>
            </a>
            
            <div class="flex flex-col md:flex-row gap-10 items-start">
                
                <!-- Photo -->
                <div class="w-full md:w-64 flex-shrink-0">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="aspect-[4/5] rounded-lg overflow-hidden shadow-2xl border-4 border-white/10">
                            <?php the_post_thumbnail('speaker-photo', array(
                                'class' => 'w-full h-full object-cover'
                            )); ?>
                        </div>
                    <?php else: ?>
                        <div class="aspect-[4/5] rounded-lg overflow-hidden bg-white/10 flex items-center justify-center">
                            <i class="fa-solid fa-user text-8xl text-white/30"></i>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Info -->
                <div class="flex-1">
                    <h1 class="font-sans font-bold text-4xl md:text-5xl mb-2">
                        <?php the_title(); ?>
                        <?php if ($credentials): ?>
                            <span class="text-2xl font-normal text-gray-300">, <?php echo esc_html($credentials); ?></span>
                        <?php endif; ?>
                    </h1>
                    
                    <?php if ($position): ?>
                    <p class="text-nd-gold font-bold text-lg mb-2">
                        <?php echo esc_html($position); ?>
                    </p>
                    <?php endif; ?>
                    
                    <?php if ($institution): ?>
                    <p class="text-gray-300 font-serif text-lg mb-6">
                        <?php echo esc_html($institution); ?>
                    </p>
                    <?php endif; ?>
                    
                    <!-- Taxonomies -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <?php if ($speaker_types && !is_wp_error($speaker_types)): ?>
                            <?php foreach ($speaker_types as $type): ?>
                                <span class="bg-uandes-red text-white text-xs font-bold px-3 py-1 rounded uppercase tracking-wider">
                                    <?php echo esc_html($type->name); ?>
                                </span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <?php if ($tracks && !is_wp_error($tracks)): ?>
                            <?php foreach ($tracks as $track): ?>
                                <span class="bg-nd-gold text-nd-navy text-xs font-bold px-3 py-1 rounded uppercase tracking-wider">
                                    <?php echo esc_html($track->name); ?>
                                </span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Social Links -->
                    <?php if ($linkedin || $twitter || $website): ?>
                    <div class="flex gap-3">
                        <?php if ($linkedin): ?>
                            <a href="<?php echo esc_url($linkedin); ?>" 
                               target="_blank" 
                               rel="noopener"
                               class="w-10 h-10 rounded-full bg-white/10 hover:bg-nd-gold flex items-center justify-center transition text-white hover:text-nd-navy">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($twitter): ?>
                            <a href="<?php echo esc_url($twitter); ?>" 
                               target="_blank" 
                               rel="noopener"
                               class="w-10 h-10 rounded-full bg-white/10 hover:bg-nd-gold flex items-center justify-center transition text-white hover:text-nd-navy">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($website): ?>
                            <a href="<?php echo esc_url($website); ?>" 
                               target="_blank" 
                               rel="noopener"
                               class="w-10 h-10 rounded-full bg-white/10 hover:bg-nd-gold flex items-center justify-center transition text-white hover:text-nd-navy">
                                <i class="fa-solid fa-globe"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 py-16">
        
        <!-- Talk/Presentation -->
        <?php if ($talk_title || $talk_description): ?>
        <div class="mb-12 p-8 bg-light-gray rounded-lg border-l-4 border-uandes-red">
            <h2 class="font-sans font-bold text-2xl text-nd-navy mb-4 flex items-center gap-3">
                <i class="fa-solid fa-presentation text-uandes-red"></i>
                <?php _e('Presentation', 'rise-ai-summit'); ?>
            </h2>
            
            <?php if ($talk_title): ?>
                <h3 class="font-serif text-xl text-nd-navy mb-3 italic">
                    "<?php echo esc_html($talk_title); ?>"
                </h3>
            <?php endif; ?>
            
            <?php if ($talk_description): ?>
                <p class="text-gray-700 font-serif leading-relaxed">
                    <?php echo wp_kses_post(wpautop($talk_description)); ?>
                </p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- Bio -->
        <div class="prose prose-lg max-w-none font-serif text-gray-700">
            <h2 class="font-sans font-bold text-nd-navy"><?php _e('Biography', 'rise-ai-summit'); ?></h2>
            <?php the_content(); ?>
        </div>
        
    </div>
    
</article>

<?php
endwhile;

get_footer();