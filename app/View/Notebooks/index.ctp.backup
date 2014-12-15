<?php $this->start('sidebar'); ?>
    <ul id="first-sidebar" class="sidebar-nav">
        <a id="menu-close" href="#" class="btn btn-primary pull-right">
            <i class="glyphicon glyphicon-remove"></i>
        </a>
        <?php
        // $notebooks = $this->requestAction('notebooks/index/sort:book_name/direction:asc');

        // Print site brand
        echo $this->Html->tag(
                'li', 'Notebook', array(
            'class' => 'sidebar-brand'
        ));
        // Print Notebook list
        // Print 'All notes'
        $all_link = $this->Html->link(
                'All notes',
                    array(
                        'controller' => 'notebooks',
                        'action' => 'index',
                    ),
                array(
            'escape' => false,
        ));
        $active = null;
        if(empty($id)) {
            $active = 'active';
        }
        echo $this->Html->tag(
                'li', $all_link, array(
            'id' => 'all',
            'class' => $active,
        ));
        // Print notebook list
        foreach ($notebooks as $value) {
            $notebook = $value['Notebook'];
            $active = null;
            $p = 15;
            if(!empty($id)) {
                if($notebook['id'] == $id) {
                    $active = 'active';
                    $p = 10;
                }
            }
            $notebook_link = $this->Html->link(
                    $notebook['book_name'],
                    array(
                        'controller' => 'notebooks',
                        'action' => 'index',
                        $notebook['id']
                    ),
                    array(
                        'style' => 'padding-left: '. $p . 'px;',
                        'id' => $notebook['id'],
                        'escape' => false,
            ));
            echo $this->Html->tag(
                    'li', $notebook_link, array(
                'id' => 'notebook-' . $notebook['id'],
                'class' => $active,
            ));
        }
        // Print 'Trash' and 'Uncategorized' link
        $link = $this->Html->link(
                'Trash', "#trash", array(
            'onclick' => 'list(\'trash\')',
            'escape' => false
        ));
        echo $this->Html->tag(
                'li', $link, array(
            'id' => 'trash'
        ));
        $link = $this->Html->link(
                'Uncategorized', "#uncategorized", array(
            'onclick' => 'list(\'uncategorized\')',
            'escape' => false
        ));
        echo $this->Html->tag(
                'li', $link, array(
            'id' => 'uncategorized'
        ));
        ?>
        </ul>
<?php $this->end(); ?>

<?php $this->start('main'); ?>
    <h1></h1>
    <?php
        if(empty($id)) {
            $notes = $this->requestAction('notes/index/sort:note_created/direction:desc');
        }
        if(!empty($notes)) {
            foreach ($notes as $value) {
                $note = $value['Note'];
                // pr($note);
                echo $this->element(
                    'note',
                    array(
                        'id' => $note['id'],
                        'title' => $note['note_title'],
                        'body' => $note['note_body'],
                        'trashed' => $note['trashed'],
                        'uncategorized' => $note['uncategorized'],
                        'shared' => $note['shared'],
                        'created_date' => $note['note_created']
                    )
                );
            }
        }
        else {
           echo 'There are no notes!';
        }
        // pr($notes);
    ?>
<?php $this->end(); ?>