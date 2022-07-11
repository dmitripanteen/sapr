<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.view');


class ContactUsViewContactUs extends JViewLegacy {

    protected $params;
    public $customHeader;
    public $contactData;
    public $mapCode;

    public function display($tpl = null) {

        $this->params = JFactory::getApplication()->getParams();
        $this->customHeader = $this->params->get('custom_header');
        $this->contactData = $this->params->get('contact_data');
        $this->mapCode = $this->params->get('map_code');

        if ($this->get('Errors')){
            throw new Exception(implode('<br>', $this->get('Errors')), 500);
        }

        parent::display($tpl);
        return true;
    }

}