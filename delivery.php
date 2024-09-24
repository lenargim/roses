<?php
// Template name: Delivery

get_template_part('parts/header'); ?>
  <main class="section delivery-page">
    <div class="container">
      <div class="banner">
							<?php the_post_thumbnail('', array('class' => 'banner-img')); ?>
        <h1><?php the_title(); ?></h1>
      </div>
					<?php the_content(); ?>
    </div>
  </main>
<div class="container">
<?php get_template_part('parts/delivery-calc'); ?>
</div>
<?php
get_template_part('parts/map');
get_template_part('parts/footer'); ?>