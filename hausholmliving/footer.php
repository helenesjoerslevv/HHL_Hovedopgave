<footer class="site-footer">
  <div class="container">
    <div class="row gy-3">
      <!-- Venstre kolonne (to kolonner inde i én) -->
      <div class="col-12 col-md-7">
        <div class="row">
          <div class="col-12 col-sm-6 mb-4">
            <h3>Hausholmliving</h3>
            <p>Holmevej 18,</p>
            <p>6760 Ribe</p>
            <p><?php pll_e("Tlf.: ") ?><a href="tel:+45 51884786"> +45 51884786</a></p>
            <p>Email: <a href="mailto:hausholmliving@gmail.com">hausholmliving@gmail.com</a></p>
            <p class="spaced-line"><?php pll_e("CVR-nummer:") ?> 38544616</p>
          </div>
          <div class="col-12 col-sm-6 mb-4">
            <h3>Info</h3>
            <p><a href="/"><?php pll_e("Om virksomheden") ?></a></p>
            <p><a href="/"><?php pll_e("Filosofien bag") ?></a></p>
            <p><a href="/"><?php pll_e("Person Datapolitik") ?></a></p>
            <p><a href="/"><?php pll_e("Vilkår & handelsbetingelser") ?></a></p>
            <p><a href="/"><?php pll_e("Servicevilkår") ?></a></p>
            <p><a href="/"><?php pll_e("Refusionspolitik") ?></a></p>
          </div>
        </div>
      </div>

      <!-- Højre kolonne (Nyhedsbrev) -->
      <div class="footer-right col-md-4">
        <h3><?php pll_e("Nyhedsbrev") ?></h3>
        <p><?php pll_e("Modtag eksklusive tilbud og nyheder direkte i din indbakke.") ?></p>
        <form class="newsletter-form">
          <input type="email" class="form-control" placeholder="<?php pll_e("Indtast din e-mail") ?>">
          <button type="submit" class="newsletter-button"><?php pll_e("Tilmeld") ?></button>
        </form>
      </div>

    <hr class="footer-divider">

    <!-- Sociale medier -->
    <div class="footer-social d-flex flex-wrap justify-content-center justify-content-md-start gap-3">
      <a href="https://www.facebook.com/hausholmliving"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook.png" alt="Facebook"></a>
      <a href="https://www.instagram.com/hausholmliving/"><img src="<?php echo get_template_directory_uri(); ?>/img/instagram.png" alt="Instagram"></a>
      <a href="https://www.tiktok.com/@hausholmliving"><img src="<?php echo get_template_directory_uri(); ?>/img/tiktok.png" alt="TikTok"></a>
    </div>
  </div>
</footer>
