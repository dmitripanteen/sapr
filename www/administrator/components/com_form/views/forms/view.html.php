<?php defined('_JEXEC') or die;

class FormViewForms extends JViewLegacy
{

    public function display($tpl = null)
    {
        $this->addToolBar();
        parent::display($tpl);
        return true;
    }

    protected function addToolBar()
    {
        JToolBarHelper::title(JText::_('COM_FORM_LIST_OF_FORMS'));
        JToolBarHelper::preferences('com_form');
        return $this;
    }

}