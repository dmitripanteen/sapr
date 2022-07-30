<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');


class SaprController extends JControllerLegacy {

    public function display($cachable = false, $urlparams = false){
        $input = JFactory::getApplication()->input;
        $input->set('view', $input->getCmd('view', 'Features'));
        return parent::display($cachable);
    }

}