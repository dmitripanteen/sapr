<?php defined('_JEXEC') or die;

if ($this->params['menu-meta_description']){
    JFactory::getDocument()->setDescription($this->params['menu-meta_description']);
}
if ($this->params['menu-meta_keywords']){
    JFactory::getDocument()->setMetaData('keywords', $this->params['menu-meta_keywords']);
}
?>
<h1 class="page-header"><?=$this->customHeader;?></h1>
<div class="contact-details">
    <?=$this->contactData;?>
</div>
<div class="map">
    <div class="triangle"></div>
    <?=$this->mapCode;?>
</div>
