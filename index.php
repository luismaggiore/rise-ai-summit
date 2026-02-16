<?php
/**
 * Template for displaying blog archive
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="blog-archive">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('News & Updates', 'rise-ai-summit'); ?>
            </span>
            
            <h1 class="font-sans font-bold text-4xl text-nd-navy">
                <?php
                if (is_category()) {
                    single_cat_title();
                } elseif (is_tag()) {
                    single_tag_title();
                } elseif (is_author()) {
                    the_author();
                } elseif (is_date()) {
                    echo get_the_date('F Y');
                } else {
                    _e('Blog', 'rise-ai-summit');
                }
                ?>
            </h1>
            
            <?php if (is_category() && category_description()): ?>
                <p class="mt-4 text-gray-600 font-serif text-lg">
                    <?php echo category_description(); ?>
                </p>
            <?php endif; ?>
        </div>
    </header>
    
    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        
        <?php if (have_posts()): ?>
            
            <!-- Posts Grid -->
            <div class="grid md:grid-cols-3 gap-10 mb-12">
                
                <?php while (have_posts()) : the_post(); ?>
                    
                    <article class="bg-white rounded-lg overflow-hidden shadow-sm border border-gray-200 hover:shadow-md transition group">
                        
                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>" class="block">
                                <?php the_post_thumbnail('medium', array('class' => 'w-full h-48 object-cover group-hover:opacity-90 transition')); ?>
                            </a>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            
                            <!-- Category -->
                            <?php
                            $categories = get_the_category();
                            if ($categories):
                                $category = $categories[0];
                            ?>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                   class="inline-block bg-nd-navy text-white px-2 py-1 rounded text-xs font-bold uppercase tracking-wider mb-3 hover:bg-uandes-red transition">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            <?php endif; ?>
                            
                            <!-- Title -->
                            <h2 class="font-sans font-bold text-xl text-nd-navy mb-2 group-hover:text-uandes-red transition line-clamp-2">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <!-- Meta -->
                            <div class="text-xs text-gray-500 font-sans mb-3 flex items-center gap-3">
                                <span><i class="fa-regular fa-calendar mr-1"></i><?php echo get_the_date(); ?></span>
                                <span><i class="fa-regular fa-user mr-1"></i><?php the_author(); ?></span>
                            </div>
                            
                            <!-- Excerpt -->
                            <div class="text-sm text-gray-600 font-serif line-clamp-3 mb-4">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </div>
                            
                            <!-- Read More -->
                            <a href="<?php the_permalink(); ?>" 
                               class="inline-block text-uandes-red hover:text-nd-navy font-bold text-sm transition">
                                <?php _e('Read More', 'rise-ai-summit'); ?> →
                            </a>
                            
                        </div>
                        
                    </article>
                    
                <?php endwhile; ?>
                
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center gap-2">
                <?php
                echo paginate_links(array(
                    'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
                    'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
                    'type' => 'list',
                    'class' => 'pagination'
                ));
                ?>
            </div>
            
        <?php else: ?>
            
            <!-- No Posts -->
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-newspaper text-4xl text-gray-300"></i>
                </div>
                <h3 class="font-sans font-bold text-2xl text-gray-400 mb-2">
                    <?php _e('No posts found', 'rise-ai-summit'); ?>
                </h3>
                <p class="text-gray-500 font-serif mb-6">
                    <?php _e('Check back soon for updates!', 'rise-ai-summit'); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/')); ?>" 
                   class="inline-block bg-uandes-red hover:bg-nd-navy text-white px-6 py-3 rounded font-bold transition">
                    <?php _e('Back to Home', 'rise-ai-summit'); ?>
                </a>
            </div>
            
        <?php endif; ?>
        
    </div>
    
</div>

<style>
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

/* Pagination Styles */
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
</style>

<?php
get_footer();