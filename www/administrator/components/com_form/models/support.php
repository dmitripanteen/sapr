<?php defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class FormModelSupport extends JModelList
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
        $query->from('#__form_user_support');
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
            ->delete("#__form_user_support")
            ->where("id IN (" . $ids . ")");
        $db->setQuery($q)->execute();
        return true;
    }

    public function getExportItems()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true)
            ->select(
                'id, request_date, company_name, phone, email, message, file1, file2, file3, file4'
            )
            ->from('#__form_user_support')
            ->order('request_date DESC');
        return $db->setQuery($query)->loadObjectList();
    }

    protected function populateState($ordering = null, $direction = null)
    {
        parent::populateState('request_date', 'DESC');
    }

}