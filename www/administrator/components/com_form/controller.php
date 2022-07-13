<?php defined('_JEXEC') or die;

jimport('joomla.application.component.controller');


class FormController extends JControllerLegacy
{
    public function display($cachable = false, $urlparams = false){
        $input = JFactory::getApplication()->input;
        $input->set('view', $input->getCmd('view', 'TrialVersions'));
        return parent::display($cachable);
    }

}
