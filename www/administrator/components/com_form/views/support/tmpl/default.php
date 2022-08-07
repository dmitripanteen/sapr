<?php

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('formbehavior.chosen', 'select', null, array('disable_search_threshold' => 10));
?>
<form action="<?php echo JRoute::_('index.php?option=com_form&view=support'); ?>" method="post" name="adminForm" id="adminForm">

    <?php if($this->sidebar):?>
        <div id="j-sidebar-container" class="span2">
            <?=$this->sidebar;?>
        </div>
    <?php endif;?>

    <div id="j-main-container" class="<?=($this->sidebar ? 'span10' : 'span12');?>">
        <table class="table table-striped table-hover">
        <thead><?php echo $this->loadTemplate('head');?></thead>
        <tbody><?php echo $this->loadTemplate('body');?></tbody>
        <tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
        </table>
        <div>
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
            <input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
</form>