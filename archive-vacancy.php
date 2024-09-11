<?php
get_template_part('parts/header'); ?>


<main class="section">
  <div class="container">
    <div class="grid-wrap">
      <div class="grid-3-11">
        <div class="vacancy-page">
          <h2 class="h2">Вакансии</h2>
          <?php if (have_posts()) : ?>
            <div class="vacancy-page__desc"><strong>Питомник Русроза приглашает на работу!</strong> Вы можете ознакомиться с актуальными вакансиями и узнать все условия работы с нами подробнее.</div>
          <div class="vacancy-page__wrap">
            <?php while (have_posts()): the_post() ?>
             <div class="vacancy-page__item">
               <img src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full'); ?>" alt="<?php the_title(); ?>" class="vacancy-page__item-img" />
               <div class="vacancy-page__item-info">
                 <h3><?php the_title(); ?></h3>
                 <div class="vacancy-page__item-excerpt">
                   <span>Требования:</span>
                   <p><?php the_excerpt(); ?></p>
                 </div>
               </div>
               <div class="vacancy-page__item-side">
                <div class="vacancy-page__item-payment">
                  <?php the_field('payment') ?>
                </div>
                 <a href="<?php the_permalink(); ?>" class="button orange">Узнать больше</a>
               </div>
             </div>
            <?php endwhile; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</main>


<?php
get_template_part('parts/about');
get_template_part('parts/map');
get_template_part('parts/footer'); ?>
