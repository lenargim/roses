<?php

	$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
	$catalog_orderby_options = [
		'price'      => __( 'По цене ', 'woocommerce' ),
		'price-desc' => __( 'По цене', 'woocommerce' ),
		'popularity' => __( 'Sort by popularity', 'woocommerce' ),
		'date'       => __( 'По новизне', 'woocommerce' ),
		'title'      => __( 'По алфавиту (А-Я)', 'woocommerce' ),
		'title-desc' => __( 'По алфавиту (Я-А)', 'woocommerce' ),
	];
	$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );

	if ( wc_get_loop_prop( 'is_search' ) ) {
		$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'woocommerce' ) ), $catalog_orderby_options );
		unset( $catalog_orderby_options['menu_order'] );
	}

	if ( ! $show_default_orderby ) {
		unset( $catalog_orderby_options['menu_order'] );
	}

	if ( ! wc_review_ratings_enabled() ) {
		unset( $catalog_orderby_options['rating'] );
	}

	if ( ! array_key_exists( $default_orderby, $catalog_orderby_options ) ) {
		$orderby = current( array_keys( $catalog_orderby_options ) );
	}

	wc_get_template(
		'loop/orderby.php',
		array(
			'catalog_orderby_options' => $catalog_orderby_options,
			'orderby'                 => $orderby,
			'show_default_orderby'    => $show_default_orderby,
		)
	);
