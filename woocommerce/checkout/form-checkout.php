<?php
if (!defined('ABSPATH')) {
	exit;
}

//do_action('woocommerce_before_checkout_form', $checkout);
$cart = WC()->cart; ?>
<form name="checkout" method="post" class="checkout woocommerce-checkout"
      action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
  <?php get_template_part('parts/delivery-calc'); ?>
  <div class="cart-block__bottom">
  <div class="cart-block__side-total">
    <span>Итого</span>
    <span><?php echo $cart->get_cart_total(); ?></span>
  </div>
  <div class="cart-block__side-arrange">
    <button type="button" class="button orange big open-order">оформить заказ</button>
    <div class="cart-block__side-accept">
      <div class="input-wrap">
        <input type="checkbox" id="accept" class="checkbox">
        <label for="accept">
            <span>Соглашаюсь с <a href="#" target="_blank">правилами питомника</a> по продаже и обмену
            саженцев</span>
        </label>
      </div>
    </div>
  </div>
  </div>
	<?php echo wc_get_template('checkout/modal-order.php'); ?>
</form>

<?php //do_action('woocommerce_after_checkout_form', $checkout); ?>
