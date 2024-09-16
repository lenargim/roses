<?php
/*
	* Template name: Registration Form
*/

//if(is_user_logged_in()){
//	wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')));
//}
//
global $woocommerce;
get_template_part('parts/header');
do_action('woocommerce_before_customer_login_form'); ?>

  <div class="registration">
    <div class="container">
      <div class="grid-wrap">
        <div class="grid-2-12">
          <form method="post"
                class="woocommerce-form-register register registration__form" <?php do_action('woocommerce_register_form_tag'); ?> >
											<?php do_action('woocommerce_register_form_start'); ?>
            <h1 class="h1"><?php the_title(); ?></h1>
            <div class="registration__wrap">
              <div class="registration__half">
                <div class="text-wrap required">
                  <input type="text" id="reg_username" name="username" placeholder="...">
                  <label for="reg_username">Логин</label>
                </div>
                <div class="text-wrap">
                  <input type="text" id="billing_last_name" name="billing_last_name" placeholder="...">
                  <label for="billing_last_name">Фамилия</label>
                </div>
                <div class="text-wrap">
                  <input type="text" id="billing_first_name" name="billing_first_name" placeholder="...">
                  <label for="billing_first_name">Имя</label>
                </div>
                <div class="text-wrap">
                  <input type="text" id="billing_patronymic_name" name="billing_patronymic_name" placeholder="...">
                  <label for="billing_patronymic_name">Отчество</label>
                </div>
                <div class="text-wrap required">
                  <input type="text" id="email" name="email" placeholder="...">
                  <label for="email">Email</label>
                </div>
                <div class="text-wrap">
                  <input type="text" id="billing_phone" name="billing_phone" placeholder="+7...">
                  <label for="billing_phone">Телефон</label>
                </div>
              </div>
              <div class="registration__half">
                <div class="text-wrap">
																	<?php woocommerce_form_field('billing_country', array('type' => 'country', 'placeholder' => '...')); ?>
                  <label for="billing_country">Страна</label>
                </div>
                <div class="text-wrap">
                  <input type="text" id="billing_postcode" name="billing_postcode" placeholder="...">
                  <label for="billing_postcode">Индекс</label>
                </div>
                <div class="text-wrap">
                  <input type="text" id="billing_state" name="billing_state" placeholder="...">
                  <label for="billing_state">Регион</label>
                </div>
                <div class="text-wrap">
                  <input type="text" id="billing_city" name="billing_city" placeholder="...">
                  <label for="billing_city">Город/населенный пункт</label>
                </div>
                <div class="text-wrap">
                  <input type="text" id="billing_address_1" name="billing_address_1" placeholder="...">
                  <label for="billing_address_1">Улица</label>
                </div>
                <div class="registration__row">
                  <div class="text-wrap">
                    <input type="text" id="billing_home" name="billing_home" placeholder="...">
                    <label for="billing_home">Дом</label>
                  </div>
                  <div class="text-wrap">
                    <input type="text" id="billing_body" name="billing_body" placeholder="...">
                    <label for="billing_body">Корпус</label>
                  </div>
                  <div class="text-wrap">
                    <input type="text" id="billing_apartment" name="billing_apartment" placeholder="...">
                    <label for="billing_apartment">Квартира</label>
                  </div>
                </div>
                <div class="registration__bottom">
                  <div class="accept-wrap registration__accept">
                    <input type="checkbox" id="accept" class="checkbox" name="accept">
                    <label for="accept">
              <span>Я принимаю <a href="#">условия использования</a> и&nbsp;<a href="#">политику конфиденциальности</a>
                    </label>
                  </div>
																	<?php do_action('woocommerce_register_form'); ?>
																	<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                  <button type="submit"
                          class="woocommerce-Button woocommerce-button woocommerce-form-register__submit button big orange"
                          name="register"
                          value="<?php esc_attr_e('Register', 'woocommerce'); ?>">Регистрация
                  </button>
																	<?php do_action('woocommerce_register_form_end'); ?>
																	<?php do_action('woocommerce_after_customer_login_form'); ?>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php //get_template_part('parts/about'); ?>
<?php //get_template_part('parts/map'); ?>
<?php get_template_part('parts/footer'); ?>