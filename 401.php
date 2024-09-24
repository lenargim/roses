<?php
// Template Name: 401
get_template_part('parts/header'); ?>

<main class="not-found">
  <div class="not-found__wrap">
    <div class="not-found__text">
      <div class="not-found__title">Произошла ошибка!</div>
      <div class="not-found__desc">Пользователь не найден. Проверьте правильность заполнения полей или
        <a href="<?php echo get_page_link('sign-in');?>">зарегестрируйтесь</a>.<br>Вы также можете вернуться на главную страницу и продолжить без регистрации.
      </div>
      <a href="/" class="button orange big">Вернуться на главную</a>
    </div>
  </div>
</main>

<?php get_template_part('parts/footer'); ?>
