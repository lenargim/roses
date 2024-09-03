<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
//get_header( 'shop' );
global $wp_query;
$cat_obj = $wp_query->get_queried_object();
$isParentCat = $cat_obj->parent === 0;

get_template_part('parts/header'); ?>

  <section class="catalog section">
    <div class="container">
      <div class="catalog__wrap">
        <div class="catalog__sidebar">
									<?php get_template_part('parts/sidebar-menu'); ?>
        </div>
        <div class="catalog__main">
									<?php get_template_part('parts/new');
									if ($isParentCat):
                  $terms = get_terms(
                    ['taxonomy' => 'product_cat',
                      'hide_empty' => false,
                      'parent' => $cat_obj->term_id,
                    ]);
                   if ($terms): ?>
                    <div class="grid grid-4 catalog__loop">
											<?php foreach ($terms as $term):
												$thumb_id = get_term_meta($term->term_id, 'thumbnail_id', true);
												$term_img = lenar_get_img(wp_get_attachment_url($thumb_id, 'product-category')); ?>
                    <a href="<?php echo get_term_link($term) ?>"
                      style="background-image: url(<?php echo $term_img ?>)"
                      class="grid__item"><span><?php echo $term->name ?></span></a>
											<?php endforeach; ?>
                    </div>
									<?php endif;
                   else:
										get_template_part('parts/filters');
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

										<?php endif;
									endif; ?>

        </div>
      </div>
    </div>
  </section>

<?php
get_template_part('parts/extra-sale');
get_template_part('parts/map'); ?>

<?php get_template_part('parts/footer');
