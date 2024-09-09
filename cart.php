<?php
// Template Name: Cart
defined('ABSPATH') || exit;
get_template_part('parts/header');

?>
  <div class="cart-block section">
    <div class="container">
      <h1 class="h1">Корзина</h1>
					<?php echo wc_get_template('cart/cart.php'); ?>
    </div>
  </div>
  </div>

<?php echo do_shortcode('[woocommerce_checkout]') ?>
<?php
get_template_part('parts/new');
get_template_part('parts/extra-sale');
get_template_part('parts/map');
get_template_part('parts/footer'); ?>