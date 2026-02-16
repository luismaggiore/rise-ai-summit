<?php
/**
 * Template Part: Sponsors Section for Homepage
 * Displays sponsor logos by tier
 * 
 * @package RISE_AI_Summit
 */

// Get all sponsors
$all_sponsors = get_posts(array(
    'post_type' => 'sponsor',
    'posts_per_page' => -1,
    'orderby' => 'meta_value_num',
    'meta_key' => 'sponsor_display_order',
    'order' => 'ASC'
));

if (empty($all_sponsors)) {
    return; // No sponsors, don't show section
}

// Group sponsors by level
$sponsors_by_level = array(
    'platinum' => array(),
    'gold' => array(),
    'silver' => array(),
    'bronze' => array(),
    'in-kind' => array()
);

foreach ($all_sponsors as $sponsor) {
    // Get sponsor level from taxonomy (NOT meta field)
    $terms = get_the_terms($sponsor->ID, 'sponsor_level');
    
    if ($terms && !is_wp_error($terms)) {
        $level_slug = $terms[0]->slug;
        if (isset($sponsors_by_level[$level_slug])) {
            $sponsors_by_level[$level_slug][] = $sponsor;
        }
    }
}
?>

<section class="sponsors-home-section py-20 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        
        <!-- Section Header -->
        <div class="text-center mb-16">
            <span class="text-nd-gold font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Our Partners', 'rise-ai-summit'); ?>
            </span>
            <h2 class="font-sans font-bold text-3xl md:text-4xl text-nd-navy mb-4">
                <?php _e('Summit Sponsors', 'rise-ai-summit'); ?>
            </h2>
            <p class="text-gray-600 font-serif text-lg max-w-2xl mx-auto">
                <?php _e('Thank you to our sponsors for making RISE AI South America Summit possible.', 'rise-ai-summit'); ?>
            </p>
        </div>
        
        <!-- Platinum Sponsors -->
        <?php if (!empty($sponsors_by_level['platinum'])): ?>
        <div class="mb-16">
            <div class="text-center mb-8">
                <h3 class="inline-flex items-center gap-2 font-sans font-bold text-xl text-gray-800 px-6 py-2 bg-gray-100 rounded-full">
                    <i class="fa-solid fa-crown text-gray-600"></i>
                    <?php _e('Platinum Sponsors', 'rise-ai-summit'); ?>
                </h3>
            </div>
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <?php foreach ($sponsors_by_level['platinum'] as $sponsor): 
                    $logo_id = get_post_thumbnail_id($sponsor->ID); // Featured Image
                    $website = get_post_meta($sponsor->ID, 'sponsor_website', true);
                ?>
                    <div class="sponsor-card bg-white rounded-lg p-8 border-2 border-gray-200 hover:border-gray-400 transition shadow-sm hover:shadow-md flex items-center justify-center group">
                        <?php if ($website): ?>
                            <a href="<?php echo esc_url($website); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="block w-full"
                               title="<?php echo esc_attr($sponsor->post_title); ?>">
                        <?php endif; ?>
                        
                        <?php if ($logo_id): ?>
                            <?php echo wp_get_attachment_image($logo_id, 'medium', false, array(
                                'class' => 'max-h-24 w-auto mx-auto object-contain grayscale group-hover:grayscale-0 transition duration-300',
                                'alt' => esc_attr($sponsor->post_title)
                            )); ?>
                        <?php else: ?>
                            <div class="text-center py-8">
                                <h4 class="font-sans font-bold text-2xl text-gray-400 group-hover:text-nd-navy transition">
                                    <?php echo esc_html($sponsor->post_title); ?>
                                </h4>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($website): ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Gold Sponsors -->
        <?php if (!empty($sponsors_by_level['gold'])): ?>
        <div class="mb-16">
            <div class="text-center mb-8">
                <h3 class="inline-flex items-center gap-2 font-sans font-bold text-lg text-gray-700 px-6 py-2 bg-yellow-50 rounded-full">
                    <i class="fa-solid fa-medal text-nd-gold"></i>
                    <?php _e('Gold Sponsors', 'rise-ai-summit'); ?>
                </h3>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto">
                <?php foreach ($sponsors_by_level['gold'] as $sponsor): 
                    $logo_id = get_post_thumbnail_id($sponsor->ID);
                    $website = get_post_meta($sponsor->ID, 'sponsor_website', true);
                ?>
                    <div class="sponsor-card bg-white rounded-lg p-6 border border-gray-200 hover:border-nd-gold transition shadow-sm hover:shadow-md flex items-center justify-center group">
                        <?php if ($website): ?>
                            <a href="<?php echo esc_url($website); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="block w-full"
                               title="<?php echo esc_attr($sponsor->post_title); ?>">
                        <?php endif; ?>
                        
                        <?php if ($logo_id): ?>
                            <?php echo wp_get_attachment_image($logo_id, 'medium', false, array(
                                'class' => 'max-h-16 w-auto mx-auto object-contain grayscale group-hover:grayscale-0 transition duration-300',
                                'alt' => esc_attr($sponsor->post_title)
                            )); ?>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <h4 class="font-sans font-bold text-lg text-gray-400 group-hover:text-nd-navy transition">
                                    <?php echo esc_html($sponsor->post_title); ?>
                                </h4>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($website): ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Silver Sponsors -->
        <?php if (!empty($sponsors_by_level['silver'])): ?>
        <div class="mb-16">
            <div class="text-center mb-8">
                <h3 class="inline-flex items-center gap-2 font-sans font-bold text-base text-gray-600 px-5 py-2 bg-gray-50 rounded-full">
                    <i class="fa-solid fa-award text-gray-400"></i>
                    <?php _e('Silver Sponsors', 'rise-ai-summit'); ?>
                </h3>
            </div>
            <div class="grid grid-cols-3 md:grid-cols-6 gap-4 max-w-6xl mx-auto">
                <?php foreach ($sponsors_by_level['silver'] as $sponsor): 
                    $logo_id = get_post_thumbnail_id($sponsor->ID);
                    $website = get_post_meta($sponsor->ID, 'sponsor_website', true);
                ?>
                    <div class="sponsor-card bg-white rounded-lg p-4 border border-gray-100 hover:border-gray-300 transition flex items-center justify-center group">
                        <?php if ($website): ?>
                            <a href="<?php echo esc_url($website); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="block w-full"
                               title="<?php echo esc_attr($sponsor->post_title); ?>">
                        <?php endif; ?>
                        
                        <?php if ($logo_id): ?>
                            <?php echo wp_get_attachment_image($logo_id, 'thumbnail', false, array(
                                'class' => 'max-h-12 w-auto mx-auto object-contain grayscale group-hover:grayscale-0 transition duration-300',
                                'alt' => esc_attr($sponsor->post_title)
                            )); ?>
                        <?php else: ?>
                            <div class="text-center py-2">
                                <h4 class="font-sans font-bold text-sm text-gray-400 group-hover:text-nd-navy transition">
                                    <?php echo esc_html($sponsor->post_title); ?>
                                </h4>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($website): ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Bronze & In-Kind (Combined, smaller) -->
        <?php 
        $supporting_sponsors = array_merge(
            $sponsors_by_level['bronze'],
            $sponsors_by_level['in-kind']
        );
        if (!empty($supporting_sponsors)): 
        ?>
        <div>
            <div class="text-center mb-6">
                <h3 class="inline-flex items-center gap-2 font-sans font-bold text-sm text-gray-500 px-4 py-1 bg-gray-50 rounded-full">
                    <?php _e('Supporting Sponsors', 'rise-ai-summit'); ?>
                </h3>
            </div>
            <div class="flex flex-wrap justify-center items-center gap-6 max-w-6xl mx-auto">
                <?php foreach ($supporting_sponsors as $sponsor): 
                    $logo_id = get_post_thumbnail_id($sponsor->ID);
                    $website = get_post_meta($sponsor->ID, 'sponsor_website', true);
                ?>
                    <div class="sponsor-card-small">
                        <?php if ($website): ?>
                            <a href="<?php echo esc_url($website); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               title="<?php echo esc_attr($sponsor->post_title); ?>">
                        <?php endif; ?>
                        
                        <?php if ($logo_id): ?>
                            <?php echo wp_get_attachment_image($logo_id, 'thumbnail', false, array(
                                'class' => 'max-h-10 w-auto object-contain grayscale hover:grayscale-0 transition duration-300',
                                'alt' => esc_attr($sponsor->post_title)
                            )); ?>
                        <?php else: ?>
                            <span class="font-sans text-xs text-gray-400 hover:text-nd-navy transition">
                                <?php echo esc_html($sponsor->post_title); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ($website): ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- CTA to Become Sponsor -->
        <div class="text-center mt-16 pt-12 border-t border-gray-200">
            <p class="text-gray-600 font-serif mb-6">
                <?php _e('Interested in supporting RISE AI South America Summit?', 'rise-ai-summit'); ?>
            </p>
            <?php
            // Get sponsorship page URL
            $sponsorship_page = get_page_by_path('sponsorship');
            $sponsorship_url = $sponsorship_page ? get_permalink($sponsorship_page->ID) : home_url('/sponsorship/');
            ?>
            <a href="<?php echo esc_url($sponsorship_url); ?>" 
               class="inline-flex items-center gap-2 bg-uandes-red hover:bg-nd-navy text-white px-8 py-3 rounded font-sans font-bold uppercase tracking-wider transition shadow-md text-sm">
                <i class="fa-solid fa-handshake"></i>
                <?php _e('Become a Sponsor', 'rise-ai-summit'); ?>
            </a>
        </div>
        
    </div>
</section>

<style>
/* Grayscale effect on logos */
.sponsor-card img,
.sponsor-card-small img {
    filter: grayscale(100%);
    opacity: 0.7;
    transition: all 0.3s ease;
}

.sponsor-card:hover img,
.sponsor-card-small:hover img {
    filter: grayscale(0%);
    opacity: 1;
}

/* Sponsor card hover effects */
.sponsor-card {
    transition: all 0.3s ease;
}

.sponsor-card:hover {
    transform: translateY(-2px);
}
</style>