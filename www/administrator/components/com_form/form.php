<?php defined('_JEXEC') or die;

jimport('joomla.application.component.controller');
JLoader::register('FormHelper', __DIR__.'/helpers/form.php');

$controller = JControllerLegacy::getInstance('Form');
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
$controller->redirect();