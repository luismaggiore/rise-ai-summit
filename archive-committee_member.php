<?php
/**
 * Archive template for Committee Members (Team)
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="committee-archive">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Leadership', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl md:text-5xl text-nd-navy">
                <?php _e('Organizing Committees', 'rise-ai-summit'); ?>
            </h1>
            <p class="mt-4 text-gray-600 font-serif text-lg">
                <?php _e('The team behind RISE AI South America.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>
    
    <!-- Committee Members by Type -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        
        <?php
        // Get all committee types
        $committee_types = get_terms(array(
            'taxonomy' => 'committee_type',
            'hide_empty' => true,
            'orderby' => 'term_id',
            'order' => 'ASC',
        ));
        
        if ($committee_types && !is_wp_error($committee_types)):
            
            foreach ($committee_types as $type):
                
                // Query members for this type
                $members_query = new WP_Query(array(
                    'post_type' => 'committee_member',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'committee_type',
                            'field' => 'slug',
                            'terms' => $type->slug,
                        ),
                    ),
                    'meta_key' => 'committee_display_order',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                ));
                
                if (!$members_query->have_posts()) continue;
                
                // Type-specific styling
                $type_colors = array(
                    'general-chairs' => 'border-uandes-red',
                    'program-chairs' => 'border-nd-navy',
                    'track-chairs' => 'border-nd-gold',
                    'local-team' => 'border-gray-300',
                );
                
                $border_class = isset($type_colors[$type->slug]) ? $type_colors[$type->slug] : 'border-gray-300';
        ?>
        
        <div class="mb-16">
            
            <!-- Type Header -->
            <h2 class="font-sans font-bold text-2xl text-nd-navy mb-2 pb-4 border-b-4 <?php echo $border_class; ?> inline-block">
                <?php echo esc_html($type->name); ?>
            </h2>
            
            <?php if ($type->description): ?>
                <p class="text-gray-600 font-serif mt-4 mb-8">
                    <?php echo esc_html($type->description); ?>
                </p>
            <?php endif; ?>
            
            <!-- Members Grid -->
            <div class="grid md:grid-cols-2 gap-6 mt-8">
                <?php while ($members_query->have_posts()): $members_query->the_post(); ?>
                    <?php get_template_part('template-parts/content/content', 'committee'); ?>
                <?php endwhile; ?>
            </div>
            
        </div>
        
        <?php
            wp_reset_postdata();
            endforeach;
            
        else:
        ?>
        
        <!-- No committee members yet -->
        <div class="text-center py-20">
            <i class="fa-solid fa-users text-6xl text-gray-300 mb-6"></i>
            <h2 class="font-sans font-bold text-2xl text-nd-navy mb-4">
                <?php _e('Committee Information Coming Soon', 'rise-ai-summit'); ?>
            </h2>
            <p class="text-gray-600 font-serif">
                <?php _e('We are finalizing our organizing committee.', 'rise-ai-summit'); ?>
            </p>
        </div>
        
        <?php endif; ?>
        
    </div>
    
    <!-- Contact CTA -->
    <div class="bg-light-gray py-16 border-t border-gray-200">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="font-sans font-bold text-3xl text-nd-navy mb-4">
                <?php _e('Questions About the Summit?', 'rise-ai-summit'); ?>
            </h2>
            <p class="text-gray-600 font-serif text-lg mb-8">
                <?php _e('Our organizing team is here to help.', 'rise-ai-summit'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" 
               class="inline-flex items-center gap-2 bg-uandes-red hover:bg-red-700 text-white font-bold px-8 py-4 rounded transition shadow-lg">
                <i class="fa-solid fa-envelope"></i>
                <?php _e('Contact Us', 'rise-ai-summit'); ?>
            </a>
        </div>
    </div>
    
</div>

<?php
get_footer();