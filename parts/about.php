<section class="about section">
  <div class="container">
    <h2 class="h2">О компании</h2>
    <div class="about__wrap">
      <div class="about__images">
        <img src="<?php echo IMAGES_PATH . 'about1.jpg' ?>" alt="О компании">
							<?php if (!wp_is_mobile()): ?>
                <img src="<?php echo IMAGES_PATH . 'about2.jpg' ?>" alt="О компании">
                <img src="<?php echo IMAGES_PATH . 'about3.jpg' ?>" alt="О компании">
							<?php endif; ?>
      </div>
      <div class="about__text">
        <p class="about__paragraph">Наши саженцы — это высококачественные растения, выращенные с любовью и забото в
          нашем питомнике.
          Мы специализируемся на разведении разнообразных сортов и видов растений, предлагая клиентам уникальные
          возможност для создания красочных садов и уютных зеленых уголков.
        </p>
        <h3>Нас отличает</h3>
        <ol>
          <li>
            <p>
              <span>Высокое качество</span>
              <span>Мы гарантируем высочайшее качество каждого растения</span>
            </p>
          </li>
          <li>
            <p>
              <span>Богатый выбор</span>
              <span>В нашем каталоге около 15000 наименований сортов</span>
            </p>
          </li>
          <li>
            <p>
              <span>Забота о клиенте</span>
              <span>Индивидуальным подход к каждому клиенту</span>
            </p>
          </li>
        </ol>
      </div>
    </div>
  </div>
</section>