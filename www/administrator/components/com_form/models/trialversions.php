<?php defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class FormModelTrialVersions extends JModelList
{

    public function __construct($config = array())
    {
        $config['filter_fields'] = array(
            'id',
            'request_date'
        );
        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__form_trial_version');
        $query->order(
            $db->escape($this->getState('list.ordering', 'request_date'))
            . ' ' . $db->escape($this->getState('list.direction', 'DESC'))
        );
        return $query;
    }

    public function delete()
    {
        $data = JRequest::get('post');
        $ids = implode(", ", $data['cid']);
        $db = JFactory::getDbo();
        $q = $db->getQuery(true)
            ->delete("#__form_trial_version")
            ->where("id IN (" . $ids . ")");
        $db->setQuery($q)->execute();
        return true;
    }

    protected function populateState($ordering = null, $direction = null)
    {
        parent::populateState('request_date', 'DESC');
    }

}