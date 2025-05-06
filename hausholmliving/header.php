<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="top-bar">
            <div class="container">

                <!-- language -->
                <div class="language-switcher">
                    <ul>
                        <?php
                        if (function_exists('pll_the_languages')) :
                            $languages = pll_the_languages(['raw' => 1]);
                            foreach ($languages as $lang) {
                                $label = '';

                                switch ($lang['slug']) {
                                    case 'da':
                                        $label = 'Dansk';
                                        break;
                                    case 'en':
                                        $label = 'English';
                                        break;
                                    case 'de':
                                        $label = 'Deutsch';
                                        break;
                                    default:
                                        $label = esc_html($lang['name']);
                                        break;
                                }

                                echo '<li><a href="' . esc_url($lang['url']) . '">' . $label . '</a></li>';
                            }
                        endif;
                        ?>
                    </ul>
                </div>

                <div class="trustpilot">
                    <p><?php pll_e("5 stjerner på") ?>  <a href="https://dk.trustpilot.com/review/hausholmliving.dk?utm_medium=trustbox&utm_source=MicroReviewCount"><strong><?php pll_e("Trustpilot") ?> </strong></a> <?php pll_e("- Husk du kan vælge afhentning i Ribe⭐️") ?></p>
                </div>

                <div class="contact-info">
                    <p><?php pll_e("Hurtig levering") ?> </p>
                    <p><?php pll_e("Gratis fragt over 499,-") ?>-</p>
                </div>
            </div>
        </div>

        <div class="main-header-content">
    <div class="container d-flex justify-content-between align-items-center">
        
        <!-- Desktop Navigation -->
        <nav class="desktop-nav">
            <?php 
                wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => 'nav',
                    'echo' => true, 
                ));
            ?>
        </nav>

        <!-- Logo -->
        <div class="site-logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/hausholm_logo_sort.png" alt="Logo">
            </a>
        </div>

        <!-- Søg + kurv + hamburgermenu -->
        <div class="site-search-cart d-flex align-items-center">
            <button class="hamburger" id="hamburger">☰</button>

            <div class="search-bar">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <label for="search-input" class="screen-reader-text"><?php pll_e("Søg efter:") ?></label>
                    <input type="search" id="search-input" class="search-field" placeholder="<?php pll_e("Søg...") ?>" value="" name="s">
                    <button type="submit" class="search-submit"><?php pll_e("Søg") ?></button>
                </form>
            </div>

            <div class="cart-icon">
                <a href="<?php echo wc_get_cart_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/126142.png" alt="Cart">
                    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
            </div>
        </div>
    </div>

    <!-- Mobilmenu -->
    <div class="site-nav" id="mobileMenu">
        <?php 
            wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'nav',
                'echo' => true, 
            ));
        ?>
    </div>
</div>

    </header>

    <script src="script.js"></script> 
    <?php wp_footer(); ?>
</body>
</html>
