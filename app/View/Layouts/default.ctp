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
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $appDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//Import CSS
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-flat');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<section>
		<div class="container-fluid">
			<h1>
				<?php echo $this->Html->link($appDescription, 'https://github.com/ansidev/maya-notes-app'); ?>
			</h1>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<footer>
				<div class="pull-left">
					<?php echo $this->Html->link(
							$this->Html->image('cake.power.gif', array('alt' => $appDescription, 'border' => '0')),
							'http://www.cakephp.org/',
							array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
						);
					?>
				</div>
				<div class="pull-right">
					<?php echo $cakeVersion; ?>
				</div>
			</footer>
		</div>
	</section>
	<section>
		<div class="container-fluid">
			<?php echo $this->element('sql_dump'); ?>
		</div>
	</section>
</body>
</html>
