<?php get_header(); ?>

<?php 
$kontakt_banner_img = get_field('kontakt_banner_img');
$kontakt_banner_tekst = get_field('kontakt_banner_tekst');
$kontakt_information_tekst = get_field('kontakt_information_tekst');
$kontakt_email_title = get_field('kontakt_email_title');
$kontakt_email = get_field('kontakt_email');
$kontakt_telefon_title = get_field('kontakt_telefon_title');
$kontakt_telefon = get_field('kontakt_telefon');
$kontakt_adresse_title = get_field('kontakt_adresse_title');
$kontakt_adresse = get_field('kontakt_adresse');
?>

<!-- Kontakt sektion -->
<section class="kontakt-section py-4">
    <div class="container-fluid">
        <div class="row g-0">
            <!-- Venstre kolonne med billede -->
            <div class="col-md-6 kontakt-billede">
                <div class="kontakt-billede-img" style="background-image: url('<?php echo esc_url($kontakt_banner_img['url']); ?>');"></div>
            </div>

            <!-- Højre kolonne med kontakt info -->
            <div class="col-md-6 kontakt-info">
                <div class="container">
                    <!-- Kontakt banner tekst -->
                    <div class="kontakt-banner-tekst">
                        <h1 class="fw-bold"><?php echo esc_html($kontakt_banner_tekst); ?></h1>
                    </div>

                    <!-- Kontakt information tekst -->
                    <div class="kontakt-info-tekst py-2">
                        <p><?php echo wp_kses_post($kontakt_information_tekst); ?></p>
                    </div>

                    <!-- Kontakt detaljer (email, telefon, adresse) -->
                    <div class="row ">
                        <div class="col-md-4">
                            <h3 class="fw-bold"><?php echo esc_html($kontakt_email_title); ?></h3>
                            <p><a href="mailto:<?php echo esc_attr($kontakt_email); ?>" class="kontakt-link"><?php echo esc_html($kontakt_email); ?></a></p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="fw-bold"><?php echo esc_html($kontakt_telefon_title); ?></h3>
                            <p><a href="tel:<?php echo esc_attr($kontakt_telefon); ?>" class="kontakt-link"><?php echo esc_html($kontakt_telefon); ?></a></p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="fw-bold"><?php echo esc_html($kontakt_adresse_title); ?></h3>
                            <div class="kontakt-text"><?php echo wp_kses_post($kontakt_adresse); ?></div>
                        </div>
                    </div>

                    <!-- Kontaktformular -->
                    <div class="kontakt-formular">
                        <div class="contact-form-container">
                            <?php echo do_shortcode('[contact-form-7 id="aade53a" title="Person Details"]'); ?>
                        </div>
                    </div>

                    <!-- Besked feedback fra Contact Form 7 -->
                    <div class="form-response-message wpcf7-response-output" aria-hidden="true" style="display:none;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
