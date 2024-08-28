<section class="section background map">
  <div class="container">
    <h2>Остались вопросы?</h2>
    <div class="map__wrap">
      <img src="<?php echo IMAGES_PATH . 'map.jpg' ?>" alt="Карта проезда" class="map__img">
					<?php $map = get_field('map', 16) ?>
      <div class="map__contacts">
        <div class="map__part"><?php echo $map['callback'] ?><button class="button orange" type="button">Заказать звонок</button></div>
        <div class="map__part"><?php echo $map['schema'] ?>
          <a href="#" class="button orange" type="button">Посмотреть схему проезда</a></div></div>
    </div>
  </div>
  </div>
</section>