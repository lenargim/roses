<?php $cart = WC()->cart; ?>
<div class="cart-block__table-wrap">
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
            global $product;
						$product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
						$product_name = apply_filters('woocommerce_cart_item_name', $product->get_name(), $cart_item, $cart_item_key);
						if ($product && $product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
							$product_permalink = apply_filters('woocommerce_cart_item_permalink', $product->is_visible() ? $product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
							?>
        <div
            class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
          <div class="product-thumbnail">
											<?php
											$img_src_arr = wp_get_attachment_image_src($product->get_image_id(), 'product-thumb');
											$product_img = lenar_get_img($img_src_arr ? $img_src_arr[0] : '');
											?>
            <img src="<?php echo $product_img; ?>" alt="<?php echo $product_name?>">
            <div class="product-data">
              <div class="product-name"><?php echo $product_name; ?></div>
            </div>
          </div>
          <div class="product-quantity buttonset" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
            <button type="button" class="change-cart-product-qty minus" data-type="minus"
                    data-key="<?php echo $cart_item_key; ?>"></button>
											<?php
											if ($product->is_sold_individually()) {
												$min_quantity = 1;
												$max_quantity = 1;
											} else {
												$min_quantity = 1;
												$max_quantity = $product->get_max_purchase_quantity();
											}
											$product_quantity = woocommerce_quantity_input(
												array(
													'input_name' => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value' => $max_quantity,
													'min_value' => $min_quantity,
													'product_name' => $product_name,
													'readonly' => 'readonly'
												),
												$product,
												false
											);
											echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
											?>
            <button type="button" class="change-cart-product-qty plus" data-type="plus"
                    data-key="<?php echo $cart_item_key; ?>"></button>
          </div>
          <div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
											<?php
											$price = $product->get_price();
											$reg_price = $product->get_regular_price();

											if ($price !== $reg_price): ?>
             <div class="price regular">
														<?php echo $reg_price * intval($cart_item['quantity']) . '₽'; ?>
             </div>
											<?php else: ?>
             <div class="price empty">0₽</div>
											<?php endif; ?>
            <div
                class="price <?php if ($price !== $reg_price) echo 'sale'; ?>"><?php echo $price * intval($cart_item['quantity']) . '₽' ?></div>
          </div>
          <div class="product-remove">
											<?php echo do_shortcode('[wishsuite_button]') ?>
            <button type="button" class="cart-remove-product" data-id="<?php echo $product_id; ?>">
              <img src="<?php echo IMAGES_PATH . 'remove.svg'; ?>"
                   alt="Удалить <?php echo $product->name ?> из корзины">
            </button>
          </div>
        </div>
							<?php
						}
					}
					?>
      <!--					--><?php //do_action('woocommerce_cart_contents'); ?>
      <!--      <div>-->
      <!--        <div class="actions">-->
      <!--          <button type="submit"-->
      <!--                  class="button-->
					<?php //echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?><!--"-->
      <!--                  name="update_cart"-->
      <!--                  value="--><?php //esc_attr_e('Update cart', 'woocommerce'); ?><!--"></button>-->
      <!--									--><?php //do_action('woocommerce_cart_actions'); ?>
      <!--									--><?php //wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
      <!--        </div>-->
      <!--      </div>-->
      <!--					--><?php //do_action('woocommerce_after_cart_contents'); ?>
    </div>
    <!--			--><?php //do_action('woocommerce_after_cart_table'); ?>
  </div>
</div>
<div class="cart-block__side-wrap">
  <div class="cart-block__side">
    <div class="cart-block__side-block">
      <div class="cart-block__side-row">
        <span>Количество товаров</span>
        <span><?php echo $cart->get_cart_contents_count() ?></span>
      </div>
    </div>
    <div class="cart-block__side-block">
      <div class="cart-block__side-row">
        <span>Сумма заказа</span>
        <span><?php echo get_total_products_discount()['regular_total'] . '₽'; ?></span>
      </div>
      <div class="cart-block__side-row">
        <span>Скидка</span>
        <span><?php echo get_total_products_discount()['discount_total'] . '₽'; ?></span>
      </div>
    </div>
  </div>
  <div class="cart-block__after">
    <a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>" class="button big violet">Вернуться в
      каталог</a>
    <a href="<?php echo get_page_link('sign-in'); ?>" class="button big orange">Зарегистрироваться</a>
    <p class="text">Зарегистрированным пользователям доступны все функции личного кабинета: избранное, лист ожидания,
      список желаний, история заказов, а также возможность копить баллы и получать скидки!</p>
  </div>
</div>