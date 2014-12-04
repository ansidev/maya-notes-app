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
//        echo $this->Html->css('app'); //Import web app CSS
        echo $this->Html->css('sidebar'); //Import web app CSS
        echo $this->Html->css('panel'); //Import web app CSS
        echo $this->Html->script('jquery-1.11.1');
        echo $this->Html->script('bootstrap');
        if ($this->params['action'] == 'add' || $this->params['action'] == 'edit') {
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
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div id="container-fluid">
            <div class="row">
                <div id="book_name" class="col-xs-6">
                    <?php echo $this->fetch('book_name'); ?>
                </div>
                <div id="note_title" class="col-xs-6">
                    <?php echo $this->fetch('note_title'); ?>
                </div>
                <div id="note_body" class="col-xs-12">
                    <?php
                        $this->element(
                            'flash_success',
                            array (
                                'message' => $this->Session->flash()
                            )
                        );
                        $this->element(
                            'flash_danger',
                            array (
                                'message' => $this->Session->flash()
                            )
                        );
                    ?>
                    <?php echo $this->fetch('note_body'); ?>
                </div>
            </div>
        </div>
        <?php echo $this->fetch('inline_scripts'); ?>
    </body>
</html>
