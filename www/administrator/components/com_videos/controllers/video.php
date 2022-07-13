<?php defined('_JEXEC') or die;

class VideosControllerVideo extends JControllerForm
{

    /** @var  bool */
    protected $errors;

    /**
     * @var VideosModelVideo
     */
    protected $model;

    public function save($key = null, $urlVar = null)
    {

        $app = JFactory::getApplication();
        $jform = $app->input->post->get('jform', array(), 'array');
        if ($this->errors) {
            $app->setUserState('com_videos.edit.video.data', $jform);
            $this->setRedirect(
                JRoute::_(
                    'index.php?option=com_videos&view=video&layout=edit&id=' .
                    $jform['id']
                )
            );
            return false;
        }
        $app->input->post->set('jform', $jform);
        $this->model = $this->getModel('video');
        parent::save();
        return true;
    }
}