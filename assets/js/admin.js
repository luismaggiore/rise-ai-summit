/**
 * RISE AI Summit - Admin JavaScript
 * For metaboxes and admin pages
 */

(function($) {
    'use strict';
    
    /**
     * =================================================================
     * MEDIA UPLOADER FOR METABOXES
     * =================================================================
     */
    function initMediaUploader() {
        $('.rise-upload-button').on('click', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const inputField = button.siblings('.rise-media-id');
            const previewContainer = button.siblings('.rise-media-preview');
            
            const mediaUploader = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Use This Image'
                },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                const attachment = mediaUploader.state().get('selection').first().toJSON();
                inputField.val(attachment.id);
                
                if (previewContainer.length) {
                    previewContainer.html('<img src="' + attachment.url + '" style="max-width: 100%;">');
                }
            });
            
            mediaUploader.open();
        });
        
        // Remove media
        $('.rise-remove-button').on('click', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const inputField = button.siblings('.rise-media-id');
            const previewContainer = button.siblings('.rise-media-preview');
            
            inputField.val('');
            previewContainer.html('');
        });
    }
    
    /**
     * =================================================================
     * REPEATER FIELDS
     * =================================================================
     */
    function initRepeaterFields() {
        $('.rise-repeater-add').on('click', function(e) {
            e.preventDefault();
            
            const wrapper = $(this).closest('.rise-repeater-wrapper');
            const template = wrapper.find('.rise-repeater-item:first').clone();
            
            // Clear values
            template.find('input, textarea, select').val('');
            
            // Update name attributes with new index
            const items = wrapper.find('.rise-repeater-item');
            const newIndex = items.length;
            
            template.find('input, textarea, select').each(function() {
                const name = $(this).attr('name');
                if (name) {
                    const newName = name.replace(/\[\d+\]/, '[' + newIndex + ']');
                    $(this).attr('name', newName);
                }
            });
            
            template.insertBefore($(this));
        });
        
        // Remove repeater item
        $(document).on('click', '.rise-repeater-remove', function(e) {
            e.preventDefault();
            
            const wrapper = $(this).closest('.rise-repeater-wrapper');
            const items = wrapper.find('.rise-repeater-item');
            
            // Don't remove if only one item
            if (items.length > 1) {
                $(this).closest('.rise-repeater-item').remove();
            } else {
                alert('At least one item is required');
            }
        });
    }
    
    /**
     * =================================================================
     * COLOR PICKER
     * =================================================================
     */
    function initColorPicker() {
        if ($.fn.wpColorPicker) {
            $('.rise-color-picker').wpColorPicker();
        }
    }
    
    /**
     * =================================================================
     * TABS INTERFACE
     * =================================================================
     */
    function initTabs() {
        $('.rise-metabox-tabs button').on('click', function() {
            const tab = $(this).data('tab');
            
            // Update active tab button
            $('.rise-metabox-tabs button').removeClass('active');
            $(this).addClass('active');
            
            // Update active tab content
            $('.rise-tab-content').removeClass('active');
            $('#' + tab).addClass('active');
        });
    }
    
    /**
     * =================================================================
     * CONDITIONAL FIELDS
     * =================================================================
     */
    function initConditionalFields() {
        $('[data-condition]').each(function() {
            const field = $(this);
            const condition = field.data('condition');
            const conditionField = $('#' + condition.field);
            
            function checkCondition() {
                const value = conditionField.val();
                if (value === condition.value) {
                    field.show();
                } else {
                    field.hide();
                }
            }
            
            conditionField.on('change', checkCondition);
            checkCondition(); // Initial check
        });
    }
    
    /**
     * =================================================================
     * SORTABLE ITEMS
     * =================================================================
     */
    function initSortable() {
        if ($.fn.sortable) {
            $('.rise-sortable').sortable({
                handle: '.sort-handle',
                axis: 'y',
                opacity: 0.7,
                cursor: 'move',
                update: function(event, ui) {
                    // Update order input values
                    $(this).find('.rise-repeater-item').each(function(index) {
                        $(this).find('.item-order').val(index);
                    });
                }
            });
        }
    }
    
    /**
     * =================================================================
     * CONFIRM BEFORE DELETE
     * =================================================================
     */
    function initDeleteConfirmation() {
        $('.submitdelete').on('click', function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
                return false;
            }
        });
    }
    
    /**
     * =================================================================
     * AUTO-SAVE DRAFT INDICATOR
     * =================================================================
     */
    function initAutoSaveIndicator() {
        $(document).on('heartbeat-tick.autosave', function(event, data) {
            if (data['wp-refresh-post-nonces']) {
                $('.autosave-message').fadeIn().delay(2000).fadeOut();
            }
        });
    }
    
    /**
     * =================================================================
     * INITIALIZE ALL ON DOCUMENT READY
     * =================================================================
     */
    $(document).ready(function() {
        initMediaUploader();
        initRepeaterFields();
        initColorPicker();
        initTabs();
        initConditionalFields();
        initSortable();
        initDeleteConfirmation();
        initAutoSaveIndicator();
    });
    
})(jQuery);

/**
 * ===================================
 * HOME PAGE - HERO IMAGE UPLOADER
 * ===================================
 */

jQuery(document).ready(function ($) {

    var mediaUploader;

    // Upload button
    $('.upload-hero-image').on('click', function (e) {
        e.preventDefault();

        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Extend the wp.media object
        mediaUploader = wp.media({
            title: 'Choose Hero Banner Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        // When a file is selected, grab the URL and set it
        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#home_hero_image_override').val(attachment.id);

            // Update preview
            var imgHtml = '<div style="margin-bottom: 10px;"><img src="' + attachment.url + '" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 4px;"></div>';
            $('.home-hero-image-wrapper').prepend(imgHtml);

            // Change button text
            $('.upload-hero-image').text('Change Image');

            // Show remove button if not already there
            if (!$('.remove-hero-image').length) {
                $('.upload-hero-image').after('<button type="button" class="button remove-hero-image">Remove Image</button>');
            }
        });

        // Open the uploader dialog
        mediaUploader.open();
    });

    // Remove button
    $(document).on('click', '.remove-hero-image', function (e) {
        e.preventDefault();

        $('#home_hero_image_override').val('');
        $('.home-hero-image-wrapper img').parent().remove();
        $('.upload-hero-image').text('Upload Image');
        $(this).remove();
    });

});