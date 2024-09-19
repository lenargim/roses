<?php

defined('ABSPATH') || exit; ?>

<div class="dark active form-questions">
  <div class="modal modal-questions">
    <div class="modal__close"></div>
    <h2 class="modal__title">Остались вопросы?</h2>
    <div class="modal__desc">Оставьте свои контактные данные и наш менеджер с вами свяжется.</div>
    <form id="questions-form" method="post" class="modal-questions__form">
      <div class="text-wrap required">
        <input type="text" class="input-text" name="name" id="name"
               placeholder="..."/>
        <label for="name">Имя</label>
      </div>
      <div class="text-wrap required">
        <input type="text" class="input-text phone" name="phone" id="phone"
               placeholder="..."/>
        <label for="phone">Телефон</label>
      </div>
      <div class="text-wrap required">
        <input type="email" class="input-text" name="email" id="email"
               placeholder="..."/>
        <label for="email">Email</label>
      </div>
      <button type="submit" class="button orange big" disabled>отправить</button>
    </form>
  </div>
</div>

<div class="dark overlay-questions-thx">
  <div class="modal modal-questions-thx">
    <div class="modal__close"></div>
    <div class="modal-questions-thx__wrap">
      <img src="<?php echo IMAGES_PATH . 'questions-thx.png' ?>" alt="Спасибо!">
      <div class="modal-reset-sent__text">
        <h4>Спасибо!</h4>
        <div class="modal__desc">Наш менеджер скоро с вами свяжется!</div>
      </div>
    </div>
  </div>
</div>