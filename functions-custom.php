<?php

add_action( 'wp_enqueue_scripts', 'lenar_enqueue_scripts', 9999 );
add_action( 'wp_head', 'lenar_enqueue_scripts', 9999 );
function lenar_enqueue_scripts() {
	wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/style.css', array(), filemtime( get_template_directory() . '/style.css' ), false );
	wp_enqueue_script( 'main-scripts', get_template_directory_uri() . '/main.min.js', array( 'jquery' ) );

	if (is_front_page()) {
		wp_enqueue_style( 'swiper-styles', 'https://unpkg.com/swiper@8/swiper-bundle.min.css' );
		wp_enqueue_script( 'swiper-lib', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'swiper-script', get_template_directory_uri() . '/assets/js/swiper.js', array( 'swiper-lib' ) );
	}

}

add_action( 'init', 'custom_posts' );
function custom_posts() {
	register_post_type( 'services', array(
		'labels'             => array(
			'name'               => 'Услуги', // Основное название типа записи
			'singular_name'      => 'Услуга', // отдельное название записи типа Book
			'add_new'            => 'Добавить услугу',
			'add_new_item'       => 'Добавить новую услугу',
			'edit_item'          => 'Редактировать услугу',
			'new_item'           => 'Новая услуга',
			'view_item'          => 'View',
			'search_items'       => 'Искать услугу',
			'not_found'          => 'not found',
			'not_found_in_trash' => 'not_found_in_trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Услуги'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-list-view',
		'supports'           => array( 'title', 'excerpt', 'thumbnail' )
	) );
}

function trim_phone($phone) {
	return str_replace(['(',')',' ', '-'], '', $phone);
}

function lenar_get_img($link){
	return $link ? : IMAGES_PATH .'no-img.webp';
}