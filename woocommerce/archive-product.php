<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
//get_header( 'shop' );
global $wp_query;
$cat_obj = $wp_query->get_queried_object();
$terms = get_terms(
	['taxonomy' => 'product_cat',
		'hide_empty' => false,
		'parent' => 0,
	]);

get_template_part('parts/header'); ?>
	<section class="catalog section">
		<div class="container">
			<div class="catalog__wrap">
				<div class="catalog__sidebar">
					<?php get_template_part('parts/sidebar-menu'); ?>
				</div>
				<div class="catalog__main">
					<?php get_template_part('parts/new'); ?>

					<?php if ($terms): ?>
						<div class="grid grid-4 catalog__loop">
							<?php foreach ($terms as $term):
								$thumb_id = get_term_meta($term->term_id, 'thumbnail_id', true);
								$term_img = lenar_get_img(wp_get_attachment_url($thumb_id, 'product-category')); ?>
								<a href="<?php echo get_term_link($term) ?>"
											style="background-image: url(<?php echo $term_img ?>)"
											class="grid__item"><span><?php echo $term->name ?></span></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</section>

<?php
get_template_part('parts/extra-sale');
get_template_part('parts/map'); ?>

<?php get_template_part('parts/footer');