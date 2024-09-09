<div class="filters">
  <button type="button" class="button filter reset">Сбросить все</button>
  <button type="button" class="button filter tags">Теги</button>
<!--  <button type="button" class="button filter sort">Сортировать</button>-->
	<?php woocommerce_catalog_ordering() ?>
  <div class="filter__wrap ">
    <button type="button" class="button filter big">Фильтры</button>
    <div class="filter__list">
					<?php echo do_shortcode('[br_filters_group group_id=226]'); ?>
    </div>
  </div>
</div>