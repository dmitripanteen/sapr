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
            <?= $item->address; ?>
        </td>
        <td>
            <?= $item->inn; ?>
        </td>
        <td>
            <?= $item->contact_person; ?>
        </td>
        <td>
            <?= $item->phone; ?>
        </td>
        <td>
            <?= $item->email; ?>
        </td>
    </tr>
<?php endforeach; ?>