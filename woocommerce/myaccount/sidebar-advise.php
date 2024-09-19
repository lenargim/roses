<div class="account__advise">
  <div class="account__advise-title">Ваши предложения</div>
  <p>Если существуют товары, которые вы хотели бы видеть в нашем каталоге, но их пока нет, напишите список желаемых
    товаров, чтобы мы могли учесть их в будущем! </p>
  <button type="button" class="button orange open-advise big">заполнить заявку</button>
</div>
<div class="dark advise-overlay">
  <div class="modal modal-advise">
    <div class="modal__close"></div>
    <div class="modal__title">Предложения и пожелания</div>
    <div class="modal__desc">Если существуют товары, которые вы хотели бы видеть в нашем каталоге, но их пока нет,
      напишите список желаемых товаров, чтобы мы могли учесть их в будущем! Укажите свое имя и номер телефона.
    </div>

    <form class="modal-advise__form">
      <div class="text-wrap required">
        <input type="text" id="name" name="name" value="<?php if (isset($name)) echo $name; ?>" placeholder="...">
        <label for="name">ФИО</label>
      </div>
      <div class="text-wrap required">
        <input type="text" id="phone" class="phone" name="phone" placeholder="..." value="<?php if (isset($phone)) echo $phone; ?>">
        <label for="phone">Телефон</label>
      </div>
      <div class="text-wrap required">
        <textarea name="textarea" id="textarea" rows="5" placeholder="..."></textarea>
        <label for="textarea">Желаемые товары</label>
      </div>

      <button type="submit" class="button orange big" disabled>отправить</button>
    </form>
  </div>
</div>