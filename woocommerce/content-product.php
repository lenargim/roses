<?php

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>
<div class="products__item">
	<?php
	$title = $product->get_title();
	$price = $product->get_price();
	$image_id = $product->get_image_id();
	$sku = $product->get_sku();
	$image_url = lenar_get_img(wp_get_attachment_image_url($image_id, 'thumbnail'));
	$tags = wc_get_product_terms($product->get_id(), 'product_tag', ['fields' => 'slugs']);
	?>
  <a href="<?php the_permalink() ?>" class="products__item-img-link">
    <img src="<?php echo $image_url ?>" alt="<?php echo $title; ?>" class="products__item-img">
    <div class="products__item-tags">
					<?php if (in_array('new', $tags)): ?>
       <div class="products__item-tag new">Новинка</div>
					<?php endif; ?>
					<?php if (in_array('bestseller', $tags)): ?>
       <div class="products__item-tag bestseller">Хит продаж</div>
					<?php endif; ?>
    </div>
			<?php
			if ($product->is_on_sale()):
				$sale_percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100); ?>
     <div class="products__item-sale">
						<?php echo $sale_percentage . '%'; ?>
     </div>
			<?php endif; ?>
  </a>
  <div class="products__item-data">
			<?php echo do_shortcode('[wishsuite_button]'); ?>
    <a href="<?php the_permalink() ?>" class="products__item-info">
     <span class="products__item-attr">
      <?php $height = $product->get_attribute('pa_height'); ?>
						<?php if ($height): ?>
        <span class="products__item-height">Высота: <?php echo $height; ?></span>
						<?php endif; ?>
       </span>
      <div class="products__item-name"><?php echo $title; ?></div>
    </a>
    <div class="products__item-bottom">
      <div class="products__item-price"><?php echo $product->get_price_html(); ?></div>
					<?php
					if ($product->is_in_stock()): ?>
       <a href="<?php echo $product->add_to_cart_url() ?>"
          data-id="<?php echo $product->get_id(); ?>"
          data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr($sku) ?>"
          class="button white product-button ajax_add_to_cart add_to_cart_button">купить</a>
					<?php else: ?>
          <span class="products__item-out">Нет в наличии</span>
					<?php endif; ?>
    </div>
  </div>
</div>
