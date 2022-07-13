<?php defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
JHtml::_('behavior.tabstate');
JHtml::_('formbehavior.chosen', 'select');
?>

<form action="<?=JRoute::_('index.php?option=com_videos&view=video&layout=edit&id='.(int)$this->item->id);?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
    <div class="form-horizontal">

        <?=JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details'));?>

        <?=JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('JDETAILS'));?>
        <?=$this->form->renderFieldset('details');?>
        <div>
            <fieldset class="adminform">
                <legend><?=JText::_('COM_VIDEOS_VIDEO_PREVIEW'); ?></legend>
                <div style="width:480px;">
                    <?=$this->item->link;?>
                </div>
            </fieldset>
        </div>
        <?=JHtml::_('bootstrap.endTab');?>

        <?=JHtml::_('bootstrap.endTabSet');?>
    </div>

    <input type="hidden" name="task" value="video.edit" />
    <?=JHtml::_('form.token'); ?>

</form>