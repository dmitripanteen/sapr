<?php defined('_JEXEC') or die;

class FormViewTrialVersions extends JViewLegacy
{

    protected $items;
    protected $pagination;
    public $state;
    public $sortDirection;
    public $sortColumn;

    public function display($tpl = null)
    {
        $this->items = $this->getModel()->getItems();
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->sortDirection = $this->state->get('list.direction');
        $this->sortColumn = $this->state->get('list.ordering');

        if (count($errors = $this->get('Errors'))) {
            JFactory::getApplication()->enqueueMessage(
                implode('<br />', $errors),
                'error'
            );
        }

        $this->addToolBar();
        parent::display($tpl);
        return true;
    }

    protected function addToolBar()
    {
        JToolBarHelper::title(JText::_('COM_FORM_TRIAL_VERSIONS_LIST'));
        JToolBarHelper::deleteList(
            'JGLOBAL_CONFIRM_DELETE',
            'trialversions.delete'
        );
        JToolBarHelper::custom(
            'trialversions.printExcel',
            'download',
            'download',
            JText::_('COM_FORM_EXPORT_EXCEL_BTN'),
            false
        );
        JToolBarHelper::divider();
        JToolBarHelper::preferences('com_form');
        return $this;
    }

}