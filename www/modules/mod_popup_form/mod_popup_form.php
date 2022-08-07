<?php
defined('_JEXEC') or die;

$moduleId = $params->get('module_id', '');

require JModuleHelper::getLayoutPath(
    'mod_popup_form',
    $params->get(
        'layout',
        'default'
    )
);
