<?php defined('_JEXEC') or die;
$listDirn = $this->escape($this->state->get('list.direction'));
$listOrder = $this->escape($this->state->get('list.ordering'));
$saveOrder = $listOrder == 'ordering';

?>
<tr>
	<th width="20" class="nowrap center">
        <?=JHtml::_('grid.sort', 'COM_SAPR_HEADING_ID', 'id', $this->sortDirection, $this->sortColumn);?>
	</th>
	<th width="20" class="nowrap center">
        <?=JHtml::_('grid.checkall');?>
	</th>
    <th class="nowrap center">
        <?=JHtml::_('grid.sort', 'JPUBLISHED', 'published', $this->sortDirection, $this->sortColumn);?>
    </th>
    <th class="nowrap center">
        <?=JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'title', $this->sortDirection, $this->sortColumn);?>
    </th>
    <th class="nowrap center">
        <?php echo JText::_('JGLOBAL_DESCRIPTION');?>
    </th>
    <th width="140px" class="nowrap center">
        <?=JHtml::_('grid.sort', 'JGRID_HEADING_ORDERING', 'ordering', $listDirn, $listOrder);?>
        <?php if ($listOrder == 'ordering'): ?>
            <?=JHtml::_('grid.order', $this->items, 'filesave.png', 'features.saveorder');?>
        <?php endif; ?>
    </th>
</tr>