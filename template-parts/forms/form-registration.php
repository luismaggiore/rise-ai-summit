<?php
/**
 * Registration Interest Form
 * 
 * @package RISE_AI_Summit
 */

// Get stored data if there was an error
$stored_data = get_transient('registration_data_' . session_id());
$errors = get_transient('registration_errors_' . session_id());

// Helper function to get old value
function rise_old_reg($key, $default = '') {
    global $stored_data;
    return isset($stored_data[$key]) ? esc_attr($stored_data[$key]) : $default;
}

// Helper for checkboxes
function rise_old_checked($key, $value) {
    global $stored_data;
    if (isset($stored_data[$key]) && is_array($stored_data[$key])) {
        return in_array($value, $stored_data[$key]) ? 'checked' : '';
    }
    return '';
}
?>

<div class="registration-form-container max-w-4xl mx-auto">
    
    <?php if (isset($_GET['submission']) && $_GET['submission'] === 'success'): ?>
        <!-- Success Message -->
        <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg mb-8">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-check-circle text-green-500 text-2xl mt-1"></i>
                <div>
                    <h3 class="font-sans font-bold text-green-800 text-lg mb-2">
                        <?php _e('Thank You for Your Interest!', 'rise-ai-summit'); ?>
                    </h3>
                    <p class="text-green-700 text-sm">
                        <?php _e('We have registered your interest. You will receive updates about registration opening and event details.', 'rise-ai-summit'); ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($errors)): ?>
        <!-- Error Messages -->
        <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg mb-8">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-exclamation-triangle text-red-500 text-2xl mt-1"></i>
                <div>
                    <h3 class="font-sans font-bold text-red-800 text-lg mb-2">
                        <?php _e('Please fix the following errors:', 'rise-ai-summit'); ?>
                    </h3>
                    <ul class="list-disc pl-5 text-sm text-red-700 space-y-1">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo esc_html($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <form id="registration-form" method="post" class="space-y-8">
        <?php wp_nonce_field('register_interest', 'registration_nonce'); ?>
        
        <!-- SECTION 1: ATTENDEE INFORMATION -->
        <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
            <h3 class="font-sans font-bold text-xl text-nd-navy mb-6 pb-3 border-b border-gray-200 flex items-center gap-2">
                <i class="fa-solid fa-user text-uandes-red"></i>
                <?php _e('Attendee Information', 'rise-ai-summit'); ?>
            </h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="full_name" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Full Name', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="full_name" 
                           name="full_name" 
                           value="<?php echo rise_old_reg('full_name'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Email', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="<?php echo rise_old_reg('email'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Phone', 'rise-ai-summit'); ?>
                    </label>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           value="<?php echo rise_old_reg('phone'); ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="institution" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Institution/Organization', 'rise-ai-summit'); ?>
                    </label>
                    <input type="text" 
                           id="institution" 
                           name="institution" 
                           value="<?php echo rise_old_reg('institution'); ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="country" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Country', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <select id="country" 
                            name="country" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                        <option value=""><?php _e('Select Country', 'rise-ai-summit'); ?></option>
                        <option value="Argentina">Argentina</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Chile" <?php selected(rise_old_reg('country'), 'Chile'); ?>>Chile</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Mexico">Mexico</option>
                        <option value="United States">United States</option>
                        <option value="Canada">Canada</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- SECTION 2: ATTENDEE TYPE & INTERESTS -->
        <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
            <h3 class="font-sans font-bold text-xl text-nd-navy mb-6 pb-3 border-b border-gray-200 flex items-center gap-2">
                <i class="fa-solid fa-star text-uandes-red"></i>
                <?php _e('Your Interests', 'rise-ai-summit'); ?>
            </h3>
            
            <!-- Attendee Type -->
            <div class="mb-6">
                <label for="attendee_type" class="block text-sm font-bold text-gray-700 mb-2">
                    <?php _e('Attendee Type', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                </label>
                <select id="attendee_type" 
                        name="attendee_type" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                    <option value=""><?php _e('Select...', 'rise-ai-summit'); ?></option>
                    <option value="academic" <?php selected(rise_old_reg('attendee_type'), 'academic'); ?>><?php _e('Academic/Researcher', 'rise-ai-summit'); ?></option>
                    <option value="industry" <?php selected(rise_old_reg('attendee_type'), 'industry'); ?>><?php _e('Industry Professional', 'rise-ai-summit'); ?></option>
                    <option value="student" <?php selected(rise_old_reg('attendee_type'), 'student'); ?>><?php _e('Student', 'rise-ai-summit'); ?></option>
                    <option value="government" <?php selected(rise_old_reg('attendee_type'), 'government'); ?>><?php _e('Government/Policy', 'rise-ai-summit'); ?></option>
                    <option value="other" <?php selected(rise_old_reg('attendee_type'), 'other'); ?>><?php _e('Other', 'rise-ai-summit'); ?></option>
                </select>
            </div>
            
            <!-- Areas of Interest -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-3">
                    <?php _e('Areas of Interest', 'rise-ai-summit'); ?>
                </label>
                <div class="space-y-3">
                    <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-nd-navy transition">
                        <input type="checkbox" name="interests[]" value="business" <?php echo rise_old_checked('interests', 'business'); ?> class="mt-1">
                        <div>
                            <span class="font-bold text-nd-navy"><?php _e('Business Track', 'rise-ai-summit'); ?></span>
                            <p class="text-sm text-gray-600"><?php _e('AI strategy, governance, and business applications', 'rise-ai-summit'); ?></p>
                        </div>
                    </label>
                    
                    <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-nd-gold transition">
                        <input type="checkbox" name="interests[]" value="education" <?php echo rise_old_checked('interests', 'education'); ?> class="mt-1">
                        <div>
                            <span class="font-bold text-nd-gold"><?php _e('Education Track', 'rise-ai-summit'); ?></span>
                            <p class="text-sm text-gray-600"><?php _e('AI in education, skills development, and policy', 'rise-ai-summit'); ?></p>
                        </div>
                    </label>
                    
                    <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-uandes-red transition">
                        <input type="checkbox" name="interests[]" value="science" <?php echo rise_old_checked('interests', 'science'); ?> class="mt-1">
                        <div>
                            <span class="font-bold text-uandes-red"><?php _e('Applied Science Track', 'rise-ai-summit'); ?></span>
                            <p class="text-sm text-gray-600"><?php _e('Health applications and engineering innovation', 'rise-ai-summit'); ?></p>
                        </div>
                    </label>
                </div>
            </div>
            
            <!-- How Did You Hear -->
            <div>
                <label for="how_heard" class="block text-sm font-bold text-gray-700 mb-2">
                    <?php _e('How did you hear about us?', 'rise-ai-summit'); ?>
                </label>
                <select id="how_heard" 
                        name="how_heard"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                    <option value=""><?php _e('Select...', 'rise-ai-summit'); ?></option>
                    <option value="social"><?php _e('Social Media', 'rise-ai-summit'); ?></option>
                    <option value="colleague"><?php _e('Colleague/Friend', 'rise-ai-summit'); ?></option>
                    <option value="email"><?php _e('Email Newsletter', 'rise-ai-summit'); ?></option>
                    <option value="university"><?php _e('University Announcement', 'rise-ai-summit'); ?></option>
                    <option value="website"><?php _e('Website/Google Search', 'rise-ai-summit'); ?></option>
                    <option value="other"><?php _e('Other', 'rise-ai-summit'); ?></option>
                </select>
            </div>
        </div>
        
        <!-- SECTION 3: NEWSLETTER & SUBMIT -->
        <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
            <label class="flex items-start gap-3 cursor-pointer mb-6">
                <input type="checkbox" name="newsletter" value="yes" class="mt-1">
                <span class="text-sm text-gray-700">
                    <?php _e('Subscribe to our newsletter for updates about the summit, speakers, and registration.', 'rise-ai-summit'); ?>
                </span>
            </label>
            
            <button type="submit" 
                    name="submit_registration"
                    class="w-full bg-uandes-red hover:bg-red-700 text-white font-bold py-4 px-6 rounded-lg transition duration-300 shadow-lg flex items-center justify-center gap-3 text-lg">
                <i class="fa-solid fa-user-check"></i>
                <?php _e('Register Interest', 'rise-ai-summit'); ?>
            </button>
            
            <p class="text-xs text-center text-gray-500 mt-4">
                <?php _e('This is not a confirmed registration. Official registration will open in March 2026.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </form>
</div>