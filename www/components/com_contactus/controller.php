<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');


class ContactUsController extends JControllerLegacy {

    public function display($cachable = false, $urlparams = false){
        $input = JFactory::getApplication()->input;
        $input->set('view', $input->getCmd('view', 'ContactUs'));
        return parent::display($cachable);
    }

}