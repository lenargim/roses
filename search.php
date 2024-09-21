<?php
$squery = trim(get_search_query());

?>

<div id="primary" class="content-area search">
  <div class="container">
			<?php if (have_posts()) : ?>
     <section class="section">
       <h1 class="search__title h1">Поиск по запросу: <span><?php echo $squery ?></span></h1>
       <div class="search__loop">
								<?php while (have_posts()): the_post();
									wc_get_template_part('content', 'product');
								endwhile; ?>
       </div>
     </section>
			<?php else : ?>
     <div class="search__nothing">
       <div class="grid-wrap">
         <div class="grid-3-11">
           <div class="search__nothing-text">
             <div class="search__nothing-title">По запросу <span><?php echo $squery; ?></span> ничего не найдено</div>
             <div class="search__nothing-desc">
               <span>Рекомендации:</span>
               <ul>
                 <li>Убедитесь, что слова написаны без ошибок.</li>
                 <li>Попробуйте использовать другие ключевые слова.</li>
                 <li>Попробуйте использовать меньшее количество букв (не менее 3-х букв).</li>
                 <li>Используйте алфавитный указатель</li>
               </ul>
             </div>
             <div class="search__nothing-bottom">
               <a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>" class="button orange">Перейти в
                 каталог</a>
														<?php echo do_shortcode('[fibosearch]'); ?>
             </div>
           </div>
         </div>
       </div>
       <h2 class="h2">Алфавитный поиск</h2>
						<?php get_template_part('parts/abc'); ?>
       <a href="<?php echo home_url('/'); ?>" class="button orange search__back">Вернуться на главную</a>
     </div>

			<?php endif; ?>
  </div>

</div>
