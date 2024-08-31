<?php
defined('ABSPATH') || exit;
global $product;
/**
	* @hooked woocommerce_output_all_notices - 10
	*/
//do_action('woocommerce_before_single_product');

if (post_password_required()):
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
endif; ?>

<div class="product-single__title">
  <h1><?php the_title(); ?></h1>

	<?php
	$prod_id = $product->ID;
	$sku = $product->get_sku();
	$stock_label = get_prod_stock_status_label($product->get_stock_status());
	if ($sku): ?>
   <span class="sku">Артикул <?php echo $sku; ?></span>
	<?php endif; ?>
</div>
<div id="product-<?php the_ID(); ?>" class="product-single__wrap">
	<?php wc_get_template('single-product/product-image.php'); ?>
  <div class="product-single__summary">
    <div class="product-single__table">
      <div class="row">
        <span>
          Цена:
        </span>
        <span>
          <?php woocommerce_template_single_price() ?>
          <span class="data">
          <span class="total-sales"><?php echo $product->get_total_sales() . ' заказов'; ?></span>
          <span class="stock-status"><?php echo $stock_label; ?></span>
            </span>
        </span>
      </div>
      <div class="row">
        <span>
          Класс роз:
        </span>
        <span><?php echo yoast_get_primary_term('product_cat', $prod_id); ?></span>
      </div>
      <div class="row">
        <span>
          Возраст:
        </span>
        <span></span>
      </div>
      <div class="row">
        <span>
          Контейнер:
        </span>
        <span></span>
      </div>
      <div class="row">
        <span>
          Акция:
        </span>
        <span></span>
      </div>
    </div>
			<?php
			woocommerce_template_single_add_to_cart();
			/**
				* @hooked woocommerce_template_single_title - 5
				* @hooked woocommerce_template_single_rating - 10
				* @hooked woocommerce_template_single_price - 10
				* @hooked woocommerce_template_single_excerpt - 20
				* @hooked woocommerce_template_single_add_to_cart - 30
				* @hooked woocommerce_template_single_meta - 40
				* @hooked woocommerce_template_single_sharing - 50
				* @hooked WC_Sdivuctured_Data::generate_product_data() - 60
				*/
			//			do_action('woocommerce_single_product_summary');
			?>
  </div>
  <div class="product-single__desc">
    <h3>Описание товара</h3>
			<?php echo $product->get_description(); ?>
  </div>
  <div class="product-single__feature">
    <h3>Характеристики</h3>
			<?php wc_display_product_attributes($product); ?>
  </div>
	<?php
	/**
		* @hooked woocommerce_output_product_data_tabs - 10
		* @hooked woocommerce_upsell_display - 15
		* @hooked woocommerce_output_related_products - 20
		*/
	//	do_action('woocommerce_after_single_product_summary');
	?>
</div>

