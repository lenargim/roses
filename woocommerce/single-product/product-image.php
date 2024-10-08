<?php
defined('ABSPATH') || exit;
global $product;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();
array_unshift($attachment_ids, $post_thumbnail_id);
$wrapper_classes = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
		'images',
	)
);
$tags = wc_get_product_terms($product->get_id(), 'product_tag', ['fields' => 'slugs']);
if ($attachment_ids && $post_thumbnail_id): ?>
  <div class="product-single__gallery">
			<?php if (!wp_is_mobile()): ?>
     <div class="product-single__thumbs swiper-thumbs">
       <div class="swiper-wrapper">
								<?php foreach ($attachment_ids as $attachment_id): ?>
          <div class="swiper-slide">
											<?php $product_img = lenar_get_img(wp_get_attachment_url($attachment_id, 'product-thumb')); ?>
            <img src="<?php echo $product_img ?>" alt="<?php echo $product->name ?>" class="product-single__thumb">
          </div>
								<?php endforeach; ?>
       </div>
     </div>
			<?php endif; ?>
    <div class="product-single__images swiper-product">
					<?php wc_get_template('single-product/sale-flash.php'); ?>
      <div class="product-single__tags">
							<?php if (in_array('bestseller', $tags)): ?>
         <div class="product-single__tag bestseller">Хит продаж</div>
							<?php endif; ?>
							<?php if (in_array('new', $tags)): ?>
         <div class="product-single__tag new">Новинка</div>
							<?php endif; ?>

      </div>
      <div class="prev product-single__arrow product-single__prev"></div>
      <div class="next product-single__arrow product-single__next"></div>
      <div class="swiper-wrapper">
							<?php foreach ($attachment_ids as $attachment_id): ?>
         <div class="swiper-slide">
										<?php $product_img = lenar_get_img(wp_get_attachment_url($attachment_id, 'product-img')); ?>
           <img src="<?php echo $product_img ?>" alt="<?php echo $product->name ?>" class="product-single__image">
         </div>
							<?php endforeach; ?>
      </div>
    </div>
  </div>
<?php else: ?>
  <img src="<?php echo lenar_get_img(''); ?>" alt="<?php echo $product->name ?>" class="product-single__image">
<?php endif; ?>