<!-- start note -->
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title pull-left" contenteditable="true">
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
                    echo $this->Form->postLink(
                        $span,
                        array(
                            'controller' => 'notes',
                            'action' => 'delete',
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
                    )
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body" contenteditable="true">
        	<?=$body . "\n";?>
        </div>
    </div>
</div>
<!-- end note -->
