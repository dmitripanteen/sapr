<?php defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SaprModelFeature extends JModelAdmin
{

    public function getTable(
        $type = 'Feature',
        $prefix = 'SaprTable',
        $config = array()
    ) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form =
            $this->loadForm(
                'com_sapr.feature',
                'feature',
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
                'com_sapr.edit.feature.data',
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
                ->from('#__sapr');

            $db->setQuery($query);
            $max = $db->loadResult();
            $table->ordering = $max + 1;
        }
    }

}