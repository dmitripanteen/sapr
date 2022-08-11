<?php defined('_JEXEC') or die;

class FormControllerTrialVersion extends JControllerForm
{
    /**
     * @var FormModelTrialVersion
     */
    private $model;

    public function sendRequest()
    {
        $this->model = $this->getModel();
        $isError = false;
        $formData = $this->input->post->get('jform', array(), 'array');
        $validationResult = $this->model->validateForm($formData);
        if ($validationResult === false) {
            $isError = true;
            echo JText::_('COM_FORM_ERROR_MSG');
            JFactory::getApplication()->close();
        }

        JLoader::import('captcha.recaptcha');

        if (JPluginHelper::isEnabled('captcha', 'recaptcha')) {
            if (!Recaptcha::isValid()) {
                $isError = true;
                echo JText::_('COM_FORM_CAPTCHA_ERR_MESSAGE');
                JFactory::getApplication()->close();
            }
        }

        if (!$isError) {
            $return = $this->model->sendRequest($formData);
            echo($return === true ? 'true' : $return);
            $this->sendEmail($formData);
        }
        JFactory::getApplication()->close();
    }

    public function sendEmail($formData)
    {
        $app = JFactory::getApplication();
        $params = $app->getMenu()->getItem(103)->getParams();
        $mailer = JFactory::getMailer();
        $config = JFactory::getConfig();

        $sender = array($config->get("mailfrom"), $config->get("fromname"));

        $mailer->setSender($sender);
        $recipient = $params->get('email_to_address');
        if (is_null($recipient)) {
            $recipient = $sender[0];
        }
        $mailer->setSender($recipient);
        if (empty($recipient) ||
            !filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $mailer->ClearReplyTos();
        $mailer->addCustomHeader('ReturnPath', $recipient);
        $mailer->addRecipient($recipient);
        $mailer->IsHTML(true);
        $mailer->Encoding = 'base64';

        $body = '<b>' . str_replace(
                '*',
                '',
                JText::_('COM_FORM_FIELD_COMPANY_NAME_LABEL')
            )
            . ':</b> ' . $formData['company_name'] . '<br>';
        $body .= '<b>' . str_replace(
                '*',
                '',
                JText::_('COM_FORM_FIELD_ADDRESS_LABEL')
            )
            . ':</b> ' . $formData['address'] . '<br>';
        $body .= '<b>' . str_replace(
                '*',
                '',
                JText::_('COM_FORM_FIELD_INN_LABEL')
            )
            . ':</b> ' . $formData['inn'] . '<br>';
        $body .= '<b>' . str_replace(
                '*',
                '',
                JText::_('COM_FORM_FIELD_CONTACT_PERSON_LABEL')
            )
            . ':</b> ' . $formData['contact_person'] . '<br>';
        $body .= '<b>' . str_replace(
                '*',
                '',
                JText::_('COM_FORM_FIELD_PHONE_LABEL')
            )
            . ':</b> ' . $formData['phone'] . '<br>';
        $body .= '<b>' . str_replace(
                '*',
                '',
                JText::_('COM_FORM_FIELD_EMAIL_LABEL')
            )
            . ':</b> ' . $formData['email'] . '<br>';
        $body .= '<b>' . str_replace(
                '*',
                '',
                JText::_('COM_FORM_FIELD_REQUEST_DATE_LABEL')
            )
            . ':</b> ' . date('d.m.Y H:i:s') . '<br>';
        $emailBody = '<html>
					<body>' . $body . '</body>    
				</html>';

        $emailBody .= "------" . '<br>' . $config->get("sitename") . '<br>';
        $mailer->setSubject(
            $params->get('email_subject') ?? $config->get("sitename")
        );
        $mailer->setBody($emailBody);
        $mailer->Send();
        return true;
    }
}