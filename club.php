<?php
// Template Name: Club

get_template_part('parts/header'); ?>

<div class="club">
  <div class="container">
    <div class="banner">
					<?php the_post_thumbnail(); ?>
      <h1><?php the_title(); ?></h1>
    </div>
  </div>
</div>
<?php get_template_part('parts/club-slider'); ?>
<main class="club">
  <div class="container">
    <div class="grid-wrap">
      <div class="grid-3-11">
							<?php the_content(); ?>
      </div>
    </div>
			<?php if (have_rows('tariffs', 304)): ?>
     <div class="club__tariffs-wrap">
       <h2>Тарифы</h2>
       <div class="club__tariffs">
								<?php while (have_rows('tariffs', 304)) : the_row();
									$img = get_sub_field('img');
									$title = get_sub_field('title');
									$price = get_sub_field('price');
									$list = get_sub_field('list');

									?>
          <div class="club__item">
            <img src="<?php echo $img; ?>" alt="<?php echo $title; ?>" class="club__item-img">
            <div class="club__item-data">
              <div class="club__item-info">
                <div class="club__item-title">“<?php echo $title; ?>”</div>
                <div class="club__item-price">Стоимость: <span><?php echo $price; ?> руб.</span></div>
                <div class="club__item-list"><?php echo $list; ?></div>
              </div>
              <button class="club__item-button button white">Заполнить анкету</button>
            </div>
          </div>
								<?php endwhile; ?>
       </div>
     </div>
			<?php endif; ?>
    <div class="grid-wrap section">
      <div class="grid-3-11 club__join">
        <div class="club__join-img">
          <img src="<?php echo IMAGES_PATH . 'club-join.jpg' ?>" alt="Записаться">
          <button type="button" class="button violet">Записаться</button>
        </div>
        <div class="club__join-text">
          <div class="club__join-block">
            <h4>Адрес проведения:</h4>
            <p><?php echo the_field('address', 304) ?></p>
          </div>
          <div class="club__join-block">
            <h4>Запись и регистрация: </h4>
											<?php $phones = get_field('phones', 16);; ?>
            <p>Чтобы записаться в школу розоводов, можно позвонить по телефону
              <a href="tel:<?php echo trim_phone($phones['phone_2']); ?>"><?php echo $phones['phone_2']; ?></a>
              или заполнить форму </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php get_template_part('parts/gallery-slider'); ?>
</main>

<?php
get_template_part('parts/services');
get_template_part('parts/map');
get_template_part('parts/footer'); ?>
