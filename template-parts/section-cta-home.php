<?php
/**
 * Home CTA Section - 3 Columns
 * Sponsor | Research | Attend
 * 
 * @package RISE_AI_Summit
 */
?>

<section class="cta-section py-20 bg-gradient-to-br from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4">
        
        <!-- Section Header -->
        <div class="text-center mb-16">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Get Involved', 'rise-ai-summit'); ?>
            </span>
            <h2 class="font-sans font-bold text-3xl md:text-4xl text-nd-navy mb-4">
                <?php _e('Join RISE AI Summit 2026', 'rise-ai-summit'); ?>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto font-serif">
                <?php _e('Be part of the conversation shaping the future of ethical AI in South America', 'rise-ai-summit'); ?>
            </p>
        </div>

        <!-- 3 Column Grid -->
        <div class="grid md:grid-cols-3 gap-8">
            
            <!-- CTA 1: SPONSOR -->
            <div class="group bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-nd-navy hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="p-8">
                    <!-- Icon -->
                    <div class="w-20 h-20 bg-nd-navy/10 rounded-full flex items-center justify-center mb-6 group-hover:bg-nd-navy group-hover:scale-110 transition-all duration-300">
                        <i class="fa-solid fa-handshake text-4xl text-nd-navy group-hover:text-white transition-colors duration-300"></i>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="font-sans font-bold text-2xl text-nd-navy mb-4">
                        <?php _e('Become a Sponsor', 'rise-ai-summit'); ?>
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-gray-600 mb-6 font-serif leading-relaxed">
                        <?php _e('Support the summit and showcase your commitment to responsible AI innovation. Connect with leaders and researchers.', 'rise-ai-summit'); ?>
                    </p>
                    
                    <!-- Benefits List -->
                    <ul class="space-y-2 mb-8 text-sm text-gray-700">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Brand visibility', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Networking access', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('VIP passes', 'rise-ai-summit'); ?></span>
                        </li>
                    </ul>
                    
                    <!-- CTA Button -->
                    <a href="<?php echo esc_url(rise_ai_get_page_url_by_slug('sponsorship')); ?>" 
                       class="block w-full bg-nd-navy hover:bg-uandes-red text-white font-bold py-4 px-6 rounded-lg transition duration-300 text-center shadow-md group-hover:shadow-lg">
                        <?php _e('Explore Packages', 'rise-ai-summit'); ?>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- CTA 2: RESEARCH -->
            <div class="group bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-nd-gold hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="p-8">
                    <!-- Icon -->
                    <div class="w-20 h-20 bg-nd-gold/10 rounded-full flex items-center justify-center mb-6 group-hover:bg-nd-gold group-hover:scale-110 transition-all duration-300">
                        <i class="fa-solid fa-microscope text-4xl text-nd-gold group-hover:text-white transition-colors duration-300"></i>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="font-sans font-bold text-2xl text-nd-navy mb-4">
                        <?php _e('Submit Research', 'rise-ai-summit'); ?>
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-gray-600 mb-6 font-serif leading-relaxed">
                        <?php _e('Share your work with an international audience. Submit an abstract for poster presentation at the summit.', 'rise-ai-summit'); ?>
                    </p>
                    
                    <!-- Benefits List -->
                    <ul class="space-y-2 mb-8 text-sm text-gray-700">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Peer review process', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Poster presentation', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Networking opportunities', 'rise-ai-summit'); ?></span>
                        </li>
                    </ul>
                    
                    <!-- CTA Button -->
                    <a href="<?php echo esc_url(rise_ai_get_page_url_by_slug('call-for-papers')); ?>" 
                       class="block w-full bg-nd-gold hover:bg-nd-gold-light text-white font-bold py-4 px-6 rounded-lg transition duration-300 text-center shadow-md group-hover:shadow-lg">
                        <?php _e('Submit Abstract', 'rise-ai-summit'); ?>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    
                    <!-- Deadline Notice -->
                    <p class="text-xs text-center text-gray-500 mt-4 font-sans">
                        <i class="fa-regular fa-clock mr-1"></i>
                        <?php _e('Deadline: June 30, 2026', 'rise-ai-summit'); ?>
                    </p>
                </div>
            </div>

            <!-- CTA 3: ATTEND -->
            <div class="group bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-uandes-red hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="p-8">
                    <!-- Icon -->
                    <div class="w-20 h-20 bg-uandes-red/10 rounded-full flex items-center justify-center mb-6 group-hover:bg-uandes-red group-hover:scale-110 transition-all duration-300">
                        <i class="fa-solid fa-user-check text-4xl text-uandes-red group-hover:text-white transition-colors duration-300"></i>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="font-sans font-bold text-2xl text-nd-navy mb-4">
                        <?php _e('Attend the Summit', 'rise-ai-summit'); ?>
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-gray-600 mb-6 font-serif leading-relaxed">
                        <?php _e('Join 200+ professionals, researchers, and decision-makers for two days of insights and connections.', 'rise-ai-summit'); ?>
                    </p>
                    
                    <!-- Benefits List -->
                    <ul class="space-y-2 mb-8 text-sm text-gray-700">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Keynote sessions', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Track workshops', 'rise-ai-summit'); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span><?php _e('Networking events', 'rise-ai-summit'); ?></span>
                        </li>
                    </ul>
                    
                    <!-- CTA Button -->
                    <a href="<?php echo esc_url(rise_ai_get_page_url_by_slug('register')); ?>" 
                       class="block w-full bg-uandes-red hover:bg-red-700 text-white font-bold py-4 px-6 rounded-lg transition duration-300 text-center shadow-md group-hover:shadow-lg">
                        <?php _e('Register Interest', 'rise-ai-summit'); ?>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    
                    <!-- Date Notice -->
                    <p class="text-xs text-center text-gray-500 mt-4 font-sans">
                        <i class="fa-regular fa-calendar mr-1"></i>
                        <?php _e('October 15-16, 2026', 'rise-ai-summit'); ?>
                    </p>
                </div>
            </div>

        </div>

        <!-- Bottom CTA -->
        <div class="text-center mt-16 pt-12 border-t border-gray-200">
            <p class="text-gray-600 mb-6 font-serif">
                <?php _e('Have questions? We\'re here to help.', 'rise-ai-summit'); ?>
            </p>
            <a href="mailto:info@rise-summit.cl"
               class="inline-flex items-center gap-2 text-nd-navy hover:text-uandes-red font-bold transition border-b-2 border-transparent hover:border-uandes-red pb-1">
                <i class="fa-solid fa-envelope"></i>
                <?php _e('Contact Us', 'rise-ai-summit'); ?>
            </a>
        </div>

    </div>
</section>