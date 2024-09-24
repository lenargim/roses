<?php
$crosssell_ids = get_post_meta(get_the_ID(), '_crosssell_ids');
if (!empty ($crosssell_ids)):
	$crosssell_ids = $crosssell_ids[0];
	if (count($crosssell_ids) > 0):
		$args = array(
			'post_type' => 'product',
			'ignore_sticky_posts' => 1,
			'post__in' => $crosssell_ids,
			'posts_per_page' => 4
		);
		$products = new WP_Query($args);

		if ($products->have_posts()) : ?>
    <section class="section background">
      <div class="container">
        <h2 class="h2">Необходимые товары</h2>
        <div class="products">
									<?php while ($products->have_posts()) : $products->the_post(); ?>
										<?php wc_get_template_part('content', 'product'); ?>
									<?php endwhile; // end of the loop. ?>
        </div>
      </div>
    </section>
		<?php endif;
	endif;
	wp_reset_query();
endif;
?>