<?php
/**
 * Template Name: Agenda Page
 * 
 * @package RISE_AI_Summit
 */

get_header();
?>

<div class="agenda-page">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Schedule', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl text-nd-navy">
                <?php _e('Program Agenda', 'rise-ai-summit'); ?>
            </h1>
            <p class="mt-4 text-gray-600 font-serif text-lg">
                <?php _e('A two-day immersive experience in Santiago.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>

    <div class="max-w-5xl mx-auto px-4 py-16">
        
        <!-- DAY 1 -->
        <div class="mb-20 relative">
            <div class="absolute left-6 top-20 bottom-0 w-0.5 bg-gray-200 hidden md:block"></div>
            
            <div class="sticky top-20 bg-white/95 backdrop-blur z-20 py-4 border-b-2 border-nd-navy mb-8 flex items-baseline gap-4">
                <h2 class="font-sans font-bold text-3xl text-nd-navy"><?php _e('Day 1', 'rise-ai-summit'); ?></h2>
                <span class="font-serif text-gray-500 text-lg"><?php _e('Thursday, October 15, 2026', 'rise-ai-summit'); ?></span>
            </div>

            <div class="space-y-8">
                
                <!-- Session: Registration -->
                <div class="relative bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition ml-0 md:ml-12">
                    <div class="absolute -left-[31px] top-8 w-4 h-4 rounded-full border-4 border-white bg-nd-navy shadow-sm hidden md:block"></div>
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-32 flex-shrink-0 text-right md:border-r border-gray-100 md:pr-6">
                            <span class="block font-bold text-nd-navy font-sans text-xl">08:30</span>
                            <span class="text-xs text-gray-400 font-bold uppercase">09:30</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-nd-navy font-sans">
                                <?php _e('Registration & Welcome Coffee', 'rise-ai-summit'); ?>
                            </h3>
                            <p class="text-sm text-gray-500 font-serif mt-1">
                                <i class="fa-solid fa-location-dot mr-1 text-uandes-red"></i> 
                                <?php _e('Main Hall, ESE Business School', 'rise-ai-summit'); ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Session: Opening -->
                <div class="relative bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition ml-0 md:ml-12">
                    <div class="absolute -left-[31px] top-8 w-4 h-4 rounded-full border-4 border-white bg-nd-navy shadow-sm hidden md:block"></div>
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-32 flex-shrink-0 text-right md:border-r border-gray-100 md:pr-6">
                            <span class="block font-bold text-nd-navy font-sans text-xl">09:30</span>
                            <span class="text-xs text-gray-400 font-bold uppercase">10:30</span>
                        </div>
                        <div>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-nd-navy text-white mb-2">
                                <?php _e('Plenary', 'rise-ai-summit'); ?>
                            </span>
                            <h3 class="font-bold text-lg text-nd-navy font-sans">
                                <?php _e('Opening Ceremony', 'rise-ai-summit'); ?>
                            </h3>
                            <p class="text-sm text-gray-600 font-serif mt-2">
                                <?php _e('Welcome remarks by University Rectors and Summit Chairs.', 'rise-ai-summit'); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Session: Keynote 1 -->
                <div class="relative bg-blue-50/40 p-6 rounded-lg border border-blue-100 shadow-sm ml-0 md:ml-12">
                    <div class="absolute -left-[31px] top-8 w-4 h-4 rounded-full border-4 border-white bg-uandes-red shadow-sm hidden md:block"></div>
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-32 flex-shrink-0 text-right md:border-r border-blue-200 md:pr-6">
                            <span class="block font-bold text-uandes-red font-sans text-xl">10:30</span>
                            <span class="text-xs text-uandes-red/60 font-bold uppercase">11:30</span>
                        </div>
                        <div>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-uandes-red text-white mb-2">
                                <?php _e('Keynote', 'rise-ai-summit'); ?>
                            </span>
                            <h3 class="font-bold text-xl text-nd-navy font-sans">
                                <?php _e('Keynote: The State of Ethical AI in 2026', 'rise-ai-summit'); ?>
                            </h3>
                            <p class="text-sm text-gray-600 font-serif mt-2 italic">
                                <?php _e('Speaker TBA (Distinguished Professor of AI Ethics)', 'rise-ai-summit'); ?>
                            </p>
                            <p class="text-sm text-gray-500 font-serif mt-2">
                                <?php _e('An overview of global regulations, technological breakthroughs, and the specific role of the Global South.', 'rise-ai-summit'); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Session: Parallel Sessions -->
                <div class="relative bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition ml-0 md:ml-12">
                    <div class="absolute -left-[31px] top-8 w-4 h-4 rounded-full border-4 border-white bg-gray-300 shadow-sm hidden md:block"></div>
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-32 flex-shrink-0 text-right md:border-r border-gray-100 md:pr-6">
                            <span class="block font-bold text-nd-navy font-sans text-xl">11:30</span>
                            <span class="text-xs text-gray-400 font-bold uppercase">13:00</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-nd-navy font-sans mb-3">
                                <?php _e('Parallel Sessions A', 'rise-ai-summit'); ?>
                            </h3>
                            <div class="grid md:grid-cols-3 gap-4 text-sm font-serif">
                                <div class="bg-gray-50 p-3 border-l-4 border-nd-navy rounded-r">
                                    <strong class="block text-nd-navy font-sans text-xs uppercase mb-1">
                                        <?php _e('Business', 'rise-ai-summit'); ?>
                                    </strong>
                                    <?php _e('AI Governance in Banking', 'rise-ai-summit'); ?>
                                </div>
                                <div class="bg-gray-50 p-3 border-l-4 border-nd-gold rounded-r">
                                    <strong class="block text-nd-navy font-sans text-xs uppercase mb-1">
                                        <?php _e('Education', 'rise-ai-summit'); ?>
                                    </strong>
                                    <?php _e('Generative AI in the Classroom', 'rise-ai-summit'); ?>
                                </div>
                                <div class="bg-gray-50 p-3 border-l-4 border-uandes-red rounded-r">
                                    <strong class="block text-nd-navy font-sans text-xs uppercase mb-1">
                                        <?php _e('Science', 'rise-ai-summit'); ?>
                                    </strong>
                                    <?php _e('AI for Drug Discovery', 'rise-ai-summit'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Lunch Break -->
                <div class="relative bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition ml-0 md:ml-12">
                    <div class="absolute -left-[31px] top-8 w-4 h-4 rounded-full border-4 border-white bg-gray-300 shadow-sm hidden md:block"></div>
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-32 flex-shrink-0 text-right md:border-r border-gray-100 md:pr-6">
                            <span class="block font-bold text-nd-navy font-sans text-xl">13:00</span>
                            <span class="text-xs text-gray-400 font-bold uppercase">14:30</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-nd-navy font-sans">
                                <?php _e('Lunch Break', 'rise-ai-summit'); ?>
                            </h3>
                            <p class="text-sm text-gray-500 font-serif mt-1">
                                <i class="fa-solid fa-utensils mr-1 text-uandes-red"></i> 
                                <?php _e('Networking lunch provided', 'rise-ai-summit'); ?>
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- DAY 2 -->
        <div class="relative">
            <div class="absolute left-6 top-20 bottom-0 w-0.5 bg-gray-200 hidden md:block"></div>

            <div class="sticky top-20 bg-white/95 backdrop-blur z-20 py-4 border-b-2 border-uandes-red mb-8 flex items-baseline gap-4">
                <h2 class="font-sans font-bold text-3xl text-nd-navy"><?php _e('Day 2', 'rise-ai-summit'); ?></h2>
                <span class="font-serif text-gray-500 text-lg"><?php _e('Friday, October 16, 2026', 'rise-ai-summit'); ?></span>
            </div>

            <div class="space-y-8">
                
                <!-- Session: Keynote 2 -->
                <div class="relative bg-blue-50/40 p-6 rounded-lg border border-blue-100 shadow-sm ml-0 md:ml-12">
                    <div class="absolute -left-[31px] top-8 w-4 h-4 rounded-full border-4 border-white bg-uandes-red shadow-sm hidden md:block"></div>
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-32 flex-shrink-0 text-right md:border-r border-blue-200 md:pr-6">
                            <span class="block font-bold text-uandes-red font-sans text-xl">09:00</span>
                            <span class="text-xs text-uandes-red/60 font-bold uppercase">10:00</span>
                        </div>
                        <div>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-uandes-red text-white mb-2">
                                <?php _e('Keynote', 'rise-ai-summit'); ?>
                            </span>
                            <h3 class="font-bold text-xl text-nd-navy font-sans">
                                <?php _e('Keynote: AI for Social Good in Latin America', 'rise-ai-summit'); ?>
                            </h3>
                            <p class="text-sm text-gray-600 font-serif mt-2 italic">
                                <?php _e('Speaker TBA (Industry Leader)', 'rise-ai-summit'); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Session: Poster Session -->
                <div class="relative bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition ml-0 md:ml-12">
                    <div class="absolute -left-[31px] top-8 w-4 h-4 rounded-full border-4 border-white bg-gray-500 shadow-sm hidden md:block"></div>
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-32 flex-shrink-0 text-right md:border-r border-gray-100 md:pr-6">
                            <span class="block font-bold text-nd-navy font-sans text-xl">12:00</span>
                            <span class="text-xs text-gray-400 font-bold uppercase">13:30</span>
                        </div>
                        <div>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-gray-600 text-white mb-2">
                                <?php _e('Research', 'rise-ai-summit'); ?>
                            </span>
                            <h3 class="font-bold text-lg text-nd-navy font-sans">
                                <?php _e('Poster Session & Lunch', 'rise-ai-summit'); ?>
                            </h3>
                            <p class="text-sm text-gray-600 font-serif mt-2">
                                <?php _e('Interactive presentation of accepted abstracts. A light lunch will be served.', 'rise-ai-summit'); ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Closing -->
                <div class="relative bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition ml-0 md:ml-12">
                    <div class="absolute -left-[31px] top-8 w-4 h-4 rounded-full border-4 border-white bg-nd-navy shadow-sm hidden md:block"></div>
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-32 flex-shrink-0 text-right md:border-r border-gray-100 md:pr-6">
                            <span class="block font-bold text-nd-navy font-sans text-xl">16:00</span>
                            <span class="text-xs text-gray-400 font-bold uppercase">17:00</span>
                        </div>
                        <div>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-nd-navy text-white mb-2">
                                <?php _e('Plenary', 'rise-ai-summit'); ?>
                            </span>
                            <h3 class="font-bold text-lg text-nd-navy font-sans">
                                <?php _e('Closing Ceremony & Networking Reception', 'rise-ai-summit'); ?>
                            </h3>
                            <p class="text-sm text-gray-600 font-serif mt-2">
                                <?php _e('Summit wrap-up and farewell reception.', 'rise-ai-summit'); ?>
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
    
</div>

<?php
get_footer();