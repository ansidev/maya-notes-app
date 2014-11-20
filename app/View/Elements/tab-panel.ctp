<!-- <?=$id;?> -->
<?php
	if (empty($active)) {
	$active = '';
	}
	elseif($active) {
		$active = 'active';
	}
	else {
		$active = '';
	}
?>
<div role="tabpanel" class="tab-pane fade in <?=$active;?>" id="<?=$id;?>" aria-labelledBy="<?=$id;?>-tab">
	<h1><?php echo $name;?></h1>
	<?php echo $content;?>
</div>
