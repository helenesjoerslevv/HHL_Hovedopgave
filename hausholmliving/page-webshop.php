<?php get_header(); ?>

<div class="shop-container">
    <h1>Kategorier</h1>

    <div class="category-container">
        <?php
        $args = array(
            'taxonomy'   => 'product_cat',
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => false,
        );
        $product_categories = get_terms($args);

        if ($product_categories) {
            foreach ($product_categories as $category) {
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';

                if ($image_url) {
                    ?>
                    <div class="category-item">
                        <a href="<?php echo get_term_link($category); ?>" class="category-link">
                            <div class="category-image-wrapper">
                                <div class="category-image" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
                                <div class="category-overlay">
                                    <span><?php echo esc_html($category->name); ?></span>
                                </div>
                            </div>
                            <h3 class="category-title"><?php echo esc_html($category->name); ?></h3>
                        </a>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
</div>



<?php get_footer(); ?>
