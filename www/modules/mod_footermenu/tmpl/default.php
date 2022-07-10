<?php
$itemsCount = count($list);
$itemsPerColumn = ceil($itemsCount) / 2;
?>
<div class="col">
    <?php foreach ($list as $i => &$item) {
        if ($i == $itemsPerColumn + 1) {
            echo '</div><div class="col">';
        }
        echo '<p>';
        switch ($item->type) :
            case 'separator':
                $item->type = 'separator';
                require JModuleHelper::getLayoutPath(
                    'mod_menu',
                    'default_' . $item->type
                );
                break;
            case 'component':
            case 'heading':
            case 'url':
                $item->type = 'component';
                require JModuleHelper::getLayoutPath(
                    'mod_menu',
                    'default_' . $item->type
                );
                break;

            default:
                require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
                break;
        endswitch;
        echo '</p>';
    } ?>
</div>