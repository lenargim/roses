<?php
if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_checkout_form', $checkout);
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout"
      action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

  <?php get_template_part('parts/delivery-calc'); ?>
	<?php echo wc_get_template('checkout/modal-order.php'); ?>
</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
