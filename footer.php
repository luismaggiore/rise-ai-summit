<?php
/**
 * The footer for RISE AI Summit theme
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;
?>

</main><!-- #main-content -->

<!-- FOOTER GLOBAL -->
<footer class="bg-gray-900 text-white pt-20 pb-10 border-t-8 border-uandes-red mt-auto">
    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-4 gap-12 mb-16">
        
        <!-- Column 1: About -->
        <div class="col-span-1 md:col-span-1">
            <div class="mb-6">
                <span class="font-sans font-black text-3xl tracking-tighter text-white">RISE AI</span>
                <span class="block font-sans text-xs font-bold text-nd-gold tracking-widest uppercase mt-1">
                    South America Summit
                </span>
            </div>
            <p class="text-gray-400 text-sm font-serif leading-relaxed">
                <?php _e('Advancing Responsible, Inclusive, Safe, and Ethical AI in South America through academic and industrial collaboration.', 'rise-ai-summit'); ?>
            </p>
            <div class="mt-6 flex gap-4">
                <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" 
                   class="text-gray-400 hover:text-white transition" aria-label="LinkedIn">
                    <i class="fa-brands fa-linkedin text-xl"></i>
                </a>
                <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" 
                   class="text-gray-400 hover:text-white transition" aria-label="Twitter">
                    <i class="fa-brands fa-x-twitter text-xl"></i>
                </a>
            </div>
        </div>
        
        <!-- Column 2: Venue Host -->
        <div class="col-span-1">
            <h4 class="font-sans font-bold text-gray-200 uppercase tracking-widest text-xs mb-6 border-b border-gray-700 pb-2 inline-block">
                <?php _e('Venue Host', 'rise-ai-summit'); ?>
            </h4>
            <address class="not-italic text-sm text-gray-400 space-y-3 font-sans">
                <strong class="text-white block">Universidad de los Andes</strong>
                <span>Monseñor Álvaro del Portillo 12.455</span><br>
                <span>Las Condes, Santiago, Chile</span>
                <span class="block mt-2 text-xs opacity-75 text-uandes-red">
                    <?php _e('Innovation Division', 'rise-ai-summit'); ?>
                </span>
            </address>
        </div>
        
        <!-- Column 3: Co-Host -->
        <div class="col-span-1">
            <h4 class="font-sans font-bold text-gray-200 uppercase tracking-widest text-xs mb-6 border-b border-gray-700 pb-2 inline-block">
                <?php _e('Co-Host', 'rise-ai-summit'); ?>
            </h4>
            <address class="not-italic text-sm text-gray-400 space-y-3 font-sans">
                <strong class="text-white block">ESE Business School</strong>
                <span>Av. Plaza 1905</span><br>
                <span>San Carlos de Apoquindo</span><br>
                <span>Las Condes, Santiago</span>
            </address>
        </div>

        <div class="col-span-1">
            <h4 class="font-sans font-bold text-gray-200 uppercase tracking-widest text-xs mb-6 border-b border-gray-700 pb-2 inline-block">
                <?php _e('Summit Links', 'rise-ai-summit'); ?>
            </h4>
            <ul class="text-sm text-gray-400 space-y-3 font-sans">
                <li>
                    <a href="<?php echo esc_url(rise_ai_get_page_url_by_slug('committee')); ?>" 
                       class="hover:text-white transition flex items-center gap-2">
                        <i class="fa-solid fa-angle-right text-xs"></i>
                        <?php _e('Committees', 'rise-ai-summit'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url(rise_ai_get_page_url_by_slug('research')); ?>" 
                       class="hover:text-white transition flex items-center gap-2">
                        <i class="fa-solid fa-angle-right text-xs"></i>
                        <?php _e('Abstract Submission', 'rise-ai-summit'); ?>
                    </a>
                </li>
                <li>
                    <a href="mailto:info@rise-summit.cl"
                       class="hover:text-white transition flex items-center gap-2">
                        <i class="fa-solid fa-angle-right text-xs"></i>
                        <?php _e('Contact Us', 'rise-ai-summit'); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
   
    <!-- Footer Bottom -->
    <div class="max-w-7xl mx-auto px-4 border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 font-sans">
        <p>&copy; <?php echo date('Y'); ?> <?php _e('RISE AI South America Summit. All rights reserved.', 'rise-ai-summit'); ?></p>
        <div class="flex gap-4 mt-4 md:mt-0">
            <span><?php _e('Part of the RISE AI Global Series', 'rise-ai-summit'); ?></span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>