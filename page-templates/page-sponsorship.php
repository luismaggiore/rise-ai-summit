<?php
/**
 * Template Name: Sponsorship Page
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="sponsorship-page">
    
    <!-- Header -->
    <header class="bg-nd-navy py-24 border-b-4 border-nd-gold relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#AE9142 1px, transparent 1px); background-size: 20px 20px;"></div>
        <div class="max-w-7xl mx-auto px-4 text-white relative z-10">
            <span class="text-nd-gold font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Support the Summit', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl md:text-5xl text-white">
                <?php _e('Sponsorship Opportunities', 'rise-ai-summit'); ?>
            </h1>
            <p class="mt-4 text-gray-300 text-lg">
                <?php _e('Partner with us for RISE AI 2026', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>
    
    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        
        <!-- Why Sponsor -->
        <div class="text-center mb-16">
            <h2 class="font-sans font-bold text-3xl text-nd-navy mb-6">
                <?php _e('Why Sponsor RISE AI Summit?', 'rise-ai-summit'); ?>
            </h2>
            <p class="text-gray-600 mb-12 font-serif text-lg leading-relaxed max-w-3xl mx-auto">
                <?php _e('Demonstrate your organization\'s commitment to responsible AI innovation. The summit offers a unique opportunity to connect with top talent, leading researchers, and decision-makers from across the Americas in an intimate, high-impact setting.', 'rise-ai-summit'); ?>
            </p>
            
            <!-- Benefits Grid -->
            <div class="grid md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-uandes-red/10 text-uandes-red rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                    <h3 class="font-bold text-nd-navy font-sans mb-2 text-sm">
                        <?php _e('Network Access', 'rise-ai-summit'); ?>
                    </h3>
                    <p class="text-xs text-gray-600">
                        <?php _e('Connect with 200+ academics, industry leaders, and policymakers', 'rise-ai-summit'); ?>
                    </p>
                </div>
                
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-nd-gold/10 text-nd-gold rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-trophy text-xl"></i>
                    </div>
                    <h3 class="font-bold text-nd-navy font-sans mb-2 text-sm">
                        <?php _e('Brand Visibility', 'rise-ai-summit'); ?>
                    </h3>
                    <p class="text-xs text-gray-600">
                        <?php _e('Prominent logo placement and recognition throughout the event', 'rise-ai-summit'); ?>
                    </p>
                </div>
                
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-nd-navy/10 text-nd-navy rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-handshake text-xl"></i>
                    </div>
                    <h3 class="font-bold text-nd-navy font-sans mb-2 text-sm">
                        <?php _e('Talent Pipeline', 'rise-ai-summit'); ?>
                    </h3>
                    <p class="text-xs text-gray-600">
                        <?php _e('Early access to top AI talent and researchers', 'rise-ai-summit'); ?>
                    </p>
                </div>
                
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-green-500/10 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-chart-line text-xl"></i>
                    </div>
                    <h3 class="font-bold text-nd-navy font-sans mb-2 text-sm">
                        <?php _e('Thought Leadership', 'rise-ai-summit'); ?>
                    </h3>
                    <p class="text-xs text-gray-600">
                        <?php _e('Position your company at the forefront of ethical AI', 'rise-ai-summit'); ?>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Sponsorship Levels -->
        <div class="mb-16">
            <h2 class="font-sans font-bold text-3xl text-nd-navy mb-8 text-center">
                <?php _e('Sponsorship Levels', 'rise-ai-summit'); ?>
            </h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                
                <!-- Platinum -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-gray-400 hover:shadow-xl transition">
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 p-6 text-center">
                        <h3 class="font-bold text-2xl text-gray-800 font-sans mb-2">
                            <?php _e('Platinum', 'rise-ai-summit'); ?>
                        </h3>
                        <p class="text-sm text-gray-600"><?php _e('Premier Sponsor', 'rise-ai-summit'); ?></p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('Keynote introduction opportunity', 'rise-ai-summit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('Large exhibition booth', 'rise-ai-summit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('5 VIP passes', 'rise-ai-summit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('Logo on all materials', 'rise-ai-summit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('Social media recognition', 'rise-ai-summit'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Gold -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-nd-gold hover:shadow-xl transition">
                    <div class="bg-gradient-to-br from-yellow-100 to-yellow-200 p-6 text-center">
                        <h3 class="font-bold text-2xl text-nd-gold font-sans mb-2">
                            <?php _e('Gold', 'rise-ai-summit'); ?>
                        </h3>
                        <p class="text-sm text-yellow-800"><?php _e('Major Sponsor', 'rise-ai-summit'); ?></p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('Session branding', 'rise-ai-summit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('Standard exhibition booth', 'rise-ai-summit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('3 VIP passes', 'rise-ai-summit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('Logo on website and programs', 'rise-ai-summit'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Silver -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-gray-300 hover:shadow-xl transition">
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 text-center">
                        <h3 class="font-bold text-2xl text-gray-700 font-sans mb-2">
                            <?php _e('Silver', 'rise-ai-summit'); ?>
                        </h3>
                        <p class="text-sm text-gray-600"><?php _e('Supporting Sponsor', 'rise-ai-summit'); ?></p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('Table display', 'rise-ai-summit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('2 passes', 'rise-ai-summit'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span><?php _e('Logo on website', 'rise-ai-summit'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="bg-light-gray p-12 rounded-lg text-center mb-16">
            <h3 class="font-sans font-bold text-2xl text-nd-navy mb-4">
                <?php _e('Request Full Sponsorship Prospectus', 'rise-ai-summit'); ?>
            </h3>
            <p class="text-gray-600 mb-6 font-serif">
                <?php _e('Download our detailed prospectus for complete package information, pricing, and custom sponsorship opportunities.', 'rise-ai-summit'); ?>
            </p>
            <a href="#" 
               class="bg-uandes-red text-white px-10 py-4 rounded font-bold hover:bg-red-700 transition inline-flex items-center gap-2 shadow-lg">
                <i class="fa-solid fa-file-pdf"></i>
                <?php _e('Request Prospectus', 'rise-ai-summit'); ?>
            </a>
        </div>
        
        <!-- Contact Form -->
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="font-sans font-bold text-3xl text-nd-navy mb-4">
                    <?php _e('Get in Touch', 'rise-ai-summit'); ?>
                </h2>
                <p class="text-gray-600 font-serif">
                    <?php _e('Interested in sponsoring? Fill out the form below and our team will contact you within 48 hours.', 'rise-ai-summit'); ?>
                </p>
            </div>
            
            <?php get_template_part('template-parts/forms/form', 'sponsor'); ?>
        </div>
        
    </div>
    
</div>

<?php
get_footer();