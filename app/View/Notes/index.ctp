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
