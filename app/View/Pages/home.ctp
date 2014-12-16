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
                <ul class="nav navbar-nav navbar-right">
                <?php if(!$is_logged_in): ?>
                    <li>
                        <div class="navbar-btn">
                            <?php
                                $icon = $this->Html->tag(
                                    'span',
                                    '',
                                    array(
                                        'class' => 'glyphicon glyphicon-log-in'
                                    )
                                );
                                echo $this->Html->link(
                                    $icon . ' Login via Dropbox',
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
                                $display_name . ' ' . $span_user,
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
            <img src="img/note.png">
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->