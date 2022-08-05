<?php
defined('_JEXEC') or die;

$documentText = $params->get('text', '');
$moduleId = $params->get('module_id', '');

require JModuleHelper::getLayoutPath(
    'mod_popup_text',
    $params->get(
        'layout',
        'default'
    )
);
