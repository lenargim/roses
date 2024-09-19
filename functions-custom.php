<?php

add_action('wp_enqueue_scripts', 'lenar_enqueue_scripts', 9999);
add_action('wp_head', 'lenar_enqueue_scripts', 9999);
function lenar_enqueue_scripts()
{
	wp_enqueue_style('main-styles', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'), false);
	wp_enqueue_script('main-scripts', get_template_directory_uri() . '/main.min.js', array('jquery'));
	wp_enqueue_script('mask-scripts', get_template_directory_uri() . '/assets/js/jquery.mask.min.js', array('jquery'));

	wp_deregister_style('storefront-woocommerce-style');
	wp_deregister_style('berocket_aapf_widget-style');
	wp_deregister_style('storefront-style');
	wp_deregister_style('gutenberg-blocks');
	wp_deregister_style('main-styles-css');
	wp_deregister_style('tablepress-default-css');
	wp_deregister_style('wishsuite-frontend');
	remove_theme_support('wc-product-gallery-zoom');

	if (is_front_page()) {
		wp_enqueue_style('swiper-styles', 'https://unpkg.com/swiper@8/swiper-bundle.min.css');
		wp_enqueue_script('swiper-lib', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array('jquery'));
		wp_enqueue_script('home-script', get_template_directory_uri() . '/assets/js/home.js', array('swiper-lib'));
	}

	if (is_product_category() || is_product_tag() || is_shop() || is_product()) {
		wp_enqueue_style('swiper-styles', 'https://unpkg.com/swiper@8/swiper-bundle.min.css');
		wp_enqueue_script('swiper-lib', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array('jquery'));
		wp_enqueue_script('shop-script', get_template_directory_uri() . '/assets/js/shop.js', array('swiper-lib'));
	}

	wp_enqueue_script('selectWoo', WC()->plugin_url() . '/assets/js/selectWoo/selectWoo.full.min.js', array('jquery'), '1.0.6');
	wp_dequeue_style('select2');
	wp_dequeue_style('berocket_aapf_widget-style');
	if (is_cart()) {
		wp_enqueue_script('cart-script', get_template_directory_uri() . '/assets/js/cart.js', array('jquery'));
	}

	if (is_page('about')) {
		wp_enqueue_style('swiper-styles', 'https://unpkg.com/swiper@8/swiper-bundle.min.css');
		wp_enqueue_script('swiper-lib', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array('jquery'));
		wp_enqueue_script('about-script', get_template_directory_uri() . '/assets/js/about.js', array('swiper-lib'));
	}

	if (is_page(229) || is_cart()) {
		wp_register_script('dadata', 'https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/js/jquery.suggestions.min.js');
		wp_enqueue_script('dadata');
		wp_enqueue_style('dadata-style', 'https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/css/suggestions.min.css');
		wp_enqueue_script('dadata-style');
		wp_enqueue_script('delivery-script', get_template_directory_uri() . '/assets/js/delivery.js', array('dadata'));
	}

	if (is_page(304)) {
		wp_enqueue_style('swiper-styles', 'https://unpkg.com/swiper@8/swiper-bundle.min.css');
		wp_enqueue_script('swiper-lib', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array('jquery'));
		wp_enqueue_script('club-script', get_template_directory_uri() . '/assets/js/club.js', array('swiper-lib'));
	}

	if (is_page('sign-in')) {
		wp_enqueue_script('sign-in-script', get_template_directory_uri() . '/assets/js/sign-in.js', array('jquery'));
	}

	$translation_array = array('templateUrl' => get_stylesheet_directory_uri());
	wp_localize_script('shop-script', 'object_name', $translation_array);


	if (is_account_page() || is_page('wishsuite')) {
		wp_enqueue_style('swiper-styles', 'https://unpkg.com/swiper@8/swiper-bundle.min.css');
		wp_enqueue_script('swiper-lib', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array('jquery'));
		wp_enqueue_script('account-script', get_template_directory_uri() . '/assets/js/account.js', array('swiper-lib'));
	}
}

add_action('init', 'lenar_init');
function lenar_init()
{
	register_post_type('services', array(
		'labels' => array(
			'name' => 'Услуги', // Основное название типа записи
			'singular_name' => 'Услуга', // отдельное название записи типа Book
			'add_new' => 'Добавить услугу',
			'add_new_item' => 'Добавить новую услугу',
			'edit_item' => 'Редактировать услугу',
			'new_item' => 'Новая услуга',
			'view_item' => 'View',
			'search_items' => 'Искать услугу',
			'not_found' => 'not found',
			'not_found_in_trash' => 'not_found_in_trash',
			'parent_item_colon' => '',
			'menu_name' => 'Услуги'

		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-list-view',
		'supports' => array('title', 'excerpt', 'thumbnail')
	));

	register_post_type('vacancy', array(
		'labels' => array(
			'name' => 'Вакансии', // Основное название типа записи
			'singular_name' => 'Вакансия', // отдельное название записи типа Book
			'add_new' => 'Добавить вакансию',
			'add_new_item' => 'Добавить новую вакансию',
			'edit_item' => 'Редактировать вакансию',
			'new_item' => 'Новая вакансия',
			'view_item' => 'View',
			'search_items' => 'Искать вакансию',
			'not_found' => 'not found',
			'not_found_in_trash' => 'not_found_in_trash',
			'parent_item_colon' => '',
			'menu_name' => 'Вакансии'

		),
		'public' => true,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-list-view',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail')
	));

	add_image_size('product-new', 137, 137, ['center', 'center']);
	add_image_size('extra-sale', 345, 200, ['center', 'center']);
	add_image_size('product-category', 200, 200, ['center', 'center']);
	add_image_size('product-img', 520, 520, ['center', 'center']);
	add_image_size('product-thumb', 73, 73, ['center', 'center']);
}

function trim_phone($phone)
{
	return str_replace(['(', ')', ' ', '-', '+'], '', $phone);
}

function lenar_get_img($link)
{
	return $link ?: wc_placeholder_img_src();
}

add_filter('loop_shop_per_page', 'truemisha_products_per_page', 20);

function truemisha_products_per_page($per_page)
{
	return 18;
}

add_filter('upload_mimes', 'svg_upload_allow');

function svg_upload_allow($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);
function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
{

	if (version_compare($GLOBALS['wp_version'], '5.1.0', '>=')) {
		$dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
	} else {
		$dosvg = ('.svg' === strtolower(substr($filename, -4)));
	}
	if ($dosvg) {

		if (current_user_can('manage_options')) {

			$data['ext'] = 'svg';
			$data['type'] = 'image/svg+xml';
		} else {
			$data['ext'] = false;
			$data['type'] = false;
		}
	}
	return $data;
}

add_filter('wp_prepare_attachment_for_js', 'show_svg_in_media_library');

# Формирует данные для отображения SVG как изображения в медиабиблиотеке.
function show_svg_in_media_library($response)
{

	if ($response['mime'] === 'image/svg+xml') {

		// Без вывода названия файла
		$response['sizes'] = [
			'medium' => [
				'url' => $response['url'],
			],
			// при редактирования картинки
			'full' => [
				'url' => $response['url'],
			],
		];
	}
	return $response;
}

function get_prod_stock_status_label($stock_status)
{
	if ($stock_status === 'instock'):
		$stock_status_ru = 'В наличии';
 elseif ($stock_status === 'outofstock'):
		$stock_status_ru = 'Нет в наличии';
	else:
		$stock_status_ru = 'Предзаказ';
	endif;
	return $stock_status_ru;
}

// enable gutenberg for woocommerce
function activate_gutenberg_product($can_edit, $post_type)
{
	if ($post_type == 'product') {
		$can_edit = true;
	}
	return $can_edit;
}

add_filter('use_block_editor_for_post_type', 'activate_gutenberg_product', 10, 2);

// enable taxonomy fields for woocommerce with gutenberg on
function enable_taxonomy_rest($args)
{
	$args['show_in_rest'] = true;
	return $args;
}

add_filter('woocommerce_taxonomy_args_product_cat', 'enable_taxonomy_rest');
add_filter('woocommerce_taxonomy_args_product_tag', 'enable_taxonomy_rest');

function remove_short_description()
{
	remove_meta_box('postexcerpt', 'product', 'normal');
}

add_action('add_meta_boxes', 'remove_short_description', 999);

add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');

function wc_customize_product_sorting($sorting_options)
{
	$sorting_options = [
		'price' => __('По цене', 'woocommerce'),
		'price-desc' => __('По цене', 'woocommerce'),
		'popularity' => __('Sort by popularity', 'woocommerce'),
		'date' => __('По новизне', 'woocommerce'),
		'title' => __('По алфавиту (А-Я)', 'woocommerce'),
		'title-desc' => __('По алфавиту (Я-А)', 'woocommerce'),
	];
	return $sorting_options;
}


add_filter('term_link', 'truemisha_ne_sbrasyvat_filtr', 10, 3);
function truemisha_ne_sbrasyvat_filtr($url, $term, $taxonomy)
{
	// сначала мы проверяем, присутствует у нас в данный момент сортировка
	$orderby = !empty($_GET['orderby']) ? $_GET['orderby'] : '';
	// если присутствует, то добавляем её в конечный урл
	if ($orderby) {
		return add_query_arg('orderby', $orderby, $url);
	} else {
		return $url;
	}
}


add_action('template_redirect', 'truemisha_recently_viewed_product_cookie', 20);
function truemisha_recently_viewed_product_cookie()
{
	// если находимся не на странице товара, ничего не делаем
	if (!is_product()) {
		return;
	}
	if (empty($_COOKIE['woocommerce_recently_viewed_2'])) {
		$viewed_products = array();
	} else {
		$viewed_products = (array)explode('|', $_COOKIE['woocommerce_recently_viewed_2']);
	}
	// добавляем в массив текущий товар
	if (!in_array(get_the_ID(), $viewed_products)) {
		$viewed_products[] = get_the_ID();
	}
	// нет смысла хранить там бесконечное количество товаров
	if (sizeof($viewed_products) > 4) {
		array_shift($viewed_products); // выкидываем первый элемент
	}
	// устанавливаем в куки
	wc_setcookie('woocommerce_recently_viewed_2', join('|', $viewed_products));
}

//add_shortcode('recently_viewed_products', 'truemisha_recently_viewed_products');

function truemisha_recently_viewed_products()
{
	if (empty($_COOKIE['woocommerce_recently_viewed_2'])) {
		$viewed_products = array();
	} else {
		$viewed_products = (array)explode('|', $_COOKIE['woocommerce_recently_viewed_2']);
	}

	if (empty($viewed_products)) {
		return;
	}
	// надо ведь сначала отображать последние просмотренные
	$viewed_products = array_reverse(array_map('absint', $viewed_products));
	$product_ids = join(",", $viewed_products);
	return do_shortcode("[products ids='$product_ids']");
}

// NOTE: 8 - before `wp_print_head_scripts`
add_action('wp_head', 'myajax_data', 8);
function myajax_data()
{
	$data = [
		'url' => admin_url('admin-ajax.php'),
		'security' => wp_create_nonce('file_upload'),
	];
	?>
  <script id="myajax_data">
    window.myajax = <?= wp_json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>
  </script>
	<?php
}


add_action('wp_ajax_empty_cart', 'lenar_empty_cart');
add_action('wp_ajax_nopriv_empty_cart', 'lenar_empty_cart');

function lenar_empty_cart()
{
	WC()->cart->empty_cart();
	ob_start();
	wc_get_template('cart/cart.php');
	$output = ob_get_contents();
	ob_end_clean();
	echo $output;
	wp_die();
}

function remove_item_from_cart()
{
	$cart = WC()->instance()->cart;
	$id = $_POST['product_id'];
	$cart_id = $cart->generate_cart_id($id);
	$cart_item_id = $cart->find_product_in_cart($cart_id);

	if ($cart_item_id) {
		$cart->set_quantity($cart_item_id, 0);
		ob_start();
		wc_get_template('cart/cart.php');
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		wp_die();
	}
	return false;
}

add_action('wp_ajax_remove_item_from_cart', 'remove_item_from_cart');
add_action('wp_ajax_nopriv_remove_item_from_cart', 'remove_item_from_cart');


function update_item_amount_in_cart()
{
	$key = sanitize_text_field($_POST['key']);
	$number = intval(sanitize_text_field($_POST['number']));
	if ($key && $number > 0) {
		WC()->cart->set_quantity($key, $number);
		ob_start();
		wc_get_template('cart/cart.php');
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		wp_die();

	}
	return false;
}

add_action('wp_ajax_update_item_amount_in_cart', 'update_item_amount_in_cart'); // If called from admin panel
add_action('wp_ajax_nopriv_update_item_amount_in_cart', 'update_item_amount_in_cart'); // If called from elsewhere


add_action('wp_ajax_get_login_modal', 'lenar_get_login_modal');
add_action('wp_ajax_nopriv_get_login_modal', 'lenar_get_login_modal');

function lenar_get_login_modal()
{
	ob_start();
	wc_get_template('auth/form-login.php');
	$output = ob_get_contents();
	ob_end_clean();
	echo $output;
	wp_die();
}

add_action('wp_ajax_get_questions_modal', 'lenar_get_questions_modal');
add_action('wp_ajax_nopriv_get_questions_modal', 'lenar_get_questions_modal');

function lenar_get_questions_modal()
{
	ob_start();
	wc_get_template('auth/form-questions.php');
	$output = ob_get_contents();
	ob_end_clean();
	echo $output;
	wp_die();
}


function get_total_products_discount()
{
	$discount_total = 0;
	$regular_total = 0;

	foreach (WC()->cart->get_cart() as $cart_item_key => $values) {

		$_product = $values['data'];
		$regular_price = $_product->get_regular_price();
		if ($_product->is_on_sale()) {
			$sale_price = $_product->get_sale_price();
			$discount = ($regular_price - $sale_price) * $values['quantity'];
			$discount_total += $discount;
		}
		$regular_total += $regular_price * $values['quantity'];

	}
	$data['discount_total'] = $discount_total;
	$data['regular_total'] = $regular_total;
	return $data;
}


add_filter('woocommerce_checkout_fields', 'del_checkout_fields', 9999);

function del_checkout_fields($fields)
{
	unset($fields['billing']['billing_last_name']);
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_address_2']);
	unset($fields['billing']['billing_city']);
	unset($fields['billing']['billing_state']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['order']['order_comments']);
	return $fields;

}

// Убрать таблицу товаров из checkout
remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);
add_filter('woocommerce_cart_needs_shipping_address', '__return_false');


function get_payment_methods()
{
	$WC_Payment_Gateways = new WC_Payment_Gateways();
	$available_gateways = $WC_Payment_Gateways->get_available_payment_gateways();

	$data = [];
	foreach ($available_gateways as $gateway):
		$object = new stdClass();
		$object->id = $gateway->id;
		$object->text = $gateway->get_title();
		$object->shortText = $gateway->get_description();
		$data[] = $object;
	endforeach;

	echo json_encode($data);
	wp_die();
}

add_action('wp_ajax_get_payment_methods', 'get_payment_methods'); // If called from admin panel
add_action('wp_ajax_nopriv_get_payment_methods', 'get_payment_methods'); // If called from elsewhere


add_action('woocommerce_before_checkout_form', 'bbloomer_uncheck_default_payment_gateway');
function bbloomer_uncheck_default_payment_gateway()
{
	wc_enqueue_js("
 
      // ONLY RUN ON CHECKOUT PAGE LOAD
      $( document.body ).on( 'updated_checkout', function() {
          
         // ONLY RUN IF MORE THAN 1 PAYMENT OPTION
         if ( $( '.woocommerce-checkout' ).find( 'input[name=\'payment_method\']' ).length === 1 ) return false;
 
         // UNCHECK CHECKED PAYMENT METHOD
         $('input[name=\'payment_method\']').prop('checked', false);
          
         // CLOSE CHECKED PAYMENT DESCRIPTION BOX
         $('div.payment_box').hide();
 
      });
   ");
}

add_filter('wpcf7_form_response_output', '__return_empty_string');

add_filter('woocommerce_checkout_redirect_empty_cart', '__return_false');
add_filter('woocommerce_checkout_update_order_review_expired', '__return_false');

add_filter('wc_add_to_cart_message_html', '__return_null');


add_action('wp_ajax_ajax_order', 'submited_ajax_order_data');
add_action('wp_ajax_nopriv_ajax_order', 'submited_ajax_order_data');
function submited_ajax_order_data()
{
	if (isset($_POST['fields']) && !empty($_POST['fields'])) {

		$order = new WC_Order();
		$cart = WC()->cart;
		$checkout = WC()->checkout;
		$data = [];

		// Loop through posted data array transmitted via jQuery
		foreach ($_POST['fields'] as $values) {
			// Set each key / value pairs in an array
			$data[$values['name']] = $values['value'];
		}

		$cart_hash = md5(json_encode(wc_clean($cart->get_cart_for_session())) . $cart->total);
		$available_gateways = WC()->payment_gateways->get_available_payment_gateways();

		// Loop through the data array
		foreach ($data as $key => $value) {
			// Use WC_Order setter methods if they exist
			if (is_callable(array($order, "set_{$key}"))) {
				$order->{"set_{$key}"}($value);

				// Store custom fields prefixed with wither shipping_ or billing_
			} elseif ((0 === stripos($key, 'billing_') || 0 === stripos($key, 'shipping_'))
				&& !in_array($key, array('shipping_method', 'shipping_total', 'shipping_tax'))) {
				$order->update_meta_data('_' . $key, $value);
			}
		}

		$user_id = get_current_user_id();

		$order->set_created_via('checkout');
		$order->set_cart_hash($cart_hash);
		$order->set_customer_id($user_id ?? '');
		$order->set_currency(get_woocommerce_currency());
		$order->set_prices_include_tax('yes' === get_option('woocommerce_prices_include_tax'));
		$order->set_customer_ip_address(WC_Geolocation::get_ip_address());
		$order->set_customer_user_agent(wc_get_user_agent());
		$order->set_customer_note(isset($data['order_comments']) ? $data['order_comments'] : '');
		$order->set_payment_method(isset($available_gateways[$data['payment_method']]) ? $available_gateways[$data['payment_method']] : $data['payment_method']);
		$order->set_shipping_total($cart->get_shipping_total());
		$order->set_discount_total($cart->get_discount_total());
		$order->set_discount_tax($cart->get_discount_tax());
		$order->set_cart_tax($cart->get_cart_contents_tax() + $cart->get_fee_tax());
		$order->set_shipping_tax($cart->get_shipping_tax());
		$order->set_total($cart->get_total('edit'));

		$checkout->create_order_line_items($order, $cart);
		$checkout->create_order_fee_lines($order, $cart);
		$checkout->create_order_shipping_lines($order, WC()->session->get('chosen_shipping_methods'), WC()->shipping->get_packages());
		$checkout->create_order_tax_lines($order, $cart);
		$checkout->create_order_coupon_lines($order, $cart);

		do_action('woocommerce_checkout_create_order', $order, $data);
		$order_id = $order->save();
		do_action('woocommerce_checkout_update_order_meta', $order_id, $data);
		WC()->cart->empty_cart();
		echo 'New order created with order ID: #' . $order_id . '.';
	}
	die();
}

add_action('wp_logout', 'misha_logout_redirect', 5);

function misha_logout_redirect()
{
	wp_safe_redirect(get_home_url());
	exit;
}

add_filter('authenticate', 'misha_redirect_at_authenticate', 101, 3);

function misha_redirect_at_authenticate($user, $username, $password)
{

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (is_wp_error($user)) {
			$error_codes = join(',', $user->get_error_codes());

			$login_url = home_url('/401/');
			$login_url = add_query_arg('errno', $error_codes, $login_url);

			wp_redirect($login_url);
			exit;
		}
	}

	return $user;
}


add_action('wp_ajax_update_account_img', 'update_account_img');
add_action('wp_ajax_nopriv_update_account_img', 'update_account_img');

function update_account_img()
{
	$file = $_FILES['image'];
	$user_id = get_current_user_id();
	$attachment_id = media_handle_upload('image', 0);
	if (is_wp_error($attachment_id)) {
		update_user_meta($user_id, 'image', $file . ": " . $attachment_id->get_error_message());
		echo $attachment_id->get_error_message();
	} else {
		$old_attachment_id = get_user_meta($user_id, 'image', true);
		wp_delete_attachment($old_attachment_id);
		update_user_meta($user_id, 'image', $attachment_id);
		echo wp_get_attachment_image_url($attachment_id, 'product-new');
	}
	wp_die();
}

function get_ru_order_status($status)
{
	switch ($status) {
		case 'pending':
			return 'На рассмотрении';
		case 'processing':
			return 'Заказ подтвержден';
		case 'on-hold':
			return 'На удержании';
		case 'completed':
			return 'Получено';
		case 'cancelled':
			return 'Отменен';
		case 'refunded':
			return 'Возвращен';
		case 'failed':
			return 'Неудача';
	}
}


add_action('wp_ajax_update_orders_year', 'update_orders_year');
add_action('wp_ajax_nopriv_update_orders_year', 'update_orders_year');

function update_orders_year()
{
	$year = $_POST['year'];
	ob_start();
	wc_get_template('myaccount/order-table.php', array('search_year' => $year));
	$output = ob_get_contents();
	ob_end_clean();
	echo $output;
	wp_die();
}


add_action('wp_ajax_add_single_product', 'add_single_product');
add_action('wp_ajax_nopriv_add_single_product', 'add_single_product');

function add_single_product()
{
	$id = $_POST['id'];
//	ob_start();

//	$output = ob_get_contents();
//	ob_end_clean();

	global $woocommerce;
	if ($id) {
		$woocommerce->cart->add_to_cart($id, $quantity = 1, $variation_id = 0);
		echo '1';
	}
	wp_die();
}


add_filter('woocommerce_product_add_to_cart_text', 'wp_kama_woocommerce_product_add_to_cart_text_filter', 10, 2);

/**
	* Function for `woocommerce_product_add_to_cart_text` filter-hook.
	*
	* @param  $__
	* @param  $that
	*
	* @return
	*/
function wp_kama_woocommerce_product_add_to_cart_text_filter($__, $that)
{
	return 'купить';
}

add_action('wp_ajax_remove_wishlist_items', 'remove_wishlist_items');
add_action('wp_ajax_nopriv_remove_wishlist_items', 'remove_wishlist_items');

function remove_wishlist_items()
{
	global $wpdb;
	$user_id = $_POST['user_id'];
	if ($user_id) {
		$wpdb->get_results($wpdb->prepare(
			"DELETE FROM {$wpdb->prefix}wishsuite_list WHERE user_id = $user_id"
		));
	}
	$response = [
		'item_count' => (int)0,
		'message' => '',
		'html' => do_shortcode('[wishsuite_table]'),
		'total_pages' => (int)1,
		'current_page' => 1,
	];
	wp_send_json_success($response);
	die();
}


add_action('wp_ajax_send_advise', 'send_advise');
add_action('wp_ajax_nopriv_send_advise', 'send_advise');

function send_advise()
{
	$name = sanitize_text_field($_POST['name']);
	$phone = sanitize_text_field($_POST['phone']);
	$textarea = sanitize_text_field($_POST['textarea']);

	// Sent email registration automatic
	$to = SMTP_TO;
	$subject = 'Новое предложение';
	$body = 'Имя: ' . $name . '<br>Телефон: ' . $phone . '<br>Сообщение: ' . $textarea;
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$mailResult = false;
	$mailResult = wp_mail($to, $subject, $body, $headers);
	echo $mailResult;
	die();
}

add_action('wp_ajax_send_question', 'send_question');
add_action('wp_ajax_nopriv_send_question', 'send_question');

function send_question()
{
	$name = sanitize_text_field($_POST['name']);
	$phone = sanitize_text_field($_POST['phone']);
	$email = sanitize_text_field($_POST['email']);

	// Sent email registration automatic
	$to = SMTP_TO;
	$subject = 'Заказ звонка';
	$body = 'Имя: ' . $name . '<br>Телефон: ' . $phone . '<br>Email: ' . $email;
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$mailResult = false;
	$mailResult = wp_mail($to, $subject, $body, $headers);
	echo $mailResult;
	die();
}

add_action('wp_ajax_lost_password', 'lost_password');
add_action('wp_ajax_nopriv_lost_password', 'lost_password');

function lost_password()
{
	check_ajax_referer('ajax-login-nonce', 'nonce');
	$result = pcw_retrieve_password();
	$result_msg = is_wp_error($result) ? $result->get_error_message() : __('Проверьте свою электронную почту, чтобы найти ссылку для подтверждения');
	$result_status = is_wp_error($result) ? 'alert' : 'success';
	wp_send_json(array('sent' => !is_wp_error($result), 'status' => $result_status, 'msg' => $result_msg));
	die();
}


add_action('wp_ajax_new_password', 'new_password');
add_action('wp_ajax_nopriv_new_password', 'new_password');

function new_password()
{
	$user_name = sanitize_text_field($_POST['user_name']);
	$key = sanitize_text_field($_POST['key']);
	$password = $_POST['password'];

	$result = false;
	if (isset($user_name) && isset($password) && !empty($user_name) && !empty($password) && isset($key) && !empty($key)) {
		$user = check_password_reset_key($key, $user_name);
		if (!is_wp_error($user)) {
			reset_password($user, $password);
			$result = true;
		}
	}
	echo $result;

	die();
}


function pcw_retrieve_password()
{
	$errors = new WP_Error();

	if (empty($_POST['user_login']) || !is_string($_POST['user_login'])) {
		$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or email address.'));
	} elseif (strpos($_POST['user_login'], '@')) {
		$user_data = get_user_by('email', trim(wp_unslash($_POST['user_login'])));
		if (empty($user_data)) {
			$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no account with that username or email address.'));
		}
	} else {
		$login = trim($_POST['user_login']);
		$user_data = get_user_by('login', $login);
	}

	/**
		* Fires before errors are returned from a password reset request.
		*
		* @param WP_Error $errors A WP_Error object containing any errors generated
		*                         by using invalid credentials.
		* @since 4.4.0 Added the `$errors` parameter.
		*
		* @since 2.1.0
		*/
	do_action('lostpassword_post', $errors);

	if ($errors->has_errors()) {
		return $errors;
	}

	if (!$user_data) {
		$errors->add('invalidcombo', __('<strong>ERROR</strong>: There is no account with that username or email address.'));
		return $errors;
	}

	// Redefining user_login ensures we return the right case in the email.
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;
	$key = get_password_reset_key($user_data);

	if (is_wp_error($key)) {
		return $key;
	}

	if (is_multisite()) {
		$site_name = get_network()->site_name;
	} else {
		/*
		 * The blogname option is escaped with esc_html on the way into the database
		 * in sanitize_option we want to reverse this for the plain text arena of emails.
		 */
		$site_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
	}

	$message = "Получен запрос на сброс пароля для следующей учётной записи: \r\n\r\n";
	$message .= sprintf(__('Site Name: %s'), $site_name) . "\r\n\r\n";
	$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
	$message .= "Если Вы этого не делали, то просто проигнорируйте это письмо\r\n\r\n";
	$message .= "Или перейдите по ссылке для восстановления пароля: \r\n\r\n";
	$message .= '' . network_site_url("/new-password?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";

	$title = sprintf(__('[%s] Password Reset'), $site_name);

	$title = apply_filters('retrieve_password_title', $title, $user_login, $user_data);
	$message = apply_filters('retrieve_password_message', $message, $key, $user_login, $user_data);

	if ($message && !wp_mail($user_email, wp_specialchars_decode($title), $message)) {
		wp_die(__('The email could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.'));
	}

	return true;
}