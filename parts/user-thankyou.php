<?php

defined('ABSPATH') || exit; ?>

<div class="dark overlay-user-thx">
  <div class="modal modal-user-thx">
    <div class="modal__close"></div>
    <div class="modal-user-thx__wrap">
      <img src="<?php echo IMAGES_PATH . 'user-thx.png';?>" alt="Письмо отправлено">
      <div>
        <h3 class="modal__title">Письмо отправлено!</h3>
        <div class="modal__desc">
          На адрес <span class="user-email"></span> было выслано письмо с новыми данными для авторизации.
        </div>
      </div>
    </div>
  </div>
</div>
