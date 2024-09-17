<?php
if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_account_navigation');
global $woocommerce;
$items = $woocommerce->cart->get_cart();

?>

<nav class="account__nav" aria-label="<?php esc_html_e('Account pages', 'woocommerce'); ?>">
  <ul>
    <!--		--><?php //foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
    <!--			<li class="--><?php //echo wc_get_account_menu_item_classes( $endpoint ); ?><!--">-->
    <!--				<a href="--><?php //echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?><!--">-->
			<?php //echo esc_html( $label ); ?><!--</a>-->
    <!---->
    <!--			</li>-->
    <!--		--><?php //endforeach; ?>
    <li><a class="account__nav-link" href="<?php echo esc_url(wc_get_account_endpoint_url('dashboard')) ?>"><span>Мой профиль</span></a></li>
    <li><a class="account__nav-link" href="<?php echo wc_get_checkout_url(); ?>">
        <span>Корзина</span>
        <span>товаров <?php echo count($items); ?></span>
      </a></li>
    <li><a class="account__nav-link" href="#">
        <span>Избранное</span>
        <span>товаров 0</span>
      </a></li>
    <li><a class="account__nav-link" href="#">Уведомления</a></li>
    <li><a class="account__nav-link" href="#">Лист ожидания</a></li>
    <li><a class="account__nav-link" href="#">Подписки</a></li>
    <li><a class="account__nav-link" href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Вернуться в каталог</a></li>
    <li><a class="account__nav-link" href="<?php echo esc_url(wc_get_account_endpoint_url('customer-logout')) ?>">Выйти</a></li>

  </ul>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>
