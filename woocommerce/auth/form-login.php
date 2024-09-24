<?php

defined('ABSPATH') || exit;

//do_action( 'woocommerce_auth_page_header' ); ?>

<div class="dark active form-login">
  <div class="modal modal-login">
    <div class="modal__close"></div>
    <h2 class="modal__title h2">Войти в личный кабинет</h2>
			<?php wc_print_notices(); ?>
    <form method="post" class="wc-auth-login">
      <div class="text-wrap required">
        <input type="text" class="input-text" name="username" id="username"
               value="<?php echo (!empty($_POST['username'])) ? esc_attr($_POST['username']) : ''; ?>" required
               aria-required="true"
               placeholder="Введите логин..."/>
        <label for="username">Логин</label>
      </div>
      <div class="text-wrap required">
        <input class="input-text" type="password" placeholder="Введите пароль..." name="password" id="password" required
               aria-required="true"/>
        <label for="password">Пароль</label>
      </div>
      <button type="button" class="modal-login__forgot">Забыли пароль?</button>
      <p class="wc-auth-actions">
							<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
        <button type="submit"
                class="button orange big"
                name="login"
                value="<?php esc_attr_e('Login', 'woocommerce'); ?>">Войти
        </button>
        <input type="hidden" name="redirect" value="<?php echo get_permalink(wc_get_page_id('myaccount')) ?>"/>
      </p>
      <a href="<?php echo get_page_link('sign-in'); ?>" class="modal__link">Зарегистрироваться</a>
    </form>
  </div>
</div>

<div class="dark form-reset">
  <div class="modal">
    <div class="modal__close"></div>
    <h2 class="modal__title h2">Забыли пароль?</h2>
    <p class="modal__desc">Укажите логин или email, который использовался при регистрации и мы пришлем на него письмо с
      новыми данными для авторизации</p>
    <form id="lost-password" class="form-reset__form">
      <div class="form-row text-wrap required">
							<?php wp_nonce_field( 'ajax-login-nonce' ); ?>
        <input type="text" name="user_login" id="user_login" placeholder="...">
        <label for="user_login">Логин или email</label>
      </div>
      <p class="lostpassword-submit">
        <input type="submit" name="submit" disabled class="lostpassword-button button orange big" value="Отправить" />
      </p>
    </form>
  </div>
</div>

<div class="dark overlay-reset-sent">
  <div class="modal modal-reset-sent">
    <div class="modal__close"></div>
    <div class="modal-reset-sent__wrap">
      <img src="<?php echo IMAGES_PATH . 'password-thx.png' ?>" alt="Письмо отправлено!">
      <div class="modal-reset-sent__text">
        <h4>Письмо отправлено!</h4>
        <div class="modal__desc">
          На адрес <span class="user-new-email"></span> было выслано письмо с новыми данными для авторизации.
        </div>
      </div>
    </div>
  </div>
</div>

<?php //do_action( 'woocommerce_auth_page_footer' ); ?>
