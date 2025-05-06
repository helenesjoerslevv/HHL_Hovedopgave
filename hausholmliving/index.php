<?php get_header(); ?>

<div class="banner-carousel">
    <?php 
    for ($i = 1; $i <= 3; $i++) {
        $image = get_field('banner_image_' . $i);
        $subtitle = get_field('banner_subtitle_' . $i);
        $title = get_field('banner_title_' . $i);
        $link = get_field('banner_link_' . $i);
    ?>
        <div class="slide">
            <?php if ($image): ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            <?php endif; ?>
            <div class="text">
                <?php if ($subtitle): ?>
                    <p class="subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
                <?php if ($title): ?>
                    <h2>
                        <?php if ($link): ?>
                            <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a>
                        <?php else: ?>
                            <?php echo esc_html($title); ?>
                        <?php endif; ?>
                    </h2>
                <?php endif; ?>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Dots for carousel navigation -->
<div class="carousel-dots">
    <span class="dot active"></span>
    <span class="dot"></span>
    <span class="dot"></span>
</div>


<!-- Row 1 -->
<div class="new-arrivals container mt-5">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><?php the_field('row_title'); ?></h2>
        <a href="<?php the_field('shop_alt'); ?>" class="shop-all-link"><?php pll_e("Shop alt") ?></a>
    </div>

    <div class="row">
        <?php 
        $shop_link = get_field('shop_alt'); 
        for ($i = 1; $i <= 4; $i++) : ?>
            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <a href="<?php echo esc_url($shop_link); ?>" class="text-decoration-none text-reset d-block h-100">
                    <div class="product-box position-relative">
                        <div class="product-image">
                            <?php if ($image = get_field('new_image_' . $i)) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="New Arrival <?php echo $i; ?>" class="img-fluid normal-image">
                            <?php endif; ?>

                            <?php if ($hover_image = get_field('new_image_hover_' . $i)) : ?>
                                <img src="<?php echo esc_url($hover_image['url']); ?>" alt="New Arrival Hover <?php echo $i; ?>" class="img-fluid hover-image">
                            <?php endif; ?>

                            <span class="new-badge position-absolute"><?php pll_e("Nyhed") ?></span>
                        </div>

                        <div class="product-info mt-2">
                            <p class="product-title mb-0"><?php the_field('product_title_' . $i); ?></p>
                            <p class="product-name mb-0"><?php the_field('product_name_' . $i); ?></p>
                            <p class="price mb-0"><?php the_field('price_' . $i); ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endfor; ?>
    </div>
</div>




 <!-- Category Row -->
 <div class="category-row">
    <?php for ($i = 1; $i <= 2; $i++) :
        $image = get_field('category_image_' . $i);
        $title = get_field('category_title_' . $i);
        $link = get_field('category_link_' . $i);
    ?>
        <?php if ($image && $link): ?>
            <a href="<?php echo esc_url($link); ?>" class="category-block">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="category-img" />
                <div class="overlay">
                    <h3 class="category-title"><?php echo esc_html($title); ?></h3>
                </div>
            </a>
        <?php endif; ?>
    <?php endfor; ?>
</div>


<!-- Row for banner image -->
<?php 
    $banner_image = get_field('category_banner_image');
    $banner_title = get_field('category_banner_title');
    $banner_link = get_field('category_banner_link');
?>

<?php if ($banner_image): ?>
    <div class="category-banner">
        <div class="banner-image">
            <img src="<?php echo esc_url($banner_image['url']); ?>" alt="Banner Image" class="img-fluid">
            <div class="overlay">
                <a href="<?php echo esc_url($banner_link); ?>" class="banner-title-link">
                    <h3 class="banner-title"><?php echo esc_html($banner_title); ?></h3>
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>



<!-- Row for best sellers -->
<?php 
$best_title = get_field('best_title'); 
$best_shop_text = get_field('best_shop'); 
?>

<?php
$shop_page = get_page_by_title('Shop');
$shop_url = $shop_page ? get_permalink($shop_page) : ''; 
?>

<div class="best-sellers container mt-5">
    <div class="best-section-header d-flex justify-content-between align-items-center mb-4">
        <?php if ($best_title) : ?>
            <h2 class="best-title mb-0"><?php echo esc_html($best_title); ?></h2>
        <?php endif; ?>

        <?php if ($best_shop_text && $shop_url) : ?>
            <a href="<?php echo esc_url($shop_url); ?>" class="best-shop-link">
                <?php echo esc_html($best_shop_text); ?>
            </a>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php for ($i = 1; $i <= 8; $i++) : ?>
            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <a href="<?php echo esc_url($shop_url); ?>" class="text-decoration-none text-reset d-block h-100">
                    <div class="product-box position-relative">
                        <div class="product-image">
                            <?php if ($main_image = get_field('best_image_' . $i)) : ?>
                                <img src="<?php echo esc_url($main_image['url']); ?>" alt="Best Seller <?php echo $i; ?>" class="img-fluid normal-image">
                            <?php endif; ?>

                            <?php if ($hover_image = get_field('n_best_image_' . $i)) : ?>
                                <img src="<?php echo esc_url($hover_image['url']); ?>" alt="Best Seller Hover <?php echo $i; ?>" class="img-fluid hover-image">
                            <?php endif; ?>
                        </div>

                        <div class="product-info mt-2">
                            <p class="product-title mb-0"><?php the_field('best_title_' . $i); ?></p>
                            <p class="product-name mb-0"><?php the_field('best_product_name_' . $i); ?></p>
                            <p class="price mb-0"><?php the_field('best_price_' . $i); ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endfor; ?>
    </div>
</div>



<!-- Kategori row slut -->
<div class="row best-category-row">
    <?php for ($i = 1; $i <= 4; $i++) :
        $image = get_field('cat_image_' . $i); 
        $title = get_field('cat_title_' . $i); 
    ?>
        <?php if ($image && $title): ?>
            <div class="col-6 col-lg-3">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('shop'))); ?>" class="best-category-block">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="best-category-img" />
                    <div class="best-overlay">
                        <h3 class="best-category-title"><?php echo esc_html($title); ?></h3>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    <?php endfor; ?>
</div>


















<?php get_footer(); ?> 
