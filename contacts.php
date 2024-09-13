<?php
// Template Name: Contacts

get_template_part('parts/header'); ?>

<main class="contacts-page">
  <div class="container">
    <h1 class="h1">Контакты</h1>
    <div class="contacts-page__wrap">
      <div class="contacts-page__left">
        <div class="contacts-page__banner">
									<?php the_post_thumbnail(); ?>
          <div class="contacts-page__banner-title">Питомник саженцев №1</div>
        </div>
							<?php if (have_rows('offices')):
								while (have_rows('offices')) : the_row(); ?>
          <div class="contacts-page__item">
            <div class="contacts-page__item-title"><?php the_sub_field('title') ?></div>
            <div class="contacts-page__item-desc"><?php the_sub_field('data') ?></div>
          </div>
									<?php break;
								endwhile;
							endif; ?>
      </div>
      <div class="contacts-page__right">
							<?php if (have_rows('offices')):
								while (have_rows('offices')) : the_row(); ?>
          <div class="contacts-page__item">
            <div class="contacts-page__item-title"><?php the_sub_field('title') ?></div>
            <div class="contacts-page__item-desc"><?php the_sub_field('data') ?></div>
          </div>
								<?php
								endwhile;
							endif; ?>
      </div>
    </div>

    <div class="grid-wrap">
      <div class="grid-3-11 schema" id="schema">
        <?php the_content(); ?>
      </div>
    </div>
    <div class="contacts-page__wrap">
      <div class="contacts-page__left">
        <?php $details = get_field('details'); ?>
        <?php if ($details): ?>
        <div class="contacts-page__item">
          <div class="contacts-page__item-title">Реквизиты</div>
          <div class="contacts-page__item-name"><?php echo $details['title']; ?></div>
          <div class="contacts-page__item-desc"><?php echo $details['desc']; ?></div>
        </div>
        <?php endif; ?>
      </div>
      <div class="contacts-page__right">
							<?php $details = get_field('press'); ?>
							<?php if ($details): ?>
         <div class="contacts-page__item">
           <div class="contacts-page__item-title">Пресс-центр</div>
           <div class="contacts-page__item-name"><?php echo $details['title']; ?></div>
           <div class="contacts-page__item-desc"><?php echo $details['desc']; ?></div>
         </div>
							<?php endif; ?>
        <div class="contacts-page__banner">
          <img src="<?php echo IMAGES_PATH . 'press.jpg' ?>" alt="Мы создаем сады, за которыми легко ухаживать!">
          <div class="contacts-page__banner-title">Мы создаем сады, за которыми легко ухаживать!</div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
get_template_part('parts/services');
get_template_part('parts/map');
get_template_part('parts/footer');
?>

