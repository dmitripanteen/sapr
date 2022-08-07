<?php

defined('_JEXEC') or die;

$listDirn = $this->escape($this->state->get('list.direction'));
$listOrder = $this->escape($this->state->get('list.ordering'));

foreach ($this->items as $i => $item): ?>
    <tr class="row<?= $i % 2; ?>">
        <td class="center">
            <?= $item->id; ?>
        </td>
        <td class="center">
            <?= JHtml::_('grid.id', $i, $item->id); ?>
        </td>
        <td class="center">
            <?= $item->request_date; ?>
        </td>
        <td>
            <?= $item->company_name; ?>
        </td>
        <td>
            <?= $item->phone; ?>
        </td>
        <td>
            <?= $item->email; ?>
        </td>
        <td>
            <?= $item->message; ?>
        </td>
        <td>
            <?php
            for ($i=1; $i<=4; $i++) {
                if (isset($item->{'file'.$i}) && $item->{'file'.$i}) {
                    echo '<a href="' . $item->{'file'.$i}
                        . '" target="_blank">'
                        . basename(JPATH_SITE . $item->{'file'.$i})
                        . '</a><br>';
                }
            }?>
        </td>
    </tr>
<?php endforeach; ?>