<?php
/**
 * Archive template for Sponsors
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="sponsors-archive">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Our Partners', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl md:text-5xl text-nd-navy">
                <?php _e('Sponsors', 'rise-ai-summit'); ?>
            </h1>
            <p class="mt-4 text-gray-600 font-serif text-lg max-w-2xl mx-auto">
                <?php _e('Thank you to our sponsors who make this summit possible.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>
    
    <!-- Sponsors by Level -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        
        <?php
        // Get all sponsor levels
        $sponsor_levels = get_terms(array(
            'taxonomy' => 'sponsor_level',
            'hide_empty' => true,
            'orderby' => 'term_id',
            'order' => 'ASC',
        ));
        
        if ($sponsor_levels && !is_wp_error($sponsor_levels)):
            
            foreach ($sponsor_levels as $level):
                
                // Query sponsors for this level
                $sponsors_query = new WP_Query(array(
                    'post_type' => 'sponsor',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'sponsor_level',
                            'field' => 'slug',
                            'terms' => $level->slug,
                        ),
                    ),
                    'meta_key' => 'sponsor_display_order',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                ));
                
                if (!$sponsors_query->have_posts()) continue;
                
                // Level-specific styling
                $level_colors = array(
                    'platinum' => 'border-gray-400 bg-gradient-to-r from-gray-100 to-gray-50',
                    'gold' => 'border-nd-gold bg-gradient-to-r from-yellow-50 to-amber-50',
                    'silver' => 'border-gray-300 bg-gradient-to-r from-slate-50 to-gray-50',
                    'bronze' => 'border-amber-600 bg-gradient-to-r from-orange-50 to-amber-50',
                    'in-kind' => 'border-blue-300 bg-gradient-to-r from-blue-50 to-indigo-50',
                );
                
                $level_badge_colors = array(
                    'platinum' => 'bg-gray-700 text-white',
                    'gold' => 'bg-nd-gold text-nd-navy',
                    'silver' => 'bg-gray-400 text-white',
                    'bronze' => 'bg-amber-700 text-white',
                    'in-kind' => 'bg-blue-600 text-white',
                );
                
                $level_class = isset($level_colors[$level->slug]) ? $level_colors[$level->slug] : 'border-gray-200 bg-white';
                $badge_class = isset($level_badge_colors[$level->slug]) ? $level_badge_colors[$level->slug] : 'bg-gray-600 text-white';
                
                // Grid columns based on level
                $grid_cols = 'md:grid-cols-4';
                if ($level->slug === 'platinum') {
                    $grid_cols = 'md:grid-cols-2';
                } elseif ($level->slug === 'gold') {
                    $grid_cols = 'md:grid-cols-3';
                }
        ?>
        
        <div class="mb-16 pb-16 border-b border-gray-200 last:border-b-0">
            
            <!-- Level Header -->
            <div class="flex items-center justify-center mb-10">
                <div class="text-center">
                    <span class="inline-block <?php echo $badge_class; ?> text-sm font-bold px-6 py-2 rounded-full uppercase tracking-widest mb-3">
                        <?php echo esc_html($level->name); ?>
                        <span class="opacity-75 ml-2">(<?php echo $level->count; ?>)</span>
                    </span>
                    
                    <?php if ($level->description): ?>
                        <p class="text-gray-600 text-sm font-serif max-w-xl mx-auto">
                            <?php echo esc_html($level->description); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Sponsors Grid -->
            <div class="grid grid-cols-2 <?php echo $grid_cols; ?> gap-8">
                <?php while ($sponsors_query->have_posts()): $sponsors_query->the_post(); ?>
                    <?php get_template_part('template-parts/content/content', 'sponsor'); ?>
                <?php endwhile; ?>
            </div>
            
        </div>
        
        <?php
            wp_reset_postdata();
            endforeach;
            
        else:
        ?>
        
        <!-- No sponsors yet -->
        <div class="text-center py-20">
            <i class="fa-solid fa-award text-6xl text-gray-300 mb-6"></i>
            <h2 class="font-sans font-bold text-2xl text-nd-navy mb-4">
                <?php _e('Sponsorship Opportunities Available', 'rise-ai-summit'); ?>
            </h2>
            <p class="text-gray-600 font-serif mb-6">
                <?php _e('Be part of the leading AI summit in South America.', 'rise-ai-summit'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/sponsorship/')); ?>" 
               class="inline-block bg-uandes-red hover:bg-red-700 text-white font-bold px-8 py-3 rounded transition">
                <?php _e('Learn More About Sponsorship', 'rise-ai-summit'); ?>
            </a>
        </div>
        
        <?php endif; ?>
        
    </div>
    
    <!-- CTA Section -->
    <div class="bg-nd-navy text-white py-16 border-t-4 border-nd-gold">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="font-sans font-bold text-3xl mb-4">
                <?php _e('Interested in Sponsoring?', 'rise-ai-summit'); ?>
            </h2>
            <p class="text-gray-300 font-serif text-lg mb-8">
                <?php _e('Join our partners in advancing responsible AI innovation across South America.', 'rise-ai-summit'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/sponsorship/')); ?>" 
               class="inline-block bg-uandes-red hover:bg-red-700 text-white font-bold px-8 py-4 rounded transition shadow-lg">
                <?php _e('View Sponsorship Packages', 'rise-ai-summit'); ?>
            </a>
        </div>
    </div>
    
</div>

<?php
get_footer();