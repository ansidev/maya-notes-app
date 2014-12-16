<?php $this->start('inline_script'); ?>
<script>
    var client = new Dropbox.Client({
        key: 'zqbqp0fe1i6oacx'
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

    //Sync note from Dropbox to web site
    function doSyncDown() {
        client.readdir('Apps/MayaNote/', function (error, info) {
            if (error) {
                alert('Error: ' + error);
            } else {
                $('#main-content').html('');
                $.each(info, function(index, value) {
                    doAddNote(index, value);
                });
            }
        });
    }

    //Add note to bottom of list
    function doAddNote(index, title) {
        client.readFile('Apps/MayaNote/' + title, function (error, body) {
            if (error) {
                alert('Error: ' + error);
            } else {
                var html = $('#main-content').html();
                html += doGenerateHtml(title, body, index);
                $('#main-content').html(html);
                doHandleClickButton();
            }
        });
    }

    //Generat HTML for note
    function doGenerateHtml(title, body, index) {
        var html = '';
        html += '<div id="note-' + index + '" class="note col-md-12">';
            html += '<div class="panel panel-primary">';
                html += '<div class="panel-heading">';
                    html += '<div class="row">';
                        html += '<div class="panel-title pull-left" id="note-title-' + index + '">';
                            html += title;
                        html += '</div>';
                            html += '<div class="panel-button btn-group pull-right ">';
                                html += '<button type="button" class="btn btn-danger edit-button" id="edit-button-' + index + '">';
                                    html += '<span class="glyphicon glyphicon-edit"></span>';
                                html += '</button>';
                                html += '<button type="button" class="btn btn-danger delete-button" data-toggle="modal" data-target="#deleteModal" id="delete-button-' + index + '">';
                                    html += '<span class="glyphicon glyphicon-remove"></span>';
                                html += '</button>';
                            html += '</div>';
                            html += '<div class="clearfix"></div>';
                    html += '</div>';
                html += '</div>';
                html += '<div class="panel-body" id="note-body-' + index + '">';
                    html += body;
                html += '</div>';
            html += '</div>';
        html += '</div>';
        return html;
    }

    //Handle Click event for button after generate code
    function doHandleClickButton() {
        $(".edit-button").on('click',function(){
            var id = this.id;
            id = id.replace('edit-button-', '');
            title = $('#note-title-' + id).text();
            body = $('#note-body-' + id).text();
            $('#id').val(id);
            // console.log(id)
            $('#note-title-old').val(title);
            $('#note-body-old').val(body);
            $('#note-title-new').val(title);
            $('#note-body-new').val(body);
            $('#editModal').modal('show');
        });
        $(".delete-button").on('click',function(){
            var id = this.id;
            id = id.replace('delete-button-', '');
            $('#id-delete').val(id);
        });
    }

    //Handle click event of #saveButton
    $('#saveButton').click(function(e) {
        e.preventDefault();
        client.authenticate(function (error, client) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doSaveNote();
            }
        });
    })

    //Write note to Dropbox and add it to current page
    function doSaveNote() {
        client.writeFile('Apps/MayaNote/' + $('#note-title-new').val(), $('#note-body-new').val(), function (error) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doAddToList($('#note-title-new').val(), $('#note-body-new').val());
                $('#note-title-new').val(null);
                $('#note-body-new').val(null);
                $('#addModal').modal('hide');
                doHandleClickButton()
            }
        });
    }

    //Add note to top of list
    function doAddToList(title, body) {
        var temp = $('#main-content').html();
        var index = $('.note').length;
        html = doGenerateHtml(title, body, index);
        $('#main-content').html(html);
        $('#main-content').append(temp);
    }

    //Handle click event of #saveChangeButton
    $('#saveChangesButton').on('click', function() {
        client.authenticate(function (error, client) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doSaveChangesNote();
            }
        });
    })

    //Write changes of note to Dropbox and update it to current page
    function doSaveChangesNote() {
        console.log($('#note-title-new').val())
        console.log($('#note-body-new').val())
        // client.writeFile('Apps/MayaNote/' + $('#note-title-new').val(), $('#note-body-new').val(), function (error) {
        //     if (error) {
        //         alert('Error: ' + error);
        //     } else {
        //         doUpdateChanges($('#id').val(), $('#note-title-new').val(), $('#note-body-new').val());
        //         $('#note-title-new').val(null);
        //         $('#note-body-new').val(null);
        //         $('#editModal').modal('hide');
        //     }
        // });
    }

    function doDeleteOldNote() {
    }
    //Update changes of note
    function doUpdateChanges(id, title, body) {
        $('#note-title-' + id).text(title);
        $('#note-body-' + id).text(body);
    }

    //Write changes of note to Dropbox and update it to current page
    function doSaveChangesNote() {
        console.log($('#note-title').val())
        console.log($('#note-body').val())
        client.writeFile('Apps/MayaNote/' + $('#note-title-edit').val(), $('#note-body-edit').val(), function (error) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doUpdateChanges($('#id').val(), $('#note-title-edit').val(), $('#note-body-edit').val());
                $('#note-title-edit').val(null);
                $('#note-body-edit').val(null);
                $('#editModal').modal('hide');
            }
        });
    }

    //Update changes of note
    function doUpdateChanges(id, title, body) {
        $('#note-title-' + id).text(title);
        $('#note-body-' + id).text(body);
    }

    //Handle click event for #deleteConfirmButton
    $('#deleteConfirmButton').on('click', function() {
        id = $('#id-delete').val();
        // console.log(id);
        doDeleteNote(id);
    });

    //Delete a note from Dropbox
    function doDeleteNote(id) {
        title = $('#note-title-' + id).text();
        // console.log(title)
        client.remove('Apps/MayaNote/' + title, function (error) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doRemoveNoteFromPage(id);
                $('#deleteModal').modal('hide');
                alert('Deleted note successfully');
            }
        });
    }

    function doRemoveNoteFromPage(id) {
        $('#note-' + id).remove();
    }

    //Sync data from Dropbox
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

    $('#writeButton').click(function(e) {
        e.preventDefault();
            client.authenticate(function (error, client) {
                if (error) {
                    alert('Error: ' + error);
                } else {
                    doHelloWorld();
                }
            });
    })

    function doHelloWorld() {
        client.writeFile('Apps/MayaNote/' + 'hello.txt', 'Hello, World!', function (error) {
            if (error) {
                alert('Error: ' + error);
            } else {
                alert('File written successfully!');
            }
        });
    }    

</script>
<?php $this->end(); ?>