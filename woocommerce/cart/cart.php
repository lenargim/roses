<?php defined('ABSPATH') || exit; ?>

<div class="refresh-cart">
	<?php $cart = WC()->cart;
	$cart_size = sizeof($cart->get_cart()); ?>
  <form class="cart-block__wrap" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
			<?php if ($cart_size > 0):
				echo wc_get_template('cart/cart-filled.php');
			else:
				echo wc_get_template('cart/cart-empty.php');
			endif; ?>
  </form>

	<?php if ($cart_size > 0): ?>
		<?php echo do_shortcode('[woocommerce_checkout]') ?>
	<?php endif; ?>

</div>