<?php
/**
 * Template Name: Register Page
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="register-page">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Join Us', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl text-nd-navy">
                <?php _e('Register for RISE AI Summit', 'rise-ai-summit'); ?>
            </h1>
            <p class="mt-4 text-gray-600 font-serif text-lg">
                <?php _e('Express your interest to attend the summit.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>
    
    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        
        <!-- Event Info Banner -->
        <div class="bg-nd-navy text-white p-8 rounded-lg mb-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 text-white/5 text-9xl">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="relative z-10 grid md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fa-solid fa-calendar text-nd-gold text-2xl"></i>
                        <div>
                            <p class="text-xs text-gray-300 uppercase tracking-wide"><?php _e('Dates', 'rise-ai-summit'); ?></p>
                            <p class="font-bold text-lg"><?php _e('October 15-16, 2026', 'rise-ai-summit'); ?></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fa-solid fa-location-dot text-nd-gold text-2xl"></i>
                        <div>
                            <p class="text-xs text-gray-300 uppercase tracking-wide"><?php _e('Location', 'rise-ai-summit'); ?></p>
                            <p class="font-bold text-lg"><?php _e('Santiago, Chile', 'rise-ai-summit'); ?></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fa-solid fa-university text-nd-gold text-2xl"></i>
                        <div>
                            <p class="text-xs text-gray-300 uppercase tracking-wide"><?php _e('Venue', 'rise-ai-summit'); ?></p>
                            <p class="font-bold text-lg"><?php _e('Universidad de los Andes', 'rise-ai-summit'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid md:grid-cols-12 gap-12">
            
            <!-- Main Content (8 columns) -->
            <div class="md:col-span-8">
                
                <!-- Registration Info -->
                <div class="mb-12">
                    <h2 class="font-sans font-bold text-2xl text-nd-navy mb-6">
                        <?php _e('Registration Information', 'rise-ai-summit'); ?>
                    </h2>
                    
                    <div class="prose prose-lg font-serif text-gray-700">
                        <p>
                            <?php _e('Official registration will open in March 2026. By expressing your interest now, you will:', 'rise-ai-summit'); ?>
                        </p>
                        <ul class="list-disc pl-5 space-y-2 marker:text-uandes-red">
                            <li><?php _e('Receive early notification when registration opens', 'rise-ai-summit'); ?></li>
                            <li><?php _e('Get access to early bird pricing (estimated $100 students, $200 professionals)', 'rise-ai-summit'); ?></li>
                            <li><?php _e('Stay updated on speaker announcements and program details', 'rise-ai-summit'); ?></li>
                            <li><?php _e('Receive hotel room block information', 'rise-ai-summit'); ?></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Registration Form -->
                <div class="bg-light-gray p-8 rounded-lg">
                    <h3 class="font-sans font-bold text-xl text-nd-navy mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-user-plus text-uandes-red"></i>
                        <?php _e('Express Your Interest', 'rise-ai-summit'); ?>
                    </h3>
                    
                    <?php get_template_part('template-parts/forms/form', 'registration'); ?>
                </div>
                
            </div>

            <!-- Sidebar (4 columns) -->
            <div class="md:col-span-4">
                
                <!-- What's Included -->
                <div class="bg-white border border-gray-200 p-6 rounded-lg shadow-sm mb-8">
                    <h3 class="font-sans font-bold text-nd-navy mb-4 uppercase tracking-widest text-sm border-b pb-2">
                        <?php _e("What's Included", 'rise-ai-summit'); ?>
                    </h3>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Access to all keynote sessions', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Parallel track sessions', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Poster session and networking', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Coffee breaks and lunches', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Conference materials', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Certificate of attendance', 'rise-ai-summit'); ?></span>
                        </li>
                    </ul>
                </div>
                
                <!-- FAQ Quick Links -->
                <div class="bg-nd-navy text-white p-6 rounded-lg">
                    <h3 class="font-sans font-bold mb-4">
                        <?php _e('Have Questions?', 'rise-ai-summit'); ?>
                    </h3>
                    <p class="text-sm text-gray-300 mb-4">
                        <?php _e('Check our logistics page for accommodation, travel, and venue information.', 'rise-ai-summit'); ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/logistics/')); ?>" 
                       class="text-nd-gold hover:text-white font-bold text-sm inline-flex items-center gap-2 transition">
                        <i class="fa-solid fa-plane"></i>
                        <?php _e('Travel & Logistics', 'rise-ai-summit'); ?>
                    </a>
                </div>
                
            </div>
            
        </div>
    </div>
    
</div>

<?php
get_footer();