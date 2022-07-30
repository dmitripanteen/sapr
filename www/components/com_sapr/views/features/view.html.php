<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.view');


class SaprViewFeatures extends JViewLegacy {

    protected $params;
    public $pageHeading;
    public $items;

    public function display($tpl = null) {

        $app = JFactory::getApplication();

        $this->params = $app->getParams();
        $this->pageHeading = $this->params->get('page_heading')
            ?? JFactory::getApplication()->getMenu()->getActive()->title;
        $this->items = $this->get('Items');
        foreach ($this->items as $item){
            $item->gallery = json_decode($item->gallery);
        }

        if ($this->get('Errors')){
            throw new Exception(implode('<br>', $this->get('Errors')), 500);
        }

        parent::display($tpl);
        return true;
    }

}