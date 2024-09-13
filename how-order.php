<?php
// Template Name: How order

get_template_part('parts/header');
?>
<main class="how-order">
  <div class="container">
    <div class="grid-wrap">
      <div class="grid-2-12">
       <h1 class="h1"><?php the_title(); ?></h1>
        <div class="how-order__content">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
get_template_part('parts/services');
get_template_part('parts/map');
get_template_part('parts/footer');
?>

