<?php
// Template Name: Cart
defined('ABSPATH') || exit;
get_template_part('parts/header');

?>
  <div class="cart-block section">
    <div class="container">
      <h1 class="h1">Корзина</h1>
					<?php echo wc_get_template('cart/cart.php'); ?>
    </div>
  </div>
  </div>


  <section class="section delivery-calc">
    <div class="container">
      <div class="delivery-calc__wrap">
        <div class="delivery-calc__box">
          <h2>Калькулятор стоимости доставки</h2>
          <div class="delivery-calc__calc">
            <form class="delivery-calc__form">
              <select name="delivery-type" id="delivery-type" placeholder="Выберите способ доставки">
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
              </select>
              <select name="pickup-address" id="pickup-address" placeholder="Выберите способ доставки">
                <option value="1">1</option>
                <option value="2">2</option>
              </select>
              <select name="payment-type" id="payment-type" placeholder="Выберите способ оплаты">
                <option value="1">1</option>
                <option value="2">2</option>
              </select>

              <div class="text-wrap">
                <input type="text" id="delivery_address" placeholder="г. Москва">
                <label for="delivery_address">Адрес доставки</label>
              </div>
              <div class="text-wrap">
                <input type="text" id="order_price" placeholder="0₽">
                <label for="order_price">Сумма заказа</label>
              </div>
              <div class="input-wrap">
                <input type="checkbox" id="is_from_cart" class="checkbox">
                <label for="is_from_cart">
                  <span>Расчитать сумму товаров из текущей корзины</span>
                </label>
              </div>
              <div class="input-wrap">
                <input type="checkbox" id="is_action" class="checkbox">
                <label for="is_action">
                  <span>Акционные товары</span>
                </label>
              </div>
              <button type="button" class="button big orange">расчитать стоимость</button>
            </form>
            <div class="delivery-calc__total">
              <p>Предварительная стоимость доставки:</p>
              <span>0₽</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php
get_template_part('parts/new');
get_template_part('parts/extra-sale');
get_template_part('parts/map');
get_template_part('parts/footer'); ?>