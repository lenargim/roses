<?php require_once("head.php"); ?>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <header class="header">
    <div class="container">
					<?php if (!wp_is_mobile()): ?>
       <div class="header__wrap">
								<?php echo get_custom_logo(); ?>
         <div class="header__row">
           <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>?orderby=date"
              class="button violet laptop-hidden">Новые
             поступления</a>
           <a href="<?php echo get_page_link(229); ?>" class="button orange laptop-hidden">Бесплатная доставка</a>
										<?php echo do_shortcode('[fibosearch]'); ?>
         </div>
         <div class="header__admin">
           <div class="header__phone">
             <div class="header__phone-list">
														<?php $phones = get_field('phones', 16); ?>
               <a href="tel:<?php echo trim_phone($phones['phone_1']); ?>"><?php echo $phones['phone_1']; ?></a>
               <a href="tel:<?php echo trim_phone($phones['phone_2']); ?>"><?php echo $phones['phone_2']; ?></a>
             </div>
           </div>
           <div class="header__links">
												<?php if (is_user_logged_in()):
													$current_user = wp_get_current_user();
													$name = $current_user->user_firstname ?? $current_user->user_login;
													?>
              <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')) ?>"
                 class="header__link admin"><?php echo $name; ?></a>
												<?php else: ?>
              <button type="button" class="header__link admin open-login">Войти</button>
												<?php endif; ?>
             <a href="<?php echo wc_get_cart_url() ?>" class="header__link cart">Корзина</a>
           </div>
         </div>
       </div>
					<?php else: ?>
       <div class="burger-block">
         <div class="burger-block__close"></div>
								<?php echo do_shortcode('[fibosearch]');
								global $wp_query;
								$cat_obj = $wp_query->get_queried_object();
								global $allParentCategories;
								$allParentCategories = get_terms([
									'taxonomy' => 'product_cat',
									'hide_empty' => false,
									'parent' => 0
								]);
								?>
         <li class="menu-item menu-item-has-children" id="detach">
           <a disabled=true><span>Саженцы</span></a>
           <div class="sub-menu">
												<?php foreach ($allParentCategories as $parentCat):
													$termId = $parentCat->term_id;
													$isParent = isset($cat_obj->parent) && $cat_obj->parent === $termId;
													$isOpen = $isParent;
													$children = get_terms([
														'taxonomy' => 'product_cat',
														'parent' => $termId,
														'hide_empty' => false
													]);
													$svg = '<svg viewBox="0 0 21 22" xmlns="http://www.w3.org/2000/svg">
         <path d="M6.20815 7.82617L10.0469 11.665L13.8857 7.82617L15.0704 9.01088L10.0469 14.0344L5.02344 9.01088L6.20815 7.82617Z" />
       </svg>'
													?>
              <div class="sidebar__parent sidebar__toggle <?php if ($isOpen) echo 'open' ?>">
                <button class="sidebar__button"
                        type="button">
                  <span><?php echo $parentCat->name ?></span>
																	<?php echo $svg; ?>
                </button>
															<?php if ($children): ?>
                 <div class="sidebar__list">
                   <div class="sidebar__categories sidebar__toggle <?php if ($isOpen) echo 'open' ?>">
                     <button type="button" class="sidebar__button"><span>По Классам</span> <?php echo $svg; ?></button>
                     <div class="sidebar__children sidebar__list">
																						<?php foreach ($children as $child): ?>
																							<?php $isCurrentLink = isset($cat_obj->term_id) && $cat_obj->term_id === $child->term_id; ?>
                        <a href="<?php echo get_term_link($child) ?>"
                           class="<?php if ($isCurrentLink) echo 'current' ?>"><?php echo $child->name; ?></a>
																						<?php endforeach; ?>
                     </div>
                   </div>
                   <div class="sidebar__tags sidebar__toggle">
																				<?php
																				$tags = get_terms('product_tag');
																				?>
                     <button type="button" class="sidebar__button"><span>По группам</span><?php echo $svg; ?></button>
                     <div class="sidebar__children sidebar__list">
																						<?php foreach ($tags as $tag): ?>
                        <a href="<?php echo get_term_link($tag) ?>"><?php echo $tag->name; ?></a>
																						<?php endforeach; ?>
                     </div>
                   </div>
                 </div>
															<?php endif; ?>
              </div>
												<?php endforeach; ?>
           </div>
         </li>
								<?php echo wp_nav_menu(['menu' => 'main']) ?>
         <div class="burger-block__auth">
										<?php if (is_user_logged_in()):
											$current_user = wp_get_current_user();
											$name = $current_user->user_firstname ?? $current_user->user_login; ?>
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')) ?>"
               class="header__link admin"><?php echo $name; ?></a>
										<?php else: ?>
            <p class="burger-block__auth-desc">Вы не авторизованы. Войдите или зарегистрируйтесь.</p>
            <button type="button" class="button orange open-login big">войти в аккаунт</button>
										<?php endif; ?>
           <a href="<?php echo wc_get_cart_url() ?>" class="button big violet cart">Перейти в корзину</a>
           <div class="footer__qr">
             <h4>Приложение
               RUSROZA</h4>
												<?php $qr = get_field('app_qr', 16) ?>
												<?php if ($qr): ?>
              <img class="footer__qr-img" src="<?php echo $qr ?>" alt="QR code app">
              <div class="footer__qr-desc">Наведите камеру, чтобы скачать приложение</div>
              <div class="footer__storelist">
                <img src="<?php echo IMAGES_PATH . 'apple.png' ?>" alt="Apple" class="footer__store">
                <img src="<?php echo IMAGES_PATH . 'google.png' ?>" alt="Google" class="footer__store">
                <img src="<?php echo IMAGES_PATH . 'huawei.png' ?>" alt="Huawei" class="footer__store">
              </div>
												<?php endif; ?>
           </div>
         </div>
       </div>
       <div class="header__mobile">
         <div class="header__mobile-top">
           <button type="button" class="burger"></button>
										<?php echo get_custom_logo(); ?>
           <div class="header__mobile-links">
												<?php if (is_user_logged_in()):
													$current_user = wp_get_current_user();
													$name = $current_user->user_firstname ?? $current_user->user_login;
													?>
              <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')) ?>"
                 class="header__link admin"></a>
												<?php else: ?>
              <button type="button" class="header__link admin open-login"></button>
												<?php endif; ?>
             <a href="<?php echo wc_get_cart_url() ?>" class="header__link cart"></a>
           </div>
         </div>
         <div class="header__mobile-bottom">
										<?php $phones = get_field('phones', 16); ?>
           <a href="tel:<?php echo trim_phone($phones['phone_1']); ?>" class="header__mobile-phone"></a>
										<?php echo do_shortcode('[fibosearch]'); ?>
         </div>
       </div>
					<?php endif; ?>
    </div>
  </header>

<?php
if (!wp_is_mobile()):
	get_template_part('parts/header-menu');
endif;
?>