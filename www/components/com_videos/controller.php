<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');


class VideosController extends JControllerLegacy {

    public function display($cachable = false, $urlparams = false){
        $input = JFactory::getApplication()->input;
        $input->set('view', $input->getCmd('view', 'com_videos'));
        return parent::display($cachable);
    }

}