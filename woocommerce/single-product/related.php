<?php

if (!defined('ABSPATH')) {
	exit;
}
global $product;
$uppsels = $product->get_upsell_ids();

if ($uppsels) : ?>

  <section class="related section">
    <div class="container">
      <div class="product-single__related">
        <h2 class="h2">Похожие сорта</h2>
        <div class="prev slider__prev"></div>
        <div class="next slider__next"></div>
        <div class="swiper-wrapper">
									<?php foreach ($uppsels as $id) : ?>
										<?php
										$post_object = get_post($id);
										setup_postdata($GLOBALS['post'] =& $post_object); ?>
           <div class="swiper-slide">
												<?php wc_get_template_part('content', 'product'); ?>
           </div>
									<?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
<?php
endif;

wp_reset_postdata();
