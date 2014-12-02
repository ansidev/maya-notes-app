<!-- start note -->
<?php
    if($trashed) {
        $panel_class = 'default';
        $trash_mark = 'trash';
    }
    else {
        $panel_class = 'info';
        $trash_mark = null;
    }
?>
<div class="col-md-12 <?=$trash_mark;?>">
    <div class="panel panel-<?=$panel_class;?>">
        <div class="panel-heading">
            <div class="row">
                <div class="panel-title pull-left" contenteditable="false">
                    <?=$title . "\n";?>
                </div>
                <div class="panel-button btn-group pull-right">
                    <?php if(!$trashed): ?>
                    <?php
                        $span = $this->Html->tag(
                            'span',
                            '',
                            array(
                                'class' => 'glyphicon glyphicon-edit' 
                            )
                        );
                        echo $this->Html->link(
                            $span,
                            array(
                                'controller' => 'notes',
                                'action' => 'edit',
                                $id
                            ),
                            array(
                                'role' => 'button',
                                'class' => 'btn btn-primary',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'bottom',
                                'title' => 'Edit this note',
                                'escape' => false
                            )
                        );
                    ?>
                    <?php endif;?>
                    <?php
                        $span = $this->Html->tag(
                            'span',
                            '',
                            array(
                                'class' => 'glyphicon glyphicon-remove' 
                            )
                        );
                        $action = 'moveToTrash';
                        $act_title = 'Move to Trash';
                        if($trashed) {
                            $action = 'delete';
                            $act_title = 'Delete permanently';
                        }
                        // echo $this->Form->postLink('...','#');
                        // $postLink = $this->Form->postLink(
                        $postLink = $this->Html->link(
                            $span,
                            array(
                                'controller' => 'notes',
                                'action' => $action,
                                $id
                            ),
                            array(
                                'role' => 'button',
                                'class' => 'btn btn-primary',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'bottom',
                                'title' => $act_title,
                                'escape' => false,
                                'confirm' => 'Are you sure want to move this note to Trash?'
                            )
                        );
                        echo $postLink;
                    ?>
                </div>
            </div>
            <div class="row">
                    <?php
                        // debug($postLink);
                    ?>
                <div class="panel-title pull-left" contenteditable="false">
                    <?php if($notebook != null): ?>
                    <span class="label label-primary"><?=$notebook;?></span>
                    <?php endif;?>
                    <?php if($uncategorized): ?>
                    <span class="label label-primary">Uncategorized</span>
                    <?php endif;?>
                    <?php if($shared): ?>
                    <span class="label label-primary">Shared</span>
                    <?php endif;?>
                    <?php if($trashed): ?>
                    <span class="label label-danger">Trashed</span>
                    <?php endif;?>
                    <?php
                        $date = date_format(date_create($created_date), 'H:i:s d-m-Y');
                    ;?>
                    <span class="label label-default"><?=$date;?></span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body" contenteditable="false">
        	<?php echo htmlspecialchars_decode($body);?>

        </div>
    </div>
</div>
<!-- end note -->
