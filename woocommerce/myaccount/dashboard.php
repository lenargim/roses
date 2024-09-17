<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $user;

//var_dump($user);
$name = '';
if (isset($user['last_name'][0]) && $user['last_name'][0] !== '') {
	$name .= $user['last_name'][0];
}
if (isset($user['first_name'][0]) && $user['first_name'][0] !== '') {
	$name .= ' ' . $user['first_name'][0];
}
if (isset($user['billing_patronymic_name'][0]) && $user['billing_patronymic_name'][0] !== '') {
	$name .= ' ' . $user['billing_patronymic_name'][0];
}

$address = '';
if (isset($user['billing_postcode'][0]) && $user['billing_postcode'][0] !== '') {
	$address .= $user['billing_postcode'][0] . '.';
}
if (isset($user['billing_country'][0]) && $user['billing_country'][0] !== '') {
	$address .= ' ' . $user['billing_country'][0];
}
if (isset($user['billing_state'][0]) && $user['billing_state'][0] !== '') {
	$address .= ' ' . $user['billing_state'][0];
}
if (isset($user['billing_city'][0]) && $user['billing_city'][0] !== '') {
	$address .= ' г. ' . $user['billing_city'][0];
}
if (isset($user['billing_address_1'][0]) && $user['billing_address_1'][0] !== '') {
	$address .= ' ул. ' . $user['billing_address_1'][0];
}
if (isset($user['billing_home'][0]) && $user['billing_home'][0] !== '') {
	$address .= ' дом ' . $user['billing_home'][0];
}
if (isset($user['billing_body'][0]) && $user['billing_body'][0] !== '') {
	$address .= ' корпус ' . $user['billing_body'][0];
}
if (isset($user['billing_apartment'][0]) && $user['billing_apartment'][0] !== '') {
	$address .= ' ' . $user['billing_apartment'][0] . ' кв.';
}

$name = preg_replace('/\s\s+/', ' ', $name);
$address = preg_replace('/\s\s+/', ' ', $address);
?>

  <div class="account__personal">
    <div class="account__personal-data">
      <div class="account__personal-title">Личные данные</div>
      <div class="account__personal-table">
        <span>Логин:</span><span><?php echo $user['nickname'][0] ?></span>
        <span>ФИО:</span><span><?php echo $name; ?></span>
        <span>Email</span><span><?php echo $user['billing_email'][0]; ?></span>
        <span>Телефон:</span><span><?php echo $user['billing_phone'][0]; ?></span>
        <span>Адрес:</span><span><?php echo $address; ?></span>
      </div>
      <div class="account__personal-button-box">
        <button type="button" class="account__personal-button">Редактировать данные</button>
      </div>
    </div>
    <div class="account__personal-sale"></div>
  </div>

<?php
$customer_orders = wc_get_orders(apply_filters('woocommerce_my_account_my_orders_query', array(
	'customer' => get_current_user_id(),
	'page' => 1,
	'paginate' => true,
)));

wc_get_template('myaccount/order-table.php', array('search_year' => $current_year = date("Y"))); ?>