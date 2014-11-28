<!-- start note -->
<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="row">
                <div class="panel-title pull-left" contenteditable="false">
                    <?=$title . "\n";?>
                </div>
                <div class="panel-button btn-group pull-right">
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
                        )
                    ?>
                    <?php
                        $span = $this->Html->tag(
                            'span',
                            '',
                            array(
                                'class' => 'glyphicon glyphicon-remove' 
                            )
                        );
                        // echo $this->Form->postLink('...','#');
                        // $postLink = $this->Form->postLink(
                        $postLink = $this->Html->link(
                            $span,
                            array(
                                'controller' => 'notes',
                                'action' => 'moveToTrash',
                                $id
                            ),
                            array(
                                'role' => 'button',
                                'class' => 'btn btn-primary',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'bottom',
                                'title' => 'Move to Trash',
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
                    <span class="label label-primary"><?=$notebook;?></span>
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
