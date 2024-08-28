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

	if (is_front_page()) {
		wp_enqueue_style('swiper-styles', 'https://unpkg.com/swiper@8/swiper-bundle.min.css');
		wp_enqueue_script('swiper-lib', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array('jquery'));
		wp_enqueue_script('home-script', get_template_directory_uri() . '/assets/js/home.js', array('swiper-lib'));
	}

	if (is_product_category() || is_product_tag()) {
		wp_enqueue_style('swiper-styles', 'https://unpkg.com/swiper@8/swiper-bundle.min.css');
		wp_enqueue_script('swiper-lib', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array('jquery'));
		wp_enqueue_script('shop-script', get_template_directory_uri() . '/assets/js/shop.js', array('swiper-lib'));
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
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-list-view',
		'supports' => array('title', 'excerpt', 'thumbnail')
	));

	add_image_size('product-new', 137, 137, ['center', 'center']);
	add_image_size('extra-sale', 345, 200, ['center', 'center']);
	add_image_size('product-category', 200, 200, ['center', 'center']);


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