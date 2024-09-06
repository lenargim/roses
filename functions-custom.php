<?php

add_action('wp_enqueue_scripts', 'lenar_enqueue_scripts', 9999);
add_action('wp_head', 'lenar_enqueue_scripts', 9999);
function lenar_enqueue_scripts()
{
	wp_enqueue_style('main-styles', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'), false);
	wp_enqueue_script('main-scripts', get_template_directory_uri() . '/main.min.js', array('jquery'));

	wp_deregister_style('storefront-woocommerce-style');
	wp_deregister_style('storefront-style');
	wp_deregister_style('gutenberg-blocks');
	remove_theme_support( 'wc-product-gallery-zoom' );

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

	wp_enqueue_script( 'selectWoo', WC()->plugin_url() . '/assets/js/selectWoo/selectWoo.full.min.js', array( 'jquery' ), '1.0.6' );
	wp_dequeue_style( 'select2' );
  if (is_cart()) {
			wp_enqueue_script('cart-script', get_template_directory_uri() . '/assets/js/cart.js', array('jquery'));
  }


	$translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
	wp_localize_script( 'shop-script', 'object_name', $translation_array );

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
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-list-view',
		'supports' => array('title', 'excerpt', 'thumbnail')
	));

	add_image_size('product-new', 137, 137, ['center', 'center']);
	add_image_size('extra-sale', 345, 200, ['center', 'center']);
	add_image_size('product-category', 200, 200, ['center', 'center']);
	add_image_size('product-img', 520, 520, ['center', 'center']);
	add_image_size('product-thumb', 73, 73, ['center', 'center']);
}

function trim_phone($phone)
{
	return str_replace(['(', ')', ' ', '-'], '', $phone);
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

add_filter( 'upload_mimes', 'svg_upload_allow' );

function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	return $mimes;
}

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	}
	else {
		$dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
	}
	if( $dosvg ){

		if( current_user_can('manage_options') ){

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		else {
			$data['ext']  = false;
			$data['type'] = false;
		}
	}
	return $data;
}
add_filter( 'wp_prepare_attachment_for_js', 'show_svg_in_media_library' );

# Формирует данные для отображения SVG как изображения в медиабиблиотеке.
function show_svg_in_media_library( $response ) {

	if ( $response['mime'] === 'image/svg+xml' ) {

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

function get_prod_stock_status_label($stock_status){
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
function activate_gutenberg_product( $can_edit, $post_type ) {
	if ( $post_type == 'product' ) {
		$can_edit = true;
	}
	return $can_edit;
}
add_filter( 'use_block_editor_for_post_type', 'activate_gutenberg_product', 10, 2 );

// enable taxonomy fields for woocommerce with gutenberg on
function enable_taxonomy_rest( $args ) {
	$args['show_in_rest'] = true;
	return $args;
}
add_filter( 'woocommerce_taxonomy_args_product_cat', 'enable_taxonomy_rest' );
add_filter( 'woocommerce_taxonomy_args_product_tag', 'enable_taxonomy_rest' );

function remove_short_description() {
	remove_meta_box( 'postexcerpt', 'product', 'normal');
}
add_action('add_meta_boxes', 'remove_short_description', 999);

add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');

function wc_customize_product_sorting($sorting_options){
	$sorting_options = [
		'price'      => __( 'По цене', 'woocommerce' ),
		'price-desc' => __( 'По цене', 'woocommerce' ),
		'popularity' => __( 'Sort by popularity', 'woocommerce' ),
		'date'       => __( 'По новизне', 'woocommerce' ),
		'title'      => __( 'По алфавиту (А-Я)', 'woocommerce' ),
		'title-desc' => __( 'По алфавиту (Я-А)', 'woocommerce' ),
	];
	return $sorting_options;
}


add_filter('term_link', 'truemisha_ne_sbrasyvat_filtr', 10, 3);
function truemisha_ne_sbrasyvat_filtr( $url, $term, $taxonomy ) {
	// сначала мы проверяем, присутствует у нас в данный момент сортировка
	$orderby = ! empty( $_GET[ 'orderby' ] ) ? $_GET[ 'orderby' ]  : '';
	// если присутствует, то добавляем её в конечный урл
	if( $orderby ) {
		return add_query_arg( 'orderby', $orderby, $url );
	} else {
		return $url;
	}
}


add_action( 'template_redirect', 'truemisha_recently_viewed_product_cookie', 20 );
function truemisha_recently_viewed_product_cookie() {
	// если находимся не на странице товара, ничего не делаем
	if ( ! is_product() ) {
		return;
	}
	if ( empty( $_COOKIE[ 'woocommerce_recently_viewed_2' ] ) ) {
		$viewed_products = array();
	} else {
		$viewed_products = (array) explode( '|', $_COOKIE[ 'woocommerce_recently_viewed_2' ] );
	}
	// добавляем в массив текущий товар
	if ( ! in_array( get_the_ID(), $viewed_products ) ) {
		$viewed_products[] = get_the_ID();
	}
	// нет смысла хранить там бесконечное количество товаров
	if ( sizeof( $viewed_products ) > 4 ) {
		array_shift( $viewed_products ); // выкидываем первый элемент
	}
	// устанавливаем в куки
	wc_setcookie( 'woocommerce_recently_viewed_2', join( '|', $viewed_products ) );
}

add_shortcode( 'recently_viewed_products', 'truemisha_recently_viewed_products' );

function truemisha_recently_viewed_products() {
	if( empty( $_COOKIE[ 'woocommerce_recently_viewed_2' ] ) ) {
		$viewed_products = array();
	} else {
		$viewed_products = (array) explode( '|', $_COOKIE[ 'woocommerce_recently_viewed_2' ] );
	}

	if ( empty( $viewed_products ) ) {
		return;
	}
	// надо ведь сначала отображать последние просмотренные
	$viewed_products = array_reverse( array_map( 'absint', $viewed_products ) );
	$product_ids = join( ",", $viewed_products );
	return do_shortcode( "[products ids='$product_ids']" );

}

// NOTE: 8 - before `wp_print_head_scripts`
add_action( 'wp_head', 'myajax_data', 8 );
function myajax_data(){
	$data = [
		'url' => admin_url( 'admin-ajax.php' ),
	];
	?>
	<script id="myajax_data">
   window.myajax = <?= wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) ?>
	</script>
	<?php
}


add_action( 'wp_ajax_empty_cart', 'lenar_empty_cart' );
add_action( 'wp_ajax_nopriv_empty_cart', 'lenar_empty_cart' );

function lenar_empty_cart() {
	WC()->cart->empty_cart();
}

function remove_item_from_cart() {
	$cart = WC()->instance()->cart;
	$id = $_POST['product_id'];
	$cart_id = $cart->generate_cart_id($id);
	$cart_item_id = $cart->find_product_in_cart($cart_id);

	if($cart_item_id){
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



function update_item_amount_in_cart() {
	$key    = sanitize_text_field( $_POST['key'] );
	$number = intval( sanitize_text_field( $_POST['number'] ) );
	if ( $key && $number > 0 ) {
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


function get_total_products_discount ()
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
    $regular_total += $regular_price* $values['quantity'];

	}
  $data['discount_total'] = $discount_total;
  $data['regular_total'] = $regular_total;
  return $data;
}