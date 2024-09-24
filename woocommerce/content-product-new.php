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

<div class="swiper-slide">
	<?php
	$title = $product->get_title();
	$price = $product->get_price();
	$image_id = $product->get_image_id();
	$image_url = lenar_get_img(wp_get_attachment_image_url($image_id, 'product-new'));
	?>
  <div class="new__item">
    <a href="<?php the_permalink() ?>">
      <img src="<?php echo $image_url ?>" alt="<?php echo $title; ?>" class="new__item-img">
    </a>
    <div class="new__item-data">
					<?php echo do_shortcode('[wishsuite_button]'); ?>
      <a href="<?php the_permalink() ?>" class="new__item-info">
							<?php $height = $product->get_attribute('pa_height'); ?>

        <span class="new__item-attr">
           <?php if ($height): ?>
             <span class="new__item-height">Высота: <?php echo $height; ?></span>
											<?php endif; ?>
         </span>

        <div class="new__item-name"><?php echo $title; ?></div>
      </a>
      <div class="new__item-bottom">
        <div class="new__item-price"><?php echo $price . '₽'; ?></div>
							<?php if ($product->is_in_stock()): ?>
         <a href="<?php echo $product->add_to_cart_url() ?>" class="button white buy">купить</a>
              <?php else: ?><span class="new__item-out">Нет<br>в наличии</span>
							<?php endif; ?>
      </div>
    </div>
  </div>
</div>