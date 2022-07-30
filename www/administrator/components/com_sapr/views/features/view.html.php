<?php defined('_JEXEC') or die;


class SaprViewFeatures extends JViewLegacy {

    protected $items;
    protected $pagination;
    public $state;
    public $sortDirection;
    public $sortColumn;

    public function display($tpl = null) {
        $this->items = $this->getModel()->getItems();
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->sortDirection = $this->state->get('list.direction');
        $this->sortColumn = $this->state->get('list.ordering');

        if (count($errors = $this->get('Errors'))) {
            JFactory::getApplication()->enqueueMessage(implode('<br />', $errors), 'error');
        }

        $this->addToolBar();
        parent::display($tpl);
        return true;
    }

    protected function addToolBar() {
        JToolBarHelper::title(JText::_('COM_SAPR_FEATURES_LIST'));
        JToolBarHelper::addNew('feature.add');
        JToolBarHelper::editList('feature.edit');
        JToolBarHelper::divider();
        JToolBarHelper::publishList('features.publish');
        JToolBarHelper::unpublishList('features.unpublish');
        JToolBarHelper::divider();
        JToolBarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'features.delete');
        JToolBarHelper::divider();
        JToolBarHelper::preferences('com_sapr');
        return $this;
    }

}