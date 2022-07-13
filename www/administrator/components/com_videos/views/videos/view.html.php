<?php defined('_JEXEC') or die;


class VideosViewVideos extends JViewLegacy {

    protected $items;
    protected $pagination;
    public $state;
    public $sortDirection;
    public $sortColumn;
    
    public function display($tpl = null) {
        $this->items = $this->getModel()->getData();
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
        JToolBarHelper::title(JText::_('COM_VIDEOS_VIDEOS_MANAGER'));
        JToolBarHelper::addNew('video.add');
        JToolBarHelper::editList('video.edit');
        JToolBarHelper::divider();
        JToolBarHelper::publishList('videos.publish');
        JToolBarHelper::unpublishList('videos.unpublish');
        JToolBarHelper::divider();
        JToolBarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'videos.delete');
        JToolBarHelper::divider();
        JToolBarHelper::preferences('com_videos');
        return $this;
    }

}