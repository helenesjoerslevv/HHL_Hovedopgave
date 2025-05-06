<?php 
function plp_register_stylesheet() {
    wp_enqueue_style("main-style", get_template_directory_uri() . "/style.css");

    // Bootstrap 5.2.3 via jsDelivr
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', array(), null);

    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100..900&family=Squada+One&display=swap', array(), null);
}
add_action("wp_enqueue_scripts", "plp_register_stylesheet");

function blog_theme_enqueue_assets() {
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'blog_theme_enqueue_assets');

function enqueue_custom_scripts() {
    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function register_my_menus() {
    register_nav_menus(
        array(
            'main-menu' => __( 'Main Menu' ),
        )
    );
}
add_action( 'init', 'register_my_menus' );


// Deaktiver Gutenberg editoren for sider og indlæg
function plp_disable_gutenberg() {
    remove_post_type_support("page", "editor");
    remove_post_type_support("post", "editor");
}
add_action("init", "plp_disable_gutenberg");

// Aktiver WooCommerce
function shop_enable_woocommerce() {
    add_theme_support("woocommerce");
}
add_action("after_setup_theme", "shop_enable_woocommerce");

// Fjern "Viser antal ud af x produkter" i WooCommerce
function custom_cleanup_woocommerce_category_output() {
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
}
add_action('init', 'custom_cleanup_woocommerce_category_output');

// Tilføj filtre til produktsøgning
add_action('pre_get_posts', 'custom_product_filter_query');
function custom_product_filter_query($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category())) {

        // Meta queries (pris og lagerstatus)
        $meta_query = array();
        if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
            $meta_query[] = array(
                'key' => '_price',
                'value' => array($_GET['min_price'], $_GET['max_price']),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC',
            );
        }

        if (isset($_GET['in_stock'])) {
            $meta_query[] = array(
                'key'     => '_stock_status',
                'value'   => $_GET['in_stock'] == '1' ? 'instock' : 'outofstock',
                'compare' => '='
            );
        }

        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }

        $tax_query = array();

        // Brand filter (product_brand)
        if (!empty($_GET['brand'])) {
            $tax_query[] = array(
                'taxonomy' => 'product_brand', 
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['brand']),
            );
        }

        // Produkttype filter (product_tag)
        if (!empty($_GET['product_tag'])) {
            $tax_query[] = array(
                'taxonomy' => 'product_tag', 
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['product_tag']),
            );
        }

        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }

        // Filtrer efter kategori
        if (!empty($_GET['product_cat'])) {
            $query->set('product_cat', sanitize_text_field($_GET['product_cat']));
        }
    }
}

add_action( 'woocommerce_single_product_summary', 'my_custom_product_summary', 25 );

function my_custom_product_summary() {
    echo '<div class="custom-product-summary">';
    echo '<p>Custom message or content here</p>';
    echo '</div>';
}

add_filter( 'woocommerce_is_sold_individually', '__return_true' );






function plp_register_strings() {
    pll_register_string("5 stjerner på", "5 stjerner på");
    pll_register_string("Trustpilot", "Trustpilot");
    pll_register_string("- Husk du kan vælge afhentning i Ribe⭐️", "- Husk du kan vælge afhentning i Ribe⭐️");
    pll_register_string("Hurtig levering", "Hurtig levering");
    pll_register_string("Gratis fragt over 499,-", "Gratis fragt over 499,-");
    pll_register_string("Søg efter:", "Søg efter:");
    pll_register_string("Søg", "Søg");
    pll_register_string("Søg...", "Søg...");
    pll_register_string("Shop alt", "Shop alt");
    pll_register_string("Nyhed", "Nyhed");
    pll_register_string("Tlf.: ", "Tlf.: ");
    pll_register_string("CVR-nummer:", "CVR-nummer:");
    pll_register_string("Om virksomheden", "Om virksomheden");
    pll_register_string("Filosofien bag", "Filosofien bag");
    pll_register_string("Person Datapolitik", "Person Datapolitik");
    pll_register_string("Vilkår & handelsbetingelser", "Vilkår & handelsbetingelser");
    pll_register_string("Servicevilkår", "Servicevilkår");
    pll_register_string("Refusionspolitik", "Refusionspolitik");
    pll_register_string("Nyhedsbrev", "Nyhedsbrev");
    pll_register_string("Modtag eksklusive tilbud og nyheder direkte i din indbakke.", "Modtag eksklusive tilbud og nyheder direkte i din indbakke.");
    pll_register_string("Indtast din e-mail", "Indtast din e-mail");
    pll_register_string("Tilmeld", "Tilmeld");
    pll_register_string("Du vil måske også kunne lide", "Du vil måske også kunne lide");
    pll_register_string("Filtrer produkter", "Filtrer produkter");
    pll_register_string("Min pris", "Min pris");
    pll_register_string("Max pris", "Max pris");
    pll_register_string("Produkttype", "Produkttype");
    pll_register_string("Alle", "Alle");
    pll_register_string("Brand", "Brand");
    pll_register_string("Lagerstatus", "Lagerstatus");
    pll_register_string("På lager", "På lager");
    pll_register_string("Ikke på lager", "Ikke på lager");
    pll_register_string("Anvend filtre", "Anvend filtre");

    }
    
add_action("init", "plp_register_strings");