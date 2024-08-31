<?php
/**
	* Single Product Thumbnails
	*
	* This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
	*
	* HOWEVER, on occasion WooCommerce will need to update template files and you
	* (the theme developer) will need to copy the new files to your theme to
	* maintain compatibility. We try to do this as little as possible, but it does
	* happen. When this occurs the version of the template file will be bumped and
	* the readme will list any important changes.
	*
	* @see         https://woocommerce.com/document/template-structure/
	* @package     WooCommerce\Templates
	* @version     3.5.1
	*/

defined('ABSPATH') || exit;

global $product;
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();
array_unshift($attachment_ids, $post_thumbnail_id);

?>
<?php if ($attachment_ids && $post_thumbnail_id): ?>
  <div class="swiper-thumbs">
    <div class="swiper-wrapper">
					<?php foreach ($attachment_ids as $attachment_id): ?>
            <div class="swiper-slide">
													<?php $product_img = lenar_get_img(wp_get_attachment_url($attachment_id, 'product-thumb')); ?>
              <img src="<?php echo $product_img ?>" alt="<?php echo $product->name ?>" class="product__thumb">
            </div>
					<?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
