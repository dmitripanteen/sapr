<?php defined('_JEXEC') or die;


class SaprTableFeature extends JTable {

    protected $_jsonEncode = array('gallery');

    public function __construct(&$db) {
        parent::__construct('#__sapr', 'id', $db);
    }

}