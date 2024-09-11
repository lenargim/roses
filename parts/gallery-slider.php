<?php if (have_rows('gallery', 88)): ?>
  <section class="section gallery">
    <div class="container">
      <h2 class="h2">Галерея</h2>
      <div class="grid-wrap">
        <div class="grid-3-11">
          <div class="gallery-slider">
            <div class="prev slider__prev"></div>
            <div class="next slider__next"></div>
            <div class="swiper-wrapper">
													<?php while (have_rows('gallery', 88)): the_row();
														$img = get_sub_field('slide');
														$desc = get_sub_field('desc');
														?>
               <div class="swiper-slide">
                 <div class="gallery__desc"><?php echo $desc; ?></div>
                 <div class="gallery__slide">
                   <img src="<?php echo $img; ?>" alt="<?php echo $desc; ?>">
                 </div>
               </div>
													<?php endwhile; ?>
            </div>
          </div>
          <div class="gallery-thumbs">
            <div class="prev slider__prev"></div>
            <div class="next slider__next"></div>
            <div class="swiper-wrapper">
													<?php while (have_rows('gallery', 88)): the_row();
														$img = get_sub_field('slide');
														$desc = get_sub_field('desc');
														?>
               <div class="swiper-slide">
                   <img src="<?php echo $img; ?>" alt="<?php echo $desc; ?>">
               </div>
													<?php endwhile; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>