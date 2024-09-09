<div class="dark modal-order-overlay">
  <div class="modal modal-order">
			<?php $checkout = new WC_Checkout(); ?>
			<?php $fields = $checkout->get_checkout_fields('billing'); ?>
    <button type="button" class="modal__close"></button>
    <h4 class="modal__title">Остались вопросы?</h4>
    <h4 class="modal__desc">Оставьте свои контактные данные и наш менеджер с вами свяжется.</h4>


    <div class="text-wrap">
      <input type="text" id="billing_first_name" name="billing_first_name" placeholder="...">
      <label for="billing_first_name">Имя</label>
    </div>
    <div class="text-wrap">
      <input type="text" id="billing_phone" name="billing_phone" placeholder="...">
      <label for="billing_phone">Телефон</label>
    </div>
    <div class="text-wrap">
      <input type="text" id="billing_email" name="billing_email" placeholder="...">
      <label for="billing_email">Email</label>
    </div>
    <button type="submit" class="button orange big" name="woocommerce_checkout_place_order" id="place_order"
            value="Отправить">Отправить
    </button>
  </div>
</div>