<?php

//Template Name: Wishlist

defined('ABSPATH') || exit;

if (!is_user_logged_in()) {
	wp_redirect(get_permalink('498'));
}
get_template_part('parts/header');

global $current_user;
$user = get_user_meta($current_user->ID);
if (in_array('administrator', (array)$current_user->roles)) {
	$name = 'Администратор';
} elseif ($user['first_name'][0] && $user['billing_patronymic_name'][0]) {
	$name = $user['first_name'][0] . ' ' . $user['billing_patronymic_name'][0];
} elseif ($user['first_name'][0]) {
	$name = $user['first_name'][0];
} else {
	$name = $user['user'];
}
?>

<div class="account">
  <div class="container">
    <form method="post" class="account__top">
      <label class="account__top-img">
        <input type="file" class="account__top-img-input" id="account-img" name="image"
               accept="image/x-png,image/gif,image/jpeg">
							<?php if (isset($user['image'][0])): ?>
         <img src="<?php echo wp_get_attachment_image_url($user['image'][0], 'product-new'); ?>"
              alt="<?php echo $name; ?>">
							<?php else: ?>
         <img class="no-img" src="<?php echo IMAGES_PATH . 'rose.png' ?>" alt="<?php echo $name; ?>">
							<?php endif ?>
      </label>
      <div class="account__top-name">С возвращением, <?php echo $name; ?>!</div>
      <div class="account__top-app">
        <span>приложение</span>
        <img src="<?php the_field('app_qr', 16) ?>" alt="приложение rusroza">
        <span>rusroza</span>
      </div>
    </form>
    <div class="account__wrap">
      <aside class="account__sidebar">
							<?php do_action('woocommerce_account_navigation'); ?>
							<?php wc_get_template('myaccount/sidebar-actions.php') ?>
							<?php wc_get_template('myaccount/sidebar-new.php') ?>
      </aside>
      <main class="account__main">
        <div class="entry-content">
									<?php echo do_shortcode('[wishsuite_table]'); ?>
        </div>
      </main>
    </div>
  </div>
</div>


<?php
get_template_part('parts/services');
get_template_part('parts/map');
get_template_part('parts/footer'); ?>
