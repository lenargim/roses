<?php
/**
	* Related Products
	*
	* This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
	*
	* HOWEVER, on occasion WooCommerce will need to update template files and you
	* (the theme developer) will need to copy the new files to your theme to
	* maintain compatibility. We try to do this as little as possible, but it does
	* happen. When this occurs the version of the template file will be bumped and
	* the readme will list any important changes.
	*
	* @see         https://woocommerce.com/document/template-structure/
	* @package     WooCommerce\Templates
	* @version     3.9.0
	*/

if (!defined('ABSPATH')) {
	exit;
}

if ($related_products) : ?>

  <section class="related section background">
    <div class="container">
      <div class="product-single__related">
        <h2 class="h2">Похожие сорта</h2>
        <div class="swiper-wrapper">
									<?php foreach ($related_products as $related_product) : ?>
										<?php
										$post_object = get_post($related_product->get_id());
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
