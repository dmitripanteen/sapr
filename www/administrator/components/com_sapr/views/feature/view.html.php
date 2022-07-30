<?php defined('_JEXEC') or die;


class SaprViewFeature extends JViewLegacy {

    protected $item;
    protected $isNew;
    protected $form;

    public function display($tpl = null) {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->isNew = ($this->item->id == 0);

        if (count($errors = $this->get('Errors'))) {
            JFactory::getApplication()->enqueueMessage(implode('<br />', $errors), 'error');
        }

        $this->addToolBar();
        parent::display($tpl);
        return true;
    }

    protected function addToolBar() {
        $isNew = ($this->item->id == 0);
        JToolBarHelper::title($isNew ? JText::_('COM_SAPR_FEATURES_MANAGER_NEW') : JText::_('COM_SAPR_FEATURES_MANAGER_EDIT'), '');
        JToolBarHelper::apply('feature.apply', 'JTOOLBAR_APPLY');
        JToolBarHelper::save('feature.save');
        JToolBarHelper::cancel('feature.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
        return $this;
    }

}