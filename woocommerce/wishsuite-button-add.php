<?php
$svg = '<svg viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M19.456 32.0821C18.9318 32.2671 18.0685 32.2671 17.5443 32.0821C13.0735 30.5558 3.0835 24.1888 3.0835 13.3971C3.0835 8.63334 6.92225 4.77917 11.6552 4.77917C14.461 4.77917 16.9431 6.13584 18.5002 8.23251C20.0572 6.13584 22.5547 4.77917 25.3452 4.77917C30.0781 4.77917 33.9168 8.63334 33.9168 13.3971C33.9168 24.1888 23.9268 30.5558 19.456 32.0821Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
</svg>'
?>
<a href="<?php echo esc_url($button_url); ?>" class="<?php echo esc_attr($button_class); ?>"
   data-product_id="<?php echo esc_attr($product_id); ?>"><?php echo __($svg, 'wishsuite'); ?>
</a>

