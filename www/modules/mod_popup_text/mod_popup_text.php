<?php
defined('_JEXEC') or die;

$documentText = $params->get('text', '');
$moduleClass = $params->get('module_class', '');

require JModuleHelper::getLayoutPath(
    'mod_popup_text',
    $params->get(
        'layout',
        'default'
    )
);
