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
		<?php echo $content;?>
	</div>
</div>
