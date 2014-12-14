<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$appDescription = __d('cake_dev', 'Maya Notes Web App');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<?php
		echo $this->Html->charset();
		echo $this->Html->meta(
			array(
				'http-equiv' => 'X-UA-Compatible',
				'content' => 'IE=edge'
			)
		);
		echo $this->Html->meta(
			array(
				'name' => 'viewport',
				'content' => 'width=device-width, initial-scale=1'
			)
		);
		echo $this->Html->meta(
			array(
				'name' => 'description',
				'content' => ''
			)
		);
		echo $this->Html->meta(
			array(
				'name' => 'author',
				'content' => ''
			)
		);
	?>
	<title>
		<?php echo $appDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//Import CSS
		echo $this->Html->css(array('bootstrap', 'bootstrap-flat')); //import Boostrap CSS
        echo $this->Html->css('font-awesome');
        echo $this->Html->css('cake'); //Import bootstrap style for CakePHP default CSS
        echo $this->Html->css('app'); //Import web app CSS
        echo $this->Html->script('jquery-1.11.1');
        echo $this->Html->script('bootstrap');
		echo $this->Html->script('app');

        echo $this->Html->script('dropbox-datastores-1.2-latest');
        echo $this->Html->script('dropbox'); //Import web app CSS

        if($this->params['action'] == 'add' || $this->params['action'] == 'edit') {
            echo $this->Html->css(array('summernote', 'font-awesome'));
            echo $this->Html->script('summernote');
            echo "<script>
            $(document).ready(function() {
                $('.sn-editor').summernote({
                    height: 300,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                });
            });
            </script>";
        }

	?>
    <!-- Custom CSS -->
    <style>
    body {
        /*padding-top: 115px;*/
        /*padding-left: 0;*/
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
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
                <?php
                    echo $this->Html->link(
                        'Maya Notes App',
                        array(
                            'controller' => '/',
                            'action' => '',
                            'full_base' => true
                        ),
                        array(
                            'class' => 'navbar-brand',
                            'style' => 'display: inline-block'
                        )
                    );
                ?>
                <button href="#menu-toggle" id="menu-toggle" class="navbar-header navbar-btn navbar-toggle btn btn-primary pull-right">
                    <span class="glyphicon glyphicon-list"></span>
                </button>
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
            	<div id="sidebar" class="col-md-2 animate">
                	<?php echo $this->fetch('sidebar'); ?>
            	</div>
            	<div id="main" class="col-md-10 animate">
	                <?php echo $this->fetch('main'); ?>
	                <?php echo $this->fetch('content'); ?>
					<div class="footer animate">
						<div class="container-fluid">
							<div class="row">
								<div class="pull-left">
									<?php echo $this->Html->link($appDescription, 'https://github.com/ansidev/maya-notes-app'); ?>
									<?php echo " - Built with $cakeVersion"; ?>
									
								</div>
								<div class="pull-right">
									<?php echo $this->Html->link(
											$this->Html->image('cake.power.gif', array('alt' => $appDescription, 'border' => '0')),
											'http://www.cakephp.org/',
											array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
										); ?>
								</div>
							</div>
							<div class="row">			
								<?php
									// debug($users_display_name);
									echo $this->element('sql_dump');
								?>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    //Load resources
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
?>
