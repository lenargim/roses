<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_template_part('parts/header'); ?>
  <section class="catalog section">
    <div class="container">
      <div class="catalog__wrap">
        <div class="catalog__sidebar">
									<?php get_template_part('parts/sidebar-menu'); ?>
        </div>
        <div class="catalog__main">
									<?php get_template_part('parts/new-slider'); ?>
          									<?php get_template_part('parts/filters'); ?>
									<?php if (woocommerce_product_loop()): ?>
           <div class="catalog__loop">
												<?php while (have_posts()):
													the_post();
													wc_get_template_part('content', 'product');
												endwhile; ?>
           </div>
									<?php else:
										do_action('woocommerce_no_products_found');
									endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php
get_template_part('parts/new');
get_template_part('parts/extra-sale');
get_template_part('parts/map'); ?>

<?php get_template_part('parts/footer');