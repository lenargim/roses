<footer class="footer">
  <div class="container">
    <div class="footer__wrap">
      <div class="footer__col">
        <h4>Покупателям</h4>
							<?php wp_nav_menu([
								'menu' => 'footer1'
							]) ?>
      </div>
      <div class="footer__col">
        <h4>Компания</h4>
							<?php wp_nav_menu([
								'menu' => 'footer2'
							]) ?>
      </div>
      <div class="footer__col">
							<?php $socials = get_field('socials', 16); ?>
							<?php if ($socials): ?>
         <h4>Мы в соц. сетях:</h4>
         <div class="footer__list">
           <a target="_blank" href="<?php echo $socials['wh'];?>" class="footer__link wa">
             <svg>
               <use xlink:href="<?php echo IMAGES_PATH . 'sprite.svg#wa' ?>"></use>
             </svg>
             <span>Whats App</span>
           </a>
           <a target="_blank" href="<?php echo $socials['telegram'];?>" class="footer__link tg">
             <svg>
               <use xlink:href="<?php echo IMAGES_PATH . 'sprite.svg#tg' ?>"></use>
             </svg>
             <span>Telegram</span>
           </a>
           <a target="_blank" href="<?php echo $socials['vk'];?>" class="footer__link vk">
             <svg>
               <use xlink:href="<?php echo IMAGES_PATH . 'sprite.svg#vk' ?>"></use>
             </svg>
             <span>Vkontakte</span>
           </a>
           <a target="_blank" href="<?php echo $socials['youtube'];?>" class="footer__link youtube">
             <svg>
               <use xlink:href="<?php echo IMAGES_PATH . 'sprite.svg#youtube' ?>"></use>
             </svg>
             <span>YouTube</span>
           </a>
         </div>
							<?php endif; ?>
      </div>
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
    <div class="footer__copy">2023 © RUSROZA.RU - питомник саженцев роз. Доставка по всей России. Все права защищены.
    </div>
  </div>
</footer>
<?php get_template_part('parts/modal'); ?>
<?php wp_footer(); ?>
<div class="loader-box"><span class="loader"></span></div>
</body>
</html>
