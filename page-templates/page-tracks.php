<?php
/**
 * Template Name: Tracks Page
 * 
 * @package RISE_AI_Summit
 */

get_header();

// Get custom fields
$business_topics = get_post_meta(get_the_ID(), 'track_business_topics', true);
$education_topics = get_post_meta(get_the_ID(), 'track_education_topics', true);
$science_topics = get_post_meta(get_the_ID(), 'track_science_topics', true);

// Convert to arrays
$business_topics_array = $business_topics ? array_filter(array_map('trim', explode("\n", $business_topics))) : array();
$education_topics_array = $education_topics ? array_filter(array_map('trim', explode("\n", $education_topics))) : array();
$science_topics_array = $science_topics ? array_filter(array_map('trim', explode("\n", $science_topics))) : array();

// Defaults if empty
if (empty($business_topics_array)) {
    $business_topics_array = array(
        __('Responsible AI in organizations', 'rise-ai-summit'),
        __('Productivity and transformation', 'rise-ai-summit'),
        __('Governance, compliance, and risk', 'rise-ai-summit'),
        __('AI adoption and talent management', 'rise-ai-summit'),
    );
}

if (empty($education_topics_array)) {
    $education_topics_array = array(
        __('AI literacy and workforce skills', 'rise-ai-summit'),
        __('Teaching and learning augmentation', 'rise-ai-summit'),
        __('Institutional strategy and policy', 'rise-ai-summit'),
        __('Equity and inclusion in education', 'rise-ai-summit'),
    );
}

if (empty($science_topics_array)) {
    $science_topics_array = array(
        __('AI for science and engineering innovation', 'rise-ai-summit'),
        __('Applied research translation', 'rise-ai-summit'),
        __('Health applications (Clinical and Systems)', 'rise-ai-summit'),
        __('Data-intensive systems and evaluation', 'rise-ai-summit'),
    );
}
?>

<div class="tracks-page">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('The Program', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl text-nd-navy">
                <?php _e('Conference Tracks', 'rise-ai-summit'); ?>
            </h1>
            <p class="mt-4 text-gray-600 max-w-2xl font-serif text-lg">
                <?php _e('The program is organized into three distinct tracks. Submissions and sessions will align with these core areas.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 py-16 space-y-12">
        
        <!-- TRACK 1: BUSINESS -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col md:flex-row hover:shadow-lg transition duration-300 group">
            <div class="bg-nd-navy text-white p-10 md:w-1/3 flex flex-col justify-center relative overflow-hidden">
                <i class="fa-solid fa-briefcase text-9xl absolute -right-6 -bottom-6 text-white opacity-5 group-hover:opacity-10 transition"></i>
                <div class="relative z-10">
                    <span class="bg-nd-gold text-nd-navy text-xs font-bold px-2 py-1 rounded mb-4 inline-block">TRACK 01</span>
                    <h2 class="font-sans font-bold text-3xl mb-2"><?php _e('Business', 'rise-ai-summit'); ?></h2>
                    <p class="text-gray-300 text-sm opacity-90"><?php _e('Strategy & Governance', 'rise-ai-summit'); ?></p>
                </div>
            </div>
            <div class="p-10 md:w-2/3">
                <h3 class="font-sans font-bold text-lg text-uandes-red uppercase tracking-wider mb-3">
                    <?php _e('Scope', 'rise-ai-summit'); ?>
                </h3>
                <p class="text-gray-700 mb-8 font-serif leading-relaxed">
                    <?php _e('Focuses on AI strategy, deployment, governance, risk management, and real-world business applications. Designed for leaders and practitioners navigating the AI transformation.', 'rise-ai-summit'); ?>
                </p>
                
                <h3 class="font-sans font-bold text-xs text-nd-navy uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">
                    <?php _e('Key Topics', 'rise-ai-summit'); ?>
                </h3>
                <div class="grid md:grid-cols-2 gap-y-3 gap-x-8 text-gray-600 font-serif text-sm">
                    <?php foreach ($business_topics_array as $topic): ?>
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i> 
                            <?php echo esc_html($topic); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- TRACK 2: EDUCATION -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col md:flex-row hover:shadow-lg transition duration-300 group">
            <div class="bg-nd-gold text-nd-navy p-10 md:w-1/3 flex flex-col justify-center relative overflow-hidden">
                <i class="fa-solid fa-graduation-cap text-9xl absolute -right-6 -bottom-6 text-nd-navy opacity-5 group-hover:opacity-10 transition"></i>
                <div class="relative z-10">
                    <span class="bg-nd-navy text-white text-xs font-bold px-2 py-1 rounded mb-4 inline-block">TRACK 02</span>
                    <h2 class="font-sans font-bold text-3xl mb-2"><?php _e('Education', 'rise-ai-summit'); ?></h2>
                    <p class="text-nd-navy text-sm opacity-90 font-medium"><?php _e('Policy & Skills', 'rise-ai-summit'); ?></p>
                </div>
            </div>
            <div class="p-10 md:w-2/3">
                <h3 class="font-sans font-bold text-lg text-uandes-red uppercase tracking-wider mb-3">
                    <?php _e('Scope', 'rise-ai-summit'); ?>
                </h3>
                <p class="text-gray-700 mb-8 font-serif leading-relaxed">
                    <?php echo __('Explores AI impact on education systems, learning outcomes, skills development, and institutional transformation in schools and universities.', 'rise-ai-summit'); ?>
                </p>
                
                <h3 class="font-sans font-bold text-xs text-nd-navy uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">
                    <?php _e('Key Topics', 'rise-ai-summit'); ?>
                </h3>
                <div class="grid md:grid-cols-2 gap-y-3 gap-x-8 text-gray-600 font-serif text-sm">
                    <?php foreach ($education_topics_array as $topic): ?>
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i> 
                            <?php echo esc_html($topic); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- TRACK 3: SCIENCE -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col md:flex-row hover:shadow-lg transition duration-300 group">
            <div class="bg-uandes-red text-white p-10 md:w-1/3 flex flex-col justify-center relative overflow-hidden">
                <i class="fa-solid fa-microscope text-9xl absolute -right-6 -bottom-6 text-white opacity-10 group-hover:opacity-20 transition"></i>
                <div class="relative z-10">
                    <span class="bg-white text-uandes-red text-xs font-bold px-2 py-1 rounded mb-4 inline-block">TRACK 03</span>
                    <h2 class="font-sans font-bold text-3xl mb-2"><?php _e('Applied Science', 'rise-ai-summit'); ?></h2>
                    <p class="text-white text-sm opacity-90"><?php _e('Health & Engineering', 'rise-ai-summit'); ?></p>
                </div>
            </div>
            <div class="p-10 md:w-2/3">
                <h3 class="font-sans font-bold text-lg text-uandes-red uppercase tracking-wider mb-3">
                    <?php _e('Scope', 'rise-ai-summit'); ?>
                </h3>
                <p class="text-gray-700 mb-8 font-serif leading-relaxed">
                    <?php _e('Dedicated to applied AI for scientific and engineering domains, with a special emphasis on health-focused applications and translational research.', 'rise-ai-summit'); ?>
                </p>
                
                <h3 class="font-sans font-bold text-xs text-nd-navy uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">
                    <?php _e('Key Topics', 'rise-ai-summit'); ?>
                </h3>
                <div class="grid md:grid-cols-2 gap-y-3 gap-x-8 text-gray-600 font-serif text-sm">
                    <?php foreach ($science_topics_array as $topic): ?>
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i> 
                            <?php echo esc_html($topic); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
    </div>
    
</div>

<?php
get_footer();