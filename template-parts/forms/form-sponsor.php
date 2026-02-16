<?php
/**
 * Sponsor Inquiry Form
 * 
 * @package RISE_AI_Summit
 */

// Get stored data if there was an error
$stored_data = get_transient('sponsor_data_' . session_id());
$errors = get_transient('sponsor_errors_' . session_id());

// Helper function to get old value
function rise_old_sponsor($key, $default = '') {
    global $stored_data;
    return isset($stored_data[$key]) ? esc_attr($stored_data[$key]) : $default;
}
?>

<div class="sponsor-form-container max-w-4xl mx-auto">
    
    <?php if (isset($_GET['submission']) && $_GET['submission'] === 'success'): ?>
        <!-- Success Message -->
        <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg mb-8">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-check-circle text-green-500 text-2xl mt-1"></i>
                <div>
                    <h3 class="font-sans font-bold text-green-800 text-lg mb-2">
                        <?php _e('Inquiry Received!', 'rise-ai-summit'); ?>
                    </h3>
                    <p class="text-green-700 text-sm">
                        <?php _e('Thank you for your interest in sponsoring RISE AI Summit. Our team will contact you within 48 hours.', 'rise-ai-summit'); ?>
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
    
    <form id="sponsor-inquiry-form" method="post" class="space-y-8">
        <?php wp_nonce_field('sponsor_inquiry', 'sponsor_nonce'); ?>
        
        <!-- SECTION 1: COMPANY INFORMATION -->
        <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
            <h3 class="font-sans font-bold text-xl text-nd-navy mb-6 pb-3 border-b border-gray-200 flex items-center gap-2">
                <i class="fa-solid fa-building text-uandes-red"></i>
                <?php _e('Company Information', 'rise-ai-summit'); ?>
            </h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="company_name" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Company Name', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="company_name" 
                           name="company_name" 
                           value="<?php echo rise_old_sponsor('company_name'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="industry" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Industry/Sector', 'rise-ai-summit'); ?>
                    </label>
                    <select id="industry" 
                            name="industry"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                        <option value=""><?php _e('Select...', 'rise-ai-summit'); ?></option>
                        <option value="technology" <?php selected(rise_old_sponsor('industry'), 'technology'); ?>><?php _e('Technology', 'rise-ai-summit'); ?></option>
                        <option value="finance" <?php selected(rise_old_sponsor('industry'), 'finance'); ?>><?php _e('Finance/Banking', 'rise-ai-summit'); ?></option>
                        <option value="healthcare" <?php selected(rise_old_sponsor('industry'), 'healthcare'); ?>><?php _e('Healthcare', 'rise-ai-summit'); ?></option>
                        <option value="education" <?php selected(rise_old_sponsor('industry'), 'education'); ?>><?php _e('Education', 'rise-ai-summit'); ?></option>
                        <option value="consulting" <?php selected(rise_old_sponsor('industry'), 'consulting'); ?>><?php _e('Consulting', 'rise-ai-summit'); ?></option>
                        <option value="manufacturing" <?php selected(rise_old_sponsor('industry'), 'manufacturing'); ?>><?php _e('Manufacturing', 'rise-ai-summit'); ?></option>
                        <option value="other" <?php selected(rise_old_sponsor('industry'), 'other'); ?>><?php _e('Other', 'rise-ai-summit'); ?></option>
                    </select>
                </div>
                
                <div class="md:col-span-2">
                    <label for="website" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Website URL', 'rise-ai-summit'); ?>
                    </label>
                    <input type="url" 
                           id="website" 
                           name="website" 
                           value="<?php echo rise_old_sponsor('website'); ?>"
                           placeholder="https://"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
            </div>
        </div>
        
        <!-- SECTION 2: CONTACT PERSON -->
        <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
            <h3 class="font-sans font-bold text-xl text-nd-navy mb-6 pb-3 border-b border-gray-200 flex items-center gap-2">
                <i class="fa-solid fa-user-tie text-uandes-red"></i>
                <?php _e('Contact Person', 'rise-ai-summit'); ?>
            </h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="contact_name" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Full Name', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="contact_name" 
                           name="contact_name" 
                           value="<?php echo rise_old_sponsor('contact_name'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="contact_title" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Title/Position', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="contact_title" 
                           name="contact_title" 
                           value="<?php echo rise_old_sponsor('contact_title'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="contact_email" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Email', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="contact_email" 
                           name="contact_email" 
                           value="<?php echo rise_old_sponsor('contact_email'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="contact_phone" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Phone', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" 
                           id="contact_phone" 
                           name="contact_phone" 
                           value="<?php echo rise_old_sponsor('contact_phone'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
            </div>
        </div>
        
        <!-- SECTION 3: YOUR INQUIRY -->
        <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
            <h3 class="font-sans font-bold text-xl text-nd-navy mb-6 pb-3 border-b border-gray-200 flex items-center gap-2">
                <i class="fa-solid fa-envelope text-uandes-red"></i>
                <?php _e('Your Inquiry', 'rise-ai-summit'); ?>
            </h3>
            
            <div class="mb-6">
                <label for="message" class="block text-sm font-bold text-gray-700 mb-2">
                    <?php _e('Message', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                </label>
                <textarea id="message" 
                          name="message" 
                          rows="8"
                          required
                          placeholder="<?php esc_attr_e('Tell us about your sponsorship interest, budget range, and any specific questions...', 'rise-ai-summit'); ?>"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent font-serif"><?php echo rise_old_sponsor('message'); ?></textarea>
            </div>
            
            <div>
                <label for="how_heard" class="block text-sm font-bold text-gray-700 mb-2">
                    <?php _e('How did you hear about us?', 'rise-ai-summit'); ?>
                </label>
                <select id="how_heard" 
                        name="how_heard"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                    <option value=""><?php _e('Select...', 'rise-ai-summit'); ?></option>
                    <option value="social"><?php _e('Social Media', 'rise-ai-summit'); ?></option>
                    <option value="colleague"><?php _e('Colleague/Partner', 'rise-ai-summit'); ?></option>
                    <option value="email"><?php _e('Email Outreach', 'rise-ai-summit'); ?></option>
                    <option value="website"><?php _e('Website/Google Search', 'rise-ai-summit'); ?></option>
                    <option value="event"><?php _e('Previous Event/Conference', 'rise-ai-summit'); ?></option>
                    <option value="other"><?php _e('Other', 'rise-ai-summit'); ?></option>
                </select>
            </div>
        </div>
        
        <!-- SUBMIT -->
        <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
            <button type="submit" 
                    name="submit_sponsor_inquiry"
                    class="w-full bg-nd-navy hover:bg-uandes-red text-white font-bold py-4 px-6 rounded-lg transition duration-300 shadow-lg flex items-center justify-center gap-3 text-lg">
                <i class="fa-solid fa-paper-plane"></i>
                <?php _e('Send Inquiry', 'rise-ai-summit'); ?>
            </button>
            
            <p class="text-xs text-center text-gray-500 mt-4">
                <?php _e('Our sponsorship team will respond within 48 hours with detailed package information.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </form>
</div>