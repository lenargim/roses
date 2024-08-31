<?php

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly
endif;
get_template_part('parts/header'); ?>
  <div class="product-single">
    <div class="container">
					<?php
					if ( function_exists('yoast_breadcrumb') ):
						yoast_breadcrumb( '<p class="breadcrumbs"><button class="back" onclick="history.go(-1);"></button>','</p>' );
					endif; ?>
					<?php while (have_posts()) : ?>
						<?php the_post(); ?>
						<?php wc_get_template_part('content', 'single-product'); ?>
					<?php endwhile; ?>
    </div>
  </div>

<?php get_template_part('parts/extra-sale'); ?>
<?php get_template_part('parts/footer'); ?>