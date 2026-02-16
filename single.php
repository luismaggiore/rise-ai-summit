<?php
/**
 * Template for displaying single blog posts
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="single-post-page bg-white">
    
    <?php while (have_posts()) : the_post(); ?>
    
    <!-- Header with Category & Meta -->
    <header class="bg-light-gray py-12 border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4">
            
            <!-- Category Badge -->
            <?php
            $categories = get_the_category();
            if (!empty($categories)) {
                $category = $categories[0];
                $cat_colors = array(
                    'news' => 'bg-nd-navy text-white',
                    'announcements' => 'bg-uandes-red text-white',
                    'research-highlights' => 'bg-nd-gold text-nd-navy',
                    'behind-the-scenes' => 'bg-gray-500 text-white',
                    'speaker-spotlights' => 'bg-purple-600 text-white'
                );
                $cat_color = isset($cat_colors[$category->slug]) ? $cat_colors[$category->slug] : 'bg-gray-600 text-white';
                ?>
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                   class="inline-block <?php echo $cat_color; ?> px-3 py-1 rounded text-xs font-bold uppercase tracking-wider mb-4 hover:opacity-80 transition">
                    <?php echo esc_html($category->name); ?>
                </a>
            <?php } ?>
            
            <!-- Post Title -->
            <h1 class="font-sans font-bold text-4xl md:text-5xl text-nd-navy leading-tight mb-4">
                <?php the_title(); ?>
            </h1>
            
            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 font-sans">
                <!-- Author -->
                <div class="flex items-center gap-2">
                    <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('class' => 'rounded-full')); ?>
                    <span class="font-semibold"><?php the_author(); ?></span>
                </div>
                
                <!-- Date -->
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-calendar text-uandes-red"></i>
                    <time datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo get_the_date(); ?>
                    </time>
                </div>
                
                <!-- Reading Time (estimated) -->
                <?php
                $content = get_post_field('post_content', get_the_ID());
                $word_count = str_word_count(strip_tags($content));
                $reading_time = ceil($word_count / 200); // 200 words per minute
                ?>
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-clock text-uandes-red"></i>
                    <span><?php echo $reading_time; ?> <?php _e('min read', 'rise-ai-summit'); ?></span>
                </div>
            </div>
            
        </div>
    </header>
    
    <!-- Featured Image -->
    <?php if (has_post_thumbnail()): ?>
    <div class="max-w-5xl mx-auto px-4 -mt-8 mb-12">
        <div class="rounded-xl overflow-hidden shadow-2xl border-4 border-white">
            <?php the_post_thumbnail('large', array('class' => 'w-full h-auto')); ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Post Content -->
    <article class="max-w-4xl mx-auto px-4 py-12">
        
        <div class="prose prose-lg max-w-none font-serif text-gray-700 leading-relaxed">
            <?php the_content(); ?>
        </div>
        
        <!-- Tags -->
        <?php
        $tags = get_the_tags();
        if ($tags):
        ?>
        <div class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex flex-wrap gap-2">
                <span class="font-sans font-bold text-sm text-gray-500 uppercase tracking-wider mr-2">
                    <?php _e('Tags:', 'rise-ai-summit'); ?>
                </span>
                <?php foreach ($tags as $tag): ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                       class="inline-block bg-gray-100 hover:bg-nd-navy hover:text-white px-3 py-1 rounded-full text-xs font-semibold text-gray-700 transition">
                        #<?php echo esc_html($tag->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Share Buttons -->
        <div class="mt-8 pt-8 border-t border-gray-200">
            <div class="flex items-center gap-4">
                <span class="font-sans font-bold text-sm text-gray-500 uppercase tracking-wider">
                    <?php _e('Share:', 'rise-ai-summit'); ?>
                </span>
                
                <!-- Twitter -->
                <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" 
                   target="_blank"
                   rel="noopener noreferrer"
                   class="flex items-center gap-2 bg-black hover:bg-gray-800 text-white px-4 py-2 rounded font-semibold text-sm transition">
                    <i class="fa-brands fa-x-twitter"></i>
                    <span>Twitter</span>
                </a>
                
                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" 
                   target="_blank"
                   rel="noopener noreferrer"
                   class="flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded font-semibold text-sm transition">
                    <i class="fa-brands fa-linkedin-in"></i>
                    <span>LinkedIn</span>
                </a>
                
                <!-- Copy Link -->
                <button onclick="copyToClipboard('<?php echo esc_js(get_permalink()); ?>')" 
                        class="flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded font-semibold text-sm transition">
                    <i class="fa-solid fa-link"></i>
                    <span><?php _e('Copy Link', 'rise-ai-summit'); ?></span>
                </button>
            </div>
        </div>
        
    </article>
    
    <!-- Author Bio -->
    <?php
    $author_id = get_the_author_meta('ID');
    $author_bio = get_the_author_meta('description');
    if ($author_bio):
    ?>
    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-light-gray rounded-lg p-8 border-l-4 border-uandes-red">
            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <?php echo get_avatar($author_id, 80, '', '', array('class' => 'rounded-full border-2 border-white shadow-md')); ?>
                </div>
                <div>
                    <h3 class="font-sans font-bold text-lg text-nd-navy mb-2">
                        <?php _e('About', 'rise-ai-summit'); ?> <?php the_author(); ?>
                    </h3>
                    <p class="text-gray-600 font-serif text-sm leading-relaxed mb-4">
                        <?php echo esc_html($author_bio); ?>
                    </p>
                    <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" 
                       class="text-uandes-red hover:text-nd-navy font-bold text-sm transition">
                        <?php _e('View all posts by', 'rise-ai-summit'); ?> <?php the_author(); ?> →
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Post Navigation (Previous/Next) -->
    <div class="max-w-4xl mx-auto px-4 py-12 border-t border-gray-200">
        <div class="grid md:grid-cols-2 gap-8">
            
            <!-- Previous Post -->
            <?php
            $prev_post = get_previous_post();
            if ($prev_post):
            ?>
            <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" 
               class="group block bg-white border border-gray-200 rounded-lg p-6 hover:border-uandes-red hover:shadow-lg transition">
                <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-arrow-left mr-1"></i> <?php _e('Previous Post', 'rise-ai-summit'); ?>
                </div>
                <h4 class="font-sans font-bold text-lg text-nd-navy group-hover:text-uandes-red transition">
                    <?php echo esc_html($prev_post->post_title); ?>
                </h4>
            </a>
            <?php else: ?>
            <div></div>
            <?php endif; ?>
            
            <!-- Next Post -->
            <?php
            $next_post = get_next_post();
            if ($next_post):
            ?>
            <a href="<?php echo esc_url(get_permalink($next_post)); ?>" 
               class="group block bg-white border border-gray-200 rounded-lg p-6 hover:border-uandes-red hover:shadow-lg transition text-right">
                <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                    <?php _e('Next Post', 'rise-ai-summit'); ?> <i class="fa-solid fa-arrow-right ml-1"></i>
                </div>
                <h4 class="font-sans font-bold text-lg text-nd-navy group-hover:text-uandes-red transition">
                    <?php echo esc_html($next_post->post_title); ?>
                </h4>
            </a>
            <?php endif; ?>
            
        </div>
    </div>
    
    <!-- Related Posts -->
    <?php
    $categories = get_the_category();
    if ($categories) {
        $category_ids = array();
        foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
        }
        
        $related_posts = get_posts(array(
            'category__in' => $category_ids,
            'post__not_in' => array(get_the_ID()),
            'posts_per_page' => 3,
            'orderby' => 'rand'
        ));
        
        if ($related_posts):
        ?>
        <div class="bg-light-gray py-16">
            <div class="max-w-7xl mx-auto px-4">
                
                <h3 class="font-sans font-bold text-2xl text-nd-navy mb-8">
                    <?php _e('Related Articles', 'rise-ai-summit'); ?>
                </h3>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <?php foreach ($related_posts as $related): ?>
                        <article class="bg-white rounded-lg overflow-hidden shadow-sm border border-gray-200 hover:shadow-md transition group">
                            
                            <?php if (has_post_thumbnail($related->ID)): ?>
                                <a href="<?php echo esc_url(get_permalink($related)); ?>" class="block">
                                    <?php echo get_the_post_thumbnail($related->ID, 'medium', array('class' => 'w-full h-48 object-cover group-hover:opacity-90 transition')); ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="p-6">
                                <?php
                                $related_cats = get_the_category($related->ID);
                                if ($related_cats):
                                    $related_cat = $related_cats[0];
                                ?>
                                    <a href="<?php echo esc_url(get_category_link($related_cat->term_id)); ?>" 
                                       class="inline-block bg-nd-navy text-white px-2 py-1 rounded text-xs font-bold uppercase tracking-wider mb-3 hover:bg-uandes-red transition">
                                        <?php echo esc_html($related_cat->name); ?>
                                    </a>
                                <?php endif; ?>
                                
                                <h4 class="font-sans font-bold text-lg text-nd-navy mb-2 group-hover:text-uandes-red transition">
                                    <a href="<?php echo esc_url(get_permalink($related)); ?>">
                                        <?php echo esc_html($related->post_title); ?>
                                    </a>
                                </h4>
                                
                                <div class="text-xs text-gray-500 font-sans mb-3">
                                    <?php echo get_the_date('', $related); ?>
                                </div>
                                
                                <div class="text-sm text-gray-600 font-serif line-clamp-3">
                                    <?php echo wp_trim_words(get_the_excerpt($related), 20); ?>
                                </div>
                                
                                <a href="<?php echo esc_url(get_permalink($related)); ?>" 
                                   class="inline-block mt-4 text-uandes-red hover:text-nd-navy font-bold text-sm transition">
                                    <?php _e('Read More', 'rise-ai-summit'); ?> →
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
    
    <!-- Back to Blog -->
    <div class="max-w-4xl mx-auto px-4 py-12 text-center">
        <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" 
           class="inline-flex items-center gap-2 bg-nd-navy hover:bg-uandes-red text-white px-6 py-3 rounded font-sans font-bold text-sm uppercase tracking-wider transition shadow-md">
            <i class="fa-solid fa-arrow-left"></i>
            <span><?php _e('Back to Blog', 'rise-ai-summit'); ?></span>
        </a>
    </div>
    
    <?php endwhile; ?>
    
</div>

<!-- Copy to Clipboard Script -->
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('<?php _e('Link copied to clipboard!', 'rise-ai-summit'); ?>');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>

<style>
/* Prose Styles for Content */
.prose {
    max-width: none;
}

.prose h2 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 2rem;
    color: #0C2340;
    margin-top: 2rem;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.prose h3 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 1.5rem;
    color: #0C2340;
    margin-top: 1.75rem;
    margin-bottom: 0.75rem;
}

.prose h4 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 1.25rem;
    color: #333;
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
}

.prose p {
    margin-bottom: 1.5rem;
    line-height: 1.8;
}

.prose a {
    color: #E31837;
    text-decoration: underline;
    transition: color 0.2s;
}

.prose a:hover {
    color: #0C2340;
}

.prose ul, .prose ol {
    margin-bottom: 1.5rem;
    margin-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
    line-height: 1.7;
}

.prose blockquote {
    border-left: 4px solid #E31837;
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: #666;
    background: #f9f9f9;
    padding: 1.5rem;
    border-radius: 0 8px 8px 0;
}

.prose img {
    border-radius: 8px;
    margin: 2rem 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.prose pre {
    background: #f4f4f4;
    padding: 1.5rem;
    border-radius: 8px;
    overflow-x: auto;
    margin: 1.5rem 0;
    border-left: 4px solid #AE9142;
}

.prose code {
    background: #f4f4f4;
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-size: 0.9em;
    color: #E31837;
}

.prose pre code {
    background: transparent;
    padding: 0;
    color: inherit;
}

.prose table {
    width: 100%;
    margin: 2rem 0;
    border-collapse: collapse;
}

.prose th {
    background: #0C2340;
    color: white;
    padding: 0.75rem;
    text-align: left;
    font-weight: 600;
}

.prose td {
    padding: 0.75rem;
    border-bottom: 1px solid #e5e5e5;
}

.prose tr:hover {
    background: #f9f9f9;
}

/* Line clamp for excerpts */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<?php
get_footer();