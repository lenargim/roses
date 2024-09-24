<?php

if (empty($_COOKIE['woocommerce_recently_viewed_2'])) {
	$viewed_products = array();
} else {
	$viewed_products = (array)explode('|', $_COOKIE['woocommerce_recently_viewed_2']);
}

if (empty($viewed_products)) {
	return;
} else {
	$viewed_products = array_reverse(array_map('absint', $viewed_products));
	$product_ids = join(",", $viewed_products);
	?>
  <section class="section background">
    <div class="container">
      <h2 class="h2">Вы недавно смотрели</h2>
					<?php echo do_shortcode("[products ids='$product_ids']"); ?>
    </div>
  </section>

<?php } ?>
