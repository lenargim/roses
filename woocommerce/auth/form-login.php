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
      <p class="wc-auth-actions">
							<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
        <button type="submit"
                class="button orange big"
                name="login"
                value="<?php esc_attr_e('Login', 'woocommerce'); ?>">Войти</button>
        <input type="hidden" name="redirect" value="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ) ?>"/>
      </p>
      <a href="<?php echo get_page_link('498');?>" class="modal__link">Зарегистрироваться</a>
    </form>

  </div>
</div>

<?php //do_action( 'woocommerce_auth_page_footer' ); ?>
