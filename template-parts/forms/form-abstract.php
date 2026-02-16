<?php
/**
 * Abstract Submission Form
 * 
 * @package RISE_AI_Summit
 */

// Get stored data if there was an error
$stored_data = get_transient('abstract_data_' . session_id());
$errors = get_transient('abstract_errors_' . session_id());

// Helper function to get old value
function rise_old($key, $default = '') {
    global $stored_data;
    return isset($stored_data[$key]) ? esc_attr($stored_data[$key]) : $default;
}
?>

<div class="abstract-form-container max-w-4xl mx-auto">
    
    <?php if (isset($_GET['submission']) && $_GET['submission'] === 'success'): ?>
        <!-- Success Message -->
        <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg mb-8">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-check-circle text-green-500 text-2xl mt-1"></i>
                <div>
                    <h3 class="font-sans font-bold text-green-800 text-lg mb-2">
                        <?php _e('Submission Successful!', 'rise-ai-summit'); ?>
                    </h3>
                    <p class="text-green-700 text-sm">
                        <?php _e('Your abstract has been received. You will receive a confirmation email shortly.', 'rise-ai-summit'); ?>
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
    
    <form id="abstract-submission-form" method="post" enctype="multipart/form-data" class="space-y-8">
        <?php wp_nonce_field('submit_abstract', 'abstract_nonce'); ?>
        
        <!-- SECTION 1: AUTHOR INFORMATION -->
        <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
            <h3 class="font-sans font-bold text-xl text-nd-navy mb-6 pb-3 border-b border-gray-200 flex items-center gap-2">
                <i class="fa-solid fa-user text-uandes-red"></i>
                <?php _e('Author Information', 'rise-ai-summit'); ?>
            </h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="author_first_name" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('First Name', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="author_first_name" 
                           name="author_first_name" 
                           value="<?php echo rise_old('author_first_name'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="author_last_name" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Last Name', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="author_last_name" 
                           name="author_last_name" 
                           value="<?php echo rise_old('author_last_name'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="author_email" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Email', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="author_email" 
                           name="author_email" 
                           value="<?php echo rise_old('author_email'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="author_phone" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Phone', 'rise-ai-summit'); ?>
                    </label>
                    <input type="tel" 
                           id="author_phone" 
                           name="author_phone" 
                           value="<?php echo rise_old('author_phone'); ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="author_institution" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Institution/Organization', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="author_institution" 
                           name="author_institution" 
                           value="<?php echo rise_old('author_institution'); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                </div>
                
                <div>
                    <label for="author_country" class="block text-sm font-bold text-gray-700 mb-2">
                        <?php _e('Country', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                    </label>
                    <select id="author_country" 
                            name="author_country" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                        <option value=""><?php _e('Select Country', 'rise-ai-summit'); ?></option>
                        <option value="Argentina">Argentina</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Chile" <?php selected(rise_old('author_country'), 'Chile'); ?>>Chile</option>
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
            
            <!-- Co-Authors (Dynamic) -->
            <div class="mt-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                <h4 class="font-sans font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-users text-gray-400"></i>
                    <?php _e('Co-Authors (Optional)', 'rise-ai-summit'); ?>
                </h4>
                <p class="text-sm text-gray-600 mb-4">
                    <?php _e('Add co-authors if this is collaborative work.', 'rise-ai-summit'); ?>
                </p>
                
                <div id="coauthors-container" class="space-y-4">
                    <!-- Co-authors will be added here dynamically -->
                </div>
                
                <button type="button" 
                        id="add-coauthor" 
                        class="mt-4 text-uandes-red font-bold text-sm flex items-center gap-2 hover:text-nd-navy transition">
                    <i class="fa-solid fa-plus-circle"></i>
                    <?php _e('Add Co-Author', 'rise-ai-summit'); ?>
                </button>
            </div>
        </div>
        
        <!-- SECTION 2: SUBMISSION DETAILS -->
        <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
            <h3 class="font-sans font-bold text-xl text-nd-navy mb-6 pb-3 border-b border-gray-200 flex items-center gap-2">
                <i class="fa-solid fa-file-alt text-uandes-red"></i>
                <?php _e('Submission Details', 'rise-ai-summit'); ?>
            </h3>
            
            <!-- Track Selection -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-3">
                    <?php _e('Conference Track', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                </label>
                <div class="space-y-3">
                    <label class="flex items-start gap-3 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-nd-navy transition">
                        <input type="radio" name="track" value="business" required class="mt-1">
                        <div>
                            <span class="font-bold text-nd-navy"><?php _e('Business: Strategy & Governance', 'rise-ai-summit'); ?></span>
                            <p class="text-sm text-gray-600 mt-1"><?php _e('AI strategy, deployment, governance, risk management', 'rise-ai-summit'); ?></p>
                        </div>
                    </label>
                    
                    <label class="flex items-start gap-3 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-nd-gold transition">
                        <input type="radio" name="track" value="education" required class="mt-1">
                        <div>
                            <span class="font-bold text-nd-gold"><?php _e('Education: Policy & Skills', 'rise-ai-summit'); ?></span>
                            <p class="text-sm text-gray-600 mt-1"><?php _e('AI literacy, teaching augmentation, institutional strategy', 'rise-ai-summit'); ?></p>
                        </div>
                    </label>
                    
                    <label class="flex items-start gap-3 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-uandes-red transition">
                        <input type="radio" name="track" value="science" required class="mt-1">
                        <div>
                            <span class="font-bold text-uandes-red"><?php _e('Applied Science: Health & Engineering', 'rise-ai-summit'); ?></span>
                            <p class="text-sm text-gray-600 mt-1"><?php _e('Health applications, translational research, data-intensive systems', 'rise-ai-summit'); ?></p>
                        </div>
                    </label>
                </div>
            </div>
            
            <!-- Title -->
            <div class="mb-6">
                <label for="abstract_title" class="block text-sm font-bold text-gray-700 mb-2">
                    <?php _e('Presentation Title', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="abstract_title" 
                       name="abstract_title" 
                       value="<?php echo rise_old('abstract_title'); ?>"
                       maxlength="150"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1"><?php _e('Maximum 150 characters', 'rise-ai-summit'); ?></p>
            </div>
            
            <!-- Abstract Content -->
            <div class="mb-6">
                <label for="abstract_content" class="block text-sm font-bold text-gray-700 mb-2">
                    <?php _e('Abstract', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                </label>
                <textarea id="abstract_content" 
                          name="abstract_content" 
                          rows="12"
                          required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent font-serif"><?php echo rise_old('abstract_content'); ?></textarea>
                <div class="flex justify-between items-center mt-2">
                    <p class="text-xs text-gray-500"><?php _e('Maximum 500 words', 'rise-ai-summit'); ?></p>
                    <span id="word-count" class="text-sm font-bold text-gray-600">0 / 500 <?php _e('words', 'rise-ai-summit'); ?></span>
                </div>
            </div>
            
            <!-- Keywords -->
            <div class="mb-6">
                <label for="keywords" class="block text-sm font-bold text-gray-700 mb-2">
                    <?php _e('Keywords', 'rise-ai-summit'); ?>
                </label>
                <input type="text" 
                       id="keywords" 
                       name="keywords" 
                       value="<?php echo rise_old('keywords'); ?>"
                       placeholder="<?php esc_attr_e('e.g., machine learning, ethics, governance', 'rise-ai-summit'); ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1"><?php _e('Comma-separated, maximum 5 keywords', 'rise-ai-summit'); ?></p>
            </div>
            
            <!-- File Upload -->
            <div class="mb-6">
                <label for="abstract_file" class="block text-sm font-bold text-gray-700 mb-2">
                    <?php _e('Supporting Document (PDF)', 'rise-ai-summit'); ?>
                </label>
                <input type="file" 
                       id="abstract_file" 
                       name="abstract_file" 
                       accept=".pdf"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1"><?php _e('Optional. PDF format, maximum 5MB', 'rise-ai-summit'); ?></p>
            </div>
            
            <!-- Presenter -->
            <div class="mb-6">
                <label for="presenter" class="block text-sm font-bold text-gray-700 mb-2">
                    <?php _e('Who will present this work?', 'rise-ai-summit'); ?> <span class="text-red-500">*</span>
                </label>
                <select id="presenter" 
                        name="presenter" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-uandes-red focus:border-transparent">
                    <option value=""><?php _e('Select...', 'rise-ai-summit'); ?></option>
                    <option value="primary"><?php _e('Primary Author (me)', 'rise-ai-summit'); ?></option>
                    <option value="coauthor"><?php _e('Co-Author', 'rise-ai-summit'); ?></option>
                </select>
            </div>
        </div>
        
        <!-- SECTION 3: CONSENT & SUBMIT -->
        <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
            <div class="space-y-4">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="consent" required class="mt-1">
                    <span class="text-sm text-gray-700">
                        <?php _e('I agree to the double-blind peer review process and understand that my abstract may be rejected.', 'rise-ai-summit'); ?> 
                        <span class="text-red-500">*</span>
                    </span>
                </label>
                
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="code_of_conduct" required class="mt-1">
                    <span class="text-sm text-gray-700">
                        <?php _e('I agree to abide by the conference Code of Conduct.', 'rise-ai-summit'); ?> 
                        <span class="text-red-500">*</span>
                    </span>
                </label>
            </div>
            
            <button type="submit" 
                    name="submit_abstract"
                    class="w-full mt-8 bg-uandes-red hover:bg-red-700 text-white font-bold py-4 px-6 rounded-lg transition duration-300 shadow-lg flex items-center justify-center gap-3 text-lg">
                <i class="fa-solid fa-paper-plane"></i>
                <?php _e('Submit Abstract', 'rise-ai-summit'); ?>
            </button>
            
            <p class="text-xs text-center text-gray-500 mt-4">
                <?php _e('By submitting, you agree that at least one author will register for the conference if accepted.', 'rise-ai-summit'); ?>
            </p>
        </div>
    </form>
</div>

<script>
// Word counter
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('abstract_content');
    const counter = document.getElementById('word-count');
    
    function updateWordCount() {
        const text = textarea.value.trim();
        const words = text ? text.split(/\s+/).length : 0;
        counter.textContent = words + ' / 500 <?php _e('words', 'rise-ai-summit'); ?>';
        
        if (words > 500) {
            counter.classList.add('text-red-500');
            counter.classList.remove('text-gray-600');
        } else {
            counter.classList.remove('text-red-500');
            counter.classList.add('text-gray-600');
        }
    }
    
    textarea.addEventListener('input', updateWordCount);
    updateWordCount();
    
    // Co-author functionality
    let coauthorCount = 0;
    const addButton = document.getElementById('add-coauthor');
    const container = document.getElementById('coauthors-container');
    
    addButton.addEventListener('click', function() {
        if (coauthorCount >= 5) {
            alert('<?php _e('Maximum 5 co-authors allowed', 'rise-ai-summit'); ?>');
            return;
        }
        
        coauthorCount++;
        const coauthorHtml = `
            <div class="coauthor-item grid md:grid-cols-3 gap-4 p-4 bg-white border border-gray-200 rounded-lg">
                <input type="text" name="coauthor_name[]" placeholder="<?php esc_attr_e('Name', 'rise-ai-summit'); ?>" class="px-3 py-2 border border-gray-300 rounded">
                <input type="email" name="coauthor_email[]" placeholder="<?php esc_attr_e('Email', 'rise-ai-summit'); ?>" class="px-3 py-2 border border-gray-300 rounded">
                <div class="flex gap-2">
                    <input type="text" name="coauthor_institution[]" placeholder="<?php esc_attr_e('Institution', 'rise-ai-summit'); ?>" class="flex-1 px-3 py-2 border border-gray-300 rounded">
                    <button type="button" class="remove-coauthor text-red-500 hover:text-red-700 px-3">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', coauthorHtml);
    });
    
    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-coauthor')) {
            e.target.closest('.coauthor-item').remove();
            coauthorCount--;
        }
    });
});
</script>