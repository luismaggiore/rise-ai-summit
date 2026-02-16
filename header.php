<?php
/**
 * The header for RISE AI Summit theme
 * WordPress version - NO manual language toggle
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class('font-serif text-uandes-dark antialiased bg-white flex flex-col min-h-screen'); ?>>
<?php wp_body_open(); ?>

<!-- Skip to content link for accessibility -->
<a href="#main-content" class="skip-link screen-reader-text">
    <?php _e('Skip to content', 'rise-ai-summit'); ?>
</a>

<!-- BARRA SUPERIOR INSTITUCIONAL (Co-Branding) -->
<div class="bg-white border-b border-gray-100 text-xs py-2">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center text-gray-600 font-sans">
        <span class="hidden md:inline italic text-gray-400">
            <?php _e('Advancing Responsible AI together', 'rise-ai-summit'); ?>
        </span>
        <div class="flex gap-6 font-semibold uppercase tracking-wider text-[10px] md:text-xs">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-nd-navy"></span>
                <span class="text-nd-navy font-bold">University of Notre Dame</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-uandes-red"></span>
                <span class="text-uandes-red font-bold">Universidad de los Andes</span>
            </div>
        </div>
        
        <!-- POLYLANG LANGUAGE SWITCHER -->
        <?php if (function_exists('pll_the_languages')) : ?>
            <div class="language-switcher flex items-center gap-2 text-nd-navy">
                <i class="fa-solid fa-globe"></i>
                <?php 
                pll_the_languages(array(
                    'dropdown'           => 0,
                    'show_names'         => 1,
                    'display_names_as'   => 'slug',
                    'show_flags'         => 0,
                    'hide_if_empty'      => 0,
                    'force_home'         => 0,
                    'echo'               => 1,
                    'hide_current'       => 0,
                ));
                ?>
            </div>
        <?php else : ?>
            <div class="text-gray-400 text-xs">
                <i class="fa-solid fa-globe"></i>
                <span>EN</span>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- NAVEGACIÓN PRINCIPAL -->
<nav class="bg-white sticky top-0 z-40 shadow-lg border-b-4 border-nd-gold">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Logo / Marca -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3 group">
                <div class="flex flex-col leading-none">
                    <span class="font-sans font-black text-2xl tracking-tighter text-nd-navy group-hover:text-uandes-red transition">
                        RISE AI
                    </span>
                    <span class="font-sans text-xs font-bold text-nd-gold tracking-widest uppercase">
                        South America
                    </span>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-2 lg:space-x-6 items-center font-sans font-bold text-xs lg:text-sm uppercase tracking-wide text-nd-navy">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(array(
                        'theme_location'  => 'primary',
                        'container'       => false,
                        'menu_class'      => 'flex space-x-2 lg:space-x-6 items-center',
                        'fallback_cb'     => false,
                    ));
                }
                
                // Fallback menu if no menu is assigned
                if (!has_nav_menu('primary')) {
                    $menu_items = array(
                        'about'      => __('About', 'rise-ai-summit'),
                        'tracks'     => __('Tracks', 'rise-ai-summit'),
                        'agenda'     => __('Agenda', 'rise-ai-summit'),
                        'speakers'   => __('Speakers', 'rise-ai-summit'),
                         'research'   => __('Research', 'rise-ai-summit'),
                        'committee'       => __('People', 'rise-ai-summit'),
                        'logistics'       => __('Logistics', 'rise-ai-summit'),                        
                                        'blog'       => __('Blog', 'rise-ai-summit'),       

                        );
                    
                    echo '<ul class="flex space-x-2 lg:space-x-6 items-center">';
                    foreach ($menu_items as $slug => $label) {
                        $url = home_url('/' . $slug . '/');
                        $current = (is_page($slug)) ? 'text-uandes-red' : '';
                        printf(
                            '<li><a href="%s" class="hover:text-uandes-red transition px-2 py-1 %s">%s</a></li>',
                            esc_url($url),
                            esc_attr($current),
                            esc_html($label)
                        );
                    }
                    echo '</ul>';
                }
                ?>
            </div>

            <!-- CTA Sponsors -->
            <div class="hidden md:block pl-2">
                <a href="<?php echo esc_url(home_url('/sponsorship/')); ?>" 
                   class="font-sans bg-uandes-red text-white px-5 py-2.5 rounded text-xs font-bold hover:bg-red-700 transition shadow-md uppercase tracking-wider">
                    <?php _e('Sponsor', 'rise-ai-summit'); ?>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button onclick="toggleMobileMenu()" 
                        class="text-nd-navy text-2xl focus:outline-none p-2"
                        aria-label="<?php esc_attr_e('Toggle mobile menu', 'rise-ai-summit'); ?>"
                        aria-expanded="false"
                        aria-controls="mobile-menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 font-sans shadow-xl absolute w-full z-50">
        <div class="px-6 pt-4 pb-6 space-y-3">
            <?php
            $mobile_menu_items = array(
                'about'      => __('About', 'rise-ai-summit'),
                'tracks'     => __('Tracks', 'rise-ai-summit'),
                'agenda'     => __('Agenda', 'rise-ai-summit'),
                'speakers'   => __('Speakers', 'rise-ai-summit'),
                'committee'       => __('People', 'rise-ai-summit'),
                'logistics'       => __('Logistics', 'rise-ai-summit'),                        
                'blog'       => __('Blog', 'rise-ai-summit'),       
                
            );
            
            foreach ($mobile_menu_items as $slug => $label) {
                $url = home_url('/' . $slug . '/');
                printf(
                    '<a href="%s" onclick="toggleMobileMenu()" class="block w-full text-left py-2 border-b border-gray-100 text-nd-navy font-bold hover:text-uandes-red">%s</a>',
                    esc_url($url),
                    esc_html($label)
                );
            }
            ?>
        </div>
    </div>
</nav>

<!-- Main Content Area -->
<main id="main-content" class="flex-grow">