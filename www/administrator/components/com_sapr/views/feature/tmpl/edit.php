<?php defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
JHtml::_('behavior.tabstate');
JHtml::_('formbehavior.chosen', 'select');
?>

<form
        action="<?=JRoute::_('index.php?option=com_sapr&view=feature&layout=edit&id='.(int)$this->item->id);?>"
        method="post"
        name="adminForm"
        id="adminForm"
        enctype="multipart/form-data"
>
    <?=JLayoutHelper::render('joomla.edit.title_alias', $this);?>

    <div class="form-horizontal">

        <?=JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details'));?>

        <?=JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('JDETAILS'));?>
        <?=$this->form->renderFieldset('details');?>
        <?=JHtml::_('bootstrap.endTab');?>

        <?=JHtml::_('bootstrap.endTabSet');?>
    </div>

    <input type="hidden" name="task" value="feature.edit" />
    <?=JHtml::_('form.token'); ?>

</form>