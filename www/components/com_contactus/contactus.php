<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

$controller = JControllerLegacy::getInstance('ContactUs');
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task', ''));
$controller->redirect();