<?php
/**
 * The template for displaying 404 pages (Not Found)
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="error-404 not-found min-h-screen flex items-center justify-center bg-light-gray">
    <div class="max-w-2xl mx-auto px-4 text-center py-20">
        
        <!-- 404 Number -->
        <div class="mb-8">
            <span class="text-9xl font-black text-nd-navy opacity-20 font-sans">404</span>
        </div>
        
        <!-- Error Message -->
        <h1 class="font-sans font-bold text-4xl md:text-5xl text-nd-navy mb-4">
            <?php _e('Page Not Found', 'rise-ai-summit'); ?>
        </h1>
        
        <p class="text-lg text-gray-600 mb-8 font-serif">
            <?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'rise-ai-summit'); ?>
        </p>
        
        <!-- Search Form -->
        <div class="mb-8 max-w-md mx-auto">
            <form role="search" method="get" class="search-form flex gap-2" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" 
                       class="search-field flex-1 px-4 py-3 border border-gray-300 rounded focus:outline-none focus:border-uandes-red" 
                       placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'rise-ai-summit'); ?>"
                       value="<?php echo get_search_query(); ?>" 
                       name="s" />
                <button type="submit" 
                        class="search-submit bg-nd-navy text-white px-6 py-3 rounded font-bold hover:bg-uandes-red transition">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form>
        </div>
        
        <!-- Helpful Links -->
        <div class="helpful-links">
            <p class="text-sm text-gray-500 mb-4 uppercase tracking-wide font-sans font-bold">
                <?php _e('Or try these pages:', 'rise-ai-summit'); ?>
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" 
                   class="inline-block bg-uandes-red text-white px-6 py-3 rounded font-bold hover:bg-red-700 transition">
                    <i class="fa-solid fa-home mr-2"></i>
                    <?php _e('Homepage', 'rise-ai-summit'); ?>
                </a>
                <a href="<?php echo esc_url(rise_ai_get_page_url_by_slug('about')); ?>" 
                   class="inline-block border-2 border-nd-navy text-nd-navy px-6 py-3 rounded font-bold hover:bg-nd-navy hover:text-white transition">
                    <?php _e('About', 'rise-ai-summit'); ?>
                </a>
                <a href="<?php echo esc_url(rise_ai_get_page_url_by_slug('contact')); ?>" 
                   class="inline-block border-2 border-nd-navy text-nd-navy px-6 py-3 rounded font-bold hover:bg-nd-navy hover:text-white transition">
                    <?php _e('Contact', 'rise-ai-summit'); ?>
                </a>
            </div>
        </div>
        
    </div>
</div>

<?php
get_footer();