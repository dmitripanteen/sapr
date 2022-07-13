<?php defined('_JEXEC') or die;


class VideosController extends JControllerLegacy {

	public function display($cachable = false, $urlparams = false) {
        $this->input->set('view', $this->input->get('view', 'videos'));
        return parent::display($cachable);
	}

}