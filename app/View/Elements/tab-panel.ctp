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
	<div class="note col-md-12">
		<?php echo $col1;?>
	</div>
	<div class="note col-md-12">
		<?php echo $col2;?>
	</div>
	<div class="note col-md-12">
		<?php echo $col3;?>
	</div>
</div>
