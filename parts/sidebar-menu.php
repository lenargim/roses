<?php
global $wp_query;
global $allParentCategories;
?>
<?php
if (function_exists('yoast_breadcrumb')):
	yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">', '</p>');
endif; ?>
<div class="sidebar">
	<?php foreach ($allParentCategories as $parentCat):
		$termId = $parentCat->term_id;
		$isCurrent = isset($cat_obj->term_id) && $cat_obj->term_id === $termId;
		$isParent = isset($cat_obj->parent) && $cat_obj->parent === $termId;
		$isOpen = $isParent || $isCurrent;
		$children = get_terms([
			'taxonomy' => 'product_cat',
			'parent' => $termId,
			'hide_empty' => false
		]);
		$svg = '<svg viewBox="0 0 21 22" xmlns="http://www.w3.org/2000/svg">
         <path d="M6.20815 7.82617L10.0469 11.665L13.8857 7.82617L15.0704 9.01088L10.0469 14.0344L5.02344 9.01088L6.20815 7.82617Z" />
       </svg>'
		?>
   <div class="sidebar__parent sidebar__toggle <?php if ($isOpen) echo 'open' ?>">
     <button class="sidebar__button"
             type="button">
       <span><?php echo $parentCat->name ?></span>
						<?php echo $svg; ?>
     </button>
				<?php if ($children): ?>
      <div class="sidebar__list">
        <div class="sidebar__categories sidebar__toggle <?php if ($isOpen) echo 'open' ?>">
          <button type="button" class="sidebar__button"><span>По Классам</span> <?php echo $svg; ?></button>
          <div class="sidebar__children sidebar__list">
											<?php foreach ($children as $child): ?>
												<?php $isCurrentLink = isset($cat_obj->term_id) && $cat_obj->term_id === $child->term_id; ?>
             <a href="<?php echo get_term_link($child) ?>"
                class="<?php if ($isCurrentLink) echo 'current' ?>"><?php echo $child->name; ?></a>
											<?php endforeach; ?>
          </div>
        </div>
        <div class="sidebar__tags sidebar__toggle <?php if ($isCurrent) echo 'open' ?>">
									<?php
									$tags = get_terms('product_tag');
									?>
          <button type="button" class="sidebar__button"><span>По группам</span><?php echo $svg; ?></button>
          <div class="sidebar__children sidebar__list">
											<?php foreach ($tags as $tag): ?>
             <a href="<?php echo get_term_link($tag) ?>"><?php echo $tag->name; ?></a>
											<?php endforeach; ?>
          </div>
        </div>
      </div>
				<?php endif; ?>
   </div>
	<?php endforeach; ?>
</div>
