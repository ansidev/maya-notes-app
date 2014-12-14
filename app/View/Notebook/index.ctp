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
                'All notes', '#all', array(
            'escape' => false,
            'onclick' => 'list(\'all\')'
        ));
        echo $this->Html->tag(
                'li', $all_link, array(
            'id' => 'all',
            'class' => 'active',
        ));
        // Print notebook list
        foreach ($notebooks as $value) {
            $notebook = $value['Notebook'];
            $notebook_link = $this->Html->link(
                    $notebook['book_name'], '#', array(
                'style' => 'padding-left: 15px;',
                'id' => $notebook['id'],
                'onclick' => 'list(' . $notebook['id'] . ')',
                'escape' => false,
            ));
            echo $this->Html->tag(
                    'li', $notebook_link, array(
                'id' => 'notebook-' . $notebook['id']
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
	<h1 id="main-title">All notes</h1>
    <?php
        $notes = $this->requestAction('notes/index/sort:note_created/direction:desc');
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
    ?>
<?php $this->end(); ?>