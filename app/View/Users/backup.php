
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php if($is_logged_in): ?>
                    <div class="navbar-btn navbar-left">
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">
                            <span class="glyphicon glyphicon-list"></span>
                        </a>
                    </div>
                <?php endif; ?>
                <?php
                    $appDescription = __d('cake_dev', 'Maya Notes Web App');
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
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
                <?php else: ?>
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
                                        'action' => 'dashboard',
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