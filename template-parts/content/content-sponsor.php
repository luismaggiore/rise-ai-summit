<?php
/**
 * Template part for displaying sponsor logos
 * 
 * @package RISE_AI_Summit
 */

$website = get_post_meta(get_the_ID(), 'sponsor_website', true);
$description = get_the_excerpt();
?>

<div class="sponsor-card text-center group">
    
    <!-- Logo -->
    <div class="sponsor-logo-wrapper bg-white p-6 rounded-lg border border-gray-200 hover:border-uandes-red/30 hover:shadow-md transition duration-300 mb-4">
        <?php if (has_post_thumbnail()): ?>
            <a href="<?php echo $website ? esc_url($website) : '#'; ?>" 
               <?php echo $website ? 'target="_blank" rel="noopener"' : ''; ?>
               class="block">
                <?php the_post_thumbnail('sponsor-logo', array(
                    'class' => 'w-full h-auto max-h-32 object-contain mx-auto',
                    'alt' => get_the_title()
                )); ?>
            </a>
        <?php else: ?>
            <div class="h-32 flex items-center justify-center text-gray-300">
                <i class="fa-solid fa-award text-6xl"></i>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Name -->
    <h3 class="font-sans font-bold text-lg text-nd-navy mb-2">
        <?php if ($website): ?>
            <a href="<?php echo esc_url($website); ?>" 
               target="_blank" 
               rel="noopener"
               class="hover:text-uandes-red transition">
                <?php the_title(); ?>
            </a>
        <?php else: ?>
            <?php the_title(); ?>
        <?php endif; ?>
    </h3>
    
    <!-- Description (if exists) -->
    <?php if ($description): ?>
    <p class="text-sm text-gray-600 font-serif line-clamp-2">
        <?php echo esc_html($description); ?>
    </p>
    <?php endif; ?>
    
    <!-- Website Link -->
    <?php if ($website): ?>
    <a href="<?php echo esc_url($website); ?>" 
       target="_blank" 
       rel="noopener"
       class="inline-flex items-center gap-2 text-xs text-gray-500 hover:text-uandes-red mt-2 transition">
        <i class="fa-solid fa-external-link-alt"></i>
        <?php _e('Visit Website', 'rise-ai-summit'); ?>
    </a>
    <?php endif; ?>
    
</div>