<?php
    // if(!empty($request)) {
    //     if($request == 'get') {
    //         // $id = 'first-sidebar';
    //         $id = 'main';
    //     }
    //     else {
    //         $id = 'main';
    //     }
    // }
    // else {
    //     $id = 'main';
    // }
?>
<div class="row" id="note-wrapper">
	<div class="panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">
				<?php echo $note[0]['Note']['note_title'];?>
			</h3>
		</div>
		<div class="panel-body">
			<?php echo htmlspecialchars_decode($note[0]['Note']['note_body']);?>
		</div>
	</div>
</div>
