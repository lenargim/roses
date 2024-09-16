<?php require_once("head.php"); ?>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <header class="header">
    <div class="container">
      <div class="header__wrap">
							<?php echo get_custom_logo(); ?>
        <div class="header__row">
          <a href="#" class="button violet">Новые поступления</a>
          <a href="<?php echo get_page_link(229); ?>" class="button orange">Бесплатная доставка</a>
          <div class="header__search button search">
            <input type="search" placeholder="я ищу...">
          </div>
        </div>
        <div class="header__admin">
          <div class="header__phone">
            <div class="header__phone-list">
													<?php $phones = get_field('phones', 16);; ?>
              <a href="tel:<?php echo trim_phone($phones['phone_1']); ?>"><?php echo $phones['phone_1']; ?></a>
              <a href="tel:<?php echo trim_phone($phones['phone_2']); ?>"><?php echo $phones['phone_2']; ?></a>
            </div>
          </div>
          <div class="header__links">
            <?php if(is_user_logged_in()):
              $current_user = wp_get_current_user();
            $name = $current_user->user_firstname ?? $current_user->user_login;
             ?>
              <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ) ?>" class="header__link"><?php echo $name;?></a>
            <?php else: ?>
              <button type="button" class="header__link admin open-login">Войти</button>
            <?php endif; ?>
            <a href="<?php echo wc_get_checkout_url() ?>" class="header__link cart">Корзина</a>
          </div>
        </div>
      </div>
    </div>
  </header>
<?php get_template_part('parts/header-menu'); ?>