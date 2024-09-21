<?php
$rus = $array = array(
	'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р',
	'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Э', 'Ю', 'Я'
);
$eng = range('A', 'Z');
?>

<div class="abc">
  <div class="abc__wrap">
    <div class="abc__line rus">
					<?php foreach ($rus as $letter): ?>
       <a href="?s=<?php echo $letter; ?>&post_type=product"><?php echo $letter; ?></a>
					<?php endforeach; ?>
    </div>
    <div class="abc__line eng">
					<?php foreach ($eng as $letter): ?>
       <a href="?s=<?php echo $letter; ?>&post_type=product"><?php echo $letter; ?></a>
					<?php endforeach; ?>
    </div>
  </div>
</div>
