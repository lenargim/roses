<?php
$product_ids_on_sale = wc_get_product_ids_on_sale();
$args = array(
	'post_type' => 'product',
	'orderby' => 'date',
	'posts_per_page' => 5,
	'post_status' => 'publish'
);
$loop = new WP_Query($args);

?>

<?php if ($loop): ?>
  <div class="account__slider account__slider-actions">
    <h3 class="h3">Новинки Русроза</h3>
    <div class="swiper-wrapper">
					<?php while ($loop->have_posts()) : $loop->the_post(); ?>
       <div class="swiper-slide">
								<?php wc_get_template_part('content', 'product'); ?>
       </div>
					<?php endwhile; ?>
    </div>
    <div class="account__slider-arrow-wrap">
      <div class="account__slider-arrow prev"></div>
      <div class="account__slider-arrow next"></div>
    </div>
  </div>
<?php endif; ?>