<?php
/**
 * Template Name: About Page
 * 
 * @package RISE_AI_Summit
 */

get_header();

while (have_posts()): the_post();
?>

<div class="about-page">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Our Mission', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl md:text-5xl text-nd-navy">
                <?php the_title(); ?>
            </h1>
        </div>
    </header>
    
    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-16 grid md:grid-cols-12 gap-16">
        
        <!-- Main Content (8 columns) -->
        <div class="md:col-span-8 prose prose-lg text-gray-600 font-serif">
            
            <?php if (has_excerpt()): ?>
                <p class="lead text-xl">
                    <?php the_excerpt(); ?>
                </p>
            <?php else: ?>
                <p class="lead text-xl">
                    <?php _e('The RISE AI South America Summit is a premier academic and professional gathering designed to advance the discourse on Responsible, Inclusive, Safe, and Ethical (RISE) AI.', 'rise-ai-summit'); ?>
                </p>
            <?php endif; ?>
            
            <!-- Dynamic Content from Editor -->
            <?php the_content(); ?>
            
            <!-- Default Content if empty -->
            <?php if (!get_the_content()): ?>
                
                <h3 class="text-nd-navy font-sans font-bold mt-8 mb-4">
                    <?php _e('Why RISE Matters in South America', 'rise-ai-summit'); ?>
                </h3>
                <p>
                    <?php _e('As AI technologies rapidly transform industries and societies, South America faces unique challenges—from infrastructure gaps to diverse cultural contexts. This summit provides a platform to discuss how AI can be leveraged to solve regional problems while mitigating risks related to bias, inequality, and safety.', 'rise-ai-summit'); ?>
                </p>
                
                <h3 class="text-nd-navy font-sans font-bold mt-8 mb-4">
                    <?php _e('Goals of the Summit', 'rise-ai-summit'); ?>
                </h3>
                <ul class="list-disc pl-5 space-y-2 marker:text-uandes-red">
                    <li><?php _e('Foster interdisciplinary collaboration between North and South.', 'rise-ai-summit'); ?></li>
                    <li><?php _e('Showcase applied research in health, engineering, and business.', 'rise-ai-summit'); ?></li>
                    <li><?php _e('Develop policy frameworks for ethical AI adoption in education.', 'rise-ai-summit'); ?></li>
                    <li><?php _e('Connect academia, industry, and government stakeholders.', 'rise-ai-summit'); ?></li>
                    <li><?php _e('Amplify voices from underrepresented regions in global AI discourse.', 'rise-ai-summit'); ?></li>
                </ul>
                
                <h3 class="text-nd-navy font-sans font-bold mt-8 mb-4">
                    <?php _e('A Legacy of Excellence', 'rise-ai-summit'); ?>
                </h3>
                <p>
                    <?php _e('Building on the success of the original RISE AI Conference at the University of Notre Dame, this South American edition brings the same commitment to ethical AI development, now focused on the unique opportunities and challenges facing our continent.', 'rise-ai-summit'); ?>
                </p>
                
            <?php endif; ?>
            
        </div>
        
        <!-- Sidebar (4 columns) -->
        <div class="md:col-span-4 space-y-8">
            
            <!-- Co-Organizers Box -->
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
                <h3 class="font-sans font-bold text-nd-navy mb-6 uppercase tracking-widest text-sm border-b pb-2">
                    <?php _e('Co-Organizers', 'rise-ai-summit'); ?>
                </h3>
                
                <!-- Notre Dame -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="h-8 w-8 bg-nd-navy text-nd-gold flex items-center justify-center font-bold rounded text-xs">
                            ND
                        </div>
                        <h4 class="font-bold text-sm text-nd-navy">
                            <?php _e('University of Notre Dame', 'rise-ai-summit'); ?>
                        </h4>
                    </div>
                    <p class="text-xs text-gray-500 pl-11">
                        <?php _e('Through the', 'rise-ai-summit'); ?>
                        <strong><?php _e('Lucy Family Institute for Data & Society', 'rise-ai-summit'); ?></strong>.
                    </p>
                </div>

                <!-- UAndes -->
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="h-8 w-8 bg-uandes-red text-white flex items-center justify-center font-bold rounded text-xs">
                            UA
                        </div>
                        <h4 class="font-bold text-sm text-nd-navy">
                            <?php _e('Universidad de los Andes', 'rise-ai-summit'); ?>
                        </h4>
                    </div>
                    <p class="text-xs text-gray-500 pl-11">
                        <?php _e('Through the', 'rise-ai-summit'); ?>
                        <strong><?php _e('Innovation Division', 'rise-ai-summit'); ?></strong>
                        <?php _e('and', 'rise-ai-summit'); ?>
                        <strong><?php _e('ESE Business School', 'rise-ai-summit'); ?></strong>.
                    </p>
                </div>
            </div>

            <!-- Contact Box -->
            <div class="bg-nd-navy text-white p-8 rounded-lg shadow-lg relative overflow-hidden">
                <div class="absolute -right-4 -top-4 text-white/5 text-9xl">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h3 class="font-sans font-bold mb-4 relative z-10">
                    <?php _e('Contact Us', 'rise-ai-summit'); ?>
                </h3>
                <p class="text-sm text-gray-300 mb-6 relative z-10">
                    <?php _e('For general inquiries regarding the summit organization.', 'rise-ai-summit'); ?>
                </p>
                <a href="mailto:info@rise-summit.cl" 
                   class="text-nd-gold hover:text-white font-bold text-sm flex items-center gap-2 relative z-10 transition">
                    <i class="fa-solid fa-envelope"></i> 
                    info@rise-summit.cl
                </a>
            </div>
            
            <!-- Quick Links Box -->
            <div class="bg-light-gray p-8 rounded-lg border border-gray-200">
                <h3 class="font-sans font-bold text-nd-navy mb-6 uppercase tracking-widest text-sm border-b pb-2">
                    <?php _e('Quick Links', 'rise-ai-summit'); ?>
                </h3>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="<?php echo esc_url(home_url('/tracks/')); ?>" 
                           class="flex items-center gap-2 text-gray-700 hover:text-uandes-red transition">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                            <?php _e('Conference Tracks', 'rise-ai-summit'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(get_post_type_archive_link('speaker')); ?>" 
                           class="flex items-center gap-2 text-gray-700 hover:text-uandes-red transition">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                            <?php _e('Speakers', 'rise-ai-summit'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/committee/')); ?>"
                           class="flex items-center gap-2 text-gray-700 hover:text-uandes-red transition">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                            <?php _e('Organizing Committee', 'rise-ai-summit'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/research/')); ?>" 
                           class="flex items-center gap-2 text-gray-700 hover:text-uandes-red transition">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                            <?php _e('Call for Papers', 'rise-ai-summit'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/sponsorship/')); ?>" 
                           class="flex items-center gap-2 text-gray-700 hover:text-uandes-red transition">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                            <?php _e('Sponsorship', 'rise-ai-summit'); ?>
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
        
    </div>
    
</div>

<?php
endwhile;

get_footer();