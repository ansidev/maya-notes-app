<?php $appDescription= "Maya Notes App"; ?>
<?php $this->start('navbar'); ?>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php
                    echo $this->Html->link(
                        $appDescription,
                        array(
                            'controller' => '/',
                            'action' => '',
                            'full_base' => true
                        ),
                        array(
                            'class' => 'navbar-brand'
                        )
                    );
                ?>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar">
            <?php if(!$is_logged_in): ?>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            <?php else: ?>
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
            <?php endif; ?>
                <ul class="nav navbar-nav navbar-right">
                <?php if(!$is_logged_in): ?>
                    <li>
                        <div class="navbar-btn">
                            <?php
                                $span_login = $this->Html->tag(
                                    'span',
                                    '',
                                    array(
                                        'class' => 'glyphicon glyphicon-log-in'
                                    )
                                );
                                echo $this->Html->link(
                                    $span_login . ' Login',
                                    array(
                                        'controller' => 'users',
                                        'action' => 'login',
                                        'full_base' => true
                                    ),
                                    array(
                                        'class' => 'btn btn-primary',
                                        'type' => 'button',
                                        'escape' => false
                                    )
                                );
                            ?>
                            <?php
                                $span_register = $this->Html->tag(
                                    'span',
                                    '',
                                    array(
                                        'class' => 'glyphicon glyphicon-user'
                                    )
                                );
                                echo $this->Html->link(
                                    $span_register . ' Register',
                                    array(
                                        'controller' => 'users',
                                        'action' => 'register',
                                        'full_base' => true
                                    ),
                                    array(
                                        'class' => 'btn btn-primary',
                                        'type' => 'button',
                                        'escape' => false
                                    )
                                );
                            ?>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if($is_logged_in): ?>
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
                                        'controller' => 'user',
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
                <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php $this->end(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1>Maya Notes Web App</h1>
            <p class="lead">Coming soon!</p>
            <ul class="list-unstyled">
                <li>Bootstrap v3.3.0</li>
                <li>jQuery v1.11.1</li>
            </ul>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->