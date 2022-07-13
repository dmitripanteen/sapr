<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
jimport('captcha.recaptcha');


class FormViewTrialVersion extends JViewLegacy {

    protected $params;
    /** @var  \Joomla\Registry\Registry */
    protected $userState;
    public $pageHeading;
    public $textBeforeForm;
    public $submitText;

    public function display($tpl = null) {

        $app = JFactory::getApplication();

        $this->params = $app->getParams();
        $this->pageHeading = $this->params->get('page_heading')
            ?? JFactory::getApplication()->getMenu()->getActive()->title;
        $this->textBeforeForm = $this->params->get('text_before_form');
        $this->submitText = $this->params->get('submit_text');

        $this->userState = new Joomla\Registry\Registry($app->getUserState('com_form.trialversion.form.data', []));
        $app->setUserState('com_form.trialversion.form.data', null);

        if ($this->get('Errors')){
            throw new Exception(implode('<br>', $this->get('Errors')), 500);
        }

        Recaptcha::init();

        parent::display($tpl);
        return true;
    }

}