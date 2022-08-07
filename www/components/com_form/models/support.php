<?php defined('_JEXEC') or die;

class FormModelSupport extends JModelForm
{

    protected $data;

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_form.support',
            'support',
            array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    public function getData()
    {
        if ($this->data === null) {
            $this->setData();
        }
        return $this->data;
    }

    protected function loadFormData()
    {
        return $this->getData();
    }

    protected function setData()
    {
        $this->data = new stdClass();
        $app = JFactory::getApplication();
        $temp =
            (array)$app->getUserState('com_form.support.data', array()
            );
        foreach ($temp as $k => $v) {
            $this->data->$k = $v;
        }
        return $this;
    }

    public function validateForm($formData)
    {
        $form = $this->getForm();
        return parent::validate($form, $formData);
    }

    public function sendRequest($formData)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->insert('#__form_user_support')
            ->columns(
                $db->quoteName('company_name') . ','
                . $db->quoteName('phone') . ','
                . $db->quoteName('email') . ','
                . $db->quoteName('message') . ','
                . $db->quoteName('file1') . ','
                . $db->quoteName('file2') . ','
                . $db->quoteName('file3') . ','
                . $db->quoteName('file4') . ','
                . $db->quoteName('request_date')
            )
            ->values(
                $db->quote($formData['company_name']) . ', '
                . $db->quote($formData['phone']) . ', '
                . $db->quote($formData['email']) . ', '
                . $db->quote($formData['message']) . ', '
                . $db->quote($formData['file1'] ?? '') . ', '
                . $db->quote($formData['file2'] ?? '') . ', '
                . $db->quote($formData['file3'] ?? '') . ', '
                . $db->quote($formData['file4'] ?? '') . ', '
                . $db->quote(date('Y-m-d H:i:s'))
            );
        if ($db->setQuery($query)->execute()) {
            return true;
        }
        return JText::_('COM_FORM_SAVE_FAILED');
    }

}