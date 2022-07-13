<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.view');


class VideosViewVideos extends JViewLegacy {

    protected $params;
    public $pageHeading;
    public $textBeforeVideos;
    public $items;

    public function display($tpl = null) {

        $this->params = JFactory::getApplication()->getParams();
        $this->pageHeading = $this->params->get('page_heading')
            ?? JFactory::getApplication()->getMenu()->getActive()->title;
        $this->textBeforeVideos = $this->params->get('text_before_videos');
        $this->items = $this->get('Items');

        if ($this->get('Errors')){
            throw new Exception(implode('<br>', $this->get('Errors')), 500);
        }

        parent::display($tpl);
        return true;
    }

}