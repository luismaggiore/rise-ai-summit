<?php
/**
 * Template Name: Call for Papers
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="call-for-papers-page">
    
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
                <?php _e('Submit Your Abstract for RISE AI Summit 2026', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>
    
    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-12 gap-12">
            
            <!-- Main Content (8 columns) -->
            <div class="md:col-span-8 space-y-8 font-serif text-gray-700 leading-relaxed">
                
                <div class="prose prose-lg">
                    <p>
                        <?php _e('The RISE AI South America Summit invites researchers, practitioners, and students to submit abstracts for poster presentations. Submissions should align with one of the three conference tracks (Business, Education, Applied Science).', 'rise-ai-summit'); ?>
                    </p>
                    <p>
                        <?php _e('This is an opportunity to showcase work-in-progress, recent findings, or novel applications of AI to an international audience of peers and leaders.', 'rise-ai-summit'); ?>
                    </p>
                </div>
                
                <h3 class="font-sans font-bold text-xl text-nd-navy mt-8 border-b border-gray-200 pb-2">
                    <?php _e('Submission Guidelines', 'rise-ai-summit'); ?>
                </h3>
                <ul class="list-disc pl-5 space-y-2 marker:text-uandes-red">
                    <li><strong><?php _e('Format:', 'rise-ai-summit'); ?></strong> <?php _e('Abstracts must be submitted in English or Spanish.', 'rise-ai-summit'); ?></li>
                    <li><strong><?php _e('Length:', 'rise-ai-summit'); ?></strong> <?php _e('Maximum 500 words (excluding references).', 'rise-ai-summit'); ?></li>
                    <li><strong><?php _e('Review:', 'rise-ai-summit'); ?></strong> <?php _e('All submissions will undergo a double-blind peer review process by the Program Committee.', 'rise-ai-summit'); ?></li>
                    <li><strong><?php _e('Acceptance:', 'rise-ai-summit'); ?></strong> <?php _e('Accepted authors will be invited to present a poster during the summit. At least one author must register for the conference.', 'rise-ai-summit'); ?></li>
                </ul>

                <h3 class="font-sans font-bold text-xl text-nd-navy mt-8 border-b border-gray-200 pb-2">
                    <?php _e('Poster Specifications', 'rise-ai-summit'); ?>
                </h3>
                <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-nd-gold">
                    <p class="text-sm">
                        <strong><?php _e('Size:', 'rise-ai-summit'); ?></strong> 
                        <?php _e('Posters should be printed in vertical A0 format (841 x 1189 mm). Mounting materials will be provided at the venue.', 'rise-ai-summit'); ?>
                    </p>
                </div>
                
                <h3 class="font-sans font-bold text-xl text-nd-navy mt-8 border-b border-gray-200 pb-2">
                    <?php _e("What We're Looking For", 'rise-ai-summit'); ?>
                </h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-white p-4 border-l-4 border-nd-navy rounded-r shadow-sm">
                        <h4 class="font-bold text-nd-navy font-sans text-sm mb-2">
                            <?php _e('Business Track', 'rise-ai-summit'); ?>
                        </h4>
                        <p class="text-xs text-gray-600">
                            <?php _e('Strategy, governance, risk management, organizational impact', 'rise-ai-summit'); ?>
                        </p>
                    </div>
                    <div class="bg-white p-4 border-l-4 border-nd-gold rounded-r shadow-sm">
                        <h4 class="font-bold text-nd-gold font-sans text-sm mb-2">
                            <?php _e('Education Track', 'rise-ai-summit'); ?>
                        </h4>
                        <p class="text-xs text-gray-600">
                            <?php _e('Learning outcomes, skills development, institutional transformation', 'rise-ai-summit'); ?>
                        </p>
                    </div>
                    <div class="bg-white p-4 border-l-4 border-uandes-red rounded-r shadow-sm">
                        <h4 class="font-bold text-uandes-red font-sans text-sm mb-2">
                            <?php _e('Science Track', 'rise-ai-summit'); ?>
                        </h4>
                        <p class="text-xs text-gray-600">
                            <?php _e('Health applications, engineering innovation, translational research', 'rise-ai-summit'); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sidebar (4 columns) -->
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
                            <span class="text-gray-500"><?php _e('Notification', 'rise-ai-summit'); ?></span>
                            <span class="font-bold text-nd-navy"><?php _e('August 15, 2026', 'rise-ai-summit'); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500"><?php _e('Summit Dates', 'rise-ai-summit'); ?></span>
                            <span class="font-bold text-nd-navy"><?php _e('Oct 15-16, 2026', 'rise-ai-summit'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- SUBMISSION FORM -->
        <div class="mt-16 pt-16 border-t-2 border-gray-200">
            <div class="text-center mb-12">
                <h2 class="font-sans font-bold text-3xl text-nd-navy mb-4">
                    <?php _e('Submit Your Abstract', 'rise-ai-summit'); ?>
                </h2>
                <p class="text-gray-600 font-serif">
                    <?php _e('Complete the form below to submit your abstract for consideration.', 'rise-ai-summit'); ?>
                </p>
            </div>
            
            <?php get_template_part('template-parts/forms/form', 'abstract'); ?>
        </div>
    </div>
    
</div>

<?php
get_footer();