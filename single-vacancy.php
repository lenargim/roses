<?php
get_template_part('parts/header'); ?>


<main class="section">
  <div class="container">
			<?php get_template_part('parts/yoast-breadcrumbs'); ?>
    <div class="grid-wrap single-vacancy">
      <div class="grid-3-11">
        <div class="single-vacancy__wrap">
          <div class="single-vacancy__info">
            <?php $page_title = get_the_title(); ?>
            <h3>Вакансия <?php echo $page_title; ?></h3>
            <p class="single-vacancy__desc">
              <span>Питомник Русроза приглашает на работу!</span> Отправьте заявку на интересующую вас вакансию, оставив
              нам свои
              контактные данные и прикрепив файл с резюме. Наши сотрудники свяжутся с вами в ближайшее время!
            </p>
											<?php $vacancy = get_field('vacancy', 16); ?>
											<?php if ($vacancy): ?>
             <div class="single-vacancy__contacts">
               <div class="single-vacancy__contacts-block">
                 <span>Контактное лицо:</span>
                 <div><?php echo $vacancy['name']; ?></div>
               </div>
               <div class="single-vacancy__contacts-block">
                 <span>Телефон:</span>
                 <a href="tel:<?php echo trim_phone($vacancy['phone']); ?>"><?php echo $vacancy['phone']; ?></a>
               </div>
               <div class="single-vacancy__contacts-block">
                 <span>WhatsApp:</span>
                 <a href="https://wa.me/<?php echo trim_phone($vacancy['whatsapp']); ?>"><?php echo $vacancy['whatsapp']; ?></a>
               </div>
               <div class="single-vacancy__contacts-block">
                 <span>Email:</span>
                 <a href="email:<?php echo trim_phone($vacancy['email']); ?>"><?php echo $vacancy['email']; ?></a>
               </div>
             </div>
											<?php endif; ?>
          </div>
          <div class="single-vacancy__form-wrap">
            <h3>Оставить заявку на вакансию</h3>
            <form class="send-cv" enctype="multipart/form-data" method="post">
              <div class="text-wrap required">
                <input type="text" name="full-name" id="full-name" placeholder="...">
                <label for="full-name">ФИО</label>
              </div>
              <div class="text-wrap required">
                <input type="text" name="phone" id="phone" placeholder="+7...">
                <label for="phone">Телефон</label>
              </div>
              <div class="text-wrap">
															<?php
															$args = array(
																'post_type' => 'vacancy',
                                'post_status' => 'publish',
																'posts_per_page' => -1
															);
															$vacancies = get_posts($args);
															?>
                <select name="vacancy" id="vacancy">
                  <?php foreach ($vacancies as $post):
                    setup_postdata( $post );
																			?>
                    <option value="<?php the_title();?>" <?php if ($page_title == get_the_title()) echo 'selected';?>><?php the_title();?></option>
                  <?php endforeach; wp_reset_postdata();?>

                </select>
                <label for="vacancy">Телефон</label>
              </div>
              <div class="file-wrap">
                <label for="file-cv">
                  <input type="file" accept=".pdf,.txt,.doc,.docx" name="file-cv" id="file-cv">
                  <span class="file-text">Прикрепить резюме</span>
                </label>
              </div>
              <button type="submit" class="button orange big">отправить заявку</button>
            </form>

            <!--											--><?php //echo do_shortcode('[contact-form-7 id="8342975" title="Вакансия"]'); ?>
          </div>
        </div>
        <div class="single-vacancy__content"><?php the_content(); ?></div>
      </div>
    </div>
  </div>
</main>


<?php
get_template_part('parts/about');
get_template_part('parts/map');
get_template_part('parts/footer'); ?>
