<?php
$posts = get_posts([
	'numberposts' => 10,
	'post_type' => 'services'
])
?>
<?php if ($posts): ?>
  <section class="services section">
    <div class="container">
      <h2 class="h2">Мы вам помогаем</h2>
      <div class="services__wrap">
							<?php foreach ($posts as $post):
								setup_postdata($post);
								?>
         <div class="services__item">
           <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?php the_title(); ?>"
                class="services__img">
           <div class="services__info">
             <div class="services__text">
               <h4><?php the_title(); ?></h4>
               <p><?php the_excerpt(); ?></p>
             </div>
												<?php $has_page = get_field('has_page') ?>
												<?php if (!$has_page): ?>
              <button type="button" class="button white">записаться</button>
												<?php else: ?>
              <a href="<?php echo get_field('page_link'); ?>" class="button white">подробнее</a>
												<?php endif; ?>
           </div>
         </div>
							<?php endforeach;
							wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
<?php endif; ?>