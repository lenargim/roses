<?php
// Template Name: About

get_template_part('parts/header'); ?>

<main class="about-page">
  <div class="container">
    <div class="banner">
					<?php the_post_thumbnail(); ?>
      <div class="banner__title">
        <span>РУСРОЗА</span>
        <p>Питомник саженцев №1</p>
      </div>
    </div>
    <section class="section grid-wrap">
      <div class="grid-2-12">
        <h1 class="h1"><?php the_title(); ?></h1>
        <div class="about-page__content">
									<?php the_content(); ?>
          <div>
            <h2>Наши достижения</h2>
            <div class="about-page__awards">
              <div class="about-page__awards-item">
                <img src="<?php echo IMAGES_PATH . 'cup.png' ?>" alt="Moscow Flower Show"
                     class="about-page__awards-img">
                <div class="about-page__awards-text">Неоднократный победитель международного фестиваля садов и цветов
                </div>
                <div class="about-page__awards-name">«Moscow Flower Show»</div>
              </div>
              <div class="about-page__awards-item">
                <img src="<?php echo IMAGES_PATH . 'medal.png' ?>" alt="Фазенда на первом канале"
                     class="about-page__awards-img">
                <div class="about-page__awards-text">Почетный участник многих международных выставок в сфере
                  ландшафтного
                  дизайна и устройства садов
                </div>
                <div class="about-page__awards-name"></div>
              </div>
              <div class="about-page__awards-item">
                <img src="<?php echo IMAGES_PATH . 'carrots.png' ?>" alt="" class="about-page__awards-img">
                <div class="about-page__awards-text">Участник телевизионной программы о дачной жизни</div>
                <div class="about-page__awards-name">«Фазенда» на первом канале</div>
              </div>
            </div>
          </div>
									<?php if (have_rows('decorate')): ?>
           <div>
             <h2>Наши саженцы украшают</h2>
             <div class="about-page__decorate">
														<?php while (have_rows('decorate')) : the_row(); ?>
                <div class="about-page__decorate-item"><?php echo get_sub_field('text'); ?></div>
														<?php endwhile; ?>
             </div>
           </div>
									<?php endif; ?>
        </div>

      </div>
    </section>
  </div>
</main>
<?php
get_template_part('parts/gallery-slider'); ?>
<section>
  <div class="container">
    <?php echo do_shortcode('[html5_video id=413]'); ?>
  </div>
</section>


<?php
get_template_part('parts/services');
get_template_part('parts/map');
get_template_part('parts/footer');
?>
