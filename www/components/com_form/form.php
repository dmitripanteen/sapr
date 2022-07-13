<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

$controller = JControllerLegacy::getInstance('Form');
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task', 'display'));
$controller->redirect();