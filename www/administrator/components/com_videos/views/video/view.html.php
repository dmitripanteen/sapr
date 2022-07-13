<?php defined('_JEXEC') or die;


class VideosViewVideo extends JViewLegacy {

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
        JToolBarHelper::title($isNew ? JText::_('COM_VIDEOS_VIDEO_MANAGER_NEW') : JText::_('COM_VIDEOS_VIDEO_MANAGER_EDIT'), 'video');
        JToolBarHelper::apply('video.apply', 'JTOOLBAR_APPLY');
        JToolBarHelper::save('video.save');
        JToolBarHelper::cancel('video.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
        return $this;
    }

}