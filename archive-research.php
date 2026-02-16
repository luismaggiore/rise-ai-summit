<?php
/**
 * Archive Template: Research
 * Call for Papers + Published Research
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="research-archive-page">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Call for Papers', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl text-nd-navy">
                <?php _e('Research Program', 'rise-ai-summit'); ?>
            </h1>
            <p class="mt-4 text-gray-600 font-serif text-lg">
                <?php _e('Call for Abstracts & Posters', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>
    
    <!-- Call for Papers Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-12 gap-12">
            
            <!-- Main Info -->
            <div class="md:col-span-8 space-y-8 font-serif text-gray-700 leading-relaxed">
                <p>
                    <?php _e('The RISE AI South America Summit invites researchers, practitioners, and students to submit abstracts for poster presentations. Submissions should align with one of the three conference tracks (Business, Education, Applied Science).', 'rise-ai-summit'); ?>
                </p>
                <p>
                    <?php _e('This is an opportunity to showcase work-in-progress, recent findings, or novel applications of AI to an international audience of peers and leaders.', 'rise-ai-summit'); ?>
                </p>
                
                <h3 class="font-sans font-bold text-xl text-nd-navy mt-8 border-b border-gray-200 pb-2">
                    <?php _e('Submission Guidelines', 'rise-ai-summit'); ?>
                </h3>
                <ul class="list-disc pl-5 space-y-2 marker:text-uandes-red">
                    <li>
                        <strong><?php _e('Format:', 'rise-ai-summit'); ?></strong> 
                        <?php _e('Abstracts must be submitted in English or Spanish.', 'rise-ai-summit'); ?>
                    </li>
                    <li>
                        <strong><?php _e('Length:', 'rise-ai-summit'); ?></strong> 
                        <?php _e('Maximum 500 words (excluding references).', 'rise-ai-summit'); ?>
                    </li>
                    <li>
                        <strong><?php _e('Review:', 'rise-ai-summit'); ?></strong> 
                        <?php _e('All submissions will undergo a double-blind peer review process by the Program Committee.', 'rise-ai-summit'); ?>
                    </li>
                    <li>
                        <strong><?php _e('Acceptance:', 'rise-ai-summit'); ?></strong> 
                        <?php _e('Accepted authors will be invited to present a poster during the summit. At least one author must register for the conference.', 'rise-ai-summit'); ?>
                    </li>
                </ul>

                <h3 class="font-sans font-bold text-xl text-nd-navy mt-8 border-b border-gray-200 pb-2">
                    <?php _e('Poster Specifications', 'rise-ai-summit'); ?>
                </h3>
                <div class="bg-gray-50 p-6 rounded-l border-l-4 border-nd-gold">
                    <p class="text-sm">
                        <strong><?php _e('Size:', 'rise-ai-summit'); ?></strong> 
                        <?php _e('Posters should be printed in vertical A0 format (841 x 1189 mm). Mounting materials will be provided at the venue.', 'rise-ai-summit'); ?>
                    </p>
                </div>
            </div>

            <!-- Sidebar Dates -->
            <div class="md:col-span-4">
                <div class="bg-white border border-gray-200 p-8 rounded-lg shadow-sm sticky top-24">
                    <h3 class="font-sans font-bold text-uandes-red uppercase tracking-widest text-sm mb-6">
                        <?php _e('Important Dates', 'rise-ai-summit'); ?>
                    </h3>
                    <div class="space-y-6 text-sm font-sans">
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500"><?php _e('Submissions Open', 'rise-ai-summit'); ?></span>
                            <span class="font-bold text-nd-navy"><?php _e('March 1, 2026', 'rise-ai-summit'); ?></span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500"><?php _e('Submission Deadline', 'rise-ai-summit'); ?></span>
                            <span class="font-bold text-nd-navy"><?php _e('June 30, 2026', 'rise-ai-summit'); ?></span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500"><?php _e('Notification of Acceptance', 'rise-ai-summit'); ?></span>
                            <span class="font-bold text-nd-navy"><?php _e('August 15, 2026', 'rise-ai-summit'); ?></span>
                        </div>
                    </div>
                    <a href="#submission-form" class="block w-full mt-8 bg-uandes-red hover:bg-red-700 text-white text-center font-bold py-3 rounded transition shadow-md">
                        <?php _e('Submit Abstract', 'rise-ai-summit'); ?>
                    </a>
                    <p class="text-xs text-center text-gray-400 mt-2">
                        <?php _e('Powered by EasyChair / CMT', 'rise-ai-summit'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Published Research Section -->
    <?php
    $research_query = new WP_Query(array(
        'post_type' => 'research',
        'posts_per_page' => 9,
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    ));
    
    if ($research_query->have_posts()): 
    ?>
    <section class="py-20 bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            
            <!-- Section Header -->
            <div class="mb-12">
                <h2 class="font-sans font-bold text-3xl text-nd-navy mb-4 pb-3 border-b border-gray-200 inline-block">
                    <?php _e('Accepted Research', 'rise-ai-summit'); ?>
                </h2>
                <p class="text-gray-600 font-serif mt-2">
                    <?php _e('Browse research papers accepted for presentation at the summit.', 'rise-ai-summit'); ?>
                </p>
            </div>
            
            <!-- Track Filter -->
            <?php
            $tracks = get_terms(array(
                'taxonomy' => 'research_track',
                'hide_empty' => true,
            ));
            
            if (!empty($tracks) && !is_wp_error($tracks)):
            ?>
            <div class="mb-12 flex justify-center">
                <div class="inline-flex bg-white rounded-lg shadow-md border border-gray-200 p-1 flex-wrap gap-1">
                    <a href="<?php echo esc_url(get_post_type_archive_link('research')); ?>" 
                       class="track-filter-btn <?php echo !is_tax() ? 'active' : ''; ?> px-6 py-3 rounded-md font-sans font-bold text-sm uppercase tracking-wide transition-all duration-300">
                        <i class="fa-solid fa-border-all mr-2"></i>
                        <?php _e('All Tracks', 'rise-ai-summit'); ?>
                    </a>
                    
                    <?php foreach ($tracks as $track): 
                        $is_current = is_tax('research_track', $track->slug);
                        $icon = '';
                        if ($track->slug === 'business') {
                            $icon = 'fa-briefcase';
                        } elseif ($track->slug === 'education') {
                            $icon = 'fa-graduation-cap';
                        } elseif ($track->slug === 'science') {
                            $icon = 'fa-microscope';
                        }
                    ?>
                        <a href="<?php echo esc_url(get_term_link($track)); ?>" 
                           class="track-filter-btn <?php echo $is_current ? 'active' : ''; ?> px-6 py-3 rounded-md font-sans font-bold text-sm uppercase tracking-wide transition-all duration-300">
                            <?php if ($icon): ?>
                                <i class="fa-solid <?php echo $icon; ?> mr-2"></i>
                            <?php endif; ?>
                            <?php echo esc_html($track->name); ?>
                            <span class="ml-1 text-xs opacity-75">(<?php echo $track->count; ?>)</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Research Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                
                <?php while ($research_query->have_posts()) : $research_query->the_post(); 
                    $authors = get_post_meta(get_the_ID(), 'research_authors', true);
                    $institutions = get_post_meta(get_the_ID(), 'research_institutions', true);
                    $keywords = get_post_meta(get_the_ID(), 'research_keywords', true);
                    $pdf = get_post_meta(get_the_ID(), 'research_pdf', true);
                    $presentation_type = get_post_meta(get_the_ID(), 'research_presentation_type', true);
                    
                    $terms = get_the_terms(get_the_ID(), 'research_track');
                    $track_name = $terms && !is_wp_error($terms) ? $terms[0]->name : '';
                    $track_slug = $terms && !is_wp_error($terms) ? $terms[0]->slug : '';
                ?>
                
                <article class="research-card bg-white rounded-lg overflow-hidden shadow-sm border border-gray-200 hover:shadow-lg transition group flex flex-col">
                    
                    <!-- Track Badge -->
                    <?php if ($track_name): 
                        $track_colors = array(
                            'business' => 'bg-nd-navy text-white',
                            'education' => 'bg-nd-gold text-nd-navy',
                            'science' => 'bg-uandes-red text-white'
                        );
                        $track_color = isset($track_colors[$track_slug]) ? $track_colors[$track_slug] : 'bg-gray-600 text-white';
                    ?>
                        <div class="<?php echo $track_color; ?> px-4 py-2 text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                            <?php if ($track_slug === 'business'): ?>
                                <i class="fa-solid fa-briefcase"></i>
                            <?php elseif ($track_slug === 'education'): ?>
                                <i class="fa-solid fa-graduation-cap"></i>
                            <?php elseif ($track_slug === 'science'): ?>
                                <i class="fa-solid fa-microscope"></i>
                            <?php endif; ?>
                            <?php echo esc_html($track_name); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Content -->
                    <div class="p-6 flex-grow flex flex-col">
                        
                        <!-- Title -->
                        <h3 class="font-sans font-bold text-xl text-nd-navy mb-3 group-hover:text-uandes-red transition line-clamp-2">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        
                        <!-- Authors -->
                        <?php if ($authors): ?>
                            <p class="text-sm text-gray-600 font-serif mb-2 line-clamp-2">
                                <i class="fa-solid fa-user-pen text-uandes-red mr-1"></i>
                                <?php echo esc_html($authors); ?>
                            </p>
                        <?php endif; ?>
                        
                        <!-- Institutions -->
                        <?php if ($institutions): ?>
                            <p class="text-xs text-gray-500 font-serif mb-4 line-clamp-1">
                                <i class="fa-solid fa-building-columns text-nd-gold mr-1"></i>
                                <?php echo esc_html($institutions); ?>
                            </p>
                        <?php endif; ?>
                        
                        <!-- Excerpt -->
                        <div class="text-sm text-gray-600 font-serif line-clamp-3 mb-4 flex-grow">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </div>
                        
                        <!-- Keywords -->
                        <?php if ($keywords): 
                            $keyword_array = array_map('trim', explode(',', $keywords));
                            $keyword_array = array_slice($keyword_array, 0, 3);
                        ?>
                            <div class="flex flex-wrap gap-1 mb-4">
                                <?php foreach ($keyword_array as $keyword): ?>
                                    <span class="inline-block bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                        #<?php echo esc_html($keyword); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Footer -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                            <?php if ($presentation_type): 
                                $type_labels = array(
                                    'poster' => __('Poster', 'rise-ai-summit'),
                                    'oral' => __('Oral', 'rise-ai-summit'),
                                    'lightning' => __('Lightning', 'rise-ai-summit')
                                );
                                $type_label = isset($type_labels[$presentation_type]) ? $type_labels[$presentation_type] : $presentation_type;
                            ?>
                                <span class="text-xs text-gray-500 font-sans">
                                    <i class="fa-solid fa-presentation-screen mr-1"></i>
                                    <?php echo esc_html($type_label); ?>
                                </span>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>" 
                               class="text-uandes-red hover:text-nd-navy font-bold text-sm transition">
                                <?php _e('View Details', 'rise-ai-summit'); ?> →
                            </a>
                        </div>
                        
                    </div>
                    
                </article>
                
                <?php endwhile; ?>
                
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center">
                <?php
                echo paginate_links(array(
                    'total' => $research_query->max_num_pages,
                    'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
                    'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
                    'type' => 'list',
                ));
                ?>
            </div>
            
        </div>
    </section>
    <?php 
    endif;
    wp_reset_postdata();
    ?>
    
    <!-- Submission Form Section (AL FINAL) -->
    <section id="submission-form" class="py-20 bg-light-gray border-t-4 border-nd-navy">
        <div class="max-w-4xl mx-auto px-4">
            
            <div class="text-center mb-12">
                <h2 class="font-sans font-bold text-3xl text-nd-navy mb-4">
                    <?php _e('Submit Your Abstract', 'rise-ai-summit'); ?>
                </h2>
                <p class="text-gray-600 font-serif text-lg">
                    <?php _e('Complete the form below to submit your research for consideration.', 'rise-ai-summit'); ?>
                </p>
            </div>
            
            <!-- Include Abstract Form -->
            <?php get_template_part('template-parts/forms/form', 'abstract'); ?>
            
        </div>
    </section>
    
</div>

<style>
/* Track Filter Buttons */
.track-filter-btn {
    color: #666;
    background: transparent;
}

.track-filter-btn.active {
    background: #0C2340;
    color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.track-filter-btn:hover:not(.active) {
    background: #f0f0f1;
    color: #0C2340;
}

/* Line clamp */
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

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Research Card Hover */
.research-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.research-card:hover {
    transform: translateY(-4px);
}

/* Pagination */
.pagination {
    display: flex;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination li a,
.pagination li span {
    display: block;
    padding: 0.5rem 1rem;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    color: #0C2340;
    font-weight: 600;
    transition: all 0.2s;
}

.pagination li a:hover {
    background: #E31837;
    color: white;
    border-color: #E31837;
}

.pagination li span.current {
    background: #0C2340;
    color: white;
    border-color: #0C2340;
}

/* Smooth Scroll */
html {
    scroll-behavior: smooth;
}
</style>

<?php
get_footer();