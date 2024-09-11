<?php
if (have_rows('slider',304)): ?>
  <div class="slider club-slider">
    <div class="slider__pagination"></div>
    <div class="swiper-wrapper">
					<?php while (have_rows('slider',304)) : the_row(); ?>
       <div class="swiper-slide">
								<?php
                $date = get_sub_field('date');
                $title = get_sub_field('title');
                $name = get_sub_field('name');
                $text = get_sub_field('text');
                $img = get_sub_field('img');
                ?>
         <div class="slider__item">
           <div class="slider__content background">
             <div class="slider__text">
               <div class="date"><?php echo $date; ?></div>
               <div>
                 <div class="title"><?php echo $title;?></div>
                 <div class="name"><?php echo $name;?></div>
                 <div class="text"><?php echo $text;?></div>
               </div>
               <button class="button orange small">ЗАПИСАТЬСЯ НА МК</button>
             </div>
           </div>
           <img src="<?php echo $img ?>" alt="<?php echo $title;?>" class="slider__img">
         </div>
       </div>
					<?php endwhile; ?>
    </div>
  </div>
<?php endif; ?>