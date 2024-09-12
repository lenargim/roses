<div class="cart-block__empty-wrap">
  <div class="cart-block__empty">
    <img src="<?php echo IMAGES_PATH . 'empty-cart.svg'; ?>" class="cart-block__empty-img" alt="Empty cart">
    <div class="cart-block__empty-text">
      <div class="cart-block__empty-title">Ваша корзина пока пуста!</div>
      <div class="cart-block__empty-desc">Перейдите в каталог, чтобы выбрать товары</div>
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="button orange">перейти в каталог</a>
    </div>
  </div>
</div>