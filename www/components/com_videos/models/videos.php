<?php defined('_JEXEC') or die;


class VideosModelVideos extends JModelList
{
    protected function getListQuery(){
        $query = $this->_db->getQuery(true)
            ->select("*")
            ->from("#__videos")
            ->where("published = 1")
            ->order("ordering ASC");
        return $query;
    }


    protected function populateState($ordering = null, $direction = null){
        /** @var JApplicationSite $app */
        $app = JFactory::getApplication();

        parent::populateState($ordering, $direction);

        $this->setState('list.limit', $app->getParams()->get('list_limit', 0));
        $this->setState('list.start', $app->input->get('start', 0));
    }
}