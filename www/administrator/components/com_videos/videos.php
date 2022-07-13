<?php

defined('_JEXEC') or die;
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

jimport('joomla.application.component.controller');

$controller = JControllerLegacy::getInstance('Videos');
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
$controller->redirect();