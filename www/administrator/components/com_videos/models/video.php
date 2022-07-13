<?php defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class VideosModelVideo extends JModelAdmin
{

    public function getTable(
        $type = 'Videos',
        $prefix = 'VideosTable',
        $config = array()
    ) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form =
            $this->loadForm(
                'com_videos.video',
                'video',
                array('control' => 'jform', 'load_data' => $loadData)
            );
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    protected function loadFormData()
    {
        $data =
            JFactory::getApplication()->getUserState(
                'com_videos.edit.video.data',
                array()
            );
        if (empty($data)) {
            $data = $this->getItem();
        }
        return $data;
    }

    protected function prepareTable($table)
    {
        if (empty($table->ordering)) {
            $db = $this->getDbo();
            $query = $db->getQuery(true)
                ->select('MAX(ordering)')
                ->from('#__videos');

            $db->setQuery($query);
            $max = $db->loadResult();
            $table->ordering = $max + 1;
        }
    }

}