<!--Template name: Main    -->
<?php get_template_part('parts/header'); ?>
<main class="main">
	<?php if (have_rows('slide')): ?>
   <div class="section banner">
     <div class="container">
       <div class="banner__wrap">
         <div class="banner__arrow prev"></div>
         <div class="banner__arrow next"></div>
         <div class="slider__pagination"></div>
         <div class="swiper-wrapper">
										<?php while (have_rows('slide')) : the_row(); ?>
            <div class="swiper-slide">
              <div class="banner__item" style="background-image: url(<?php echo get_sub_field('banner'); ?>)">
                <div class="banner__text">
                  <div class="banner__title"><?php echo get_sub_field('text'); ?></div>
                  <a href="<?php echo get_sub_field('link'); ?>" class="button orange">Подробнее</a>
                </div>
              </div>
            </div>
										<?php endwhile; ?>
         </div>
       </div>
     </div>
   </div>
	<?php endif; ?>

	<?php
	$terms = get_terms([
		'taxonomy' => 'product_cat',
		'hide_empty' => false,
   'parent' => 0,
			'exclude' => [36, 37, 38],
	]);
	if ($terms): ?>
   <section class="section">
     <div class="container">
       <h2 class="h2">Саженцы питомника</h2>
       <div class="grid grid-5">
								<?php foreach ($terms as $term):
									$thumb_id = get_term_meta($term->term_id, 'thumbnail_id', true);
									$term_img = lenar_get_img(wp_get_attachment_url($thumb_id, 'product-category')); ?>
          <a href="<?php echo get_term_link($term) ?>"
             class="grid__item"
             style="background-image: url(<?php echo $term_img; ?>)">
            <span><?php echo $term->name; ?></span>
          </a>
								<?php endforeach; ?>
       </div>
     </div>
   </section>
	<?php endif; ?>

	<?php get_template_part('parts/recommended'); ?>

	<?php if ($terms): ?>
   <section class="section">
     <div class="container">
       <h2 class="h2">Русроза рекоментует</h2>
       <div class="grid grid-5">
								<?php foreach ($terms as $term):
									$thumb_id = get_term_meta($term->term_id, 'thumbnail_id', true);
									$term_img = lenar_get_img(wp_get_attachment_url($thumb_id, 'product-category')); ?>
          <a href="<?php echo get_term_link($term) ?>"
             class="grid__item"
             style="background-image: url(<?php echo $term_img; ?>)">
            <span><?php echo $term->name; ?></span>
          </a><?php endforeach; ?>
       </div>
     </div>
   </section>
	<?php endif; ?>

	<?php get_template_part('parts/extra-sale'); ?>
	<?php get_template_part('parts/services'); ?>
	<?php get_template_part('parts/club-slider'); ?>
	<?php get_template_part('parts/about'); ?>
	<?php get_template_part('parts/map'); ?>

</main>
<?php get_template_part('parts/footer'); ?>
