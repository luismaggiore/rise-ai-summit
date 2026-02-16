/**
 * RISE AI Summit - Main JavaScript
 * WordPress version (NO tabs, NO manual translation)
 */

(function() {
    'use strict';
    
    /**
     * =================================================================
     * SMOOTH SCROLL FOR ANCHOR LINKS
     * =================================================================
     */
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '#!') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    });
    
    /**
     * =================================================================
     * MOBILE MENU TOGGLE
     * =================================================================
     */
    window.toggleMobileMenu = function() {
        const menu = document.getElementById('mobile-menu');
        if (menu) {
            menu.classList.toggle('hidden');
        }
    };
    
    /**
     * =================================================================
     * CLOSE MOBILE MENU ON WINDOW RESIZE
     * =================================================================
     */
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth >= 768) {
                const menu = document.getElementById('mobile-menu');
                if (menu && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            }
        }, 250);
    });
    
    /**
     * =================================================================
     * ACCESSIBILITY: ESC KEY TO CLOSE MOBILE MENU
     * =================================================================
     */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const menu = document.getElementById('mobile-menu');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        }
    });
    
    /**
     * =================================================================
     * HEADER SHADOW ON SCROLL
     * =================================================================
     */
    document.addEventListener('DOMContentLoaded', function() {
        const nav = document.querySelector('nav');
        if (nav) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    nav.classList.add('shadow-xl');
                } else {
                    nav.classList.remove('shadow-xl');
                }
            });
        }
    });
    
    /**
     * =================================================================
     * LAZY LOAD IMAGES (if not using native lazy loading)
     * =================================================================
     */
    document.addEventListener('DOMContentLoaded', function() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        } else {
            // Fallback for older browsers
            lazyImages.forEach(function(img) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            });
        }
    });
    
    /**
     * =================================================================
     * EXTERNAL LINKS OPEN IN NEW TAB
     * =================================================================
     */
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('a[href^="http"]');
        const host = window.location.hostname;
        
        links.forEach(function(link) {
            if (link.hostname !== host) {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');
            }
        });
    });
    
})();