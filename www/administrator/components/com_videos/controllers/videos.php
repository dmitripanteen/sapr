<?php defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class VideosControllerVideos extends JControllerAdmin
{

    public function getModel(
        $name = 'Videos',
        $prefix = 'VideosModel',
        $config = array()
    ) {
        return parent::getModel(
            $name,
            $prefix,
            array('ignore_request' => true)
        );
    }

}