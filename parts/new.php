<?php

$args = array(
	'post_type' => 'product',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 10,
	'meta_query' => (array(
		array(
			'key' => '_stock_status',
			'value' => 'instock'
		),
//		array(
//			'key' => '_thumbnail_id',
//			'compare' => 'EXIST'
//		)
	))
);

$loop = new WP_Query($args);
if ($loop->have_posts()): ?>
  <div class="new">
    <h2 class="h2">Новые поступления</h2>
    <div class="new__slider background">
      <svg class="prev new__arrow" viewBox="0 0 14 29" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 9.15083L6.65083 14.5L12 19.8492L10.3492 21.5L3.34917 14.5L10.3492 7.5L12 9.15083Z"/>
      </svg>
      <svg class="next new__arrow" viewBox="0 0 14 29" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 9.15083L6.65083 14.5L12 19.8492L10.3492 21.5L3.34917 14.5L10.3492 7.5L12 9.15083Z"/>
      </svg>
      <div class="swiper-wrapper">
							<?php while ($loop->have_posts()) : $loop->the_post(); ?>
								<?php wc_get_template_part('content', 'product-new'); ?>
							<?php endwhile;
							wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
<?php endif; ?>