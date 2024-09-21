<?php
//Template Name: Sales
get_template_part('parts/header');
?>

  <main class="sales">
    <section class="section">
      <div class="container">
        <h1 class="h1"><?php the_title() ?></h1>
        <div class="sales__wrap">
          <div class="sales__text">
											<?php if (have_rows('sale')): ?>
             <div class="sales__text-title">При единовременной покупке на сумму или сумме покупок за один сезон:</div>
             <div class="sales__text-types">
														<?php
														while (have_rows('sale')) : the_row();
															$number = get_sub_field('number');
															$title = get_sub_field('title');
															$desc = get_sub_field('desc');
															?>
                <div class="sales__text-type">
                  <div class="sales__text-percent"><?php echo $number ?></div>
                  <div>
                    <span><?php echo $title ?></span>
                    <p><?php echo $desc ?></p>
                  </div>
                </div>
														<?php endwhile; ?>
             </div>
											<?php endif; ?>
          </div>
          <div class="sales__personal">
            <div class="sales__personal-title">Ваша скидка</div>
            <div class="sales__personal-center">
              <div class="sales__personal-left">10%</div>
              <div class="sales__personal-right">
                <p>до 15%<br>осталось:</p>
                <span>- 25 808.00 ₽ </span>
              </div>
            </div>
            <div class="sales__personal-bottom">
              <span>До конца сезона осталось:</span>
              <div class="timer">
                <span>13</span>
                <span>10</span>
                <span>25</span>
              </div>
            </div>
          </div>
        </div>
        <div class="grid-wrap">
          <div class="sales__desc"><?php the_content(); ?></div>
        </div>
        <div class="sales__cards">
          <img src="<?php echo IMAGES_PATH . 'sale1.jpg'; ?>" alt="Карта постоянного покупателя 5%">
          <img src="<?php echo IMAGES_PATH . 'sale2.jpg'; ?>" alt="Карта постоянного покупателя 15%">
          <img src="<?php echo IMAGES_PATH . 'sale3.jpg'; ?>" alt="Карта постоянного покупателя 10%">
        </div>
        <div class="sales__design">
          <img src="<?php echo IMAGES_PATH . 'sales-design.jpg'; ?>"
               alt="Для ландшафтных дизайнеров действует дополнительная скидка 5%"
               class="sales__design-img"
          >
          <div class="sales__design-text">
            <div class="sales__design-title">Для ландшафтных дизайнеров действует дополнительная&nbsp;скидка 5%!</div>
            <div class="sales__design-desc">При предоставлении удостоверяющего документа о виде деятельности в сфере
              ландшафтного дизайна или соответствующем образовании - предоставляется дополнительная скидка 5%, но не
              более 15% процентов в сумме всех скидок в одном заказе.
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>


<?php
get_template_part('parts/services');
get_template_part('parts/map');
get_template_part('parts/footer');
?>