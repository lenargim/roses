<?php
// Template Name: Cart def
defined('ABSPATH') || exit;
get_template_part('parts/header');
do_action('woocommerce_before_cart');
$cart = WC()->cart;
?>
  <form class="woocommerce-cart-form cart-block" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
    <div class="container">
      <h1 class="h1">Корзина</h1>
      <div class="cart-block__wrap">
        <div class="cart-block__table">
									<?php do_action('woocommerce_before_cart_table'); ?>
          <div class="cart-block__table-top">
            <span>Товары в корзине:  <?php echo $cart->get_cart_contents_count() ?></span>
            <button class="button white empty-cart" type="button">Очистить корзину</button>
          </div>
          <div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
											<?php do_action('woocommerce_before_cart_contents'); ?>
											<?php
											foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
											$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
											$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
											$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
											if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
											$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
											?>
            <div
                class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
              <div class="product-thumbnail">
															<?php $product_img = lenar_get_img(wp_get_attachment_image_src($_product->get_image_id(), 'product-thumb')[0]); ?>
                <img src="<?php echo $product_img; ?>" alt="">
                <div class="product-data">
                  <div class="product-name"><?php echo $product_name; ?></div>
                </div>
              </div>
              <div class="product-quantity buttonset" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                <button type="button" class="change-cart-product-qty minus" data-type="minus"></button>
															<?php
															if ($_product->is_sold_individually()) {
																$min_quantity = 1;
																$max_quantity = 1;
															} else {
																$min_quantity = 1;
																$max_quantity = $_product->get_max_purchase_quantity();
															}
															$product_quantity = woocommerce_quantity_input(
																array(
																	'input_name' => "cart[{$cart_item_key}][qty]",
																	'input_value' => $cart_item['quantity'],
																	'max_value' => $max_quantity,
																	'min_value' => $min_quantity,
																	'product_name' => $product_name,
																),
																$_product,
																false
															);
															echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
															?>
                <button type="button" class="change-cart-product-qty plus" data-type="plus"></button>
              </div>
              <div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
															<?php
															$price = $_product->get_price();
															$reg_price = $_product->get_regular_price();

															if ($price !== $reg_price): ?>
                 <div class="price regular">
																		<?php echo $reg_price * intval($cart_item['quantity']).'₽'; ?>
                 </div>
															<?php endif; ?>
                <div class="price <?php if ($price !== $reg_price) echo 'sale';?>"><?php echo $price * intval($cart_item['quantity']).'₽' ?></div>
              </div>
            <div class="product-remove">
             <button type="button" class="cart-remove-product" data-id="<?php echo $product_id; ?>">
               <img src="<?php echo IMAGES_PATH . 'remove.svg';?>" alt="Удалить <?php echo $_product->name?> из корзины">
             </button>
<!--													--><?php
//													echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
//														'woocommerce_cart_item_remove_link',
//														sprintf(
//															'<a href="%s" class="" aria-label="%s" data-product_id="%s" data-product_sku="%s"></a>',
//															esc_url(wc_get_cart_remove_url($cart_item_key)),
//															/* translators: %s is the product name */
//															esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
//															esc_attr($product_id),
//															esc_attr($_product->get_sku())
//														),
//														$cart_item_key
//													);
//													?>
            </div>
          </div>
								<?php
								}
								}
								?>
									<?php do_action('woocommerce_cart_contents'); ?>
          <div>
            <div colspan="6" class="actions">
              <button type="submit"
                      class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
                      name="update_cart"
                      value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

													<?php do_action('woocommerce_cart_actions'); ?>

													<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
            </div>
          </div>
									<?php do_action('woocommerce_after_cart_contents'); ?>
        </div>
							<?php do_action('woocommerce_after_cart_table'); ?>
      </div>
      <div class="cart-block__side">
        side
      </div>
    </div>
    </div>
  </form>
<?php do_action('woocommerce_before_cart_collaterals'); ?>
<?php do_action('woocommerce_after_cart');


get_template_part('parts/new');
get_template_part('parts/extra-sale');
get_template_part('parts/map');
get_template_part('parts/footer'); ?>