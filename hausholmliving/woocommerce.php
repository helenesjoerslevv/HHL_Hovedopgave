<?php get_header(); ?>

<main class="woocommerce-page">
    <div class="container">

    <!-- Individuel produktside -->
    <?php if (is_product()) : ?>
        <div class="single-product-page">
            <div class="row">
                <div class="col-md-6">
                    <!-- Produktbillede (hovedbillede) -->
                    <div class="main-product-image">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('large', ['class' => 'img-fluid main-image', 'id' => 'main-image']);
                        }
                        ?>
                    </div>

                    <!-- Produktgalleri -->
                    <div class="product-gallery">
                        <?php
                        // Hent galleri-billeder
                        $attachment_ids = $product->get_gallery_image_ids();
                        if ($attachment_ids) :
                            echo '<div class="gallery-thumbnails">';
                            foreach ($attachment_ids as $attachment_id) :
                                $image_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');
                                ?>
                                <div class="gallery-thumbnail" data-image="<?php echo esc_url($image_url); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="Product Thumbnail" class="img-fluid">
                                </div>
                                <?php
                            endforeach;
                            echo '</div>';
                        endif;
                        ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php
                    // Vis brand 
                    $brand = get_the_term_list(get_the_ID(), 'product_brand', '', ', ');
                    if ($brand) :
                    ?>
                        <div class="product-brand"><?php echo $brand; ?></div>
                    <?php endif; ?>

                    <h1 class="product-title"><?php the_title(); ?></h1>

                    <div class="product-price">
                        <?php woocommerce_template_single_price(); ?>
                    </div>

                    <!-- Vælg antal og læg i kurv -->
                    <div class="quantity-cart-wrapper">
                        <div class="quantity-selector">
                            <div class="quantity-wrapper">
                                <input type="number" id="quantity" name="quantity" value="1" min="1" step="1" class="quantity-input">
                            </div>
                        </div>

                        <div class="product-cart">
                            <?php woocommerce_template_single_add_to_cart(); ?>
                        </div>
                    </div>

                    <!-- Produktbeskrivelse -->
                    <div class="product-description">
                        <?php the_content(); ?>
                    </div>

                    <!-- fold-ud-sektion -->
                    <div class="accordion-container">
                        <button class="accordion-toggle">Levering & Fragt</button>
                        <div class="accordion-content">
                            <p>Vi sender alle ordrer med GLS og DAO. <br> Leveringstiden er 1-3 hverdage. <br> Du modtager trackinginfo på e-mail så snart din ordre er sendt.</p>
                        </div>

                        <button class="accordion-toggle">Betalingsmetoder</button>
                        <div class="accordion-content">
                            <p>Du kan betale med Visa, Mastercard, MobilePay og Apple Pay. <br> Alle betalinger er sikret og krypteret.</p>
                        </div>

                        <button class="accordion-toggle">Returnering</button>
                        <div class="accordion-content">
                            <p>Du har 30 dages fuld returret. Returneringer skal sendes tilbage i original emballage. <br> Skriv til os på hausholmliving@gmail.com for at starte en retur.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Anbefalede produkter -->
        <div class="recommended-products">
            <h2><?php pll_e("Du vil måske også synes om...") ?></h2>
            <div class="row">
                <?php
                global $post;
                $terms = wp_get_post_terms($post->ID, 'product_cat');
                
                if (!empty($terms)) {
                    $term_ids = wp_list_pluck($terms, 'term_id'); 

                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 4,
                        'post__not_in' => array($post->ID), 
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'id',
                                'terms' => $term_ids,
                                'operator' => 'IN',
                            ),
                        ),
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            global $product;
                            ?>
                            <div class="col-6 col-md-3 product-item">
                                <a href="<?php the_permalink(); ?>" class="product-link">
                                    <div class="product-image">
                                        <?php the_post_thumbnail('shop_catalog'); ?>
                                    </div>
                                    <div class="product-details">
                                        <h3><?php the_title(); ?></h3>
                                        <div class="woocommerce-loop-product__price">
                                            <?php echo $product->get_price_html(); ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        endwhile;
                    endif;

                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </div>
    
    <!-- Hvis ikke produktside -->
    <?php else : ?>

        <!-- Kategoriside -->
        <?php if (is_product_category()) : ?>
    <header class="product-category-header">
        <h1 class="woocommerce-products-header__title page-title">
            <?php single_term_title(); ?>
        </h1>
        <?php
        $category = get_queried_object();
        if (!empty($category->description)) :
        ?>
            <div class="category-description">
                <?php echo wpautop($category->description); ?>
            </div>
        <?php endif; ?>
    </header>
<?php endif; ?>


        <button id="filterToggleBtn" class="filter-button"><?php pll_e("Filtrer produkter") ?></button>

        <div id="filterPanel" class="filter-panel">
            <button id="closeFilter" class="close-filter">&times;</button>
            
            <form method="get" action="">
                <!-- Filtrering formular -->
                <label for="min_price"><?php pll_e("Min pris") ?></label>
                <input type="number" name="min_price" id="min_price" placeholder="0" value="<?php echo isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : ''; ?>">

                <label for="max_price"><?php pll_e("Max pris") ?></label>
                <input type="number" name="max_price" id="max_price" placeholder="5000" value="<?php echo isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : ''; ?>">

                <label for="type"><?php pll_e("Produkttype") ?></label>
                <select name="product_tag" id="type">
                    <option value=""><?php pll_e("Alle") ?></option>
                    <?php
                    $tags = get_terms(array(
                        'taxonomy' => 'product_tag',
                        'hide_empty' => false,
                    ));
                    foreach ($tags as $tag) {
                        $selected = (isset($_GET['product_tag']) && $_GET['product_tag'] === $tag->slug) ? 'selected' : '';
                        echo '<option value="' . esc_attr($tag->slug) . '" ' . $selected . '>' . esc_html($tag->name) . '</option>';
                    }
                    ?>
                </select>

                <label for="brand"><?php pll_e("Brand") ?></label>
                <select name="brand" id="brand">
                    <option value=""><?php pll_e("Alle") ?></option>
                    <?php
                    $brands = get_terms(array(
                        'taxonomy' => 'product_brand',
                        'hide_empty' => false,
                    ));
                    if (!empty($brands) && !is_wp_error($brands)) :
                        foreach ($brands as $brand) :
                            $selected = (isset($_GET['brand']) && $_GET['brand'] === $brand->slug) ? 'selected' : '';
                            echo '<option value="' . esc_attr($brand->slug) . '" ' . $selected . '>' . esc_html($brand->name) . '</option>';
                        endforeach;
                    endif;
                    ?>
                </select>

                <label for="in_stock"><?php pll_e("Lagerstatus") ?></label>
                <select name="in_stock" id="in_stock">
                    <option value=""><?php pll_e("Alle") ?></option>
                    <option value="1" <?php selected($_GET['in_stock'] ?? '', '1'); ?>>På lager</option>
                    <option value="0" <?php selected($_GET['in_stock'] ?? '', '0'); ?>>Ikke på lager</option>
                </select>

                <button type="submit"><?php pll_e("Anvend filtre") ?></button>
            </form>
        </div>

        <div class="container">
            <div class="row product-category-listing no-gutters">
                <?php
                if (have_posts()) :
                    woocommerce_product_loop_start();
                    while (have_posts()) : the_post();
                        $product_url = get_permalink();
                        ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-item">
                            <a href="<?php echo esc_url($product_url); ?>" class="product-link">
                                <div class="product-image">
                                    <?php if (has_post_thumbnail()) the_post_thumbnail('shop_catalog'); ?>
                                </div>
                                <div class="product-details">
                                    <?php
                                    $terms = get_the_terms(get_the_ID(), 'product_brand');
                                    if ($terms && !is_wp_error($terms)) :
                                        $brand = array_shift($terms);
                                        echo '<p class="product-brand">' . esc_html($brand->name) . '</p>';
                                    endif;
                                    ?>
                                    <h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>
                                    <div class="woocommerce-loop-product__price">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    endwhile;
                    woocommerce_product_loop_end();
                else :
                    echo '<p>No products found in this category.</p>';
                endif;
                ?>
            </div>
        </div>

    <?php endif; ?>

    </div> <!-- container -->
</main>

<?php get_footer(); ?>
