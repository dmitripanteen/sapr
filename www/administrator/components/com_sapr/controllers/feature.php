<?php defined('_JEXEC') or die;

class SaprControllerFeature extends JControllerForm
{

    /** @var  bool */
    protected $errors;

    /**
     * @var SaprModelFeature
     */
    protected $model;

    public function save($key = null, $urlVar = null)
    {

        $app = JFactory::getApplication();
        $jform = $app->input->post->get('jform', array(), 'array');
        $this->processAlias($jform);
        $app->input->post->set('jform', $jform);
        if ($this->errors) {
            $app->setUserState('com_sapr.edit.feature.data', $jform);
            $this->setRedirect(
                JRoute::_(
                    'index.php?option=com_sapr&view=feature&layout=edit&id=' .
                    $jform['id']
                )
            );
            return false;
        }
        $app->input->post->set('jform', $jform);
        $this->model = $this->getModel('feature');
        parent::save();
        return true;
    }

    /**
     * @param $jform
     */
    private function processAlias(&$jform){
        $app = JFactory::getApplication();
        if (empty($jform['alias'])) {
            $jform['alias'] = $jform['title'];
            $jform['alias'] =
                JFilterOutput::stringURLUnicodeSlug($jform['title']);
            $currAlias = $jform['alias'];
            $suffix = 2;
            if ($this->isAliasExist($jform)) {
                $app->enqueueMessage(
                    JText::_('COM_SAPR_MANAGER_ERR_COPY_ALIAS'),
                    "warning"
                );
            }
        } else{
            $jform['alias'] =
                JFilterOutput::stringURLUnicodeSlug($jform['alias']);
        }
        while ($this->isAliasExist($jform)){
            $jform['alias'] = $currAlias.'-'.$suffix;
            $suffix++;
        }
    }

    /**
     * @param $jform
     * @return bool
     */
    private function isAliasExist($jform){
        $db = JFactory::getDBO();

        $db->setQuery(
            $db->getQuery(true)
                ->select('count(*)')
                ->from('#__sapr')
                ->where('alias='.$db->quote($jform['alias']))
                ->where('id != '.$db->quote($jform['id']))
        );

        return ($db->loadResult() > 0);
    }
}