<?php
/**
	* The template for displaying product content within loops
	*
	* This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
	*
	* HOWEVER, on occasion WooCommerce will need to update template files and you
	* (the theme developer) will need to copy the new files to your theme to
	* maintain compatibility. We try to do this as little as possible, but it does
	* happen. When this occurs the version of the template file will be bumped and
	* the readme will list any important changes.
	*
	* @see     https://woocommerce.com/document/template-structure/
	* @package WooCommerce\Templates
	* @version 3.6.0
	*/

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
	$image_url = lenar_get_img(wp_get_attachment_image_url($image_id, 'thumbnail'));
	$tags = $product->get_tag_ids();
	?>
  <a href="<?php the_permalink() ?>" class="products__item-img-link">
    <img src="<?php echo $image_url ?>" alt="<?php echo $title; ?>" class="products__item-img">
			<?php if ($tags): ?>
     <div class="products__item-tags">
						<?php foreach ($tags as $tag): ?>
        <div class="products__item-tag">
									<?php echo get_term($tag)->name; ?>
        </div>
						<?php endforeach ?>
     </div>
			<?php endif; ?>
  </a>
  <div class="products__item-data">
			<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
    <a href="<?php the_permalink() ?>" class="products__item-info">
      <span class="products__item-height">Высота: 60 - 80 см</span>
      <div class="products__item-name"><?php echo $title; ?></div>
    </a>
    <div class="products__item-bottom">
      <div class="products__item-price"><?php echo $price . '₽'; ?></div>
      <a href="<?php echo $product->add_to_cart_url() ?>" class="button white product-button">купить</a>
    </div>
  </div>
</div>
