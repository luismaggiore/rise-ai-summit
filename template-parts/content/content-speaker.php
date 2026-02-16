<?php
/**
 * Template part for displaying speaker cards
 * 
 * @package RISE_AI_Summit
 */

$credentials = get_post_meta(get_the_ID(), 'speaker_title_credentials', true);
$position = get_post_meta(get_the_ID(), 'speaker_position', true);
$institution = get_post_meta(get_the_ID(), 'speaker_institution', true);
$talk_title = get_post_meta(get_the_ID(), 'speaker_talk_title', true);

// Get speaker type
$speaker_types = get_the_terms(get_the_ID(), 'speaker_type');
$is_keynote = false;
if ($speaker_types && !is_wp_error($speaker_types)) {
    foreach ($speaker_types as $type) {
        if ($type->slug === 'keynote') {
            $is_keynote = true;
            break;
        }
    }
}
?>

<div class="speaker-card group <?php echo $is_keynote ? 'keynote-speaker' : ''; ?>">
    
    <!-- Photo -->
    <div class="speaker-photo-wrapper aspect-[4/5] bg-gray-200 rounded-lg overflow-hidden mb-4 relative shadow-md">
        <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('speaker-photo', array(
                'class' => 'w-full h-full object-cover',
                'alt' => get_the_title()
            )); ?>
        <?php else: ?>
            <div class="absolute inset-0 flex items-center justify-center text-gray-400 bg-gray-100">
                <i class="fa-solid fa-user text-6xl"></i>
            </div>
        <?php endif; ?>
        
        <!-- Hover Overlay with Talk Title -->
        <?php if ($talk_title): ?>
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-nd-navy to-transparent p-6 pt-20 translate-y-full group-hover:translate-y-0 transition duration-300">
            <p class="text-white text-sm font-serif italic line-clamp-3">
                "<?php echo esc_html($talk_title); ?>"
            </p>
        </div>
        <?php endif; ?>
        
        <!-- Keynote Badge -->
        <?php if ($is_keynote): ?>
        <div class="absolute top-4 left-4">
            <span class="bg-uandes-red text-white text-xs font-bold px-3 py-1 rounded uppercase tracking-wider">
                <?php _e('Keynote', 'rise-ai-summit'); ?>
            </span>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Info -->
    <div class="speaker-info">
        <h3 class="font-sans font-bold text-xl text-nd-navy mb-1">
            <a href="<?php the_permalink(); ?>" class="hover:text-uandes-red transition">
                <?php the_title(); ?>
                <?php if ($credentials): ?>
                    <span class="text-sm font-normal">, <?php echo esc_html($credentials); ?></span>
                <?php endif; ?>
            </a>
        </h3>
        
        <?php if ($institution): ?>
        <p class="text-uandes-red font-bold text-xs uppercase tracking-wider mb-1">
            <?php echo esc_html($institution); ?>
        </p>
        <?php endif; ?>
        
        <?php if ($position): ?>
        <p class="text-gray-500 text-sm font-serif mb-3">
            <?php echo esc_html($position); ?>
        </p>
        <?php endif; ?>
        
        <!-- Excerpt -->
        <?php if (has_excerpt()): ?>
        <p class="text-gray-600 text-sm font-serif line-clamp-3 mb-3">
            <?php echo get_the_excerpt(); ?>
        </p>
        <?php endif; ?>
        
        <!-- Read More Link -->
        <a href="<?php the_permalink(); ?>" 
           class="text-uandes-red font-bold text-sm inline-flex items-center gap-2 hover:gap-3 transition-all">
            <?php _e('View Profile', 'rise-ai-summit'); ?>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
    
</div>