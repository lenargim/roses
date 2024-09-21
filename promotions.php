<?php
//Template Name: Promotions
get_template_part('parts/header');
?>

  <main class="promotions">
    <div class="container">
      <h1 class="h1">Акции</h1>
      <div class="promotions__wrap">
        <div class="promotions__item">
          <img src="<?php echo IMAGES_PATH . 'about1.jpg'; ?>"
               alt="10+5! При покупке 10 акционных саженцев - 5 акционных саженцев в подарок!" class="promotions__item-img">
          <div class="promotions__item-top">
            <span>C 15 октября по 15 ноября 2023 г.</span>
            <div class="promotions__item-timer">
              <span>До конца акции осталось:</span>
              <div class="timer">
                <span>13</span>
                <span>10</span>
                <span>25</span>
              </div>
            </div>
          </div>
          <div class="promotions__item-title">10+5! При покупке 10 акционных саженцев - 5 акционных саженцев в подарок!</div>
          <div class="promotions__item-desc">C 15 октября акция на все многолетние цветочные декоративные растения, лилии,
            пионы действует акция 10+ 5!<br>
            При покупке 10 акционных саженцев - 5 акционных саженцев вы получаете вы подарок!
          </div>
          <div class="promotions__item-bottom">
            <span>Акция действует, пока товар есть в наличии, скидки по картам на аукционные саженцы не распространяются, акции не суммируются.</span>
            <a href="#" class="button orange">Смотреть товары</a>
          </div>
        </div>
        <div class="promotions__item">
          <img src="<?php echo IMAGES_PATH . 'about1.jpg'; ?>"
               alt="10+5! При покупке 10 акционных саженцев - 5 акционных саженцев в подарок!" class="promotions__item-img">
          <div class="promotions__item-top">
            <span>C 5 октября по 5 ноября 2023 г.</span>
            <div class="promotions__item-timer">
              <span>До конца акции осталось:</span>
              <div class="timer">
                <span>03</span>
                <span>10</span>
                <span>25</span>
              </div>
            </div>
          </div>
          <div class="promotions__item-title">Цены пополам!</div>
          <div class="promotions__item-desc">C 5 октября на все крупномеры плодовых деревьев и крупнолистную гортензию
            действует акция “Цены пополам!”, скидка 50%!
          </div>
          <div class="promotions__item-bottom">
            <span>Акция действует, пока товар есть в наличии, скидки по картам на аукционные саженцы не распространяются, акции не суммируются.</span>
            <a href="#" class="button orange">Смотреть товары</a>
          </div>
        </div>
      </div>
    </div>
  </main>


<?php
get_template_part('parts/map');
get_template_part('parts/footer');
?>