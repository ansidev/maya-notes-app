<?php $this->start('inline_scripts'); ?>
<script>
function list(notebookId){
//       var data = "id="+ postId;
		console.log(notebookId);
		var url = '<?php echo Router::url(array('controller' => 'notebooks', 'action' => 'view'));?>/' + notebookId;
	        $.ajax({
	            type: "post",  // Request method: post, get
	            url: url, // URL to request
	            data: { id: notebookId},  // post data
	//            dataType: "json",
	            success: function(response) {
					document.getElementById("note_title").innerHTML = response;
					console.log(response);
				},
				error:function (status) {
				      alert(status);
				}
			});
			return false;
}

function view(noteId){
//       var data = "id="+ postId;
		console.log(noteId);
		var url = '<?php echo Router::url(array('controller' => 'notes', 'action' => 'view'));?>/' + noteId;
	        $.ajax({
	            type: "post",  // Request method: post, get
	            url: url, // URL to request
	            data: { id: noteId},  // post data
	//            dataType: "json",
	            success: function(response) {
					document.getElementById("note_body").innerHTML = response;
					console.log(response);
				},
				error:function (status) {
				      alert(status);
				}
			});
			return false;
}
</script>
<?php $this->end(); ?>
<?php
    $this->Paginator->options(array(
        'update' => '#note_body',
        'evalScripts' => true, 
    ));
?>
<!--Start book_name-->
<?php $this->start('book_name'); ?>
<ul id="first-sidebar" class="sidebar-nav">
    <?php
    //Generate span html
    $span = $this->Html->tag(
            'span', '', array(
        'class' => 'glyphicon glyphicon-sort'
    ));
    // Generate sort link
    $sort = $this->Paginator->sort('book_name', $span, array(
        'direction' => 'asc',
        'escape' => false));
    // Print site brand
    echo $this->Html->tag(
            'li', 'Notebook', array(
        'class' => 'sidebar-brand'
    ));
    // Print Notebook list
    // Print 'All notes' 
    $all_link = $this->Html->link(
            'All notes', '#', array(
        'escape' => false,
        'onclick' => 'list(\'all\')'
    ));
    echo $this->Html->tag(
            'li', $all_link, array(
        'id' => 'all'
    ));
    // Print notebook list
    foreach ($notebooks as $value) {
        $notebook = $value['Notebook'];
        $notebook_link = $this->Html->link(
                $notebook['book_name'], '#', array(
            'style' => 'padding-left: 15px;',
            'onclick' => 'list(' . $notebook['id'] . ')',
            'escape' => false,
        ));
        echo $this->Html->tag(
                'li', $notebook_link, array(
            'id' => 'notebook-' . $notebook['id']
        ));
    }
    // Print 'Trash' link
    $link = $this->Html->link(
            'Trash', "#", array(
        'onclick' => 'list(\'trash\')', 
        'escape' => false
    ));
    echo $this->Html->tag(
            'li', $link, array(
        'id' => 'trash'
    ));
    ?>
</ul>
<?php $this->end(); ?>
<!--End book_name-->
<!--Start note_title-->
<?php $this->start('note_title'); ?>
<ul id="second-sidebar" class="sidebar-nav">
    <?php
    //Generate span html
    $span = $this->Html->tag(
            'span', '', array(
        'class' => 'glyphicon glyphicon-sort'
    ));
    // Generate sort link
    $sort = $this->Paginator->sort('note_modified', $span, array(
        'direction' => 'asc',
        'escape' => false));
//     Print site brand
   echo $this->Html->tag(
           'li', 'Note', array(
       'class' => 'sidebar-brand'
   ));
    // Print Note list
//    echo $this->Html->tag(
//            'li', $all_link, array(
//        'id' => 'all'
//    ));
    // Print notebook list
    foreach ($notes as $value) {
        $note = $value['Note'];
        $note_link = $this->Html->link(
                $note['note_title'], '#', array(
//            'style' => 'padding-left: 15px;',
            'onclick' => 'view(' . $note['id'] . ')',
            'escape' => false,
        ));
        echo $this->Html->tag(
                'li', $note_link, array(
            'id' => 'note-' . $note['id']
        ));
    }
    ?>
</ul>
<?php $this->end(); ?>
<!--End note_title-->
<!--Start note_body-->
<?php $this->start('note_body'); ?>
<?php $this->end(); ?>

<!--End note_body-->