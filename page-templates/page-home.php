<?php
/**
 * Template Name: Home Page
 * 
 * @package RISE_AI_Summit
 */

get_header();

// Get custom fields
$hero_image_id = get_post_meta(get_the_ID(), 'home_hero_image_override', true);
$featured_speaker_ids = get_post_meta(get_the_ID(), 'home_featured_speakers', true);

// Default hero image
$default_hero = 'https://rise-ai-summit.s3.us-east-1.amazonaws.com/Banner_1.png';
$hero_image = $hero_image_id ? wp_get_attachment_url($hero_image_id) : $default_hero;
?>

<div class="home-page">
    
    <!-- 1. HERO BANNER -->
    <div class="w-full">
        <img src="<?php echo esc_url($hero_image); ?>" 
             alt="RISE AI South America Summit Banner" 
             class="w-full h-auto block shadow-sm"
             referrerpolicy="no-referrer">
    </div>

    <!-- 2. TITLE & ACTION BAR -->
    <div class="bg-nd-navy py-10 border-b-4 border-uandes-red">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left">
            
            <!-- Title & Date -->
            <div class="text-white">
                <div class="inline-flex items-center gap-2 text-nd-gold text-xs font-bold uppercase tracking-widest mb-2">
                    <i class="fa-regular fa-calendar"></i>
                    <span class="lang-en">October 2026 • Santiago, Chile</span>
                </div>
                <h1 class="font-sans font-extrabold text-3xl md:text-4xl leading-tight text-white">
                    RISE AI South America Summit
                </h1>
                <p class="text-gray-300 mt-2 font-serif font-light max-w-xl">
                    <?php _e('Advancing Responsible, Inclusive, Safe, and Ethical AI.', 'rise-ai-summit'); ?>
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-center gap-4 font-sans shrink-0">
                <a href="<?php echo esc_url(home_url('/tracks/')); ?>" 
                   class="bg-uandes-red hover:bg-red-700 text-white px-6 py-3 rounded font-bold transition duration-300 text-sm shadow-lg border border-transparent">
                    <?php _e('Explore Tracks', 'rise-ai-summit'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/research/')); ?>" 
                   class="group bg-transparent border border-white hover:bg-white hover:text-nd-navy text-white px-6 py-3 rounded font-bold transition duration-300 text-sm flex items-center gap-2">
                    <?php _e('Call for Abstracts', 'rise-ai-summit'); ?>
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- 3. ABOUT TEASER -->
    <section class="py-24 bg-white relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-nd-navy via-nd-gold to-uandes-red"></div>
        <div class="max-w-4xl mx-auto px-4 text-center">
            <span class="text-nd-gold font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('The Legacy Continues', 'rise-ai-summit'); ?>
            </span>
            <h2 class="font-sans font-bold text-3xl md:text-4xl text-nd-navy mb-8">
                <?php _e('A Regional Convening for Global Impact', 'rise-ai-summit'); ?>
            </h2>
            <p class="text-lg text-gray-600 mb-12 leading-relaxed font-serif">
                <?php _e('Building on the legacy of the original RISE AI Conference at Notre Dame, this South American summit brings together academia, industry, and government to define the future of ethical AI in our continent.', 'rise-ai-summit'); ?>
            </p>
            
            <div class="grid md:grid-cols-3 gap-8 text-left max-w-4xl mx-auto mb-12">
                <div class="group p-6 rounded-lg border border-gray-100 hover:border-uandes-red/30 hover:bg-red-50/30 transition cursor-default">
                    <div class="w-12 h-12 bg-uandes-red/10 text-uandes-red rounded-full flex items-center justify-center mb-4 group-hover:bg-uandes-red group-hover:text-white transition">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <h4 class="font-bold text-nd-navy font-sans mb-1"><?php _e('Business Strategy', 'rise-ai-summit'); ?></h4>
                    <p class="text-sm text-gray-500"><?php _e('AI adoption & governance models.', 'rise-ai-summit'); ?></p>
                </div>
                <div class="group p-6 rounded-lg border border-gray-100 hover:border-nd-gold/50 hover:bg-yellow-50/30 transition cursor-default">
                    <div class="w-12 h-12 bg-nd-gold/10 text-nd-gold rounded-full flex items-center justify-center mb-4 group-hover:bg-nd-gold group-hover:text-white transition">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h4 class="font-bold text-nd-navy font-sans mb-1"><?php _e('Education Policy', 'rise-ai-summit'); ?></h4>
                    <p class="text-sm text-gray-500"><?php _e('Skills & institutional transformation.', 'rise-ai-summit'); ?></p>
                </div>
                <div class="group p-6 rounded-lg border border-gray-100 hover:border-nd-navy/30 hover:bg-blue-50/30 transition cursor-default">
                    <div class="w-12 h-12 bg-nd-navy/10 text-nd-navy rounded-full flex items-center justify-center mb-4 group-hover:bg-nd-navy group-hover:text-white transition">
                        <i class="fa-solid fa-microscope"></i>
                    </div>
                    <h4 class="font-bold text-nd-navy font-sans mb-1"><?php _e('Applied Science', 'rise-ai-summit'); ?></h4>
                    <p class="text-sm text-gray-500"><?php _e('Health & engineering innovation.', 'rise-ai-summit'); ?></p>
                </div>
            </div>
            
            <a href="<?php echo esc_url(rise_ai_get_page_url_by_slug('about')); ?>" 
               class="text-uandes-red font-bold hover:text-nd-navy font-sans uppercase text-sm tracking-wide border-b-2 border-uandes-red hover:border-nd-navy transition pb-1">
                <?php _e('Read Full Overview', 'rise-ai-summit'); ?>
            </a>
        </div>
    </section>

    <?php get_template_part('template-parts/section', 'sponsors-home'); ?>

    <!-- Get Involved CTA Section -->
<?php get_template_part('template-parts/section', 'cta-home'); ?>

    <!-- 4. FEATURED SPEAKERS 
    <section class="py-20 bg-light-gray">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                    <?php _e('Lineup', 'rise-ai-summit'); ?>
                </span>
                <h2 class="font-sans font-bold text-3xl md:text-4xl text-nd-navy">
                    <?php _e('Featured Speakers', 'rise-ai-summit'); ?>
                </h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-10 mb-10">
                <?php
                // Get featured speakers
                if ($featured_speaker_ids) {
                    $speaker_ids = array_map('trim', explode(',', $featured_speaker_ids));
                    $speakers_args = array(
                        'post_type' => 'speaker',
                        'post__in' => $speaker_ids,
                        'posts_per_page' => 3,
                        'orderby' => 'post__in',
                    );
                } else {
                    // Default: get keynote speakers
                    $speakers_args = array(
                        'post_type' => 'speaker',
                        'posts_per_page' => 3,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'speaker_type',
                                'field' => 'slug',
                                'terms' => 'keynote',
                            ),
                        ),
                    );
                }
                
                $speakers_query = new WP_Query($speakers_args);
                
                if ($speakers_query->have_posts()):
                    while ($speakers_query->have_posts()): $speakers_query->the_post();
                        get_template_part('template-parts/content/content', 'speaker');
                    endwhile;
                    wp_reset_postdata();
                else:
                ?>
                    <div class="col-span-3 text-center py-10">
                        <p class="text-gray-500 font-serif">
                            <?php _e('Speaker lineup coming soon!', 'rise-ai-summit'); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="text-center">
                <a href="<?php echo esc_url(get_post_type_archive_link('speaker')); ?>" 
                   class="inline-flex items-center gap-2 bg-nd-navy hover:bg-uandes-red text-white font-bold px-8 py-3 rounded transition shadow-md">
                    <?php _e('View All Speakers', 'rise-ai-summit'); ?>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
    
</div>-->

<?php
get_footer();