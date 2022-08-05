<?php

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_form&view=forms'); ?>"
      method="post" name="adminForm" id="adminForm">

    <div id="j-main-container" class="span12">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="center" width="30">ID</th>
                <th><?= JText::_('COM_FORM_LIST_TITLE') ?></th>
            </tr>
            </thead>
            <tbody>
            <tr class="row0">
                <td class="center" width="30">1</td>
                <td>
                    <a href="<?= JRoute::_(
                        'index.php?option=com_form&view=trialversions'
                    ); ?>">
                        <?= JText::_('COM_FORM_MENU_TRIALVERSIONS') ?>
                    </a>
                </td>
            </tr>
            <tr class="row1">
                <td class="center">2</td>
                <td>
                    <a href="<?= JRoute::_(
                        'index.php?option=com_form&view=support'
                    ); ?>">
                        <?= JText::_('COM_FORM_MENU_SUPPORT') ?>
                    </a>
                </td>
            </tr>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</form>