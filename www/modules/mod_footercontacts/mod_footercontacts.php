<?php
defined('_JEXEC') or die;

$contacts = $params->get('info','');

require JModuleHelper::getLayoutPath('mod_footercontacts', $params->get('layout', 'default'));
