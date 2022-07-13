<?php defined('_JEXEC') or die;

class FormModelTrialVersion extends JModelForm
{

    protected $data;

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_form.trialversion',
            'trialversion',
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
            (array)$app->getUserState('com_form.trialversion.data', array()
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
            ->insert('#__form_trial_version')
            ->columns(
                $db->quoteName('company_name') . ','
                . $db->quoteName('address') . ','
                . $db->quoteName('inn') . ','
                . $db->quoteName('contact_person') . ','
                . $db->quoteName('phone') . ','
                . $db->quoteName('email') . ','
                . $db->quoteName('request_date')
            )
            ->values(
                $db->quote($formData['company_name']) . ', '
                . $db->quote($formData['address']) . ', '
                . $db->quote($formData['inn']) . ', '
                . $db->quote($formData['contact_person']) . ', '
                . $db->quote($formData['phone']) . ', '
                . $db->quote($formData['email']) . ', '
                . $db->quote(date('Y-m-d H:i:s'))
            );
        if ($db->setQuery($query)->execute()) {
            return true;
        }
        return JText::_('COM_FORM_SAVE_FAILED');
    }

}