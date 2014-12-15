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
        echo $this->Html->script('dropbox'); //Import web app JS

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
                                        'action' => 'index',
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
                                        'id' => 'item-log-out',
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
                        <button id="addButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-plus"></span> New note
                        </button>
                        <button id="syncButton" type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-cloud-download"></span> Sync now
                        </button>
                    </li>
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="login-popup-label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" tabindex="1">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <h2 class="text-uppercase">Add new note</h2>
                                </div>
                                <div class="modal-body">
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label for="note-title">Note title</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                <input type="text" class="form-control" id="note-title" name="note-title" placeholder="Enter note title" tabindex="2">
                                                <span id="note-title-tooltip" style="display: none;">Please enter a title</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="note-body">Note body</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                                                <textarea class="form-control" rows="7" id="note-body" name="note-body" placeholder="Enter your note body" tabindex="3"></textarea> 
                                                <span id="note-body" style="display: none;">Please enter a body</span>
                                            </div>
                                        </div>
                                        <button type="submit" name="saveButton" id="saveButton" class="btn btn-primary" tabindex="5">
                                            <span class="glyphicon glyphicon-floppy-disk"></span> Save note
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <!-- End modal -->
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
            	<div id="main" class="col-md-12 animate">
                    <div class="row" id="main-content">
                        <?php echo $this->fetch('main'); ?>
                    </div>
                    <div class="row" id="content">
                        <?php echo $this->fetch('content'); ?>
                    </div>
                    <div class="row"><?php echo $this->element('sql_dump'); ?></div>
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
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->fetch('inline_script'); ?>
</body>
</html>
<?php
    //Load resources
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
?>
<script>
    $('#item-log-out').click(function(e) {
        client.signOut();
    })
</script>