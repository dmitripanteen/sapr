<?php defined('_JEXEC') or die;

class SaprControllerFeatures extends JControllerAdmin
{

    public function getModel(
        $name = 'Features',
        $prefix = 'SaprModel',
        $config = array()
    ) {
        $model =
            parent::getModel($name, $prefix, array('ignore_request' => true));
        return $model;
    }

}