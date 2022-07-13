<?php defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class VideosModelVideos extends JModelList
{

    var $_data;

    public function __construct($config = array())
    {
        $config['filter_fields'] = array(
            'id',
            'title',
            'description',
            'published',
            'ordering',
        );
        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__videos');
        $query->order(
            $db->escape($this->getState('list.ordering', 'ordering')) . ' ' .
            $db->escape($this->getState('list.direction', 'ASC'))
        );
        return $query;
    }

    protected function setData()
    {
        $query = $this->getListQuery();
        $this->_data =
            $this->_getList(
                $query,
                $this->getStart(),
                $this->getState('list.limit')
            );
    }

    public function getData()
    {
        if (empty($this->_data)) {
            $this->setData();
        }
        return $this->_data;
    }

    public function delete()
    {
        $data = JRequest::get('post');
        $ids = implode(", ", $data['cid']);
        $db = JFactory::getDbo();
        $q = $db->getQuery(true)
            ->delete("#__videos")
            ->where("id IN (" . $ids . ")");
        $db->setQuery($q)->execute();
        return true;
    }

    protected function populateState($ordering = null, $direction = null)
    {
        parent::populateState('ordering', 'ASC');
    }

    public function publish($cid, $task)
    {
        $ids = implode(", ", $cid);
        $db = JFactory::getDbo();
        $q = $db->getQuery(true);
        $q->update("#__videos");
        if ($task == 0) {
            $q->set("published = 0");
        } elseif ($task == 1) {
            $q->set("published = 1");
        }
        $q->where("id IN (" . $ids . ")");
        $db->setQuery($q)->execute();
        return true;
    }

    public function saveorder($pks, $order)
    {
        foreach ($pks as $i => $pk) {
            $db = JFactory::getDbo();
            $curr_order = $db->setQuery(
                $db->getQuery(true)
                    ->select('ordering')
                    ->from('#__videos')
                    ->where('id=' . $pk)
            )->loadResult();
            if ($curr_order != $order[$i]) {
                $db->setQuery(
                    $db->getQuery(true)
                        ->update('#__videos')
                        ->set('ordering=' . $order[$i])
                        ->where('id=' . $pk)
                )->execute();
            }
        }

        return true;
    }

    public function reorder($pks, $delta)
    {

        foreach ($pks as $i => $pk) {
            $db = JFactory::getDbo();
            $curr_order = $db->setQuery(
                $db->getQuery(true)
                    ->select('ordering')
                    ->from('#__videos')
                    ->where('id=' . $pk)
            )->loadResult();

            $db->setQuery(
                $db->getQuery(true)
                    ->update('#__videos')
                    ->set('ordering=ordering-' . $delta)
                    ->where('ordering=' . ($curr_order + $delta))
            )->execute();

            $db->setQuery(
                $db->getQuery(true)
                    ->update('#__videos')
                    ->set('ordering=ordering+' . $delta)
                    ->where('id=' . $pk)
            )->execute();

        }

        return true;
    }

}