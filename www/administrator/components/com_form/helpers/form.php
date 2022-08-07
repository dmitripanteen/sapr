<?php defined('_JEXEC') or die;


abstract class FormHelper
{
    public static function addSubmenu($submenu){
        JHtmlSidebar::addEntry(
            JText::_('COM_FORM_MENU_TRIALVERSIONS'),
            'index.php?option=com_form&view=trialversions',
            $submenu === 'trial'
        );
        JHtmlSidebar::addEntry(
            JText::_('COM_FORM_MENU_SUPPORT'),
            'index.php?option=com_form&view=support',
            $submenu === 'support'
        );
    }
}
