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
                        <form class="navbar-form" role="search" action="#" method="GET" id="desktop-search-bar">
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
                                        'controller' => 'users',
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
                                <li><a href="#">Notebook</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Note</a>
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

<div class="container-fluid">
    <div id="app" class="row">
        <div id="sidebar-wrapper" class="col-md-2 col-sm-12" role="tabpanel">
            <ul id="myTab" class="nav nav-tabs nav-stacked nav-pills sidebar-nav" role="tablist">
                <li role="presentation" class="active"><a href="#all" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">All Notebook</a>
                </li>
                <?php
                //Print Default Notebook
                foreach ($default_books as $books => $book) {
                    if($book['Notebook']['id'] >= 3 && $book['Notebook']['id'] <=  7) {
                        // $total = 0;
                        // $i = 0;
                        // foreach ($curr_user['Note'] as $key => $note) {
                        //     $i++;
                        //     pr($i);
                        //     pr($note['notebook_id']);
                        //     if($note['notebook_id'] === $book['Notebook']['id']) {
                        //         $total++;
                        //         pr('true');
                        //         pr($total);
                        //     }
                        // }
                        $span_total = $this->Html->tag(
                            'span',
                            '',
                            array(
                                'class' => 'badge inline'
                            )
                        );
                        echo $this->Html->tag(
                            'li',
                            $this->Html->link(
                                $book['Notebook']['book_name'] . ' ' . $span_total,
                                '#' . 'notebook-' . $book['Notebook']['id'],
                                array(
                                    'id' => '[Notebook]['. $book['Notebook']['id'] . ']-tab',
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
                }
                //Print User-defined Notebook
                foreach($curr_user['Notebook'] as $books => $book) {
                    // pr($book);
                    if($book['id'] > 7) {
                        echo $this->Html->tag(
                            'li',
                            $this->Html->link(
                                $book['book_name'],
                                '#',
                                array(
                                    'id' => '[Notebook]['. $book['id'] . ']',
                                    'data-toggle' => 'tab',
                                    'aria-controls' => 'notebook-' . $book['id'],
                                    'aria-expanded' => 'true',
                                    'escape' => false
                                )
                            ),
                            array(
                                'role' => 'presentation'
                            )
                        );
                    }
                }
                //Print special notebook
                foreach ($default_books as $books => $book) {
                    // pr($book['Notebook']['book_name']);
                        if($book['Notebook']['id'] < 3) {
                        echo $this->Html->tag(
                            'li',
                            $this->Html->link(
                                $book['Notebook']['book_name'],
                                '#' . $book['Notebook']['id'],
                                array(
                                    'id' => '[Notebook]['. $book['Notebook']['id'] . ']',
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
                }
                ?>
<!--                 <li role="presentation">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                        <li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">@fat</a>
                        </li>
                        <li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">@mdo</a>
                        </li>
                    </ul>
                </li>
 -->            </ul>
        </div>
        <div id="main" class="col-md-10 col-sm-12 tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="all" aria-labelledBy="home-tab">
                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledBy="profile-tab">
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledBy="dropdown1-tab">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledBy="dropdown2-tab">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
            </div>
        </div>
    </div>
    <!-- app -->
</div><!-- /.container -->

        <script type="text/javascript">
            $(document).ready(function() {
                //Switch between ListView and GridView
                var elem = $('.row > div');
                $('#view-control > button').on('click', function(e) {
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
                    $("#main").toggleClass("toggled");
                    $(".footer").toggleClass("toggled");
                    $("#sidebar-wrapper").toggleClass("toggled");
                    $("#nav").toggleClass("toggled");
                    // $("#toolbar").toggleClass("toggled");
                });
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#menu-toggle").fadeOut(500).css("display", "none");
                    $("#desktop-search-bar").css("padding-left", "0");
                    $("#main").toggleClass("toggled");
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