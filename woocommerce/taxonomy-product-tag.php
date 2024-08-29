<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
//get_header( 'shop' );


	get_template_part('parts/header'); ?>

  <section class="catalog section">
    <div class="container">
      <div class="catalog__wrap">
        <div class="catalog__sidebar">
									<?php get_template_part('parts/sidebar-menu'); ?>

        </div>
        <div class="catalog__main">
									<?php get_template_part('parts/new'); ?>
									<?php woocommerce_catalog_ordering() ?>
									<?php get_template_part('parts/filters'); ?>
									<?php
									if (woocommerce_product_loop()): ?>
           <div class="catalog__loop products">
												<?php if (wc_get_loop_prop('total')):
													while (have_posts()):
														the_post();
														wc_get_template_part('content', 'product');
													endwhile;
												endif; ?>
           </div>
										<?php woocommerce_pagination();
									else:
										do_action('woocommerce_no_products_found'); ?>
									<?php endif; ?>
        </div>
      </div>
    </div>
  </section>

	<?php
	get_template_part('parts/extra-sale');
	get_template_part('parts/map'); ?>

	<?php get_template_part('parts/footer');
