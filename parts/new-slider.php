<?php
$args = array(
	'post_type' => 'product',
	'orderby' => 'date',
	'posts_per_page' => 8,
	'post_status' => 'publish'
);

$loop = new WP_Query($args);
if ($loop->have_posts()): ?>
  <div class="new">
    <h2 class="h2">Новые поступления</h2>
    <div class="new__slider">
      <div class="prev new__arrow"></div>
      <div class="next new__arrow"></div>
      <div class="swiper-wrapper">
							<?php while ($loop->have_posts()) : $loop->the_post(); ?>
								<?php wc_get_template_part('content', 'product-new'); ?>
							<?php endwhile;
							wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
<?php endif; ?>