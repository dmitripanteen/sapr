<?php
defined('_JEXEC') or die;

$links = $params->get('links', '');
$copyrightsText = $params->get('copyrights', '');

require JModuleHelper::getLayoutPath(
    'mod_footersocial',
    $params->get('layout', 'default')
);
