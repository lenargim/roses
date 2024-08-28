<?php
$terms = get_terms([
//	'taxonomy' => 'product_cat',
	'hide_empty' => false,
	'include' => [36, 37, 38],
	'orderby' => 'menu_order'
]);
?>

<?php if ($terms): ?>
  <section class="section background">
    <div class="container">
      <h2 class="h2">У нас в продаже</h2>
      <div class="grid grid-3">
							<?php foreach ($terms as $term):
								$thumb_id = get_term_meta($term->term_id, 'thumbnail_id', true);
								$term_img = lenar_get_img(wp_get_attachment_url($thumb_id, 'extra-sale')); ?>

         <a href="<?php echo get_term_link($term); ?>"
            class="grid__item" style="background-image: url(<?php echo $term_img; ?>)">
           <span><?php echo $term->name ?></span>
         </a>
							<?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>