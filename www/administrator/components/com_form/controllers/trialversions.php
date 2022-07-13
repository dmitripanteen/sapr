<?php defined('_JEXEC') or die;

class FormControllerTrialVersions extends JControllerAdmin
{

    public function getModel(
        $name = 'TrialVersions',
        $prefix = 'FormModel',
        $config = array()
    ) {
        $model =
            parent::getModel($name, $prefix, array('ignore_request' => true));
        return $model;
    }

}