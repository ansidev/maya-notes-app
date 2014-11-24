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
        echo $this->Html->css('cake'); //Import bootstrap style for CakePHP default CSS
        echo $this->Html->css('app'); //Import web app CSS
        echo $this->Html->script('jquery-1.11.1');
        echo $this->Html->script('bootstrap');

        //Load resources
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
	?>
    <!-- Custom CSS -->
    <style>
    @media (min-width: 768px) {
        .footer {
        margin: 0 15px;
        }
    }
    body {
        padding-top: 70px;
        padding-left: 0;
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
            	<?php endif; ?>
				</ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
	<div class="footer">
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
</body>
</html>
