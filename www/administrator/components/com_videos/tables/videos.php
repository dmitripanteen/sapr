<?php defined('_JEXEC') or die;


class VideosTableVideos extends JTable {

	/**
	 * @param JDatabase &$db
	 */
	public function __construct(&$db) {
		parent::__construct('#__videos', 'id', $db);
	}

}