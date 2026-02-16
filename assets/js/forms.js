/**
 * RISE AI Summit - Form Validation & Enhancement
 */

(function ($) {
    'use strict';

    /**
     * =================================================================
     * WORD COUNTER FOR TEXTAREA
     * =================================================================
     */
    function initWordCounter() {
        const textareas = document.querySelectorAll('textarea[data-max-words]');

        textareas.forEach(function (textarea) {
            const maxWords = parseInt(textarea.dataset.maxWords);
            const counterEl = document.createElement('span');
            counterEl.className = 'word-count';
            counterEl.textContent = '0 / ' + maxWords + ' words';

            textarea.parentNode.insertBefore(counterEl, textarea.nextSibling);

            textarea.addEventListener('input', function () {
                const text = this.value.trim();
                const wordCount = text === '' ? 0 : text.split(/\s+/).length;

                counterEl.textContent = wordCount + ' / ' + maxWords + ' words';

                // Remove previous state classes
                counterEl.classList.remove('warning', 'error');

                if (wordCount > maxWords) {
                    counterEl.classList.add('error');
                } else if (wordCount > maxWords * 0.9) {
                    counterEl.classList.add('warning');
                }
            });
        });
    }

    /**
     * =================================================================
     * FORM VALIDATION
     * =================================================================
     */
    function validateForm(form) {
        let isValid = true;
        const errors = [];

        // Clear previous errors
        form.querySelectorAll('.field-error').forEach(function (field) {
            field.classList.remove('field-error');
        });

        form.querySelectorAll('.error-message').forEach(function (msg) {
            msg.remove();
        });

        // Required fields
        form.querySelectorAll('[required]').forEach(function (field) {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('field-error');
                showError(field, riseTranslations.required || 'This field is required');
            }
        });

        // Email validation
        form.querySelectorAll('input[type="email"]').forEach(function (field) {
            if (field.value && !isValidEmail(field.value)) {
                isValid = false;
                field.classList.add('field-error');
                showError(field, riseTranslations.invalidEmail || 'Invalid email address');
            }
        });

        // File validation
        form.querySelectorAll('input[type="file"]').forEach(function (field) {
            const file = field.files[0];
            if (file) {
                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    isValid = false;
                    field.classList.add('field-error');
                    showError(field, riseTranslations.fileTooLarge || 'File size exceeds 5MB');
                }

                // Check file type (PDF only)
                if (field.accept === '.pdf' && file.type !== 'application/pdf') {
                    isValid = false;
                    field.classList.add('field-error');
                    showError(field, riseTranslations.invalidFileType || 'Please upload a PDF file');
                }
            }
        });

        // Word count validation
        form.querySelectorAll('textarea[data-max-words]').forEach(function (field) {
            const maxWords = parseInt(field.dataset.maxWords);
            const text = field.value.trim();
            const wordCount = text === '' ? 0 : text.split(/\s+/).length;

            if (wordCount > maxWords) {
                isValid = false;
                field.classList.add('field-error');
                showError(field, 'Maximum ' + maxWords + ' words allowed');
            }
        });

        return isValid;
    }

    /**
     * Show error message below field
     */
    function showError(field, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        field.parentNode.insertBefore(errorDiv, field.nextSibling);
    }

    /**
     * Email validation
     */
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    /**
     * =================================================================
     * FILE UPLOAD PREVIEW
     * =================================================================
     */
    function initFilePreview() {
        document.querySelectorAll('input[type="file"]').forEach(function (input) {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const preview = document.createElement('div');
                    preview.className = 'file-preview text-sm text-gray-600 mt-2';
                    preview.innerHTML = '<i class="fa-solid fa-file-pdf text-uandes-red mr-2"></i>' +
                        file.name + ' (' + formatFileSize(file.size) + ')';

                    // Remove old preview if exists
                    const oldPreview = this.parentNode.querySelector('.file-preview');
                    if (oldPreview) {
                        oldPreview.remove();
                    }

                    this.parentNode.insertBefore(preview, this.nextSibling);
                }
            });
        });
    }

    /**
     * Format file size
     */
    function formatFileSize(bytes) {
        if (bytes >= 1048576) {
            return (bytes / 1048576).toFixed(2) + ' MB';
        } else if (bytes >= 1024) {
            return (bytes / 1024).toFixed(2) + ' KB';
        } else {
            return bytes + ' bytes';
        }
    }

    /**
     * =================================================================
     * FORM SUBMISSION WITH LOADING STATE
     * =================================================================
     */
    function initFormSubmission() {
        document.querySelectorAll('form.rise-form').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                if (!validateForm(form)) {
                    e.preventDefault();

                    // Scroll to first error
                    const firstError = form.querySelector('.field-error');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstError.focus();
                    }

                    return false;
                }

                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('form-loading');
                    const originalText = submitBtn.textContent;
                    submitBtn.textContent = riseTranslations.loading || 'Loading...';

                    // Store original text to restore on error
                    submitBtn.dataset.originalText = originalText;
                }
            });
        });
    }

    /**
     * =================================================================
     * CO-AUTHORS REPEATER (for abstract form)
     * =================================================================
     */
    function initCoauthorsRepeater() {
        const container = document.getElementById('coauthors-container');
        if (!container) return;

        const addBtn = document.getElementById('add-coauthor');
        let coauthorCount = 0;

        if (addBtn) {
            addBtn.addEventListener('click', function () {
                coauthorCount++;
                const coauthorHTML = `
                    <div class="coauthor-item border border-gray-200 p-4 rounded mb-4 relative">
                        <button type="button" class="remove-coauthor absolute top-2 right-2 text-red-600 hover:text-red-800">
                            <i class="fa-solid fa-times"></i>
                        </button>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="coauthor_name[]" placeholder="Full Name" class="w-full p-2 border rounded">
                            <input type="email" name="coauthor_email[]" placeholder="Email" class="w-full p-2 border rounded">
                        </div>
                    </div>
                `;

                const div = document.createElement('div');
                div.innerHTML = coauthorHTML;
                container.insertBefore(div.firstElementChild, addBtn);

                // Bind remove button
                const removeBtn = container.querySelector('.coauthor-item:last-of-type .remove-coauthor');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function () {
                        this.closest('.coauthor-item').remove();
                    });
                }
            });
        }
    }

    /**
     * =================================================================
     * INITIALIZE ALL
     * =================================================================
     */
    document.addEventListener('DOMContentLoaded', function () {
        initWordCounter();
        initFilePreview();
        initFormSubmission();
        initCoauthorsRepeater();
    });

})(jQuery);