<?php defined('_JEXEC') or die;

class FormControllerSupport extends JControllerForm
{
    /**
     * @var FormModelSupport
     */
    private $model;

    public function sendRequest()
    {
        $this->model = $this->getModel();
        $isError = false;
        $input = JFactory::getApplication()->input;
        $formData = $input->get('jform', '', 'array');
        $formFiles = $_FILES['jform'];
        $validationResult = $this->model->validateForm($formData);
        if ($validationResult === false) {
            $isError = true;
            echo json_encode(
                [
                    'success' => false,
                    'error'   => JText::_('COM_FORM_ERROR_MSG')
                ]
            );
            JFactory::getApplication()->close();
        }
        if (!$isError) {
            if (
                isset($formFiles['name']['file1'])
                && $formFiles['name']['file1']
            ) {
                move_uploaded_file(
                    $formFiles['tmp_name']['file1'],
                    JPATH_ROOT .
                    '/images/user-support/' .
                    $formFiles['name']['file1']
                );
                $formData['file1'] =
                    '/images/user-support/' . $formFiles['name']['file1'];
            }
            if (
                isset($formFiles['name']['file2'])
                && $formFiles['name']['file2']
            ) {
                move_uploaded_file(
                    $formFiles['tmp_name']['file2'],
                    JPATH_ROOT .
                    '/images/user-support/' .
                    $formFiles['name']['file2']
                );
                $formData['file2'] =
                    '/images/user-support/' . $formFiles['name']['file2'];
            }
            if (
                isset($formFiles['name']['file3'])
                && $formFiles['name']['file3']
            ) {
                move_uploaded_file(
                    $formFiles['tmp_name']['file3'],
                    JPATH_ROOT .
                    '/images/user-support/' .
                    $formFiles['name']['file3']
                );
                $formData['file3'] =
                    '/images/user-support/' . $formFiles['name']['file3'];
            }
            if (
                isset($formFiles['name']['file4'])
                && $formFiles['name']['file4']
            ) {
                move_uploaded_file(
                    $formFiles['tmp_name']['file4'],
                    JPATH_ROOT .
                    '/images/user-support/' .
                    $formFiles['name']['file4']
                );
                $formData['file4'] =
                    '/images/user-support/' . $formFiles['name']['file4'];
            }
            $result = $this->model->sendRequest($formData);
            $this->sendEmail($formData);
            if ($result === true) {
                echo json_encode(
                    [
                        'success' => true,
                    ]
                );
            } else {
                echo json_encode(
                    [
                        'success' => false,
                        'error'   => $result
                    ]
                );
            }
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
                JText::_('COM_FORM_FIELD_PHONE_LABEL')
            )
            . ':</b> ' . $formData['phone'] . '<br>';
        $body .= '<b>' . str_replace(
                '*',
                '',
                JText::_('COM_FORM_FIELD_EMAIL_LABEL')
            )
            . ':</b> ' . $formData['email'] . '<br>';
        $filesData = [];
        for ($i = 1; $i <= 4; $i++) {
            if (isset($formData['file'.$i])) {
                $filesData[] = '<a href="'
                    . $this->getServerUrl() . $formData['file'.$i]
                    . '">' . $this->getServerUrl() . $formData['file'.$i]
                    . '</a>';
            }
        }
        if(count($filesData)){
            $body .= '<b>' . str_replace(
                    '*',
                    '',
                    JText::_('COM_FORM_ATTACHED_FILES_LABEL')
                )
                . ':</b> ' . implode("<br>", $filesData) . '<br>';
        }
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
        $mailer->setSubject(JText::_('COM_FORM_USER_SUPPORT_MAIL_HEADER'));
        $mailer->setBody($emailBody);
        $mailer->Send();
        return true;
    }

    private function getServerUrl()
    {
        if (isset($_SERVER['HTTPS'])) {
            $protocol =
                ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https"
                    : "http";
        } else {
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'];
    }
}