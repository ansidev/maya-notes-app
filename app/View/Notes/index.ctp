<?php $this->start('main'); ?>
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
<?php $this->start('inline_script'); ?>
<script>
    var client = new Dropbox.Client({
        key: 'zqbqp0fe1i6oacx'
    });

    function doWriteHelloWorld() {
        client.writeFile('Apps/MayaNote/hello.txt', 'Hello, Dropbox!', function (error) {
            if (error) {
                alert('Error: ' + error);
            } else {
                alert('File written successfully!');
            }
        });
    }

    function doReadHelloWorld() {
        client.readFile('Apps/MayaNote/hello.txt', function (error, info) {
            if (error) {
                alert('Error: ' + error);
            } else {
                console.log(info);
                alert('File read successfully!');
            }
        });
    }

    function doAddNote(title) {
        client.readFile('Apps/MayaNote/' + title, function (error, body) {
            if (error) {
                alert('Error: ' + error);
            } else {
                var html = $('#main-content').html();
                html += '<div class="note col-md-12">';
                    html += '<div class="panel panel-primary">';
                        html += '<div class="panel-heading">';
                            html += '<div class="row">';
                                html += '<div class="panel-title pull-left" contenteditable="false">';
                                    html += title;
                                html += '</div>';
                                // html += '<div class="panel-button btn-group pull-right">';
                            html += '</div>';
                        html += '</div>';
                        html += '<div class="panel-body" contenteditable="false">';
                            html += body;
                        html += '</div>';
                    html += '</div>';
                html += '</div>';
                $('#main-content').html(html);
            }
        });
    }

    function doSyncDown() {
        client.readdir('Apps/MayaNote/', function (error, info) {
            if (error) {
                alert('Error: ' + error);
            } else {
                $('#main-content').html('');
                $.each(info, function(index, value) {
                    doAddNote(value);
                });
            }
        });
    }

    $('#writeButton').click(function(e) {
        e.preventDefault();
        client.authenticate(function (error, client) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doWriteHelloWorld();
            }
        });
    })

    $('#readButton').click(function(e) {
        e.preventDefault();
        client.authenticate(function (error, client) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doReadHelloWorld();
            }
        });
    })

    $('#listButton').click(function(e) {
        e.preventDefault();
        client.authenticate(function (error, client) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doList();
            }
        });
    })

    $('#syncButton').click(function(e) {
        e.preventDefault();
        client.authenticate(function (error, client) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doSyncDown();
            }
        });
    })

    $(document).ready(function() {
        client.authenticate(function (error, client) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doSyncDown();
            }
        });
    })
</script>
<?php $this->end(); ?>