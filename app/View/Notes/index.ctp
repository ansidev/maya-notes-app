<?php
    $appDescription = __d('cake_dev', 'Maya Notes Web App');
?>
<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top animate" role="navigation" id="nav">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="glyphicon glyphicon-user"></span>
                </button>   
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#toolbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="glyphicon glyphicon-chevron-down"></span>
                </button>
                <a href="#menu-toggle" id="menu-toggle" class="navbar-btn btn btn-primary" style="display: none">
                    <span class="glyphicon glyphicon-list"></span>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <form class="navbar-form animate" role="search" action="#" method="GET" id="desktop-search-bar">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search your notes here" name="q">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <?php
                            $span_user = $this->Html->tag(
                                'span',
                                '',
                                array(
                                    'class' => 'caret'
                                )
                            );
                            echo $this->Html->link(
                                $users_display_name . ' ' . $span_user,
                                '',
                                array(
                                    'class' => 'dropdown-toggle',
                                    'data-toggle' => 'dropdown',
                                    'escape' => false
                                )
                            );
                        ?>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                            <?php
                                echo $this->Html->link(
                                    'Dashboard',
                                    array(
                                        'controller' => 'notes',
                                        'action' => 'index',
                                        'full_base' => true
                                    ),
                                    array(
                                        'escape' => false
                                    )
                                );
                            ?>
                            </li>
                            <li>
                            <?php
                                echo $this->Html->link(
                                    'Profiles',
                                    array(
                                        'controller' => 'users',
                                        'action' => 'profiles',
                                        'full_base' => true
                                    ),
                                    array(
                                        'escape' => false
                                    )
                                );
                            ?>
                            </li>
                            <li>
                            <?php
                                echo $this->Html->link(
                                    'Log out',
                                    array(
                                        'controller' => 'users',
                                        'action' => 'logout',
                                        'full_base' => true
                                    ),
                                    array(
                                        'escape' => false
                                    )
                                );
                            ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <div class="collapse navbar-collapse" id="toolbar">
                <ul class="nav navbar-nav">
                    <li>
                        <form class="navbar-form" role="search" action="#" method="GET" id="mobile-search-bar">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search your notes here" name="q">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li>
                        <!-- Split button -->
                        <div class="navbar-btn btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                New <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                <?php
                                    echo $this->Html->link(
                                        'Notebook',
                                        array(
                                            'controller' => 'notebooks',
                                            'action' => 'add',
                                            'full_base' => true
                                        ),
                                        array(
                                            'escape' => false
                                        )
                                    );
                                ?>
                                </li>
                                <li class="divider"></li>
                                <li>
                                <?php
                                    echo $this->Html->link(
                                        'Note',
                                        array(
                                            'controller' => 'notes',
                                            'action' => 'add',
                                            'full_base' => false
                                        ),
                                        array(
                                            'escape' => false
                                        )
                                    );
                                ?>
                                </li>
                                <li><a href="#">Reminder</a>
                                </li>
                                <li><a href="#">Event</a>
                                </li>
                                <li><a href="#">To do list</a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Split button -->
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div id="view-control" class="navbar-btn btn-group">
                            <button type="button" class="btn btn-primary listview">
                                <span class="glyphicon glyphicon-th"></span>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<div id="app">
    <div class="container-fluid">
        <div class="row">
            <div id="sidebar-wrapper" class="col-md-2 col-sm-12 animate" role="tabpanel">
                <ul id="myTab" class="nav nav-tabs nav-stacked nav-pills sidebar-nav" role="tablist">
                    <?php
                        $total = 0;
                        //Count number of user's notes
                        foreach ($curr_user_notebooks as $book) {
                            if($book['Notebook']['permitted'] !== '1') {
                                $total += count($book['Note']);
                            }
                        }
                    ?>
                    <a id="menu-close" href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-remove"></i></a>
                    <li style="margin-right: 55px"><?=$appDescription;?></li>
                    <li role="presentation" class="active">
                    <a href="#all" id="all-tab" role="tab" data-toggle="tab" aria-controls="all" aria-expanded="true">
                        All Notebook <span class="badge inline"><?=$total;?></span>
                    </a>
                    </li>
                    <?php
                    for($i = 0; $i < 3; $i++) {
                        array_push($curr_user_notebooks, array_shift($curr_user_notebooks));
                    }
                    foreach ($curr_user_notebooks as $book) {
                        $values[$book['Notebook']['id']]['name'] = $book['Notebook']['book_name'];
                        $values[$book['Notebook']['id']]['id'] = 'notebook-' . $book['Notebook']['id'];
                        $values[$book['Notebook']['id']]['content'] = '';
                        $total = count($book['Note']);
                        if($total === 0) {
                            $total = '';
                        }
                        $span_total = $this->Html->tag(
                            'span',
                            $total,
                            array(
                                'class' => 'badge inline'
                            )
                        );
                        //Generate User's notebooks
                        echo $this->Html->tag(
                            'li',
                            $this->Html->link(
                                $book['Notebook']['book_name'] . ' ' . $span_total,
                                '#' . 'notebook-' . $book['Notebook']['id'],
                                array(
                                    'id' => 'notebook-'. $book['Notebook']['id'] . '-tab',
                                    'role' => 'tab',
                                    'data-toggle' => 'tab',
                                    'aria-controls' => 'notebook-' . $book['Notebook']['id'],
                                    'aria-expanded' => 'true',
                                    'escape' => false
                                )
                            ),
                            array(
                                'role' => 'presentation'
                            )
                        );
                    }
                    ?>
    <!--            
                    <li role="presentation">
                        <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                            <li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">@fat</a>
                            </li>
                            <li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">@mdo</a>
                            </li>
                        </ul>
                    </li>
     -->            
                    </ul>
            </div>
            <div id="main" class="col-md-12 col-sm-12 tab-content animate">
            <?php
                // pr($this->Session);
                $all_id = count($curr_user_notebooks);
                // pr($all_id);
                $values[$all_id]['id'] = 'all';
                $values[$all_id]['name'] = 'All Notebooks';
                $values[$all_id]['content'] = '';
                $a = '';
                //Run loop to get inner html content of all notes
                foreach($curr_user_notebooks as $book) {
                    $b = '';
                    if(array_filter($book['Note'])) {
                        foreach ($book['Note'] as $note) {
                            // debug($note['note_title']);
                            $b .= $this->element(
                                'note',
                                array(
                                    'title' => $note['note_title'],
                                    'body' => $note['note_body'],
                                    'id' => $note['id']
                                )
                            );
                        }
                        // debug($b);
                    }
                    $values[$all_id]['content'] = $values[$all_id]['content'] . $b;
                    // set inner html content to notebook for dislay on each notebook tab
                    $values[$book['Notebook']['id']]['content'] = $values[$book['Notebook']['id']]['content'] . $b;
                }
                // pr($values);
                //Print all notes of each user's notebook
                foreach ($values as $key => $value) {
                    if($value['content'] === '') {
                        $value['content'] = "There are no notes!\n";
                    }
                    if($value['id'] === 'all') {
                        echo $this->element(
                            'tab-panel',
                            array(
                                'name' => $value['name'],
                                'id' => $value['id'],
                                'content' => $value['content'],
                                'active' => true
                            )
                        );
                    }
                    else {
                        echo $this->element(
                            'tab-panel',
                            array(
                                'name' => $value['name'],
                                'id' => $value['id'],
                                'content' => $value['content'],
                            )
                        );
                    }
                }
            pr($curr_user_notebooks);
            ?>

        </div>
        <!-- main -->
    </div>
    <!-- row -->
</div>
<!-- app -->
</div>
<!-- /.container -->

        <script type="text/javascript">
            $(document).ready(function() {
                //Display tooltip on hover
                $('[data-toggle="tooltip"]').tooltip();
                //Fade out alert messages
                $().alert('close');
                //Switch between ListView and GridView
                var elem = $('.note');
                $('#view-control > button').on('click', function(e) {
                    $('li .note').wookmark();
                    if ($(this).hasClass('gridview')) {
                        $(this).removeClass('gridview').addClass('listview');
                        $(this).children('span').removeClass('glyphicon-th-list').addClass('glyphicon-th');
                        //                    elem = $('div').hasClass('col-md-4');
                        elem.fadeOut(100, function() {
                            elem.removeClass('col-md-4').addClass('col-md-12');
                            elem.fadeIn(100);
                        });
                    } else if ($(this).hasClass('listview')) {
                        $(this).removeClass('listview').addClass('gridview');
                        $(this).children('span').removeClass('glyphicon-th').addClass('glyphicon-th-list');
                        //                    elem = $('div').hasClass('col-md-12');
                        elem.fadeOut(100, function() {
                            elem.removeClass('col-md-12').addClass('col-md-4');
                            elem.fadeIn(100);
                        });
                    }
                });
                //End switch between ListView and GridView
                //Toggle Sidebar
                $("#menu-close").click(function(e) {
                    e.preventDefault();
                    $("#menu-toggle").fadeIn(500).css("display", "inline-block");
                    $("#desktop-search-bar").css("padding-left", "15px");
                    $("body").toggleClass("toggled");
                    $(".footer").toggleClass("toggled");
                    $("#sidebar-wrapper").toggleClass("toggled");
                    $("#nav").toggleClass("toggled");
                    // $("#toolbar").toggleClass("toggled");
                });
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#menu-toggle").fadeOut(500).css("display", "none");
                    $("#desktop-search-bar").css("padding-left", "0");
                    $("body").toggleClass("toggled");
                    $(".footer").toggleClass("toggled");
                    $("#sidebar-wrapper").toggleClass("toggled");
                    $("#nav").toggleClass("toggled");
                    // $("#toolbar").toggleClass("toggled");
                });
                //End toggle sidebar
                // $(function() {
                //     $('.sortable').sortable();
                //     //                $('.handles').sortable({
                //     //                    handle: 'span'
                //     //                });
                // });
                //            $('.panel-title').click(function(e) {
                //                $(this).css({
                //                    'max-height': ''
                //                });
                //            });
            });
        </script>