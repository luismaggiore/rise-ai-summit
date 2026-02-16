<?php
/**
 * Template for displaying single research paper
 * 
 * @package RISE_AI_Summit
 */

get_header();

while (have_posts()) : the_post();
    
    // Get meta fields
    $authors = get_post_meta(get_the_ID(), 'research_authors', true);
    $institutions = get_post_meta(get_the_ID(), 'research_institutions', true);
    $abstract = get_post_meta(get_the_ID(), 'research_abstract', true);
    $keywords = get_post_meta(get_the_ID(), 'research_keywords', true);
    $pdf = get_post_meta(get_the_ID(), 'research_pdf', true);
    $presentation_type = get_post_meta(get_the_ID(), 'research_presentation_type', true);
    $session_date = get_post_meta(get_the_ID(), 'research_session_date', true);
    $session_time = get_post_meta(get_the_ID(), 'research_session_time', true);
    $session_room = get_post_meta(get_the_ID(), 'research_session_room', true);
    $contact_email = get_post_meta(get_the_ID(), 'research_contact_email', true);
    
    // Get track
    $terms = get_the_terms(get_the_ID(), 'research_track');
    $track_name = $terms && !is_wp_error($terms) ? $terms[0]->name : '';
    $track_slug = $terms && !is_wp_error($terms) ? $terms[0]->slug : '';
?>

<div class="single-research bg-white">
    
    <!-- Header -->
    <header class="bg-light-gray py-16 border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4">
            
            <!-- Track Badge -->
            <?php if ($track_name): 
                $track_colors = array(
                    'business' => 'bg-nd-navy text-white',
                    'education' => 'bg-nd-gold text-nd-navy',
                    'science' => 'bg-uandes-red text-white'
                );
                $track_color = isset($track_colors[$track_slug]) ? $track_colors[$track_slug] : 'bg-gray-600 text-white';
            ?>
                <a href="<?php echo esc_url(get_term_link($terms[0])); ?>" 
                   class="inline-flex items-center gap-2 <?php echo $track_color; ?> px-4 py-2 rounded text-xs font-bold uppercase tracking-wider mb-4 hover:opacity-80 transition">
                    <?php if ($track_slug === 'business'): ?>
                        <i class="fa-solid fa-briefcase"></i>
                    <?php elseif ($track_slug === 'education'): ?>
                        <i class="fa-solid fa-graduation-cap"></i>
                    <?php elseif ($track_slug === 'science'): ?>
                        <i class="fa-solid fa-microscope"></i>
                    <?php endif; ?>
                    <?php echo esc_html($track_name); ?>
                </a>
            <?php endif; ?>
            
            <!-- Title -->
            <h1 class="font-sans font-bold text-4xl md:text-5xl text-nd-navy leading-tight mb-6">
                <?php the_title(); ?>
            </h1>
            
            <!-- Authors -->
            <?php if ($authors): ?>
                <p class="text-lg text-gray-700 font-serif mb-2">
                    <i class="fa-solid fa-user-pen text-uandes-red mr-2"></i>
                    <?php echo esc_html($authors); ?>
                </p>
            <?php endif; ?>
            
            <!-- Institutions -->
            <?php if ($institutions): ?>
                <p class="text-sm text-gray-600 font-serif mb-6">
                    <i class="fa-solid fa-building-columns text-nd-gold mr-2"></i>
                    <?php echo esc_html($institutions); ?>
                </p>
            <?php endif; ?>
            
            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600 font-sans pt-6 border-t border-gray-200">
                
                <!-- Presentation Type -->
                <?php if ($presentation_type): 
                    $type_labels = array(
                        'poster' => __('Poster Presentation', 'rise-ai-summit'),
                        'oral' => __('Oral Presentation', 'rise-ai-summit'),
                        'lightning' => __('Lightning Talk', 'rise-ai-summit')
                    );
                    $type_label = isset($type_labels[$presentation_type]) ? $type_labels[$presentation_type] : $presentation_type;
                ?>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-presentation-screen text-uandes-red"></i>
                        <span><?php echo esc_html($type_label); ?></span>
                    </div>
                <?php endif; ?>
                
                <!-- Session Date/Time -->
                <?php if ($session_date || $session_time): ?>
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-calendar text-uandes-red"></i>
                        <span>
                            <?php 
                            if ($session_date) {
                                echo date('F j, Y', strtotime($session_date));
                            }
                            if ($session_time) {
                                echo ' • ' . date('g:i A', strtotime($session_time));
                            }
                            ?>
                        </span>
                    </div>
                <?php endif; ?>
                
                <!-- Room -->
                <?php if ($session_room): ?>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-uandes-red"></i>
                        <span><?php echo esc_html($session_room); ?></span>
                    </div>
                <?php endif; ?>
                
            </div>
            
        </div>
    </header>
    
    <!-- Content -->
    <div class="max-w-5xl mx-auto px-4 py-16">
        
        <div class="grid md:grid-cols-3 gap-12">
            
            <!-- Main Content -->
            <div class="md:col-span-2">
                
                <!-- Abstract -->
                <?php if ($abstract): ?>
                    <section class="mb-12">
                        <h2 class="font-sans font-bold text-2xl text-nd-navy mb-4 pb-3 border-b border-gray-200">
                            <?php _e('Abstract', 'rise-ai-summit'); ?>
                        </h2>
                        <div class="prose prose-lg text-gray-700 font-serif leading-relaxed">
                            <?php echo wpautop(esc_html($abstract)); ?>
                        </div>
                    </section>
                <?php endif; ?>
                
                <!-- Full Content (if any) -->
                <?php if (get_the_content()): ?>
                    <section class="mb-12">
                        <h2 class="font-sans font-bold text-2xl text-nd-navy mb-4 pb-3 border-b border-gray-200">
                            <?php _e('Details', 'rise-ai-summit'); ?>
                        </h2>
                        <div class="prose prose-lg text-gray-700 font-serif leading-relaxed">
                            <?php the_content(); ?>
                        </div>
                    </section>
                <?php endif; ?>
                
            </div>
            
            <!-- Sidebar -->
            <div class="md:col-span-1">
                
                <!-- Download PDF -->
                <?php if ($pdf): 
                    $pdf_url = wp_get_attachment_url($pdf);
                    $pdf_filename = basename(get_attached_file($pdf));
                ?>
                    <div class="bg-uandes-red text-white p-6 rounded-lg shadow-lg mb-6">
                        <div class="text-center mb-4">
                            <i class="fa-solid fa-file-pdf text-5xl mb-3"></i>
                            <h3 class="font-sans font-bold text-lg">
                                <?php _e('Full Paper', 'rise-ai-summit'); ?>
                            </h3>
                        </div>
                        <a href="<?php echo esc_url($pdf_url); ?>" 
                           target="_blank"
                           download
                           class="block w-full bg-white text-uandes-red text-center px-4 py-3 rounded font-bold hover:bg-gray-100 transition">
                            <i class="fa-solid fa-download mr-2"></i>
                            <?php _e('Download PDF', 'rise-ai-summit'); ?>
                        </a>
                        <p class="text-xs text-center mt-3 opacity-90">
                            <?php echo esc_html($pdf_filename); ?>
                        </p>
                    </div>
                <?php endif; ?>
                
                <!-- Keywords -->
                <?php if ($keywords): 
                    $keyword_array = array_map('trim', explode(',', $keywords));
                ?>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                        <h3 class="font-sans font-bold text-sm uppercase tracking-wider text-nd-navy mb-4 border-b pb-2">
                            <?php _e('Keywords', 'rise-ai-summit'); ?>
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($keyword_array as $keyword): ?>
                                <span class="inline-block bg-gray-100 hover:bg-nd-navy hover:text-white text-gray-700 px-3 py-1 rounded-full text-sm transition cursor-default">
                                    #<?php echo esc_html($keyword); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Contact -->
                <?php if ($contact_email): ?>
                    <div class="bg-nd-navy text-white p-6 rounded-lg shadow-lg">
                        <h3 class="font-sans font-bold text-sm uppercase tracking-wider mb-4">
                            <?php _e('Contact Author', 'rise-ai-summit'); ?>
                        </h3>
                        <a href="mailto:<?php echo esc_attr($contact_email); ?>" 
                           class="flex items-center gap-2 text-nd-gold hover:text-white transition">
                            <i class="fa-solid fa-envelope"></i>
                            <span class="text-sm break-all"><?php echo esc_html($contact_email); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
                
                <!-- Share -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 mt-6">
                    <h3 class="font-sans font-bold text-sm uppercase tracking-wider text-nd-navy mb-4">
                        <?php _e('Share', 'rise-ai-summit'); ?>
                    </h3>
                    <div class="flex gap-3">
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" 
                           target="_blank"
                           class="flex-1 bg-black hover:bg-gray-800 text-white text-center py-2 rounded transition">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" 
                           target="_blank"
                           class="flex-1 bg-blue-700 hover:bg-blue-800 text-white text-center py-2 rounded transition">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
    <!-- Related Research -->
    <?php
    if ($terms && !is_wp_error($terms)) {
        $related = get_posts(array(
            'post_type' => 'research',
            'posts_per_page' => 3,
            'post__not_in' => array(get_the_ID()),
            'tax_query' => array(
                array(
                    'taxonomy' => 'research_track',
                    'field' => 'term_id',
                    'terms' => $terms[0]->term_id,
                )
            )
        ));
        
        if ($related):
        ?>
        <div class="bg-light-gray py-16">
            <div class="max-w-7xl mx-auto px-4">
                <h3 class="font-sans font-bold text-2xl text-nd-navy mb-8">
                    <?php _e('Related Research', 'rise-ai-summit'); ?>
                </h3>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <?php foreach ($related as $related_post): 
                        $rel_authors = get_post_meta($related_post->ID, 'research_authors', true);
                        $rel_institutions = get_post_meta($related_post->ID, 'research_institutions', true);
                    ?>
                        <article class="bg-white rounded-lg overflow-hidden shadow-sm border border-gray-200 hover:shadow-md transition">
                            <div class="p-6">
                                <h4 class="font-sans font-bold text-lg text-nd-navy mb-2 line-clamp-2">
                                    <a href="<?php echo esc_url(get_permalink($related_post)); ?>" class="hover:text-uandes-red transition">
                                        <?php echo esc_html($related_post->post_title); ?>
                                    </a>
                                </h4>
                                <?php if ($rel_authors): ?>
                                    <p class="text-sm text-gray-600 font-serif mb-3 line-clamp-1">
                                        <?php echo esc_html($rel_authors); ?>
                                    </p>
                                <?php endif; ?>
                                <a href="<?php echo esc_url(get_permalink($related_post)); ?>" 
                                   class="text-uandes-red hover:text-nd-navy font-bold text-sm transition">
                                    <?php _e('View Details', 'rise-ai-summit'); ?> →
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
        endif;
        wp_reset_postdata();
    }
    ?>
    
    <!-- Back to Archive -->
    <div class="max-w-5xl mx-auto px-4 py-12 text-center">
        <a href="<?php echo esc_url(get_post_type_archive_link('research')); ?>" 
           class="inline-flex items-center gap-2 bg-nd-navy hover:bg-uandes-red text-white px-6 py-3 rounded font-sans font-bold text-sm uppercase tracking-wider transition shadow-md">
            <i class="fa-solid fa-arrow-left"></i>
            <span><?php _e('Back to Research', 'rise-ai-summit'); ?></span>
        </a>
    </div>
    
</div>

<style>
.prose p {
    margin-bottom: 1rem;
}

.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<?php
endwhile;
get_footer();