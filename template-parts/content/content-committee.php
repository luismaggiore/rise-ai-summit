<?php
/**
 * Template part for displaying committee members
 * 
 * @package RISE_AI_Summit
 */

$role = get_post_meta(get_the_ID(), 'committee_role', true);
$institution = get_post_meta(get_the_ID(), 'committee_institution', true);
$email = get_post_meta(get_the_ID(), 'committee_email', true);
?>

<div class="committee-member-card flex items-start gap-4 p-6 rounded-lg bg-white border border-gray-200 shadow-sm hover:shadow-md transition">
    
    <!-- Photo -->
    <div class="committee-photo-wrapper flex-shrink-0">
        <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-100 border-4 border-white shadow-md">
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('committee-photo', array(
                    'class' => 'w-full h-full object-cover',
                    'alt' => get_the_title()
                )); ?>
            <?php else: ?>
                <div class="w-full h-full flex items-center justify-center text-gray-300">
                    <i class="fa-solid fa-user text-3xl"></i>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Info -->
    <div class="committee-info flex-1">
        <h4 class="font-sans font-bold text-lg text-nd-navy mb-1">
            <?php the_title(); ?>
        </h4>
        
        <?php if ($role): ?>
        <p class="text-uandes-red font-bold text-sm uppercase tracking-wide mb-2">
            <?php echo esc_html($role); ?>
        </p>
        <?php endif; ?>
        
        <?php if ($institution): ?>
        <p class="text-gray-600 text-sm font-serif mb-2">
            <?php echo esc_html($institution); ?>
        </p>
        <?php endif; ?>
        
        <!-- Bio excerpt -->
        <?php if (has_excerpt()): ?>
        <p class="text-gray-600 text-sm font-serif line-clamp-2 mb-3">
            <?php echo get_the_excerpt(); ?>
        </p>
        <?php endif; ?>
        
        <!-- Email -->
        <?php if ($email): ?>
        <a href="mailto:<?php echo esc_attr($email); ?>" 
           class="text-nd-navy hover:text-uandes-red text-sm inline-flex items-center gap-2 transition">
            <i class="fa-solid fa-envelope"></i>
            <?php echo esc_html($email); ?>
        </a>
        <?php endif; ?>
    </div>
    
</div>