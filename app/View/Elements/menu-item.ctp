<li>
<?php
    echo $this->Html->link(
        $title,
        array(
            'controller' => $controller,
            'action' => $action,
            'full_base' => true
        ),
        array(
            'escape' => false
        )
    );
?>
</li>