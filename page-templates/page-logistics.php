<?php
/**
 * Template Name: Logistics Page
 * 
 * @package RISE_AI_Summit
 */

get_header();

while (have_posts()): the_post();
?>

<div class="logistics-page">
    
    <!-- Header -->
    <header class="bg-light-gray py-20 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <span class="text-uandes-red font-bold uppercase tracking-widest text-xs mb-2 block">
                <?php _e('Plan Your Trip', 'rise-ai-summit'); ?>
            </span>
            <h1 class="font-sans font-bold text-4xl text-nd-navy">
                <?php _e('Travel & Logistics', 'rise-ai-summit'); ?>
            </h1>
            <p class="mt-4 text-gray-600 font-serif text-lg">
                <?php _e('Planning your trip to Santiago.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </header>
    
    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-16">
        
        <!-- VENUE INFO (Left Column) -->
        <div>
            <h3 class="font-sans font-bold text-xl text-nd-navy mb-6 border-b border-uandes-red inline-block pb-1">
                <?php _e('The Venue', 'rise-ai-summit'); ?>
            </h3>
            
            <!-- CAMPUS GALLERY -->
            <div class="mb-6">
                <!-- Main Image (UAndes1) -->
                <img src="https://rise-ai-summit.s3.us-east-1.amazonaws.com/UAndes1.png" 
                     alt="Universidad de los Andes Main Campus View" 
                     class="w-full h-auto object-cover rounded-lg mb-2 shadow-md">
                
                <!-- Thumbnails Grid (UAndes2 - UAndes5) -->
                <div class="grid grid-cols-4 gap-2">
                    <img src="https://rise-ai-summit.s3.us-east-1.amazonaws.com/UAndes2.png" 
                         alt="Campus View 2" 
                         class="w-full h-20 object-cover rounded-lg hover:opacity-80 transition cursor-pointer shadow-sm border border-gray-200">
                    <img src="https://rise-ai-summit.s3.us-east-1.amazonaws.com/Uandes3.jpg" 
                         alt="Campus View 3" 
                         class="w-full h-20 object-cover rounded-lg hover:opacity-80 transition cursor-pointer shadow-sm border border-gray-200">
                    <img src="https://rise-ai-summit.s3.us-east-1.amazonaws.com/Uandes4.jpg" 
                         alt="Campus View 4" 
                         class="w-full h-20 object-cover rounded-lg hover:opacity-80 transition cursor-pointer shadow-sm border border-gray-200">
                    <img src="https://rise-ai-summit.s3.us-east-1.amazonaws.com/Uandes5.jpeg" 
                         alt="Campus View 5" 
                         class="w-full h-20 object-cover rounded-lg hover:opacity-80 transition cursor-pointer shadow-sm border border-gray-200">
                </div>
            </div>
            <!-- END CAMPUS GALLERY -->

            <p class="font-serif text-gray-700 mb-4">
                <strong><?php _e('Universidad de los Andes', 'rise-ai-summit'); ?></strong><br>
                Monseñor Álvaro del Portillo 12.455<br>
                Las Condes, Santiago, Chile.
            </p>
            
            <p class="font-serif text-sm text-gray-600 leading-relaxed mb-6">
                <?php _e('Located in the San Carlos de Apoquindo neighborhood, nestling in the foothills of the Andes Mountains, the campus offers a modern academic environment. It is approximately 45-60 minutes from SCL Airport by car.', 'rise-ai-summit'); ?>
            </p>
            
            <div class="flex gap-4 flex-wrap">
                <a href="https://maps.app.goo.gl/oHYGZETYT7UCuqgn6" 
                   target="_blank"
                   rel="noopener noreferrer"
                   class="text-uandes-red font-bold text-sm border border-uandes-red px-4 py-2 rounded hover:bg-uandes-red hover:text-white transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-map-location-dot"></i> 
                    <?php _e('View on Maps', 'rise-ai-summit'); ?>
                </a>
                <a href="https://www.uandes.cl" 
                   target="_blank"
                   rel="noopener noreferrer"
                   class="text-nd-navy font-bold text-sm border border-nd-navy px-4 py-2 rounded hover:bg-nd-navy hover:text-white transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-external-link-alt"></i> 
                    <?php _e('University Website', 'rise-ai-summit'); ?>
                </a>
            </div>
            
            <!-- Getting There Section -->
            <div class="mt-10 p-6 bg-light-gray rounded-lg border border-gray-200">
                <h4 class="font-sans font-bold text-nd-navy mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-plane-arrival text-uandes-red"></i>
                    <?php _e('Getting There', 'rise-ai-summit'); ?>
                </h4>
                <p class="text-sm text-gray-600 font-serif leading-relaxed mb-3">
                    <strong><?php _e('From Airport (SCL):', 'rise-ai-summit'); ?></strong><br>
                    <?php _e('Arturo Merino Benítez International Airport is approximately 45-60 minutes by car. Taxi, Uber, and airport shuttle services are available.', 'rise-ai-summit'); ?>
                </p>
                <p class="text-sm text-gray-600 font-serif leading-relaxed">
                    <strong><?php _e('Public Transport:', 'rise-ai-summit'); ?></strong><br>
                    <?php _e('Metro Line 1 to Escuela Militar station, then taxi/bus to campus (approximately 15 minutes).', 'rise-ai-summit'); ?>
                </p>
            </div>
        </div>

        <!-- FAQ ACCORDION (Right Column) -->
        <div>
            <h3 class="font-sans font-bold text-xl text-nd-navy mb-6 border-b border-uandes-red inline-block pb-1">
                <?php _e('Frequent Questions', 'rise-ai-summit'); ?>
            </h3>
            
            <div class="space-y-4">
                
                <!-- FAQ Item 1: Registration -->
                <details class="group bg-white border border-gray-200 rounded-lg open:shadow-md transition-all duration-200">
                    <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-4 text-nd-navy hover:bg-gray-50 rounded-lg">
                        <span><?php _e('How do I register?', 'rise-ai-summit'); ?></span>
                        <span class="transition group-open:rotate-180">
                            <i class="fa-solid fa-chevron-down text-uandes-red"></i>
                        </span>
                    </summary>
                    <div class="text-gray-600 px-4 pb-4 pt-0 font-serif text-sm leading-relaxed border-t border-transparent group-open:border-gray-100 group-open:pt-4">
                        <?php _e('Registration will open in March 2026. We will offer Early Bird rates for students ($100 USD) and regular attendees ($200 USD). A link will be provided on this page and via our newsletter.', 'rise-ai-summit'); ?>
                    </div>
                </details>

                <!-- FAQ Item 2: Hotel Blocks -->
                <details class="group bg-white border border-gray-200 rounded-lg open:shadow-md transition-all duration-200">
                    <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-4 text-nd-navy hover:bg-gray-50 rounded-lg">
                        <span><?php _e('Are there hotel room blocks?', 'rise-ai-summit'); ?></span>
                        <span class="transition group-open:rotate-180">
                            <i class="fa-solid fa-chevron-down text-uandes-red"></i>
                        </span>
                    </summary>
                    <div class="text-gray-600 px-4 pb-4 pt-0 font-serif text-sm leading-relaxed border-t border-transparent group-open:border-gray-100 group-open:pt-4">
                        <?php _e('Yes. We have secured a limited number of rooms at partner hotels in the Las Condes area (e.g., Regal Pacific, Mandarin Oriental) at a special conference rate. Booking links will be sent upon registration.', 'rise-ai-summit'); ?>
                    </div>
                </details>
                
                <!-- FAQ Item 3: Visa Requirements -->
                <details class="group bg-white border border-gray-200 rounded-lg open:shadow-md transition-all duration-200">
                    <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-4 text-nd-navy hover:bg-gray-50 rounded-lg">
                        <span><?php _e('Do I need a visa to travel to Chile?', 'rise-ai-summit'); ?></span>
                        <span class="transition group-open:rotate-180">
                            <i class="fa-solid fa-chevron-down text-uandes-red"></i>
                        </span>
                    </summary>
                    <div class="text-gray-600 px-4 pb-4 pt-0 font-serif text-sm leading-relaxed border-t border-transparent group-open:border-gray-100 group-open:pt-4">
                        <?php _e('Visa requirements depend on your nationality. Most visitors from the Americas and Europe can enter Chile without a visa for tourism/business purposes for up to 90 days. Please check with your local Chilean consulate or embassy for specific requirements.', 'rise-ai-summit'); ?>
                    </div>
                </details>
                
                <!-- FAQ Item 4: Conference Language -->
                <details class="group bg-white border border-gray-200 rounded-lg open:shadow-md transition-all duration-200">
                    <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-4 text-nd-navy hover:bg-gray-50 rounded-lg">
                        <span><?php _e('What language will the conference be in?', 'rise-ai-summit'); ?></span>
                        <span class="transition group-open:rotate-180">
                            <i class="fa-solid fa-chevron-down text-uandes-red"></i>
                        </span>
                    </summary>
                    <div class="text-gray-600 px-4 pb-4 pt-0 font-serif text-sm leading-relaxed border-t border-transparent group-open:border-gray-100 group-open:pt-4">
                        <?php _e('The conference will be conducted primarily in English, with some sessions in Spanish. Keynote presentations will have simultaneous translation available. Posters and abstracts may be submitted in either English or Spanish.', 'rise-ai-summit'); ?>
                    </div>
                </details>
                
                <!-- FAQ Item 5: What to Bring -->
                <details class="group bg-white border border-gray-200 rounded-lg open:shadow-md transition-all duration-200">
                    <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-4 text-nd-navy hover:bg-gray-50 rounded-lg">
                        <span><?php _e('What should I bring to the summit?', 'rise-ai-summit'); ?></span>
                        <span class="transition group-open:rotate-180">
                            <i class="fa-solid fa-chevron-down text-uandes-red"></i>
                        </span>
                    </summary>
                    <div class="text-gray-600 px-4 pb-4 pt-0 font-serif text-sm leading-relaxed border-t border-transparent group-open:border-gray-100 group-open:pt-4">
                        <?php _e('We recommend bringing business casual attire, your laptop for note-taking, business cards for networking, and comfortable walking shoes. The weather in Santiago in October is mild (spring season), with temperatures ranging from 10-25°C (50-77°F).', 'rise-ai-summit'); ?>
                    </div>
                </details>
                
                <!-- FAQ Item 6: Parking -->
                <details class="group bg-white border border-gray-200 rounded-lg open:shadow-md transition-all duration-200">
                    <summary class="flex justify-between items-center font-bold cursor-pointer list-none p-4 text-nd-navy hover:bg-gray-50 rounded-lg">
                        <span><?php _e('Is parking available at the venue?', 'rise-ai-summit'); ?></span>
                        <span class="transition group-open:rotate-180">
                            <i class="fa-solid fa-chevron-down text-uandes-red"></i>
                        </span>
                    </summary>
                    <div class="text-gray-600 px-4 pb-4 pt-0 font-serif text-sm leading-relaxed border-t border-transparent group-open:border-gray-100 group-open:pt-4">
                        <?php _e('Yes, free parking is available on campus for registered attendees. Please bring your registration confirmation to access the parking area.', 'rise-ai-summit'); ?>
                    </div>
                </details>
                
            </div>
            
            <!-- Contact Help Box -->
            <div class="mt-8 p-6 bg-nd-navy text-white rounded-lg">
                <h4 class="font-sans font-bold mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-question-circle"></i>
                    <?php _e('Still Have Questions?', 'rise-ai-summit'); ?>
                </h4>
                <p class="text-sm text-gray-300 mb-4">
                    <?php _e('Our logistics team is here to help with travel, accommodation, and venue questions.', 'rise-ai-summit'); ?>
                </p>
                <a href="mailto:logistics@rise-summit.cl" 
                   class="text-nd-gold hover:text-white font-bold text-sm inline-flex items-center gap-2 transition">
                    <i class="fa-solid fa-envelope"></i> 
                    logistics@rise-summit.cl
                </a>
            </div>
            
        </div>
        
    </div>
    
</div>

<?php
endwhile;

get_footer();