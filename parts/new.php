<?php
$args = array(
	'post_type' => 'product',
	'orderby' => 'date',
	'posts_per_page' => 4,
	'post_status' => 'publish'
);
$loop = new WP_Query($args);
?>

<section class="section background">
  <div class="container">
    <h2 class="h2">Новые поступления</h2>
    <div class="grid grid-space">
					<?php while ($loop->have_posts()) : $loop->the_post();
						woocommerce_get_template_part('content', 'product');
					endwhile;
					wp_reset_postdata(); ?>
    </div>
  </div>
</section>