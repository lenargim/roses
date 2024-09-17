<?php
defined('ABSPATH') || exit;

if(!is_user_logged_in()){
	wp_redirect(get_permalink('498'));
}

do_action('woocommerce_account_navigation'); ?>

<div class="account">
	<?php do_action('woocommerce_account_content'); ?>
</div>
