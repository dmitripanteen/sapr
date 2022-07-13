<?php defined('_JEXEC') or die;


class FormTableTrialVersion extends JTable {

    public function __construct(&$db) {
        parent::__construct('#__form_trial_version', 'id', $db);
    }

}