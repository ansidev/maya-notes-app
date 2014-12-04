<!-- <?=$id;?> -->
<?php
	if (empty($active)) {
	$active = '';
	}
	elseif($active) {
		$active = 'in active';
	}
	else {
		$active = '';
	}
?>
<div role="tabpanel" class="tab-pane fade <?=$active;?>" id="<?=$id;?>" aria-labelledBy="<?=$id;?>-tab">
	<h1><?php echo $name;?></h1>
	<div class="row" id="notebook">
		<?php echo $content;?>
	</div>
</div>
