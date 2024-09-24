<section class="section delivery-calc">
  <div class="delivery-calc__box">
    <h2>Калькулятор стоимости доставки</h2>
    <div class="delivery-calc__calc">
      <div class="delivery-calc__form">
        <select name="delivery-type" class="button big" id="delivery-type">
          <option></option>
        </select>
        <select name="pickup-address" id="pickup-address">
          <option></option>
        </select>
							<?php do_action('woocommerce_checkout_order_review'); ?>
        <select name="payment-type" id="payment-type">
          <option></option>
        </select>
        <div class="text-wrap">
          <input type="text" id="billing_address_1" name="billing_address_1" placeholder="г. Москва">
          <label for="billing_address_1">Адрес доставки</label>
        </div>
        <div class="text-wrap">
          <input type="text" id="order_price" placeholder="0₽">
          <label for="order_price">Сумма заказа</label>
        </div>
        <div class="accept-wrap">
          <input type="checkbox" id="is_from_cart" class="checkbox">
          <label for="is_from_cart">
            <span>Расчитать сумму товаров из текущей корзины</span>
          </label>
        </div>
        <div class="accept-wrap">
          <input type="checkbox" id="is_action" class="checkbox">
          <label for="is_action">
            <span>Акционные товары</span>
          </label>
        </div>
        <button type="button" disabled class="button big orange">расчитать стоимость</button>
      </div>
      <div class="delivery-calc__total">
        <p>Предварительная стоимость доставки:</p>
        <span>0₽</span>
      </div>
    </div>
  </div>
</section>