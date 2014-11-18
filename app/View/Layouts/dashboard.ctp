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
				'content' => 'width=device-width, initial-scale=1.0'
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
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-flat');
        echo $this->Html->css(
        	'app',
        	array(
        		'media' => 'all'
    		)
    	);
        echo $this->Html->script('jquery-1.11.1');
        echo $this->Html->script('bootstrap');

        //Load resources
		echo $this->fetch('meta');
		echo $this->fetch('css');
        echo $this->fetch('script');
	?>
    <style>
    .footer {
        bottom: -100px;
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
	<?php echo $this->Session->flash(); ?>
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
</body>
</html>
