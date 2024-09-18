<div class="wishsuite-table-content wishlist">
  <div class="wishlist__top">
    <h2 class="wishlist__title">Избранные товары</h2>
    <button class="wishlist__reset button white" type="button" data-user-id="<?php echo get_current_user_id(); ?>">Очистить избранное</button>
  </div>
  <div class="wishsuite_table wishlist__list">
			<?php
			if (!empty($products)):
				foreach ($products as $product_id => $product):
					$_product = wc_get_product($product_id);
					$image = isset($product['image']) ? $product['image'] : '<img src="' . lenar_get_img('') . '"/>'; ?>
      <div
          class="wishlist__item woocommerce-cart-form__cart-item">
        <div class="product-thumbnail">
									<?php echo $image ?>
          <div class="product-data">
            <div class="product-name"><?php echo $product['title']; ?></div>
          </div>
        </div>
        <div class="product-quantity buttonset" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
          <button type="button" class="change-cart-product-qty minus" data-type="minus"></button>
          <input type="text" readonly="readonly" id="quantity_<?php echo $product_id; ?>" class="input-text qty text"
                 value="1"
                 aria-label="Количество товара" min="1" max="<?php echo $_product->get_max_purchase_quantity(); ?>">
          <button type="button" class="change-cart-product-qty plus" data-type="plus"></button>
        </div>
        <div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
									<?php
									$price = $_product->get_price();
									$reg_price = $_product->get_regular_price();
									if ($price !== $reg_price): ?>
           <div class="price regular">
												<?php echo $reg_price . '₽'; ?>
           </div>
									<?php else: ?>
           <div class="price empty">0₽</div>
									<?php endif; ?>
          <div
              class="price <?php if ($price !== $reg_price) echo 'sale'; ?>"><?php echo $price . '₽' ?></div>
        </div>
							<?php echo $product['add_to_cart']; ?>
        <div class="product-remove ">
          <a type="button" class="wishlist-remove-product wishsuite-remove" data-product_id="<?php echo $product_id; ?>">
            <img src="<?php echo IMAGES_PATH . 'remove.svg'; ?>"
                 alt="Удалить <?php echo $product['title']; ?> из корзины">
          </a>
        </div>
      </div>

				<?php endforeach; ?>
			<?php else: ?>
     <div class="wishsuite-emplty-text wishlist__empty">
       У Вас нет избранных товаров
     </div>
			<?php endif; ?>
  </div>
  <div class="wishsuite-table-content-loader"></div>
</div>