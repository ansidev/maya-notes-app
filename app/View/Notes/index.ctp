<?php $this->start('inline_script'); ?>
<script>
    var client = new Dropbox.Client({
        key: 'zqbqp0fe1i6oacx'
    });

    //Generat HTML for note
    function doGenerateHtml(title, body, index) {
        var html = '';
        html += '<div class="note col-md-12">';
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
                                html += '<button type="button" class="btn btn-danger del-button" data-toggle="modal" data-target="#deleteModal">';
                                    html += '<span class="glyphicon glyphicon-remove"></span>';
                                html += '</button>';
                            html += '</div>';
                            html += '<div class="clearfix "></div>';
                    html += '</div>';
                html += '</div>';
                html += '<div class="panel-body id="note-body-' + index + '">';
                    html += body;
                html += '</div>';
            html += '</div>';
        html += '</div>';
        return html;
    }


    //Add note to top of list
    function doAddToList(title, body) {
        var temp = $('#main-content').html();
        var index = $('.note').length + 1;
        html = doGenerateHtml(title, body, index);
        $('#main-content').html(html);
        $('#main-content').append(temp);
    }


    //Write note to Dropbox and add it to current page
    function doSaveNote() {
        client.writeFile('Apps/MayaNote/' + $('#note-title').val(), $('#note-body').val(), function (error) {
            if (error) {
                alert('Error: ' + error);
            } else {
                doAddToList($('#note-title').val(), $('#note-body').val());
                $('#note-title').val(null);
                $('#note-body').val(null);
                $('#myModal').modal('hide');
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
            }
        });
    }

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

    $('.edit-button').click(function(e) {
        console.log(this.id);
        e.preventDefault();
        client.authenticate(function (error, client) {
            if (error) {
                alert('Error: ' + error);
            } else {
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