<?php
$current_year = date("Y");
$first_Year = 2023;
$select_years_array = [];
for ($i = $first_Year; $i <= $current_year; $i++) {
	$select_years_array[] = $i;
}
$whole_year = $search_year . '-01-01...' . $search_year . '-12-31';
$args = array(
	'customer_id' => get_current_user_id(),
	'date_created' => $whole_year,
	'limit' => '-1',
);
$orders = wc_get_orders($args);
?>

<div class="account__table-wrap">
	<?php if ($orders):
		$season_total = 0; ?>
   <div class="account__table-before">
     <h3>История ваших заказов</h3>
     <select name="order-years" id="order-years">
						<?php foreach ($select_years_array as $value):
							$is_checked = $value === intval($search_year);
							?>
        <option value="<?php echo $value ?>" <?php if ($is_checked) echo 'selected'; ?>><?php echo $value ?> год</option>
						<?php endforeach; ?>
     </select>
   </div>
   <div class="account__table">
     <div class="tr">
       <div class="th">Дата заказа</div>
       <div class="th">Кол-во позиций</div>
       <div class="th">Статус</div>
       <div class="th">Сумма заказа</div>
       <div class="th">Дата получения</div>
       <div class="th">Товар</div>
     </div>
				<?php foreach ($orders as $order):
					$date_created = $order->get_date_created();
					$date_completed = $order->get_date_completed();
					$season_total += $order->get_total();
					$date_completed_text = 'Не получен';
					if (isset($date_completed)) {
						$date_completed_text = $date_completed->date('d.m.Y');
					}
					?>
      <div class="tr">
        <div class="td"><?php echo $date_created->date('d.m.Y'); ?></div>
        <div class="td"><?php echo $order->get_item_count(); ?></div>
        <div class="td <?php if ($order->get_status() === 'completed') echo 'bold'; ?>"><?php echo get_ru_order_status($order->get_status()); ?></div>
        <div class="td"><?php echo $order->get_total(); ?> ₽</div>
        <div class="td"><?php echo $date_completed_text; ?></div>
        <div class="td"></div>
      </div>
				<?php endforeach; ?>
   </div>
   <div class="account__table-after">
     <span>Сумма покупок за сезон</span>
     <span><?php echo $season_total; ?> ₽</span>
   </div>
	<?php else: ?>
   <div class="account__table-before">
     <h3>История ваших заказов пуста  <?php echo $search_year?></h3>
     <select name="order-years" id="order-years">
						<?php foreach ($select_years_array as $value):
							$is_checked = $value === intval($search_year);
							?>
        <option value="<?php echo $value ?>" <?php if ($is_checked) echo 'selected'; ?>><?php echo $value ?> год</option>
						<?php endforeach; ?>
     </select>
   </div>
	<?php endif; ?>
</div>
