<?php
defined('ABSPATH') || exit;

if(!is_user_logged_in()){
	wp_redirect( get_permalink(get_page_by_path('sign-in')));
}
?>

<div class="account">
	<?php do_action('woocommerce_account_content'); ?>
</div>
