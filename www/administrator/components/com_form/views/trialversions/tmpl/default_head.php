<?php defined('_JEXEC') or die;
$listDirn = $this->escape($this->state->get('list.direction'));
$listOrder = $this->escape($this->state->get('list.ordering'));

?>
<tr>
	<th width="20" class="nowrap center">
        <?=JHtml::_('grid.sort', 'COM_FORM_HEADING_ID', 'id', $this->sortDirection, $this->sortColumn);?>
	</th>
	<th width="20" class="nowrap center">
        <?=JHtml::_('grid.checkall');?>
	</th>
    <th class="nowrap center">
        <?=JHtml::_('grid.sort', 'COM_FORM_HEADING_REQUEST_DATE',
                    'request_date', $this->sortDirection, $this->sortColumn);?>
    </th>
    <th class="nowrap">
        <?=JText::_('COM_FORM_HEADING_COMPANY_NAME');?>
    </th>
    <th class="nowrap">
        <?=JText::_('COM_FORM_HEADING_ADDRESS');?>
    </th>
    <th class="nowrap">
        <?=JText::_('COM_FORM_HEADING_INN');?>
    </th>
    <th class="nowrap">
        <?=JText::_('COM_FORM_HEADING_CONTACT_PERSON');?>
    </th>
    <th class="nowrap">
        <?=JText::_('COM_FORM_HEADING_PHONE');?>
    </th>
    <th class="nowrap">
        <?=JText::_('COM_FORM_HEADING_EMAIL');?>
    </th>
</tr>