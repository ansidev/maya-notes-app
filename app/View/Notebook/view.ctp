<?php
    if(!empty($request)) {
        if($request == 'get') {
            $id = 'first-sidebar';
        }
        else {
            $id = 'second-sidebar';
        }
    }
    else {
        $id = 'second-sidebar';
    }
?>
<ul id="<?=$id;?>" class="sidebar-nav">
    <?php
    //Generate span html
    $span = $this->Html->tag(
            'span', '', array(
        'class' => 'glyphicon glyphicon-sort'
    ));
    // Generate sort link
    $sort = $this->Paginator->sort('note_modified', $span, array(
        'direction' => 'asc',
        'escape' => false));
//     Print site brand
    echo $this->Html->tag(
           'li', $title, array(
       'class' => 'sidebar-brand'
    ));
    // Print Note list
//    echo $this->Html->tag(
//            'li', $all_link, array(
//        'id' => 'all'
//    ));
    // Print notebook list
    // pr($notes);
    foreach ($notes as $value) {
        $note = $value['Note'];
        $note_link = $this->Html->link(
                $note['note_title'], '#', array(
//            'style' => 'padding-left: 15px;',
            'onclick' => 'view(' . $note['id'] . ')',
            'escape' => false,
        ));
        echo $this->Html->tag(
                'li', $note_link, array(
            'id' => 'note-' . $note['id']
        ));
    }
    ?>
</ul>