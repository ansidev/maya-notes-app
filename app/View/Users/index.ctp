<?php
    $appDescription = __d('cake_dev', 'Maya Notes Web App');
?>
<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="nav">
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
                <a href="#menu-toggle" id="menu-toggle" class="navbar-btn btn btn-primary">
                    <span class="glyphicon glyphicon-list"></span>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <form class="navbar-form navbar-left" role="search" id="desktop-search-bar">
                            <div class="form-group">
                                <input type="text" class="form-control input-large search-query" placeholder="Search your notes here">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            $user <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Profiles</a>
                            </li>
                            <li><a href="#">Log out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <div class="collapse navbar-collapse" id="toolbar">
                <ul class="nav navbar-nav">
                    <li>
                        <form class="navbar-form navbar-left" role="search" id="mobile-search-bar">
                            <div class="form-group">
                                <input type="text" class="form-control input-large search-query" placeholder="Search your notes here">
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
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="col-md-2 col-sm-3">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        <?=$appDescription; ?>
                    </a>
                </li>
                <li class="stripe">
                    <a href="#">
                        All Notebooks
                        <span class="badge total">10</span>
                    </a>
                </li>
                <li>
                    <a href="#">Notes</a>
                </li>
                <li>
                    <a href="#">Reminder</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">To do list</a>
                </li>
                <li>
                    <a href="#">Trash</a>
                </li>
                <li>
                    <a href="#">Shared</a>
                </li>
            </ul>
        </div><!-- /#sidebar -->
        <div id="main" class="col-xs-12 col-md-10">
        <!-- Appbar -->
        <div id="appbar" class="col-xs-12 col-md-8">
            <ul class="text-uppercase nav navbar-nav navbar-right">
                <!--
                <li class="active"><a href="#">$home</a>
                </li>
-->
            </ul>
        </div>
        <!-- /#appbar -->
        <!-- Toolbar -->
        <div id="toolbar" class="col-xs-12 col-md-8">
            <div class="navbar-btn pull-left">
            </div>
        </div>
        <!-- /#toolbar -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div id="all" class="page-header">
                    <h1>All Notebooks [$NOTEBOOK_TITLE]</h1>
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="panel panel-default">
                                <div class="panel-heading ">
                                    <div class="panel-title pull-left" contenteditable="true">
                                        Item 1
                                    </div>
                                    <div class="panel-button btn-group pull-right ">
                                        <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#sign-up-popup">
                                            <span class="glyphicon glyphicon-edit "></span>
                                        </button>
                                        <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#sign-in-popup ">
                                            <span class="glyphicon glyphicon-remove "></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="panel-body" contenteditable="true">
                                    Quo dolor ingeniis. Duis an o eram proident a illum proident sed amet nulla o qui ex fidelissimae an an minim nescius. Litteris iis multos ab irure offendit proident. Sed excepteur est eiusmod, lorem quamquam de expetendis se o nisi fabulas ullamco aut vidisse legam litteris. Si tamen arbitror ita dolor expetendis litteris, fabulas summis fugiat an dolor, ad arbitror exercitation ea ex magna instituendarum ne elit distinguantur fabulas veniam fabulas, ut dolor cernantur, nisi et vidisse. Dolore si quibusdam hic quis. Culpa arbitror iis amet tamen est ea quis litteris de esse hic ullamco, elit nam consequat.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="panel panel-default ">
                                <div class="panel-heading ">
                                    <div class="panel-title pull-left" contenteditable="true">
                                        Item 2
                                    </div>
                                    <div class="panel-button btn-group pull-right ">
                                        <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#sign-up-popup ">
                                            <span class="glyphicon glyphicon-edit "></span>
                                        </button>
                                        <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#sign-in-popup ">
                                            <span class="glyphicon glyphicon-remove "></span>
                                        </button>
                                    </div>
                                    <div class="clearfix "></div>
                                </div>
                                <div class="panel-body" contenteditable="true">
                                    Incididunt aute commodo. Ubi quis distinguantur ab fore eiusmod e nescius. Mandaremus ut culpa iudicem, ab eu nulla fugiat quorum, magna ut incurreret ad mandaremus quid eu consequat sempiternum. Ullamco esse ubi singulis praesentibus, dolore tempor exercitation, occaecat quorum summis incurreret sint, minim eu mandaremus. Legam ullamco se ipsum irure. Amet te nostrud ad duis ut fugiat comprehenderit litteris dolor ullamco. Excepteur illum possumus ullamco, do ita eram probant se vidisse ea malis tempor, duis iis expetendis a sint.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="panel panel-default ">
                                <div class="panel-heading ">
                                    <div class="panel-title pull-left" contenteditable="true">
                                        Item 3
                                    </div>
                                    <div class="btn-group pull-right ">
                                        <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#sign-up-popup ">
                                            <span class="glyphicon glyphicon-edit "></span>
                                        </button>
                                        <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#sign-in-popup ">
                                            <span class="glyphicon glyphicon-remove "></span>
                                        </button>
                                    </div>
                                    <div class="clearfix "></div>
                                </div>
                                <div class="panel-body" contenteditable="true">
                                    Iis ipsum litteris eiusmod aut non e esse quamquam si admodum ut velit o iis enim efflorescere, nostrud ea quibusdam hic nam minim tempor cernantur, ne multos concursionibus ita ad commodo non ingeniis. Ad vidisse ab fabulas. Aliquip quis est singulis consectetur. Ad quem sint enim laborum, aute ab probant. Dolore arbitror exercitation. Duis hic ea lorem offendit. Lorem eu quo dolore vidisse non quid laborum o lorem multos. Varias probant iis quae quorum. Ea velit varias in senserit. Ne cillum ex minim, multos possumus quo consequat ex consequat sint appellat proident, ut irure offendit. Est singulis in excepteur ita se quem possumus eruditionem do illum pariatur qui legam nisi qui proident labore ipsum consequat aute. Anim ea non eram occaecat. Ut ea cillum quem tamen e ad elit ubi aute, pariatur nisi ea cupidatat domesticarum est sed de quid quibusdam. Multos quibusdam est philosophari e aut labore nostrud, occaecat multos senserit expetendis quo a irure ne illum a dolor tempor hic distinguantur, varias incurreret voluptatibus se doctrina elit quo aliquip sempiternum et ingeniis malis quem arbitror velit. E offendit coniunctione ab quis est officia.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="panel panel-default ">
                                <div class="panel-heading ">
                                    <div class="panel-title pull-left" contenteditable="true">
                                        Item 4
                                    </div>
                                    <div class="btn-group pull-right ">
                                        <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#sign-up-popup ">
                                            <span class="glyphicon glyphicon-edit "></span>
                                        </button>
                                        <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#sign-in-popup ">
                                            <span class="glyphicon glyphicon-remove "></span>
                                        </button>
                                    </div>
                                    <div class="clearfix "></div>
                                </div>
                                <div class="panel-body" contenteditable="true">
                                    Ea an eram commodo. Ea sunt fabulas eruditionem, varias te eiusmod aut incurreret dolor quem cernantur anim quo ubi probant est nostrud. Arbitror esse illum fabulas elit, malis tempor aut quibusdam, illum nostrud quo quis magna, qui velit concursionibus, a laboris ab cupidatat ab eram fidelissimae cernantur sunt appellat ubi nescius nisi laboris doctrina, ex noster iudicem transferrem. Commodo lorem incurreret si cernantur arbitrantur et cupidatat. Ubi quid malis dolore ullamco. Si laborum e nostrud non ne quid consequat expetendis ex quae ubi appellat eu aliqua litteris consectetur, cernantur tamen ab voluptate coniunctione, qui se multos offendit ne tempor tamen minim nam illum ea et hic firmissimum. Est legam nescius, legam comprehenderit admodum eram appellat se o quis fabulas ne fabulas sed nulla cernantur.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="panel panel-default ">
                                <div class="panel-heading ">
                                    <div class="panel-title pull-left" contenteditable="true">
                                        Item 5
                                    </div>
                                    <div class="btn-group pull-right ">
                                        <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#sign-up-popup ">
                                            <span class="glyphicon glyphicon-edit "></span>
                                        </button>
                                        <button type="button " class="btn btn-primary " data-toggle="modal " data-target="#sign-in-popup ">
                                            <span class="glyphicon glyphicon-remove "></span>
                                        </button>
                                    </div>
                                    <div class="clearfix "></div>
                                </div>
                                <div class="panel-body" contenteditable="true">
                                    Amet iudicem ut distinguantur. Irure ullamco litteris ex de ubi praetermissum, sunt laboris philosophari iis iis multos mentitum occaecat. Varias excepteur nam praetermissum de illum commodo arbitrantur ea an te cohaerescant, id minim possumus vidisse. Deserunt nisi doctrina probant. O amet appellat nam ullamco nam quis, e in sunt incididunt non fugiat hic sed dolore mentitum. Ad dolor officia in aut multos instituendarum, occaecat ad varias, multos possumus non laboris. Fabulas sed lorem singulis iis lorem iis possumus an admodum aut eram nostrud quo quis eu te enim offendit an veniam ut sed quae proident, ad qui familiaritatem, quis doctrina cupidatat quo est aut fore nulla nisi.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tasks " class="page-header ">
                    <h1>Tasks</h1>
                    <div class="row ">
                        <div class="col-md-4 ">
                            <div class="panel panel-default ">
                                <div class="panel-heading ">
                                    <h3 class="panel-title ">Hello world</h3>
                                </div>
                                <div class="panel-body ">
                                    Item 6
                                </div>
                            </div>
                            <div class="panel panel-default ">
                                <div class="panel-heading ">
                                    <h3 class="panel-title ">Hello world</h3>
                                </div>
                                <div class="panel-body ">
                                    Hello world!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="panel panel-default ">
                                <div class="panel-heading ">
                                    <h3 class="panel-title ">Hello world</h3>
                                </div>
                                <div class="panel-body ">
                                    Hello world!
                                </div>
                            </div>
                            <div class="panel panel-default ">
                                <div class="panel-heading ">
                                    <h3 class="panel-title ">Hello world</h3>
                                </div>
                                <div class="panel-body ">
                                    Hello world!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="panel panel-default ">
                                <div class="panel-heading ">
                                    <h3 class="panel-title ">Hello world</h3>
                                </div>
                                <div class="panel-body ">
                                    Hello world!
                                </div>
                            </div>
                            <div class="panel panel-default ">
                                <div class="panel-heading ">
                                    <h3 class="panel-title ">Hello world</h3>
                                </div>
                                <div class="panel-body ">
                                    Hello world!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /#page-content-wrapper -->
    </div><!-- /#app -->
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
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#menu-toggle").toggleClass("toggled");
                    $("#main").toggleClass("toggled");
                    $("#sidebar").toggleClass("toggled");
                    $("#appbar").toggleClass("toggled");
                    $("#toolbar").toggleClass("toggled");
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